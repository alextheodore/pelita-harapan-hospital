<?php
include 'conf/connection.php';
$conn = getConnection();

// Get room_id from the URL and validate it
$room_id = isset($_GET['room_id']) ? $_GET['room_id'] : '';
if (empty($room_id)) {
    echo "Room ID is missing.";
    exit;
}

// Prepare SQL query to fetch room details
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

// Fetch the room details
$roomDetails = $result->fetch_assoc();

// Check if room details were found
if (!$roomDetails) {
    echo "Room not found.";
    exit;
}

$sqlStatuses = "
    SELECT d.code, d.status, d.date, d.patient_id, p.name AS patient_name
    FROM MsRoomDetails d
    LEFT JOIN MsPatient p ON d.patient_id = p.patient_id
    WHERE d.room_id = ?
";

$stmtStatuses = $conn->prepare($sqlStatuses);
$stmtStatuses->bind_param("s", $room_id);
$stmtStatuses->execute();
$resultStatuses = $stmtStatuses->get_result();

$roomsStatus = [];
while ($row = $resultStatuses->fetch_assoc()) {
    $roomsStatus[$row['code']] = [
        'status' => $row['status'],
        'date' => $row['date'],
        'patient_id' => $row['patient_id'],
        'patient_name' => $row['patient_name']
    ];
}
$stmtStatuses->close();
$conn->close();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Pelita Harapan Hospital - Booking Room</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
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

                <h1>Registration - Inpatient Room - <?php echo htmlspecialchars($roomDetails['name']); ?></h1>

                <div class="room-detail">
                    <div class="room-header">
                        <span class="room-title"><?php echo htmlspecialchars($roomDetails['name']); ?></span>
                        <span class="room-update" style="font-size: 16px;">Last Updated at: <?php echo htmlspecialchars($roomDetails['last_update']); ?></span>
                    </div>
                    <div class="room-stats">
                        <div class="total-rooms">Total <span><?php echo htmlspecialchars($roomDetails['total_count']); ?></span></div>
                        <div class="available-rooms">Available <span><?php echo htmlspecialchars($roomDetails['available_count']); ?></span></div>
                        <div class="queue">Queue <span>0</span></div>
                    </div>

                    <div class="room-table-section">
                        <table class="room-table">
                            <thead>
                                <tr>
                                    <th>Room Number</th>
                                    <th>Status</th>
                                    <th>Date</th>
                                    <th>Patient ID</th>
                                    <th>Patient Name</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                // Display the room statuses
                                foreach ($roomsStatus as $roomCode => $info) {
                                    // Disable booking link if the room is occupied
                                    $disabledClass = ($info['status'] == 'Occupied') ? 'disabled' : '';
                                    $bookButton = ($info['status'] == 'Available') ?
                                        "<button class='book-button' data-bs-toggle='modal' data-bs-target='#bookingModal' data-room-code='$roomCode'>Book</button>" :
                                        "<button class='book-button disabled'>Booked</button>";
                                ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($roomCode); ?></td>
                                        <td><?php echo htmlspecialchars($info['status']); ?></td>
                                        <td><?php echo htmlspecialchars($info['date']); ?></td>
                                        <td><?php echo htmlspecialchars($info['patient_id']); ?></td>
                                        <td><?php echo htmlspecialchars($info['patient_name']); ?></td>
                                        <td><?php echo $bookButton; ?></td>
                                    </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="bookingModal" tabindex="-1" aria-labelledby="bookingModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="bookingModalLabel">Booking Confirmation</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="bookingForm" action="conf/create_book_room.php" method="POST">
                        <input type="hidden" id="room_code" name="room_code" value="">
                        <input type="hidden" id="room_name" name="room_name" value=<?php echo $roomDetails['name']?>>
                        <div class="mb-3">
                            <label for="booking_date" class="form-label">Select Date</label>
                            <input type="date" class="form-control" id="booking_date" name="booking_date" required>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn" style="background-color: #e895b7;" id="confirmBookingButton">Confirm Booking</button>
                </div>
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Set room code in modal when booking button is clicked
        const bookingButtons = document.querySelectorAll('.book-button');
        const roomCodeInput = document.getElementById('room_code');

        bookingButtons.forEach(button => {
            button.addEventListener('click', () => {
                const roomCode = button.getAttribute('data-room-code');
                roomCodeInput.value = roomCode;
            });
        });

        // Confirm booking action
        document.getElementById('confirmBookingButton').addEventListener('click', () => {
            document.getElementById('bookingForm').submit();
        });
    </script>
</body>

</html>