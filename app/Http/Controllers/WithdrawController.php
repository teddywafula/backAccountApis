<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\Withdraw as WithdrawResource;
use App\Repositories\Withdraw\WithdrawInterface;

class WithdrawController extends Controller
{
    
    protected $withdraw;
    /**
     * WithdrawController constructor.
     *
     * @param WithdrawInterface $post
    **/

    public function __construct(WithdrawInterface $withdraw)
    {
        $this->withdraw = $withdraw;
    }
     public function store(WithdrawResource $request)
    {

        $validated = $request->validated();
        return response()->json($this->withdraw->save($validated),201);

    }
   
}
