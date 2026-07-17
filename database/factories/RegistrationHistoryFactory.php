<?php

namespace Database\Factories;

use App\Models\Registration;
use App\Models\RegistrationHistory;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/** @extends Factory<RegistrationHistory> */
class RegistrationHistoryFactory extends Factory
{
    public function definition(): array
    {
        return [
            'registration_id' => Registration::factory(),
            'user_id' => User::factory()->operator(),
            'status' => fake()->randomElement(['draft', 'submitted', 'in_review', 'approved', 'rejected']),
            'notes' => fake()->optional()->sentence(),
        ];
    }
}
