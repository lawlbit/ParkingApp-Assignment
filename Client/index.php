<?php
    // This is the header php script element for redirectiing.

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Welcome to Spotted</title>
    <link rel="stylesheet" type="text/css" href="styles/style.css" />
    <link rel="stylesheet" type="text/css" href="styles/loginStyles.css" />
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
        <!-- This is the main login form -->
        <form action="phpInclude/functional/login.php" method="POST">
            <div class="formContainer">
                <h1>Spotted<br><img src="./assets/images/logo.jpg" alt="Logo" style="border-style:none; width:40%;"></h1>
                <div class="label-container">
                    <label for="email">Email</label>
                </div>

                <input type="email" class="email" id="email" value="email" name="email" />

                <div class="label-container">
                    <label for="password">Password</label>
                </div>

                <input type="password" name="password" class="password" id="password" value="password" />
                
                <!-- as it is currently a static page, signin just loads the logged in home screen -->
                <!-- <a href="phpInclude/functional/login.php" name="signIn">
                    <div class="signIn">Sign In</div>
                </a> -->
                <input type="submit" class="signIn" id="submit" name="regbtn" value="Sign In" />

                <!-- Loads the register screen for users to sign up. -->
                <a href="register.php">
                    <div class="signUp">Sign Up</div>
                </a>
            </div>
        </form>
    </div>


    <!-- For Footer -->
    <?php
        include 'phpInclude/visual/footer.php';
    ?>
</body>
</html>