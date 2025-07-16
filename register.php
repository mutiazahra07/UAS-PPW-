<?php
session_start();
$message = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = $_POST['nama'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirm = $_POST['confirm'];

    if ($password !== $confirm) {
        $message = "Password dan konfirmasi tidak sama!";
    } else {
        $file = 'data/user.json';
        $users = file_exists($file) ? json_decode(file_get_contents($file), true) : [];

        foreach ($users as $user) {
            if ($user['username'] === $username) {
                $message = "Username sudah digunakan!";
                break;
            }
        }

        if ($message == '') {
            $users[] = [
                'nama' => $nama,
                'username' => $username,
                'password' => $password
            ];
            file_put_contents($file, json_encode($users, JSON_PRETTY_PRINT));
            header("Location: index.php");
            exit();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Register - Toko Kita Aja</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <h2>Register Form</h2>
    <?php if ($message) echo "<p class='error'>$message</p>"; ?>
    <form method="POST">
        <input type="text" name="nama" placeholder="Nama Lengkap" required><br>
        <input type="text" name="username" placeholder="Username" required><br>
        <input type="password" name="password" placeholder="Password" required><br>
        <input type="password" name="confirm" placeholder="Konfirmasi Password" required><br>
        <button type="submit">Register</button>
    </form>
    <p>Sudah punya akun? <a href="index.php">Login disini</a></p>
</div>
</body>
</html>
