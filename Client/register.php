<?php
    // This is the header php script element for redirectiing.

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Create Account</title>
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
        <!-- For Containing the form -->
        <div class="formContainer">
            <script src="./scripts/validation.js"></script>
            <h1>Registration Form</h1>
            <?php
                // Check if there is an error then print if there is.
                if (isset($_GET['err'])){
                    echo "<p> Invalid Inputs, try again.</p>";
                }
            ?>
            <form name="registerForm" method="POST" action="phpInclude/functional/registerDB.php" onsubmit="return validateForm()">
                <!-- Label Container to help with organizing the label -->
                <div class="label-container">
                    <label for="userName">Name</label>
                </div>
                <input type="text" class="name" name="fname" placeholder="Name" id="userName" required/>

                <div class="label-container">
                    <label for="email">Email</label>
                </div>
                <input type="email" class="email" name="femail" placeholder="email" id="email" required/>

                <div class="label-container">
                    <label for="pw">Password</label>
                </div>
                <input type="password" class="password" name="fpassword" placeholder="password" id="pw" required/>

                <div class="label-container">
                    <label for="tel">Phone Number</label>
                </div>
                <input type="tel" class="tele" name="ftele" id="tel" placeholder="123-456-7890" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" required/>
                <!-- Once Account is created user should be brought straight to home screen. -->
                <input type="submit" class="submit" id="submit" name="regbtn" value="Create Account" />
            </form>
            <!-- <input type="button" value="Temp Sub/Validate Button" class="submit" onclick="validateForm()"/> -->
        </div>
    </div>

    <!-- For Footer -->
    <?php
        include 'phpInclude/visual/footer.php';
    ?>
</body>
</html>