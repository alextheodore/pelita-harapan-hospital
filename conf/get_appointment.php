<?php
session_start();
include 'connection.php';
$conn = getConnection();

$selectedDate = $_GET['date'];

$stmt = $conn->prepare("SELECT * FROM msappointment WHERE msappointment.date = ?");
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
