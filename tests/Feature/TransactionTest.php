<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TransactionTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $param = [
            'subscription_id' => '5',
            'price' => '1'
        ];
        $response = $this->post('/api/user/3/transaction', $param);


        $response->assertStatus(201);
        $response->assertRedirect('/');

    }
}
