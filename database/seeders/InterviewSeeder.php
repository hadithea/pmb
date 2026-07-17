<?php

namespace Database\Seeders;

use App\Models\Interview;
use App\Models\Interviewer;
use App\Models\Registration;
use App\Models\User;
use Illuminate\Database\Seeder;

class InterviewSeeder extends Seeder
{
    public function run(): void
    {
        $operators = User::where('role', 'operator')->get();
        $registrations = Registration::all();

        if ($operators->count() < 2) {
            return;
        }

        $interviewer1 = Interviewer::factory()->create([
            'user_id' => $operators[0]->id,
            'name' => $operators[0]->name,
            'position' => 'Dosen Penguji',
        ]);

        $interviewer2 = Interviewer::factory()->create([
            'user_id' => $operators[1]->id,
            'name' => $operators[1]->name,
            'position' => 'Kepala Prodi',
        ]);

        foreach ($registrations as $i => $reg) {
            Interview::factory()->attended()->create([
                'registration_id' => $reg->id,
                'interviewer_id' => $i % 2 === 0 ? $interviewer1->id : $interviewer2->id,
                'schedule_time' => now()->addWeeks(2)->setHour(9)->addMinutes($i * 30),
            ]);
        }
    }
}
