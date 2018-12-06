<?php
 session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Spotted Search</title>
    <link rel="stylesheet" type="text/css" href="styles/style.css" />
    <link rel="stylesheet" type="text/css" href="styles/registerStyles.css" />
    <link rel="stylesheet" type="text/css" href="styles/searchStyles.css" />
    <?php
        include 'phpInclude/functional/head.php';
    ?>
    <script src="./scripts/geolocation.js"></script>
</head>
<body onload="getLocation()">
    <!-- For Header -->
    <?php
        include 'phpInclude/visual/navbar.php';
    ?>
    <!-- Main Content -->
    <div class="content-wrapper">
        <div class="formContainer">
            <h1>Spot Search</h1>
            <form method="POST" action="results.php">
            <!-- The following inputs are hidden from the user... -->
            <input type="hidden" id="long" name="long"/>
            <input type="hidden" id="lat" name="lat"/>
                <table class="center">
                    <tr>
                        <td>Name: </td>
                        <td> <input class="row-Entry" type="text" id="name" name="name"/></td>
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
                        <td>Rating: </td>
                        <td> 
                            <select name="rating">
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                            </select>
                        </td>
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
                        <!-- Using radio buttons forces the user to choose one of the following. using the same name keeps
                             them all linked togther/related -->
                        <td>Distance (km): </td>
                        <td>
                          <input class="row-Entry" type="number" id="dist" name="distance"  step="any"/>
                        </td>
                    </tr>
                </table>
                <input type="submit" class="sub" id="submit" name="submit" />
            </form>
        </div>
    </div>


    <!-- For Footer -->
    <?php
        include 'phpInclude/visual/footer.php';
    ?>
</body>
</html>