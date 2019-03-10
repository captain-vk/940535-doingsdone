<?php
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
$con = mysqli_connect("localhost", "root", "","deals_allright");
if ($con === false) {
		exit();
}
mysqli_set_charset($con, "utf8");
?>