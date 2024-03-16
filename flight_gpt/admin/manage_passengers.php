<?php
session_start();
include('/includes/db.php');
include('/includes/functions.php');
redirect_if_not_logged_in();

// Fetch all passengers
$sql = "SELECT * FROM passengers";
$result = mysqli_query($conn, $sql);

// Check if passengers exist
if (mysqli_num_rows($result) > 0) {
    $passengers = mysqli_fetch_all($result, MYSQLI_ASSOC);
} else {
    $passengers = [];
}

// Close connection
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Manage Passengers</title>
    <link rel="stylesheet" href="../admin/css/admin_style.css">
</head>

<body>
    <div class="container">
        <h2>Manage Passengers</h2>
        <table>
            <thead>
                <tr>
                    <th>Passenger ID</th>
                    <th>Name</th>
                    <th>Passport Number</th>
                    <th>Phone Number</th>
                    <th>Email</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($passengers as $passenger) : ?>
                    <tr>
                        <td><?php echo $passenger['id']; ?></td>
                        <td><?php echo $passenger['name']; ?></td>
                        <td><?php echo $passenger['passport_number']; ?></td>
                        <td><?php echo $passenger['phone_number']; ?></td>
                        <td><?php echo $passenger['email']; ?></td>
                        <td>
                            <a href="edit_passenger.php?id=<?php echo $passenger['id']; ?>">Edit</a>
                            <a href="delete_passenger.php?id=<?php echo $passenger['id']; ?>" onclick="return confirm('Are you sure you want to delete this passenger?')">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>

</html>
