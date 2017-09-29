<?php

error_reporting(E_ALL ^ E_DEPRECATED);
require_once __DIR__ . '/db_connect.php';
$db = new DB_CONNECT();

$date = date('Y-m-d', strtotime($_GET["datez"]));
$year = date('Y', strtotime($date));
$floorid = $_GET["floorid"];
//$floorid = "FLOOR-0000047";

$response = array();
$response["class"] = array();

$getClass = mysql_query("select classificationID, classification from tblref_merchandise_class");
if(mysql_num_rows($getClass) <> 0){
	while($rowClass = mysql_fetch_array($getClass)){
		$cnt = 0;
		$getUnit = mysql_query("select unitid from tblref_unit where classid like '".$rowClass["classificationID"]."' and floorid like '$floorid'");
		if(mysql_num_rows($getUnit) <> 0){
			while($rowUnit = mysql_fetch_array($getUnit)){
				$getUnitAmount = mysql_query("select total_amount from pmls_android_worker_task_history where location_id like '".$rowUnit["unitid"]."'");
				if(mysql_num_rows($getUnitAmount) <> 0){
					while($rowAmount = mysql_fetch_array($getUnitAmount)){
						$cnt += $rowAmount["total_amount"];
					}
				}
			}
		}
		$list = array();
		$list["id"] = $rowClass["classificationID"];
		$list["class"] = $rowClass["classification"];
		$list["val"] = $cnt;
		array_push($response["class"], $list);
	}
	$response["success"] = 1;
}else{
	$response["success"] = 0;
}

echo json_encode($response);

?>