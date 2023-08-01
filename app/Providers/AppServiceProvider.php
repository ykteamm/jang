<?php

namespace App\Providers;

use App\Services\LockService;
use App\Services\MakeImageService;
use App\Services\PlanFactService;
use App\Services\TurnirService;
use Illuminate\Cache\Lock;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        date_default_timezone_set('Asia/Tashkent');
        $this->app->bind(MakeImageService::class, MakeImageService::class);
        $this->app->bind(LockService::class, LockService::class);
        $this->app->bind(PlanFactService::class, PlanFactService::class);
        \Debugbar::disable();
    }
}
