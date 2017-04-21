<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>WELCOME</title>
		<link rel="stylesheet" type="text/css" href="css/style.css">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	</head>



<body>
	<?php
		require_once 'includes/config.php';
	?>
	<div class="contents">

			<div id = "header">
				<h1>
					WELCOME!
				</h1> 					
			</div> <!--End of header div-->

			<?php
    	  		include 'includes/navbar.php';
    		?> 

		<div class="banner">
  		</div> <!--End of banner div-->

		<div class="page_body"> <!--Info about the page-->

			<h2>Select an Album</h2>

			<div class="album_bar">
				<ul>
					<?php
						$albs=array();
						$mysqli = new mysqli( DB_HOST, DB_USER, DB_PASSWORD, DB_NAME ); 
						$result = $mysqli->query('SELECT * FROM Album_List'); 
							while ( $row = $result->fetch_assoc() ) {
								$id = $row[ 'album_id' ];
								$name = $row[ 'album_name' ]; 
							echo( "<li><a href='index.php?album_id=$id'>$name</a></li>");
							}
					?>
				</ul>
			</div>

			



			<?php
				$mysqli = new mysqli( DB_HOST, DB_USER, DB_PASSWORD, DB_NAME ); 
				$a_id=filter_input(INPUT_GET, 'album_id', FILTER_SANITIZE_NUMBER_INT);
				if($a_id >0 ){

					if (isset($_SESSION['valid_user'])) {
			            echo 
							"<form method='post'>
								Edit the Album Name: <input type='text' name='album_edit' placeholder='Edit Album Name'>
								<input class= 'submit' type='submit' name='edit' value='Edit Album Name'>
							</form>";

			            echo 
							"<form method='post'>
								<input type='submit' name='delete' value='Delete Album'>
							</form>";

						if ( isset($_POST['delete']) ) {
				            echo 
								"<p class='center'>Are you sure you want to delete this album?</p>
								<form method='post'>
									<input type='submit' name='confirmation' value='DELETE ALBUM'>
								</form>";
						}											

						if ( isset($_POST['edit']) ) {
							$album_edit = filter_input( INPUT_POST, "album_edit", FILTER_SANITIZE_STRING );
							$sql = "UPDATE Album_List SET album_name='$album_edit', date_modified=CURRENT_DATE() WHERE Album_List.album_id = $a_id";

							if ($mysqli->query($sql)) {
			    				echo "Album Name Changed";
							} else {
			    				echo "Error:". $mysqli->error;
							}
						}	


											
						if ( isset($_POST['confirmation']) ) {
							$sql = "DELETE FROM Album_List WHERE album_id = $a_id";
							if ($mysqli->query($sql)) {
			    				echo "Album Deleted from Album_List<br>";
							} else {
			    				echo "Error:". $mysqli->error;
							}

							$sql2 = "DELETE FROM Photo_Info WHERE album_id = $a_id";
							if ($mysqli->query($sql2)) {
			    				echo "Album Deleted from Photo_Info<br>";
							} else {
			    				echo "Error:". $mysqli->error;
							}
						}	
					}
					else {
						echo '<p class="center">Log In for Additional Features</p>';
	            		echo ("<p class='center'>Go to our <a href='login.php'>Login Page</a></p>");
					}	


					$result = $mysqli->query("SELECT * FROM Photos INNER JOIN Photo_Info ON Photos.photo_id=Photo_Info.photo_id WHERE album_id = $a_id"); 
					while ( $row = $result->fetch_assoc() ) {
						$title = $row[ 'title' ];
						$photoID = $row[ 'photo_id' ]; 
						$caption = $row[ 'caption' ];
						$path = $row[ 'photo_path' ];
						$file_url = urlencode( $photoID );
						echo( "	<div class='imagecontainer'>
									<p>$title</p>
									<a href='photo_detail.php?photo_id=$file_url'><img class='picture' src='$path' alt='$title' title='$title'></a>
									<p>$caption</p>
					 			</div>");
						}
							// All Images from Wikipedia
				}		

			?>
			

		</div> <!--End of page_body div-->

		<footer>
			<?php
    	  		include 'includes/bottom.php';
    		?> 
		</footer> <!-- end of footer div -->   
	</div> <!-- end of contents div -->
</body>

</html>