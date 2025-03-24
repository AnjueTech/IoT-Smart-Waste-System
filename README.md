# IoT-Smart-Waste-System 🚀

IoT-Smart-Waste-System uses **ESP8266**, **Arduino Uno**, **DHT11**, and **Ultrasonic Sensors** to monitor bin levels and environmental data. It features real-time tracking via a web app (PHP, MySQL, JS) with Google Maps integration for remote bin location. This optimizes waste collection, cuts costs, and helps prevent pollution. 🌱

---

## Installation Guide for IoT-Smart-Waste-System

### 1. Extract the Project Files 📁
- Unzip the folder `smart_waste` and place it in the `htdocs` folder of **XAMPP**.

### 2. Import the Database 🗄️
- Open **phpMyAdmin** in your browser.
- Create a new database named `smart_waste`.
- Import the file `smart_waste.sql` located in `smartwaste/assets/Resources`.

### 3. Move the Insert Data Script 🔄
- Move `insert_data.php` to the `htdocs` folder.

### 4. Locate Arduino & ESP8266 Codes 📡
- Find the necessary code files in `smartwaste/assets/Resources`.

### 5. Update ESP8266 Code 🔧
- Open the ESP8266 code and modify the following lines:
  ```cpp
  // WiFi credentials - Change to your network details
  const char* ssid = "Your_WiFi_SSID";
  const char* password = "Your_WiFi_Password";

  // Change to your laptop/server IP where the database is installed
  const char* serverUrl = "http://Your-IP-Address:8080/insert_data.php"; // Ensure port 8080 is included

### 6. Video and Screenshots included in folder 'smartwaste/screenshots'.

### 7.For Full Project or Custom IoT Solutions
      Contact via WhatsApp:0111208991. 🚀
