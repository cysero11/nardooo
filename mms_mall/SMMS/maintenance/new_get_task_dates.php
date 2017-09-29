<?php

error_reporting(E_ALL ^ E_DEPRECATED);
require_once __DIR__ . '/db_connect.php';
$db = new DB_CONNECT();

$id = $_GET['id'];
//$id = "USER-0000008";
$response = array();
$response["task"] = array();

$getDates = mysql_query("select xdate from tblmaintenance_workorder where xstatus like 'Pending' and workerid like '$id'");
if(mysql_num_rows($getDates) <> 0){
	while($row = mysql_fetch_array($getDates)){
		$list["sched"] = date('Y-m-d', strtotime($row["xdate"]));
		array_push($response["task"], $list);
	}
	$response["success"] = 1;
}else{
	$response["success"] = 0;
}
echo json_encode($response);
?>