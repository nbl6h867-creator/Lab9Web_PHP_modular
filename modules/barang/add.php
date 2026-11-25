<?php
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = trim($_POST['nama'] ?? '');
    $kategori = trim($_POST['kategori'] ?? '');
    $harga_jual = (int) ($_POST['harga_jual'] ?? 0);
    $harga_beli = (int) ($_POST['harga_beli'] ?? 0);
    $stok = (int) ($_POST['stok'] ?? 0);
    $gambar = null;

    if ($nama === '') {
        $error = 'Nama barang wajib diisi.';
    } else {
        if (isset($_FILES['file_gambar']) && $_FILES['file_gambar']['error'] === UPLOAD_ERR_OK) {
            $filename = time() . '_' . str_replace(' ', '_', basename($_FILES['file_gambar']['name']));
            $destination = dirname(__DIR__, 2) . '/assets/gambar/' . $filename;

            if (move_uploaded_file($_FILES['file_gambar']['tmp_name'], $destination)) {
                $gambar = $filename;
            }
        }

        $stmt = mysqli_prepare($conn, "INSERT INTO data_barang (nama, kategori, harga_jual, harga_beli, stok, gambar) VALUES (?, ?, ?, ?, ?, ?)");
        mysqli_stmt_bind_param($stmt, 'ssiiis', $nama, $kategori, $harga_jual, $harga_beli, $stok, $gambar);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        setFlash('sukses', 'Data barang baru berhasil ditambahkan.');

        header('Location: index.php?page=barang/list');
        exit;
    }
}
?>
<section class="content">
    <h2>Tambah Barang</h2>
    <?php if ($error): ?>
        <p style="color:#c62828;"><strong><?= e($error); ?></strong></p>
    <?php endif; ?>

    <form method="post" action="index.php?page=barang/add" enctype="multipart/form-data">
        <label>Nama Barang</label>
        <input type="text" name="nama" required>

        <label>Kategori</label>
        <select name="kategori">
            <option value="Komputer">Komputer</option>
            <option value="Elektronik">Elektronik</option>
            <option value="Hand Phone">Hand Phone</option>
        </select>

        <label>Harga Jual</label>
        <input type="number" name="harga_jual" required>

        <label>Harga Beli</label>
        <input type="number" name="harga_beli" required>

        <label>Stok</label>
        <input type="number" name="stok" required>

        <label>File Gambar</label>
        <input type="file" name="file_gambar" accept="image/*">

        <div style="margin-top: 14px;">
            <button type="submit" class="btn">Simpan</button>
            <a href="index.php?page=barang/list">Batal</a>
        </div>
    </form>
</section>