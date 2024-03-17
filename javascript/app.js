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

// Function to calculate distance between two coordinates (Haversine formula)
function calculateDistance(lon1, lat1, lon2, lat2) {
  const earthRadius = 6371; // Earth's radius in kilometers
  const dLat = ((lat2 - lat1) * Math.PI) / 180;
  const dLon = ((lon2 - lon1) * Math.PI) / 180;
  const a =
    Math.sin(dLat / 2) * Math.sin(dLat / 2) +
    Math.cos((lat1 * Math.PI) / 180) *
      Math.cos((lat2 * Math.PI) / 180) *
      Math.sin(dLon / 2) *
      Math.sin(dLon / 2);
  const c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
  const distance = earthRadius * c; // Distance in kilometers
  return distance;
}

// Function to fetch promise locations from the server
function fetchPromiseLocations() {
  return fetch("fetch_promise_locations.php")
    .then((response) => response.json())
    .catch((error) => {
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
  fetchPromiseLocations().then((promiseLocations) => {
    // Add promise location markers
    promiseLocations.forEach((location) => {
      new mapboxgl.Marker().setLngLat([location.lon, location.lat]).addTo(map);
    });
  });

  geolocate.on("geolocate", function (e) {
    var lon = e.coords.longitude;
    var lat = e.coords.latitude;
    var position = [lon, lat];
    geojson.features[0].geometry.coordinates.push(position);

    map.getSource("trace").setData(geojson);

    // Fetch promise locations from the server
    fetchPromiseLocations().then((promiseLocations) => {
      // Check distance to each promise location
      promiseLocations.forEach((location) => {
        const distance = calculateDistance(
          lon,
          lat,
          location.lon,
          location.lat
        );
        if (distance < 0.1) {
          // Example threshold: 100 meters
          // Notify user
          alert("You are close to the promise location!");
        }
      });
    });

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
