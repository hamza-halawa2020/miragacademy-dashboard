<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CertificateFactory extends Factory
{
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(4),
            'file' => 'certificates/' . fake()->slug() . '.pdf',
            'status' => fake()->boolean(85),
        ];
    }
}
