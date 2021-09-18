<?php

namespace App\Providers;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;
use Carbon\Carbon;
use App\Deposit as DepositModel;
use App\Withdraw as WithdrawModel;

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
        //
        Schema::defaultStringLength(191);
        Validator::extend('maxi_atts', function ($attribute, $value, $parameters, $validator) {
             return WithdrawModel::whereDate('created_at', Carbon::today())->get()->count() < 4;
          });
        Validator::extend('amount_balance', function ($attribute, $value, $parameters, $validator) {
              return $value<=50000;
         
          });
        Validator::extend('check_balance', function ($attribute, $value, $parameters, $validator) {
             return (double)DepositModel::get()->sum('amount')-(double)WithdrawModel::get()->sum('amount') >= $value;
         
          });

        Validator::extend('amount_nums', function ($attribute, $value, $parameters, $validator) {
            return DepositModel::whereDate('created_at', Carbon::today())->get()->count() < 5;
          });
        Validator::extend('maxim_deposit', function ($attribute, $value, $parameters, $validator) {
            return $value<=150000;
         
          });
        
        
          

    }
}
