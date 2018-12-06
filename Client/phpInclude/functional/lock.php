<?php
// Steps for this, make query to database to update occupied id to current user id.
    include 'sessionValidate.php';
    $pdo = new PDO('mysql:host=localhost;dbname=4ww3', 'chaneh', 'test');
    $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    echo "ParkingID: {$_GET['parking']}";
    // Instead of deleting the parking spot, the parking information is saved and instead locked to the owner so others no longer see it.
    $sql = "Update parkings set OccupantID={$_SESSION['loginID']} where ID={$_GET['parking']} and OwnerID={$_SESSION['loginID']}";
    $stmnt = $pdo->prepare($sql);
    try {
        $stmnt->execute();
    }  catch (PDOException $e){
        echo $e->getMessage();
        echo $e->getTraceAsString();
    }
    header("Location: https://{$_SERVER['HTTP_HOST']}/management.php");
?>