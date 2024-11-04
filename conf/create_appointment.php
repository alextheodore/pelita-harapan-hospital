<?php
session_start();
include 'connection.php';
include 'create_transaction.php';

$date = $_POST['appointment_date'];
$time = $_POST['time_slot'];
$datetime = date('Y-m-d H:i:s', strtotime("$date $time"));

$conn = getConnection();

function generateAppointmentId($conn) {
    $query = "SELECT appointment_id FROM `msappointment` ORDER BY appointment_id DESC LIMIT 1";
    $result = $conn->query($query);
    $latestID = 'AP000';

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $latestID = $row['appointment_id'];
    }

    $num = (int)substr($latestID, 2) + 1;
    return 'AP' . str_pad($num, 3, '0', STR_PAD_LEFT);
}

$newId = generateAppointmentId($conn);

$doctorDetails = $_SESSION['selectedDoctor'];
$price = 300000;
$status = "Confirmed";
$patient_id = $_SESSION['patient_id'];
$admin_id = $_SESSION['user_id'];

// Begin transaction
$conn->begin_transaction();

try {
    // Insert appointment
    $stmt = $conn->prepare("
        INSERT INTO msappointment (appointment_id, doctor_id, patient_id, date, status, price)
        VALUES (?, ?, ?, ?, ?, ?)
    ");
    $stmt->bind_param("ssssss", $newId, $doctorDetails['id'], $patient_id, $datetime, $status, $price);

    if (!$stmt->execute()) {
        throw new Exception("Failed to insert appointment: " . $stmt->error);
    }
    $stmt->close();

    // Insert transaction using the appointment ID as the room code
    $transaction_id = insertTransaction($conn, $patient_id, $admin_id, $datetime, $newId);

    // Commit transaction
    $conn->commit();

    // Encode details and redirect
    $details = json_encode([
        'name' => $doctorDetails['name'],
        'date' => $datetime,
    ]);
    $encodedDetails = urlencode($details);
    header("Location: ../appointment_confirm.php?details=" . $encodedDetails);
    exit();

} catch (Exception $e) {
    $conn->rollback();
    echo "Error: " . $e->getMessage();
}

$conn->close();
