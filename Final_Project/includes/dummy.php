<?php
session_start();
$name = $_POST['name'];
$_SESSION['name'] = "hello";
return 'name set';
?>