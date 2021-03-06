<?php function include_template($name, $data=null) {
    $name = 'templates/' . $name;
    $result = '';

    if (!is_readable($name)) {
        return $result;
    }

    ob_start();
    extract($data);
    require $name;

    $result = ob_get_clean();

    return $result;
};
	 function get_projects($con,$id=null){
	 mysqli_set_charset($con, "utf8");
	 if ($id!=null){
	 $sql = "SELECT * FROM project where user_id='$id'";} else
	 $sql = "SELECT * FROM project";
		 
	 $result = mysqli_query($con, $sql);
		if (!$result) {
			$error = mysqli_error($con);
			return print("Ошибка MySQL: ". $error);
			}else {
			$rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
			return $rows;}
			};
				
				function get_tasks($con, $user_id, $proj_id=null,$mode){
						$date_time_now = date_create($time)->Format('Y-m-d H:i:s');	
						$date_now=date_create($time)->Format('Y-m-d');	
						$date_time_start=$date_now. ' 00:00:00';
						$date_time_end=$date_now. ' 23:59:59';
						$date_tomorrow = date("Y-m-d", strtotime("+1 days"));
						$date_time_start_tomorrow=$date_tomorrow. ' 00:00:00';
						$date_time_end_tomorrow=$date_tomorrow. ' 23:59:59';
						//echo($date_tomorrow);
						mysqli_set_charset($con, "utf8");
						if ($mode == 0){
						$sql = "SELECT id, status, name,execution_date,file_link,project_id FROM task WHERE user_id = '$user_id'";
						//echo('$user_id');
						}	
						
						if ($proj_id!==null && $mode==0){
							$sql.= "AND project_id = '$proj_id'";}
						
						if ($mode == 1){
						$sql = "SELECT id, status, name,execution_date,file_link,project_id FROM task WHERE execution_date BETWEEN '$date_time_start' AND '$date_time_end' and user_id = '$user_id'";}
												
						if ($mode == 2){
						$sql = "SELECT id, status, name,execution_date,file_link,project_id FROM task WHERE execution_date BETWEEN '$date_time_start_tomorrow' AND '$date_time_end_tomorrow'";}
						
						
						if ($mode == 3){
						$sql = "SELECT id, status, name,execution_date,file_link,project_id FROM task WHERE execution_date < '$date_time_start'";}							
							$result = mysqli_query($con, $sql);
						if (!$result) {
								$error = mysqli_error($con);
								return print("Ошибка MySQL: ". $error);
						}else {
							$rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
							//var_dump($rows);
							return $rows;	
								}

				};
				
				 function CountTasks ($arr2, $str)	{
							$j=0;
							foreach($arr2 as $key => $item)	{
							if ($item['project_id']== $str) {
								$j++;
								}	
							}
							return $j;
							
						}
				
				function check_id ($con, $id)	{
						$sql_id = "SELECT id FROM project";		
					$result = mysqli_query($con, $sql_id);
							if (!$result) {
								$error = mysqli_error($con);
								return print("Ошибка MySQL: ". $error);
						}else {
							$rows = mysqli_fetch_all($result, MYSQLI_ASSOC);			
								}						
					foreach($rows as $key => $item)	{
						//var_dump($rows);
							if ($item['id']== (int)$id) {
								return true;
								
								}		
							}
							//echo "qweer";
							return false;
							
							
				};
				
				function check_date_format($date) {
    $result = false;
    $regexp = '/(\d{2})\.(\d{2})\.(\d{4})/m';
    if (preg_match($regexp, $date, $parts) && count($parts) == 4) {
        $result = checkdate($parts[2], $parts[1], $parts[3]);
    }
    return $result;
}
				
	function add_tasks($con, $execution_date, $name, $project_id, $user_id, $url){
		mysqli_set_charset($con, "utf8");
		$sql = "INSERT INTO task (execution_date, name,file_link, project_id,user_id) VALUES ('$execution_date','$name','$url', $project_id, $user_id)";
		$result = mysqli_query($con, $sql);
		if ($result) {
		//echo '<p>Данные успешно добавлены в таблицу.</p>';
			return true;
			} else {
			 //echo '<p>Произошла ошибка: ' . mysqli_error($con) . '</p>';
			return false;}};
			
	function get_users($con){
	 mysqli_set_charset($con, "utf8");
	 $sql = "SELECT * FROM users";
	 $result = mysqli_query($con, $sql);
		if (!$result) {
			$error = mysqli_error($con);
			return print("Ошибка MySQL: ". $error);
			}else {
			$rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
			return $rows;}
			};
			
		function add_user($con, $email, $name, $pass){
		mysqli_set_charset($con, "utf8");
		$sql = "INSERT INTO users (email, name,pass) VALUES ('$email','$name','$pass')";
		$result = mysqli_query($con, $sql);
		if ($result) {
		//echo '<p>Данные успешно добавлены в таблицу.</p>';
			return true;
			} else {
		//	 echo '<p>Произошла ошибка: ' . mysqli_error($con) . '</p>';
			return false;}};
			
		function add_project($con, $name, $user){
		mysqli_set_charset($con, "utf8");
		$sql = "INSERT INTO project (name, user_id) VALUES ('$name', '$user')";
		$result = mysqli_query($con, $sql);
				if ($result) {
		//echo '<p>Данные успешно добавлены в таблицу.</p>';
			return true;
			} else {
		//	 echo '<p>Произошла ошибка: ' . mysqli_error($con) . '</p>';
			return false;}
			};		

		function get_status($con, $id){
		//mysqli_set_charset($con, "utf8");
		$sql = "SELECT status FROM task WHERE id='$id'";
		$result = mysqli_query($con, $sql);
		if (!$result) {
			$error = mysqli_error($con);
			print("Ошибка MySQL: ". $error);
			}else {
			$rows = mysqli_fetch_array($result, MYSQLI_ASSOC);
			//var_dump($rows);
			}		
		if ($rows['status']=='0'){
			$change_status = "UPDATE task SET status = 1 WHERE id = $id";				
		}else if ($rows['status']=='1'){
			//echo "zzzz";
			$change_status = "UPDATE task SET status = 0 WHERE id = $id";		
			};	 		
		$result_write = mysqli_query($con, $change_status);	
			if ($result_write) {
		//echo '<p>Данные успешно добавлены в таблицу.</p>';
		
			return true;
			} else {
			 //echo '<p>Произошла ошибка: ' . mysqli_error($con) . '</p>';
			return false;}
			};			
	
			
			
			?>