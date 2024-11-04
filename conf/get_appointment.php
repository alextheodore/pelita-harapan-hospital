<?php
session_start();
include 'connection.php';
$conn = getConnection();

$selectedDate = $_GET['date'];

echo $selectedDate;

// Modified query with JOIN to include patient and doctor details
$stmt = $conn->prepare("
    SELECT 
        msappointment.appointment_id, 
        msappointment.date,
        msappointment.status, 
        msappointment.price,
        msdoctor.doctor_id, 
        msdoctor.name AS doctor_name,
        mspatient.patient_id, 
        mspatient.name AS patient_name
    FROM msappointment
    JOIN msdoctor ON msappointment.doctor_id = msdoctor.doctor_id
    JOIN mspatient ON msappointment.patient_id = mspatient.patient_id
    WHERE DATE(msappointment.date) = ?
");

$stmt->bind_param('s', $selectedDate);
$stmt->execute();

$result = $stmt->get_result();
$appointments = [];

while ($row = $result->fetch_assoc()) {
    $appointments[] = $row;
}

$_SESSION['appointments'] = $appointments;
$_SESSION['selected_date'] = $selectedDate;

$stmt->close();
$conn->close();

header("Location: ../patientstatus.php?date=" . urlencode($selectedDate));
exit;
?>
