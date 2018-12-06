<?php
    // For Starting the session and redirecting if not logged in.
    include 'phpInclude/functional/sessionValidate.php';

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Submit Parking Spot.</title>
    <link rel="stylesheet" type="text/css" href="styles/style.css" />
    <link rel="stylesheet" type="text/css" href="styles/registerStyles.css" />
    <link rel="stylesheet" type="text/css" href="styles/searchStyles.css" />
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
        <!-- Form container to better format the submission form. -->
        <div class="formContainer">
            <h1>Spot Submission</h1>
            <?php
                if (isset($_GET['error'])){
                    echo "<p> Invalid Inputs, try again.</p>";
                }
            ?>
            <form method="POST" action="phpInclude/functional/parkingSub.php">
                <table class="center">
                    <tr>
                        <td>Name: </td>
                        <td> <input class="row-Entry" type="text" id="name" name="name" required/></td>
                    </tr>
                    <tr>
                        <td>
                            <hr>
                        </td>
                        <td>
                            <hr>
                        </td>
                    </tr>
                    <tr>
                        <td>Location: </td>
                        <td> <input class="row-Entry" type="text" id="loca" name="location" required/></td>
                    </tr> 
                    <tr>
                        <td>
                            <hr>
                        </td>
                        <td>
                            <hr>
                        </td>
                    </tr>
                    <tr>
                        <td>Description: </td>
                        <td> <input class="row-Entry" type="text" id="descipt" name="descipt" required/></td>
                    </tr>
                    <tr>
                        <td>
                            <hr>
                        </td>
                        <td>
                            <hr>
                        </td>
                    </tr>
                    <tr>
                        <td>Longitude: </td>
                        <td><input class="row-Entry" type="number" id="long" name="long" step="any" required/></td>
                    </tr>
                    <tr>
                        <td>
                            <hr>
                        </td>
                        <td>
                            <hr>
                        </td>
                    </tr>
                    <tr>
                        <td>Latitude: </td>
                        <td><input class="row-Entry" type="number" id="lat" name="lat"  step="any" required/></td>
                    </tr>
                </table>
                <input type="file" name="image" id="image"><br>
                <script src="scripts/geolocation.js"></script>
                <input type="button" class="submit" name="locationSet" value="Set to Current Location" onclick="getLocation()"><br>
                <input type="submit" class="submit" id="submit" name="submit" />
            </form>
        </div>
    </div>
    <!-- For Footer -->
    <?php
        include 'phpInclude/visual/footer.php';
    ?>
</body>
</html>