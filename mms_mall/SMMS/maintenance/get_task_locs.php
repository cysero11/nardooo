<?php

error_reporting(E_ALL ^ E_DEPRECATED);
require_once __DIR__ . '/db_connect.php';
$db = new DB_CONNECT();

$id = $_GET['id'];
$date = $_GET["date"];
//$date = date('Y-m-d', strtotime($date)); 

//$id = "USER-0000002";
//$date = "2017-03-14";
$date = date('m/d/Y', strtotime($date));

//echo $date."<br>";

$response = array();
$response["task"] = array();

$worktask = mysql_query("select staff_task_id, location_id, floorid, task_id, task_id_management, remarks, labor_exp, material_exp, complaint_seriesno from pmls_android_worker_task where worker_id like '".$id."' and sched like '".$date."%' order by task_id, sched");
if(mysql_num_rows($worktask) <> 0){
	
	while($res = mysql_fetch_array($worktask)){
		$arraytmp = array();
		
		$arraytmp["task_id"] = isset($res["staff_task_id"]) ? $res["staff_task_id"] : "";
		
		// getting the task description
		$taskto = "";
		$reftask = "";
		if($res["task_id"] == null || $res["task_id"] == "undefined" || $res["task_id"] == ""){
			$reftask = mysql_query("select description, type from pmls_android_reftask where task_id like '".$res["task_id_management"]."'");
			$taskto = "management";
		}else{
			$reftask = mysql_query("select description, type from pmls_android_reftask where task_id like '".$res["task_id"]."'");
			$taskto = "tenant";
		}
		if(mysql_num_rows($reftask) <> 0){
			$reftask_row = mysql_fetch_array($reftask);
			$arraytmp["task_desc"] = isset($reftask_row["description"]) ? $reftask_row["description"] : "";
			$arraytmp["task_type"] = isset($reftask_row["type"]) ? $reftask_row["type"] : "";
		}else{
			$arraytmp["task_desc"] = "";
			$arraytmp["task_type"] = "";
		}
		
		if($res["complaint_seriesno"] == null){
			
			// getting floor number_format
			$tblreffloor = mysql_query("select floor from tblref_floorsetup where floorid like '".$res["floorid"]."'");
			if(mysql_num_rows($tblreffloor) <> 0){
				$tblreffloor_row = mysql_fetch_array($tblreffloor);
				$arraytmp["floor"] = isset($tblreffloor_row["floor"]) ? $tblreffloor_row["floor"] : "";
			}else{
				$arraytmp["floor"] = "";
			}
			
			// getting the unit name
			$tblrefunit = mysql_query("select unitname from tblref_unit where unitid like '".$res["location_id"]."'");
			if(mysql_num_rows($tblrefunit) <> 0){
				$tblrefunit_row = mysql_fetch_array($tblrefunit);
				$arraytmp["unitname"] = isset($tblrefunit_row["unitname"]) ? $tblrefunit_row["unitname"] : "";
			}else{
				$arraytmp["unitname"] = "";
			}
		}else{
			
			// getting floor number_format
			$fomComplaints = mysql_query("select unitid, floorid from tblcomplaints where Complaint_Series_No like '".$res["complaint_seriesno"]."'");
			$resComps = mysql_fetch_array($fomComplaints);
			
			$tblreffloor = mysql_query("select floor from tblref_floorsetup where floorid like '".$resComps["floorid"]."'");
			if(mysql_num_rows($tblreffloor) <> 0){
				$tblreffloor_row = mysql_fetch_array($tblreffloor);
				$arraytmp["floor"] = isset($tblreffloor_row["floor"]) ? $tblreffloor_row["floor"] : "";
			}else{
				$arraytmp["floor"] = "";
			}
			
			// getting the unit name
			$tblrefunit = mysql_query("select unitname from tblref_unit where unitid like '".$resComps["unitid"]."'");
			if(mysql_num_rows($tblrefunit) <> 0){
				$tblrefunit_row = mysql_fetch_array($tblrefunit);
				$arraytmp["unitname"] = isset($tblrefunit_row["unitname"]) ? $tblrefunit_row["unitname"] : "";
			}else{
				$arraytmp["unitname"] = "";
			}
		}
		
		$arraytmp["taskto"] = $taskto;
		$arraytmp["location_id"] = isset($resComps["location_id"]) ? $resComps["location_id"] : "";
		$arraytmp["remarks"] = isset($res["remarks"]) ? $res["remarks"] : "";
		$arraytmp["labor_exp"] = isset($res["labor_exp"]) ? $res["labor_exp"] : '0';
		$arraytmp["material_exp"] = isset($res["material_exp"]) ? $res["material_exp"] : '0';
		
		array_push($response["task"], $arraytmp);
	}
	
	$response["success"] = 1;
}else{
	$response["success"] = 0;
}

echo json_encode($response);

?>














