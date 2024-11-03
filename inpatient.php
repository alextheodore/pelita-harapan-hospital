<?php
include 'conf/connection.php';
$conn = getConnection();

$sql = "
    SELECT h.room_id, h.name, h.total, h.price, h.date, h.last_update, 
           SUM(CASE WHEN d.status = 'Available' THEN 1 ELSE 0 END) AS available_count,
           SUM(CASE WHEN d.status = 'Occupied' THEN 1 ELSE 0 END) AS occupied_count,
           COUNT(d.room_id) AS total_count
    FROM MsRoomHeader h
    LEFT JOIN MsRoomDetails d ON h.room_id = d.room_id
    GROUP BY h.room_id
";

$result = $conn->query($sql);
$availableRooms = [];

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $availableRooms[] = $row;
    }
}

$_SESSION['availableRooms'] = $availableRooms;

$conn->close();
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
    <link rel="stylesheet" href="css/inpatient.css" />
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
                <h1 class="fw-medium">Registration > <span class="fw-bold">Inpatient Room</span></h1>

                <div class="room-section">
                    <?php foreach ($availableRooms as $room): ?>
                        <div class="room">
                            <div class="room-header">
                                <span class="room-title"><?php echo htmlspecialchars($room['name']); ?></span>
                                <span class="room-update" style="font-size: 16px;">Last Updated at: <?php echo htmlspecialchars($room['last_update']); ?></span>
                            </div>
                            <div class="room-stats">
                                <div class="total-rooms">Total <span><?php echo htmlspecialchars($room['total_count']); ?></span></div>
                                <div class="available-rooms">Available <span><?php echo htmlspecialchars($room['available_count']); ?></span></div>
                                <div class="queue">Occupied <span><?php echo htmlspecialchars($room['occupied_count']); ?></span></div>
                            </div>
                            <a href="room_details.php?room_id=<?php echo htmlspecialchars($room['room_id']); ?>" class="room-detail-button">Room Detail</a>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</body>

</html>