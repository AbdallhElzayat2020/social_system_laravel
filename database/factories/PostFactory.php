<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $date = $this->faker->date('Y-m-d H:i:s', 'now');
        return [
            'title' => $this->faker->sentence(5),
            'description' => $this->faker->paragraph(5),
            'status' => $this->faker->randomElement(['active', 'inactive']),
            'comment_able' => $this->faker->boolean(),
            'user_id' => User::inRandomOrder()->first()->id,
            'category_id' => Category::inRandomOrder()->first()->id,
            'created_at' => $date,
            'updated_at' => $date,
        ];
    }
}
