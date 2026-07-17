<?php

namespace Database\Factories;

use App\Models\ReRegistration;
use App\Models\SelectionResult;
use Illuminate\Database\Eloquent\Factories\Factory;

/** @extends Factory<ReRegistration> */
class ReRegistrationFactory extends Factory
{
    public function definition(): array
    {
        return [
            'selection_result_id' => SelectionResult::factory()->passed(),
            'payment_number' => null,
            'ukt_amount' => fake()->randomElement([2500000, 3500000, 5000000, 7500000]),
            'payment_date' => null,
            'payment_status' => 'unpaid',
            'files' => null,
            'verification_status' => 'pending',
            'nim' => null,
            'generated_date' => null,
        ];
    }

    public function completed(): static
    {
        return $this->state(fn () => [
            'payment_number' => 'UKT-' . fake()->numerify('#######'),
            'payment_date' => now(),
            'payment_status' => 'verified',
            'files' => [
                'statement_letter' => 'uploads/statement.pdf',
                'stamp_duty' => 'uploads/stamp.pdf',
            ],
            'verification_status' => 'verified',
            'nim' => fake()->unique()->numerify('26######'),
            'generated_date' => now(),
        ]);
    }
}
