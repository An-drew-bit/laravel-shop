<?php

namespace Domain\Catalog\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Domain\Catalog\Builders\CategoryBuilder;
use Domain\Product\Models\Product;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @method static Category|CategoryBuilder query()
 */
class Category extends Model
{
    use HasFactory, Sluggable;

    protected $fillable = [
        'title',
        'on_home_page',
        'sorting'
    ];

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class);
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    public function newEloquentBuilder($query): CategoryBuilder
    {
        return new CategoryBuilder($query);
    }
}
