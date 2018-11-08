// This script is for acquiring the location of the user via HTML5's geolocation API
// It is based on the code from  tutorial 4.
function getLocation() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition);
    } else {
        console.log("Browser doesn't support geolocation API.")
    }
}
// function showPosition(position) {
//     document.getElementById("demo").innerHTML = "Latitude: " + position.coords.latitude +"<br>Longitude: " + position.coords.longitude;
// }
