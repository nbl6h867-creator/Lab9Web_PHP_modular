<?php
$id = (int) ($_GET['id'] ?? 0);
$stmt = $pdo->prepare("SELECT * FROM users WHERE id = :id");
$stmt->execute(['id' => $id]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user) {
    echo "<p>Data tidak ditemukan.</p>";
    return;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = trim($_POST['nama'] ?? '');
    $email = trim($_POST['email'] ?? '');
    if ($nama !== '' && validasiEmail($email)) {
        $update = $pdo->prepare("UPDATE users SET nama = :nama, email = :email WHERE id = :id");
        $update->execute(['nama' => $nama, 'email' => $email, 'id' => $id]);
        header('Location: index.php?page=user/list');
        exit;
    }
}
?>
<section class="content">
    <h2>Edit Pengguna</h2>
    <form method="post" action="index.php?page=user/edit&id=<?= $id; ?>">
        <label>Nama</label>
        <input type="text" name="nama" value="<?= e($user['nama']); ?>" required>
        <label>Email</label>
        <input type="email" name="email" value="<?= e($user['email']); ?>" required>
        <button type="submit" class="btn">Perbarui</button>
        <a href="index.php?page=user/list">Batal</a>
    </form>
</section>