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
        <?php
        if (isset($_GET['side'])) {
            $searchSide = $_GET['side'];
         
        if(($searchSide == "Reps") && (!empty($_POST['repterm']))) {
            require_once 'includes/config.php';
            $mysqli = new mysqli( DB_HOST, DB_USER, DB_PASSWORD, DB_NAME );
            $keyword = $_POST['repterm'];
            $keyword = $mysqli->real_escape_string($keyword);
            $sport = $_POST['sport'];
            $year = $_POST['Year'];
            $query = "SELECT DISTINCT * FROM members WHERE first_name LIKE '%$keyword%' OR  last_name LIKE '%$keyword%' AND sport LIKE '%$sport%' AND class LIKE '%$year%'";
            $result = $mysqli->query($query);
            while ($row = $result->fetch_assoc()) {
                print "<p>$row[first_name]</p>";
            }
        }
        
        if(($searchSide == "Posts") && (!empty($_POST['postterm']))) {
            require_once 'includes/config.php';
            $mysqli = new mysqli( DB_HOST, DB_USER, DB_PASSWORD, DB_NAME );
            $keyword = $_POST['postterm'];
            $keyword = $mysqli->real_escape_string($keyword);
            $entry = $_POST['post'];
            if ($entry == 'events'){
                $query = "SELECT DISTINCT * FROM events WHERE name LIKE '%$keyword%' OR  description LIKE '%$keyword%'";
            } else if ($entry == 'albums') {
                $query = "SELECT DISTINCT * FROM albums WHERE a_title LIKE '%$keyword%' OR  description LIKE '%$keyword%'";
            }  else {
                $query = "SELECT DISTINCT * FROM photos WHERE credit LIKE '%$keyword%' OR title LIKE '%$keyword%' OR description LIKE '%$keyword%'";
            }
                $result = $mysqli->query($query);
                while ($row = $result->fetch_assoc()) {
                    print "<p>$row<p>";
                }
            }
        }
        ?>
		<div class="page_body"> <!--Photo Gallery-->
			<div class="container">
                <form method="post" action="advSearch.php?side=Reps" id="fields">
                <strong>Search Reps</strong> <br>
                    <label>Search Terms: </label>
                    <input name="repterm" type="text" required> <br>
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
                                <option value="%">Any Year</option>
                                <option name="2017">2017</option>
                                <option name="2018">2018</option>
                                <option name="2019">2019</option>
                                <option name="2020">2020</option>
                            </select><br>
                    <input value="Find Representatives" type="submit" name="repsearch">
                
                </form>
            
                <form method="post" action="advSearch.php?side=Posts" id="fields">
                    <strong>Search Posts</strong> <br>
                    <label>Search Terms: </label>
                    <input name="postterm" type="text" required> <br>
                    <label>Type of Entry:</label>
                    <input type="radio" name="post" value="photos" required> Photos
                    <input type="radio" name="post" value="events" required> Events
                    <input type="radio" name="post" value="albums" required> Albums <br>
                    <input value="Find Entries" type="submit" name="postsearch">
                </form>
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
