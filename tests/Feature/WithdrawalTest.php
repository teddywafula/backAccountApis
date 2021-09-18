<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class WithdrawalTest extends TestCase
{
    use RefreshDatabase;
    /**
     * Test withdraw api
     *
     * @return void
     */
    public function testWithdrawZero()
    {
        $response = $this->withHeaders([
            'Content-Type' => 'Application\json',
        ])->json('POST', '/api/withdraw/', ['amount' => 0]);


        return $response
            ->assertStatus(422)
            ->assertSee("Enter a valid amount");
    }

    public function testExceedWithdrawal()
    {
        $response = $this->withHeaders([
            'Content-Type' => 'Application\json',
        ])->json('POST', '/api/withdraw/', ['amount' => 20001]);

        $response
            ->assertStatus(422)
            ->assertSee("Exceeded Maximum Withdrawal Per Transaction");
    }
}
