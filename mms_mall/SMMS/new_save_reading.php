<?php

error_reporting(E_ALL ^ E_DEPRECATED);
require_once __DIR__ . '/db_connect.php';
$db = new DB_CONNECT();

$target_path = "uploads/";
$response = array();
if(isset($_POST["id"]) and isset($_POST["date1"]) and isset($_POST["date2"]) and isset($_POST["time1"]) and isset($_POST["time2"]) and isset($_POST["duration"]) 
	and isset($_POST["reading"]) and isset($_POST["amount"]) and isset($_FILES['image1']['name'])){
	$id = $_POST["id"];
	$date1 = $_POST["date1"];
	$date2 = $_POST["date2"];
	$time1 = $_POST["time1"];
	$time2 = $_POST["time2"];
	$duration = $_POST["duration"];
	$reading = $_POST["reading"];
	$amount = $_POST["amount"];
	$save = $date1."|".$date2."|".$time1."|".$time2."|".$duration."#";
	
	$target_path = $target_path . basename($_FILES['image1']['name']); 
	$ext = explode(".", basename($_FILES['image1']['name']));
	$filename = "uploads/".$id.".".$ext[1];
	try {
        // Throws exception incase file is not being moved
        if (move_uploaded_file($_FILES['image1']['tmp_name'], $filename)) {
			$img1 = basename($_FILES['image1']['name']);
			$var = mysql_query("select schedline from tblmaintenance_workorderlist where id like '$id'");
			if(mysql_num_rows($var) <> 0){
				$row = mysql_fetch_array($var);
				$ss = "undefined|undefined|undefined|undefined|undefined#".$save;
				$xx = mysql_query("update tblmaintenance_workorderlist set schedline = '$ss', meter_img = '$img1', taskstatus = 'Resolved', meter_reading = '$reading', sub_total = '$amount', meter_img = 'SMMS/uploads/$id.jpg', reading_date = now() where id like '$id'");
				
			}
			$response["success"] = 1;
        }else{
			$response["success"] = 0;
		}
    } catch (Exception $e) {
		$response["success"] = 0;
    }
	
}else{
	$response["success"] = 0;
}
echo json_encode($response);
?>