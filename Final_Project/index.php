<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>SAAC</title>
		<link rel="stylesheet" type="text/css" href="css/style.css?v=221">
		<link href="https://fonts.googleapis.com/css?family=Cormorant+SC|Linden+Hill|PT+Serif:700i" rel="stylesheet">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
		<script src="includes/scripts.js"></script>
	</head>

	<div class="contents">

		<div class ="top_bar"> <!-- Contains header and Nav Bar -->
			<div class ="banner">
        <span id="button"><button id="quicksearch">Search Site</button></span>
				<h1>Welcome to SAAC</h1>
<!-- <img class="logo" src="images/cornell_white.jpeg" alt="Cornell Logo" title="Cornell University">  -->
        <div id="dropdownsearch">
          <form action="search.php" method="post"> 
            <br> Search 
            <select name ="searchbar" required>
              <option value="all">Entire Site</option>
              <option value="reps">SAAC Members</option>
              <option value="articles">Articles</option>
              <option value="events">Events</option>
              <option value="albums">Albums</option>                        
            </select>
              for :
              <input type="text" name="searchterm" required>
              <input type="submit" value="search" name="search"> <br>
              Need More Fields? -<a href="advSearch.php">Advanced Search</a>
          </form>
        </div>
			</div> <!--End of banner div-->
			

			<?php
    	  include 'includes/navbar.php';
    	?> 
    </div> <!-- End of top_bar div -->

		<div class="page_body"> <!--Info about the page-->
		  <div class="slide_show">
  			<img class="SAAC_Rep_img" src="images/2017Reps.jpg" alt="SACC_Reps">
  			<img class="SAAC_Rep_img" src="images/2016Reps.jpg" alt="SACC_Reps">
  			<img class="SAAC_Rep_img" src="images/2015Reps.jpg" alt="SACC_Reps">
  			<img class="SAAC_Rep_img" src="images/2014Reps.jpg" alt="SACC_Reps">
        <script src="js/main.js"></script>
		  </div>

      <div class="container" id= "main_cont">
        <br>
        <h2 id='title'>Student Athlete Advisory Committee</h2>
        <br><br><br><br>

        <p id="intro">Welcome to the Student Athlete Advisory Committee (SAAC) website. The Student-Athlete Advisory Committee serves as the communication line between student-athletes and the athlete administration. Its goal is to enhance the student-athlete experience. We are composed of representatives from all varsity sports, working with the athletic administration to enhance the Student Athlete experience. By NCAA rule, it is required that a SAAC is present on each Division I campus. </p>
      </div> 
		</div> 

    <script>
       //Array of images which you want to show: Use path you want.
      // var images=new Array('images/2017Reps.jpg','images/2016Reps.jpg','images/2015Reps.jpg', 'images/2014Reps.jpg');
      // var nextimage=0;
      // doSlideshow();

      // function doSlideshow(){
      //   if(nextimage>=images.length){nextimage=0;}
      //     $('.page_body')
      //       .css('background-image','url("'+images[nextimage++]+'")')
      //       .fadeIn("slow",function(){
      //         setTimeout(doSlideshow,4000);
      //       });
      // }

    </script>
    <script type="text/javascript">
      $("#quicksearch").click(function(){
        $("#dropdownsearch").toggle('display');
        console.log("LOL so close");
      });
    </script>
		<footer>
			<?php
    	  include 'includes/bottom.php';
    	?> 
		</footer> <!-- end of footer div -->   
	</div> <!-- end of contents div -->
    
</body>

</html>