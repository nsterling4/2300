<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Add Photo</title>
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
					Add Photo
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
	            "<form method='post' enctype='multipart/form-data'>
					<h2>Multiple Photo Upload</h2>
					<br>
					Enter a Title: <input type='text' name='title' placeholder='Photo Title'>
					Enter the Accreditation: <input type='text' name='credit' placeholder='Photo Credit'>
					<input id='new-photos' class= 'submit' type='file' name='newphotos[]' multiple> <br>
					<div class='checks'>";
						$mysqli = new mysqli( DB_HOST, DB_USER, DB_PASSWORD, DB_NAME ); 
						$result = $mysqli->query('SELECT * FROM Album_List'); 
							while ( $row = $result->fetch_assoc() ) {
								$id = $row[ 'album_id' ];
								$name = $row[ 'album_name' ]; 
								echo ("<input type='checkbox' name='albums[]' value=$id>$name");
							}
				echo 
				"	</div>	
						<textarea class='field' id= 'box' name='caption' rows='4' cols='70' placeholder='Enter a Caption'></textarea><br>
						<input class='field' name='submit' type='submit' value='Upload photo(s)'>
				</form>";			
	        } 
	        else {
	            echo '<p class="center">Please Log In to Upload a Photo</p>';
	            echo ("<p class='center'>Go to our <a href='login.php'>Login Page</a></p>");
	        }


		?>




		<?php


			//Check to see if files were uploaded using the "multiple file" form
			if ( isset($_POST['submit'])) {
				if ((!empty($_FILES['newphotos'])) && (!empty($_POST['title'])) && (!empty($_POST['caption'])) && (!empty($_POST['credit'])))  {
					//require_once 'includes/resize.php';
					$newPhotos = $_FILES['newphotos'];
					//print("made it into if");
					if (!empty($_POST['albums'])) {
						$ids = $_POST['albums'];
					}
					else {
						$ids=array(0); 
					}
					$photo_title = filter_input( INPUT_POST, 'title', FILTER_SANITIZE_STRING );
					$photo_caption = filter_input( INPUT_POST, 'caption', FILTER_SANITIZE_STRING );
					$photo_credit = filter_input( INPUT_POST, 'credit', FILTER_SANITIZE_STRING );
					$mysqli = new mysqli( DB_HOST, DB_USER, DB_PASSWORD, DB_NAME ); 
					if (sizeof($ids)===1) {
						for ( $i = 0; $i < count( $newPhotos['name'] ); $i++) {
							$originalName = $newPhotos['name'][$i];
							if ($newPhotos['error'][$i] == 0 ) {
								$tempName = $newPhotos['tmp_name'][$i];
								//Debugging
								//echo "Moving $tempName to images/$originalName";
								move_uploaded_file( $tempName, "images/$originalName" );
								//print("moved the file");
								//$_SESSION['photos'][] = $originalName;
								print("<p>The file $originalName was uploaded successfully.</p>");
								// save_thumbnail( "images/$originalName", "thumbnails/$originalName", 200 );


								$sql_photo= "INSERT INTO Photos(title, caption, photo_path, photo_credit) VALUES ('$photo_title','$photo_caption','images/$originalName', '$photo_credit')";


								if ($mysqli->query($sql_photo)) {
									$new_id=$mysqli-> insert_id; 
							
				    				echo "<p>New record created successfully. Photo table updated</p>";
								} 
								else {
				    				echo "<p>Error:</p>". $mysqli->error;
								}

								if ($ids[0]> 0) {

									$sql_photo_info= "INSERT INTO Photo_Info(album_id, photo_id) 
									VALUES ('$ids[0]','$new_id')";

									if ($mysqli->query($sql_photo_info)) {
					    				echo "<p>New record created successfully. Photo Info table updated</p>";
									} 
									else {
					    				echo "<p>Error:</p>". $mysqli->error;
									}

									$album_result = $mysqli->query("SELECT * FROM Album_List WHERE album_id='$ids[0]'"); 
									$size=0;
									while ( $row = $album_result->fetch_assoc() ) {
											$size = $row[ 'size' ];
									}	
									$size+=1;
									$album_sql = "UPDATE Album_List SET date_modified=CURRENT_DATE(),size='$size' WHERE album_id='$ids[0]'";

									
									if ($mysqli->query($album_sql)) {
					    				echo "New record created successfully. Album List table updated";
									} else {
					    				echo "Error:". $mysqli->error;
									}
								}	
							}	 
							else {
								print("<p>The file $originalName was not uploaded.</p>");
							}
						}

					}
					else {
						for ( $i = 0; $i < count( $newPhotos['name'] ); $i++) {
							$originalName = $newPhotos['name'][$i];
							if ($newPhotos['error'][$i] == 0 ) {
								$tempName = $newPhotos['tmp_name'][$i];
								//Debugging
								//echo "Moving $tempName to images/$originalName";
								move_uploaded_file( $tempName, "images/$originalName" );
								//print("moved the file");
								//$_SESSION['photos'][] = $originalName;
								print("<p>The file $originalName was uploaded successfully.</p>");
								// save_thumbnail( "images/$originalName", "thumbnails/$originalName", 200 );

								$sql_photo= "INSERT INTO Photos(title, caption, photo_path, photo_credit) VALUES ('$photo_title','$photo_caption','images/$originalName', '$photo_credit')";


								if ($mysqli->query($sql_photo)) {
									$new_id=$mysqli-> insert_id; 
					    			echo "<p>New record created successfully. Photo table updated</p>";
								} 
								else {
					    				echo "<p>Error:</p>". $mysqli->error;
								}


								foreach ($ids as $albumID) {


									$sql_photo_info= "INSERT INTO Photo_Info(album_id, photo_id) 
									VALUES ('$albumID','$new_id')";

									if ($mysqli->query($sql_photo_info)) {
					    				echo "<p>New record created successfully. Photo Info table updated</p>";
									} 
									else {
					    				echo "<p>Error:</p>". $mysqli->error;
									}

									$album_result = $mysqli->query("SELECT * FROM Album_List WHERE album_id='$albumID'"); 
									$size=0;
									while ( $row = $album_result->fetch_assoc() ) {
											$size = $row[ 'size' ];
									}	
									$size+=1;
									$album_sql = "UPDATE Album_List SET date_modified=CURRENT_DATE(),size='$size' WHERE album_id='$albumID'";

									
									if ($mysqli->query($album_sql)) {
					    				echo "New record created successfully. Album List table updated";
									} else {
					    				echo "Error:". $mysqli->error;
									}	
								}
							}	 
							else {
								print("<p>The file $originalName was not uploaded.</p>");
							}
						}
					}
				}
				else {
					echo "<p class='error'>Please Enter a Title, Accreditation, File, and Caption</p>";
				}
			}				

				


			?>
	
		    </div> <!-- End of addform_container div --> 
		</div> <!-- End of page_body div -->


		<footer>
			<?php
    	  	include 'includes/bottom.php';
    		?> 
		</footer> <!-- end of footer div -->  
	</div> <!-- end of contents div -->





</body>	

</html>


