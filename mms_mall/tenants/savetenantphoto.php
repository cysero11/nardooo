<?php 
	include('../connect.php');

	$file = $_FILES['tenantupload']['name'];
	$filetype = $_FILES["tenantupload"]["type"];
	$filesize = $_FILES["tenantupload"]["size"];
	$tmp_name = $_FILES["tenantupload"]["tmp_name"];
	$tenantid = $_REQUEST['hiddentenantidsapicture'];
			if($file != "")
			{

				if (!file_exists("../tenants/tenantsimages")) {
					mkdir("../tenants/tenantsimages", 0777, true);
				}
				
					$ext = explode(".", $_FILES['tenantupload']['name']);
					$_FILES['tenantupload']['name'] = $tenantid.".".end($ext);
					$sql = " UPDATE tbltrans_tenants SET tenantphoto = '". $_FILES['tenantupload']['name'] ."' WHERE TenantID = '". $_REQUEST['hiddentenantidsapicture'] ."' ";
					$result = mysql_query($sql, $connection);
					$_FILES["tenantupload"]["name"] = $tenantid . "." . end($ext);
					unlink("../tenants/tenantsimages/" . $tenantid . ".png");
					unlink("../tenants/tenantsimages/" . $tenantid . ".jpeg");
					unlink("../tenants/tenantsimages/" . $tenantid . ".jpg");
					unlink("../tenants/tenantsimages/" . $tenantid . ".bmp");
					echo $_FILES['tenantupload']['name'];
					move_uploaded_file($_FILES["tenantupload"]["tmp_name"], "../tenants/tenantsimages/". $_FILES['tenantupload']['name']);
					echo $ext[0];
			}
		
	mysql_close($connection);
 ?>