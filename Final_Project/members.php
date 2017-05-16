<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Members</title>
		<link rel="stylesheet" type="text/css" href="css/style.css">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
		<script src="includes/scripts.js"></script>
	</head>

<body>
	<div class="contents">
		<div class ="top_bar"> <!-- Contains header and Nav Bar -->
			<div class ="banner">
				<h1>
					Your One Stop Shop for Active Members
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
					// Membership info displayed in a table
    			print("<div>");

    			$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
			    $member = $mysqli->query("SELECT DISTINCT memberID, first_name, last_name, sport FROM members");

			    while($name = $member->fetch_assoc()){
			        //print("<div class='memberDisplay'>");
			    	$f_name = $name['first_name'];
            		$l_name = $name['last_name'];
            		$sport = $name['sport'];
            		$photoID = $name['photoID'];
            		$memberID = $name["memberID"];
            		if(!empty($photoID)){
            			$file_path = $mysqli->query("SELECT picPath FROM photos WHERE photoID = $photoID");
            			$photo = <img src='$file_path'alt='$f_name'>;
            		}

			        print( 
			            "<table> 
			                <tr>
			                	<td> $photo </td>
			                    <td> $f_name </td>
			                    <td> $l_name </td> 
			                    <td> $sport </td>
			                    <td>  <input type='checkbox' name='option[]'' value='$memberID'> In Attendance? </td>
			                </tr>
			            </table>");
			    }
			    print("<input type='submit' name='submit' value='Submit'>");
    			print("</div>");
    			if(isset($_POST["option"]) && isset($_POST["submit"])){
    				$selected = $_POST["option"];
    				foreach ($selected as $attneded) {
    					$mysqli->query("UPDATE members SET number_attend = number_attned+1 WHERE members.memberID = '$selected[$i]'");
    				}
    			}

				}
				else {
					echo '<p id="welcome_p">This page is still in construction. For more features please <a href="login.php">Login</a></p>';
				}
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
