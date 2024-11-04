<?php
session_start();
include 'connection.php';
include 'create_transaction.php';

$conn = getConnection();

$room_code = $_POST['room_code'];
$room_name = $_POST['room_name'];
$booking_date = $_POST['booking_date'];

$patient_id = $_SESSION['patient_id'];
$admin_id = $_SESSION['user_id'];

$conn->begin_transaction();

try {
    // Insert into TransactionHeader and TransactionDetail
    $transaction_id = insertTransaction($conn, $patient_id, $admin_id, $booking_date, $room_code);

    // Update MsRoomDetails
    $stmtUpdate = $conn->prepare("
        UPDATE MsRoomDetails
        SET status = 'Occupied', patient_id = ?, date = ?
        WHERE code = ?
    ");
    $stmtUpdate->bind_param("sss", $patient_id, $booking_date, $room_code);
    $stmtUpdate->execute();
    $stmtUpdate->close();

    $conn->commit();

    // Encode and redirect with details
    $details = json_encode([
        'name' => $room_name,
        'date' => $booking_date,
    ]);
    $encodedDetails = urlencode($details);
    header("Location: ../room_confirm.php?details=" . $encodedDetails);

} catch (Exception $e) {
    // Rollback and show error message for debugging
    $conn->rollback();
    echo "Failed to book the room: " . $e->getMessage();
}

$conn->close();
