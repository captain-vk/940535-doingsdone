<?php 
require_once ('functions.php');
require_once ('init.php');	
session_start();
if (isset($_SESSION['id'])) {
	header("Location: /index.php");
}	
$to_guest = include_template('guest.php',[]);
print($to_guest);
?>