<?php

error_reporting(E_ALL ^ E_DEPRECATED);
require_once __DIR__ . '/db_connect.php';
$db = new DB_CONNECT();

$taskid = $_POST["taskid"];
$material = $_POST["material"];
$labor = $_POST["labor"];
$remarks = $_POST["remarks"];
$duration = $_POST["duration"];

//$taskid = "ST-0000003";
//$material = "10.00";
//$labor = "10.00";
//$remarks = "fsadfasdf";
//$duration = "00-00-00";
$total = $labor + $material;

$getTask = mysql_query("select * from pmls_android_worker_task where staff_task_id like '".$taskid."'");
if(mysql_num_rows($getTask) <> 0){
	$res1 = mysql_fetch_array($getTask);
	$saveToHistory = mysql_query("insert into pmls_android_worker_task_history set staff_task_id = '".$res1["staff_task_id"].
				"', room_owner_id = '".$res1["room_owner_id"].
				"', ownername = '".$res1["ownername"].
				"', building_id = '".$res1["building_id"].
				"', floorid = '".$res1["floorid"].
				"', category_tenant = '".$res1["category_tenant"].
				"', category_management = '".$res1["category_management"].
				"', task_id = '".$res1["task_id"].
				"', task_id_management = '".$res1["task_id_management"].
				"', lasttask_id = '".$res1["lasttask_id"].
				"', location_id = '".$res1["location_id"].
				"', management_location = '".$res1["management_location"].
				"', worker_id = '".$res1["worker_id"].
				"', remarks = '".$res1["remarks"].
				"', sched = '".$res1["sched"].
				"', startt = '".$res1["startt"].
				"', endt = NOW()"."".
				", duration = '".$duration.
				"', tagstat = 'repairbill'"."".
				", labor_exp = '".$labor.
				"', material_exp = '".$material.
				"', total_amount = '".$total."'");
				
	$getUnit = mysql_query("select unitname, TenantID, TenantName, status from tblref_unit where unitid like '".$res1["location_id"]."'");
	if(mysql_num_rows($getUnit) <> 0){
		$units = mysql_fetch_array($getUnit);
		$saveLogs = mysql_query("insert into tblunit_statuslogs set unitid = '".$res1["location_id"]."', unitname = '".$units["unitname"]."', tenantid = '".$units["TenantID"].
								"', tenantname = '".$units["TenantName"]."', xdate = '".date('Y-m-d', strtotime($res1["sched"]))."', xtime = '".$res1["timestart"]."', status = '".$units["status"].
								"', ".$unitCols." = '1'");
	}
	
	// check if this is a complaint, if so then update the complaint to be resolved.
	if(isset($res1["complaint_seriesno"])){
		$complaint = mysql_query("update tblcomplaints set time_received = '".$res1["startt"]."', time_resolved = NOW(), duration = '".$duration."', Complaint_Status = 'Resolved' where Complaint_Series_No = '".$res1["complaint_seriesno"]."'");
	}
	
	$delete = mysql_query("delete from pmls_android_worker_task where staff_task_id like '".$taskid."'");
	
}


?>