<?php

namespace Domain\Catalog\Models;

use App\Models\Product;
use Cviebrock\EloquentSluggable\Sluggable;
use Domain\Catalog\Builders\BrandBuilder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @method static Brand|BrandBuilder query()
 */
class Brand extends Model
{
    use HasFactory, Sluggable;

    protected $fillable = [
        'title',
        'thumbnail',
        'on_home_page',
        'sorting'
    ];

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    public function newEloquentBuilder($query): BrandBuilder
    {
        return new BrandBuilder($query);
    }
}
