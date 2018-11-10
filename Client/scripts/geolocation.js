// This script is for acquiring the location of the user via HTML5's geolocation API
// It is based on the code from  tutorial 4.
function getLocation() {
    // Check if feature is present
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition);
    } else {
        console.log("Browser doesn't support geolocation API.")
    }
}
// Set form values accordingly. This is temporary as to show that we do get the coords of user location.
function showPosition(position) {
    document.getElementById("long").value = position.coords.longitude;
    document.getElementById("lat").value = position.coords.latitude;
}
