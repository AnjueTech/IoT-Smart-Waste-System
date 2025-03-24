<?php
include '../includes/db_connect.php';

$sql = "SELECT temperature, humidity, distance FROM waste_data ORDER BY timestamp DESC LIMIT 1";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo json_encode($result->fetch_assoc());
} else {
    echo json_encode(["temperature" => 0, "humidity" => 0, "distance" => 0]);
}
?>
