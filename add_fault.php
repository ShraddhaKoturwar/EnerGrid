<?php
header('Content-Type: application/json');
include 'db.php';

// SQL query to get all faults
$sql = "SELECT * FROM faults";
$result = $connection->query($sql);

if ($result->num_rows > 0) {
    $faults = [];
    while($row = $result->fetch_assoc()) {
        $faults[] = $row;
    }
    echo json_encode($faults);
} else {
    echo json_encode([]);
}

$connection->close();
?>
