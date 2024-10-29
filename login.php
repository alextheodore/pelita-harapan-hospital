<?php
session_start();


$host = "localhost";
$user = "root";
$password_db = "";
$dbname = "pasien_registration";

// Koneksi ke database
$conn = new mysqli($host, $user, $password_db, $dbname);

// Periksa koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Cek apakah form sudah di-submit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $mobile_email = $_POST['mobile_email'];
    $password = $_POST['password'];

    // Amankan input pengguna
    $mobile_email = mysqli_real_escape_string($conn, $mobile_email);
    $password = mysqli_real_escape_string($conn, $password);

    // Query untuk memeriksa apakah email dan password cocok
    $query = "SELECT * FROM admin WHERE mobile_email='$mobile_email' AND password='$password'";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        // Login berhasil
        $_SESSION['mobile_email'] = $mobile_email;
        header("Location: home.php");
    } else {
        // Login gagal
        echo " Email atau Password salah!";
    }
}

$conn->close();
