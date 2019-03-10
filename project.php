<?php 
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
require_once ('functions.php');
require_once ('init.php');		
session_start();
if (isset($_SESSION['id'])) {
	$auth=true;
} else {
	$auth=false;
	}
$arr=get_projects($con, $_SESSION['id']);
$arr2=get_tasks($con, $_SESSION['id'], null, null);				
$errors=[];					
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	if (isset($_POST['name']))	{
		$name = $_POST['name'];
	} else {
		$name = null;
	};
	if ((empty($name)  || (!empty($name) && (strlen($name) > 128)))) {
		$errors['name'] = 'Введите название!' ;
	} else {
		foreach($arr as $key => $item){
		    if ($item['name'] == $name) {
				$errors['name'] = 'Такой проект уже имеется!' ;
			}
		}
	}		
	if ($errors == null){
		$new_project = add_project($con,$_POST['name'],$_SESSION['id'] );
		}
	if ($new_project){
		header('Location: /index.php');
	}
 };
$to_project = include_template('project.php', ['errors' => $errors]);			
$to_layout_from_project = include_template('layout.php',  ['Content' => $to_project, 'arr' => $arr, 'arr2' => $arr2,'errors' => $errors, 'auth' => $auth]);
print($to_layout_from_project);
?>