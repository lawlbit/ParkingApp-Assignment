<?php
// This script handles creating new users and inserting them into the database
require 'validateReg.php';
session_start();
$pdo = new PDO('mysql:host=localhost;dbname=4ww3', 'chaneh', 'test');
$pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Sanity check for checking if there is a form there.
if (isset($_POST['regbtn'])) {
    //processing form here, 4b3403665fea6 <- Salt
    // fname = name
    // femail = email
    // fpassword = password
    // ftele = telephone number 
    
    $hash = '4b3403665fea6';
    if (validateRegistration($_POST)){
        //Now submitting form data to database since we know it is good to go via the validation script.
        try {
            //Using BindValue multiple times did not work. as such values for the query sent in via parameters in the execute command.
            $sql = "INSERT INTO users (Name, Email, PhoneNumber, Salt, Passwordhash) VALUES (:name, :email, :tele, :salt, SHA2(CONCAT(:password, :salt_2), 0))";
            $stmnt = $pdo->prepare($sql);
            $stmnt->execute([$_POST['fname'], $_POST['femail'], $_POST['ftele'], $hash, $_POST['fpassword'], $hash]);
            // Redirect only if executed properly
            header("Location: https://{$_SERVER['HTTP_HOST']}/index.php");
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    } else {
        echo '<script> alert("Invalid input, restart..."); </script>';
        header("Location: https://{$_SERVER['HTTP_HOST']}/register.php?err=1");
    }
} else {
    $wow = $_POST['fname'];
    echo 'something is wrong...';
    echo "<p>WOW $wow </p>";
}



?>