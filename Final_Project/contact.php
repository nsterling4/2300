<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Contact Us</title>
		<link rel="stylesheet" type="text/css" href="css/style.css">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
		<script src="includes/scripts.js"></script>
		<script src='https://www.google.com/recaptcha/api.js'></script>
	</head>

<body>
	<div class="contents">
		<div class ="top_bar"> <!-- Contains header and Nav Bar -->
			<div class ="banner">
				<h1>
					Get In Touch With Your SACC Representatives
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
						echo '<p id="welcome_p">You are currently logged in. Unfortunately this page is still in construction, please try again later.</p>';
					}
					else {
						echo '<p id="welcome_p">This page is still in construction. For more features please <a href="login.php">Login</a></p>';
					}
				?>  
				<form class="forms">
						Name: <input type="text" name="name">
						E-mail: <input type="text" name="email"><br><br>
						What is your affiliation to Cornell?<select name="affiliation"> 
							<option value="na">No Affiliation</option>
	            		    <option value="freshman">Freshman</option>
	                		<option value="sophmore">Sophmore</option>
	                		<option value="junior">Junior</option>
	                		<option value="senior">Senior</option>
	                		<option value="grad">Graduate Student</option>
	                		<option value="alum">Alumni</option>
	                		<option value="employee">Employee</option>
	            		</select> <br><br>
	            		Do you currently or previously have any direct involvement within Cornell Athletics?
	 						<input type="radio" name="involved" value="yes">Yes
	  						<input type="radio" name="involved" value="no">No <br><br>
	  					Leave us a comment, question, concern or suggestion: <br><textarea name="comment" rows="5" cols="40"></textarea> <br><br>

	  					<div class="g-recaptcha" data-sitekey="6LfZhCEUAAAAAByow4okr6-BdKw7Pc6S6dPHdLDP"></div> <br><br>
<!-- 
	  					<input type="submit" name="contact_submit" value="Submit"/>  -->

				</form> 	

		    </div>  <!-- End of container div -->  	   


<?php 
            // checks if the form has been submitted or not
          	if(isset($_POST["submit"])) {


                    $name= $_POST["name"];
                    $email= $_POST["email"];
                    $affiliation= $_POST["affiliation"];
                    $involved= $_POST["involved"];
                    $info= $_POST["comment"];


                    echo "Name: $name \n Email: $email \n Affiliation: $affiliation \n $Involved: $involved \n Comment: $info";

      
         //        // function to either add the performer and email pair to the array and display, or simply display the array as is    
         //        function perf_attend($Pname, $attended, $email, $artists) {
         //        	if ($attended==="yes" && isset($Pname) && isset($email) && (filter_var($email, FILTER_VALIDATE_EMAIL))) {
         //        		$artists["$Pname"]= "$email";
         //        		echo '<br>Glad to have you back! Take a look below at some of our other veteran performers<br>';
         //        		foreach ($artists as $key => $value) {
        	// 				echo "Performer: $key; Email: $value<br>";
    					// }
         //        	}
         //        	else if ($attended==="no" && isset($Pname) && isset($email) && (filter_var($email, FILTER_VALIDATE_EMAIL))){
         //        		echo '<br>Thank you for your interest, we look forward to having you perform at your first Apple Fest. If you want to know more about what it is like contact some of our previous performers. <br><br>';
         //        		foreach ($artists as $Pname => $email) {
        	// 			echo "  Performer: $Pname; Email: $email<br><br>";
    					// }  	
         //        	}
         //        	else {
         //        		echo "<br>All fields are required and must be valid";
         //        	}
         //        }
         //        // calls the function
         //        perf_attend ($Pname, $attended, $email, $artists);
               

            }
?>





		</div> <!-- End of page_body div -->


		<footer>
			<?php
    	  	include 'includes/bottom.php';
    		?> 
		</footer> <!-- end of footer div -->  
	</div> <!-- end of contents div -->





</body>	

</html>
