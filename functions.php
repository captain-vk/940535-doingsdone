<?php function include_template($name, $data) {
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
	 function get_projects($con){
	 mysqli_set_charset($con, "utf8");
	 $sql = "SELECT * FROM project";
	 $result = mysqli_query($con, $sql);
		if (!$result) {
			$error = mysqli_error($con);
			return print("Ошибка MySQL: ". $error);
			}else {
			$rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
			return $rows;}
			};
				
				function get_tasks($con, $proj_id=null){
						mysqli_set_charset($con, "utf8");
						
						if ($proj_id==null){
							$sql = "SELECT name,execution_date,file_link,project_id FROM task";							
						}
						   else {
							   $sql = "SELECT name,execution_date,file_link,project_id FROM task WHERE project_id = '$proj_id'";
						   }
							$result = mysqli_query($con, $sql);
							if (!$result) {
								$error = mysqli_error($con);
								return print("Ошибка MySQL: ". $error);
						}else {
							$rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
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
				
	function add_tasks($con, $execution_date, $name, $project_id, $url){
		mysqli_set_charset($con, "utf8");
		$sql = "INSERT INTO task (execution_date, name,file_link, project_id,user_id) VALUES ('$execution_date','$name','$url', $project_id,2)";
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
			return false;}};?>