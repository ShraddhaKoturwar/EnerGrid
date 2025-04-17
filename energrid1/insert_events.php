<?php
header('Content-Type: application/json');

// DB connection
$host = "localhost";
$db = "EnerGrid";
$user = "root";
$pass = "";

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
  echo json_encode(["success" => false, "message" => "DB connection failed"]);
  exit;
}

// Get POST data
$room = $_POST['room'] ?? '';
$time = $_POST['time'] ?? '';
$action = $_POST['action'] ?? '';
$icon = $_POST['icon'] ?? '';

if (!$room || !$time || !$action || !$icon) {
  echo json_encode(["success" => false, "message" => "Missing required fields"]);
  exit;
}

// Insert query
$stmt = $conn->prepare("INSERT INTO automation_events (room, time, action, icon) VALUES (?, ?, ?, ?)");
$stmt->bind_param("ssss", $room, $time, $action, $icon);

if ($stmt->execute()) {
  echo json_encode(["success" => true]);
} else {
  echo json_encode(["success" => false, "message" => "Insert failed"]);
}

$stmt->close();
$conn->close();
?>
