<?php

include 'dbconn.php';

// Check if user_id parameter is provided in the URL
if (isset($_GET['user_id'])) {
    $userId = $_GET['user_id'];

    // Fetch user locations from the database for the specified user_id
    $sql = "SELECT id, latitude, longitude, timestamp, user_id FROM truck_location WHERE user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $userId);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if there are any results
    if ($result) {
        $locations = array();

        // Fetch data row by row
        while ($row = $result->fetch_assoc()) {
            // Add each location to the locations array
            $locations[] = $row;
        }

        // Encode the locations array as JSON and output it
        echo json_encode($locations);
    } else {
        // Handle errors if the query fails
        echo json_encode(array('error' => 'Error fetching user locations: ' . $conn->error));
    }
} else {
    // Return error if user_id parameter is not provided
    echo json_encode(array('error' => 'User ID parameter is missing.'));
}

// Close the database connection
$stmt->close();
$conn->close();

?>
