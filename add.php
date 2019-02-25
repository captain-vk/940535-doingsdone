							<?php require_once ('functions.php')?>
							<?php require_once ('init.php')?>
							<?php 		
						$arr=get_projects($con);
						$arr2=get_tasks($con);?>
						
				
				<?php if ($_POST['name_task']!=null) {
					$check_name_task=true; }
					else $check_name_task=false;
					
					if (check_date_format($_POST['date_exec'])==true) {
					$check_date_exec=true; }
					else $check_date_exec=false;
					
					if (check_id($con,$_POST['id'])==true) {
					$check_id=true; }
					else $check_id=false;
					
					$arr_alarms=[
					'Название'=>$check_name_task,
					'Дата выполнения'=>$check_date_exec,
					'Проект'=>$check_id];
					var_dump($arr_alarms);
					
					
							if (isset($_FILES['preview'])) {
							$file_name = $_FILES['preview']['name'];
							$file_path =_DIR_ . '/uploads/';
							$file_url = '/uploads/' . $file_name;
							 move_uploaded_file($_FILES['preview']['tmp_name'], $file_path . $file_name);
							}
							
							if ($check_name_task && $check_date_exec && $check_id){
								
								$new_task = add_tasks($con, $_POST['date_exec'],$_POST['name_task'], $_POST['id'],$file_url);
								if ($new_task){									
									header('Location: /index.php');
								}
							}
							
							
							?>
							
					
						<?php $to_add = include_template('add.php',['arr'=>$arr]);?>	
						
				<?php $to_layout = include_template('layout.php',  ['Content_from_add' => $to_add,'arr'=>$arr,'arr2'=>$arr2,'arr_alarms'=>$arr_alarms]);
				print($to_layout);?>	