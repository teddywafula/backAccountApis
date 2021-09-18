<?php
namespace App\Repositories\Deposit;


use Illuminate\Support\ServiceProvider;


class DepositServiceProvider extends ServiceProvider
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
        $this->app->bind('App\Repositories\Deposit\DepositInterface', 'App\Repositories\Deposit\DepositRepository');
    }
}