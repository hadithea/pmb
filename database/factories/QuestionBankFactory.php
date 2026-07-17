<?php

namespace Database\Factories;

use App\Models\QuestionBank;
use App\Models\Subject;
use Illuminate\Database\Eloquent\Factories\Factory;

/** @extends Factory<QuestionBank> */
class QuestionBankFactory extends Factory
{
    public function definition(): array
    {
        $type = fake()->randomElement(['multiple_choice', 'essay']);

        return [
            'subject_id' => Subject::factory(),
            'type' => $type,
            'difficulty_level' => fake()->randomElement(['easy', 'medium', 'hard']),
            'question_text' => fake()->paragraph(),
            'options' => $type === 'multiple_choice'
                ? [fake()->sentence(), fake()->sentence(), fake()->sentence(), fake()->sentence(), fake()->sentence()]
                : null,
            'answer_key' => $type === 'multiple_choice'
                ? fake()->randomElement(['0', '1', '2', '3', '4'])
                : null,
        ];
    }

    public function multipleChoice(): static
    {
        return $this->state(fn () => [
            'type' => 'multiple_choice',
            'options' => [fake()->sentence(), fake()->sentence(), fake()->sentence(), fake()->sentence(), fake()->sentence()],
            'answer_key' => fake()->randomElement(['0', '1', '2', '3', '4']),
        ]);
    }

    public function essay(): static
    {
        return $this->state(fn () => [
            'type' => 'essay',
            'options' => null,
            'answer_key' => null,
        ]);
    }
}
