							<?php require_once ('functions.php')?>
							<?php require_once ('init.php')?>
							<?php 		
								$arr=get_projects($con);
								$arr2=get_tasks($con);?>
						
				
				<?php 
				
				$errors=[];
				
				if ($_SERVER['REQUEST_METHOD'] == 'POST') {
						if ($_POST['name_task']==null){
					$errors['name_of_task_']='Введите название!' ;}					
					
					if (check_date_format($_POST['date_exec'])!==true) {
					$errors['date_exec_']='Некорректная дата!'; } 
					
					if (check_id($con,$_POST['id'])!==true) {
					$errors['project']='Проект не существует!'; }
					
					//$arr_alarms=[
					///'Название'=>$check_name_task,
					//'Дата выполнения'=>$check_date_exec,
					//'Проект'=>$check_id];
					//var_dump($arr_alarms);
							
					};
						
							if ($errors==null){
								
								$new_task = add_tasks($con, $_POST['date_exec'],$_POST['name_task'], $_POST['id'],$file_url);
								if ($new_task){	
								
								if (isset($_FILES['preview'])) {
							$file_name = $_FILES['preview']['name'];
							$file_path =_DIR_ . '/uploads/';
							$file_url = '/uploads/' . $file_name;
							 move_uploaded_file($_FILES['preview']['tmp_name'], $file_path . $file_name);
							}								
									header('Location: /index.php');
								}
							}
							
							
							?>
							
					
						<?php 
						var_dump($errors);
						$to_add = include_template('add.php',['arr'=>$arr, 'errors'=>$errors]);?>	
						
				<?php $to_layout = include_template('layout.php',  ['Content_from_add' => $to_add,'arr'=>$arr,'arr2'=>$arr2, 'errors'=>$errors]);
				print($to_layout);?>	
				
				
							