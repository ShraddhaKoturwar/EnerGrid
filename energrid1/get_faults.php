<?php
header('Content-Type: application/json');
$mysqli = new mysqli("localhost", "your_user", "your_password", "your_database");

if ($mysqli->connect_error) {
  echo json_encode(["error" => "Database connection failed"]);
  exit();
}

$result = $mysqli->query("SELECT * FROM device_faults ORDER BY detected_at DESC");

$faults = [];
while ($row = $result->fetch_assoc()) {
  $faults[] = $row;
}

echo json_encode($faults);
?>
