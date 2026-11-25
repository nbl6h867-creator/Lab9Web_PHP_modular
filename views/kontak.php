<?php
$pesanStatus = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $emailInput = $_POST['email'] ?? '';
    if (validasiEmail($emailInput)) {
        $pesanStatus = "Email valid: " . e($emailInput);
    } else {
        $pesanStatus = "Format email tidak valid!";
    }
}
?>
<section class="content">
    <h2>Kontak Kami</h2>
    <?php if ($pesanStatus): ?>
        <p><strong>
                <?= $pesanStatus; ?>
            </strong></p>
    <?php endif; ?>
    <form method="post" action="index.php?page=kontak">
        <label>Uji Validasi Email:</label>
        <input type="text" name="email" placeholder="contoh@domain.com" required>
        <button type="submit" class="btn">Cek Email</button>
    </form>
</section>