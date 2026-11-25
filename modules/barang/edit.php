<?php
$id = (int) ($_GET['id'] ?? $_POST['id'] ?? 0);

if ($id <= 0) {
    echo '<p>ID barang tidak valid. <a href="index.php?page=barang/list">Kembali</a></p>';
    return;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = trim($_POST['nama'] ?? '');
    $kategori = trim($_POST['kategori'] ?? '');
    $harga_jual = (int) ($_POST['harga_jual'] ?? 0);
    $harga_beli = (int) ($_POST['harga_beli'] ?? 0);
    $stok = (int) ($_POST['stok'] ?? 0);
    $gambarBaru = null;

    if (isset($_FILES['file_gambar']) && $_FILES['file_gambar']['error'] === UPLOAD_ERR_OK) {
        $filename = time() . '_' . str_replace(' ', '_', basename($_FILES['file_gambar']['name']));
        $destination = dirname(__DIR__, 2) . '/assets/gambar/' . $filename;

        if (move_uploaded_file($_FILES['file_gambar']['tmp_name'], $destination)) {
            $gambarBaru = $filename;
        }
    }

    if ($gambarBaru !== null) {
        $stmt = mysqli_prepare($conn, "UPDATE data_barang SET nama = ?, kategori = ?, harga_jual = ?, harga_beli = ?, stok = ?, gambar = ? WHERE id_barang = ?");
        mysqli_stmt_bind_param($stmt, 'ssiiisi', $nama, $kategori, $harga_jual, $harga_beli, $stok, $gambarBaru, $id);
    } else {
        $stmt = mysqli_prepare($conn, "UPDATE data_barang SET nama = ?, kategori = ?, harga_jual = ?, harga_beli = ?, stok = ? WHERE id_barang = ?");
        mysqli_stmt_bind_param($stmt, 'ssiiii', $nama, $kategori, $harga_jual, $harga_beli, $stok, $id);
    }

    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    setFlash('sukses', 'Perubahan data barang berhasil disimpan.');

    header('Location: index.php?page=barang/list');
    exit;
}

$stmtSelect = mysqli_prepare($conn, "SELECT * FROM data_barang WHERE id_barang = ?");
mysqli_stmt_bind_param($stmtSelect, 'i', $id);
mysqli_stmt_execute($stmtSelect);
$resSelect = mysqli_stmt_get_result($stmtSelect);
$data = mysqli_fetch_assoc($resSelect);
mysqli_stmt_close($stmtSelect);

if (!$data) {
    echo '<p>Data barang tidak ditemukan. <a href="index.php?page=barang/list">Kembali</a></p>';
    return;
}

function is_select(string $var, string $val): string
{
    return $var === $val ? 'selected="selected"' : '';
}
?>
<section class="content">
    <h2>Ubah Barang</h2>
    <form method="post" action="index.php?page=barang/edit&id=<?= $id; ?>" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?= (int) $data['id_barang']; ?>">

        <label>Nama Barang</label>
        <input type="text" name="nama" value="<?= e($data['nama']); ?>" required>

        <label>Kategori</label>
        <select name="kategori">
            <option <?= is_select('Komputer', $data['kategori']); ?> value="Komputer">Komputer</option>
            <option <?= is_select('Elektronik', $data['kategori']); ?> value="Elektronik">Elektronik</option>
            <option <?= is_select('Hand Phone', $data['kategori']); ?> value="Hand Phone">Hand Phone</option>
        </select>

        <label>Harga Jual</label>
        <input type="number" name="harga_jual" value="<?= (int) $data['harga_jual']; ?>" required>

        <label>Harga Beli</label>
        <input type="number" name="harga_beli" value="<?= (int) $data['harga_beli']; ?>" required>

        <label>Stok</label>
        <input type="number" name="stok" value="<?= (int) $data['stok']; ?>" required>

        <label>File Gambar (kosongkan jika tidak diubah)</label>
        <input type="file" name="file_gambar" accept="image/*">

        <div style="margin-top: 14px;">
            <button type="submit" class="btn">Simpan Perubahan</button>
            <a href="index.php?page=barang/list">Batal</a>
        </div>
    </form>
</section>