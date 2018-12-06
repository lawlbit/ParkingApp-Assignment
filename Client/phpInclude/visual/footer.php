<footer>
    <div class="footerColumn">
            <ul id="additionalLinks">
                <li><a href="#" class="link">Help</a></li>
                <li><a href="https://www.google.com/maps" class="link">Google Maps</a></li>
                <?php
                    // session_start();
                    if (isset($_SESSION['loginID'])){
                        include 'phpInclude/visual/footerLogout.php';
                    }
                    
                ?>
            </ul>
    </div>
    <div class="footerColumn" id="contactInfo">
            <p>Contact Email: <a href="mailto:chaneh@mcmaser.ca">chaneh@mcmaster.ca</a>.</p>
    </div>
</footer>