<?php

error_reporting(E_ALL ^ E_DEPRECATED);
require_once __DIR__ . '/db_connect.php';
$db = new DB_CONNECT();

$response["bldg"] = array();

$quer = mysql_query("select bldgnumber, cutoffwater, duedatewater, cutoffelectricity, duedateelectricity, cubicrate, kilowattrate from pmls_bldg");
if(mysql_num_rows($quer) <> 0){
	
	while($row = mysql_fetch_array($quer)){
		$vals = array();
		
		$vals["bldgnumber"] = $row["bldgnumber"];
		$vals["cutoffwater"] = $row["cutoffwater"];
		$vals["duedatewater"] = $row["duedatewater"];
		$vals["cutoffelectricity"] = $row["cutoffelectricity"];
		$vals["duedateelectricity"] = $row["duedateelectricity"];
		$vals["cubicrate"] = $row["cubicrate"];
		$vals["kilowattrate"] = $row["kilowattrate"];
		
		array_push($response["bldg"], $vals);
		
	}
	$response["success"] = 1;
}else{
	$response["success"] = 0;
}
echo json_encode($response);
?>