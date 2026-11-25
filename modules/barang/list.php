<?php
$sql = "SELECT * FROM data_barang ORDER BY id_barang DESC";
$result = mysqli_query($conn, $sql);
?>
<section class="content">
    <h2>Data Barang</h2>
    <a href="index.php?page=barang/add" class="btn">+ Tambah Barang</a>

    <table>
        <thead>
            <tr>
                <th>Gambar</th>
                <th>Nama Barang</th>
                <th>Kategori</th>
                <th>Harga Jual</th>
                <th>Harga Beli</th>
                <th>Stok</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($result && mysqli_num_rows($result) > 0): ?>
                <?php while ($row = mysqli_fetch_assoc($result)): ?>
                    <tr>
                        <td>
                            <?php if (!empty($row['gambar'])): ?>
                                <img src="assets/gambar/<?= e(basename($row['gambar'])); ?>" alt="<?= e($row['nama']); ?>"
                                    class="thumb-barang">
                            <?php else: ?>
                                <span>-</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <?= e($row['nama']); ?>
                        </td>
                        <td>
                            <?= e($row['kategori']); ?>
                        </td>
                        <td>
                            <?= formatRupiah((float) $row['harga_jual']); ?>
                        </td>
                        <td>
                            <?= formatRupiah((float) $row['harga_beli']); ?>
                        </td>
                        <td>
                            <?= (int) $row['stok']; ?>
                        </td>
                        <td>
                            <a href="index.php?page=barang/edit&id=<?= (int) $row['id_barang']; ?>" class="btn">Ubah</a>
                            <form method="post" action="index.php?page=barang/delete" style="display:inline;"
                                onsubmit="return confirm('Yakin ingin menghapus barang ini?');">
                                <input type="hidden" name="id" value="<?= (int) $row['id_barang']; ?>">
                                <button type="submit" class="btn btn-danger">Hapus</button>
                            </form>
                        </td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="7">Belum ada data barang.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</section>