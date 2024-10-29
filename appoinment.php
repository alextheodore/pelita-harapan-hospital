<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = ""; 
$dbname = "hospital"; 

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query to fetch data
$sql = "SELECT mr_number, patient_name, birth_date, gender, appointment_date, status FROM appointments";
$result = $conn->query($sql);
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
    <link rel="stylesheet" href="css/appoinment.css" />
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
                <h1>Registration - Book Appoinment - Specialist</h1>
                <div class="welcome-section text-center p-0 my-4 d-flex flex-row justify-content-start align-items-top">
                    <img src="images/image/ornament.png" class="img-fluid" width="200" alt="Logo" style="margin-left: -30px; margin-top: -15px;" />
                    <div class="hero-text flex-fill">
                        <h2 class="fs-2 mt-2">Neri Kwang</h2>
                        <ul class="d-flex gap-5 justify-content-start">
                            <li class="list-unstyled"> Born Date: 25-11-1970 </li>
                            <li class="list-unstyled"> Age: 54Y 9M 2D </li>
                            <li class="list-unstyled"> Gender: Female </li>
                            <li class="list-unstyled"> No. MR: 25110 </li>
                        </ul>
                    </div>
                </div>

                <div class="confirmation-container">
                    <img src="images/checkmark.jpg" alt="Confirmed">
                    <h2>Book Confirmed</h2>

                    <div class="confirmation-details">
                        <div>
                            <h3>Booking Details:</h3>
                            <span>Orthopedics</span><br>     
                            Dr. John Doe<br>
                            Orthopedics room</p>
                        </div>
                        <div>
                            <h3>Date of Entry:</h3>
                            <span>October, 1 2024</span>
                        </div>
                        <div>
                            <h3>Status:</h3>
                            <span>Confirmed</span>
                        </div>
                    </div>

                    <a href="registration.php" class="back-btn">Back</a>
                </div>

                <!-- Report Table -->
                 <h1>Reporting</h1>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                         <thead class="table-primary">
                                    <tr>
                                        <th>MR Number</th>
                                        <th>Patient Name</th>
                                        <th>Birth Date</th>
                                        <th>Gender</th>
                                        <th>Appointment Date</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                         </thead>
                        <tbody>
                <?php
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row['mr_number'] . "</td>";
                            echo "<td>" . $row['patient_name'] . "</td>";
                            echo "<td>" . $row['birth_date'] . "</td>";
                            echo "<td>" . $row['gender'] . "</td>";
                            echo "<td>" . $row['appointment_date'] . "</td>";
                            echo "<td>" . $row['status'] . "</td>";
                            echo "<td><a href='#' class='btn btn-primary btn-sm'>View</a></td>";
                            echo "</tr>";
                         }
                    }   else {
                            echo "<tr><td colspan='9'>No data found</td></tr>";
                        }
                        ?>
                    </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>

</html>