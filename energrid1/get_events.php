<?php
header('Content-Type: application/json');

// Database credentials
$host = "localhost";
$db = "EnerGrid";<?php
header('Content-Type: application/json');

$host = "localhost";
$db = "smart_building";
$user = "root";
$pass = "";

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
  echo json_encode([]);
  exit;
}

$sql = "SELECT * FROM automation_events ORDER BY time ASC";
$result = $conn->query($sql);

$events = [];

while ($row = $result->fetch_assoc()) {
  $events[] = $row;
}

echo json_encode($events);

$conn->close();
?>

$user = "root";
$pass = ""; // set your MySQL password here

// Connect to database
$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
  die(json_encode(["error" => "Connection failed: " . $conn->connect_error]));
}

// Query for automation events
$sql = "SELECT time, action, icon FROM automation_events ORDER BY time ASC";
$result = $conn->query($sql);

$events = [];

if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
    $events[] = [
      "time" => date("g:i A", strtotime($row["time"])),
      "action" => $row["action"],
      "icon" => $row["icon"]
    ];
  }
}

echo json_encode($events);
$conn->close();
?>
