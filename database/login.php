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
        exit(); // Pastikan untuk keluar dari skrip setelah melakukan pengalihan header
    } else {
        echo "Login failed. Incorrect password.";
    }
} else {
    echo "Login failed. User not found.";
}

// Tutup koneksi database
$db->close();
?>
