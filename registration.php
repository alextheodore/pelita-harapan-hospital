
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Pelita Harapan Hospital - Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="css/registration.css" />
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
                <h1>Registration</h1>
                <div class="welcome-section text-center p-0 my-4 d-flex flex-row justify-content-start align-items-top">
                    <img src="images/image/ornament.png" class="img-fluid" width="200" alt="Logo" style="margin-left: -30px; margin-top: -15px;" />
                    <div class="hero-text flex-fill">
                        <h2 class="fs-2 mt-2">Neri Kwang</h2>
                        <ul class="d-flex gap-5 justify-content-start">
                            <li class="list-unstyled"> Born Date: 25-11-1970 </li>
                            <li class="list-unstyled"> Age: 54Y 9M 2D </li>
                            <li class="list-unstyled"> Gender: Female </li>
                            <li class="list-unstyled"> No. MR: 25110 </li>
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
                    <div class="col-md-3">
                        <div class="upcoming-patients p-5">
                            <div class="d-flex justify-content-between">
                                <h5>Upcoming Patients</h5>
                                <img src="images/image/notif.png" class="img-fluid" style="width: 60px;" alt="Logo" style="margin-left: -30px; margin-top: -15px;" />
                            </div>

                            <a href="#" class="text-secondary text-decoration-none fw-bold d-block text-end">View All</a>
                            <ul class="list-group gap-3 rounded-0">

                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <span>A2307 <br> Counter no. 5</span>
                                    <img src="images/image/registration.png" class="img-fluid" width="60" alt="Logo" />
                                </li>

                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <span>A2308 <br> Counter no. 7</span>
                                    <img src="images/image/registration.png" class="img-fluid" width="60" alt="Logo" />
                                </li>

                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <span>A2309 <br> Waiting</span>
                                    <img src="images/image/registration.png" class="img-fluid" width="60" alt="Logo" />
                                </li>

                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <span>A2310 <br> Waiting</span>
                                    <img src="images/image/registration.png" class="img-fluid" width="60" alt="Logo" />
                                </li>

                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>