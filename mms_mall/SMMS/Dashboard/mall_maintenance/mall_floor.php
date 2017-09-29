<?php

error_reporting(E_ALL ^ E_DEPRECATED);
require_once __DIR__ . '/db_connect.php';
$db = new DB_CONNECT();

$date = date('Y-m-d', strtotime($_GET["datez"]));
$year = date('Y', strtotime($date));
$wingid = $_GET["wingid"];
//$wingid = "WING-0000001";
$response = array();
$response["floors"] = array();

$getFloor = mysql_query("select floorid, floor from tblref_floorsetup where wingid like '$wingid'");
if(mysql_num_rows($getFloor) <> 0){
	while($rowWing = mysql_fetch_array($getFloor)){
		$cnt = 0;
		$getUnitAmount = mysql_query("select total_amount from pmls_android_worker_task_history where floorid like '".$rowWing["floorid"]."'");
		if(mysql_num_rows($getUnitAmount) <> 0){
			while($rowAmount = mysql_fetch_array($getUnitAmount)){
				$cnt += $rowAmount["total_amount"];
			}
		}
		$list = array();
		$list["id"] = $rowWing["floorid"];
		$list["floor"] = $rowWing["floor"];
		$list["val"] = $cnt;
		array_push($response["floors"], $list);
	}
	$response["success"] = 1;
}else{
	$response["success"] = 0;
}

echo json_encode($response);


?>