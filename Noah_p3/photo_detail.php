<?php
	require_once 'includes/config.php';
	$mysqli = new mysqli( DB_HOST, DB_USER, DB_PASSWORD, DB_NAME ); 
	//$p_id=filter_input(INPUT_GET, 'photo_id', FILTER_SANITIZE_NUMBER_INT);
	$p_id=$_GET ['photo_id'];
	$album_array=array();
	$result = $mysqli->query("SELECT * FROM Photos LEFT JOIN Photo_Info ON Photos.photo_id=Photo_Info.photo_id LEFT JOIN Album_List ON Album_List.album_id = Photo_Info.album_id WHERE Photos.photo_id= $p_id"); 
		while ( $row = $result->fetch_assoc() ) {
			$title = $row[ 'title' ];
			$photoID = $row[ 'photo_id' ]; 
			$caption = $row[ 'caption' ];
			$path = $row[ 'photo_path' ];
			$credit = $row[ 'photo_credit' ];
			$albumID = $row[ 'album_id' ];
			$album_name = $row[ 'album_name' ];
			$date_c = $row[ 'date_created' ];
			$date_m = $row[ 'date_modified' ];
			$size = $row[ 'size' ];
		}

		
			

?>



<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title><?php print( $title )?></title>
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
					Photo Details
				</h1>
			</div> <!--End of banner div-->
			

			<?php
    	  		include 'includes/navbar.php';
    		?> 
    	</div> <!-- End of top_bar div -->

		<div class="page_body"> <!--Photo Gallery-->
			<h2><?php print( $title )?></h2>
			<div class="container">

				<div class="detail_container">
					<img <?php echo "src= $path alt=$title title=$title"?> >
					


					
					
					<div class='info'>
						<h3>Image Information</h3>
						<p>Title: <?php if (!empty($title)) {echo "$title";} else { echo "NOT ON RECORD"; }?></p>
						<p>ID: <?php if (!empty($photoID)){echo "$photoID";} else {echo "NOT ON RECORD";}?></p>
						<p>Caption: <?php if (!empty($caption)){echo "$caption";} else {echo "NOT ON RECORD";}?></p>
						<p>Credit: <?php if (!empty($credit)){echo "$credit";} else {echo "NOT ON RECORD";}?></p>
						<br>
					</div>	

					<div id= 'right' class='info'>
						<h3>Album Information</h3>
						<p>Name: <?php if (!empty($album_name)){echo "$album_name";} else {echo "NOT ON RECORD";}?></p>
						<p>ID: <?php if (!empty($albumID)){echo "$albumID";} else {echo "NOT ON RECORD";}?></p>
						<p>Date Created: <?php if (!empty($date_c)){echo "$date_c";} else {echo "NOT ON RECORD";}?></p>
						<p>Date Modified: <?php if (!empty($date_m)){echo "$date_m";} else {echo "NOT ON RECORD";}?></p>
						<p>Size: <?php if (!empty($size)){echo "$size";} else {echo "NOT ON RECORD";}?></p>
					</div>	


					<?php
					if (isset($_SESSION['valid_user'])) {
						echo 
						"<div id='edit_div'><div class='edit'>
							<h3 class='center'>Edit Image Information</h3>
							<form method='post'>
								Edit the Title of the Photo: <input type='text' name='edit_p_title' placeholder='Edit Photo Title'> 
								<p class='field2'>Edit the Credit of the Photo: </p><input class='field3' type='text' name='edit_p_credit' placeholder='Edit Photo Credit'><br>
								<p class= 'checks'>Edit the Caption of the Photo: </p> <textarea class='field' id= 'box' name='edit_p_caption' rows='4' cols='70' placeholder='Edit Photo Caption'></textarea>
								<input class='field' type='submit' name='edit_photo' value='Edit Photo Information'>
							</form>

							<form method='post'>
								<input type='submit' name='remove_photo' value='Remove Photo From Album'>
								<input type='submit' name='delete_photo' value='Delete Photo'>
							</form>

						</div>";	



						//Photo Confirmation
						if ( isset($_POST['remove_photo']) ) {
				            echo 
								"<p class='center'>Are you sure you want to remove this photo from this album?</p>
								<form method='post'>
									<input type='submit' name='photo_r_confirmation' value='REMOVE PHOTO'>
								</form>";
						}	

						//Photo Removal
						if ( isset($_POST['photo_r_confirmation']) ) {
							$sql = "DELETE FROM Photo_Info WHERE photo_id = $photoID";
							if ($mysqli->query($sql)) {
			    				echo "Photo Deleted from Photo_Info<br>";
							} else {
			    				echo "Error:". $mysqli->error;
							}

							$new_size=$size-1;

							$sql2 = "UPDATE Album_List SET size='$new_size', date_modified=CURRENT_DATE() WHERE Album_List.album_id = $albumID";
							if ($mysqli->query($sql2)) {
			    				echo "Size Updated in Album_List<br>";
							} else {
			    				echo "Error:". $mysqli->error;
							}
						}



						//Photo Confirm
						if ( isset($_POST['delete_photo']) ) {
				            echo 
								"<p class='center'>Are you sure you want to delete this photo? Doing so will remove it from the website entirely.</p>
								<form method='post'>
									<input type='submit' name='photo_d_confirmation' value='DELETE PHOTO'>
								</form>";
						}


						//Photo Removal
						if ( isset($_POST['photo_d_confirmation']) ) {
							$sql2 = "DELETE FROM Photos WHERE photo_id = $photoID";
							if ($mysqli->query($sql2)) {
			    				echo "Photo Deleted from Photos<br>";
							} else {
			    				echo "Error:". $mysqli->error;
							}

							$sql = "DELETE FROM Photo_Info WHERE photo_id = $photoID";
							if ($mysqli->query($sql)) {
			    				echo "Photo Deleted from Photo_Info<br>";
							} else {
			    				echo "Error:". $mysqli->error;
							}							
						}	



						if ( isset($_POST['edit_photo']) ) {
							if (!empty($_POST['edit_p_title']) || !empty($_POST['edit_p_credit']) || !empty($_POST['edit_p_caption'])) {
								if ( !empty($_POST['edit_p_title']) ) {
									$edit_pho_title = filter_input( INPUT_POST, "edit_p_title", FILTER_SANITIZE_STRING );
									$sql = "UPDATE Photos SET title='$edit_pho_title' WHERE Photos.photo_id = $photoID";
									if ($mysqli->query($sql)) {
					    				echo "Title Updated in Photos<br>";
									} else {
					    				echo "Error:". $mysqli->error;
									}
								}

								if ( !empty($_POST['edit_p_credit']) ) {
									$edit_pho_cred = filter_input( INPUT_POST, "edit_p_credit", FILTER_SANITIZE_STRING );
									$sql = "UPDATE Photos SET photo_credit='$edit_pho_cred' WHERE Photos.photo_id = $photoID";
									if ($mysqli->query($sql)) {
					    				echo "Credit Updated in Photos<br>";
									} else {
					    				echo "Error:". $mysqli->error;
									}
								}


								if ( !empty($_POST['edit_p_caption']) ) {
									$edit_pho_cap = filter_input( INPUT_POST, "edit_p_caption", FILTER_SANITIZE_STRING );
									$sql = "UPDATE Photos SET caption='$edit_pho_cap' WHERE Photos.photo_id = $photoID";
									if ($mysqli->query($sql)) {
					    				echo "Caption Updated in Photos<br>";
									} else {
					    				echo "Error:". $mysqli->error;
									}
								}
							}
							else {
							echo "<p class='error'>At Least One Field Must Be Filled</p>";	
							}
	
						}






						echo 
						"<div class='edit'>
							<h3 class='center'>Edit Album Information</h3>
							<form method='post'>
								<p class='center'>Edit the Name of the Album:</
							p>
								<input type='text' name='edit_a_title' placeholder='Edit Album Title'><br>
							<p class='center'>Add Photo to Existing Album(s)</
							p>
							<div class='checks'>";

							$result2 = $mysqli->query('SELECT * FROM Album_List'); 
							while ( $row = $result2->fetch_assoc() ) {
								$id = $row[ 'album_id' ];
								$name = $row[ 'album_name' ]; 
								echo ("<input type='checkbox' name='albums[]' value=$id>$name");
							}


						echo	"</div><br><div class='center2'><input  type='submit' name='edit_album_name' value='Edit Album'>
								<input  type='submit' name='delete_album' value='Delete Album'></div>
							</form>
						</div></div>	";

						//Delete Album Confirm
						if ( isset($_POST['delete_album']) ) {
				            echo 
								"<p class='center'>Are you sure you want to delete this album?</p>
								<form method='post'>
									<input type='submit' name='confirmation' value='DELETE ALBUM'>
								</form>";
						}	

						//Delete Album
						if ( isset($_POST['confirmation']) ) {
							$sql = "DELETE FROM Album_List WHERE album_id = $albumID";
							if ($mysqli->query($sql)) {
			    				echo "Album Deleted from Album_List<br>";
							} else {
			    				echo "Error:". $mysqli->error;
							}

							$sql2 = "DELETE FROM Photo_Info WHERE album_id = $albumID";
							if ($mysqli->query($sql2)) {
			    				echo "Album Deleted from Photo_Info<br>";
							} else {
			    				echo "Error:". $mysqli->error;
							}
						}



						//Change Album Name
						if ( isset($_POST['edit_album_name'])) {
							if (!empty($_POST['edit_a_title'] || (!empty($_POST['albums'])))) {
								if (!empty($_POST['edit_a_title'])) {
									$edit_alb_title = filter_input( INPUT_POST, "edit_a_title", FILTER_SANITIZE_STRING );
									$sql = "UPDATE Album_List SET album_name='$edit_alb_title', date_modified=CURRENT_DATE() WHERE Album_List.album_id = $albumID";

									if ($mysqli->query($sql)) {
					    				echo "Album Name Changed";
									} else {
					    				echo "Error:". $mysqli->error;
									}
								}
								if (!empty($_POST['albums'])) {
									$ids = $_POST['albums'];


									foreach ($ids as $array_album_id) {


										$photo_info_sql="INSERT INTO Photo_Info(album_id, photo_id) 
										VALUES ('$array_album_id','$photoID')";

										if ($mysqli->query($photo_info_sql)) {
						    				echo "New record created successfully. Photo_Info table updated<br>";
										} else {
						    				echo "Error:". $mysqli->error;
										}	


										$new__size=$size+1;
										$album_sql = "UPDATE Album_List SET date_modified=CURRENT_DATE(),size='$new__size' WHERE album_id='$albumID'";

										if ($mysqli->query($album_sql)) {
						    				echo "New record created successfully. Album List table updated<br>";
										} else {
						    				echo "Error:". $mysqli->error;
										}	

									}
								}
							}
							else {
							echo "<p class='error'>Album Name Must Be Filled</p>";	
							}	
						}



					}
					else {
						echo ("<div id='edit_div'><p class='center'>Log In for Additional Features</p>");
	            		echo ("<p class='center'>Go to our <a href='login.php'>Login Page</a></p></div>");
					}	
					?>

				</div>	




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