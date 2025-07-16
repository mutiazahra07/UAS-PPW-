<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}

$produk = json_decode(file_get_contents('data/produk.json'), true);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Katalog Produk - Toko Kita Aja</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header class="navbar">
    <header class="header">
    <div class="logo">Toko Kita Aja</div>
    <nav class="nav-links">
        <a href="home.php">Home</a>
        <a href="katalog.php">Katalog</a>
        <a href="keranjang.php">Keranjang</a>
        <a href="riwayat.php">Riwayat</a>
        <a href="logout.php" onclick="return confirm(' Apakah Anda yakin ingin logout?')">Logout</a>
    </nav>
</header>
<section class="katalog">
    <h1>Katalog Produk Preloved</h1>
    <div class="produk-list">
        <?php foreach ($produk as $item): ?>
            <div class="produk-card">
                <img src="<?= $item['gambar']; ?>" alt="<?= $item['nama']; ?>">
                <h3><?= $item['nama']; ?></h3>
                <p>Harga: Rp<?= number_format($item['harga'], 0, ',', '.'); ?></p>
                <form method="POST" action="keranjang.php">
                    <input type="hidden" name="id" value="<?= $item['id']; ?>">
                    <button type="submit" name="tambah">Tambah ke Keranjang</button>
                </form>
            </div>
        <?php endforeach; ?>
    </div>
</section>

</body>
</html>
