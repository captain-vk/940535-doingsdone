<?php 
require_once ('functions.php');
require_once ('init.php');	
//$arr=get_projects($con,$_SESSION['id']);
//$arr2=get_tasks($con,$_SESSION['id'],null,$mode);	
$arr_users = get_users($con);	
//var_dump($arr_users);
$auth=[];
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		if ($_POST['email']==''){
			$auth['email']='Введите имя!';}
			//echo'qwerty!'						

		if ($_POST['password']==''){
			$auth['password']='Введите пароль!' ;	
			 } 		
	if ($auth==null){			
	    foreach($arr_users as $key => $item){
	if ($item['email']==$_POST['email']){
		if (password_verify($_POST['password'],$item['pass'])){
			//setcookie($item['email'], '1', '25-Jan-2027 10:00:00 GMT', '/');
			//$auth['enter']='ok';
			session_start();
			$_SESSION['id'] = $item['id'];
			$_SESSION['name'] = $item['name'];
			//echo($_SESSION['id']);
			if (isset($_SESSION['id'])) {
			header('Location: /index.php');
			// exit();
			}
		    }
		  }
	    }		
	  }
	};	

	
	
//var_dump($_POST);
//var_dump($auth);	
//var_dump($_SESSION);
$to_auth = include_template('auth.php',['arr_users'=>$arr_users, 'arr'=>$arr,'arr2'=>$arr2,'auth'=>$auth]);						
$to_layout_from_auth = include_template('layout.php',  ['Content_from_auth' => $to_auth,'arr_users'=>$arr_users,'arr'=>$arr,'arr2'=>$arr2,'auth'=>$auth]);
print($to_layout_from_auth);?>									