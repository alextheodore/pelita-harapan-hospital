<?php
// Include database connection
include 'conf/connection.php';
$conn = getConnection();

// Get patient_id from URL
$patient_id = $_GET['patient_id'] ?? 'PA001';

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
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Pelita Harapan Hospital - Home</title>
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
        rel="stylesheet" />
    <link rel="stylesheet" href="css/home.css" />
    <link rel="stylesheet" href="css/transaction.css" />
</head>

<body>

    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <?php include 'sidebar.php' ?>

            <!-- Main Content -->
            <div class="col-md-10 content">
                <!-- Header and Search Bar -->

                <?php include 'topbar.php' ?>
                <!-- Welcome Section -->
                <h1 class="fw-medium">Registration > Patient Status > Transaction > <span class="fw-bold"><?php echo $patient['name'] ?></span></h1>

                <br>
                <br>
                <main>
                    <div class="patient-list">
                        <div class="d-flex flex-row">
                            <div class="d-flex flex-column align-items-stretch gap-3 m-5 justify-content-center ">
                                <div class="patient-info">
                                    <div class="avatar"></div>
                                    <div class="details">
                                        <h3><?= htmlspecialchars($patient['name']) ?></h3>
                                        <?php
                                        $queueNumber = isset($_GET['queue_number']) ? htmlspecialchars($_GET['queue_number']) : 'N/A';
                                        ?>
                                        <p>Queue No : <?= $queueNumber ?></p>
                                        <div class="gender-badge"><?= htmlspecialchars($patient['gender']) ?></div>
                                    </div>
                                </div>
                                <br>
                                <div class="menu">
                                    <a class="menu-item p-4" href="patientinfo.php?patient_id=<?php echo urlencode($patient['patient_id']); ?>&queue_number=<?php echo $_GET['queue_number'] ?>" style="text-decoration: none; background-color:#a73b62">
                                        Patient Info <span class="arrow">></span>
                                    </a>
                                    <a class="menu-item p-4" href="transaction.php?patient_id=<?php echo urlencode($patient['patient_id']); ?>&queue_number=<?php echo $_GET['queue_number'] ?>" style="text-decoration: none; background-color: #ffb6c1">
                                        Patient Transaction <span class="arrow">></span>
                                    </a>
                                </div>
                            </div>
                            <div class="invoice-container">
                                <div class="invoice-header">
                                    <div class="header-text">
                                        <div class="d-flex flex-row align-items-start justify-content-between">
                                            <div>
                                                <br>
                                                <h1>Patient Invoice</h1>
                                            </div>
                                            <div>
                                                <img src="/images/logoo.png" alt="Pelita Harapan Hospital Logo">
                                            </div>
                                        </div>
                                        <p>Pelita Harapan Hospital</p>
                                        <p>No.Tlp : (021) 543234555 | Fax : (021) 5432334455</p>
                                        <p>Jl. Permata Buana No.34 Kabupaten Tangerang Selatan </p>
                                        <br>
                                    </div>
                                </div>
                                <div class="section-title" style="font-size: larger; text-align: center;">BILLING INVOICE</div>
                                <div class="section-title">Patient Information</div>
                                <div class="invoice-details">
                                    <p><strong>Name:</strong> <?= htmlspecialchars($patient['name']) ?></p>
                                    <p><strong>NIK:</strong> <?= htmlspecialchars($patient['nik']) ?></p>
                                    <p><strong>DOB:</strong> <?= htmlspecialchars($patient['dob']) ?></p>
                                    <p><strong>Phone:</strong> <?= htmlspecialchars($patient['phone']) ?></p>
                                    <p><strong>BPJS Number:</strong> <?= htmlspecialchars($patient['bpjs_card']) ?></p>
                                    <p><strong>Address:</strong> <?= htmlspecialchars($patient['address']) ?></p>
                                </div>

                                <div class="section-title">Service Details</div>
                                <?php if ($transactionHeaders->num_rows > 0): ?>
                                    <table class="invoice-table table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Service</th>
                                                <th>Price (Rp)</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $totalPrice = 0;

                                            while ($transaction = $transactionHeaders->fetch_assoc()):
                                                $transactionDetailsQuery = $conn->prepare("SELECT details_id FROM TransactionDetail WHERE transaction_id = ?");
                                                $transactionDetailsQuery->bind_param("s", $transaction['transaction_id']);
                                                $transactionDetailsQuery->execute();
                                                $transactionDetails = $transactionDetailsQuery->get_result();

                                                while ($detail = $transactionDetails->fetch_assoc()) {
                                                    $details_id = $detail['details_id'];
                                                    $serviceOutput = "";
                                                    $price = 0; // Initialize price for this service
                                                    switch (substr($details_id, 0, 1)) {
                                                        case '6':
                                                        case '7':
                                                        case '8':
                                                            $roomDetailsQuery = $conn->prepare("SELECT code, room_id FROM MsRoomDetails WHERE patient_id = ? AND code = ?");
                                                            $roomDetailsQuery->bind_param("ss", $patient_id, $details_id);
                                                            $roomDetailsQuery->execute();
                                                            $roomDetails = $roomDetailsQuery->get_result()->fetch_assoc();

                                                            if ($roomDetails) {
                                                                $code = $roomDetails['code'];
                                                                $room_id = $roomDetails['room_id'];

                                                                $roomHeaderQuery = $conn->prepare("SELECT price FROM MsRoomHeader WHERE room_id = ?");
                                                                $roomHeaderQuery->bind_param("s", $room_id);
                                                                $roomHeaderQuery->execute();
                                                                $roomHeader = $roomHeaderQuery->get_result()->fetch_assoc();

                                                                if ($roomHeader) {
                                                                    $price = $roomHeader['price'];
                                                                    $serviceOutput = "Room Code: " . htmlspecialchars($code);
                                                                }
                                                            }
                                                            break;

                                                        default:
                                                            break;
                                                    }

                                                    $prefix = substr($details_id, 0, 2);

                                                    switch ($prefix) {
                                                        case 'AP':
                                                            $appointmentQuery = $conn->prepare("SELECT date, price FROM MsAppointment WHERE appointment_id = ?");
                                                            $appointmentQuery->bind_param("s", $details_id);
                                                            $appointmentQuery->execute();
                                                            $appointment = $appointmentQuery->get_result()->fetch_assoc();
                                                            $price = $appointment['price'];
                                                            $serviceOutput = "Appointment on " . htmlspecialchars($appointment['date']);
                                                            break;

                                                        case 'MC':
                                                            $checkupQuery = $conn->prepare("SELECT date, details, price FROM MsCheckup WHERE checkup_id = ?");
                                                            $checkupQuery->bind_param("s", $details_id);
                                                            $checkupQuery->execute();
                                                            $checkup = $checkupQuery->get_result()->fetch_assoc();
                                                            $price = $checkup['price'];
                                                            $serviceOutput = "Checkup on " . htmlspecialchars($checkup['date']) . " - Details: " . htmlspecialchars($checkup['details']);
                                                            break;

                                                        case 'TE':
                                                            $testQuery = $conn->prepare("SELECT name, price FROM MsTest WHERE test_id = ?");
                                                            $testQuery->bind_param("s", $details_id);
                                                            $testQuery->execute();
                                                            $test = $testQuery->get_result()->fetch_assoc();
                                                            $price = $test['price'];
                                                            $serviceOutput = "Test Name: " . htmlspecialchars($test['name']);
                                                            break;
                                                    }


                                                    if ($serviceOutput) {
                                                        echo "<tr><td>{$serviceOutput}</td><td>Rp " . number_format($price, 0, ',', '.') . "</td></tr>";
                                                        $totalPrice += $price;
                                                    }
                                                }
                                            endwhile;
                                            ?>
                                        </tbody>
                                    </table>

                                    <p class="total-price"><strong>Total Price:</strong> Rp <?= number_format($totalPrice, 0, ',', '.') ?></p>
                                <?php else: ?>
                                    <p>No transactions found for this patient.</p>
                                <?php endif; ?>

                                <div class="section-title">Handled by:</div>
                                <p><strong>Admin:</strong> <?= htmlspecialchars($_SESSION['user_id'] . ' - ' . $_SESSION['fullname']) ?></p>
                                <p class="note" style="font-weight: bold;">This invoice is valid even though it was generated electronically.</p>
                                <a class="d-flex justify-content-center align-items-center" href="conf/done_payment.php?patient_id=<?php echo $patient['patient_id']; ?>" style="text-decoration: none; text-align: center; color: white; background-color: #a73b62; border-radius: 8px; padding: 8px;">Confirm Payment</a>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>
    </div>
</body>

</html>