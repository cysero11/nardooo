<?php
	include('../connect.php');

	// if (!file_exists("../server/Requirements/" . $_REQUEST["appidreq"])) {
		mkdir("../server/Requirements/" . $_REQUEST["appidreq"] . "/". $_REQUEST["docname"], 0777, true);
	// }

			$file = $_FILES['file_uploads']['name'];
			$filetype = $_FILES["file_uploads"]["type"];
			$filesize = $_FILES["file_uploads"]["size"];
			$tmp_name = $_FILES["file_uploads"]["tmp_name"];

			$sqlexist = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM tbltrans_leasingapplicationreq WHERE filename = '".$file."' "));

			if($sqlexist[0] == 0){
				move_uploaded_file($tmp_name, "../server/Requirements/" . $_REQUEST["appidreq"] . "/" .$_REQUEST["docname"] . "/" . $file);
				$sql = "INSERT INTO tbltrans_leasingapplicationreq SET appID = '".$_REQUEST["appidreq"]."', reqID = '".$_REQUEST["inqidreq"]."', docname = '".$_REQUEST["docname"]."', docdesc = '".$_REQUEST["description"]."', filename = '".$file."', filetype = '".$filetype."', filesize = '".$filesize."' ";
				$result = mysql_query($sql, $connection);

				mysql_close($connection);
				echo "Requirement successfully added.";
			}else{
				echo "Filename already exists.";
			}
?>
