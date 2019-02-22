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
							return $rows;
	
								}

				};
				
				function get_tasks($con, $proj_id=null){
						mysqli_set_charset($con, "utf8");
						
						if ($proj_id==null){
							$sql = "SELECT name,project_id FROM task";							
						}
						   else {
							   $sql = "SELECT name,project_id FROM task WHERE project_id = '$proj_id'";
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
							if ($item['id']== $id) {
								return 'true';
								
								}		
							}
							//echo "qweer";
							return 'false';
							
							
				};
				
				
				
					?>


