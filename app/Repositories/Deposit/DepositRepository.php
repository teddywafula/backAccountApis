<?php
namespace App\Repositories\Deposit;


use App\Repositories\Deposit\DepositInterface as DepositInterface;
use App\Deposit as DepositModel;
use Carbon\Carbon;


class DepositRepository implements DepositInterface
{
    

    public function save($data)
    {
        DepositModel::create($data);
        return 'created';
    }
    public function getAttempts(){
    	return DepositModel::whereDate('created_at', Carbon::today())->get()->count();
    }
    public function getDepAmountperDay(){
    	return DepositModel::whereDate('created_at', Carbon::today())->get()->sum('amount');
    }


}