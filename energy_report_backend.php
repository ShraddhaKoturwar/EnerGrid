<?php
$servername = "localhost"; // Change to your server name
$username = "root"; // Change to your database username
$password = ""; // Change to your database password
$dbname = "energy_usage_db"; // Change to your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch today's and yesterday's usage data
$sql = "SELECT device_name, today_usage, yesterday_usage FROM device_usage WHERE date = CURDATE() OR date = CURDATE() - INTERVAL 1 DAY";
$result = $conn->query($sql);

// Store the fetched data
$todayUsage = [];
$yesterdayUsage = [];

while($row = $result->fetch_assoc()) {
    if (strtotime($row['date']) === strtotime("today")) {
        $todayUsage[$row['device_name']] = $row['today_usage'];
    } else {
        $yesterdayUsage[$row['device_name']] = $row['yesterday_usage'];
    }
}

// Calculate total usage
$totalToday = array_sum($todayUsage);
$totalYesterday = array_sum($yesterdayUsage);
$diff = $totalToday - $totalYesterday;
$percentage = ($totalYesterday > 0) ? ($diff / $totalYesterday) * 100 : 0;
$score = 100 - min(abs($percentage), 100);

$conn->close();
?>
