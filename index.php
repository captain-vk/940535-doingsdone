				<?php require_once ('functions.php')?>
				
				




		
						<?php 		
						$arr = ['Входящие', 'Учеба', 'Работа', 'Домашние дела', 'Авто'];			
						?>
						
						<?php 
						$arr2 = [
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
						];	
												
						?>

						
				<?php $OnDisplay = include_template('index',  ['arr2' => $arr2]);?>
				<?php $LayoutContent = include_template('layout', 
				['Content' => $OnDisplay],
				['arr' => $arr],
				['NamePage' => 'Дела хуево']);
				print($LayoutContent);
				?>		 
									
               