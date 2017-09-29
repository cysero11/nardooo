<?php

error_reporting(E_ALL ^ E_DEPRECATED);
require_once __DIR__ . '/db_connect.php';
$db = new DB_CONNECT();

$id = $_GET['id'];
$date = $_GET["date"];
$date = date('Y-m-d', strtotime($date));

//$id = "1";
//$date = "2016-09-25";

$response = array();
$response["task"] = array();

$worktask = mysql_query("select task_id, location_id, sched from pmls_android_worker_task where worker_id like '".$id."' and end is null and sched like '".$date."%' order by task_id");

//$temp = mysql_fetch_array($worktask);
$tmp = "";
$loc = "";
$cnt = 0;
$first = true;
if(mysql_num_rows($worktask) <> 0){
	
	while($res = mysql_fetch_array($worktask)){
		
		if($first){
			$tmp = $res["task_id"];
			$first = false;
		}
		
		if($tmp == $res["task_id"]){
			$location = mysql_query("select loc_name from pmls_android_reflocation where id like '".$res["location_id"]."'");
			$res2 = mysql_fetch_array($location);
			$loc = $loc.", ".$res2["loc_name"];
			$cnt++;
		}else{
			$list = array();
			$taskname = mysql_query("select description from pmls_android_reftask where id like '".$tmp."'");
			$res3 = mysql_fetch_array($taskname);
			$list["taskname"] = $res3["description"];
			$list["locname"] = $loc;
			$list["count"] = $cnt;
			$list["taskid"] = $tmp;
			array_push($response["task"], $list);
			$tmp = $res["task_id"];
			$loc = "";
			$cnt = 1;
		}
		
	}
	$list = array();
	$taskname = mysql_query("select description from pmls_android_reftask where id like '".$tmp."'");
	$res3 = mysql_fetch_array($taskname);
	$list["taskname"] = $res3["description"];
	$list["locname"] = $loc;
	$list["count"] = $cnt;
	$list["taskid"] = $tmp;
	array_push($response["task"], $list);
	
	$response["success"] = 1;
}else{
	$response["success"] = 0;
}

echo json_encode($response);

?>