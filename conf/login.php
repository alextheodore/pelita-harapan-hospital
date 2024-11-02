<?php
session_start();
include 'connection.php';

$conn = getConnection();

$target_email = $_POST['email'];
$target_password = $_POST['password'];

echo $target_email, $target_password;

$stmt = $conn->prepare("SELECT * FROM msadmin WHERE email = ? AND password = ?");
$stmt->bind_param("ss", $target_email, $target_password);

if ($stmt->execute()) {
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $_SESSION['user_id'] = $row['admin_id'];
        $_SESSION['email'] = $row['email'];
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
