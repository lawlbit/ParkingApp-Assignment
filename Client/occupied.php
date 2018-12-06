<?php
    // This is the header php script element for redirectiing.
    include 'phpInclude/functional/sessionValidate.php';
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
                    showCards(-1);
                ?>
        </div>
    </div>
    <!-- For Footer -->
    <?php
        include 'phpInclude/visual/footer.php';
    ?>
</body>
</html>