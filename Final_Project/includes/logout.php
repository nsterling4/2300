<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Logout</title>
		<link rel="stylesheet" type="text/css" href="css/style.css">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	</head>

<body>
	<div class="contents">
		<div class ="top_bar"> <!-- Contains header and Nav Bar -->
			<div class ="banner">
				<h1>
					GOODBYE!
				</h1>
			</div> <!--End of banner div-->
			

			<?php
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

		            <ul class="log" id="desk">
		               <div class="fb-login-button" data-max-rows="1" data-size="large" data-button-type="login_with" data-show-faces="false" data-auto-logout-link="true" data-use-continue-as="false"></div>
		            </ul>

		            <ul class="log" id="tab">
		               <div class="fb-login-button" data-max-rows="1" data-size="medium" data-button-type="login_with" data-show-faces="false" data-auto-logout-link="true" data-use-continue-as="false"></div>
		            </ul>

		            <ul class="log" id="mob">
		               <div class="fb-login-button" data-max-rows="1" data-size="small" data-button-type="login_with" data-show-faces="false" data-auto-logout-link="true" data-use-continue-as="false"></div>
		            </ul>
		        </div> <!-- End of nav_bar div -->
		    </div>  <!--End of top_bar div-->';
				if (isset($_SESSION['valid_user'])) {
					unset($_SESSION['valid_user']);
				}	
    		?> 
    	</div> <!-- End of top_bar div -->

		<div class="page_body"> <!--Photo Gallery-->
			<div class="container">

				<?php
					if ( isset($_SESSION['valid_user'] )) {
						print("<p>You haven't logged out.</p>");
						print("<p>Go to our <a href='logout.php'>Logout Page</a></p>");
					} else {
						print("<p>Thanks for using our page!</p>");
						print("<p>Return to our <a href='login.php'>Login Page</a></p>");						
					}
				?>

		    </div>  <!-- End of search_container div -->  	   

		</div> <!-- End of page_body div -->


		<footer>
			<?php
    	  	include 'bottom.php';
    		?> 
		</footer> <!-- end of footer div -->  
	</div> <!-- end of contents div -->





</body>	

</html>