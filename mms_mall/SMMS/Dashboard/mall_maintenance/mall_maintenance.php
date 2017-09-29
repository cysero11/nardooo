<?php

error_reporting(E_ALL ^ E_DEPRECATED);
require_once __DIR__ . '/db_connect.php';
$db = new DB_CONNECT();

$date = date('Y-m-d', strtotime($_GET["datez"]));
$year = date('Y', strtotime($date));
//$date = date('Y-m-d', strtotime("2017-4-8"));
//$year = date('Y', strtotime($date));
$response = array();
$response["malls"] = array();

$getMalls = mysql_query("select mallid, mallname from tblref_mall");

if(mysql_num_rows($getMalls) <> 0){
	while($malls = mysql_fetch_array($getMalls)){
		$getVals = mysql_query("SELECT SUM(total_amount) as cnt FROM pmls_android_worker_task_history WHERE building_id LIKE '".$malls["mallid"]."' and endt between '$year-01-01' and '$date'");
		$count = 0;
		if(mysql_num_rows($getVals) <> 0){
			$vals = mysql_fetch_array($getVals);
			$count = $vals["cnt"];
		}
		$list = array();
		$list["id"] = $malls["mallid"];
		$list["mall"] = $malls["mallname"];
		$list["val"] = $count <> null ? $count : 0;
		array_push($response["malls"], $list);
	}
	$response["success"] = 1;
}else{
	$response["success"] = 0;
}

echo json_encode($response);

?>