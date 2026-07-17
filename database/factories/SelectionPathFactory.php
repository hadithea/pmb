<?php

namespace Database\Factories;

use App\Models\SelectionPath;
use Illuminate\Database\Eloquent\Factories\Factory;

/** @extends Factory<SelectionPath> */
class SelectionPathFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => fake()->randomElement(['Prestasi', 'Bersama', 'Mandiri', 'UTBK']),
            'description' => fake()->sentence(),
            'is_active' => true,
        ];
    }
}
