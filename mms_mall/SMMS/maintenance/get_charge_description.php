<?php

error_reporting(E_ALL ^ E_DEPRECATED);
require_once __DIR__ . '/db_connect.php';
$db = new DB_CONNECT();

$taskid = $_GET["taskid"];
//$taskid = "JO-0000120";
$response = array();
$charge = "";
$durationn = "";

$query = mysql_query("select category_tenant, category_management from pmls_android_worker_task where staff_task_id like '".$taskid."'");
if(mysql_num_rows($query) <> 0){
	$row = mysql_fetch_array($query);
	$cattype = "";
	if($row["category_tenant"] == null || $row["category_tenant"] == "undefined") $cattype = $row["category_management"];
	else $cattype = $row["category_tenant"];
	$query2 = mysql_query("select description from tblref_charges_type where chargetypeid like '".$cattype."'");
	if(mysql_num_rows($query2) <> 0){
		$row2 = mysql_fetch_array($query2);
		$charge = $row2["description"];
	}
	$response["chargename"] = $charge;
	
	$quer = mysql_query("update pmls_android_worker_task set startt = NOW(), xstat = 'Ongoing' where staff_task_id like '".$taskid."'");
	
	$duration = mysql_query("select duration from pmls_android_worker_task where staff_task_id like '".$taskid."'");
	
	if(mysql_num_rows($duration) <>  0){
		$dur = mysql_fetch_array($duration);
		$durationn = $dur["duration"];
	}else{
		$durationn = "00:00:00";
	}
	
	$response["duration"] = $durationn;

}

echo json_encode($response);

?>