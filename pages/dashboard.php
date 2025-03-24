<?php
// Include database connection and header
include '../includes/db_connect.php';
include '../includes/header.php';

// Fetch the latest data from the waste_data table
$sql = "SELECT * FROM waste_data ORDER BY timestamp DESC LIMIT 1";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $temperature = $row["temperature"];
    $humidity = $row["humidity"];
    $distance = $row["distance"];
    $timestamp = $row["timestamp"];

    // Calculate waste level (bin height = 70 cm)
    $waste_level = ((70 - $distance) / 70) * 100;
    $waste_level = number_format($waste_level, 2); // Format to 2 decimal places
} else {
    $temperature = $humidity = $distance = $waste_level = "N/A";
    $timestamp = "No data available";
}
?>

<div class="dashboard">
    <div class="cards-container">
        <!-- Temperature Card -->
        <div class="card">
            <div class="card-header">
                <i class="fas fa-thermometer-half icon"></i>
                <h2>Temperature</h2>
            </div>
            <div class="card-body">
                <p><?php echo $temperature; ?> °C</p>
            </div>
        </div>

        <!-- Humidity Card -->
        <div class="card">
            <div class="card-header">
                <i class="fas fa-tint icon"></i>
                <h2>Humidity</h2>
            </div>
            <div class="card-body">
                <p><?php echo $humidity; ?> %</p>
            </div>
        </div>

        <!-- Distance Card -->
        <div class="card">
            <div class="card-header">
                <i class="fas fa-ruler-vertical icon"></i>
                <h2>Distance</h2>
            </div>
            <div class="card-body">
                <p><?php echo $distance; ?> cm</p>
            </div>
        </div>

        <!-- Waste Level Card -->
        <div class="card">
            <div class="card-header">
                <i class="fas fa-trash-alt icon"></i>
                <h2>Waste Level</h2>
            </div>
            <div class="card-body">
                <div class="progress-bar">
                    <div class="progress" style="width: <?php echo $waste_level; ?>%;"></div>
                </div>
                <p><?php echo $waste_level; ?> %</p>
            </div>
        </div>
    </div>

    <!-- Timestamp -->
    <div class="timestamp">
        Last Updated: <?php echo $timestamp; ?>
    </div>
</div>

<?php include '../includes/footer.php'; ?>