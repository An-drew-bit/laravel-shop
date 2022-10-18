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
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->bind(Social::class, SocialService::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(): void
    {
        Model::preventLazyLoading(!app()->isProduction());
        Model::preventSilentlyDiscardingAttributes(!app()->isProduction());

        DB::whenQueryingForLongerThan(500, fn(Connection $connection) => logger()
                ->channel('telegram')
                ->debug('whenQueryingForLongerThan:' . $connection->query()->toSql()));

        $kernel = app(Kernel::class);

        $kernel->whenRequestLifecycleIsLongerThan(
            CarbonInterval::seconds(4), fn() => logger()
                ->channel('telegram')
                ->debug('whenRequestLifecycleIsLongerThan:' . request()->url()));

        Password::defaults(fn() => Password::min(8)
            ->letters()
            ->uncompromised()
            ->numbers()
        );
    }
}
