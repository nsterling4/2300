<?php
session_start();

if(isset($_SESSION['valid_user'])){
  echo 1;
  session_destroy();
}

if(!isset($_SESSION['valid_user'])){
  echo 'not_valid, but I dont wanna destroy';
}


?>

