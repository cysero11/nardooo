<?php
	include('../connect.php');

	// if (!file_exists("../server/company/" . $_REQUEST["comidpic"])) {
	// 	mkdir("../server/company/" . $_REQUEST["comidpic"] . "/contact_person", 0777, true);
	// 	if (!file_exists("../server/company/" . $_REQUEST["comidpic"] . "/contact_person/" .$_REQUEST["conidpic"])) {
			mkdir("../server/company/" . $_REQUEST["comidpic"] . "/contact_person/" .$_REQUEST["conidpic"], 0777, true);
	// 	}
	// }

			$file = $_FILES['contactimage']['name'];
			$filetype = $_FILES["contactimage"]["type"];
			$filesize = $_FILES["contactimage"]["size"];
			$tmp_name = $_FILES["contactimage"]["tmp_name"];

			move_uploaded_file($tmp_name, "../server/company/" . $_REQUEST["comidpic"] . "/contact_person/" .$_REQUEST["conidpic"] . "/" . $file);
			$sql = "UPDATE tbltrans_company_contact_person SET filename = '".$file."' WHERE custID = '". $_REQUEST["conidpic"] ."' ";
			$result = mysql_query($sql, $connection);

			mysql_close($connection);
			// echo $_REQUEST["comidpic"] . " - " . $_REQUEST["conidpic"];

?>
