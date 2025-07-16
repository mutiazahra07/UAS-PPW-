<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}

if (isset($_POST['index'])) {
    $file = 'data/transaksi.json';
    if (file_exists($file)) {
        $data = json_decode(file_get_contents($file), true);
        
        // Hanya hapus jika data index valid dan milik user yang login
        if (isset($data[$_POST['index']]) && $data[$_POST['index']]['user'] == $_SESSION['username']) {
            array_splice($data, $_POST['index'], 1);
            file_put_contents($file, json_encode($data, JSON_PRETTY_PRINT));
        }
    }
}

header("Location: riwayat.php");
exit();
