<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Voice & Chat Control</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .card {
            background: white;
            padding: 20px 30px;
            border-radius: 12px;
            box-shadow: 0 0 15px rgba(0,0,0,0.2);
            width: 320px;
        }
        .card h2 {
            margin-top: 0;
            font-size: 20px;
        }
        .dropdown, .input {
            width: 100%;
            padding: 10px;
            margin-top: 10px;
            border-radius: 6px;
            border: 1px solid #ccc;
        }
        .toggle-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 15px;
        }
        .message-box {
            margin-top: 20px;
            display: flex;
            align-items: center;
            border: 1px solid #ccc;
            border-radius: 6px;
            padding: 10px;
            background: #000;
            color: #fff;
        }
        .message-box input {
            flex: 1;
            background: transparent;
            border: none;
            color: #fff;
            outline: none;
        }
        .message-box button {
            background: transparent;
            border: none;
            cursor: pointer;
            color: #fff;
        }
    </style>
</head>
<body>
    <div class="card">
        <h2>Voice & Chat Control</h2>

        <label for="microphone">Microphone</label>
        <select class="dropdown" id="microphone" name="microphone">
            <option value="push">🎤 Push-to-talk</option>
            <option value="always">🎤 Always-on</option>
        </select>

        <p>Try saying “Show energy report”</p>

        <div class="toggle-container">
            <span>Chat Assistant</span>
            <input type="checkbox" checked>
        </div>

        <div class="toggle-container">
            <span>Text to Speech</span>
            <input type="checkbox" checked>
        </div>

        <label for="language">Voice Language</label>
        <select class="dropdown" id="language" name="language">
            <option value="en">English</option>
            <option value="es">Spanish</option>
            <option value="fr">French</option>
        </select>

        <div class="message-box">
            <input type="text" placeholder="Type a message..." />
            <button><span>🎤</span></button>
        </div>
    </div>
</body>
</html>