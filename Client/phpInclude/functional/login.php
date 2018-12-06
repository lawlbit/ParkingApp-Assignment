<?php
// This PHP script is for login validation
session_start();
$pdo = new PDO('mysql:host=localhost;dbname=4ww3', 'chaneh', 'test');
// This is for enabling the sql injection avoidance via prepared statments
$pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if (isset($_POST['email'])){
    
    // The main sql query
    $sql = "Select * from users where Email=:email and Passwordhash=SHA2(CONCAT(:password, Salt), 0 )";
    $stmnt = $pdo->prepare($sql);
    // Just incase it doesnt work...
    try {
        $stmnt->execute([$_POST['email'], $_POST['password']]);
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
    $rows = $stmnt->fetchAll();

    //If only one result is found. do this stuff.
    if (count($rows) == 1){
        //Doing stuff here. 
        // Set the Session ID for later use in home page.
        $_SESSION['loginID'] = $rows[0]['ID'];
        // Redirect to home page.
        header("Location: http://{$_SERVER['HTTP_HOST']}/home.php");
    } else {
        //Login failed
        header("Location: http://{$_SERVER['HTTP_HOST']}/index.php");
    }

}
?>