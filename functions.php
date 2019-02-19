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
						   $sql = "SELECT name FROM project WHERE user_id = 1";
							$result = mysqli_query($con, $sql);
							if (!$result) {
								$error = mysqli_error($con);
								return print("Ошибка MySQL: ". $error);
						}else {
							$rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
							return $rows;
	
								}

				};
				
				function get_tasks($con){
						mysqli_set_charset($con, "utf8");
						   $sql = "SELECT name FROM task WHERE user_id = 1";
							$result = mysqli_query($con, $sql);
							if (!$result) {
								$error = mysqli_error($con);
								return print("Ошибка MySQL: ". $error);
						}else {
							$rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
							return $rows;
	
								}

				}
				
					?>


