<?php

namespace Database\Factories;

use App\Models\Course;
use App\Models\Lesson;
use App\Models\Support;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;


/**
 *
 */
class SupportFactory extends Factory
{
    protected $model = Support::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $statusOptions = ['P','A','C'];
        shuffle($statusOptions);
        return [
            'id' => Str::uuid(),
            'user_id' => User::factory(),
            'lesson_id' => Lesson::factory(),
            'name' => $this->faker->unique()->name(),  
            'status' => $statusOptions[0],
            'description' => $this->faker->sentence(20),
        ];
    }
}
