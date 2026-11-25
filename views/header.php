<?php $currentPage = $_GET['page'] ?? 'dashboard'; ?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <base href="/Lab9Web/">
    <title>Aplikasi PHP Modular - Lab 9</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
    <div class="container">
        <header>
            <h1>Aplikasi PHP Modular</h1>
            <p>Praktikum 9: Template, Function, Routing & Integrasi CRUD</p>
        </header>
        <nav>
            <a href="index.php?page=dashboard" class="<?= $currentPage === 'dashboard' ? 'active' : '' ?>">Home</a>
            <a href="index.php?page=profil" class="<?= $currentPage === 'profil' ? 'active' : '' ?>">Profil</a>
            <a href="index.php?page=kontak" class="<?= $currentPage === 'kontak' ? 'active' : '' ?>">Kontak</a>
            <a href="index.php?page=barang/list"
                class="<?= str_starts_with($currentPage, 'barang/') ? 'active' : '' ?>">Data Barang (CRUD)</a>
            <?php if (!empty($_SESSION['user_login'])): ?>
                <a href="index.php?page=logout">Logout (<?= e($_SESSION['user_login']); ?>)</a>
            <?php else: ?>
                <a href="index.php?page=login" class="<?= $currentPage === 'login' ? 'active' : '' ?>">Login</a>
            <?php endif; ?>
        </nav>
        <main>
            <?= tampilkanFlash(); ?>
        </main>