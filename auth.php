<?php 
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
require_once ('functions.php');
require_once ('init.php');	
if (isset($_SESSION['id'])) {
	header("Location: /index.php");
}
$auth = [];
$field=[];
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
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
		$field['password'] = null;
	};	
    $arr_users = get_users($con);
	
	if (empty($email)) {
		$auth['email'] = 'Введите имя!';
	}
	if (empty($password)) {
		$auth['password'] = 'Введите пароль!' ; 
	} 		
	if ($auth == null) {			
		foreach($arr_users as $key => $item) {
			if ($item['email'] == $_POST['email']) {
				if (password_verify($_POST['password'],$item['pass'])) {
					session_start();
					$_SESSION['id'] = $item['id'];
					$_SESSION['name'] = $item['name'];
					if (isset($_SESSION['id'])) {
						header('Location: /index.php');
					}
				}
			}
		}	
		$auth['email'] = 'Неизвестный пользователь/неправильный пароль для пользователя';
	}
};	
$to_auth = include_template('auth.php', ['auth' => $auth, 'field' => $field]);						
$to_layout_from_auth = include_template('layout.php',  ['Content' => $to_auth]);
print($to_layout_from_auth);
?>									