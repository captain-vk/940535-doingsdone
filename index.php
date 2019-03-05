<?php require_once ('functions.php');
require_once ('init.php');
session_start();

	if (isset($_SESSION['id'])){
		$auth=true;}
		else {
		$auth=false;
		header("Location: templates/guest.php");}
$arr=get_projects($con,$_SESSION['id']);					
	if (isset($_GET['tasks_today'])){
		$mode=1;}
		else if(isset($_GET['tasks_tomorrow'])){
		$mode=2;}	//(*фильтр Завтра*)										
		else if(isset($_GET['tasks_old'])){
		$mode=3;}	//(*фильтр Просроченные*)
		else $mode=0;												
	if (isset($_GET['id']))	{
		$arr3=check_id($con,$_GET['id'],null,$mode);									
	if ( $arr3==true){
		$arr2=get_tasks($con, $_GET['id'],'',$mode);} 
		else {
		header("HTTP/1.0 404 Not Found");
		exit();}}
		else {
		$arr2=get_tasks($con,$_SESSION['id'],null,$mode);};						
	if ($_GET['complete_task']!==null){
		$new_status=get_status($con,$_GET['complete_task']);	
		header('Location: /index.php');	};
$OnDisplay = include_template('index.php',  ['arr2' => $arr2]);
$LayoutContent = include_template('layout.php', ['Content' => $OnDisplay,'arr2' => $arr2,'arr' => $arr,'NamePage' => 'Дела в порядке','auth'=>$auth]);
print($LayoutContent);
				?>		 
									
               