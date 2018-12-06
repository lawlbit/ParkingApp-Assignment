<?php
// This script contains validation functions for checking registration submission data;
// This script is mirrored off of the validation js script.
function validateRegistration($fieldList){
    // Check if submitted values are empty first
    if (checkEmpty($fieldList)){
        if (!validateEmail($fieldList['femail'])) {
            echo "{$fieldList['femail']}";
            return false;
        }
        if (!validatePassword($fieldList['fpassword'])) {
            echo "Password INvalid {$fieldList['fpassword']}";
            return false;
        }
        if (!validateTelephone($fieldList['ftele'])) {
            echo "{$fieldList['ftele']}";
            return false;
        }
    } else {
        echo "Not empty";
        return false;
    }
    // Only return true after getting through all the checks!
    return true;
}
function checkEmpty($fields){
    return (isset($fields['fname']) && isset($fields['femail']) && isset($fields['ftele']) && isset($fields['fpassword']));
}

function validateEmail($email) {
    //Checks the email pattern, if it works return true;
    $pattern = '/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zAZ]{2,4}$/';
    return (preg_match($pattern, $email) === 1);
}

function validateTelephone($tele){
    $pattern = '/[0-9]{3}-[0-9]{3}-[0-9]{4}/';
    return (preg_match($pattern, $tele) === 1);
}

function validatePassword($pw){
    $upPat = '/[A-Z]/';
    $lowPat = '/[a-z]/';
    $numPat = '/[0-9]/';
    $minLength = 8;
    return (preg_match($upPat, $pw) && preg_match($lowPat, $pw) && preg_match($numPat, $pw) && (strlen($pw) >= $minLength));
}

?>