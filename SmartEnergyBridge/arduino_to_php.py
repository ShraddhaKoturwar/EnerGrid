import serial
import time
import requests

# Connect to Arduino on the correct COM port (change COM3 to yours)
arduino = serial.Serial('COM3', 9600, timeout=1)
time.sleep(2)  # wait for Arduino to reset

while True:
    try:
        line = arduino.readline().decode('utf-8').strip()
        if line:
            print("Raw data from Arduino:", line)
            if "Temperature" in line and "Humidity" in line:
                parts = line.replace("°C", "").replace("%", "").split('|')
                temp = float(parts[0].split(':')[1].strip())
                hum = float(parts[1].split(':')[1].strip())

                # Send to PHP server
                response = requests.post("http://localhost/weather/receive_data.php", data={
                    'temperature': temp,
                    'humidity': hum
                })

                print("Server response:", response.text)
        time.sleep(2)
    except KeyboardInterrupt:
        print("Stopped by user")
        break
    except Exception as e:
        print("Error:", e)
