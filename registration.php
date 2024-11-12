<?php
// Start of home.php
include 'conf/connection.php';

// Function to get appointments by date
function getAppointmentsByDate($selectedDate)
{
    $conn = getConnection();

    $stmt = $conn->prepare("
        SELECT 
            msappointment.appointment_id, 
            msappointment.date,
            msappointment.status, 
            msappointment.price,
            msdoctor.doctor_id, 
            msdoctor.name AS doctor_name,
            mspatient.patient_id, 
            mspatient.name AS patient_name
        FROM msappointment
        JOIN msdoctor ON msappointment.doctor_id = msdoctor.doctor_id
        JOIN mspatient ON msappointment.patient_id = mspatient.patient_id
        WHERE DATE(msappointment.date) = ?
    ");

    $stmt->bind_param('s', $selectedDate);
    $stmt->execute();

    $result = $stmt->get_result();
    $appointments = [];

    while ($row = $result->fetch_assoc()) {
        $appointments[] = $row;
    }

    $stmt->close();
    $conn->close();

    return $appointments;
}

// Get the selected date or default to today
$selectedDate = date('Y-m-d');

// Fetch appointments
$appointments = getAppointmentsByDate($selectedDate);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Pelita Harapan Hospital - Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="css/registration.css" />
    <link rel="stylesheet" href="css/home.css" />
</head>
<style>
    .queue h4 {
        font-weight: bold;
        font-size: 16px;
        transition: .3s ease;
    }

    .queue {
        transition: .3s ease;
        background-color: #e895b7;
        color: white;
    }

    .queue:hover {
        transition: .3s ease;
        transform: scale(1.08);
        background-color: #a2375f;
    }

    .status-indicator h4 {
        background-color: #a2375f;
        transition: .3s ease;
    }

    .queue .status-indicator h4 {
        transition: .3s ease;
    }

    .queue:hover .status-indicator h4 {
        background-color: #e895b7;
        transition: .3s ease;
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
                <h1>Registration</h1>
                <div class="welcome-section text-center p-0 my-4 d-flex flex-row justify-content-start align-items-top">
                    <img src="images/image/ornament.png" class="img-fluid" width="200" alt="Logo" style="margin-left: -30px; margin-top: -15px;" />
                    <div class="hero-text flex-fill">
                        <h2 class="fs-2 mt-2"><?php echo $_SESSION['patient_name']; ?></h2>
                        <ul class="d-flex gap-5 justify-content-start">
                            <li class="list-unstyled">Date of Birth: <?php echo $_SESSION['patient_dob']; ?></li>
                            <?php
                            $dateOfBirth = new DateTime($_SESSION['patient_dob']);
                            $today = new DateTime();
                            $age = $today->diff($dateOfBirth);
                            ?>
                            <li class="list-unstyled">Age: <?php echo $age->y . 'Y, ' . $age->m . 'M, ' . $age->d . 'D'; ?></li>
                            <li class="list-unstyled">Gender: <?php echo $_SESSION['patient_gender']; ?></li>
                            <li class="list-unstyled">No. MR: <?php echo $_SESSION['patient_id']; ?></li>
                        </ul>
                    </div>
                </div>

                <!-- Package Section -->
                <div class="row">
                    <div class="col-md-9">
                        <div class="row action-buttons text-center mt-4">

                            <div class="col-md-4 mb-3">
                                <a href="book.php" class="text-decoration-none">
                                    <div class="action-button d-flex justify-content-start gap-3 align-items-center p-3 rounded">
                                        <img src="images/image/book_appointment.png" alt="Book Appointment" />
                                        <p>Book Appointment</p>
                                    </div>
                                </a>
                            </div>


                            <div class="col-md-4 mb-3">
                                <a href="medical.php" class="text-decoration-none">
                                    <div class="action-button d-flex justify-content-start gap-3 align-items-center p-3 rounded">
                                        <img src="images/image/medical.png" alt="Medical Checkup" />
                                        <p>Medical Check-Up</p>
                                    </div>
                                </a>
                            </div>

                            <div class="col-md-4 mb-3">
                                <a href="radiology.php" class="text-decoration-none">
                                    <div class="action-button d-flex justify-content-start gap-3 align-items-center p-3 rounded">
                                        <img src="images/image/radiology.png" alt="Radiology Test" />
                                        <p>Radiology Test</p>
                                    </div>
                                </a>
                            </div>

                            <div class="col-md-4 mb-3">
                                <a href="laboratory.php" class="text-decoration-none">
                                    <div class="action-button d-flex justify-content-start gap-3 align-items-center p-3 rounded">
                                        <img src="images/image/laboratory_test.png" alt="Laboratory Test" />
                                        <p>Laboratory Test</p>
                                    </div>
                                </a>
                            </div>

                            <div class="col-md-4 mb-3">
                                <a href="inpatient.php" class="text-decoration-none">
                                    <div class="action-button d-flex justify-content-start gap-3 align-items-center p-3 rounded">
                                        <img src="images/image/inpatient.png" alt="Inpatient" />
                                        <p>Inpatient</p>
                                    </div>
                                </a>
                            </div>

                            <div class="col-md-4 mb-3">
                                <a href="emergency.php" class="text-decoration-none">
                                    <div class=" action-button d-flex justify-content-start gap-3 align-items-center p-3 rounded">
                                        <img src="images/image/emergency.png" alt="Emergency" />
                                        <p>Emergency</p>
                                    </div>
                                </a>
                            </div>

                        </div>
                    </div>

                    <!-- Upcoming Patients Section -->
                    <!-- Upcoming Patients Section -->
                    <div class="col-md-3">
                        <div class="upcoming-patients p-5">
                            <div class="d-flex justify-content-between align-items-center">
                                <h5>Upcoming Patients</h5>
                                <h6><a style="text-decoration: none; color: #a2375f" href="conf/get_appointment.php">View All</a></h6>
                            </div>
                            <?php if (count($appointments) > 0): ?>
                                <div class="d-flex flex-column align-items-center justify-content-between w-100" style="color: white;">
                                    <?php
                                    $unpaidAppointments = [];
                                    foreach ($appointments as $index => $appointment) {
                                        if ($appointment['status'] === 'Paid') {
                                            $paidAppointments[] = $appointment;
                                        } else {
                                            $unpaidAppointments[] = $appointment;
                                        }
                                    }

                                    foreach ($unpaidAppointments as $index => $appointment): ?>
                                        <a href="patientinfo.php?patient_id=<?php echo urlencode($appointment['patient_id']); ?>&queue_number=<?php echo urlencode(sprintf('A-%03d', $index + 1)); ?>" class="d-flex justify-content-between w-100 align-items-center mt-3 mb-3 rounded p-3 text-decoration-none queue">
                                            <div class="d-flex flex-column justify-content-start align-items-start">
                                                <h4 style="margin-bottom: 0px;"><?php echo htmlspecialchars($appointment['patient_id']); ?></h4>
                                                <h4 style="margin-bottom: 0px;"><?php echo htmlspecialchars($appointment['patient_name']); ?></h4>
                                                <h6 style="margin-bottom: 0px;">Handled by: <?php echo htmlspecialchars($appointment['doctor_id'] . ' - ' . $appointment['doctor_name']); ?></h6>
                                            </div>

                                            <div class="d-flex status-indicator flex-column" style="margin-left: 10px; justify-content: end; text-align: center">
                                                <?php
                                                // Generate Queue Number for unpaid appointments
                                                $queueNumber = sprintf('A-%03d', $index + 1);
                                                ?>
                                                <h5>Queue Number <?php echo count($unpaidAppointments) ?></h5>
                                                <h4 style="padding: 5px; border-radius: 10px;"><?php echo htmlspecialchars($queueNumber); ?></h4>
                                            </div>
                                        </a>
                                    <?php endforeach; ?>

                                    <?php if (count($unpaidAppointments) == 0): ?>
                                        <p class="text-center d-flex align-items-center justify-content-center" style="color: black; font-size: 20px;">No appointments found for today! Yay!</p>
                                    <?php endif; ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>