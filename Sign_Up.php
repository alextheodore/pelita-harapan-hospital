<?php

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
    $fullname = $_POST['fullname'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Cek apakah password dan konfirmasi password cocok
    if ($password === $confirm_password) {
        // Amankan input pengguna sebelum dimasukkan ke database
        $mobile_email = mysqli_real_escape_string($conn, $mobile_email);
        $fullname = mysqli_real_escape_string($conn, $fullname);
        $username = mysqli_real_escape_string($conn, $username);

        // Query untuk menyimpan data ke database
        $query = "INSERT INTO admin (mobile_email, fullname, username, password) VALUES ('$mobile_email', '$fullname', '$username', '$password')";

        if ($conn->query($query) === TRUE) {
            echo "Registrasi berhasil! Silakan login.";
            header("Location: home.php");
        } else {
            echo "Error: " . $query . "<br>" . $conn->error;
        }
    } else {
        echo "Password dan konfirmasi password tidak cocok.";
    }
}

$conn->close();
