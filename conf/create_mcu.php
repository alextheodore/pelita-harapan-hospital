<?php
session_start();
include 'connection.php';
include 'create_transaction.php'; // Include transaction insertion file

$serviceDetails = json_decode(urldecode($_SESSION['test']), true);

$date = $_POST['mcu_date'];
$time = $_POST['time_slot'];
$price = $_POST['price'];
$name = $_POST['test_name'];

// Combine date and time into a datetime string
$datetime = date('Y-m-d H:i:s', strtotime("$date $time"));

// Database connection
$conn = getConnection();

// Function to generate unique checkup ID
function generateCheckupId($conn) {
    $query = "SELECT checkup_id FROM `mscheckup` ORDER BY checkup_id DESC LIMIT 1";
    $result = $conn->query($query);

    $latestID = 'MC000';
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $latestID = $row['checkup_id'];
    }

    $num = (int)substr($latestID, 2) + 1;
    return 'MC' . str_pad($num, 3, '0', STR_PAD_LEFT);
}

$newId = generateCheckupId($conn);
$status = "Confirmed";
$patient_id = $_SESSION['patient_id'];
$admin_id = $_SESSION['user_id'];

// Begin transaction
$conn->begin_transaction();

try {
    // Insert into `mscheckup`
    $stmt = $conn->prepare("INSERT INTO mscheckup (checkup_id, patient_id, date, status, details, price) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssi", $newId, $patient_id, $datetime, $status, $name, $price);

    if (!$stmt->execute()) {
        throw new Exception("Failed to insert checkup: " . $stmt->error);
    }
    $stmt->close();

    // Insert transaction using checkup ID as room_code
    $transaction_id = insertTransaction($conn, $patient_id, $admin_id, $datetime, $newId);

    // Commit transaction
    $conn->commit();

    // Encode details and redirect
    $details = json_encode([
        'name' => $name,
        'date' => $datetime,
    ]);
    $encodedDetails = urlencode($details);
    header("Location: ../mcu_confirm.php?details=" . $encodedDetails);
    exit();

} catch (Exception $e) {
    $conn->rollback();
    echo "Error: " . $e->getMessage();
}

// Close connection
$conn->close();
