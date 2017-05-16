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
                <?php include 'includes/banner.php'; ?>
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
			<h3>Our Active Members</h3>
				<div class="admin_login">
				<ul>
				<?php
			        if (isset($_SESSION['admin_user'])) {
			            echo '<li><a href="logout.php">Logout</a></li>';
			        } else {
			            echo '<li><a href="login.php">Admin Login</a></li>';
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
                    if((!empty($_POST["option"]) || !empty($_POST["remove"])) && !empty($_POST["submit"])){
		    			if(!empty($_POST["option"])){
		    				$selected = $_POST["option"];
		    				foreach ($selected as $attended) {
		    					$meetingAttend = $mysqli->query("INSERT INTO meeting_attend(date, memberID) VALUES (CURRENT_DATE, '$attended'");
		    				}
		    			}if(!empty($_POST["remove"])){
		    				$removeList = $_POST["remove"];
		    				print("<div class='forms'>Are you sure you want to delete these members? <br>
		    					<input type='submit' name='imsure value='Yes'>I'm Sure");
		    				if(isset($_POST["imsure"])){
		    					foreach ($removeList as $r) {
		    						$delete = $mysqli->query("DELETE FROM members WHERE memberID=$r");
		    					}
		    				}
		    			}
	    			}
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
		    			print("</div>");
			    	}
			    	print("<input type='submit' name='submit' value='Submit'>");
		    			//update attendance and/or remove members
	    			

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
