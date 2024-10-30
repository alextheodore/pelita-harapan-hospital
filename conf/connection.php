<?php

function getConnection() {
    // Notes: Please change this based on your needs
    // Specifically for dbname, if you didnt have the db 'hospital', create it first into your phpmyadmin mysql
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "hospital";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection Failed: " . $conn->connect_error);
    }

    return $conn;
}
?>