<?php

namespace Database\Factories;

use App\Models\ExamParticipant;
use App\Models\ExamSession;
use App\Models\Registration;
use Illuminate\Database\Eloquent\Factories\Factory;

/** @extends Factory<ExamParticipant> */
class ExamParticipantFactory extends Factory
{
    public function definition(): array
    {
        return [
            'exam_session_id' => ExamSession::factory(),
            'registration_id' => Registration::factory()->approved(),
            'start_time' => null,
            'end_time' => null,
            'status' => 'not_started',
            'total_score' => null,
            'proctoring_logs' => null,
        ];
    }

    public function finished(): static
    {
        $start = now();

        return $this->state(fn () => [
            'start_time' => $start,
            'end_time' => $start->copy()->addMinutes(fake()->numberBetween(60, 120)),
            'status' => 'finished',
            'total_score' => fake()->randomFloat(2, 30, 100),
            'proctoring_logs' => [
                ['timestamp' => now()->toIso8601String(), 'event' => 'exam_started', 'detail' => 'Ujian dimulai'],
                ['timestamp' => now()->addMinutes(60)->toIso8601String(), 'event' => 'exam_finished', 'detail' => 'Ujian selesai'],
            ],
        ]);
    }
}
