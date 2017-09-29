<?php

error_reporting(E_ALL ^ E_DEPRECATED);
require_once __DIR__ . '/db_connect.php';
$db = new DB_CONNECT();
/*
$staff_task_id = "ST-0000020";
$charge_type_id = "CHRG-0000005";
$charge_amount = "23";
$remarks = "fukmvx";
*/
$staff_task_id = isset($_POST["staff_task_id"]) ? $_POST["staff_task_id"] : "";
$charge_type_id = isset($_POST["charge_type_id"]) ? $_POST["charge_type_id"] : "";
$charge_amount = isset($_POST["charge_amount"]) ? $_POST["charge_amount"] : "";
$remarks = isset($_POST["remarks"]) ? $_POST["remarks"] : "";

$newid = "";

$recordid = mysql_query("select lastid from refrecordid where tablename like 'tbl_charges_detail'");
if(mysql_num_rows($recordid) <> 0){
	$row = mysql_fetch_array($recordid);
	$expid = array();
	$expid = explode("-", $row["lastid"]);
	$newid = "CD-".str_pad($expid[1] + 1, 7, "0", STR_PAD_LEFT);
	
	$recordidUpdate = mysql_query("update refrecordid set lastid = '".$newid."' where tablename like 'tbl_charges_detail'");
	
	$tbl_charges_detail = mysql_query("insert into tbl_charges_detail set charge_detail_id = '".$newid."', staff_task_id = '".$staff_task_id.
									"', charge_type_id = '".$charge_type_id."', charge_amount = '".$charge_amount."', remarks = '".$remarks."'");
									
}

?>