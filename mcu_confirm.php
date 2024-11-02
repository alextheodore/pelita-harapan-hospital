<?php
$details = json_decode(urldecode($_GET['details']), true);
$dateTime = new DateTime($details['date']);
$formattedTime = $dateTime->format('H:i') . ' WIB';

$formattedDate = $dateTime->format('F j, Y');
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
    <link rel="stylesheet" href="css/appoinment.css" />
</head>
<style>
    .flex-item {
        text-align: center;
        flex: 1;
        /* This will make all flex items grow equally */
        max-width: 300px;
        /* Set a maximum width for each item */
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
                <h1 class="fw-medium">Registration > Medical Checkup > <span class="fw-bold"><?php echo $details['name'] ?></span></h1>
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
                <div class="confirmation-container d-flex justify-content-center align-items-center text-center">
                    <img src="images/checkmark.jpg" alt="Confirmed">
                    <h2>Book Confirmed</h2>
                    <div class="d-flex justify-content-center flex-row align-items-center text-center p-3 gap-5">
                        <div class="flex-item" style="max-width: 300px; width: 100%; text-align: center;">
                            <h2><?php echo $details['name']; ?></h2>
                        </div>
                        <div style="width: 2px; height: 100px; background-color: black;"></div>
                        <div class="flex-item" style="max-width: 300px; width: 100%;">
                            <?php
                            $details = json_decode(urldecode($_GET['details']), true);
                            $dateTime = new DateTime($details['date']);
                            $formattedTime = $dateTime->format('H:i') . ' WIB';
                            $formattedDate = $dateTime->format('F j, Y');
                            ?>
                            <h2 style="text-align: center;"><?php echo $formattedTime; ?></h2>
                            <h3 style="text-align: center;"><?php echo $formattedDate; ?></h3>
                        </div>
                        <div style="width: 2px; height: 100px; background-color: black;"></div>
                        <div class="flex-item" style="max-width: 300px; width: 100%;">
                            <h3>Status: <br>Confirmed</h3>
                        </div>
                    </div>
                    <a href="registration.php" class="back-btn">Back</a>
                </div>
            </div>
        </div>
    </div>
</body>

</html>