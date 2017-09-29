<?php
	include("../connect.php");
	switch($_POST["form"])
	{
		case "getdetails":
			$sql = "select tenantid, tenantname, electricstat, waterstat, txtstat, status from tblunit_statuslogs where unitid = '" . $_POST["unitid"] . "' and xdate = '" . $_POST["mydate"] . "'";
			$row = mysql_fetch_array(mysql_query($sql));
			echo "|" . $row[0] . "|" . $row[1] . "|" . $row[2] . "|" . $row[3] . "|" . $row[4] . "|" . $row[5];
		break;
		case "getdetails2":
			$arr = explode("-", $_POST["mydate"]);
			$sql = "select tenantid, tenantname from tblunit_statuslogs where unitid = '" . $_POST["unitid"] . "' and MONTH(xdate) = '" . $arr[0] . "' and YEAR(xdate) = '" . $arr[1] . "' GROUP BY tenantid";
			$result = mysql_query($sql);
			while($row = mysql_fetch_array($result))
			{ echo "#|" . $row[0] . "|" . $row[1]; }
		break;
		case "loadwing":
			$sql = "select wingID, wing from tblref_wing where mallID = '" . $_POST["mallid"] . "'";
			$result = mysql_query($sql);
			echo "<option value=''>Choose Wing</option>";
			while($row = mysql_fetch_array($result))
			{ echo "<option value='" . $row[0] . "'>" . $row[1] . "</option>"; }
		break;
		case "loadfloor":
			$sql = "select floorid, floor from tblref_floorsetup where wingid = '" . $_POST["wingid"] . "'";
			$result = mysql_query($sql);
			echo "<option value=''>Choose Floor</option>";
			while($row = mysql_fetch_array($result))
			{ echo "<option value='" . $row[0] . "'>" . $row[1] . "</option>"; }
		break;
		case "filterunit":
			$adder = "";
			if($_POST["mallid"] != "")
			{ $adder .= " and a.mallid = '" . $_POST["mallid"] . "'"; }
			if($_POST["wingid"] != "")
			{ $adder .= " and a.wingid = '" . $_POST["wingid"] . "'"; }
			if($_POST["floorid"] != "")
			{ $adder .= " and a.floorid = '" . $_POST["floorid"] . "'"; }
			$sql = "select a.unitid, a.unitname, a.typeofbusiness, a.buildingname, b.floor, a.status from tblref_unit as a LEFT JOIN tblref_floorsetup as b ON a.floorid = b.floorid where a.unitname LIKE '" . $_POST["key"] . "%' and a.typeofbusiness = '" . $_POST["type"] . "'" . $adder;
			$result = mysql_query($sql);
			while($row = mysql_fetch_array($result))
			{
				echo "
				<tr id='" . $row[0] . "'>
					<td style='height: 100px;'>
						<h5 style='margin: 5px;'><a href='#'><span class='glyphicon glyphicon-home'></span>&nbsp;&nbsp;" . $row[1] . "</a></h5>
						<b style='margin: 0px; margin-left: 25px; margin-top: 0px; font-size: 12px; color: #333;'>&nbsp;" . $row[2] . "</b>
						<p style='margin: 0px; margin-left: 25px; margin-top: 0px; font-size: 12px; color: #666;'>&nbsp;" . $row[3] . "</p>
						<p style='margin: 0px; margin-left: 25px; margin-top: 0px; font-size: 12px; color: #666;'>&nbsp;" . $row[4] . "</p>
					</td>
				</tr>
				";
			}
		break;
		case "tenantdetails":
			$sql = "";
			echo "||";
			$sql2 = "select a.unitname, b.mallname, a.buildingname, c.floor from tblref_unit as a LEFT JOIN tblref_mall as b ON a.mallid = b.mallid LEFT JOIN tblref_floorsetup as c ON a.floorid = c.floorid where a.unitid = '" . $_POST["unitid"] . "'";
			$row2 = mysql_fetch_array(mysql_query($sql2));
			echo "|" . $row2[0] . "|" . $row2[1] . "|" . $row2[2] . "|" . $row2[3];
			$sql3 = "";
			echo "||";
		break;
		case "checkphoto":
			$sql = mysql_query("select photo, ext from tblref_floorsetup where floorid = '" . $_POST["floorid"] . "'");
			$row = mysql_fetch_array($sql);
			if($row[0] == "1")
			{ echo "|1|server/floorplan/" . $_POST["floorid"] . "." . $row[1]; }
			else
			{ echo "|0"; }
		break;
		case "loadfloorplan":
			$sql = "";
			if($_POST["mallid"] != "")
			{ $sql = "select mallid from tblref_floorsetup where mallid = '" . $_POST["mallid"] . "' and photo = '1' and type_" . $_POST["type"] . " = '1' GROUP BY mallid"; }
			else
			{ $sql = "select mallid from tblref_floorsetup where photo = '1' and type_" . $_POST["type"] . " = '1' GROUP BY mallid"; }
			$result = mysql_query($sql);
			$num = mysql_num_rows($result);
			if($num == 0)
			{ echo "<li class='col-xs-12 col-sm-12' style='padding: 15px; border: none;'><h3 style='text-align: center; font-size: 30px; font-weight: 300; color: #666;'>No Photos Found.</h3></li>"; }
			else
			{
				while($row = mysql_fetch_array($result))
				{
					$getmall = "select mallname from tblref_mall where mallid = '" . $row[0] . "'";
					$mall = mysql_fetch_array(mysql_query($getmall));
					echo "<h2 class='malltxt'>" . $mall[0] . "</h2>";
					$sql2 = "";
					if($_POST["wingid"] == "")
					{ $sql2 = "select wingid from tblref_floorsetup where mallid = '" . $row[0] . "' and photo = '1' and type_" . $_POST["type"] . " = '1' GROUP BY wingid"; }
					else
					{ $sql2 = "select wingid from tblref_floorsetup where mallid = '" . $row[0] . "' and wingid = '" . $_POST["wingid"] . "' and photo = '1' and type_" . $_POST["type"] . " = '1' GROUP BY wingid"; }
					$result2 = mysql_query($sql2);
					while($row2 = mysql_fetch_array($result2))
					{
						$getwing = "select wing from tblref_wing where wingID = '" . $row2[0] . "'";
						$wing = mysql_fetch_array(mysql_query($getwing));
						echo "<h3 class='wingtxt'><span class='glyphicon glyphicon-star'></span>&nbsp;&nbsp;" . $wing[0] . "</h3>";
						$sql3 = "";
						if($_POST["mallid"] == "")
						{ $sql3 = "select floorid, ext, floor from tblref_floorsetup where mallid = '" . $row[0] . "' and wingid = '" . $row2[0] . "' and photo = '1' and type_" . $_POST["type"] . " = '1'"; }
						else
						{
							if($_POST["wingid"] == "")
							{ $sql3 = "select floorid, ext, floor from tblref_floorsetup where mallid = '" . $_POST["mallid"] . "' and wingid = '" . $row2[0] . "' and photo = '1' and type_" . $_POST["type"] . " = '1'"; }
							else
							{ $sql3 = "select floorid, ext, floor from tblref_floorsetup where mallid = '" . $_POST["mallid"] . "' and wingid = '" . $_POST["wingid"] . "' and photo = '1' and type_" . $_POST["type"] . " = '1'"; }
						}
						$result3 = mysql_query($sql3);
						$num3 = mysql_num_rows($result3);
						if($num3 == 0)
						{ echo "<h5 style='margin-left: 15px;'>No result found.</h5>"; }
						while($row3 = mysql_fetch_array($result3))
						{
							echo "
							<li class='col-xs-2 col-sm-3' style='padding: 0px; float: none; display: inline-block; vertical-align: top; margin: 0px; margin-right: -5px; margin-left: 1px; border: solid 1px #666;' id='" . $row3[0] . "'>
								<a href='#' data-rel='colorbox' onClick='viewdetails(\"" . $row3[0] . "\", \"" . $row3[2] . "\");'>
									<img style='width: 100%' src='server/floorplan/" . $row3[0] . "." . $row3[1] . "' />
									<div class='tags'>
										<span class='label-holder'>
											<span class='label label-danger'>" . $row3[2] . "</span>
										</span>
									</div>
								</a>
								<div class='tools tools-left in'>
									<a href='#' title='Edit Photo' class='btnedit'><i class='ace-icon fa fa-pencil'></i></a>
									<a href='#' title='Remove Photo' class='btndelete'><i class='ace-icon fa fa-times red'></i></a>
								</div>
							</li>
							";
						}
					}
				}
			}
		break;
		case "loadfloorplan2":
			$padding = "
				<table class='table table-bordered'>
					<thead>
						<tr>
							<th style='width: 25%;'>Mall</th>
							<th style='width: 25%;'>Wing</th>
							<th style='width: 25%;'>Floor</th>
							<th style='width: 25%;'>Action</th>
						</tr>
					</thead>
				</table>
				<div style='max-height: 400px; border-bottom: solid 1px #dddddd; padding: 0px; margin-top: -20px;' class='cont'>
				<table class='table table-bordered'>
					<tbody>
			";
			$sql = "";
			if($_POST["mallid"] == "")
			{
				if($_POST["wingid"] == "")
				{ $sql = "SELECT a.floorid, b.mallname, c.wing, a.floor FROM tblref_floorsetup AS a LEFT JOIN tblref_mall AS b ON a.mallid = b.mallid LEFT JOIN tblref_wing AS c ON a.wingid = c.wingID"; }
				else
				{ $sql = "SELECT a.floorid, b.mallname, c.wing, a.floor FROM tblref_floorsetup AS a LEFT JOIN tblref_mall AS b ON a.mallid = b.mallid LEFT JOIN tblref_wing AS c ON a.wingid = c.wingID where c.wingID = '" . $_POST["wingid"] . "'"; }
			}
			else
			{
				if($_POST["wingid"] == "")
				{ $sql = "SELECT a.floorid, b.mallname, c.wing, a.floor FROM tblref_floorsetup AS a LEFT JOIN tblref_mall AS b ON a.mallid = b.mallid LEFT JOIN tblref_wing AS c ON a.wingid = c.wingID where b.mallid = '" . $_POST["mallid"] . "'"; }
				else
				{ $sql = "SELECT a.floorid, b.mallname, c.wing, a.floor FROM tblref_floorsetup AS a LEFT JOIN tblref_mall AS b ON a.mallid = b.mallid LEFT JOIN tblref_wing AS c ON a.wingid = c.wingID where b.mallid = '" . $_POST["mallid"] . "' and c.wingID = '" . $_POST["wingid"] . "'"; }
			}
			$result = mysql_query($sql);
			while($row = mysql_fetch_array($result))
			{
				$padding .= "
				<tr id='" . $row[0] . "'>
					<td style='width: 25%;'>" . $row[1] . "</td>
					<td style='width: 25%;'>" . $row[2] . "</td>
					<td style='width: 25%;'>" . $row[3] . "</td>
					<td style='width: 25%;' class='option'><button class='btn btn-info btn-xs' onclick='editfloor(\"" . $row[0] . "\");'><span class='fa fa-edit'></span>&nbsp;&nbsp;Edit</button></td>
				</tr>
				";
			}
			echo $padding .= "</tbody></table></div>";
		break;
		case "saveunitplot":
			$sql = "insert into tblref_unitplot(floorid, unitid, unitname, status, xpos, ypos, dateadded) values('" . $_POST["floorid"] . "', '" . $_POST["unitid"] . "', '" . $_POST["unitname"] . "', '" . $_POST["status"] . "', '" . $_POST["xpos"] . "', '" . $_POST["ypos"] . "', '" . date("Y-m-d", strtotime($_POST["mydate"])) . "')";
			$result = mysql_query($sql);
			if($result == "1")
			{ echo "|1"; }
			else
			{ echo "|Error: " . mysql_error() . "!"; }
		break;
		case "loadpoints":
			$sql = "";
			if($_POST["stats"] == "all")
			{ $sql = "select a.unitid, a.unitname, b.status, a.xpos, a.ypos from tblref_unitplot as a LEFT JOIN tblunit_statuslogs as b ON a.unitid = b.unitid where a.floorid = '" . $_POST["floorid"] . "' and a.dateadded = '" . date("Y-m-d", strtotime($_POST["mydate"])) . "'"; }
			else
			{
				$stats = "";
				$arr = explode("|", $_POST["stats"]);
				for($i=1; $i<=count($arr)-1; $i++)
				{ $stats .= ", '" . $arr[$i] . "'"; }
				$sql = "select a.unitid, a.unitname, b.status, a.xpos, a.ypos from tblref_unitplot as a LEFT JOIN tblunit_statuslogs as b ON a.unitid = b.unitid where a.floorid = '" . $_POST["floorid"] . "' and b.status IN(" . substr($stats, 2) . ") and a.dateadded = '" . date("Y-m-d", strtotime($_POST["mydate"])) . "'";
			}
			$result = mysql_query($sql);
			while($row = mysql_fetch_array($result))
			{
				$stat = "vacant";
				if($row[2] != "")
				{ $stat = $row[2]; }
				echo "#|" . $row[0] . "|" . $row[1] . "|" . $stat . "|" . $row[3] . "|" . $row[4];
			}
		break;
		case "loadpoints2":
			$arr = explode("|", $_POST["padding"]);
			$arr2 = explode("|", $_POST["padding2"]);
			for($x=1; $x<=count($arr)-1; $x++)
			{
				$sql = "select a.unitid, a.unitname, b.status, a.xpos, a.ypos from tblref_unitplot as a LEFT JOIN tblunit_statuslogs as b ON a.unitid = b.unitid where a.floorid = '" . $_POST["floorid"] . "' and b.status = '" . str_replace("-", " ", $arr[$x]) . "' and b.xdate = '" . date("Y-m-d", strtotime($_POST["mydate"])) . "'";
				$num = mysql_num_rows(mysql_query($sql));
				echo "|" . $num;
			}
			for($y=1; $y<=count($arr2)-1; $y++)
			{
				$sql2 = "select a.unitid, a.unitname, a.xpos, a.ypos from tblref_unitplot as a LEFT JOIN tblunit_statuslogs as b ON a.unitid = b.unitid where a.floorid = '" . $_POST["floorid"] . "' and b." . $arr2[$y] . " = '1' and b.xdate = '" . date("Y-m-d", strtotime($_POST["mydate"])) . "'";
				$num2 = mysql_num_rows(mysql_query($sql2));
				echo "|" . $num2;
			}
		break;
		case "getbills":
			$sql = "";
			if($_POST["type"] == "electric")
			{ $sql = "select a.unitid, a.unitname, a.xpos, a.ypos from tblref_unitplot as a LEFT JOIN tblunit_statuslogs as b ON a.unitid = b.unitid where a.floorid = '" . $_POST["floorid"] . "' and b.electricstat = '1'"; }
			elseif($_POST["type"] == "water")
			{ $sql = "select a.unitid, a.unitname, a.xpos, a.ypos from tblref_unitplot as a LEFT JOIN tblunit_statuslogs as b ON a.unitid = b.unitid where a.floorid = '" . $_POST["floorid"] . "' and b.waterstat = '1'"; }
			else
			{ $sql = "select a.unitid, a.unitname, a.xpos, a.ypos from tblref_unitplot as a LEFT JOIN tblunit_statuslogs as b ON a.unitid = b.unitid where a.floorid = '" . $_POST["floorid"] . "' and b.txtstat = '1'"; }
			$result = mysql_query($sql);
			while($row = mysql_fetch_array($result))
			{ echo "#|" . $row[0] . "|" . $row[1] . "|" . $row[2] . "|" . $row[3]; }
		break;
		case "unitdetails":
			$sql = "select a.unitname, b.mallname, e.wing, c.floor, d.waterstat, d.electricstat, d.txtstat, a.max_num, a.rem_num, f.CompanyID, f.tradeID from tblref_unit as a LEFT JOIN tblref_mall as b ON a.mallid = b.mallid LEFT JOIN tblref_floorsetup as c ON a.floorid = c.floorid LEFT JOIN tblunit_statuslogs as d ON a.unitid = d.unitid LEFT JOIN tblref_wing as e ON a.wingid = e.wingid LEFT JOIN tbltrans_tenants as f ON a.TenantID = f.tradeID where a.unitid = '" . $_POST["unitid"] . "' ORDER BY d.xdate DESC";
			$row = mysql_fetch_array(mysql_query($sql));
			echo "|" . $row[0] . "|" . $row[1] . "|" . $row[2] . "|" . $row[3] . "|" . $row[4] . "|" . $row[5] . "|" . $row[6] . "|" . $row[7] . "|" . $row[8] . "|" . $row[9] . "|" . $row[10];
		break;
		case "unitdetails2":
			$sql = "SELECT a.tradename, b.Mall, d.wing, e.floor, f.waterstat, f.electricstat, f.txtstat, b.UnitID FROM tbltrans_lca_plot AS a LEFT JOIN tbltrans_inquiry AS b ON a.Inquiry_ID = b.Inquiry_ID LEFT JOIN tblref_unit AS c ON b.UnitID = c.unitid LEFT JOIN tblref_wing AS d ON c.wingid = d.wingid LEFT JOIN tblref_floorsetup AS e ON c.floorid = e.floorid LEFT JOIN tblunit_statuslogs AS f ON b.unitid = f.unitid WHERE a.Inquiry_ID = '" . $_POST["unitid"] . "' ORDER BY f.xdate DESC";
			$row = mysql_fetch_array(mysql_query($sql));
			echo "|" . $row[0] . "|" . $row[1] . "|" . $row[2] . "|" . $row[3] . "|" . $row[4] . "|" . $row[5] . "|" . $row[6] . "|" . $row[7];
		break;
		case "ctenantstat":
			$sql = "select a.tradename, a.companyname, a.tradeID, a.datefrom, a.dateto from tbltrans_tenants as a LEFT JOIN tblunit_statuslogs as b ON a.unitid = b.unitID where a.unitID = '" . $_POST["unitid"] . "' and b.xdate = '" . date("Y-m-d") . "'";
			$result = mysql_query($sql);
			while($row = mysql_fetch_array($result))
			{
				$sql2 = "select * from tblunit_statuslogs where unitid = '" . $_POST["unitid"] . "' and tenantid = '" . $row[2] . "' and status = 'occupied' and xdate = '" . date("Y-m-d") . "'";
				$num2 = mysql_num_rows(mysql_query($sql2));
				if($num2 > 0)
				{ echo "<li class='list-group-item'><span class='glyphicon glyphicon-user'></span>&nbsp;&nbsp;" . $row[0] . " - <small>" . $row[1] . "</small><div class='pull-right'>From: " . date("m/d/Y", strtotime($row[3])) . " - To: " . date("m/d/Y", strtotime($row[4])) . "</div></li>"; }
			}
		break;
		case "unitstat":
			$startdate = date("Y-m-d");
			$enddate = date("Y-m-d");
			if($_POST["startdate"] != "")
			{ $startdate = date("Y-m-d", strtotime($_POST["startdate"])); }
			if($_POST["enddate"] != "")
			{ $enddate = date("Y-m-d", strtotime($_POST["enddate"])); }
			$sql = "select xdate, unitname, status, waterstat, electricstat, txtstat from tblunit_statuslogs where unitid = '" . $_POST["unitid"] . "' and xdate BETWEEN '" . $startdate . "' and '" . $enddate . "'";
			$result = mysql_query($sql);
			$num = mysql_num_rows($result);
			if($num == 0)
			{ echo "<tr><td colspan='4' style='text-align: center;'>No result/s found.</td></tr>"; }
			while($row = mysql_fetch_array($result))
			{
				$padding = "";
				if($row[3] == "1")
				{ $padding .= "<label class='label-white label-info'><span class='glyphicon glyphicon-tint'></span></label>"; }
				if($row[4] == "1")
				{ $padding .= "<label class='label-white label-yellow'><span class='fa fa-bolt bigger-110'></span></label>"; }
				if($row[5] == "1")
				{ $padding .= "<label class='label-white label-grey'><span class='glyphicon glyphicon-file'></span></label>"; }
				echo "
				<tr>
					<td style='width: 15%;'>" . date("m/d/Y", strtotime($row[0])) . "</td>
					<td style='width: 40%;'>" . $row[1] . "</td>
					<td style='width: 15%;'>" . $row[2] . "</td>
					<td style='width: 30%;'>" . $padding . "</td>
				</tr>
				";
			}
		break;
		case "tenantstat":
			$startdate = date("Y-m-d");
			$enddate = date("Y-m-d");
			if($_POST["startdate"] != "")
			{ $startdate = date("Y-m-d", strtotime($_POST["startdate"])); }
			if($_POST["enddate"] != "")
			{ $enddate = date("Y-m-d", strtotime($_POST["enddate"])); }
			$sql = "select xdate, tenantname, status, waterstat, electricstat, txtstat from tblunit_statuslogs where unitid = '" . $_POST["unitid"] . "' and xdate BETWEEN '" . $startdate . "' and '" . $enddate . "' and tenantid != ''";
			$result = mysql_query($sql);
			$num = mysql_num_rows($result);
			if($num == 0)
			{ echo "<tr><td colspan='4' style='text-align: center;'>No result/s found.</td></tr>"; }
			while($row = mysql_fetch_array($result))
			{
				$padding = "";
				if($row[3] == "1")
				{ $padding .= "<label class='label-white label-info'><span class='glyphicon glyphicon-tint'></span></label>"; }
				if($row[4] == "1")
				{ $padding .= "<label class='label-white label-yellow'><span class='fa fa-bolt bigger-110'></span></label>"; }
				if($row[5] == "1")
				{ $padding .= "<label class='label-white label-grey'><span class='glyphicon glyphicon-file'></span></label>"; }
				echo "
				<tr>
					<td style='width: 15%;'>" . date("m/d/Y", strtotime($row[0])) . "</td>
					<td style='width: 40%;'>" . $row[1] . "</td>
					<td style='width: 15%;'>" . $row[2] . "</td>
					<td style='width: 30%;'>" . $padding . "</td>
				</tr>
				";
			}
		break;
		case "getarea":
			$sql = "select width, height, minarea from tblref_floor_lca where floorid = '" . $_POST["floorid"] . "'";
			$row = mysql_fetch_array(mysql_query($sql));
			echo "|" . $row[0] . "|" . $row[1] . "|" . $row[2];
		break;
		case "getarea1":
			$sql = "select Inquiry_ID, tradeid, tradename, totalarea, padding from tbltrans_lca_plot where unitid = '" . $_POST["unitid"] . "'";
			$row = mysql_fetch_array(mysql_query($sql));
			$sql2 = "select Status from tbltrans_inquiry Inquiry_ID = '" . $row[0] . "' and date_inquired = '" . date("d-m-Y", strtotime($_POST["mydate"])) . "'";
			$row2 = mysql_fetch_array(mysql_query($sql2));
			echo "!" . $row[0] . "!" . $row[1] . "!" . $row[2] . "!" . $row[3] . "!" . $row2[0] . "!" . $row[4];
		break;
		case "getarea2":
			$sql = "select Inquiry_ID, tradeid, tradename, totalarea, padding from tbltrans_lca_plot where floorid = '" . $_POST["floorid"] . "'";
			$result = mysql_query($sql);
			while($row = mysql_fetch_array($result))
			{
				$sql2 = "select Status from tbltrans_inquiry Inquiry_ID = '" . $row[0] . "' and date_inquired = '" . date("d-m-Y", strtotime($_POST["mydate"])) . "'";
				$result2 = mysql_query($sql2);
				$row2 = mysql_fetch_array($result2);
				{ echo "@!" . $row[0] . "!" . $row[1] . "!" . $row[2] . "!" . $row[3] . "!" . $row2[0] . "!" . $row[4]; }
			}
		break;
		case "deletepoint":
			$sql = "delete from tblref_unitplot where unitid = '" . $_POST["unitid"] . "'";
			$result = mysql_query($sql);
			if($result == "1")
			{ echo "|1"; }
			else
			{ echo "|Error: " . mysql_error() . "!"; }
		break;
		case "editfloor":
			$sql = "select ext from tblref_floorsetup where floorid = '" . $_POST["floorid"] . "'";
			$row = mysql_fetch_array(mysql_query($sql));
			echo "|" . $row[0];
		break;
		case "removefloorplan":
			$getext = "select ext from tblref_floorsetup where floorid = '" . $_POST["floorid"] . "'";
			$ext = mysql_fetch_array(mysql_query($getext));
			$sql = "update tblref_floorsetup set photo = '0' and ext = '(NULL)'";
			$result = mysql_query($sql);
			if($result == "1")
			{
				unlink("server/floorplan/" . $_POST["floorid"] . "." . $ext[0]);
				echo "|1";
			}
			else
			{ echo "|Error: " . mysql_error() . "!"; }
		break;
		case "loadtenants":
			$sql = "select Inquiry_ID, TradeID, Trade_Name, LCA_width, LCA_length from tbltrans_inquiry where Status IN('Tentative', 'Confirmed', 'Occupied') and UnitType = 'LCA' and Trade_Name LIKE '" . $_POST["key"] . "%'";
			$result = mysql_query($sql);
			while($row = mysql_fetch_array($result))
			{
				$sql2 = "select * from tbltrans_lca_plot where Inquiry_ID = '" . $row[0] . "'";
				$num2 = mysql_num_rows(mysql_query($sql2));
				if($num2 == 0)
				{
					echo "
					<tr id='" . $row[1] . "'>
						<td style='width: 20%;'>" . $row[0] . "</td>
						<td style='width: 40%;'>" . $row[2] . "</td>
						<td style='width: 20%;'>" . $row[3] . " sqm.</td>
						<td style='width: 20%;'>" . $row[4] . " sqm.</td>
					</tr>
					";
				}
			}
		break;
		case "loadunits":
			$sql = "select unitid, unitname, status from tblref_unit where floorid = '" . $_POST["floorid"] . "' and typeofbusiness = 'SET' and unitname LIKE '%" . $_POST["key"] . "%'";
			$result = mysql_query($sql);
			while($row = mysql_fetch_array($result))
			{ echo "<li class='list-group-item' onclick='addunit(\"" . $row[0] . "\", \"" . $row[1] . "\", \"" . $row[2] . "\");' style='margin-left: 10px; cursor: pointer;' id='" . $row[0] . "'><span class='glyphicon glyphicon-road green'></span>&nbsp;&nbsp;&nbsp;&nbsp;" . $row[1] . "</li>"; }
		break;
		case "saveplot":
			$sql = "";
			$alert = "";
			$get = "select * from tbltrans_lca_plot where Inquiry_ID = '" . $_POST["inquiryid"] . "'";
			$getnum = mysql_num_rows(mysql_query($get));
			if($getnum == 0)
			{
				$sql = "insert into tbltrans_lca_plot(Inquiry_ID, floorid, tradeid, tradename, totalarea, padding, dateadded) values('" . $_POST["inquiryid"] . "', '" . $_POST["floorid"] . "', '" . $_POST["tenantid"] . "', '" . $_POST["tenantname"] . "', '" . $_POST["totalarea"] . "', '" . $_POST["padding"] . "', '" . date("Y-m-d") . "')";
				$alert = "Occupancy has been set.";
			}
			else
			{
				$sql = "update tbltrans_lca_plot set floorid = ,'" . $_POST["floorid"] . "' tradeid = '" . $_POST["tenantid"] . "', tradename = '" . $_POST["tenantname"] . "', totalarea = '" . $_POST["totalarea"] . "', padding = '" . $_POST["padding"] . "', dateadded = '" . date("Y-m-d") . "' where Inquiry_ID = '" . $_POST["inquiryid"] . "'";
				$alert = "Occupancy has been modified.";
			}
			$result = mysql_query($sql);
			if($result == "1")
			{ echo "|1|" . $alert; }
			else
			{ echo "|Error: " . mysql_error() . "!"; }
		break;
		case "getunittype":
			$sql = "select mallid, wingid, floorid, typeofbusiness from tblref_unit where unitid = '" . $_POST["unitid"] . "'";
			$row = mysql_fetch_array(mysql_query($sql));
			echo "|" . $row[0] . "|" . $row[1] . "|" . $row[2] . "|" . $row[3];
		break;
		case "plotoneunit":
			$sql = "select a.unitname, b.status, a.xpos, a.ypos from tblref_unitplot as a LEFT JOIN tblunit_statuslogs as b ON a.unitid = b.unitid where a.unitid = '" . $_POST["unitid"] . "'";
			$row = mysql_fetch_array(mysql_query($sql));
			$stat = "vacant";
			if($row[1] != "")
			{ $stat = $row[1]; }
			echo "|" . $row[0] . "|" . $stat . "|" . $row[2] . "|" . $row[3];
		break;
		case "loadunits2":
			$sql = "select unitid, unitname, status from tblref_unit where floorid = '" . $_POST["floorid"] . "' and typeofbusiness = '" . $_POST["type"] . "' and unitname LIKE '%" . $_POST["key"] . "%'";
			$result = mysql_query($sql);
			while($row = mysql_fetch_array($result))
			{
				$sql2 = "select * from tblref_unitplot2 where unitid = '" . $row[0] . "'";
				$num2 = mysql_num_rows(mysql_query($sql2));
				if($num2 == 0)
				{ echo "<li class='list-group-item' onclick='addunit(\"" . $row[0] . "\", \"" . $row[1] . "\", \"" . $row[2] . "\");' style='margin-left: 10px; cursor: pointer;' id='" . $row[0] . "'><span class='glyphicon glyphicon-road green'></span>&nbsp;&nbsp;&nbsp;&nbsp;" . $row[1] . "</li>"; }
			}
		break;
		case "saveplot3":
			$sql = "";
			$getget = "select * from tblref_unitplot2 where unitid = '" . $_POST["unitid"] . "'";
			$get = mysql_num_rows(mysql_query($getget));
			if($get > 0)
			{ $sql = "update tblref_unitplot2 set coord = '" . $_POST["coord"] . "', dateadded = '" . date("Y-m-d") . "' where unitid = '" . $_POST["unitid"] . "'"; }
			else
			{
				$getget2 = "select floorid, unitname, status from tblref_unit where unitid = '" . $_POST["unitid"] . "'";
				$get2 = mysql_fetch_array(mysql_query($getget2));
				$sql = "insert into tblref_unitplot2(floorid, unitid, unitname, status, coord, dateadded, type) values('" . $get2[0] . "', '" . $_POST["unitid"] . "', '" . $get2[1] . "', '" . $get2[2] . "', '" . $_POST["coord"] . "', '" . date("Y-m-d") . "', '" . $_POST["type"] . "')";
			}
			$result = mysql_query($sql);
			if($result == "1")
			{ echo "|1"; }
			else
			{ echo "|Error: " . mysql_error() . "!"; }
		break;
		case "loadpoints3":
			$sql = "select unitid, unitname, status, coord from tblref_unitplot2 where floorid = '" . $_POST["floorid"] . "' and type='" . $_POST["type"] . "'";
			$result = mysql_query($sql);
			while($row = mysql_fetch_array($result))
			{
				$sql2 = "select b.CompanyID, b.tradeID from tblref_unit as a LEFT JOIN tbltrans_tenants as b ON a.TenantID = b.tradeID where a.unitid = '" . $row[0] . "'";
				$row2 = mysql_fetch_array(mysql_query($sql2));
				echo "#|" . $row[0] . "|" . $row[1] . "|" . $row[2] . "|" . $row2[0] . "|" . $row2[1] . "|" . $row[3];
			}
		break;
		case "removeunit3":
			$sql = "delete from tblref_unitplot2 where unitid = '" . $_POST["unitid"] . "'";
			$result = mysql_query($sql);
			if($result == "1")
			{ echo "|1"; }
			else
			{ echo "|Error: " . mysql_error() . "!"; }
		break;
	}
?>