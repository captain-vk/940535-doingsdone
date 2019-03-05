<?php 
require_once ('functions.php');
require_once ('init.php');		
session_start();
	if (isset($_SESSION['id'])) {
		$auth=true;}
		else $auth=false;					
		$arr=get_projects($con,$_SESSION['id']);
		$arr2=get_tasks($con,$_SESSION['id'],null,$mode);				
		$errors=[];				
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		if ($_POST['name']==''){
			$errors['name_of_task_']='Введите название!' ;}					
		if (check_date_format($_POST['date'])!==true) {
			$errors['date_exec_']='Некорректная дата!'; } 					
		if (check_id($con,$_POST['project'])!==true) {
			$errors['project']='Проект не существует!'; }
			$time=$_POST['date'];
			$time=str_replace('.', '-', $time);
			$time=date_create($time)->Format('Y-m-d');										
	if ($errors==null){
		$file_url = '';
		if (isset($_FILES['preview'])) {
			$file_name = $_FILES['preview']['name'];
			$file_path =__DIR__. '/uploads/';
			$file_url = '/uploads/' . $file_name;
			move_uploaded_file($_FILES['preview']['tmp_name'], $file_path . $file_name);}
$new_task = add_tasks($con, $time,$_POST['name'], $_POST['project'],$_SESSION['id'],$file_url);
	if ($new_task){											
		header('Location: /index.php');}
	}
	}					
$to_add = include_template('add.php',['arr'=>$arr, 'errors'=>$errors,'auth'=>$auth]);						
$to_layout = include_template('layout.php',  ['Content_from_add' => $to_add,'arr'=>$arr,'arr2'=>$arr2, 'errors'=>$errors,'auth'=>$auth]);
print($to_layout);?>	