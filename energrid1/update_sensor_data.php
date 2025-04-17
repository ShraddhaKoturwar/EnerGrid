<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get temperature and humidity data from POST request
    $temperature = $_POST['temperature'];
    $humidity = $_POST['humidity'];

    // Save to MySQL database
    $conn = new mysqli('localhost', 'username', 'password', 'database_name');
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "INSERT INTO sensor_data (temperature, humidity) VALUES ('$temperature', '$humidity')";
    if ($conn->query($sql) === TRUE) {
        echo "Data inserted successfully!";
    } else {
        echo "Error: " . $conn->error;
    }

    $conn->close();
}
?>
