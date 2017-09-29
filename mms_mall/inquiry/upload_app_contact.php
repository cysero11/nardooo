<?php
	include('../connect.php');

	// $sql2 = "DELETE FROM tbltrans_leasingapplicationreq WHERE appID = '".$_REQUEST["txtaapid"]."' AND reqID = '".$_REQUEST["txtinqqid"]."'";
	// $result2 = mysql_query($sql2, $connection);	

			$file = $_FILES['attachment_profilepic']['name'];
			$filetype = $_FILES["attachment_profilepic"]["type"];
			$filesize = $_FILES["attachment_profilepic"]["size"];
			$tmp_name = $_FILES["attachment_profilepic"]["tmp_name"];
		
					if($file != "")
					{

						if (!file_exists("../server/company/" . $_REQUEST["txtcon_company"]  . "/contact_person/".$_REQUEST["txtcon_person"])) {
							mkdir("../server/company/" . $_REQUEST["txtcon_company"]  . "/contact_person/".$_REQUEST["txtcon_person"], 0777, true);
						}

							move_uploaded_file($tmp_name, "../server/company/" . $_REQUEST["txtcon_company"]  . "/contact_person/".$_REQUEST["txtcon_person"] . "/" . $file);
						
							$sql = "UPDATE tbltrans_company_contact_person SET filename = '". $file ."' WHERE ConID = '".$_REQUEST["txtcon_company"]."' AND custID = '".$_REQUEST["txtcon_person"]."'";
							$result = mysql_query($sql, $connection);
					}
				
						
		
		mysql_close($connection);
?>