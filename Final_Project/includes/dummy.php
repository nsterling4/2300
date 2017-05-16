<?php
if (isset($_POST['name'])){
session_start();
$_SESSION['valid_user'] = $_POST['name'];
}

if (isset($_POST['blank'])){
	session_start();
	unset($_SESSION['valid_user']);
	session_destroy();
}


?>

