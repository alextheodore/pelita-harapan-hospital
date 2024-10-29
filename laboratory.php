<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Pelita Harapan Hospital - Home</title>
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
        rel="stylesheet" />
    <link rel="stylesheet" href="css/laboratory.css" />
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
                <h1>Registration - Laboratory Test</h1>

                <div class="specialist-container">
                    <div class="specialist-column">
                        <a href="" class="specialist-button">Arterial Blood Gas</a>
                        <a href="" class="specialist-button">Blood Glucose Test</a>

                    </div>
                    <div class="specialist-column">
                        <a href="" class="specialist-button">Coagulation Test</a>
                        <a href="cbc.php" class="specialist-button">Complete Blood Count</a>


                    </div>
                </div>

            </div>
        </div>
    </div>
</body>

</html>