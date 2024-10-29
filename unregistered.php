<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Pelita Harapan Hospital - Home</title>
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
        rel="stylesheet" />
    <link rel="stylesheet" href="css/unregistered.css" />
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
                <h1>Registration - Unregistered Patient</h1>
                <div class="col-md-9">
                    <div class="image-container mb-4">
                        <form action="registration.php" method="POST">
                            <div class="form-group">
                                <input type="text" placeholder="Name">
                            </div>
                            <div class="form-group">
                                <input type="date">
                                <input type="text" placeholder="Gender">
                            </div>
                            <div class="form-group">
                                <input type="text" placeholder="Phone number">
                                <input type="text" placeholder="Phone number 2">
                            </div>
                            <div class="form-group">
                                <input type="text" placeholder="NIK">
                                <input type="email" placeholder="Email">
                            </div>
                            <div class="form-group">
                                <input type="text" placeholder="Address">
                            </div>

                            <button type="submit">Submit</button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
</body>

</html>