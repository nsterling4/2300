<?php
    print ('<form method="post" enctype="multipart/form-data">
                <table id="athleteform">
                    <tbody>
                        <tr>
                            <td><label>First Name*:</label></td>
                            <td><input name="firstName" type="text" required></td>
                        </tr>
                        <tr>
                            <td><label>Last Name*:</label></td>
                            <td><input name="lastName" type="text" required></td>
                        </tr>
                        <tr>
                            <td><label>Sport*:</label></td>
                            <td>
                                <select name ="sport" required>
                                      <option></option>');
    include 'includes/addMemHelp.php';
    print('                     </select>
                            </td>
                        </tr>
                        <tr>
                            <td><label>Graduation Year*:</label></td>
                            <td>                            
                                <select name ="Year" required>
                                    <option></option>
                                    <option name="2017">2017</option>
                                    <option name="2018">2018</option>
                                    <option name="2019">2019</option>
                                    <option name="2020">2020</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td><label>Is member an E-Board member?*:</label></td>
                            <td>                            
                                <select name ="admin" required>
                                    <option name="0">No</option>
                                    <option name="1">Yes</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td><label>Image:</label></td>
                            <td>
                                <p><input type="file" id="new-image" name="newphoto"></p>
                                <p><input type="text" id="titleinput" name="title" value="title" placeholder="Title"></p>
                                <p><input type="text" name="description" value="description" placeholder="Write Description Here">
                                <input type="text" name="credit" value="credit" placeholder="Photo Credit"></p>                            
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input value="Submit New Member" type="submit" name="addmember">
                            </td>
                        </tr>
                    </tbody>
                </table>
            </form>');
 // <input name="newphoto" type="file">
    if(isset($_POST['firstName']) && isset($_POST['lastName']) && isset($_POST['sport']) && isset($_POST['Year'])){
        $firstName = filter_input(INPUT_POST, 'firstName', FILTER_SANITIZE_STRING);
        $lastName = filter_input(INPUT_POST, 'lastName', FILTER_SANITIZE_STRING);
        $sport = $_POST['sport'];
        $year = $_POST['Year'];
        $adminMember = $_POST['admin'];

        //if no file was uploaded with member entry
        if(!file_exists($_FILES['newphoto']['tmp_name']) || !is_uploaded_file($_FILES['newphoto']['tmp_name'])) {
            if($adminMember === 0){
                //if not an admin member entry
                $memberInsert = $mysqli->query("INSERT INTO members(memberID, first_name, last_name, sport, class, number_attend, photoID, admin) VALUES (NULL, '$firstName', '$lastName', '$sport', '$year', '0', NULL, '0')");
            }
            else{
                //if an admin new member entry
                $memberInsert = $mysqli->query("INSERT INTO members(memberID, first_name, last_name, sport, class, number_attend, photoID, admin) VALUES (NULL, '$firstName', '$lastName', '$sport', '$year', '0', NULL, '1')");
            }
        }else{
            //if a photo was uploaded with member entry
            $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING);
            $description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING);
            $credit = filter_input(INPUT_POST, 'credit', FILTER_SANITIZE_STRING);
            $filePath = "";
            $newPhoto = $_FILES['newphoto'];

            //no errors, upload the file to server folder
            if($newPhoto['error'] == 0){
                $tempName = $newPhoto['tmp_name'];
                $filePath = "images/$title";
                move_uploaded_file($tempName, "$filePath");
                print("<p>Uploaded the file to the server folder successfully</p>");
            } else {
                print("<p>Error: The file $title was not uploaded.</p>");
            }
            
            //sql execution code for photo path upload to database
            $sqlAdd = "INSERT INTO photos(photoID, title, picPath, description, credit) VALUES (NULL, '$title', '$filePath', '$description', '$credit')";

            //execution of if statement will run query insertion
            if($mysqli ->query($sqlAdd)){
                //select most recent inputed member
                $query = $mysqli->query("SELECT * FROM photos ORDER BY photoID DESC LIMIT 1");
                $idNumber = $query->fetch_assoc();
                $x = $idNumber['photoID'];

                //add the photo to albums
                $sql = $mysqli->query("INSERT INTO picsIn(albumID, photoID) VALUES ('1', '$x')");
                $memberAdd = "";
                if($admin === 0){
                    $memberAdd = "INSERT INTO members(memberID, first_name, last_name, sport, class, number_attend, photoID, admin) VALUES (NULL, '$firstName', '$lastName', '$sport', '$year', '0', '$x', '0')";
                }else{
                    $memberAdd = "INSERT INTO members(memberID, first_name, last_name, sport, class, number_attend, photoID, admin) VALUES (NULL, '$firstName', '$lastName', '$sport', '$year', '0', '$x', '1')";
                }
                $insert = $mysqli->query($memberAdd);
                $update = $mysqli->query("UPDATE albums SET date_last_mod = timestamp WHERE albums.albumID = '1'");
                $update = $mysqli->query(" UPDATE albums SET size = size+1 WHERE albums.albumID = '1'");
            }else{
                $memberAdd = "";
                if($admin === 0){
                    $memberAdd = "INSERT INTO members(memberID, first_name, last_name, sport, class, number_attend, photoID, admin) VALUES (NULL, '$firstName', '$lastName', '$sport', '$year', '0', NULL, '0')";
                }else{
                    $memberAdd = "INSERT INTO members(memberID, first_name, last_name, sport, class, number_attend, photoID, admin) VALUES (NULL, '$firstName', '$lastName', '$sport', '$year', '0', NULL, '1')";
                }
                $memberInsert = $mysqli->query($memberAdd);
                print("<h3>ERROR: Did not upload photo into the database, but member has been added</h3>" . $mysqli->error);
            }
        }
    }
?>