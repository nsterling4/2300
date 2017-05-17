<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>ADMINS ONLY</title>
		<link rel="stylesheet" type="text/css" href="css/style.css">
		<link href="https://fonts.googleapis.com/css?family=Cormorant+SC|Linden+Hill|PT+Serif:700i" rel="stylesheet">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	</head>

	<body>
		<?php
			require_once 'includes/config.php';
		?>
		<div class="contents">
		<!-- Contains header and Nav Bar -->
			<div class ="top_bar">
				<div class ="banner">
					<h1>
						Attendance Records
					</h1>
				</div>
				<!--End of banner div-->

				<?php
	    	  		include 'includes/navbar.php';
	    		?> 
	    	</div>
	    	<!-- End of top_bar div -->

			<div class="page_body"> <!--Photo Gallery-->
				<div class="container">
					
			    </div>  <!-- End of search_container div -->

				<?php
					$mysqli = new mysqli( DB_HOST, DB_USER, DB_PASSWORD, DB_NAME );
					$member = $mysqli->query("SELECT DISTINCT memberID, first_name, last_name, sport, class, photoID FROM members");
					
					if(isset($_POST["Remove"])){
						$removeList = $_SESSION["attendanceRemove"];
						foreach ($removeList as $r) {
							$delete = $mysqli->query("DELETE FROM meeting_attend WHERE entry = $r");
						}
						print("<div class='forms'>Attendance Records Have Been Removed</div>");
						unset($_SESSION['attendanceRemove']);
					}
				
					if(isset($_POST["CANCEL"])){
						print("<div class='forms'>Entries Have Been Unselected</div>");
					}
					$attend = $mysqli->query("SELECT entry, memberID, meetDate FROM meeting_attend ORDER BY memberID ASC AND ORDER BY meetDate DESC");
					$member = $mysqli->query("SELECT DISTINCT COUNT(*) FROM members INNER JOIN meeting_attend ON members.memberID = meeting_attend.memberID ORDER BY members.last_name ASC");

					if(!empty($_POST["deleteAttend"])&& isset($_POST['submitAttendance'])){
	    				//double check that they actually want to remove the selected members
						print("<form method='post'>Are you sure you want to delete selected Attendance Records? <br>
							<input type='submit' name='Remove' value='Remove'><input type='submit' name='CANCEL' value='CANCEL'></form>");
						$_SESSION['attendanceRemove'] = $_POST['deleteAttend'];
		    		}

		    		$att = $member->fetch_row();
		    		if($att[0] >0){
		    			$member = $mysqli->query("SELECT DISTINCT * FROM members INNER JOIN meeting_attend ON members.memberID = meeting_attend.memberID ORDER BY members.last_name ASC");

					    while($info = $member->fetch_assoc()){
					    	$f_name = $info['first_name'];
		            		$l_name = $info['last_name'];
		            		$year = $info['class'];
		            		$memberID = $info["memberID"];
		            		$entry = $info['entry'];
		            		$attend = $mysqli->query("SELECT meetDate FROM meeting_attend WHERE memberID = '$memberID' ORDER BY meetDate DESC");
		            		//go through all entries of $attend and display in order
		            		foreach ($attend as $displayA) {
		            			$dateA = $displayA['meetDate'];
		            			print("
										<form method='post' class='memberClassL' enctype='multipart/form-data'>
											<table> 
												<tr>
								                    <td> $f_name </td>
								                    <td> $l_name </td>
								                    <td> $year </td>
								                    <td> Date Attended $dateA </td>
								                    <td> <input type='checkbox' name='deleteAttend[]' value=$entry> Delete This Record of Attendance</td>
								                </tr>
								            </table>
							        ");
							}
			    		}
			    		print("<input type='submit' name='submitAttendance' value='Submit'></form>");
			    	}else{
			    		print("<div class = 'forms'><h2>There are no records of attendance for any members to be displayed</h2></div>");
			    	}

					$mysqli->close();
				?>
			</div>
			<!-- End of page_body div -->

			<footer>
				<?php
	    	  	include 'includes/bottom.php';
	    		?> 
			</footer> <!-- end of footer div -->  

		</div> <!-- end of contents div -->
	</body>	
</html>