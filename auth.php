<?php 
require_once ('functions.php');
require_once ('init.php');	

$auth = [];
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$email = $_POST['email'];
    $password = $_POST['password'];
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
$to_auth = include_template('auth.php', ['auth' => $auth]);						
$to_layout_from_auth = include_template('layout.php',  ['Content' => $to_auth]);
print($to_layout_from_auth);?>									