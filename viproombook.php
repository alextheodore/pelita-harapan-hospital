<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Pelita Harapan Hospital - Home</title>
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
        rel="stylesheet" />
    <link rel="stylesheet" href="css/viproombook.css" />
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
                <h1>Registration - Inpatient Room - VIP</h1>

                <div class="room-detail">
                    <div class="room-header">
                        <span class="room-title">VIP</span>
                        <span class="room-update">Update 10-09-2024 21:34:39</span>
                    </div>
                    <div class="room-stats">
                        <div class="total-rooms">Total <span>5</span></div>
                        <div class="available-rooms">Available <span>3</span></div>
                        <div class="queue">Queue <span>0</span></div>
                    </div>

                    <div class="room-table-section">
                        <table class="room-table">
                            <thead>
                                <tr>
                                    <th>Room Number</th>
                                    <th>Status</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>601</td>
                                    <td>Available</td>
                                    <td><a href="" class="book-button">Book</a></td>
                                </tr>
                                <tr>
                                    <td>602</td>
                                    <td>Occupied</td>
                                    <td><a href="#" class="book-button disabled">Book</a></td>
                                </tr>
                                <tr>
                                    <td>603</td>
                                    <td>Occupied</td>
                                    <td><a href="#" class="book-button disabled">Book</a></td>
                                </tr>
                                <tr>
                                    <td>604</td>
                                    <td>Available</td>
                                    <td><a href="" class="book-button">Book</a></td>
                                </tr>
                                <tr>
                                    <td>605</td>
                                    <td>Available</td>
                                    <td><a href="" class="book-button">Book</a></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="date-of-entry-section">
                        <h3>Date of Entry</h3>
                        <button class="date-button active">Tue, Oct 1</button>
                        <button class="date-button">Wed, Oct 2</button>
                    </div>

                    <a href="appoinmentinpatient.php" class="next-button">Next</a>
                </div>




            </div>
        </div>
    </div>
</body>

</html>