<?php
	//double check that they actually want to remove the selected members
	print("<form method='post'>Are you sure you want to delete selected members? <br>
		<input type='submit' name='REMOVE' value='REMOVE'><input type='submit' name='CANCEL' value='CANCEL'></form>");
	$_SESSION['removeArray'] = $_POST['remove'];
?>