<?php 
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
require_once ('functions.php');
require_once ('init.php');
session_start();
if (isset($_SESSION['id'])){
	$auth=true;
} else {
	$auth=false;
	header("Location: templates/guest.php");
}
$arr = get_projects($con, $_SESSION['id']);	
if (isset($_GET['id'])){
	$project_id = $_GET['id'];
}else {
	$project_id = null;
};
if (isset($_GET['show_completed'])){
	$show_complete_tasks = $_GET['show_completed'];	
} else {
	$show_complete_tasks = null;
};
if (isset($_GET['tasks_today'])) {
	$mode=1;
} else if(isset($_GET['tasks_tomorrow'])) {
	$mode=2;//(*фильтр Завтра*)
	}											
  else if(isset($_GET['tasks_old'])) {
	$mode=3;//(*фильтр Просроченные*)
	}	
  else $mode=0;			
$arr2=get_tasks($con, $project_id,null,$mode, $show_complete_tasks);	  
if ($project_id)	{
	$arr3=check_id($con,$project_id,null,$mode);									
	if ($arr3==true){
		$arr2=get_tasks($con,$_SESSION['id'], $project_id, $mode, $show_complete_tasks);
	} else {
		header("HTTP/1.0 404 Not Found");
		exit();
	}
} else {
	$arr2=get_tasks($con,$_SESSION['id'],null,$mode, $show_complete_tasks);
};	
if (isset($_GET['check']))	{
	$check = $_GET['check'];
}	else {
	$check = null;
};
if ($check!== null && $_GET['task_id'] !== null) {
    $new_status = get_status($con, $_GET['task_id']);
    header('Location: /index.php');
};
$OnDisplay = include_template('index.php',  ['arr2' => $arr2, 'show_complete_tasks' => $show_complete_tasks]);
$LayoutContent = include_template('layout.php', ['Content' => $OnDisplay, 'arr2' => $arr2,'arr' => $arr, 'NamePage' => 'Дела в порядке', 'auth'=>$auth]);
print($LayoutContent);
?>		         