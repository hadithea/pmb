<?php

namespace Database\Factories;

use App\Models\StudyProgram;
use Illuminate\Database\Eloquent\Factories\Factory;

/** @extends Factory<StudyProgram> */
class StudyProgramFactory extends Factory
{
    public function definition(): array
    {
        return [
            'code' => fake()->unique()->regexify('[A-Z]{2}[0-9]{3}'),
            'name' => fake()->randomElement([
                'Kimia Tekstil', 'Teknik Tekstil', 'Teknik Kimia',
                'Desain Produk', 'Manajemen Pemasaran', 'Teknik Industri',
            ]),
            'level' => fake()->randomElement(['D3', 'D4', 'S2']),
        ];
    }

    public function d3(): static
    {
        return $this->state(fn () => ['level' => 'D3']);
    }

    public function d4(): static
    {
        return $this->state(fn () => ['level' => 'D4']);
    }

    public function s2(): static
    {
        return $this->state(fn () => ['level' => 'S2']);
    }
}
