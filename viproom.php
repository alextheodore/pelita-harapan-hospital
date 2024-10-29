<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Pelita Harapan Hospital - Home</title>
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
        rel="stylesheet" />
    <link rel="stylesheet" href="css/viproom.css" />
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
                <h1>Registration - Inpatient Room - VIP</h1>
                <div class="room-detail">
                    <div class="room-header">
                        <span class="room-title">VIP</span>
                        <span class="room-update">Update 10-09-2024 21:34:39</span>
                    </div>
                    <div class="room-stats">
                        <div class="total-rooms">Total <span>5</span></div>
                        <div class="available-rooms">Available <span>3</span></div>
                        <div class="queue">Queue <span>0</span></div>
                    </div>
                    <div class="room-include-section">
                        <h3>Includes:</h3>
                        <ul class="room-includes">
                            <li>1 unit bed</li>
                            <li>1 unit bedside table</li>
                            <li>1 guest chair</li>
                            <li>1 set of wardeobw</li>
                            <li>1 LCD TV</li>
                            <li>1 sofa bed</li>
                            <li>1 small refrigerator</li>
                            <li>1 corner table</li>
                            <li>1 toilet room</li>
                            <li>1 sink</li>
                        </ul>
                        <div class="room-images">
                            <img src="images/vip1.png" alt="VIP Room Bed" />
                            <img src="images/vip2.png" alt="VIP Room TV" />
                        </div>
                    </div>
                    <a href="viproombook.php" class="book-now-button">Book Now</a>
                </div>





            </div>
        </div>
    </div>
</body>

</html>