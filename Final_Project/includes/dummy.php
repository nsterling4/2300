<?php
if (isset($_POST['name'])){
session_start();
$_SESSION['name'] = $_POST['name'];
}

if (isset($_POST['blank'])){
	session_start();
	unset($_SESSION['name']);
	session_destroy();
}


?>

