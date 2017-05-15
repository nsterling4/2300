<?php
session_start();
require_once 'includes/config.php';
    echo 
    '<div class="top_bar"> <!-- Contains header and Nav Bar -->
        <div class="nav_bar"><!--Bar to navigate around the page-->
         <img class="bear_logo" src="images/CornellBigRed.png" alt="Cornell Logo" title="Cornell University"> 
            <ul id="main">
                <li><a href="index.php">Home</a></li>
                <li><a href="articles.php">Articles</a></li>
                <li><a href="gallery.php">Gallery</a></li>
                <li><a href="events.php">Events</a></li>
                <li><a href="members.php">Members</a></li>
                <li><a href="about.php">About Us</a></li>
                <li><a href="contact.php">Contact Us</a></li>
            </ul>

            <ul id="log">
               <div class="fb-login-button" data-max-rows="1" data-size="large" data-button-type="login_with" data-show-faces="false" data-auto-logout-link="true" data-use-continue-as="false"></div>
            </ul>
        </div> <!-- End of nav_bar div -->
    </div>  <!--End of top_bar div-->';
?>

