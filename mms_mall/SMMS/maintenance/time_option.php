<?php

error_reporting(E_ALL ^ E_DEPRECATED);
require_once __DIR__ . '/db_connect.php';
$db = new DB_CONNECT();

$taskid = $_POST["taskid"];
$func = $_POST["function"];
$readVal = $_POST["readVal"];
$duration = $_POST["duration"];
$material = $_POST["material"];
$labor = $_POST["labor"];
$remarks2 = $_POST["remarks"];

//$taskid = "1";
//$func = "end_save_repair";
//$readVal = "25";
//$duration = "00:00:20";
//$material = "100";
//$labor = "100";
//$remarks2 = "fasdfasdfasdf";

$saveTo = "";
$phpTo = "";
$getrate = 0;
$phpval = 0;
$cut = "";
$due = "";
//$taskid = "1";
//$func = "end";

if($func == "start") $quer = mysql_query("update pmls_android_worker_task set starttt = NOW() where id like '".$taskid."'");
//elseif($func == "end") $quer = mysql_query("update pmls_android_worker_task set end = NOW() where id like '".$taskid."'");
elseif($func == "end"){
	$getTask = mysql_query("select * from pmls_android_worker_task where id like '".$taskid."'");
	$res1 = mysql_fetch_array($getTask);
	
	$task_id = (int)$res1["task_id"];
	$location_id = (int)$res1["location_id"];
	$worker_id = (int)$res1["worker_id"];
	$remarks = $res1["remarks"];
	$sched = $res1["sched"];
	$startt = $res1["startt"];
	$room_owner_id = (int)$res1["room_owner_id"];
	$saveVal = (int)$readVal;
	//echo $task_id." - ".$location_id." - ".$worker_id." - ".$remarks." - ".$sched." - ".$starttt." - ".$room_owner_id." - ".$saveVal;
	$saveToHistory = mysql_query("insert into pmls_android_worker_task_history set task_id = '".$task_id."' , location_id = '".$location_id."', worker_id = '".$worker_id."', remarks = '".$remarks."', sched = '".$sched."', startt = '".$startt."', endt = NOW(), duration = '".$duration."', room_owner_id = '".$room_owner_id."', tagstat = 'housekeeping', payment_stat = '0'");
}
elseif($func == "end_save_water" or $func == "end_save_elec"){
	$tag = "";
	if($func == "end_save_water"){
		$saveTo = "cubic_meter";
		$phpTo = "cubic_php";
		$getrate = "cubicrate";
		$tag = "waterbill";
		$cut = "cutoffwater";
		$due = "duedatewater";
	}else{
		$saveTo = "kilowatt";
		$phpTo = "kilowatt_php";
		$getrate = "kilowattrate";
		$tag = "electricity";
		$cut = "cutoffelectricity";
		$due = "duedateelectricity";
	}
	$getTask = mysql_query("select * from pmls_android_worker_task where id like '".$taskid."'");
	$res1 = mysql_fetch_array($getTask);
	
	$task_id = (int)$res1["task_id"];
	$location_id = $res1["location_id"];
	$worker_id = (int)$res1["worker_id"];
	$remarks = $res1["remarks"];
	$sched = $res1["sched"];
	$startt = $res1["startt"];
	$room_owner_id = (int)$res1["room_owner_id"];
	// This is for getting the rate
	$refbldg = mysql_query("select ".$getrate.", ".$cut.", ".$due." from pmls_bldg where bldgnumber like '".$res1["building_id"]."'");
	$res3 = mysql_fetch_array($refbldg);
	$rate = $res3[$getrate];
	// This is for getting the last reading and exact amount for the reading
	$history = mysql_query("select ".$saveTo." from pmls_android_worker_task_history where location_id like '".$location_id."' order by endt desc");
	$hist = mysql_fetch_array($history);
	if($hist[$saveTo] == null or $hist[$saveTo] == "") $phpval = $rate * $readVal; else $phpval = $rate * ($readVal - $hist[$saveTo]);
	$saveVal = (int)$readVal;
	
	//echo $task_id." - ".$location_id." - ".$worker_id." - ".$remarks." - ".$sched." - ".$starttt." - ".$room_owner_id." - ".$saveVal;
	$saveToHistory = mysql_query("insert into pmls_android_worker_task_history set task_id = '".$task_id."' , location_id = '".$location_id."', worker_id = '".$worker_id."', remarks = '".$remarks."', sched = '".$sched."', startt = '".$startt."', endt = NOW(), duration = '".$duration."', room_owner_id = '".$room_owner_id."', ".$saveTo." = '".$saveVal."', ".$phpTo." = '".$phpval."', total_amount = '".$phpval."', tagstat = '".$tag."', cutoff = '".$res3[$cut]."', duedate = '".$res3[$due]."', payment_stat = '0'");
	//$delete = mysql_query("delete from pmls_android_worker_task where id like '".$taskid."'");
	
}elseif($func == "end_save_repair"){
	
	$getTask = mysql_query("select * from pmls_android_worker_task where id like '".$taskid."'");
	$res1 = mysql_fetch_array($getTask);
	
	$task_id = (int)$res1["task_id"];
	$location_id = $res1["location_id"];
	$worker_id = (int)$res1["worker_id"];
	$sched = $res1["sched"];
	$startt = $res1["startt"];
	$room_owner_id = (int)$res1["room_owner_id"];
	
	$tot = $labor + $material;
	
	$saveToHistory = mysql_query("insert into pmls_android_worker_task_history set task_id = '".$task_id."' , location_id = '".$location_id."', worker_id = '".$worker_id."', remarks = '".$remarks2."', sched = '".$sched."', startt = '".$startt."', endt = NOW(), duration = '".$duration."', room_owner_id = '".$room_owner_id."', labor_exp = '".$labor."', material_exp = '".$material."', total_amount = '".$tot."', tagstat = 'maintenance', payment_stat = '0'");
	//$delete = mysql_query("delete from pmls_android_worker_task where id like '".$taskid."'");
}



?>