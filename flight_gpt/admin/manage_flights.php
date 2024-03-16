<?php
session_start();
include('/includes/db.php');
include('/includes/functions.php');
redirect_if_not_logged_in();

// Fetch all flights
$sql = "SELECT * FROM flights";
$result = mysqli_query($conn, $sql);

// Check if flights exist
if (mysqli_num_rows($result) > 0) {
    $flights = mysqli_fetch_all($result, MYSQLI_ASSOC);
} else {
    $flights = [];
}

// Close connection
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Manage Flights</title>
    <link rel="stylesheet" href="../admin/css/admin_style.css">
</head>

<body>
    <div class="container">
        <h2>Manage Flights</h2>
        <table>
            <thead>
                <tr>
                    <th>Flight Number</th>
                    <th>Airline</th>
                    <th>Origin</th>
                    <th>Destination</th>
                    <th>Departure Time</th>
                    <th>Arrival Time</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($flights as $flight) : ?>
                    <tr>
                        <td><?php echo $flight['flight_number']; ?></td>
                        <td><?php echo $flight['airline']; ?></td>
                        <td><?php echo $flight['origin']; ?></td>
                        <td><?php echo $flight['destination']; ?></td>
                        <td><?php echo $flight['departure_time']; ?></td>
                        <td><?php echo $flight['arrival_time']; ?></td>
                        <td>
                            <a href="edit_flight.php?id=<?php echo $flight['id']; ?>">Edit</a>
                            <a href="delete_flight.php?id=<?php echo $flight['id']; ?>" onclick="return confirm('Are you sure you want to delete this flight?')">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>

</html>
