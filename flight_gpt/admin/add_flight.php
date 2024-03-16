<?php
session_start();
include('includes/db.php');
include('includes/functions.php');
redirect_if_not_logged_in();

$flight_number = $airline = $origin = $destination = $departure_time = $arrival_time = "";
$flight_number_err = $airline_err = $origin_err = $destination_err = $departure_time_err = $arrival_time_err = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $flight_number = validate_input($_POST["flight_number"]);
    $airline = validate_input($_POST["airline"]);
    $origin = validate_input($_POST["origin"]);
    $destination = validate_input($_POST["destination"]);
    $departure_time = validate_input($_POST["departure_time"]);
    $arrival_time = validate_input($_POST["arrival_time"]);

    if (empty($flight_number)) {
        $flight_number_err = "Please enter the flight number.";
    }

    if (empty($airline)) {
        $airline_err = "Please enter the airline.";
    }

    if (empty($origin)) {
        $origin_err = "Please enter the origin.";
    }

    if (empty($destination)) {
        $destination_err = "Please enter the destination.";
    }

    if (empty($departure_time)) {
        $departure_time_err = "Please enter the departure time.";
    }

    if (empty($arrival_time)) {
        $arrival_time_err = "Please enter the arrival time.";
    }

    if (empty($flight_number_err) && empty($airline_err) && empty($origin_err) && empty($destination_err) && empty($departure_time_err) && empty($arrival_time_err)) {
        $sql = "INSERT INTO flights (flight_number, airline, origin, destination, departure_time, arrival_time) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "ssssss", $flight_number, $airline, $origin, $destination, $departure_time, $arrival_time);

        if (mysqli_stmt_execute($stmt)) {
            header("location: manage_flights.php");
            exit;
        } else {
            echo "Oops! Something went wrong. Please try again later.";
        }

        mysqli_stmt_close($stmt);
    }

    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Add Flight</title>
    <link rel="stylesheet" href="../admin/css/admin_style.css">
</head>

<body>
    <div class="container">
        <h2>Add Flight</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" onsubmit="return validateAddFlightForm()">
            <div class="form-group">
                <label>Flight Number</label>
                <input type="text" name="flight_number" value="<?php echo $flight_number; ?>">
                <span class="help-block"><?php echo $flight_number_err; ?></span>
            </div>
            <div class="form-group">
                <label>Airline</label>
                <input type="text" name="airline" value="<?php echo $airline; ?>">
                <span class="help-block"><?php echo $airline_err; ?></span>
            </div>
            <div class="form-group">
                <label>Origin</label>
                <input type="text" name="origin" value="<?php echo $origin; ?>">
                <span class="help-block"><?php echo $origin_err; ?></span>
            </div>
            <div class="form-group">
                <label>Destination</label>
                <input type="text" name="destination" value="<?php echo $destination; ?>">
                <span class="help-block"><?php echo $destination_err; ?></span>
            </div>
            <div class="form-group">
                <label>Departure Time</label>
                <input type="text" name="departure_time" value="<?php echo $departure_time; ?>">
                <span class="help-block"><?php echo $departure_time_err; ?></span>
            </div>
            <div class="form-group">
                <label>Arrival Time</label>
                <input type="text" name="arrival_time" value="<?php echo $arrival_time; ?>">
                <span class="help-block"><?php echo $arrival_time_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Add Flight">
            </div>
        </form>
    </div>
</body>

</html>
