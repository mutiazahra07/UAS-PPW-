<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}

$file = 'data/transaksi.json';
$transaksi = file_exists($file) ? json_decode(file_get_contents($file), true) : [];
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Riwayat Transaksi - Toko Kita Aja</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<h1>Riwayat Transaksi</h1>

<?php
$user_transaksi = array_filter($transaksi, function($item) {
    return $item['user'] == $_SESSION['username'];
});

if ($user_transaksi):
    foreach ($user_transaksi as $index => $transaksi):
?>
    <div class="riwayat-item">
        <p><strong>Nama Penerima:</strong> <?= $transaksi['nama']; ?></p>
        <p><strong>Email:</strong> <?= $transaksi['email']; ?></p>
        <p><strong>Alamat:</strong> <?= $transaksi['alamat']; ?></p>
        <p><strong>Metode Pembayaran:</strong> <?= $transaksi['pembayaran']; ?></p>
        <p><strong>Total:</strong> Rp<?= number_format($transaksi['total'],0,',','.'); ?></p>
        <p><strong>Tanggal:</strong> <?= $transaksi['tanggal']; ?></p>
        <p><strong>Produk:</strong></p>
        <ul>
            <?php foreach ($transaksi['produk'] as $p): ?>
                <li><?= $p['nama']; ?> - Rp<?= number_format($p['harga'],0,',','.'); ?></li>
            <?php endforeach; ?>
        </ul>

        <!-- Tombol hapus -->
        <form method="POST" action="hapus_riwayat.php" onsubmit="return confirm('Yakin ingin menghapus transaksi ini?')">
            <input type="hidden" name="index" value="<?= $index; ?>">
            <button type="submit">❌ Hapus</button>
        </form>

        <hr>
    </div>
<?php
    endforeach;
else:
?>
    <p>Belum ada transaksi.</p>
<?php endif; ?>

</body>
</html>

