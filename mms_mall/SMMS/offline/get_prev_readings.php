<?php

error_reporting(E_ALL ^ E_DEPRECATED);
require_once __DIR__ . '/db_connect.php';
$db = new DB_CONNECT();

$response = array();
$response["reading"] = array();

$quer = mysql_query("select unitid from tblref_unit");
if(mysql_num_rows($quer) <> 0){
	
	while($row = mysql_fetch_array($quer)){
		$vals = array();

		$prevreading1 = mysql_query("select kilowatt from pmls_android_worker_task_history where location_id like '".$row["unitid"]."' AND kilowatt IS NOT NULL order by endt desc");
		$res = mysql_fetch_array($prevreading1);
		if($res["kilowatt"] == null or $res["kilowatt"] == "") $vals["kilowatt"] = "0"; else $vals["kilowatt"] = $res["kilowatt"];

		$prevreading2 = mysql_query("select cubic_meter from pmls_android_worker_task_history where location_id like '".$row["unitid"]."' AND cubic_meter IS NOT NULL order by endt desc");
		$res = mysql_fetch_array($prevreading2);
		if($res["cubic_meter"] == null or $res["cubic_meter"] == "") $vals["cubic_meter"] = "0"; else $vals["cubic_meter"] = $res["cubic_meter"];
			
		$vals["roomid"] = $row["unitid"];
		
		array_push($response["reading"], $vals);
	}
	$response["success"] = 1;
}else{
	$response["success"] = 1;
}
echo json_encode($response);
?>