// map = new google.maps.Map(document.getElementById('map'));
var map;
var markerData = new Array();

// Initialize Map
function initMap() {
    var map = new google.maps.Map(document.getElementById('map'));
    // Set the destination with geolocation
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition);
    } else {
        console.log("Browser doesn't support geolocation API.");
        showPositionDefault();
    }
}
// This function is to center the map on 
function showPosition(position) {
    // currently lat and long are hardcoded in.
    var latlon = {
        lat: position.coords.latitude,
        lng: position.coords.longitude
    };
    console.log("Loading Map.");
    // Loading Map
    map = new google.maps.Map(document.getElementById('map'), {
        zoom: 15,
        center: latlon
    });
    loadMarkers();
}
function showPositionDefault(){
    var latlon = { lat: 43.255, lng: -79.93396};
    map = new google.maps.Map(document.getElementById('map'), {
        zoom: 15,
        center: latlon
    });
    loadMarkers();

}
function loadMarkers(){
    for (var i = 0; i < markerData.length; i++) {
        // Must set the content string here or else the google api function call will mark the type as undefined.
        var contentString = markerData[i].con;
        var marker = new google.maps.Marker({ position: markerData[i].pos, map: map});
        var infowindow = new google.maps.InfoWindow({
            content: contentString
        });
        google.maps.event.addListener(marker, 'click', infoCallBack(infowindow, marker));
    }
}
//This function is called to add markers to the map.
function addMarker(lat, long, content){
    var latlon = {
        lat: lat,
        lng: long
    };
    console.log(content);
    var md = {
        pos: latlon,
        con: content
    };
    // console.log(md.con);
    markerData.push(md);
}

function infoCallBack(infowindow, marker){
    return function() { infowindow.open(map, marker); }; 
}