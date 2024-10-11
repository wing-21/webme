<?php
session_start();

// Data pengguna yang disimpan dalam array
$users = [
    ['username' => 'Erwin', 'password' => 'Panincong21'], // Username dan password
];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Cek apakah username dan password cocok
    foreach ($users as $user) {
        if ($user['username'] === $username && $user['password'] === $password) {
            $_SESSION['user_id'] = $username;
            header("Location: dashboard.php");
            exit();
        }
    }
    $error = "Username atau password salah.";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="icon" href="img/webmeid.jpg" type="image/jpeg">
    <title>Login</title>
    <style>
        .login-container {
            max-width: 400px;
            margin: 50px auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .logo {
            display: block;
            margin: 0 auto 20px;
            width: 100px; /* Sesuaikan dengan ukuran logo Anda */
            height: auto;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="login-container">
        <img src="img/webmeid.jpg" alt="Logo" class="logo"> <!-- Ganti dengan URL logo Anda -->
        <form method="POST">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" class="form-control" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" name="password" required>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Login</button>
            <?php if (isset($error)): ?>
                <div class="alert alert-danger mt-2"><?php echo $error; ?></div>
            <?php endif; ?>
        </form>
    </div>
</div>
</body>
</html>
