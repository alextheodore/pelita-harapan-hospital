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
</head>
<style>
    .actions {
        display: flex;
        align-items: center;
    }

    .actions button {
        background-color: transparent;
        border: none;
        color: #a73b62;
        margin-right: 15px;
        cursor: pointer;
    }

    .user {
        display: flex;
        align-items: center;
    }

    .user img {
        width: 30px;
        margin-right: 5px;
    }

    /* Patient Info Section */
    .patient-info {
        background-color: #f5f5f5;
        padding: 20px;
        border-radius: 20px;
        margin-bottom: 20px;
        text-align: center;
        width: 250px;
        height: 55px;
        display: flex;
        align-items: center;
    }

    .avatar {
        width: 60px;
        height: 60px;
        background-color: #ccc;
        border-radius: 50%;
        margin-right: 15px;
    }

    .details h3 {
        margin: 0;
    }

    .details p {
        margin: 5px 0;
    }

    .gender-badge {
        background-color: #ffb6c1;
        color: white;
        padding: 3px 10px;
        border-radius: 15px;
        font-size: 14px;
        display: inline-block;
    }

    /* Patient Status Section */
    .patient-status {
        background-color: #f5f5f5;
        padding: 17px;
        border-radius: 20px;
        margin-bottom: 20px;
        text-align: center;
        width: 250px;
        height: 20px;
    }

    .patient-status p {
        margin: 0;
        font-size: 14px;
    }

    /* Menu Section */
    .menu {
        display: flex;
        flex-direction: column;
    }

    .menu-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 15px;
        background-color: #ffb6c1;
        color: white;
        border: none;
        border-radius: 5px;
        font-size: 16px;
        margin-bottom: 10px;
        cursor: pointer;
        width: 275px;
        height: 25px;
    }

    .menu-item.active {
        background-color: #ff6699;
    }

    .arrow {
        font-weight: bold;

    }

    .details-card {
        background-color: white;
        border-radius: 10px;
        padding: 20px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        width: 100%;
    }

    .patient-card .status {
        margin-top: 10px;
    }

    .patient-card img {
        width: 80px;
        border-radius: 50%;
        display: block;
        margin-bottom: 10px;
    }

    .status span {
        background-color: #e2a2a2;
        padding: 5px 10px;
        border-radius: 10px;
        color: white;
    }

    .details-card .section-title {
        font-weight: bold;
        margin-top: 15px;
        border-bottom: 2px solid #e2a2a2;
        padding-bottom: 5px;
    }

    .details-card .note {
        color: red;
        font-size: 0.9em;
        margin-bottom: 10px;
    }
</style>

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
                <h1 class="fw-medium">Registration > Patient Status > Patient Info > <span class="fw-bold"><?php echo $patient['name'] ?></span></h1>

                <br>
                <br>
                <main>
                    <div class="patient-list">
                        <div class="d-flex flex-row">
                            <div class="d-flex flex-column align-items-stretch gap-3 m-5 justify-content-center ">
                                <div class="patient-info">
                                    <div class="avatar"></div>
                                    <div class="details">
                                        <h3 style="font-weight: bolder;"><?= htmlspecialchars($patient['name']) ?></h3>
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
                            <div class="details-card">
                                <div class="section-title">PATIENT INFO</div>
                                <p>NIK: <?= htmlspecialchars($patient['nik']) ?></p>
                                <p>DOB: <?= htmlspecialchars($patient['dob']) ?></p>
                                <p>No.Tlp: <?= htmlspecialchars($patient['phone']) ?></p>
                                <p>No.BPJS: <?= htmlspecialchars($patient['bpjs_card']) ?></p>
                                <p>Alamat: <?= htmlspecialchars($patient['address']) ?></p>
                                <div class="section-title">Layanan Yang Digunakan:</div>
                                <div class="accordion-body">
                                    <?php if ($transactionHeaders->num_rows > 0): ?>
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Service Details</th>
                                                    <th>Price (Rp)</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $totalPrice = 0;

                                                while ($transaction = $transactionHeaders->fetch_assoc()): ?>
                                                <?php
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
                                                            case 'EM':
                                                                $emergencyQuery = $conn->prepare("SELECT date, actions, price, status from MsEmergency WHERE emergency_id = ?");
                                                                $emergencyQuery->bind_param("s", $details_id);
                                                                $emergencyQuery->execute();
                                                                $emergency = $emergencyQuery->get_result()->fetch_assoc();
                                                                $statusMessage = htmlspecialchars($emergency["status"]);
                                                                $price = $checkup['price'];
                                                                $serviceOutput = "Emergency Pickup on " . htmlspecialchars($emergency['date']);
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
                                            <tfoot>
                                                <tr>
                                                    <td><strong>Total</strong></td>
                                                    <td><strong>Rp <?= number_format($totalPrice, 0, ',', '.') ?></strong></td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    <?php else: ?>
                                        <p>No transactions found for this patient.</p>
                                    <?php endif; ?>
                                </div>

                                <div class="section-title">Total Price:</div>
                                <td><strong>Rp <?= number_format($totalPrice, 0, ',', '.') ?></strong></td>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>
    </div>
</body>

</html>