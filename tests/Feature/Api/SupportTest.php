<?php

namespace Tests\Feature\Api;

use App\Models\Course;
use App\Models\Lesson;
use App\Models\Module;
use App\Models\Support;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SupportTest extends TestCase
{
    use UtilsTrait;
    public function test_get_my_support_unauthenticated()
    {
        $response = $this->getJson('/supports');
        $response->assertStatus(401);
    }

    public function test_get_my_supports()
    {
        $user = $this->createUser();
        $token = $user->createToken('teste')->plainTextToken;
        Support::factory()->count(50)->create([
            'user_id' => $user->id,
        ]);

        Support::factory()->count(50)->create();
       
        $response = $this->getJson('/my-supports', [
            'Authorization' => "Bearer {$token}"
        ]);
        $response->assertStatus(200)->assertJsonCount(100, 'data');
    }  
    
    public function test_get_supports()
    {
        Support::factory()->count(50)->create();
       
        $response = $this->getJson('/supports', $this->defaultHeaders());
        $response->assertStatus(200)->assertJsonCount(50, 'data');
    }   

    public function test_get_supports_filter_lessons()
    {
        Support::factory()->count(50)->create();
        $lesson = Lesson::factory()->create();
        Support::factory()->count(10)->create([
            'lesson_id' => $lesson->id,
        ]);
        $payload = ['lesson_id' => $lesson->id];
       
        $response = $this->json('GET', '/supports', $payload, $this->defaultHeaders());
        $response->assertStatus(200)->assertJsonCount(60, 'data');
    }    

    public function test_create_support_unauthenticated()
    {
        $response = $this->postJson('/supports');
        $response->assertStatus(401);
    }

    public function test_create_support_error_validatoion()
    {
        $response = $this->postJson('/supports',[], $this->defaultHeaders());
        $response->assertStatus(422);
    }

    public function test_create_support()
    {
        $lesson = Lesson::factory()->create();
        $payload = [
            'lesson' => $lesson->id,
            'status' => 'P',
            'description' => 'Criado com sucesso'
        ];

        $response = $this->postJson('/supports',$payload, $this->defaultHeaders());
        $response->assertStatus(201);
    }
}
