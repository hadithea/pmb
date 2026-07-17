# Product Requirements Document (PRD)
## Sistem Informasi Layanan PMB

| | |
|--|--|
| **Nama Sistem** | Sistem Informasi Layanan PMB |
| **Tanggal** | 16 Juli 2026 |
| **Penyusun** | Hadi — Prakom |
| **Instansi** | Politeknik STTT Bandung |

---

## Ringkasan Sistem

> *Jelaskan dalam 2–4 kalimat: apa sistemnya, untuk siapa, dan manfaat utamanya.*

Politeknik STTT Bandung membutuhkan sistem digital terpadu untuk mengelola layanan Penerimaan Mahasiswa Baru. Sistem ini memudahkan klien mendaftar layanan secara online, membantu staf mengelola transaksi, dan memberikan pimpinan laporan real-time. Target: memangkas waktu proses dari 30 menit menjadi 10 menit.

---

## 1. Pengguna Sistem

| Peran | Siapa | Yang Mereka Lakukan |
|-------|-------|---------------------|
| **Administrator** | Staf TI | Kelola seluruh data dan hak akses pengguna |
| **Operator Layanan** | Staf loket PMB/administrasi] | Input pendaftaran, konfirmasi, cetak invoice |
| **Pimpinan** | Direktur | Lihat dashboard dan laporan — hanya baca |
| **Klien Individu** | Siswa/Calon Mahasiswa | Daftar layanan, upload dokumen, cek status |

---

## 2. Layanan yang Dikelola Sistem

> *Untuk setiap layanan: jelaskan alurnya dan data apa yang perlu dicatat.*
> *Aturan bisnis penting wajib dituliskan — ini yang akan menjadi validasi di sistem.*
Layanan meliputi:
1. Operator menginput periode PMB dengan pilihan jalur prestasi, jalur bersama , jalur mandiri, jalur utbk
2. Calon mahasiswa melakukan Pendaftaran dengan isian pokok pendaftaran nama, asal sekolah, no. hp, email lalu sistem mengirim informasi pendaftaran ke email pendaftar
3. Calon mahasiswa mengupload bukti bayar jika periode PMB berbayar
4. Operator memvalidasi pembayaran
5. Pendaftar login dan melengkapi data dan berkas pendaftaran
6. Operator menginput bank soal dengan kategori soal TPA, Matematika, Fisika, Kima, Bahasa indonesia dan bahasa inggris
6. Operator menjadwalkan ujian online yang terdiri dari tes TPA dan TKD
7. Pendaftar mengikuti ujian online
8. Operator memantau progress peserta yang sedang mengikuti ujian
9. Operator menjadwalkan wawancara pendaftar menjadi beberapa kelompok dan mengalokasikan pewanwancara sesuai prodi yang dipilih  
10. Operator menginput status kelulusan Pendaftar
11. Pendaftar mengecek status kelulusan
12. Pendaftar melengkapi berkas Daftar ulang


---

## 3. Laporan & Dashboard yang Dibutuhkan

### Dashboard Utama (tampil saat login)

| Informasi | Keterangan |
|-----------|------------|
| Total Pendaftar Per Tahun PMB aktif | Total Pendaftar  Per Tahun PMB aktif |
| Jumlah Animo pada gelombang/periode aktif | Jumlah seluruh pendaftar pada gelombang/periode PMB aktif  |
| Jumlah Pendaftar Lengkap pada gelombang/periode aktif | Jumlah pendaftar pada gelombang/periode PMB aktif yang data dan berkasnya lengkap  |
| Rekap Pendaftar Per Gelombang di Tahun PMB | Rekap Pendaftar Per Gelombang di Tahun PMB sesuai prodi dan di pisah L dan P|
| Jumlah Pendaftar Lulus pada Tahun PMB aktif | Jumlah Pendaftar Lulus pada Tahun PMB aktif  |
| Jumlah Pendaftar Daftar Ulang pada Tahun PMB aktif | Jumlah Pendaftar Daftar Ulang pada Tahun PMB aktif  |

### Laporan Berkala

| Laporan | Frekuensi | Isi | Format |
|---------|-----------|-----|--------|
| Rekap Pendaftar | Bulanan | Total Pendaftar per Periode/Gelombang | Excel & PDF |
| Rekap Pendaftar Ulang | Bulanan | Total Pendaftar Ulang per Periode/Gelombang | Excel & PDF |
| Rekap Pendaftar Ikut Ujian | Bulanan | Total Pendaftar Ikut Ujian per Periode/Gelombang | Excel & PDF |
| Rekap Pendaftar Ikut Wawancara | Bulanan | Total Pendaftar Ikut Wawancara per Periode/Gelombang | Excel & PDF |

---

> **Catatan untuk AI Coding Assistant:**
> - Setiap **layanan** di Bagian 2 → 1 modul Filament Resource + set tabel database
> - Setiap **alur** → urutan status pada kolom `status` di tabel transaksi
> - Setiap **data yang dicatat** → kolom-kolom pada tabel yang bersangkutan
> - Setiap **aturan bisnis** → validasi dan business logic di Model/Controller
> - Bagian 3 → widget dashboard Filament + fitur ekspor PDF/Excel

---
