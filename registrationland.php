<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Pelita Harapan Hospital - Home</title>
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
        rel="stylesheet" />
    <link rel="stylesheet" href="css/registrationland.css" />
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
                <h1 class="fw-medium">Registration</h1>
                <div class="welcome-section text-center p-0 my-4 d-flex flex-row justify-content-start align-items-top">
                    <img
                        src="images/image/ornament.png"
                        class="img-fluid"
                        width="200"
                        alt="Logo"
                        style="margin-left: -30px; margin-top: -15px;" />
                    <div class="hero-text flex-fill p-2">
                        <h2 class="fs-2 mt-2">Welcome, <?php echo $_SESSION['fullname'] ?>!</h2>
                        <div class="d-flex justify-content-center align-items-center">
                            <p style="font-size: 26px;">
                                Let’s check your health with us, care with your health from <br> now to
                                get more live better.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-center w-100 flex-row gap-5 align-items-center">
                    <a href="registered.php" class="custom-box w-100 p-5 rounded d-flex flex-column justify-content-center align-items-center" style="height:350px">
                        <h2 class="fs-2 mt-2">Registered Patient</h2>
                    </a>
                    <a href="unregistered.php" class="custom-box w-100 p-5 rounded d-flex flex-column justify-content-center align-items-center" style="height:350px">
                        <h2 class="fs-2 mt-2">Unregistered Patient</h2>
                    </a>
                </div>
                </a>
            </div>
        </div>
    </div>
    </div>
    </div>
    </div>
</body>

</html>