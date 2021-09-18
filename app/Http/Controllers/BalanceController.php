<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Balance\BalanceInterface;

class BalanceController extends Controller
{
    
    protected $balance;
    /**
     * BalanceController constructor.
     *
     * @param BalanceInterface $balance
    **/

    public function __construct(BalanceInterface $balance)
    {
        $this->balance = $balance;
    }
     public function balance(Request $request)
    {
        return response()->json($this->balance->get());

    }
}
