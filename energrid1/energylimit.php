<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "EnerGrid";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Example: Insert energy limit data
    $device_name = $_POST['device_name'];
    $energy_limit = $_POST['energy_limit'];

    $sql = "INSERT INTO devices (device_name, energy_limit)
            VALUES ('$device_name', '$energy_limit')";

    if ($conn->query($sql) === TRUE) {
        echo "New device energy limit record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

