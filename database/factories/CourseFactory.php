<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CourseFactory extends Factory
{
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(4),
            'description' => fake()->paragraphs(2, true),
            'image' => 'courses/' . fake()->slug() . '.jpg',
            'status' => fake()->boolean(80),
        ];
    }
}
