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
	header("Location: templates/guest.php");
}	
$arr=get_projects($con, $_SESSION['id']);
$arr2=get_tasks($con, $_SESSION['id'], null, null);				
$errors=[];	
$field=[];			
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	if (isset($_POST['name']))	{
		$name = $_POST['name'];
		$field['name'] = $name;
	} else {
		$name = null;
		$field['name'] = null;
	};	
	if (isset($_POST['date']))	{
		$date = $_POST['date'];
		$field['date'] = $date;
	} else {
		$date = null;
		$field['date'] = null;
	};
	if (isset($_POST['project']))	{
		$project = $_POST['project'];
		$field['project'] = $project;
	} else {
		$project = null;
		$field['project'] = null;
	};
if ((empty($name)) || (!empty($name) && (strlen($name) > 64))) {
		$errors['name_of_task_'] ='Введите название!' ;
	}		

	if (strtotime($date)=== false) {
		$errors['date_exec_']='Некорректная дата!'; 
	} 					

	$taskDate = strtotime($date);
    $nowDate = time();

    if (date('d.m.Y') != $date && $taskDate < $nowDate) {
        $errors['date_exec_'] = 'Указанная дата меньше текущей';
    }

	$time=str_replace('.', '-', $date);
	$time=date_create($time)->Format('Y-m-d');										
	if ($errors==null){
		$file_url = '';
		if (isset($_FILES['preview'])) {
			$file_name = $_FILES['preview']['name'];
			$userfile_extn = substr($file_name, strrpos($file_name, '.')+1);
			$file_new_name = uniqid().'.'.$userfile_extn;
			$file_path =__DIR__. '/uploads/';
			$file_url = '/uploads/' . $file_name;
			move_uploaded_file($_FILES['preview']['tmp_name'], $file_path . $file_new_name);
		}
		$new_task = add_tasks($con, $time, $name, $project,$_SESSION['id'],$file_url);
		if ($new_task){											
			header('Location: /index.php');
		}
	}
}					
$to_add = include_template('add.php',['arr' => $arr, 'errors' => $errors, 'auth' => $auth, 'field' => $field]);						
$to_layout = include_template('layout.php',  ['Content' => $to_add, 'arr' => $arr, 'arr2' => $arr2, 'errors' => $errors, 'auth' => $auth]);
print($to_layout);?>	