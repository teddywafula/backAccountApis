<?php
namespace App\Repositories\Balance;


use Illuminate\Support\ServiceProvider;


class BalanceServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        
    }


    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('App\Repositories\Balance\BalanceInterface', 'App\Repositories\Balance\BalanceRepository');
    }
}