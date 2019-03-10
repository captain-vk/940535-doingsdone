<?php 
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
require_once 'mysql_helper.php';

function include_template($name, $data = null) {
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
function get_projects($con, $id = null){
	if ($id != null) {
		$sql = "SELECT * FROM project WHERE user_id = '$id'";
	} else {
		$sql = "SELECT * FROM project";		 
	};
    $result = mysqli_query($con, $sql);

	if ($result) {
		$rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
		return $rows;
	} else return $rows=[];
};
				
function get_tasks($con, $user_id, $proj_id=null,$mode = null, $showCompleted = false){
	$date_time_now = date('Y-m-d H:i:s');	
	$date_now=date('Y-m-d');	
	$date_time_start=$date_now. ' 00:00:00';
	$date_time_end=$date_now. ' 23:59:59';
	$date_tomorrow = date("Y-m-d", strtotime("+1 days"));
	$date_time_start_tomorrow=$date_tomorrow. ' 00:00:00';
	$date_time_end_tomorrow=$date_tomorrow. ' 23:59:59';
	if ($mode == 0 || $mode == null){
		$sql = "SELECT id, status, name,execution_date,file_link,project_id FROM task WHERE user_id = '$user_id'";
	}							
	if ($proj_id!==null && $mode==0) {
		$sql.= "AND project_id = '$proj_id'";
	}						
	if ($mode == 1) {
		$sql = "SELECT id, status, name,execution_date,file_link,project_id FROM task WHERE user_id = '$user_id' and execution_date BETWEEN '$date_time_start' AND '$date_time_end' and user_id = '$user_id'";
	}												
	if ($mode == 2) {
		$sql = "SELECT id, status, name,execution_date,file_link,project_id FROM task WHERE user_id = '$user_id' and execution_date BETWEEN '$date_time_start_tomorrow' AND '$date_time_end_tomorrow'";
	}	
	if ($mode == 3) {
		$sql = "SELECT id, status, name,execution_date,file_link,project_id FROM task WHERE user_id = '$user_id' and execution_date < '$date_time_start'";
	}						

    if (!$showCompleted) {
        $sql .= " AND status = 0";
    }
	
	$result = mysqli_query($con, $sql);
	if ($result) {
		$rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
		return $rows;
	} else return $rows=[];
};
				
function CountTasks ($arr2, $str)	{
	$j=0;
	foreach($arr2 as $key => $item)	{
		if ($item['project_id']== $str) {
			$j++;
		}	
	}
	return $j;
};
				
function check_id ($con, $id)	{
	$sql_id = "SELECT id FROM project";		
	$result = mysqli_query($con, $sql_id);
	if ($result) {
		$rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
	}						
	foreach($rows as $key => $item)	{
		if ($item['id']== (int)$id) {
			return true;
		}		
	}
	return false;
};
				
function check_date_format($date) {
	$result = false;
	$regexp = '/(\d{2})\.(\d{2})\.(\d{4})/m';
	if (preg_match($regexp, $date, $parts) && count($parts) == 4) {
		$result = checkdate($parts[2], $parts[1], $parts[3]);
	}
	return $result;
};
				
function add_tasks($con, $execution_date, $name, $project_id, $user_id, $url){
    $sql = "INSERT INTO task (execution_date, name, file_link, project_id,user_id) VALUES (?, ?, ?, ?, ?)";
    $stmt = db_get_prepare_stmt($con, $sql, [$execution_date, $name, $url, $project_id, $user_id]);
    $test = mysqli_stmt_execute($stmt);

    return $test;
};

			
function get_users($con){
	$sql = "SELECT * FROM users";
	$result = mysqli_query($con, $sql);
	if ($result) {
		$rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
		return $rows;
	} else return $rows=[];
};			
function add_user($con, $email, $name, $pass){
    $sql = "INSERT INTO users (email, name, pass) VALUES (?, ?, ?)";
    $stmt = db_get_prepare_stmt($con, $sql, [$email, $name, $pass]);
    return mysqli_stmt_execute($stmt);
};

function add_project($con, $name, $user){
    $sql = "INSERT INTO project (name, user_id) VALUES (?, ?)";
	$stmt = db_get_prepare_stmt($con, $sql, [$name, $user]);
    return mysqli_stmt_execute($stmt);
};

function get_status($con, $id) {
	$sql = "SELECT status FROM task WHERE id='$id'";
	$result = mysqli_query($con, $sql);
	if ($result) {
		$rows = mysqli_fetch_array($result, MYSQLI_ASSOC);
	} else return $rows=[];

	if ($rows['status']=='0'){
        $status = 1;
	} else if ($rows['status']=='1') {
        $status = 0;
	}

	$sql = "UPDATE task SET status = ? WHERE id = ?";
    $stmt = db_get_prepare_stmt($con, $sql, [$status, $id]);
    return mysqli_stmt_execute($stmt);
};
?>