<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class LotteryBallModelServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        \App\Models\Admin\LotteryBall::observe(\App\Observer\LotteryBallObserver::class);
    }
}
