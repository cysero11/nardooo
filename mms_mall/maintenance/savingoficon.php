<?php
	include "../connect.php";
	if(isset($_POST["frmIconID"]))
	{
			$file = $_FILES['fileIcon']['name'];
			$filetype = $_FILES["fileIcon"]["type"];
			$filesize = $_FILES["fileIcon"]["size"];
			$tmp_name = $_FILES["fileIcon"]["tmp_name"];

			if (!file_exists("../assets/images/maintenance")) {
				mkdir("../assets/images/maintenance", 0777, true);
			}
				$ext = explode(".", $_FILES["fileIcon"]["name"]);	
				
				$filename = $_POST['frmIconID'] . "." . end($ext);

				$updateext = "UPDATE tblmaintenance_category SET icon = '" . $filename . "' WHERE id = '" . $_POST['frmIconID'] . "'";
				$updateresult = mysql_query($updateext, $connection);

				unlink("../server/userpics/" . $_POST['frmIconID'] . ".png");
				unlink("../server/userpics/" . $_POST['frmIconID'] . ".jpeg");
				unlink("../server/userpics/" . $_POST['frmIconID'] . ".jpg");
				unlink("../server/userpics/" . $_POST['frmIconID'] . ".bmp");
				move_uploaded_file($_FILES["fileIcon"]["tmp_name"], "../assets/images/maintenance/".$filename);
				if($updateresult == true){
				}
	}
?>