<?php

namespace Database\Factories;

use App\Models\Exam;
use App\Models\ExamSubject;
use App\Models\Subject;
use Illuminate\Database\Eloquent\Factories\Factory;

/** @extends Factory<ExamSubject> */
class ExamSubjectFactory extends Factory
{
    public function definition(): array
    {
        return [
            'exam_id' => Exam::factory(),
            'subject_id' => Subject::factory(),
            'question_count' => fake()->numberBetween(10, 30),
            'weight' => fake()->numberBetween(10, 25),
        ];
    }
}
