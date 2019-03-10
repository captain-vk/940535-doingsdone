<?php 
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
require_once ('functions.php');
require_once ('init.php');	
session_start();
if (isset($_SESSION['id'])) {
	header("Location: /index.php");
}
$arr_users = get_users($con);
$errors=[];
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	if (isset($_POST['name']))	{
		$name = $_POST['name'];
		$field['name'] = $name;
	} else {
		$name = null;
		$field['name'] = $name;
	};
	if (isset($_POST['email']))	{
		$email = $_POST['email'];
		$field['email'] = $email;
	} else {
		$email = null;
		$field['email'] = null;
	};	
	if (isset($_POST['password']))	{
		$password = $_POST['password'];
		$field['password'] = $password;
	} else {
		$password = null;
		$field['password'] = $password;
	};		
	if (empty($name) || (!empty($name) && (strlen($name) > 64))){
		$errors['name_user'] = 'Введите имя!' ;
	}						
	if (filter_var($email, FILTER_VALIDATE_EMAIL) !== false) {
		foreach($arr_users as $key => $item){
		    if ($item['email'] == $_POST['email']){
				$errors['email'] = 'Такой email уже имеется!' ;
			}
		}
	} else if ((empty($email))  || (!empty($email) && (strlen($email) > 128))){
		$errors['email'] = 'Введите email' ;				
	}
	if ((empty($password))  || (!empty($password) && (strlen($password) > 64))){
		$errors['password'] = 'Введите пароль!' ;	
	} 		
	if ($errors == null){
		$pass = password_hash($_POST['password'], PASSWORD_DEFAULT);
		$new_user = add_user($con, $email, $name, $pass);
		if ($new_user){	
			header('Location: /index.php');
		}
	}
};					
$to_register = include_template('register.php',['errors' => $errors, 'field' => $field]);						
$to_layout_from_register = include_template('layout.php',  ['Content' => $to_register]);
print($to_layout_from_register);?>									