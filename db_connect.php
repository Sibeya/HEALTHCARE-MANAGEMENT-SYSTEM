<?php
$host = "localhost"; // Change this if using a different host
$user = "root"; // Default user for phpMyAdmin
$password = ""; // Default password is empty
$dbname = "healthcare_db"; // Database name

// Create connection
$conn = new mysqli($host, $user, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
