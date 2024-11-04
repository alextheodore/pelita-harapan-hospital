<?php
session_start();
include 'connection.php'; // Replace with your actual database connection file
$conn = getConnection();
$patient_id = $_GET['patient_id'];

// 1. Update status in MsAppointment table to 'Paid'
$updateAppointment = $conn->prepare("UPDATE MsAppointment SET status = 'Paid' WHERE patient_id = ?");
$updateAppointment->bind_param("s", $patient_id);
$updateAppointment->execute();
$updateAppointment->close();

// 2. Update status in MsTest table to 'Paid'
$updateTest = $conn->prepare("UPDATE MsTest SET status = 'Paid' WHERE patient_id = ?");
$updateTest->bind_param("s", $patient_id);
$updateTest->execute();
$updateTest->close();

// 3. Update status in MsCheckup table to 'Paid'
$updateCheckup = $conn->prepare("UPDATE MsCheckup SET status = 'Paid' WHERE patient_id = ?");
$updateCheckup->bind_param("s", $patient_id);
$updateCheckup->execute();
$updateCheckup->close();

// 4. Update status in MsRoomDetails table to 'Available'
$updateRoomDetails = $conn->prepare("UPDATE MsRoomDetails SET status = 'Available', patient_id = NULL, date = NUll WHERE patient_id = ?");
$updateRoomDetails->bind_param("s", $patient_id);
$updateRoomDetails->execute();
$updateRoomDetails->close();

// 5. Fetch patient details from MsPatient table
$getPatient = $conn->prepare("SELECT * FROM MsPatient WHERE patient_id = ?");
$getPatient->bind_param("s", $patient_id);
$getPatient->execute();
$result = $getPatient->get_result();
$patient = $result->fetch_assoc();

// Close the database connection
$conn->close();

$details = json_encode([
    'name' => $patient['name'],
    'gender' => $patient['gender'],
]);
$encodedDetails = urlencode($details);
echo $encodedDetails;
header("Location: ../paymenttransaction.php?details=". urlencode($encodedDetails));
exit();
?>