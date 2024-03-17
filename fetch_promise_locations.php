<?php
// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "testdb";
$port =3308; // Change to your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname,$port);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
if ($conn->connect_error) {
    // If there's an error, return an empty array
    $promiseLocations = array();
} else {
    // Fetch promise locations from the database
    $sql = "SELECT longitude as lon, latitude as lat FROM points";
    $result = $conn->query($sql);

    $promiseLocations = array();

    if ($result->num_rows > 0) {
        // Output data of each row
        while($row = $result->fetch_assoc()) {
            $promiseLocations[] = array(
                'lon' => $row['lon'],
                'lat' => $row['lat']
            );
        }
    }
    
    // Close connection
    $conn->close();
}

// Output promise locations as JSON
header('Content-Type: application/json');
echo json_encode($promiseLocations);