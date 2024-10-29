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
    .top-section {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 20px;
        background-color: white;
        border-radius: 12px;
        height: 25%;
    }

    .profile-info {
        display: flex;
        align-items: center;
    }

    .profile-info img {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        margin-right: 15px;
    }

    .info {
        text-align: left;
    }

    .info h2 {
        margin: 0;
        font-size: 28px;
        font-weight: bold;
    }

    .info p {
        margin: 5px 0;
        color: #666;
        font-size: 18px;
    }

    .info .gender-badge {
        display: inline-block;
        color: white;
        background-color: #ff9999;
        padding: 5px 10px;
        border-radius: 10px;
        font-size: 16px;
        margin-top: 5px;
    }

    .status {
        text-align: center;
        font-weight: bold;
        color: green;
        font-size: 18px;
    }

    .bottom-section {
        padding: 30px;
        text-align: center;
        font-size: 18px;
        color: #333;
        background-color: white;
        border-radius: 12px;
        height: 55%;
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
    }

    .next-button {
        margin-top: 20px;
        display: inline-block;
        padding: 10px 20px;
        background-color: #f8d8e0;
        color: #d14a73;
        font-weight: bold;
        border-radius: 20px;
        text-decoration: none;
        font-size: 16px;
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
                <h1>Home</h1>

                <h2>Patient Status > Cecilia Zevanya > Patient Transaction</h2>

                <div class="top-section">
                    <div class="profile-info">
                        <img src="https://via.placeholder.com/50" alt="User Icon">
                        <div class="info">
                            <h2>Cecilia Zefanya</h2>
                            <p>No. Antrian : 00001</p>
                            <p>A-01</p>
                            <span class="gender-badge">Female</span>
                        </div>
                    </div>
                    <div class="status">
                        <p style="font-size: 30px;">Done Payment</p>
                        <img src="images/done_payment.png" width="90px" height="90px">
                    </div>
                </div>
                <br>
                <!-- Bottom section with message -->
                <div class="bottom-section">
                    <h2>Don’t forget to give smile say thank you and Get Well Soon!</h2>
                    <a href="home.php" class="next-button">Back to homepage!</a>
                </div>
            </div>
        </div>
    </div>
</body>

</html>