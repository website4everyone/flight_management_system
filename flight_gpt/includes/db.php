<?php

// Database connection parameters
$servername = "localhost";
$username = "root";
$password = ""; // Get the password as a string
$database = "flight_booking_db";

// Create a new mysqli connection
$conn = mysqli_connect($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

echo "Connected successfully";

?>
