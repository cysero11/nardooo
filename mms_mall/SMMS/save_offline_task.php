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
$error = "";

$response = array();

if (isset($_FILES['image1']['name'])) {
    $target_path = $target_path . basename($_FILES['image1']['name']);
	try {
        // Throws exception incase file is not being moved
        if (move_uploaded_file($_FILES['image1']['tmp_name'], $target_path)) {
			$img1 = basename($_FILES['image1']['name']);
        }else{
			$error = "true";
		}
    } catch (Exception $e) {
		$error = $e;
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
		$error = $e;
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
		$error = $e;
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
		$error = $e;
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
		$error = $e;
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
		$error = $e;
    }
}
/*
$staff_task_id = "ST-0000013";
$room_owner_id = "TENANT-0000001";
$ownername = "Jollibee";
$building_id = "MALL-0000010";
$floorid = "FLOOR-0000001";
$category_tenant = "CCTV";
$category_management = "";
$task_id = "TASK-0000004";
$task_id_management = "";
$lasttask_id = "LTASK-0000013";
$location_id = "U-0000001";
$management_location = "";
$worker_id = "USER-0000005";
$remarks = "Sample Remarkssss";
$sched = "03/11/2017";
$startt = "0000-00-00 00:00:00";
$endt = "2017-02-20 03:41:14";
$duration = "00:00:16";
$tagstat = "repairbill";
$labor_exp = "1200.00";
$material_exp = "0.00";
$kilowatt = "";
$kilowatt_php = "";
$cubic_meter = "";
$cubic_php = "";
$total_amount = "1200";
$payment_stat = "";
$cutoff = "";
$duedate = "";
$img_bef_1 = "";
$img_bef_2 = "";
$img_bef_3 = "";
$img_aft_1 = "";
$img_aft_2 = "";
$img_aft_3 = "";
*/

$staff_task_id = isset($_POST['staff_task_id']) ? $_POST['staff_task_id'] : '';
$room_owner_id = isset($_POST['room_owner_id']) ? $_POST['room_owner_id'] : '';
$ownername = isset($_POST['ownername']) ? $_POST['ownername'] : '';
$building_id = isset($_POST['building_id']) ? $_POST['building_id'] : '';
$floorid = isset($_POST['floorid']) ? $_POST['floorid'] : '';
$category_tenant = isset($_POST['category_tenant']) ? $_POST['category_tenant'] : '';
$category_management = isset($_POST['category_management']) ? $_POST['category_management'] : '';
$task_id = isset($_POST['task_id']) ? $_POST['task_id'] : '';
$task_id_management = isset($_POST['task_id_management']) ? $_POST['task_id_management'] : '';
$lasttask_id = isset($_POST['lasttask_id']) ? $_POST['lasttask_id'] : '';
$location_id = isset($_POST['location_id']) ? $_POST['location_id'] : '';
$management_location = isset($_POST['management_location']) ? $_POST['management_location'] : '';
$worker_id = isset($_POST['worker_id']) ? $_POST['worker_id'] : '';
$remarks = isset($_POST['remarks']) ? $_POST['remarks'] : '';
$sched = isset($_POST['sched']) ? $_POST['sched'] : '';
$startt = isset($_POST['startt']) ? $_POST['startt'] : '';
$endt = isset($_POST['endt']) ? $_POST['endt'] : '';
$duration = isset($_POST['duration']) ? $_POST['duration'] : '';
$tagstat = isset($_POST['tagstat']) ? $_POST['tagstat'] : '';
$labor_exp = isset($_POST['labor_exp']) ? $_POST['labor_exp'] : '0';
$material_exp = isset($_POST['material_exp']) ? $_POST['material_exp'] : '0';
$kilowatt = isset($_POST['kilowatt']) ? $_POST['kilowatt'] : '';
$kilowatt_php = isset($_POST['kilowatt_php']) ? $_POST['kilowatt_php'] : '0';
$cubic_meter = isset($_POST['cubic_meter']) ? $_POST['cubic_meter'] : '';
$cubic_php = isset($_POST['cubic_php']) ? $_POST['cubic_php'] : '0';
$total_amount = isset($_POST['total_amount']) ? $_POST['total_amount'] : '';
$payment_stat = isset($_POST['payment_stat']) ? $_POST['payment_stat'] : '';
$cutoff = isset($_POST['cutoff']) ? $_POST['cutoff'] : '';
$duedate = isset($_POST['duedate']) ? $_POST['duedate'] : '';
$img_bef_1 = $img1;
$img_bef_2 = isset($_POST['img_bef_2']) ? $_POST['img_bef_2'] : '';
$img_bef_3 = isset($_POST['img_bef_3']) ? $_POST['img_bef_3'] : '';
$img_aft_1 = isset($_POST['img_aft_1']) ? $_POST['img_aft_1'] : '';
$img_aft_2 = isset($_POST['img_aft_2']) ? $_POST['img_aft_2'] : '';
$img_aft_3 = isset($_POST['img_aft_3']) ? $_POST['img_aft_3'] : '';
$img_bef_3 = isset($_POST['img_bef_3']) ? $_POST['img_bef_3'] : '';
$xstat = "Resolved";

if($tagstat == "waterbill"){
	$charge = mysql_query("select chrgamount from tblref_charges where xcat like 'Water Reading'");
	$row = mysql_fetch_array($charge);
	$getrate = $row["chrgamount"];
	$remarks = $remarks."\n Metre Reading: ".$cubic_meter."\n Cubic Amount: ".($cubic_meter * $getrate); 
	$kilowatt_php = $kilowatt * $getrate;
}elseif($tagstat == "electricbill"){
	$charge = mysql_query("select chrgamount from tblref_charges where xcat like 'Electric Reading'");
	$row = mysql_fetch_array($charge);
	$getrate = $row["chrgamount"];
	$remarks = $remarks."\n Kilowatt Reading: ".$kilowatt."\n Kilowatt Amount: ".($kilowatt * $getrate); 
	$kilowatt_php = $kilowatt * $getrate;
}


$total_amount = $kilowatt_php + $cubic_php + $material_exp + $labor_exp;

$saveToHistory = mysql_query("insert into pmls_android_worker_task_history set staff_task_id = '".$staff_task_id."', ".
                "room_owner_id = '".$room_owner_id."', ".
                "ownername = '".$ownername."', ".
                "building_id = '".$building_id."', ".
                "floorid = '".$floorid."', ".
                "category_tenant = '".$category_tenant."', ".
                "category_management = '".$category_management."', ".
                "task_id = '".$task_id."', ".
                "task_id_management = '".$task_id_management."', ".
                "lasttask_id = '".$lasttask_id."', ".
                "location_id = '".$location_id."', ".
                "management_location = '".$management_location."', ".
                "worker_id = '".$worker_id."', ".
                "remarks = '".$remarks."', ".
                "sched = '".$sched."', ".
                "startt = '".$startt."', ".
                "endt = '".$endt."', ".
                "duration = '".$duration."', ".
                "tagstat = '".$tagstat."', ".
                "labor_exp = '".$labor_exp."', ".
                "material_exp = '".$material_exp."', ".
                "kilowatt = '".$kilowatt."', ".
                "kilowatt_php = '".$kilowatt_php."', ".
                "cubic_meter = '".$cubic_meter."', ".
                "cubic_php = '".$cubic_php."', ".
                "total_amount = '".$total_amount."', ".
                "payment_stat = '".$payment_stat."', ".
                "cutoff = '".$cutoff."', ".
                "duedate = '".$duedate."', ".
                "paymentstat = '0', ".
                "img_bef_1 = '".$img_bef_1."', ".
                "img_bef_2 = '".$img_bef_2."', ".
                "img_bef_3 = '".$img_bef_3."', ".
                "img_aft_1 = '".$img_aft_1."', ".
                "img_aft_2 = '".$img_aft_2."', ".
                "img_aft_3 = '".$img_aft_3."'");
				
$complaints = mysql_query("select complaint_seriesno from pmls_android_worker_task where staff_task_id like '".$staff_task_id."'");
if(mysql_num_rows($complaints) <> 0){
	$roww = mysql_fetch_array($complaints);
	if($roww == null || $roww == "NULL" || $roww == "(NULL)" || $roww == ""){
	}else{
		$updateComplaints = mysql_query("update tblcomplaints set Complaint_Status = 'Resolved' where Complaint_Series_No like '".$roww["complaint_seriesno"]."'");
	}
}
				
$delete = mysql_query("delete from pmls_android_worker_task where staff_task_id like '".$staff_task_id."'");
							
$response["pic1"] = $img1;
$response["pic2"] = $img2;
$response["pic3"] = $img3;
$response["pic4"] = $img4;
$response["pic5"] = $img5;
$response["pic6"] = $img6;
$response["error"] = $error;

echo json_encode($response);

?>





















