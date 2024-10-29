<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Pelita Harapan Hospital - Home</title>
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
        rel="stylesheet" />
    <link rel="stylesheet" href="css/radiologyschedule.css" />
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
                <h1>Registration - Radiology Test - Angiography </h1>

                <div class="appointment-section">
                    <h2>Angiography</h2>
                    <div class="appointment-schedule">
                        <div class="image-section">
                            <img src="images/angio.png" alt="Angiography" />
                        </div>
                        <div class="schedule-details">
                            <h3>Schedule & Make Appointments</h3>
                            <div class="dates">
                                <label for="appointment-date">Select Date: </label>
                                <input type="date" id="appointment-date" name="appointment-date">
                            </div>
                            <div class="time-options">
                                <label><input type="radio" name="time" value="09.00 - 09.20"> 09.00 - 09.20</label><br>
                                <label><input type="radio" name="time" value="09.30 - 09.50"> 09.30 - 09.50</label><br>
                                <label><input type="radio" name="time" value="10.00 - 10.20"> 10.00 - 10.20</label><br>
                                <label><input type="radio" name="time" value="10.30 - 11.00"> 10.30 - 11.00</label><br>
                            </div>
                        </div>
                    </div>
                    <!-- Next Button -->
                    <a href="appoinmentradiology.php" class="next-btn">Next</a>
                </div>




            </div>
        </div>
    </div>
</body>

</html>