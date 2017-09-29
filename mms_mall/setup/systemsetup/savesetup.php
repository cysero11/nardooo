<?php
	include('connect.php');

	if(isset($_POST["wards"]))
	{
		$savesetup = "";
		$alert = "";
		$id = "1";
		if($_POST["wards"] == "0")
		{
			$savesetup = " INSERT INTO tblsys_setup2(corporatename, about, address, contactnumber, emailaddress, maxnumofmall, template, id, mallprefix, inqprefix, appprefix, TIN_number, Telephone_number, Fax_number, website, Machine_No, Serial_No, Accreditation_No, softwaretype) VALUES('" . $_POST["txtcorporatename"] . "', '" . $_POST["txtcompanyabout"] . "', '" . $_POST["txtcompanyaddress"] . "', '" . $_POST["txtcompanycont"] . "', '" . $_POST["txtcompanyemail"] . "', '" . $_POST["txtnumofmall"] . "', '" . $_POST["txtcompanytemplate"] . "', '". $id ."', '" . strtoupper($_POST["txtmallprefix"]) . "', '" . strtoupper($_POST["txtinqprefix"]) . "', '" . strtoupper($_POST["txtappprefix"]) . "', '". $_POST['txtTIN'] ."', '". $_POST['txttelephone'] ."', '". $_POST['txtfax'] ."', '". $_POST['txtwebsite'] ."', '". $_POST['txtmachineno'] ."', '". $_POST['txtserialno'] ."', '". $_POST['txtaccreditationno'] ."', '". $_POST['btnsoftwaretype'] ."')";
			$alert = "System Set Up Saved.";

			$sqlmachine = " INSERT INTO tblmachine SET Machine_No = '". $_POST['txtmachineno'] ."' ";
			$resmachine = mysql_query($sqlmachine, $connection);
			$rowmachine = mysql_fetch_array($resmachine);

			$sqllogmachine = " INSERT INTO tblloggedmachine SET Machine_No = '". $_POST['txtmachineno'] ."' ";
			$reslogmachine = mysql_query($sqllogmachine, $connection);
			$rowlogmachine = mysql_fetch_array($reslogmachine);

		}
		else
		{
			$sentry = $_POST["sentry"];
			$savesetup = "UPDATE tblsys_setup2 SET corporatename = '" . $_POST["txtcorporatename"] . "', about = '" . $_POST["txtcompanyabout"] . "', address = '" . $_POST["txtcompanyaddress"] . "', contactnumber = '" . $_POST["txtcompanycont"] . "', emailaddress = '" . $_POST["txtcompanyemail"] . "', maxnumofmall = '" . $_POST["txtnumofmall"] . "', template = '" . $_POST["txtcompanytemplate"] . "', mallprefix = '".  strtoupper($_POST["txtmallprefix"]) ."', inqprefix = '".  strtoupper($_POST["txtinqprefix"]) ."', appprefix = '".  strtoupper($_POST["txtappprefix"]) ."', TIN_number = '". $_POST['txtTIN'] ."', Telephone_number = '". $_POST['txttelephone'] ."', Fax_number = '". $_POST['txtfax'] ."', website = '". $_POST['txtwebsite'] ."', Machine_No = '". $_POST['txtmachineno'] ."', Serial_No = '". $_POST['txtserialno'] ."', Accreditation_No = '". $_POST['txtaccreditationno'] ."', softwaretype = '". $_POST['btnsoftwaretype'] ."' WHERE id = '" . $sentry . "' ";
			$alert = "User information has been modified.";
		}

		$saveresult = mysql_query($savesetup);
		if($saveresult == "1")
		{
			$ext = explode(".", $_FILES["file1"]["name"]);
			if ( $_FILES["file1"]["name"] != "" ) {
				$updateext = "UPDATE tblsys_setup2 SET corporatelogo = '" . $_POST['txtcorporatename'].".".end($ext) . "' where corporatename = '" . $_POST['txtcorporatename'] . "'";
				$updateresult = mysql_query($updateext);
				$_FILES["file1"]["name"] = $_POST['txtcorporatename'] . "." . end($ext);
				unlink("../../assets/images/corporate_logo/" . $_POST['txtcorporatename'] . ".png");
				unlink("../../assets/images/corporate_logo/" . $_POST['txtcorporatename'] . ".jpeg");
				unlink("../../assets/images/corporate_logo/" . $_POST['txtcorporatename'] . ".jpg");
				unlink("../../assets/images/corporate_logo/" . $_POST['txtcorporatename'] . ".bmp");
				move_uploaded_file($_FILES["file1"]["tmp_name"], "../../assets/images/corporate_logo/" . $_FILES["file1"]["name"]);
			}
		
			echo "|1|" . $alert;
		}
		else
		{ echo "|Error: " . mysql_error() . "!"; }
		
	}
?>