<?php 
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
require_once ('functions.php');
require_once ('init.php');		
$to_guest = include_template('guest.php');
$to_layout = include_template('layout.php',  ['Content' => $to_guest]);
print($to_layout);
?>