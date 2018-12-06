<?php
    session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Search Results</title>
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
            <div class="map" id="map"></div>
            <!-- Adding the map script to the results page. -->
            <script src="./scripts/map.js"></script>
            <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBqWJWcMzxgzc6pcLv6Q7JXXi3FVDOg_bg&callback=initMap">
            </script>
            <div class="card-wrapper">
                <!-- Card is for organizing the quick summary of inofrmation for each parking spot found -->
                <?php
                    // Setting up the Database connection.
                    $defaultDistance = 2.0;
                    $pdo = new PDO('mysql:host=localhost;dbname=4ww3', 'chaneh', 'test');
                    $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
                    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                    // This is for dynamically generating the where clause of the query.
                    $options = "having ";
                    if (!$_POST['name']==""){
                        $options = $options . " parkings.Name = '{$_POST['name']}' and";
                    }
                    $options = $options . " rating >={$_POST['rating']} and";
                    if (!$_POST['distance']==""){
                        $options = $options . " distance <={$_POST['distance']}";
                    } else {
                        $options = $options . " distance <={$defaultDistance}";
                    }
                    // $sql ="Select parkings.ID, parkings.Name, parkings.Location, parkings.Imageurl, AVG(reviews.Rating) as rating from parkings join reviews on (parkings.ID=reviews.P_id) where rating>=3 Group by parkings.ID;";
                    $sql ="Select parkings.Longitude, parkings.Latitude, parkings.ID, parkings.Name, parkings.Location, parkings.Imageurl, AvG(reviews.Rating) as rating, ( 6371 * acos( cos( radians(?) ) * cos( radians( Latitude ) ) * cos( radians( Longitude ) - radians(?) ) + sin( radians(?) ) * sin( radians( Latitude ) ) ) ) AS distance from parkings join reviews on (parkings.ID=reviews.P_id) where parkings.OccupantID is NULL Group By parkings.ID {$options}";
                    $stmnt = $pdo->prepare($sql);
                    try {
                        $stmnt->execute([$_POST['lat'], $_POST['long'], $_POST['lat']]);
                    } catch (PDOException $e){
                        echo $e->getMessage();
                        echo $e->getTraceAsString();
                    }
                    $count = 0;
                    while ($row = $stmnt->fetch(PDO::FETCH_ASSOC)) {
                        $imagelocation = "./assets/images/parking.jpg";
                        
                        // If there is no image stored then use default placeholder;
                        if (isset($row['Imageurl'])){
                            $imagelocation = $row['Imageurl'];
                        }
                        // Rounding Values obtained via query.
                        $rating = round($row['rating'], 1);
                        $dist = round($row['distance'], 2);

                        // Setting the string used to generate a item when clicking.
                        $markerString = "'<div><strong> {$row['Name']} </strong><br>' + 'Location: {$row['Location']} <br>' + '<a href=\"parking.php?parking={$row['ID']}\">More Info</a><br>'";
                        echo "
                        <div class=\"card\">
                            <script>
                                console.log(\"Running addmarker Now!\");
                                addMarker({$row['Latitude']},{$row['Longitude']},{$markerString});
                            </script>
                            <!-- This is a place holder image for a map location. -->
                            <img src=$imagelocation alt=\"parkingImage\">
                            <p class=\"name\">Name: {$row['Name']}</p>
                            <p class=\"location\">Location: {$row['Location']}</p>
                            <p class=\"number\">Distance: {$dist}km</p>
                            <p class=\"number\">Rating: {$rating}/5</p>
                            <a href=\"parking.php?parking={$row['ID']}\">
                                <!-- For gong to see addition details for the spot -->
                                <div class=\"MoreInfo\"><i class=\"fas fa-question-circle\"></i> More Details</div>
                            </a>
                            <a href=\"phpInclude/functional/book.php?parking={$row['ID']}\">
                                <div class=\"MoreInfo\"><i class=\"fas fa-bookmark\"></i> Book</div>
                            </a>
                        </div>
                        ";
                        // Clearing Marker String
                        $markerString="";
                    }
                ?>
            </div>
    </div>

    <!-- For Footer -->
    <?php
        include 'phpInclude/visual/footer.php';
    ?>
</body>
</html>