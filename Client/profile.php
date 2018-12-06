<?php
     include 'phpInclude/functional/sessionValidate.php';
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Profile Information</title>
    <link rel="stylesheet" type="text/css" href="styles/style.css" />
    <link rel="stylesheet" type="text/css" href="styles/registerStyles.css" />
    <?php
        include 'phpInclude/functional/head.php';
    ?>
</head>
<body>
    <!-- For Header -->
    <?php
        include 'phpInclude/visual/navbar.php';
    ?>
    <!-- Main Content -->
    <div class="content-wrapper">
        <!-- Designed as a form for quick access for editing -->
        <div class="formContainer">
            <h1>My Profile</h1>
            <?php
                $pdo = new PDO('mysql:host=localhost;dbname=4ww3', 'chaneh', 'test');
                $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                // Query for db to get profile information based on loggin ID.
                $sql = "Select * from users where ID=?";
                $stmnt=$pdo->prepare($sql);
                try {
                    $stmnt->execute([$_SESSION['loginID']]);

                } catch (PDOException $e){
                    echo $e->getMessage();
                    echo $e->getTraceAsString();
                }
                $row = $stmnt->fetch(PDO::FETCH_ASSOC);
                echo "
                <table align=\"center\">
                    <tr>
                        <td>Name: </td>
                        <td>{$row['Name']}</td>
                    </tr>
                    <tr>
                        <td>Email: </td>
                        <td>{$row['Email']}</td>
                    </tr>
                    <tr>
                        <td>Phone Number: </td>
                        <td>{$row['PhoneNumber']}</td>
                    </tr>
                </table>
                ";

            ?>
        </div>
    </div>
    <!-- For Footer -->
    <?php
        include 'phpInclude/visual/footer.php';
    ?>
</body>
</html>