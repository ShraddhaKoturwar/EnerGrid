<?php
// Simulated energy usage data (replace later with DB queries)
$todayUsage = [
    "AC" => 3.2,
    "Fridge" => 1.5,
    "Washing Machine" => 0.8,
    "Lights" => 1.2
];

$yesterdayUsage = [
    "AC" => 2.5,
    "Fridge" => 1.4,
    "Washing Machine" => 0.6,
    "Lights" => 1.0
];

$totalToday = array_sum($todayUsage);
$totalYesterday = array_sum($yesterdayUsage);
$diff = $totalToday - $totalYesterday;
$percentage = ($totalYesterday > 0) ? ($diff / $totalYesterday) * 100 : 0;
$score = 100 - min(abs($percentage), 100);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Energy Usage Report</title>
  <style>
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      margin: 0;
      padding: 0;
      background: linear-gradient(135deg, #6d4c41, #f5f5f5);
      color: #333;
      height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
      overflow: hidden;
    }
    .container {
      background: #fff;
      width: 100%;
      max-width: 700px; /* Reduced width for compactness */
      padding: 20px;
      border-radius: 15px;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
      text-align: center;
      overflow: hidden;
      transform: translateY(0);
      animation: slideUp 1s ease-out;
      box-sizing: border-box;
    }

    h1 {
      font-size: 32px;
      font-weight: 700;
      color: #3e2723;
      margin-bottom: 20px;
      letter-spacing: 1px;
    }
    h2 {
      font-size: 24px;
      font-weight: 600;
      color: #5d4037;
      margin-bottom: 10px;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin: 15px 0;
      font-size: 16px;
    }
    th, td {
      padding: 10px;
      text-align: center;
      border: 1px solid #ddd;
      border-radius: 8px;
    }
    th {
      background-color: #3e2723;
      color: #fff;
      font-weight: 600;
    }
    td {
      background-color: #f9f9f9;
      color: #5d4037;
    }

    .alert, .suggestion, .scorecard {
      margin: 15px 0;
      padding: 15px;
      border-radius: 10px;
      transition: transform 0.3s ease;
    }
    .alert {
      background: #ffebee;
      color: #d32f2f;
      border-left: 6px solid #d32f2f;
    }
    .suggestion {
      background: #e8f5e9;
      color: #388e3c;
      border-left: 6px solid #388e3c;
    }
    .scorecard {
      background: #e3f2fd;
      color: #0288d1;
      border-left: 6px solid #0288d1;
    }

    .score {
      font-size: 36px;
      font-weight: bold;
      margin-top: 10px;
    }

    .device-log-table {
      display: inline-block;
      background-color: #ffffff;
      padding: 20px;
      border-radius: 12px;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }

    .device-log-table table {
      width: 100%;
      border-collapse: collapse;
    }
    .device-log-table th, .device-log-table td {
      padding: 10px;
      text-align: center;
      font-size: 16px;
    }
    
    @keyframes slideUp {
      0% {
        transform: translateY(100px);
        opacity: 0;
      }
      100% {
        transform: translateY(0);
        opacity: 1;
      }
    }
  </style>
</head>
<body>

<div class="container">
  <h1>Daily Energy Usage Report</h1>

  <h2>Device Usage (kWh)</h2>
  <div class="device-log-table">
    <table>
      <thead>
        <tr>
          <th>Device</th>
          <th>Today</th>
          <th>Yesterday</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($todayUsage as $device => $todayValue): ?>
          <tr>
            <td><?= htmlspecialchars($device) ?></td>
            <td><?= number_format($todayValue, 2) ?></td>
            <td><?= number_format($yesterdayUsage[$device], 2) ?></td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>

  <?php if ($diff > 0): ?>
    <div class="alert">
      ⚠️ You've used <strong><?= number_format($diff, 2) ?> kWh</strong> more energy than yesterday.
    </div>
    <div class="suggestion">
      💡 Suggestion: Try reducing use of high-consumption devices like AC, or run them during off-peak hours.
    </div>
  <?php else: ?>
    <div class="suggestion">
      ✅ Great job! You saved <strong><?= number_format(abs($diff), 2) ?> kWh</strong> compared to yesterday.
    </div>
  <?php endif; ?>

  <div class="scorecard">
    <p>Performance Score</p>
    <div class="score"><?= number_format($score, 0) ?> / 100</div>
  </div>
</div>

</body>
</html>
