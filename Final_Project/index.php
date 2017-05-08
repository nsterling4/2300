<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>SAAC</title>
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
					Welcome to SAAC 	
<!-- 					<img class="logo" src="images/cornell_white.jpeg" alt="Cornell Logo" title="Cornell University">  -->		         
				</h1>

			</div> <!--End of banner div-->
			

			<?php
    	  		include 'includes/navbar.php';
    		?> 
    	</div> <!-- End of top_bar div -->


		<div class="page_body"> <!--Info about the page-->

			<h2>Student Athlete Advisory Committee</h2>

			<div class="container">

			<p id="intro">Welcome to the Student Athlete Advisory Committee (SAAC) website. The Student-Athlete Advisory Committee serves as the communication line between student-athletes and the athlete administration. Its goal is to enhance the student-athlete experience. We are composed of representatives from all varsity sports, working with the athletic administration to enhance the Student Athlete experience. By NCAA rule, it is required that a SAAC is present on each Division I campus. </p>;

			<?php
				if (isset($_SESSION['valid_user'])) {
					echo '<p id="welcome_p">You are currently logged in. Unfortunately this page is still in construction, please try again later.</p>';
				}
				else {
					echo '<p id="welcome_p">This page is still in construction. For more features please <a href="login.php">Login</a></p>';
				}
			?> 
				
		    </div>  <!-- End of search_container div -->  
            <!--background slideshow pseudocode
            <php 
                open mysqli
                query photos
                foreach row of photos
            <img class="slides" src=$path>
    

                <script>
                w3.slideshow(".nature");
                </script>
            -->
		</div> <!--End of page_body div-->
        <!-- twitter api to link timeline on side of homepage
    <script>window.twttr = (function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0],
    t = window.twttr || {};
  if (d.getElementById(id)) return t;
  js = d.createElement(s);
  js.id = id;
  js.src = "https://platform.twitter.com/widgets.js";
  fjs.parentNode.insertBefore(js, fjs);

  t._e = [];
  t.ready = function(f) {
    t._e.push(f);
  };

  return t;
}(document, "script", "twitter-wjs"));</script> -->
		<footer>
			<?php
    	  		include 'includes/bottom.php';
    		?> 
		</footer> <!-- end of footer div -->   
	</div> <!-- end of contents div -->
</body>

</html>