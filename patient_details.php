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
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Pelita Harapan Hospital - Home</title>
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
        rel="stylesheet" />
    <link rel="stylesheet" href="css/reporting.css" />
    <link rel="stylesheet" href="css/registrationland.css" />
</head>

<style>

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
                <h1 class="fw-medium">Reporting > Patient Details > <span class="fw-bold"><?php echo $patient['name'] ?></span></h1>
                <div class="welcome-section text-center p-0 my-4 d-flex flex-row justify-content-start align-items-top">
                    <img
                        src="images/image/ornament.png"
                        class="img-fluid"
                        width="200"
                        alt="Logo"
                        style="margin-left: -30px; margin-top: -15px;" />
                    <div class="hero-text flex-fill p-2">
                        <h2 class="fs-2 mt-2">Welcome, <?php echo $_SESSION['fullname'] ?>!</h2>
                        <div class="d-flex justify-content-center align-items-center">
                            <p style="font-size: 26px;">
                                Let’s check your health with us, care with your health from <br> now to
                                get more live better.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="accordion" id="accordionExample">
                    <!-- Patient Info Accordion Item -->
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingPatientInfo">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapsePatientInfo" aria-expanded="true" aria-controls="collapsePatientInfo">
                                Patient Info
                            </button>
                        </h2>
                        <div id="collapsePatientInfo" class="accordion-collapse collapse show" aria-labelledby="headingPatientInfo" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
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
                            </div>
                        </div>
                    </div>

                    <!-- Patient Status Accordion Item -->
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingPatientStatus">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapsePatientStatus" aria-expanded="false" aria-controls="collapsePatientStatus">
                                Patient History
                            </button>
                        </h2>
                        <div id="collapsePatientStatus" class="accordion-collapse collapse" aria-labelledby="headingPatientStatus" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                <h2>Transaction History</h2>
                                <?php if ($transactionHeaders->num_rows > 0): ?>
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Transaction ID</th>
                                                <th>Transaction Date</th>
                                                <th>Admin</th>
                                                <th>Details</th>
                                                <th>Price</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
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
                                                        $totalPrice = 0; // To accumulate total price
                                                        $statusMessage = ""; // To store status message
                                                        $transactionDetailsQuery = $conn->prepare("SELECT details_id FROM TransactionDetail WHERE transaction_id = ?");
                                                        $transactionDetailsQuery->bind_param("s", $transaction['transaction_id']);
                                                        $transactionDetailsQuery->execute();
                                                        $transactionDetails = $transactionDetailsQuery->get_result();

                                                        while ($detail = $transactionDetails->fetch_assoc()) {
                                                            $details_id = $detail['details_id'];

                                                            switch (substr($details_id, 0, 1)) {
                                                                case '6':
                                                                case '7':
                                                                case '8':
                                                                    $roomDetailsQuery = $conn->prepare("SELECT code, room_id, status FROM MsRoomDetails WHERE patient_id = ? AND code = ?");
                                                                    $roomDetailsQuery->bind_param("ss", $patient_id, $details_id);
                                                                    $roomDetailsQuery->execute();
                                                                    $roomDetails = $roomDetailsQuery->get_result()->fetch_assoc();
                                                                    $statusMessage = $roomDetails['status'];
                                                                    if ($roomDetails) {
                                                                        $code = $roomDetails['code'];
                                                                        $room_id = $roomDetails['room_id'];

                                                                        $roomHeaderQuery = $conn->prepare("SELECT price FROM MsRoomHeader WHERE room_id = ?");
                                                                        $roomHeaderQuery->bind_param("s", $room_id);
                                                                        $roomHeaderQuery->execute();
                                                                        $roomHeader = $roomHeaderQuery->get_result()->fetch_assoc();

                                                                        if ($roomHeader) {
                                                                            $price = $roomHeader['price'];
                                                                            $totalPrice += $price; // Accumulate price
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

                                                            switch ($prefix) {
                                                                case 'AP':
                                                                    $appointmentQuery = $conn->prepare("SELECT date, status, price FROM MsAppointment WHERE appointment_id = ?");
                                                                    $appointmentQuery->bind_param("s", $details_id);
                                                                    $appointmentQuery->execute();
                                                                    $appointment = $appointmentQuery->get_result()->fetch_assoc();
                                                                    $totalPrice += $appointment['price']; // Accumulate appointment price
                                                                    $statusMessage = htmlspecialchars($appointment['status']); // Store appointment status
                                                                    echo "<p>Appointment on " . htmlspecialchars($appointment['date']) . "</p>";
                                                                    break;

                                                                case 'MC': // Checkup
                                                                    $checkupQuery = $conn->prepare("SELECT date, details, price, status FROM MsCheckup WHERE checkup_id = ?");
                                                                    $checkupQuery->bind_param("s", $details_id);
                                                                    $checkupQuery->execute();
                                                                    $checkup = $checkupQuery->get_result()->fetch_assoc();
                                                                    $statusMessage = htmlspecialchars($checkup['status']);
                                                                    $totalPrice += $checkup['price']; // Accumulate checkup price
                                                                    echo "<p>Checkup on " . htmlspecialchars($checkup['date']) . " - Details: " . htmlspecialchars($checkup['details']) . "</p>";
                                                                    break;

                                                                case 'EM': // Emergency
                                                                    $emergencyQuery = $conn->prepare("SELECT date, actions, price, status from MsEmergency WHERE emergency_id = ?");
                                                                    $emergencyQuery->bind_param("s", $details_id);
                                                                    $emergencyQuery->execute();
                                                                    $emergency = $emergencyQuery->get_result()->fetch_assoc();
                                                                    $statusMessage = htmlspecialchars($emergency["status"]);
                                                                    $totalPrice += $emergency['price'];
                                                                    echo "<p>Emergency Pickup on " . htmlspecialchars($emergency['date']) . " - Details: " . htmlspecialchars($emergency['actions']) . "</p>";
                                                                    break;

                                                                case 'TE': // Test
                                                                    $testQuery = $conn->prepare("SELECT name, price, status FROM MsTest WHERE test_id = ?");
                                                                    $testQuery->bind_param("s", $details_id);
                                                                    $testQuery->execute();
                                                                    $test = $testQuery->get_result()->fetch_assoc();
                                                                    $totalPrice += $test['price']; // Accumulate test price
                                                                    $statusMessage = htmlspecialchars($test['status']);
                                                                    echo "<p>Test Name: " . htmlspecialchars($test['name']) . "</p>";
                                                                    break;
                                                            }
                                                        }
                                                        ?>
                                                    </td>
                                                    <td><?= htmlspecialchars($totalPrice) ?></td> <!-- Display total price -->
                                                    <td><?= htmlspecialchars($statusMessage) ?></td> <!-- Display status message -->
                                                </tr>
                                            <?php endwhile; ?>
                                        </tbody>
                                    </table>
                                <?php else: ?>
                                    <p>No transactions found for this patient.</p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>