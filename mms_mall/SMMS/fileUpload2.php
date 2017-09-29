<?php

error_reporting(E_ALL ^ E_DEPRECATED);
require_once __DIR__ . '/db_connect.php';
$db = new DB_CONNECT();

// Path to move uploaded files
$target_path = "uploads/";
 
// getting server ip address
$server_ip = gethostbyname(gethostname());

$img1 = "";
$img2 = "";
$img3 = "";
$img4 = "";
$img5 = "";
$img6 = "";

$strr = "";

if (isset($_FILES['image1']['name'])) {
    $target_path = $target_path . basename($_FILES['image1']['name']);
	try {
        // Throws exception incase file is not being moved
        if (move_uploaded_file($_FILES['image1']['tmp_name'], $target_path)) {
			$img1 = basename($_FILES['image1']['name']);
        }
    } catch (Exception $e) {
    }
}

if (isset($_FILES['image2']['name'])) {
    $target_path = $target_path . basename($_FILES['image2']['name']);
	try {
        // Throws exception incase file is not being moved
        if (move_uploaded_file($_FILES['image2']['tmp_name'], $target_path)) {
			$img2 = basename($_FILES['image2']['name']);
        }
    } catch (Exception $e){
    }
}

if (isset($_FILES['image3']['name'])) {
    $target_path = $target_path . basename($_FILES['image3']['name']);
	try {
        // Throws exception incase file is not being moved
        if (move_uploaded_file($_FILES['image3']['tmp_name'], $target_path)) {
			$img3 = basename($_FILES['image3']['name']);
        }
    } catch (Exception $e){
    }
}

if (isset($_FILES['image4']['name'])) {
    $target_path = $target_path . basename($_FILES['image4']['name']);
	try {
        // Throws exception incase file is not being moved
        if (move_uploaded_file($_FILES['image4']['tmp_name'], $target_path)) {
			$img4 = basename($_FILES['image4']['name']);
        }
    } catch (Exception $e){
    }
}

if (isset($_FILES['image5']['name'])) {
    $target_path = $target_path . basename($_FILES['image5']['name']);
	try {
        // Throws exception incase file is not being moved
        if (move_uploaded_file($_FILES['image5']['tmp_name'], $target_path)) {
			$img5 = basename($_FILES['image5']['name']);
        }
    } catch (Exception $e){
    }
}

if (isset($_FILES['image6']['name'])) {
    $target_path = $target_path . basename($_FILES['image6']['name']);
	try {	
        // Throws exception incase file is not being moved
        if (move_uploaded_file($_FILES['image6']['tmp_name'], $target_path)) {
			$img6 = basename($_FILES['image6']['name']);
        }
    } catch (Exception $e){
    }
}

//$saveas = isset($_POST['saveas']) ? $_POST['saveas'] : '';
$saveas = "meter";

if($saveas == "room"){
	
	$taskid = isset($_POST['taskid']) ? $_POST['taskid'] : '';
	$duration = isset($_POST['duration']) ? $_POST['duration'] : '';

	$getTask = mysql_query("select * from pmls_android_worker_task where id like '".$taskid."'");

	$res1 = mysql_fetch_array($getTask);
	
	$task_id = (int)$res1["task_id"];
	$location_id = (int)$res1["location_id"];
	$worker_id = (int)$res1["worker_id"];
	$remarks = $res1["remarks"];
	$sched = $res1["sched"];
	$startt = $res1["startt"];
	$room_owner_id = (int)$res1["room_owner_id"];
	//$saveVal = (int)$readVal;
	//echo $task_id." - ".$location_id." - ".$worker_id." - ".$remarks." - ".$sched." - ".$starttt." - ".$room_owner_id." - ".$saveVal;
	$saveToHistory = mysql_query("insert into pmls_android_worker_task_history set task_id = '".$task_id."' , location_id = '".$location_id."', worker_id = '".$worker_id."', remarks = '".$remarks."', sched = '".$sched."', startt = '".$startt."', endt = NOW(), duration = '".$duration."', room_owner_id = '".$room_owner_id."', tagstat = 'housekeeping', payment_stat = '0', img_bef_1 = '".$img1."', img_bef_2 = '".$img2."', img_bef_3 = '".$img3."', img_aft_1 = '".$img4."', img_aft_2 = '".$img5."', img_aft_3 = '".$img6."'");
	
}else if($saveas == "meter"){
	
	$taskid = isset($_POST['taskid']) ? $_POST['taskid'] : '';
	$saveWat = isset($_POST['saveWat']) ? $_POST['saveWat'] : '';
	$readVal = isset($_POST['val']) ? $_POST['val'] : '';
	$duration = isset($_POST['duration']) ? $_POST['duration'] : '';
	
	/*
	$taskid = "ST-0000012";
	$saveWat = "kilowatt";
	$readVal = "12";
	$duration = "00:0013";
	*/
	$tag = "";
	$unitCols = "";
	if($saveWat == "read_cubic"){
		$saveTo = "cubic_meter";
		$phpTo = "cubic_php";
		$charge = mysql_query("select chrgamount from tblref_charges where xcat like 'Water Reading'");
		$row = mysql_fetch_array($charge);
		$getrate = $row["chrgamount"];
		$tag = "waterbill";
		$unitCols = "waterstat";
	}else{
		$saveTo = "kilowatt";
		$phpTo = "kilowatt_php";
		$charge = mysql_query("select chrgamount from tblref_charges where xcat like 'Electric Reading'");
		$row = mysql_fetch_array($charge);
		$getrate = $row["chrgamount"];
		$tag = "electricbill";
		$unitCols = "electricstat";
	}
	$getTask = mysql_query("select * from pmls_android_worker_task where staff_task_id like '".$taskid."'");
	$res1 = mysql_fetch_array($getTask);
	
	// This is for getting the last reading and exact amount for the reading
	//$history = mysql_query("select ".$saveTo." from pmls_android_worker_task_history where location_id like '".$res1["location_id"]."' and ".$saveTo." IS NOT NULL order by endt desc");
	//$hist = mysql_fetch_array($history);
	//if($hist[$saveTo] == null or $hist[$saveTo] == "") $phpval = $getrate * (int)$readVal; else $phpval = $getrate * ((int)$readVal - $hist[$saveTo]);
	$phpval = $getrate * (int)$readVal;
	$saveVal = $readVal;
	
	//echo $task_id." - ".$location_id." - ".$worker_id." - ".$remarks." - ".$sched." - ".$starttt." - ".$room_owner_id." - ".$saveVal;
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
				"', remarks = '".$res1["remarks"]."\n"."Amount reading: ".str_pad($saveVal, 4, "0", STR_PAD_LEFT)."\n"."Amount value: ".$phpval.
				"', sched = '".$res1["sched"].
				"', startt = '".$res1["startt"].
				"', endt = NOW()"."".
				", duration = '".$duration.
				"', tagstat = '".$tag.
				"', ".$saveTo." = '".str_pad($saveVal, 4, "0", STR_PAD_LEFT).
				"', ".$phpTo." = '".$phpval.
				"', total_amount = '".$phpval.
				"', img_bef_1 = '".$img1."'");
				
				// This is for the logs Ericson needed for his maps.
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
	
}
$delete = mysql_query("delete from pmls_android_worker_task where staff_task_id like '".$taskid."'");

?>