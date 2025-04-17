<?php
// Include database connection
include('db_connection.php');

// Get the data from the POST request
$device_name = $_POST['device_name'];
$energy_limit = $_POST['energy_limit'];

// Check if both fields are not empty
if (!empty($device_name) && !empty($energy_limit)) {
    // Insert data into the database
    $query = "INSERT INTO devices (device_name, energy_limit) VALUES ('$device_name', '$energy_limit')";
    
    if (mysqli_query($conn, $query)) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to insert device']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid input']);
}
?>
