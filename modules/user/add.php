<?php
$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = trim($_POST['nama'] ?? '');
    $email = trim($_POST['email'] ?? '');

    if ($nama === '' || !validasiEmail($email)) {
        $error = 'Nama wajib diisi dan email harus valid.';
    } else {
        $stmt = $pdo->prepare("INSERT INTO users (nama, email) VALUES (:nama, :email)");
        $stmt->execute(['nama' => $nama, 'email' => $email]);
        header('Location: index.php?page=user/list');
        exit;
    }
}
?>
<section class="content">
    <h2>Tambah Pengguna</h2>
    <?php if ($error): ?>
        <p style="color:red;"><?= e($error); ?></p><?php endif; ?>
    <form method="post" action="index.php?page=user/add">
        <label>Nama</label>
        <input type="text" name="nama" required>
        <label>Email</label>
        <input type="email" name="email" required>
        <button type="submit" class="btn">Simpan</button>
        <a href="index.php?page=user/list">Batal</a>
    </form>
</section>