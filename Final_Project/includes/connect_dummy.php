<?php
session_start();
if(isset($_SESSION['valid_user'])){
	echo 'valid, and we good';
}

if(!isset($_SESSION['valid_user'])){
	echo 1;
	$_SESSION['valid_user']= 'sup';

}

?>

