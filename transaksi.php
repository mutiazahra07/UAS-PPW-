<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}

if (!isset($_SESSION['keranjang']) || empty($_SESSION['keranjang'])) {
    header("Location: keranjang.php");
    exit();
}

$message = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $alamat = $_POST['alamat'];
    $pembayaran = $_POST['pembayaran'];
    $catatan = $_POST['catatan'];

    $total = 0;
    foreach ($_SESSION['keranjang'] as $item) {
        $total += $item['harga'];
    }

    $transaksi = [
        'user' => $_SESSION['username'],
        'nama' => $nama,
        'email' => $email,
        'alamat' => $alamat,
        'pembayaran' => $pembayaran,
        'catatan' => $catatan,
        'total' => $total,
        'produk' => $_SESSION['keranjang'],
        'tanggal' => date('Y-m-d H:i:s')
    ];

    $file = 'data/transaksi.json';
    $data = file_exists($file) ? json_decode(file_get_contents($file), true) : [];
    $data[] = $transaksi;
    file_put_contents($file, json_encode($data, JSON_PRETTY_PRINT));

    $_SESSION['keranjang'] = [];
    $message = "Transaksi berhasil disimpan!";
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Transaksi - Toko Kita Aja</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<h1>Form Transaksi</h1>

<?php if ($message): ?>
    <p class="success"><?= $message; ?></p>
    <a href="riwayat.php" class="btn">Lihat Riwayat Transaksi</a>
<?php else: ?>
    <form method="POST">
        <input type="text" name="nama" placeholder="Nama Lengkap" required><br>
        <input type="email" name="email" placeholder="Alamat Email" required><br>
        <textarea name="alamat" placeholder="Alamat Lengkap" required></textarea><br>

        <label>Metode Pembayaran:</label><br>
        <select name="pembayaran" required>
            <option value="">-- Pilih Metode --</option>
            <option value="Transfer Bank">Transfer Bank</option>
            <option value="E-Wallet">E-Wallet (OVO, Dana, Gopay)</option>
            <option value="COD">Cash on Delivery</option>
        </select><br><br>

        <textarea name="catatan" placeholder="Catatan Tambahan (Opsional)"></textarea><br><br>

        <button type="submit">Konfirmasi Pembayaran</button>
        <a href="keranjang.php" class="btn">Kembali ke Keranjang</a>
    </form>
<?php endif; ?>

</body>
</html>
