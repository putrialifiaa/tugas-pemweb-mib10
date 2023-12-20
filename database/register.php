<?php
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'mydatabase';
// Koneksi ke database
$db = new mysqli("localhost", "root", "", "mydatabase");

if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}

// Tangkap data dari formulir
$username = $_POST['username'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);

// Masukkan data ke database
$query = "INSERT INTO users (username, password) VALUES ('$username', '$password')";
$result = $db->query($query);

if ($result) {
    echo "Registration successful. <a href='login.html'>Login</a>";
} else {
    echo "Registration failed. Please try again.";
}

// Tutup koneksi database
$db->close();
?>
