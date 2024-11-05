<?php
include 'connection.php'; // Replace with your actual DB connection file
$conn = getConnection();
// Check if patient ID is set in the URL
if (isset($_GET['patient_id'])) {
    $patient_id = $_GET['patient_id'];

    // Delete patient
    $delete_sql = "DELETE FROM MsPatient WHERE patient_id = ?";
    $stmt = $conn->prepare($delete_sql);
    $stmt->bind_param("s", $patient_id);

    if ($stmt->execute()) {
        echo "Patient deleted successfully.";
        header("Location: ../reporting.php"); // Redirect to patient list page
        exit();
    } else {
        echo "Error deleting patient.";
    }
} else {
    echo "Patient ID not provided.";
}
?>
