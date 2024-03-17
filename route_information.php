<?php
include('dbconn.php');

$sql = "SELECT latitude, longitude FROM truck_location ORDER BY timestamp DESC LIMIT 1";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output data of each row
    $row = $result->fetch_assoc();
    $location = array("longitude" => $row["longitude"], "latitude" => $row["latitude"]);
    echo json_encode($location);
} else {
    echo "0 results";
}
$conn->close();