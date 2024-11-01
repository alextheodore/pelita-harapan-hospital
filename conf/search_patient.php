<?php
session_start();
include 'connection.php';

$conn = getConnection();

$name = $_POST['name'];
$nik = $_POST['nik'];

$stmt = $conn->prepare("SELECT * FROM mspatient WHERE name = ? AND nik = ?");
$stmt->bind_param("ss", $name, $nik);
$stmt->execute();
$result = $stmt->get_result();
$patients = [];

while ($row = $result->fetch_assoc()) {
    $patients[] = $row;
}

$stmt->close();

if ($patients) {
    $patient = $patients[0];
    $_SESSION['patient_id'] = $patient['patient_id'];
    $_SESSION['patient_name'] = $patient['name'];
    $_SESSION['patient_dob'] = $patient['dob'];
    $_SESSION['patient_gender'] = $patient['gender'];
    $_SESSION['patient_phone'] = $patient['phone'];
    $_SESSION['patient_email'] = $patient['email'];
    $_SESSION['patient_nik'] = $patient['nik'];
    $_SESSION['patient_bpjs_card'] = $patient['bpjs_card'];
    $_SESSION['patient_address'] = $patient['address'];
    header("Location: ../registration.php");
    exit();
} else {
    $_SESSION['error'] = "Patients not found on database! Register it first!";
    header("Location: ../registered.php");
    exit();
}
