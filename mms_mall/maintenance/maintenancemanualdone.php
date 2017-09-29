<?php
	include('../connect.php');

	if(isset($_POST["txtchargestype"])){
		if($_POST["txtchargestype"] == "Electric Bill"){

			$sqlkilowatt = " SELECT kilowatt FROM pmls_android_worker_task_history WHERE kilowatt <> NULL OR kilowatt <> '0' AND room_owner_id = '". $_POST['tenantidsabush'] ."' ORDER BY id DESC LIMIT 1 ";
			$reskilowatt = mysql_query($sqlkilowatt, $connection);
			$kilowatt = mysql_fetch_array($reskilowatt);

			$sqlchrg = " SELECT chrgamount from tblref_charges WHERE chrgname = 'Electric Bill' ";
			$reschrg = mysql_query($sqlchrg, $connection);
			$chrgamount = mysql_fetch_array($reschrg);
			$manualreading = $_POST['manualmeter'];
			$currentreading = $kilowatt-$manualreading;

			$totalamount = $currentreading*$chrgamount;


			$manualjoreport = "INSERT INTO pmls_android_worker_task_history SET staff_task_id = '" . $_POST['joseries'] . "', room_owner_id = '" . $_POST['tenantidsabush'] . "', ownername = '" . $_POST['ownernamesabush'] . "', building_id = '" . $_POST['building_idsabush'] . "', floorid = '" . $_POST['flooridsabush'] . "', catagory_tenant ='" . $_POST['categoryTenantsabush'] . "', catagory_management = '" . $_POST['categoryManagementsabush'] . "', task_id = '" . $_POST['taskidsabush'] . "', location_id = '". $_POST['location_idsabush'] ."', worker_id = '" . $_POST['workeridsabush'] . "',, remarks = '" . $_POST['remarkssabush'] . "', sched = '" . $_POST['schedsabush'] . "', startt = '".date("Y-m-d H:i:s", strtotime($_POST['manualdateFrom']))."', endt = '".date("Y-m-d H:i:s", strtotime($_POST['manualdateTo']))."', duration =  '" . $_POST['manualduration'] . "', tagstatt = '" . $_POST['txtchargestype'] . "', kilowatt = '" . $_POST['manualmeter'] . "', kilowatt_php = '" . $totalamount . "', total_amount = '" . $totalamount . "', img_bef1 = '" . $_POST['img_bef1'] . " ";
			$resmanualjoreport = mysql_query($manualjoreport, $connection) or die(mysql_error());
			if ( $resmanualjoreport == true ){
					echo 1;
				}
				else {
					echo mysql_error();
				}
		}
	}
?>