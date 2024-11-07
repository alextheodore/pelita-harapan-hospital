<?php
session_start();
include 'connection.php';
include 'create_transaction.php';

$conn = getConnection();


$name = $_POST['name'];
$dob = $_POST['dob'];
$gender = $_POST['gender'];
$phone1 = $_POST['phone1'];
$phone2 = $_POST['phone2'];
$nik = $_POST['nik'];
$email = $_POST['email'];
$address = $_POST['address'];
$payment = $_POST['payment'];
$inpatient_outpatient = $_POST['inpatient_outpatient'];
$ambulance = $_POST['ambulance'];
$actions = $_POST['actions'];
$notes = $_POST['note'];

if ($notes == null) {
    $_SESSION['error'] = "Notes must be filled (if null then set '-')";
    header("Location: " . $_SERVER['HTTP_REFERER']);
    exit;
}

function generateEmergencyID($conn)
{
    $query = "SELECT emergency_id FROM `MsEmergency` ORDER BY emergency_id DESC LIMIT 1";
    $result = $conn->query($query);
    $latestID = 'AP000';

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $latestID = $row['emergency_id'];
    }

    $num = (int)substr($latestID, 2) + 1;
    return 'EM' . str_pad($num, 3, '0', STR_PAD_LEFT);
}

// Begin transaction
$conn->begin_transaction();

try {
    $query = "INSERT INTO MsEmergency (emergency_id, patient_id, date, payment_type, is_ambulance, actions, price, status) VALUES (?,?,?,?,?,?,?,?)";
    $stmt = $conn->prepare($query);

    $emergency_id = generateEmergencyID($conn);
    $patient_id = $_SESSION['patient_id'];
    $admin_id = $_SESSION['user_id'];
    $price = 500000;
    $status = "Confirmed";
    date_default_timezone_set("Asia/Jakarta");
    $datetime = date('Y-m-d H:i:s');

    $stmt->bind_param('ssssssis', $emergency_id, $patient_id, $datetime, $payment, $ambulance, $actions, $price, $status);
    if (!$stmt->execute()) {
        throw new Exception("Failed to insert checkup: " . $stmt->error);
    }
    $stmt->close();

    // Insert transaction using checkup ID as room_code
    $transaction_id = insertTransaction($conn, $patient_id, $admin_id, $datetime, $emergency_id);

    // Commit transaction
    $conn->commit();

    header("Location: ../emergency_confirm.php");
    exit();
} catch (Exception $e) {
    $conn->rollback();
    echo "Error: " . $e->getMessage();
}

// Close connection
$conn->close();
