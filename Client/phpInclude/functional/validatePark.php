<?php
// This script contains the function to validate the submitted information;
// Takes post data as fields.
// $_POST['name'], $_POST['descipt'],  $_POST['long'], $_POST['lat'], $_POST['location']
function validateParkingInformation ($fields){
    $isValidLatLong = true;
    if (validateEmpty($fields)){
        // Now that we know fields are not empty.
        $isValidLatLong = validateLatLong($fields['lat'], $fields['long']);
    } else {
        return false;
    }
    return $isValidLatLong;
}

function validateEmpty($fields){
    // Return bool regarding empty fields.
    return (isset($fields['name']) && isset($fields['descipt']) && isset($fields['long']) 
    && isset($fields['lat']) && isset($fields['location']));
}


function validateLatLong($lat, $long){
    // Did a quick google search, valid range of long and lat used in this check.
    if (is_numeric($lat) && is_numeric($long)){
        return ($lat >= -90 && lat <= 90 && $long >= -180 && $long <= 180);
    } else {
        return false;
    }
}
?>