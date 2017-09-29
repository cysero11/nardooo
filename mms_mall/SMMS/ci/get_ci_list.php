<?php

error_reporting(E_ALL ^ E_DEPRECATED);
require_once __DIR__ . '/db_connect.php';
$db = new DB_CONNECT();

$response = array();

$response["listdet"] = array();

$userid = $_GET["id"];
$status = $_GET["status"];
//$userid = "USER-0000002";

$refsalesinquiry = mysql_query("select roomnumber, customername, floornumber, customeraddress, salesinquiryid from refsalesinquiry where investid like '".$userid."' and status like '".$status."'");
if(mysql_num_rows($refsalesinquiry) <> 0){
	
	while($row = mysql_fetch_array($refsalesinquiry)){
		
		$list = array();
		
		$list["roomnumber"] = $row["roomnumber"];
		$list["customername"] = $row["customername"];
		$list["floornumber"] = $row["floornumber"];
		$list["customeraddress"] = $row["customeraddress"];
		$list["salesinquiryid"] = $row["salesinquiryid"];
		
		array_push($response["listdet"], $list);
		
	}
	
	$response["success"] = 1;
}else{
	$response["success"] = 0;
}

echo json_encode($response);

?>