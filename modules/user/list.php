<?php
$stmt = $pdo->query("SELECT id, nama, email FROM users ORDER BY id DESC");
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<section class="content">
    <h2>Daftar Pengguna</h2>
    <a href="index.php?page=user/add" class="btn">+ Tambah Pengguna</a>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $i => $row): ?>
                <tr>
                    <td><?= $i + 1; ?></td>
                    <td><?= e($row['nama']); ?></td>
                    <td><?= e($row['email']); ?></td>
                    <td>
                        <a href="index.php?page=user/edit&id=<?= (int) $row['id']; ?>" class="btn">Edit</a>
                        <form method="post" action="index.php?page=user/delete" style="display:inline;"
                            onsubmit="return confirm('Hapus data ini?');">
                            <input type="hidden" name="id" value="<?= (int) $row['id']; ?>">
                            <button type="submit" class="btn btn-danger">Hapus</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</section>