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

    /* Date picker Section */
    .header-section {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
    }

    .date-picker form {
        display: flex;
        align-items: center;
    }

    .date-picker label {
        margin-right: 10px;
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

    .bg-pink-dark {
        background-color: #ff6699;
        /* Darker shade of pink */
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
                <!-- Title and Date Picker Section -->
                <div class="header-section">
                    <h2 class="patient-status">Patient Status</h2>
                    <div class="date-picker">
                        <form method="GET" action="conf/get_appointment.php">
                            <label for="date">Select a Date:</label>
                            <input type="date" id="date" name="date" value="<?php echo isset($_SESSION['selected_date']) ? $_SESSION['selected_date'] : date('Y-m-d'); ?>" required>
                            <button type="submit" class="btn btn-primary ms-2">Filter</button>
                        </form>
                    </div>
                </div>

                <!-- Appointments Section -->
                <div class="appointments-section mt-4">
                    <?php if (isset($_SESSION['appointments']) && count($_SESSION['appointments']) > 0): ?>
                        <div class="d-flex flex-column align-items-center justify-content-between w-100">
                            <?php
                            // Separate appointments into paid and unpaid
                            $unpaidAppointments = [];
                            $paidAppointments = [];
                            foreach ($_SESSION['appointments'] as $index => $appointment) {
                                if ($appointment['status'] === 'Paid') {
                                    $paidAppointments[] = $appointment;
                                } else {
                                    $unpaidAppointments[] = $appointment;
                                }
                            }

                            // Display unpaid appointments first
                            foreach ($unpaidAppointments as $index => $appointment): ?>
                                <a href="patientinfo.php?patient_id=<?php echo urlencode($appointment['patient_id']); ?>&queue_number=<?php echo urlencode(sprintf('A-%03d', $index + 1)); ?>" class="d-flex justify-content-between bg-white w-100 align-items-center mt-3 mb-3 rounded p-3 text-decoration-none" style="color: inherit;">
                                    <div class="d-flex flex-column justify-content-start align-items-start" style="flex: 1;">
                                        <h4 style="margin-bottom: 0px;"><?php echo htmlspecialchars($appointment['patient_id'] . ' - ' . $appointment['patient_name']); ?></h4>
                                        <h6 style="margin-bottom: 0px;">Handled by: <?php echo htmlspecialchars($appointment['doctor_id'] . ' - ' . $appointment['doctor_name']); ?></h6>
                                    </div>

                                    <div class="d-flex flex-column align-items-center justify-content-center" style="flex: 1;">
                                        <h5>Queue Number</h5>
                                        <?php
                                        // Generate Queue Number for unpaid appointments
                                        $queueNumber = sprintf('A-%03d', $index + 1);
                                        ?>
                                        <h6><?php echo htmlspecialchars($queueNumber); ?></h6>
                                    </div>

                                    <div class="d-flex status-indicator" style="flex: 1; margin-left: 10px; justify-content: end">
                                        <span class="badge bg-success p-2"><?php echo htmlspecialchars($appointment['status']); ?></span> <!-- Display status -->
                                    </div>
                                </a>
                            <?php endforeach; ?>

                            <!-- Display paid appointments last with a darker shade of pink -->
                            <?php foreach ($paidAppointments as $index => $appointment): ?>
                                <a href="patientinfo.php?patient_id=<?php echo urlencode($appointment['patient_id']); ?>&queue_number=<?php echo urlencode('—'); ?>" class="d-flex justify-content-between bg-pink-dark text-white w-100 align-items-center mt-3 mb-3 rounded p-3 text-decoration-none" style="color: inherit;">
                                    <div class="d-flex flex-column justify-content-start align-items-start" style="flex: 1;">
                                        <h4 style="margin-bottom: 0px;"><?php echo htmlspecialchars($appointment['patient_id'] . ' - ' . $appointment['patient_name']); ?></h4>
                                        <h6 style="margin-bottom: 0px;">Handled by: <?php echo htmlspecialchars($appointment['doctor_id'] . ' - ' . $appointment['doctor_name']); ?></h6>
                                    </div>

                                    <div class="d-flex flex-column align-items-center justify-content-center" style="flex: 1;">
                                        <h5>Queue Number</h5>
                                        <h6><?php echo htmlspecialchars('—'); // Show a dash for paid appointments 
                                            ?></h6>
                                    </div>

                                    <div class="d-flex status-indicator" style="flex: 1; margin-left: 10px; justify-content: end;">
                                        <span class="badge bg-success p-2"><?php echo htmlspecialchars($appointment['status']); ?></span> <!-- Display status -->
                                    </div>
                                </a>
                            <?php endforeach; ?>
                        </div>
                    <?php else: ?>
                        <p class="text-center">No appointments found for the selected date.</p>
                    <?php endif; ?>
                </div>


                <!-- <div class="d-flex flex-column align-items-center justify-content-between ma w-100">
                    <a href="patientinfo.php" class="d-flex justify-content-between bg-white w-100 align-items-center mt-3 mb-3 rounded p-3 text-decoration-none" style="color: inherit;">
                        <h4 style="margin-bottom: 0px;">Marchella</h4>
                        <div class="d-flex flex-column align-items-center justify-content-center">
                            <h5>Nomor Antrian</h5>
                            <h6>A - 01</h6>
                        </div>
                    </a>
                    <a href="patientinfo.php" class="d-flex justify-content-between bg-white w-100 align-items-center mt-3 mb-3 rounded p-3 text-decoration-none" style="color: inherit;">
                        <h4 style="margin-bottom: 0px;">Cecil</h4>
                        <div class="d-flex flex-column align-items-center justify-content-center">
                            <h5>Nomor Antrian</h5>
                            <h6>A - 02</h6>
                        </div>
                    </a>
                    <a href="patientinfo.php" class="d-flex justify-content-between bg-white w-100 align-items-center mt-3 mb-3 rounded p-3 text-decoration-none" style="color: inherit;">
                        <h4 style="margin-bottom: 0px;">Naftali</h4>
                        <div class="d-flex flex-column align-items-center justify-content-center">
                            <h5>Nomor Antrian</h5>
                            <h6>A - 03</h6>
                        </div>
                    </a>
                </div> -->
            </div>
        </div>
    </div>
</body>

</html>