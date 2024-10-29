<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Pelita Harapan Hospital - Home</title>
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
        rel="stylesheet" />
    <link rel="stylesheet" href="css/book.css" />
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
                <h1>Registration - Book Appointment</h1>
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

                <!-- Package Section -->
                <div class="container overflow-hidden text-center">
                    <div class="row">
                        <div class="col-md-9">
                            <div class="image-container text-center mb-4">
                                <h2 class="fs-2 mt-2">Specialist</h2>
                                <div class="container-login100-form-btn">
                                    <a href="specialist.php">
                                        <button class="login100-form-btn">
                                            click here
                                        </button>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-9">
                            <div class="image-container text-center mb-4">
                                <h2 class="fs-2 mt-2">General Practicioner</h2>
                                <div class="container-login100-form-btn">
                                    <a href="practicioner.php">
                                        <button class="login100-form-btn">
                                            click here
                                        </button>
                                    </a>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>