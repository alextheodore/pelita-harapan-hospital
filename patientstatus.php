<?php
if (!isset($_SESSION)) {
    session_start();
}
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
    <link rel="stylesheet" href="css/home.css" />
</head>
<style>
    .patient-info {
        background-color: #f5f5f5;
        padding: 20px;
        border-radius: 20px;
        margin-bottom: 20px;
        text-align: center;
        width: 250px;
        height: 55px;
        display: flex;
        align-items: center;
    }

    .avatar {
        width: 60px;
        height: 60px;
        background-color: #ccc;
        border-radius: 50%;
        margin-right: 15px;
    }

    .details h3 {
        margin: 0;
    }

    .details p {
        margin: 5px 0;
    }

    .gender-badge {
        background-color: #ffb6c1;
        color: white;
        padding: 3px 10px;
        border-radius: 15px;
        font-size: 14px;
        display: inline-block;
    }

    /* Patient Status Section */
    .patient-status {
        background-color: #f5f5f5;
        padding: 17px;
        border-radius: 20px;
        margin-bottom: 20px;
        text-align: center;
        width: 250px;
        height: 20px;
    }

    .patient-status p {
        margin: 0;
        font-size: 14px;
    }

    /* Menu Section */
    .menu {
        display: flex;
        flex-direction: column;
    }

    .menu-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 15px;
        background-color: #ffb6c1;
        color: white;
        border: none;
        border-radius: 5px;
        font-size: 16px;
        margin-bottom: 10px;
        cursor: pointer;
        width: 275px;
        height: 25px;
    }

    .menu-item.active {
        background-color: #ff6699;
    }

    .arrow {
        font-weight: bold;

    }

    .details-card {
        background-color: white;
        border-radius: 10px;
        padding: 20px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        width: 100%;
    }

    .patient-card .status {
        margin-top: 10px;
    }

    .patient-card img {
        width: 80px;
        border-radius: 50%;
        display: block;
        margin-bottom: 10px;
    }

    .status span {
        background-color: #e2a2a2;
        padding: 5px 10px;
        border-radius: 10px;
        color: white;
    }

    .details-card .section-title {
        font-weight: bold;
        margin-top: 15px;
        border-bottom: 2px solid #e2a2a2;
        padding-bottom: 5px;
    }

    .details-card .note {
        color: red;
        font-size: 0.9em;
        margin-bottom: 10px;
    }
</style>

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
                <h2>Patient Status</h2>
                <div class="d-flex flex-column align-items-center justify-content-between ma w-100">
                    <a href="patientinfo.php" class="d-flex justify-content-between bg-white w-100 align-items-center mt-3 mb-3 rounded p-3 text-decoration-none" style="color: inherit;">
                        <h4 style="margin-bottom: 0px;">Marchella</h4>
                        <div class="d-flex flex-column align-items-center justify-content-center">
                            <h5>Nomor Antrian</h5>
                            <h6>A - 01</h6>
                        </div>
                    </a>
                    <a href="patientinfo.php" class="d-flex justify-content-between bg-white w-100 align-items-center mt-3 mb-3 rounded p-3 text-decoration-none" style="color: inherit;">
                        <h4 style="margin-bottom: 0px;">Cecil</h4>
                        <div class="d-flex flex-column align-items-center justify-content-center">
                            <h5>Nomor Antrian</h5>
                            <h6>A - 02</h6>
                        </div>
                    </a>
                    <a href="patientinfo.php" class="d-flex justify-content-between bg-white w-100 align-items-center mt-3 mb-3 rounded p-3 text-decoration-none" style="color: inherit;">
                        <h4 style="margin-bottom: 0px;">Naftali</h4>
                        <div class="d-flex flex-column align-items-center justify-content-center">
                            <h5>Nomor Antrian</h5>
                            <h6>A - 03</h6>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</body>

</html>