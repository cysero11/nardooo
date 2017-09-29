<?php
include('../connect.php');

if (!file_exists("leads/Requirements/" . $_REQUEST["txtaapid"])) {
		mkdir("leads/Requirements/" . $_REQUEST["txtaapid"], 0777, true);
	}


	// $sql2 = "DELETE FROM tbltrans_leasingapplicationreq WHERE appID = '".$_REQUEST["txtaapid"]."' AND reqID = '".$_REQUEST["txtinqqid"]."'";
	// $result2 = mysql_query($sql2, $connection);	
	
			$file = $_FILES['attachment_filess']['name'];
			$filetype = $_FILES["attachment_filess"]["type"];
			$filesize = $_FILES["attachment_filess"]["size"];
			$tmp_name = $_FILES["attachment_filess"]["tmp_name"];

			if($file != "")
					{
						$delete = "DELETE * FROM tbltrans_leasingapplicationreq WHERE reqID = '".$_REQUEST["txtinqqid"]."'";
						$resDelete = mysql_query($delete, $connection);
						$deleteRow = mysql_fetch_array($resDelete);

						$sel_req = "SELECT requirements FROM tblref_applicationrequirements WHERE id = '".$_REQUEST["hiddenidss"]."'";
						$res_req = mysql_query($sel_req, $connection);
						$req = mysql_fetch_array($res_req);

						if (!file_exists("leads/Requirements/" . $_REQUEST["txtaapid"]  . "/" . $req["requirements"])) {
							mkdir("leads/Requirements/" . $_REQUEST["txtaapid"]  . "/" . $req["requirements"], 0777, true);
						}

						move_uploaded_file($tmp_name, "leads/requirements/" . $_REQUEST["txtaapid"] . "/" . $req["requirements"] . "/" . $file);
						
						$sql = "INSERT INTO tbltrans_leasingapplicationreq (reqID, filename, filetype, filesize,  type_req_ID)VALUES('".$_REQUEST["txtinqqid"]."', '". $file ."', '". $filetype ."', '". $filesize ."','".$_REQUEST["hiddenidss"]."' )";
						$result = mysql_query($sql, $connection);		

						// $logs = create_logs("uploaded a new leasing application requirement from a store with ".$_REQUEST["txtaapid"]." application ID.", "Leasing Application Module", $req["requirements"]."|".$file, "UPDATE");	
					}

					


					$i = 0;
					$selectall = "SELECT id FROM tblref_applicationrequirements";
					$resultall = mysql_query($selectall, $connection);
					while($sel = mysql_fetch_array($resultall))
					{
						$chk = "SELECT filename FROM tbltrans_leasingapplicationreq WHERE appID = '".$_REQUEST["txtaapid"]."' AND reqID = '".$_REQUEST["txtinqqid"]."' AND type_req_ID = '".$sel["id"]."'";
						$rschk = mysql_query($chk, $connection);
						$cntchk = mysql_num_rows($rschk);
						if($cntchk == 0)
						{
							$i++;
						}
				}

					

			
			


					
					
		
		mysql_close($connection);
		echo $_FILES["attachment_filess"]["name"];

?>