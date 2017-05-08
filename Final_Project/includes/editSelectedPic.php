<?php
	$selectedPhoto = $mysqli->query("SELECT * FROM picsIn 
            INNER JOIN photos ON picsIn.imageID = photos.photoID 
            WHERE picsIn.photoID = $editing");

    $albums = "";
    //go through each line of the query to print out photo information
    while($row = $selectedPhoto->fetch_assoc()){
        $credit = $row['credit'];
        $desc = $row['description'];
        $displayTitle = $row['title'];
        $file_path = $row['picPath'];
        $photoID = $row['photoID'];
        $albumID = $row['albumID'];
        $albumName = $mysqli->query("SELECT a_title FROM albums WHERE albumID = $albumID");
        
        //tracks which albums the photo is in
        while($name = $albumName->fetch_assoc()){
            if(empty($albums)){
                $albums = $albums.$name['a_title'];
            }else{
                $albums = $albums.", ".$name['a_title'];
            }
        }
    }
    //reprint the picture and info
    print("<div class='displayingImages'>
            <h2> $displayTitle </h2> <br>
            <img src='$file_path'alt='$displayTitle'> <br>
            <label> $desc <br>
            $credit <br>
            Photo in albums: $albums</label></div>");

    //if deleting
    if(isset($_POST['delete'])){
    	$modInfo = $mysqli->query("SELECT albumID FROM picsIn WHERE photoID = '".$editing."'");
    	while($key = $modInfo->fetch_assoc()){
    		//change album size
    		$updater = $mysqli->query("UPDATE albums SET size = size-1 WHERE albums.albumID = '".$key['albumID']."'");
    	}
    	//remove from joint table
    	$delete = $mysqli->query("DELETE FROM picsIn WHERE photoID='".$editing."'");
    	$delete = $mysqli->query("DELETE FROM photos WHERE photoID='".$editing."'");
    }

    //print editing form
    print("<label><form method='post'>
            Change Title:<input type='text' name='changeTitle'><br>
            Change Description:<input type='text' name='changeDesc'><br>
            Change Credit:<input type='text' name='changeCred'><br>
            Add to Album: ");
    //get all the album names as checkboxes
	$SQLalbum = $mysqli->query("SELECT * FROM album");

    $counter = 1;
    //create a checkbox for each album
    while($name = $SQLalbum->fetch_row()){
        print("<input type='checkbox' name='where[]' value='$counter'>$name[0]");
        $counter++;
    }
    
	//delete button
	print("<input type='submit' name='submit' value='Edit'>
		<br><br>Delete Photo<input type='submit' name='delete' value='Delete'></form></label>");

	//if editing
    if(isset($_POST['submit'])){
        $title = filter_input(INPUT_POST, 'changeTitle', FILTER_SANITIZE_STRING);
        $description = filter_input(INPUT_POST, 'changeDesc', FILTER_SANITIZE_STRING);
        $credit = filter_input(INPUT_POST, 'changeCredit', FILTER_SANITIZE_STRING);
       	if(isset($_POST['where'])){
     	   $selected = $_POST["where"];
    	}
            $sql = "";
        if(!empty($title)){
        	$sql = "UPDATE photos SET title = '".$title."' WHERE photos.photoID = '".$editing."'";
        }
        if(!empty($description)){
            if(empty($sql)){
                $sql = "UPDATE photos SET description = '".$description."' WHERE photos.photoID = '".$editing."'";
            }else{
            	$sql += "AND SET description = '".$description."' WHERE photos.photoID = '".$editing."'";
            }
        }
        if(!empty($credit)){
            if(empty($sql)){
                $sql = "UPDATE photos SET credit = '".$credit."' WHERE photos.photoID = '".$editing."'";
            }else{
                $sql += "AND SET credit = '".$credit."' WHERE photos.photoID = '".$editing."'";
            }
        }
        if(!empty($selected)){
	        foreach($selected as $newAlbum){
	            //add the photo to albums
	            $insert =$mysqli->query("INSERT INTO picsIn(albumID, photoID) VALUES ('$newAlbum', '$editing')");
	            $update = $mysqli->query("UPDATE albums SET size = size+1 WHERE album.albumID = '".$newAlbum."' AND SET date_modified = CURRENT_DATE WHERE albums.albumID = '".$newAlbum."'");
	        }
	    }
    }
?>