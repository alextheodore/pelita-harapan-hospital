<?php
session_start();
include 'connection.php';
include 'create_transaction.php'; // Include transaction insertion file

$date = $_POST['mcu_date'];
$time = $_POST['time_slot'];
$name = $_POST['test_name'];
$type = $_POST['type'];
$price = $_POST['price'];

$datetime = date('Y-m-d H:i:s', strtotime("$date $time"));

// Database connection
$conn = getConnection();

// Function to generate unique test ID
function generateId($conn) {
    $query = "SELECT test_id FROM `mstest` ORDER BY test_id DESC LIMIT 1";
    $result = $conn->query($query);

    $latestID = 'TE000';
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $latestID = $row['test_id'];
    }

    $num = (int)substr($latestID, 2) + 1;
    return 'TE' . str_pad($num, 3, '0', STR_PAD_LEFT);
}

$newId = generateId($conn);
$status = "Confirmed";
$patient_id = $_SESSION['patient_id'];
$admin_id = $_SESSION['user_id'];

// Begin transaction
$conn->begin_transaction();

try {
    // Insert into `mstest`
    $stmt = $conn->prepare("INSERT INTO `mstest` (test_id, patient_id, type, name, price, date, status) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssiss", $newId, $patient_id, $type, $name, $price, $datetime, $status);

    if (!$stmt->execute()) {
        throw new Exception("Failed to insert test: " . $stmt->error);
    }
    $stmt->close();

    // Insert transaction using test ID as room_code
    $transaction_id = insertTransaction($conn, $patient_id, $admin_id, $datetime, $newId);

    // Commit transaction
    $conn->commit();

    // Encode details and redirect
    $details = json_encode([
        'name' => $name,
        'date' => $datetime,
        'type' => $type,
    ]);
    $encodedDetails = urlencode($details);
    header("Location: ../test_confirm.php?details=" . $encodedDetails);
    exit();

} catch (Exception $e) {
    $conn->rollback();
    echo "Error: " . $e->getMessage();
}

// Close connection
$conn->close();
