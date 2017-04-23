<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Search</title>
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
					Search
				</h1>
			</div> <!--End of banner div-->
			

			<?php
    	  		include 'includes/navbar.php';
    		?> 
    	</div> <!-- End of top_bar div -->

		<div class="page_body"> <!--Photo Gallery-->
			<div class="container">
				<h2>Search an Album</h2>
				<form method="post">
					Enter an Album Name:<input type="text" class="field" name="album_search" placeholder="Album"><br>
					<input type="submit" class="field" name="a_search" value="Search">
				</form>

				<h2>Search a Photo</h2>
				<form method="post">
					Enter an Photo Title or Caption:<input type="text" class="field" name="photo_search" placeholder="Photo Title or Caption"><br>
					<input type="submit" class="field" name="p_search" value="Search">
				</form>				
		    </div>  <!-- End of search_container div -->  	





		    <?php
		    require_once 'includes/config.php';

			if ( isset($_POST['a_search'])) {
				if (!empty($_POST['album_search'])){
					$album = filter_input( INPUT_POST, 'album_search', FILTER_SANITIZE_STRING );
					$mysqli = new mysqli( DB_HOST, DB_USER, DB_PASSWORD, DB_NAME ); 


					$result = $mysqli->query("SELECT * FROM Album_List WHERE album_name LIKE '%$album%'");
					echo "<div id='link_container'><ul>"; 
					while ( $row = $result->fetch_assoc() ) {
						$id = $row[ 'album_id' ];
						$name = $row[ 'album_name' ]; 
						echo( "<li><a href='index.php?album_id=$id'>$name</a></li>");
					}
					echo "</ul></div>";
					$mysqli->close();
				}
				else {
					echo "<p class='error'>Search Failed. Album Field Must Be Filled.</p>";
				}
			}		



			if ( isset($_POST['p_search'])) {
				if (!empty($_POST['photo_search'])) {
					$photo = filter_input( INPUT_POST, 'photo_search', FILTER_SANITIZE_STRING );
					$mysqli = new mysqli( DB_HOST, DB_USER, DB_PASSWORD, DB_NAME ); 
					$result = $mysqli->query("SELECT * FROM Photos WHERE title LIKE '%$photo%' OR caption LIKE '%$photo%'"); 
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
					$mysqli->close();
				}	
				else {
				echo "<p class='error'>Search Failed. Photo Field Must Be Filled.</p>";
				}	
			}		

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