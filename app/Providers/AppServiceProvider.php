<?php

namespace App\Providers;

use App\Services\Socialite\Contract\Social;
use App\Services\Socialite\SocialService;
use Carbon\CarbonInterval;
use Illuminate\Database\Connection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Http\Kernel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;
use Illuminate\Validation\Rules\Password;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(Social::class, SocialService::class);
    }

    public function boot(): void
    {
        Model::shouldBeStrict(!app()->isProduction());

        if (app()->isProduction()) {
            DB::listen(function ($query) {
                if ($query->time > 10) {
                    logger()->channel('telegram')
                        ->debug('whenQueryingForLongerThan:' . $query->sql, $query->bindings);
                }
            });

            app(Kernel::class)->whenRequestLifecycleIsLongerThan(
                CarbonInterval::seconds(4), fn() => logger()
                ->channel('telegram')
                ->debug('whenRequestLifecycleIsLongerThan:' . request()->url()));
        }

        Password::defaults(fn() => Password::min(8)
            ->letters()
            ->uncompromised()
            ->numbers()
        );
    }
}
