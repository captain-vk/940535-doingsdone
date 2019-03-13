<?php 
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
$field=[];
$new_project=null;				
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	if (isset($_POST['name']))	{
		$name = mb_convert_case($_POST['name'], MB_CASE_TITLE, 'UTF-8');
		$field['name'] = $name;
	} else {
		$name = null;
		$field['name'] = null;
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
		$new_project = add_project($con,$name,$_SESSION['id'] );
		}
	if ($new_project){
		header('Location: /index.php');
	}
 };
$to_project = include_template('project.php', ['errors' => $errors, 'field' => $field]);			
$to_layout_from_project = include_template('layout.php',  ['Content' => $to_project, 'arr' => $arr, 'arr2' => $arr2,'errors' => $errors, 'auth' => $auth, 'NamePage' => 'Добавление проекта']);
print($to_layout_from_project);
?>