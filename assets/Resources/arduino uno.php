#include <SoftwareSerial.h>
#include <DHT.h>

#define DHTPIN 2          // DHT11 data pin
#define DHTTYPE DHT11     // DHT11 sensor type
#define TRIG_PIN 9        // Ultrasonic sensor trigger pin
#define ECHO_PIN 10       // Ultrasonic sensor echo pin

DHT dht(DHTPIN, DHTTYPE);
SoftwareSerial espSerial(6, 7); // RX, TX for ESP8266

void setup() {
  Serial.begin(9600);
  espSerial.begin(9600);
  dht.begin();
  pinMode(TRIG_PIN, OUTPUT);
  pinMode(ECHO_PIN, INPUT);
}

void loop() {
  // Read temperature and humidity from DHT11
  float temperature = dht.readTemperature();
  float humidity = dht.readHumidity();

  // Read distance from ultrasonic sensor
  digitalWrite(TRIG_PIN, LOW);
  delayMicroseconds(2);
  digitalWrite(TRIG_PIN, HIGH);
  delayMicroseconds(10);
  digitalWrite(TRIG_PIN, LOW);
  long duration = pulseIn(ECHO_PIN, HIGH);
  int distance = duration * 0.034 / 2; // Distance in cm

  // Prepare data to send to ESP8266
  String data = String(temperature) + "," + String(humidity) + "," + String(distance);

  // Debug: Print data to Serial Monitor
  Serial.println("Sending data to ESP8266: " + data);

  // Send data to ESP8266
  espSerial.println(data);
  delay(2000); // Wait 2 seconds before next reading
}