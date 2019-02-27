				<?php require_once ('functions.php')?>
				<?php require_once ('init.php')?>
			
						
						<?php 		
						//$arr3=check_id($con,$_GET['id']);
						//echo ($arr3);
						$arr=get_projects($con);
						//var_dump($arr);
						//$arr = ['Входящие', 'Учеба', 'Работа', 'Домашние дела', 'Авто'];		
						//$arr[] = $rows;
						//var_dump($arr);
												
						 		if (isset($_GET['id']))	{
									$arr3=check_id($con,$_GET['id']);
									
									if ( $arr3==true)	{
										//echo "asdfgghjjj";
										$arr2=get_tasks($con, $_GET['id']);		
											
									} 
									else {
											header("HTTP/1.0 404 Not Found");
											exit();
									}
								}															
								
									else {
										$arr2=get_tasks($con);
										};						
								
								
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
				'NamePage' => 'Дела в порядке']);
				print($LayoutContent);
				?>		 
									
               