<?php
    include 'sessionValidate.php';
    $pdo = new PDO('mysql:host=localhost;dbname=4ww3', 'chaneh', 'test');
    $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // This is for sanity to make sure the information is there to form query.
    if (isset($_POST['submit'])){
        $sql = "Insert into reviews (ReviewerID, P_id, Rating, Description) values (?,?,?,?);";
        $stmnt= $pdo->prepare($sql);
        try {
            $stmnt->execute([$_SESSION['loginID'], $_POST['pid'],$_POST['rating'],$_POST['review']]);
        } catch (PDOException $e) {
            echo $e->getMessage();
            echo $e->getTraceAsString();
        }
        header("Location: https://{$_SERVER['HTTP_HOST']}/parking.php?parking={$_POST['pid']}");
    } else {
        header("Location: https://{$_SERVER['HTTP_HOST']}/home.php");
    }
?>