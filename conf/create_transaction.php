<?php

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

function insertTransaction($conn, $patient_id, $admin_id, $booking_date, $details_code) {
    $transaction_id = generateTransactionID($conn);

    // Insert into TransactionHeader
    $stmtHeader = $conn->prepare("
        INSERT INTO TransactionHeader (transaction_id, patient_id, admin_id, transaction_date)
        VALUES (?, ?, ?, ?)
    ");
    $stmtHeader->bind_param("ssss", $transaction_id, $patient_id, $admin_id, $booking_date);
    $stmtHeader->execute();
    $stmtHeader->close();

    // Insert into TransactionDetail
    $stmtDetail = $conn->prepare("
        INSERT INTO TransactionDetail (transaction_id, details_id)
        VALUES (?, ?)
    ");
    $stmtDetail->bind_param("ss", $transaction_id, $details_code);
    $stmtDetail->execute();
    $stmtDetail->close();

    return $transaction_id;
}
?>