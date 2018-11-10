// map = new google.maps.Map(document.getElementById('map'));
var map;

function initMap() {
    var map = new google.maps.Map(document.getElementById('map'));
    showPosition();
}
function showPosition() {
    // currently lat and long are hardcoded in.
    var latlon =  {
        lat: 43.255, 
        lng: -79.93396
    };
    console.log("Loading Map.");
    map = new google.maps.Map(document.getElementById('map'), { 
        zoom: 15, 
        center: latlon
    });
    var marker = new google.maps.Marker({ position: latlon, map: map });
}