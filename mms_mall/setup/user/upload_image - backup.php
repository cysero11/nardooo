<?php
	include('../../connect.php');

			$file = $_FILES['attachment_profilepic']['name'];
			$filetype = $_FILES["attachment_profilepic"]["type"];
			$filesize = $_FILES["attachment_profilepic"]["size"];
			$tmp_name = $_FILES["attachment_profilepic"]["tmp_name"];
		
					if($file != "")
					{

						if (!file_exists("../../server/user/" . $_REQUEST["userID"])) {
							mkdir("../../server/user/" . $_REQUEST["userID"], 0777, true);
						}

							move_uploaded_file($tmp_name, "../../server/user/" . $_REQUEST["userID"] . "/" . $file);
						
							$sql = "UPDATE tbluser SET img = '". $file ."' WHERE userid = '".$_REQUEST["userID"]."'";
							$result = mysql_query($sql, $connection);
					}		
		
		// mysql_close($connection);
					echo $_REQUEST["userID"];
?>