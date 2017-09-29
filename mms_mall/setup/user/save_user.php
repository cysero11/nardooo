<?php
	include('../../connect.php');

	if(isset($_POST["txtfirstname"]))
	{
		$saveuser = "";
		$userid = "";
		$alert = "";
		if($_POST["txtpassword"] == $_POST["txtcpassword"]){
			if($_POST["txtuserid"] == "")
			{
				$userid = createidno("USER", "tbluser", "userid");
				$saveuser = "insert into tbluser(userid, firstname, middlename, lastname, contactnumber, emailaddress, gender, username, usertype, password2, password, passwordstr, dateadded, groupaccess) values('" . $userid . "', '" . strtoupper($_POST["txtfirstname"]) . "', '" . strtoupper($_POST["txtmiddlename"]) . "', '" . strtoupper($_POST["txtlastname"]) . "', '" . $_POST["txtcontactnumber"] . "', '" . $_POST["txtemailaddress"] . "', '" . $_POST["txtgender"] . "', '" . $_POST["txtusername"] . "', '" . $_POST["txtusertype"] . "', '" . md5($_POST["txtpassword"]) . "', '" . $_POST["txtpassword"] . "', '" . $_POST["txtpasswordhint"] . "', '" . date("Y-m-d") . "', '" . $_POST["txtgroupaccess"] . "')";
				$alert = "Record successfully added.";
			}
			else
			{
				$userid = $_POST["txtuserid"];
				$saveuser = "update tbluser set firstname = '" . $_POST["txtfirstname"] . "', middlename = '" . $_POST["txtmiddlename"] . "', lastname = '" . $_POST["txtlastname"] . "', contactnumber = '" . $_POST["txtcontactnumber"] . "', emailaddress = '" . $_POST["txtemailaddress"] . "', gender = '" . $_POST["txtgender"] . "', username = '" . $_POST["txtusername"] . "', usertype = '" . $_POST["txtusertype"] . "', password2 = '" . md5($_POST["txtpassword"]) . "', password = '" . $_POST["txtpassword"] . "', passwordstr = '" . $_POST["txtpasswordhint"] . "', dateadded = '" . date("Y-m-d") . "', groupaccess = '" . $_POST["txtgroupaccess"] . "' where userid = '" . $userid . "'";
				$alert = "Record successfully updated.";
			}
		$saveresult = mysql_query($saveuser);
		}else{
			echo "|2|" . "Password do not match";
		}
		if($saveresult == "1")
		{
			$ext = explode(".", $_FILES["txtfile"]["name"]);
			if ( $_FILES["txtfile"]["name"] != "" ) {
					$updateext = "UPDATE tbluser SET ext = '" . end($ext) . "' where userid = '" . $userid . "'";
					$updateresult = mysql_query($updateext);
					$_FILES["txtfile"]["name"] = $userid . "." . end($ext);
					unlink("../../server/userpics/" . $userid . ".png");
					unlink("../../server/userpics/" . $userid . ".jpeg");
					unlink("../../server/userpics/" . $userid . ".jpg");
					unlink("../../server/userpics/" . $userid . ".bmp");
					move_uploaded_file($_FILES["txtfile"]["tmp_name"], "../../server/userpics/" . $_FILES["txtfile"]["name"]);
				}
			echo "|1|" . $alert;
		}
		else
		{ echo "|Error: " . mysql_error() . "!"; }
		
	}
?>