<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Pelita Harapan Hospital - Home</title>
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
        rel="stylesheet" />
    <link rel="stylesheet" href="css/inpatient.css" />
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
                <h1>Registration - Inpatient Room </h1>

                <div class="room-section">
                    <div class="room vip">
                        <div class="room-header">
                            <span class="room-title">VIP</span>
                            <span class="room-update">Update 10-09-2024 21:34:39</span>
                        </div>
                        <div class="room-stats">
                            <div class="total-rooms">Total <span>5</span></div>
                            <div class="available-rooms">Available <span>3</span></div>
                            <div class="queue">Queue <span>0</span></div>
                        </div>
                        <a href="viproom.php" class="room-detail-button">Room Detail</a>
                    </div>

                    <div class="room first-class">
                        <div class="room-header">
                            <span class="room-title">1st Class</span>
                            <span class="room-update">Update 10-09-2024 21:34:39</span>
                        </div>
                        <div class="room-stats">
                            <div class="total-rooms">Total <span>10</span></div>
                            <div class="available-rooms">Available <span>8</span></div>
                            <div class="queue">Queue <span>1</span></div>
                        </div>
                        <a href="" class="room-detail-button">Room Detail</a>
                    </div>

                    <div class="room second-class">
                        <div class="room-header">
                            <span class="room-title">2nd Class</span>
                            <span class="room-update">Update 10-09-2024 21:34:39</span>
                        </div>
                        <div class="room-stats">
                            <div class="total-rooms">Total <span>15</span></div>
                            <div class="available-rooms">Available <span>3</span></div>
                            <div class="queue">Queue <span>2</span></div>
                        </div>
                        <a href="" class="room-detail-button">Room Detail</a>
                    </div>
                </div>




            </div>
        </div>
    </div>
</body>

</html>