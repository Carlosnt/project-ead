<?php

namespace Tests\Feature\Api;

use App\Models\Course;
use App\Models\Module;
use Tests\TestCase;

class ModuleTest extends TestCase
{
    use UtilsTrait;

    public function test_get_modues_unauthenticated()
    {
        $response = $this->getJson('/courses/fake_id/modules');

        $response->assertStatus(401);
    }

    public function test_get_modues_course_not_found()
    {
        $response = $this->get('/courses/fake_id/modules', $this->defaultHeaders());

        $response->assertStatus(200)->assertJsonCount(0, 'data');
    }

    public function test_get_modues_course()
    {
        $course = Course::factory()->create();
        $response = $this->get("/courses/{$course->id}/modules", $this->defaultHeaders());

        $response->assertStatus(200);
    }

    public function test_get_modues_course_total()
    {
        $course = Course::factory()->create();
        $modules = Module::factory()->count(10)->create([
            'course_id' => $course->id,
        ]);
        $response = $this->get("/courses/{$course->id}/modules", $this->defaultHeaders());

        $response->assertStatus(200)->assertJsonCount(10, 'data');;
    }

    
}
