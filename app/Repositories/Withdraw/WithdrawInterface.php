<?php
namespace App\Repositories\Withdraw;


interface WithdrawInterface {


    public function save($data);
    public function getWithDrawAttempts();
    public function getWithAmountperDay();

}