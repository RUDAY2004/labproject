<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "metro";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch station data from the database
$sql = "SELECT station_name FROM stations_table";
$result = $conn->query($sql);

// Check if stations are retrieved successfully
if ($result->num_rows > 0) {
    // Initialize an empty array to store station data
    $stations = array();

    // Fetch station data and store it in the array
    while ($row = $result->fetch_assoc()) {
        $stations[] = $row;
    }

    // Output station data as JSON
    header('Content-Type: application/json');
    echo json_encode($stations);
} else {
    // If no stations found, return an empty JSON array
    header('Content-Type: application/json');
    echo json_encode(array());
}

// Close the result set
$result->close();

// Close connection
$conn->close();
?>
