<?php

namespace Database\Factories;

use App\Models\Period;
use Illuminate\Database\Eloquent\Factories\Factory;

/** @extends Factory<Period> */
class PeriodFactory extends Factory
{
    public function definition(): array
    {
        $startDate = fake()->dateTimeBetween('now', '+1 month');
        $endDate = fake()->dateTimeBetween($startDate, '+3 months');

        return [
            'name' => 'Gelombang ' . fake()->numberBetween(1, 3) . ' ' . date('Y'),
            'program_level' => fake()->randomElement(['D4', 'S2', null]),
            'start_date' => $startDate,
            'end_date' => $endDate,
            'is_active' => true,
        ];
    }

    public function inactive(): static
    {
        return $this->state(fn () => ['is_active' => false]);
    }
}
