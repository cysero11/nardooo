<?php
	include('../connect.php');
	if (!file_exists("../server/Requirements/" . $_REQUEST["txtaapid"])) {
		mkdir("../server/Requirements/" . $_REQUEST["txtaapid"], 0777, true);
	}

	// $sql2 = "DELETE FROM tbltrans_leasingapplicationreq WHERE appID = '".$_REQUEST["txtaapid"]."' AND reqID = '".$_REQUEST["txtinqqid"]."'";
	// $result2 = mysql_query($sql2, $connection);	
	
			$file = $_FILES['attachment_filess']['name'];
			$filetype = $_FILES["attachment_filess"]["type"];
			$filesize = $_FILES["attachment_filess"]["size"];
			$tmp_name = $_FILES["attachment_filess"]["tmp_name"];

			

					if($file != "")
					{
						$sel_req = "SELECT requirements FROM tblref_applicationrequirements WHERE id = '".$_REQUEST["hiddenidss"]."'";
						$res_req = mysql_query($sel_req, $connection);
						$req = mysql_fetch_array($res_req);

						if (!file_exists("../server/Requirements/" . $_REQUEST["txtaapid"]  . "/" . $req["requirements"])) {
							mkdir("../server/Requirements/" . $_REQUEST["txtaapid"]  . "/" . $req["requirements"], 0777, true);
						}

						move_uploaded_file($tmp_name, "../server/Requirements/" . $_REQUEST["txtaapid"] . "/" . $req["requirements"] . "/" . $file);
						$sql = "INSERT INTO tbltrans_leasingapplicationreq (appID ,reqID, filename, filetype, filesize, type_req_ID)VALUES('".$_REQUEST["txtaapid"]."', '".$_REQUEST["txtinqqid"]."', '". $file ."', '". $filetype ."', '". $filesize ."', '".$_REQUEST["hiddenidss"]."')";
						$result = mysql_query($sql, $connection);		

						$logs = create_logs("uploaded a new leasing application requirement from a store with ".$_REQUEST["txtaapid"]." application ID.", "Leasing Application Module", $req["requirements"]."|".$file, "UPDATE");	
					}
		mysql_close($connection);
?>