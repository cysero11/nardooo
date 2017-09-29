<?php

error_reporting(E_ALL ^ E_DEPRECATED);
require_once __DIR__ . '/db_connect.php';
$db = new DB_CONNECT();

$response = array();

$salesid = $_GET["id"];
//$salesid = "S-0000001";

$refsalesinquiry = mysql_query("select customername, createddate, salesperson, roomnumber, investigator, startdate, roomamount, sourceinquiry, companyname, customeraddress, bldgname, roomid, advance, deposit, monthadvance, monthdeposit, startdate, enddate, totalamount from refsalesinquiry where salesinquiryid like '".$salesid."'");

if(mysql_num_rows($refsalesinquiry) <> 0){
	
	$row = mysql_fetch_array($refsalesinquiry);
		
	$response["customername"] = $row["customername"];
	$response["createddate"] = $row["createddate"];
	$response["salesperson"] = $row["salesperson"];
	$response["roomnumber"] = $row["roomnumber"];
	$response["roomamount"] = $row["roomamount"];
	$response["investigator"] = $row["investigator"];
	$response["startdate"] = $row["startdate"];
	$response["cidate"] = date("Y-m-d");
	
	$response["sourceinquiry"] = $row["sourceinquiry"];
	$response["companyname"] = $row["companyname"];
	$response["customeraddress"] = $row["customeraddress"];
	
	//This is for the building info
	$bldg = mysql_query("select bldgtype, fulladdress, bldgabb from pmls_bldg where bldgname like '".$row["bldgname"]."'");
	$row1 = mysql_fetch_array($bldg);
	
	$response["bldgname"] = $row["bldgname"];
	$response["bldgtype"] = $row1["bldgtype"];
	$response["fulladdress"] = $row1["fulladdress"];
	$response["bldgabb"] = $row1["bldgabb"];
	
	//This is for the room information
	$unit = mysql_query("select bldgtype, areasize, pricepersqm, floornumber, bathrooms from pmls_room where roomid like '".$row["roomid"]."'");
	$row2 = mysql_fetch_array($unit);
	
	$response["unittype"] = $row2["bldgtype"];
	$response["areasize"] = $row2["areasize"];
	$response["pricepersqm"] = $row2["pricepersqm"];
	$response["floornumber"] = $row2["floornumber"];
	$response["bathrooms"] = $row2["bathrooms"];
	//Back to refsalesinquiry
	$response["advance"] = $row["advance"];
	$response["deposit"] = $row["deposit"];
	$response["monthadvance"] = $row["monthadvance"];
	$response["monthdeposit"] = $row["monthdeposit"];
	$response["between"] = $row["startdate"]." - ".$row["enddate"];
	$response["totalamount"] = $row["totalamount"];
	
	
	$response["success"] = 1;
}else{
	$response["success"] = 0;
}

echo json_encode($response);

?>