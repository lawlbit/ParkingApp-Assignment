<?php
// This script starts a session for the user and checks if they are logged in. Redirects to login if not.
    session_start();
    if (!isset($_SESSION['loginID'])){
        header("Location: http://{$_SERVER['HTTP_HOST']}/AssignmentPHP/");
    }
?>