<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\User;



class BankTransactionsTest extends TestCase
{
     use RefreshDatabase;
   
    public function testDeposit()
    {
        
        $response = $this->withHeaders([
            'Content-Type' => 'Application\json',
        ])->json('POST', '/api/deposit/', ['amount' => 10]);

        $response
            ->assertStatus(201)
            ->assertSee("created");

    }

    public function testBalance()
    {
        $response = $this->withHeaders([
            'Content-Type' => 'Application\json',
        ])->json('GET', '/api/balance/');

        $response
            ->assertStatus(200)
            ->assertSee(0);
    }

    public function testWithdraw()
    {
        
        $response = $this->withHeaders([
            'Content-Type' => 'Application\json',
        ])->json('POST', '/api/withdraw/', ['amount' => 10]);

        $response
            ->assertStatus(422)
            ->assertSee("You have insufficient balance.");

    }


}
