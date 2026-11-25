<section class="content">
    <h2>Halaman Home (Dashboard)</h2>
    <p>Selamat datang di aplikasi PHP modular. Navigasi di atas dikelola melalui satu router utama.</p>

    <h3>Pengujian Helper Function</h3>
    <?php
    $hargaAwal = 250000;
    $hargaAkhir = hitungDiskon($hargaAwal, 15);
    $deskripsi = "Modularisasi adalah teknik membagi aplikasi menjadi bagian-bagian kecil berdasarkan fungsi dan tanggung jawabnya.";
    ?>
    <ul>
        <li>Harga Awal: <strong>
                <?= formatRupiah($hargaAwal); ?>
            </strong></li>
        <li>Harga Setelah Diskon 15%: <strong>
                <?= formatRupiah($hargaAkhir); ?>
            </strong></li>
        <li>Ringkasan Teks: <em>
                <?= e(ringkasTeks($deskripsi, 55)); ?>
            </em></li>
    </ul>
</section>