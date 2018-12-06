<?php    
    //This function takes in n number of cards to present and does so.
    function showCards($numCards){
        $pdo = new PDO('mysql:host=localhost;dbname=4ww3', 'chaneh', 'test');
        $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // This is the query String to be sent in.
        $sql = "Select * from parkings where OccupantID=? and OwnerID<>?";
        $stmnt = $pdo->prepare($sql);
        // Try to execute first
        try {
            $stmnt->execute([$_SESSION['loginID'], $_SESSION['loginID']]);
        } catch (PDOException $e){
            echo $e->getMessage();
            echo $e->getTraceAsString();
        }
        $counter = 0;
        while ($row = $stmnt->fetch(PDO::FETCH_ASSOC)) {
            $imagelocation = "./assets/images/parking.jpg";

            // If there is no image stored then use default placeholder;
            if (isset($row['Imageurl'])){
                $imagelocation = $row['Imageurl'];
            }
            // This is here for rounding.
            $lat = round($row['Latitude'], 2);
            $lng = round($row['Longitude'], 2);

            echo "
            <div class=\"card\">
                <!-- This is a place holder image for a map location. -->
                <img src=$imagelocation alt=\"parkingImage\">
                <p class=\"location\">Location: {$row['Location']}</p>
                <p class=\"location\">Longitude: {$lng}</p>
                <p class=\"location\">Latitude: {$lat}</p>
                <p class=\"location\">Desciption: {$row['Description']}</p>
                <a href=\"parking.php?parking={$row['ID']}\">
                    <!-- For gong to see addition details for the spot -->
                    <div class=\"MoreInfo\"><i class=\"fas fa-question-circle\"></i> More Details</div>
                </a>
                <a href=\"phpInclude/functional/unbook.php?parking={$row['ID']}\">
                    <!-- For gong to see addition details for the spot -->
                    <div class=\"MoreInfo\"> <i class=\"fas fa-unlock\"></i> Unlock Spot</div>
                </a>
            </div>
            ";
            $counter++;
            // If a negative number is sent in display all cards.
            if ($numCards > 0){
                if ($counter >= $numCards){
                    break;
                }
            }
        }
    }

// Query for getting people using users parking spots;
// Select users.Name from parkings join users on (parkings.OccupantID=users.ID) where parkings.OwnerID=5;
    function showTennents(){
        //Setting up the connection to the database.
        $pdo = new PDO('mysql:host=localhost;dbname=4ww3', 'chaneh', 'test');
        $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Sql statement, looking for user's name and contact number for tennants on current user's owned parking spots
        $sql = "Select users.Name, users.PhoneNumber, parkings.Location,  parkings.Imageurl, parkings.ID from parkings join users on (parkings.OccupantID=users.ID) where parkings.OwnerID=? and parkings.OccupantID<>?";
        $stmnt = $pdo->prepare($sql);
        try {
            //Attempting to get query;
            $stmnt->execute([$_SESSION['loginID'],$_SESSION['loginID']]);
        } catch (PDOException $e){
            echo $e->getMessage();
            echo $e->getTraceAsString();
        }
        while ($row = $stmnt->fetch(PDO::FETCH_ASSOC)) {
            $imagelocation = "./assets/images/parking.jpg";

            // If there is no image stored then use default placeholder;
            if (isset($row['Imageurl'])){
                $imagelocation = $row['Imageurl'];
            }
            echo "
            <div class=\"card\">
                <!-- This is a place holder image for a map location. -->
                <img src=$imagelocation alt=\"parkingImage\">
                <p class=\"location\">Location: {$row['Location']}</p>
                <p class=\"name\">Name: {$row['Name']}</p>
                <p class=\"number\">Contact: {$row['PhoneNumber']}</p>
                <a href=\"parking.php?parking={$row['ID']}\">
                    <!-- For gong to see addition details for the spot -->
                    <div class=\"MoreInfo\"><i class=\"fas fa-question-circle\"></i> More Details</div>
                </a>
            </div>
            ";
        }
    }

    function getMyOpenSpots(){
        $pdo = new PDO('mysql:host=localhost;dbname=4ww3', 'chaneh', 'test');
        $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // This is the query String to be sent in.
        $sql = "Select * from parkings where OwnerID=? and (OccupantID<>? or OccupantID is Null)";
        $stmnt = $pdo->prepare($sql);
        // Try to execute first
        try {
            $stmnt->execute([$_SESSION['loginID'], $_SESSION['loginID'] ]);
        } catch (PDOException $e){
            echo $e->getMessage();
            echo $e->getTraceAsString();
        }
        while ($row = $stmnt->fetch(PDO::FETCH_ASSOC)) {
            $imagelocation = "./assets/images/parking.jpg";

            // If there is no image stored then use default placeholder;
            if (isset($row['Imageurl'])){
                $imagelocation = $row['Imageurl'];
            }
            // This is here for rounding.
            $lat = round($row['Latitude'], 2);
            $lng = round($row['Longitude'], 2);

            echo "
            <div class=\"card\">
                <!-- This is a place holder image for a map location. -->
                <img src=$imagelocation alt=\"parkingImage\">
                <p class=\"location\">Location: {$row['Location']}</p>
                <p class=\"location\">Longitude: {$lng}</p>
                <p class=\"location\">Latitude: {$lat}</p>
                <p class=\"location\">Desciption: {$row['Description']}</p>
                <a href=\"parking.php?parking={$row['ID']}\">
                    <!-- For gong to see addition details for the spot -->
                    <div class=\"MoreInfo\"><i class=\"fas fa-question-circle\"></i> More Details</div>
                </a>
                <a href=\"phpInclude/functional/lock.php?parking={$row['ID']}\">
                    <!-- for locking parking spot -->
                    <div class=\"MoreInfo\"><i class=\"fas fa-lock\"></i> Lock Spot</div>
                </a>
            </div>
            ";
        }
    }
    // Function obtains spots locked by the user. (ie. not bookable by other people)
    function getMyLockedSpots(){
        $pdo = new PDO('mysql:host=localhost;dbname=4ww3', 'chaneh', 'test');
        $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // This is the query String to be sent in.
        $sql = "Select * from parkings where OwnerID=? and OccupantID=?";
        $stmnt = $pdo->prepare($sql);
        // Try to execute first
        try {
            $stmnt->execute([$_SESSION['loginID'],$_SESSION['loginID']]);
        } catch (PDOException $e){
            echo $e->getMessage();
            echo $e->getTraceAsString();
        }
        while ($row = $stmnt->fetch(PDO::FETCH_ASSOC)) {
            $imagelocation = "./assets/images/parking.jpg";

            // If there is no image stored then use default placeholder;
            if (isset($row['Imageurl'])){
                $imagelocation = $row['Imageurl'];
            }
            // This is here for rounding.
            $lat = round($row['Latitude'], 2);
            $lng = round($row['Longitude'], 2);

            echo "
            <div class=\"card\">
                <!-- This is a place holder image for a map location. -->
                <img src=$imagelocation alt=\"parkingImage\">
                <p class=\"location\">Location: {$row['Location']}</p>
                <p class=\"location\">Longitude: {$lng}</p>
                <p class=\"location\">Latitude: {$lat}</p>
                <p class=\"location\">Desciption: {$row['Description']}</p>
                <a href=\"parking.php?parking={$row['ID']}\">
                    <!-- For gong to see addition details for the spot -->
                    <div class=\"MoreInfo\"><i class=\"fas fa-question-circle\"></i> More Details</div>
                </a>
                <a href=\"phpInclude/functional/unbook.php?parking={$row['ID']}&unlock=1\">
                    <!-- for unlocking parking spot -->
                    <div class=\"MoreInfo\"><i class=\"fas fa-lock\"></i> Unlock Spot</div>
                </a>
            </div>
            ";
        }
    }
?>

