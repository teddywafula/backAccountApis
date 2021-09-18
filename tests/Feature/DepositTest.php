<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DepositTest extends TestCase
{
     use RefreshDatabase;
    /**
     * Test deposit api.
     *
     * @return void
     */

    
    public function testDepositZero(){
         $response = $this->withHeaders([
            'Content-Type' => 'Application\json',
        ])->json('POST', '/api/deposit/', ['amount' => 0]);

        $response
            ->assertStatus(422)
            ->assertSee("The amount must be greater than or equal 1.");
    }
    public function testExceedDeposit(){
         $response = $this->withHeaders([
            'Content-Type' => 'Application\json',
        ])->json('POST', '/api/deposit/', ['amount' => 40001]);

        $response
            ->assertStatus(422)
            ->assertSee("Exceeded Maximum Deposit Per Transaction");
    }
    

}
