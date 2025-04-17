<?php
header('Content-Type: application/json');

$data = [
  [
    "name" => "Boiler 2",
    "health_percent" => 72,
    "anomaly_description" => "Overheating detected",
    "status" => "warning"
  ],
  [
    "name" => "Lighting Zone C",
    "health_percent" => 95,
    "note" => "Operating within normal range",
    "status" => "normal"
  ],
  [
    "name" => "HVAC Unit A1",
    "health_percent" => 90,
    "note" => "No issues",
    "status" => "normal"
  ]
];

echo json_encode($data);
?>
