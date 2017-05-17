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
					Meet our Many Members

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
				print("<div id='mem_tab'>");

    			$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
			    $member = $mysqli->query("SELECT DISTINCT memberID, first_name, last_name, sport, class, photoID FROM members");

			   	//if admin logged in
				if (isset($_SESSION['admin_user'])) {
					//if any members were selected for deleting or attendance
                    if(isset($_POST["option"]) || isset($_POST["remove"]) && isset($_POST["submit"])){
                    	//if members were choosen for attendance
		    			if(!empty($_POST["option"])){
		    				$selected = $_POST["option"];
		    				//check to see if today is actually a valid meeting to check attendance for
		    				$meetValid = $mysqli->query("SELECT * FROM meetings WHERE meetDate = CURRENT_DATE");
		    				if(!empty($meetValid)){
		    					//if valid, go through each member selected and increase their tracked attendance number and create an entry for what meeting they have attended
			    				foreach ($selected as $attended) {

			    					//meetingAttend code isn't working
			    					$meetingAttend = $mysqli->query("INSERT INTO meeting_attend(meetDate, memberID) VALUES (CURRENT_DATE, '$attended'");
			    					//increase works
			    					$increase = $mysqli->query("UPDATE members SET number_attend = number_attend +1 WHERE members.memberID = $attended");
			    				}
			    				print("<div class='forms'>Attendance has been taken</div>");
			    			}else{
			    				print("<div class='forms'>Please Create A Meeting For Today Before Taking Attendance</div>");
			    			}
		    			}
		    			//if members were selected to be removed
		    			if(!empty($_POST["remove"])){
		    				//this code isn't working, even when it's here. Displays confirmation then after selecting an option, does nothing
		    				include 'includes/removeMemHelp.php';
		    			}
		    			
	    			}
                    include 'addMemForm.php';
						
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
				            "<form method='post' class='memberClassL' enctype='multipart/form-data'><table> 
				                <tr>
				                    <td> $f_name </td>
				                    <td> $l_name </td> 
				                    <td> $sport </td>
				                    <td> $year </td>
				                    <td> <input type='checkbox' name='option[]'' value='$memberID'> In Attendance of Meeting? </td>
				                    <td> <input type='checkbox' name='remove[]' value='$memberID'> Remove Member?</td>
				                </tr>
				            </table>");
			    	}
			    	print("<input type='submit' name='submit' value='Submit'></form>");
			    	print("</div>");
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
