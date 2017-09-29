<?php
	include "../../../reports/tenantsalesreport/connect.php";
	
	if(isset($_POST["pinaghuhugutan"]))
	{
			$file = $_FILES['androidicon']['name'];
			$filetype = $_FILES["androidicon"]["type"];
			$filesize = $_FILES["androidicon"]["size"];
			$tmp_name = $_FILES["androidicon"]["tmp_name"];
			if (!file_exists("../../../assets/images/maintenance")) {
				mkdir("../../../assets/images/maintenance", 0777, true);
			}
		if($file != ""){
			$ext = explode(".", $_FILES["androidicon"]["name"]);
			
			$filename = $_POST['pinaghuhugutan'] . "." . end($ext);

			$updateext = "UPDATE tblmaintenance_category SET icon = '" . $filename . "' WHERE id = '" . $_POST['pinaghuhugutan'] . "'";
			$updateresult = mysqli_query($connection, $updateext);

			unlink("../../../assets/images/maintenance/" . $_POST['pinaghuhugutan'] . ".png");
			unlink("../../../assets/images/maintenance/" . $_POST['pinaghuhugutan'] . ".jpeg");
			unlink("../../../assets/images/maintenance/" . $_POST['pinaghuhugutan'] . ".jpg");
			unlink("../../../assets/images/maintenance/" . $_POST['pinaghuhugutan'] . ".bmp");
			move_uploaded_file($_FILES["androidicon"]["tmp_name"], "../../../assets/images/maintenance/".$filename);
			if($updateresult == true){
			}
		}
	}
?>