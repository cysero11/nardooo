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

$tagstat = "";
$task_id = "";
$location_id = "";
$worker_id = "";
$remarks = "";
$sched = "";
$startt = "";
$endt = "";
$duration = "";
$room_owner_id = "";
$customername = "";
$labor_exp = "";
$material_exp = "";
$kilowatt = "";
$kilowatt_php = "";
$cubic_meter = "";
$cubic_php = "";
$total_amount = "";
$payment_stat = "";
$cutoff = "";
$duedate = "";
$building_id = "";

$tagstat = isset($_POST['tagstat']) ? $_POST['tagstat'] : '';
$task_id = isset($_POST['task_id']) ? $_POST['task_id'] : '';
$location_id = isset($_POST['location_id']) ? $_POST['location_id'] : '';
$worker_id = isset($_POST['worker_id']) ? $_POST['worker_id'] : '';
$remarks = isset($_POST['remarks']) ? $_POST['remarks'] : '';
$sched = isset($_POST['sched']) ? $_POST['sched'] : '';
$startt = isset($_POST['startt']) ? $_POST['startt'] : '';
$endt = isset($_POST['endt']) ? $_POST['endt'] : '';
$duration = isset($_POST['duration']) ? $_POST['duration'] : '';
$room_owner_id = isset($_POST['room_owner_id']) ? $_POST['room_owner_id'] : '';
$customername = isset($_POST['customername']) ? $_POST['customername'] : '';
$labor_exp = isset($_POST['labor_exp']) ? $_POST['labor_exp'] : '';
$material_exp = isset($_POST['material_exp']) ? $_POST['material_exp'] : '';
$kilowatt = isset($_POST['kilowatt']) ? $_POST['kilowatt'] : '';
$kilowatt_php = isset($_POST['kilowatt_php']) ? $_POST['kilowatt_php'] : '';
$cubic_meter = isset($_POST['cubic_meter']) ? $_POST['cubic_meter'] : '';
$cubic_php = isset($_POST['cubic_php']) ? $_POST['cubic_php'] : '';
$total_amount = isset($_POST['total_amount']) ? $_POST['total_amount'] : '';
$payment_stat = isset($_POST['payment_stat']) ? $_POST['payment_stat'] : '';
$cutoff = isset($_POST['cutoff']) ? $_POST['cutoff'] : '';
$duedate = isset($_POST['duedate']) ? $_POST['duedate'] : '';
$building_id = isset($_POST['building_id']) ? $_POST['building_id'] : '';

$saveToHistory = mysql_query("insert into pmls_android_worker_task_history set tagstat = '".$tagstat."', task_id = '".$task_id."' , location_id = '".$location_id.
							"', worker_id = '".$worker_id."', remarks = '".$remarks."\n"."Amount reading: ".str_pad($saveVal, 4, "0", STR_PAD_LEFT)."\n"."Amount value: ".$phpval."', sched = '".$sched."', startt = '".$startt."', endt = '".$endt."', duration = '".$duration.
							"', room_owner_id = '".$room_owner_id."', labor_exp = '".$labor_exp."', material_exp = '".$material_exp."', kilowatt = '".$kilowatt.
							"', kilowatt_php = '".$kilowatt_php."', cubic_meter = '".$cubic_meter."', cubic_php = '".$cubic_php."', total_amount = '".$total_amount.
							"', payment_stat = '0', cutoff = '".$cutoff."', duedate = '".$duedate."', building_id = '".$building_id."', img_bef_1 = '".$img1."', img_bef_2 = '".$img2.
							"', img_bef_3 = '".$img3."', img_aft_1 = '".$img4."', img_aft_2 = '".$img5."', img_aft_3 = '".$img6."'");

//echo json_encode($response);

?>





















