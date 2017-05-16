<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Contact Us</title>
		<link rel="stylesheet" type="text/css" href="css/style.css">
		<link href="https://fonts.googleapis.com/css?family=Cormorant+SC|Linden+Hill|PT+Serif:700i" rel="stylesheet">
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
				<form method="post" class="forms">
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

	  					<input type="submit" name="submit" value="Submit"/> 

				</form> 	

		    </div>  <!-- End of container div -->  	 



		    <?php 



            // checks if the form has been submitted or not
          	if(isset($_POST["submit"])) {

                    $name= filter_input( INPUT_POST, trim('name'), FILTER_SANITIZE_STRING );
                    $email= filter_input( INPUT_POST, trim('email'), FILTER_SANITIZE_STRING );
                    $affiliation= filter_input( INPUT_POST, trim('affiliation'), FILTER_SANITIZE_STRING );
                    $involved= filter_input( INPUT_POST, trim('involved'), FILTER_SANITIZE_STRING );
                    $info= filter_input( INPUT_POST, trim('comment'), FILTER_SANITIZE_STRING );


                    echo "Name: $name \n Email: $email \n Affiliation: $affiliation \n $Involved: $involved \n Comment: $info";


                        // EDIT THE 2 LINES BELOW AS REQUIRED
    		$email_to = "nas95@cornell.edu";
    		$email_subject = "CONTACT US";


    		$email_message="Name: $name \n Email: $email \n Affiliation: $affiliation \n $Involved: $involved \n Comment: $info";
  
 
    // $email_message .= "Name: ".clean_string($name)."\n";
    // $email_message .= "Email: ".clean_string($email)."\n";
    // $email_message .= "Affiliation: ".clean_string($affiliation)."\n";
    // $email_message .= "Involved: ".clean_string($involved)."\n";
    // $email_message .= "Comments: ".clean_string($info)."\n";
 
// create email headers
	mail($email_to, $email_subject, $email_message); 
 
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
