<?php
	//double check that they actually want to remove the selected members
	print("<form method='post'>Are you sure you want to delete selected members? <br>
		<input type='submit' name='REMOVE' value='REMOVE'><input type='submit' name='CANCEL' value='CANCEL'></form>");

	if(isset($_POST["REMOVE"])){
		$removeList = $_POST["remove"];
		foreach ($removeList as $r) {
			$delete = $mysqli->query("DELETE FROM members WHERE members.memberID = $r");
		}
		print("<div class='forms'>Members Selected Have Been Removed</div>");
	}
	
	if(isset($_POST["CANCEL"])){
		print("<div class='forms'>Members Have Been Unselected</div>");
	}
?>