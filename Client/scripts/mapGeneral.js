// map = new google.maps.Map(document.getElementById('map'));
var map;

function initMap() {
    var map = new google.maps.Map(document.getElementById('map'));
    showPosition();
}
function showPosition() {
    // currently lat and long are hardcoded in.
    var latlon = {
        lat: 43.255,
        lng: -79.93396
    };
    console.log("Loading Map.");
    // Loading Map
    map = new google.maps.Map(document.getElementById('map'), {
        zoom: 15,
        center: latlon
    });
    loadMarkers();
}
// In Assignment 3 this function will grab lat and long values from the database. Instead of just hard coding.
function loadMarkers() {
    //These are temporary.
    var locations = [
        { lat: 43.255, lng: -79.93396},
        { lat: 43.255, lng: -79.9 },
        { lat: 43.267, lng: -79.944 },
        { lat: 43.3, lng: -79.935 },
        { lat: 43.255, lng: -79.91396 }
    ]
    for (i = 0; i < locations.length; i++) {
        var marker = new google.maps.Marker({ position: locations[i], map: map });
        var infowindow = new google.maps.InfoWindow();
        google.maps.event.addListener(marker, 'click', function () {
            infowindow.setContent('<div><strong> Random Location Name </strong><br>' +
                'Description: Lorem ipsum dolor sit amet. <br>' + 
                '<a href="parking.html">More Info</a><br>');
                // the link/parking page should be live generated based on data retrieved from database.
            infowindow.open(map, this);
        });
    }
}