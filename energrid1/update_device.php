<?php
// update_device.php
header('Content-Type: application/json');

// Get POST data
$device_id = isset($_POST['id']) ? $_POST['id'] : 0;
$energy_limit = isset($_POST['energy_limit']) ? $_POST['energy_limit'] : 0;

if ($device_id && $energy_limit > 0) {
    // Database connection
    $host = 'localhost'; // your host
    $dbname = 'EnerGrid'; // your database name
    $username = 'root'; // your username
    $password = ''; // your password

    try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Prepare and execute update statement
        $stmt = $pdo->prepare("UPDATE devices SET energy_limit = ? WHERE id = ?");
        $stmt->execute([$energy_limit, $device_id]);

        echo json_encode(['success' => 'Device updated successfully']);
    } catch (PDOException $e) {
        echo json_encode(['error' => $e->getMessage()]);
    }
} else {
    echo json_encode(['error' => 'Invalid input data']);
}
?>
