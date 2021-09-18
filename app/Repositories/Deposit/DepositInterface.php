<?php
namespace App\Repositories\Deposit;


interface DepositInterface {


    public function save($data);
    public function getAttempts();
    public function getDepAmountperDay();

}