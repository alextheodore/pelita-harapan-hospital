<?php
session_start();
$conn = new mysqli('localhost', 'root', '', 'hospital');

if ($conn->connect_error) {
    die('Connection Failed: ' . $conn->connect_error);
}

$target_email = $_POST['email'];
$taget_password = $_POST['password'];

$stmt = $conn->prepare("SELECT * FROM admin WHERE mobile_email = ? AND password = ?");
$stmt->bind_param("ss", $target_email, $taget_password);

if ($stmt->execute()) {
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $_SESSION['user_id'] = $row['id_number'];
        $_SESSION['email'] = $row['mobile_email'];
        $_SESSION['fullname'] = $row['fullname'];
        $_SESSION['username'] = $row['username'];

        header("Location: ../home.php");
    } else {
        $_SESSION['error'] = "Invalid Credentials";
        header("Location: ../index.php");
        exit();
    }
} else {
    echo "Error executing query: " . $stmt->error;
}

// Close the statement and connection
$stmt->close();
$conn->close();
?>
