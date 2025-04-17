<?php
require_once 'config/db.php';  details

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $temperature = $_POST['temperature'];
    $humidity = $_POST['humidity'];

    
    $stmt = $pdo->prepare("INSERT INTO sensor_data (temperature, humidity) VALUES (?, ?)");
    $stmt->execute([(float)$temperature, (float)$humidity]);

    echo 'Data saved successfully!';
} else {
    echo 'Failed to receive data';
}
?>
