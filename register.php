<?php 
require_once ('functions.php');
require_once ('init.php');	
$arr=get_projects($con);
$arr2=get_tasks($con);	
$arr_users = get_users($con);
//var_dump($arr_users);
$errors=[];
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		if ($_POST['name']==''){
			$errors['name_user']='Введите имя!' ;}						
		if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) !== false) {
			foreach($arr_users as $key => $item){
		    if ($item['email']==$_POST['email']){
				$errors['email']='Такой email уже имеется!' ;}
				}
			} else if ($_POST['email']==''){
				$errors['email']='введите email' ;				
			}
		if ($_POST['password']==''){
			$errors['password']='Введите пароль!' ;	
			 } 		
		if ($errors==null){
			$pass = password_hash($_POST['password'], PASSWORD_DEFAULT);
			$new_user = add_user($con, $_POST['email'], $_POST['name'],$pass);
		if ($new_user){	
			header('Location: /index.php');
			}
				}
					};
//var_dump($errors);
//var_dump($_POST);							
$to_register = include_template('register.php',['arr_users'=>$arr_users, 'arr'=>$arr,'arr2'=>$arr2,'errors'=>$errors]);						
$to_layout_from_register = include_template('layout.php',  ['Content_from_register' => $to_register,'arr_users'=>$arr_users,'arr'=>$arr,'arr2'=>$arr2,'errors'=>$errors]);
print($to_layout_from_register);?>									