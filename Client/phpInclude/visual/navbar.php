 <!-- Navigation bar at the top php element -->
<header>
    <div id="topNavbar">
        <ul class="navMenuContainer">
            <!-- Going to an anonymous user home page -->
            <?php
                // session_start();
                if (!isset($_SESSION['loginID'])){
                    include 'anonHeader.php';
                } else {
                    include 'header.php';
                }
                
            
            ?>
        </ul>
    </div>
</header>