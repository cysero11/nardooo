<?php

error_reporting(E_ALL ^ E_DEPRECATED);
require_once __DIR__ . '/db_connect.php';
$db = new DB_CONNECT();

$id = $_GET['id'];
//$id = "JO-0000317";
$response = array();
$response["task"] = array();

$getAllTasks = mysql_query("SELECT id, xcategory, xtaskid, workorderid, taskstatus FROM tblmaintenance_workorderlist where workorderid like '$id'");
if(mysql_num_rows($getAllTasks) <> 0){
	while($rowTask = mysql_fetch_array($getAllTasks)){
		$list = array();
		$taskname = "";
		$amount = "";
		$tenantname = "";
		$mallname = "";
		$wingname = "";
		$floorname = "";
		$date = "";
		$time = "";
		if($rowTask["xtaskid"] == ""){
			$getCateg = mysql_query("select category_id, category from tblmaintenance_category where category_id like '".$rowTask["xcategory"]."'");
			if(mysql_num_rows($getCateg) <> 0){
				$rowCateg = mysql_fetch_array($getCateg);
				$taskname = $rowCateg["category"];
				if($rowCateg["category"] == "Electric Reading" or $rowCateg["category"] == "Water Reading"){
					$amount = getLastReading($rowCateg["category_id"], $rowTask["workorderid"]);
				}else{
					$amount = "0";
				}
			}
		}else{
			$Description = mysql_query("select description, amount from tblmaintenance_tasklist where taskid like '".$rowTask["xtaskid"]."'");
			if(mysql_num_rows($Description) <> 0){
				$getDescription = mysql_fetch_array($Description);
				$taskname = $getDescription["description"];
				$amount = $getDescription["amount"];
			}
		}
		
		$getRestDets = mysql_query("select tenantid, joformanagement, xdate, xtime from tblmaintenance_workorder where workorderid like '".$rowTask["workorderid"]."'");
		if(mysql_num_rows($getRestDets) <> 0){
			$rowRestDets = mysql_fetch_array($getRestDets);
			if($rowRestDets["tenantid"] == ""){
				$tenantname = "Federaland";
				$wingname = "Federaland";
				$floorname = "Federaland";
				$getUnit = mysql_query("select unit from tblmaintenance_equip where code like '".$rowRestDets["joformanagement"]."' and (unit <> '' or unit = null)");
				if(mysql_num_rows($getUnit) <> 0){
					$rowUnit = mysql_fetch_array($getUnit);
					$mallname = getMall($rowUnit["unit"]);
				}else{
					$mallname = "Federaland";
				}
			}else{
				$getTenant = mysql_query("select companyname, mallid, unitid from tbltrans_tenants where tenantid like '".$rowRestDets["tenantid"]."'");
				if(mysql_num_rows($getTenant) <> 0){
					$rowTenant = mysql_fetch_array($getTenant);
					$tenantname = $rowTenant["companyname"];
					$mallname = getMall($rowTenant["mallid"]);
					$wingname = getWing($rowTenant["unitid"]);
					$floorname = getFloor($rowTenant["unitid"]);
				}else{
					$tenantname = "Federaland";
					$wingname = "Federaland";
					$floorname = "Federaland";
					$mallname = "Federaland";
				}
			}
			$date = $rowRestDets["xdate"];
			$time = $rowRestDets["xtime"];
		}
		
		$list["id"] = $rowTask["id"];
		$list["taskname"] = $taskname;
		$list["amount"] = $amount;
		$list["tenantname"] = $tenantname;
		$list["mallname"] = $mallname;
		$list["wingname"] = $wingname;
		$list["floorname"] = $floorname;
		$list["date"] = $date;
		$list["time"] = $time;
		$list["taskstatus"] = $rowTask["taskstatus"];
		
		array_push($response["task"], $list);
	}
	
	$elec = "0";
	$water = "0";
	$getReadingVals = mysql_query("select elec_amnt, watr_amnt from mall_setup");
	if(mysql_num_rows($getReadingVals) <> 0){
		$rowRead = mysql_fetch_array($getReadingVals);
		$elec = $rowRead["elec_amnt"];
		$water = $rowRead["watr_amnt"];
	}
	
	$response["elec"] = $elec;
	$response["water"] = $water;
	
	$response["success"] = 1;
}else{
	$response["success"] = 0;
}
echo json_encode($response);

function getLastReading($catId, $id){
	$vals = "0";
	$getUnit = mysql_query("SELECT tbltrans_tenants.`unitID` FROM tblmaintenance_workorderlist, tblmaintenance_workorder, tbltrans_tenants
							WHERE tblmaintenance_workorderlist.`workorderid` LIKE '$id'
							AND tblmaintenance_workorderlist.`workorderid` LIKE tblmaintenance_workorder.`workorderid`
							AND tbltrans_tenants.`TenantID` LIKE tblmaintenance_workorder.`TenantID` LIMIT 1");
	if(mysql_num_rows($getUnit) <> 0){
		$rowUnit = mysql_fetch_array($getUnit);
		$getLastRead = mysql_query("SELECT tblmaintenance_workorderlist.`meter_reading` FROM tblmaintenance_workorderlist, tblmaintenance_workorder, tbltrans_tenants
									WHERE tblmaintenance_workorderlist.`xcategory` LIKE '$catId'
									AND tblmaintenance_workorderlist.`workorderid` LIKE tblmaintenance_workorder.`workorderid`
									AND tblmaintenance_workorder.`TenantID` LIKE tbltrans_tenants.`TenantID`
									AND tbltrans_tenants.`unitID` LIKE '".$rowUnit["unitID"]."' AND tbltrans_tenants.`unitID` <> ''");
		if(mysql_num_rows($getLastRead) <> 0){
			$rowLastRec = mysql_fetch_array($getLastRead);
			$vals = $rowLastRec["meter_reading"];
		}
	}
	return $vals;
}

function getMall($mallid){
	$mallname = "Federaland";
	$getMall = mysql_query("select mallname from tblref_mall where mallid like '$mallid'");
	if(mysql_num_rows($getMall) <> 0){
		$rowMall = mysql_fetch_array($getMall);
		$mallname = $rowMall["mallname"];
	}
	return $mallname;
}

function getWing($wingid){
	$wingname = "Federaland";
	$getWing = mysql_query("select buildingname from tblref_unit where unitid like '$wingid'");
	if(mysql_num_rows($getWing) <> 0){
		$rowWing = mysql_fetch_array($getWing);
		$wingname = $rowWing["buildingname"];
	}
	return $wingname;
}

function getFloor($wingid){
	$floorname = "Federaland";
	$getUnit = mysql_query("select floorid from tblref_unit where unitid like '$wingid'");
	if(mysql_num_rows($getUnit) <> 0){
		$rowUnit = mysql_fetch_array($getUnit);
		$getFloor = mysql_query("select floor from tblref_floorsetup where floorid like '".$rowUnit["floorid"]."'");
		if(mysql_num_rows($getFloor) <> 0){
			$rowFloor = mysql_fetch_array($getFloor);
			$floorname = $rowFloor["floor"];
		}
		
	}
	return $floorname;
}

?>