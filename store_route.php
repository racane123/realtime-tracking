<?php

include('dbconn.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $lon = $_POST['lon'];
    $lat = $_POST['lat'];

    // Prepare SQL statement
    $sql = "INSERT INTO truck_location (longitude, latitude) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("dd", $lon, $lat);

    // Execute SQL statement
    if ($stmt->execute()) {
        echo "Location data stored successfully.";
    } else {
        echo "Error storing location data: " . $conn->error;
    }
} else {
    echo '<script>alert("Invalid Request");</script>';
    header('Location: index.php');
}

$conn->close();
