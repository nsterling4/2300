<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>About Us</title>
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
					Learn More About SAAC And Our Values
				</h1>
			</div> <!--End of banner div-->
			

			<?php
    	  		include 'includes/navbar.php';
    		?> 
    	</div> <!-- End of top_bar div -->

		<div class="page_body"> <!--Photo Gallery-->
			<div class="container">

			<h2> Our Web Administrators and Executive Board</h2>
			<?php
			 $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
			 $member = $mysqli->query("SELECT DISTINCT memberID, first_name, last_name, sport, class, photoID FROM members WHERE admin = 1");
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
				                </tr>
				            </table>");
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