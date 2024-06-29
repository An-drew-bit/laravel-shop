<?php

declare(strict_types=1);

namespace App\Providers;

use Carbon\CarbonInterval;
use Illuminate\Support\Facades\DB;
use Illuminate\Container\Container;
use Illuminate\Support\Facades\App;
use Services\Socialite\SocialService;
use Illuminate\Foundation\Http\Kernel;
use Services\Socialite\Contract\Social;
use Illuminate\Database\Eloquent\Model;
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
        Model::preventLazyLoading(!App::isProduction());
        Model::preventSilentlyDiscardingAttributes(!App::isProduction());

        if (App::isProduction()) {
            DB::listen(function ($query) {
                if ($query->time > 10) {
                    logger()->channel('telegram')
                        ->debug('whenQueryingForLongerThan:' . $query->sql, $query->bindings);
                }
            });

            Container::getInstance()
                ->make(Kernel::class)
                ->whenRequestLifecycleIsLongerThan(
                    CarbonInterval::seconds(4), fn() => logger()
                        ->channel()
                        ->debug('whenRequestLifecycleIsLongerThan:' . request()->url())
                );
        }

        Password::defaults(fn() => Password::min(8)
            ->letters()
            ->uncompromised()
            ->numbers()
        );
    }
}
