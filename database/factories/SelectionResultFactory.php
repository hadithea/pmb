<?php

namespace Database\Factories;

use App\Models\Registration;
use App\Models\SelectionResult;
use App\Models\StudyProgram;
use Illuminate\Database\Eloquent\Factories\Factory;

/** @extends Factory<SelectionResult> */
class SelectionResultFactory extends Factory
{
    public function definition(): array
    {
        return [
            'registration_id' => Registration::factory()->approved(),
            'total_score' => fake()->randomFloat(2, 30, 100),
            'rank' => fake()->numberBetween(1, 100),
            'status' => fake()->randomElement(['passed', 'failed', 'reserve']),
            'accepted_study_program_id' => null,
            'announcement_date' => null,
        ];
    }

    public function passed(): static
    {
        return $this->state(fn () => [
            'status' => 'passed',
            'accepted_study_program_id' => StudyProgram::factory(),
            'announcement_date' => now(),
        ]);
    }

    public function failed(): static
    {
        return $this->state(fn () => [
            'status' => 'failed',
            'announcement_date' => now(),
        ]);
    }

    public function reserve(): static
    {
        return $this->state(fn () => [
            'status' => 'reserve',
            'announcement_date' => now(),
        ]);
    }
}
