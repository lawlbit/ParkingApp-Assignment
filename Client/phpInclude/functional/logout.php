<?php
    session_start();
    session_unset();
    // echo "Logged Out Successfully!";
    header("Location: http://{$_SERVER['HTTP_HOST']}/AssignmentPHP/index.php");
    exit();
?>