<?php

error_reporting(E_ALL ^ E_DEPRECATED);
require_once __DIR__ . '/db_connect.php';
$db = new DB_CONNECT();

$id = $_GET['id'];
//$id = "USER-0000005";

$response = array();
$response["task"] = array();

// GET WORK TASK
$worktask = mysql_query("SELECT task_id, location_id, worker_id, sched FROM pmls_android_worker_task WHERE worker_id LIKE '".$id."' ORDER BY sched");

if(mysql_num_rows($worktask) <> 0){
	
	while($res = mysql_fetch_array($worktask)){
		
		$list = array();
		$list["task_id"] = $res["task_id"];
		$list["location_id"] = $res["location_id"];
		$list["worker_id"] = $res["worker_id"];
		$list["sched"] = date('Y-m-d', strtotime($res["sched"]));
		//$list["date_sched"] = $res["sched"];
		//$list["duration"] = $res["duration"];
		//$list["kilowatt"] = $res["kilowatt"];
		//$list["cubic_meter"] = $res["cubic_meter"];
		
		array_push($response["task"], $list);
		
	}
	
	$response["success"] = 1;
}else{
	$response["success"] = 0;
}
echo json_encode($response);
?>