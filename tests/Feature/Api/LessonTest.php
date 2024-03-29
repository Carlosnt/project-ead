<?php

namespace Tests\Feature\Api;

use App\Models\Course;
use App\Models\Lesson;
use App\Models\Module;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LessonTest extends TestCase
{
    use UtilsTrait;

    public function test_get_lessons_unauthenticated()
    {
        $response = $this->getJson('/modules/fake_id/lessons');

        $response->assertStatus(401);
    }

    public function test_get_lessons_of_module_not_found()
    {
        $response = $this->get('/modules/fake_id/lessons', $this->defaultHeaders());

        $response->assertStatus(200)->assertJsonCount(0, 'data');
    }

    public function test_get_lessons_module()
    {
        $course = Module::factory()->create();
        $response = $this->get("/modules/{$course->id}/lessons", $this->defaultHeaders());

        $response->assertStatus(200);
    }

    public function test_get_lessons_of_module_total()
    {
        $module = Module::factory()->create();
        $lessons = Lesson::factory()->count(10)->create([
            'module_id' => $module->id,
        ]);
        $response = $this->get("/modules/{$module->id}/lessons", $this->defaultHeaders());

        $response->assertStatus(200)->assertJsonCount(10, 'data');;
    }

    public function test_get_single_lessons_unauthenticated()
    {
        $response = $this->getJson('/lessons/fake_value');

        $response->assertStatus(401);
    }

    public function test_get_single_lessons_not_found()
    {
        $response = $this->getJson('/lessons/fake_value', $this->defaultHeaders());

        $response->assertStatus(404);
    }

    public function test_get_single_lessons()
    {
        $lesson = Lesson::factory()->create();

        $response = $this->getJson("/lessons/{$lesson->id}", $this->defaultHeaders());

        $response->assertStatus(200);
    }

    
}
