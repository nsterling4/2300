<?php
session_start();
    echo 
    '<div class="top_bar_main"> <!-- Contains header and Nav Bar -->
    			
    		<div class="nav_bar" id="main"><!--Bar to navigate around the page-->
    			<ul>
     				<li><a href="index.php">Home</a></li>
     				<li><a href="gallery.php">Gallery</a></li>
     				<li><a href="photo_add.php">Add Photo</a></li>
     				<li><a href="album_add.php">Add Album</a></li>
     				<li><a href="search.php">Search</a></li>';


        if (isset($_SESSION['valid_user'])) {
            echo '<li><a href="logout.php">Logout</a></li>';
        } else {
            echo '<li><a href="login.php">Login</a></li>';
        }

                   
    echo 
                '</ul>
    		</div> <!-- End of nav_bar div -->
    	</div>	<!--End of top_bar div-->';
?>


