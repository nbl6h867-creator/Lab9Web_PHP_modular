# Lab9Web - Praktikum 9: PHP Modular

## Tujuan Project
Menerapkan konsep modularisasi program PHP dengan memisahkan konfigurasi database, template antarmuka, fungsi bantuan (*helper*), autentikasi sesi, modul fitur CRUD `data_barang` (hasil refactoring Praktikum 8), serta mengelola navigasi melalui *whitelist router* yang aman.

## Kebutuhan Perangkat
- Windows 10/11
- XAMPP (Apache dengan `mod_rewrite` aktif & MySQL / MariaDB)
- PHP 
- Browser, Visual Studio Code, dan Git

## Cara Menjalankan Aplikasi
1. Jalankan layanan **Apache** dan **MySQL** melalui XAMPP Control Panel.
2. Pastikan folder `Lab9Web` berada di dalam `C:\xampp\htdocs\`.
3. Pastikan database `latihan1` beserta tabel `data_barang` dari Praktikum 8 sudah tersedia di MySQL, dan sesuaikan kredensial pada `config/database.php`.
4. Buka browser dan akses `http://localhost/Lab9Web/dashboard` atau `http://localhost/Lab9Web/index.php`.
5. Untuk mengakses menu **Data Barang (CRUD)**, login menggunakan akun `admin` / `admin123`.

## Struktur Direktori
- `index.php` : *Front controller* / *whitelist router* utama aplikasi.
- `.htaccess` : Aturan *URL rewrite* Apache untuk URL ringkas.
- `config/database.php` : Konfigurasi koneksi database MySQLi terpusat (`latihan1`).
- `views/` : Template bersama (`header.php`, `footer.php`) dan halaman statis (`dashboard.php`, `profil.php`, `kontak.php`, `404.php`).
- `helpers/functions.php` : Library fungsi utilitas (`e`, `formatRupiah`, `hitungDiskon`, `validasiEmail`, `ringkasTeks`).
- `modules/auth/` : Modul autentikasi (`login.php`, `logout.php`).
- `modules/barang/` : Modul CRUD `data_barang` (`list.php`, `add.php`, `edit.php`, `delete.php`).
- `assets/` : File statis CSS (`assets/css/style.css`), gambar barang (`assets/gambar/`), dan JS (`assets/js/`).

## Daftar Rute
- `index.php?page=dashboard` (`/dashboard`) : Halaman utama & pengujian helper function.
- `index.php?page=profil` (`/profil`) : Halaman profil mahasiswa.
- `index.php?page=kontak` (`/kontak`) : Halaman kontak & pengujian `validasiEmail()`.
- `index.php?page=login` (`/login`) : Halaman login pengguna.
- `index.php?page=logout` (`/logout`) : Proses keluar sesi login.
- `index.php?page=barang/list` (`/barang/list`) : Menampilkan daftar data barang.
- `index.php?page=barang/add` (`/barang/add`) : Form tambah data barang.
- `index.php?page=barang/edit&id={id}` : Form ubah data barang.
- `index.php?page=barang/delete` : Proses hapus data barang (metode POST).

## Kendala dan Solusi
- **Kendala**: Aset CSS tidak terbaca ketika mengakses URL bertingkat menggunakan `.htaccess` (seperti `/barang/list`) karena path relatif berubah.
- **Solusi**: Menambahkan tag `<base href="/Lab9Web/">` di dalam `<head>` pada `views/header.php` agar seluruh path aset selalu mengacu ke root proyek.

## Konfigurasi URL Rewrite (.htaccess)
Agar URL ringkas (seperti `/dashboard` atau `/barang/list`) berjalan pada Apache XAMPP Windows:

1. Pastikan baris `LoadModule rewrite_module modules/mod_rewrite.so` pada `C:\xampp\apache\conf\httpd.conf` aktif (tidak diawali tanda `#`).
2. Pastikan direktif `AllowOverride All` aktif di dalam blok `<Directory "C:/xampp/htdocs">`.
3. Tempatkan file `.htaccess` di direktori root `Lab9Web/` sejajar dengan `index.php`.