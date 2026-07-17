<?php

namespace Database\Factories;

use App\Models\Period;
use App\Models\Registration;
use App\Models\SelectionPath;
use App\Models\StudyProgram;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/** @extends Factory<Registration> */
class RegistrationFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id' => User::factory()->applicant(),
            'period_id' => Period::factory(),
            'selection_path_id' => SelectionPath::factory(),
            'registration_number' => 'PMB-' . fake()->unique()->numerify('#######'),
            'study_program_1_id' => StudyProgram::factory(),
            'study_program_2_id' => null,
            'personal_data' => [
                'full_name' => fake()->name(),
                'nik' => fake()->numerify('################'),
                'gender' => fake()->randomElement(['male', 'female']),
                'birth_place' => fake()->city(),
                'birth_date' => fake()->date(),
                'phone' => fake()->phoneNumber(),
                'country_code' => 'ID',
                'province_code' => '32',
                'city_code' => '3273',
                'district_code' => '327301',
                'sub_district_code' => '3273011001',
                'address' => fake()->address(),
                'postal_code' => fake()->postcode(),
            ],
            'education_data' => [
                'school_name' => 'SMA ' . fake()->city(),
                'school_npsn' => fake()->numerify('########'),
                'school_address' => fake()->address(),
                'graduation_year' => date('Y'),
                'major' => fake()->randomElement(['IPA', 'IPS']),
            ],
            'parent_data' => [
                'father_name' => fake()->name('male'),
                'father_occupation' => fake()->jobTitle(),
                'father_phone' => fake()->phoneNumber(),
                'mother_name' => fake()->name('female'),
                'mother_occupation' => fake()->jobTitle(),
                'mother_phone' => fake()->phoneNumber(),
            ],
            'files' => null,
            'utbk_score' => null,
            'payment_number' => null,
            'payment_amount' => null,
            'payment_date' => null,
            'payment_status' => 'unpaid',
            'verification_status' => 'pending',
            'participant_card_number' => null,
            'status' => 'draft',
        ];
    }

    public function submitted(): static
    {
        return $this->state(fn () => ['status' => 'submitted']);
    }

    public function approved(): static
    {
        return $this->state(fn () => [
            'status' => 'approved',
            'payment_status' => 'verified',
            'verification_status' => 'verified',
            'payment_number' => 'PAY-' . fake()->numerify('#######'),
            'payment_amount' => 350000,
            'payment_date' => now(),
            'participant_card_number' => 'KPU-' . fake()->numerify('#######'),
        ]);
    }

    public function withUtbk(): static
    {
        return $this->state(fn () => [
            'utbk_score' => fake()->randomFloat(2, 400, 800),
        ]);
    }
}
