<?php

namespace Database\Factories;

use App\Models\Interviewer;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/** @extends Factory<Interviewer> */
class InterviewerFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id' => User::factory()->operator(),
            'name' => fake()->name(),
            'position' => fake()->randomElement(['Dosen', 'Kepala Prodi', 'Wakil Direktur']),
        ];
    }
}
