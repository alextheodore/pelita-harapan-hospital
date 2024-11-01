<?php
session_start();
include 'connection.php';

$conn = getConnection();

$name = $_POST['name'];
$dob = $_POST['dob'];
$gender = $_POST['gender'];
$phone = $_POST['phone'];
$email = $_POST['email'];
$nik = $_POST['nik'];
$bpjs_card = $_POST['bpjs_card'] ?: null;
$address = $_POST['address'];

function generatePatientID($conn) {
    // This query to get the latest ID from the table in the database
    $query = "SELECT patient_id FROM `mspatient` ORDER BY patient_id DESC LIMIT 1";
    $result = $conn->query($query);

    // Default ID if no records exist
    $latestID = 'PA000';

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $latestID = $row['patient_id'];
    }

    $num = (int)substr($latestID, 2) + 1;
    return 'PA' . str_pad($num, 3, '0', STR_PAD_LEFT);
}

$newPatientID = generatePatientID($conn);

$stmt = $conn->prepare("INSERT INTO mspatient (patient_id, name, dob, gender, phone, email, nik, bpjs_card, address, is_registered) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
$is_registered = 1;
$stmt->bind_param("ssssssisss", $newPatientID, $name, $dob, $gender, $phone, $email, $nik, $bpjs_card, $address, $is_registered);
$stmt->execute();

$_SESSION['patient_id'] = $newPatientID;
$_SESSION['patient_name'] = $name;
$_SESSION['patient_dob'] = $dob;
$_SESSION['patient_gender'] = $gender;
$_SESSION['patient_phone'] = $phone;
$_SESSION['patient_email'] = $email;
$_SESSION['patient_nik'] = $nik;
$_SESSION['patient_bpjs_card'] = $bpjs_card;
$_SESSION['patient_address'] = $address;

$stmt->close();

header("Location: ../registration.php");
exit();
