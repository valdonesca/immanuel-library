# Immanuel Library — Revisi

## Cara menjalankan
1. Pastikan PHP 8+ tersedia.
2. Jalankan dari folder proyek:
   `php -S localhost:8000`
3. Buka `http://localhost:8000/`.
4. Data disimpan otomatis di `data/library.json`, jadi tidak membutuhkan MySQL/SQLite.

## Akun demo
- Admin: `kelvin@immanuel.sch.id`
- Password: `password123`

## Fitur yang diperbaiki
- Login, register, logout, session, password hashing.
- CRUD buku, penulis, kategori, dan pengguna.
- Edit memakai ID dari URL, bukan data hardcoded.
- Relasi buku dengan kategori dan banyak penulis.
- Search/filter buku, penulis, kategori, dan pengguna.
- Profil pengguna tersimpan.
- Validasi input dasar dan escaping output.
- Tombol hapus benar-benar menjalankan action.
- Data seed dibuat otomatis saat aplikasi pertama kali dijalankan.
