<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Articles</title>
		<link rel="stylesheet" type="text/css" href="css/style.css">
		<link href="https://fonts.googleapis.com/css?family=Cormorant+SC|Linden+Hill|PT+Serif:700i" rel="stylesheet">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
		<script src="includes/scripts.js"></script>
		<script src="http://code.jquery.com/jquery-1.8.0.min.js"></script>
  		<script src="includes/texteditor.js"></script>
	</head>

<body>
	<div class="contents">
		<div class ="top_bar"> <!-- Contains header and Nav Bar -->
			<div class ="banner">
                <?php include 'includes/banner.php'; ?>
				<h1>
					Read more about SAAC
				</h1>
			</div> <!--End of banner div-->
			

			<?php
    	  		include 'includes/navbar.php';
    		?> 
    	</div> <!-- End of top_bar div -->

		<div class="page_body"> <!--Photo Gallery-->
			<div class="container">
				<div class="forms">
			   		<div class="ze ie"></div>
			   		<div id="controls">
			    		<a id="bold" class="font-bold">
			    		<button type="button">B</button>
					    </a>&nbsp;&nbsp;&nbsp;
					    <a id="italic" class="italic">
					    <button type="button">I</button>
					    </a>&nbsp;&nbsp;&nbsp;&nbsp;
					    <a id="link" class="link">
					    <button type="button">Link</button>
					    </a>&nbsp;&nbsp;&nbsp;&nbsp;
					    <select id="fonts" class="g-button">
						    <option value="Times">Times</option>
						    <option value="Arial">Arial</option>
						    <option value="Comic Sans MS">Comic Sans MS</option>
						    <option value="Courier New">Courier New</option>
						    <option value="Monotype Corsiva">Monotype</option>
			    		</select>
			   		</div>
			   		<iframe frameborder="0" id="textEditor"></iframe>
					<textarea name="text" id='text' rows="6" cols="53"></textarea>
					</div>
			<?php
				if (isset($_SESSION['valid_user'])) {
					echo '<p id="welcome_p">You are currently logged in. Unfortunately this page is still in construction, please try again later.</p>';
                  /**<button>Add an Article</button>
                    <script>"button".onclick: open text entry form,asks for article,
                    gives timestamp, photos, tags</script> (members and admin only)
				            **/
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
