<?php
session_start();
include 'connection.php';
$conn = getConnection();

$specialistType = $_GET['specialist'];


$stmt = $conn->prepare("SELECT * FROM msdoctor WHERE msdoctor.type = ?");

$type = $specialistType == "General" ? "General" : "Specialist";

$stmt->bind_param('s', $type);
$stmt->execute();

$result = $stmt->get_result();
$doctors = [];

while ($row = $result->fetch_assoc()) {
    $doctors[] = $row;
}

$_SESSION['doctors'] = $doctors;
$_SESSION['specialist'] = $type == "General" ?  "General Practitioner" : "Specialist";

$stmt->close();
$conn->close();
if ($type == "General") {
    header("Location: ../appointment_details_specialist.php?specialist=" . urlencode($specialistType));
}
else{
    header("Location: ../appointment_details_specialist.php?specialist=" . urlencode($specialistType));
}
exit;
