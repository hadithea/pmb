<?php

namespace Database\Factories;

use App\Models\Period;
use App\Models\Quota;
use App\Models\SelectionPath;
use App\Models\StudyProgram;
use Illuminate\Database\Eloquent\Factories\Factory;

/** @extends Factory<Quota> */
class QuotaFactory extends Factory
{
    public function definition(): array
    {
        return [
            'period_id' => Period::factory(),
            'selection_path_id' => SelectionPath::factory(),
            'study_program_id' => StudyProgram::factory(),
            'quota_amount' => fake()->numberBetween(20, 60),
        ];
    }
}
