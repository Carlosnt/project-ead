<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Course;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;


/**
 *
 */
class CourseFactory extends Factory
{
    protected $model = Course::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'id' => Str::uuid(),
            'category_id' => Category::factory(),
            'name' => $this->faker->unique()->name(),            
            'description' => $this->faker->sentence(10),
        ];
    }
}
