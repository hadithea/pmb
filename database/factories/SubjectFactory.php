<?php

namespace Database\Factories;

use App\Models\Subject;
use Illuminate\Database\Eloquent\Factories\Factory;

/** @extends Factory<Subject> */
class SubjectFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => fake()->randomElement([
                'TPA', 'Matematika', 'Bahasa Indonesia',
                'Bahasa Inggris', 'Fisika', 'Kimia',
            ]),
            'description' => fake()->sentence(),
        ];
    }
}
