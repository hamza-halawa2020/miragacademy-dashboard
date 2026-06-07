<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class MediaCenterFactory extends Factory
{
    public function definition(): array
    {
        $type = fake()->randomElement(['image', 'video']);

        return [
            'title' => fake()->sentence(5),
            'type' => $type,
            'file' => $type === 'image' ? 'media/' . fake()->slug() . '.jpg' : null,
            'video_url' => $type === 'video' ? fake()->url() : null,
            'status' => fake()->boolean(80),
        ];
    }
}
