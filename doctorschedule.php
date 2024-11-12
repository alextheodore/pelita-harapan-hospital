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
                <h1 class="fw-medium">Registration > Book Appointment > <?php
                                                                        if ($_SESSION['specialist'] == "Specialist") {
                                                                            echo "Specialist > ";
                                                                        } else {
                                                                        }
                                                                        ?>
                    <span class="fw-bold">
                        <?php echo $_GET['specialist'] . " Practicioner" ?>
                    </span>
                </h1>
                <div class="appointment-container">
                    <div class="doctor-info">
                        <!-- <img src="images/doctors/DR001.JPG" alt="Dr. Aldo"> -->
                         
                        <?php
                        $doctorDetails = json_decode($_GET['doctor'], true);
                        $_SESSION['selectedDoctor'] = $doctorDetails;
                        
                        $doctorId = htmlspecialchars($doctorDetails['id']);
                        ?>
                        
                        <img src="images/doctors/<?php echo $doctorId; ?>.jpg" alt="Dr. <?php echo htmlspecialchars($doctorDetails['name']); ?>" width="100px" height="100px">
                        
                        <div class="doctor-details">
                            <?php
                            $doctorDetails = json_decode($_GET['doctor'], true);
                            $_SESSION['selectedDoctor'] = $doctorDetails;
                            ?>
                            <h2><?php echo $doctorDetails['id'], " | ", $doctorDetails['name'] ?></h2>
                            <p class="specialty"><?php echo  $_GET['specialist'] ?></p>
                        </div>
                    </div>
                    <div style="width: 100%; height: 2px; background-color: #E84C88; margin: 20px 0;"></div>

                    <div class="schedule-section">
                        <h3 style="color: #E84C88; font-size: 20px; text-align: center; margin-bottom: 15px">Schedule & Make Appointments</h3>

                        <form action="conf/create_appointment.php" method="POST">
                            <div class="dates d-flex flex-column align-items-center">
                                <label for="appointment-date">Select Date: </label>
                                <input type="date" id="appointment-date" name="appointment_date" min="<?php echo date('Y-m-d'); ?>">
                            </div>

                            <div class="time-slots w-100">
                                <table>
                                    <tr>
                                        <td>09.00 - 09.20</td>
                                        <td><input type="radio" name="time_slot" value="09:00"></td>
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
                            <?php if (isset($_SESSION['error'])) {
                                echo '<div id="errorMessage" class="alert alert-danger animate__animated animate__fadeInDown" role="alert" style="background-color: #fe4949; color: white; text-align: center; margin: 20px auto; padding: 15px; border-radius: 5px; width: 20%">'
                                    . htmlspecialchars($_SESSION['error']) . '</div>';
                                unset($_SESSION['error']);
                            } ?>
                            <button type="submit" class="next-btn">Next</button>
                        </form>

                    </div>



                </div>
            </div>
        </div>
</body>

</html>