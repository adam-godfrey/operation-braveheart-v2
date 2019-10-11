<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class LotteryDrawModelServiceProvider extends ServiceProvider
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
        \App\Models\Admin\LotteryDraw::observe(\App\Observer\LotteryDrawObserver::class);
    }
}
