CREATE DATABASE smart_waste;
USE smart_waste;
CREATE TABLE waste_data (
    id INT AUTO_INCREMENT PRIMARY KEY,
    temperature FLOAT,
    humidity FLOAT,
    distance INT,
    timestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
