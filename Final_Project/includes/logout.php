<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Logout</title>
		<link rel="stylesheet" type="text/css" href="css/style.css">
		<link href="https://fonts.googleapis.com/css?family=Cormorant+SC|Linden+Hill|PT+Serif:700i" rel="stylesheet">
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
    	  		include 'includes/navbar.php';
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
    	  	include 'includes/bottom.php';
    		?> 
		</footer> <!-- end of footer div -->  
	</div> <!-- end of contents div -->





</body>	

</html>