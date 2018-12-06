<?php
    // Validating there is a logged in session.
    include 'phpInclude/functional/sessionValidate.php';

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Parking Management</title>
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
    <!-- Main Content -->
    <div class="content-wrapper">
        <h1>My Open Parking Spots: </h1>
        <!-- <a href="submission.html"><div><i class="fas fa-plus-circle"></i></div></a> -->
        <div class="card-wrapper">
            <!-- Out going link for adding addition parking spots, it links to the submission html page. -->
            <div class="add-spot">
                <a href="submission.php" class="link">
                    <div class="MoreInfo"><i class="fas fa-plus-circle"></i> Add Parking Spot</div>
                </a>
            </div>
            <!-- Card class/container to better organize presented data. -->
            <!-- PHP for generating your owned spots. -->
            <?php
                    include 'phpInclude/visual/occupiedCards.php';
                    getMyOpenSpots();
            ?>
        </div>
        <hr>
        <h1>My Locked Spots:</h1>
        <div class="card-wrapper">
            <!-- Out going link for adding addition parking spots, it links to the submission html page. -->
            <?php
                    getMyLockedSpots();
            ?>
        </div>
    </div>

    <!-- For Footer -->
    <?php
        include 'phpInclude/visual/footer.php';
    ?>
</body>
</html>