<?php
    // Make sure user is logged in.
    include 'sessionValidate.php';
    require 'validatePark.php';
    $pdo = new PDO('mysql:host=localhost;dbname=4ww3', 'chaneh', 'test');
    $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if (isset($_POST['submit'])) {
        // Validating parking data.
        if (validateParkingInformation($_POST)) {
            try {
                //Using BindValue multiple times did not work. as such values for the query sent in via parameters in the execute command.
                $sql = "insert into parkings (OwnerID, Name, Description, Longitude, Latitude, Location) values (?,?,?,?,?,?)";
                $stmnt = $pdo->prepare($sql);
                $stmnt->execute([$_SESSION['loginID'], $_POST['name'], $_POST['descipt'],  $_POST['long'], $_POST['lat'], $_POST['location']]);
                // Redirect only if executed properly
                header("Location: http://{$_SERVER['HTTP_HOST']}/AssignmentPHP/management.php");
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        } else {
            header("Location: http://{$_SERVER['HTTP_HOST']}/AssignmentPHP/submission.php?error=100");
        }
        
    }
?>