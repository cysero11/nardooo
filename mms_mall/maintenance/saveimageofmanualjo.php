<?php
	include('../connect.php');

	// $sql2 = "DELETE FROM tbltrans_leasingapplicationreq WHERE appID = '".$_REQUEST["txtaapid"]."' AND reqID = '".$_REQUEST["txtinqqid"]."'";
	// $result2 = mysql_query($sql2, $connection);	
	$arr = explode("|", $_POST['hiddenpangupload']);


			$file = $_FILES['meter_image']['name'];
			$filetype = $_FILES["meter_image"]["type"];
			$filesize = $_FILES["meter_image"]["size"];
			$tmp_name = $_FILES["meter_image"]["tmp_name"];

						if (!file_exists("../SMMS/uploads")) {
							mkdir("../SMMS/uploads", 0777, true);
						}
						$catname = mysql_fetch_array(mysql_query("SELECT category FROM tblmaintenance_category WHERE category_id = '". $arr[1] ."' ", $connection));
						$date = mysql_fetch_array(mysql_query("SELECT xdate FROM tblmaintenance_workorder WHERE workorderid = '". $arr[0] ."' ", $connection));
						if($catname[0] == 'Electric Reading'){
							$ext = explode(".", $_FILES["meter_image"]["name"]);
							$_FILES["meter_image"]["name"] = $arr[2].".".end($ext);
							$mallid = mysql_fetch_array(mysql_query("SELECT mallid FROM tbltrans_tenants WHERE tenantid = '". $arr[3] ."' ", $connection));
							$elec_amnt = mysql_fetch_array(mysql_query("SELECT elec_amnt FROM mall_setup WHERE mall_id = '". $mallid[0] ."' ", $connection));
							$prevkwh = mysql_fetch_array(mysql_query("SELECT meter_reading FROM tblmaintenance_workorderlist WHERE meter_reading <> NULL OR meter_reading <> '0' AND xcategory = '". $arr[1] ."' AND tenantid = '". $arr[3] ."' AND reading_date = '". date('Y-m-d', strtotime($date[0].'-1 month')) ."' ", $connection));

							$currentreading = $_POST['metervalue'] - $prevkwh[0];

							$subtotal = $elec_amnt[0] * $currentreading;

							$sql = "UPDATE tblmaintenance_workorderlist SET meter_img = '". "SMMS/uploads/".$_FILES["meter_image"]["name"] ."', meter_reading = '". $_POST['metervalue'] ."', sub_total = '". $subtotal ."', taskstatus = 'Resolved' WHERE workorderid = '".$arr[0]."' AND xcategory = '". $arr[1] ."' AND id = '". $arr[2] ."' ";
							$res = mysql_query($sql, $connection);
							if($res == true){
								move_uploaded_file($tmp_name, "../SMMS/uploads/" . $_FILES["meter_image"]["name"]);
							}
						}else if($catname[0] == 'Water Reading'){
							$ext = explode(".", $_FILES["meter_image"]["name"]);
							$_FILES["meter_image"]["name"] = $arr[2].".".end($ext);
							$mallid = mysql_fetch_array(mysql_query("SELECT mallid FROM tbltrans_tenants WHERE tenantid = '". $arr[3] ."' ", $connection));
							$elec_amnt = mysql_fetch_array(mysql_query("SELECT watr_amnt FROM mall_setup WHERE mall_id = '". $mallid[0] ."' ", $connection));
							$prevkwh = mysql_fetch_array(mysql_query(" SELECT meter_reading FROM tblmaintenance_workorderlist WHERE meter_reading <> NULL OR meter_reading <> '0' AND xcategory = '". $arr[1] ."' AND tenantid = '". $arr[3] ."' AND reading_date = '". date('Y-m-d', strtotime($date[0].'-1 month')) ."' ", $connection));

							$currentreading = $_POST['metervalue'] - $prevkwh[0];
							$subtotal = $elec_amnt[0] * $currentreading;
							$sql = "UPDATE tblmaintenance_workorderlist SET meter_img = '". "SMMS/uploads/".$_FILES["meter_image"]["name"] ."', meter_reading = '". $_POST['metervalue'] ."', sub_total = '". $subtotal ."', taskstatus = 'Resolved' WHERE workorderid = '".$arr[0]."' AND xcategory = '". $arr[1] ."' AND id = '". $arr[2] ."' ";
							$res = mysql_query($sql, $connection);
							if($res == true){
								move_uploaded_file($tmp_name, "../SMMS/uploads/" . $_FILES["meter_image"]["name"]);
							}
						}
		
		mysql_close($connection);
?>