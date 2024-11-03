<?php
include 'conf/connection.php';
$conn = getConnection();

$room_id = isset($_GET['room_id']) ? $_GET['room_id'] : '';

$sql = "
    SELECT h.room_id, h.name, h.total, h.price, h.date, h.last_update,
           SUM(CASE WHEN d.status = 'Available' THEN 1 ELSE 0 END) AS available_count,
           SUM(CASE WHEN d.status = 'Occupied' THEN 1 ELSE 0 END) AS occupied_count,
           COUNT(d.room_id) AS total_count
    FROM MsRoomHeader h
    LEFT JOIN MsRoomDetails d ON h.room_id = d.room_id
    WHERE h.room_id = ?
    GROUP BY h.room_id
";

$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $room_id);
$stmt->execute();
$result = $stmt->get_result();
$roomDetails = $result->fetch_assoc();

$conn->close();
$roomIncludes = [];

switch ($room_id) {
    case 'RM001':
        $roomIncludes = [
            '2 unit bed',
            '2unit bedside table',
            '6 guest chair',
            '2 set of wardrobe',
            '2 LCD TV',
            '2 sofa bed',
            '2 small refrigerator',
            '2 corner table',
            '2 toilet room',
            '2 sink',
        ];
        break;
    case 'RM002':
        $roomIncludes = [
            '1 unit bed',
            '1 unit bedside table',
            '2 guest chairs',
            '1 set of wardrobe',
            '1 LCD TV',
            '1 sofa bed',
            '1 small refrigerator',
            '1 corner table',
            '1 toilet room',
            '1 sink',
        ];
        break;
    case 'RM003': // 2nd Class
        $roomIncludes = [
            '1 unit bed',
            '1 bedside table',
            '1 guest chair',
            '1 wardrobe',
            '1 small TV',
            '1 sofa bed',
            '1 toilet room',
        ];
        break;
    default:
        $roomIncludes = [];
        break;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?php echo htmlspecialchars($roomDetails['name']); ?> - Pelita Harapan Hospital</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="css/viproom.css" />
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <?php include 'sidebar.php' ?>

            <!-- Main Content -->
            <div class="col-md-10 content">
                <?php include 'topbar.php' ?>
                <h1 class="fw-medium">Registration > Inpatient Room > <span class="fw-bold"><?php echo htmlspecialchars($roomDetails['name']); ?></span></h1>
                <div class="room-detail">
                    <div class="room-header">
                        <span class="room-title"><?php echo htmlspecialchars($roomDetails['name']); ?></span>
                        <span class="room-update" style="font-size: 16px;">Last Updated at: <?php echo htmlspecialchars($roomDetails['last_update']); ?></span>
                    </div>
                    <div class="room-stats">
                        <div class="total-rooms">Total <span><?php echo htmlspecialchars($roomDetails['total_count']); ?></span></div>
                        <div class="available-rooms">Available <span><?php echo htmlspecialchars($roomDetails['available_count']); ?></span></div>
                        <div class="queue">Occupied <span><?php echo htmlspecialchars($roomDetails['occupied_count']); ?></span></div>
                    </div>
                    <div class="room-include-section">
                        <h3>Includes:</h3>
                        <ul class="room-includes">
                            <?php foreach ($roomIncludes as $include): ?>
                                <li><?php echo htmlspecialchars($include); ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                    <div class="room-images">
                        <img src="images/vip1.png" alt="VIP Room Bed" />
                        <img src="images/vip2.png" alt="VIP Room TV" />
                    </div>
                    <a href="room_book.php?room_id=<?php echo htmlspecialchars($roomDetails['room_id']); ?>" class="book-now-button">Book Now</a>
                </div>
            </div>
        </div>
    </div>
</body>

</html>