<?php

namespace Database\Factories;

use App\Models\Course;
use App\Models\Lesson;
use App\Models\ReplySupport;
use App\Models\Support;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;


/**
 *
 */
class ReplySupportFactory extends Factory
{
    protected $model = ReplySupport::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'id' => Str::uuid(),
            'support_id' => Support::factory(),
            'user_id' => User::factory(),
            'admin_id' => null,
            'description' => $this->faker->sentence(20),
        ];
    }
}
