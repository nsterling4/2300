<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>ADMINS ONLY</title>
		<link rel="stylesheet" type="text/css" href="css/style.css">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	</head>

<body>
	<?php
	require_once 'includes/config.php';
	?>
	<div class="contents">
		<div class ="top_bar"> <!-- Contains header and Nav Bar -->
			<div class ="banner">
				<h1>
					Admin Login
				</h1>
			</div> <!--End of banner div-->
			

			<?php
    	  		include 'includes/navbar.php';
    		?> 
    	</div> <!-- End of top_bar div -->

		<div class="page_body"> <!--Photo Gallery-->
			<div class="container">
				<form method="post" action='login.php'>
					Enter Username:<input type="text" class="field" name="user" placeholder="Username"><br>
					Enter Password:<input type="password" class="field" name="pass" placeholder="Password"><br>
					<input type="submit" class="field" name="login" value="Login">
				</form>	
		    </div>  <!-- End of search_container div -->  	   
			


			<?php

				$mysqli = new mysqli( DB_HOST, DB_USER, DB_PASSWORD, DB_NAME );

				$post_username = filter_input( INPUT_POST, 'user', FILTER_SANITIZE_STRING );
				$post_password = filter_input( INPUT_POST, 'pass', FILTER_SANITIZE_STRING ); 

				

				if (isset($_POST["login"])) {
					//Get the post data and clean it up so it is safe

					//Create new user 	

					// $hashed_password=password_hash( $post_password, PASSWORD_DEFAULT);	

					// // INSERT INTO `Users`(`username`, `hash_password`) VALUES ([value-1],[value-2])

					// $sql ="INSERT INTO Users(username, hash_password) VALUES ('$post_username','$hashed_password')";
					// if ($mysqli->query($sql)) {
	    //  				echo "New record created successfully";
					// } else {
	    //  				echo "Error:". $mysqli->error;
					// }

					// }

				 	//username: SAAC_Admin
				 	//password: BigRed

					$sql = "SELECT * FROM Users WHERE username = '$post_username'";

					$result = $mysqli->query($sql);
				
					//Uncomment the next line for debugging
					//echo "<pre>" . print_r( $mysqli, true) . "</p>";

					//Make sure there is exactly one user with this username
					if ( $result && $result->num_rows == 1) {
						
						$row = $result->fetch_assoc();
						//Debugging
						//echo "<pre>" . print_r( $row, true) . "</p>";
						
						$db_hash_password = $row['hash_password'];
						
						if( password_verify( $post_password, $db_hash_password ) ) {
							$db_username = $row['username'];
							$_SESSION['valid_user'] = $db_username;
							echo "<META HTTP-EQUIV=Refresh CONTENT='login.php'>";
						}
					} 
					
					$mysqli->close();
					
					if ( isset($_SESSION['valid_user'] ) ) {
						print("<p>You have successfully logged into this site<p>");
					} else {
						echo '<p>You did not login successfully.</p>';
					}
				
				} //end if isset username and password





			?>




		</div> <!-- End of page_body div -->


		<footer>
			<?php
    	  	include 'includes/bottom.php';
    		?> 
		</footer> <!-- end of footer div -->  
	</div> <!-- end of contents div -->





</body>	

</html>