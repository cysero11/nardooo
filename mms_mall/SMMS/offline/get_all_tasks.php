<?php

error_reporting(E_ALL ^ E_DEPRECATED);
require_once __DIR__ . '/db_connect.php';
$db = new DB_CONNECT();

$response = array();

$response["users"] = array();

$query = mysql_query("select * from pmls_android_worker_task");
if(mysql_num_rows($query) <> 0){
	while($row = mysql_fetch_array($query)){
		$vals = array();
		$vals["staff_task_id"] = $row["staff_task_id"];
		$vals["room_owner_id"] = $row["room_owner_id"];
		$vals["ownername"] = $row["ownername"];
		$vals["building_id"] = $row["building_id"];
		$vals["floorid"] = $row["floorid"];
		$vals["category_tenant"] = $row["category_tenant"];
		$vals["category_management"] = $row["category_management"];
		$vals["task_id"] = $row["task_id"];
		$vals["task_id_management"] = $row["task_id_management"];
		$vals["lasttask_id"] = $row["lasttask_id"];
		$vals["location_id"] = $row["location_id"];
		$vals["management_location"] = $row["management_location"];
		$vals["worker_id"] = $row["worker_id"];
		$vals["remarks"] = $row["remarks"];
		$vals["sched"] = date('Y-m-d', strtotime($row["sched"]));
		$vals["timestart"] = $row["timestart"];
		$vals["startt"] = $row["startt"];
		$vals["labor_exp"] = $row["labor_exp"];
		$vals["material_exp"] = $row["material_exp"];
		
		$quer2 = mysql_query("select unitname, floorunit from tblref_unit where unitid like '".$row["location_id"]."'");
		$row2 = mysql_fetch_array($quer2);
		$vals["unitname"] = $row2["unitname"];
		$getfloor = mysql_query("select floor from tblref_floorsetup where floorid like '".$row2["floorunit"]."'");
		$floor = mysql_fetch_array($getfloor);
		$vals["floornumber"] = $floor["floor"];
		
		$reftask = "";
		if($row["task_id"] == null || $row["task_id"] == "undefined"){
			$reftask = mysql_query("select description, type from pmls_android_reftask where task_id like '".$row["task_id_management"]."'");
		}else{
			$reftask = mysql_query("select description, type from pmls_android_reftask where task_id like '".$row["task_id"]."'");
		}
		$row3 = mysql_fetch_array($reftask);
		$vals["taskdesc"] = $row3["description"];
		$vals["tasktype"] = $row3["type"];
		
		array_push($response["users"], $vals);
	}
	$response["success"] = 1;
}else{
	$response["success"] = 0;
}

echo json_encode($response);

?>