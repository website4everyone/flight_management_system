<?php
session_start();
include('/includes/db.php');
include('/includes/functions.php');
redirect_if_not_logged_in();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["logout"])) {
        session_unset();
        session_destroy();
        header("Location: ../public/index.php");
        exit;
    }

    if (isset($_POST["add_flight"])) {
        // Validate and sanitize inputs
        $flight_number = validate_input($_POST["flight_number"]);
        $airline = validate_input($_POST["airline"]);
        $origin = validate_input($_POST["origin"]);
        $destination = validate_input($_POST["destination"]);
        $departure_time = $_POST["departure_time"];
        $arrival_time = $_POST["arrival_time"];

        // Insert flight into database
        $sql = "INSERT INTO flights (flight_number, airline, origin, destination, departure_time, arrival_time) VALUES ('$flight_number', '$airline', '$origin', '$destination', '$departure_time', '$arrival_time')";

        if (mysqli_query($conn, $sql)) {
            echo "Flight added successfully";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }

    if (isset($_POST["edit_flight"])) {
        // Validate and sanitize inputs
        $flight_id = $_POST["flight_id"];
        $flight_number = validate_input($_POST["flight_number"]);
        $airline = validate_input($_POST["airline"]);
        $origin = validate_input($_POST["origin"]);
        $destination = validate_input($_POST["destination"]);
        $departure_time = $_POST["departure_time"];
        $arrival_time = $_POST["arrival_time"];

        // Update flight in database
        $sql = "UPDATE flights SET flight_number='$flight_number', airline='$airline', origin='$origin', destination='$destination', departure_time='$departure_time', arrival_time='$arrival_time' WHERE id='$flight_id'";

        if (mysqli_query($conn, $sql)) {
            echo "Flight updated successfully";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }

    if (isset($_POST["delete_flight"])) {
        // Validate and sanitize inputs
        $flight_id = $_POST["flight_id"];

        // Delete flight from database
        $sql = "DELETE FROM flights WHERE id='$flight_id'";

        if (mysqli_query($conn, $sql)) {
            echo "Flight deleted successfully";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Flight Management System - Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <h1>Welcome, <?php echo $_SESSION["username"]; ?></h1>
        <form method="post">
            <button type="submit" class="btn btn-danger" name="logout">Logout</button>
        </form>

        <hr>

        <h2>Add Flight</h2>
        <form method="post">
            <div class="form-group">
                <label>Flight Number:</label>
                <input type="text" class="form-control" name="flight_number" required>
            </div>
            <div class="form-group">
                <label>Airline:</label>
                <input type="text" class="form-control" name="airline" required>
            </div>
            <div class="form-group">
                <label>Origin:</label>
                <input type="text" class="form-control" name="origin" required>
            </div>
            <div class="form-group">
                <label>Destination:</label>
                <input type="text" class="form-control" name="destination" required>
            </div>
            <div class="form-group">
                <label>Departure Time:</label>
                <input type="datetime-local" class="form-control" name="departure_time" required>
            </div>
            <div class="form-group">
                <label>Arrival Time:</label>
                <input type="datetime-local" class="form-control" name="arrival_time" required>
            </div>
            <button type="submit" class="btn btn-primary" name="add_flight">Add Flight</button>
        </form>

        <hr>

        <!-- Other sections such as editing/deleting flights, managing passengers can be added here -->

    </div>
</body>

</html>
