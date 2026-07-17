<?php

namespace Database\Seeders;

use App\Models\Period;
use App\Models\Quota;
use App\Models\SelectionPath;
use App\Models\StudyProgram;
use Illuminate\Database\Seeder;

class MasterDataSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Program Studi
        $prodiData = [
            ['code' => 'KT01', 'name' => 'Kimia Tekstil', 'level' => 'D4'],
            ['code' => 'TT01', 'name' => 'Teknik Tekstil', 'level' => 'D4'],
            ['code' => 'DP01', 'name' => 'Desain Produk Tekstil', 'level' => 'D4'],
            ['code' => 'TI01', 'name' => 'Teknik Industri Garmen', 'level' => 'D4'],
            ['code' => 'MT01', 'name' => 'Magister Teknik Tekstil', 'level' => 'S2'],
        ];
        foreach ($prodiData as $prodi) {
            StudyProgram::factory()->create($prodi);
        }

        // 2. Periode
        $period = Period::factory()->create([
            'name' => 'Gelombang 1 2026',
            'program_level' => 'D4',
            'start_date' => '2026-06-01',
            'end_date' => '2026-08-31',
            'is_active' => true,
        ]);

        // 3. Jalur Seleksi
        $pathNames = ['Prestasi', 'Bersama', 'Mandiri', 'UTBK'];
        $selectionPaths = collect();
        foreach ($pathNames as $pathName) {
            $selectionPaths->push(SelectionPath::factory()->create([
                'name' => $pathName,
                'description' => 'Jalur seleksi ' . $pathName,
            ]));
        }

        // 4. Kuota
        $studyPrograms = StudyProgram::where('level', 'D4')->get();
        foreach ($selectionPaths as $path) {
            foreach ($studyPrograms as $prodi) {
                Quota::factory()->create([
                    'period_id' => $period->id,
                    'selection_path_id' => $path->id,
                    'study_program_id' => $prodi->id,
                    'quota_amount' => rand(20, 40),
                ]);
            }
        }
    }
}
