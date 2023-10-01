<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SubscriptionTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $user = [
            'expired_at' => '2023-11-01',
            'renewed_at' => '2023-10-01'
        ];
        $response = $this->post('/api/user/3/subscription/3', $user);


        $response->assertStatus(201);
        $response->assertRedirect('/');


    }
}
