<?php 
require_once ('functions.php');
require_once ('init.php');		
session_start();
if (isset($_SESSION['id'])) {
	$auth=true;
} else {
	$auth=false;
	header("Location: templates/guest.php");
	}
$arr=get_projects($con, $_SESSION['id']);
$arr2=get_tasks($con, $_SESSION['id'], null, $mode);				
$errors=[];					
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];

	if (empty($name)) {
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
$to_layout_from_project = include_template('layout.php',  ['Content' => $to_project, 'arr_users' => $arr_users, 'arr' => $arr, 'arr2' => $arr2,'errors' => $errors, 'auth' => $auth]);
print($to_layout_from_project);
?>