<?php

namespace Tests\Feature\Api;

use App\Models\Support;
use Tests\TestCase;

class ReplySupportTest extends TestCase
{
    use UtilsTrait;

    public function test_create_replay_to_support_unauthenticated()
    {
        $response = $this->postJson('/replies');
        $response->assertStatus(401);
    }

    public function test_create_replay_to_support_error_validations()
    {
        $response = $this->postJson('/replies', [], $this->defaultHeaders());
        $response->assertStatus(422);
    }  

    public function test_create_replay_to_support()
    {
        
        $support = Support::factory()->create();
        $payload = [
            'support' => $support->id,
            'description' => 'Criado com sucesso'
        ];

        $response = $this->postJson('/replies', $payload, $this->defaultHeaders());
        $response->assertStatus(201);
    }    
    
}
