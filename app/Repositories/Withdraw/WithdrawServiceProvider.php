<?php
namespace App\Repositories\Withdraw;


use Illuminate\Support\ServiceProvider;


class WithdrawServiceProvider extends ServiceProvider
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
        $this->app->bind('App\Repositories\Withdraw\WithdrawInterface', 'App\Repositories\Withdraw\WithdrawRepository');
    }
}