#include <Adafruit_Sensor.h>
#include <DHT.h>
#include <DHT_U.h>
#include <Wire.h>
#include <LiquidCrystal_I2C.h>

#define DHTPIN 7            // DHT11 sensor data pin
#define DHTTYPE DHT11       // DHT sensor type

#define MOTOR_PIN_ENA 9     // Enable pin for motor driver (PWM pin)
#define MOTOR_PIN_IN1 10    // Input pin 1 for motor driver
#define MOTOR_PIN_IN2 11    // Input pin 2 for motor driver

#define TEMPERATURE_THRESHOLD 29 
#define TEMPERATURE_THRESHOLD1 32 
#define TEMPERATURE_OFF 25   // Optional: turn off fan below this temperature

DHT dht(DHTPIN, DHTTYPE);
LiquidCrystal_I2C lcd(0x3F, 16, 2);  // Adjust I2C address if needed

void setup() {
  Serial.begin(9600);
  dht.begin();

  pinMode(MOTOR_PIN_ENA, OUTPUT);
  pinMode(MOTOR_PIN_IN1, OUTPUT);
  pinMode(MOTOR_PIN_IN2, OUTPUT);

  lcd.init();             // Initialize LCD
  lcd.backlight();        // Turn on backlight
  lcd.setCursor(0, 0);
  lcd.print("Temperature:");
}

void loop() {
  delay(2000); // Wait between readings

  float temperature = dht.readTemperature();
  if (isnan(temperature)) {
    Serial.println("Failed to read temperature from DHT sensor!");
    return;
  }

  Serial.print("Temperature: ");
  Serial.print(temperature);
  Serial.println(" °C");

  // Clear previous temperature display
  lcd.setCursor(12, 0);
  lcd.print("    ");
  lcd.setCursor(12, 0);
  lcd.print(temperature, 1); // Show 1 decimal place

  // Clear the second line before updating motor info
  lcd.setCursor(0, 1);
  lcd.print("                ");

  // Motor control logic based on temperature
  if (temperature > TEMPERATURE_THRESHOLD1) {
    analogWrite(MOTOR_PIN_ENA, 255);
    digitalWrite(MOTOR_PIN_IN1, HIGH);
    digitalWrite(MOTOR_PIN_IN2, LOW);
    lcd.setCursor(0, 1);
    lcd.print("Motor Speed: Max");
  }
  else if (temperature > TEMPERATURE_THRESHOLD) {
    analogWrite(MOTOR_PIN_ENA, 100);
    digitalWrite(MOTOR_PIN_IN1, HIGH);
    digitalWrite(MOTOR_PIN_IN2, LOW);
    lcd.setCursor(0, 1);
    lcd.print("Motor Speed: Med");
  }
  else if (temperature > TEMPERATURE_OFF) {
    analogWrite(MOTOR_PIN_ENA, 45);
    digitalWrite(MOTOR_PIN_IN1, HIGH);
    digitalWrite(MOTOR_PIN_IN2, LOW);
    lcd.setCursor(0, 1);
    lcd.print("Motor Speed: Low");
  }
  else {
    analogWrite(MOTOR_PIN_ENA, 0); // Turn off motor
    digitalWrite(MOTOR_PIN_IN1, LOW);
    digitalWrite(MOTOR_PIN_IN2, LOW);
    lcd.setCursor(0, 1);
    lcd.print("Motor: OFF       ");
  }
}
