<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Gallery</title>
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
					Gallery
				</h1>
			</div> <!--End of banner div-->
			

			<?php
    	  		include 'includes/navbar.php';
    		?> 
    	</div> <!-- End of top_bar div -->

		<div class="page_body"> <!--Photo Gallery-->
			<div class="container">
				<?php
				$mysqli = new mysqli( DB_HOST, DB_USER, DB_PASSWORD, DB_NAME ); 
				$result = $mysqli->query('SELECT * FROM Photos'); 
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
				?>
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
