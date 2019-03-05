<?php
$con = mysqli_connect("localhost", "root", "","deals_allright");
//mysqli_set_charset($con, "utf8");
if ($con == false) {
	print("Ошибка подключения: ". mysqli_connect_error());
}
?>