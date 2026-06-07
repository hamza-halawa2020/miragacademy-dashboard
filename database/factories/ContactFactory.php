<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ContactFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'phone' => fake()->phoneNumber(),
            'email' => fake()->safeEmail(),
            'age' => fake()->numberBetween(7, 70),
            'country' => fake()->country(),
            'course' => fake()->randomElement([
                'Noor Al-Bayan',
                'Quran Memorization',
                'Tajweed',
                'Arabic',
                'Islamic Studies',
            ]),
            'message' => fake()->paragraph(),
        ];
    }
}
