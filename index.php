<!DOCTYPE html>
<html>
<head>
    <title>Truck Tracking</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://api.mapbox.com/mapbox-gl-js/v2.6.1/mapbox-gl.js"></script>
    <link href="https://api.mapbox.com/mapbox-gl-js/v2.6.1/mapbox-gl.css" rel="stylesheet">
    <style>
        #map {
            width: 100%;
            height: 400px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Truck Tracking</h1>
        <div id="map"></div>
        <button id="startTracking">Start Tracking</button>
    </div>
    <script src="javascript/app.js"></script>
</body>
</html>
