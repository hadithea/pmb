<?php

namespace Database\Factories;

use App\Models\ExamAnswer;
use App\Models\ExamParticipant;
use App\Models\QuestionBank;
use Illuminate\Database\Eloquent\Factories\Factory;

/** @extends Factory<ExamAnswer> */
class ExamAnswerFactory extends Factory
{
    public function definition(): array
    {
        return [
            'exam_participant_id' => ExamParticipant::factory(),
            'question_bank_id' => QuestionBank::factory(),
            'answer' => fake()->randomElement(['0', '1', '2', '3', '4']),
            'is_correct' => fake()->boolean(60),
            'score' => fake()->randomFloat(2, 0, 10),
        ];
    }
}
