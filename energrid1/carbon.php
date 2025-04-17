<?php
$host = 'localhost';
$user = 'root';
$pass = ''; // XAMPP default
$dbname = 'EnerGrid';

$conn = new mysqli($host, $user, $pass, $dbname);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Emissions overview
$overview = null;
$overview_result = $conn->query("SELECT * FROM emissions ORDER BY id DESC LIMIT 1");
if ($overview_result && $overview_result->num_rows > 0) {
  $overview = $overview_result->fetch_assoc();
}

// Emission sources
$sources = $conn->query("SELECT * FROM emission_sources");
if (!$sources) {
  die("Query failed for 'emission_sources': " . $conn->error);
}

// Sustainability insights
$insights = $conn->query("SELECT * FROM insights");
if (!$insights) {
  die("Query failed for 'insights': " . $conn->error);
}

// Emission trends for charts
$trendData = $conn->query("SELECT month, total_emissions FROM emissions ORDER BY id ASC");
$months = [];
$emissions = [];

while ($row = $trendData->fetch_assoc()) {
  $months[] = $row['month'];
  $emissions[] = $row['total_emissions'] / 1000; // convert kg to tons
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Carbon Footprint Tracker</title>
  <link rel="stylesheet" href="astyles.css" />
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
  <div class="container">
    <header class="header">
      <h1>Carbon Footprint Tracker</h1>
      <p>Monitor and reduce your building’s CO₂ emissions in real-time.</p>
    </header>

    <div class="grid">
      <!-- Emissions Overview -->
      <div class="card">
        <h2>Emissions Overview</h2>
        <?php if ($overview): ?>
          <p class="emission-value"><strong><?= number_format($overview['total_emissions'] / 1000, 1) ?> tons CO₂</strong></p>
          <p>Total emissions this month (<?= htmlspecialchars($overview['month']) ?>)</p>
          <div class="highlight">Goal: Reduce by <?= htmlspecialchars($overview['reduction_goal_percent']) ?>%</div>
          <div class="highlight"><?= htmlspecialchars($overview['offset_percent']) ?>% offset via green energy</div>
        <?php else: ?>
          <p>No emissions data available.</p>
        <?php endif; ?>
      </div>

      <!-- Emissions by Source -->
      <div class="card">
        <h2>Emissions by Source</h2>
        <?php if ($sources && $sources->num_rows > 0): ?>
          <?php while ($row = $sources->fetch_assoc()): ?>
            <div class="source">
              <span class="icon"><?= htmlspecialchars($row['icon']) ?></span>
              <span><?= htmlspecialchars($row['amount_kg']) ?> kg CO₂</span>
              <span><?= htmlspecialchars($row['percentage']) ?>%</span>
            </div>
          <?php endwhile; ?>
        <?php else: ?>
          <p>No source data found.</p>
        <?php endif; ?>
      </div>

      <!-- Sustainability Insights -->
      <div class="card">
        <h2>Sustainability Insights</h2>
        <ul class="insights">
          <?php if ($insights && $insights->num_rows > 0): ?>
            <?php while ($row = $insights->fetch_assoc()): ?>
              <li><?= htmlspecialchars($row['insight_text']) ?></li>
            <?php endwhile; ?>
          <?php else: ?>
            <li>No insights available.</li>
          <?php endif; ?>
        </ul>
      </div>

      <!-- Emission Trends -->
      <div class="card">
        <h2>Emission Trends</h2>
        <canvas id="lineChart" width="300" height="150"></canvas>
        <canvas id="barChart" width="300" height="100"></canvas>
      </div>
    </div>
  </div>

  <!-- Chart.js Scripts -->
  <script>
    const months = <?= json_encode($months) ?>;
    const emissions = <?= json_encode($emissions) ?>;

    const lineCtx = document.getElementById('lineChart').getContext('2d');
    new Chart(lineCtx, {
      type: 'line',
      data: {
        labels: months,
        datasets: [{
          label: 'Emissions (tons CO₂)',
          data: emissions,
          borderColor: '#36a2eb',
          backgroundColor: 'rgba(54, 162, 235, 0.2)',
          fill: true,
          tension: 0.4
        }]
      }
    });

    const barCtx = document.getElementById('barChart').getContext('2d');
    new Chart(barCtx, {
      type: 'bar',
      data: {
        labels: months,
        datasets: [{
          label: 'Emissions (tons CO₂)',
          data: emissions,
          backgroundColor: '#4caf50'
        }]
      }
    });
  </script>
</body>
</html>
