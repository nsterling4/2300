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
				<?php
    	  			include 'includes/mail.php';
    			?> 
				
				<form method="post" class="forms">
						<p><span class="error">* required field.</span></p>

						Name: <input type="text" name="name">
						<span class="error">* <?php echo $nameErr;?></span><br>

						E-mail: <input type="text" name="email">
						  <span class="error">* <?php echo $emailErr;?></span><br><br>

						What is your affiliation to Cornell? <span class="error">*</span>
						<select name="affiliation"> 
							<option value="empty"></option>
							<option value="na">No Affiliation</option>
	            		    <option value="freshman">Freshman</option>
	                		<option value="sophmore">Sophmore</option>
	                		<option value="junior">Junior</option>
	                		<option value="senior">Senior</option>
	                		<option value="grad">Graduate Student</option>
	                		<option value="alum">Alumni</option>
	                		<option value="employee">Employee</option>
	            		</select>
	            		<span class="error"><?php echo $affiliationErr;?></span> <br><br>

	            		Do you currently or previously have any direct involvement within Cornell Athletics? <span class="error">*</span><br><br>
	 						<input type="radio" name="involved" value="yes">Yes
	  						<input type="radio" name="involved" value="no">No 
	  						<span class="error"><?php echo "<br>$involvedErr";?></span><br>

	  					Leave us a comment, question, concern or suggestion: <span class="error">*</span>
	  					 <br><textarea name="comment" rows="5" cols="40"></textarea> 
	  					<span class="error"><?php echo "<br>$commentErr";?></span><br><br>

	  					<div class="g-recaptcha" data-sitekey="6LfZhCEUAAAAAByow4okr6-BdKw7Pc6S6dPHdLDP"></div> <br><br>

	  					<input type="submit" name="submit" value="Submit"/> 

				</form> 






		    </div>  <!-- End of container div -->  	 














		</div> <!-- End of page_body div -->


		<footer>
			<?php
    	  	include 'includes/bottom.php';
    		?> 
		</footer> <!-- end of footer div -->  
	</div> <!-- end of contents div -->





</body>	

</html>
