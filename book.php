<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Pelita Harapan Hospital - Home</title>
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
        rel="stylesheet" />
    <link rel="stylesheet" href="css/book.css" />
    <link rel="stylesheet" href="css/registrationland.css" />
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
                <h1 class="fw-medium">Registration > <span class="fw-bold">Book Appointment</span></h1>
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

                <div class="d-flex justify-content-center w-100 flex-row gap-5 align-items-center">
                    <a href="specialist.php" class="custom-box w-100 p-5 rounded d-flex flex-column justify-content-center align-items-center" style="height:350px">
                        <h2 class="fs-2 mt-2">Specialist</h2>
                    </a>
                    <a href="conf/get_doctors.php?specialist=General" class="custom-box w-100 p-5 rounded d-flex flex-column justify-content-center align-items-center" style="height:350px">
                        <h2 class="fs-2 mt-2">General Practicioner</h2>
                    </a>
                </div>
            </div>
        </div>
    </div>
</body>

</html>