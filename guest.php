<?php 
require_once ('functions.php');
require_once ('init.php');		
$to_guest = include_template('guest.php');
$to_layout = include_template('layout.php',  ['Content' => $to_guest]);
print($to_layout);
?>