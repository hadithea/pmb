# Database Migration Context — PMB Politeknik STTT Bandung

> Dokumen ini adalah **konteks & spesifikasi** untuk membuat file migration Laravel.
> Semua penamaan tabel dan kolom menggunakan **bahasa Inggris** dan mengikuti **Laravel conventions**:
> - Tabel: *plural*, *snake_case* (`study_programs`, `exam_sessions`)
> - Foreign key: *singular_table_id* (`period_id`, `study_program_id`)
> - Pivot/junction: *alphabetical singular* (`exam_subject`)
> - Timestamps: `created_at`, `updated_at` via `$table->timestamps()`
> - Soft delete: `deleted_at` via `$table->softDeletes()`

---

## Keputusan Desain yang Sudah Disetujui

1. **Satu tabel `users`** untuk semua peran (admin, operator, management, applicant) — dibedakan dengan kolom `role`.
2. **Tabel `registration_histories`** terpisah untuk mencatat log historis perubahan status pendaftaran.
3. **Kolom `program_level`** pada tabel `periods` untuk membedakan periode pendaftaran antar jenjang (D4, S2, dll.) karena jadwal bisa berbeda.
4. **Data alamat di JSON `personal_data`** mencakup `country_code`, `province_code`, `city_code`, `district_code`, `sub_district_code` mengikuti kode referensi PDDIKTI — untuk memfasilitasi pendaftar dari luar negeri.
5. **Data biodata, pendidikan, dan orang tua** disimpan sebagai kolom JSON pada tabel `registrations` (tidak dipisah ke tabel tersendiri).

---

## Urutan Migration (Sesuai Dependensi Foreign Key)

### Migration 1 — `add_role_to_users_table`

**Tabel:** `users` (ALTER — tambah kolom)

| Kolom | Tipe | Constraint |
|-------|------|------------|
| `role` | enum(`'admin'`, `'operator'`, `'management'`, `'applicant'`) | default `'applicant'`, setelah kolom `email` |

**Konteks:** Tabel `users` bawaan Laravel sudah ada (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `timestamps`). Migration ini hanya **menambah** kolom `role`.

---

### Migration 2 — `create_study_programs_table`

**Tabel:** `study_programs`

| Kolom | Tipe | Constraint |
|-------|------|------------|
| `id` | bigIncrements | PK |
| `code` | string | unique |
| `name` | string | |
| `level` | string | — contoh: `'D3'`, `'D4'`, `'S2'` |
| `timestamps` | | |

**Konteks:** Master data program studi. Dipakai oleh `registrations` (pilihan prodi 1 & 2), `quotas` (kuota per prodi), dan `selection_results` (prodi tempat diterima).

---

### Migration 3 — `create_periods_table`

**Tabel:** `periods`

| Kolom | Tipe | Constraint |
|-------|------|------------|
| `id` | bigIncrements | PK |
| `name` | string | — contoh: `'Gelombang 1 2026'` |
| `program_level` | string | nullable — contoh: `'D4'`, `'S2'` |
| `start_date` | date | |
| `end_date` | date | |
| `is_active` | boolean | default `true` |
| `timestamps` | | |

**Konteks:** Periode/gelombang pendaftaran. Kolom `program_level` membedakan periode antar jenjang karena jadwal pendaftaran dan ujian bisa berbeda antara D4 dan S2.

**Aturan bisnis:** Pendaftaran otomatis ditutup setelah `end_date` terlewati.

---

### Migration 4 — `create_selection_paths_table`

**Tabel:** `selection_paths`

| Kolom | Tipe | Constraint |
|-------|------|------------|
| `id` | bigIncrements | PK |
| `name` | string | — isi: `'Prestasi'`, `'Bersama'`, `'Mandiri'`, `'UTBK'` |
| `description` | text | nullable |
| `is_active` | boolean | default `true` |
| `timestamps` | | |

**Konteks:** Jalur seleksi masuk. Setiap jalur memiliki persyaratan berbeda (Prestasi → sertifikat, UTBK → skor UTBK).

---

### Migration 5 — `create_quotas_table`

**Tabel:** `quotas`

| Kolom | Tipe | Constraint |
|-------|------|------------|
| `id` | bigIncrements | PK |
| `period_id` | foreignId | FK → `periods`, cascadeOnDelete |
| `selection_path_id` | foreignId | FK → `selection_paths`, cascadeOnDelete |
| `study_program_id` | foreignId | FK → `study_programs`, cascadeOnDelete |
| `quota_amount` | integer | |
| `timestamps` | | |

**Unique constraint:** (`period_id`, `selection_path_id`, `study_program_id`)

**Konteks:** Kuota penerimaan = berapa banyak mahasiswa yang bisa diterima per **periode × jalur × prodi**. Jika kuota penuh, jalur otomatis ditutup untuk prodi terkait.

---

### Migration 6 — `create_registrations_table`

**Tabel:** `registrations`

| Kolom | Tipe | Constraint |
|-------|------|------------|
| `id` | bigIncrements | PK |
| `user_id` | foreignId | FK → `users`, cascadeOnDelete |
| `period_id` | foreignId | FK → `periods`, cascadeOnDelete |
| `selection_path_id` | foreignId | FK → `selection_paths`, cascadeOnDelete |
| `registration_number` | string | unique |
| `study_program_1_id` | foreignId | FK → `study_programs` (constrained) |
| `study_program_2_id` | foreignId | FK → `study_programs` (constrained), nullable |
| `personal_data` | json | nullable |
| `education_data` | json | nullable |
| `parent_data` | json | nullable |
| `files` | json | nullable |
| `utbk_score` | float | nullable |
| `payment_number` | string | nullable |
| `payment_amount` | decimal(12,2) | nullable |
| `payment_date` | dateTime | nullable |
| `payment_status` | enum(`'unpaid'`, `'paid'`, `'verified'`) | default `'unpaid'` |
| `verification_status` | enum(`'pending'`, `'verified'`, `'rejected'`) | default `'pending'` |
| `participant_card_number` | string | nullable |
| `status` | enum(`'draft'`, `'submitted'`, `'in_review'`, `'approved'`, `'rejected'`) | default `'draft'` |
| `timestamps` | | |
| `softDeletes` | | |

**Konteks:** Tabel transaksi utama pendaftaran. Satu user hanya boleh punya satu pendaftaran per periode.

**Struktur JSON `personal_data`:**
```json
{
  "full_name": "string",
  "nik": "string",
  "gender": "male|female",
  "birth_place": "string",
  "birth_date": "YYYY-MM-DD",
  "phone": "string",
  "country_code": "ID",
  "province_code": "32",
  "city_code": "3273",
  "district_code": "327301",
  "sub_district_code": "3273011001",
  "address": "string",
  "postal_code": "string"
}
```

**Struktur JSON `education_data`:**
```json
{
  "school_name": "string",
  "school_npsn": "string",
  "school_address": "string",
  "graduation_year": 2026,
  "major": "string"
}
```

**Struktur JSON `parent_data`:**
```json
{
  "father_name": "string",
  "father_occupation": "string",
  "father_phone": "string",
  "mother_name": "string",
  "mother_occupation": "string",
  "mother_phone": "string",
  "guardian_name": "string",
  "guardian_phone": "string"
}
```

**Struktur JSON `files`:**
```json
{
  "photo": "path/to/file",
  "ktp": "path/to/file",
  "family_card": "path/to/file",
  "diploma": "path/to/file",
  "transcript": "path/to/file",
  "achievement_cert": "path/to/file",
  "utbk_score_proof": "path/to/file"
}
```

**Aturan bisnis:**
- `payment_status` harus `'verified'` + `verification_status` harus `'verified'` sebelum kartu peserta diterbitkan.
- Jalur Prestasi → `files.achievement_cert` wajib diisi.
- Jalur UTBK → `utbk_score` dan `files.utbk_score_proof` wajib diisi.

---

### Migration 7 — `create_registration_histories_table`

**Tabel:** `registration_histories`

| Kolom | Tipe | Constraint |
|-------|------|------------|
| `id` | bigIncrements | PK |
| `registration_id` | foreignId | FK → `registrations`, cascadeOnDelete |
| `user_id` | foreignId | FK → `users`, nullable, nullOnDelete |
| `status` | string | |
| `notes` | text | nullable |
| `timestamps` | | |

**Konteks:** Tabel log terpisah yang mencatat setiap perubahan status pada pendaftaran. `user_id` = siapa yang melakukan perubahan (operator/admin/system).

---

### Migration 8 — `create_subjects_table`

**Tabel:** `subjects`

| Kolom | Tipe | Constraint |
|-------|------|------------|
| `id` | bigIncrements | PK |
| `name` | string | — isi: `'TPA'`, `'Matematika'`, `'Bahasa Indonesia'`, `'Bahasa Inggris'`, `'Fisika'`, `'Kimia'` |
| `description` | text | nullable |
| `timestamps` | | |

**Konteks:** Master mata ujian. Digunakan oleh `question_banks` dan `exam_subjects`.

---

### Migration 9 — `create_question_banks_table`

**Tabel:** `question_banks`

| Kolom | Tipe | Constraint |
|-------|------|------------|
| `id` | bigIncrements | PK |
| `subject_id` | foreignId | FK → `subjects`, cascadeOnDelete |
| `type` | enum(`'multiple_choice'`, `'essay'`) | default `'multiple_choice'` |
| `difficulty_level` | string | default `'medium'` — nilai: `'easy'`, `'medium'`, `'hard'` |
| `question_text` | text | |
| `options` | json | nullable — untuk pilihan ganda (A, B, C, D, E) |
| `answer_key` | string | nullable |
| `timestamps` | | |

**Konteks:** Kumpulan soal yang dikelompokkan per mata ujian dan tingkat kesulitan. Soal diacak (randomize) saat disajikan ke peserta.

**Struktur JSON `options`:**
```json
["Jawaban A", "Jawaban B", "Jawaban C", "Jawaban D", "Jawaban E"]
```

---

### Migration 10 — `create_exams_table`

**Tabel:** `exams`

| Kolom | Tipe | Constraint |
|-------|------|------------|
| `id` | bigIncrements | PK |
| `period_id` | foreignId | FK → `periods`, cascadeOnDelete |
| `name` | string | — contoh: `'Ujian Seleksi Gelombang 1'` |
| `duration_minutes` | integer | |
| `timestamps` | | |

**Konteks:** Paket ujian yang dibuat untuk periode tertentu. Berisi komposisi soal dari beberapa mata ujian.

---

### Migration 11 — `create_exam_subjects_table`

**Tabel:** `exam_subjects`

| Kolom | Tipe | Constraint |
|-------|------|------------|
| `id` | bigIncrements | PK |
| `exam_id` | foreignId | FK → `exams`, cascadeOnDelete |
| `subject_id` | foreignId | FK → `subjects`, cascadeOnDelete |
| `question_count` | integer | — jumlah soal yang diambil dari bank soal |
| `weight` | integer | — bobot nilai mata ujian ini |
| `timestamps` | | |

**Konteks:** Relasi many-to-many antara paket ujian dan mata ujian. Menentukan berapa soal diambil dan bobot nilainya.

---

### Migration 12 — `create_exam_sessions_table`

**Tabel:** `exam_sessions`

| Kolom | Tipe | Constraint |
|-------|------|------------|
| `id` | bigIncrements | PK |
| `exam_id` | foreignId | FK → `exams`, cascadeOnDelete |
| `name` | string | — contoh: `'Sesi 1 - Pagi'` |
| `start_time` | dateTime | |
| `end_time` | dateTime | |
| `timestamps` | | |

**Konteks:** Jadwal pelaksanaan ujian. Ujian hanya bisa diakses dalam rentang `start_time` – `end_time`.

---

### Migration 13 — `create_exam_participants_table`

**Tabel:** `exam_participants`

| Kolom | Tipe | Constraint |
|-------|------|------------|
| `id` | bigIncrements | PK |
| `exam_session_id` | foreignId | FK → `exam_sessions`, cascadeOnDelete |
| `registration_id` | foreignId | FK → `registrations`, cascadeOnDelete |
| `start_time` | dateTime | nullable |
| `end_time` | dateTime | nullable |
| `status` | string | default `'not_started'` — nilai: `'not_started'`, `'in_progress'`, `'finished'` |
| `total_score` | float | nullable |
| `proctoring_logs` | json | nullable |
| `timestamps` | | |

**Konteks:** Mencatat peserta yang mengikuti sesi ujian tertentu. Termasuk log pengawasan (proctoring).

**Struktur JSON `proctoring_logs`:**
```json
[
  { "timestamp": "2026-07-20T09:01:00Z", "event": "tab_switch", "detail": "Switched to another tab" },
  { "timestamp": "2026-07-20T09:05:00Z", "event": "webcam_capture", "detail": "path/to/capture.jpg" }
]
```

**Aturan bisnis:** Hanya pendaftar dengan `payment_status = 'verified'` dan `verification_status = 'verified'` yang boleh mengikuti ujian.

---

### Migration 14 — `create_exam_answers_table`

**Tabel:** `exam_answers`

| Kolom | Tipe | Constraint |
|-------|------|------------|
| `id` | bigIncrements | PK |
| `exam_participant_id` | foreignId | FK → `exam_participants`, cascadeOnDelete |
| `question_bank_id` | foreignId | FK → `question_banks`, cascadeOnDelete |
| `answer` | text | nullable |
| `is_correct` | boolean | nullable |
| `score` | float | nullable |
| `timestamps` | | |

**Konteks:** Rekaman jawaban peserta per soal. `is_correct` dan `score` diisi otomatis untuk pilihan ganda, manual untuk esai.

---

### Migration 15 — `create_interviewers_table`

**Tabel:** `interviewers`

| Kolom | Tipe | Constraint |
|-------|------|------------|
| `id` | bigIncrements | PK |
| `user_id` | foreignId | FK → `users`, cascadeOnDelete |
| `name` | string | |
| `position` | string | nullable |
| `timestamps` | | |

**Konteks:** Data pewawancara. Terkait dengan user yang berperan sebagai operator atau peran khusus.

---

### Migration 16 — `create_interviews_table`

**Tabel:** `interviews`

| Kolom | Tipe | Constraint |
|-------|------|------------|
| `id` | bigIncrements | PK |
| `registration_id` | foreignId | FK → `registrations`, cascadeOnDelete |
| `interviewer_id` | foreignId | FK → `interviewers`, cascadeOnDelete |
| `schedule_time` | dateTime | |
| `meeting_link` | string | nullable |
| `status` | enum(`'scheduled'`, `'attended'`, `'absent'`) | default `'scheduled'` |
| `components_score` | json | nullable |
| `total_score` | float | nullable |
| `notes` | text | nullable |
| `duration_minutes` | integer | nullable |
| `timestamps` | | |

**Konteks:** Jadwal dan hasil wawancara per pendaftar.

**Struktur JSON `components_score`:**
```json
{
  "motivation": 85,
  "communication": 90,
  "knowledge": 80,
  "attitude": 88
}
```

**Aturan bisnis:** Wawancara hanya dijadwalkan untuk pendaftar yang sudah mengikuti ujian. Pendaftar `absent` tanpa keterangan dianggap mengundurkan diri.

---

### Migration 17 — `create_selection_results_table`

**Tabel:** `selection_results`

| Kolom | Tipe | Constraint |
|-------|------|------------|
| `id` | bigIncrements | PK |
| `registration_id` | foreignId | FK → `registrations`, cascadeOnDelete |
| `total_score` | float | nullable |
| `rank` | integer | nullable |
| `status` | enum(`'passed'`, `'failed'`, `'reserve'`) | |
| `accepted_study_program_id` | foreignId | FK → `study_programs` (constrained), nullable |
| `announcement_date` | dateTime | nullable |
| `timestamps` | | |

**Konteks:** Hasil akhir seleksi. `passed` = lulus, `failed` = tidak lulus, `reserve` = cadangan. Cadangan bisa dipanggil jika kuota tidak terisi.

---

### Migration 18 — `create_re_registrations_table`

**Tabel:** `re_registrations`

| Kolom | Tipe | Constraint |
|-------|------|------------|
| `id` | bigIncrements | PK |
| `selection_result_id` | foreignId | FK → `selection_results`, cascadeOnDelete |
| `payment_number` | string | nullable |
| `ukt_amount` | decimal(12,2) | |
| `payment_date` | dateTime | nullable |
| `payment_status` | enum(`'unpaid'`, `'paid'`, `'verified'`) | default `'unpaid'` |
| `files` | json | nullable |
| `verification_status` | enum(`'pending'`, `'verified'`, `'rejected'`) | default `'pending'` |
| `nim` | string | unique, nullable |
| `generated_date` | dateTime | nullable |
| `timestamps` | | |

**Konteks:** Proses daftar ulang mahasiswa yang lulus. NIM diterbitkan otomatis setelah `payment_status = 'verified'` dan `verification_status = 'verified'`.

**Aturan bisnis:** Daftar ulang punya batas waktu — jika terlewat, kelulusan gugur.

---
