<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Contact>
 */
class ContactFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->email(),
            'title' => $this->faker->title(),
            'phone' => $this->faker->phoneNumber(),
            'body' => $this->faker->paragraph(5),
            'ip_address' => $this->faker->ipv4(),
        ];
    }
}
