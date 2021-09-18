<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BalanceTest extends TestCase
{
    use RefreshDatabase;
    /**
     * Test balance api
     *
     * @return void
     */
    public function testBalance()
    {
        $response = $this->get('/api/balance');

        $response->assertStatus(200);
    }
}
