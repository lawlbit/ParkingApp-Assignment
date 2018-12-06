<?php
    session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Parking Information</title>
    <link rel="stylesheet" type="text/css" href="styles/style.css" />
    <link rel="stylesheet" type="text/css" href="styles/information.css" />
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
        <div class="info-container">
            <h2>Location Information</h2>
            <!-- Place holder for map element  -->
            <div class="map" id="map"></div>
            <!-- Script importing for map loading -->
            <script src="./scripts/map.js"></script>
            <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBqWJWcMzxgzc6pcLv6Q7JXXi3FVDOg_bg&callback=initMap">
            </script>
            <div class="content">
                <!-- The script to obtain information goes here. -->
                <?php
                    // Connecting to the database
                    $pdo = new PDO('mysql:host=localhost;dbname=4ww3', 'chaneh', 'test');
                    $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
                    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                    // Since the ID is the primary key it should only return one element.
                    $sql = "Select parkings.Name, parkings.Location, parkings.Latitude, parkings.Longitude, parkings.Description, users.Name as uName, users.PhoneNumber from parkings join users on (parkings.OwnerID=users.ID) where parkings.ID=?";
                    $stmnt = $pdo->prepare($sql);
                    // Try to execute first
                    try {
                        $stmnt->execute([$_GET['parking']]);
                    } catch (PDOException $e){
                        echo $e->getMessage();
                        echo $e->getTraceAsString();
                    }
                    // Assuming only one element is pulled.
                    $row = $stmnt->fetch(PDO::FETCH_ASSOC);
                    $markerString = "'<div><strong> {$row['Name']} </strong><br>' + 'Location: {$row['Location']} <br>'";

                    echo "
                        <script>
                            console.log(\"Running addmarker Now!\");
                            addMarker({$row['Latitude']},{$row['Longitude']},{$markerString});
                        </script>
                    <table>
                    <tr>
                        <td>Name: </td>
                        <td>{$row['Name']}</td>
                    </tr>
                    <tr>
                        <td>Location: </td>
                        <td>{$row['Location']}</td>
                    </tr>
                    <tr>
                        <td>Description: </td>
                        <td>{$row['Description']}</td>
                    </tr>
                    <tr>
                        <td>Longitude: </td>
                        <td>{$row['Longitude']}</td>
                    </tr>
                    <tr>
                        <td>Latitude: </td>
                        <td>{$row['Latitude']}</td>
                    </tr>
                    <tr>
                        <td>Owner: </td>
                        <td>{$row['uName']}</td>
                    </tr>
                    <tr>
                        <td>Contact: </td>
                        <td>{$row['PhoneNumber']}</td>
                    </tr>
                </table>
                ";
                ?>
                <!-- Table for displaying parking spot information -->
            </div>
            <hr>
            <!-- User reviews -->
            <h2>Reviews/Comments</h2>
            <div class="review-card-container">
                <!-- Similar to the original card, except for housing reviews, same idea -->
                <!-- Performing queries for reviews. -->
                <?php
                    // $pdo = new PDO('mysql:host=localhost;dbname=4ww3', 'chaneh', 'test');
                    // $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
                    // $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                    // Since the ID is the primary key it should only return one element.
                    $sql = "Select users.Name, reviews.Rating, reviews.Description from reviews join users on (reviews.ReviewerID=users.ID) where reviews.P_id=?";
                    $stmnt = $pdo->prepare($sql);
                    // Try to execute first
                    try {
                        $stmnt->execute([$_GET['parking']]);
                    } catch (PDOException $e){
                        echo $e->getMessage();
                        echo $e->getTraceAsString();
                    }
                    while ($row = $stmnt->fetch(PDO::FETCH_ASSOC)) {
                        echo "
                            <div class=\"review-card\">
                                <p><strong>{$row['Name']}</strong></p>
                                
                                <p>Rating: {$row['Rating']}/5</p>
                               
                                <p>{$row['Description']}</p>
                                
                            </div>
                        ";
                    }
                    // if logged in
                    if (isset($_SESSION['loginID'])){
                        // Review submission.
                        echo "
                            <div class=\"review-card\">
                            <form method=\"POST\" action=\"phpInclude/functional/subReview.php\" style=\" text-align: center;\" >
                                <input type=\"hidden\" id=\"long\" name=\"pid\" value=\"{$_GET['parking']}\"/>
                                Rating: 
                                <select name=\"rating\">
                                    <option value=\"1\">1</option>
                                    <option value=\"2\">2</option>
                                    <option value=\"3\">3</option>
                                    <option value=\"4\">4</option>
                                    <option value=\"5\">5</option>
                                </select>
                                <br>
                                <input type=\"text\" id=\"descrip\" name=\"review\" style=\" width: 80%;\"/>
                                <br>
                                <input type=\"submit\" class=\"sub\" id=\"submit\" name=\"submit\" />

                            </from>
                            </div>
                        ";
                    } else {
                        echo "
                            <a href=\"index.php\">
                                <div class=\"button\">Leave Review</div>
                            </a>
                        ";
                    }
                ?>
                <!-- Currently a broken link due to not having access to js. -->
            </div>
        </div>
    </div>

    <!-- For Footer -->
    <?php
        include 'phpInclude/visual/footer.php';
    ?>
</body>
</html>