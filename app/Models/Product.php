<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Domain\Catalog\Models\Brand;
use Domain\Catalog\Models\Category;
use Illuminate\Contracts\Database\Query\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Pipeline\Pipeline;
use Support\Casts\PriceCast;

class Product extends Model
{
    use HasFactory, Sluggable;

    protected $fillable = [
        'title',
        'thumbnail',
        'price',
        'brand_id',
        'on_home_page',
        'sorting',
        'text'
    ];

    protected $casts = [
        'price' => PriceCast::class
    ];

    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class);
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    public function scopeHomePage(Builder $query): void
    {
        $query->where('on_home_page', true)
            ->orderBy('sorting')
            ->limit(8);
    }

    public function scopeFiltered(Builder $query): mixed
    {
        return app(Pipeline::class)
            ->send($query)
            ->through(filters())
            ->thenReturn();
    }

    public function scopeSorted(Builder $query): void
    {
        $query->when(request('sort'), function (Builder $builder) {
            $column = request()->str('sort');

            if ($column->contains(['price', 'title'])) {
                $direction = $column->contains('-') ? 'DESC' : 'ASC';

                $builder->orderBy((string) $column->remove('-'), $direction);
            }
        });
    }
}
