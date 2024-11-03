<?php
// Database connection
include 'conf/connection.php';
$conn = getConnection();;

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$adminList = $conn->query("SELECT admin_id, fullname, username, email FROM MsAdmin");
$patientList = $conn->query("SELECT patient_id, name, dob, gender, phone, email FROM MsPatient");
$doctorList = $conn->query("SELECT doctor_id, name, type FROM MsDoctor");

$roomList = $conn->query("
    SELECT 
        h.name AS room_type,
        d.room_id, 
        d.code AS room_code,
        d.status,
        p.name AS patient_name,
        d.date AS occupied_date
    FROM 
        MsRoomDetails d
    LEFT JOIN 
        MsRoomHeader h ON d.room_id = h.room_id
    LEFT JOIN 
        MsPatient p ON d.patient_id = p.patient_id
");
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
                <h1 class="fw-medium">Reporting</h1>
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
                    <!-- Admin List Accordion Item -->
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingOne">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                Admin List
                            </button>
                        </h2>
                        <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                <?php if ($adminList->num_rows > 0): ?>
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Full Name</th>
                                                <th>Username</th>
                                                <th>Email</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php while ($admin = $adminList->fetch_assoc()): ?>
                                                <tr>
                                                    <td><?= $admin['admin_id'] ?></td>
                                                    <td><?= $admin['fullname'] ?></td>
                                                    <td><?= $admin['username'] ?></td>
                                                    <td><?= $admin['email'] ?></td>
                                                </tr>
                                            <?php endwhile; ?>
                                        </tbody>
                                    </table>
                                <?php else: ?>
                                    <p>No admin records found.</p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>

                    <!-- Patient List Accordion Item -->
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingTwo">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                Patient List
                            </button>
                        </h2>
                        <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                <?php if ($patientList->num_rows > 0): ?>
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Name</th>
                                                <th>Date of Birth</th>
                                                <th>Gender</th>
                                                <th>Phone</th>
                                                <th>Email</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php while ($patient = $patientList->fetch_assoc()): ?>
                                                <tr>
                                                    <td><?= $patient['patient_id'] ?></td>
                                                    <td><?= $patient['name'] ?></td>
                                                    <td><?= $patient['dob'] ?></td>
                                                    <td><?= $patient['gender'] ?></td>
                                                    <td><?= $patient['phone'] ?></td>
                                                    <td><?= $patient['email'] ?></td>
                                                    <td>
                                                        <a href="patient_details.php?patient_id=<?= $patient['patient_id'] ?>" class="btn btn-primary btn-sm">More Details</a>
                                                    </td>
                                                </tr>
                                            <?php endwhile; ?>
                                        </tbody>
                                    </table>
                                <?php else: ?>
                                    <p>No patient records found.</p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>

                    <!-- Doctor List Accordion Item -->
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingThree">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                Doctor List
                            </button>
                        </h2>
                        <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                <?php if ($doctorList->num_rows > 0): ?>
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Name</th>
                                                <th>Type</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php while ($doctor = $doctorList->fetch_assoc()): ?>
                                                <tr>
                                                    <td><?= $doctor['doctor_id'] ?></td>
                                                    <td><?= $doctor['name'] ?></td>
                                                    <td><?= $doctor['type'] ?></td>
                                                </tr>
                                            <?php endwhile; ?>
                                        </tbody>
                                    </table>
                                <?php else: ?>
                                    <p>No doctor records found.</p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>

                    <!-- Room List Accordion Item -->
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingFour">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                Room List
                            </button>
                        </h2>
                        <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                <?php if ($roomList->num_rows > 0): ?>
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Room Type</th>
                                                <th>Room Code</th>
                                                <th>Status</th>
                                                <th>Occupied By</th>
                                                <th>Occupied Date</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php while ($room = $roomList->fetch_assoc()): ?>
                                                <tr>
                                                    <td><?= htmlspecialchars($room['room_type']) ?></td>
                                                    <td><?= htmlspecialchars($room['room_code']) ?></td>
                                                    <td><?= $room['status'] === 'Occupied' ? 'Occupied' : 'Available' ?></td>
                                                    <td><?= $room['status'] === 'Occupied' ? htmlspecialchars($room['patient_name']) : '-' ?></td>
                                                    <td><?= htmlspecialchars($room['occupied_date']) ?></td>
                                                </tr>
                                            <?php endwhile; ?>
                                        </tbody>
                                    </table>
                                <?php else: ?>
                                    <p>No room records found.</p>
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