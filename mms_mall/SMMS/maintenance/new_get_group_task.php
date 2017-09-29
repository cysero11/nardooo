<?php

error_reporting(E_ALL ^ E_DEPRECATED);
require_once __DIR__ . '/db_connect.php';
$db = new DB_CONNECT();

$id = $_GET['id'];
$date = $_GET["date"];
//$id = "USER-0000008";
//$date = "2017-07-18";
$response = array();
$response["task"] = array();

$getTask = mysql_query("select workorderid, tradename, xdate, xtime, xstatus from tblmaintenance_workorder where workerid like '$id' and xdate = '$date'");
if(mysql_num_rows($getTask) <> 0){
	while($rowTask = mysql_fetch_array($getTask)){
		$list = array();
		$list["id"] = $rowTask["workorderid"];
		$list["tradename"] = $rowTask["tradename"];
		$list["date"] = $rowTask["xdate"];
		$list["time"] = $rowTask["xtime"];
		$list["status"] = $rowTask["xstatus"];
		array_push($response["task"], $list);
	}
	$response["success"] = 1;
}else{
	$response["success"] = 0;
}
echo json_encode($response);
?>