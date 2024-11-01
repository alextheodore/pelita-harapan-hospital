<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Pelita Harapan Hospital - Home</title>
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
        rel="stylesheet" />
    <link rel="stylesheet" href="css/registered.css" />
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
                <h1 class="fw-medium">Registration > <span class="fw-bold">Registered Patient</span></h1>
                <div class="">
                    <div class="d-flex justify-content-center align-items-center bg-light flex-column w-100
                                p-5" style="height: 450px">
                        <h1>Registered Patient Form</h1>
                        <br>
                        <form action="conf/search_patient.php" method="POST" class="d-flex justify-content-center align-items-center flex-column">
                            <div class="form-group w-100 flex justify-content-center">
                                <input type="text" name="name" placeholder="Name according to KTP" style="width: 550px;">
                            </div>
                            <div class="form-group">
                                <input type="text" name="nik" placeholder="NIK according to KTP (16 digits)" style="width: 550px;">
                            </div>
                            <?php if (isset($_SESSION['error'])) {
                                echo '<div id="errorMessage" class="alert alert-danger animate__animated animate__fadeInDown" role="alert" style="background-color: #fe4949; color: white; text-align: center; margin: 20px auto; padding: 15px; border-radius: 5px;">'
                                    . htmlspecialchars($_SESSION['error']) . '</div>';
                                unset($_SESSION['error']);
                            } ?>
                            <button type="submit">Submit</button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
</body>

</html>