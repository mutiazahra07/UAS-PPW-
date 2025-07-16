<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}

if (!isset($_SESSION['keranjang'])) {
    $_SESSION['keranjang'] = [];
}

$produk = json_decode(file_get_contents('data/produk.json'), true);

// Proses Tambah ke Keranjang
if (isset($_POST['tambah'])) {
    $id = $_POST['id'];
    foreach ($produk as $item) {
        if ($item['id'] == $id) {
            $_SESSION['keranjang'][] = $item;
            break;
        }
    }
    header("Location: keranjang.php");
    exit();
}

// Proses Hapus Keranjang
if (isset($_GET['hapus'])) {
    $index = $_GET['hapus'];
    unset($_SESSION['keranjang'][$index]);
    $_SESSION['keranjang'] = array_values($_SESSION['keranjang']);
    header("Location: keranjang.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Keranjang - Toko Kita Aja</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<h1>Keranjang Belanja</h1>

<?php if (!empty($_SESSION['keranjang'])): ?>
    <ul>
        <?php foreach ($_SESSION['keranjang'] as $index => $item): ?>
            <li>
                <?= $item['nama']; ?> - Rp<?= number_format($item['harga'],0,',','.') ?>
                <a href="keranjang.php?hapus=<?= $index; ?>">Hapus</a>
            </li>
        <?php endforeach; ?>
    </ul>
    <a href="transaksi.php" class="btn">Lanjut ke Pembayaran</a>
<?php else: ?>
    <p>Keranjang kosong!</p>
<?php endif; ?>

</body>
</html>
