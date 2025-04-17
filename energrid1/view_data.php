<?php
require_once 'config/db.php'; // make sure your DB config is correct

// Fetch latest 10 records
$stmt = $pdo->query("SELECT * FROM sensor_data ORDER BY timestamp DESC LIMIT 10");
$data = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sensor Data Log</title>
    <style>
        body { font-family: Arial, sans-serif; padding: 20px; background-color: #f0f2f5; }
        h2 { color: #333; }
        table { border-collapse: collapse; width: 100%; background: #fff; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
        th, td { padding: 10px 15px; border: 1px solid #ddd; text-align: center; }
        th { background-color: #007bff; color: white; }
    </style>
</head>
<body>

<h2>📊 Latest Sensor Readings</h2>

<table>
    <tr>
        <th>ID</th>
        <th>Temperature (°C)</th>
        <th>Humidity (%)</th>
        <th>Timestamp</th>
    </tr>
    <?php foreach ($data as $row): ?>
        <tr>
            <td><?= $row['id'] ?></td>
            <td><?= $row['temperature'] ?></td>
            <td><?= $row['humidity'] ?></td>
            <td><?= $row['timestamp'] ?></td>
        </tr>
    <?php endforeach; ?>
</table>

</body>
</html>
