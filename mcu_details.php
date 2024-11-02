<?php
if (isset($_GET['service'])) {
    // Decode the JSON object from the URL
    $serviceDetails = json_decode(urldecode($_GET['service']), true);
} else {
    $serviceDetails = null; // Set to null if no service details are provided
}
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
    <link rel="stylesheet" href="css/stroke-screening.css" />
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
                <h1 class="fw-medium">Registration > Medical Checkup > <span class="fw-bold"><?php echo $serviceDetails['name']?></span></h1>
                <div class="package-container">
                    <img src="images/mcuu.png" alt="Stroke Screening Package">

                    <div class="package-details">
                        <h2><?php echo $serviceDetails['name']?></h2>
                        <p><strong>Includes:</strong></p>
                        <ul>
                            <li><?php echo $serviceDetails['description'][0]?></li>
                            <li><?php echo $serviceDetails['description'][1]?></li>
                            <li><?php echo $serviceDetails['description'][2]?></li>
                        </ul>
                        <p class="price" style="font-size: 32px;">Rp. <?php echo number_format($serviceDetails['price'], 0, ',', '.'); ?></p>


                        <a href="appoinmentmcu.php" class="book-now-btn">Book Now</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>