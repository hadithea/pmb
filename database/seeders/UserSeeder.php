<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // 1 Admin
        User::factory()->admin()->create([
            'name' => 'Administrator',
            'email' => 'admin@poltek-sttt.ac.id',
        ]);

        // 2 Operator
        User::factory()->operator()->create([
            'name' => 'Operator PMB 1',
            'email' => 'operator1@poltek-sttt.ac.id',
        ]);

        User::factory()->operator()->create([
            'name' => 'Operator PMB 2',
            'email' => 'operator2@poltek-sttt.ac.id',
        ]);

        // 1 Management
        User::factory()->management()->create([
            'name' => 'Direktur',
            'email' => 'direktur@poltek-sttt.ac.id',
        ]);

        // 6 Pendaftar (Calon Mahasiswa)
        User::factory()->applicant()->count(6)->create();
    }
}
