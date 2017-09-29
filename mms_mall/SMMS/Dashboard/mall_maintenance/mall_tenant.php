<?php

error_reporting(E_ALL ^ E_DEPRECATED);
require_once __DIR__ . '/db_connect.php';
$db = new DB_CONNECT();

$date = date('Y-m-d', strtotime($_GET["datez"]));
$year = date('Y', strtotime($date));
$floorid = $_GET["floorid"];
//$floorid = "FLOOR-0000047";
$classid = $_GET["classid"];
//$classid = "class_1";

$response = array();
$response["units"] = array();

$getUnit = mysql_query("select unitid, unitname from tblref_unit where floorid like '$floorid' and classid like '$classid'");
if(mysql_num_rows($getUnit)){
	while($rowUnit = mysql_fetch_array($getUnit)){
		$cnt = 0;
		$getUnitAmount = mysql_query("select total_amount from pmls_android_worker_task_history where location_id like '".$rowUnit["unitid"]."'");
		if(mysql_num_rows($getUnitAmount) <> 0){
			while($rowAmount = mysql_fetch_array($getUnitAmount)){
				$cnt += $rowAmount["total_amount"];
			}
		}
		$list = array();
		$list["id"] = $rowUnit["unitid"];
		$list["unit"] = $rowUnit["unitname"];
		$list["val"] = $cnt;
		array_push($response["units"], $list);
	}
	$response["success"] = 1;
}else{
	$response["success"] = 0;
}
echo json_encode($response);
?>