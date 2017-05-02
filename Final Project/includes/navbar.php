<?php
session_start();
require_once 'includes/config.php';
    echo 
    '<div class="top_bar"> <!-- Contains header and Nav Bar -->     
        <div class="nav_bar"><!--Bar to navigate around the page-->
            <ul id="main">
                <li><a href="index.php">Home</a></li>
                <li><a href="articles.php">Articles</a></li>
                <li><a href="gallery.php">Gallery</a></li>
                <li><a href="events.php">Events</a></li>
                <li><a href="members.php">Members</a></li>
                <li><a href="about.php">About Us</a></li>
                <li><a href="contact.php">Contact Us</a></li>
            </ul>

            <ul id="log">';
                if (isset($_SESSION['valid_user'])) {
                    echo '<li><a href="logout.php">Logout</a></li>';
                } else {
                    echo '<li><a href="login.php">Login</a></li>';
                }      
            echo 
            '</ul>
        </div> <!-- End of nav_bar div -->
    </div>  <!--End of top_bar div-->';
?>

