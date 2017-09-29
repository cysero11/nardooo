<?php

error_reporting(E_ALL ^ E_DEPRECATED);
require_once __DIR__ . '/db_connect.php';
$db = new DB_CONNECT();

$taskid = $_GET["id"];
$roomid = "";
//$taskid = "ST-0000064";

$response = array();

$quer = mysql_query("update pmls_android_worker_task set startt = NOW(), xstat = 'Ongoing' where staff_task_id like '".$taskid."'");

// getting the unit id from pending task
$task = mysql_query("select location_id from pmls_android_worker_task where staff_task_id like '".$taskid."'");
if(mysql_num_rows($task) <> 0){
	$task_row = mysql_fetch_array($task);
	$roomid = $task_row["location_id"];
	$prevreading1 = mysql_query("select kilowatt from pmls_android_worker_task_history where location_id like '".$roomid."' AND kilowatt IS NOT NULL order by endt desc");
	$res = mysql_fetch_array($prevreading1);
	if($res["kilowatt"] == null or $res["kilowatt"] == "") $response["kilowatt"] = "0"; else $response["kilowatt"] = $res["kilowatt"];

	$prevreading2 = mysql_query("select cubic_meter from pmls_android_worker_task_history where location_id like '".$roomid."' AND cubic_meter IS NOT NULL order by endt desc");
	$res = mysql_fetch_array($prevreading2);
		
	if($res["cubic_meter"] == null or $res["cubic_meter"] == "") $response["cubic_meter"] = "0"; else $response["cubic_meter"] = $res["cubic_meter"];
		
	if($response["cubic_meter"] != "0") $response["id"] = $res[0];
	
	$duration = mysql_query("select duration from pmls_android_worker_task where staff_task_id like '".$taskid."'");
	
	if(mysql_num_rows($duration) <>  0){
		$dur = mysql_fetch_array($duration);
		$response["duration"] = $dur["duration"];
	}else{
		$response["duration"] = "00:00:00";
	}
	
	$response["success"] = 1;
}else{
	$response["success"] = 0;
}

echo json_encode($response);

?>