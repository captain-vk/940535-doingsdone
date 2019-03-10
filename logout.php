<?php
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
session_start();
unset($_SESSION['id']);
header("Location: templates/guest.php");
exit;
?>