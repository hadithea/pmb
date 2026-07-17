<?php

namespace Database\Factories;

use App\Models\Interview;
use App\Models\Interviewer;
use App\Models\Registration;
use Illuminate\Database\Eloquent\Factories\Factory;

/** @extends Factory<Interview> */
class InterviewFactory extends Factory
{
    public function definition(): array
    {
        return [
            'registration_id' => Registration::factory()->approved(),
            'interviewer_id' => Interviewer::factory(),
            'schedule_time' => fake()->dateTimeBetween('+1 week', '+1 month'),
            'meeting_link' => fake()->optional()->url(),
            'status' => 'scheduled',
            'components_score' => null,
            'total_score' => null,
            'notes' => null,
            'duration_minutes' => null,
        ];
    }

    public function attended(): static
    {
        return $this->state(fn () => [
            'status' => 'attended',
            'components_score' => [
                'motivation' => fake()->numberBetween(60, 100),
                'communication' => fake()->numberBetween(60, 100),
                'knowledge' => fake()->numberBetween(60, 100),
                'attitude' => fake()->numberBetween(60, 100),
            ],
            'total_score' => fake()->randomFloat(2, 60, 100),
            'notes' => fake()->sentence(),
            'duration_minutes' => fake()->numberBetween(15, 30),
        ]);
    }

    public function absent(): static
    {
        return $this->state(fn () => ['status' => 'absent']);
    }
}
