<?php
namespace App\Repositories\Withdraw;


use App\Repositories\Withdraw\WithdrawInterface as WithdrawInterface;
use App\Withdraw as WithdrawModel;
use Carbon\Carbon;



class WithdrawRepository implements WithdrawInterface
{
    

    public function save($data)
    {
        WithdrawModel::create($data);
        return 'created';
    }
    public function getWithDrawAttempts(){
    	return WithdrawModel::whereDate('created_at', Carbon::today())->get()->count();
    }
    public function getWithAmountperDay(){
    	return WithdrawModel::whereDate('created_at', Carbon::today())->get()->sum('amount');
    }

}