<?php
// config/database.php
$host = 'localhost';
$user = 'root';
$pass = '';
$db   = 'latihan1';

$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn) {
    error_log('Koneksi MySQLi gagal: ' . mysqli_connect_error());
    http_response_code(500);
    exit('Terjadi kesalahan pada koneksi database.');
}

mysqli_set_charset($conn, 'utf8mb4');