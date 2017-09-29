<?php
	include("connect.php");
	switch($_POST["form"])
	{
		case "loadgaccess":
			echo "<option value=''>Select group access</option>";
        	$sql = "SELECT groupid, groupname FROM tblref_groupaccess";
       		$result = mysql_query($sql);
			while($row = mysql_fetch_array($result))
			{ echo "<option value='" . $row[0] . "'>" . $row[1] . "</option>"; }
		break;
		case "loadusers":
			$added = "";
			if($_POST["gender"] != "")
			{ $added .= " and gender = '" . $_POST["gender"] . "'"; }
			if($_POST["usertype"] != "")
			{ $added .= " and usertype = '" . $_POST["usertype"] . "'"; }
			$sql = "select userid, CONCAT(firstname, ' ', lastname), gender, contactnumber, usertype, emailaddress, ext from tbluser where CONCAT(firstname, ' ', lastname) LIKE '%" . $_POST["key"] . "%'" . $added;
			$result = mysql_query($sql);
			$num = mysql_num_rows($result);
			if($num == 0)
			{ 
				echo "<tr><td colspan='7' style='width: 100%; text-align: center;'><h4 style='font-weight: 300; color: #999; margin-top: 10px;'>No result/s found.</h4></td></tr>";
				 }
			while($row = mysql_fetch_array($result))
			{
				echo "
				<tr id='" . $row[0] . "'>
					<td style='width: 6%;'><img src='server/userpics/" . $row[0] . "." . $row[6] . "' class='img-thumbnail img-circle'></td>
					<td style='width: 24%; vertical-align: middle;'>" . $row[1] . "</td>
					<td style='width: 10%; vertical-align: middle;'>" . $row[2] . "</td>
					<td style='width: 20%; vertical-align: middle;'>" . $row[3] . "</td>
					<td style='width: 10%; vertical-align: middle;'>" . $row[4] . "</td>
					<td style='width: 20%; vertical-align: middle;'>" . $row[5] . "</td>
					<td style='width: 10%; vertical-align: middle;'>
						<center>
						<button class='btn btn-info btn-xs' onClick='edituser(\"" . $row[0] . "\");'><span class='glyphicon glyphicon-pencil'></span></button>
						<button class='btn btn-danger btn-xs' onClick='deleteuser(\"" . $row[0] . "\");'><span class='glyphicon glyphicon-trash'></span></button>
						</center>
					</td>
				</tr>
				";
			}
		break;
		case "edituser":
			$sql = "select firstname, middlename, lastname, contactnumber, emailaddress, gender, username, usertype, password2, password, passwordstr, dateadded, groupaccess, userid, ext from tbluser where userid = '" . $_POST["userid"] . "'";
			$row = mysql_fetch_array(mysql_query($sql));

			$img .= "server/userpics/".$row[13].".".$row[14]."";

			echo "|" . $row[7] . "|" . $row[12] . "|" . $row[0] . "|" . $row[1] . "|" . $row[2] . "|" . $row[3] . "|" . $row[4] . "|" . $row[5] . "|" . $row[6] . "|" . $row[8] . "|" . $row[9] . "|" . $row[10] . "|" . $row[11] . "|" . $img . "|" . $row[13];
		break;
		case "deleteuser":
			$sql = "delete from tbluser where userid = '" . $_POST["userid"] . "'";
			$result = mysql_query($sql);
			if($result == "1")
			{ echo "|1"; }
			else
			{ echo "|Error: " . mysql_error() . "!"; }
		break;
		case "loadgroupaccess":
			$sql = "select groupid, groupname from tblref_groupaccess";
			$result = mysql_query($sql);
			while($row = mysql_fetch_array($result))
			{
				echo "
				<li class='dd-item dd2-item' id='" . $row[0] . "' style='cursor: pointer;'>
					<div class='dd-handle dd2-handle'>
						<i class='normal-icon ace-icon fa fa-user blue bigger-130'></i>
					</div>
					<div class='dd2-content'>" . $row[1] . "</div>
				</li>
				";
			}
		break;
		case "savegroupaccess":
			$groupid = createidno("", "tblref_groupaccess", "groupid");
			$sql = "insert into tblref_groupaccess(groupid, groupname, dateadded) values('" . $groupid . "', '" . $_POST["groupname"] . "', '" . date("Y-m-d") . "')";
			$result = mysql_query($sql);
			if($result == "1")
			{ echo "|1"; }
			else
			{ echo "|Error: " . mysql_error() . "!"; }
		break;
		case "saveaccessibility":
			$delaccess = "delete from tblref_groupaccess2 where groupid = '" . $_POST["groupid"] . "'";
			$accessdel = mysql_query($delaccess);
			$arr = explode("!", $_POST["padding"]);
			for($i=1; $i<=count($arr)-1; $i++)
			{
				$arr2 = explode("#", $arr[$i]);
				$arr3 = explode("|", $arr2[2]);
				$access1 = "";
				$access2 = "";
				for($x=1; $x<=count($arr3)-1; $x++)
				{
					$arr4 = explode(":", $arr3[$x]);
					$access1 .= ", " . $arr4[0];
					$access2 .= ", '" . $arr4[1] . ":1'";
				}
				$sql = "insert into tblref_groupaccess2(groupid, groupname, module" . $access1 . ") values('" . $_POST["groupid"] . "', '" . $_POST["groupname"] . "', '" . $arr2[1] . "'" . $access2 . ")";
				$result = mysql_query($sql);
				if($i == count($arr)-1)
				{ echo "|1"; }
			}
		break;
		case "getaccessibility":
			$fields = array("addnew", "edit", "delremove", "approve", "eviction", "renewal", "pdc_clearing", "viewing", "post", "add2", "edit2", "delete2", "cost_of_repair", "payment", "soa", "user_access");
			$sql = "select module from tblref_groupaccess2 where groupid = '" . $_POST["groupid"] . "'";
			$result = mysql_query($sql);
			while($row = mysql_fetch_array($result))
			{
				echo "!#" . $row[0] . "#";
				$sql2 = "select addnew, edit, delremove, approve, eviction, renewal, pdc_clearing, viewing, post, add2, edit2, delete2, cost_of_repair, payment, soa, user_access from tblref_groupaccess2 where groupid = '" . $_POST["groupid"] . "' and module = '" . $row[0] . "'";
				$row2 = mysql_fetch_array(mysql_query($sql2));
				for($i=0; $i<=15; $i++)
				{
					if($row2[$i] != "")
					{
						$arr = explode(":", $row2[$i]);
						echo "|" . $fields[$i] . ":" . $arr[0];
					}
				}
			}
		break;
	}
?>