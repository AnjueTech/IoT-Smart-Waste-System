<?php
// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database connection
$host = "localhost"; // Use "localhost" if the database is on the same machine
$username = "root"; // MySQL username
$password = ""; // MySQL password (default for XAMPP is empty)
$database = "smart_waste"; // Database name

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if POST data exists
if (isset($_POST['temperature']) && isset($_POST['humidity']) && isset($_POST['distance'])) {
    // Get data from POST request
    $temperature = floatval($_POST['temperature']); // Convert to float
    $humidity = floatval($_POST['humidity']); // Convert to float
    $distance = intval($_POST['distance']); // Convert to integer

    // Insert data into waste_data table
    $sql = "INSERT INTO waste_data (temperature, humidity, distance) VALUES ($temperature, $humidity, $distance)";

    if ($conn->query($sql)) {
        echo "Data inserted successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} else {
    echo "Error: Missing POST data";
}

$conn->close();
?>