<?php
	include('../../connect.php');

			$file = $_FILES['bruno']['name'];
			$filetype = $_FILES["bruno"]["type"];
			$filesize = $_FILES["bruno"]["size"];
			$tmp_name = $_FILES["bruno"]["tmp_name"];

			$file2 = $_FILES['bruno2']['name'];
			$filetype2 = $_FILES["bruno2"]["type"];
			$filesize2 = $_FILES["bruno2"]["size"];
			$tmp_name2 = $_FILES["bruno2"]["tmp_name"];
					if($file != "" && $file2 != "")
					{

						if (!file_exists("../../server/accreditation/".$_REQUEST['clint']." ")) {
							mkdir("../../server/accreditation/".$_REQUEST['clint']."", 0777, true);
						}
						
						
							$sql = "UPDATE tblaccreditation SET Network_Result = '". $file ."', Accuracy_Result = '". $file2 ."' WHERE TenantID = '".$_REQUEST["clint"]."'";
							$result = mysql_query($sql, $connection);
							if($result == true)
							{
								move_uploaded_file($tmp_name, "../../server/accreditation/".$_REQUEST['clint']."/". $file);
								move_uploaded_file($tmp_name2, "../../server/accreditation/".$_REQUEST['clint']."/". $file2);
							}
					}
		
		mysql_close($connection);
?>