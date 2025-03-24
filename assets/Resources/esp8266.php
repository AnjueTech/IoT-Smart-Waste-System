#include <ESP8266WiFi.h>
#include <ESP8266HTTPClient.h>
#include <WiFiClient.h>
#include <DHT.h>

// WiFi credentials REPLACE WITH ACTUAL ONES
const char* ssid = "wifiname";
const char* password = "wifipasword";

// Server details REPLACE WITH ACTUAL IP ADDRESS OF YOUR LAPTOP OR PC 
const char* serverUrl = "http://192.168.100.6:8080/insert_data.php"; // Include port 8080

// DHT11 Sensor
#define DHTPIN 2       // GPIO2 (D4) for DHT11 data
#define DHTTYPE DHT11  // DHT11 sensor type
DHT dht(DHTPIN, DHTTYPE);

// Ultrasonic Sensor
#define TRIG_PIN 5     // GPIO5 (D1) for ultrasonic sensor trigger
#define ECHO_PIN 4     // GPIO4 (D2) for ultrasonic sensor echo

// Function to print received data
void printReceivedData(float temperature, float humidity, int distance) {
  Serial.println("--- Received Data ---");
  Serial.println("Temperature: " + String(temperature) + " °C");
  Serial.println("Humidity: " + String(humidity) + " %");
  Serial.println("Distance: " + String(distance) + " cm");
  Serial.println("---------------------");
}

void setup() {
  Serial.begin(9600);

  // Initialize sensors
  dht.begin();
  pinMode(TRIG_PIN, OUTPUT);
  pinMode(ECHO_PIN, INPUT);

  // Connect to WiFi
  WiFi.begin(ssid, password);
  while (WiFi.status() != WL_CONNECTED) {
    delay(1000);
    Serial.println("Connecting to WiFi...");
  }
  Serial.println("Connected to WiFi");
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

  // Print the received data
  printReceivedData(temperature, humidity, distance);

  // Send data to server
  if (WiFi.status() == WL_CONNECTED) {
    WiFiClient wifiClient;
    HTTPClient http;
    http.begin(wifiClient, serverUrl); // Use the new API
    http.addHeader("Content-Type", "application/x-www-form-urlencoded");

    String postData = "temperature=" + String(temperature) +
                      "&humidity=" + String(humidity) +
                      "&distance=" + String(distance);

    Serial.println("Sending data: " + postData);

    int httpResponseCode = http.POST(postData);
    if (httpResponseCode > 0) {
      Serial.println("HTTP Response code: " + String(httpResponseCode));
      String response = http.getString();
      Serial.println("Server response: " + response);
    } else {
      Serial.println("Error sending data to server");
    }
    http.end();
  }

  delay(2000); // Wait 2 seconds before next reading
}