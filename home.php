<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Home - Toko Kita Aja</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body> 
  <header class="navar">
<nav>
    <h2>Toko Kita Aja</h2>
    <div>
        <a href="home.php">Home</a>
        <a href="katalog.php">Katalog Produk</a>
        <a href="keranjang.php">Keranjang</a>
        <a href="riwayat.php">Riwayat</a>
        <a href="logout.php" onclick="return confirm('Apakah Anda yakin ingin logout?')">Logout</a>
    </div>
</nav>

<section class="home">
    <h1>Selamat Datang di Toko Kita Aja, <?= $_SESSION['username']; ?>!</h1>
    <p>Kami menyediakan berbagai produk preloved berkualitas dengan harga terjangkau dan yang pasti dengan kualitas barang yang masih oke, jadi buruan checkout yaa dear.</p>
    <a href="katalog.php" class="btn">Lihat Katalog</a>
</section>

</body>
</html>
