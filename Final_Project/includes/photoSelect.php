<?php
    $link_ID = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
    $photoSelect = filter_input(INPUT_GET, 'secondID', FILTER_SANITIZE_NUMBER_INT);
    $editing = filter_input(INPUT_GET, 'thirdID', FILTER_SANITIZE_NUMBER_INT);

    //display the album options
    if($link_ID){
        $idOfAlbum = $link_ID;
        $selectedAlbum = $mysqli->query("SELECT * FROM picsIn
            INNER JOIN photos ON picsIn.imageID = photos.photoID 
            WHERE picsIn.albumID = $idOfAlbum");

        //go through each line of the query to print out photo information
        while($row = $selectedAlbum->fetch_assoc()){
            $displayTitle = $row['title'];
            $file_path = $row['picPath'];
            $photoID = $row['photoID'];

            print("<div class='displayingImages'>
                <a href='photos.php?secondID=$photoID'>
                <img src='$file_path'alt='$displayTitle'></a></div>");
        }
    }

    //when you select a photo to view
    if($photoSelect){
        $selectedPhoto = $mysqli->query("SELECT * FROM picsIn 
            INNER JOIN photos ON picsIn.imageID = photos.photoID 
            WHERE picsIn.photoID = $photoSelect");

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

        //if logged in, you can edit picture, displays a different photo description
        if(isset($_SESSION['logged_user_by_sql'])){
            print("<div class='displayingImages'>
                        <h2> $displayTitle </h2> <br>
                        <img src='$file_path'alt='$displayTitle'> <br>
                        <label> $desc <br>
                        $credit <br>
                        Photo in albums: $albums<br>
                        <a href='photos.php?thirdID=$photoID'>Edit</a></label></div>");
        }else{
            //when you aren't logged in, you can still view the photo info
            print("<div class='displayingImages'>
                        <h2> $displayTitle </h2> <br>
                        <img src='$file_path'alt='$displayTitle'> <br>
                        <label> $desc <br>
                        $credit <br>
                        Photo in albums: $albums</label></div>");
        }
    }

    //if you are logged in and selected a photo
    if($editing){
        include("includes/editSelectedPic.php");
    }
?>