<?php

error_reporting(E_ALL ^ E_DEPRECATED);
require_once __DIR__ . '/db_connect.php';
$db = new DB_CONNECT();

//$id = $_GET['taskid'];
$id = "1";

$response = array();
$response["locs"] = array();
$dur = "00:00:00";
$hour = 0;
$min = 0;
$sec = 0;

$loctask = mysql_query("select location_id, time_duration from pmls_android_location_task where work_task_id like '".$id."' order by task_id");
if(mysql_num_rows($loctask) <> 0){
	
	while($res = mysql_fetch_array($loctask)){
		
		$arraytmp = array();
		$tasklist = "";
		if($res["time_duration"] == "" or $res["time_duration"] == null) $sqltime = "00:00:00"; else $sqltime = $res["time_duration"];
		$time = $res["time_duration"];
		$hour += $time[0].$time[1];
		$min += $time[3].$time[4];
		$sec += $time[6].$time[7];
		
		$locname = mysql_query("select room_number, total_area, floor_number from pmls_android_refroom where id like '".$res["location_id"]."' order by room_number");
		while($res2 = mysql_fetch_array($locname)){
			$arraytmp["name"] = "Room ".$res2["room_number"];
			$arraytmp["area"] = $res2["total_area"];
			$arraytmp["floor"] = $res2["floor_number"];
		}
		array_push($response["locs"], $arraytmp);
	}
	$hour += $min / 60;
	$min %= 60;
	$min += $sec / 60;
	$sec %= 60;
	$response["duration"] = two(floor($hour)).":".two(floor($min)).":".two($sec);
	$response["success"] = 1;
}else{
	$response["success"] = 0;
}
echo json_encode($response);

function two($num){
	if(strlen($num) <> 2) return "0".$num;
	return $num;
}

?>