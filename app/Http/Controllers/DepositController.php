<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\Deposit as DepositResource;
use App\Repositories\Deposit\DepositInterface;

class DepositController extends Controller
{
    
    protected $deposit;
    /**
     * DepositController constructor.
     *
     * @param DepositRepositoryInterface $post
    **/

    public function __construct(DepositInterface $deposit)
    {
        $this->deposit = $deposit;
    }
     public function store(DepositResource $request)
    {

        $validated = $request->validated();
        return response()->json($this->deposit->save($validated),201);

    }
}
