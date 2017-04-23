<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Add Album</title>
		<link rel="stylesheet" type="text/css" href="css/style.css">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	</head>

<body>
	<div class="contents">
		<div class ="top_bar"> <!-- Contains header and Nav Bar -->
			<div class ="banner">
				<h1>
					Add Album
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
	            echo 
					"<form id='album_add' method='post'>
						Enter an New Album Name: <input type='text' name='album_add' placeholder='Create a New Album'>
						<input class='submit' type='submit' name='add' value='Submit'>
					</form>";
			}
	        else {
	            echo '<p class="center">Please Log In to Create an Album</p>';
	            echo ("<p class='center'>Go to our <a href='login.php'>Login Page</a></p>");
	        }
				require_once 'includes/config.php';

				$mysqli = new mysqli( DB_HOST, DB_USER, DB_PASSWORD, DB_NAME ); 

				if (isset($_POST["add"])) {
					if (!empty($_POST['album_add'])) {

						$album_name = filter_input( INPUT_POST, "album_add", FILTER_SANITIZE_STRING );
						$sql = "INSERT INTO Album_List(album_name, date_created, date_modified, size) VALUES ('$album_name', CURRENT_DATE(), CURRENT_DATE(), '0')";
						if ($mysqli->query($sql)) {
		    				echo "New record created successfully";
						} else {
		    				echo "Error:". $mysqli->error;
						}
					}	
					else {
						echo "<p class='error'>Album Name Must Be Filled</p>";
					}
				}
		?>

		    </div>  <!-- End of album_add_container div -->  	   
			
		</div> <!-- End of page_body div -->


		<footer>
			<?php
    	  	include 'includes/bottom.php';
    		?> 
		</footer> <!-- end of footer div -->  
	</div> <!-- end of contents div -->





</body>	

</html>