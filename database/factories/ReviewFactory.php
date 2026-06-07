<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ReviewFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'country' => fake()->country(),
            'review' => fake()->paragraph(),
            'status' => fake()->boolean(80),
        ];
    }
}
