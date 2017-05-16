<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Events</title>
		<link rel="stylesheet" type="text/css" href="css/style.css">
		<link href="https://fonts.googleapis.com/css?family=Cormorant+SC|Linden+Hill|PT+Serif:700i" rel="stylesheet">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
		<script src="includes/scripts.js"></script>
	</head>

<body>
	<div class="contents">
		<div class ="top_bar"> <!-- Contains header and Nav Bar -->
			<div class ="banner">
                <?php include 'includes/banner.php'; ?>
				<h1>
					Come See Us in Action!
				</h1>
			</div> <!--End of banner div-->
			

			<?php
    	  		include 'includes/navbar.php';
    		?> 
    	</div> <!-- End of top_bar div -->

		<div class="page_body"> <!--Photo Gallery-->
			<div class="container">
			<?php
				if (isset($_SESSION['valid_user'])) {
					echo '<p id="welcome_p">You are currently logged in. Unfortunately this page is still in construction, please try again later.</p>';
                    /**<button>Add an Event</button>
                    <script>"button".onclick: open text entry form,asks for description,
                    date, time, sport/s, photos, tags</script>
				            **/
                }
				else {
					echo '<p id="welcome_p">This page is still in construction. For more features please <a href="login.php">Login</a></p>';
				}
			?> 
            <!-- 
            new mysqli, query on events table
            foreach event
            <div class=event> Event Name
            <p>event description</p>
            <img event gallery>
            <button> Add comment/submit photos </button> <button> Like/share etc<button> (members only)
            <button> Edit post, remove comment etc<button> (admins only)
            -->
		    </div>  <!-- End of gallery_container div -->  	   
			
		</div> <!-- End of page_body div -->


		<footer>
			<?php
    	  	include 'includes/bottom.php';
    		?> 
		</footer> <!-- end of footer div -->  
	</div> <!-- end of contents div -->





</body>	

</html>
