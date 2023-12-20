<?php
session_start();

// Koneksi ke database
$db = new mysqli("localhost", "username", "password", "mydatabase");

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
        echo "Login successful. Welcome, $username!";
    } else {
        echo "Login failed. Incorrect password.";
    }
} else {
    echo "Login failed. User not found.";
}

// Tutup koneksi database
$db->close();
?>
