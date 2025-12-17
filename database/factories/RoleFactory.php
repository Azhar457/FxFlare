<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class RoleFactory extends Factory
{
    public function definition(): array
    {
        return [
            //gunakan unique agar tidak ada nama role ganda saat seeding//
            'name' => fake()->unique()->randomElement(['admin', 'editor', 'user']),
        ];
    }
}
