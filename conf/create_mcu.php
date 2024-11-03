<?php
session_start();
include 'connection.php';
$serviceDetails = json_decode(urldecode($_SESSION['test']), true);

$date = $_POST['mcu_date'];
$time = $_POST['time_slot'];
$price = $_POST['price'];
$name = $_POST['test_name'];

// Combine date and time into a datetime string
$datetime = date('Y-m-d H:i:s', strtotime("$date $time"));

// Database connection
$conn = getConnection();


function generateCheckupId($conn)
{
    // This query to get the latest ID from the table in the database
    $query = "SELECT checkup_id FROM `mscheckup` ORDER BY checkup_id DESC LIMIT 1";
    $result = $conn->query($query);

    // Default ID if no records exist
    $latestID = 'MC001';

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $latestID = $row['checkup_id'];
    }

    $num = (int)substr($latestID, 2) + 1;
    return 'MC' . str_pad($num, 3, '0', STR_PAD_LEFT);
}

$newId = generateCheckupId($conn);

$stmt = $conn->prepare("INSERT INTO mscheckup (checkup_id, patient_id, date, status, details, price) VALUES (?, ?, ?, ?, ?, ?)");

$status = "Confirmed";

$stmt->bind_param("sssssi", $newId, $_SESSION['patient_id'], $datetime,  $status, $name ,$price);

// Execute the statement
if ($stmt->execute()) {
    $details = json_encode([
        'name' => $name,
        'date' => $datetime,
    ]);
    $encodedDetails = urlencode($details);
    header("Location: ../mcu_confirm.php?details=" . urlencode($encodedDetails));
    exit();
} else {
    echo "Error: " . $stmt->error;
}

// Close the connection
$stmt->close();
$conn->close();