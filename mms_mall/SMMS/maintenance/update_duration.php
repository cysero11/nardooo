<?php

error_reporting(E_ALL ^ E_DEPRECATED);
require_once __DIR__ . '/db_connect.php';
$db = new DB_CONNECT();

$id = $_POST['id'];
$duration = $_POST['duration'];

$response = array();
/*
$id = "ST-0000066";
$duration = "00:03:00";
*/
$querUpdate = mysql_query("update pmls_android_worker_task set duration = '".$duration."' where staff_task_id like '".$id."'");
if(mysql_affected_rows() <> 0){
	$response["id"] = $id;
	$response["duration"] = $duration;
	$response["success"] = 1;
}else{
	$response["id"] = $id;
	$response["duration"] = $duration;
	$response["success"] = 0;
}
echo json_encode($response);
?>