<?php
session_start();
if (isset($_SESSION['username'])) {
    header("Location: home.php");
    exit();
}

$message = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $users = json_decode(file_get_contents('data/user.json'), true);

    foreach ($users as $user) {
        if ($user['username'] === $username && $user['password'] === $password) {
            $_SESSION['username'] = $username;
            header("Location: home.php");
            exit();
        }
    }
    $message = "Username atau Password salah!";
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login - Toko Kita Aja</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
  <header class="navbar">
<div class="form-container">
    <h2>Login</h2>
    <?php if ($message) echo "<p class='error'>$message</p>"; ?>
    <form method="POST">
        <input type="text" name="username" placeholder="Username" required><br>
        <input type="password" name="password" placeholder="Password" required><br>
        <button type="submit">Login</button>
    </form>
    <p>Belum punya akun? <a href="register.php">Daftar disini</a></p>
</div>
</body>
</html>
