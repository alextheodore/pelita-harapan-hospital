<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Pelita Harapan Hospital - Home</title>
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
        rel="stylesheet" />
    <link rel="stylesheet" href="css/medical.css" />
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
                <h1>Registration - Medical Check Up</h1>
                <div class="container">
                    <a href="">
                        <div class="card">
                            <img src="images/breast.png" alt="Breast Screening Package">
                            <h3>Breast Screening Package</h3>
                        </div>
                    </a>

                    <a href="">
                        <div class="card">
                            <img src="images/heart.png" alt="Heart Screening Package">
                            <h3>Heart Screening Package</h3>
                        </div>
                    </a>

                    <a href="stroke-screening.php">
                        <div class="card">
                            <img src="images/stroke.png" alt="Stroke Screening Package">
                            <h3>Stroke Screening Package</h3>
                        </div>
                    </a>

                    <a href="">
                        <div class="card">
                            <img src="images/mcu.png" alt="MCU Comprehensive Package">
                            <h3>MCU Comprehensive Package</h3>
                        </div>
                    </a>

                    <a href="">
                        <div class="card">
                            <img src="images/cervix.png" alt="Cervix Cancer Screening Package">
                            <h3>Cervix Cancer Screening Package</h3>
                        </div>
                    </a>

                    <a href="">
                        <div class="card">
                            <img src="images/gastro.png" alt="Gastrointestinal Screening Package">
                            <h3>Gastrointestinal Screening Package</h3>
                        </div>
                    </a>
                </div>




            </div>
        </div>
    </div>
</body>

</html>