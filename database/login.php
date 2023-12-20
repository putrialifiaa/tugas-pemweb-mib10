<?php
session_start();

// Koneksi ke database (sesuaikan dengan informasi koneksi database Anda)
$db = new mysqli("localhost", "root", "", "mydatabase");

if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}

// Tangkap data dari formulir
$username = $_POST['username'];
$password = $_POST['password'];

// Ambil data pengguna dari database
$query = "SELECT * FROM users WHERE username='$username'";
$result = $db->query($query);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    // Verifikasi password
    if (password_verify($password, $row['password'])) {
        // Set session untuk menandakan bahwa pengguna sudah login
        $_SESSION['username'] = $username;

        // Redirect ke halaman HTML setelah login (ganti 'dashboard.html' dengan nama file HTML yang diinginkan)
        header("Location: ../html-css/index.html");
        exit();
    } else {
        // Password salah, tampilkan pesan kesalahan di halaman login
        $error_message = "Password salah, silahkan coba lagi.";
    }
} else {
    // User tidak ditemukan, tampilkan pesan kesalahan di halaman login
    $error_message = "User tidak ditemukan, silahkan coba lagi.";
}

// Tutup koneksi database
$db->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="login-style.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
</head>
<body>

    <div class="login-container">
        <h2>Login</h2>
        <form class="login-form" action="login.php" method="post">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>
            </div>

            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
        
            <?php
    // Tampilkan pesan kesalahan jika ada
    if (isset($error_message)) {
        echo "<div style='color: red;'>$error_message</div>";
    }
    ?>
            <div class="form-group">
                <button type="submit">Login</button>
                
            </div>
        </form>
    </div>
</body>

</html>
