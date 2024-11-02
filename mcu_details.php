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
    <link rel="stylesheet" href="css/doctorschedule.css" />
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
</head>

<style>
    .modal-dialog {
        max-width: 500px;
        /* Optional: Set a max width */
        margin: 1.75rem auto;
        /* Centering with auto margin */
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
                <h1 class="fw-medium">Registration > Medical Checkup > <span class="fw-bold"><?php echo $serviceDetails['name'] ?></span></h1>
                <div class="package-container">
                    <img src="images/mcuu.png" alt="Stroke Screening Package">

                    <div class="package-details">
                        <h2><?php echo $serviceDetails['name'] ?></h2>
                        <p><strong>Includes:</strong></p>
                        <ul>
                            <li><?php echo $serviceDetails['description'][0] ?></li>
                            <li><?php echo $serviceDetails['description'][1] ?></li>
                            <li><?php echo $serviceDetails['description'][2] ?></li>
                        </ul>
                        <p class="price" style="font-size: 32px;">Rp. <?php echo number_format($serviceDetails['price'], 0, ',', '.'); ?></p>
                        <div class="schedule-section">
                            <button type="button" class="btn book-now-btn" data-toggle="modal" data-target="#scheduleModal">
                                Book Now
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="scheduleModal" tabindex="-1" aria-labelledby="scheduleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="scheduleModalLabel">Select Date and Time</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span>&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="conf/create_mcu.php" method="POST">
                                <div class="dates d-flex flex-column align-items-center">
                                    <label for="mcu_date">Select Date: </label>
                                    <input type="date" id="mcu_date" name="mcu_date" required>
                                </div>

                                <div class="time-slots w-100">
                                    <table class="table">
                                        <tr>
                                            <td>09.00 - 09.20</td>
                                            <td><input type="radio" name="time_slot" value="09:00" required></td>
                                        </tr>
                                        <tr>
                                            <td>09.30 - 09.50</td>
                                            <td><input type="radio" name="time_slot" value="09:30"></td>
                                        </tr>
                                        <tr>
                                            <td>10.00 - 10.20</td>
                                            <td><input type="radio" name="time_slot" value="10:00"></td>
                                        </tr>
                                        <tr>
                                            <td>10.30 - 11.00</td>
                                            <td><input type="radio" name="time_slot" value="10:30"></td>
                                        </tr>
                                    </table>
                                </div>
                                <br>
                                <button type="submit" class="btn book-now-btn">Book Now!</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>