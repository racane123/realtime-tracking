<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Real-Time User Tracking Map</title>
    <script src='https://api.mapbox.com/mapbox-gl-js/v2.6.1/mapbox-gl.js'></script>
    <link href='https://api.mapbox.com/mapbox-gl-js/v2.6.1/mapbox-gl.css' rel='stylesheet' />
    <style>
        #map {
            height: 100vh;
            width: 100%;
        }
    </style>
</head>

<body>
    <div id='map'></div>
    <script>
        mapboxgl.accessToken =
            "pk.eyJ1Ijoia3Jha2VuMTIzIiwiYSI6ImNsdHU1M3V3ajFhZjUya21vcGMwNG9ldDQifQ.B5h0r_S1blXJS0mJMgwYIA";
        var map = new mapboxgl.Map({
            container: "map",
            style: "mapbox://styles/mapbox/streets-v11",
            center: [121.04207, 14.75782], // Initial coordinates
            zoom: 9, // Initial zoom level
        });

        // Function to fetch user locations from the server for a specific user_id
        function fetchUserLocations(userId) {
            return fetch('fetch_user_locations.php?user_id=' + userId)
                .then(response => response.json())
                .catch(error => {
                    console.error('Error fetching user locations:', error);
                    return [];
                });
        }

        // Function to update user locations on the map
        function updateUserLocations(userId, color) {
            fetchUserLocations(userId).then(userLocations => {
                // Convert user locations to GeoJSON LineString feature
                var lineString = {
                    type: 'Feature',
                    properties: {},
                    geometry: {
                        type: 'LineString',
                        coordinates: userLocations.map(location => [parseFloat(location.longitude), parseFloat(location.latitude)])
                    }
                };

                // Update the LineString feature data on the map
                map.getSource('user-line-' + userId).setData(lineString);
            });
        }

        // Add initial user locations to the map for each user
        [1, 2, 3].forEach(userId => { // Add user IDs as needed
            fetchUserLocations(userId).then(userLocations => {
                var lineString = {
                    type: 'Feature',
                    properties: {},
                    geometry: {
                        type: 'LineString',
                        coordinates: userLocations.map(location => [parseFloat(location.longitude), parseFloat(location.latitude)])
                    }
                };

                map.on('load', function() {
                    map.addSource('user-line-' + userId, {
                        type: 'geojson',
                        data: lineString
                    });

                    map.addLayer({
                        id: 'user-line-' + userId,
                        type: 'line',
                        source: 'user-line-' + userId,
                        layout: {
                            'line-join': 'round',
                            'line-cap': 'round'
                        },
                        paint: {
                            'line-color': colorByUserId(userId), // Call function to get color based on user ID
                            'line-width': 2
                        }
                    });
                });
            });
        });

        // Function to assign color based on user ID
        function colorByUserId(userId) {
            // Assign different colors based on user ID
            switch (userId) {
                case 1:
                    return 'blue';
                case 2:
                    return 'green';
                case 3:
                    return 'red';
                    // Add more cases as needed
                default:
                    return 'gray'; // Default color
            }
        }

        // Set interval to update user locations every 30 seconds (adjust as needed)
        setInterval(function() {
            [1, 2, 3].forEach(userId => { // Add user IDs as needed
                updateUserLocations(userId, colorByUserId(userId));
            });
        }, 30000); // 30 seconds interval
    </script>
</body>

</html>