<?php

error_reporting(E_ALL ^ E_DEPRECATED);
require_once __DIR__ . '/db_connect.php';
$db = new DB_CONNECT();

$date = date('Y-m-d', strtotime($_GET["datez"]));
$year = date('Y', strtotime($date));
$mallid = $_GET["mallid"];
//$mallid = "MALL-0000010";
//$mallid = "MALL-0000001";

$response = array();
$response["wings"] = array();

$getWings = mysql_query("select wingid, wing from tblref_wing where mallid like '$mallid'");
if(mysql_num_rows($getWings) <> 0){
	while($rowWings = mysql_fetch_array($getWings)){
		$cnt = 0;
		$getUnit = mysql_query("select unitid from tblref_unit where wingid like '".$rowWings["wingid"]."'");
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
		$list["id"] = $rowWings["wingid"];
		$list["wing"] = $rowWings["wing"];
		$list["val"] = $cnt;
		array_push($response["wings"], $list);
	}
	$response["success"] = 1;
}else{
	$response["success"] = 0;
}

echo json_encode($response);

?>