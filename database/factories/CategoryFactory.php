<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;


class CategoryFactory extends Factory
{
    protected $model = Category::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $name = $this->faker->unique()->name();
        return [
            'id' => Str::uuid(),
            'name' => $this->faker->unique()->name(), 
            'slug' => Str::slug($name),           
            'description' => $this->faker->sentence(10),
        ];
    }
}
