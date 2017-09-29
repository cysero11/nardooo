<?php

error_reporting(E_ALL ^ E_DEPRECATED);
require_once __DIR__ . '/db_connect.php';
$db = new DB_CONNECT();

$response = array();
$response["cilist"] = array();

$refsalesinquiry = mysql_query("select salesinquiryid, customername, createddate, salesperson, roomnumber, investid, investigator, startdate, roomamount, sourceinquiry, companyname, customeraddress, bldgname, roomid, advance, deposit, monthadvance, monthdeposit, startdate, enddate, totalamount from refsalesinquiry where status like 'Pending'");

if(mysql_num_rows($refsalesinquiry) <> 0){
	
	while($row = mysql_fetch_array($refsalesinquiry)){
		$vsls = array();
		$vals["salesinquiryid"] = $row["salesinquiryid"];
		$vals["customername"] = $row["customername"];
		$vals["createddate"] = $row["createddate"];
		$vals["salesperson"] = $row["salesperson"];
		$vals["roomnumber"] = $row["roomnumber"];
		$vals["roomamount"] = $row["roomamount"];
		$vals["investid"] = $row["investid"];
		$vals["investigator"] = $row["investigator"];
		$vals["startdate"] = $row["startdate"];
		$vals["cidate"] = date("Y-m-d");
		
		$vals["sourceinquiry"] = $row["sourceinquiry"];
		$vals["companyname"] = $row["companyname"];
		$vals["customeraddress"] = $row["customeraddress"];
		
		//This is for the building info
		$bldg = mysql_query("select bldgtype, fulladdress, bldgabb from pmls_bldg where bldgname like '".$row["bldgname"]."'");
		$row1 = mysql_fetch_array($bldg);
		
		$vals["bldgname"] = $row["bldgname"];
		$vals["bldgtype"] = $row1["bldgtype"];
		$vals["fulladdress"] = $row1["fulladdress"];
		$vals["bldgabb"] = $row1["bldgabb"];
		
		//This is for the room information
		$unit = mysql_query("select bldgtype, areasize, pricepersqm, floornumber, bathrooms from pmls_room where roomid like '".$row["roomid"]."'");
		$row2 = mysql_fetch_array($unit);
		
		$vals["unittype"] = $row2["bldgtype"];
		$vals["areasize"] = $row2["areasize"];
		$vals["pricepersqm"] = $row2["pricepersqm"];
		$vals["floornumber"] = $row2["floornumber"];
		$vals["bathrooms"] = $row2["bathrooms"];
		//Back to refsalesinquiry
		$vals["advance"] = $row["advance"];
		$vals["deposit"] = $row["deposit"];
		$vals["monthadvance"] = $row["monthadvance"];
		$vals["monthdeposit"] = $row["monthdeposit"];
		$vals["between"] = $row["startdate"]." - ".$row["enddate"];
		$vals["totalamount"] = $row["totalamount"];
		array_push($response["cilist"], $vals);
	}
	
	
	$response["success"] = 1;
}else{
	$response["success"] = 0;
}

echo json_encode($response);

?>