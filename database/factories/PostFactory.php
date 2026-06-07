<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(6),
            'description' => fake()->paragraphs(3, true),
            'image' => 'posts/' . fake()->slug() . '.jpg',
            'status' => fake()->boolean(75),
        ];
    }
}
