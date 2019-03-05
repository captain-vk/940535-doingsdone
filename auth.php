<?php 
require_once ('functions.php');
require_once ('init.php');	
$arr_users = get_users($con);	
$auth = [];
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	if ($_POST['email'] == '') {
		$auth['email'] = 'Введите имя!';
	}
	if ($_POST['password'] == '') {
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
	}
};	
$to_auth = include_template('auth.php', ['arr_users' => $arr_users, 'arr' => $arr, 'arr2' => $arr2, 'auth' => $auth]);						
$to_layout_from_auth = include_template('layout.php',  ['Content_from_auth' => $to_auth,'arr_users'=>$arr_users,'arr'=>$arr,'arr2'=>$arr2,'auth'=>$auth]);
print($to_layout_from_auth);?>									