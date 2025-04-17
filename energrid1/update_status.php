<?php
header('Content-Type: application/json');

// Only allow PUT requests
if ($_SERVER['REQUEST_METHOD'] !== 'PUT') {
  http_response_code(405);
  echo json_encode(['error' => 'Only PUT allowed']);
  exit();
}

$input = json_decode(file_get_contents('php://input'), true);
$id = intval($input['id']);
$new_status = $input['status'] ?? 'Resolved';

$mysqli = new mysqli("localhost", "your_user", "your_password", "your_database");

if ($mysqli->connect_error) {
  echo json_encode(["error" => "Database connection failed"]);
  exit();
}

$stmt = $mysqli->prepare("UPDATE device_faults SET status=? WHERE id=?");
$stmt->bind_param("si", $new_status, $id);
$stmt->execute();

if ($stmt->affected_rows > 0) {
  echo json_encode(["status" => $new_status]);
} else {
  echo json_encode(["error" => "Update failed or already resolved"]);
}
?>
