<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Pelita Harapan Hospital - Home</title>
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
        rel="stylesheet" />
    <link rel="stylesheet" href="css/specialist.css" />
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
                <h1>Registration - Book Appointment - Specialist</h1>

                <div class="specialist-container">
                    <div class="specialist-column">
                        <a href="acupuncture.php" class="specialist-button">Acupuncture</a>
                        <a href="dermatology.php" class="specialist-button">Dermatology</a>

                    </div>
                    <div class="specialist-column">
                        <a href="neurology.php" class="specialist-button">Neurology</a>
                        <a href="orthopedics.php" class="specialist-button">Orthopedics</a>


                    </div>
                </div>

            </div>
        </div>
    </div>
</body>

</html>