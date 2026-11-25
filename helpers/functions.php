<?php
function e(string $nilai): string
{
    return htmlspecialchars($nilai, ENT_QUOTES, 'UTF-8');
}

function formatRupiah(float $angka): string
{
    return 'Rp ' . number_format($angka, 0, ',', '.');
}

function hitungDiskon(float $harga, float $persen = 10): float
{
    return $harga - ($harga * ($persen / 100));
}

function validasiEmail(string $email): bool
{
    return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
}

function ringkasTeks(string $teks, int $maksKarakter = 60): string
{
    if (mb_strlen($teks) <= $maksKarakter) {
        return $teks;
    }
    return mb_substr($teks, 0, $maksKarakter) . '...';
}

function setFlash(string $tipe, string $pesan): void
{
    $_SESSION['flash'] = [
        'tipe' => $tipe,
        'pesan' => $pesan,
    ];
}

function tampilkanFlash(): string
{
    if (empty($_SESSION['flash'])) {
        return '';
    }

    $flash = $_SESSION['flash'];
    unset($_SESSION['flash']);

    $class = $flash['tipe'] === 'sukses' ? 'alert-sukses' : 'alert-gagal';
    return '<div class="alert ' . $class . '">' . e($flash['pesan']) . '</div>';
}