<?php
session_start();

// Add Exception for homepage.php and home.php
// Because they are the unauthorized pages, so no need to redirect them

$currentFile = basename($_SERVER['PHP_SELF']);

if (!isset($_SESSION['user_id']) && ($currentFile !== 'homepage.php' || $currentFile !== 'home.php')) {
    header("Location: index.php");
    exit();
}
?>
