<?php

namespace Database\Seeders;

use App\Models\Exam;
use App\Models\ExamParticipant;
use App\Models\ExamSession;
use App\Models\ExamSubject;
use App\Models\Period;
use App\Models\QuestionBank;
use App\Models\Registration;
use App\Models\Subject;
use Illuminate\Database\Seeder;

class ExamSeeder extends Seeder
{
    public function run(): void
    {
        $period = Period::where('is_active', true)->first();
        $registrations = Registration::all();

        // 1. Subjects & Question Banks
        $subjectNames = ['TPA', 'Matematika', 'Bahasa Indonesia', 'Bahasa Inggris', 'Fisika', 'Kimia'];
        $subjects = collect();
        foreach ($subjectNames as $name) {
            $subject = Subject::factory()->create(['name' => $name]);
            $subjects->push($subject);

            QuestionBank::factory()->multipleChoice()->count(10)->create([
                'subject_id' => $subject->id,
            ]);
        }

        // 2. Exam & Exam Subjects
        $exam = Exam::factory()->create([
            'period_id' => $period->id,
            'name' => 'Ujian Seleksi Gelombang 1 2026',
            'duration_minutes' => 120,
        ]);

        foreach ($subjects as $subject) {
            ExamSubject::factory()->create([
                'exam_id' => $exam->id,
                'subject_id' => $subject->id,
                'question_count' => 10,
                'weight' => 15,
            ]);
        }

        // 3. Exam Session
        $session = ExamSession::factory()->create([
            'exam_id' => $exam->id,
            'name' => 'Sesi 1 - Pagi',
            'start_time' => now()->addWeek()->setHour(8),
            'end_time' => now()->addWeek()->setHour(10),
        ]);

        // 4. Exam Participants
        foreach ($registrations as $reg) {
            ExamParticipant::factory()->finished()->create([
                'exam_session_id' => $session->id,
                'registration_id' => $reg->id,
            ]);
        }
    }
}
