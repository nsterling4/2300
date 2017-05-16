<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Advanced Search</title>
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
				<h1>
                    Find Anything on the Site
                </h1>
			</div> <!--End of banner div-->
			

			<?php
    	  		include 'includes/navbar.php';
    		?> 
    	</div> <!-- End of top_bar div -->

		<div class="page_body"> <!--Photo Gallery-->
			<div class="container">
                <form method="post" action="advSearch.php?side=Reps" name="search" id="fields">
                <p>Search Reps <br>
                    <label>Search Terms: </label>
                    <input name="lastName" type="text"> <br>
                    <label>Sport:</label>
                    <select name ="sport">
                        <option>Any Sport</option>
                        <?php 
                        $sports = ["Baseball", "MBasketball", "MXC", "Football", "Golf", "MHockey", "MLacrosse", "MPolo", "HWRowing", "LWRowing", "MSoccer", "SprintFootball", "MSquash", "MSwim&Dive", "MTennis", "MTrack&Field", "Wrestling", "WBasketball", "WXC", "Equestrian", "Fencing", "FieldHockey", "Gymnastics", "WHockey", "WLacrosse", "WPolo", "WRowing", "Sailing", "WSoccer", "Softball", "WSquash", "WSwim&Dive", "WTennis", "WTrack&Field", "Volleyball"];
                        foreach ($sports as $sport) {
                            print ("<option name=$sport>$sport</option>");
                        }
                        ?>
                    </select><br>
                        <label>Graduation Year:</label>                            
                            <select name ="Year">
                                <option></option>
                                <option name="2017">2017</option>
                                <option name="2018">2018</option>
                                <option name="2019">2019</option>
                                <option name="2020">2020</option>
                            </select><br>
                    <input value="Find Representatives" type="submit" name="repsearch">
                    </p>
                </form>
            
                <p id="fields">Search Posts</p>
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
