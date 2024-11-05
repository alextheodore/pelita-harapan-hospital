<?php
include 'conf/connection.php'; // Replace with your actual DB connection file
$conn = getConnection();
// Check if patient ID is set in the URL
if (isset($_GET['patient_id'])) {
    $patient_id = $_GET['patient_id'];
    // Fetch patient data
    $sql = "SELECT * FROM MsPatient WHERE patient_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $patient_id);
    $stmt->execute();
    $patient = $stmt->get_result()->fetch_assoc();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Pelita Harapan Hospital - Update Patient</title>
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
                <h1 class="fw-medium">Update Patient > <span class="fw-bold">Edit Patient Data</span></h1>
                <div class="col-md-9">
                    <div class="image-container mb-4">
                        <h1 style="text-align: center;">Update Patient Form</h1>
                        <form action="conf/update_patient.php" method="POST">
                            <!-- Add hidden field to pass patient ID -->
                            <input type="hidden" name="patient_id" value="<?= htmlspecialchars($patient['patient_id']) ?>">
                            <div class="form-group">
                                <input type="text" name="name" placeholder="<?= htmlspecialchars($patient['name']) ?>">
                            </div>
                            <div class="form-group">
                                <input type="date" name="dob" value="<?= htmlspecialchars(date('Y-m-d', strtotime($patient['dob']))) ?>">
                                <select name="gender">
                                    <option value="male" <?= $patient['gender'] == 'male' ? 'selected' : '' ?>>Male</option>
                                    <option value="female" <?= $patient['gender'] == 'female' ? 'selected' : '' ?>>Female</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <input type="text" name="phone" placeholder="<?= htmlspecialchars($patient['phone']) ?>">
                                <input type="text" name="bpjs_card" placeholder="<?= htmlspecialchars($patient['bpjs_card']) ?>">
                            </div>
                            <div class="form-group">
                                <input type="text" name="nik" placeholder="<?= htmlspecialchars($patient['nik']) ?>">
                                <input type="email" name="email" placeholder="<?= htmlspecialchars($patient['email']) ?>">
                            </div>
                            <div class="form-group">
                                <input type="text" name="address" placeholder="<?= htmlspecialchars($patient['address']) ?>">
                            </div>

                            <button type="submit" class="btn" style="background-color: #a2375f; color: white;">Update Patient</button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
</body>

</html>