<?php
session_start();
include 'connection.php';
$conn = getConnection();

$room_code = $_POST['room_code'];
$room_name = $_POST['room_name'];
$booking_date = $_POST['booking_date'];

$patient_id = $_SESSION['patient_id'];
$admin_id = $_SESSION['user_id'];

function generateTransactionID($conn) {
    $query = "SELECT transaction_id FROM `transactionheader` ORDER BY transaction_id DESC LIMIT 1";
    $result = $conn->query($query);

    $latestID = 'TR000';

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $latestID = $row['transaction_id'];
    }

    $num = (int)substr($latestID, 2) + 1;
    return 'TR' . str_pad($num, 3, '0', STR_PAD_LEFT);
}

$transaction_id = generateTransactionID($conn);
echo $transaction_id;
// Start a transaction
$conn->begin_transaction();

try {
    $stmtHeader = $conn->prepare("
            INSERT INTO TransactionHeader (transaction_id, patient_id, admin_id, transaction_date)
            VALUES (?, ?, ?, ?)
        ");
    $stmtHeader->bind_param("ssss", $transaction_id, $patient_id, $admin_id, $booking_date);
    $stmtHeader->execute();

    // Insert into TransactionDetail
    $stmtDetail = $conn->prepare("
            INSERT INTO TransactionDetail (transaction_id, details_id)
            VALUES (?, ?)
        ");

    $stmtDetail->bind_param("ss", $transaction_id, $room_code);
    $stmtDetail->execute();

    $stmtUpdate = $conn->prepare("
            UPDATE MsRoomDetails
            SET status = 'Occupied', patient_id = ?, date = ?
            WHERE code = ?
        ");
    $stmtUpdate->bind_param("sss", $patient_id, $booking_date, $room_code);
    $stmtUpdate->execute();

    $conn->commit();

    $stmtHeader->close();
    $stmtDetail->close();
    $stmtUpdate->close();

    $details = json_encode([
        'name' => $room_name,
        'date' => $booking_date,
    ]);
    $encodedDetails = urlencode($details);
    header("Location: ../room_confirm.php?details=" . urlencode($encodedDetails));

} catch (Exception $e) {
    // Debugging kinda things ? 
    $conn->rollback();
    echo "Failed to book the room: " . $e->getMessage();
}

$conn->close();
