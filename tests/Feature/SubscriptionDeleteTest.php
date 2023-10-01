<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SubscriptionDeleteTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function destroy(): void
    {
        $param = [
            'method' => 'DELETE'
        ];
        $response = $this->post('/api/user/3/subscription/3', $param);


        $response->assertStatus(201);
        $response->assertRedirect('/');

    }
}
