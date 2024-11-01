<?php
session_start();
include 'connection.php';

$conn = getConnection();

$mobile_email = $_POST['email'];
$fullname = $_POST['fullname'];
$username = $_POST['username'];
$password = $_POST['password'];
$confirm_password = $_POST['confirm_password'];

$isError = false;

if (empty($mobile_email)) {
    $_SESSION['error'] = "Email must be filled!";
    $isError = true;
} else if (empty($fullname)) {
    $_SESSION['error'] = "Fullname must be filled!";
    $isError = true;
} else if (empty($username)) {
    $_SESSION['error'] = "Username must be filled!";
    $isError = true;
} else if (empty($password)) {
    $_SESSION['error'] = "Password must be filled!";
    $isError = true;
} else if (empty($confirm_password)) {
    $_SESSION['error'] = "Confirm password must be filled!";
    $isError = true;
} else if ($password !== $confirm_password) {
    $_SESSION['error'] = "Confirm password must be the same as password!";
    $isError = true;
}

if ($isError) {
    header("Location: ../SignUp.php");
    exit();
}

$mobile_email = $conn->real_escape_string($mobile_email);
$fullname = $conn->real_escape_string($fullname);
$username = $conn->real_escape_string($username);
$password = $conn->real_escape_string($password);

function generateAdminID($conn) {
    // This query to get the latest ID from the table in the database
    $query = "SELECT admin_id FROM `msadmin` ORDER BY admin_id DESC LIMIT 1";
    $result = $conn->query($query);

    // Default ID if no records exist
    $latestID = 'AM000';

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $latestID = $row['admin_id'];
    }

    $num = (int)substr($latestID, 2) + 1;
    return 'AM' . str_pad($num, 3, '0', STR_PAD_LEFT);
}

$newAdminID = generateAdminID($conn);

$stmt = $conn->prepare("INSERT INTO `msadmin` (admin_id, email, fullname, username, password) VALUES (?, ?, ?, ?, ?)");

// Use bind_param to prevent SQL Injection (aka Prepare Statement)

$stmt->bind_param("sssss", $newAdminID, $mobile_email, $fullname, $username, $password);

if ($stmt->execute()) {
    header("Location: ../index.php");
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
