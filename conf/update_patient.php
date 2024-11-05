<?php
include 'connection.php';
$conn = getConnection();

$patient_id = $_POST['patient_id'];
$name = $_POST['name'];
$dob = $_POST['dob'];
$gender = $_POST['gender'];
$phone = $_POST['phone'];
$email = $_POST['email'];
$nik = $_POST['nik'];
$bpjs_card = $_POST['bpjs_card'];
$address = $_POST['address'];

echo $patient_id, $name, $dob, $gender, $phone, $email, $nik, $bpjs_card, $address;

// Update patient data
$update_sql = "UPDATE MsPatient SET name=?, dob=?, gender=?, phone=?, email=?, nik=?, bpjs_card=?, address=? WHERE patient_id=?";
$stmt = $conn->prepare($update_sql);
$stmt->bind_param("sssssssss", $name, $dob, $gender, $phone, $email, $nik, $bpjs_card, $address, $patient_id);

if ($stmt->execute()) {
    header("Location: ../reporting.php"); // Redirect to patient list page
    exit();
} else {
    echo "Error updating patient.";
}

?>