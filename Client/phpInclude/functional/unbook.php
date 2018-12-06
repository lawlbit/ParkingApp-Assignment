<?php
// Steps for this, make query to database to update occupied id to current user id.
    include 'sessionValidate.php';
    $pdo = new PDO('mysql:host=localhost;dbname=4ww3', 'chaneh', 'test');
    $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    echo "ParkingID: {$_GET['parking']}";
    // Query to database, This query makes sure that there is no one occupying the requested spot.;
    $sql = "Update parkings set OccupantID=NULL where ID={$_GET['parking']}";
    $stmnt = $pdo->prepare($sql);
    try {
        $stmnt->execute();
    }  catch (PDOException $e){
        echo $e->getMessage();
        echo $e->getTraceAsString();
    }
    $rowC = $stmnt->rowCount();
    // Go to home with news of whether or not update worked.
    if (isset($_GET['unlock'])){
        header("Location: http://{$_SERVER['HTTP_HOST']}/management.php");
    } else {
        header("Location: http://{$_SERVER['HTTP_HOST']}/home.php");
    }
?>