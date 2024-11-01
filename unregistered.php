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
                        <h1 style="text-align: center;">Unregistered Patient Form</h1>
                        <form action="conf/insert_patient.php" method="POST">
                            <div class="form-group">
                                <input type="text" placeholder="Name" name="name">
                            </div>
                            <div class="form-group">
                                <input type="date" name="dob">
                                <select name="gender">
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <input type="text" placeholder="Phone number" name="phone">
                                <input type="text" placeholder="BJPS Card Number (For BPJS Student)" name="bpjs_card">
                            </div>
                            <div class="form-group">
                                <input type="text" placeholder="NIK" name="nik">
                                <input type="email" placeholder="Email" name="email">
                            </div>
                            <div class="form-group">
                                <input type="text" placeholder="Address" name="address">
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