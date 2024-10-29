<?php
session_start(); // Start the session
session_unset(); // Clear all session variables
session_destroy(); // Destroy the session
unset($_SESSION['error']);
header("Location: ../index.php"); // Redirect to the login page
exit(); // Terminate the script
