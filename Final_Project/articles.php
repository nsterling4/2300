<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Agendas</title>
		<link rel="stylesheet" type="text/css" href="css/style.css">
		<link href="https://fonts.googleapis.com/css?family=Cormorant+SC|Linden+Hill|PT+Serif:700i" rel="stylesheet">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
		<script src="includes/scripts.js"></script>
		<script src="http://code.jquery.com/jquery-1.8.0.min.js"></script>
	</head>

<body>
	<div class="contents">
		<div class ="top_bar"> <!-- Contains header and Nav Bar -->
			<div class ="banner">
                <?php include 'includes/banner.php'; ?>
				<h1>
					Meeting Agendas and Announcements
				</h1>
			</div> <!--End of banner div-->
			

			<?php
    	  		include 'includes/navbar.php';
    		?> 
    	</div> <!-- End of top_bar div -->

		<div class="page_body"> <!--Photo Gallery-->
			<div class="container">
<h3>Links to Meeting Agendas</h3>
    <!-- upload pdf files for agendas -->
    <?php if(isset($_SESSION['admin_user'])){ ?>
    <form method='post' enctype='multipart/form-data'>
      <input type='file' id='meetingAgenda' name='agendaPDF'></p>
      <input type='text' id='meetingDate' name='meetingDate' placeholder="0000/00/00"> Date of the Meeting (yyyy/mm/dd)</p>
      <input type='submit' value='Upload Agenda' name='submit'></p>
    </form>
    <?php }?>

    <!-- upload the file -->
    <!-- -->
    <?php
    $mysqli = new mysqli( DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
      if(isset($_POST['meetingDate']) && isset($_POST['submit'])){
        $date = preg_replace("([^0-9/])", "", $_POST['meetingDate']);
        $date = date("Y-m-d", strtotime($date));
        if(!file_exists($_FILES['agendaPDF']['tmp_name']) || !is_uploaded_file($_FILES['agendaPDF']['tmp_name'])) {
          print("<p>No File Detected</p>");
        }else{
          $filePath = "";
          $newAgenda = $_FILES['agendaPDF'];
          if($newAgenda['error'] == 0){
            $tempName = $newAgenda['tmp_name'];
            $filePath = "agendas/$date.pdf";
            move_uploaded_file($tempName, "$filePath");
            $insert = $mysqli->query("INSERT INTO meetings(meetDate, agendaPath) VALUES ('$date', '$filePath')"); 
            print("<p>Uploaded the file to the server folder successfully</p>");
          }else{
            print("<p>Error: The file was not uploaded.</p>");
          }
        }
      }
  
      $pdfs = $mysqli->query("SELECT * FROM meetings ORDER BY meetDate DESC");
      $checker = false;
      while($display = $pdfs->fetch_assoc()){
        $checker = true;
        $filePath = $display['agendaPath'];
        $dateMeeting = $display['meetDate'];
        $link = "<a href=\"$filePath\" target=\"_blank\"> $dateMeeting Meeting Agenda </a>";
        print("<div class='forms'>$link</div>");
      }
      if ($checker === false) {
        print("<div class='forms'>Sorry, No Agendas To Show</div>");
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
