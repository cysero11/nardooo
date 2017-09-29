<?php
	include('../connect.php');
	include("../imagescale.php");

	// $sql2 = "DELETE FROM tbltrans_leasingapplicationreq WHERE appID = '".$_REQUEST["txtaapid"]."' AND reqID = '".$_REQUEST["txtinqqid"]."'";
	// $result2 = mysql_query($sql2, $connection);	

			$file = $_FILES['attachment_profilepic']['name'];
			$filetype = $_FILES["attachment_profilepic"]["type"];
			$filesize = $_FILES["attachment_profilepic"]["size"];
			$tmp_name = $_FILES["attachment_profilepic"]["tmp_name"];

			
		
					if($file != "")
					{
						if (!file_exists("../server/company/" . $_REQUEST["companyID"]  . "/trades/".$_REQUEST["tradeID"])) {
							mkdir("../server/company/" . $_REQUEST["companyID"]  . "/trades/".$_REQUEST["tradeID"], 0777, true);
							$content = scaleImageFileToBlob($tmp_name);
							file_put_contents("../server/company/" . $_REQUEST["companyID"]  . "/trades/" . $_REQUEST["tradeID"] . "/thumb.png",  $content);
						}
						else
						{
							$content = scaleImageFileToBlob($tmp_name);
							file_put_contents("../server/company/" . $_REQUEST["companyID"]  . "/trades/" . $_REQUEST["tradeID"] . "/thumb.png",  $content);
						}

							move_uploaded_file($tmp_name, "../server/company/" . $_REQUEST["companyID"]  . "/trades/".$_REQUEST["tradeID"] . "/" . $file);
							
							$sql = "UPDATE tbltrans_tradename SET filename = '". $file ."' WHERE companyID = '".$_REQUEST["companyID"]."' AND tradeID = '".$_REQUEST["tradeID"]."'";
							$result = mysql_query($sql, $connection);
					}
				
						
		
		mysql_close($connection);
?>