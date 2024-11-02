<?php
session_start();
include 'connection.php';

$date = $_POST['appointment_date'];
$time = $_POST['time_slot'];

// Combine date and time into a datetime string
$datetime = date('Y-m-d H:i:s', strtotime("$date $time"));

// Database connection
$conn = getConnection();

function generateAppointmentId($conn) {
    // This query to get the latest ID from the table in the database
    $query = "SELECT appointment_id FROM `msappointment` ORDER BY appointment_id DESC LIMIT 1";
    $result = $conn->query($query);

    // Default ID if no records exist
    $latestID = 'AP001';

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $latestID = $row['appointment_id'];
    }

    $num = (int)substr($latestID, 2) + 1;
    return 'AP' . str_pad($num, 3, '0', STR_PAD_LEFT);
}

$newId = generateAppointmentId($conn);

$doctorDetails = $_SESSION['selectedDoctor'];

$stmt = $conn->prepare("INSERT INTO msappointment (appointment_id, doctor_id, patient_id, date, status, price) VALUES (?, ?, ?, ?, ?, ?)");

// Make sure price is an integer
$price = 300000; // This is already correct
$status = "Confirmed";
// Adjust bind_param to use the correct types
$stmt->bind_param("ssssss", $newId, $doctorDetails['id'], $_SESSION['patient_id'], $datetime, $status, $price);

// Execute the statement
if ($stmt->execute()) {
    $details = json_encode([
        'name' => $doctorDetails['name'],
        'date' => $datetime,
    ]);
    $encodedDetails = urlencode($details);
    echo $encodedDetails;
    header("Location: ../appointment_confirm.php?details=" . urlencode($encodedDetails));
    exit();
} else {
    echo "Error: " . $stmt->error;
}

// Close the connection
$stmt->close();
$conn->close();
