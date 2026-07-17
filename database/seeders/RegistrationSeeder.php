<?php

namespace Database\Seeders;

use App\Models\Period;
use App\Models\Registration;
use App\Models\RegistrationHistory;
use App\Models\SelectionPath;
use App\Models\StudyProgram;
use App\Models\User;
use Illuminate\Database\Seeder;

class RegistrationSeeder extends Seeder
{
    public function run(): void
    {
        $applicants = User::where('role', 'applicant')->get();
        $operator = User::where('role', 'operator')->first();
        $period = Period::where('is_active', true)->first();
        $studyPrograms = StudyProgram::where('level', 'D4')->get();
        $selectionPaths = SelectionPath::all();

        foreach ($applicants as $i => $applicant) {
            $reg = Registration::factory()->create([
                'user_id' => $applicant->id,
                'period_id' => $period->id,
                'selection_path_id' => $selectionPaths[$i % 4]->id,
                'study_program_1_id' => $studyPrograms[0]->id,
                'study_program_2_id' => $studyPrograms[1]->id,
                'status' => 'approved',
                'payment_status' => 'verified',
                'verification_status' => 'verified',
                'payment_number' => 'PAY-' . str_pad($i + 1, 7, '0', STR_PAD_LEFT),
                'payment_amount' => 350000,
                'payment_date' => now(),
                'participant_card_number' => 'KPU-' . str_pad($i + 1, 7, '0', STR_PAD_LEFT),
            ]);

            // Log history
            if ($operator) {
                RegistrationHistory::factory()->create([
                    'registration_id' => $reg->id,
                    'user_id' => $operator->id,
                    'status' => 'approved',
                    'notes' => 'Berkas dan pembayaran telah diverifikasi.',
                ]);
            }
        }
    }
}
