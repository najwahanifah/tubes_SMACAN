# SmaCan — Jaga Sekolah, Jaga Bumi

Aplikasi monitoring tong sampah sekolah (Laravel). Siswa melapor kondisi tong, belajar lewat artikel edukasi,
mengumpulkan poin, dan bersaing di papan peringkat.

## Fitur
- Landing page + modal login/register (AJAX) dan halaman `/login`, `/register`
- Dashboard (statistik tong, poin & level, edukasi dan laporan terbaru)
- Lokasi tong sampah dan statusnya
- Edukasi: baca artikel di modal, klaim poin via AJAX (anti klaim ganda)
- Laporan Saya: CRUD lengkap + upload foto (+5 poin bonus kalau pakai foto)
- Poin, level, dan papan peringkat
- Profil: edit data dan ganti foto

## Kebutuhan
- PHP **8.4+** (disarankan sama dengan yang dipakai `vendor/`) dan Composer
- MySQL/MariaDB (XAMPP, Laragon, dsb) **atau** SQLite

## Cara menjalankan

```bash
# 1. Pasang dependensi (lewati kalau folder vendor/ sudah ada)
composer install

# 2. Salin .env bila belum ada, lalu buat APP_KEY
cp .env.example .env        # lewati jika .env sudah ada
php artisan key:generate    # lewati jika APP_KEY di .env sudah terisi

# 3. Buat database kosong bernama  smacan_db  (MySQL), lalu:
php artisan migrate:fresh --seed
#    (pakai migrate:fresh, BUKAN migrate, kalau database smacan_db pernah berisi tabel
#     dari percobaan sebelumnya -- supaya skema lama yang rusak ikut dihapus)

# 4. Jalankan
php artisan serve
```

Buka http://localhost:8000

**Pakai SQLite saja (tanpa MySQL)?** Di `.env` ubah `DB_CONNECTION=sqlite`, hapus/komentari baris `DB_HOST`,
`DB_PORT`, `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`, lalu jalankan `touch database/database.sqlite`
dan `php artisan migrate --seed`.

## Akun demo
Semua password: `password123`

| Nama | Email |
|---|---|
| Andi Saputra | andi.saputra@smacan.sch.id |
| Budi Rahayu | budi.rahayu@smacan.sch.id |
| Siti Fatimah | siti.fatimah@smacan.sch.id |
| Dewi Wulandari | dewi.wulandari@smacan.sch.id |
| Rizky Hidayat | rizky.hidayat@smacan.sch.id |

## Mengulang dari awal
```bash
php artisan migrate:fresh --seed
```

## Struktur singkat
- `routes/web.php` — semua route (web + endpoint AJAX `api/...`)
- `app/Http/Controllers` — controller halaman; `Api/` untuk endpoint AJAX
- `resources/views` — Blade (`layouts/app`, `partials/flash`, tiap halaman)
- `public/assets` — CSS/JS dari desain Smacan (tidak diubah)
- `public/uploads` — foto laporan dan avatar
- `lang/id/validation.php` — pesan validasi Bahasa Indonesia
