<?php
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    if ($username === 'admin' && $password === 'admin123') {
        $_SESSION['user_login'] = $username;
        header('Location: index.php?page=barang/list');
        exit;
    } else {
        $error = 'Username atau password salah.';
    }
}
?>
<section class="content">
    <h2>Login Aplikasi</h2>
    <p>Silakan login untuk mengakses modul Data User (CRUD).</p>
    <?php if ($error): ?>
        <p style="color:#c62828;"><strong><?= e($error); ?></strong></p>
    <?php endif; ?>
    <form method="post" action="index.php?page=login">
        <label>Username</label>
        <input type="text" name="username" placeholder="admin" required>
        <label>Password</label>
        <input type="password" name="password" placeholder="admin123" required>
        <button type="submit" class="btn">Login</button>
    </form>
    <p><small>Akun uji coba: <code>admin</code> / <code>admin123</code></small></p>
</section>