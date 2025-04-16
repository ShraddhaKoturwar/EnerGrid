<?php
require_once 'config/db.php';

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $manualTemp = $_POST['manual_temp'] ?? 24;
    $manualBrightness = $_POST['manual_brightness'] ?? 70;
    $manualFanSpeed = $_POST['manual_fan_speed'] ?? 2;

    // Save manual overrides to database
    $stmt = $pdo->prepare("UPDATE manual_overrides SET temp = ?, brightness = ?, fan_speed = ? WHERE id = 1");
    $stmt->execute([(int)$manualTemp, (int)$manualBrightness, (int)$manualFanSpeed]);

    // Update toggle rules
    $rules = $pdo->query("SELECT * FROM settings")->fetchAll();
    foreach ($rules as $rule) {
        $ruleName = $rule['rule_name'];
        $isActive = isset($_POST['rule'][$ruleName]) ? 1 : 0;

        $stmt = $pdo->prepare("UPDATE settings SET is_active = ? WHERE rule_name = ?");
        $stmt->execute([$isActive, $ruleName]);
    }

    $message = "Changes saved!";
}

// Load values
$rules = $pdo->query("SELECT * FROM settings")->fetchAll();

// Load manual override values
$stmt = $pdo->query("SELECT temp, brightness, fan_speed FROM manual_overrides WHERE id = 1");
$overrides = $stmt->fetch();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Weather-wise Control</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body { font-family: 'Segoe UI', sans-serif; background-color: #f3f4f6; margin: 0; padding: 20px; }
        .container { max-width: 700px; margin: auto; background: white; padding: 30px; border-radius: 15px; box-shadow: 0 10px 30px rgba(0,0,0,0.1); }
        h2 { font-size: 28px; color: #333; margin-bottom: 10px; }
        .description { color: #666; margin-bottom: 20px; }
        .weather-box {
            background: linear-gradient(to right, #d0eafc, #edf6ff);
            padding: 15px 20px;
            border-radius: 10px;
            margin-bottom: 20px;
            font-weight: 500;
            color: #005b9f;
        }
        .section { margin-bottom: 30px; }
        .toggle-label {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px;
            border-bottom: 1px solid #eee;
        }
        label input[type="checkbox"] {
            margin-right: 10px;
        }
        .manual-inputs label {
            display: block;
            margin: 15px 0;
        }
        input[type="number"], select {
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 8px;
            width: 120px;
            font-size: 16px;
        }
        .forecast {
            background: #eef1f5;
            padding: 12px;
            border-radius: 10px;
            font-size: 15px;
            color: #333;
            text-align: center;
        }
        .button {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 12px 25px;
            font-size: 16px;
            border-radius: 8px;
            cursor: pointer;
            transition: background 0.3s;
        }
        .button:hover {
            background-color: #0056b3;
        }
        .message {
            color: green;
            font-weight: bold;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Weather-wise Control</h2>
    <p class="description">Automate your environment based on real-time and forecasted weather.</p>

    <div class="weather-box">
        <strong>Sunny | 28°C | Humidity: 45%</strong><br>
        Forecast: Partly Cloudy later | Wind: 10 km/h
    </div>

    <?php if (isset($message)) echo "<p class='message'>$message</p>"; ?>

    <form method="post">
        <div class="section">
            <h3>Auto-Control Rules</h3>
            <?php foreach ($rules as $rule): ?>
                <div class="toggle-label">
                    <label>
                        <input type="checkbox" name="rule[<?= $rule['rule_name'] ?>]" <?= $rule['is_active'] ? 'checked' : '' ?>>
                        <?= htmlspecialchars($rule['rule_name']) ?>
                    </label>
                    <span><?= $rule['is_active'] ? 'Active' : 'Inactive' ?></span>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="section manual-inputs">
            <h3>Manual Control Overrides</h3>
            <label>
                Temperature (°C):
                <input type="number" name="manual_temp" value="<?= $overrides['temp'] ?>" required>
            </label>
            <label>
                Brightness (%):
                <input type="number" name="manual_brightness" value="<?= $overrides['brightness'] ?>" required>
            </label>
            <label>
                Fan Speed:
                <select name="manual_fan_speed" required>
                    <option value="1" <?= $overrides['fan_speed'] == 1 ? 'selected' : '' ?>>Low</option>
                    <option value="2" <?= $overrides['fan_speed'] == 2 ? 'selected' : '' ?>>Medium</option>
                    <option value="3" <?= $overrides['fan_speed'] == 3 ? 'selected' : '' ?>>High</option>
                </select>
            </label>
        </div>

        <div class="section forecast">
            <h4>12-Hour Forecast</h4>
            <p>Cloudy with light rain expected later</p>
        </div>

        <button type="submit" class="button">Save Changes</button>
    </form>
</div>

</body>
</html>
