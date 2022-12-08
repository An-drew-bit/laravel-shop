<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Seo as SeoModel;
use Illuminate\Support\Facades\Cache;

class Seo
{
    public function handle(Request $request, Closure $next)
    {
        $seo = Cache::rememberForever('seo_' . str($request->getPathInfo())->slug('_'), function () use ($request) {
            SeoModel::query()->where('url', $request->getPathInfo())->first() ?? false;
        });

        if ($seo) {
            view()->share('seo_title', $seo->title);
        }

        return $next($request);
    }
}
