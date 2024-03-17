<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "testdb";
$port=3308; // Change to your database name

try {
    // Get JSON data from the request
    $data = file_get_contents('php://input');
    if(empty($data)) {
        throw new Exception('Empty JSON data received.');
    }
    
    $jsonData = json_decode($data, true);
    if(json_last_error() !== JSON_ERROR_NONE) {
        throw new Exception('Invalid JSON data received: ' . json_last_error_msg());
    }
    
    // Get coordinates from the JSON data
    $coordinates = $jsonData['coordinates'] ?? [];
    if(count($coordinates) !== 2 || !is_numeric($coordinates[0]) || !is_numeric($coordinates[1])) {
        throw new Exception('Invalid or missing coordinates.');
    }

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname,$port);

    // Check connection
    if ($conn->connect_error) {
        throw new Exception("Connection failed: " . $conn->connect_error);
    }

    // Prepare SQL statement
    $stmt = $conn->prepare("INSERT INTO points (longitude, latitude) VALUES (?, ?)");
    $stmt->bind_param("dd", $longitude, $latitude);

    $longitude = $coordinates[0];
    $latitude = $coordinates[1];

    // Execute SQL statement
    if ($stmt->execute()) {
        $response = array('status' => 'success', 'message' => 'Point added successfully.');
    } else {
        throw new Exception("Error adding point: " . $conn->error);
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
} catch(Exception $e) {
    $response = array('status' => 'error', 'message' => 'Error: ' . $e->getMessage());
}

// Send JSON response
header('Content-Type: application/json');
echo json_encode($response);
?>
