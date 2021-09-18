<?php
namespace App\Repositories\Balance;


use App\Repositories\Balance\BalanceInterface as BalanceInterface;
use App\Withdraw as WithdrawModel;
use App\Deposit as DepositModel;
use Illuminate\Support\Facades\DB;

class BalanceRepository implements BalanceInterface
{
    

    public function get()
    {
        return (double)$this->getDepositTotal()-(double)$this->getWithdrawTotal();
    }
    private function getWithdrawTotal(){
    	return WithdrawModel::get()->sum('amount');
    }

    private function getDepositTotal(){
    	return DepositModel::get()->sum('amount');
    }

}