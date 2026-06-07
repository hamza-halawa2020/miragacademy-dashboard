<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class MainSliderFactory extends Factory
{
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(5),
            'description' => fake()->sentence(12),
            'link' => '/' . fake()->slug(),
            'image' => 'sliders/' . fake()->slug() . '.jpg',
            'status' => fake()->boolean(80),
        ];
    }
}
