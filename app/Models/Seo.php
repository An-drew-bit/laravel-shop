<?php

namespace App\Models;

use App\Casts\SeoUrlCast;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Seo extends Model
{
    use HasFactory;

    protected $fillable = [
        'url',
        'title'
    ];

    protected $casts = [
        'url' => SeoUrlCast::class,
    ];

    protected static function boot()
    {
        parent::boot();

        static::created(function (self $model) {
            Cache::forget('seo_' . str($model->url)->slug('_'));
        });

        static::updated(function (self $model) {
            Cache::forget('seo_' . str($model->url)->slug('_'));
        });

        static::deleted(function (self $model) {
            Cache::forget('seo_' . str($model->url)->slug('_'));
        });
    }
}
