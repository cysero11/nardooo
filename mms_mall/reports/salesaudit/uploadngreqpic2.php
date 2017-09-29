<?php
	include('../../connect.php');

			$file = $_FILES['bruno2']['name'];
			$filetype = $_FILES["bruno2"]["type"];
			$filesize = $_FILES["bruno2"]["size"];
			$tmp_name = $_FILES["bruno2"]["tmp_name"];
					if($file != "")
					{

						if (!file_exists("../../server/accreditation/".$_REQUEST['clint']." ")) {
							mkdir("../../server/accreditation/".$_REQUEST['clint']."", 0777, true);
						}
						
						
							$sql = "UPDATE tblaccreditation SET Network_Result = '". $file ."' WHERE TenantID = '".$_REQUEST["clint"]."'";
							$result = mysql_query($sql, $connection);
							if($result == true)
							{
								move_uploaded_file($tmp_name, "../../server/accreditation/".$_REQUEST['clint']."/". $file);
							}
					}
		
		mysql_close($connection);
?>