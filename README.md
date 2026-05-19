# BOS MOCHI PHP + MySQL

Website landing page dinamis untuk BOS MOCHI yang siap di-upload ke shared hosting/FTP.

## Struktur

- `index.php` - Landing page utama.
- `admin/` - Admin panel untuk update produk, konten viral, testimoni, dan setting landing.
- `config/database.php` - Konfigurasi koneksi MySQL.
- `includes/` - Helper dan query data.
- `dist/output.css` - CSS siap pakai.
- `database.sql` - Struktur tabel dan data awal.
- `logo.jpeg` - Logo/placeholder produk.

## Cara Deploy FTP

1. Buat database MySQL di hosting.
2. Import `database.sql` lewat phpMyAdmin.
3. Edit `config/database.php` sesuai host, nama database, user, dan password MySQL dari hosting.
4. Upload semua file/folder di project ini ke `public_html`.
5. Buka `https://domain-kamu.com`.

## Admin

URL admin:

```text
/admin/login.php
```

Login default:

```text
Username: admin
Password: admin123
```

Ganti username/password di `admin/auth.php` sebelum lomba/deploy final.

## Setelah Update Produk

Kalau sebelumnya database sudah pernah di-import, hapus/drop tabel lama di phpMyAdmin lalu import ulang `database.sql` agar daftar produk dari `produk.md` masuk.

Best seller saat ini: `Strawberry Coklat`, dan akan tampil paling depan di landing page.
