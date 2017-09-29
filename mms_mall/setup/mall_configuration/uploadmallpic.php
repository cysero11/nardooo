<?php
	include('connect.php');

	// $sql2 = "DELETE FROM tbltrans_leasingapplicationreq WHERE appID = '".$_REQUEST["txtaapid"]."' AND reqID = '".$_REQUEST["txtinqqid"]."'";
	// $result2 = mysql_query($sql2, $connection);	

			$file = $_FILES['attachment_profilepic']['name'];
			$filetype = $_FILES["attachment_profilepic"]["type"];
			$filesize = $_FILES["attachment_profilepic"]["size"];
			$tmp_name = $_FILES["attachment_profilepic"]["tmp_name"];
		
					if($file != "")
					{

						if (!file_exists("../../server/mall_image")) {
							mkdir("../../server/mall_image", 0777, true);
						}
						
						
							$sql = "UPDATE tblref_mall SET mall_image = '". $file ."' WHERE mallid = '".$_REQUEST["txtmallid_forms"]."'";
							$result = mysql_query($sql, $connection);
							if($result == true)
							{
								move_uploaded_file($tmp_name, "../../server/mall_image/" . $file);
							}
					}
		
		mysql_close($connection);
?>