<?php
session_start();
include 'connection.php';


$date = $_POST['mcu_date'];
$time = $_POST['time_slot'];
$name = $_POST['test_name'];
$type = $_POST['type'];
$price= $_POST['price'];

echo $type;

$datetime = date('Y-m-d H:i:s', strtotime("$date $time"));

$conn = getConnection();


function generateId($conn, $type)
{
    // This query to get the latest ID from the table in the database
    $query = "SELECT test_id FROM `mstest` ORDER BY test_id DESC LIMIT 1";
    $result = $conn->query($query);

    // Default ID if no records exist
    $latestID = 'TE000';

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $latestID = $row['test_id'];
    }

    $num = (int)substr($latestID, 2) + 1;
    return 'TE' . str_pad($num, 3, '0', STR_PAD_LEFT);
}

$newId = generateId($conn, $type);

$stmt = $conn->prepare("INSERT INTO `mstest` (test_id, patient_id, type, name, price, date, status) VALUES (?, ?, ?, ?, ?, ?, ?)");

$status = "Confirmed";

$stmt->bind_param("ssssiss", $newId, $_SESSION['patient_id'], $type, $name, $price, $datetime,  $status);

// Execute the statement
if ($stmt->execute()) {
    $details = json_encode([
        'name' => $name,
        'date' => $datetime,
        'type' => $type,
    ]);
    $encodedDetails = urlencode($details);
    header("Location: ../test_confirm.php?details=" . urlencode($encodedDetails));
    exit();
} else {
    echo "Error: " . $stmt->error;
}

// Close the connection
$stmt->close();
$conn->close();
