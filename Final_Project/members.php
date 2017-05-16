<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Members</title>
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
				<h1>
					Members
				</h1>
			</div> <!--End of banner div-->
			

			<?php
    	  		include 'includes/navbar.php';
    		?> 
    	</div> <!-- End of top_bar div -->
    	
		<div class="page_body"> <!--Photo Gallery-->
			<div class="container">
			<h3>Our Active Members</h3>
				<div class="admin_login">
				<ul>
				<?php
					echo "Admin Login";
			        if (isset($_SESSION['valid_user'])) {
			            echo '<li><a href="logout.php">Logout</a></li>';
			        } else {
			            echo '<li><a href="login.php">Login</a></li>';
			        }
				?>
				</ul>
				</div>


			<?php
				print("<div>");

    			$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
			    $member = $mysqli->query("SELECT DISTINCT memberID, first_name, last_name, sport, class, photoID FROM members");

			   	//if admin logged in
				if (isset($_SESSION['admin_user'])) {
				//put member adding form here
                    
                    include 'includes/addMemForm.php';
						
				    while($name = $member->fetch_assoc()){
				        //print("<div class='memberDisplay'>");
				    	$f_name = $name['first_name'];
	            		$l_name = $name['last_name'];
	            		if(!empty($name['sport'])){
	            			$sport = $name['sport'];
	            		}if(empty($name['sport'])){
	            			$sport = "-------";
	            		}
	            		$year = $name['class'];
	            		$memberID = $name["memberID"];

	            		// Membership info displayed in a table
				        print( 
				            "<table> 
				                <tr>
				                    <td> $f_name </td>
				                    <td> $l_name </td> 
				                    <td> $sport </td>
				                    <td> $year </td>
				                    <td> <input type='checkbox' name='option[]'' value='$memberID'> In Attendance of Meeting? </td>
				                    <td> <input type='checkbox' name='remove[]' value='$memberID'> Remove Member?</td>
				                </tr>
				            </table>");
					    print("<input type='submit' name='submit' value='Submit'>");
		    			print("</div>");
			    	}
		    			//update attendance and/or remove members
	    			if((isset($_POST["option"]) || isset($_POST["remove"])) && isset($_POST["submit"])){
		    			if(!empty($_POST["option"])){
		    				$selected = $_POST["option"];
		    				//Add code for uploading a file.
		    				$insert = $mysqli->query("INSERT INTO meetings(date, agenda) VALUES (CURRENT_DATE, 'figure out how to add file'");
		    				foreach ($selected as $attended) {
		    					$meetingAttend = $mysqli->query("INSERT INTO meeting_attend(meetingID, memberID) VALUES (CURRENT_DATE, '$attended'");
		    				}
		    			}if(!empty($_POST["remove"])){
		    				$removeList = $_POST["remove"];
		    				print("<div class='forms'>Are you sure you want to delete these members? <br>
		    					<input type='submit' name='imsure value='Yes'>I'm Sure");
		    				if(isset($_POST["imsure"])){
		    					foreach ($removeList as $r) {
		    						$delete = $mysqli->query("DELETE FROM members WHERE memberID=$r");
		    						//$changeAuto = $mysqli->query("ALTER TABLE members auto_increment = auto_increment - 1");
		    					}
		    				}
		    			}
	    			}

				}else {
					while($name = $member->fetch_assoc()){
				        print("<div class='memberDisplay'>");
				    	$f_name = $name['first_name'];
	            		$l_name = $name['last_name'];
	            		if(!empty($name['sport'])){
	            			$sport = $name['sport'];
	            		}if(empty($name['sport'])){
	            			$sport = "-------";
	            		}
	            		$year = $name['class'];
	            		$memberID = $name["memberID"];
						print(
							"<table>
								<tr>
									<td> $f_name </td>
									<td> $l_name </td>
									<td> $sport </td>
									<td> $year </td>
								</tr>
							</table>");
			    		print("</div>");
			    	}
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
