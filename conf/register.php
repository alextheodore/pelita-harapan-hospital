<?php
session_start();
$conn = new mysqli('localhost', 'root', '', 'hospital');

// Periksa koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$mobile_email = $_POST['mobile_email'];
$fullname = $_POST['fullname'];
$username = $_POST['username'];
$password = $_POST['password'];
$confirm_password = $_POST['confirm_password'];

$isError = false;
if ($mobile_email == "") {
    $_SESSION['error'] = "Email must be filled!";
    $isError = true;
} else if ($fullname == "") {
    $_SESSION['error'] = "Fullname must be filled!";
    $isError = true;
} else if ($username == "") {
    $_SESSION['error'] = "Username must be filled!";
    $isError = true;
} else if ($password == "") {
    $_SESSION['error'] = "Password must be filled!";
    $isError = true;
} else if ($password == "") {
    $_SESSION['error'] = "Confirm password must be filled!";
    $isError = true;
} else if ($password == "") {
    $_SESSION['error'] = "Confirm password must be the same with password!";
    $isError = true;
}

if ($isError) {
    header("Location: ../SignUp.php");
} else {
    $mobile_email = mysqli_real_escape_string($conn, $mobile_email);
    $fullname = mysqli_real_escape_string($conn, $fullname);
    $username = mysqli_real_escape_string($conn, $username);
    $password = mysqli_real_escape_string($conn, $password);

    $query = "INSERT INTO admin (mobile_email, fullname, username, password) VALUES ('$mobile_email', '$fullname', '$username', '$password')";

    if ($conn->query($query) === TRUE) {
        header("Location: ../index.php");
    } else {
        echo "Error: " . $query . "<br>" . $conn->error;
    }
    // $conn->close();
}
