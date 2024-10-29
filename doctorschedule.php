<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Pelita Harapan Hospital - Home</title>
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
        rel="stylesheet" />
    <link rel="stylesheet" href="css/doctorschedule.css" />
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
                <h1>Registration - Book Appointment - Specialist </h1>

                <div class="appointment-container">
                    <div class="doctor-info">
                        <img src="images/gambar_dokter.png" alt="Dr. Austa Mia">
                        <div class="doctor-details">
                            <h2>dr. Austa Mia, Sp.OT</h2>
                            <p class="specialty">Orthopedics</p>
                        </div>
                    </div>

                    <div class="schedule-section">
                        <h3>Schedule & Make Appointments</h3>
                        <div class="dates">
                            <?php
                            $dates = [
                                "Tue, Oct 1",
                                "Wed, Oct 2",
                                "Fri, Oct 4",
                                "Sun, Oct 6",
                                "Tue, Oct 8",
                                "Wed, Oct 9"
                            ];
                            foreach ($dates as $date) {
                                echo "<button class='date-btn'>$date</button>";
                            }
                            ?>
                        </div>

                        <div class="time-slots">
                            <table>
                                <tr>
                                    <td>09.00 - 09.20</td>
                                    <td><input type="radio" name="time" value="09:00"></td>
                                </tr>
                                <tr>
                                    <td>09.30 - 09.50</td>
                                    <td><input type="radio" name="time" value="09:30"></td>
                                </tr>
                                <tr>
                                    <td>10.00 - 10.20</td>
                                    <td><input type="radio" name="time" value="10:00"></td>
                                </tr>
                                <tr>
                                    <td>10.30 - 11.00</td>
                                    <td><input type="radio" name="time" value="10:30"></td>
                                </tr>
                            </table>
                        </div>

                        <button class="next-btn" onclick="location.href='appoinment.php'">Next</button>
                    </div>
                </div>



            </div>
        </div>
    </div>
</body>

</html>