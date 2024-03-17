<?php
include('dbconn.php');
session_start(); // Starting the session

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_SESSION['user_id'])) {
        $user_id = $_SESSION['user_id']; // Retrieve user ID from session

        $lon = $_POST['lon'];
        $lat = $_POST['lat'];

        // Prepare SQL statement with user_id
        $sql = "INSERT INTO truck_location (user_id, longitude, latitude) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ddd", $user_id, $lon, $lat);

        // Execute SQL statement
        if ($stmt->execute()) {
            echo "Location data stored successfully.";
        } else {
            echo "Error storing location data: " . $conn->error;
        }
    } else {
        echo "User not logged in.";
    }
} else {
    echo '<script>alert("Invalid Request");</script>';
}

$conn->close();
?>
