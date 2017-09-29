<?php 
include "connect.php";
	switch ($_POST['form']) {

			case 'loadsetup':
				$sql = " SELECT corporatename, about, address, contactnumber, emailaddress, maxnumofmall, template, corporatelogo, id, mallprefix, inqprefix, appprefix, TIN_number, Telephone_number, Fax_number, website, Machine_No, Serial_No, Accreditation_No, softwaretype FROM tblsys_setup2 ";
				$row = mysql_fetch_array(mysql_query($sql));

				if ($row[7] == "") {
					$img = "assets/images/avatars/noimage.png";
				}
				else{
					$img = "assets/images/corporate_logo/".$row[7]."";
				}

				echo "|" . $row[0] . "|" . $row[1] . "|" . $row[2] . "|" . $row[3] . "|" . $row[4] . "|" . $row[5] . "|" . $row[6] . "|" . $img . "|" . $row[8] . "|" . $row[9] . "|" . $row[10] . "|" . $row[11] . "|" . $row[7] . "|" . $row[12] . "|" . $row[13] . "|" . $row[14] . "|" . $row[15] . "|" . $row[16] . "|" . $row[17] . "|" . $row[18] . "|" . $row[19];
			break;

			case 'loadcount':
				$sql = " SELECT count(*) from tblsys_setup2 ";
				$res = mysql_query($sql, $connection);
				$row = mysql_fetch_array($res);
				echo $row[0];
			break;

			case 'template':
			$sql = " SELECT corporatename, about, address, contactnumber, emailaddress, corporatelogo, template from tblsys_setup2 ";
			$res = mysql_query($sql, $connection) or die(mysql_error());
			$row = mysql_fetch_array($res);

			$template1 .= "
						<tr>
							<td colspan='3' align='center'><img src='assets/images/corporate_logo/".$row[5]." ' style='height: 130px; width: 120px;'></td>
							<td colspan='3'>
								<p style='padding: 0px; display: block;margin:0px;' class=''><h2>".$row[0]."</h2></p>
								<p style='padding: 0px; display: block;margin:0px;' class=''>".$row[2]."</p>
								<p style='padding: 0px; display: block;margin:0px;' class=''>".$row[3]."</p>
								<p style='padding: 0px; display: block;margin:0px;' class=''>".$row[4]."</p>
							</td>
						</tr>
						";
			$template2 .= "
						<tr>
							<td colspan='3' align='center'><img src='assets/images/corporate_logo/".$row[5]." ' style='height: 130px; width: 120px;'></td>
						</tr>
						<tr>
							<td colspan='3' align='center'>
								<p style='padding: 0px; display: block;margin:0px;' class='companyname'><h2>".$row[0]."</h2></p>
								<p style='padding: 0px; display: block;margin:0px;' class='companyaddress'>".$row[2]."</p>
								<p style='padding: 0px; display: block;margin:0px;' class='companynumber'>".$row[3]."</p>
								<p style='padding: 0px; display: block;margin:0px;' class='companywebsite'>".$row[4]."</p>
							</td>
						</tr>
						";

			if ($row[6] == "1"){
				echo $template1;
				}
			else{
				echo $template2;
			}

			break;

			case  'addpenal':

			if ($_POST['chrgpenaltytype'] == "percent"){

				if ($_POST['chrgpenalvatable'] == "yes"){

				$sql ="UPDATE tblref_charges SET chrgpenaltytype ='".$_POST['chrgpenaltytype']."', chrgpenalvatable ='".$_POST['chrgpenalvatable']."',  chrgpenalpercent ='".$_POST['labas']."', chrgpenalvatper = '".$_POST['chrgpenalvatper']."',  chrgpenalvattype = '".$_POST['chrgpenalvattype']."' WHERE chrgid = 'CHRG-0000001' ";

				$result = mysql_query($sql, $connection);	
				}
				else {

				$sql ="UPDATE  tblref_charges SET chrgpenalpercent = '".$_POST['labas']."', chrgpenalvatable ='No', chrgpenaltytype ='".$_POST['chrgpenaltytype']."',  chrgpenalvatper = '0', chrgpenalvattype = '".$_POST['chrgpenalvattype']."' WHERE chrgid = 'CHRG-0000001' ";


				$result = mysql_query($sql, $connection);

				}
			}
			else{

				if ($_POST['chrgpenalvatable'] == "yes"){

				$sql ="UPDATE tblref_charges SET chrgpenaltytype ='".$_POST['chrgpenaltytype']."', chrgpenalvatable ='".$_POST['chrgpenalvatable']."',  chrgpealamount ='".$_POST['labas']."', chrgpenalvatper = '".$_POST['chrgpenalvatper']."',  chrgpenalvattype = '".$_POST['chrgpenalvattype']."' WHERE chrgid = 'CHRG-0000001' ";

				$result = mysql_query($sql, $connection);	
				}
				else {

				$sql ="UPDATE  tblref_charges SET chrgpealamount = '".$_POST['labas']."', chrgpenalvatable ='No', chrgpenaltytype ='".$_POST['chrgpenaltytype']."',  chrgpenalvatper = '0', chrgpenalvattype = '".$_POST['chrgpenalvattype']."' WHERE chrgid = 'CHRG-0000001' ";


				$result = mysql_query($sql, $connection);

				}


			}

			break;

			case 'checkmachineno':
				$sql = " SELECT COUNT(Machine_No) FROM tblmachine WHERE Machine_No = '". $_POST['txtmachineno'] ."' ";
				$res = mysql_query($sql, $connection);
				$row = mysql_fetch_array($res);
				echo $row[0];
			break;	
	}
 ?>