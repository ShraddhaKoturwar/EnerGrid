<?php
// Include database connection
include('db_connection.php');

// Fetch all devices from the database
$query = "SELECT * FROM devices";
$result = mysqli_query($conn, $query);

// Check if we have any devices
$devices = [];
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $devices[] = $row;
    }
}

// Return the devices as a JSON response
echo json_encode($devices);
?>
