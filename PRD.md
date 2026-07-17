# Product Requirements Document (PRD)
## Sistem Informasi Penerimaan Mahasiswa Baru (PMB) Politeknik STTT Bandung

| | |
|--|--|
| **Nama Sistem** | Sistem Informasi PMB Politeknik STTT Bandung |
| **Tanggal** | 17 Juli 2026 |
| **Penyusun** | Tim IT — Unit Teknologi Informasi |
| **Instansi** | Politeknik STTT Bandung |

---

## Ringkasan Sistem

Politeknik STTT Bandung membutuhkan sistem digital terpadu untuk mengelola layanan **Penerimaan Mahasiswa Baru (PMB)** secara online. Sistem ini mencakup pendaftaran calon mahasiswa melalui beberapa jalur seleksi (Prestasi, Bersama, Mandiri, UTBK), validasi pembayaran, upload berkas persyaratan, pelaksanaan ujian online, wawancara, hingga pengumuman kelulusan dan daftar ulang. Sistem ini memudahkan calon mahasiswa mendaftar secara mandiri, membantu operator dan admin mengelola seluruh proses penerimaan, serta memberikan manajemen dashboard pemantauan real-time. Target: memangkas waktu proses pendaftaran dari **proses manual/semi-digital** menjadi **proses digital terpadu end-to-end**.

---

## 1. Pengguna Sistem

| Peran | Siapa | Yang Mereka Lakukan |
|-------|-------|---------------------|
| **Administrator** | Staf TI / Admin Sistem | Kelola seluruh konfigurasi sistem, data master, hak akses pengguna, dan periode pendaftaran |
| **Operator** | Staf Administrasi PMB | Memvalidasi pembayaran, memverifikasi berkas pendaftar, menginput bank soal ujian, mengelola pelaksanaan ujian dan wawancara, memproses kelulusan dan daftar ulang |
| **Manajemen** | Direktur / Wakil Direktur / Kepala Bagian | Memantau dashboard pendaftaran, melihat statistik dan laporan per periode/gelombang/jalur — hanya baca |
| **Pendaftar** | Calon Mahasiswa Baru | Mendaftar secara online, upload berkas persyaratan, melakukan pembayaran, mengikuti ujian online, mengikuti wawancara, melihat pengumuman kelulusan, dan melakukan daftar ulang |

---

## 2. Layanan yang Dikelola Sistem

> *Setiap layanan di bawah ini merepresentasikan modul utama dalam sistem PMB.*
> *Aturan bisnis penting wajib dituliskan — ini yang akan menjadi validasi di sistem.*

---

### Layanan 1 — Pendaftaran Online & Upload Berkas

**Deskripsi:** Penerimaan pendaftaran calon mahasiswa baru secara online untuk setiap periode/gelombang penerimaan melalui empat jalur seleksi: **Jalur Prestasi**, **Jalur Bersama**, **Jalur Mandiri**, dan **Jalur UTBK**. Pendaftar mengisi formulir biodata, memilih program studi, mengunggah berkas persyaratan, dan melakukan pembayaran biaya pendaftaran.

**Alur:**
1. Admin membuka periode/gelombang pendaftaran dan mengaktifkan jalur seleksi yang tersedia
2. Calon mahasiswa melakukan registrasi akun dan login ke sistem PMB
3. Pendaftar memilih periode/gelombang dan jalur seleksi yang diinginkan
4. Pendaftar mengisi formulir biodata lengkap (data pribadi, data orang tua/wali, riwayat pendidikan, pilihan program studi)
5. Pendaftar mengunggah berkas persyaratan (ijazah/SKL, rapor, pas foto, KTP, kartu keluarga, sertifikat prestasi untuk jalur prestasi, skor UTBK untuk jalur UTBK)
6. Pendaftar melakukan pembayaran biaya pendaftaran (transfer bank/VA)
7. Operator memvalidasi bukti pembayaran dan kelengkapan berkas
8. Pendaftar menerima kartu peserta ujian setelah berkas diverifikasi dan pembayaran dikonfirmasi

**Data yang dicatat:** nomor pendaftaran · periode/gelombang · jalur seleksi · biodata lengkap · pilihan prodi 1 & 2 · daftar berkas terunggah · status verifikasi berkas · nomor pembayaran · jumlah pembayaran · tanggal bayar · status pembayaran · nomor kartu peserta

**Aturan bisnis:**
- Setiap periode/gelombang memiliki **tanggal buka dan tanggal tutup** — pendaftaran otomatis ditutup setelah melewati batas waktu
- Setiap jalur seleksi memiliki **kuota per program studi** — jika kuota penuh, jalur tersebut ditutup untuk prodi terkait
- Pendaftar **wajib mengunggah seluruh berkas wajib** sebelum bisa melanjutkan ke tahap berikutnya
- Berkas pendaftar **harus divalidasi oleh operator** sebelum kartu peserta ujian diterbitkan
- Pembayaran **harus dikonfirmasi** sebelum pendaftar dianggap sah terdaftar
- Satu pendaftar **hanya dapat mendaftar satu kali** per periode/gelombang
- Jalur Prestasi mensyaratkan upload **sertifikat prestasi** (akademik/non-akademik)
- Jalur UTBK mensyaratkan input **skor UTBK** yang valid

---

### Layanan 2 — Bank Soal & Ujian Online

**Deskripsi:** Pengelolaan bank soal ujian seleksi masuk dan pelaksanaan ujian online dengan sistem pengawasan (proctoring). Mata ujian meliputi: **TPA (Tes Potensi Akademik)**, **Matematika**, **Bahasa Indonesia**, **Bahasa Inggris**, **Fisika**, dan **Kimia**.

**Alur:**
1. Operator menginput soal ke bank soal berdasarkan mata ujian (TPA, Matematika, Bahasa Indonesia, Bahasa Inggris, Fisika, Kimia)
2. Admin/Operator menyusun paket soal ujian dari bank soal (menentukan jumlah soal per mata ujian, bobot, dan durasi)
3. Admin menjadwalkan sesi ujian online untuk periode/gelombang tertentu
4. Pendaftar yang telah terverifikasi login ke sistem ujian pada jadwal yang ditentukan
5. Sistem mengaktifkan pengawasan online (proctoring): webcam monitoring, screen lock, timer otomatis
6. Pendaftar mengerjakan soal ujian dalam waktu yang ditentukan
7. Sistem melakukan penilaian otomatis dan menyimpan hasil ujian
8. Operator mereview hasil ujian dan log pengawasan

**Data yang dicatat:** ID soal · mata ujian · tipe soal (pilihan ganda/esai) · tingkat kesulitan · kunci jawaban · paket soal · jadwal ujian · durasi ujian · jawaban peserta · skor per mata ujian · total skor · log aktivitas pengawasan (webcam capture, tab switching, waktu mulai/selesai)

**Aturan bisnis:**
- Bank soal dikelompokkan berdasarkan **mata ujian** dan **tingkat kesulitan**
- Soal dapat diacak (**randomize**) per peserta untuk mencegah kecurangan
- Ujian hanya dapat diakses pada **jadwal yang telah ditentukan** — di luar jadwal sistem terkunci
- Durasi ujian **dibatasi oleh timer** — otomatis submit saat waktu habis
- Sistem pengawasan online **wajib aktif** selama ujian berlangsung (webcam harus menyala)
- Peserta yang terdeteksi melakukan **pelanggaran** (berpindah tab, membuka aplikasi lain) akan dicatat dalam log
- Setiap mata ujian memiliki **bobot nilai** yang dapat dikonfigurasi per jalur seleksi
- Hanya pendaftar dengan **status pembayaran lunas dan berkas terverifikasi** yang dapat mengikuti ujian

---

### Layanan 3 — Wawancara

**Deskripsi:** Pengelolaan pelaksanaan wawancara terhadap pendaftar yang telah mengikuti ujian seleksi sebagai bagian dari proses seleksi masuk. Wawancara dilakukan oleh tim pewawancara yang ditunjuk.

**Alur:**
1. Admin/Operator menjadwalkan sesi wawancara berdasarkan hasil ujian (menentukan tanggal, waktu, ruang/link meeting, dan pewawancara)
2. Pendaftar menerima notifikasi jadwal wawancara
3. Pendaftar hadir pada sesi wawancara sesuai jadwal (online/offline)
4. Pewawancara melakukan penilaian berdasarkan rubrik/kriteria yang telah ditentukan
5. Pewawancara menginput nilai dan catatan wawancara ke sistem
6. Hasil wawancara dikompilasi sebagai bagian dari nilai seleksi keseluruhan

**Data yang dicatat:** jadwal wawancara · ruang/link meeting · nama pewawancara · komponen penilaian · skor wawancara · catatan pewawancara · status kehadiran pendaftar · durasi wawancara

**Aturan bisnis:**
- Wawancara hanya dapat dijadwalkan untuk pendaftar yang **telah mengikuti ujian**
- Setiap sesi wawancara memiliki **batas jumlah peserta** per pewawancara per hari
- Rubrik penilaian wawancara **harus dikonfigurasi** sebelum jadwal wawancara dibuka
- Pendaftar yang **tidak hadir** tanpa keterangan dianggap mengundurkan diri
- Nilai wawancara memiliki **bobot** yang dikonfigurasi terhadap total nilai seleksi

---

### Layanan 4 — Kelulusan & Daftar Ulang

**Deskripsi:** Pengelolaan pengumuman kelulusan calon mahasiswa baru dan proses daftar ulang bagi yang dinyatakan lulus seleksi. Mencakup penentuan kelulusan berdasarkan akumulasi nilai, pengumuman resmi, serta proses registrasi ulang mahasiswa baru.

**Alur:**
1. Operator/Admin mengkompilasi seluruh nilai seleksi (ujian, wawancara, prestasi/UTBK sesuai jalur)
2. Sistem menghitung ranking berdasarkan bobot nilai yang telah dikonfigurasi
3. Admin menetapkan batas kelulusan (passing grade) dan jumlah yang diterima sesuai kuota
4. Admin menerbitkan pengumuman kelulusan melalui sistem
5. Pendaftar melihat status kelulusan melalui akun masing-masing
6. Pendaftar yang dinyatakan lulus melakukan daftar ulang: pembayaran UKT/biaya kuliah dan upload berkas tambahan (surat pernyataan, materai, dll)
7. Operator memverifikasi pembayaran daftar ulang dan kelengkapan berkas
8. Pendaftar yang telah menyelesaikan daftar ulang ditetapkan sebagai **Mahasiswa Baru**

**Data yang dicatat:** ranking seleksi · total nilai akhir · status kelulusan (lulus/tidak lulus/cadangan) · tanggal pengumuman · status daftar ulang · nomor pembayaran UKT · jumlah UKT · tanggal bayar daftar ulang · berkas daftar ulang · NIM (Nomor Induk Mahasiswa) · tanggal penetapan mahasiswa baru

**Aturan bisnis:**
- Kelulusan dihitung berdasarkan **akumulasi nilai seleksi** sesuai bobot per jalur
- Kuota penerimaan per program studi **tidak boleh dilampaui**
- Pendaftar cadangan dapat dipanggil jika ada **kuota yang tidak terisi** dalam batas waktu tertentu
- Daftar ulang memiliki **batas waktu** — jika terlewat, kelulusan dianggap gugur
- Pembayaran UKT **harus lunas** sebelum mahasiswa baru ditetapkan
- Seluruh **berkas daftar ulang wajib diverifikasi** oleh operator
- NIM **diterbitkan secara otomatis** setelah proses daftar ulang selesai

---

## 3. Laporan & Dashboard yang Dibutuhkan

### Dashboard Utama (tampil saat login)

| Informasi | Keterangan |
|-----------|------------|
| Total pendaftar per periode/gelombang | Jumlah pendaftar aktif pada periode/gelombang berjalan, dipecah per jalur seleksi |
| Status pembayaran | Ringkasan jumlah pembayaran lunas vs belum bayar per periode |
| Status verifikasi berkas | Jumlah berkas terverifikasi vs menunggu verifikasi vs ditolak |
| Peserta ujian | Jumlah peserta yang telah mengikuti ujian vs belum per sesi |
| Jadwal wawancara | Jumlah wawancara yang telah dilaksanakan vs terjadwal |
| Statistik kelulusan | Jumlah yang dinyatakan lulus, tidak lulus, cadangan per prodi per jalur |
| Progress daftar ulang | Jumlah mahasiswa yang telah daftar ulang vs belum per prodi |
| Kuota terisi per prodi | Persentase kuota yang telah terisi per program studi per jalur |

### Laporan Berkala

| Laporan | Frekuensi | Isi | Format |
|---------|-----------|-----|--------|
| Rekap Pendaftaran | Per Gelombang | Total pendaftar per jalur, per prodi, per status pembayaran dan verifikasi | Excel & PDF |
| Hasil Ujian Seleksi | Per Sesi Ujian | Rata-rata skor per mata ujian, distribusi nilai, ranking peserta | Excel & PDF |
| Rekap Wawancara | Per Gelombang | Hasil penilaian wawancara per peserta, statistik kehadiran | Excel & PDF |
| Pengumuman Kelulusan | Per Gelombang | Daftar peserta lulus, tidak lulus, cadangan per prodi per jalur | PDF |
| Rekap Daftar Ulang | Per Gelombang | Jumlah mahasiswa baru yang telah daftar ulang, status pembayaran UKT | Excel & PDF |
| Statistik PMB Tahunan | Tahunan | Tren pendaftaran, rasio seleksi, demografi pendaftar, perbandingan antar gelombang/jalur | Excel & PDF |

---

> **Catatan untuk AI Coding Assistant:**
> - Setiap **layanan** di Bagian 2 → 1 modul Filament Resource + set tabel database
> - Setiap **alur** → urutan status pada kolom `status` di tabel transaksi
> - Setiap **data yang dicatat** → kolom-kolom pada tabel yang bersangkutan
> - Setiap **aturan bisnis** → validasi dan business logic di Model/Controller
> - Bagian 3 → widget dashboard Filament + fitur ekspor PDF/Excel
> - **Periode/Gelombang** → tabel master `periods` yang memiliki relasi ke semua transaksi
> - **Jalur Seleksi** → tabel master `selection_paths` (Prestasi, Bersama, Mandiri, UTBK) dengan konfigurasi kuota dan bobot per jalur
> - **Bank Soal** → tabel `question_banks` dengan relasi ke `subjects` (TPA, Matematika, Bahasa Indonesia, Bahasa Inggris, Fisika, Kimia)
> - **Ujian Online** → tabel `exams`, `exam_sessions`, `exam_answers` dengan fitur timer dan proctoring
> - **Wawancara** → tabel `interviews` dengan relasi ke `interviewers` dan rubrik penilaian
> - **Kelulusan** → tabel `selection_results` dengan status lulus/tidak lulus/cadangan
> - **Daftar Ulang** → tabel `re_registrations` dengan status pembayaran dan verifikasi berkas

---
