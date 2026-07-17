<?php

namespace Database\Seeders;

use App\Models\ReRegistration;
use App\Models\Registration;
use App\Models\SelectionResult;
use App\Models\StudyProgram;
use Illuminate\Database\Seeder;

class SelectionResultSeeder extends Seeder
{
    public function run(): void
    {
        $registrations = Registration::all();
        $studyPrograms = StudyProgram::where('level', 'D4')->get();

        foreach ($registrations as $i => $reg) {
            $status = $i < 4 ? 'passed' : ($i < 5 ? 'reserve' : 'failed');

            $result = SelectionResult::factory()->create([
                'registration_id' => $reg->id,
                'total_score' => fake()->randomFloat(2, 50, 100),
                'rank' => $i + 1,
                'status' => $status,
                'accepted_study_program_id' => $status === 'passed' ? $studyPrograms[0]->id : null,
                'announcement_date' => now(),
            ]);

            // Daftar ulang hanya untuk yang lulus
            if ($status === 'passed') {
                ReRegistration::factory()->completed()->create([
                    'selection_result_id' => $result->id,
                ]);
            }
        }
    }
}
