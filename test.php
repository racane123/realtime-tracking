<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Truck Locations</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <?php

    include 'dbconn.php';

    // Function to fetch data from the database
    function fetchData($conn) {
        $sql = 'SELECT tl.*, u.username FROM truck_location tl 
                INNER JOIN users u ON tl.user_id = u.user_id';
        $result = mysqli_query($conn, $sql);
        if ($result) {
            $data = mysqli_fetch_all($result, MYSQLI_ASSOC);
            mysqli_free_result($result);
            return $data;
        } else {
            echo "Error: " . mysqli_error($conn);
            return [];
        }
    }

    // Check if the user clicked on the view switch button
    $view = isset($_GET['view']) ? $_GET['view'] : 'table';

    // Fetch data from the database
    $data = fetchData($conn);

    // Display data in table or map view based on user's choice
    if ($view === 'table') {
        echo "<h2>Truck Locations Table View</h2>";
        echo "<table>";
        echo "<tr><th>Location ID</th><th>User ID</th><th>Username</th><th>Longitude</th><th>Latitude</th><th>Timestamp</th></tr>";
        foreach ($data as $row) {
            echo "<tr>";
            echo "<td>{$row['id']}</td>";
            echo "<td>{$row['user_id']}</td>";
            echo "<td>{$row['username']}</td>";
            echo "<td>{$row['longitude']}</td>";
            echo "<td>{$row['latitude']}</td>";
            echo "<td>{$row['timestamp']}</td>";
            echo "</tr>";
        }
        echo "</table>";
        echo "<a href='?view=map'>Switch to Map View</a>";
    } elseif ($view === 'map') {
        // Add code for displaying map view
        // Example: You can use JavaScript to render a map using the longitude and latitude data
        echo "<h2>Truck Locations Map View (Under Construction)</h2>";
        echo "<a href='?view=table'>Switch to Table View</a>";
    }

    // Close connection
    mysqli_close($conn);

    ?>
</body>
</html>
