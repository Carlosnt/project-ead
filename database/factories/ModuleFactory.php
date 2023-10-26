<?php

namespace Database\Factories;

use App\Models\Course;
use App\Models\Module;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;


class ModuleFactory extends Factory
{
    protected $model = Module::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'id' => Str::uuid(),
            'course_id' => Course::factory(),
            'name' => $this->faker->unique()->name(),
        ];
    }
}
