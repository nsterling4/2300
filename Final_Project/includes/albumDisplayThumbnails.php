<?php
    require_once 'includes/config.php';

    $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    $thumbnails = $mysqli->query("SELECT DISTINCT albumID, photoID FROM picsIn");
    $album = $mysqli->query("SELECT * FROM albums");
    $pics = $mysqli->query("SELECT * FROM photos");

    while($name = $album->fetch_row()){
        print("<div class='albumDisplay'>");

        //id number of the album working with
        $albumID = $name[0];

        //if size of album is greater than 0
        if($name[3] > 0){

            //loop through thumbnails (albumID and imageID rows from includedInAlbum) entries
            while($entry = $thumbnails->fetch_assoc()) {

                //the entry from thumbnails (the row) where $albumID (albums table) equals the albumID from thumbnails
                if($entry['albumID'] === $albumID){

                    //loop through $pics to match imageID with imageID of current thumbnails row
                    while($row = $pics->fetch_assoc()){

                        //photoIDs match up to imageID(from thumbnails)
                        if($row['photoID'] === $entry['photoID']){
                            
                            //filepath
                            $picFile = $row['picPath']; 

                            //title of image for alt pic
                            $alternative = $row['title']; 

                            //display the picture and the name of album
                            print("<div class='gallery'><a href='gallery.php?id=$name[0]'><img src='$picFile' alt='$alternative'><h3 id='albumH3'>Pictures from $name[1]</h3></a></div>");
                            
                            //end foreach for $pics
                            break;
                        }
                    }
                    break;  //end foreach for $$thumbnails
                }
            }
            
        }else{
            //just print the title of the album
            print("<div class='gallery'><a href='gallery.php?id=$name[0]'><h3>No Pictures In This Album: $name[1]</h3></a></div>");
        }
        print("</div>");
    }
?>