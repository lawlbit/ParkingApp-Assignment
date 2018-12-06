<?php
    session_start();
    session_unset();
    // echo "Logged Out Successfully!";
    header("Location: https://{$_SERVER['HTTP_HOST']}/index.php");
    exit();
?>