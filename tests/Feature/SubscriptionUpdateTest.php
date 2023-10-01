<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SubscriptionUpdateTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {

        $param = [
            'expired_at' => '2023-12-01',
            'renewed_at' => '2023-10-01',
            'method' => 'PUT'
        ];
        $response = $this->post('/api/user/3/subscription/3', $param);


        $response->assertRedirect('/');

        $response->assertStatus(201);
    }
}
