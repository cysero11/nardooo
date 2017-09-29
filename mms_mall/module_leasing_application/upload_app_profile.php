<?php
	include('../connect.php');
	if (!file_exists("../server/company/" . $_REQUEST["hidden_company_id"])) {
		mkdir("../server/company/" . $_REQUEST["hidden_company_id"], 0777, true);
	}

// delete existing profile (pending...)

			$file = $_FILES['attachment_profilepic']['name'];
			$filetype = $_FILES["attachment_profilepic"]["type"];
			$filesize = $_FILES["attachment_profilepic"]["size"];
			$tmp_name = $_FILES["attachment_profilepic"]["tmp_name"];
			$image = getimagesize($tmp_name);
		
					if($file != "")
					{

						if (!file_exists("../server/company/" . $_REQUEST["hidden_company_id"]  . "/profile")) {
							mkdir("../server/company/" . $_REQUEST["hidden_company_id"]  . "/profile", 0777, true);
						}
							$ext = explode(".", $file);
							$_FILES['attachment_profilepic']['name'] = $_REQUEST["hidden_company_id"] . "." . end($ext);
							$file2 = $_FILES['attachment_profilepic']['name'];

							unlink("../server/company/" . $_REQUEST["hidden_company_id"]  . "/profile/" . $file2);
							move_uploaded_file($tmp_name, "../server/company/" . $_REQUEST["hidden_company_id"]  . "/profile/" . $file2);
							
							$sql = "UPDATE tbltrans_company SET filename = '". $file2 ."', ext = '" . end($ext) . "', width = '".$image[0]."', height = '".$image[1]."' WHERE CompanyID = '".$_REQUEST["hidden_company_id"]."'";
							$result = mysql_query($sql, $connection);
					}

		
		mysql_close($connection);
		// echo "File(s) has been uploaded.";
?>