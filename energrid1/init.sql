CREATE DATABASE IF NOT EXISTS weather_control;
USE weather_control;

CREATE TABLE settings (
    id INT AUTO_INCREMENT PRIMARY KEY,
    rule_name VARCHAR(50),
    is_active BOOLEAN,
    config JSON
);

INSERT INTO settings (rule_name, is_active, config) VALUES
('Auto Adjust HVAC', TRUE, JSON_OBJECT('temp_threshold', 28, 'ac_temp', 24)),
('Auto Adjust Lighting', TRUE, JSON_OBJECT('after_hour', 18, 'cloudy', true)),
('Auto Close Blinds', FALSE, JSON_OBJECT('lux_threshold', 500)),
('Alert on Extreme Weather', TRUE, JSON_OBJECT('low_temp', 5, 'high_temp', 40));
