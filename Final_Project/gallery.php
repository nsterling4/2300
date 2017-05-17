<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Gallery</title>
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
					Check Us Out
				</h1>
			</div> <!--End of banner div-->
			

            <?php
            include 'includes/navbar.php';
            if (isset($_POST["submitpic"]) && !empty( $_FILES[ 'newphoto' ] ) ) {
                $newPhoto = $_FILES[ 'newphoto' ];
                $originalName = $newPhoto['name'];
                if ( $newPhoto['error'] == 0 ) {
                    $tempName = $newPhoto['tmp_name'];
                    move_uploaded_file( $tempName, "images/$originalName");
                    $_SESSION['photos'][] = $originalName;
                    print("The file $originalName was uploaded successfully.\n");
     

            
                    $mysqli = new mysqli( DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
                    //fetching the data
                    $title = $_POST["title"];
                    $caption = $_POST["caption"];        
                    $credit = $_POST["credit"];
                    $path = "images/$originalName";
                    $album = $_POST['album'];
                    if ($mysqli->query("INSERT INTO photos (title, picPath, description, credit) VALUES ('$title', '$path', '$caption', '$credit')")){
                        print "<br> successful sql query";
                    };
                    if(!empty($_POST["newAlbum"]) && ($album == "newAlb")) {
                        $album = $_POST["newAlbum"];
                        $mysqli->query("INSERT INTO albums (a_title, size) VALUES ('$album', 1)");
                        $mysqli->query("INSERT INTO picsIn (albumID, photoID) VALUES ((SELECT albumID FROM albums WHERE a_title = '$album'), (SELECT photoID FROM photos WHERE title = '$title'))");
                    } else {
                        $mysqli->query("UPDATE albums SET size = size + 1 WHERE albumID = '$album'");
                        $mysqli->query("INSERT INTO picsIn (albumID, photoID) VALUES ('$album', (SELECT photoID FROM photos WHERE title = '$title'))");
                    };
                }
            }
    		?> 
    	</div> <!-- End of top_bar div -->

		<div class="page_body"> <!--Photo Gallery-->
			<div id="gallery_thumbnails">
			<!-- display a thumbnail for each album -->
				<?php
					//include 'includes/albumDisplayThumbnails.php';
				?>
			</div>
			<div id="imageDisplay">
			<!-- if a photo was selected -->
				<?php
					//include 'includes/photoSelect.php';
				?>
			</div>
			<div class="container">
			<?php
				if (isset($_SESSION['valid_user'])) {
                    $mysqli = new mysqli( DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
                    $result = $mysqli->query("SELECT * FROM albums");
                    //fetching the data
                   
                    echo '
                    <form method="post" enctype="multipart/form-data">
                    <label>Photo Title:</label> 
                    <input type="text" name="title" required>
                    <br>
                    <label>Caption:</label>
                    <input type="text" name="caption" required> 
                    <br>
                    <label>Credit:</label>
                    <input type="text" name="credit" required>
                    <br>
                    <label>File Upload:</label>
                    <input name="newphoto" type="file" required> <br>
                    <select id="album-select" name ="album" required>
                    <option></option>
                    <option value="newAlb">Enter New Album:</option>';
                     while ($row = $result->fetch_assoc()) {
                        $albumname = $row['a_title'];
                        $albumID = $row['albumID'];
                        print ("<option value=$albumID>$albumname</option>");
                     }
                    print '<input type="text" name="newAlbum" id="newAlbumEntry"> 
                        <br> <input value="Submit!" type="submit" name="submitpic">
                    </form>';
                    
				}
				else {
					echo '<p id="welcome_p">Only certain members can add albums or photos. For more features please <a href="login.php">Login</a></p>';
				}
			?> 
		    </div>  <!-- End of gallery_container div -->  	   
			<!-- 
            -->
            
		</div> <!-- End of page_body div -->
        <script>
            $("#album-select").change(function() {
            // START CODE Q1
                var $album_selection = $("#album-select").val();
                if($album_selection == "newAlb"){
                    $("#newAlbumEntry").show();
                } else {     
                    $("#newAlbumEntry").hide();
                };
            });
            </script>

		<footer>
			<?php
    	  	include 'includes/bottom.php';
    		?> 
		</footer> <!-- end of footer div -->  
	</div> <!-- end of contents div -->





</body>	

</html>
