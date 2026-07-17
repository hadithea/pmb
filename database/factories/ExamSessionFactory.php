<?php

namespace Database\Factories;

use App\Models\Exam;
use App\Models\ExamSession;
use Illuminate\Database\Eloquent\Factories\Factory;

/** @extends Factory<ExamSession> */
class ExamSessionFactory extends Factory
{
    public function definition(): array
    {
        $startTime = fake()->dateTimeBetween('+1 week', '+1 month');
        $endTime = (clone $startTime)->modify('+3 hours');

        return [
            'exam_id' => Exam::factory(),
            'name' => 'Sesi ' . fake()->numberBetween(1, 3) . ' - ' . fake()->randomElement(['Pagi', 'Siang', 'Sore']),
            'start_time' => $startTime,
            'end_time' => $endTime,
        ];
    }
}
