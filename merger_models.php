<?php
$file = 'c:\laragon\www\pmb\lang\id.json';
$current = json_decode(file_get_contents($file), true) ?: [];

$new = [
    "Exam" => "Ujian",
    "Exams" => "Ujian",
    "Exam Answer" => "Jawaban Ujian",
    "Exam Answers" => "Jawaban Ujian",
    "Exam Participant" => "Peserta Ujian",
    "Exam Participants" => "Peserta Ujian",
    "Exam Session" => "Sesi Ujian",
    "Exam Sessions" => "Sesi Ujian",
    "Exam Subject" => "Mata Ujian",
    "Exam Subjects" => "Mata Ujian",
    "Interview" => "Wawancara",
    "Interviews" => "Wawancara",
    "Interviewer" => "Pewawancara",
    "Interviewers" => "Pewawancara",
    "Period" => "Periode",
    "Periods" => "Periode",
    "Question Bank" => "Bank Soal",
    "Question Banks" => "Bank Soal",
    "Quota" => "Kuota",
    "Quotas" => "Kuota",
    "Re Registration" => "Daftar Ulang",
    "Re Registrations": "Daftar Ulang",
    "Registration" => "Pendaftaran",
    "Registrations" => "Pendaftaran",
    "Registration History" => "Riwayat Pendaftaran",
    "Registration Histories" => "Riwayat Pendaftaran",
    "Selection Path" => "Jalur Seleksi",
    "Selection Paths" => "Jalur Seleksi",
    "Selection Result" => "Hasil Seleksi",
    "Selection Results" => "Hasil Seleksi",
    "Study Program" => "Program Studi",
    "Study Programs" => "Program Studi",
    "Subject" => "Mata Pelajaran",
    "Subjects": "Mata Pelajaran",
    "User" => "Pengguna",
    "Users" => "Pengguna",
    
    "Dashboard" => "Dasbor",
    "Create" => "Buat",
    "Save" => "Simpan",
    "Delete" => "Hapus",
    "Edit" => "Ubah",
    "View" => "Lihat",
    "Cancel" => "Batal",
    "Create and create another" => "Buat dan buat baru",
    "Save changes" => "Simpan perubahan",
    "Filters" => "Filter",
    "Search" => "Cari",
    "Clear" => "Bersihkan"
];

$merged = array_merge($current, $new);
ksort($merged);

file_put_contents($file, json_encode($merged, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE));
echo "Done";
