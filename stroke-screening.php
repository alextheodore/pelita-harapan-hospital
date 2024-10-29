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
                <h1>Registration - Medical Check Up</h1>
                <div class="package-container">
                    <img src="images/mcuu.png" alt="Stroke Screening Package">

                    <div class="package-details">
                        <h2>Stroke Screening Package</h2>
                        <p><strong>Includes:</strong></p>
                        <ul>
                            <li>Consultation with a Neurologist or Neurosurgeon</li>
                            <li>Doppler Carotid Ultrasound</li>
                            <li>Laboratory examination</li>
                        </ul>
                        <p class="price">Rp. 1.399.000</p>

                        <a href="appoinmentmcu.php" class="book-now-btn">Book Now</a>
                    </div>
                </div>





            </div>
        </div>
    </div>
</body>

</html>