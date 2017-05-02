<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>SAAC</title>
		<link rel="stylesheet" type="text/css" href="css/style.css">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	</head>



<body>
	<div class="contents">

		<div class ="top_bar"> <!-- Contains header and Nav Bar -->
			<div class ="banner">

				<h1> 
					Welcome to SAAC 	
<!-- 					<img class="logo" src="images/cornell_white.jpeg" alt="Cornell Logo" title="Cornell University">  -->		         
				</h1>

			</div> <!--End of banner div-->
			

			<?php
    	  		include 'includes/navbar.php';
    		?> 
    	</div> <!-- End of top_bar div -->


		<div class="page_body"> <!--Info about the page-->

			<h2>Student Athlete Advising Commitee</h2>

			<div class="container">
			<?php
				echo '<p id="welcome_p">Welcome to the Student Athlete Advisory Committee (SAAC) website. We are composed of representatives from all varsity sports, working with the athletic administration to enhance the Student Athlete experience</p>';
				if (isset($_SESSION['valid_user'])) {
					echo '<p id="welcome_p">You are currently logged in. Unfortunately this page is still in construction, please try again later.</p>';
				}
				else {
					echo '<p id="welcome_p">This page is still in construction. For more features please <a href="login.php">Login</a></p>';
				}
			?> 
				
		    </div>  <!-- End of search_container div -->  

		</div> <!--End of page_body div-->

		<footer>
			<?php
    	  		include 'includes/bottom.php';
    		?> 
		</footer> <!-- end of footer div -->   
	</div> <!-- end of contents div -->
</body>

</html>