<?php require_once ('functions.php');
require_once ('init.php');
session_start();
//echo($_SESSION['id']);
if (isset($_SESSION['id'])) {
$auth=true;}
else {
	$auth=false;
header("Location: templates/guest.php");}

						
						//$arr3=check_id($con,$_GET['id']);
						//echo ($arr3);
						$arr=get_projects($con,$_SESSION['id']);
						//var_dump($arr);
						//$arr = ['Входящие', 'Учеба', 'Работа', 'Домашние дела', 'Авто'];		
						//$arr[] = $rows;
						//var_dump($arr);
									
					//echo($time);
																
								if (isset($_GET['tasks_today']))	{
										$mode=1;
										//(*фильтр Повестка дня*)										
									} else if(isset($_GET['tasks_tomorrow'])){
										$mode=2;	//(*фильтр Завтра*)										
									} else if(isset($_GET['tasks_old'])){
										$mode=3;	//(*фильтр Просроченные*)
									} else $mode=0;
												
						 		if (isset($_GET['id']))	{
									$arr3=check_id($con,$_GET['id'],null,$mode);
									
									if ( $arr3==true)	{
										//echo "asdfgghjjj";
										$arr2=get_tasks($con, $_GET['id'],'',$mode);
																				
											
									} 
									else {
											header("HTTP/1.0 404 Not Found");
											exit();
									}
								}							
								
									else {
										$arr2=get_tasks($con,$_SESSION['id'],null,$mode);
										//echo($_SESSION['id']);
										};						

								
								//var_dump($arr2);
								//echo($mode);
								
								
								//var_dump($arr2);
								/*&& $arr3==true && $_GET['id']!=null) {					 
								$arr2=get_tasks($con, $_GET['id']);																						
								}								
								else if ($_GET['id']==null){
								$arr2=get_tasks($con);}
								else if(isset($_GET['id'] && $arr3==false){
								header("HTTP/1.0 404 Not Found");
								exit();
								}*/
								
								
								if ($_GET['complete_task']!==null){
									$new_status=get_status($con,$_GET['complete_task']);	
									header('Location: /index.php');
											};
											
						?>
						
						<?php 
						/*$arr2 = [
						0 =>[
						'Задача' =>'Собеседование в IT компании',
						'Дата выполнения' =>'01.12.2019',
						'Категория' =>'Работа',
						'Выполнен' =>'Нет'],
						
						1 =>[
						'Задача' =>'Выполнить тестовое задание',
						'Дата выполнения' =>'25.12.2019',
						'Категория' =>'Работа',
						'Выполнен' =>'Нет'],
						2 =>[
						'Задача' =>'Сделать задание первого раздела',
						'Дата выполнения' =>'21.12.2019',
						'Категория' =>'Учеба',
						'Выполнен' =>'Да'],
						3 =>[
						'Задача' =>'Встреча с другом',
						'Дата выполнения' =>'22.12.2019',
						'Категория' =>'Входящие',
						'Выполнен' =>'Нет'],						
						4 =>[
						'Задача' =>'Купить корм для кота',
						'Дата выполнения' =>'Нет',
						'Категория' =>'Домашние дела',
						'Выполнен' =>'Нет'],						
						5 =>[
						'Задача' =>'Заказать пиццу',
						'Дата выполнения' =>'Нет',
						'Категория' =>'Домашние дела',
						'Выполнен' =>'Нет']
						];	*/
												
						?>						
				<?php $OnDisplay = include_template('index.php',  ['arr2' => $arr2]);?>

				
				<?php $LayoutContent = include_template('layout.php', 
				['Content' => $OnDisplay,
				'arr2' => $arr2,	
				'arr' => $arr,
				'NamePage' => 'Дела в порядке',
				'auth'=>$auth]);
				print($LayoutContent);
				?>		 
									
               