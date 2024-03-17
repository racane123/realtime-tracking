mapboxgl.accessToken =
  "pk.eyJ1Ijoia3Jha2VuMTIzIiwiYSI6ImNsdHU1M3V3ajFhZjUya21vcGMwNG9ldDQifQ.B5h0r_S1blXJS0mJMgwYIA";
var map = new mapboxgl.Map({
  container: "map",
  style: "mapbox://styles/mapbox/streets-v11",
  center: [121.04207, 14.75782], // Initial coordinates
  zoom: 9, // Initial zoom level
});

var geojson = {
  type: "FeatureCollection",
  features: [
    {
      type: "Feature",
      geometry: {
        type: "LineString",
        coordinates: [],
      },
    },
  ],
};

// Function to fetch promise locations from the server
function fetchPromiseLocations() {
  return fetch("fetch_promise_locations.php")
    .then(response => response.json())
    .catch(error => {
      console.error("Error fetching promise locations:", error);
      return []; // Return an empty array in case of error
    });
}

map.on("load", function () {
  // Add a source and layer displaying the user's track
  map.addSource("trace", { type: "geojson", data: geojson });
  map.addLayer({
    id: "trace",
    type: "line",
    source: "trace",
    paint: {
      "line-color": "red",
      "line-width": 5,
    },
  });

  // Use GeolocateControl
  var geolocate = new mapboxgl.GeolocateControl({
    positionOptions: {
      enableHighAccuracy: true,
    },
    trackUserLocation: true,
  });
  map.addControl(geolocate);

  // Fetch promise locations from the server
  fetchPromiseLocations()
    .then(promiseLocations => {
      // Add promise location markers
      promiseLocations.forEach(location => {
        new mapboxgl.Marker()
          .setLngLat([location.lon, location.lat])
          .addTo(map);
      });
    });

  geolocate.on("geolocate", function (e) {
    var lon = e.coords.longitude;
    var lat = e.coords.latitude;
    var position = [lon, lat];
    geojson.features[0].geometry.coordinates.push(position);

    map.getSource("trace").setData(geojson);

    fetch("store_route.php", {
      method: "POST",
      headers: {
        "Content-Type": "application/x-www-form-urlencoded",
      },
      body: "lon=" + lon + "&lat=" + lat,
    })
      .then((response) => response.text())
      .then((data) => console.log(data))
      .catch((error) => console.error("Error:", error));
  });

  document.getElementById("startTracking").addEventListener("click", () => {
    // Trigger geolocation
    geolocate.trigger();

    // Check if the button text is 'Start Tracking'
    if (
      document.getElementById("startTracking").innerHTML === "Start Tracking"
    ) {
      // Change button text to 'Stop Tracking'
      document.getElementById("startTracking").innerHTML = "Stop Tracking";
    } else {
      // Change button text to 'Start Tracking'
      document.getElementById("startTracking").innerHTML = "Start Tracking";
    }
    var locationTracker = document.getElementById("startTracking").value;
  });
});

map.addControl(new mapboxgl.NavigationControl(), "top-left");
