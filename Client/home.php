<?php
    // This is the header php script element for redirectiing.
    session_start();
    if (!isset($_SESSION['loginID'])){
        header("Location: http://{$_SERVER['HTTP_HOST']}/AssignmentPHP/");
    }
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Spotted Home</title>
    <link rel="stylesheet" type="text/css" href="styles/style.css" />
    <?php
        include 'phpInclude/functional/head.php';
    ?>
</head>
<body>
    <!-- For Header -->
    <?php
        include 'phpInclude/visual/navbar.php';
        if (isset($_GET['fail'])){
            echo "
            <script>
                alert(\"Spot already taken, sorry!\");
            </script>
            ";
        }
    ?>
    <!-- This is temporary -->
    <!-- Main Content for Home page, will be divided into two parts. -->
     <div class="content-wrapper">
        <!-- First segment should be spots user is currently using -->
        <h1>My Currently Occupied Parking Spots:</h1>
        <div class="card-wrapper" id="occupiedQuick">
            <!-- All infromation is summarized in the form of cards. 
                This should allow for easier readability especially when going cross platform into mobile. -->
                <!-- Including php here to generate the cards. -->
                <?php
                    include 'phpInclude/visual/occupiedCards.php';
                    showCards(3);
                ?>
        </div>
        <!-- Dividing line to visually seperate the sections. -->
        <hr>
        <!-- Second segment is for user owned parking spots being loaned out currently -->
        <h1>My Tennents:</h1>
        <div class="card-wrapper" id="myTennents">
           <?php
                showTennents();
           ?>
        </div>
    </div>

    <!-- For Footer -->
    <?php
        include 'phpInclude/visual/footer.php';
    ?>
</body>
</html>