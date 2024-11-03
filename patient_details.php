<?php
// Include database connection
include 'conf/connection.php';
$conn = getConnection();;

// Get patient_id from URL
$patient_id = $_GET['patient_id'] ?? '';

if (!$patient_id) {
    echo "No patient ID specified.";
    exit;
}

// Fetch patient details
$patientQuery = $conn->prepare("SELECT * FROM MsPatient WHERE patient_id = ?");
$patientQuery->bind_param("s", $patient_id);
$patientQuery->execute();
$patientResult = $patientQuery->get_result();
$patient = $patientResult->fetch_assoc();

// Fetch transaction headers for the patient
$transactionHeaderQuery = $conn->prepare("
    SELECT * FROM TransactionHeader 
    WHERE patient_id = ?
");
$transactionHeaderQuery->bind_param("s", $patient_id);
$transactionHeaderQuery->execute();
$transactionHeaders = $transactionHeaderQuery->get_result();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Patient Details</title>
</head>

<body>
    <!-- Display patient details -->
    <h1>Patient Details</h1>
    <?php if ($patient): ?>
        <p><strong>Name:</strong> <?= htmlspecialchars($patient['name']) ?></p>
        <p><strong>Date of Birth:</strong> <?= htmlspecialchars($patient['dob']) ?></p>
        <p><strong>Gender:</strong> <?= htmlspecialchars($patient['gender']) ?></p>
        <p><strong>Phone:</strong> <?= htmlspecialchars($patient['phone']) ?></p>
        <p><strong>Email:</strong> <?= htmlspecialchars($patient['email']) ?></p>
        <p><strong>Address:</strong> <?= htmlspecialchars($patient['address']) ?></p>
    <?php else: ?>
        <p>Patient not found.</p>
    <?php endif; ?>

    <!-- Display transaction history -->
    <h2>Transaction History</h2>
    <?php if ($transactionHeaders->num_rows > 0): ?>
        <table border="1">
            <tr>
                <th>Transaction ID</th>
                <th>Transaction Date</th>
                <th>Admin</th>
                <th>Details</th>
            </tr>
            <?php while ($transaction = $transactionHeaders->fetch_assoc()): ?>
                <tr>
                    <td><?= htmlspecialchars($transaction['transaction_id']) ?></td>
                    <td><?= htmlspecialchars($transaction['transaction_date']) ?></td>
                    <td>
                        <?php
                        $adminQuery = $conn->prepare("SELECT fullname FROM MsAdmin WHERE admin_id = ?");
                        $adminQuery->bind_param("s", $transaction['admin_id']);
                        $adminQuery->execute();
                        $adminResult = $adminQuery->get_result()->fetch_assoc();
                        echo htmlspecialchars($adminResult['fullname']);
                        ?>
                    </td>
                    <td>
                        <?php
                        // Fetch transaction details based on `details_id` prefix
                        $transactionDetailsQuery = $conn->prepare("
                            SELECT details_id 
                            FROM TransactionDetail 
                            WHERE transaction_id = ?
                        ");
                        $transactionDetailsQuery->bind_param("s", $transaction['transaction_id']);
                        $transactionDetailsQuery->execute();
                        $transactionDetails = $transactionDetailsQuery->get_result();

                        while ($detail = $transactionDetails->fetch_assoc()) {
                            $details_id = $detail['details_id'];

                            switch (substr($details_id, 0, 1)) {
                                case '6':
                                case '7':
                                case '8':
                                    $roomDetailsQuery = $conn->prepare("
                                    SELECT code, room_id FROM MsRoomDetails 
                                    WHERE patient_id = ? AND code = ?
                                ");
                                    $roomDetailsQuery->bind_param("ss", $patient_id, $details_id);
                                    $roomDetailsQuery->execute();
                                    $roomDetails = $roomDetailsQuery->get_result()->fetch_assoc();

                                    if ($roomDetails) {
                                        $code = $roomDetails['code'];
                                        $room_id = $roomDetails['room_id'];

                                        $roomHeaderQuery = $conn->prepare("
                                        SELECT price FROM MsRoomHeader 
                                        WHERE room_id = ?
                                    ");
                                        $roomHeaderQuery->bind_param("s", $room_id);
                                        $roomHeaderQuery->execute();
                                        $roomHeader = $roomHeaderQuery->get_result()->fetch_assoc();

                                        if ($roomHeader) {
                                            $price = $roomHeader['price'];
                                            echo "<p>Room Code: " . htmlspecialchars($code) . " - Price: " . htmlspecialchars($price) . "</p>";
                                        } else {
                                            echo "<p>Room details not found in MsRoomHeader.</p>";
                                        }
                                    } else {
                                        echo "<p>Room details not found in MsRoomDetails.</p>";
                                    }
                                    break;

                                default:
                                    break;
                            }


                            $prefix = substr($details_id, 0, 2);
                            echo $prefix;
                            switch ($prefix) {
                                case 'AP':
                                    $appointmentQuery = $conn->prepare("
                                        SELECT date, status, price FROM MsAppointment 
                                        WHERE appointment_id = ?
                                    ");
                                    $appointmentQuery->bind_param("s", $details_id);
                                    $appointmentQuery->execute();
                                    $appointment = $appointmentQuery->get_result()->fetch_assoc();
                                    echo "<p>Appointment on " . htmlspecialchars($appointment['date']) . " - Status: " . htmlspecialchars($appointment['status']) . " - Price: " . htmlspecialchars($appointment['price']) . "</p>";
                                    break;

                                case 'MC': // Checkup
                                    $checkupQuery = $conn->prepare("
                                        SELECT date, details, price FROM MsCheckup 
                                        WHERE checkup_id = ?
                                    ");
                                    $checkupQuery->bind_param("s", $details_id);
                                    $checkupQuery->execute();
                                    $checkup = $checkupQuery->get_result()->fetch_assoc();
                                    echo "<p>Checkup on " . htmlspecialchars($checkup['date']) . " - Details: " . htmlspecialchars($checkup['details']) . " - Price: " . htmlspecialchars($checkup['price']) . "</p>";
                                    break;

                                case 'EM': // Emergency
                                    $emergencyQuery = $conn->prepare("
                                        SELECT actions FROM MsEmergency 
                                        WHERE emergency_id = ?
                                    ");
                                    $emergencyQuery->bind_param("s", $details_id);
                                    $emergencyQuery->execute();
                                    $emergency = $emergencyQuery->get_result()->fetch_assoc();
                                    echo "<p>Emergency Action: " . htmlspecialchars($emergency['actions']) . "</p>";
                                    break;


                                case 'TE':
                                    $testQuery = $conn->prepare("
                                        SELECT name, price FROM MsTest 
                                        WHERE test_id = ?
                                    ");
                                    $testQuery->bind_param("s", $details_id);
                                    $testQuery->execute();
                                    $test = $testQuery->get_result()->fetch_assoc();
                                    echo "<p>Test Name: " . htmlspecialchars($test['name']) . " - Price: " . htmlspecialchars($test['price']) . "</p>";
                                    break;
                            }
                        }
                        ?>
                    </td>
                </tr>
            <?php endwhile; ?>
        </table>
    <?php else: ?>
        <p>No transactions found for this patient.</p>
    <?php endif; ?>
</body>

</html>