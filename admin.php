<!DOCTYPE html>
<html>
<head>
    <title>Admin Map</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <script src="https://api.mapbox.com/mapbox-gl-js/v2.6.1/mapbox-gl.js"></script>
    <link href="https://api.mapbox.com/mapbox-gl-js/v2.6.1/mapbox-gl.css" rel="stylesheet" />
    <style>
        body { margin: 0; padding: 0; }
        #map { position: absolute; top: 0; bottom: 0; width: 100%; }
    </style>
</head>
<body>

<div id="map"></div>

<script>
mapboxgl.accessToken =
  "pk.eyJ1Ijoia3Jha2VuMTIzIiwiYSI6ImNsdHU1M3V3ajFhZjUya21vcGMwNG9ldDQifQ.B5h0r_S1blXJS0mJMgwYIA";
var map = new mapboxgl.Map({
  container: "map",
  style: "mapbox://styles/mapbox/streets-v11",
  center: [121.10186508, 14.68374031], // Initial coordinates
  zoom: 16, // Initial zoom level
});

    // Add click event listener to the map
    map.on('click', function(e) {
        // Display a popup at the clicked location
        new mapboxgl.Popup()
            .setLngLat(e.lngLat)
            .setHTML('<h3>Add Point</h3><p>Coordinates: ' + e.lngLat.lng + ', ' + e.lngLat.lat + '</p>')
            .addTo(map);

        // Send coordinates to server for storage
        var coordinates = e.lngLat.toArray(); // Convert coordinates to array
        savePointToDatabase(coordinates);
    });

    // Function to send coordinates to server for storage
    function savePointToDatabase(coordinates) {
        fetch('save_point.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                coordinates: coordinates
            })
        })
        .then(response => response.json())
        .then(data => console.log(data))
        .catch(error => console.error('Error:', error));
    }
</script>

</body>
</html>
