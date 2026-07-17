<?php

namespace Database\Factories;

use App\Models\Exam;
use App\Models\Period;
use Illuminate\Database\Eloquent\Factories\Factory;

/** @extends Factory<Exam> */
class ExamFactory extends Factory
{
    public function definition(): array
    {
        return [
            'period_id' => Period::factory(),
            'name' => 'Ujian Seleksi ' . fake()->randomElement(['Gelombang 1', 'Gelombang 2', 'Gelombang 3']),
            'duration_minutes' => fake()->randomElement([90, 120, 150, 180]),
        ];
    }
}
