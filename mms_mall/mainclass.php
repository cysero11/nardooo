<?php
	include("connect.php");
	switch($_POST["form"])
	{
		case 'loaddatetofunction':
			$refDate = $_POST["datefrom"];
			$months = intval($_POST["months"]);
			$days = intval($_POST["days"]);
			if($_POST["type"] == "LCA")
			{
				for ($x=1; $x<=$days; $x++)
				{
					$refDate = date( 'm/d/Y', strtotime($refDate . '+1 day') );
				}
				for ($x=1; $x<=$months; $x++)
				{
					$refDate = date( 'm/d/Y', strtotime($refDate . '+1 month') );
				}
			}
			else
			{
				for ($x=1; $x<=$months; $x++)
				{
					$refDate = date( 'm/d/Y', strtotime($refDate . '+1 month') );
				}
			}



			echo "|" . $refDate . "|";
		break;

		// Kevin Macandog codes START
		case 'updatetenantstatus':
			// $sql = "SELECT COUNT(id) as DATEdiff FROM tbltrans_tenants WHERE DATEDIFF (DATE_FORMAT(dateto, '%Y/%m/%d'), CURDATE()) >= '0' AND DATEDIFF ( DATE_FORMAT(dateto, '%Y/%m/%d'), CURDATE()) <= '5'";
			// $result = mysql_query($sql, $connection);
			// $row = mysql_fetch_array($result);
			//
			// for ($date=0; $date <= $row[0] - 1; $date++) {
			// 	$sql2 = "UPDATE tbltrans_tenants SET Status = 'foreviction' WHERE DATEDIFF (DATE_FORMAT(dateto, '%Y/%m/%d'), CURDATE()) >= '0' AND DATEDIFF ( DATE_FORMAT(dateto, '%Y/%m/%d'), CURDATE()) <= '5' AND Status != 'forrenewal' AND Status != 'evicted'";
			// 	$res2 = mysql_query($sql2, $connection);
			// }
			// echo $row[0];

			$sql = "SELECT TIMESTAMPDIFF(MONTH, DATE_FORMAT(CURDATE(), '%Y/%m/%d'), DATE_FORMAT(dateto, '%Y/%m/%d')) AS datedate, dateevic, dateto FROM tbltrans_tenants";
			$result = mysql_query($sql, $connection);
			while ($row = mysql_fetch_array($result)) {

				if($row[0] < 0){
					$arr = explode("-", $row[0]);
					$datediff = $arr[1];
				}else{
						$datediff = $row[0];
				}

				$evict = explode(" ", $row[1]);
				// $evict[0];

				if($datediff <= $evict[0]){
					$sql2 = "UPDATE tbltrans_tenants SET Status = 'foreviction' WHERE dateto = '".$row[2]."' AND Status != 'foreviction' ";
					$result2 = mysql_query($sql2, $connection);
				}
				// echo $datediff . "<=" . $evict[0] . " ? ";
			}
		break;

		case 'pdcstatupdate':
			$sql = "SELECT COUNT(id) as DATEdiff FROM tbltrans_pdc WHERE DATEDIFF (CURDATE(), DATE_FORMAT(pdcdate, '%Y/%m/%d')) > 0 AND checkstat = 'PENDING'";
			$result = mysql_query($sql, $connection);
			$row = mysql_fetch_array($result);

			for ($date=0; $date <= $row[0] - 1; $date++) {
				$sql2 = "UPDATE tbltrans_pdc SET checkstat = 'Insufficient Fund' WHERE DATEDIFF (CURDATE(), DATE_FORMAT(pdcdate, '%Y/%m/%d')) > 0 AND checkstat = 'PENDING'";
				$res2 = mysql_query($sql2, $connection);
			}
			// echo $row[0];
		break;
		// Kevin Macandog codes END
		// ====================================================== USER INFORMATION ===============================================================
		case "getuserdata":
			$sql = "SELECT firstname, ext FROM tbluser WHERE userid = '".$_COOKIE["userid"]."'";
			$result = mysql_query($sql, $connection);
			$row = mysql_fetch_array($result);

			$sql2 = "SELECT setup FROM tblsys_setup";
			$result2 = mysql_query($sql2, $connection);
			$row2 = mysql_fetch_array($result2);

			if($row["ext"] == "")
			{
				$img = "assets/images/ai1logo.png";
			}
			else
			{
				$img = "server/userpics/".$_COOKIE["userid"] . "." . $row["ext"];
			}
			echo $row["firstname"] . "|" . $_COOKIE["userid"] . "|" . $row2["setup"] . "|" . $img . "|";

		break;
		// ========================================================================================================================================

		// ====================================================== REFERENTIAL OF INVESTIGATOR ====================================================
		case "loadinvestigator":
		$page = $_POST["page"];
		$limit = ($page-1) * 20;
			$getinvestigator = "SELECT refbmid, refbmlastname, refbmfirstname, refbmmiddlename, refbmposition, refbmusername, refbmpassword, dateadded FROM tblref_investigator WHERE refbmlastname LIKE '%". $_POST["key"]."%' OR refbmfirstname LIKE '%". $_POST["key"]."%' OR refbmmiddlename LIKE '%". $_POST["key"]."%' OR refbmposition LIKE '%". $_POST["key"]."%' OR refbmusername LIKE '%". $_POST["key"]."%' LIMIT ".$limit.",20";
			$investigatorresult = mysql_query($getinvestigator, $connection);
			while($investigator = mysql_fetch_array($investigatorresult))
			{
				// <td class='center'>
				// <label class='pos-rel'>
				// 	<input type='checkbox' class='ace' />
				// 	<span class='lbl'></span>
				// </label>
				// </td>
			echo "
			<tr style='width: 100%;display: table;table-layout: fixed;'>
			<td class='hide_mobile'>" . $investigator["refbmid"] . "</th>
			<td class='scroll'>" . $investigator["refbmlastname"] . "</th>
			<td class='scroll'>" . $investigator["refbmfirstname"] . "</th>
			<td class='hide_mobile'>" . $investigator["refbmmiddlename"] . "</th>
			<td class='hide_mobile'>" . $investigator["refbmposition"] . "</th>
			<td class='hide_mobile'>" . $investigator["refbmusername"] . "</th>
			<td hidden >" . $investigator["refbmpassword"] . "</th>
			<td>
				<button class='btn btn-xs btn-info' onclick='editbmref(\"".$investigator["refbmid"]."\")'>
					<i class='ace-icon fa fa-pencil bigger-120'></i>
				</button>

				<button class='btn btn-xs btn-danger' onclick='delbmref(\"".$investigator["refbmid"]."\")'>
					<i class='ace-icon fa fa-trash-o bigger-120'></i>
				</button>
			</td>
			</tr>
			";
			}
		break;

		case "loadpaginationinvest":

			$page = $_POST["page"];
			$sqlb = "SELECT COUNT(*) FROM tblref_investigator WHERE refbmlastname LIKE '%". $_POST["key"]."%' OR refbmfirstname LIKE '%". $_POST["key"]."%' OR refbmmiddlename LIKE '%". $_POST["key"]."%' OR refbmposition LIKE '%". $_POST["key"]."%' OR refbmusername LIKE '%". $_POST["key"]."%'";
			$aa = mysql_query($sqlb, $connection);
			$nums = mysql_fetch_row($aa);
			$num = $nums[0];
			// if($num <= 20)
			// {
			// 	$page = 1
			// }
			$rowsperpage = 20;
			$range = 4;
			$totalpages = ceil($num / $rowsperpage);
			$prevpage;
			$nextpage;
			// if not on page 1, don't show back links
			if($page > 1 )
			{
			   echo "<li style='width:50px !important;' onclick='getvalinve(1)'><< First</li>";
			   $prevpage = $page - 1;
			   echo "<li style='width:70px !important;' onclick='getvalinve(". $prevpage .")'>< Previous</li>";
			}
			for($x = ($page - $range); $x < (($page + $range) + 1); $x++)
			{
			   if (($x > 0) && ($x <= $totalpages))
			   {
			      if ($x == $page)
			      {

		   	echo "<li id='pgptnts" . $x . "' class='pgnumptnts active' onclick='getvalinve(" . $x . ",". $x .")'>" . $x . "</li>"; }
			else
			{
			echo "<li id='pgptnts" . $x . "' class='pgnumptnts' onclick='getvalinve(" . $x . ",". $x .")'>" . $x . "</li>"; }
		       }
		    }
		    if($page < ($totalpages - $range))
		    { echo "<li>...</li>"; }
		    if ($page != $totalpages && $num != 0)
		    {
		       $nextpage = $page + 1;
		       echo "<li style='width:50px !important;' onclick='getvalinve(". $nextpage .", ". $nextpage .")'>Next ></li>";
		       echo "<li style='width:50px !important;' onclick='getvalinve(". $totalpages .", ". $totalpages .")'>Last >></li>";
		    }
		break;

		case 'loadentriesinvest':
			if($_POST["page"] == "")
    		{ $page = 1; }
    		else
    		{ $page = $_POST["page"]; }
    		$limit = ($page-1) * 20;
  			 $sql = "SELECT COUNT(*) FROM tblref_investigator WHERE refbmlastname LIKE '%". $_POST["key"]."%' OR refbmfirstname LIKE '%". $_POST["key"]."%' OR refbmmiddlename LIKE '%". $_POST["key"]."%' OR refbmposition LIKE '%". $_POST["key"]."%' OR refbmusername LIKE '%". $_POST["key"]."%'";
  			 $result = mysql_query($sql, $connection);
  			 $row = mysql_fetch_array($result);
  			 $rowsperpage = 20;
  			 $totalpages = ceil($row[0] / $rowsperpage);
  			 $upto = $limit + 20;
  			 $from = $limit + 1;
  			 if($page == $totalpages && $row[0] != 0)
  			 {
  			      echo "Showing " . $from . " to " . $row[0] . " of " . $row[0] . " entries";
  			 }
  			 else
  			 {

  			      if($row[0] == 0)
  			       {
  			        echo "no data";
  			       }
  			      else if($row[0] <= 19 && $row[0] != 0)
  			       {
  			        echo "Showing 1 to " . $row[0] . " of " . $row[0] . " entries";
  			       }
  			      else if($row[0] >= 20 && $row[0] != 0)
  			       {
  			        echo "Showing " . $from . " to " . $upto . " of " . $row[0] . " entries";
  			       }

  			  }
		break;

		case 'delbmref':
				$sql = "DELETE FROM tblref_investigator WHERE refbmid = '". $_POST["id"] ."'";
				$result = mysql_query($sql);
				if($result == true)
				{
					echo "Successfully deleted.";
				}
		break;

		case 'editbmref':
				$sql = "SELECT refbmid, refbmlastname, refbmfirstname, refbmmiddlename, refbmposition, refbmusername, refbmpassword FROM tblref_investigator WHERE refbmid = '". $_POST["id"] ."'";
				$result = mysql_query($sql);
				$row = mysql_fetch_array($result);
				if($result == true)
				{
					echo "|" . $row["refbmid"] . "|" . $row["refbmlastname"] . "|" . $row["refbmfirstname"] . "|" . $row["refbmmiddlename"] . "|" . $row["refbmposition"] . "|" . $row["refbmusername"] . "|" . $row["refbmpassword"];
				}
		break;

		case "newinvestigator":
			$datenow = getsysdate();
			$sql = "";
			$alert = "";
			if($_POST["bmid"] == "")
			{
				$sql = "INSERT into tblref_investigator (refbmid, refbmlastname, refbmfirstname,refbmmiddlename, refbmposition, refbmusername, refbmpassword, dateadded) values('" . createidno("INV", "tblref_investigator", "refbmid") . "', '" . $_POST["refbmlastname"] . "', '" . $_POST["refbmfirstname"] . "', '" . $_POST["refbmmiddlename"] . "','" . $_POST["refbmposition"] . "', '" . $_POST["refbmusername"] . "', '" . $_POST["refbmpassword"] . "' ,'" . date($datenow." H:i:s") . "')";
				$alert = "New Investigator has been added.";
			}

			else
			{
				$sql = "UPDATE tblref_investigator SET refbmlastname = '". $_POST["refbmlastname"] ."',  refbmfirstname = '". $_POST["refbmfirstname"] ."', refbmmiddlename = '". $_POST["refbmmiddlename"] ."',  refbmposition = '". $_POST["refbmposition"] ."',  refbmusername = '". $_POST["refbmusername"] ."',  refbmpassword = '" . $_POST["refbmpassword"] ."' WHERE refbmid = '". $_POST["bmid"] ."'";
				$alert = "Investigator successfully modified.";
			}
			$result = mysql_query($sql) or die (mysql_error());
			if($result == true)
			{
					echo $alert;
			}

		break;


		case "loadmall":
		$page = $_POST["page"];
		$limit = ($page-1) * 20;
			$sql = "SELECT mallid, mallname, malladdress FROM tblref_mall WHERE mallname LIKE '%" . $_POST["key"] . "%' LIMIT ".$limit.",20";
			$result = mysql_query($sql);
			while($row = mysql_fetch_array($result))
			{
				echo "
				<tr id='" . $row[0] . "'' style='width: 100%;display: table;table-layout: fixed;'>
					<td class='hide_mobile'>" . $row["mallid"] . "</td>
					<td>" . $row["mallname"] . "</td>
					<td class='scroll'>" . $row["malladdress"] . "</td>
					<td>
						<button class='btn btn-xs btn-info' onclick='editmallref(\"".$row["mallid"]."\")'>
							<i class='ace-icon fa fa-pencil bigger-120'></i>
						</button>

						<button class='btn btn-xs btn-danger' onclick='delmallref(\"".$row["mallid"]."\")'>
							<i class='ace-icon fa fa-trash-o bigger-120'></i>
						</button>
					</td>
				</tr>
				";
			}
		break;

		case "loadpaginationmall":

			$page = $_POST["page"];
			$sqlb = "SELECT COUNT(*) FROM tblref_mall WHERE mallname LIKE '%" . $_POST["key"] . "%'";
			$aa = mysql_query($sqlb, $connection);
			$nums = mysql_fetch_row($aa);
			$num = $nums[0];
			// if($num <= 20)
			// {
			// 	$page = 1
			// }
			$rowsperpage = 20;
			$range = 4;
			$totalpages = ceil($num / $rowsperpage);
			$prevpage;
			$nextpage;
			// if not on page 1, don't show back links
			if($page > 1 )
			{
			   echo "<li style='width:50px !important;' onclick='getvalmall(1)'><< First</li>";
			   $prevpage = $page - 1;
			   echo "<li style='width:70px !important;' onclick='getvalmall(". $prevpage .")'>< Previous</li>";
			}
			for($x = ($page - $range); $x < (($page + $range) + 1); $x++)
			{
			   if (($x > 0) && ($x <= $totalpages))
			   {
			      if ($x == $page)
			      {

		   	echo "<li id='pgptnts" . $x . "' class='pgnumptnts active' onclick='getvalmall(" . $x . ",". $x .")'>" . $x . "</li>"; }
			else
			{
			echo "<li id='pgptnts" . $x . "' class='pgnumptnts' onclick='getvalmall(" . $x . ",". $x .")'>" . $x . "</li>"; }
		       }
		    }
		    if($page < ($totalpages - $range))
		    { echo "<li>...</li>"; }
		    if ($page != $totalpages && $num != 0)
		    {
		       $nextpage = $page + 1;
		       echo "<li style='width:50px !important;' onclick='getvalmall(". $nextpage .", ". $nextpage .")'>Next ></li>";
		       echo "<li style='width:50px !important;' onclick='getvalmall(". $totalpages .", ". $totalpages .")'>Last >></li>";
		    }
		break;

		case 'loadentriesmall':
			 if($_POST["page"] == "")
    	     { $page = 1; }
    	     else
    	     { $page = $_POST["page"]; }
    	     $limit = ($page-1) * 20;

  			 $sql = "SELECT COUNT(*) FROM tblref_mall WHERE mallname LIKE '%" . $_POST["key"] . "%'";
  			 $result = mysql_query($sql, $connection);
  			 $row = mysql_fetch_array($result);
  			 $rowsperpage = 20;
  			 $totalpages = ceil($row[0] / $rowsperpage);
  			 $upto = $limit + 20;
  			 $from = $limit + 1;
  			 if($page == $totalpages && $row[0] != 0)
  			 {
  			      echo "Showing " . $from . " to " . $row[0] . " of " . $row[0] . " entries";
  			 }
  			 else
  			 {

  			      if($row[0] == 0)
  			       {
  			        echo "no data";
  			       }
  			      else if($row[0] <= 19 && $row[0] != 0)
  			       {
  			        echo "Showing 1 to " . $row[0] . " of " . $row[0] . " entries";
  			       }
  			      else if($row[0] >= 20 && $row[0] != 0)
  			       {
  			        echo "Showing " . $from . " to " . $upto . " of " . $row[0] . " entries";
  			       }

  			  }
		break;

		case 'delmallref':
				$sql = "DELETE FROM tblref_mall WHERE mallid = '". $_POST["id"] ."'";
				$result = mysql_query($sql);
				if($result == true)
				{
					echo "Successfully deleted.";
				}
		break;

		case 'editmallref':
				$sql = "SELECT mallid, mallname, malladdress FROM tblref_mall WHERE mallid = '". $_POST["id"] ."'";
				$result = mysql_query($sql);
				$row = mysql_fetch_array($result);
				if($result == true)
				{
					echo "|" . $row["mallid"] . "|" . $row["mallname"] . "|" . $row["malladdress"];
				}
		break;

		case "addnewmall":
		$datenow = getsysdate();
			if($_POST["mallid"] == "")
			{
				$pau= " SELECT * FROM tblref_mall WHERE mallname = '" . $_POST["mallname"] ."' ";
				$result = mysql_query($pau) or die(mysql_error());
				$poleng = mysql_num_rows($result);
					if ($poleng == 0) {
						$sql = "INSERT into tblref_mall (mallid, mallname,malladdress,dateadded) values('" . createidno("M", "tblref_mall", "mallid") . "' , '" . $_POST["mallname"] . "', '" . $_POST["malladdress"] . "','" . date($datenow." H:i:s") . "')";
						$result = mysql_query($sql, $connection);
						echo "Successfully Added.";
					} else {
						echo "Already Existing!";
					}
			}
			else
			{
					$sql = "UPDATE tblref_mall SET mallname = '" . $_POST["mallname"] . "', malladdress = '" . $_POST["malladdress"] . "' WHERE mallid = '". $_POST["mallid"] ."'";
					$result = mysql_query($sql, $connection);
						echo "Successfully modified.";
			}
		break;
		// ========================================================================================================================================


		// ====================================================== REFERENTIAL OF FLOOR ============================================================
		case 'loadfloors':
				$page = $_POST["page"];
				$limit = ($page-1) * 20;
				if($_POST["key"] != "")
				{
					$key = "AND (floor LIKE '%".$_POST["key"]."%' OR floorid LIKE '%".$_POST["key"]."%')";
				}
				else
				{
					$key = "";
				}
						$select = "SELECT mallid, wingid, floor, floorid FROM tblref_floorsetup WHERE wingid = '".$_POST["type"]."' ".$key." LIMIT ".$limit.",20";
						$result = mysql_query($select);
						$numres = mysql_num_rows($result);
						if($numres != 0)
						{
							while($row = mysql_fetch_array($result)){

								$selectbldg = "SELECT wing FROM tblref_wing WHERE wingID = '". $row["wingid"] ."'";
								$result_bldg = mysql_query($selectbldg, $connection);
								$row_bldg = mysql_fetch_array($result_bldg);
								$numbldg = mysql_num_rows($result_bldg);
								if($numbldg != 0)
								{
									$sql2 = "select width, height, minarea from tblref_floor_lca where floorid = '" . $row[3] . "'";
									$row2 = mysql_fetch_array(mysql_query($sql2));
											echo "
											<tr style='width: 100%;display: table;table-layout: fixed;'>
												<td class='scroll'>". $row["floor"] ."</td>
												<td class='hide_mobile'>". $row_bldg["wing"] ."</td>
												<td>" . $row2[0] . " m. x " . $row2[1] . " m.</td>
												<td class='hide_mobile'>" . $row2[2] . " sqm.</td>
												<td>
													<button class='btn btn-xs btn-info' onclick='editreffloor(\"".$row["floorid"]."\")'>
														<i class='ace-icon fa fa-pencil bigger-120'></i>
													</button>

													<button class='btn btn-xs btn-danger' onclick='delreffloor(\"".$row["floorid"]."\")'>
														<i class='ace-icon fa fa-trash-o bigger-120'></i>
													</button>
												</td>
											</tr>";

											// echo $select . "|" . $selectbldg . "|" . $selectmall . "|#";

								}

							}
						}
				break;

				case "loadpaginationflr":
					$page = $_POST["page"];
					if($_POST["key"] != "")
					{
						$key = "AND (floor LIKE '%".$_POST["key"]."%' OR floorid LIKE '%".$_POST["key"]."%')";
					}
					else
					{
						$key = "";
					}
					$sqlb = "SELECT COUNT(*) FROM tblref_floorsetup WHERE wingid = '".$_POST["type"]."' ".$key."";
					$aa = mysql_query($sqlb, $connection);
					$nums = mysql_fetch_row($aa);
					$num = $nums[0];
					// if($num <= 20)
					// {
					// 	$page = 1
					// }
					$rowsperpage = 20;
					$range = 4;
					$totalpages = ceil($num / $rowsperpage);
					$prevpage;
					$nextpage;
					// if not on page 1, don't show back links
					if($page > 1 )
					{
					   echo "<li style='width:50px !important;' onclick='getvalflr(1)'><< First</li>";
					   $prevpage = $page - 1;
					   echo "<li style='width:70px !important;' onclick='getvalflr(". $prevpage .")'>< Previous</li>";
					}
					for($x = ($page - $range); $x < (($page + $range) + 1); $x++)
					{
					   if (($x > 0) && ($x <= $totalpages))
					   {
					      if ($x == $page)
					      {

				   	echo "<li id='pgptnts" . $x . "' class='pgnumptnts active' onclick='getvalflr(" . $x . ",". $x .")'>" . $x . "</li>"; }
					else
					{
					echo "<li id='pgptnts" . $x . "' class='pgnumptnts' onclick='getvalflr(" . $x . ",". $x .")'>" . $x . "</li>"; }
				       }
				    }
				    if($page < ($totalpages - $range))
				    { echo "<li>...</li>"; }
				    if ($page != $totalpages && $num != 0)
				    {
				       $nextpage = $page + 1;
				       echo "<li style='width:50px !important;' onclick='getvalflr(". $nextpage .", ". $nextpage .")'>Next ></li>";
				       echo "<li style='width:50px !important;' onclick='getvalflr(". $totalpages .", ". $totalpages .")'>Last >></li>";
				    }
				break;

				case 'loadentriesflr':
					if($_POST["key"] != "")
					{
						$key = "AND (floor LIKE '%".$_POST["key"]."%' OR floorid LIKE '%".$_POST["key"]."%')";
					}
					else
					{
						$key = "";
					}
  					 $sql = "SELECT COUNT(*) FROM tblref_floorsetup WHERE wingid = '".$_POST["type"]."' ".$key."";
  					 $result = mysql_query($sql, $connection);
  					 $row = mysql_fetch_array($result);
  					 $rowsperpage = 20;
  					 $totalpages = ceil($row[0] / $rowsperpage);
  					 $upto = $limit + 20;
  					 $from = $limit + 1;
  					 if($page == $totalpages && $row[0] != 0)
  					 {
  					      echo "Showing " . $from . " to " . $row[0] . " of " . $row[0] . " entries";
  					 }
  					 else
  					 {

  					      if($row[0] == 0)
  					       {
  					        echo "no data";
  					       }
  					      else if($row[0] <= 19 && $row[0] != 0)
  					       {
  					        echo "Showing 1 to " . $row[0] . " of " . $row[0] . " entries";
  					       }
  					      else if($row[0] >= 20 && $row[0] != 0)
  					       {
  					        echo "Showing " . $from . " to " . $upto . " of " . $row[0] . " entries";
  					       }

  					  }
				break;

				case 'editreffloor':
						$sql = "SELECT mallid, wingid, floor, floorid FROM tblref_floorsetup WHERE floorid = '" . $_POST["id"] . "'";
						$result = mysql_query($sql);
						$row = mysql_fetch_array($result);
						$sql2 = "select width, height, minarea from tblref_floor_lca where floorid = '" . $_POST["id"] . "'";
						$row2 = mysql_fetch_array(mysql_query($sql2));
						echo "|" . $row["mallid"] . "|" . $row["wingid"] . "|" . $row["floor"] . "|" . $row["floorid"] . "|" . $row2[0] . "|" . $row2[1] . "|" . $row2[2];
				break;

				case 'delreffloor':
						$sql = "DELETE FROM tblref_floorsetup WHERE floorid = '". $_POST["id"] ."'";
						$result = mysql_query($sql);
						if($result == true)
						{
							echo "Successfully deleted.";
						}
				break;

				case 'getbldg':
					$selectmall = "SELECT bldgnumber FROM tblref_mall WHERE mallid = '". $_POST["id"] ."'";
					$result_mall = mysql_query($selectmall, $connection);
					$row_mall = mysql_fetch_array($result_mall);

						$selectbldg = "SELECT bldgname FROM tblref_bldg WHERE bldgnumber = '". $row_mall["bldgnumber"] ."'";
						$result_bldg = mysql_query($selectbldg, $connection);
						$row_bldg = mysql_fetch_array($result_bldg);

						echo $row_bldg["bldgname"] . "|" . $row_mall["bldgnumber"];
						// echo $selectmall . "|" . $selectbldg;
				break;


				case 'savefloor':
					$datenow = getsysdate();
					if($_POST["floorid"] == "")
					{
						$selectfloor = "SELECT COUNT(*) FROM tblref_floorsetup WHERE floor = '". $_POST["floor"] ."' AND mallid = '". $_POST["mallid"] ."' AND wingid = '". $_POST["wingid"] ."'";
						$resultfloor = mysql_query($selectfloor, $connection);
						$floornum = mysql_fetch_array($resultfloor);
						if($floornum[0] == 0)
						{
							$floorid = createidno("FLOOR", "tblref_floorsetup", "floorid");
							$insertflr = "INSERT INTO tblref_floorsetup (floorid, mallid, wingid, floor) VALUES ('". $floorid ."', '". $_POST["mallid"] ."', '". $_POST["wingid"] ."', '". $_POST["floor"] ."')";
							$resultflr = mysql_query($insertflr, $connection);
							if($resultflr == true)
							{
								$sql = "INSERT INTO tblref_floor_lca(floorid, width, height, minarea, dateadded) values('" . $floorid . "', '" . $_POST["width"] . "', '" . $_POST["length"] . "', '" . $_POST["minarea"] . "', '" . $datenow . "')";
								$result = mysql_query($sql);
								echo "Successfully Added.";
							}
							else
							{
								echo "An error occured!";
							}
						}
						else
						{
							echo "Already Existing!";
						}
					}
					else
					{
						$select_floor = "SELECT floor FROM tblref_floorsetup WHERE floorid = '". $_POST["floorid"] ."' AND mallid = '". $_POST["mallid"] ."' AND wingid = '". $_POST["wingid"] ."'";
						$floorsel = mysql_query($select_floor, $connection);
						$sel = mysql_fetch_array($floorsel);
						if($sel["floor"] == $_POST["floor"])
						{
							$floorid = $_POST["floorid"];
							$insertflr = "UPDATE tblref_floorsetup SET mallid = '". $_POST["mallid"] ."', wingid = '". $_POST["wingid"] ."', floor = '". $_POST["floor"] ."' WHERE floorid = '" . $floorid . "'";
							$resultflr = mysql_query($insertflr, $connection);
							if($resultflr == true)
							{
								$getlca = "SELECT * FROM tblref_floor_lca WHERE floorid = '" . $floorid . "'";
								$lca = mysql_num_rows(mysql_query($getlca));
								$sql = "";
								if($lca > 0)
								{ $sql = "UPDATE tblref_floor_lca SET width = '" . $_POST["width"] . "', height = '" . $_POST["length"] . "', minarea = '" . $_POST["minarea"] . "', dateadded = '" . $datenow . "' WHERE floorid = '" . $floorid . "'"; }
								else
								{ $sql = "INSERT INTO tblref_floor_lca(floorid, width, height, minarea, dateadded) VALUES('" . $floorid . "', '" . $_POST["width"] . "', '" . $_POST["length"] . "', '" . $_POST["minarea"] . "', '" . $datenow . "')"; }
								$result = mysql_query($sql);
								echo "Successfully modified.";
							}
						}
						else
						{
								$selectfloor = "SELECT COUNT(*) FROM tblref_floorsetup WHERE floor = '". $_POST["floor"] ."' AND mallid = '". $_POST["mallid"] ."' AND wingid = '". $_POST["wingid"] ."'";
								$resultfloor = mysql_query($selectfloor, $connection);
								$floornum = mysql_fetch_array($resultfloor);
								if($floornum[0] == 0)
								{
									$floorid = $_POST["floorid"];
									$insertflr = "UPDATE tblref_floorsetup SET mallid = '". $_POST["mallid"] ."', wingid = '". $_POST["wingid"] ."', floor = '". $_POST["floor"] ."' WHERE floorid = '" . $floorid . "'";
									$resultflr = mysql_query($insertflr, $connection);
									if($resultflr == true)
									{
										$getlca = "SELECT * FROM tblref_floor_lca WHERE floorid = '" . $floorid . "'";
										$lca = mysql_num_rows(mysql_query($getlca));
										$sql = "";
										if($lca > 0)
										{ $sql = "UPDATE tblref_floor_lca SET width = '" . $_POST["width"] . "', height = '" . $_POST["length"] . "', minarea = '" . $_POST["minarea"] . "', dateadded = '" . $datenow . "' WHERE floorid = '" . $floorid . "'"; }
										else
										{ $sql = "INSERT INTO tblref_floor_lca(floorid, width, height, minarea, dateadded) VALUES('" . $floorid . "', '" . $_POST["width"] . "', '" . $_POST["length"] . "', '" . $_POST["minarea"] . "', '" . $datenow . "')"; }
										$result = mysql_query($sql);
										echo "Successfully modified.";
									}
								}
								else
								{
									echo "Already Existing!";
								}
							}
					}
				break;
		// ========================================================================================================================================


		// ====================================================== REFERENTIAL OF WING ============================================================
				case 'loadwing':
					$page = $_POST["page"];
					$limit = ($page-1) * 20;
					if($_POST["key"] != "")
					{
						$key = "AND wing LIKE '%".$_POST["key"]."%'";
					}
					else
					{
						$key = "";
					}
						$sql = "SELECT wingID, wing FROM tblref_wing WHERE mallID = '".$_POST["mallid"]."' ".$key." LIMIT ".$limit.", 20";
						$result = mysql_query($sql);
						while($row = mysql_fetch_array($result))
						{

								// $totalamount = floatval($row["sqmunitsetup"]) * floatval($row["pricepersqmunitsetup"]);
							echo "<tr style='width: 100%;display: table;table-layout: fixed;'>
									 <td class='scroll'>".$row["wing"]."</td>
									 <td>
										<button class='btn btn-xs btn-info' onclick='editrefwing(\"".$row["wingID"]."\")'>
											<i class='ace-icon fa fa-pencil bigger-120'></i>
										</button>

										<button class='btn btn-xs btn-danger' onclick='delrefwing(\"".$row["wingID"]."\")'>
											<i class='ace-icon fa fa-trash-o bigger-120'></i>
										</button>
									 </td>
								  </tr>";
						}
				break;

				case "loadpaginationwing":
					if($_POST["key"] != "")
					{
						$key = "AND wing LIKE '%".$_POST["key"]."%'";
					}
					else
					{
						$key = "";
					}
					$page = $_POST["page"];
					$sqlb = "SELECT COUNT(*) FROM tblref_wing WHERE mallID = '".$_POST["mallid"]."' ".$key."";
					$aa = mysql_query($sqlb, $connection);
					$nums = mysql_fetch_row($aa);
					$num = $nums[0];
					// if($num <= 20)
					// {
					// 	$page = 1
					// }
					$rowsperpage = 20;
					$range = 4;
					$totalpages = ceil($num / $rowsperpage);
					$prevpage;
					$nextpage;
					// if not on page 1, don't show back links
					if($page > 1 )
					{
					   echo "<li style='width:50px !important;' onclick='getvalwing(1)'><< First</li>";
					   $prevpage = $page - 1;
					   echo "<li style='width:70px !important;' onclick='getvalwing(". $prevpage .")'>< Previous</li>";
					}
					for($x = ($page - $range); $x < (($page + $range) + 1); $x++)
					{
					   if (($x > 0) && ($x <= $totalpages))
					   {
					      if ($x == $page)
					      {

				   	echo "<li id='pgptnts" . $x . "' class='pgnumptnts active' onclick='getvalwing(" . $x . ",". $x .")'>" . $x . "</li>"; }
					else
					{
					echo "<li id='pgptnts" . $x . "' class='pgnumptnts' onclick='getvalwing(" . $x . ",". $x .")'>" . $x . "</li>"; }
				       }
				    }
				    if($page < ($totalpages - $range))
				    { echo "<li>...</li>"; }
				    if ($page != $totalpages && $num != 0)
				    {
				       $nextpage = $page + 1;
				       echo "<li style='width:50px !important;' onclick='getvalwing(". $nextpage .", ". $nextpage .")'>Next ></li>";
				       echo "<li style='width:50px !important;' onclick='getvalwing(". $totalpages .", ". $totalpages .")'>Last >></li>";
				    }
				break;

				case 'loadentrieswing':
					if($_POST["key"] != "")
					{
						$key = "AND wing LIKE '%".$_POST["key"]."%'";
					}
					else
					{
						$key = "";
					}
  					 $sql = "SELECT COUNT(*) FROM tblref_wing WHERE mallID = '".$_POST["mallid"]."' ".$key."";
  					 $result = mysql_query($sql, $connection);
  					 $row = mysql_fetch_array($result);
  					 $rowsperpage = 20;
  					 $totalpages = ceil($row[0] / $rowsperpage);
  					 $upto = $limit + 20;
  					 $from = $limit + 1;
  					 if($page == $totalpages && $row[0] != 0)
  					 {
  					      echo "Showing " . $from . " to " . $row[0] . " of " . $row[0] . " entries";
  					 }
  					 else
  					 {

  					      if($row[0] == 0)
  					       {
  					        echo "no data";
  					       }
  					      else if($row[0] <= 19 && $row[0] != 0)
  					       {
  					        echo "Showing 1 to " . $row[0] . " of " . $row[0] . " entries";
  					       }
  					      else if($row[0] >= 20 && $row[0] != 0)
  					       {
  					        echo "Showing " . $from . " to " . $upto . " of " . $row[0] . " entries";
  					       }

  					  }
				break;

				case 'savewing':
					if($_POST["id"] == "")
					{
						$selectwing = "SELECT COUNT(*) FROM tblref_wing WHERE wing = '". $_POST["wingname"] ."'";
						$resultwing = mysql_query($selectwing, $connection);
						$wingnum = mysql_fetch_array($resultwing);
						if($wingnum[0] == 0)
						{

							$wingid = createidno("WING", "tblref_wing", "wingID");
							$insertwing = "INSERT INTO tblref_wing (wingID, wing, mallID) VALUES ('". $wingid ."', '". $_POST["wingname"] ."', '". $_POST["mallid"] ."')";
							$resultwing = mysql_query($insertwing, $connection);
							if($resultwing == true)
							{
								echo "Successfully Added.";
							}
							else
							{
								echo "An error occured!";
							}
						}
						else
						{
							echo "Already Existing!";
						}
					}
					else
					{
						$select_wing = "SELECT wing FROM tblref_wing WHERE wingID = '".$_POST["id"]."'";
						$wingsel = mysql_query($select_wing, $connection);
						$sel = mysql_fetch_array($wingsel);
						if($sel["wing"] == $_POST["wingname"])
						{
							echo "Successfully modified.";
						}
						else
						{
							$selectwing = "SELECT COUNT(*) FROM tblref_wing WHERE wing = '". $_POST["wingname"] ."'";
							$resultwing = mysql_query($selectwing, $connection);
							$wingnum = mysql_fetch_array($resultwing);
							if($wingnum[0] == 0)
							{
								$insertwing = "UPDATE tblref_wing SET wing = '". $_POST["wingname"] ."' WHERE wingID = '".$_POST["id"]."'";
								$resultwing = mysql_query($insertwing, $connection);
								if($resultwing == true)
								{
									echo "Successfully modified.";
								}
							}
							else
							{
								echo "Already Existing!";
							}
						}
					}
				break;

				case 'editrefwing':
						$sql = "SELECT wingID, wing FROM tblref_wing WHERE wingID = '". $_POST["id"] ."'";
						$result = mysql_query($sql);
						$row = mysql_fetch_array($result);


						if($result == true)
						{
							echo "|" . $row["wingID"] . "|" . $row["wing"] . "|";
						}
				break;

				case 'delrefwing':
						$sql = "DELETE FROM tblref_wing WHERE wingID = '". $_POST["id"] ."'";
						$result = mysql_query($sql);
						if($result == true)
						{
							echo "Successfully deleted.";
						}
				break;

				case 'getbldgwing':
					$selectmall = "SELECT bldgnumber FROM tblref_mall WHERE mallid = '". $_POST["id"] ."'";
					$result_mall = mysql_query($selectmall, $connection);
					$row_mall = mysql_fetch_array($result_mall);

						$selectbldg = "SELECT bldgname FROM tblref_bldg WHERE bldgnumber = '". $row_mall["bldgnumber"] ."'";
						$result_bldg = mysql_query($selectbldg, $connection);
						$row_bldg = mysql_fetch_array($result_bldg);

						echo $row_bldg["bldgname"] . "|" . $row_mall["bldgnumber"];
				break;

				case 'loadflrwing':
					$selectmall = "SELECT bldgnumber FROM tblref_mall WHERE mallid = '". $_POST["id"] ."'";
					$result_mall = mysql_query($selectmall, $connection);
					$row_mall = mysql_fetch_array($result_mall);
					echo "<option value=''>-- Select Floor --</option>";
            		$queryflr = "SELECT floor, floorid FROM tblref_floorsetup WHERE buildingid = '".$row_mall["bldgnumber"]."'";
            		$result_flr = mysql_query($queryflr, $connection);
					while($row = mysql_fetch_array($result_flr)){
						echo "<option value='".$row["floorid"]."'>".$row["floor"]."</option>";
					}
				break;

		// ========================================================================================================================================


		// ====================================================== REFERENTIAL OF UNIT ===========================================================
				case 'loadunit':
					$page = $_POST["page"];
					$limit = ($page-1) * 20;
					if($_POST["key"] != "")
					{
						$key = "AND unitname LIKE '%".$_POST["key"]."%'";
					}
					else
					{
						$key = "";
					}
				// NO FILTERING YET FOR FLOOR NAME, MALL NAME AND WING NAME
						$sql = "SELECT unitid, unitname, buildingname, typeofbusiness, classificationname, sqmunitsetup, pricepersqmunitsetup, totalamountunitsetup, floorunit, toilet, qty, status, dateadded, bldgnumber, mallid, floorid, wingid FROM tblref_unit WHERE mallid = '".$_POST["mallid"]."' ".$key." LIMIT ".$limit.", 20";
						$result = mysql_query($sql);
						while($row = mysql_fetch_array($result))
						{

								$selectfloor = "SELECT floor FROM tblref_floorsetup WHERE floorid = '". $row["floorid"] ."'";
								$result_floor = mysql_query($selectfloor, $connection);
								$row_floor = mysql_fetch_array($result_floor);

								$selectwing = "SELECT wing FROM tblref_wing WHERE wingID = '". $row["wingid"] ."'";
								$result_wing = mysql_query($selectwing, $connection);
								$row_wing = mysql_fetch_array($result_wing);

							echo "<tr style='width: 100%;display: table;table-layout: fixed;'>
									 <td class='scroll'>".$row["unitname"]."</td>
									 <td class='hide_mobile'>".$row_wing["wing"]."</td>
									 <td class='hide_mobile'>".$row_floor["floor"]."</td>

									 <td class='hide_mobile'>".$row["typeofbusiness"]."</td>
									 <td class='hide_mobile'>".$row["classificationname"]."</td>
									 <td>
										<button class='btn btn-xs btn-info' onclick='editrefunit(\"".$row["unitid"]."\")'>
											<i class='ace-icon fa fa-pencil bigger-120'></i>
										</button>

										<button class='btn btn-xs btn-danger' onclick='delrefunit(\"".$row["unitid"]."\")'>
											<i class='ace-icon fa fa-trash-o bigger-120'></i>
										</button>
									 </td>
								  </tr>";
						}

				break;

				case "loadpaginationunit":

					$page = $_POST["page"];
					if($_POST["key"] != "")
					{
						$key = "unitname LIKE '%".$_POST["key"]."%'";
					}
					else
					{
						$key = "";
					}
					$sqlb = "SELECT COUNT(*) FROM tblref_unit WHERE mallid = '".$_POST["mallid"]."' ".$key."";
					$aa = mysql_query($sqlb, $connection);
					$nums = mysql_fetch_row($aa);
					$num = $nums[0];
					// if($num <= 20)
					// {
					// 	$page = 1
					// }
					$rowsperpage = 20;
					$range = 4;
					$totalpages = ceil($num / $rowsperpage);
					$prevpage;
					$nextpage;
					// if not on page 1, don't show back links
					if($page > 1 )
					{
					   echo "<li style='width:50px !important;' onclick='getvalunit(1)'><< First</li>";
					   $prevpage = $page - 1;
					   echo "<li style='width:70px !important;' onclick='getvalunit(". $prevpage .")'>< Previous</li>";
					}
					for($x = ($page - $range); $x < (($page + $range) + 1); $x++)
					{
					   if (($x > 0) && ($x <= $totalpages))
					   {
					      if ($x == $page)
					      {

				   	echo "<li id='pgptnts" . $x . "' class='pgnumptnts active' onclick='getvalunit(" . $x . ",". $x .")'>" . $x . "</li>"; }
					else
					{
					echo "<li id='pgptnts" . $x . "' class='pgnumptnts' onclick='getvalunit(" . $x . ",". $x .")'>" . $x . "</li>"; }
				       }
				    }
				    if($page < ($totalpages - $range))
				    { echo "<li>...</li>"; }
				    if ($page != $totalpages && $num != 0)
				    {
				       $nextpage = $page + 1;
				       echo "<li style='width:50px !important;' onclick='getvalunit(". $nextpage .", ". $nextpage .")'>Next ></li>";
				       echo "<li style='width:50px !important;' onclick='getvalunit(". $totalpages .", ". $totalpages .")'>Last >></li>";
				    }
				break;

				case 'loadentriesunit':
					if($_POST["key"] != "")
					{
						$key = "unitname LIKE '%".$_POST["key"]."%'";
					}
					else
					{
						$key = "";
					}
  					 $sql = "SELECT COUNT(*) FROM tblref_unit WHERE mallid = '".$_POST["mallid"]."' ".$key."";
  					 $result = mysql_query($sql, $connection);
  					 $row = mysql_fetch_array($result);
  					 $rowsperpage = 20;
  					 $totalpages = ceil($row[0] / $rowsperpage);
  					 $upto = $limit + 20;
  					 $from = $limit + 1;
  					 if($page == $totalpages && $row[0] != 0)
  					 {
  					      echo "Showing " . $from . " to " . $row[0] . " of " . $row[0] . " entries";
  					 }
  					 else
  					 {

  					      if($row[0] == 0)
  					       {
  					        echo "no data";
  					       }
  					      else if($row[0] <= 19 && $row[0] != 0)
  					       {
  					        echo "Showing 1 to " . $row[0] . " of " . $row[0] . " entries";
  					       }
  					      else if($row[0] >= 20 && $row[0] != 0)
  					       {
  					        echo "Showing " . $from . " to " . $upto . " of " . $row[0] . " entries";
  					       }

  					  }
				break;

				case 'saveunit':
				$datenow = getsysdate();
				$selectwing = "SELECT wing FROM tblref_wing WHERE wingID = '". $_POST["wingid"] ."'";
				$result_wing = mysql_query($selectwing, $connection);
				$row_wing = mysql_fetch_array($result_wing);

					$sqlunit = "SELECT classification FROM tblref_merchandise_class WHERE classificationID = '".$_POST["classid"]."'";
					$resulrsqlunit = mysql_query($sqlunit, $connection);
					$unitclass = mysql_fetch_array($resulrsqlunit);
					if($_POST["id"] == "")
					{
						$selectwing = "SELECT COUNT(*) FROM tblref_unit WHERE unitname = '". $_POST["unitname"] ."' AND mallid = '".$_POST["mallid"]."' AND wingid = '". $_POST["wingid"] ."' AND floorid = '".$_POST["flrid"]."'";
						$resultwing = mysql_query($selectwing, $connection);
						$wingnum = mysql_fetch_array($resultwing);
						if($wingnum[0] == 0)
						{
							$ttlsqm = floatval($_POST["sqm_width"]) * floatval($_POST["sqm_height"]);
							$total = $ttlsqm * floatval($_POST["pricepersqm"]);
							$unitid = createidno("U", "tblref_unit", "unitid");
							$insertwing = "INSERT INTO tblref_unit (unitid, unitname, buildingname, typeofbusiness, classificationname, sqmunitsetup, pricepersqmunitsetup, totalamountunitsetup, floorunit, status, dateadded, bldgnumber, mallid, floorid, wingid, classid, bussid, depid, catid, sqm_width, sqm_height, assocdues) VALUES ('". $unitid ."', '". $_POST["unitname"] ."', '". $row_wing["wing"] ."', '". $_POST["bustype"] ."', '". $unitclass["classification"] ."', '". $ttlsqm ."', '". $_POST["pricepersqm"] ."', '". $total ."', '". $_POST["flrid"] ."', 'vacant', '". $datenow ."', '". $_POST["wingid"] ."', '". $_POST["mallid"] ."', '". $_POST["flrid"] ."', '". $_POST["wingid"] ."', '".$_POST["classid"]."', '', '".$_POST["depid"]."', '".$_POST["catid"]."', '".$_POST["sqm_width"]."', '".$_POST["sqm_height"]."', '". $_POST['assocdues'] ."')";
							$resultwing = mysql_query($insertwing, $connection);
							if($resultwing == true)
							{
								// $selectlogs = "SELECT COUNT(*) FROM tblunit_statuslogs WHERE unitid = '".$inq["UnitID"]."' AND xdate = '".$datenow."'";
								// $resultlogs = mysql_query($selectlogs, $connection);
								// $logs = mysql_fetch_array($resultlogs);
								// if($logs[0] == 0)
								// {
									$insert_logs = "INSERT INTO tblunit_statuslogs (unitid, unitname, xdate, xtime, status)VALUES('".$unitid."', '".$_POST["unitname"]."', '".$datenow."', '".date("h-i-s")."', 'vacant')";
									$result_logs = mysql_query($insert_logs);
								// }
								// else
								// {
								// 	$insert_logs = "UPDATE tblunit_statuslogs SET status = 'occupied' WHERE unitid = '".$inq["UnitID"]."' AND xdate = '".$datenow."'";
								// 	$result_logs = mysql_query($insert_logs);
								// }

								$amenities = explode("#", $_POST["amenities"]);
								for($i=1; $i<=count($amenities)-1; $i++)
								{
									$arr = explode("|", $amenities[$i]);
									$sqlinsert = "INSERT INTO tblref_unit_amenities (unitID, unit, amenitiesID, amenities)VALUES('".$unitid."', '".$_POST["unitname"]."', '".$arr[0]."', '".$arr[1]."')";
									$resinsert = mysql_query($sqlinsert, $connection);
								}

								echo "Successfully Added.";
							}
							else
							{
								echo "An error occured!";
							}
						}
						else
						{
							echo "Already Existing!";
						}
					}
					else
					{
						$ttlsqm = floatval($_POST["sqm_width"]) * floatval($_POST["sqm_height"]);
						$total = $ttlsqm * floatval($_POST["pricepersqm"]);

						$selectunit2 = "SELECT unitname FROM tblref_unit WHERE unitid = '".$_POST["id"]."' AND mallid = '".$_POST["mallid"]."' AND wingid = '". $_POST["wingid"] ."' AND floorid = '".$_POST["flrid"]."'";
						$resultunit2 = mysql_query($selectunit2, $connection);
						$unit2 = mysql_fetch_array($resultunit2);
						if($unit2["unitname"] == $_POST["unitname"])
						{
							$insertwing = "UPDATE tblref_unit SET unitname = '".$_POST["unitname"]."', buildingname = '".$row_wing["wing"]."', typeofbusiness = '". $_POST["bustype"] ."', classificationname = '". $unitclass["classification"] ."', sqmunitsetup = '".$ttlsqm."', pricepersqmunitsetup = '".$_POST["pricepersqm"]."', totalamountunitsetup = '".$total."', floorunit = '".$_POST["flrid"]."', bldgnumber = '".$_POST["wingid"]."', mallid = '".$_POST["mallid"]."', floorid = '".$_POST["flrid"]."', wingid = '".$_POST["wingid"]."', classid = '".$_POST["classid"]."', bussid = '', depid = '".$_POST["depid"]."', catid = '".$_POST["catid"]."', sqm_width='".$_POST["sqm_width"]."', sqm_height='".$_POST["sqm_height"]."', assocdues = '". $_POST['assocdues'] ."' WHERE unitid = '".$_POST["id"]."'";
							$resultwing = mysql_query($insertwing, $connection);
							if($resultwing == true)
							{
								echo "Successfully modified.";

								$sqldel = "DELETE FROM tblref_unit_amenities WHERE unitID = '".$_POST["id"]."'";
								$resdel = mysql_query($sqldel, $connection);

								$amenities = explode("#", $_POST["amenities"]);
								for($i=1; $i<=count($amenities)-1; $i++)
								{
									$arr = explode("|", $amenities[$i]);
									$sqlinsert = "INSERT INTO tblref_unit_amenities (unitID, unit, amenitiesID, amenities)VALUES('".$_POST["id"]."', '".$_POST["unitname"]."', '".$arr[0]."', '".$arr[1]."')";
									$resinsert = mysql_query($sqlinsert, $connection);
								}
							}
						}
						else
						{
							$selectwing = "SELECT COUNT(*) FROM tblref_unit WHERE unitname = '". $_POST["unitname"] ."' AND mallid = '".$_POST["mallid"]."' AND wingid = '". $_POST["wingid"] ."' AND floorid = '".$_POST["flrid"]."'";
							$resultwing = mysql_query($selectwing, $connection);
							$wingnum = mysql_fetch_array($resultwing);
							if($wingnum[0] == 0)
							{
								$insertwing = "UPDATE tblref_unit SET unitname = '".$_POST["unitname"]."', buildingname = '".$row_wing["wing"]."', typeofbusiness = '". $_POST["bustype"] ."', classificationname = '". $unitclass["classification"] ."', sqmunitsetup = '".$ttlsqm."', pricepersqmunitsetup = '".$_POST["pricepersqm"]."', totalamountunitsetup = '".$total."', floorunit = '".$_POST["flrid"]."', bldgnumber = '".$_POST["wingid"]."', mallid = '".$_POST["mallid"]."', floorid = '".$_POST["flrid"]."', wingid = '".$_POST["wingid"]."', classid = '".$_POST["classid"]."', bussid = '', depid = '".$_POST["depid"]."', catid = '".$_POST["catid"]."', sqm_width='".$_POST["sqm_width"]."', sqm_height='".$_POST["sqm_height"]."', assocdues = '". $_POST['assocdues'] ."' WHERE unitid = '".$_POST["id"]."'";
								$resultwing = mysql_query($insertwing, $connection);
								if($resultwing == true)
								{
									echo "Successfully modified.";

									$sqldel = "DELETE FROM tblref_unit_amenities WHERE unitID = '".$_POST["id"]."'";
									$resdel = mysql_query($sqldel, $connection);

									$amenities = explode("#", $_POST["amenities"]);
									for($i=1; $i<=count($amenities)-1; $i++)
									{
										$arr = explode("|", $amenities[$i]);
										$sqlinsert = "INSERT INTO tblref_unit_amenities (unitID, unit, amenitiesID, amenities)VALUES('".$_POST["id"]."', '".$_POST["unitname"]."', '".$arr[0]."', '".$arr[1]."')";
										$resinsert = mysql_query($sqlinsert, $connection);
									}
								}
							}
							else
							{
								echo $selectwing;
							}
						}
					}
				break;

				case 'editrefunit':
						$sql = "SELECT unitname, buildingname, typeofbusiness, classificationname, sqmunitsetup, pricepersqmunitsetup, totalamountunitsetup, floorunit, toilet, qty, status, bldgnumber, mallid, floorid, wingid, classid, unitid, sqm_width, sqm_height, depid, catid FROM tblref_unit WHERE unitid = '". $_POST["id"] ."'";
						$result = mysql_query($sql);
						$row = mysql_fetch_array($result);

							$selectbldg = "SELECT bldgname FROM tblref_bldg WHERE bldgnumber = '". $row["bldgnumber"] ."'";
							$result_bldg = mysql_query($selectbldg, $connection);
							$row_bldg = mysql_fetch_array($result_bldg);

								$selectmall = "SELECT mallname FROM tblref_mall WHERE mallid = '". $row["mallid"] ."'";
								$result_mall = mysql_query($selectmall, $connection);
								$row_mall = mysql_fetch_array($result_mall);

								$selectfloor = "SELECT floor FROM tblref_floorsetup WHERE floorid = '". $row["floorid"] ."'";
								$result_floor = mysql_query($selectfloor, $connection);
								$row_floor = mysql_fetch_array($result_floor);

								$selectwing = "SELECT wing FROM tblref_wing WHERE wingID = '". $row["wingid"] ."'";
								$result_wing = mysql_query($selectwing, $connection);
								$row_wing = mysql_fetch_array($result_wing);

								$selectclass = "SELECT classname FROM tblref_classification WHERE classificationid = '". $row["classid"] ."'";
								$result_class = mysql_query($selectclass, $connection);
								$row_class = mysql_fetch_array($result_class);

							echo $row["unitname"] ."|". $row["buildingname"] ."|". $row["typeofbusiness"] ."|". $row["classificationname"] ."|". $row["sqmunitsetup"] ."|". $row["pricepersqmunitsetup"] ."|". $row["totalamountunitsetup"] ."|". $row["floorunit"] ."|". $row["toilet"] ."|". $row["qty"] ."|". $row["status"] ."|". $row["bldgnumber"] ."|". $row["mallid"] ."|". $row["floorid"] ."|". $row["wingid"] ."|". $row["classid"] ."|". $row["unitid"] . "|" . $row_bldg["bldgname"] ."|". $row_mall["mallname"] ."|". $row_floor["floor"] ."|". $row_wing["wing"] ."|". $row_class["classname"] . "|". $row["sqm_width"]."|".$row["sqm_height"]."|".$row["catid"]."|".$row["depid"]."|";
				break;

				case 'editrefunitamenities':
						$sql = "SELECT amenitiesID, amenities FROM tblref_unit_amenities WHERE unitID = '". $_POST["id"] ."'";
						$result = mysql_query($sql);
						while($row = mysql_fetch_array($result))
						{
							$sel = "SELECT amenitiesname FROM tblref_amenities WHERE amenitiesid = '".$row["amenitiesID"]."'";
							$res = mysql_query($sel, $connection);
							$get = mysql_fetch_array($res);

							echo "<span class='tag tagval_".$row["amenitiesID"]."' id='span_".$row["amenitiesID"]."'> ".$get["amenitiesname"]."<button type='button' class='close'>×</button><input type='hidden' value='".$row["amenities"]."' class='qty_amenities'><input type='hidden' value='".$row["amenitiesID"]."' class='chosen_amenities'></span>";
						}
						echo '<br /><label style="width: 100%;" onclick="addnewrefamenities()">Click to add amenities ..</label>';

				break;

				case 'delrefunit':
						$sql = "DELETE FROM tblref_unit WHERE unitid = '". $_POST["id"] ."'";
						$result = mysql_query($sql);
						if($result == true)
						{
							echo "Successfully deleted.";
						}
				break;

				case 'getbldgwing':
					$selectmall = "SELECT bldgnumber FROM tblref_mall WHERE mallid = '". $_POST["id"] ."'";
					$result_mall = mysql_query($selectmall, $connection);
					$row_mall = mysql_fetch_array($result_mall);

						$selectbldg = "SELECT bldgname FROM tblref_bldg WHERE bldgnumber = '". $row_mall["bldgnumber"] ."'";
						$result_bldg = mysql_query($selectbldg, $connection);
						$row_bldg = mysql_fetch_array($result_bldg);

						echo $row_bldg["bldgname"] . "|" . $row_mall["bldgnumber"];
				break;

				case 'loadwingflr':
					echo '<option value="">-- Select Wing --</option>';
					$queryflr = "SELECT wing, wingID FROM tblref_wing WHERE floorID = '".$_POST["id"]."'";
            		$result_flr = mysql_query($queryflr, $connection);
					while($row = mysql_fetch_array($result_flr)){
						echo "<option value='".$row["wingID"]."'>".$row["wing"]."</option>";
					}
				break;

				case 'loadotherinfo':
					$selectinfo = "SELECT businesstype, businessid, counter, pricepersqm, sqm FROM tblref_classification WHERE classificationid = '". $_POST["id"] ."'";
					$result_info = mysql_query($selectinfo, $connection);
					$info = mysql_fetch_array($result_info);

						echo $info["businesstype"] . "|" . $info["businessid"] . "|" . $info["counter"] . "|" . $info["pricepersqm"] . "|" . $info["sqm"];
				break;

		// ========================================================================================================================================


		// ================================================= REFERENTIAL OF BUSINESS TYPE ========================================================
				case 'loadbusinesstype':
					$page = $_POST["page"];
					$limit = ($page-1) * 20;
						$sql = "SELECT businessid, typeofbusiness FROM tblref_typeofbusiness WHERE typeofbusiness != '' OR typeofbusiness LIKE '%".$_POST["key"]."%' LIMIT ".$limit.", 20";
						$result = mysql_query($sql);
						while($row = mysql_fetch_array($result))
						{
							echo "<tr style='width: 100%;display: table;table-layout: fixed;'>
									 <td class='scroll'>".$row["typeofbusiness"]."</td>
									 <td>
										<button class='btn btn-xs btn-info' onclick='editrefbustype(\"".$row["businessid"]."\")'>
											<i class='ace-icon fa fa-pencil bigger-120'></i>
										</button>

										<button class='btn btn-xs btn-danger' onclick='delrefbustype(\"".$row["businessid"]."\")'>
											<i class='ace-icon fa fa-trash-o bigger-120'></i>
										</button>
									 </td>
								  </tr>";
						}

				break;

				case "loadpaginationbusiness":

					$page = $_POST["page"];
					$sqlb = "SELECT COUNT(*) FROM tblref_bldg";
					$aa = mysql_query($sqlb, $connection);
					$nums = mysql_fetch_row($aa);
					$num = $nums[0];
					// if($num <= 20)
					// {
					// 	$page = 1
					// }
					$rowsperpage = 20;
					$range = 4;
					$totalpages = ceil($num / $rowsperpage);
					$prevpage;
					$nextpage;
					// if not on page 1, don't show back links
					if($page > 1 )
					{
					   echo "<li style='width:50px !important;' onclick='getvalbusi(1)'><< First</li>";
					   $prevpage = $page - 1;
					   echo "<li style='width:70px !important;' onclick='getvalbusi(". $prevpage .")'>< Previous</li>";
					}
					for($x = ($page - $range); $x < (($page + $range) + 1); $x++)
					{
					   if (($x > 0) && ($x <= $totalpages))
					   {
					      if ($x == $page)
					      {

				   	echo "<li id='pgptnts" . $x . "' class='pgnumptnts active' onclick='getvalbusi(" . $x . ",". $x .")'>" . $x . "</li>"; }
					else
					{
					echo "<li id='pgptnts" . $x . "' class='pgnumptnts' onclick='getvalbusi(" . $x . ",". $x .")'>" . $x . "</li>"; }
				       }
				    }
				    if($page < ($totalpages - $range))
				    { echo "<li>...</li>"; }
				    if ($page != $totalpages && $num != 0)
				    {
				       $nextpage = $page + 1;
				       echo "<li style='width:50px !important;' onclick='getvalbusi(". $nextpage .", ". $nextpage .")'>Next ></li>";
				       echo "<li style='width:50px !important;' onclick='getvalbusi(". $totalpages .", ". $totalpages .")'>Last >></li>";
				    }
				break;

				case 'loadentriebusiness':
  					 $sql = "SELECT COUNT(*) FROM tblref_bldg";
  					 $result = mysql_query($sql, $connection);
  					 $row = mysql_fetch_array($result);
  					 $rowsperpage = 20;
  					 $totalpages = ceil($row[0] / $rowsperpage);
  					 $upto = $limit + 20;
  					 $from = $limit + 1;
  					 if($page == $totalpages && $row[0] != 0)
  					 {
  					      echo "Showing " . $from . " to " . $row[0] . " of " . $row[0] . " entries";
  					 }
  					 else
  					 {

  					      if($row[0] == 0)
  					       {
  					        echo "no data";
  					       }
  					      else if($row[0] <= 19 && $row[0] != 0)
  					       {
  					        echo "Showing 1 to " . $row[0] . " of " . $row[0] . " entries";
  					       }
  					      else if($row[0] >= 20 && $row[0] != 0)
  					       {
  					        echo "Showing " . $from . " to " . $upto . " of " . $row[0] . " entries";
  					       }

  					  }
				break;

				case 'savebustype':
				$datenow = getsysdate();
					if($_POST["id"] == "")
					{
						$selectbustypr = "SELECT COUNT(*) FROM tblref_typeofbusiness WHERE typeofbusiness = '". $_POST["type"] ."'";
						$resultbustype = mysql_query($selectbustypr, $connection);
						$wingbustype = mysql_fetch_array($resultbustype);
						if($wingbustype[0] == 0)
						{

							$businessid = createidno("B", "tblref_typeofbusiness", "businessid");
							$insertbustype = "INSERT INTO tblref_typeofbusiness (businessid, typeofbusiness, dateadded) VALUES ('". $businessid ."', '". $_POST["type"] ."', '".$datenow."')";
							$resultbustype = mysql_query($insertbustype, $connection);
							if($resultbustype == true)
							{
								echo "Successfully Added.";
							}
							else
							{
								echo "An error occured!";
							}
						}
						else
						{
							echo "Already Existing!";
						}
					}
					else
					{
						$insertbustype = "UPDATE tblref_typeofbusiness SET typeofbusiness = '". $_POST["type"] ."' WHERE businessid = '".$_POST["id"]."'";
						$resultbustype = mysql_query($insertbustype, $connection);
						if($resultbustype == true)
						{
							echo "Successfully modified.";
						}
					}
				break;

				case 'editrefbustype':
					$selectinfo = "SELECT businessid, typeofbusiness FROM tblref_typeofbusiness WHERE businessid = '". $_POST["id"] ."'";
					$result_info = mysql_query($selectinfo, $connection);
					$info = mysql_fetch_array($result_info);

						echo $info["businessid"] . "|" . $info["typeofbusiness"];
				break;

				case 'delrefbustype':
						$sql = "DELETE FROM tblref_typeofbusiness WHERE businessid = '". $_POST["id"] ."'";
						$result = mysql_query($sql);
						if($result == true)
						{
							echo "Successfully deleted.";
						}
				break;
		// ========================================================================================================================================


		// ================================================= REFERENTIAL OF CLASSIFICATION =======================================================
				case 'loadclassification':
				$page = $_POST["page"];
				$limit = ($page-1) * 20;
					$selectclass = "SELECT classname, businesstype, counter, pricepersqm, sqm, totalprice, classificationid FROM tblref_classification WHERE classname LIKE '%". $_POST["key"] ."%' LIMIT ".$limit.", 20";
					$result_class = mysql_query($selectclass, $connection);
					while($row_class = mysql_fetch_array($result_class))
					{
						echo "<tr style='width: 100%;display: table;table-layout: fixed;'>";
						echo "<td class='scroll'>". $row_class["classname"] ."</td>";
						echo "<td class='scroll'>". $row_class["businesstype"] ."</td>";
						echo "<td class='hide_mobile'>". $row_class["counter"] ."</td>";
						echo "<td class='hide_mobile'>". $row_class["sqm"] ."</td>";
						echo "<td class='hide_mobile' style='text-align:right;'>". number_format($row_class["pricepersqm"], 2, '.', ',') ."</td>";
						echo "<td class='hide_mobile' style='text-align:right;'>". number_format($row_class["totalprice"], 2, '.', ',') ."</td>";
						echo "<td>
								<button class='btn btn-xs btn-info' onclick='editrefclass(\"".$row_class["classificationid"]."\")'>
									<i class='ace-icon fa fa-pencil bigger-120'></i>
								</button>

								<button class='btn btn-xs btn-danger' onclick='delrefclass(\"".$row_class["classificationid"]."\")'>
									<i class='ace-icon fa fa-trash-o bigger-120'></i>
								</button>
							  </td>";
						echo "</tr>";
					}

				break;

				case "loadpaginatioclass":

					$page = $_POST["page"];
					$sqlb = "SELECT COUNT(*) FROM tblref_classification WHERE classname LIKE '%". $_POST["key"] ."%'";
					$aa = mysql_query($sqlb, $connection);
					$nums = mysql_fetch_row($aa);
					$num = $nums[0];
					// if($num <= 20)
					// {
					// 	$page = 1
					// }
					$rowsperpage = 20;
					$range = 4;
					$totalpages = ceil($num / $rowsperpage);
					$prevpage;
					$nextpage;
					// if not on page 1, don't show back links
					if($page > 1 )
					{
					   echo "<li style='width:50px !important;' onclick='getvalclass(1)'><< First</li>";
					   $prevpage = $page - 1;
					   echo "<li style='width:70px !important;' onclick='getvalclass(". $prevpage .")'>< Previous</li>";
					}
					for($x = ($page - $range); $x < (($page + $range) + 1); $x++)
					{
					   if (($x > 0) && ($x <= $totalpages))
					   {
					      if ($x == $page)
					      {

				   	echo "<li id='pgptnts" . $x . "' class='pgnumptnts active' onclick='getvalclass(" . $x . ",". $x .")'>" . $x . "</li>"; }
					else
					{
					echo "<li id='pgptnts" . $x . "' class='pgnumptnts' onclick='getvalclass(" . $x . ",". $x .")'>" . $x . "</li>"; }
				       }
				    }
				    if($page < ($totalpages - $range))
				    { echo "<li>...</li>"; }
				    if ($page != $totalpages && $num != 0)
				    {
				       $nextpage = $page + 1;
				       echo "<li style='width:50px !important;' onclick='getvalclass(". $nextpage .", ". $nextpage .")'>Next ></li>";
				       echo "<li style='width:50px !important;' onclick='getvalclass(". $totalpages .", ". $totalpages .")'>Last >></li>";
				    }
				break;

				case 'loadentriesclass':
  					 $sql = "SELECT COUNT(*) FROM tblref_classification WHERE classname LIKE '%". $_POST["key"] ."%'";
  					 $result = mysql_query($sql, $connection);
  					 $row = mysql_fetch_array($result);
  					 $rowsperpage = 20;
  					 $totalpages = ceil($row[0] / $rowsperpage);
  					 $upto = $limit + 20;
  					 $from = $limit + 1;
  					 if($page == $totalpages && $row[0] != 0)
  					 {
  					      echo "Showing " . $from . " to " . $row[0] . " of " . $row[0] . " entries";
  					 }
  					 else
  					 {

  					      if($row[0] == 0)
  					       {
  					        echo "no data";
  					       }
  					      else if($row[0] <= 19 && $row[0] != 0)
  					       {
  					        echo "Showing 1 to " . $row[0] . " of " . $row[0] . " entries";
  					       }
  					      else if($row[0] >= 20 && $row[0] != 0)
  					       {
  					        echo "Showing " . $from . " to " . $upto . " of " . $row[0] . " entries";
  					       }

  					  }
				break;

				case 'saveclassification':
				if($_POST["id"] == "")
				{
					$selectfloor = "SELECT COUNT(*) FROM tblref_classification WHERE classname = '". $_POST["classification"] ."' AND businessid = '". $_POST["bussid"] ."'";
					$resultfloor = mysql_query($selectfloor, $connection);
					$floornum = mysql_fetch_array($resultfloor);
					if($floornum[0] == 0)
					{
						$pricepersqm = floatval($_POST["pricepersqm"]);
						$sqm = floatval($_POST["sqm"]);
						$totalamt = $pricepersqm * $sqm;

						$classid = createidno("CLASS", "tblref_classification", "classificationid");
						$insertclass = "INSERT INTO tblref_classification (classificationid, classname, businesstype, businessid, counter, pricepersqm, sqm, totalprice) VALUES ('". $classid ."', '". $_POST["classification"] ."', '". $_POST["bussname"] ."', '". $_POST["bussid"] ."', '". $_POST["counter"] ."', '". $_POST["pricepersqm"] ."', '". $_POST["sqm"] ."', '". $totalamt ."')";
						$resultclass = mysql_query($insertclass, $connection);
						if($resultclass == true)
						{
							echo "Successfully Added.";
						}
						else
						{
							echo "An error occured!";
						}
					}
					else
					{
						echo "Already Existing!";
					}
				}
				else
				{
					$pricepersqm = floatval($_POST["pricepersqm"]);
					$sqm = floatval($_POST["sqm"]);
					$totalamt = $pricepersqm * $sqm;

					$insertclass = "UPDATE tblref_classification SET classname = '". $_POST["classification"] ."', businesstype = '". $_POST["bussname"] ."', businessid = '". $_POST["bussid"] ."', counter = '". $_POST["counter"] ."', pricepersqm = '". $_POST["pricepersqm"] ."', sqm = '". $_POST["sqm"] ."', totalprice = '". $totalamt ."' WHERE classificationid = '".$_POST["id"]."'";
					$resultclass = mysql_query($insertclass, $connection);
					if($resultclass == true)
					{
						echo "Successfully modified.";
					}
				}
				break;

				case 'editrefclass':
						$sql = "SELECT classificationid, classname, businesstype, businessid, counter, pricepersqm, sqm, totalprice FROM tblref_classification WHERE classificationid = '". $_POST["id"] ."'";
						$result = mysql_query($sql);
						$row = mysql_fetch_array($result);

						if($result == true)
						{
							echo "|" . $row["classificationid"] . "|" . $row["classname"] . "|" . $row["businesstype"] . "|" . $row["businessid"] . "|" . $row["counter"] . "|" . $row["pricepersqm"] . "|" . $row["sqm"] . "|" . $row["totalprice"];
						}
				break;

				case 'delrefclass':
						$sql = "DELETE FROM tblref_classification WHERE classificationid = '". $_POST["id"] ."'";
						$result = mysql_query($sql);
						if($result == true)
						{
							echo "Successfully deleted.";
						}
				break;
		// ========================================================================================================================================


		// ================================================= REFERENTIAL OF AMENITIES ==========================================================
				case 'loadamenities':
				$page = $_POST["page"];
				$limit = ($page-1) * 20;

				$sql = "SELECT amenitiesname, abbreviation, amenitiesid FROM  tblref_amenities where amenitiesname LIKE '%". $_POST["key"] ."%' LIMIT ".$limit.", 20";
				$result = mysql_query($sql);
				while($row = mysql_fetch_array($result))
				{
				  echo "<tr style='width: 100%;display: table;table-layout: fixed;'>
							<td class='scroll'>" . $row["amenitiesname"] . "</td>
							<td>" . $row["abbreviation"] . "</td>
							<td>
								<button class='btn btn-xs btn-info' onclick='editrefame(\"".$row["amenitiesid"]."\")'>
									<i class='ace-icon fa fa-pencil bigger-120'></i>
								</button>

								<button class='btn btn-xs btn-danger' onclick='delrefame(\"".$row["amenitiesid"]."\")'>
									<i class='ace-icon fa fa-trash-o bigger-120'></i>
								</button>
							 </td>
						</tr>";
				}
				break;

				case "loadpaginationamenities":

					$page = $_POST["page"];
					$sqlb = "SELECT COUNT(*) FROM  tblref_amenities where amenitiesname LIKE '%". $_POST["key"] ."%'";
					$aa = mysql_query($sqlb, $connection);
					$nums = mysql_fetch_row($aa);
					$num = $nums[0];
					// if($num <= 20)
					// {
					// 	$page = 1
					// }
					$rowsperpage = 20;
					$range = 4;
					$totalpages = ceil($num / $rowsperpage);
					$prevpage;
					$nextpage;
					// if not on page 1, don't show back links
					if($page > 1 )
					{
					   echo "<li style='width:50px !important;' onclick='getvalame(1)'><< First</li>";
					   $prevpage = $page - 1;
					   echo "<li style='width:70px !important;' onclick='getvalame(". $prevpage .")'>< Previous</li>";
					}
					for($x = ($page - $range); $x < (($page + $range) + 1); $x++)
					{
					   if (($x > 0) && ($x <= $totalpages))
					   {
					      if ($x == $page)
					      {

				   	echo "<li id='pgptnts" . $x . "' class='pgnumptnts active' onclick='getvalame(" . $x . ",". $x .")'>" . $x . "</li>"; }
					else
					{
					echo "<li id='pgptnts" . $x . "' class='pgnumptnts' onclick='getvalame(" . $x . ",". $x .")'>" . $x . "</li>"; }
				       }
				    }
				    if($page < ($totalpages - $range))
				    { echo "<li>...</li>"; }
				    if ($page != $totalpages && $num != 0)
				    {
				       $nextpage = $page + 1;
				       echo "<li style='width:50px !important;' onclick='getvalame(". $nextpage .", ". $nextpage .")'>Next ></li>";
				       echo "<li style='width:50px !important;' onclick='getvalame(". $totalpages .", ". $totalpages .")'>Last >></li>";
				    }
				break;

				case 'loadentriesame':
  					 $sql = "SELECT COUNT(*) FROM  tblref_amenities where amenitiesname LIKE '%". $_POST["key"] ."%'";
  					 $result = mysql_query($sql, $connection);
  					 $row = mysql_fetch_array($result);
  					 $rowsperpage = 20;
  					 $totalpages = ceil($row[0] / $rowsperpage);
  					 $upto = $limit + 20;
  					 $from = $limit + 1;
  					 if($page == $totalpages && $row[0] != 0)
  					 {
  					      echo "Showing " . $from . " to " . $row[0] . " of " . $row[0] . " entries";
  					 }
  					 else
  					 {

  					      if($row[0] == 0)
  					       {
  					        echo "no data";
  					       }
  					      else if($row[0] <= 19 && $row[0] != 0)
  					       {
  					        echo "Showing 1 to " . $row[0] . " of " . $row[0] . " entries";
  					       }
  					      else if($row[0] >= 20 && $row[0] != 0)
  					       {
  					        echo "Showing " . $from . " to " . $upto . " of " . $row[0] . " entries";
  					       }

  					  }
				break;


				case 'editrefame':
						$sql = "SELECT amenitiesid, amenitiesname, abbreviation FROM tblref_amenities WHERE amenitiesid = '". $_POST["id"] ."'";
						$result = mysql_query($sql);
						$row = mysql_fetch_array($result);

						if($result == true)
						{
							echo "|" . $row["amenitiesid"] . "|" . $row["amenitiesname"] . "|" . $row["abbreviation"];
						}
				break;

				case 'delrefame':
						$sql = "DELETE FROM tblref_amenities WHERE amenitiesid = '". $_POST["id"] ."'";
						$result = mysql_query($sql);
						if($result == true)
						{
							echo "Successfully deleted.";
						}

				break;

				case 'saveamenities':
					if($_POST["id"] == "")
					{
						$selectame = "SELECT COUNT(*) FROM tblref_amenities WHERE amenitiesname = '". $_POST["amenity"] ."' AND abbreviation = '". $_POST["abbreviation"] ."'";
						$resultame = mysql_query($selectame, $connection);
						$amenum = mysql_fetch_array($resultame);
						if($amenum[0] == 0)
						{

							$amenityid = createidno("A", "tblref_amenities", "amenitiesid");
							$insertame = "INSERT INTO tblref_amenities (amenitiesid, amenitiesname, abbreviation) VALUES ('". $amenityid ."', '". $_POST["amenity"] ."', '". $_POST["abbreviation"] ."')";
							$resultame = mysql_query($insertame, $connection);
							if($resultame == true)
							{
								echo "Successfully Added.";
							}
							else
							{
								echo "An error occured!";
							}
						}
						else
						{
							echo "Already Existing!";
						}
					}
					else
					{

						$insertame = "UPDATE tblref_amenities SET amenitiesname = '". $_POST["amenity"] ."', abbreviation = '". $_POST["abbreviation"] ."' WHERE amenitiesid = '".$_POST["id"]."'";
						$resultame = mysql_query($insertame, $connection);
						if($resultame == true)
						{
							echo "Successfully modified.";
						}
					}
				break;
		// ========================================================================================================================================


		// ================================================= REFERENTIAL OF BUILDING =============================================================

				case 'bldginventory':
				$page = $_POST["page"];
				$limit = ($page-1) * 20;
					$sql = "SELECT multiunit, bldgnumber, bldgtype, bldgname, bldgabb, nooffloors, noofrooms, address, city, province, zipcode, fulladdress, mallname FROM tblref_bldg LIMIT ".$limit.", 20";
					$result = mysql_query($sql, $connection);
					while ($row = mysql_fetch_array($result)) {
						echo "
							<tr onclick='selectbldg(\"". $row[0] ."\", \"". $row[1] ."\", \"". $row[2] ."\", \"". $row[3] ."\", \"". $row[4] ."\", \"". $row[5] ."\", \"". $row[6] ."\", \"". $row[7] ."\", \"". $row[8] ."\", \"". $row[9] ."\", \"". $row[10] ."\", \"". $row[11] ."\")' style='width: 100%;display: table;table-layout: fixed;'>
								<td class='scroll'>" . $row[2] . "</td>
								<td class='scroll'>" . $row[3] . "</td>
								<td class='hide_mobile'>" . $row[5] . "</td>
								<td class='hide_mobile'>" . $row[6] . "</td>
								<td class='hide_mobile' style='text-align: justify;'>" . $row[11] . "</td>
								<td class='hide_mobile'>" . $row[12] . "</td>
								<td>
								<button class='btn btn-xs btn-info' onclick='editrefame(\"".$row["amenitiesid"]."\")'>
									<i class='ace-icon fa fa-pencil bigger-120'></i>
								</button>

								<button class='btn btn-xs btn-danger' onclick='delrefame(\"".$row["amenitiesid"]."\")'>
									<i class='ace-icon fa fa-trash-o bigger-120'></i>
								</button>
							 </td>
							</tr>
						";
					}
				break;

				case "loadpaginationbldg":

					$page = $_POST["page"];
					$sqlb = "SELECT COUNT(*) FROM tblref_bldg";
					$aa = mysql_query($sqlb, $connection);
					$nums = mysql_fetch_row($aa);
					$num = $nums[0];
					// if($num <= 20)
					// {
					// 	$page = 1
					// }
					$rowsperpage = 20;
					$range = 4;
					$totalpages = ceil($num / $rowsperpage);
					$prevpage;
					$nextpage;
					// if not on page 1, don't show back links
					if($page > 1 )
					{
					   echo "<li style='width:50px !important;' onclick='getvalbldg(1)'><< First</li>";
					   $prevpage = $page - 1;
					   echo "<li style='width:70px !important;' onclick='getvalbldg(". $prevpage .")'>< Previous</li>";
					}
					for($x = ($page - $range); $x < (($page + $range) + 1); $x++)
					{
					   if (($x > 0) && ($x <= $totalpages))
					   {
					      if ($x == $page)
					      {

				   	echo "<li id='pgptnts" . $x . "' class='pgnumptnts active' onclick='getvalbldg(" . $x . ",". $x .")'>" . $x . "</li>"; }
					else
					{
					echo "<li id='pgptnts" . $x . "' class='pgnumptnts' onclick='getvalbldg(" . $x . ",". $x .")'>" . $x . "</li>"; }
				       }
				    }
				    if($page < ($totalpages - $range))
				    { echo "<li>...</li>"; }
				    if ($page != $totalpages && $num != 0)
				    {
				       $nextpage = $page + 1;
				       echo "<li style='width:50px !important;' onclick='getvalbldg(". $nextpage .", ". $nextpage .")'>Next ></li>";
				       echo "<li style='width:50px !important;' onclick='getvalbldg(". $totalpages .", ". $totalpages .")'>Last >></li>";
				    }
				break;

				case 'loadentriesbldg':
  					 $sql = "SELECT COUNT(*) FROM tblref_bldg";
  					 $result = mysql_query($sql, $connection);
  					 $row = mysql_fetch_array($result);
  					 $rowsperpage = 20;
  					 $totalpages = ceil($row[0] / $rowsperpage);
  					 $upto = $limit + 20;
  					 $from = $limit + 1;
  					 if($page == $totalpages && $row[0] != 0)
  					 {
  					      echo "Showing " . $from . " to " . $row[0] . " of " . $row[0] . " entries";
  					 }
  					 else
  					 {

  					      if($row[0] == 0)
  					       {
  					        echo "no data";
  					       }
  					      else if($row[0] <= 19 && $row[0] != 0)
  					       {
  					        echo "Showing 1 to " . $row[0] . " of " . $row[0] . " entries";
  					       }
  					      else if($row[0] >= 20 && $row[0] != 0)
  					       {
  					        echo "Showing " . $from . " to " . $upto . " of " . $row[0] . " entries";
  					       }

  					  }
				break;

				case 'savebldg':
					$datenow = getsysdate();
					if($_POST['hiddennumber'] == ""){

						$sqlid = " SELECT bldgnumber FROM tblref_bldg ORDER BY id DESC LIMIT 1 ";
						$res = mysql_query($sqlid, $connection);
						$rowres = mysql_fetch_array($res);
							if ( $rowres[0] == "" ) {
								$newid = "BLDG-" . str_pad(1, 7, 0, STR_PAD_LEFT);
							}
							else {
								$arr = explode("-", $rowres[0]);
								$newid = "BLDG-" . str_pad($arr[1] + 1, 7, 0, STR_PAD_LEFT);
							}

						$sql = "INSERT INTO tblref_bldg (multiunit, bldgnumber, bldgtype, bldgname, bldgabb, nooffloors, noofrooms, address, city, province, zipcode, fulladdress, description, cutoffwater, duedatewater, cutoffelectricity, duedateelectricity, mallid, mallname)VALUES('" . $_POST['multiunit'] . "', '" . $newid . "','" . $_POST['bldgtype'] . "', '" . $_POST['bldgname'] . "', '" . $_POST['bldgabb'] . "', '" . $_POST['nooffloors'] . "', '" . $_POST['noofrooms'] . "', '" . $_POST['address'] . "', '" . $_POST['city'] . "', '" . $_POST['province'] . "', '" . $_POST['zipcode'] . "', '" . $_POST['fulladdress'] . "', '" . $_POST['bldgdesc'] . "', '" . $_POST['wcutoff'] . "', '" . $_POST['wduedate'] . "', '" . $_POST['ecutoff'] . "', '" . $_POST['eduedate'] . "', '" . $_POST['mallidd'] . "', '" . $_POST['mallname3'] . "')";
						$result = mysql_query($sql, $connection);


						$sql2 = "UPDATE tblref_mall SET bldgnumber = '" . $_POST['bldgnumber'] . "', bldgname = '" . $_POST['bldgname'] . "' WHERE mallname = '" . $_POST['hiddennumber'] . "'  ";
						$result2 = mysql_query($sql2, $connection);




							$arr = explode("|", $_POST['bldgamenities']);
							for ($i=1; $i <= count($arr)-1; $i++)
							{
								$sql2 = "INSERT INTO tblref_bldgamenities(bldgnumber, bldgamenities) VALUES('" . $newid . "','" . $arr[$i] . "')";
								$result2 = mysql_query($sql2, $connection);
							}

							$arr0 = explode("#", $_POST['reffloors']);
							for ( $i = 1; $i <= count($arr0)-1; $i++ )
							{
								$arr2 = explode("|", $arr0[$i]);
								$floorid = createidno("FLOOR", "tblref_floorsetup", "floorid");
								$sqlNew = " INSERT INTO tblref_floorsetup(floorid, floor,dateadded, bldgname) values('". $floorid ."', '". $arr2[2] ."', '" . date($datenow." H:i:s") . "', '" . $_POST['bldgname'] . "')";
								$resultNew = mysql_query($sqlNew, $connection);
							}

							// $arr2 = explode("|", $_POST['unitamenities']);
							// for ($i=1; $i <= count($arr2)-1; $i++)
							// {
							// 	$sql3 = "INSERT INTO pmls_unitamenities(roomnumber, unitamenities) VALUES('" . $_POST['roomnumber'] . "','" . $arr2[$i] . "')";
							// 	$result3 = mysql_query($sql3, $connection);
							// }

						echo "New building successfully added.";

					}else{
						$sql = "UPDATE tblref_bldg SET multiunit = '" . $_POST['multiunit'] . "', bldgtype = '" . $_POST['bldgtype'] . "', bldgname = '" . $_POST['bldgname'] . "', bldgabb = '" . $_POST['bldgabb'] . "', nooffloors = '" . $_POST['nooffloors'] . "', noofrooms = '" . $_POST['noofrooms'] . "', address = '" . $_POST['address'] . "', city = '" . $_POST['city'] . "', province = '" . $_POST['province'] . "', zipcode = '" . $_POST['zipcode'] . "' WHERE bldgnumber = '" . $_POST['hiddennumber'] . "' ";
						$result = mysql_query($sql, $connection);

						echo "Room has been modified.";
					}
				break;

				case 'deletebldg':
					$sql = "DELETE FROM tblref_bldg WHERE bldgnumber = '" . $_POST['hiddennumber'] . "' ";
					$result = mysql_query($sql, $connection);

					echo "Room successfully deleted.";
				break;

				case 'generateid':
					$sqlid = " SELECT bldgnumber FROM tblref_bldg ORDER BY id DESC LIMIT 1 ";
					$res = mysql_query($sqlid, $connection);
					$rowres = mysql_fetch_array($res);
						if ( $rowres[0] == "" ) {
							$newid = "BLDG-" . str_pad(1, 7, 0, STR_PAD_LEFT);
						}
						else {
							$arr = explode("-", $rowres[0]);
							$newid = "BLDG-" . str_pad($arr[1] + 1, 7, 0, STR_PAD_LEFT);
						}

						echo $newid;
				break;

				case 'displaybldgname':
					$datas .="<option value=''>-- Select Building --</option>";
					$sql = "SELECT buildingname FROM tblref_location";
					$result = mysql_query($sql, $connection);
					while ($row = mysql_fetch_array($result)) {
						$datas .= "<option>". $row[0] ."</option>";
					}
					echo $datas;
				break;

				case 'displayfullbldgadd':
					$sql = "SELECT completeaddress FROM tblref_location WHERE buildingname = '". $_POST['key'] ."'";
					$result = mysql_query($sql, $connection);
					$row = mysql_fetch_array($result);

					echo "|" . $row[0];
				break;

				case 'mallnamee':
					$datas .="<option value=''> -- Select -- </option>";
					$sql = "SELECT mallname FROM tblref_mall";
					$result = mysql_query($sql, $connection) or die (mysql_error());
					while ($row = mysql_fetch_array($result)) {
						$datas .= "<option>". $row["mallname"] ."</option>";
					}
					echo $datas;
				break;

				case 'mallnameinfo':
					$sql = "SELECT mallid, mallname FROM tblref_mall WHERE mallname = '". $_POST['mallname'] ."'";
					$result = mysql_query($sql, $connection);
					$row = mysql_fetch_array($result);

					echo "|" . $row[0] . "|" . $row[1];
				break;

				case 'bldgamenities':
					$sql = "SELECT amenities, abbreviation FROM pmls_refamenities WHERE type ='bldg' ";
					$result = mysql_query($sql, $connection);
					while ($row = mysql_fetch_array($result)) {

						$sql2 = "SELECT bldgnumber, bldgamenities FROM tblref_bldgamenities WHERE bldgamenities = '". $row[0] ."' AND bldgnumber = '".$_POST['generatedit']."' ";
						$result2 = mysql_query($sql2, $connection);
						$row2 = mysql_fetch_array($result2);

						if($row2[1] == ""){
							echo "
								<div class='col-md-4'><input class='bldg' name='amenities' type='checkbox' value='" . $row[0] . "' /> " . $row[0] . " " . $row[1] . "</div>
							";
						}else{
							echo "
								<div class='col-md-4'><input class='bldg' name='amenities' type='checkbox' value='" . $row[0] . "' checked/> " . $row[0] . " " . $row[1] . "</div>
							";
						}
					}
				break;

				case 'unitamenities':
					$sql = "SELECT amenities, abbreviation FROM pmls_refamenities WHERE type ='unit' ";
					$result = mysql_query($sql, $connection);
					while ($row = mysql_fetch_array($result)) {

						$sql2 = "SELECT unitamenities FROM pmls_unitamenities WHERE unitamenities='". $row[0] ."' AND roomnumber = '". $_POST['roomid'] ."' ";
						$result2 = mysql_query($sql2, $connection);
						$row2 = mysql_fetch_array($result2);

						if($row2[0] == ""){
							echo "
								<div class='col-md-4'> <input class='unit' name='amenities' type='checkbox' value='" . $row[0] . "' /> " . $row[0] . "</div>
							";
						}else{
							echo "
								<div class='col-md-4'> <input class='unit' name='amenities' type='checkbox' value='" . $row[0] . "' checked/> " . $row[0] . "</div>
							";
						}
					}
				break;

				case 'createfolder':
					if (!file_exists("bldgphotos/" . $_POST["generatedit"])) {
					    mkdir("bldgphotos/" . $_POST["generatedit"], 0777, true);
					}
				break;

				case 'bldgthumbnail':
					$sql = "SELECT bldgnumber, filename FROM tblref_bldgimages WHERE bldgnumber = '" . $_POST['generatedit'] . "' ";
					$result = mysql_query($sql, $connection);
					while ($row = mysql_fetch_assoc($result)) {

						$sql2 = "SELECT COUNT(id) as bilang FROM tblref_bldgimages WHERE bldgnumber = '" . $_POST['generatedit'] . "' ";
						$result2 = mysql_query($sql2, $connection);
						$row2 = mysql_fetch_array($result2);

						echo "
							<div class='col-md-2'>
								<img id='roomimg' class='img-thumbnail' src='bldgphotos/". $row['bldgnumber'] ."/". $row['filename'] ."' style='width: 100%; height: auto; margin-bottom: 10px;' />
							</div>
						";
					}
				break;

				case "loadlocationlist":

					$getcolor = "SELECT locationid, buildingname, completeaddress FROM tblref_location ";
					$colorresult = mysql_query($getcolor, $connection);

					while($color = mysql_fetch_array($colorresult))
					{
						echo "
							<tr onclick='applylocationclick(\"". $color[0] ."\", \"". $color[1] ."\", \"". $color[2] ."\");'>
								<td width='250'>" . $color[1] . "</th>
								<td >" . $color[2] . "</th>
							</tr>
						";
					}
				break;

				case "searchlocation":

					$getcolor = "SELECT locationid, buildingname, completeaddress FROM tblref_location where completeaddress LIKE '%" . $_POST["completeaddress"] . "%'";
					$colorresult = mysql_query($getcolor, $connection);

					while($color = mysql_fetch_array($colorresult))
					{
						echo "
							<tr onclick='applylocationclick(\"". $color[0] ."\", \"". $color[1] ."\", \"". $color[2] ."\");'>
								<td width='250'>" . $color[1] . "</th>
								<td >" . $color[2] . "</th>
							</tr>
						";
					}
				break;

				case "addnewlocation":
					$sql = "";
					$locationid = "";
					if($_POST["locationid"] == "")
					{
						$locationid = createidno("LOC", "tblref_location", "locationid");
						$sql = "INSERT into tblref_location(locationid, completeaddress, buildingname) values('" . $locationid . "', '" . $_POST["completeaddress"] . "', '" . $_POST["txtbuildingnamelocation"] . "')";
					}
					else
					{
						$locationid = $_POST["locationid"];
						$sql = "UPDATE tblref_location set completeaddress = '" . $_POST["completeaddress"] . "', buildingname = '" . $_POST["txtbuildingnamelocation"] . "' WHERE locationid = '"  . $_POST["locationid"] . "'";
					}
						$result = mysql_query($sql, $connection) or die(mysql_error());
				break;
		// ========================================================================================================================================


		// ================================================= REFERENTIAL OF USERS =============================================================

		case 'loaduser':
			$page = $_POST["page"];
			$limit = ($page-1) * 20;

				$sql = "SELECT userid, firstname, middlename, lastname, email, username  FROM  tbluser where firstname LIKE '%". $_POST["key"] ."%' OR middlename LIKE '%".$_POST["key"]."%' OR lastname LIKE '%".$_POST["key"]."%' LIMIT ".$limit.", 20";
				$result = mysql_query($sql);
				while($row = mysql_fetch_array($result))
				{
				  echo "<tr style='width: 100%;display: table;table-layout: fixed;'>
							<td class='scroll'>" . $row["lastname"] . " ".$row["firstname"]." ".$row["middlename"]."</td>
							<td class='hide_mobile'>" . $row["email"] . "</td>
							<td class='scroll'>" . $row["username"] . "</td>
							<td>
								<button class='btn btn-xs btn-info' onclick='editrefuser(\"".$row["userid"]."\")'>
									<i class='ace-icon fa fa-pencil bigger-120'></i>
								</button>

								<button class='btn btn-xs btn-danger' onclick='delrefuser(\"".$row["userid"]."\")'>
									<i class='ace-icon fa fa-trash-o bigger-120'></i>
								</button>
							 </td>

						</tr>";
				}
		break;

		case "loadpaginationuser":

			$page = $_POST["page"];
			$sqlb = "SELECT COUNT(*) FROM tbluser where firstname LIKE '%". $_POST["key"] ."%' OR middlename LIKE '%".$_POST["key"]."%' OR lastname LIKE '%".$_POST["key"]."%'";
			$aa = mysql_query($sqlb, $connection);
			$nums = mysql_fetch_row($aa);
			$num = $nums[0];
			// if($num <= 20)
			// {
			// 	$page = 1
			// }
			$rowsperpage = 20;
			$range = 4;
			$totalpages = ceil($num / $rowsperpage);
			$prevpage;
			$nextpage;
			// if not on page 1, don't show back links
			if($page > 1 )
			{
			   echo "<li style='width:50px !important;' onclick='getvaluser(1)'><< First</li>";
			   $prevpage = $page - 1;
			   echo "<li style='width:70px !important;' onclick='getvaluser(". $prevpage .")'>< Previous</li>";
			}
			for($x = ($page - $range); $x < (($page + $range) + 1); $x++)
			{
			   if (($x > 0) && ($x <= $totalpages))
			   {
			      if ($x == $page)
			      {

		   	echo "<li id='pgptnts" . $x . "' class='pgnumptnts active' onclick='getvaluser(" . $x . ",". $x .")'>" . $x . "</li>"; }
			else
			{
			echo "<li id='pgptnts" . $x . "' class='pgnumptnts' onclick='getvaluser(" . $x . ",". $x .")'>" . $x . "</li>"; }
		       }
		    }
		    if($page < ($totalpages - $range))
		    { echo "<li>...</li>"; }
		    if ($page != $totalpages && $num != 0)
		    {
		       $nextpage = $page + 1;
		       echo "<li style='width:50px !important;' onclick='getvaluser(". $nextpage .", ". $nextpage .")'>Next ></li>";
		       echo "<li style='width:50px !important;' onclick='getvaluser(". $totalpages .", ". $totalpages .")'>Last >></li>";
		    }
		break;

		case 'loadentriesuser':
  			 $sql = "SELECT COUNT(*) FROM tbluser where firstname LIKE '%". $_POST["key"] ."%' OR middlename LIKE '%".$_POST["key"]."%' OR lastname LIKE '%".$_POST["key"]."%'";
  			 $result = mysql_query($sql, $connection);
  			 $row = mysql_fetch_array($result);
  			 $rowsperpage = 20;
  			 $totalpages = ceil($row[0] / $rowsperpage);
  			 $upto = $limit + 20;
  			 $from = $limit + 1;
  			 if($page == $totalpages && $row[0] != 0)
  			 {
  			      echo "Showing " . $from . " to " . $row[0] . " of " . $row[0] . " entries";
  			 }
  			 else
  			 {

  			      if($row[0] == 0)
  			       {
  			        echo "no data";
  			       }
  			      else if($row[0] <= 19 && $row[0] != 0)
  			       {
  			        echo "Showing 1 to " . $row[0] . " of " . $row[0] . " entries";
  			       }
  			      else if($row[0] >= 20 && $row[0] != 0)
  			       {
  			        echo "Showing " . $from . " to " . $upto . " of " . $row[0] . " entries";
  			       }

  			  }
		break;

		case 'delrefuser':
			$sql = "DELETE FROM tbluser WHERE userid = '". $_POST["id"] ."'";
			$result = mysql_query($sql);
			if($result == true)
			{
				echo "Successfully deleted.";
			}
		break;

		case 'editrefuser':
				$sql = "SELECT userid, firstname, middlename, lastname, email, username, password FROM tbluser WHERE userid = '". $_POST["id"] ."'";
				$result = mysql_query($sql);
				$row = mysql_fetch_array($result);

				if($result == true)
				{
					echo "|" . $row["userid"] . "|" . $row["firstname"] . "|" . $row["middlename"] . "|" . $row["lastname"] . "|" . $row["email"] . "|" . $row["username"] . "|" . $row["password"];
				}
		break;

		case 'addnewuser':
					$md5 = md5($_POST["password"]);

					if($_POST["id"] == "")
					{
						$selectame = "SELECT COUNT(*) FROM tbluser WHERE username = '". $_POST["username"] ."' AND password = '". $_POST["password"] ."'";
						$resultame = mysql_query($selectame, $connection);
						$amenum = mysql_fetch_array($resultame);
						if($amenum[0] == 0)
						{

							$userid = createidno("USER", "tbluser", "userid");
							$insertame = "INSERT INTO tbluser (userid, firstname, middlename, lastname, email, username, password, password2) VALUES ('". $userid ."', '". $_POST["first"] ."', '". $_POST["middle"] ."', '". $_POST["last"] ."', '". $_POST["email"] ."', '". $_POST["username"] ."', '". $_POST["password"] ."', '". $md5 ."')";
							$resultame = mysql_query($insertame, $connection);
							if($resultame == true)
							{
								echo "Successfully Added.";
							}
							else
							{
								echo "An error occured!";
							}
						}
						else
						{
							echo "Already Existing!";
						}
					}
					else
					{

						$insertame = "UPDATE tbluser SET firstname = '". $_POST["first"] ."', middlename = '". $_POST["middle"] ."', lastname = '". $_POST["last"] ."', email = '". $_POST["email"] ."', username = '". $_POST["username"] ."', password = '". $_POST["password"] ."', password2 = '". $md5 ."' WHERE userid = '".$_POST["id"]."'";
						$resultame = mysql_query($insertame, $connection);
						if($resultame == true)
						{
							echo "Successfully modified.";
						}
					}

		break;

		// ========================================================================================================================================


		// ========================================================== INQUIRY MODULE ===============================================================

		case "loadinquiries":
			$cnt_fltr = 0;
			$sql_filter = mysql_fetch_array(mysql_query("SELECT checked_value, otherfilter, bystat, xcheck FROM tblref_filters WHERE module = 'Inquiry'"));
			$trby = explode("|", $sql_filter["checked_value"]);
			$stat = explode("|", $sql_filter["bystat"]);
			$unit = explode("|", $sql_filter["xcheck"]);
			$date = explode("|", $sql_filter["otherfilter"]);
			$filter = "";

			// filter for status
			$cnt = 0; $chk = "";
			for($a = 0; $a<=count($stat)-1; $a++)
			{
				if($stat[$a] == "Inquired"){ $con = "(Status = 'Pending' AND Application_ID = '')"; }
				else if($stat[$a] == "Processing"){ $con = "((Status = 'Pending' AND Application_ID != '') OR (Status = 'For Approval' AND Application_ID != ''))"; }
				else if($stat[$a] == "Disapproved"){ $con = "(Status = 'Disapproved' AND Application_ID != '') "; }
				else if($stat[$a] == "Approved"){ $con = "(Status = 'Tentative') "; }
				else if($stat[$a] == "Reserved"){ $con = "(Status = 'Confirmed') "; }
				else if($stat[$a] == "Cancelled"){ $con = "(Status = 'Cancelled') "; }
				else if($stat[$a] == "Occupied"){ $con = "(Status = 'Occupied') "; }

				if($stat[$a] != "")
				{
					$cnt_fltr++;
					$cnt++;
					if($cnt == 1)
					{
						$chk .= $con;
					}
					else
					{
						$chk .= " OR ".$con;
					}
				}
			}

			if($cnt > 1)
			{
				$Stat_fltr = "(".$chk.")";
			}
			else
			{
				$Stat_fltr = $chk;
			}
			if($cnt > 0)
			{
				$and = " AND ";
			}
			else
			{
				$and = "";
			}
			// filter for unit type
			$cnt2 = 0; $chk2 = "";
			for($b = 0; $b<=count($unit)-1; $b++)
			{
				if($unit[$b] != "")
				{
					$cnt_fltr++;
					$cnt2++;
					if($cnt2 == 1)
					{
						$chk2 .= "UnitType = '".$unit[$b]."'";
					}
					else
					{
						$chk2 .= " OR UnitType = '".$unit[$b]."'";
					}
				}
			}
			if($cnt2 > 1)
			{
				$Unit_fltr = "(".$chk2.")";
			}
			else
			{
				$Unit_fltr = $chk2;
			}

			if($cnt2 > 0)
			{
				$and1 = " AND ";
			}
			else
			{
				$and1 = "";
			}
			// filter by date
			$date_fltr = "(date_inquired BETWEEN '".date("Y-m-d", strtotime($date[0]))."' AND '".date("Y-m-d", strtotime($date[1]))."')";

			// filter by
			$cnt3 = 0; $chk3 = "";
			for($c = 0; $c<=count($trby)-1; $c++)
			{
				if($trby[$c] != "")
				{
					$cnt_fltr++;
					$cnt3++;
					if($cnt3 == 1)
					{
						$chk3 .= $trby[$c] . " LIKE '%".$_POST["key"]."%'";
					}
					else
					{
						$chk3 .= " OR ". $trby[$c] . " LIKE '%".$_POST["key"]."%'";
					}
				}
			}
			if($cnt3 > 1)
			{
				$by_fltr = "(".$chk3.")";
			}
			else
			{
				$by_fltr = $chk3;
			}
			if($cnt3 > 0)
			{
				$and2 = " AND ";
			}
			else
			{
				$and2 = "";
			}

			if($cnt > 0 && $cnt2 > 0)
			{
				$filterselected = "WHERE ".$Stat_fltr . "".$and."" . $Unit_fltr . "".$and1."" . $date_fltr . "".$and2."" . $by_fltr;
				$page = $_POST["page"];
	            $limit = ($page-1) * 20;
	            $sql = "SELECT Inquiry_ID, Application_ID, Mall, Mall_ID, Trade_Name, Company_Name, Industry, Address, TradeID, Company_ID, UnitID, Status, UnitType FROM tbltrans_inquiry ".$filterselected." ORDER BY Inquiry_ID DESC LIMIT ".$limit.", 20";
	            $result = mysql_query($sql);
	            while($row = mysql_fetch_array($result))
	            {
	                if($row["Application_ID"] == "")
	                {
	                    $function = "leaseapplication(\"". $row["Inquiry_ID"] ."\")";
	                    $title = "Create Leasing Application";
	                }
	                else
	                {
	                    $function = "loadapplication(\"". $row["Inquiry_ID"] ."\", \"". $row["Application_ID"] ."\");loadtelno_application(\"". $row["Inquiry_ID"] ."\", \"". $row["Application_ID"] ."\");loadaffiliate_application(\"". $row["Inquiry_ID"] ."\", \"". $row["Application_ID"] ."\");";
	                    $title = "Edit Leasing Application";
	                }

	                if($row["Status"] == "Pending" && $row["Application_ID"] == "")
	                {
	                    $stat = "<span class='label label-sm label-light'>Inquired</span>";
	                }
	                else if($row["Application_ID"] != "" && ($row["Status"] == "Pending" || $row["Status"] == "For Approval"))
	                {
	                    $stat = "<span class='label label-sm label-success'>Application on process . . .</span>";
	                }
	                else if($row["Application_ID"] != "" && $row["Status"] == "Disapproved")
	                {
	                    $stat = "<span class='label label-sm label-danger'>Disapproved Application</span>";
	                }
	                else if($row["Status"] == "Tentative")
	                {
	                    $stat = "<span class='label label-sm label-info'>Approved Application</span>";
	                }
	                else if($row["Status"] == "Confirmed")
	                {
	                    $stat = "<span class='label label-sm label-yellow'>Reserved</span>";
	                }
	                else if($row["Status"] == "Occupied")
	                {
	                    $stat = "<span class='label label-sm label-warning'>Occupied</span>";
	                }
	                else if($row["Status"] == "Cancelled")
	                {
	                    $stat = "<span class='label label-sm label-danger'>Cancelled Reservation</span>";
	                }
	                echo "
	                <tr id='" . $row["Inquiry_ID"] . "'>
	                    <td class='scroll'>" . $row["Mall"] . "</td>
	                    <td class='scroll'>" . $row["UnitType"] . "</td>
	                    <td class='scroll'>" . $row["Trade_Name"] . "</td>
	                    <td class='hide_mobile'>" . $row["Company_Name"] . "</td>
	                    <td class='hide_mobile'>" . $row["Industry"] . "</td>
	                    <td class='hide_mobile'>" . $row["Address"] . "</td>
	                    <td class='hide_mobile'>" . $stat . "</td>
	                    <td>
	                        <div class='btn-group'>";
	                            if($row["Application_ID"] == "")
	                            {
	                                echo"<button class='btn btn-xs btn-info' onclick='viewinquiry(\"". $row["TradeID"] ."\", \"". $row["Company_ID"] ."\",\"". $row["Inquiry_ID"] ."\",\"". $row["UnitID"] ."\", \"apply\")' title='Apply Leasing Application'>
	                                <img src='assets/images/resume.png' style='width: 100%; height: auto;' />
	                                </button>";
	                                echo"<button class='btn btn-xs btn-gray' onclick='loadprintinfo(\"". $row["TradeID"] ."\", \"". $row["Company_ID"] ."\",\"". $row["Inquiry_ID"] ."\",\"". $row["UnitID"] ."\", \"".$row["Mall_ID"]."\")' title='Print Inquiry'>
	                                <img src='assets/images/printer.png' style='width: 100%; height: auto;' />
	                                </button>";
	                                echo"<button class='btn btn-xs btn-gray' onclick='viewinquiry(\"". $row["TradeID"] ."\", \"". $row["Company_ID"] ."\",\"". $row["Inquiry_ID"] ."\",\"". $row["UnitID"] ."\", \"view\")' title='View Inquiry'>
	                                <img src='assets/images/view.png' style='width: 100%; height: auto;' />
	                                </button>";
	                            }
	                            else
	                            {
	                                echo"<button class='btn btn-xs btn-gray' onclick='loadprintinfo(\"". $row["TradeID"] ."\", \"". $row["Company_ID"] ."\",\"". $row["Inquiry_ID"] ."\",\"". $row["UnitID"] ."\", \"".$row["Mall_ID"]."\")' title='Print Inquiry'>
	                                <img src='assets/images/printer.png' style='width: 100%; height: auto;' />
	                                </button>";
	                                echo"<button class='btn btn-xs btn-gray' onclick='viewinquiry(\"". $row["TradeID"] ."\", \"". $row["Company_ID"] ."\",\"". $row["Inquiry_ID"] ."\",\"". $row["UnitID"] ."\", \"view\")' title='View Inquiry'>
	                                <img src='assets/images/view.png' style='width: 100%; height: auto;' />
	                                </button>";
	                            }
	                            echo"<button class='btn btn-xs btn-gray' onclick='viewhistorytenants(\"". $row["Inquiry_ID"] ."\")' title='View Logs'>
	                                <img src='assets/images/clock.png' style='width: 100%; height: auto;' />
	                                </button>";
	                    echo "</div>
	                    </td>




	                </tr>
	                ";
	                // echo $sql;
	            }
			}

            // echo $sql;
		break;

		case "loadpaginationinquiry":
			$cnt_fltr = 0;
			$sql_filter = mysql_fetch_array(mysql_query("SELECT checked_value, otherfilter, bystat, xcheck FROM tblref_filters WHERE module = 'Inquiry'"));
			$trby = explode("|", $sql_filter["checked_value"]);
			$stat = explode("|", $sql_filter["bystat"]);
			$unit = explode("|", $sql_filter["xcheck"]);
			$date = explode("|", $sql_filter["otherfilter"]);
			$filter = "";

			// filter for status
			$cnt = 0; $chk = "";
			for($a = 0; $a<=count($stat)-1; $a++)
			{
				if($stat[$a] == "Inquired"){ $con = "(Status = 'Pending' AND Application_ID = '')"; }
				else if($stat[$a] == "Processing"){ $con = "((Status = 'Pending' AND Application_ID != '') OR (Status = 'For Approval' AND Application_ID != ''))"; }
				else if($stat[$a] == "Disapproved"){ $con = "(Status = 'Disapproved' AND Application_ID != '') "; }
				else if($stat[$a] == "Approved"){ $con = "(Status = 'Tentative') "; }
				else if($stat[$a] == "Reserved"){ $con = "(Status = 'Confirmed') "; }
				else if($stat[$a] == "Cancelled"){ $con = "(Status = 'Cancelled') "; }
				else if($stat[$a] == "Occupied"){ $con = "(Status = 'Occupied') "; }

				if($stat[$a] != "")
				{
					$cnt_fltr++;
					$cnt++;
					if($cnt == 1)
					{
						$chk .= $con;
					}
					else
					{
						$chk .= " OR ".$con;
					}
				}
			}

			if($cnt > 1)
			{
				$Stat_fltr = "(".$chk.")";
			}
			else
			{
				$Stat_fltr = $chk;
			}
			if($cnt > 0)
			{
				$and = " AND ";
			}
			else
			{
				$and = "";
			}
			// filter for unit type
			$cnt2 = 0; $chk2 = "";
			for($b = 0; $b<=count($unit)-1; $b++)
			{
				if($unit[$b] != "")
				{
					$cnt_fltr++;
					$cnt2++;
					if($cnt2 == 1)
					{
						$chk2 .= "UnitType = '".$unit[$b]."'";
					}
					else
					{
						$chk2 .= " OR UnitType = '".$unit[$b]."'";
					}
				}
			}
			if($cnt2 > 1)
			{
				$Unit_fltr = "(".$chk2.")";
			}
			else
			{
				$Unit_fltr = $chk2;
			}

			if($cnt2 > 0)
			{
				$and1 = " AND ";
			}
			else
			{
				$and1 = "";
			}
			// filter by date
			$date_fltr = "(date_inquired BETWEEN '".date("Y-m-d", strtotime($date[0]))."' AND '".date("Y-m-d", strtotime($date[1]))."')";

			// filter by
			$cnt3 = 0; $chk3 = "";
			for($c = 0; $c<=count($trby)-1; $c++)
			{
				if($trby[$c] != "")
				{
					$cnt_fltr++;
					$cnt3++;
					if($cnt3 == 1)
					{
						$chk3 .= $trby[$c] . " LIKE '%".$_POST["key"]."%'";
					}
					else
					{
						$chk3 .= " OR ". $trby[$c] . " LIKE '%".$_POST["key"]."%'";
					}
				}
			}
			if($cnt3 > 1)
			{
				$by_fltr = "(".$chk3.")";
			}
			else
			{
				$by_fltr = $chk3;
			}
			if($cnt3 > 0)
			{
				$and2 = " AND ";
			}
			else
			{
				$and2 = "";
			}

			if($cnt > 0 && $cnt2 > 0 && $cnt3 > 0)
			{
				$filterselected = "WHERE ".$Stat_fltr . "".$and."" . $Unit_fltr . "".$and1."" . $date_fltr . "".$and2."" . $by_fltr;

					$page = $_POST["page"];
					$sqlb = "SELECT COUNT(*) FROM tbltrans_inquiry ".$filterselected."";
					$aa = mysql_query($sqlb, $connection);
					$nums = mysql_fetch_row($aa);
					$num = $nums[0];
					// if($num <= 20)
					// {
					// 	$page = 1
					// }
					$rowsperpage = 20;
					$range = 4;
					$totalpages = ceil($num / $rowsperpage);
					$prevpage;
					$nextpage;
					// if not on page 1, don't show back links
					if($page > 1 )
					{
					   echo "<li style='width:50px !important;' onclick='getvalinquiry(1)'><< First</li>";
					   $prevpage = $page - 1;
					   echo "<li style='width:70px !important;' onclick='getvalinquiry(". $prevpage .")'>< Previous</li>";
					}
					for($x = ($page - $range); $x < (($page + $range) + 1); $x++)
					{
					   if (($x > 0) && ($x <= $totalpages))
					   {
					      if ($x == $page)
					      {

				   	echo "<li id='pgptnts" . $x . "' class='pgnumptnts active' onclick='getvalinquiry(" . $x . ",". $x .")'>" . $x . "</li>"; }
					else
					{
					echo "<li id='pgptnts" . $x . "' class='pgnumptnts' onclick='getvalinquiry(" . $x . ",". $x .")'>" . $x . "</li>"; }
				       }
				    }
				    if($page < ($totalpages - $range))
				    { echo "<li>...</li>"; }
				    if ($page != $totalpages && $num != 0)
				    {
				       $nextpage = $page + 1;
				       echo "<li style='width:50px !important;' onclick='getvalinquiry(". $nextpage .", ". $nextpage .")'>Next ></li>";
				       echo "<li style='width:50px !important;' onclick='getvalinquiry(". $totalpages .", ". $totalpages .")'>Last >></li>";
				    }
			}
		break;

		case 'loadinquiryentries':
			$cnt_fltr = 0;
			$sql_filter = mysql_fetch_array(mysql_query("SELECT checked_value, otherfilter, bystat, xcheck FROM tblref_filters WHERE module = 'Inquiry'"));
			$trby = explode("|", $sql_filter["checked_value"]);
			$stat = explode("|", $sql_filter["bystat"]);
			$unit = explode("|", $sql_filter["xcheck"]);
			$date = explode("|", $sql_filter["otherfilter"]);
			$filter = "";

			// filter for status
			$cnt = 0; $chk = "";
			for($a = 0; $a<=count($stat)-1; $a++)
			{
				if($stat[$a] == "Inquired"){ $con = "(Status = 'Pending' AND Application_ID = '')"; }
				else if($stat[$a] == "Processing"){ $con = "((Status = 'Pending' AND Application_ID != '') OR (Status = 'For Approval' AND Application_ID != ''))"; }
				else if($stat[$a] == "Disapproved"){ $con = "(Status = 'Disapproved' AND Application_ID != '') "; }
				else if($stat[$a] == "Approved"){ $con = "(Status = 'Tentative') "; }
				else if($stat[$a] == "Reserved"){ $con = "(Status = 'Confirmed') "; }
				else if($stat[$a] == "Cancelled"){ $con = "(Status = 'Cancelled') "; }
				else if($stat[$a] == "Occupied"){ $con = "(Status = 'Occupied') "; }

				if($stat[$a] != "")
				{
					$cnt_fltr++;
					$cnt++;
					if($cnt == 1)
					{
						$chk .= $con;
					}
					else
					{
						$chk .= " OR ".$con;
					}
				}
			}

			if($cnt > 1)
			{
				$Stat_fltr = "(".$chk.")";
			}
			else
			{
				$Stat_fltr = $chk;
			}
			if($cnt > 0)
			{
				$and = " AND ";
			}
			else
			{
				$and = "";
			}
			// filter for unit type
			$cnt2 = 0; $chk2 = "";
			for($b = 0; $b<=count($unit)-1; $b++)
			{
				if($unit[$b] != "")
				{
					$cnt_fltr++;
					$cnt2++;
					if($cnt2 == 1)
					{
						$chk2 .= "UnitType = '".$unit[$b]."'";
					}
					else
					{
						$chk2 .= " OR UnitType = '".$unit[$b]."'";
					}
				}
			}
			if($cnt2 > 1)
			{
				$Unit_fltr = "(".$chk2.")";
			}
			else
			{
				$Unit_fltr = $chk2;
			}

			if($cnt2 > 0)
			{
				$and1 = " AND ";
			}
			else
			{
				$and1 = "";
			}
			// filter by date
			$date_fltr = "(date_inquired BETWEEN '".date("Y-m-d", strtotime($date[0]))."' AND '".date("Y-m-d", strtotime($date[1]))."')";

			// filter by
			$cnt3 = 0; $chk3 = "";
			for($c = 0; $c<=count($trby)-1; $c++)
			{
				if($trby[$c] != "")
				{
					$cnt_fltr++;
					$cnt3++;
					if($cnt3 == 1)
					{
						$chk3 .= $trby[$c] . " LIKE '%".$_POST["key"]."%'";
					}
					else
					{
						$chk3 .= " OR ". $trby[$c] . " LIKE '%".$_POST["key"]."%'";
					}
				}
			}
			if($cnt3 > 1)
			{
				$by_fltr = "(".$chk3.")";
			}
			else
			{
				$by_fltr = $chk3;
			}
			if($cnt3 > 0)
			{
				$and2 = " AND ";
			}
			else
			{
				$and2 = "";
			}

			if($cnt > 0 && $cnt2 > 0)
			{
				$filterselected = "WHERE ".$Stat_fltr . "".$and."" . $Unit_fltr . "".$and1."" . $date_fltr . "".$and2."" . $by_fltr;
					if($_POST["page"] == "")
		    		{ $page = 1; }
		    		else
		    		{ $page = $_POST["page"]; }
		    		 $limit = ($page-1) * 20;

		  			 $sql = "SELECT COUNT(*)  FROM tbltrans_inquiry ".$filterselected."";
		  			 $result = mysql_query($sql, $connection);
		  			 $row = mysql_fetch_array($result);
		  			 $rowsperpage = 20;
		  			 $totalpages = ceil($row[0] / $rowsperpage);
		  			 $upto = $limit + 20;
		  			 $from = $limit + 1;
		  			 if($page == $totalpages && $row[0] != 0)
		  			 {
		  			      echo "Showing " . $from . " to " . $row[0] . " of " . $row[0] . " entries";
		  			 }
		  			 else
		  			 {

		  			      if($row[0] == 0)
		  			       {
		  			        echo 000;
		  			       }
		  			      else if($row[0] <= 19 && $row[0] != 0)
		  			       {
		  			        echo "Showing 1 to " . $row[0] . " of " . $row[0] . " entries";
		  			       }
		  			      else if($row[0] >= 20 && $row[0] != 0)
		  			       {
		  			        echo "Showing " . $from . " to " . $upto . " of " . $row[0] . " entries";
		  			       }

		  			  }
		  	}
		break;


		case 'saveinquiry':
			$depositperc = mysql_fetch_array(mysql_query("SELECT depositperc FROM mall_setup WHERE mall_id = '". $_POST['mallid'] ."' ", $connection));
			$totalbayarin = floatval($_POST['totalpayment']) * $_POST['monthnum'];
			$mindeposit = ($depositperc[0] / 100) * $totalbayarin;

			if($mindeposit >= $_POST['depositpayment']){
				echo "Deposit must be P".number_format($mindeposit, 2, '.', ',')." or greater.";
			}else{
				$sql_mall = "SELECT mallname FROM tblref_mall WHERE mallid = '". $_POST['mallid'] ."'";
				$result_mall = mysql_query($sql_mall, $connection);
				$mall = mysql_fetch_array($result_mall);

				$sql_user = "SELECT firstname, middlename, lastname FROM tbluser WHERE userid = '".$_COOKIE["userid"]."'";
	       		$res = mysql_query($sql_user, $connection);
	       		$row_user = mysql_fetch_array($res);

				$inqid = createidno("INQ", "tbltrans_inquiry", "Inquiry_ID");
				$sql = "INSERT INTO tbltrans_inquiry (Inquiry_ID, Mall, Mall_ID, Trade_Name, Company_Name, Industry, Address, User_ID, Company_ID, TradeID, UnitID, datefrom, dateto, DepartmentID,CategoryID, depamount, advamount, dep_month, adv_month, date_inquired, UnitType, ClassID, LCA_length, LCA_width, desired_noofmonths, desired_noofdays, inq_by, date_modified, mod_by, time_inquired, month_adv, payment_terms, payment_type, cardtype, cardholder, authno, seccode, expirydate, bankfrom, bf_accno, bankto, bt_accno, owner_card_number, monthly_dues, assoc_dues) values('". $inqid ."' , '".$_POST["mallname"]."', '".$_POST["mallid"]."', '".$_POST["tradename"]."', '".$_POST["companyname"]."', '".$_POST["industryname"]."', '".$_POST["address"]."', '".$_COOKIE["userid"]."', '".$_POST["companyid"]."', '".$_POST["tradeid"]."','".$_POST["unitid"]."', '".$_POST["datefrom"]."', '".$_POST["dateto"]."', '".$_POST["dep_id"]."', '".$_POST["cat_id"]."', '".$_POST["depositpayment"]."', '".$_POST["advancepayment"]."', '".$_POST["monthlydepamt"]."', '".$_POST["monthlyadvamt"]."', '".date("Y-m-d")."', '".$_POST["unittype"]."', '".$_POST["classid"]."', '".$_POST["sqm_length"]."', '".$_POST["sqm_width"]."', '".$_POST["monthnum"]."', '".$_POST["daynum"]."', '".$row_user["lastname"].", ".$row_user["firstname"]." ".$row_user["middlename"]."', '".date("Y-m-d H:i:s")."', '".$row_user["lastname"].", ".$row_user["firstname"]." ".$row_user["middlename"]."', '".date("H:i:s")."', '".$_POST["selectedmonth"]."', '".$_POST["pymentterms"]."', '".$_POST["pymenttype"]."', '". $_POST['cardtype'] ."', '". $_POST['cardholder'] ."', '". $_POST['authno'] ."', '". $_POST['securitycode'] ."', '". $_POST['expirydate'] ."', '". $_POST['bankfrom'] ."', '". $_POST['bf_accno'] ."', '". $_POST['bankto'] ."', '". $_POST['bt_accno'] ."', '". $_POST['ccno'] ."', '". $_POST['totalsqm'] ."', '". $_POST['assocdues'] ."')";
				$result = mysql_query($sql, $connection);
				if($result == true)
				{
					$logs = create_logs("created an new inquiry.", "Inquiry Module", $inqid ."|".$_POST["mallname"]."|".$_POST["mallid"]."|".$_POST["tradename"]."|".$_POST["companyname"]."|".$_POST["industryname"]."|".$_POST["address"]."|".$row_user["lastname"].", ".$row_user["firstname"]." ".$row_user["middlename"]."|".$_POST["companyid"]."|".$_POST["tradeid"]."|".$_POST["unitid"]."|".$_POST["datefrom"]."|".$_POST["dateto"]."|".$_POST["dep_id"]."|".$_POST["cat_id"]."|".$_POST["depositpayment"]."|".$_POST["advancepayment"]."|".$_POST["monthlydepamt"]."|".$_POST["monthlyadvamt"]."|".$_POST["unittype"]."|".$_POST["classid"]."|".$_POST["sqm_length"]."|".$_POST["sqm_width"]."|".$_POST["monthnum"]."|".$_POST["daynum"], "ADD");

					$tran_logs = create_logs_per_transaction("created an new inquiry.", "Inquiry Module", $inqid ."|".$_POST["mallname"]."|".$_POST["mallid"]."|".$_POST["tradename"]."|".$_POST["companyname"]."|".$_POST["industryname"]."|".$_POST["address"]."|".$row_user["lastname"].", ".$row_user["firstname"]." ".$row_user["middlename"]."|".$_POST["companyid"]."|".$_POST["tradeid"]."|".$_POST["unitid"]."|".$_POST["datefrom"]."|".$_POST["dateto"]."|".$_POST["dep_id"]."|".$_POST["cat_id"]."|".$_POST["depositpayment"]."|".$_POST["advancepayment"]."|".$_POST["monthlydepamt"]."|".$_POST["monthlyadvamt"]."|".$_POST["unittype"]."|".$_POST["classid"]."|".$_POST["sqm_length"]."|".$_POST["sqm_width"]."|".$_POST["monthnum"]."|".$_POST["daynum"], "ADD", $inqid, "", "");

					echo 1;

					if($_POST["remarks"] != "")
					{
						$remid = createidno("REM", "tbltrans_remarks", "remID");
						$sql_remarks = "INSERT INTO tbltrans_remarks(remID, inqID, xremarks, xdate, userID)VALUES('". $remid ."', '". $inqid ."', '". $_POST["remarks"] ."', '". date("Y-m-d H:i:s") ."', '". $_COOKIE["userid"] ."')";
						$result_remarks = mysql_query($sql_remarks, $connection);
					}
				}
			}

			// if($_POST["unittype"] == "LCA" && $_POST["lca_unitname"] != "")
			// {
			// 	$sqlunit = "INSERT INTO tblref_unit_lca_dummy (inquiryID, appID, UnitName, width, ulength, amountpersqm, totalamountsqm, FlrName, WingID, MallID, xStat) VALUES('". $inqid ."', '', '". $_POST["lca_unitname"] ."', '". $_POST["sqm_width"] ."', '". $_POST["sqm_length"] ."', '". $_POST["persqm"] ."', '". $_POST["totalsqm"] ."', '". $_POST["unitfloor"] ."', '". $_POST["unitwing"] ."', '". $_POST["mallid"] ."', 'inquired')";
			// 	$sqlresit = mysql_query($sqlunit, $connection);
			// }
		break;

		case 'saveinquiryupdate':
			$datenow = getsysdate();
			if($_POST["statss"] == "leaseapp")
			{
				$log_stat = "Leasing Application Module";
				$tyype = "a leasing application with ".$_POST["appidd"]." application ID";
			}
			else
			{
				$log_stat = "Inquiry Module";
				$tyype = "an inquiry with ".$_POST["id"]." inquiry ID";
			}
				$sql_user = "SELECT firstname, middlename, lastname FROM tbluser WHERE userid = '".$_COOKIE["userid"]."'";
       			$res = mysql_query($sql_user, $connection);
       			$row_user = mysql_fetch_array($res);

				$sql_mall = "SELECT mallname FROM tblref_mall WHERE mallid = '". $_POST['mallid'] ."'";
				$result_mall = mysql_query($sql_mall, $connection);
				$mall = mysql_fetch_array($result_mall);

				$logs = create_logs("updated ".$tyype.".", $log_stat, $mall["mallname"]."|".$_POST["mallid"]."|".$_POST["tradename"]."|".$_POST["companyname"]."|".$_POST["industryname"]."|".$_POST["address"]."|".$_POST["companyid"]."|".$_POST["tradeid"]."|".$_POST["unitid"]."|".$_POST["datefrom"]."|".$_POST["dateto"]."|".$_POST["dep_id"]."|".$_POST["cat_id"]."|".$_POST["depositpayment"]."|".$_POST["advancepayment"]."|".$_POST["monthlydepamt"]."|".$_POST["monthlyadvamt"]."|".$_POST["unittype"]."|".$_POST["classid"]."|".$_POST["sqm_length"]."|".$_POST["sqm_width"]."|".$_POST["monthnum"]."|".$_POST["daynum"]."|".date($datenow." H:i:s")."|".$row_user["lastname"].", ".$row_user["firstname"]." ".$row_user["middlename"], "UPDATE");

				$tran_logs = create_logs_per_transaction("updated ".$tyype.".", $log_stat, $mall["mallname"]."|".$_POST["mallid"]."|".$_POST["tradename"]."|".$_POST["companyname"]."|".$_POST["industryname"]."|".$_POST["address"]."|".$_POST["companyid"]."|".$_POST["tradeid"]."|".$_POST["unitid"]."|".$_POST["datefrom"]."|".$_POST["dateto"]."|".$_POST["dep_id"]."|".$_POST["cat_id"]."|".$_POST["depositpayment"]."|".$_POST["advancepayment"]."|".$_POST["monthlydepamt"]."|".$_POST["monthlyadvamt"]."|".$_POST["unittype"]."|".$_POST["classid"]."|".$_POST["sqm_length"]."|".$_POST["sqm_width"]."|".$_POST["monthnum"]."|".$_POST["daynum"]."|".date($datenow." H:i:s")."|".$row_user["lastname"].", ".$row_user["firstname"]." ".$row_user["middlename"], "UPDATE", $_POST["id"], $_POST["appidd"], "");



				if($logs == 1)
				{
					$sql = "UPDATE tbltrans_inquiry SET Mall = '".$mall["mallname"]."', Mall_ID = '".$_POST["mallid"]."', Trade_Name = '".$_POST["tradename"]."', Company_Name = '".$_POST["companyname"]."', Industry = '".$_POST["industryname"]."', Address = '".$_POST["address"]."', Company_ID = '".$_POST["companyid"]."', TradeID = '".$_POST["tradeid"]."', UnitID = '".$_POST["unitid"]."', datefrom = '".$_POST["datefrom"]."', dateto = '".$_POST["dateto"]."', DepartmentID = '".$_POST["dep_id"]."', CategoryID = '".$_POST["cat_id"]."', depamount = '".$_POST["depositpayment"]."', advamount = '".$_POST["advancepayment"]."', dep_month = '".$_POST["monthlydepamt"]."', adv_month = '".$_POST["monthlyadvamt"]."', UnitType = '".$_POST["unittype"]."', ClassID = '".$_POST["classid"]."', LCA_length = '".$_POST["sqm_length"]."', LCA_width = '".$_POST["sqm_width"]."', desired_noofmonths = '".$_POST["monthnum"]."', desired_noofdays = '".$_POST["daynum"]."', date_modified = '".date($datenow." H:i:s")."', mod_by = '".$row_user["lastname"].", ".$row_user["firstname"]." ".$row_user["middlename"]."', month_adv = '".$_POST["selectedmonth"]."', payment_terms = '".$_POST["pymentterms"]."', payment_type = '".$_POST["pymenttype"]."', req_status = '". $_POST['req'] ."', monthly_dues = '". $_POST['totalsqm'] ."', assoc_dues = '". $_POST['assocdues'] ."', cardtype = '". $_POST['cardtype'] ."', cardholder = '". $_POST['cardholder'] ."', authno = '". $_POST['authno'] ."', seccode = '". $_POST['securitycode'] ."', expirydate = '". $_POST['expirydate'] ."', bankfrom = '". $_POST['bankfrom'] ."', bf_accno =  '". $_POST['bf_accno'] ."', bankto = '". $_POST['bankto'] ."', bt_accno = '". $_POST['bt_accno'] ."', owner_card_number = '". $_POST['ccno'] ."' WHERE Inquiry_ID = '".$_POST["id"]."'";
					$result = mysql_query($sql, $connection);
					if($result == true)
					{
						echo 1;
					}
				}


				// $selectt = "SELECT COUNT(*) FROM tblref_unit_lca_dummy WHERE inquiryID = '".$_POST["id"]."'";
				// $resss = mysql_query($selectt, $connection);
				// $rowww = mysql_fetch_array($resss);

				// if($rowww[0] == 0)
				// {
				// 	if($_POST["unittype"] == "LCA")
				// 	{
				// 		$sqlunit = "INSERT INTO tblref_unit_lca_dummy (inquiryID, appID, UnitName, width, ulength, amountpersqm, totalamountsqm, FlrName, WingID, MallID, xStat) VALUES('". $_POST["id"] ."', '', '". $_POST["lca_unitname"] ."', '". $_POST["sqm_width"] ."', '". $_POST["sqm_length"] ."', '". $_POST["persqm"] ."', '". $_POST["totalsqm"] ."', '". $_POST["unitfloor"] ."', '". $_POST["unitwing"] ."', '". $_POST["mallid"] ."', 'inquired')";
				// 		$sqlresit = mysql_query($sqlunit, $connection);
				// 	}
				// }
				// else
				// {
				// 	if($_POST["unittype"] == "LCA" && $_POST["lca_unitname"] != "")
				// 	{
				// 		$sqlunit = "UPDATE tblref_unit_lca_dummy SET UnitName = '". $_POST["lca_unitname"] ."', width = '". $_POST["sqm_width"] ."', ulength = '". $_POST["sqm_length"] ."', amountpersqm = '". $_POST["persqm"] ."', totalamountsqm = '". $_POST["totalsqm"] ."', FlrName = '". $_POST["unitfloor"] ."', WingID = '". $_POST["unitwing"] ."', MallID = '". $_POST["mallid"] ."', xStat = 'applied' WHERE inquiryID = '".$_POST["id"]."'";
				// 		$sqlresit = mysql_query($sqlunit, $connection);
				// 	}
				// }
		break;

		case 'editinquiry':
			$sql = "SELECT Inquiry_ID, Mall, Mall_ID, Trade_Name, Company_Name, Industry, Industry_ID, Address, Contact_Person, Firstname, Middlename, Lastname, Mobile_No, Tel_No, Remarks, User_ID, Email FROM tbltrans_inquiry WHERE Inquiry_ID = '".$_POST["id"]."'";
			$result = mysql_query($sql, $connection);
			$row = mysql_fetch_array($result);

			echo $row["Inquiry_ID"] ."|". $row["Mall"] ."|". $row["Mall_ID"] ."|". $row["Trade_Name"] ."|". $row["Company_Name"] ."|". $row["Industry"] ."|". $row["Address"] ."|". $row["Contact_Person"] ."|". $row["Firstname"] ."|". $row["Middlename"] ."|". $row["Lastname"] ."|". $row["Mobile_No"] ."|". $row["Tel_No"] ."|". $row["Remarks"] ."|". $row["User_ID"] ."|". $row["Industry_ID"] ."|". $row["Email"];
		break;

		case 'leaseapplication':
			$sql = "SELECT Inquiry_ID, Mall, Mall_ID, Trade_Name, Company_Name, Industry, Address, Contact_Person, Firstname, Middlename, Lastname, Mobile_No, Tel_No, Remarks, User_ID, Industry_ID, Email FROM tbltrans_inquiry WHERE Inquiry_ID = '".$_POST["id"]."'";
			$result = mysql_query($sql, $connection);
			$row = mysql_fetch_array($result);

			echo $row["Inquiry_ID"] ."|". $row["Mall"] ."|". $row["Mall_ID"] ."|". $row["Trade_Name"] ."|". $row["Company_Name"] ."|". $row["Industry"] ."|". $row["Address"] ."|". $row["Contact_Person"] ."|". $row["Firstname"] ."|". $row["Middlename"] ."|". $row["Lastname"] ."|". $row["Mobile_No"] ."|". $row["Tel_No"] ."|". $row["Remarks"] ."|". $row["User_ID"]. "|" .$row["Industry_ID"] . "|" . $row["Email"] . "|";
		break;
		// ========================================================================================================================================


		// ======================================================= LEASING APPLICATION ============================================================
		case 'saveleasingapplication':
			$datenow = getsysdate();
			$sql_user = "SELECT firstname, middlename, lastname FROM tbluser WHERE userid = '".$_COOKIE["userid"]."'";
       		$res = mysql_query($sql_user, $connection);
       		$row_user = mysql_fetch_array($res);

			$app = createidno("APP", "tbltrans_appid", "app_id");
			$insertapp_id = mysql_query("INSERT INTO tbltrans_appid (app_id)VALUES('".$app."')");
			$sql_updateinq = "UPDATE tbltrans_inquiry SET Application_ID = '".$app."', DepartmentID = '".$_POST["dep_id"]."', CategoryID = '".$_POST["cat_id"]."', UnitID = '".$_POST["unit_id"]."', applicationDate = '".$datenow."', datefrom = '".$_POST["datefrom"]."', dateto = '".$_POST["dateto"]."', req_status = '".$_POST["req"]."', LCA_length = '".$_POST["sqm_length"]."', LCA_width = '".$_POST["sqm_width"]."', desired_noofmonths = '".$_POST["monthnum"]."', desired_noofdays = '".$_POST["daynum"]."', date_modified = '".date($datenow." H:i:s")."', mod_by = '".$row_user["lastname"].", ".$row_user["firstname"]." ".$row_user["middlename"]."', app_by = '".$row_user["lastname"].", ".$row_user["firstname"]." ".$row_user["middlename"]."', date_applied = '".date($datenow." H:i:s")."', month_adv = '".$_POST["selectedmonth"]."', payment_terms = '".$_POST["pymentterms"]."', payment_type = '".$_POST["pymenttype"]."' WHERE Inquiry_ID = '".$_POST["id"]."'";
			$result2 = mysql_query($sql_updateinq, $connection);
			if($result2 == true)
			{
				echo $app."|";
			}

			$logs = create_logs("created a new leasing application.", "Leasing Application Module", $app."|".$_POST["dep_id"]."|".$_POST["cat_id"]."|".$_POST["unit_id"]."|".$datenow."|".$_POST["datefrom"]."|".$_POST["dateto"]."|".$_POST["req"]."|".$_POST["sqm_length"]."|".$_POST["sqm_width"]."|".$_POST["monthnum"]."|".$_POST["daynum"]."|".$row_user["lastname"].", ".$row_user["firstname"]." ".$row_user["middlename"]."|".$_POST["id"], "ADD");

			$tran_logs = create_logs_per_transaction("created a new leasing application.", "Leasing Application Module", $app."|".$_POST["dep_id"]."|".$_POST["cat_id"]."|".$_POST["unit_id"]."|".$datenow."|".$_POST["datefrom"]."|".$_POST["dateto"]."|".$_POST["req"]."|".$_POST["sqm_length"]."|".$_POST["sqm_width"]."|".$_POST["monthnum"]."|".$_POST["daynum"]."|".$row_user["lastname"].", ".$row_user["firstname"]." ".$row_user["middlename"]."|".$_POST["id"], "ADD", $_POST["id"], $app, "");

			$updatelogs = "UPDATE tbllogs_per_trans SET appID = '".$app."' WHERE inqID = '".$_POST["id"]."'";
			$resultudatelogs = mysql_query($updatelogs, $connection);

			// $select = "SELECT COUNT(*) FROM tblref_unit_lca_dummy WHERE inquiryID = '".$_POST["id"]."'";
			// $result_select = mysql_query($select, $connection);
			// $sel = mysql_fetch_array($result_select);

			// if($sel[0] == 0)
			// {
			// 	if($_POST["unittype"] == "LCA")
			// 	{
			// 		$sqlunit = "INSERT INTO tblref_unit_lca_dummy (inquiryID, UnitName, width, ulength, amountpersqm, totalamountsqm, FlrName, WingID, MallID, xStat, inquiryID)VALUES('". $_POST["id"] ."', '". $_POST["lca_unitname"] ."', '". $_POST["sqm_width"] ."', '". $_POST["sqm_length"] ."', '". $_POST["persqm"] ."', '". $_POST["totalsqm"] ."', '". $_POST["unitfloor"] ."', '". $_POST["unitwing"] ."', '". $_POST["mallid"] ."', 'applied', '".$_POST["id"]."')";
			// 		$sqlresit = mysql_query($sqlunit, $connection);
			// 	}
			// }
			// else
			// {
			// 	if($_POST["unittype"] == "LCA" && $_POST["lca_unitname"] != "")
			// 	{
			// 		$sqlunit = "UPDATE tblref_unit_lca_dummy SET UnitName = '". $_POST["lca_unitname"] ."', width = '". $_POST["sqm_width"] ."', ulength = '". $_POST["sqm_length"] ."', amountpersqm = '". $_POST["persqm"] ."', totalamountsqm = '". $_POST["totalsqm"] ."', FlrName = '". $_POST["unitfloor"] ."', WingID = '". $_POST["unitwing"] ."', MallID = '". $_POST["mallid"] ."', xStat = 'applied' WHERE inquiryID = '".$_POST["id"]."'";
			// 		$sqlresit = mysql_query($sqlunit, $connection);
			// 	}
			// }

		break;

		case 'savecontactinfo':
			$arr = explode("|", $_POST["contactperson"]);
			$custID = createidno("CON", "tbltrans_leasingapplication_contactperson", "custID");
			$aff_sql = "INSERT INTO tbltrans_leasingapplication_contactperson(custID, inqID, appID, name, designation, address, email_address, mobnum, telnum) VALUES('".$custID."', '".$_POST["inq"]."','".$_POST["app"]."', '" . $arr[1] . "','" . $arr[2] . "','" . $arr[3] . "','" . $arr[4] . "','" . $arr[5] . "','" . $arr[6] . "')";
			$aff_result = mysql_query($aff_sql, $connection);

			if($aff_result == true)
			{
				echo $custID;
			}
		break;

		case 'loadapplication':
			$sql = "SELECT tradename, companyname, industry, address, company_telno, company_faxno, company_email, company_website, company_franchisor, company_owner_firstname, company_owner_midname, company_owner_lastname, company_owner_civilstat, company_owner_home_address, company_contact_firstname, company_contact_midname, company_contact_lastname, company_contact_designation, company_contact_mobno, company_contact_telno, merchandise_dep_name, merchandise_dep_id, merchandise_class_name, merchandise_class_id, merchandise_cat_name, merchandise_cat_id, company_owner_permanent_address, company_owner_billing_address, industryID FROM tbltrans_leasingapplication WHERE applicationID = '".$_POST["appid"]."' AND inquiryID = '".$_POST["inqid"]."'";
			$result = mysql_query($sql, $connection);
			$row = mysql_fetch_array($result);

			echo $row["tradename"] ."|". $row["companyname"] ."|". $row["industry"] ."|". $row["address"] ."|". $row["company_telno"] ."|". $row["company_faxno"] ."|". $row["company_email"] ."|". $row["company_website"] ."|". $row["company_franchisor"] ."|". $row["company_owner_firstname"] ."|". $row["company_owner_midname"] ."|". $row["company_owner_lastname"] ."|". $row["company_owner_civilstat"] ."|". $row["company_owner_home_address"] ."|". $row["company_contact_firstname"] ."|". $row["company_contact_midname"] ."|". $row["company_contact_lastname"] ."|". $row["company_contact_designation"] ."|". $row["company_contact_mobno"] ."|". $row["company_contact_telno"] ."|". $row["merchandise_dep_name"] ."|". $row["merchandise_dep_id"] ."|". $row["merchandise_class_name"] ."|". $row["merchandise_class_id"] ."|". $row["merchandise_cat_name"] ."|". $row["merchandise_cat_id"] ."|". $row["company_owner_permanent_address"] ."|". $row["company_owner_billing_address"] ."|". $row["industryID"] . "|";
		break;

		case 'loadcontactper_application':
			$sql = "SELECT custID, inqID, appID, name, designation, address, email_address, mobnum, telnum, filename FROM tbltrans_leasingapplication_contactperson WHERE appID = '".$_POST["appid"]."' AND inqID = '".$_POST["inqid"]."'";
			$result = mysql_query($sql, $connection);
			while($row = mysql_fetch_array($result))
			{
				echo "<div class='alert alert-info div_contact_person'><center><div class='image'><img class='img-thumbnail imageName form-control' src='server/" . $row["appID"]  . "/contact/" . $row["filename"] . "' style='border: 2px solid #bdc3c7; margin-bottom: 8px;height: 160px;width:90%;'></div></center><p style='font-size: 14px; font-weight: bold;margin: 0px !important;' class='contact_person_lastname'>".$row["name"]."</p><p style='font-size: 14px; font-weight: normal;margin: 0px !important;' class='contact_person_designation'>".$row["designation"]."</p><p style='font-size: 10px; font-weight: normal;margin: 0px !important;' class='address_person'>".$row["address"]."</p><p style='font-size: 10px; font-weight: normal;margin: 0px !important;font-style: underline;' class='contact_person_emailadd'>".$row["email_address"]."</p><p style='font-size: 12px; font-weight: normal;font-style: italic;margin: 0px !important;' class='contact_person_mobno'>".$row["mobnum"]."</p><p style='font-size: 12px; font-weight: normal;font-style: italic;margin: 0px !important;' class='contact_person_telno'>".$row["telnum"]."</p></div>";
			}
		break;

		case 'loadrequirements_application':
			$i = 0;
			$sql = "SELECT id, requirements, override FROM tblref_applicationrequirements";
			$result = mysql_query($sql, $connection);
			while($row = mysql_fetch_array($result))
			{
				$sql2 = "SELECT filename, filetype, filename FROM tbltrans_leasingapplicationreq WHERE appID = '".$_POST["appid"]."' AND reqID = '".$_POST["inqid"]."' AND type_req_ID = '".$row["id"]."'";
				$result2 = mysql_query($sql2, $connection);
				$row2 = mysql_fetch_array($result2);
				$num = mysql_num_rows($result2);

				if($num == 0 && $row[2] == "0")
				{
					$i++;
					$id = "posting_commentreq_".$i;
					$file = '<div class="row">
							 	<div class="col-xs-4">'.$row["requirements"].'</div>
							 	<div class="col-xs-1"><i style="color:red;margin-top:5px;" class="ace-icon fa fa-remove bigger-120" id="'.$id.'_icon"></i></div>';
					$file .= '	<div class="col-xs-5" style="white-space: nowrap;text-overflow: ellipsis;overflow: hidden;">';
					$file .= '	<form name="posting_comment" class="form_lease_application_req_2" id="posting_commentreq_'.$i.'">
		                              <div style="display: none">
		                                <input type="text" name="txtaapid" class="txtaapid" value="'.$_POST["appid"].'">
		                                <input type="text" name="txtinqqid" class="txtinqqid" value="'.$_POST["inqid"].'">
		                              </div>
                                		<input type="file" class="upload_app_req id-input-file-2" name="attachment_filess" onchange="chkclippeddocx($(this))"/><input type="hidden" name="hiddenidss" value="'.$row["id"].'">
                              </form>
                              	</div>
                              </div>';
				}else if($num == 0 && $row[2] == "1"){
					$i++;
					$id = "posting_commentreq_".$i;
					$file = '<div class="row">
							 	<div class="col-xs-4">'.$row["requirements"].'</div>
							 	<div class="col-xs-1"><i style="color:red;margin-top:5px;" class="ace-icon fa fa-remove bigger-120" id="'.$id.'_icon"></i></div>';
					$file .= '	<div class="col-xs-5" style="white-space: nowrap;text-overflow: ellipsis;overflow: hidden;">';
					$file .= '	<form name="posting_comment" class="form_lease_application_req_2" id="posting_commentreq_'.$i.'">
		                              <div style="display: none">
		                                <input type="text" name="txtaapid" class="txtaapid" value="'.$_POST["appid"].'">
		                                <input type="text" name="txtinqqid" class="txtinqqid" value="'.$_POST["inqid"].'">
		                              </div>
                                		<input type="file" class="upload_app_req id-input-file-2" name="attachment_filess" id="overridemoko'.$row["id"].'" onchange="chkclippeddocx($(this))"/><input type="hidden" name="hiddenidss" value="'.$row["id"].'">
                              </form>
                              	</div>
                              	<div class="col-xs-1"><button class="btn btn-xs btn-primary overridebutton" onclick="showmodal_login_override(\''.$row[0].'\', \''.$i.'\', \''.$_POST["appid"].'\', \''.$_POST["inqid"].'\');">Override</button></div>
                              </div>';
				}
				else
				{
					$file = '<div class="row">
							 <div class="col-xs-4">'.$row["requirements"].'</div><div class="col-xs-1"><i style="color:green;" class="ace-icon fa fa-check bigger-120"></i></div>';
					$file .= '<div class="col-xs-5" style="white-space: nowrap;text-overflow: ellipsis;overflow: hidden;">';
					$file .= '<button class="btn btn-xs btn-info" style="padding:2px;margin-bottom:3px;margin-left:2px;display:inline;">
								<a href="server/Requirements/'.$_POST["appid"].'/'.$row["requirements"].'/'.$row2["filename"].'" download><i style="color:white !important;" class="ace-icon fa fa-arrow-down bigger-120"></i></a>
							  </button>';

							$linkimage = 'server/Requirements/'.$_POST["appid"].'/'.$row["requirements"].'/'.$row2["filename"];
							if($row2["filetype"] == "image/jpeg" || $row2["filetype"] == "image/png" || $row2["filetype"] == "image/jpg")
							{
								$file .= "<button class='btn btn-xs btn-purple' style='padding:2px;margin-bottom:3px;margin-left:2px;display:inline;' onclick='load_req_image(\"". $linkimage ."\")' title='view image'>
									<i class='ace-icon fa fa-picture-o bigger-120'></i>
									</button>";
							}
							else
							{
								$file .= '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
							}

					$file .= '<p class="req_nam_'.$_POST["appid"].' req_already_added_na" id="'.$row2["filename"].'" style="font-size:11px;font-weight:normal;font-style:italic;display:inline;">&nbsp;&nbsp;'.$row2["filename"].'</p></div>
							</div>';
				}



				echo $file;
			}
		break;

		case 'loadrequirements_application2':
			$i = 0;
			$sql = "SELECT id, requirements FROM tblref_applicationrequirements";
			$result = mysql_query($sql, $connection);
			while($row = mysql_fetch_array($result))
			{
				$sql2 = "SELECT filename, filetype, filename FROM tbltrans_leasingapplicationreq WHERE appID = '".$_POST["appid"]."' AND reqID = '".$_POST["inqid"]."' AND type_req_ID = '".$row["id"]."'";
				$result2 = mysql_query($sql2, $connection);
				$row2 = mysql_fetch_array($result2);
				$num = mysql_num_rows($result2);

				if($num == 0)
				{
					$i++;
					$id = "posting_commentreq_".$i;
					$file = '<div class="row">
							 <div class="col-xs-6">'.$row["requirements"].'</div><div class="col-xs-1"><i style="color:red;margin-top:5px;" class="ace-icon fa fa-remove bigger-120" id="'.$id.'_icon"></i></div>';
					$file .= '<div class="col-xs-5" style="white-space: nowrap;text-overflow: ellipsis;overflow: hidden;">';
					$file .= '<form name="posting_comment" class="form_lease_application_req" id="posting_commentreq_'.$i.'">
                              <div style="display: none;">
                                <input type="text" name="txtaapid" class="txtaapid" value="'.$_POST["appid"].'" id="txtappid_form_'.$i.'"><br />
                                <input type="text" name="txtinqqid" class="txtinqqid" value="'.$_POST["inqid"].'" id="txtinqid_form_'.$i.'">
                              </div>
                                <input type="file" class="upload_app_req id-input-file-2" name="attachment_filess" onchange="chkclippeddocx($(this))" '.$_POST["inputt"].'/><input type="hidden" name="hiddenidss" value="'.$row["id"].'">
                              </form></div></div>';
				}
				else
				{
					$file = '<div class="row">
							 <div class="col-xs-6">'.$row["requirements"].'</div><div class="col-xs-1"><i style="color:green;" class="ace-icon fa fa-check bigger-120"></i></div>';
					$file .= '<div class="col-xs-5" style="white-space: nowrap;text-overflow: ellipsis;overflow: hidden;">';
					$file .= '<button class="btn btn-xs btn-info" style="padding:2px;margin-bottom:3px;margin-left:2px;display:inline;">
								<a href="server/Requirements/'.$_POST["appid"].'/'.$row["requirements"].'/'.$row2["filename"].'" download><i style="color:white !important;" class="ace-icon fa fa-arrow-down bigger-120"></i></a>
							  </button>';

							$linkimage = 'server/Requirements/'.$_POST["appid"].'/'.$row["requirements"].'/'.$row2["filename"];
							if($row2["filetype"] == "image/jpeg" || $row2["filetype"] == "image/png" || $row2["filetype"] == "image/jpg")
							{
								$file .= "<button class='btn btn-xs btn-purple' style='padding:2px;margin-bottom:3px;margin-left:2px;display:inline;' onclick='load_req_image(\"". $linkimage ."\")' title='view image'>
									<i class='ace-icon fa fa-picture-o bigger-120'></i>
									</button>";
							}
							else
							{
								$file .= '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
							}

					$file .= '<p class="req_nam_'.$_POST["appid"].'" id="'.$row2["filename"].'" style="font-size:11px;font-weight:normal;font-style:italic;display:inline;">&nbsp;&nbsp;'.$row2["filename"].'</p></div>
							</div>';
				}



				echo $file;
			}
		break;

		case 'loadimageacc_application':
			$sql = "SELECT filename FROM tbltrans_leasingapplication_dp WHERE appID = '".$_POST["appid"]."' AND reqID = '".$_POST["inqid"]."'";
			$result = mysql_query($sql, $connection);
			$row = mysql_fetch_array($result);
			if($row["filename"] != "")
			{
				echo "server/".$_POST["appid"]."/profile/".$row["filename"]."";
			}

		break;

		case 'loadtelno_application':
			$sql = "SELECT tel_no FROM tbltrans_leasingapplication_owner_telno WHERE applicationID = '".$_POST["appid"]."' AND inquiryID = '".$_POST["inqid"]."'";
			$result = mysql_query($sql, $connection);
			while($row = mysql_fetch_array($result))
			{
				echo "<input tye='text' class='form-control numonly' value='".$row["tel_no"]."' style='margin-bottom:5px;' maxlength='11'>";
			}
			echo "<div class='input-group'><input type='text' id='spinner3' class='spinbox-input form-control numonly' maxlength='11'><div class='spinbox-buttons input-group-btn'><button type='button' class='btn spinbox-up btn-sm btn-success' onclick='div_addtel()'><i class='icon-only  ace-icon ace-icon fa fa-plus bigger-110'></i></button></div></div>";
		break;

		case 'loadaffiliate_application':
			$sql = "SELECT company_name, line_of_business, address, tel_no FROM tbltrans_leasingapplication_affiliated WHERE applicationID = '".$_POST["appid"]."' AND inquiryID = '".$_POST["inqid"]."'";
			$result = mysql_query($sql, $connection);
			while($row = mysql_fetch_array($result))
			{
				echo "<div class='alert alert-info business_affiliated'><p style='font-size: 14px; font-weight: bold;margin: 0px !important;' class='business_affiliated_compname'>".$row["company_name"]."</p><p style='font-size: 14px; font-weight: normal;margin: 0px !important;' class='business_affiliated_lineofbusiness'>".$row["line_of_business"]."</p><p style='font-size: 10px; font-weight: normal;margin: 0px !important;' class='business_affiliated_address'>".$row["address"]."</p><p style='font-size: 12px; font-weight: normal;font-style: italic;margin: 0px !important;' class='business_affiliated_telnum'>".$row["tel_no"]."</p></div>";
			}
		break;

		case 'savereservation_application':
		$select = "SELECT company_contact_firstname, company_contact_midname, company_contact_lastname, company_contact_designation, company_contact_mobno, company_contact_telno, Status FROM tbltrans_leasingapplication WHERE applicationID = '".$_POST["appid"]."' AND inquiryID = '".$_POST["inqid"]."'";
		$res_select = mysql_query($select, $connection);
		$row = mysql_fetch_array($res_select);
		if($_POST["stat"] == "3")
		{
			$statss = "3";
		}
		else
		{
			$statss = $_POST["stats"];
		}
			if($_POST["resid"] == "")
			{
				$transID = createidno("RES", "tbltrans_reservation", "transID");
				$sql = "INSERT INTO tbltrans_reservation (appID, transID, inqID, tradename , companyname , industry , address , compinf_telno , compinf_faxno , compinf_email , compinf_website , compinf_Franchisor , compinf_ownerfirstname , compinf_ownermidname , compinf_ownerlastname , compinf_stat , compinf_address , merchandise_dep , dep_id , merchandise_class , class_id , merchandise_cat , cat_id , resapp_mall , mall_id , resapp_flr , flr_id , resapp_wing , wing_id , resapp_class , classification_id , resapp_unit , datepayment , alertdate , remarks , accof , alerttype_cus , alerttype_email, Status, contact_firstname, contact_midname, contact_lastname, contact_designation, contact_mobno, contact_telno, unitID, datefrom, dateto, amount) VALUES('".$_POST["appid"]."','". $transID ."','". $_POST["inqid"] ."', '". $_POST["tradename"] ."', '". $_POST["companyname"] ."', '". $_POST["industry"] ."', '". $_POST["address"] ."', '". $_POST["compinf_telno"] ."', '". $_POST["compinf_faxno"] ."', '". $_POST["compinf_email"] ."', '". $_POST["compinf_website"] ."', '". $_POST["compinf_Franchisor"] ."', '". $_POST["compinf_ownerfirstname"] ."', '". $_POST["compinf_ownermidname"] ."', '". $_POST["compinf_ownerlastname"] ."', '". $_POST["compinf_stat"] ."', '". $_POST["compinf_address"] ."', '". $_POST["merchandise_dep"] ."', '". $_POST["dep_id"] ."', '". $_POST["merchandise_class"] ."', '". $_POST["class_id"] ."', '". $_POST["merchandise_cat"] ."', '". $_POST["cat_id"] ."', '". $_POST["resapp_mall"] ."', '". $_POST["mall_id"] ."', '". $_POST["resapp_flr"] ."', '". $_POST["flr_id"] ."', '". $_POST["resapp_wing"] ."', '". $_POST["wing_id"] ."', '". $_POST["resapp_class"] ."', '". $_POST["classification_id"] ."', '". $_POST["resapp_unit"] ."', '". $_POST["datepayment"] ."', '". $_POST["alertdate"] ."', '". $_POST["remarks"] ."', '". $_POST["accof"] ."', '". $_POST["alerttype_cus"] ."', '". $_POST["alerttype_email"] ."', '". $statss ."', '". $row["company_contact_firstname"] ."', '". $row["company_contact_midname"] ."', '". $row["company_contact_lastname"] ."', '". $row["company_contact_designation"] ."', '". $row["company_contact_mobno"] ."', '". $row["company_contact_telno"] ."', '".$row["unit_id"]."', '". $_POST["datefrom"] ."', '". $_POST["dateto"] ."', '". $_POST["amountpayment"] ."')";
				$result = mysql_query($sql, $connection);

				if($result == true)
				{
					$statchange = "UPDATE tbltrans_leasingapplication SET Status = '".$statss."' WHERE applicationID = '".$_POST["appid"]."' AND inquiryID = '".$_POST["inqid"]."'";
					$resstat = mysql_query($statchange, $connection);
					if($resstat == true)
					{
						if($_POST["stat"] == "3")
						{
							echo 3; //reserved
						}
						else
						{

								echo 1; //reserved
						}
					}
				}
			}
			else
			{
				$sql = "UPDATE tbltrans_reservation SET tradename = '". $_POST["tradename"] ."', companyname = '". $_POST["companyname"] ."', industry = '". $_POST["industry"] ."', address = '". $_POST["address"] ."', compinf_telno = '". $_POST["compinf_telno"] ."', compinf_faxno = '". $_POST["compinf_faxno"] ."', compinf_email = '". $_POST["compinf_email"] ."', compinf_website = '". $_POST["compinf_website"] ."', compinf_Franchisor = '". $_POST["compinf_Franchisor"] ."', compinf_ownerfirstname = '". $_POST["compinf_ownerfirstname"] ."', compinf_ownermidname = '". $_POST["compinf_ownermidname"] ."', compinf_ownerlastname = '". $_POST["compinf_ownerlastname"] ."', compinf_stat = '". $_POST["compinf_stat"] ."', compinf_address = '". $_POST["compinf_address"] ."', merchandise_dep = '". $_POST["merchandise_dep"] ."', dep_id = '". $_POST["dep_id"] ."', merchandise_class = '". $_POST["merchandise_class"] ."', class_id = '". $_POST["class_id"] ."', merchandise_cat = '". $_POST["merchandise_cat"] ."', cat_id = '". $_POST["cat_id"] ."', resapp_mall = '". $_POST["resapp_mall"] ."', mall_id = '". $_POST["mall_id"] ."', resapp_flr = '". $_POST["resapp_flr"] ."', flr_id = '". $_POST["flr_id"] ."', resapp_wing = '". $_POST["resapp_wing"] ."', wing_id = '". $_POST["wing_id"] ."', resapp_class = '". $_POST["resapp_class"] ."', classification_id = '". $_POST["classification_id"] ."', resapp_unit = '". $_POST["resapp_unit"] ."', datepayment = '". $_POST["datepayment"] ."', alertdate = '". $_POST["alertdate"] ."', remarks = '". $_POST["remarks"] ."', accof = '". $_POST["accof"] ."', alerttype_cus = '". $_POST["alerttype_cus"] ."', alerttype_email= '". $_POST["alerttype_email"] ."', Status = '". $statss ."', unitID = '".$row["unit_id"]."', datefrom = '". $_POST["datefrom"] ."', dateto = '". $_POST["dateto"] ."', amount = '". $_POST["amountpayment"] ."' WHERE transID = '". $_POST["resid"] ."'";
				$result = mysql_query($sql, $connection);

				if($result == true)
				{
					$statchange = "UPDATE tbltrans_leasingapplication SET Status = '".$statss."' WHERE applicationID = '".$_POST["appid"]."' AND inquiryID = '".$_POST["inqid"]."'";
					$resstat = mysql_query($statchange, $connection);
					if($resstat == true)
					{
						if(($_POST["stat"] == "3" && $_POST["stats"] == "3") || ($_POST["stat"] == "1" && $_POST["stats"] == "1" && $row["Status"] != "3" && $row["Status"] != "2") ||  ($_POST["stat"] == "1" && $_POST["stats"] == "4" && $row["Status"] != "3" && $row["Status"] != "2"))
						{
							echo 4; //Modified
						}
						else
						{
							if($_POST["stat"] == "3")
							{
								echo 3; //waiting
							}
							else
							{

									echo 1; //Reserved
							}
						}
					}
				}

			}
		break;
		// ========================================================================================================================================


		// ================================================== LEASING APPLICATIONS MODULE =========================================================
		case 'loadleasingapplications':
			$cnt_fltr = 0;
			$sql_filter = mysql_fetch_array(mysql_query("SELECT checked_value, otherfilter, bystat, xcheck FROM tblref_filters WHERE module = 'Application'"));
			$trby = explode("|", $sql_filter["checked_value"]);
			$stat = explode("|", $sql_filter["bystat"]);
			$unit = explode("|", $sql_filter["xcheck"]);
			$date = explode("|", $sql_filter["otherfilter"]);
			$filter = "";

			// filter for status
			$cnt = 0; $chk = "";
			for($a = 0; $a<=count($stat)-1; $a++)
			{
				if($stat[$a] == "Pending"){ $con = "(Status = 'Pending' AND Application_ID != '')"; }
				else if($stat[$a] == "ForApproval"){ $con = "(Status = 'For Approval')"; }
				else if($stat[$a] == "Approved"){ $con = "(Status = 'Tentative')"; }
				else if($stat[$a] == "Disapproved"){ $con = "(Status = 'Disapproved' AND Application_ID != '')"; }
				else if($stat[$a] == "Reserved"){ $con = "(Status = 'Confirmed')"; }
				else if($stat[$a] == "Cancelled"){ $con = "(Status = 'Cancelled')"; }
				else if($stat[$a] == "Occupied"){ $con = "(Status = 'Occupied')"; }

				if($stat[$a] != "")
				{
					$cnt_fltr++;
					$cnt++;
					if($cnt == 1)
					{
						$chk .= $con;
					}
					else
					{
						$chk .= " OR ".$con;
					}
				}
			}

			if($cnt > 1)
			{
				$Stat_fltr = "(".$chk.")";
			}
			else
			{
				$Stat_fltr = $chk;
			}
			if($cnt > 0)
			{
				$and = " AND ";
			}
			else
			{
				$and = "";
			}
			// filter for unit type
			$cnt2 = 0; $chk2 = "";
			for($b = 0; $b<=count($unit)-1; $b++)
			{
				if($unit[$b] != "")
				{
					$cnt_fltr++;
					$cnt2++;
					if($cnt2 == 1)
					{
						$chk2 .= "UnitType = '".$unit[$b]."'";
					}
					else
					{
						$chk2 .= " OR UnitType = '".$unit[$b]."'";
					}
				}
			}
			if($cnt2 > 1)
			{
				$Unit_fltr = "(".$chk2.")";
			}
			else
			{
				$Unit_fltr = $chk2;
			}

			if($cnt2 > 0)
			{
				$and1 = " AND ";
			}
			else
			{
				$and1 = "";
			}
			// filter by date
			$date_fltr = "(date_inquired BETWEEN '".date("Y-m-d", strtotime($date[0]))."' AND '".date("Y-m-d", strtotime($date[1]))."')";

			// filter by
			$cnt3 = 0; $chk3 = "";
			for($c = 0; $c<=count($trby)-1; $c++)
			{
				if($trby[$c] != "")
				{
					$cnt_fltr++;
					$cnt3++;
					if($cnt3 == 1)
					{
						$chk3 .= $trby[$c] . " LIKE '%".$_POST["key"]."%'";
					}
					else
					{
						$chk3 .= " OR ". $trby[$c] . " LIKE '%".$_POST["key"]."%'";
					}
				}
			}
			if($cnt3 > 1)
			{
				$by_fltr = "(".$chk3.")";
			}
			else
			{
				$by_fltr = $chk3;
			}
			if($cnt3 > 0)
			{
				$and2 = " AND ";
			}
			else
			{
				$and2 = "";
			}

			if($cnt > 0 && $cnt2 > 0)
			{
				$filterselected = "WHERE ".$Stat_fltr . "".$and."" . $Unit_fltr . "".$and1."" . $date_fltr . "".$and2."" . $by_fltr;

				$page = ($_POST["page"] || 1);
				$limit = ($page-1) * 20;

				$lstatus = "AND Status LIKE '%".$_POST['lstatus']."%' ";

					$sql = "SELECT TradeID, Company_ID, Inquiry_ID, UnitID, Application_ID, Trade_Name, Company_Name, Industry, Company_ID, applicationDate, Status, req_status, UnitType, Mall_ID FROM tbltrans_inquiry ".$filterselected." ORDER BY Application_ID DESC LIMIT ".$limit.", 20";
					$result = mysql_query($sql, $connection);
					// echo $sql;
					while($row = mysql_fetch_array($result))
					{
						$email = "";
						$mobile = "";
						$telephone = "";
						$fax = "";
						$website = "";
						$email2 = 0;
						$mobile2 = 0;
						$telephone2 = 0;
						$fax2 = 0;
						$website2 = 0;

						if($row["Status"] == "Pending" && $row["Application_ID"] != "")
						{

							$stat = "<span class='label label-sm label-pink'>Pending Application</span>";
						}
						else if($row["Status"] == "For Approval")
						{
							$stat = "<span class='label label-sm label-sm label-success'>For Approval</span>";
						}
						else if($row["Status"] == "Tentative")
						{
							$stat = "<span class='label label-sm label-info'>Approved Application</span>";
						}
						else if($row["Application_ID"] != "" && $row["Status"] == "Disapproved")
						{
							$stat = "<span class='label label-sm label-danger'>Disapproved Application</span>";
						}
						else if($row["Status"] == "Tentative" || $row["Status"] == "Confirmed")
						{
							$stat = "<span class='label label-sm label-yellow'>Reserved</span>";
						}
						else if($row["Status"] == "Occupied")
						{
							$stat = "<span class='label label-sm label-warning'>Occupied</span>";
						}
						else if($row["Status"] == "Cancelled")
						{
							$stat = "<span class='label label-sm label-danger'>Cancelled Reservation</span>";
						}

						if($row["req_status"] == "Completed")
						{
							$reqstat = "<h6 style='color:green;margin-top:3px;'><i class='fa fa-check bigger-110'></i>&nbsp;&nbsp;Completed</h6>";
						}
						else if($row["req_status"] == "Incomplete")
						{
							$reqstat = "<h6 style='color:orange;margin-top:3px;'><i class='fa fa-remove bigger-110'></i>&nbsp;&nbsp;Incomplete</h6>";
						}

						$mobile .= "</div>";
						$telephone .= "</div>";
						$fax .= "</div>";
						$email .= "</div>";
						echo "<tr>
						<td class='hide_mobile'>".$row["Application_ID"]."</td>
						<td class='hide_mobile'>".$row["UnitType"]."</td>
						<td class='scroll'>".$row["Trade_Name"]."</td>
						<td class='hide_mobile'>".$row["Company_Name"]."</td>
						<td class='hide_mobile'>".$row["Industry"]."</td>
						<td class='hide_mobile scroll'>".$row["applicationDate"]."</td>
						<td class='hide_mobile'>".$reqstat."</td>
						<td class='hide_mobile'>".$stat."</td>
						<td>";

						if($row["req_status"] == "Incomplete")
						{
							echo"<div class='hidden-sm hidden-xs btn-group'>
								<button class='btn btn-xs btn-gray' onclick='previewleasingapp(\"". $row["TradeID"] ."\",\"". $row["Company_ID"] ."\",\"". $row["Inquiry_ID"] ."\",\"". $row["UnitID"] ."\",\"". $row["Application_ID"] ."\", \"update_application\", \"".$row["Status"]."\")' title='Update Application'>
									<img src='assets/images/edit.png' style='width: 100%; height: auto;' />
								</button>
								<button class='btn btn-xs btn-gray' onclick='loadprintinfo(\"". $row["TradeID"] ."\", \"". $row["Company_ID"] ."\",\"". $row["Inquiry_ID"] ."\",\"". $row["UnitID"] ."\", \"".$row["Mall_ID"]."\")' title='Print Application'>
									<img src='assets/images/printer.png' style='width: 100%; height: auto;'>
								</button>";
						}
						else
						{
							echo"<div class='hidden-sm hidden-xs btn-group'>";
							if($row["Status"] == "Pending")
							{
								echo"<button class='btn btn-xs btn-success' onclick='previewleasingapp(\"". $row["TradeID"] ."\",\"". $row["Company_ID"] ."\",\"". $row["Inquiry_ID"] ."\",\"". $row["UnitID"] ."\",\"". $row["Application_ID"] ."\", \"for_approval\", \"".$row["Status"]."\")' title='Tenant Investigation Report'>
									<img src='assets/images/approve.png' style='width: 100%; height: auto;' />
								</button>";
								echo"<button class='btn btn-xs btn-gray' onclick='previewleasingapp(\"". $row["TradeID"] ."\",\"". $row["Company_ID"] ."\",\"". $row["Inquiry_ID"] ."\",\"". $row["UnitID"] ."\",\"". $row["Application_ID"] ."\", \"update_application\", \"".$row["Status"]."\")' title='Update Application'>
									<img src='assets/images/edit.png' style='width: 100%; height: auto;' />
								</button>";
							}
							else if($row["Status"] == "For Approval")
							{
								echo"<button class='btn btn-xs btn-info' onclick='previewleasingapp(\"". $row["TradeID"] ."\",\"". $row["Company_ID"] ."\",\"". $row["Inquiry_ID"] ."\",\"". $row["UnitID"] ."\",\"". $row["Application_ID"] ."\", \"approve\", \"".$row["Status"]."\")' title='Tenant Application Approval'>
									<img src='assets/images/like.png' style='width: 100%; height: auto;' />
								</button>";
								echo"<button class='btn btn-xs btn-gray' onclick='previewleasingapp(\"". $row["TradeID"] ."\",\"". $row["Company_ID"] ."\",\"". $row["Inquiry_ID"] ."\",\"". $row["UnitID"] ."\",\"". $row["Application_ID"] ."\", \"update_application\", \"".$row["Status"]."\")' title='Update Application'>
									<img src='assets/images/edit.png' style='width: 100%; height: auto;' />
								</button>";
							}
							// else if($row["Status"] == "Tentative")
							// {
								echo"<button class='btn btn-xs btn-gray' onclick='previewleasingapp(\"". $row["TradeID"] ."\",\"". $row["Company_ID"] ."\",\"". $row["Inquiry_ID"] ."\",\"". $row["UnitID"] ."\",\"". $row["Application_ID"] ."\", \"approve\", \"Pending\")' title='View Tenant Application Approval'>
									<img src='assets/images/view.png' style='width: 100%; height: auto;' />
								</button>
								";
							// }
								echo"<button class='btn btn-xs btn-gray' onclick='loadprintinfo(\"". $row["TradeID"] ."\", \"". $row["Company_ID"] ."\",\"". $row["Inquiry_ID"] ."\",\"". $row["UnitID"] ."\", \"".$row["Mall_ID"]."\")' title='Print Application'>
									<img src='assets/images/printer.png' style='width: 100%; height: auto;'>
								</button>
								";
						}
								echo"<button class='btn btn-xs btn-gray' onclick='viewhistoryleasing(\"". $row["Inquiry_ID"] ."\")' title='View Logs'>
											<img src='assets/images/clock.png' style='width: 100%; height: auto;' />
											</button>";

							echo"</div>
						</td>
						</tr>
						";

					}
				// echo $sql;
			}
		break;

		case 'changestatleasingapp':
		$datenow = getsysdate();
		if($_POST["stat"] == "updateremarks")
		{
			$sql = "UPDATE tbltrans_inquiry SET Remarks = '".$_POST["remarks"]."' WHERE Inquiry_ID = '".$_POST["Inquiry_ID"]."' AND Application_ID = '".$_POST["Application_ID"]."'";
			$result = mysql_query($sql, $connection);
			if($result == true)
			{
				echo 2;
				// echo $sql;
			}
		}
		else
		{
			$sql = "UPDATE tbltrans_inquiry SET Status = '".$_POST["stat"]."', Remarks = '".$_POST["remarks"]."' WHERE Inquiry_ID = '".$_POST["Inquiry_ID"]."' AND Application_ID = '".$_POST["Application_ID"]."'";
			$result = mysql_query($sql, $connection);
			if($result == true)
			{
				echo 1;
				// echo $sql;
			}

			if($_POST["stat"] == "For Approval")
			{
				$logs = create_logs("changed the status of a leasing application to \"For Approval\" with ".$_POST["Application_ID"]." application ID.", "Leasing Application Module", "For Approval|".$_POST["Application_ID"]."|".$_POST["Inquiry_ID"], "UPDATE");

				$tran_logs = create_logs_per_transaction("changed the status of a leasing application to \"For Approval\" with ".$_POST["Application_ID"]." application ID.", "Leasing Application Module", "For Approval|".$_POST["Application_ID"]."|".$_POST["Inquiry_ID"], "UPDATE", $_POST["Inquiry_ID"], $_POST["Application_ID"], "");
			}

			if($_POST["stat"] == "Tentative")
			{
				$logs = create_logs("approved a leasing application with ".$_POST["Application_ID"]." application ID.", "Leasing Application Module", $_POST["Application_ID"]."|".$_POST["Inquiry_ID"], "UPDATE");
				$tran_logs = create_logs_per_transaction("approved a leasing application with ".$_POST["Application_ID"]." application ID.", "Leasing Application Module", $_POST["Application_ID"]."|".$_POST["Inquiry_ID"], "UPDATE", $_POST["Inquiry_ID"], $_POST["Application_ID"], "");

				$sql_name = "SELECT firstname, middlename, lastname FROM tbluser WHERE userid = '".$_COOKIE["userid"]."'";
    			$res = mysql_query($sql_name, $connection);
    			$name = mysql_fetch_array($res);

    			// update approval name and date aproved
				$sql_stat = "UPDATE tbltrans_inquiry SET appr_by = '".$name["lastname"].", ".$name["firstname"]." ".$name["middlename"]."', date_approved = '".date($datenow." H:i:s")."' WHERE Inquiry_ID = '".$_POST["Inquiry_ID"]."' AND Application_ID = '".$_POST["Application_ID"]."'";
				$result_stat = mysql_query($sql_stat, $connection);

				$sqlselectneeded_inq = "SELECT TradeID, Mall_ID, Trade_Name, Company_ID, Company_Name, UnitID, datefrom, dateto, accof_Reservation, alerttype_cus, alerttype_email, datepayment, amount, alertdate, accof_Reservation, alerttype_cus, alerttype_email FROM tbltrans_inquiry WHERE Inquiry_ID = '".$_POST["Inquiry_ID"]."' AND Application_ID = '".$_POST["Application_ID"]."'";
				$sqlselectneeded_inq_result = mysql_query($sqlselectneeded_inq, $connection);
				$inq = mysql_fetch_array($sqlselectneeded_inq_result);

				$sqlselectneeded_comp = "SELECT owner_firstname, owner_middlename, owner_lastname FROM tbltrans_company WHERE CompanyID = '".$inq["Company_ID"]."'";
				$sqlselectneeded_comp_result = mysql_query($sqlselectneeded_comp, $connection);
				$comp = mysql_fetch_array($sqlselectneeded_comp_result);

				$sqlselectneeded_unit = "SELECT unitname, totalamountunitsetup, typeofbusiness FROM tblref_unit WHERE unitid = '".$inq["UnitID"]."'";
				$sqlselectneeded_unit_result = mysql_query($sqlselectneeded_unit, $connection);
				$unit = mysql_fetch_array($sqlselectneeded_unit_result);

				$date1 = $inq["datefrom"];
				$date2 = $inq["dateto"];

				$ts1 = strtotime($date1);
				$ts2 = strtotime($date2);

				$year1 = date('Y', $ts1);
				$year2 = date('Y', $ts2);

				$month1 = date('m', $ts1);
				$month2 = date('m', $ts2);

				$months = (($year2 - $year1) * 12) + ($month2 - $month1);


				$days = (strtotime($inq["dateto"]) - strtotime($inq["datefrom"])) / (60 * 60 * 24);

				if($unit["typeofbusiness"] == "LCA")
				{
					$months2 = $months;
					$days2 = $days;
				}
				else if($unit["typeofbusiness"] == "SET")
				{
					$months2 = $months;
					$days2 = 0;
				}


				$refDate2 = $inq["datefrom"];
				for ($x=1; $x<=$days+1; $x++)
				{
					$refDate2 = date( 'Y/m/d', strtotime($refDate2) );
					$selectlogs = "SELECT COUNT(*) FROM tblunit_statuslogs WHERE unitid = '".$inq["UnitID"]."' AND xdate = '".$refDate2."'";
					$resultlogs = mysql_query($selectlogs, $connection);
					$logs = mysql_fetch_array($resultlogs);

					if($logs[0] == 0)
					{
						$insert_logs = "INSERT INTO tblunit_statuslogs (unitid, unitname, tenantid, tenantname, xdate, xtime, status)VALUES('".$inq["UnitID"]."', '".$unit["unitname"]."', '".$_POST["Application_ID"]."', '".$inq["Trade_Name"]."', '".$refDate2."', '".date("h-i-s")."', 'reserved')";
						$result_logs = mysql_query($insert_logs);
					}
					else
					{
						$insert_logs = "UPDATE tblunit_statuslogs SET status = 'reserved', tenantname = '".$inq["Trade_Name"]."', tenantid = '".$_POST["Application_ID"]."' WHERE unitid = '".$inq["UnitID"]."' AND xdate = '".$refDate2."'";
						$result_logs = mysql_query($insert_logs);
					}
					$refDate2 = date( 'Y/m/d', strtotime($refDate2 . '+1 day') );
				}
			}
		}
		break;

		case "loadpaginationleasingapp":
			$cnt_fltr = 0;
			$sql_filter = mysql_fetch_array(mysql_query("SELECT checked_value, otherfilter, bystat, xcheck FROM tblref_filters WHERE module = 'Application'"));
			$trby = explode("|", $sql_filter["checked_value"]);
			$stat = explode("|", $sql_filter["bystat"]);
			$unit = explode("|", $sql_filter["xcheck"]);
			$date = explode("|", $sql_filter["otherfilter"]);
			$filter = "";

			// filter for status
			$cnt = 0; $chk = "";
			for($a = 0; $a<=count($stat)-1; $a++)
			{
				if($stat[$a] == "Pending"){ $con = "(Status = 'Pending' AND Application_ID != '')"; }
				else if($stat[$a] == "ForApproval"){ $con = "(Status = 'For Approval')"; }
				else if($stat[$a] == "Approved"){ $con = "(Status = 'Tentative')"; }
				else if($stat[$a] == "Disapproved"){ $con = "(Status = 'Disapproved' AND Application_ID != '')"; }
				else if($stat[$a] == "Reserved"){ $con = "(Status = 'Confirmed')"; }
				else if($stat[$a] == "Cancelled"){ $con = "(Status = 'Cancelled')"; }
				else if($stat[$a] == "Occupied"){ $con = "(Status = 'Occupied')"; }

				if($stat[$a] != "")
				{
					$cnt_fltr++;
					$cnt++;
					if($cnt == 1)
					{
						$chk .= $con;
					}
					else
					{
						$chk .= " OR ".$con;
					}
				}
			}

			if($cnt > 1)
			{
				$Stat_fltr = "(".$chk.")";
			}
			else
			{
				$Stat_fltr = $chk;
			}
			if($cnt > 0)
			{
				$and = " AND ";
			}
			else
			{
				$and = "";
			}
			// filter for unit type
			$cnt2 = 0; $chk2 = "";
			for($b = 0; $b<=count($unit)-1; $b++)
			{
				if($unit[$b] != "")
				{
					$cnt_fltr++;
					$cnt2++;
					if($cnt2 == 1)
					{
						$chk2 .= "UnitType = '".$unit[$b]."'";
					}
					else
					{
						$chk2 .= " OR UnitType = '".$unit[$b]."'";
					}
				}
			}
			if($cnt2 > 1)
			{
				$Unit_fltr = "(".$chk2.")";
			}
			else
			{
				$Unit_fltr = $chk2;
			}

			if($cnt2 > 0)
			{
				$and1 = " AND ";
			}
			else
			{
				$and1 = "";
			}
			// filter by date
			$date_fltr = "(date_inquired BETWEEN '".date("Y-m-d", strtotime($date[0]))."' AND '".date("Y-m-d", strtotime($date[1]))."')";

			// filter by
			$cnt3 = 0; $chk3 = "";
			for($c = 0; $c<=count($trby)-1; $c++)
			{
				if($trby[$c] != "")
				{
					$cnt_fltr++;
					$cnt3++;
					if($cnt3 == 1)
					{
						$chk3 .= $trby[$c] . " LIKE '%".$_POST["key"]."%'";
					}
					else
					{
						$chk3 .= " OR ". $trby[$c] . " LIKE '%".$_POST["key"]."%'";
					}
				}
			}
			if($cnt3 > 1)
			{
				$by_fltr = "(".$chk3.")";
			}
			else
			{
				$by_fltr = $chk3;
			}
			if($cnt3 > 0)
			{
				$and2 = " AND ";
			}
			else
			{
				$and2 = "";
			}
			if($cnt > 0 && $cnt2 > 0)
			{
				$filterselected = "WHERE ".$Stat_fltr . "".$and."" . $Unit_fltr . "".$and1."" . $date_fltr . "".$and2."" . $by_fltr;
				$page = $_POST["page"];
				$sqlb = "SELECT COUNT(*) FROM tbltrans_inquiry ".$key."";
				$aa = mysql_query($sqlb, $connection);
				$nums = mysql_fetch_row($aa);
				$num = $nums[0];
				// if($num <= 20)
				// {
				// 	$page = 1
				// }
				$rowsperpage = 20;
				$range = 4;
				$totalpages = ceil($num / $rowsperpage);
				$prevpage;
				$nextpage;
				// if not on page 1, don't show back links
				if($page > 1 )
				{
				   echo "<li style='width:50px !important;' onclick='getvalinquiry(1)'><< First</li>";
				   $prevpage = $page - 1;
				   echo "<li style='width:70px !important;' onclick='getvalinquiry(". $prevpage .")'>< Previous</li>";
				}
				for($x = ($page - $range); $x < (($page + $range) + 1); $x++)
				{
				   if (($x > 0) && ($x <= $totalpages))
				   {
				      if ($x == $page)
				      {

			   	echo "<li id='pgptnts" . $x . "' class='pgnumptnts active' onclick='getvalinquiry(" . $x . ",". $x .")'>" . $x . "</li>"; }
				else
				{
				echo "<li id='pgptnts" . $x . "' class='pgnumptnts' onclick='getvalinquiry(" . $x . ",". $x .")'>" . $x . "</li>"; }
			       }
			    }
			    if($page < ($totalpages - $range))
			    { echo "<li>...</li>"; }
			    if ($page != $totalpages && $num != 0)
			    {
			       $nextpage = $page + 1;
			       echo "<li style='width:50px !important;' onclick='getvalinquiry(". $nextpage .", ". $nextpage .")'>Next ></li>";
			       echo "<li style='width:50px !important;' onclick='getvalinquiry(". $totalpages .", ". $totalpages .")'>Last >></li>";
			    }
			}
		break;

		case 'loadleasingappentries':
			$cnt_fltr = 0;
			$sql_filter = mysql_fetch_array(mysql_query("SELECT checked_value, otherfilter, bystat, xcheck FROM tblref_filters WHERE module = 'Application'"));
			$trby = explode("|", $sql_filter["checked_value"]);
			$stat = explode("|", $sql_filter["bystat"]);
			$unit = explode("|", $sql_filter["xcheck"]);
			$date = explode("|", $sql_filter["otherfilter"]);
			$filter = "";

			// filter for status
			$cnt = 0; $chk = "";
			for($a = 0; $a<=count($stat)-1; $a++)
			{
				if($stat[$a] == "Pending"){ $con = "(Status = 'Pending' AND Application_ID != '')"; }
				else if($stat[$a] == "ForApproval"){ $con = "(Status = 'For Approval')"; }
				else if($stat[$a] == "Approved"){ $con = "(Status = 'Tentative')"; }
				else if($stat[$a] == "Disapproved"){ $con = "(Status = 'Disapproved' AND Application_ID != '')"; }
				else if($stat[$a] == "Reserved"){ $con = "(Status = 'Confirmed')"; }
				else if($stat[$a] == "Cancelled"){ $con = "(Status = 'Cancelled')"; }
				else if($stat[$a] == "Occupied"){ $con = "(Status = 'Occupied')"; }

				if($stat[$a] != "")
				{
					$cnt_fltr++;
					$cnt++;
					if($cnt == 1)
					{
						$chk .= $con;
					}
					else
					{
						$chk .= " OR ".$con;
					}
				}
			}

			if($cnt > 1)
			{
				$Stat_fltr = "(".$chk.")";
			}
			else
			{
				$Stat_fltr = $chk;
			}
			if($cnt > 0)
			{
				$and = " AND ";
			}
			else
			{
				$and = "";
			}
			// filter for unit type
			$cnt2 = 0; $chk2 = "";
			for($b = 0; $b<=count($unit)-1; $b++)
			{
				if($unit[$b] != "")
				{
					$cnt_fltr++;
					$cnt2++;
					if($cnt2 == 1)
					{
						$chk2 .= "UnitType = '".$unit[$b]."'";
					}
					else
					{
						$chk2 .= " OR UnitType = '".$unit[$b]."'";
					}
				}
			}
			if($cnt2 > 1)
			{
				$Unit_fltr = "(".$chk2.")";
			}
			else
			{
				$Unit_fltr = $chk2;
			}

			if($cnt2 > 0)
			{
				$and1 = " AND ";
			}
			else
			{
				$and1 = "";
			}
			// filter by date
			$date_fltr = "(date_inquired BETWEEN '".date("Y-m-d", strtotime($date[0]))."' AND '".date("Y-m-d", strtotime($date[1]))."')";

			// filter by
			$cnt3 = 0; $chk3 = "";
			for($c = 0; $c<=count($trby)-1; $c++)
			{
				if($trby[$c] != "")
				{
					$cnt_fltr++;
					$cnt3++;
					if($cnt3 == 1)
					{
						$chk3 .= $trby[$c] . " LIKE '%".$_POST["key"]."%'";
					}
					else
					{
						$chk3 .= " OR ". $trby[$c] . " LIKE '%".$_POST["key"]."%'";
					}
				}
			}
			if($cnt3 > 1)
			{
				$by_fltr = "(".$chk3.")";
			}
			else
			{
				$by_fltr = $chk3;
			}
			if($cnt3 > 0)
			{
				$and2 = " AND ";
			}
			else
			{
				$and2 = "";
			}
			if($cnt > 0 && $cnt2 > 0)
			{
				$filterselected = "WHERE ".$Stat_fltr . "".$and."" . $Unit_fltr . "".$and1."" . $date_fltr . "".$and2."" . $by_fltr;
	  			 $sql = "SELECT COUNT(*) FROM tbltrans_inquiry ".$filterselected."";
	  			 $result = mysql_query($sql, $connection);
	  			 $row = mysql_fetch_array($result);
	  			 $rowsperpage = 20;
	  			 $totalpages = ceil($row[0] / $rowsperpage);
	  			 $upto = $limit + 20;
	  			 $from = $limit + 1;
	  			 if($page == $totalpages && $row[0] != 0)
	  			 {
	  			      echo "Showing " . $from . " to " . $row[0] . " of " . $row[0] . " entries";
	  			 }
	  			 else
	  			 {

	  			      if($row[0] == 0)
	  			       {
	  			        echo 000;
	  			       }
	  			      else if($row[0] <= 19 && $row[0] != 0)
	  			       {
	  			        echo "Showing 1 to " . $row[0] . " of " . $row[0] . " entries";
	  			       }
	  			      else if($row[0] >= 20 && $row[0] != 0)
	  			       {
	  			        echo "Showing " . $from . " to " . $upto . " of " . $row[0] . " entries";
	  			       }

	  			  }
	  		}
		break;

		case 'cancelapplication':
				$sql = "UPDATE tbltrans_leasingapplication SET Status = '2' WHERE applicationID = '".$_POST["applicationID"]."' AND inquiryID = '".$_POST["inquiryID"]."'";
				$result = mysql_query($sql, $connection);
				if($result == true)
				{
					echo 1;
				}
		break;

		case 'edittenantapplication':
			$sql = "SELECT applicationID, inquiryID, tradename, companyname, industry, address, company_telno, company_faxno, company_email, company_website, company_franchisor, company_owner_firstname, company_owner_midname, company_owner_lastname, company_owner_civilstat, company_owner_home_address, company_contact_firstname, company_contact_midname, company_contact_lastname, company_contact_designation, company_contact_mobno, company_contact_telno, merchandise_dep_name, merchandise_dep_id, merchandise_class_name, merchandise_class_id, merchandise_cat_name, merchandise_cat_id,company_owner_permanent_address, company_owner_billing_address, industryID FROM tbltrans_leasingapplication WHERE inquiryID = '".$_POST["inquiryID"]."' AND applicationID = '".$_POST["applicationID"]."'";
			$result = mysql_query($sql, $connection);
			$row = mysql_fetch_array($result);

			echo $row["tradename"]. "|" . $row["companyname"]. "|" . $row["industry"]. "|" . $row["address"]. "|" . $row["company_telno"]. "|" . $row["company_faxno"]. "|" . $row["company_email"]. "|" . $row["company_website"]. "|" . $row["company_franchisor"]. "|" . $row["company_owner_firstname"]. "|" . $row["company_owner_midname"]. "|" . $row["company_owner_lastname"]. "|" . $row["company_owner_civilstat"]. "|" . $row["company_owner_home_address"]. "|" . $row["company_contact_firstname"]. "|" . $row["company_contact_midname"]. "|" . $row["company_contact_lastname"]. "|" . $row["company_contact_designation"]. "|" . $row["company_contact_mobno"]. "|" . $row["company_contact_telno"]. "|" . $row["merchandise_dep_name"]. "|" . $row["merchandise_dep_id"]. "|" . $row["merchandise_class_name"]. "|" . $row["merchandise_class_id"]. "|" . $row["merchandise_cat_name"]. "|" . $row["merchandise_cat_id"]. "|" . $row["company_owner_permanent_address"]. "|" . $row["company_owner_billing_address"]. "|" . $row["industryID"] . "|";
		break;

		case 'edittenantapplication_tel':
			$sql = "SELECT tel_no FROM tbltrans_leasingapplication_owner_telno WHERE inquiryID = '".$_POST["inquiryID"]."' AND applicationID = '".$_POST["applicationID"]."'";
			$result = mysql_query($sql, $connection);
			while($row = mysql_fetch_array($result))
			{
				echo "<input tye='text' class='form-control numonly' value='".$row["tel_no"]."' style='margin-bottom:5px;' maxlength='11'>";
			}
				echo "<div class='input-group'><input type='text' id='spinner3' class='spinbox-input form-control numonly' maxlength='11'><div class='spinbox-buttons input-group-btn'><button type='button' class='btn spinbox-up btn-sm btn-success' onclick='div_addtel()'><i class='icon-only  ace-icon ace-icon fa fa-plus bigger-110'></i></button></div></div>";
		break;

		case 'edittenantapplication_affiliates':
			$sql = "SELECT company_name, line_of_business, address, tel_no FROM tbltrans_leasingapplication_affiliated WHERE inquiryID = '".$_POST["inquiryID"]."' AND applicationID = '".$_POST["applicationID"]."'";
			$result = mysql_query($sql, $connection);
			while($row = mysql_fetch_array($result))
			{
				echo "<div class='alert alert-info business_affiliated'><p style='font-size: 14px; font-weight: bold;margin: 0px !important;' class='business_affiliated_compname'>".$row["company_name"]."</p><p style='font-size: 14px; font-weight: normal;margin: 0px !important;' class='business_affiliated_lineofbusiness'>".$row["line_of_business"]."</p><p style='font-size: 10px; font-weight: normal;margin: 0px !important;' class='business_affiliated_address'>".$row["address"]."</p><p style='font-size: 12px; font-weight: normal;font-style: italic;margin: 0px !important;' class='business_affiliated_telnum'>".$row["tel_no"]."</p></div>";
			}
		break;

		case 'reservation_application':
			$sql = "SELECT applicationID, inquiryID, tradename, companyname, industry, address, company_telno, company_faxno, company_email, company_website, company_franchisor, company_owner_firstname, company_owner_midname, company_owner_lastname, company_owner_civilstat, company_owner_home_address, company_contact_firstname, company_contact_midname, company_contact_lastname, company_contact_designation, company_contact_mobno, company_contact_telno, merchandise_dep_name, merchandise_dep_id, merchandise_class_name, merchandise_class_id, merchandise_cat_name, merchandise_cat_id FROM tbltrans_leasingapplication WHERE inquiryID = '".$_POST["inquiryID"]."' AND applicationID = '".$_POST["applicationID"]."'";
			$result = mysql_query($sql, $connection);
			$row = mysql_fetch_array($result);

			echo $row["tradename"]. "|" . $row["companyname"]. "|" . $row["industry"]. "|" . $row["address"]. "|" . $row["company_telno"]. "|" . $row["company_faxno"]. "|" . $row["company_email"]. "|" . $row["company_website"]. "|" . $row["company_franchisor"]. "|" . $row["company_owner_firstname"]. "|" . $row["company_owner_midname"]. "|" . $row["company_owner_lastname"]. "|" . $row["company_owner_civilstat"]. "|" . $row["company_owner_home_address"]. "|" . $row["company_contact_firstname"]. "|" . $row["company_contact_midname"]. "|" . $row["company_contact_lastname"]. "|" . $row["company_contact_designation"]. "|" . $row["company_contact_mobno"]. "|" . $row["company_contact_telno"]. "|" . $row["merchandise_dep_name"]. "|" . $row["merchandise_dep_id"]. "|" . $row["merchandise_class_name"]. "|" . $row["merchandise_class_id"]. "|" . $row["merchandise_cat_name"]. "|" . $row["merchandise_cat_id"];
		break;

		case 'reservation_application2':
			$sql = "SELECT appID ,inqID ,tradename ,companyname ,industry ,address ,compinf_telno ,compinf_faxno ,compinf_email ,compinf_website ,compinf_Franchisor ,compinf_ownerfirstname ,compinf_ownermidname ,compinf_ownerlastname ,compinf_stat ,compinf_address ,contact_firstname ,contact_midname ,contact_lastname ,contact_designation ,contact_mobno ,contact_telno ,merchandise_dep ,dep_id ,merchandise_class ,class_id ,merchandise_cat ,cat_id, resapp_mall, mall_id, resapp_flr, flr_id, resapp_wing, wing_id, resapp_class, classification_id, resapp_unit, unitID, datefrom, dateto, datepayment, amount, alertdate, remarks, accof, alerttype_cus, alerttype_email FROM tbltrans_reservation WHERE inqID = '".$_POST["inquiryID"]."' AND appID = '".$_POST["applicationID"]."' AND transID = '". $_POST["resID"] ."'";
			$result = mysql_query($sql, $connection);
			$row = mysql_fetch_array($result);

			echo $row["tradename"]."|".$row["companyname"]."|".$row["industry"]."|".$row["address"]."|".$row["compinf_telno"]."|".$row["compinf_faxno"]."|".$row["compinf_email"]."|".$row["compinf_website"]."|".$row["compinf_Franchisor"]."|".$row["compinf_ownerfirstname"]."|".$row["compinf_ownermidname"]."|".$row["compinf_ownerlastname"]."|".$row["compinf_stat"]."|".$row["compinf_address"]."|".$row["contact_firstname"]."|".$row["contact_midname"]."|".$row["contact_lastname"]."|".$row["contact_designation"]."|".$row["contact_mobno"]."|".$row["contact_telno"]."|".$row["merchandise_dep"]."|".$row["dep_id"]."|".$row["merchandise_class"]."|".$row["class_id"]."|".$row["merchandise_cat"]."|".$row["cat_id"] ."|" . $row["resapp_mall"] ."|" . $row["mall_id"] ."|" . $row["resapp_flr"] ."|" . $row["flr_id"] ."|" . $row["resapp_wing"] ."|" . $row["wing_id"] ."|" . $row["resapp_class"] ."|" . $row["classification_id"] ."|" . $row["resapp_unit"] ."|" . $row["unitID"] . "|" . $row["datefrom"] . "|" . $row["dateto"] . "|" . $row["datepayment"] . "|" . $row["amount"] . "|" . $row["alertdate"] . "|" . $row["remarks"] . "|" . $row["accof"] . "|" . $row["alerttype_cus"] . "|" . $row["alerttype_email"];

			// echo $sql;

		break;

		case 'reservation_application_telno':
			$sql = "SELECT tel_no FROM tbltrans_leasingapplication_owner_telno WHERE inquiryID = '". $_POST["inquiryID"] ."' AND applicationID = '".$_POST["applicationID"]."'";
			$result = mysql_query($sql, $connection);
			while($row = mysql_fetch_array($result))
			{
				echo "<input tye='text' class='form-control numonly' value='".$row["tel_no"]."' style='margin-bottom:5px;' maxlength='11'>";
			}
				echo "<div class='input-group'><input type='text' id='spinner3' class='spinbox-input form-control numonly' maxlength='11'><div class='spinbox-buttons input-group-btn'><button type='button' class='btn spinbox-up btn-sm btn-success' onclick='div_addtel()'><i class='icon-only  ace-icon ace-icon fa fa-plus bigger-110'></i></button></div></div>";
		break;

		case 'loadmalls':
			$querymall = "Select mallid, mallname, malladdress FROM tblref_mall";
               $rsss = mysql_query($querymall, $connection);
             while($row = mysql_fetch_array($rsss)){
               $mall = "<option id='' ";
               $mall .= "value='".$row['mallid']."'>".$row['mallname']."</option>";

               echo $mall;
             }
		break;

		case 'loadwingflr2':
			$wings = "";
			$sql = "SELECT DISTINCT(wingid) FROM tblref_unit WHERE typeofbusiness = 'SET' AND classid = '".$_POST["classification_id"]."'";
			$result = mysql_query($sql, $connection);
			while($row = mysql_fetch_array($result))
			{
				$wings .= $row["wingid"] . "|";
			}
			$condition = "";
			$wingid = explode("|", $wings);
			for($i=0; $i<=count($wingid)-2; $i++)
			{
				if($i == 0)
				{
					$condition .= "WHERE wingID = '".$wingid[$i]."' ";
				}
				else
				{
					$condition .= "OR wingID = '".$wingid[$i]."' ";
				}
			}
				echo '<option value="">-- Select Wing --</option>';
				$querywing = "SELECT wingID, wing FROM tblref_wing ".$condition."";
        		$result_wing = mysql_query($querywing, $connection);
				while($row = mysql_fetch_array($result_wing)){
					echo "<option value='".$row["wingID"]."'>".$row["wing"]."</option>";
				}
		break;

		case 'loadunitapp':
		echo '<option value="">-- Select Unit --</option>';
			$sql = "SELECT unitid, unitname FROM tblref_unit WHERE floorid = '".$_POST["flrid"]."' AND mallid = '".$_POST["mallid"]."' AND wingid = '".$_POST["wingid"]."'";
			$result = mysql_query($sql, $connection);
			while($row = mysql_fetch_array($result))
			{
				echo "<option value='".$row["unitid"]."'>".$row["unitname"]."</option>";
			}
		break;

		case 'getclasssel':
			$sql = "SELECT classid, classificationname FROM tblref_unit WHERE floorid = '".$_POST["flrid"]."' AND mallid = '".$_POST["mallid"]."' AND wingid = '".$_POST["wingid"]."' AND unitid = '".$_POST["unitid"]."'";
			$result = mysql_query($sql, $connection);
			while($row = mysql_fetch_array($result))
			{
				echo $row["classid"] . "|" . $row["classificationname"];
			}
		break;

		case 'checkreservation':
			$sql = "SELECT transID FROM tbltrans_reservation WHERE appID = '".$_POST["applicationID"]."' AND inqID = '".$_POST["inquiryID"]."'";
			$result = mysql_query($sql, $connection);
			$row = mysql_fetch_array($result);

			echo $row["transID"] . "|";
		break;

		case 'list_department':
		echo '<option value="">-- Select Department --</option>';
			$sql = "SELECT departmentID, department FROM tblref_merchandise_depa";
			$result = mysql_query($sql, $connection);
			while($row = mysql_fetch_array($result))
			{
				$dep = "<option";
				$dep .= " value='".$row['departmentID']."'>".$row['department']."</option>";

                echo $dep;
			}
		break;

		case 'list_classification':
		echo '<option value="">-- Select Classification --</option>';
			$sql = "SELECT classificationID, classification FROM tblref_merchandise_class";
			$result = mysql_query($sql, $connection);
			while($row = mysql_fetch_array($result))
			{
				$class = "<option value='".$row['classificationID']."'>";
                $class .= $row['classification']."</option>";

                echo $class;
			}
		break;

		case 'list_category':
		echo '<option value="">-- Select Category --</option>';
			$sql = "SELECT categoryID, category FROM tblref_merchandisedep_cat";
			$result = mysql_query($sql, $connection);
			while($row = mysql_fetch_array($result))
			{
				$cat = "<option";
				$cat .= " value='".$row['categoryID']."'>".$row['category']."</option>";

                echo $cat;
			}
		break;

		case 'loadreservationlist':
			$x = 0;
			$chk1 = "";
			$getttt = mysql_fetch_array(mysql_query("SELECT checked_value, otherfilter, bystat, xcheck FROM tblref_filters WHERE module = 'Reservation'"));
			$alcrd = explode("|", $getttt["bystat"]);
			for($a=0; $a<=count($alcrd)-2; $a++)
			{
				if($alcrd[$a] != "")
				{
					$x++;
					if($x == 1)
					{
						$chk1 .= "tbltrans_inquiry.Status = '".$alcrd[$a]."'";
					}
					else if($x > 1)
					{
						$chk1 .= " OR tbltrans_inquiry.Status = '".$alcrd[$a]."'";
					}
				}
			}

			$chk .= " WHERE (".$chk1.")"; //filter by status
			$chk2 = "";
			$y = 0;
			$estes = explode("|", $getttt["checked_value"]);
			for($b=0; $b<=count($estes)-2; $b++)
			{
				if($estes[$b] != "")
				{
					$y++;
					if($y == 1)
					{
						$chk2 .= "tbltrans_inquiry.".$estes[$b]." LIKE '%".$_POST["key"]."%'";
					}
					else if($y > 1)
					{
						$chk2 .= " OR tbltrans_inquiry.".$estes[$b]." LIKE '%".$_POST["key"]."%'";
					}
				}
			}
			$chk .= " AND (".$chk2.")"; //filter by data

			$chk3 = "";
			$eudora = explode("|", $getttt["otherfilter"]);
			if($getttt["xcheck"] == "chkoccdate")
			{
				$chk3 .= "(tbltrans_inquiry.datefrom BETWEEN '".date("m/d/Y", strtotime($eudora[0]))."' AND '".date("m/d/Y", strtotime($eudora[1]))."')";
			}
			else if($getttt["xcheck"] == "chkappdate")
			{
				$chk3 .= "(tbltrans_inquiry.date_approved BETWEEN '".date("Y-m-d", strtotime($eudora[2]))."' AND '".date("Y-m-d", strtotime($eudora[3]))."')";
			}

			$chk .= " AND ".$chk3; //filter by date

			$page = ($_POST["page"] || 1);
			$limit = ($page-1) * 20;
				$sql = "SELECT tbltrans_inquiry.Inquiry_ID, tbltrans_inquiry.Application_ID, tbltrans_inquiry.Mall, tbltrans_inquiry.Mall_ID, tbltrans_inquiry.UnitID, tbltrans_inquiry.TradeID, tbltrans_inquiry.Trade_Name, tbltrans_inquiry.Company_ID, tbltrans_inquiry.Company_Name, tbltrans_inquiry.Industry, tbltrans_inquiry.DepartmentID, tbltrans_inquiry.CategoryID, tbltrans_inquiry.Address, tbltrans_inquiry.Remarks, tbltrans_inquiry.User_ID, tbltrans_inquiry.datefrom, tbltrans_inquiry.dateto, tbltrans_inquiry.applicationDate, tbltrans_inquiry.Status, tbltrans_inquiry.UnitType, tbltrans_inquiry.TenantID, tblref_unit.unitname, tblref_floorsetup.floor, tblref_wing.wing, tbltrans_inquiry.payment_type FROM tbltrans_inquiry LEFT JOIN tblref_unit ON tbltrans_inquiry.UnitID = tblref_unit.unitid LEFT JOIN tblref_floorsetup ON tblref_unit.floorid = tblref_floorsetup.floorid LEFT JOIN tblref_wing ON tblref_wing.wingID = tblref_unit.wingid ".$chk." LIMIT ".$limit.",20";
				// echo $sql;
				$result = mysql_query($sql, $connection);
				while ($row = mysql_fetch_array($result)) {

						if($row["Status"] == "Cancelled")
						{
							$stat = "<span class='label label-sm label-danger'>Cancelled</span>";
						}
						else if($row["Status"] == "Confirmed")
						{
							$stat = "<span class='label label-sm label-success'>Confirmed</span>";
						}
						else if($row["Status"] == "Waiting List")
						{
							$stat = "<span class='label label-sm label-warning'>Waiting</span>";
						}
						else if($row["Status"] == "Approved" || $row["Status"] == "")
						{
							$stat = "<span class='label label-sm label-yellow'>Pending</span>";
						}
						else if($row["Status"] == "Tentative")
						{
							$stat = "<span class='label label-sm label-success' style='background-color: #925c92;'>Tentative</span>";
						}
						else if($row["Status"] == "Occupied")
						{
							$stat = "<span class='label label-sm label-warning'>Occupied</span>";
						}


					$sellogo = "SELECT filename FROM tbltrans_tradename WHERE tradeID = '".$row["TradeID"]."'";
					$reslogo = mysql_query($sellogo, $connection);
					$logo = mysql_fetch_array($reslogo);

					echo "<tr>";
					echo "<td class='hide_mobile' width='5%'><img src='server/company/".$row["Company_ID"]."/trades/".$row["TradeID"]."/".$logo["filename"]."' style='width:40px;height:40px;'></td>";
					echo "<td class='hide_mobile'>".$row["Trade_Name"]."</td>";
					echo "<td class='scroll'>".$row["Company_Name"]."</td>";
					echo "<td class='scroll'>".$row["unitname"]."</td>";
					echo "<td class='scroll'>".$row["UnitType"]."</td>";
					echo "<td class='hide_mobile'>".$row["floor"]."</td>";
					echo "<td class='hide_mobile'>".$row["wing"]."</td>";
					echo "<td class='hide_mobile'>".$row["datefrom"]."</td>";
					echo "<td class='hide_mobile'>".$row["dateto"]."</td>";
					echo "<td class='hide_mobile'>".$stat."</td>";
					echo "<td class='scroll'>
						<div class='hidden-sm hidden-xs btn-group'>";
						if ($row["Status"] == "Cancelled")
						{
							// echo"<button class='btn btn-xs btn-yellow' onclick='reinstatereservation(\"". $row["Inquiry_ID"] ."\",\"". $row["Application_ID"] ."\",\"". $row["datefrom"] ."\",\"". $row["dateto"] ."\",\"". $row["UnitID"] ."\")' title='Reinstate Reservation'>
							// 	<i class='ace-icon fa fa-calendar-check-o bigger-120'></i>
							// 	</button>";
							echo"<button class='btn btn-xs btn-yellow' onclick='editreservationmodal(\"". $row["TradeID"] ."\",\"". $row["Company_ID"] ."\",\"". $row["Inquiry_ID"] ."\",\"". $row["UnitID"] ."\",\"". $row["Application_ID"] ."\",\"reinstate\",\"". $row["Status"] ."\")' title='Reinstate Reservation'>
								<img src='assets/images/calendar2.png' style='width: 100%; height: auto;' />
								</button>";
						}
						// if($row["Status"] == "Tentative")
						// {
						// 		echo"<button class='btn btn-xs btn-info' onclick='editreservationmodal(\"". $row["TradeID"] ."\",\"". $row["Company_ID"] ."\",\"". $row["Inquiry_ID"] ."\",\"". $row["UnitID"] ."\",\"". $row["Application_ID"] ."\",\"change_status\",\"". $row["Status"] ."\",\"". $row["payment_type"] ."\")' title='Edit Reservation'>
						// 			<img src='assets/images/edit.png' style='width: 100%; height: auto;' />
						// 		</button>";
						// 		echo"<button class='btn btn-xs btn-danger' onclick='editreservationmodal(\"". $row["TradeID"] ."\",\"". $row["Company_ID"] ."\",\"". $row["Inquiry_ID"] ."\",\"". $row["UnitID"] ."\",\"". $row["Application_ID"] ."\",\"cancel\",\"". $row["Status"] ."\")' title='Cancel Reservation'>
						// 			<img src='assets/images/calendar.png' style='width: 100%; height: auto;' />
						// 		</button>";
						// 		// echo"<button class='btn btn-xs btn-danger' onclick='cancelreservation(\"". $row["Inquiry_ID"] ."\",\"". $row["Application_ID"] ."\",\"". $row["datefrom"] ."\",\"". $row["dateto"] ."\",\"". $row["UnitID"] ."\")' title='Cancel Reservation'>
						// 		// 	<i class='ace-icon fa fa-calendar-times-o bigger-120'></i>
						// 		// </button>"; July 04 Kevin M
						// }
						if($row["Status"] == "Tentative")
						{
								echo"<button class='btn btn-xs btn-info' onclick='editreservationmodal(\"". $row["TradeID"] ."\",\"". $row["Company_ID"] ."\",\"". $row["Inquiry_ID"] ."\",\"". $row["UnitID"] ."\",\"". $row["Application_ID"] ."\",\"change_status\",\"". $row["Status"] ."\",\"". $row["payment_type"] ."\")' title='Edit Reservation'>
									<img src='assets/images/edit.png' style='width: 100%; height: auto;' />
								</button>";
								echo"<button class='btn btn-xs btn-danger' onclick='editreservationmodal(\"". $row["TradeID"] ."\",\"". $row["Company_ID"] ."\",\"". $row["Inquiry_ID"] ."\",\"". $row["UnitID"] ."\",\"". $row["Application_ID"] ."\",\"cancel\",\"". $row["Status"] ."\")' title='Cancel Reservation'>
									<img src='assets/images/calendar.png' style='width: 100%; height: auto;' />
								</button>";
								// echo"<button class='btn btn-xs btn-danger' onclick='cancelreservation(\"". $row["Inquiry_ID"] ."\",\"". $row["Application_ID"] ."\",\"". $row["datefrom"] ."\",\"". $row["dateto"] ."\",\"". $row["UnitID"] ."\")' title='Cancel Reservation'>
								// 	<i class='ace-icon fa fa-calendar-times-o bigger-120'></i>
								// </button>"; July 04 Kevin M
						}
						else
						{
							if($row["Status"] == "Confirmed" && (date("m/d/Y", strtotime($row["datefrom"])) < date("m/d/Y") || date("m/d/Y", strtotime($row["datefrom"])) == date("m/d/Y")))
							{
								echo"<button class='btn btn-xs btn-yellow' onclick='editreservationmodal(\"". $row["TradeID"] ."\",\"". $row["Company_ID"] ."\",\"". $row["Inquiry_ID"] ."\",\"". $row["UnitID"] ."\",\"". $row["Application_ID"] ."\",\"occupy\",\"". $row["Status"] ."\")' title='Occupy'>
									<img src='assets/images/key.png' style='width: 100%; height: auto;' />
								</button>";
							}

								echo"<button class='btn btn-xs btn-gray' onclick='editreservationmodal(\"". $row["TradeID"] ."\",\"". $row["Company_ID"] ."\",\"". $row["Inquiry_ID"] ."\",\"". $row["UnitID"] ."\",\"". $row["Application_ID"] ."\",\"viewonly\",\"". $row["Status"] ."\")' title='View Reservation'>
									<img src='assets/images/view.png' style='width: 100%; height: auto;' />
								</button>";
						}

						if ($row["Status"] == "Confirmed" || $row["Status"] == "Occupied")
						{
							echo "<button class='btn btn-xs btn-success' onclick='printcontract(\"". $row["Inquiry_ID"] ."\", \"".$row["Mall_ID"]."\")' title='Print Contract'>
							<img src='assets/images/diploma.png' style='width: 100%; height: auto;' />
							</button>";
						}

						echo"<button class='btn btn-xs btn-gray' onclick='viewhistoryreservation(\"". $row["Inquiry_ID"] ."\")' title='View Logs'>
							<img src='assets/images/clock.png' style='width: 100%; height: auto;' />
							</button>";

						echo"</div>";

						echo"</div>
					</td>";
					echo "</tr>";
				}
		break;

		case "loadpaginationreservation":
			$x = 0;
			$chk1 = "";
			$getttt = mysql_fetch_array(mysql_query("SELECT checked_value, otherfilter, bystat, xcheck FROM tblref_filters WHERE module = 'Reservation'"));
			$alcrd = explode("|", $getttt["bystat"]);
			for($a=0; $a<=count($alcrd)-2; $a++)
			{
				if($alcrd[$a] != "")
				{
					$x++;
					if($x == 1)
					{
						$chk1 .= "tbltrans_inquiry.Status = '".$alcrd[$a]."'";
					}
					else if($x > 1)
					{
						$chk1 .= " OR tbltrans_inquiry.Status = '".$alcrd[$a]."'";
					}
				}
			}

			$chk .= " WHERE (".$chk1.")"; //filter by status
			$chk2 = "";
			$y = 0;
			$estes = explode("|", $getttt["checked_value"]);
			for($b=0; $b<=count($estes)-2; $b++)
			{
				if($estes[$b] != "")
				{
					$y++;
					if($y == 1)
					{
						$chk2 .= "tbltrans_inquiry.".$estes[$b]." LIKE '%".$_POST["key"]."%'";
					}
					else if($y > 1)
					{
						$chk2 .= " OR tbltrans_inquiry.".$estes[$b]." LIKE '%".$_POST["key"]."%'";
					}
				}
			}
			$chk .= " AND (".$chk2.")"; //filter by data

			$chk3 = "";
			$eudora = explode("|", $getttt["otherfilter"]);
			if($getttt["xcheck"] == "chkoccdate")
			{
				$chk3 .= "(tbltrans_inquiry.datefrom BETWEEN '".date("m/d/Y", strtotime($eudora[0]))."' AND '".date("m/d/Y", strtotime($eudora[1]))."')";
			}
			else if($getttt["xcheck"] == "chkappdate")
			{
				$chk3 .= "(tbltrans_inquiry.date_approved BETWEEN '".date("Y-m-d", strtotime($eudora[2]))."' AND '".date("Y-m-d", strtotime($eudora[3]))."')";
			}

			$chk .= " AND ".$chk3; //filter by date

			if($chk2 != "") {
				$page = $_POST["page"];
				$sqlb = "SELECT COUNT(*) FROM tbltrans_inquiry INNER JOIN tblref_unit ON tbltrans_inquiry.UnitID = tblref_unit.unitid INNER JOIN tblref_floorsetup ON tblref_unit.floorid = tblref_floorsetup.floorid INNER JOIN tblref_wing ON tblref_wing.wingID = tblref_unit.wingid ".$chk."";
				// echo $sqlb;
				$aa = mysql_query($sqlb, $connection);
				$nums = mysql_fetch_row($aa);
				$num = $nums[0];

				$rowsperpage = 20;
				$range = 4;
				$totalpages = ceil($num / $rowsperpage);
				$prevpage;
				$nextpage;
				// if not on page 1, don't show back links
				if($page > 1 )
				{
				   echo "<li style='width:50px !important;' onclick='getvalinquiry(1)'><< First</li>";
				   $prevpage = $page - 1;
				   echo "<li style='width:70px !important;' onclick='getvalinquiry(". $prevpage .")'>< Previous</li>";
				}
				for($x = ($page - $range); $x < (($page + $range) + 1); $x++)
				{
				   if (($x > 0) && ($x <= $totalpages))
				   {
				      if ($x == $page)
				      {

			   	echo "<li id='pgptnts" . $x . "' class='pgnumptnts active' onclick='getvalinquiry(" . $x . ",". $x .")'>" . $x . "</li>"; }
				else
				{
				echo "<li id='pgptnts" . $x . "' class='pgnumptnts' onclick='getvalinquiry(" . $x . ",". $x .")'>" . $x . "</li>"; }
			       }
			    }
			    if($page < ($totalpages - $range))
			    { echo "<li>...</li>"; }
			    if ($page != $totalpages && $num != 0)
			    {
			       $nextpage = $page + 1;
			       echo "<li style='width:50px !important;' onclick='getvalinquiry(". $nextpage .", ". $nextpage .")'>Next ></li>";
			       echo "<li style='width:50px !important;' onclick='getvalinquiry(". $totalpages .", ". $totalpages .")'>Last >></li>";
			    }
			}
		break;

		case 'loadreservationentries':
			$x = 0;
			$chk1 = "";
			$getttt = mysql_fetch_array(mysql_query("SELECT checked_value, otherfilter, bystat, xcheck FROM tblref_filters WHERE module = 'Reservation'"));
			$alcrd = explode("|", $getttt["bystat"]);
			for($a=0; $a<=count($alcrd)-2; $a++)
			{
				if($alcrd[$a] != "")
				{
					$x++;
					if($x == 1)
					{
						$chk1 .= "tbltrans_inquiry.Status = '".$alcrd[$a]."'";
					}
					else if($x > 1)
					{
						$chk1 .= " OR tbltrans_inquiry.Status = '".$alcrd[$a]."'";
					}
				}
			}

			$chk .= " WHERE (".$chk1.")"; //filter by status
			$chk2 = "";
			$y = 0;
			$estes = explode("|", $getttt["checked_value"]);
			for($b=0; $b<=count($estes)-2; $b++)
			{
				if($estes[$b] != "")
				{
					$y++;
					if($y == 1)
					{
						$chk2 .= "tbltrans_inquiry.".$estes[$b]." LIKE '%".$_POST["key"]."%'";
					}
					else if($y > 1)
					{
						$chk2 .= " OR tbltrans_inquiry.".$estes[$b]." LIKE '%".$_POST["key"]."%'";
					}
				}
			}
			$chk .= " AND (".$chk2.")"; //filter by data

			$chk3 = "";
			$eudora = explode("|", $getttt["otherfilter"]);
			if($getttt["xcheck"] == "chkoccdate")
			{
				$chk3 .= "(tbltrans_inquiry.datefrom BETWEEN '".date("m/d/Y", strtotime($eudora[0]))."' AND '".date("m/d/Y", strtotime($eudora[1]))."')";
			}
			else if($getttt["xcheck"] == "chkappdate")
			{
				$chk3 .= "(tbltrans_inquiry.date_approved BETWEEN '".date("Y-m-d", strtotime($eudora[2]))."' AND '".date("Y-m-d", strtotime($eudora[3]))."')";
			}

			$chk .= " AND ".$chk3; //filter by date

  			 $sql = "SELECT COUNT(*) FROM tbltrans_inquiry INNER JOIN tblref_unit ON tbltrans_inquiry.UnitID = tblref_unit.unitid INNER JOIN tblref_floorsetup ON tblref_unit.floorid = tblref_floorsetup.floorid INNER JOIN tblref_wing ON tblref_wing.wingID = tblref_unit.wingid ".$chk."";
  			 $result = mysql_query($sql, $connection);
  			 $row = mysql_fetch_array($result);
  			 $rowsperpage = 20;
  			 $totalpages = ceil($row[0] / $rowsperpage);
  			 $upto = $limit + 20;
  			 $from = $limit + 1;
  			 if($page == $totalpages && $row[0] != 0)
  			 {
  			      echo "Showing " . $from . " to " . $row[0] . " of " . $row[0] . " entries";
  			 }
  			 else
  			 {

  			      if($row[0] == 0)
  			       {
  			        echo 000;
  			       }
  			      else if($row[0] <= 19 && $row[0] != 0)
  			       {
  			        echo "Showing 1 to " . $row[0] . " of " . $row[0] . " entries";
  			       }
  			      else if($row[0] >= 20 && $row[0] != 0)
  			       {
  			        echo "Showing " . $from . " to " . $upto . " of " . $row[0] . " entries";
  			       }

  			  }
  			  // echo $sql;
		break;

		case 'savereservation_application2':
			$select = "SELECT company_contact_firstname, company_contact_midname, company_contact_lastname, company_contact_designation, company_contact_mobno, company_contact_telno, Status FROM tbltrans_leasingapplication WHERE applicationID = '".$_POST["appid"]."' AND inquiryID = '".$_POST["inqid"]."'";
			$res_select = mysql_query($select, $connection);
			$row = mysql_fetch_array($res_select);


				$sql = "UPDATE tbltrans_reservation SET tradename = '". $_POST["tradename"] ."', companyname = '". $_POST["companyname"] ."', industry = '". $_POST["industry"] ."', address = '". $_POST["address"] ."', compinf_telno = '". $_POST["compinf_telno"] ."', compinf_faxno = '". $_POST["compinf_faxno"] ."', compinf_email = '". $_POST["compinf_email"] ."', compinf_website = '". $_POST["compinf_website"] ."', compinf_Franchisor = '". $_POST["compinf_Franchisor"] ."', compinf_ownerfirstname = '". $_POST["compinf_ownerfirstname"] ."', compinf_ownermidname = '". $_POST["compinf_ownermidname"] ."', compinf_ownerlastname = '". $_POST["compinf_ownerlastname"] ."', compinf_stat = '". $_POST["compinf_stat"] ."', compinf_address = '". $_POST["compinf_address"] ."', merchandise_dep = '". $_POST["merchandise_dep"] ."', dep_id = '". $_POST["dep_id"] ."', merchandise_class = '". $_POST["merchandise_class"] ."', class_id = '". $_POST["class_id"] ."', merchandise_cat = '". $_POST["merchandise_cat"] ."', cat_id = '". $_POST["cat_id"] ."', resapp_mall = '". $_POST["resapp_mall"] ."', mall_id = '". $_POST["mall_id"] ."', resapp_flr = '". $_POST["resapp_flr"] ."', flr_id = '". $_POST["flr_id"] ."', resapp_wing = '". $_POST["resapp_wing"] ."', wing_id = '". $_POST["wing_id"] ."', resapp_class = '". $_POST["resapp_class"] ."', classification_id = '". $_POST["classification_id"] ."', resapp_unit = '". $_POST["resapp_unit"] ."', datepayment = '". $_POST["datepayment"] ."', alertdate = '". $_POST["alertdate"] ."', remarks = '". $_POST["remarks"] ."', accof = '". $_POST["accof"] ."', alerttype_cus = '". $_POST["alerttype_cus"] ."', alerttype_email= '". $_POST["alerttype_email"] ."', unitID = '".$row["unit_id"]."', datefrom = '". $_POST["datefrom"] ."', dateto = '". $_POST["dateto"] ."', amount = '". $_POST["amountpayment"] ."' WHERE transID = '". $_POST["resid"] ."'";
				$result = mysql_query($sql, $connection);

				if($result == true)
				{
						echo 1;
				}
		break;

		case 'savefile':
			   // Edit upload location here
				$destination_path = getcwd().DIRECTORY_SEPARATOR;

				$result = 0;

				$target_path = $destination_path . basename( $_POST['name']);

				if(@move_uploaded_file($_POST['file']["tmp_name"], $target_path)) {
				   $result = 1;
				}

				if($result == 1)
				{
					echo 1;
				}
		break;

		case 'load_list_department':
			echo '<option value="">-- Select Department --</option>';
			$sql = "SELECT departmentID, department FROM tblref_merchandise_depa WHERE class_ID = '".$_POST["class_id"]."'";
			$result = mysql_query($sql, $connection);
			while($row = mysql_fetch_array($result))
			{
				 $dep = "<option";
				 $dep .= " value='".$row['departmentID']."'>".$row['department']."</option>";

				echo $dep;
			}
		break;

		case 'load_list_classification':
			echo '<option value="">-- Select Classification --</option>';
			$sql = "SELECT classificationID, classification FROM tblref_merchandise_class WHERE industry_ID = '".$_POST["classes"]."'";
			$result = mysql_query($sql, $connection);
			while($row = mysql_fetch_array($result))
			{
				echo "<option value='".$row["classificationID"]."'>".$row["classification"]."</option>";
			}

			// echo $sql;
		break;

		case 'load_list_category':
			echo '<option value="">-- Select Category --</option>';
			$sql = "SELECT categoryID, category FROM tblref_merchandisedep_cat WHERE dept_ID = '".$_POST["dep_id"]."'";
			$result = mysql_query($sql, $connection);
			while($row = mysql_fetch_array($result))
			{
				$cat = "<option";
				$cat .= " value='".$row['categoryID']."'>".$row['category']."</option>";
				echo $cat;
			}
		break;

		case 'loaddivmalls':
			$sql = "SELECT mallid, mallname, malladdress, dateadded, bldgnumber, bldgname, mall_image, abouts, telephone_number, email, mallstat FROM tblref_mall";
			$result = mysql_query($sql, $connection);
			while($row = mysql_fetch_array($result))
			{
				if($row["mall_image"] == "")
				{
					$image = "assets/images/avatars/noimage.png";
				}
				else
				{
					$image = "server/mall_image/".$row["mall_image"];
				}
				echo "
				<div class='table-detail'>
                            <div class='row'>
                                <div class='col-xs-12 col-sm-2'>
                                    <div class='text-center'>
                                        <img height='150' width='180' class='thumbnail inline no-margin-bottom' alt='Greenbelt' src='".$image."' />
                                        <br />
                                        <div class='width-80 label label-info label-xlg arrowed-in arrowed-in-right'>
                                            <div class='inline position-relative'>
                                                <a class='user-title-label' href='#'>
                                                    <!-- <i class='ace-icon fa fa-circle light-green'></i> -->
                                                    &nbsp;
                                                    <span class='white'>".$row["mallname"]."</span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class='col-xs-12 col-sm-8'>
                                    <div class='space visible-xs'></div>

                                    <div class='profile-user-info profile-user-info-striped'>
                                        <div class='profile-info-row'>
                                            <div class='profile-info-name'> Mall Name </div>

                                            <div class='profile-info-value'>
                                                <span>".$row["mallname"]."</span>
                                            </div>
                                        </div>

                                        <div class='profile-info-row'>
                                            <div class='profile-info-name'> Location </div>

                                            <div class='profile-info-value'>
                                                <i class='fa fa-map-marker light-orange bigger-110'></i>
                                                <span>".$row["malladdress"]."</span>
                                            </div>
                                        </div>

                                        <div class='profile-info-row'>
                                            <div class='profile-info-name'> About </div>

                                            <div class='profile-info-value'>
                                                <span>".$row["abouts"]."</span>
                                            </div>
                                        </div>

                                        <div class='profile-info-row'>
                                            <div class='profile-info-name'> Telephone Number </div>

                                            <div class='profile-info-value'>
                                                <span>".$row["telephone_number"]."</span>
                                            </div>
                                        </div>

                                        <div class='profile-info-row'>
                                            <div class='profile-info-name'> Email </div>

                                            <div class='profile-info-value'>
                                                <span>".$row["email"]."</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class='col-xs-12 col-sm-2'>
                                    <button class='btn btn-light btn-sm' style='width: 100%; margin-bottom: 5px;' onclick='editmall(\"".$row["mallid"]."\")'>

                                        <span class='bigger-110 no-text-shadow'>Edit</span>
                                    </button>
                                    <button class='btn btn-light btn-sm' style='width: 100%; margin-bottom: 5px;' onclick='configuremall(\"".$row["mallid"]."\")'>

                                        <span class='bigger-110 no-text-shadow'>Configure</span>
                                    </button>";
                                    if($row[10] == "1"){
                                    	?> <button class='btn btn-light btn-sm' style='width: 100%; margin-bottom: 5px;' onclick='deletemall("<?php echo $row["mallid"]; ?>")'><span class='bigger-110 no-text-shadow'>Deactivate</span></button><?php
                                    }else{
                                    	?> <button class='btn btn-light btn-sm' style='width: 100%; margin-bottom: 5px;' onclick='reactivate("<?php echo $row["mallid"]; ?>")'><span class='bigger-110 no-text-shadow'>Reactivate</span></button><?php
                                    }
                                    
                                   
                            echo "</div>
                            </div>
                    </div>
				";
			}
		break;

		case 'loadwingdetails':
			echo '<option value="">-- Select Wing --</option>';
			$sql = "SELECT wingID, wing FROM tblref_wing WHERE mallID = '".$_POST["id"]."'";
			$result = mysql_query($sql, $connection);
			while($row = mysql_fetch_array($result))
			{
				echo "<option value='".$row["wingID"]."'>".$row["wing"]."</option>";
			}
			// echo $sql;
		break;

		case 'loadwingdetails2':
			echo '<option value="">-- Select Wing --</option>';
			$sql = "SELECT wingID, wing FROM tblref_wing WHERE mallID = '".$_POST["id"]."'";
			$result = mysql_query($sql, $connection);
			while($row = mysql_fetch_array($result))
			{
				echo "<option value='".$row["wingID"]."'>".$row["wing"]."</option>";
			}
			// echo $sql;
		break;

		case 'loaddropflr':
			$sql = "SELECT floor FROM tblref_flr";
			$result = mysql_query($sql, $connection);
			echo '<option value="">-- Select Floor --</option>';
			while($row = mysql_fetch_array($result))
			{
				echo "<option value='".$row["floor"]."'>".$row["floor"]."</option>";
			}
		break;

		case 'loadmallls':
			echo '<option value="">-- Select Wing --</option>';
			$sql = "SELECT wingID, wing FROM tblref_wing WHERE mallID = '".$_POST["id"]."'";
			$result = mysql_query($sql, $connection);
			while($row = mysql_fetch_array($result))
			{
				echo "<option value='".$row["wingID"]."'>".$row["wing"]."</option>";
			}
			// echo $sql;
		break;

		case 'loadflrrrls':
			echo "<option value=''>-- Select Floor --</option>";
			$sql = "SELECT floorid, floor FROM tblref_floorsetup WHERE mallid = '".$_POST["id"]."'";
			$result = mysql_query($sql, $connection);
			while($row = mysql_fetch_array($result))
			{
				echo "<option value='".$row["floorid"]."'>".$row["floor"]."</option>";
			}
			// echo $sql;
		break;

		case 'loadflrrrls2':
			echo "<option value=''>-- Select Floor --</option>";
			$sql = "SELECT floorid, floor FROM tblref_floorsetup WHERE wingid = '".$_POST["id"]."'";
			$result = mysql_query($sql, $connection);
			while($row = mysql_fetch_array($result))
			{
				echo "<option value='".$row["floorid"]."'>".$row["floor"]."</option>";
			}
			// echo $sql;
		break;

		case 'loadclassrls':
			echo '<option value="">-- Select Classification --</option>';
			$sql = "SELECT classificationID, classification FROM tblref_merchandise_class";
			$result = mysql_query($sql, $connection);
			while($row = mysql_fetch_array($result))
			{
				echo "<option value='".$row["classificationID"]."'>".$row["classification"]."</option>";
			}
			// echo $sql;
		break;

		case 'loadrefflrdetails':
			$sql = "SELECT floor FROM tblref_flr";
			$result = mysql_query($sql, $connection);
			while($row = mysql_fetch_array($result))
			{
				echo "<tr style='width: 100%;display: table;table-layout: fixed;'><td>".$row["floor"]."</td></tr>";
			}
		break;

		case 'savereffloor':
			$sql = "SELECT COUNT(*) FROM tblref_flr WHERE floor = '".$_POST["flr"]."'";
			$result = mysql_query($sql, $connection);
			$row = mysql_fetch_array($result);

			if($row[0] == 0)
			{
				$sql2 = "INSERT INTO tblref_flr(floor)VALUES('".$_POST["flr"]."')";
				$result2 = mysql_query($sql2, $connection);
				if($result2 == true)
				{
					echo 1;
				}
			}
			else
			{
				echo 2;
			}
		break;

		case 'editmallinformation':
			$sql = "SELECT mallid, mallname, malladdress, abouts, mall_image, telephone_number, email FROM tblref_mall WHERE mallid = '".$_POST["id"]."'";
			$result = mysql_query($sql, $connection);
			while($row = mysql_fetch_array($result))
			{
				echo $row["mallid"]."|".$row["mallname"]."|".$row["malladdress"]."|".$row["abouts"]."|server/mall_image/".$row["mall_image"]."|".$row[5]."|".$row[6];
			}
		break;

		case 'savemallupdate':
			if($_POST["id"] == "")
			{
				$mallid = createidno("MALL", "tblref_mall", "mallid");
				$sql = "INSERT into tblref_mall (mallid, mallname, malladdress, abouts, telephone_number, email) values('" . $mallid . "', '" . $_POST["name"] . "', '" . $_POST["loc"] . "', '" . $_POST["abouts"] . "', '". $_POST['telephone'] ."', '". $_POST['email'] ."')";
				$alert = "1|".$mallid . "|";
			}

			else
			{
				$sql = "UPDATE tblref_mall SET mallname = '". $_POST["name"] ."',  malladdress = '". $_POST["loc"] ."', abouts = '". $_POST["abouts"] ."', telephone_number = '". $_POST['telephone'] ."', email = '". $_POST['email'] ."' WHERE mallid = '". $_POST["id"] ."'";
				$alert = "2|".$_POST["id"] . "|";
			}
			$result = mysql_query($sql);
			if($result == true)
			{
					echo $alert;
			}
		break;

		case 'deletemall':
			$sql = "UPDATE tblref_mall SET mallstat = '0' WHERE mallid = '".$_POST["id"]."'";
			$result = mysql_query($sql, $connection);
			if($result == true)
			{
				$sql2 = "UPDATE tblref_wing SET wingstat = '0' WHERE mallID = '".$_POST["id"]."'";
				$result2 = mysql_query($sql2, $connection);
				if($result2 == true)
				{
					$sql3 = "UPDATE tblref_floorsetup SET floorstat = '0' WHERE mallid = '".$_POST["id"]."'";
					$result3 = mysql_query($sql3, $connection);
					if($result3 == true)
					{
						$sql4 = "UPDATE tblref_unit SET unitstat = '0' WHERE unitid = '".$_POST["id"]."'";
						$result4 = mysql_query($sql4, $connection);
						if($result4 == true)
						{
							echo 1;
						}
					}
				}
			}
		break;

		case 'reactivate':
			$sql = "UPDATE tblref_mall SET mallstat = '1' WHERE mallid = '".$_POST["id"]."'";
			$result = mysql_query($sql, $connection);
			if($result == true)
			{
				$sql2 = "UPDATE tblref_wing SET wingstat = '1' WHERE mallID = '".$_POST["id"]."'";
				$result2 = mysql_query($sql2, $connection);
				if($result2 == true)
				{
					$sql3 = "UPDATE tblref_floorsetup SET floorstat = '1' WHERE mallid = '".$_POST["id"]."'";
					$result3 = mysql_query($sql3, $connection);
					if($result3 == true)
					{
						$sql4 = "UPDATE tblref_unit SET unitstat = '1' WHERE unitid = '".$_POST["id"]."'";
						$result4 = mysql_query($sql4, $connection);
						if($result4 == true)
						{
							echo 1;
						}
					}
				}
			}
		break;

		case 'loadtblamenitiesreflist':
			$sql = "SELECT amenitiesid, amenitiesname, qty FROM tblref_amenities";
			$result = mysql_query($sql, $connection);
			while($row = mysql_fetch_array($result))
			{
				echo "<tr style='width: 100%;display: table;table-layout: fixed;'>
						<td style=''>
							<div class='checkbox' style='margin:3px;'>
								<label>
									<input name='form-field-checkbox' type='checkbox' class='ace amenities_chk' value='".$row["amenitiesid"]."' onchange='checkamenities(\"".$row["amenitiesid"]."\")' id='trsschk_".$row["amenitiesid"]."'>
									<span class='lbl' id='amenities_chk_".$row["amenitiesid"]."'> ".$row["amenitiesname"]."</span>
								</label>
							</div>
						</td>
					  </tr>";

				if($row["qty"] == "0")
				{

				}
				else if($row["qty"] == "1")
				{
					echo "<tr style='width: 100%;display: none;table-layout: fixed;' id='trss_".$row["amenitiesid"]."'>
							<td>
								<input type='text' class='form-control numonly' id='txtqty_".$row["amenitiesid"]."' style='width:95%;float:right;text-align:right;' placeholder='qty'>
							</td>
						  </tr>";
				}

			}
		break;

		case 'savenewamenitiesref':
			$amenitiesid = createidno("A", "tblref_amenities", "amenitiesid");
			$sql = "INSERT INTO tblref_amenities (amenitiesid, amenitiesname, qty) VALUES('".$amenitiesid."', '". $_POST["newame"]. "', '".$_POST["radio"]."')";
			$result = mysql_query($sql, $connection);
			if($result == true)
			{
				echo 1;
			}
		break;

		case 'loadaddedameni':
			$sql = "SELECT amenitiesid, amenitiesname, qty FROM tblref_amenities ".$_POST["amenities"]."";
			$result = mysql_query($sql, $connection);
			while($row = mysql_fetch_array($result))
			{
				echo "<tr style='width: 100%;display: table;table-layout: fixed;'>
						<td style=''>
							<div class='checkbox' style='margin:3px;'>
								<label>
									<input name='form-field-checkbox' type='checkbox' class='ace amenities_chk' value='".$row["amenitiesid"]."' onchange='checkamenities(\"".$row["amenitiesid"]."\")' id='trsschk_".$row["amenitiesid"]."'>
									<span class='lbl' id='amenities_chk_".$row["amenitiesid"]."'> ".$row["amenitiesname"]."</span>
								</label>
							</div>
						</td>
					  </tr>";

				if($row["qty"] == "0")
				{

				}
				else if($row["qty"] == "1")
				{
					echo "<tr style='width: 100%;display: none;table-layout: fixed;' id='trss_".$row["amenitiesid"]."'>
							<td>
								<input type='text' class='form-control numonly' id='txtqty_".$row["amenitiesid"]."' style='width:95%;float:right;text-align:right;' placeholder='qty'>
							</td>
						  </tr>";
				}

			}
		break;

		case 'loadcompanylist':
			$page = $_POST['page'];
			$limit = ($page-1) * 20;
			$search = " ( Company LIKE '%".$_POST['txtsearchcompany']."%')";

			$sql = "SELECT Company, CompanyID, businessAddress FROM tbltrans_company WHERE ".$search." LIMIT ".$limit.",20 ";
			$result = mysql_query($sql, $connection);
			while($row = mysql_fetch_array($result))
			{
				echo "<tr>
							<td><button class='btn btn-light btn-xs'><i class='fa red fa-pencil bigger-110' style='display:inline;' onclick='updatecompany(\"".$row["CompanyID"]."\")'></i></button><label style='margin-left: 15px;width:88%;display:inline;' onclick='selectthiscompanyforref(\"".$row["CompanyID"]."\")'>".$row["Company"]."</label></td>
							<td onclick='selectthiscompanyforref(\"".$row["CompanyID"]."\")'>".$row["businessAddress"]."</td>
					  </tr>";
			}
		break;

		case 'savenewmall':
			$companyid = createidno("COM", "tbltrans_company", "CompanyID");
			$sql = "INSERT INTO tbltrans_company(CompanyID, Company, industry, businessAddress, owner_firstname, owner_middlename, owner_lastname, permanent_address, current_address, billing_address, remarks) VALUES('".$companyid."','".$_POST["name"]."', '".$_POST["industry"]."', '".$_POST["busadd"]."', '".$_POST["fname"]."', '".$_POST["mname"]."', '".$_POST["lname"]."', '".$_POST["perm_add"]."', '".$_POST["curr_add"]."', '".$_POST["bill_add"]."', '')";
			$result = mysql_query($sql, $connection);

			$ownertel = explode("|", $_POST["owner_tel_no"]);
			for($i=0; $i<=count($ownertel)-2; $i++)
			{
				$owner_telno = "INSERT INTO tbltrans_company_owner_contacts(CompanyID, type, content) VALUES('".$companyid."', 'telephone', '".$ownertel[$i]."')";
				$result_owner_telno = mysql_query($owner_telno, $connection);
			}

			$contact_mobile = explode("|", $_POST["contact_mobile"]);
			for($j=0; $j<=count($contact_mobile)-2; $j++)
			{
				$contact_mobile_query = "INSERT INTO tbltrans_company_contacts(CompanyID, type, content) VALUES('".$companyid."', 'mobile', '".$contact_mobile[$j]."')";
				$contact_mobile_result = mysql_query($contact_mobile_query, $connection);
			}

			$contact_tele = explode("|", $_POST["contact_tele"]);
			for($k=0; $k<=count($contact_tele)-2; $k++)
			{
				$contact_tele_query = "INSERT INTO tbltrans_company_contacts(CompanyID, type, content) VALUES('".$companyid."', 'telephone', '".$contact_tele[$k]."')";
				$contact_tele_result = mysql_query($contact_tele_query, $connection);
			}

			$contact_fax = explode("|", $_POST["contact_fax"]);
			for($l=0; $l<=count($contact_fax)-2; $l++)
			{
				$contact_fax_query = "INSERT INTO tbltrans_company_contacts(CompanyID, type, content) VALUES('".$companyid."', 'fax', '".$contact_fax[$l]."')";
				$contact_fax_result = mysql_query($contact_fax_query, $connection);
			}

			$contact_email = explode("|", $_POST["contact_email"]);
			for($m=0; $m<=count($contact_email)-2; $m++)
			{
				$contact_email_query = "INSERT INTO tbltrans_company_contacts(CompanyID, type, content) VALUES('".$companyid."', 'email', '".$contact_email[$m]."')";
				$contact_email_result = mysql_query($contact_email_query, $connection);
			}

			$contact_website = explode("|", $_POST["contact_website"]);
			for($n=0; $n<=count($contact_website)-2; $n++)
			{
				$contact_website_query = "INSERT INTO tbltrans_company_contacts(CompanyID, type, content) VALUES('".$companyid."', 'website', '".$contact_website[$n]."')";
				$contact_website_result = mysql_query($contact_website_query, $connection);
			}

			if($result == true)
			{
				echo $companyid."|1|Successfully Added";
			}
		break;

		case 'savecontactpersons':
			$contactid = createidno("CON", "tbltrans_company_contact_person", "ConID");
			$sql = "INSERT INTO tbltrans_company_contact_person (ConID, Confname, Conmname, Conlname, custID, name, designation, address)VALUES('".$_POST["id"]."', '".$_POST["firstname_val"]."', '".$_POST["middlename_val"]."', '".$_POST["lastname_val"]."', '".$contactid."', '".$_POST["firstname_val"]." ".$_POST["middlename_val"]." ".$_POST["lastname_val"]."', '".$_POST["designation_val"]."', '".$_POST["address_val"]."')";
			$result = mysql_query($sql, $connection);

			$email_string = explode("|", $_POST["email_string"]);
			for($a=0; $a<=count($email_string)-2; $a++)
			{
				$email_string_query = "INSERT INTO tbltrans_company_contact_person_contacts(ConID, type, content) VALUES('".$contactid."', 'email', '".$email_string[$a]."')";
				$email_string_result = mysql_query($email_string_query, $connection);
			}

			$mobile_string = explode("|", $_POST["mobile_string"]);
			for($b=0; $b<=count($mobile_string)-2; $b++)
			{
				$mobile_string_query = "INSERT INTO tbltrans_company_contact_person_contacts(ConID, type, content) VALUES('".$contactid."', 'mobile', '".$mobile_string[$b]."')";
				$mobile_string_result = mysql_query($mobile_string_query, $connection);
			}

			$tele_string = explode("|", $_POST["tele_string"]);
			for($c=0; $c<=count($tele_string)-2; $c++)
			{
				$tele_string_query = "INSERT INTO tbltrans_company_contact_person_contacts(ConID, type, content) VALUES('".$contactid."', 'telephone', '".$tele_string[$c]."')";
				$tele_string_result = mysql_query($tele_string_query, $connection);
			}

			echo $contactid;
		break;

		case 'loadtenantslist':
			$page = $_POST['page'];
			$limit = ($page-1) * 20;
			$search = " ( tradename LIKE '%".$_POST['txtsearchtradename']."%')";

			$sql = "SELECT a.companyid,  b.tradename, a.company, a.businessaddress, b.tradeID FROM tbltrans_company AS a INNER JOIN tbltrans_tradename AS b ON a.companyID = b.companyID WHERE ".$search." LIMIT ".$limit.",20 ";
			$result = mysql_query($sql, $connection);
			while($row = mysql_fetch_array($result))
			{
				echo "<tr>
							<td><button class='btn btn-light btn-xs'><i class='fa red fa-pencil bigger-110' style='display:inline;' onclick='editstorename(\"".$row["tradeID"]."\")'></i></button><label style='margin-left: 15px;width:85%;display:inline;' onclick='selecttenant(\"".$row[0]."\", \"".$row[4]."\")'>".$row[1]."</label></td>
							<td onclick='selecttenant(\"".$row[0]."\", \"".$row[4]."\")'>".$row[2]."</td>
							<td onclick='selecttenant(\"".$row[0]."\", \"".$row[4]."\")'>".$row[3]."</td>
					  </tr>";
			}
		break;

		case 'selecttenant':
			$sql = "SELECT CompanyID, Company, industryID, industry, businessAddress, owner_firstname, owner_middlename, owner_lastname, permanent_address, current_address, billing_address, remarks, filename FROM tbltrans_company WHERE CompanyID = '".$_POST["companyID"]."'";
			$result = mysql_query($sql, $connection);
			$row = mysql_fetch_array($result);

			$sql2 = "SELECT tradename, filename FROM tbltrans_tradename WHERE tradeID = '".$_POST["tradeID"]."'";
			$result2 = mysql_query($sql2, $connection);
			$row2 = mysql_fetch_array($result2);

			$tblcontact = "<table>";
			$sql3 = "SELECT content FROM tbltrans_company_owner_contacts WHERE CompanyID = '".$row["CompanyID"]."'";
			$result3 = mysql_query($sql3, $connection);
			while($row3 = mysql_fetch_array($result3))
			{
				$tblcontact .= "<tr><td>".$row3["content"]."</td></tr>";
			}
			$tblcontact .= "</table>";
			echo $row["CompanyID"] . "|" . $row["Company"] . "|" . $row["industryID"] . "|" . $row["industry"] . "|" . $row["businessAddress"] . "|" . $row["owner_firstname"] . "|" . $row["owner_middlename"] . "|" . $row["owner_lastname"] . "|" . $row["permanent_address"] . "|" . $row["current_address"] . "|" . $row["billing_address"] . "|" . $row["remarks"] . "|" . $row["filename"] . "|" . $row2["tradename"] . "|" . $row2["filename"]."|".$tblcontact."|";
		break;

		case 'selectunit':
			$sql = "SELECT unitid, unitname, sqmunitsetup, pricepersqmunitsetup, totalamountunitsetup, mallid, bldgnumber, floorid, wingid, classid, typeofbusiness, sqm_width, sqm_height, depid, catid, assocdues FROM tblref_unit WHERE unitid = '".$_POST["UnitID"]."'";
			$result = mysql_query($sql, $connection);
			$row = mysql_fetch_array($result);

			$sql3 = "SELECT datefrom, dateto, CategoryID, DepartmentID, UnitType, ClassID, desired_noofdays, desired_noofmonths, monthly_dues, assoc_dues FROM tbltrans_inquiry WHERE Inquiry_ID = '".$_POST["Inquiry_ID"]."'";
			$result3 = mysql_query($sql3, $connection);
			$row3 = mysql_fetch_array($result3);

			$sql2 = "SELECT tradename FROM tbltrans_tradename WHERE tradeID = '".$_POST["TradeID"]."'";
			$result2 = mysql_query($sql2, $connection);
			$row2 = mysql_fetch_array($result2);

			$sql9 = "SELECT UnitName, width, ulength, amountpersqm, totalamountsqm, FlrName, WingID, MallID FROM tblref_unit_lca_dummy WHERE inquiryID = '".$_POST["Inquiry_ID"]."'";
			$result9 = mysql_query($sql9, $connection);
			$row9 = mysql_fetch_array($result9);


			$sql6 = "SELECT classification FROM tblref_merchandise_class WHERE classificationID = '".$row["classid"]."'"; //txtinqprint_class
			$result6 = mysql_query($sql6, $connection);
			$row6 = mysql_fetch_array($result6);

			$sql7 = "SELECT department FROM tblref_merchandise_depa WHERE departmentID = '".$row["depid"]."'"; //txtinqprint_depa
			$result7 = mysql_query($sql7, $connection);
			$row7 = mysql_fetch_array($result7);

			$sql8 = "SELECT category FROM tblref_merchandisedep_cat WHERE categoryID = '".$row["catid"]."'"; //txtinqprint_unitcategory
			$result8 = mysql_query($sql8, $connection);
			$row8 = mysql_fetch_array($result8);

				$sql4 = "SELECT floor FROM tblref_floorsetup WHERE floorid = '".$row["floorid"]."'"; //txtinqprint_flrname
				$result4 = mysql_query($sql4, $connection);
				$row4 = mysql_fetch_array($result4);

				$sql5 = "SELECT wing FROM tblref_wing WHERE wingID = '".$row["wingid"]."'"; //txtinqprint_wingname
				$result5 = mysql_query($sql5, $connection);
				$row5 = mysql_fetch_array($result5);


				$sqla = "SELECT classification FROM tblref_merchandise_class WHERE classificationID = '".$row3["ClassID"]."'"; //txtinqprint_class
				$resulta = mysql_query($sqla, $connection);
				$rowa = mysql_fetch_array($resulta);

				$sqlb = "SELECT department FROM tblref_merchandise_depa WHERE departmentID = '".$row3["DepartmentID"]."'"; //txtinqprint_depa
				$resultb = mysql_query($sqlb, $connection);
				$rowb = mysql_fetch_array($resultb);

				$sqlc = "SELECT category FROM tblref_merchandisedep_cat WHERE categoryID = '".$row3["CategoryID"]."'";
				$resultc = mysql_query($sqlc, $connection);
				$rowc = mysql_fetch_array($resultc);

				$sqld = "SELECT floor FROM tblref_floorsetup WHERE floorid = '".$row9["FlrName"]."'"; //txtinqprint_flrname
				$resultd = mysql_query($sqld, $connection);
				$rowd = mysql_fetch_array($resultd);

				$sqle = "SELECT wing FROM tblref_wing WHERE wingID = '".$row9["WingID"]."'"; //txtinqprint_wingname
				$resulte = mysql_query($sqle, $connection);
				$rowe = mysql_fetch_array($resulte);

	            $totalmonthlydues = $row3[9] + $row3[8];
				echo $row["unitid"]."|".$row["unitname"]."|".$row["sqmunitsetup"]."|".number_format($row["pricepersqmunitsetup"], 2, '.', ',')."|".number_format($row["totalamountunitsetup"], 2, '.', ',')."|".$row["mallid"]."|".$row["bldgnumber"]."|".$row["floorid"]."|".$row["wingid"]."|".$row["classid"]."|".$row["typeofbusiness"]."|".$row3["datefrom"]."|".$row3["dateto"]."|".$row3["CategoryID"]."|".$row3["DepartmentID"]."|".$row["sqm_width"]."|".$row["sqm_height"] . "|" . $row4["floor"] . "|" . $row5["wing"] . "|" . $rowa["classification"] . "|" . $rowb["department"] . "|" . $rowc["category"] . "|". $row9["UnitName"] . "|" . $row9["width"] . "|" . $row9["ulength"] . "|" . $row9["amountpersqm"] . "|" . $row9["totalamountsqm"] . "|" . $rowd["floor"] . "|" . $rowe["wing"] . "|" . $row9["MallID"] . "|" . $row3["department"] . "|" . $rowc["category"] . "|" . $row3["depamount"] . "|" . $row3["advamount"] . "|" . $row3["UnitType"] . "|" . $row3["desired_noofdays"] . "|" . $row3["desired_noofmonths"] . "|" . $row3["UnitType"] . "|" . $row[15] . "|" . 
				number_format($row3[9], 2, '.', ',') . "|" . number_format($row3[8], 2, '.', ',') . "|" . number_format($totalmonthlydues, 2, '.', ',');
		break;

		case 'selectunit2':
			$sql = "SELECT unitid, unitname, sqmunitsetup, pricepersqmunitsetup, totalamountunitsetup, mallid, bldgnumber, floorid, wingid, classid, typeofbusiness, sqm_width, sqm_height, depid, catid, assocdues FROM tblref_unit WHERE unitid = '".$_POST["UnitID"]."'";
			$result = mysql_query($sql, $connection);
			$row = mysql_fetch_array($result);

			$sql3 = "SELECT datefrom, dateto, CategoryID, DepartmentID, UnitType, depamount, advamount, monthly_dues, assoc_dues FROM tbltrans_inquiry WHERE Inquiry_ID = '".$_POST["Inquiry_ID"]."'";
			$result3 = mysql_query($sql3, $connection);
			$row3 = mysql_fetch_array($result3);

			$sql2 = "SELECT tradename FROM tbltrans_tradename WHERE tradeID = '".$_POST["TradeID"]."'";
			$result2 = mysql_query($sql2, $connection);
			$row2 = mysql_fetch_array($result2);

			$sql9 = "SELECT unitname, sqm_width, sqm_height, pricepersqmunitsetup, totalamountunitsetup, floorid, wingid, mallid FROM tblref_unit WHERE unitid = '".$_POST["UnitID"]."'";
			$result9 = mysql_query($sql9, $connection);
			$row9 = mysql_fetch_array($result9);

			$sql6 = "SELECT classification FROM tblref_merchandise_class WHERE classificationID = '".$row["classid"]."'"; //txtinqprint_class
			$result6 = mysql_query($sql6, $connection);
			$row6 = mysql_fetch_array($result6);

			$sql7 = "SELECT department FROM tblref_merchandise_depa WHERE departmentID = '".$row["depid"]."'"; //txtinqprint_depa
			$result7 = mysql_query($sql7, $connection);
			$row7 = mysql_fetch_array($result7);

			$sql8 = "SELECT category FROM tblref_merchandisedep_cat WHERE categoryID = '".$row["catid"]."'"; //txtinqprint_unitcategory
			$result8 = mysql_query($sql8, $connection);
			$row8 = mysql_fetch_array($result8);

			$sql4 = "SELECT floor FROM tblref_floorsetup WHERE floorid = '".$row["floorid"]."'"; //txtinqprint_flrname
			$result4 = mysql_query($sql4, $connection);
			$row4 = mysql_fetch_array($result4);

			$sql5 = "SELECT wing FROM tblref_wing WHERE wingID = '".$row["wingid"]."'"; //txtinqprint_wingname
			$result5 = mysql_query($sql5, $connection);
			$row5 = mysql_fetch_array($result5);

	        $totalmonthlydues = $row3[8] + $row3[7];

			echo $_POST["UnitID"] . "|" . $row9["sqm_width"] . "|" . $row9["sqm_height"] . "|" . $row9["pricepersqmunitsetup"] . "|" . number_format($row9["totalamountunitsetup"], 2, '.', ',') . "|" . $row9["floorid"] . "|" . $row9["wingid"] . "|" . $row9["mallid"] . "|" . $row3["DepartmentID"] . "|" . $row3["CategoryID"] . "|" . number_format($row3["depamount"], 2, '.', ',') . "|" . number_format($row3["advamount"], 2, '.', ',') . "|" . $row[15] . "|" . number_format($row3[7], 2, '.', ',') . "|" . number_format($totalmonthlydues, 2, '.', ',') . "|" . number_format($row3[8], 2, '.', ',');
		break;

		case 'selectcontactnumbers':
			$i = 0;
			$sql = "SELECT CompanyID, type, content FROM tbltrans_company_contacts WHERE CompanyID = '".$_POST["companyID"]."' AND type = 'mobile'";
			$result = mysql_query($sql, $connection);
			while($row = mysql_fetch_array($result))
			{
				$i++;
				if($i == 1)
				{
					echo"<div class='alert alert-info'>";
						echo"<div class='row form-group' style='margin-bottom:0px;'>
								<div class='col-md-12'>
									<label>Mobile No</label>
								</div>
							 </div>";
						echo"<div class='row form-group' style='margin-bottom:0px;'>
	            		      <div class='col-md-12 col-xs-12' style='font-size:12px;'>
	            		          ".$row["content"]."
	            		      </div>
	            		    </div>";
				}
				else
				{
						echo"<div class='row form-group' style='margin-bottom:0px;'>
	            		      <div class='col-md-12 col-xs-12' style='font-size:12px;'>
	            		          ".$row["content"]."
	            		      </div>
	            		    </div>";
				}

			}
			echo "</div>";

			$j = 0;
			$sql2 = "SELECT CompanyID, type, content FROM tbltrans_company_contacts WHERE CompanyID = '".$_POST["companyID"]."' AND type = 'telephone'";
			$result2 = mysql_query($sql2, $connection);
			while($row2 = mysql_fetch_array($result2))
			{
				$j++;
				if($j == 1)
				{
					echo"<div class='alert alert-info'>";
						echo"<div class='row form-group' style='margin-bottom:0px;'>
								<div class='col-md-12'>
									<label>Telephone No</label>
								</div>
							 </div>";
						echo"<div class='row form-group' style='margin-bottom:0px;'>
	            		      <div class='col-md-12 col-xs-12' style='font-size:12px;'>
	            		          ".$row2["content"]."
	            		      </div>
	            		    </div>";
				}
				else
				{
						echo"<div class='row form-group' style='margin-bottom:0px;'>
	            		      <div class='col-md-12 col-xs-12' style='font-size:12px;'>
	            		          ".$row2["content"]."
	            		      </div>
	            		    </div>";
				}

			}
			echo "</div>";

			$k = 0;
			$sql3 = "SELECT CompanyID, type, content FROM tbltrans_company_contacts WHERE CompanyID = '".$_POST["companyID"]."' AND type = 'fax'";
			$result3 = mysql_query($sql3, $connection);
			while($row3 = mysql_fetch_array($result3))
			{
				$k++;
				if($k == 1)
				{
					echo"<div class='alert alert-info'>";
						echo"<div class='row form-group' style='margin-bottom:0px;'>
								<div class='col-md-12'>
									<label>Fax No</label>
								</div>
							 </div>";
						echo"<div class='row form-group' style='margin-bottom:0px;'>
	            		      <div class='col-md-12 col-xs-12' style='font-size:12px;'>
	            		          ".$row3["content"]."
	            		      </div>
	            		    </div>";
				}
				else
				{
						echo"<div class='row form-group' style='margin-bottom:0px;'>
	            		      <div class='col-md-12 col-xs-12' style='font-size:12px;'>
	            		          ".$row3["content"]."
	            		      </div>
	            		    </div>";
				}

			}
			echo "</div>";

			$l = 0;
			$sql4 = "SELECT CompanyID, type, content FROM tbltrans_company_contacts WHERE CompanyID = '".$_POST["companyID"]."' AND type = 'email'";
			$result4 = mysql_query($sql4, $connection);
			while($row4 = mysql_fetch_array($result4))
			{
				$l++;

				if($l == 1)
				{
						echo"<div class='alert alert-info'>";
						echo"<div class='row form-group' style='margin-bottom:0px;'>
								<div class='col-md-12'>
									<label>Email</label>
								</div>
							 </div>";
						echo"<div class='row form-group' style='margin-bottom:0px;'>
	            		      <div class='col-md-12 col-xs-12' style='font-size:12px;'>
	            		          ".$row4["content"]."
	            		      </div>
	            		    </div>";
				}
				else
				{
						echo"<div class='row form-group' style='margin-bottom:0px;'>
	            		      <div class='col-md-12 col-xs-12' style='font-size:12px;'>
	            		          ".$row4["content"]."
	            		      </div>
	            		    </div>";
				}

			}
			echo "</div>";
		break;

		case 'selectcontactnumbers2':
			$sql = "SELECT CompanyID, type, content FROM tbltrans_company_contacts WHERE CompanyID = '".$_POST["companyID"]."' AND type = 'mobile'";
			$result = mysql_query($sql, $connection);
			while($row = mysql_fetch_array($result))
			{

						echo $row["content"]."<br />";

			}

			echo "#|";
			$sql2 = "SELECT CompanyID, type, content FROM tbltrans_company_contacts WHERE CompanyID = '".$_POST["companyID"]."' AND type = 'telephone'";
			$result2 = mysql_query($sql2, $connection);
			while($row2 = mysql_fetch_array($result2))
			{
				echo $row2["content"]."<br />";

			}
			echo "#|";

			$sql3 = "SELECT CompanyID, type, content FROM tbltrans_company_contacts WHERE CompanyID = '".$_POST["companyID"]."' AND type = 'fax'";
			$result3 = mysql_query($sql3, $connection);
			while($row3 = mysql_fetch_array($result3))
			{
				echo $row3["content"]."<br />";

			}
			echo "#|";

			$sql4 = "SELECT CompanyID, type, content FROM tbltrans_company_contacts WHERE CompanyID = '".$_POST["companyID"]."' AND type = 'email'";
			$result4 = mysql_query($sql4, $connection);
			while($row4 = mysql_fetch_array($result4))
			{
				echo $row4["content"]."<br />";
			}
			echo "#|";

			$sql5 = "SELECT CompanyID, type, content FROM tbltrans_company_contacts WHERE CompanyID = '".$_POST["companyID"]."' AND type = 'website'";
			$result5 = mysql_query($sql5, $connection);
			while($row5 = mysql_fetch_array($result5))
			{
				echo $row5["content"]."<br />";
			}
			echo "#|";
		break;

		case 'selectcontactpersons':
			$sql = "SELECT ConID, Confname, Conmname, Conlname, custID, name, designation, address, filename FROM tbltrans_company_contact_person WHERE ConID = '".$_POST["companyID"]."'";
			$result = mysql_query($sql, $connection);
			while($row = mysql_fetch_array($result))
			{
				echo "<div class='alert alert-info div_inquiry_wells' id='contact_".$row["custID"]."'><center><div class='image'><img class='img-thumbnail imageName form-control' src='server/company/".$_POST["companyID"]."/contact_person/".$row["custID"]."/".$row["filename"]."' style='border: 2px solid #bdc3c7; margin-bottom: 8px;height: 160px;width:90%;'></div></center><label style='font-size: 14px; font-weight: bold;margin: 0px !important;' class='contact_person_firstname'>".$row["Confname"]." ".$row["Conmname"]." ".$row["Conlname"]."</label><p style='font-size: 14px; font-weight: normal;margin: 0px !important;' class='contact_person_designation'>".$row["designation"]."</p><p style='font-size: 10px; font-weight: normal;margin: 0px !important;' class='address_person'>".$row["address"]."</p>";

				$sql2 = "SELECT content FROM tbltrans_company_contact_person_contacts WHERE ConID = '".$row["custID"]."'";
				$result2 = mysql_query($sql2, $connection);
				while($row2 = mysql_fetch_array($result2))
				{
					echo"<p style='font-size: 10px; font-weight: normal;margin: 0px !important;'>".$row2["content"]."</p>";
				}
				echo "</div>";
			}
		break;

		case 'selectthiscompanyforref':
			$sql = "SELECT CompanyID, Company, industry, businessAddress FROM tbltrans_company WHERE CompanyID = '".$_POST["companyid"]."'";
			$result = mysql_query($sql, $connection);
			$row = mysql_fetch_array($result);

			echo $row["CompanyID"] . "|" . $row["Company"] . "|" . $row["industry"] . "|" . $row["businessAddress"] . "|";
		break;

		case 'savetradename':
			$tradeid = createidno("TRADE", "tbltrans_tradename", "tradeID");
			$sql = "INSERT INTO tbltrans_tradename (tradeID, tradename, companyID)VALUES('".$tradeid."', '".$_POST["tradename"]."', '".$_POST["companyid"]."')";
			$result = mysql_query($sql, $connection);
			$row = mysql_fetch_array($result);

			if($result == true)
			{
				echo "1|".$_POST["companyid"]."|".$tradeid;
			}
		break;

		case 'viewinquiry':

			$sql = "SELECT Mall, Mall_ID, Remarks, remarks_Reservation, datepayment, amount, alertdate, remarks_Reservation, accof_Reservation, alerttype_cus, alerttype_email, datefrom, dateto, depamount, advamount, dep_month, adv_month, applicationDate, Status, Application_Remarks, Application_ID, billingtype, ClassID, UnitType, desired_noofmonths, desired_noofdays, inq_by, app_by, mod_by, date_inquired, date_approved, date_applied, date_modified, time_inquired, appr_by, merchant_code, owner_card_number, month_adv, UnitID, payment_terms, payment_type, reservationfee FROM tbltrans_inquiry WHERE Inquiry_ID = '".$_POST["Inquiry_ID"]."'";
			$result = mysql_query($sql, $connection);
			$row = mysql_fetch_array($result);

			$sql_3 = "SELECT totalamountunitsetup FROM tblref_unit WHERE unitid = '".$row["UnitID"]."'";
			$result_3 = mysql_query($sql_3, $connection);
			$row_3 = mysql_fetch_array($result_3);

			$sql_2 = "SELECT revpercent FROM tbltrans_tenants WHERE inqID = '".$_POST["Inquiry_ID"]."'";
			$result_2 = mysql_query($sql_2, $connection);
			$row_2 = mysql_fetch_array($result_2);



					$date1 = $row["datefrom"];
					$date2 = $row["dateto"];

					$ts1 = strtotime($date1);
					$ts2 = strtotime($date2);

					$year1 = date('Y', $ts1);
					$year2 = date('Y', $ts2);

					$month1 = date('m', $ts1);
					$month2 = date('m', $ts2);

					$months = (($year2 - $year1) * 12) + ($month2 - $month1);


					$days = (strtotime($row["dateto"]) - strtotime($row["datefrom"])) / (60 * 60 * 24);
					echo $row["Mall"] . "|" . $row["Mall_ID"] . "|" . $row["Remarks"] . "|" . $row["remarks_Reservation"] . "|" . $row["datepayment"] . "|" . $row["amount"] . "|" . $row["alertdate"] . "|" . $row["remarks_Reservation"] . "|" . $row["accof_Reservation"] . "|" . $row["alerttype_cus"] . "|" . $row["alerttype_email"] . "|" . $row["datefrom"] . "|" . $row["dateto"] . "|" . $months . "|" . $days. "|" . number_format($row["depamount"], 2, '.', ','). "|" . number_format($row["advamount"], 2, '.', ','). "|" . $row["dep_month"]. "|" . $row["adv_month"] . "|" . date("M d, Y", strtotime($row["date_inquired"])) . "|" . date("M d, Y", strtotime($row["applicationDate"])) . "|" . $row["Status"] . "|" . $row["Application_Remarks"] . "|" . $row["Application_ID"] . "||". $row["billingtype"] . "|" . $row["ClassID"] . "|" . $row["UnitType"] . "|" . $row["desired_noofmonths"] . "|" . $row["desired_noofdays"] . "||" . $row_2["revpercent"] . "|" . $row["inq_by"] ."|". $row["app_by"] ."|". $row["mod_by"] ."|". date("F d, Y", strtotime($row["date_inquired"])) ." ".date("h:i:s A", strtotime($row["time_inquired"]))."|". date("F d, Y h:i:s A", strtotime($row["date_approved"])) ."|". date("F d, Y h:i:s A", strtotime($row["date_applied"])) . "|" . date("F d, Y h:i:s A", strtotime($row["date_modified"])) . "|" . $row["appr_by"] . "|" . $row["merchant_code"] . "|" . $row["owner_card_number"] . "|" . $row["month_adv"] . "|" . $row_3["totalamountunitsetup"] . "|" . $row["payment_terms"] ."|". $row["payment_type"] . "|" . $row[41];
		break;

		case 'viewinquiry2':
			$sql_2 = "SELECT tenanttype FROM tbltrans_tenants WHERE inqID = '".$_POST["inqid"]."'";
			$result_2 = mysql_query($sql_2, $connection);
			$row_2 = mysql_fetch_array($result_2);

			echo $row_2["tenanttype"] . "#";
		break;

		case 'loadinquiry_department':
			echo '<option value="">-- Select Department --</option>';
			$querydep = "SELECT departmentID, department FROM tblref_merchandise_depa WHERE class_ID = '".$_POST["classification_id"]."'";
            $result_dep = mysql_query($querydep, $connection);
			while($row = mysql_fetch_array($result_dep)){
				$dep = "<option";
				$dep .= " value='".$row['departmentID']."'>".$row['department']."</option>";

				echo $dep;
			}
		break;

		case 'loadinquiry_department2':
			echo '<option value="">-- Select Department --</option>';
			if($_POST["classification_id"] != "" || $_POST["classification_id"] != undefined )
			{
				$condition = " WHERE class_ID = '".$_POST["classification_id"]."'";
			}
			else
			{
				$condition = "";
			}
				$querydep = "SELECT departmentID, department FROM tblref_merchandise_depa".$condition."";
	            $result_dep = mysql_query($querydep, $connection);
				while($row = mysql_fetch_array($result_dep)){
					$dep = "<option";
					$dep .= " value='".$row['departmentID']."'>".$row['department']."</option>";

					echo $dep;
				}
		break;

		case 'loadinquiry_category':
		echo '<option value="">-- Select Category --</option>';
			$querycat = "SELECT categoryID, category FROM tblref_merchandisedep_cat WHERE dept_ID = '".$_POST["department_id"]."'";
            $result_cat = mysql_query($querycat, $connection);
			while($row = mysql_fetch_array($result_cat)){
				$cat = "<option";
				$cat .= " value='".$row['categoryID']."'>".$row['category']."</option>";

				echo $cat;
			}
		break;

		case 'loadinquiry_category2':
		echo '<option value="">-- Select Category --</option>';
		if($_POST["department_id"] != "" || $_POST["department_id"] != undefined )
		{
			$condition = " WHERE dept_ID = '".$_POST["department_id"]."'";
		}
		else
		{
			$condition = "";
		}
			$querycat = "SELECT categoryID, category FROM tblref_merchandisedep_cat".$condition;
            $result_cat = mysql_query($querycat, $connection);
			while($row = mysql_fetch_array($result_cat)){
				$cat = "<option";
				$cat .= " value='".$row['categoryID']."'>".$row['category']."</option>";

				echo $cat;
			}

		break;

		case 'loadinquiry_wing2':
				echo '<option value="">-- Select Wing --</option>';
				if($_POST["classification_id"] != "")
				{
					$wings = "";
					$sql = "SELECT DISTINCT(wingid) FROM tblref_unit WHERE typeofbusiness = '".$_POST["type"]."' AND classid = '".$_POST["classification_id"]."' AND mallid = '".$_POST["mallid"]."'";
					$result = mysql_query($sql, $connection);
					while($row = mysql_fetch_array($result))
					{
						$wings .= $row["wingid"] . "|";
					}
					$condition = "";
					$wingid = explode("|", $wings);
					for($i=0; $i<=count($wingid)-2; $i++)
					{
						if($i == 0)
						{
							$condition .= " WHERE wingID = '".$wingid[$i]."' ";
						}
						else
						{
							$condition .= " OR wingID = '".$wingid[$i]."' ";
						}
					}
				}
				else
				{
					$condition = "";
				}

				$querywing = "SELECT wingID, wing FROM tblref_wing".$condition;
        		$result_wing = mysql_query($querywing, $connection);
				while($row2 = mysql_fetch_array($result_wing)){
					echo "<option value='".$row2["wingID"]."'>".$row2["wing"]."</option>";
				}

		break;

		case 'loadinquiry_flr2':
			echo "<option value=''>-- Select Floor --</option>";
			if($_POST["classification_id"] != "")
			{
				$wings = "";
				$sql = "SELECT DISTINCT(floorid) FROM tblref_unit WHERE typeofbusiness = '".$_POST["type"]."' AND classid = '".$_POST["classification_id"]."' AND mallid = '".$_POST["mallid"]."'";
				$result = mysql_query($sql, $connection);
				while($row = mysql_fetch_array($result))
				{
					$flrs .= $row["floorid"] . "|";
				}
				$condition = "";
				$flrid = explode("|", $flrs);
				for($i=0; $i<=count($flrid)-2; $i++)
				{
					if($i == 0)
					{
						$condition .= " WHERE floorid = '".$flrid[$i]."' ";
					}
					else
					{
						$condition .= " OR floorid = '".$flrid[$i]."' ";
					}
				}
			}
			else
			{
				$condition = "";
			}
			$queryflr = "SELECT floorid, floor FROM tblref_floorsetup".$condition;
        	$result_flr = mysql_query($queryflr, $connection);
			while($row = mysql_fetch_array($result_flr)){
				echo "<option value='".$row["floorid"]."'>".$row["floor"]."</option>";
			}
		break;

		case 'loadinquiry_wing':
			$wings = "";
			$sql = "SELECT DISTINCT(wingid) FROM tblref_unit WHERE typeofbusiness = 'LCA' AND classid = '".$_POST["classification_id"]."'";
			$result = mysql_query($sql, $connection);
			while($row = mysql_fetch_array($result))
			{
				$wings .= $row["wingid"] . "|";
			}
			$condition = "";
			$wingid = explode("|", $wings);
			for($i=0; $i<=count($wingid)-2; $i++)
			{
				if($i == 0)
				{
					$condition .= "WHERE wingID = '".$wingid[$i]."' ";
				}
				else
				{
					$condition .= "OR wingID = '".$wingid[$i]."' ";
				}
			}
				echo '<option value="">-- Select Wing --</option>';
				$querywing = "SELECT wingID, wing FROM tblref_wing ".$condition."";
        		$result_wing = mysql_query($querywing, $connection);
				while($row = mysql_fetch_array($result_wing)){
					echo "<option value='".$row["wingID"]."'>".$row["wing"]."</option>";
				}

		break;

		case 'loadinquiry_wing_lca':
		if($_POST["type"] == "SET")
		{
				$wings = "";
				$sql = "SELECT DISTINCT(wingid) FROM tblref_unit WHERE typeofbusiness = '".$_POST["type"]."' AND classid = '".$_POST["classification_id"]."' AND mallid = '".$_POST["mallid"]."'";
				$result = mysql_query($sql, $connection);
				$nummm = mysql_num_rows($result);
				while($row = mysql_fetch_array($result))
				{
					$wings .= $row["wingid"] . "|";
				}
				$condition = "";
				$wingid = explode("|", $wings);
				for($i=0; $i<=count($wingid)-2; $i++)
				{
					if($i == 0)
					{
						$condition .= "WHERE (wingID = '".$wingid[$i]."' ";
					}
					else
					{
						$condition .= "OR wingID = '".$wingid[$i]."' ";
					}
				}
				if($condition == "")
				{
					$and = "WHERE ";
				}
				else
				{
					$and = ") AND ";
				}
				if($nummm != 0)
				{
					$condition .= $and."mallID = '".$_POST["mallid"]."'";
					echo '<option value="">-- Select Wing --</option>';
					$querywing = "SELECT wingID, wing FROM tblref_wing ".$condition."";
        			$result_wing = mysql_query($querywing, $connection);
					while($row = mysql_fetch_array($result_wing)){
						echo "<option value='".$row["wingID"]."'>".$row["wing"]."</option>";
					}
				}
				else
				{
					echo '<option value="">-- Select Wing --</option>';
				}
		}
		else
		{
			echo '<option value="">-- Select Wing --</option>';
			$querywing = "SELECT wingID, wing FROM tblref_wing WHERE mallID = '".$_POST["mallid"]."'";
        	$result_wing = mysql_query($querywing, $connection);
			while($row = mysql_fetch_array($result_wing)){
				echo "<option value='".$row["wingID"]."'>".$row["wing"]."</option>";
			}
		}


		break;

		case 'loadinquiry_flr':
			$sql = "SELECT DISTINCT(floorid) FROM tblref_unit WHERE classid = '".$_POST["classification_id"]."' AND mallid = '".$_POST["mallid"]."' AND wingid = '".$_POST["wing_id"]."'";
			$result = mysql_query($sql, $connection);
			$nummm = mysql_num_rows($result);
			while($row = mysql_fetch_array($result))
			{
				$flrname .= $row["floorid"] . "|";
			}
			$condition = "";
			$flrid = explode("|", $flrname);
			for($i=0; $i<=count($flrid)-2; $i++)
			{
				if($i == 0)
				{
					$condition .= " AND (floorid = '".$flrid[$i]."' ";
				}
				else
				{
					$condition .= "OR floorid = '".$flrid[$i]."' ";
				}
			}
			if($condition != "")
			{
				$condition .= ")";
			}
			echo "<option value=''>-- Select Floor --</option>";
			$queryflr = "SELECT floorid, floor FROM tblref_floorsetup WHERE wingid = '".$_POST["wing_id"]."'".$condition;
        	$result_flr = mysql_query($queryflr, $connection);
			while($row = mysql_fetch_array($result_flr)){
				echo "<option value='".$row["floorid"]."'>".$row["floor"]."</option>";
			}
		break;

		case 'loadinquiry_unit_set':
		echo '<option value="">-- Select Unit --</option>';
			$queryunit = "SELECT unitid, unitname FROM tblref_unit WHERE floorid = '".$_POST["flr_id"]."'";
        	$result_unit = mysql_query($queryunit, $connection);
			while($row = mysql_fetch_array($result_unit)){
			echo "<option value='".$row["unitid"]."'>".$row["unitname"]."</option>";
			}
		break;

		case 'loadinquiry_unit2':
			echo '<option value="">-- Select Unit --</option>';
			if($_POST["classification_id"] != "")
			{
				$wings = "";
				$sql = "SELECT DISTINCT(unitid) FROM tblref_unit WHERE typeofbusiness = '".$_POST["type"]."' AND classid = '".$_POST["classification_id"]."' AND mallid = '".$_POST["mallid"]."'";
				$result = mysql_query($sql, $connection);
				while($row = mysql_fetch_array($result))
				{
					$units .= $row["unitid"] . "|";
				}
				$condition = "";
				$unitid = explode("|", $units);
				for($i=0; $i<=count($unitid)-2; $i++)
				{
					if($i == 0)
					{
						$condition .= " WHERE unitid = '".$unitid[$i]."' ";
					}
					else
					{
						$condition .= " OR unitid = '".$unitid[$i]."' ";
					}
				}
			}
			else
			{
				$condition = "";
			}

			$queryunit = "SELECT unitid, unitname FROM tblref_unit".$condition;
        	$result_unit = mysql_query($queryunit, $connection);
			while($row = mysql_fetch_array($result_unit)){
				echo "<option value='".$row["unitid"]."'>".$row["unitname"]."</option>";
			}
		break;

		case 'loadinquiry_unit_lca':
			echo '<option value="">-- Select Unit --</option>';
			$queryunit = "SELECT unitid, unitname FROM tblref_unit WHERE classid = '".$_POST["classification_id"]."' AND typeofbusiness = '".$_POST["type"]."' AND floorid = '".$_POST["flr"]."'";
        	$result_unit = mysql_query($queryunit, $connection);
			while($row = mysql_fetch_array($result_unit)){
				echo "<option value='".$row['unitid']."'>".$row['unitname']."</option>";
			}
		break;

		case 'selected_unit':
			$sql = "SELECT sqmunitsetup, pricepersqmunitsetup, totalamountunitsetup, assocdues, typeofbusiness FROM tblref_unit WHERE unitid = '".$_POST["unit_id"]."'";
			$result = mysql_query($sql, $connection);
			$row = mysql_fetch_array($result);

			if($row[3] == "1"){
                $sqlassocdues = mysql_fetch_array(mysql_query("SELECT associationdues FROM mall_setup WHERE mall_id = '". $_POST['mallid'] ."' ", $connection));
                $assocdues = $sqlassocdues[0];
            }else{
                $assocdues = 0;
            }

            $totalmonthlydues = $assocdues + $row[2];

			echo $row["sqmunitsetup"] . "|" . number_format($row["pricepersqmunitsetup"], 2, '.', ',') . "|" . number_format($row["totalamountunitsetup"], 2, '.', ',') . "|" . number_format($assocdues, '2', '.', ',') . "|" . number_format($totalmonthlydues, '2', '.', ',')."|".$row[4];
		break;

		case 'selected_unit_lca':
			$sql = "SELECT sqm_width, sqm_height, pricepersqmunitsetup, totalamountunitsetup, assocdues FROM tblref_unit WHERE unitid = '".$_POST["unit_id"]."'";
			$result = mysql_query($sql, $connection);
			$row = mysql_fetch_array($result);

			if($row[4] == "1"){
                $sqlassocdues = mysql_fetch_array(mysql_query("SELECT associationdues FROM mall_setup WHERE mall_id = '". $_POST['mallid'] ."' ", $connection));
                $assocdues = $sqlassocdues[0];
            }else{
                $assocdues = 0;
            }

            $totalmonthlydues = $assocdues + $row[3];

			echo $row["sqm_width"] . "|" . $row["sqm_height"] . "|" . number_format($row["pricepersqmunitsetup"], 2, '.', ',') . "|" . number_format($row["totalamountunitsetup"], 2, '.', ',') . "|" . number_format($assocdues, '2', '.', ',') . "|" . number_format($totalmonthlydues, '2', '.', ',');
		break;

		case 'selected_unit_amenities':
			$sql = "SELECT amenitiesID FROM tblref_unit_amenities WHERE unitID = '".$_POST["unit_id"]."'";
			$result = mysql_query($sql, $connection);
			$cnt = mysql_num_rows($result);
			if($cnt > 0)
			{
				echo '<div class="alert alert-info"><table><tr><td><h4 class="blue smaller lighter">Amenities</h4></td></tr>';
			}
			while($row = mysql_fetch_array($result))
			{
				$sql2 = "SELECT amenitiesname FROM tblref_amenities WHERE amenitiesid = '".$row["amenitiesID"]."'";
				$result2 = mysql_query($sql2, $connection);
				$row2 = mysql_fetch_array($result2);
				if($row2["amenitiesname"] != "")
				{
					echo "<tr>
							<td>
							<div class='checkbox' style='margin:3px;'>
									<label>
										<i class='ace-icon fa fa-check'></i>&nbsp;&nbsp;
										<span class='lbl'> &nbsp;&nbsp;&nbsp;".$row2["amenitiesname"]."</span>
									</label>
								</div>
							</td>
						</tr>";
				}


			}
			if($cnt > 0)
			{
				echo '</table></div>';
			}
			if($cnt == 0)
			{
				echo '<div class="alert alert-info"><table><tr><td><h4 class="blue smaller lighter">This unit has no amenities included.</h4></td></tr></table></div>';
			}
		break;

		case 'selected_unit_amenities2':
			$sql = "SELECT amenitiesID FROM tblref_unit_amenities WHERE unitID = '".$_POST["unit_id"]."'";
			$result = mysql_query($sql, $connection);
			while($row = mysql_fetch_array($result))
			{
				$sql2 = "SELECT amenitiesname FROM tblref_amenities WHERE amenitiesid = '".$row["amenitiesID"]."'";
				$result2 = mysql_query($sql2, $connection);
				$row2 = mysql_fetch_array($result2);
				echo "<li><i class='ace-icon fa fa-caret-right blue'></i>".$row2["amenitiesname"]."</li>";

			}
		break;

		case 'savereservationform':
			$sql_user = "SELECT firstname, middlename, lastname FROM tbluser WHERE userid = '".$_COOKIE["userid"]."'";
       		$res = mysql_query($sql_user, $connection);
       		$row_user = mysql_fetch_array($res);

			$tenantID = createidno("TENANT", "tbltrans_tenants", "TenantID");

			$sqlselectold_inq = mysql_fetch_array(mysql_query("SELECT datefrom, dateto FROM tbltrans_inquiry WHERE Inquiry_ID = '".$_POST["Inquiry_ID"]."' AND Application_ID = '".$_POST["Application_ID"]."'"));
			$date1_old = $sqlselectold_inq["datefrom"];
			$date2_old = $sqlselectold_inq["dateto"];

			$ts1_old = strtotime($date1_old);
			$ts2_old = strtotime($date2_old);

			$year1_old = date('Y', $ts1_old);
			$year2_old = date('Y', $ts2_old);

			$month1_old = date('m', $ts1_old);
			$month2_old = date('m', $ts2_old);

			$months_old = (($year2_old - $year1_old) * 12) + ($month2_old - $month1_old);


			$days = (strtotime($sqlselectold_inq["dateto"]) - strtotime($sqlselectold_inq["datefrom"])) / (60 * 60 * 24);
			$refDate23 = $sqlselectold_inq["datefrom"];

			for ($x=1; $x<=$days+1; $x++)
			{
				$refDate23 = date( 'Y-m-d', strtotime($refDate23) );
				$insert_logs = "UPDATE tblunit_statuslogs SET xstat = '1' WHERE tenantid = '".$_POST["Application_ID"]."' AND xdate = '".$refDate23."'";
				$result_logs = mysql_query($insert_logs);
				$refDate23 = date( 'Y-m-d', strtotime($refDate23 . '+1 day') );
			}

			$sqlcheckcontractid = " SELECT contractID, Mall_ID, datefrom, dateto, unitid FROM tbltrans_inquiry WHERE inquiry_ID = '". $_POST['Inquiry_ID'] ."' ";
			$rescheckcontractid = mysql_query($sqlcheckcontractid, $connection);
			$rowcheckcontractid = mysql_fetch_array($rescheckcontractid);

			$termsandconlist = explode("|", $_POST['contractterms']);
			for ($i=0; $i <= count($termsandconlist)-2; $i++) { 
				$selectby1 = mysql_fetch_array(mysql_query("SELECT Group_Name, Term_Name, Description FROM tblcondition WHERE Term_ID = '". $termsandconlist[$i] ."' ", $connection));
				$gname .= $selectby1[0]."|";
				$tname .= $selectby1[1]."|";
				$cond .= $selectby1[2]."|";
			}

			if($rowcheckcontractid[0] != ""){
				$sqlcontract = " UPDATE tblcontract SET Group_Name = '". mysql_real_escape_string($gname) ."', Term_Name = '". mysql_real_escape_string($tname) ."',  ids = '". $_POST['contractterms'] ."', Conditions = '".  mysql_real_escape_string($cond) ."' WHERE contractID = '". $rowcheckcontractid[0] ."' ";
			}
			else{
				$contractID = createidno("CONTRACT", "tblcontact", "ContractID");
				$sqlcontract = " INSERT INTO tblcontract SET ContractID = '". $contractID ."', MallID = '". $rowcheckcontractid[1] ."', InquiryID = '". $_POST['Inquiry_ID'] ."', datefrom = '". date('Y-m-d', strtotime($rowcheckcontractid[2])) ."', dateto = '". date('Y-m-d', strtotime($rowcheckcontractid[3])) ."', unitid = '". $rowcheckcontractid[4] ."', Group_Name = '". mysql_real_escape_string($gname) ."', Term_Name = '". mysql_real_escape_string($tname) ."', Conditions = '".  mysql_real_escape_string($cond) ."', ids  = '". $_POST['contractterms'] ."'";

				$sqlinqupc = " UPDATE tbltrans_inquiry SET contractID = '". $contractID ."' WHERE Inquiry_ID = '". $_POST['Inquiry_ID'] ."' ";
				$resinqupc = mysql_query($sqlinqupc, $connection);
			}
				$rescontract = mysql_query($sqlcontract, $connection);
			$sql = "UPDATE tbltrans_inquiry SET Status = '".$_POST["stat"]."', alerttype_email = '".$_POST["email"]."', alerttype_cus = '".$_POST["customer"]."', datepayment = '".$_POST["datepayment"]."', alertdate = '".$_POST["alertdate"]."', Remarks = '".$_POST["remarks"]."' WHERE Inquiry_ID = '".$_POST["Inquiry_ID"]."' AND Application_ID = '".$_POST["Application_ID"]."'";
			$result = mysql_query($sql, $connection);

			$sql_mall = "SELECT mallid, mallname FROM tblref_mall WHERE mallname = '". $_POST['mallid'] ."'";
			$result_mall = mysql_query($sql_mall, $connection);
			$mall = mysql_fetch_array($result_mall);

			$sql2 = "UPDATE tbltrans_inquiry SET UnitID = '".$_POST["unitid"]."', datefrom = '".$_POST["datefrom"]."', dateto = '".$_POST["dateto"]."', DepartmentID = '".$_POST["dep_id"]."', CategoryID = '".$_POST["cat_id"]."', depamount = '".$_POST["depositpayment"]."', advamount = '".$_POST["advancepayment"]."', dep_month = '".$_POST["monthlydepamt"]."', adv_month = '".$_POST["monthlyadvamt"]."', UnitType = '".$_POST["unittype"]."', ClassID = '".$_POST["classid"]."', LCA_length = '".$_POST["sqm_length"]."', LCA_width = '".$_POST["sqm_width"]."', desired_noofmonths = '".$_POST["monthnum"]."', desired_noofdays = '".$_POST["daynum"]."', date_modified = '".date("Y-m-d H:i:s")."', mod_by = '".$row_user["lastname"].", ".$row_user["firstname"]." ".$row_user["middlename"]."', merchant_code = '".$_POST["merchcode"]."', month_adv = '".$_POST["selectedmonth"]."', payment_terms = '".$_POST["pymentterms"]."', payment_type = '".$_POST["pymenttype"]."', monthly_dues = '". $_POST['totalsqm'] ."', assoc_dues = '". $_POST['assocdues'] ."', cardtype = '". $_POST['cardtype'] ."', cardholder = '". $_POST['cardholder'] ."', authno = '". $_POST['authno'] ."', seccode = '". $_POST['securitycode'] ."', expirydate = '". $_POST['expirydate'] ."', bankfrom = '". $_POST['bankfrom'] ."', bf_accno =  '". $_POST['bf_accno'] ."', bankto = '". $_POST['bankto'] ."', bt_accno = '". $_POST['bt_accno'] ."', owner_card_number = '". $_POST['ccno'] ."' WHERE Inquiry_ID = '".$_POST["Inquiry_ID"]."'";
			$result2 = mysql_query($sql2, $connection);

			$logs = create_logs("updated a reservation form with ".$_POST["Application_ID"]." application ID.", "Reservation Module", $_POST["unitid"]."|".$_POST["datefrom"]."|".$_POST["dateto"]."|".$_POST["dep_id"]."|".$_POST["cat_id"]."|".$_POST["depositpayment"]."|".$_POST["advancepayment"]."|".$_POST["monthlydepamt"]."|".$_POST["monthlyadvamt"]."|".$_POST["unittype"]."|".$_POST["classid"]."|".$_POST["sqm_length"]."|".$_POST["sqm_width"]."|".$_POST["monthnum"]."|".$_POST["daynum"]."|".$_POST["Inquiry_ID"] . "|" . $_POST["merchcode"] , "UPDATE");
			$tran_logs = create_logs_per_transaction("updated a reservation form with ".$_POST["Application_ID"]." application ID.", "Reservation Module", $_POST["unitid"]."|".$_POST["datefrom"]."|".$_POST["dateto"]."|".$_POST["dep_id"]."|".$_POST["cat_id"]."|".$_POST["depositpayment"]."|".$_POST["advancepayment"]."|".$_POST["monthlydepamt"]."|".$_POST["monthlyadvamt"]."|".$_POST["unittype"]."|".$_POST["classid"]."|".$_POST["sqm_length"]."|".$_POST["sqm_width"]."|".$_POST["monthnum"]."|".$_POST["daynum"]."|".$_POST["Inquiry_ID"] . "|" . $_POST["merchcode"] , "UPDATE", $_POST["Inquiry_ID"], $_POST["Application_ID"], $tenantID);

			$updatestatofunitlog = mysql_query("UPDATE tblunit_statuslogs SET xstat = '0', tenantid = '', tenantname = '', status = 'vacant' WHERE xstat = '1'");
			$updatelogs = "UPDATE tbllogs_per_trans SET tenID = '".$tenantID."' WHERE inqID = '".$_POST["Inquiry_ID"]."'";
			$resultudatelogs = mysql_query($updatelogs, $connection);

			if($result == true)
			{
				$sqlselectneeded_inq = "SELECT TradeID, Mall_ID, Trade_Name, Company_ID, Company_Name, UnitID, datefrom, dateto, accof_Reservation, alerttype_cus, alerttype_email, datepayment, amount, alertdate, accof_Reservation, alerttype_cus, alerttype_email, UnitType, ClassID, DepartmentID, CategoryID, contractID, reservationfee FROM tbltrans_inquiry WHERE Inquiry_ID = '".$_POST["Inquiry_ID"]."' AND Application_ID = '".$_POST["Application_ID"]."'";
				$sqlselectneeded_inq_result = mysql_query($sqlselectneeded_inq, $connection);
				$inq = mysql_fetch_array($sqlselectneeded_inq_result);


				if($_POST["stat"] == "Confirmed")
				{
					$logs = create_logs("changed the status of a reservation of ".$inq["Trade_Name"]." to \"Confirmed\".", "Reservation Module", $_POST["Application_ID"]."|".$_POST["Inquiry_ID"], "UPDATE");

					$tran_logs = create_logs_per_transaction("changed the status of a reservation of ".$inq["Trade_Name"]." to \"Confirmed\".", "Reservation Module", $_POST["Application_ID"]."|".$_POST["Inquiry_ID"], "UPDATE", $_POST["Inquiry_ID"], $_POST["Application_ID"], $tenantID);

					$sqlselectneeded_comp = "SELECT owner_firstname, owner_middlename, owner_lastname FROM tbltrans_company WHERE CompanyID = '".$inq["Company_ID"]."'";
					$sqlselectneeded_comp_result = mysql_query($sqlselectneeded_comp, $connection);
					$comp = mysql_fetch_array($sqlselectneeded_comp_result);

					$sqlselectneeded_unit = "SELECT unitname, totalamountunitsetup, typeofbusiness FROM tblref_unit WHERE unitid = '".$inq["UnitID"]."'";
					$sqlselectneeded_unit_result = mysql_query($sqlselectneeded_unit, $connection);
					$unit = mysql_fetch_array($sqlselectneeded_unit_result);

					$date1 = $inq["datefrom"];
					$date2 = $inq["dateto"];

					$ts1 = strtotime($date1);
					$ts2 = strtotime($date2);

					$year1 = date('Y', $ts1);
					$year2 = date('Y', $ts2);

					$month1 = date('m', $ts1);
					$month2 = date('m', $ts2);

					$months = (($year2 - $year1) * 12) + ($month2 - $month1);

					$days = (strtotime($inq["dateto"]) - strtotime($inq["datefrom"])) / (60 * 60 * 24);

					if($unit["typeofbusiness"] == "LCA")
					{
						$months2 = $months;
						$days2 = $days;
					}
					else if($unit["typeofbusiness"] == "SET")
					{
						$months2 = $months;
						$days2 = 0;
					}
						$insert_tenants = "INSERT INTO tbltrans_tenants (TenantID, mallID, owner_lastname, owner_firstname, owner_midname, appID, inqID, tradeID, tradename, CompanyID, companyname, unitID, unitname, datefrom, dateto, datepayment, amount, alertdate, remarks, accof, alerttype_cus, alerttype_email, Status, noofmonths, noofdays,  costpermonths, ustatus, tenanttype, revpercent, merchant_code, ContractID, monthly_dues, assoc_dues, cardtype, cardholder, authno, seccode, expirydate, bankfrom, bf_accno, bankto, bt_accno, owner_card_number, payment_terms, payment_type)VALUES('".$tenantID."' ,'".$inq["Mall_ID"]."' ,'".$comp["owner_lastname"]."' ,'".$comp["owner_firstname"]."' ,'".$comp["owner_middlename"]."' ,'".$_POST["Application_ID"]."' ,'".$_POST["Inquiry_ID"]."' ,'".$inq["TradeID"]."' ,'".$inq["Trade_Name"]."' ,'".$inq["Company_ID"]."' ,'".$inq["Company_Name"]."' ,'".$inq["UnitID"]."' ,'".$unit["unitname"]."' ,'".date("Y/m/d", strtotime($inq["datefrom"]))."' ,'".date("Y/m/d", strtotime($inq["dateto"]))."' ,'".$inq["datepayment"]."' ,'".$inq["amount"]."' ,'".$inq["alertdate"]."' ,'' ,'".$inq["accof_Reservation"]."' ,'".$inq["alerttype_cus"]."' ,'".$inq["alerttype_email"]."' ,'actived' ,'".$months2."','".$days2."' ,'".$unit["totalamountunitsetup"]."', 'incoming', '". $_POST["billtype"] . "', '". $_POST["perc"] . "', '".$_POST["merchcode"]."', '". $inq["contractID"] ."', '". $_POST['totalsqm'] ."', '". $_POST['assocdues'] ."', '". $_POST['cardtype'] ."', '". $_POST['cardholder'] ."', '". $_POST['authno'] ."', '". $_POST['securitycode'] ."', '". $_POST['expirydate'] ."', '". $_POST['bankfrom'] ."', '". $_POST['bf_accno'] ."', '". $_POST['bankto'] ."', '". $_POST['bt_accno'] ."', '". $_POST['ccno'] ."', '".$_POST["pymentterms"]."', '".$_POST["pymenttype"]."')";
						$result_tenants = mysql_query($insert_tenants, $connection);

						$arr = explode("|", $inq[22]);
						for ($a=0; $a <= count($arr)-2; $a++) { 
							$transval = mysql_fetch_array(mysql_query("SELECT amount FROM tbltransaction WHERE id = '". $arr[$a] ."' ", $connection));
							$res = mysql_query("UPDATE tbltransaction SET TenantID = '". $tenantID ."' WHERE id = '". $arr[$a] ."' ", $connection);

						}

						$updatecontract = " UPDATE tblcontract SET TenantID = '". $tenantID ."' WHERE InquiryID = '". $_POST['Inquiry_ID'] ."' ";
						$result_contract = mysql_query($updatecontract, $connection);

						$sqlupdatetenantid = " UPDATE tbltrans_inquiry SET TenantID = '". $tenantID ."' WHERE inquiry_ID = '". $_POST['Inquiry_ID'] ."' ";
						$resupdatetenantid = mysql_query($sqlupdatetenantid, $connection);

						$sqlinsert_accreditation = " INSERT INTO tblaccreditation SET TenantID = '". $TenantID ."', DateofAccreditation = '". date('Y-m-d',strtotime('+15 days')) ."' ";
						$resinsert_accreditation = mysql_query($sqlinsert_accreditation, $connection);

						$refDate2 = $inq["datefrom"];
						for ($x=1; $x<=$days+1; $x++)
						{
							$refDate2 = date( 'Y/m/d', strtotime($refDate2) );
							$selectlogs = "SELECT COUNT(*) FROM tblunit_statuslogs WHERE unitid = '".$inq["UnitID"]."' AND xdate = '".$refDate2."'";
							$resultlogs = mysql_query($selectlogs, $connection);
							$logs = mysql_fetch_array($resultlogs);

							if($logs[0] == 0)
							{

								$insert_logs = "INSERT INTO tblunit_statuslogs (unitid, unitname, tenantid, tenantname, xdate, xtime, status, xstat)VALUES('".$inq["UnitID"]."', '".$unit["unitname"]."', '".$tenantID."', '".$inq["Trade_Name"]."', '".$refDate2."', '".date("h-i-s")."', 'reserved', '0')";
								$result_logs = mysql_query($insert_logs);
							}
							else
							{
								$insert_logs = "UPDATE tblunit_statuslogs SET status = 'reserved', tenantid = '".$_POST["Application_ID"]."', unitid = '".$inq["UnitID"]."', tenantname = '".$inq["Trade_Name"]."', unitname = '".$unit["unitname"]."', xstat = '0' WHERE unitid = '".$inq["UnitID"]."' AND xdate = '".$refDate2."'";
								$result_logs = mysql_query($insert_logs);
							}
							$refDate2 = date( 'Y/m/d', strtotime($refDate2 . '+1 day') );
						}


					if($_POST['pymenttype'] == "Check"){
						$refDate = $inq["datefrom"];
						$chknumposted = explode("#", $_POST["chknum"]);
						$banknameposted = explode("|", $_POST["bankname"]);
						if($unit["typeofbusiness"] == "LCA")
						{

							for ($x=1; $x<=$days; $x++) {
								$chkkk = explode("|", $chknumposted[$x]);

								$refDate = date( 'Y/m/d', strtotime($refDate . '+1 day') );
								$sql_pdc = "INSERT INTO tbltrans_pdc (inquiryid, customerid, lname, fname, pdcdate, amount, checkno, bank, xtype)VALUES('". $_POST["Inquiry_ID"] ."', '". $tenantID ."', '". $comp["owner_lastname"] ."', '". $comp["owner_firstname"] ."', '". $refDate ."', '". $unit[1] ."', '".$chkkk[0]."', '".$banknameposted[$x]."', '".$chkkk[1]."')";
								$result_pdc = mysql_query($sql_pdc, $connection);

							}
						}
						else
						{

							for ($x=1; $x<=$months; $x++) {
								$chkkk = explode("|", $chknumposted[$x]);

								$refDate = date( 'Y/m/d', strtotime($refDate . '+1 month') );
								$sql_pdc = "INSERT INTO tbltrans_pdc (inquiryid, customerid, lname, fname, pdcdate, amount, checkno, bank, xtype)VALUES('". $_POST["Inquiry_ID"] ."', '". $tenantID ."', '". $comp["owner_lastname"] ."', '". $comp["owner_firstname"] ."', '". $refDate ."', '". $unit[1] ."', '".$chkkk[0]."', '".$banknameposted[$x]."', '".$chkkk[1]."')";
								$result_pdc = mysql_query($sql_pdc, $connection);

							}
						}
					}



					if (!file_exists("../csv/".$inq["Mall_ID"]."/" . $tenantID)) {
						mkdir("../csv/".$inq["Mall_ID"]."/" . $tenantID, 0777, true);
					}

				}
				else
				{
					$sqlselectneeded_unit = "SELECT unitname, totalamountunitsetup, typeofbusiness FROM tblref_unit WHERE unitid = '". $_POST["unitid"] ."'";
					$sqlselectneeded_unit_result = mysql_query($sqlselectneeded_unit, $connection);
					$unit = mysql_fetch_array($sqlselectneeded_unit_result);

					$date1 = $inq["datefrom"];
					$date2 = $inq["dateto"];

					$ts1 = strtotime($date1);
					$ts2 = strtotime($date2);

					$year1 = date('Y', $ts1);
					$year2 = date('Y', $ts2);

					$month1 = date('m', $ts1);
					$month2 = date('m', $ts2);

					$months = (($year2 - $year1) * 12) + ($month2 - $month1);


					$days = (strtotime($inq["dateto"]) - strtotime($inq["datefrom"])) / (60 * 60 * 24);

					if($unit["typeofbusiness"] == "LCA")
					{
						$months2 = $months;
						$days2 = $days;
					}
					else if($unit["typeofbusiness"] == "SET")
					{
						$months2 = $months;
						$days2 = 0;
					}


						$refDate2 = $inq["datefrom"];
						for ($x=1; $x<=$days+1; $x++)
						{
							$refDate2 = date( 'Y-m-d', strtotime($refDate2) );
							$selectlogs = "SELECT COUNT(unitid) FROM tblunit_statuslogs WHERE unitid = '".$_POST["unitid"]."' AND xdate = '".$refDate2."'";
							$resultlogs = mysql_query($selectlogs, $connection);
							$logs = mysql_fetch_array($resultlogs);

							if($logs[0] == 0)
							{
								$insert_logs = "INSERT INTO tblunit_statuslogs (unitid, unitname, tenantid, tenantname, xdate, xtime, status, xstat)VALUES('".$_POST["unitid"]."', '".$unit["unitname"]."', '".$_POST["Application_ID"]."', '".$inq["Trade_Name"]."', '".$refDate2."', '".date("h-i-s")."', 'reserved', '0')";
								$result_logs = mysql_query($insert_logs);
							}
							else
							{
								$insert_logs = "UPDATE tblunit_statuslogs SET status = 'reserved', tenantname = '".$inq["Trade_Name"]."', tenantid = '".$_POST["Application_ID"]."', unitid = '".$_POST["unit_id"]."', unitname = '".$unit["unitname"]."', xstat = '0' WHERE unitid = '".$_POST["unit_id"]."' AND xdate = '".$refDate2."'";
								$result_logs = mysql_query($insert_logs);
							}
							$refDate2 = date( 'Y-m-d', strtotime($refDate2 . '+1 day') );
						}
				}
				echo "1|".$tenantID . "|" . $unit["typeofbusiness"] ."|";
			}
		break;

		case 'occupyunitrightnow':

					$sqlselectneeded_inq = "SELECT TradeID, Mall_ID, Trade_Name, Company_ID, Company_Name, UnitID, datefrom, dateto, accof_Reservation, alerttype_cus, alerttype_email, datepayment, amount, alertdate, accof_Reservation, alerttype_cus, alerttype_email, UnitType, ClassID, DepartmentID, CategoryID FROM tbltrans_inquiry WHERE Inquiry_ID = '".$_POST["Inquiry_ID"]."' AND Application_ID = '".$_POST["Application_ID"]."'";
					$sqlselectneeded_inq_result = mysql_query($sqlselectneeded_inq, $connection);
					$inq = mysql_fetch_array($sqlselectneeded_inq_result);

					$selecttenants = "SELECT unitID, TenantID FROM tbltrans_tenants WHERE inqID = '".$_POST["Inquiry_ID"]."'";
					$resselecttenants = mysql_query($selecttenants, $connection);
					$ten = mysql_fetch_array($resselecttenants);

					$insert_tenants = "UPDATE tbltrans_tenants SET Status = 'actived', ustatus = 'occupied' WHERE inqID = '".$_POST["Inquiry_ID"]."'";
					$result_tenants = mysql_query($insert_tenants, $connection);

					$udateinquiryunnit = "UPDATE tbltrans_inquiry SET Status = 'Occupied' WHERE Inquiry_ID = '".$_POST["Inquiry_ID"]."'";
					$udateinquiryunnit_RES = mysql_query($udateinquiryunnit, $connection);

					$sqlselectneeded_comp = "SELECT owner_firstname, owner_middlename, owner_lastname FROM tbltrans_company WHERE CompanyID = '".$inq["Company_ID"]."'";
					$sqlselectneeded_comp_result = mysql_query($sqlselectneeded_comp, $connection);
					$comp = mysql_fetch_array($sqlselectneeded_comp_result);

					$sqlselectneeded_comp = "SELECT owner_firstname, owner_middlename, owner_lastname FROM tbltrans_company WHERE CompanyID = '".$inq["Company_ID"]."'";
					$sqlselectneeded_comp_result = mysql_query($sqlselectneeded_comp, $connection);
					$comp = mysql_fetch_array($sqlselectneeded_comp_result);

					$sqlselectneeded_unit = "SELECT unitname, totalamountunitsetup, typeofbusiness FROM tblref_unit WHERE unitid = '".$ten["unitID"]."'";
					$sqlselectneeded_unit_result = mysql_query($sqlselectneeded_unit, $connection);
					$unit = mysql_fetch_array($sqlselectneeded_unit_result);

					$logs = create_logs("changed status of a reservation to \"Occupied\".", "Reservation Module", $_POST["Inquiry_ID"]."|".$_POST["Application_ID"]."|".$ten["TenantID"] , "UPDATE");

					$tran_logs = create_logs_per_transaction("changed status of a reservation to \"Occupied\".", "Reservation Module", $_POST["Inquiry_ID"]."|".$_POST["Application_ID"]."|".$ten["TenantID"] , "UPDATE", $_POST["Inquiry_ID"], $_POST["Application_ID"], $ten["TenantID"]);

					$date1 = $inq["datefrom"];
					$date2 = $inq["dateto"];

					$ts1 = strtotime($date1);
					$ts2 = strtotime($date2);

					$year1 = date('Y', $ts1);
					$year2 = date('Y', $ts2);

					$month1 = date('m', $ts1);
					$month2 = date('m', $ts2);

					$months = (($year2 - $year1) * 12) + ($month2 - $month1);


					$days = (strtotime($inq["dateto"]) - strtotime($inq["datefrom"])) / (60 * 60 * 24);

					if($unit["typeofbusiness"] == "LCA")
					{
						$months2 = $months;
						$days2 = $days;
					}
					else if($unit["typeofbusiness"] == "SET")
					{
						$months2 = $months;
						$days2 = 0;
					}



					$refDate2 = $inq["datefrom"];
					for ($x=1; $x<=$days+1; $x++)
					{
							$refDate2 = date( 'Y/m/d', strtotime($refDate2) );
							$selectlogs = "SELECT COUNT(*) FROM tblunit_statuslogs WHERE unitid = '".$ten["unitID"]."' AND xdate = '".$refDate2."'";
							$resultlogs = mysql_query($selectlogs, $connection);
							$logs = mysql_fetch_array($resultlogs);

							if($logs[0] == 0)
							{
								$insert_logs = "INSERT INTO tblunit_statuslogs (unitid, unitname, tenantid, tenantname, xdate, xtime, status)VALUES('".$ten["unitID"]."', '".$unit["unitname"]."', '".$tenantID."', '".$inq["Trade_Name"]."', '".$refDate2."', '".date("h-i-s")."', 'occupied')";
								$result_logs = mysql_query($insert_logs);
							}
							else
							{
								$insert_logs = "UPDATE tblunit_statuslogs SET status = 'occupied', tenantid = '".$inq["TradeID"]."', unitid = '".$_POST["unitid"]."', unitname = '".$unit["unitname"]."' WHERE unitid = '".$ten["unitID"]."' AND xdate = '".$refDate2."'";
								$result_logs = mysql_query($insert_logs);
							}
							$refDate2 = date( 'Y/m/d', strtotime($refDate2 . '+1 day') );
						}


					$update_unitstats = "UPDATE tblref_unit SET status = 'occupied', TenantID = '".$inq["TradeID"]."', startDate = '".date("Y-m-d", strtotime($inq["datefrom"]))."', endDate = '".date("Y-m-d", strtotime($inq["dateto"]))."' WHERE unitid = '".$ten["unitID"]."'";
					$res_updateresstat = mysql_query($update_unitstats);



				// echo "1|".$tenantID . "|" . $unit["typeofbusiness"] ."|";
					echo $selecttenants;

		break;

		case 'cancelreservation':
			$sql = "UPDATE tbltrans_inquiry SET Status = 'Cancelled' WHERE Inquiry_ID = '".$_POST["Inquiry_ID"]."' AND Application_ID = '".$_POST["Application_ID"]."'";
			$result = mysql_query($sql, $connection);
			$date1 = $_POST["datefrom"];
			$date2 = $_POST["dateto"];

			$ts1 = strtotime($date1);
			$ts2 = strtotime($date2);

			$year1 = date('Y', $ts1);
			$year2 = date('Y', $ts2);

			$month1 = date('m', $ts1);
			$month2 = date('m', $ts2);

			$months = (($year2 - $year1) * 12) + ($month2 - $month1);


			$days = (strtotime($_POST["dateto"]) - strtotime($_POST["datefrom"])) / (60 * 60 * 24);

			if($unit["typeofbusiness"] == "LCA")
			{
				$months2 = $months;
				$days2 = $days;
			}
			else if($unit["typeofbusiness"] == "SET")
			{
				$months2 = $months;
				$days2 = 0;
			}

			$refDate2 = $_POST["datefrom"];
			for ($x=1; $x<=$days+1; $x++)
			{
				$refDate2 = date( 'Y/m/d', strtotime($refDate2) );
				$insert_logs = "UPDATE tblunit_statuslogs SET status = 'vacant', tenantid = '', tenantname = '' WHERE tenantid = '".$_POST["Application_ID"]."' AND xdate = '".$refDate2."'";
				$result_logs = mysql_query($insert_logs);
				$refDate2 = date( 'Y/m/d', strtotime($refDate2 . '+1 day') );
			}

			if($result == true)
			{

				echo "You successfully cancelled an application.";
			}
		break;

		case 'reinstatereservation':
			$sql = "UPDATE tbltrans_inquiry SET Status = 'Tentative' WHERE Inquiry_ID = '".$_POST["Inquiry_ID"]."' AND Application_ID = '".$_POST["Application_ID"]."'";
			$result = mysql_query($sql, $connection);
			$date1 = $_POST["datefrom"];
			$date2 = $_POST["dateto"];

			$ts1 = strtotime($date1);
			$ts2 = strtotime($date2);

			$year1 = date('Y', $ts1);
			$year2 = date('Y', $ts2);

			$month1 = date('m', $ts1);
			$month2 = date('m', $ts2);

			$months = (($year2 - $year1) * 12) + ($month2 - $month1);

			$days = (strtotime($_POST["dateto"]) - strtotime($_POST["datefrom"])) / (60 * 60 * 24);

			if($unit["typeofbusiness"] == "LCA")
			{
				$months2 = $months;
				$days2 = $days;
			}
			else if($unit["typeofbusiness"] == "SET")
			{
				$months2 = $months;
				$days2 = 0;
			}

			$Trade_Name = mysql_fetch_array(mysql_query("SELECT Trade_Name FROM tbltrans_inquiry WHERE Inquiry_ID = '".$_POST["Inquiry_ID"]."' AND Application_ID = '".$_POST["Application_ID"]."'"));

			$unitinfo = mysql_fetch_array(mysql_query("SELECT classid, depid, catid, typeofbusiness FROM tblref_unit WHERE unitid = '".$_POST["UnitID"]."'"));
			// update depending on unit and date selected
			$update_reservation = mysql_fetch_array(mysql_query("UPDATE tbltrans_inquiry SET UnitID = '".$_POST["UnitID"]."', datefrom = '".$_POST["datefrom"]."', dateto = '".$_POST["dateto"]."', ClassID = '".$unitinfo["classid"]."', DepartmentID = '".$unitinfo["depid"]."', CategoryID = '".$unitinfo["catid"]."', UnitType = '".$unitinfo["typeofbusiness"]."' WHERE Inquiry_ID = '".$_POST["Inquiry_ID"]."' AND Application_ID = '".$_POST["Application_ID"]."'"));
			// update status of unit (logs)
			$refDate2 = $_POST["datefrom"];
			for ($x=1; $x<=$days+1; $x++)
			{
				$refDate2 = date( 'Y/m/d', strtotime($refDate2) );
				$insert_logs = "UPDATE tblunit_statuslogs SET status = 'reserved', TenantID = '".$_POST["Application_ID"]."', tenantname = '".$Trade_Name["Trade_Name"]."' WHERE unitid = '".$_POST["UnitID"]."' AND xdate = '".$refDate2."'";
				$result_logs = mysql_query($insert_logs);
				$refDate2 = date( 'Y/m/d', strtotime($refDate2 . '+1 day') );
			}

			if($result == true)
			{

				echo "You successfully reinstated an application.";
			}
		break;

		case 'loadindustry':
			echo "<option value=''>-- Select Industry --</option>";
			$sql = "SELECT Industry FROM tblref_industry";
			$result = mysql_query($sql, $connection);
			while($row = mysql_fetch_array($result))
			{
				echo "<option value='".$row["Industry"]."'>".$row["Industry"]."</option>";
			}
		break;

		case 'loadcompanyposition':
			echo "<option value=''>-- Select Position --</option>";
			$sql = "SELECT xposition FROM tblref_companyposition";
			$result = mysql_query($sql, $connection);
			while($row = mysql_fetch_array($result))
			{
				echo "<option value='".$row["xposition"]."'>".$row["xposition"]."</option>";
			}
		break;

		case 'tblreflist':
		if($_POST["type"] == "position")
		{
			$sql = "SELECT xposition FROM tblref_companyposition";
			$result = mysql_query($sql, $connection);
			while($row = mysql_fetch_array($result))
			{
				echo "<tr style='width: 100%;display: table;table-layout: fixed;'>
						<td style=''>
							".$row["xposition"]."
						</td>
					  </tr>";

			}
		}
		if($_POST["type"] == "industry")
		{
			$sql = "SELECT Industry FROM tblref_industry";
			$result = mysql_query($sql, $connection);
			while($row = mysql_fetch_array($result))
			{
				echo "<tr style='width: 100%;display: table;table-layout: fixed;'>
						<td style=''>
							".$row["Industry"]."
						</td>
					  </tr>";

			}
		}

		break;

		case 'savenewreferential':
		if($_POST["type"] == "position")
		{
			$sql2 = "SELECT COUNT(*) FROM tblref_companyposition WHERE xposition = '".$_POST["ref"]."'";
			$result2 = mysql_query($sql2, $connection);
			$row2 = mysql_fetch_array($result2);
			if($row2[0] == 0)
			{
				$sql = "INSERT INTO tblref_companyposition(xposition)VALUES('".$_POST["ref"]."')";
				$result = mysql_query($sql, $connection);
				if($result == true)
				{
					echo 1;
				}
			}
			else
			{
				echo 2;
			}

		}
		if($_POST["type"] == "industry")
		{
			$sql2 = "SELECT COUNT(*) FROM tblref_industry WHERE Industry = '".$_POST["ref"]."'";
			$result2 = mysql_query($sql2, $connection);
			$row2 = mysql_fetch_array($result2);
			if($row2[0] == 0)
			{
				$sql = "INSERT INTO tblref_industry(Industry)VALUES('".$_POST["ref"]."')";
				$result = mysql_query($sql, $connection);
				if($result == true)
				{
					echo 1;
				}
			}
			else
			{
				echo 2;
			}
		}

		break;

		//load only
		case 'loadtbodypdc_inquiry':
			$date1 = $_POST["datefrom"];
			$date2 = $_POST["dateto"];

			$ts1 = strtotime($date1);
			$ts2 = strtotime($date2);

			$year1 = date('Y', $ts1);
			$year2 = date('Y', $ts2);

			$month1 = date('m', $ts1);
			$month2 = date('m', $ts2);

			$months = (($year2 - $year1) * 12) + ($month2 - $month1);


			$days = (strtotime($_POST["dateto"]) - strtotime($_POST["datefrom"])) / (60 * 60 * 24);


			$sql_pdc = "SELECT totalamountunitsetup, assocdues, mallid FROM tblref_unit WHERE unitid = '".$_POST["unit_id"]."'";
			$result_pdc = mysql_query($sql_pdc, $connection);
			$row_pdc = mysql_fetch_array($result_pdc);

			if($row_pdc[1] == "1" && $_POST['radassocdues'] == "1"){
                $sqlassocdues = mysql_fetch_array(mysql_query("SELECT associationdues FROM mall_setup WHERE mall_id = '". $row_pdc[2] ."' ", $connection));
                $assocdues = $sqlassocdues[0];
            }else{
                $assocdues = 0;
            }

			$refDate = $_POST["datefrom"];

			if($_POST["type"] == "LCA")
			{
						$refDate2 = $_POST["datefrom"];
						$amount = $_POST["ttlamnt"];
						if($_POST["pymntterms"] == "monthly")
						{
							$f=0;
							for ($x=1; $x<=$months; $x++)
							{
								$f++;
							}
							$pagdayslang = $_POST['ttlamnt'] / $days;

							if($_POST['days'] != "" && $_POST['months'] != ""){
								$amt2 = floatval($_POST['ttlamnt']) + $pagdayslang;
							}else if($_POST['days'] == "" && $_POST['months'] != ""){
								$amt2 = floatval($_POST['ttlamnt']);
							}else{
								$amt2 = $_POST['days'] * $pagdayslang;
							}
							for ($x=1; $x<=$months; $x++)
							{
								$now2 =strtotime(date("Y-m-d", strtotime($_POST["datefrom"]))); // or your date as well
								$your_date2 = strtotime(date("Y-m-d", strtotime($refDate . '+1 month')));
								$datediff2 = ($your_date2-$now2);

								$ttlamnt = floatval($_POST["ttlamnt"]);
								echo '<tr id="'.date("m/d/Y", strtotime($refDate)).'" class="unselected">
	                                  <td class="center" width="10%">
										<label>
										    <input name="form-field-checkbox" class="ace ace-checkbox-2 chk_advpyment" type="checkbox" value="" id="">
										    <span class="lbl"></span>
										</label>
	                                  </td>
	                                  <td>
	                                    '.date("m/d/Y", strtotime($refDate)).'
	                                  </td>
	                                  <td style="text-align: right;">'.number_format($amt2, 2, '.', ',').'</td>
	                                  <td style="text-align: right;">'.number_format($assocdues, 2, '.', ',').'</td>
	                                  <td style="text-align: right;" class="lblamntsetup">'.number_format($assocdues+$ttlamnt, 2, '.', ',').'</td>
	                                  <td style="text-align: right;"><label class="lbladvpyment">0.00</label><input type="text" class="form-control numonly amount txtadvpyment" style="text-align:right;display:none;" placeholder="0.00"></td>
	                                </tr>';

	                              $refDate = date( 'Y/m/d', strtotime($refDate . '+1 month') );
							}
						}
						else if($_POST["pymntterms"] == "1time")
						{
							$amt = 0;
							$pagdayslang = $_POST['ttlamnt'] / $days;
							if($_POST['days'] != "" && $_POST['months'] != ""){
								$amt2 = (floatval($_POST['ttlamnt']) * $months) + $pagdayslang;
							}else if($_POST['days'] == "" && $_POST['months'] != ""){
								$amt2 = floatval($_POST['ttlamnt']) * $months;
							}else{
								$amt2 = $_POST['days'] * $pagdayslang;
							}

							$amt3 = 0;
							if($_POST['days'] != ""){
								$monthsassoc = floatval($months) + 1;
								$amt3 = floatval($assocdues) * $monthsassoc;
							}else{
								$amt3 = floatval($assocdues) * $months;
							}

							for ($x=1; $x<=$days+1; $x++)
							{
								$amt += floatval($amount);
								$refDate = date( 'Y/m/d', strtotime($refDate . '+1 day') );
							}
							$fusion = $amt2+$amt3;

								echo '<tr id="'.date("m/d/Y", strtotime($refDate)).'" class="unselected">
	                            	    <td class="center" width="10%">
	                            	    	<label>
									  	    <input name="form-field-checkbox" class="ace ace-checkbox-2 chk_advpyment" type="checkbox" value="" id="">
									  	    <span class="lbl"></span>
									  	</label>
	                            	    </td>
	                            	    <td>
	                            	      '.date("m/d/Y", strtotime($_POST["datefrom"])).' - '.date("m/d/Y", strtotime($_POST["dateto"])).'
	                            	    </td>
	                            	    <td style="text-align: right;">'.number_format($amt2, 2, '.', ',').'</td>
	                            	    <td style="text-align: right;">'.number_format($amt3, 2, '.', ',').'</td>
		                                <td style="text-align: right;">'.number_format($fusion, 2, '.', ',').'</td>
	                            	    <td style="text-align: right;"><label class="lbladvpyment">0.00</label><input type="text" class="form-control numonly amount txtadvpyment" style="text-align:right;display:none;" placeholder="0.00"></td>
	                            	  </tr>';
						}else if($_POST['pymntterms'] == "daily"){
							if($_POST['days'] != "" && $_POST['months'] != ""){
								$amt2 = (floatval($_POST['ttlamnt']) * $months) + $pagdayslang;
							}else if($_POST['days'] == "" && $_POST['months'] != ""){
								$amt2 = floatval($_POST['ttlamnt']) * $months / $days;
							}else{
								$amt2 = $_POST['days'] * $pagdayslang;
							}
							$aw = $_POST['ttlamnt'] / $days;
							for ($x=1; $x<=$days; $x++) {

							if(date('d', strtotime($refDate)) == date('t', strtotime($refDate))){
								$assocdues = $sqlassocdues[0];
							}else{
								$assocdues = 0;
							}
                            // $mgadate .= "<span class='pdcdate' style='font-size: 14px; color: black;'>". $refDate . "</span><label style='font-size: 14px; color: black;'> - ₱ ".$_POST['inqmonpayment'].".00</label style='font-size: 14px;'><br>";
							$fusion = $assocdues+$amt2;


	                        echo '<tr id="'.date("m/d/Y", strtotime($refDate)).'" class="unselected">
		                                  <td class="center" width="10%">
											<label>
											    <input name="form-field-checkbox" class="ace ace-checkbox-2 chk_advpyment" type="checkbox" value="" id="">
											    <span class="lbl"></span>
											</label>
		                                  </td>
		                                  <td>
		                                    '.date("m/d/Y", strtotime($refDate)).'
		                                  </td>
		                                  <td style="text-align: right;">'.number_format($amt2, 2, '.', ',').'</td>
		                                  <td style="text-align: right;">'.number_format($assocdues, 2, '.', ',').'</td>
		                                  <td style="text-align: right;" class="lblamntsetup">'.number_format($fusion, 2, '.', ',').'</td>
		                                  <td style="text-align: right;"><label class="lbladvpyment">0.00</label><input type="text" class="form-control numonly amount txtadvpyment" style="text-align:right;display:none;" placeholder="0.00"></td>
		                                </tr>';
                            $refDate = date( 'Y/m/d', strtotime($refDate . '+1 day') );
                        	}
						}
			}
			else
			{
						if($_POST["pymntterms"] == "monthly")
						{
							$fusion = $assocdues+$ttlamnt;
							for ($x=1; $x<=$months; $x++)
							{
								$now2 =strtotime(date("Y-m-d", strtotime($_POST["datefrom"]))); // or your date as well
								$your_date2 = strtotime(date("Y-m-d", strtotime($refDate . '+1 month')));
								$datediff2 = ($your_date2-$now2);

								$ttlamnt = floatval($_POST["ttlamnt"]);
								echo '<tr id="'.date("m/d/Y", strtotime($refDate)).'" class="unselected">
	                                  <td class="center" width="10%">
										<label>
										    <input name="form-field-checkbox" class="ace ace-checkbox-2 chk_advpyment" type="checkbox" value="" id="">
										    <span class="lbl"></span>
										</label>
	                                  </td>
	                                  <td>
	                                    '.date("m/d/Y", strtotime($refDate)).'
	                                  </td>
	                                  <td style="text-align: right;">'.number_format($ttlamnt, 2, '.', ',').'</td>
	                                  <td style="text-align: right;">'.number_format($assocdues, 2, '.', ',').'</td>
	                                  <td style="text-align: right;" class="lblamntsetup">'.number_format($assocdues+$ttlamnt, 2, '.', ',').'</td>
	                                  <td style="text-align: right;"><label class="lbladvpyment">0.00</label><input type="text" class="form-control numonly amount txtadvpyment" style="text-align:right;display:none;" placeholder="0.00"></td>
	                                </tr>';

	                              $refDate = date( 'Y/m/d', strtotime($refDate . '+1 month') );
							}
						}
						else if($_POST["pymntterms"] == "1time")
						{
							$amt = 0;
							$amt2 = 0;
							$amt3 = 0;
							$fusion = $assocdues+$row_pdc["totalamountunitsetup"];
							for ($x=1; $x<=$months; $x++)
							{
								$refDate = date( 'Y/m/d', strtotime($refDate . '+1 month') );
								$amt += floatval($row_pdc["totalamountunitsetup"]);
								$amt2 += floatval($assocdues);
								$amt3 += floatval($fusion);
							}
								echo '<tr id="'.date("m/d/Y", strtotime($refDate)).'" class="unselected">
			                            <td class="center" width="10%">
			                            	<label>
											    <input name="form-field-checkbox" class="ace ace-checkbox-2 chk_advpyment" type="checkbox" value="" id="">
											    <span class="lbl"></span>
											</label>
			                            </td>
			                            <td>
			                              '.date("m/d/Y", strtotime($_POST["datefrom"])).' - '.date("m/d/Y", strtotime($refDate)).'
			                            </td>
			                            <td style="text-align: right;" class="lblamntsetup">'.number_format($amt, 2, '.', ',').'</td>
			                            <td style="text-align: right;">'.number_format($amt2, 2, '.', ',').'</td>
		                                <td style="text-align: right;">'.number_format($amt3, 2, '.', ',').'</td>
			                            <td style="text-align: right;"><label class="lbladvpyment">0.00</label><input type="text" class="form-control numonly amount txtadvpyment" style="text-align:right;display:none;" placeholder="0.00"></td>
			                          </tr>';
						}
			}
		break;

		case 'loadtbodypdc_inquiry2':
			$date1 = $_POST["datefrom"];
			$date2 = $_POST["dateto"];

			$ts1 = strtotime($date1);
			$ts2 = strtotime($date2);

			$year1 = date('Y', $ts1);
			$year2 = date('Y', $ts2);

			$month1 = date('m', $ts1);
			$month2 = date('m', $ts2);

			$months = (($year2 - $year1) * 12) + ($month2 - $month1);


			$days = (strtotime($_POST["dateto"]) - strtotime($_POST["datefrom"])) / (60 * 60 * 24);


			$sql_pdc = "SELECT totalamountunitsetup FROM tblref_unit WHERE unitid = '".$_POST["unit_id"]."'";
			$result_pdc = mysql_query($sql_pdc, $connection);
			$row_pdc = mysql_fetch_array($result_pdc);

			$refDate = $_POST["datefrom"];
			$rate = 0;
			if($_POST["type"] == "LCA")
			{
				$perday = $_POST["ttlamnt"] / date('t', strtotime($date2));
				if($_POST['days'] != ""){
					$payable = ($_POST["ttlamnt"] * $months)+($perday*floatval($_POST['days']));
				}
				else{
					$payable = $_POST["ttlamnt"] * $months;
				}
				for ($x=1; $x<=$days; $x++) {
					$refDate = date( 'Y/m/d', strtotime($refDate . '+1 day') );
					$rate = floatval($payable);
				}
			}
			else
			{
				for ($x=1; $x<=$months; $x++) {
					$refDate = date( 'Y/m/d', strtotime($refDate . '+1 month') );
					$rate += floatval($_POST["ttlamnt"]);
				}
			}

			echo number_format($rate, 2, '.', ',') . "|" . $days . "|" . $payable . "|" . number_format($perday, 2, '.', ',');
		break;

		// print
		case 'loadtbodypdc_inquiry3':
			$date1 = $_POST["datefrom"];
			$date2 = $_POST["dateto"];

			$ts1 = strtotime($date1);
			$ts2 = strtotime($date2);

			$year1 = date('Y', $ts1);
			$year2 = date('Y', $ts2);

			$month1 = date('m', $ts1);
			$month2 = date('m', $ts2);

			$months = (($year2 - $year1) * 12) + ($month2 - $month1);


			$days = (strtotime($_POST["dateto"]) - strtotime($_POST["datefrom"])) / (60 * 60 * 24);

			$churva = (string)$_POST["unit_id"] ;
			$sql_pdc2 = "SELECT totalamountunitsetup FROM tblref_unit WHERE unitid = '".$_POST["unit_id"]."'";
			$result_pdc2 = mysql_query($sql_pdc2, $connection);
			$row_pdc2 = mysql_fetch_array($result_pdc2);

			$refDate = $_POST["datefrom"];
			if($_POST["type"] == "LCA")
			{
				$amount = $_POST["ttlamnt"];
				for ($x=1; $x<=$days; $x++) {


					$refDate = date( 'Y/m/d', strtotime($refDate . '+1 day') );

					echo '<tr>
                          <td style="border-right: 1px solid #CCC;border-bottom: 1px solid #CCC;">'.$x.'</td>
                          <td style="border-right: 1px solid #CCC;border-bottom: 1px solid #CCC;">
                            '.date("m/d/Y", strtotime($refDate)).'
                          </td>
                          <td style="text-align: right;border-bottom: 1px solid #CCC;">'.number_format($amount, 2, '.', ',').'</td>
                        </tr>';
				}
			}
			else
			{
				for ($x=1; $x<=$months; $x++) {

					$refDate = date( 'Y/m/d', strtotime($refDate . '+1 month') );
					echo '<tr>
                          <td style="border-right: 1px solid #CCC;border-bottom: 1px solid #CCC;">'.$x.'</td>
                          <td style="border-right: 1px solid #CCC;border-bottom: 1px solid #CCC;">
                            '.date("m/d/Y", strtotime($refDate)).'
                          </td>
                          <td style="text-align: right;border-bottom: 1px solid #CCC;">'.number_format($row_pdc2["totalamountunitsetup"], 2, '.', ',').'</td>
                        </tr>';

				}
			}
		break;
			// July 12 Kevin M
		case 'loadtbodypdc_inquiry4':
			$date1 = $_POST["datefrom"];
			$date2 = $_POST["dateto"];

			$ts1 = strtotime($date1);
			$ts2 = strtotime($date2);

			$year1 = date('Y', $ts1);
			$year2 = date('Y', $ts2);

			$month1 = date('m', $ts1);
			$month2 = date('m', $ts2);

			$months = (($year2 - $year1) * 12) + ($month2 - $month1);

			$days = (strtotime($_POST["dateto"]) - strtotime($_POST["datefrom"])) / (60 * 60 * 24);

			$amount = 0;
			$assocdues = 0;
			$total = 0;

			$pdc = "";
			$bankname = "";
			$sql_3 = "SELECT checkno, bank FROM tbltrans_pdc WHERE inquiryid = '".$_POST["inqid"]."'";
			$result_3 = mysql_query($sql_3, $connection);
			while($row_3 = mysql_fetch_array($result_3))
			{
				$pdc .= $row_3["checkno"] . "#";
				$bankname .= $row_3["bank"] . "#";
			}
			$ccc = explode("#", $pdc);
			$ddd = explode("#", $bankname);

			$sql_pdc = "SELECT totalamountunitsetup, assocdues, mallid FROM tblref_unit WHERE unitid = '".$_POST["unit_id"]."'";
			$result_pdc = mysql_query($sql_pdc, $connection);
			$row_pdc = mysql_fetch_array($result_pdc);

			if($_POST['radassocdues'] == "1"){
				$pagmeron = ", assoc_dues";
			}
            	$resdues = mysql_query("SELECT monthly_dues ".$pagmeron." FROM tbltrans_inquiry WHERE Inquiry_ID = '". $_POST['inqid'] ."' ", $connection);
            $dues = mysql_fetch_array($resdues);
			$amount = $dues[0];
			if($_POST['radassocdues'] == "1"){
	            $assocdues = $dues[1];
			}else{
				$assocdues = 0;
			}
            $total = $amount + $assocdues;

			$refDate = $_POST["datefrom"];
			if($_POST['paymenttype'] == "Check"){
				if($_POST["type"] == "LCA"){
					$refDate2 = $_POST["datefrom"];
					if($_POST["pymntterms"] == "monthly"){
						$f=0;
						for ($x=1; $x<=$months; $x++){
							$f++;
						}

						for ($x=1; $x<=$months; $x++){
							$now2 =strtotime(date("Y-m-d", strtotime($_POST["datefrom"]))); // or your date as well
							$your_date2 = strtotime(date("Y-m-d", strtotime($refDate . '+1 month')));
							$datediff2 = ($your_date2-$now2);

							$ttlamnt = $amount+$assocdues;
							echo '	<tr id="'.date("m/d/Y", strtotime($refDate)).'" class="unselected">
	                              		<td class="center" style="width:5%;">
											<label>
											    <input name="form-field-checkbox" class="ace ace-checkbox-2 chk_advpyment" type="checkbox" value="" id="">
											    <span class="lbl"></span>
											</label>
	                              		</td>
	                              		<td>
		                                 	'.date("m/d/Y", strtotime($refDate)).'
		                              	</td>
	                              		<td style="text-align: right;">'.number_format($amount, 2, '.', ',').'</td>
	                              		<td style="text-align: right;">'.number_format($assocdues, 2, '.', ',').'</td>
	                              		<td style="text-align: right;" class="lblamntsetup">'.number_format($ttlamnt, 2, '.', ',').'</td>
	                              		<td style="text-align: right;"><label class="lbladvpyment">0.00</label><input type="text" class="form-control numonly amount txtadvpyment" style="text-align:right;display:none;" placeholder="0.00"></td>
								  		<td>
									  		<select class="form-control bnk" onchange="chkduplicatedchknum()" disabled>';
												$sql2_bnk = "SELECT description FROM tblrefbank";
												$result2_bnk = mysql_query($sql2_bnk, $connection);
												while($row2_bnk = mysql_fetch_array($result2_bnk)){
													if($row2_bnk["description"] == $ddd[$x-1]){
														echo "<option value='" . $row2_bnk[0] . "' selected>" . $row2_bnk[0] . "</option>";
													}
													else{
														echo "<option value='" . $row2_bnk[0] . "'>" . $row2_bnk[0] . "</option>";
													}
												}
							echo '			</select>
										</td>
			                            <td><input type="text" class="form-control numonly txtchnummmm" onkeyup="chkduplicatedchknum()" disabled></td>
										<td><input type="text" class="form-control" value="'.date("m/d/Y", strtotime($refDate)).'" disabled></td>
			                            </tr>';
	                        $refDate = date( 'Y/m/d', strtotime($refDate . '+1 month') );
						}
					}
					else if($_POST["pymntterms"] == "1time"){
						$amt = 0;
						$perdaymonthly = $total / date('t', strtotime($date2));
							if($_POST['days'] != ""){
								$totalmonthly = ($amount * $months)+($perdaymonthly*floatval($_POST['days']));
							}
							else{
								$totalmonthly = $amount * $months;
							}

						$perdayassoc = $assocdues / date('t', strtotime($date2));
							if($_POST['days'] != ""){
								$months = $months + 1;
								$totalassoc = ($assocdues * $months);
							}
							else{
								$totalassoc = $assocdues * $months;
							}
						$totaltotal = $totalmonthly + $totalassoc;
						for ($x=1; $x<=$days+1; $x++){
							$refDate = date( 'Y/m/d', strtotime($refDate . '+1 day') );
						}
							echo '	<tr id="'.date("m/d/Y", strtotime($refDate)).'" class="unselected">
	                        	    	<td class="center" style="width:5%;">
	                        	    		<label>
								  	    		<input name="form-field-checkbox" class="ace ace-checkbox-2 chk_advpyment" type="checkbox" value="" id="">
								  	    		<span class="lbl"></span>
								  			</label>
		                        	    </td>
		                        	    <td>
		                        	      	'.date("m/d/Y", strtotime($_POST["datefrom"])).' - '.date("m/d/Y", strtotime($_POST["dateto"])).'
		                        	    </td>
		                        	    <td style="text-align: right;">'.number_format($totalmonthly, 2, '.', ',').'</td>
		                        	    <td style="text-align: right;">'.number_format($totalassoc, 2, '.', ',').'</td>
		                        	    <td style="text-align: right;" class="lblamntsetup">'.number_format($totaltotal, 2, '.', ',').'</td>
		                        	    <td style="text-align: right;"><label class="lbladvpyment">0.00</label><input type="text" class="form-control numonly amount txtadvpyment" style="text-align:right;display:none;" placeholder="0.00"></td>
			                        	<td>
										  	<select class="form-control bnk" onchange="chkduplicatedchknum()" disabled>';
												$sql2_bnk = "SELECT description FROM tblrefbank";
												$result2_bnk = mysql_query($sql2_bnk, $connection);
												while($row2_bnk = mysql_fetch_array($result2_bnk)){
													if($row2_bnk["description"] == $ddd[$x-1]){
														echo "<option value='" . $row2_bnk[0] . "' selected>" . $row2_bnk[0] . "</option>";
													}
													else{
														echo "<option value='" . $row2_bnk[0] . "'>" . $row2_bnk[0] . "</option>";
													}
												}
							echo '			</select>
										</td>
										<td>
											<input type="text" class="form-control numonly txtchnummmm" value="'.$ccc[$x-1].'" onkeyup="chkduplicatedchknum()" disabled>
										</td>
										<td><input type="text" class="form-control" value="'.date("m/d/Y", strtotime($refDate)).'" disabled></td>
	                        	  	</tr>';
					}else if($_POST['pymntterms'] == "daily"){
						if($_POST['days'] == ""){
							$aw = $amount / $days;
						}else if($_POST['days'] != ""){
							$perday = $amount / date('t', strtotime($date2));
							$aw = ($amount + $perday) / $days;
						}
						$totaldaily = $aw + $assocduesdaily;
						for ($x=1; $x<=$days; $x++) {
							if(date('d', strtotime($refDate)) == date('t', strtotime($refDate))){
								$assocdues = $dues[1];
							}else{
								$assocdues = 0;
							}
							$totaldaily = $assocdues+$aw;
	                    	$refDate = date( 'Y/m/d', strtotime($refDate . '+1 day') );
	                    	echo '	<tr id="'.date("m/d/Y", strtotime($refDate)).'" class="unselected">
			                            <td class="center" style="width:5%;">
			                            	<label>
											    <input name="form-field-checkbox" class="ace ace-checkbox-2 chk_advpyment" type="checkbox" value="chk_'.date("m/d/Y", strtotime($refDate)).'" id="">
											    <span class="lbl"></span>
											</label>
			                            </td>
		                            	<td>
			                              	'.date("m/d/Y", strtotime($refDate)).'
			                            </td>
			                            <td style="text-align: right;">'.number_format($aw, 2, '.', ',').'</td>
			                            <td style="text-align: right;">'.number_format($assocdues, 2, '.', ',').'</td>
			                            <td style="text-align: right;" class="lblamntsetup">'.number_format($totaldaily, 2, '.', ',').'</td>
			                            <td style="text-align: right;"><label class="lbladvpyment">0.00</label><input type="text" class="form-control numonly amount txtadvpyment" style="text-align:right;display:none;" placeholder="0.00"></td>
			                          	<td>
			                          		<select class="form-control bnk" onchange="chkduplicatedchknum()" disabled>';
												$sql2_bnk = "SELECT description FROM tblrefbank";
												$result2_bnk = mysql_query($sql2_bnk, $connection);
												while($row2_bnk = mysql_fetch_array($result2_bnk)){
													if($row2_bnk["description"] == $ddd[$x-1]){
														echo "<option value='" . $row2_bnk[0] . "' selected>" . $row2_bnk[0] . "</option>";
													}
													else{
														echo "<option value='" . $row2_bnk[0] . "'>" . $row2_bnk[0] . "</option>";
													}
												}
							echo '			</select>
										</td>
										<td>
											<input type="text" class="form-control numonly txtchnummmm" value="'.$ccc[$x-1].'" onkeyup="chkduplicatedchknum()" disabled></td>
										<td>
											'.date("m/d/Y", strtotime($refDate)).'
										</td>
		                          	</tr>';
	                	}
					}
				}
				else{
					if($_POST["pymntterms"] == "monthly"){
						$totalsetmonthly = $row_pdc["totalamountunitsetup"] + $assocdues;
						for ($x=1; $x<=$months; $x++){
							$ttlamnt = $amount+$assocdues;
							echo '	<tr id="'.date("m/d/Y", strtotime($refDate)).'" class="unselected">
		                          		<td class="center" style="width:5%;">
											<label>
											    <input name="form-field-checkbox" class="ace ace-checkbox-2 chk_advpyment" type="checkbox" value="chk_'.$x.'" id="">
											    <span class="lbl"></span>
											</label>
		                          		</td>
		                          		<td>
		                            		'.date("m/d/Y", strtotime($refDate)).'
		                          		</td>
		                          		<td style="text-align: right;">'.number_format($amount, 2, '.', ',').'</td>
	                              		<td style="text-align: right;">'.number_format($assocdues, 2, '.', ',').'</td>
	                              		<td style="text-align: right;" class="lblamntsetup">'.number_format($ttlamnt, 2, '.', ',').'</td>
		                          		<td style="text-align: right;"><label class="lbladvpyment">0.00</label><input type="text" class="form-control numonly amount txtadvpyment" style="text-align:right;display:none;" placeholder="0.00"></td>
			                          	<td>
			                          		<select class="form-control bnk" onchange="chkduplicatedchknum()">';
												$sql2_bnk = "SELECT description FROM tblrefbank";
												$result2_bnk = mysql_query($sql2_bnk, $connection);
												while($row2_bnk = mysql_fetch_array($result2_bnk)){
													if($row2_bnk["description"] == $ddd[$x-1]){
														echo "<option value='" . $row2_bnk[0] . "' selected>" . $row2_bnk[0] . "</option>";
													}
													else{
														echo "<option value='" . $row2_bnk[0] . "'>" . $row2_bnk[0] . "</option>";
													}
												}
							echo '			</select>
										</td>
										<td>
											<input type="text" class="form-control numonly txtchnummmm" value="'.$ccc[$x-1].'" onkeyup="chkduplicatedchknum()"></td>
										<td>
											<input class="form-control kevin-date-picker" id="chk_'.$x.'pdc" type="text" data-date-format="dd-mm-yyyy" value="'.date("m/d/Y", strtotime($refDate)).'" disabled>
										</td>
			                        </tr>';
							$refDate = date( 'Y/m/d', strtotime($refDate . '+1 month') );
						}
					}
					else if($_POST["pymntterms"] == "1time"){
						$amt = 0;
						$perdaymonthly = $total / date('t', strtotime($date2));
							if($_POST['days'] != ""){
								$totalmonthly = ($amount * $months)+($perdaymonthly*floatval($_POST['days']));
							}
							else{
								$totalmonthly = $amount * $months;
							}

						$perdayassoc = $assocdues / date('t', strtotime($date2));
							if($_POST['days'] != ""){
								$months = $months + 1;
								$totalassoc = ($assocdues * $months);
							}
							else{
								$totalassoc = $assocdues * $months;
							}
						$totaltotal = $totalmonthly + $totalassoc;
						for ($x=1; $x<=$months; $x++){
							$refDate = date( 'Y/m/d', strtotime($refDate . '+1 month') );
							$amt += floatval($row_pdc["totalamountunitsetup"]);
						}
							echo '	<tr id="'.date("m/d/Y", strtotime($refDate)).'" class="unselected">
			                            <td class="center" style="width:5%;">
			                            	<label>
											    <input name="form-field-checkbox" class="ace ace-checkbox-2 chk_advpyment" type="checkbox" value="chk_'.date("m/d/Y", strtotime($refDate)).'" id="">
											    <span class="lbl"></span>
											</label>
			                            </td>
			                            <td>
			                              	'.date("m/d/Y", strtotime($_POST["datefrom"])).' - '.date("m/d/Y", strtotime($refDate)).'
			                            </td>
			                            <td style="text-align: right;">'.number_format($totalmonthly, 2, '.', ',').'</td>
		                        	    <td style="text-align: right;">'.number_format($totalassoc, 2, '.', ',').'</td>
		                        	    <td style="text-align: right;" class="lblamntsetup">'.number_format($totaltotal, 2, '.', ',').'</td>
			                            <td style="text-align: right;"><label class="lbladvpyment">0.00</label><input type="text" class="form-control numonly amount txtadvpyment" style="text-align:right;display:none;" placeholder="0.00"></td>
				                         <td>
				                          	<select class="form-control bnk" onchange="chkduplicatedchknum()" disabled>';
											$sql2_bnk = "SELECT description FROM tblrefbank";
											$result2_bnk = mysql_query($sql2_bnk, $connection);
											while($row2_bnk = mysql_fetch_array($result2_bnk)){
												if($row2_bnk["description"] == $ddd[$x-1]){
													echo "<option value='" . $row2_bnk[0] . "' selected>" . $row2_bnk[0] . "</option>";
												}
												else{
													echo "<option value='" . $row2_bnk[0] . "'>" . $row2_bnk[0] . "</option>";
												}

											}
							echo '			</select>
										</td>
										<td>
											<input type="text" class="form-control numonly txtchnummmm" value="'.$ccc[$x-1].'" onkeyup="chkduplicatedchknum()" disabled></td>
										<td>
											'.date("m/d/Y", strtotime($refDate)).'
										</td>
		                          	</tr>';

					}
				}
			}
			else{
				if($_POST["type"] == "LCA")
				{
					$refDate2 = $_POST["datefrom"];
					$amount = $_POST["ttlamnt"];
					if($_POST["pymntterms"] == "monthly")
					{
						$f=0;
						for ($x=1; $x<=$months; $x++)
						{
							$f++;
						}
						$pagdayslang = $_POST['ttlamnt'] / $days;

						if($_POST['days'] != "" && $_POST['months'] != ""){
							$amt2 = floatval($_POST['ttlamnt']) + $pagdayslang;
						}else if($_POST['days'] == "" && $_POST['months'] != ""){
							$amt2 = floatval($_POST['ttlamnt']);
						}else{
							$amt2 = $_POST['days'] * $pagdayslang;
						}
						for ($x=1; $x<=$months; $x++)
						{
							$now2 =strtotime(date("Y-m-d", strtotime($_POST["datefrom"]))); // or your date as well
							$your_date2 = strtotime(date("Y-m-d", strtotime($refDate . '+1 month')));
							$datediff2 = ($your_date2-$now2);

							$ttlamnt = floatval($_POST["ttlamnt"]);
							echo '<tr id="'.date("m/d/Y", strtotime($refDate)).'" class="unselected">
                                  <td class="center" width="10%">
									<label>
									    <input name="form-field-checkbox" class="ace ace-checkbox-2 chk_advpyment" type="checkbox" value="" id="">
									    <span class="lbl"></span>
									</label>
                                  </td>
                                  <td>
                                    '.date("m/d/Y", strtotime($refDate)).'
                                  </td>
                                  <td style="text-align: right;">'.number_format($amt2, 2, '.', ',').'</td>
                                  <td style="text-align: right;">'.number_format($assocdues, 2, '.', ',').'</td>
                                  <td style="text-align: right;" class="lblamntsetup">'.number_format($assocdues+$ttlamnt, 2, '.', ',').'</td>
                                  <td style="text-align: right;"><label class="lbladvpyment">0.00</label><input type="text" class="form-control numonly amount txtadvpyment" style="text-align:right;display:none;" placeholder="0.00"></td>
                                </tr>';

                              $refDate = date( 'Y/m/d', strtotime($refDate . '+1 month') );
						}
					}
					else if($_POST["pymntterms"] == "1time")
					{
						$amt = 0;
						$pagdayslang = $_POST['ttlamnt'] / $days;
						if($_POST['days'] != "" && $_POST['months'] != ""){
							$amt2 = (floatval($_POST['ttlamnt']) * $months) + $pagdayslang;
						}else if($_POST['days'] == "" && $_POST['months'] != ""){
							$amt2 = floatval($_POST['ttlamnt']) * $months;
						}else{
							$amt2 = $_POST['days'] * $pagdayslang;
						}

						$amt3 = 0;
						if($_POST['days'] != ""){
							$monthsassoc = floatval($months) + 1;
							$amt3 = floatval($assocdues) * $monthsassoc;
						}else{
							$amt3 = floatval($assocdues) * $months;
						}

						for ($x=1; $x<=$days+1; $x++)
						{
							$amt += floatval($amount);
							$refDate = date( 'Y/m/d', strtotime($refDate . '+1 day') );
						}
						$fusion = $amt2+$amt3;

							echo '<tr id="'.date("m/d/Y", strtotime($refDate)).'" class="unselected">
                            	    <td class="center" width="10%">
                            	    	<label>
								  	    <input name="form-field-checkbox" class="ace ace-checkbox-2 chk_advpyment" type="checkbox" value="" id="">
								  	    <span class="lbl"></span>
								  	</label>
                            	    </td>
                            	    <td>
                            	      '.date("m/d/Y", strtotime($_POST["datefrom"])).' - '.date("m/d/Y", strtotime($_POST["dateto"])).'
                            	    </td>
                            	    <td style="text-align: right;">'.number_format($amt2, 2, '.', ',').'</td>
                            	    <td style="text-align: right;">'.number_format($amt3, 2, '.', ',').'</td>
	                                <td style="text-align: right;">'.number_format($fusion, 2, '.', ',').'</td>
                            	    <td style="text-align: right;"><label class="lbladvpyment">0.00</label><input type="text" class="form-control numonly amount txtadvpyment" style="text-align:right;display:none;" placeholder="0.00"></td>
                            	  </tr>';
					}else if($_POST['pymntterms'] == "daily"){

						if($_POST['days'] == ""){
							$aw = $amount / $days;
						}else if($_POST['days'] != ""){
							$perday = $amount / date('t', strtotime($date2));
							$aw = ($amount + $perday) / $days;
						}

						for ($x=1; $x<=$days; $x++) {

						if(date('d', strtotime($refDate)) == date('t', strtotime($refDate))){
							$assocdues = $dues[1];
						}else{
							$assocdues = 0;
						}

						$totaldaily = $assocdues+$aw;

                        echo '<tr id="'.date("m/d/Y", strtotime($refDate)).'" class="unselected">
	                                  <td class="center" width="10%">
										<label>
										    <input name="form-field-checkbox" class="ace ace-checkbox-2 chk_advpyment" type="checkbox" value="" id="">
										    <span class="lbl"></span>
										</label>
	                                  </td>
	                                  <td>
	                                    '.date("m/d/Y", strtotime($refDate)).'
	                                  </td>
	                                  <td style="text-align: right;">'.number_format($aw, 2, '.', ',').'</td>
	                                  <td style="text-align: right;">'.number_format($assocdues, 2, '.', ',').'</td>
	                                  <td style="text-align: right;" class="lblamntsetup">'.number_format($totaldaily, 2, '.', ',').'</td>
	                                  <td style="text-align: right;"><label class="lbladvpyment">0.00</label><input type="text" class="form-control numonly amount txtadvpyment" style="text-align:right;display:none;" placeholder="0.00"></td>
	                                </tr>';
                        $refDate = date( 'Y/m/d', strtotime($refDate . '+1 day') );
                    	}
					}
				}
				else
				{
					if($_POST["pymntterms"] == "monthly")
					{
						$fusion = $assocdues+$ttlamnt;
						for ($x=1; $x<=$months; $x++)
						{
							$now2 =strtotime(date("Y-m-d", strtotime($_POST["datefrom"]))); // or your date as well
							$your_date2 = strtotime(date("Y-m-d", strtotime($refDate . '+1 month')));
							$datediff2 = ($your_date2-$now2);

							$ttlamnt = floatval($_POST["ttlamnt"]);
							echo '<tr id="'.date("m/d/Y", strtotime($refDate)).'" class="unselected">
                                  <td class="center" width="10%">
									<label>
									    <input name="form-field-checkbox" class="ace ace-checkbox-2 chk_advpyment" type="checkbox" value="" id="">
									    <span class="lbl"></span>
									</label>
                                  </td>
                                  <td>
                                    '.date("m/d/Y", strtotime($refDate)).'
                                  </td>
                                  <td style="text-align: right;">'.number_format($ttlamnt, 2, '.', ',').'</td>
                                  <td style="text-align: right;">'.number_format($assocdues, 2, '.', ',').'</td>
                                  <td style="text-align: right;" class="lblamntsetup">'.number_format($assocdues+$ttlamnt, 2, '.', ',').'</td>
                                  <td style="text-align: right;"><label class="lbladvpyment">0.00</label><input type="text" class="form-control numonly amount txtadvpyment" style="text-align:right;display:none;" placeholder="0.00"></td>
                                </tr>';

                              $refDate = date( 'Y/m/d', strtotime($refDate . '+1 month') );
						}
					}
					else if($_POST["pymntterms"] == "1time")
					{
						$amt = 0;
						$amt2 = 0;
						$amt3 = 0;
						$fusion = $assocdues+$row_pdc["totalamountunitsetup"];
						for ($x=1; $x<=$months; $x++)
						{
							$refDate = date( 'Y/m/d', strtotime($refDate . '+1 month') );
							$amt += floatval($row_pdc["totalamountunitsetup"]);
							$amt2 += floatval($assocdues);
							$amt3 += floatval($fusion);
						}
							echo '<tr id="'.date("m/d/Y", strtotime($refDate)).'" class="unselected">
		                            <td class="center" width="10%">
		                            	<label>
										    <input name="form-field-checkbox" class="ace ace-checkbox-2 chk_advpyment" type="checkbox" value="" id="">
										    <span class="lbl"></span>
										</label>
		                            </td>
		                            <td>
		                              '.date("m/d/Y", strtotime($_POST["datefrom"])).' - '.date("m/d/Y", strtotime($refDate)).'
		                            </td>
		                            <td style="text-align: right;">'.number_format($amt, 2, '.', ',').'</td>
		                            <td style="text-align: right;">'.number_format($amt2, 2, '.', ',').'</td>
	                                <td style="text-align: right;"  class="lblamntsetup">'.number_format($amt3, 2, '.', ',').'</td>
		                            <td style="text-align: right;"><label class="lbladvpyment">0.00</label><input type="text" class="form-control numonly amount txtadvpyment" style="text-align:right;display:none;" placeholder="0.00"></td>
		                          </tr>';
					}
				}
			}

			$checkreservationfee = mysql_fetch_array(mysql_query("SELECT reservationfee, Application_ID FROM tbltrans_inquiry WHERE inquiry_ID = '". $_POST['inqid'] ."'", $connection));
			echo "|".$checkreservationfee[1] . "|" . $checkreservationfee[0]."|".$_POST['paymenttype'];
		break;

		case 'loadtbodypdc_inquiry5':
					$date1 = $_POST["datefrom"];
					$date2 = $_POST["dateto"];

					$ts1 = strtotime($date1);
					$ts2 = strtotime($date2);

					$year1 = date('Y', $ts1);
					$year2 = date('Y', $ts2);

					$month1 = date('m', $ts1);
					$month2 = date('m', $ts2);

					$months = (($year2 - $year1) * 12) + ($month2 - $month1);


					$days = (strtotime($_POST["dateto"]) - strtotime($_POST["datefrom"])) / (60 * 60 * 24);


					$sql_pdc = "SELECT totalamountunitsetup FROM tblref_unit WHERE unitid = '".$_POST["unit_id"]."'";
					$result_pdc = mysql_query($sql_pdc, $connection);
					$row_pdc = mysql_fetch_array($result_pdc);

					$refDate = $_POST["datefrom"];
					if($_POST["type"] == "LCA")
					{
						$amount = $_POST["ttlamnt"];
						for ($x=1; $x<=$days; $x++) {

							$refDate = date( 'Y/m/d', strtotime($refDate . '+1 day') );

							echo '<tr style="width: 100%;display: table;table-layout: fixed;">
                                  <td class="center" style="width:15%;">'.$x.'</td>
                                  <td>
                                    '.date("m/d/Y", strtotime($refDate)).'
                                  </td>
                                  <td style="text-align: right;">'.number_format($amount, 2, '.', ',').'</td>
                                  <td><input type="text" class="form-control numonly required_inq" onkeyup="chkduplicatedchknum()"></td>
                                  <td><select class="form-control bnk" onchange="chkduplicatedchknum()"  onchange="chkduplicatedchknum()">';

									$sql2_bnk = "SELECT description FROM tblrefbank";
									$result2_bnk = mysql_query($sql2_bnk, $connection);
									while($row2_bnk = mysql_fetch_array($result2_bnk))
									{
										if($row2_bnk["description"] == $ddd[$x-1])
										{
											echo "
											<option value='" . $row2_bnk[0] . "' selected>" . $row2_bnk[0] . "</option>
										";
										}
										else
										{
											echo "
											<option value='" . $row2_bnk[0] . "'>" . $row2_bnk[0] . "</option>
										";
										}

									}
								echo '</select></td>
                                </tr>';
						}
					}
					else
					{
						for ($x=1; $x<=$months; $x++) {

							$refDate = date( 'Y/m/d', strtotime($refDate . '+1 month') );
							echo '<tr style="width: 100%;display: table;table-layout: fixed;">
                                  <td class="center" style="width:15%;">'.$x.'</td>
                                  <td>
                                    '.date("m/d/Y", strtotime($refDate)).'
                                  </td>
                                  <td style="text-align: right;">'.number_format($row_pdc["totalamountunitsetup"], 2, '.', ',').'</td>
                                  <td><input type="text" class="form-control numonly required_inq" onkeyup="chkduplicatedchknum()"></td>
                                  <td><select class="form-control bnk" onchange="chkduplicatedchknum()" onchange="chkduplicatedchknum()">';

									$sql2_bnk = "SELECT description FROM tblrefbank";
									$result2_bnk = mysql_query($sql2_bnk, $connection);
									while($row2_bnk = mysql_fetch_array($result2_bnk))
									{
										if($row2_bnk["description"] == $ddd[$x-1])
										{
											echo "
											<option value='" . $row2_bnk[0] . "' selected>" . $row2_bnk[0] . "</option>
										";
										}
										else
										{
											echo "
											<option value='" . $row2_bnk[0] . "'>" . $row2_bnk[0] . "</option>
										";
										}

									}
								echo '</select></td>
                                </tr>';

						}
					}
					// echo $_POST["unit_id"];
		break;

		case 'loaddatefunction4':
			$sql_pdc = "SELECT totalamountunitsetup FROM tblref_unit WHERE unitid = '".$_POST["unit_id"]."' ";
			$result_pdc = mysql_query($sql_pdc, $connection);
			$row_pdc = mysql_fetch_array($result_pdc);

			$advance = floatval($row_pdc["totalamountunitsetup"]) * floatval($_POST["advance"]);
			$deposit = floatval($row_pdc["totalamountunitsetup"]) * floatval($_POST["deposit"]);

			echo number_format($advance, 2, '.', ',') . "|" . number_format($deposit, 2, '.', ',') . "|" . $sql_pdc;
		break;

		case 'loadcityref':
			$queryflr = "SELECT DISTINCT(citymunDesc) FROM tblref_citymun WHERE citymunDesc LIKE '%".$_POST["city"]."%' LIMIT 0,20";
            $result_flr = mysql_query($queryflr, $connection);
			while($row = mysql_fetch_array($result_flr)){
				$flr = "<option value='".$row["citymunDesc"]."' ";
				$flr .= ">".$row["citymunDesc"]."</option>";

				echo $flr;
			}
			// echo $queryflr;
		break;

		case 'loadfilters_inquiry':
			$sql = "SELECT checked_value, otherfilter, bystat, xcheck FROM tblref_filters WHERE module = '".$_POST["module"]."'";
			$result = mysql_query($sql, $connection);
			$row = mysql_fetch_array($result);

			echo $row["checked_value"] . "#" . $row["otherfilter"] . "#" . $row["bystat"] . "#" . $row["xcheck"];
			// echo $sql;
		break;

		case 'savefilter':
			$sql = "SELECT checked_value FROM tblref_filters WHERE module = '".$_POST["module"]."'";
			$result = mysql_query($sql, $connection);
			$num = mysql_num_rows($result);
			$row = mysql_fetch_array($result);

			if($num == 0)
			{
				$sql_insert = "INSERT INTO tblref_filters (module, checked_value, filters, otherfilter, bystat, xcheck)VALUES('".$_POST["module"]."', '".$_POST["checked"]."', '".$_POST["checked2"]."', '".$_POST["occstrt"]."|".$_POST["occend"]."|".$_POST["appstart"]."|".$_POST["append"]."', '".$_POST["checked3"]."', '".$_POST["datefilter"]."')";
				$result_insert = mysql_query($sql_insert, $connection);
				if($result_insert == true)
				{
					echo 1;
				}
			}
			else
			{
				$sql_update= "UPDATE tblref_filters SET checked_value = '".$_POST["checked"]."', otherfilter = '".$_POST["occstrt"]."|".$_POST["occend"]."|".$_POST["appstart"]."|".$_POST["append"]."', bystat = '".$_POST["checked3"]."', xcheck = '".$_POST["datefilter"]."' WHERE module = '".$_POST["module"]."'";
				$result_update = mysql_query($sql_update, $connection);
				if($result_update == true)
				{
					echo 1;
				}
			}
		break;

		case 'savefilter2':

				$sql_update= "UPDATE tblref_filters SET otherfilter = '".$_POST["occstrt"]."|".$_POST["occend"]."|".$_POST["appstart"]."|".$_POST["append"]."' WHERE module = '".$_POST["module"]."'";
				$result_update = mysql_query($sql_update, $connection);
				if($result_update == true)
				{
					echo 1;
				}
		break;
		case 'updateinquiry':
				$sql = "UPDATE tbltrans_inquiry SET Mall = '".$_POST["mallname"]."', Mall_ID = '".$_POST["mallid"]."', Trade_Name = '".$_POST["tradename"]."', Company_Name = '".$_POST["companyname"]."', Industry = '".$_POST["industryname"]."', Address = '".$_POST["address"]."', Company_ID = '".$_POST["companyid"]."', TradeID = '".$_POST["tradeid"]."', UnitID = '".$_POST["unitid"]."', datefrom = '".$_POST["datefrom"]."', dateto = '".$_POST["dateto"]."', DepartmentID = '".$_POST["dep_id"]."', CategoryID = '".$_POST["cat_id"]."', depamount = '".$_POST["depositpayment"]."', advamount = '".$_POST["advancepayment"]."', dep_month = '".$_POST["monthlydepamt"]."', adv_month = '".$_POST["monthlyadvamt"]."' WHERE Inquiry_ID = '".$_POST["Inquiry_ID"]."' AND Application_ID = '".$_POST["Application_ID"]."'";
				$result = mysql_query($sql, $connection);
				if($result == true)
				{
					echo 1;
				}
		break;

// JONAS

        case 'loadnotifications':
        	$i = 0;
			$select = "SELECT Status, datefrom FROM tbltrans_inquiry WHERE Status = 'Confirmed'";
			$result = mysql_query($select, $connection);
			while($row = mysql_fetch_array($result))
			{
				if($row["Status"] == "Confirmed" && (date("m/d/Y", strtotime($row["datefrom"])) < date("m/d/Y") || date("m/d/Y", strtotime($row["datefrom"])) == date("m/d/Y")))
				{
					$i++;
				}
			}

			if($i == 0)
			{
				$stat = "No reservation for occupancy today.";
				$icon = "<i class='ace-icon fa fa-bell-o orange bigger-130'></i>";
			}
			else
			{
				$stat = $i ." reservation(s) are for occupancy today!";
				$icon = "<i class='ace-icon fa fa-bell orange bigger-130'></i>";
			}

			echo $stat . "|" . $icon . "|";
        break;

		case 'displaytnc':
		$sql = " SELECT Group_ID, Group_Name, Term_Name, Description, Stats, Term_ID FROM tblcondition where Stats = 1 ";
		$res = mysql_query($sql, $connection);
			while($row = mysql_fetch_array($res)) {
					?>
						<tr id="tr<?php echo $row[5]; ?>">
								<td style="display: none;" width="3%"><input type="checkbox" id="<?php echo $row[0]; ?>" class="checkbox <?php echo $row[5]; ?>" value='<?php echo $row[5]; ?>' disabled></td>
								<td width="15%"><?php echo $row[1]; ?></td>
								<td width="20%"><?php echo $row[2]; ?></td>
								<td width="35%"><?php echo substr($row[3], 0, 100)."..."; ?></td>
								<td width="10%"><?php
										if($row[4] == 1) {
											echo "Active";
										}
										else {
											echo "Inactive";
										}
									?>
								</td>
						</tr>
					<?php
			}
		break;

		case 'selectfilterdisplay':
			echo " <option value=''>All</option> ";
			$sql = "SELECT Group_ID, Group_Name FROM tblgroups";
            $result = mysql_query($sql, $connection);
            while ( $row = mysql_fetch_array($result)) {
                echo"
                <option value='". $row[0] ."'>".$row[1]."</option>
                ";
            }
        break;

        case 'selectfilter':
       	 	if ( $_POST['id'] != "" ) {
       	 		$sql = " SELECT Group_ID, Group_Name, Term_Name, Description, Stats, Term_ID FROM tblcondition WHERE Group_ID = '". $_POST['id'] ."' ORDER BY Stats = 1 ";
       	 	}

       	 	else {
       	 		$sql = " SELECT Group_ID, Group_Name, Term_Name, Description, Stats, Term_ID FROM tblcondition where Stats = 1 ";
       	 	}

        	$res = mysql_query($sql, $connection);
        	while( $row = mysql_fetch_array($res)) {
        		?>
						<tr id="tr<?php echo $row[5]; ?>">
								<td style="display: none;" width="3%"><input type="checkbox" id="<?php echo $row[0]; ?>" class="checkbox <?php echo $row[5]; ?>" value='<?php echo $row[5]; ?>'></td>
								<td width="15%"><?php echo $row[1]; ?></td>
								<td width="20%"><?php echo $row[2]; ?></td>
								<td width="35%"><?php echo substr($row[3], 0, 100)."..."; ?></td>
								<td width="10%"><?php
										if($row[4] == 1) {
											echo "Active";
										}
										else {
											echo "Inactive";
										}
									?>
								</td>
						</tr>
					<?php
        	}
        break;

       case 'addselectedtnc':
            $arr = explode("|", $_POST['nakacheck']);

            for($a = 0;$a <= count($arr)-2;$a++){
                $sql = " SELECT Term_ID, Group_Name, Term_Name, Description FROM tblcondition WHERE Term_ID = '". $arr[$a] ."' ";
                $res = mysql_query($sql, $connection);
                $row = mysql_fetch_array($res);
                ?>
                    <tr>
                        <td width="15%"><?php echo $row[2]; ?></td>
                        <td><?php echo $row[3]; ?></td>
                    </tr>
                <?php
            }
       	break;

       	case 'displayselected':
       		$contractid = mysql_fetch_array(mysql_query("SELECT ContractID FROM tbltrans_inquiry WHERE inquiry_ID = '". $_POST['invi'] ."' ", $connection));
       		$row = mysql_fetch_array(mysql_query("SELECT Term_Name, Conditions, ids FROM tblcontract WHERE ContractID = '". $contractid[0] ."' ", $connection));

       		$arr = explode("|", $row[0]);
       		$arr2 = explode("|", $row[1]);
       		for($a = 0;$a <= count($arr)-2;$a++){
	   			?>
	   				<tr>
	   					<td width="15%"><?php echo $arr[$a]; ?></td>
	   					<td><?php echo $arr2[$a]; ?></td>
	   				</tr>
	   			<?php
	   		}
	   		echo "#".$row[2];
       	break;


		case 'printcontract':
			$sql = "SELECT TenantID, CONCAT(owner_firstname, ' ', owner_lastname) as owner, CompanyID, tradename, companyname, costpermonths, unitname, noofmonths, mallid from tbltrans_tenants where inqID = '".$_POST["Inquiry_ID"]."'";
			$result = mysql_query($sql, $connection);
			$row = mysql_fetch_array($result);

			$sql2 = " SELECT Address from tbltrans_inquiry WHERE TenantID = '". $row[0] ."' ";
       		$res2 = mysql_query($sql2, $connection);
       		$row2 = mysql_fetch_array($res2);

       		$sql3 = " SELECT CompanyID, content FROM tbltrans_company_contacts WHERE CompanyID = '". $row[2] ."' ";
       		$res3 = mysql_query($sql3, $connection);
       		$row3 = mysql_fetch_array($res3);

       		$sql5 = "SELECT conditions from tblcontract WHERE TenantID = '". $row[0] ."' OR inquiryid = '". $_POST['Inquiry_ID'] ."' ";
       		$res5 = mysql_query($sql5, $connection);
       		$row5 = mysql_fetch_array($res5);

	       		$arr = explode("|", $row5[0]);
		       	$tables = "";
	       		for($a = 0;$a <= count($arr);$a++){
			   		$sql6 = " SELECT Term_ID, Term_Name, Description FROM tblcondition WHERE Term_ID = '". $arr[$a] ."' ";
			   		$res6 = mysql_query($sql6, $connection);
			   		$row6 = mysql_fetch_array($res6);

			   		$tables .= "
   					   			<tr>7
   					   				<td valign='top'>".$row6[1]."</td>
   					   				<td valign='center' style='text-align: justify;'>".$row6[2]."</td>
   					   			</tr>";

			   	}

			$sql7 = "SELECT CompanyID, industry, permanent_address, billing_address FROM tbltrans_company where CompanyID = '". $_POST['CompanyID'] ."' ";
			$res7 = mysql_query($sql7, $connection);
			$row7 = mysql_fetch_array($res7);

			$sql8 = " SELECT content FROM tbltrans_company_owner_contacts where CompanyID  = '". $row[2] ."' ";
			$res8 = mysql_query($sql8, $connection);
			$row8 = mysql_fetch_array($res8);

			$sql9 = " SELECT malladdress FROM tblref_mall WHERE mallid = '". $row[8] ."' ";
       		$res9 = mysql_query($sql9, $connection);
       		$row9 = mysql_fetch_array($res9);

			echo $row[3] . "|" . $row[4] . "|" . $row[1] . "|" . $row[0] . "|" .  $tables . "|" . $row9[0] . "|" . $row[3] . "|" . $row2[0] . "|" . $row[4] . "|" . $row[5] . "|" . $row[6] . "|" .  $row[7] . "|" . $row8[0];
		break;



		case 'updatetenantcode':
       		$sql = " UPDATE tbltrans_inquiry SET TenantID = '". $_POST['tenantcode'] ."' WHERE inquiry_ID = '". $_POST['invi'] ."' ";
       		$res = mysql_query($sql, $connection);
       		if($res == true){
       			echo 1;
       		}
       	break;

       	case 'searchChecked':
       		$sql = "SELECT ids from tblcontract WHERE inquiryID = '". $_POST['id'] ."' ";
       		$res = mysql_query($sql, $connection);
       		$row = mysql_fetch_array($res);

       		echo $row[0];
       	break;

       	case 'loaduserlist':
       		$sql = "SELECT userid, firstname, middlename, lastname, email, gender, username, usertype, password, password2, passwordstr, dateadded, img FROM tbluser";
       		$res = mysql_query($sql, $connection);
       		while($row = mysql_fetch_array($res))
       		{
                    echo"<div class='table-detail'>
                            <div class='row'>
                                <div class='col-xs-12 col-sm-2'>
                                    <div class='text-center'>
                                    	";
                                    	if($row["img"] == "")
                                    	{
                                    		echo "<img height='80' width='100' class='thumbnail inline no-margin-bottom' alt='Greenbelt' src='assets/images/avatars/noimage.png'>";
                                    	}
                                    	else
                                    	{
                                    		echo "<img height='80' width='100' class='thumbnail inline no-margin-bottom' alt='Greenbelt' src='server/user/".$row["userid"]."/".$row["img"]."'>";
                                    	}

                                    	echo"

                                        <br><br>
                                        <div class='width-80 label label-info label-md'>
                                            <div class='inline position-relative'>
                                                <a class='user-title-label' href='#'>
                                                    <!-- <i class='ace-icon fa fa-circle light-green'></i> -->
                                                    &nbsp;
                                                    <span class='white'>".$row["userid"]."</span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class='col-xs-12 col-sm-8'>
                                    <div class='space visible-xs'></div>

                                    <div class='profile-user-info profile-user-info-striped'>
                                        <div class='profile-info-row'>
                                            <div class='profile-info-name'> User Name </div>

                                            <div class='profile-info-value'>
                                                <span>".$row["lastname"].", ".$row["firstname"]." ".$row["middlename"]."</span>
                                            </div>
                                        </div>

                                        <div class='profile-info-row'>
                                            <div class='profile-info-name'> Email </div>

                                            <div class='profile-info-value'>
                                                <span>".$row["email"]."</span>
                                            </div>
                                        </div>

                                        <div class='profile-info-row'>
                                            <div class='profile-info-name'> Username </div>

                                            <div class='profile-info-value'>
                                                ".$row["username"]."
                                            </div>
                                        </div>

                                        <div class='profile-info-row'>
                                            <div class='profile-info-name'> Password </div>

                                            <div class='profile-info-value'>
                                                **********
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class='col-xs-12 col-sm-2'>
                                    <button class='btn btn-light btn-sm' style='width: 100%; margin-bottom: 5px;' onclick='edituser(\"".$row["userid"]."\")'>

                                        <span class='bigger-110 no-text-shadow'>Edit Informations</span>
                                    </button>

                                    <button class='btn btn-light btn-sm' style='width: 100%; margin-bottom: 5px;' onclick='deleteuser(\"".$row["userid"]."\")'>

                                        <span class='bigger-110 no-text-shadow'>Delete User</span>
                                    </button>
                                </div>
                            </div>
                        </div>";
       		}
       	break;

       	case 'edituser':
       		$sql = "SELECT userid, firstname, middlename, lastname, email, gender, username, usertype, password, password2, passwordstr, dateadded, img, groupaccess FROM tbluser WHERE userid = '".$_POST["userid"]."'";
       		$res = mysql_query($sql, $connection);
			$row = mysql_fetch_array($res);

			echo $row["userid"] . "|" . $row["firstname"] . "|" . $row["middlename"] . "|" . $row["lastname"] . "|" . $row["email"] . "|" . $row["username"] . "|" . $row["password"] . "|" . $row["password2"] . "|" . $row["passwordstr"] . "|" . $row["dateadded"] . "|" . $row["img"] . "|" . $row["groupaccess"] . "|";
       	break;

       	case 'saveuserinfo':
		$pass = md5($_POST["pass"]);
		if($_POST["id"] == "")
		{
			$userid = createidno("USER", "tbluser", "userid");
			$sql = "INSERT INTO tbluser (userid, firstname, middlename, lastname, email, username, password, password2, passwordstr, dateadded, groupaccess) VALUES ('". $userid ."', '".$_POST["fname"]."', '".$_POST["mname"]."', '".$_POST["lname"]."', '".$_POST["eaddress"]."', '".$_POST["username"]."', '".$_POST["pass"]."', '".$pass."', '".$_POST["pass"]."', '".date("d-m-Y")."', '".$_POST["access"]."')";
    		$res = mysql_query($sql, $connection);
    		if($res == true)
    		{
    			echo "2|".$userid."|";
    		}
		}
		else
		{
			$sql = "UPDATE tbluser SET firstname = '".$_POST["fname"]."', middlename = '".$_POST["mname"]."', lastname = '".$_POST["lname"]."', email = '".$_POST["eaddress"]."', username = '".$_POST["username"]."', password = '".$_POST["pass"]."', password2 = '".$pass."', passwordstr = '".$_POST["pass"]."', groupaccess = '".$_POST["access"]."' WHERE userid = '".$_POST["id"]."'";
    		$res = mysql_query($sql, $connection);
    		if($res == true)
    		{
    			echo "1|".$_POST["id"]."|";
    		}
		}
       	break;

       	case 'group_access_list':
       		$sql = "SELECT groupID, groupName, Inquiry_new, Inquiry_update, App_new, App_update, App_forapproval, App_approve, Res_update, Res_confirm FROM tblref_groupaccess";
       		$result = mysql_query($sql, $connection);
       		while($row = mysql_fetch_array($result))
       		{
       			echo "<tr><td onclick='viewpermission(\"".$row["groupID"]."\", \"".$row["groupName"]."\")' style='padding:5px;font-weight:bold;'><i class='ace-icon fa fa-caret-right green'></i>&nbsp;&nbsp;&nbsp;".$row["groupName"]."</td></tr>";
       		}
        break;

        case 'viewpermission':
        	$sql = "SELECT Inquiry_new, Inquiry_update, App_new, App_update, App_forapproval, App_approve, Res_update, Res_confirm FROM tblref_groupaccess WHERE groupID = '".$_POST["id"]."'";
       		$res = mysql_query($sql, $connection);
			$row = mysql_fetch_array($res);

			echo $row["Inquiry_new"] . "|" . $row["Inquiry_update"] . "|" . $row["App_new"] . "|" . $row["App_update"] . "|" . $row["App_forapproval"] . "|" . $row["App_approve"] . "|" . $row["Res_update"] . "|" . $row["Res_confirm"] . "|";
        break;

        case 'savepermission':
        $chk = explode("|", $_POST["permission"]);
        $sql = "UPDATE tblref_groupaccess SET Inquiry_new = '".$chk[0]."', Inquiry_update = '".$chk[1]."', App_new = '".$chk[2]."', App_update = '".$chk[3]."', App_forapproval = '".$chk[4]."', App_approve = '".$chk[5]."', Res_update = '".$chk[6]."', Res_confirm = '".$chk[7]."' WHERE groupID = '".$_POST["id"]."'";
       	$result = mysql_query($sql, $connection);
       	if($result == true)
       	{
       		echo 1;
       	}
        break;

        case 'loadgaccess':
        	echo "<option value=''>-- Select Group Access --</option>";
        	$sql = "SELECT groupID, groupName FROM tblref_groupaccess";
       		$res = mysql_query($sql, $connection);
			while($row = mysql_fetch_array($res)){
				echo "<option value='".$row["groupID"]."'>".$row["groupName"]."</option>";
			}
        break;

        case 'savenewgroupname':
        	$sql = "INSERT INTO tblref_groupaccess (groupName)VALUES('".$_POST["grp"]."')";
       		$res = mysql_query($sql, $connection);
        break;

        case 'load_editstorename':
        	$sql = "SELECT tradename, companyID, filename FROM tbltrans_tradename WHERE tradeID = '".$_POST["id"]."'";
       		$result = mysql_query($sql, $connection);
       		$row = mysql_fetch_array($result);

       		$select_companyname = "SELECT Company, industry, businessAddress FROM tbltrans_company WHERE CompanyID = '".$row["companyID"]."'";
       		$result_company = mysql_query($select_companyname, $connection);
       		$company = mysql_fetch_array($result_company);

       		if($row["filename"] == "")
			{
				$img = "assets/images/avatars/noimage.png";
			}
			else
			{
				$img = "server/company/" . $row["companyID"] . "/trades/" . $_POST["id"] . "/" . $row["filename"];
			}

       		echo $company["Company"] . "|" . $row["companyID"] . "|" . $row["tradename"] . "|" . $img . "|" . $company["industry"] . "|" . $company["businessAddress"] . "|";
        break;

        case 'load_updatecompany':
        	$sql = "SELECT Company, industry, businessAddress, owner_firstname, owner_middlename, owner_lastname, permanent_address, current_address, billing_address, filename, CompanyID FROM tbltrans_company WHERE CompanyID = '".$_POST["id"]."'";
       		$result = mysql_query($sql, $connection);
       		$row = mysql_fetch_array($result);

       		if($row["filename"] == "")
			{
				$img = "assets/images/avatars/noimage.png";
			}
			else
			{
				$img = "server/company/".$_POST["id"]."/profile/".$row["filename"];
			}

       		echo $row["Company"] . "|" . $row["industry"] . "|" . $row["businessAddress"] . "|" . $row["owner_firstname"] . "|" . $row["owner_middlename"] . "|" . $row["owner_lastname"] . "|" . $row["permanent_address"] . "|" . $row["current_address"] . "|" . $row["billing_address"] . "|" . $img . "|";
        break;

        case 'load_updatecompany_ownertelno':
        	$num = 0;
        	$sql = "SELECT content FROM tbltrans_company_owner_contacts WHERE CompanyID = '".$_POST["id"]."'";
       		$result = mysql_query($sql, $connection);
       		$numrows = mysql_num_rows($result);
       		while($row = mysql_fetch_array($result))
       		{
       			$num++;
       			if($num == $numrows)
       			{
       				echo "<div class='input-group' style='width:100%;'><input type='text' id='add_tel_no_owner' class='spinbox-input form-control input-mask-tele' placeholder='(99)-999-9999' value='".$row["content"]."'><div class='spinbox-buttons input-group-btn'><button type='button' class='btn spinbox-up btn-sm btn-success' onclick='div_add_field(\"add_tel_no_owner\",\"input-mask-tele\")'><i class='icon-only  ace-icon ace-icon fa fa-plus bigger-110'></i></button></div></div>";
       			}
       			else
       			{
	       			echo "<input type='text' id='add_tel_no_owner' class='spinbox-input form-control input-mask-tele' value='".$row["content"]."' style='margin-bottom:5px;' placeholder='(99)-999-9999'>";
       			}

       		}
        break;

        case 'load_updatecompany_companycontacts':

        	$sql_add = 0;
        	$sql = "SELECT CompanyID, type, content FROM tbltrans_company_contacts WHERE CompanyID = '".$_POST["id"]."' AND type = 'mobile'";
			$result = mysql_query($sql, $connection);
			$result_num = mysql_num_rows($result);
			while($row = mysql_fetch_array($result))
			{
				$sql_add++;
				if($sql_add == $result_num)
				{
					echo "<div class='input-group' style='width:100%;'><input type='text' id='company_contact_mobile' class='spinbox-input form-control input-mask-phone' placeholder='(999)-999-9999' value='".$row["content"]."'><div class='spinbox-buttons input-group-btn'><button type='button' class='btn spinbox-up btn-sm btn-success' onclick='div_add_field(\"company_contact_mobile\",\"input-mask-phone\")'><i class='icon-only  ace-icon ace-icon fa fa-plus bigger-110'></i></button></div></div>";
				}
				else
				{
					echo "<input type='text' id='company_contact_mobile' class='spinbox-input form-control input-mask-phone' value='".$row["content"]."' style='margin-bottom:5px;' placeholder='(999)-999-9999'>";
				}


			}

			$sql2_add = 0;
			echo "#|";
			$sql2 = "SELECT CompanyID, type, content FROM tbltrans_company_contacts WHERE CompanyID = '".$_POST["id"]."' AND type = 'telephone'";
			$result2 = mysql_query($sql2, $connection);
			$result2_num = mysql_num_rows($result2);
			while($row2 = mysql_fetch_array($result2))
			{
				$sql2_add++;
				if($sql2_add == $result2_num)
				{
					echo "<div class='input-group' style='width:100%;'><input type='text' id='company_contact_tele' class='spinbox-input form-control input-mask-tele' placeholder='(99)-999-9999' value='".$row2["content"]."'><div class='spinbox-buttons input-group-btn'><button type='button' class='btn spinbox-up btn-sm btn-success' onclick='div_add_field(\"company_contact_tele\",\"input-mask-tele\")'><i class='icon-only  ace-icon ace-icon fa fa-plus bigger-110'></i></button></div></div>";
				}
				else
				{
					echo "<input type='text' id='company_contact_tele' class='spinbox-input form-control input-mask-tele' value='".$row2["content"]."' style='margin-bottom:5px;' placeholder='(99)-999-9999'>";
				}

			}
			echo "#|";
			$sql3_add = 0;
			$sql3 = "SELECT CompanyID, type, content FROM tbltrans_company_contacts WHERE CompanyID = '".$_POST["id"]."' AND type = 'fax'";
			$result3 = mysql_query($sql3, $connection);
			$result3_num = mysql_num_rows($result3);
			while($row3 = mysql_fetch_array($result3))
			{
				$sql3_add++;
				if($sql3_add == $result3_num)
				{
					echo "<div class='input-group' style='width:100%;'><input type='text' id='company_contact_fax' class='spinbox-input form-control input-mask-tele' placeholder='(99)-999-9999' value='".$row3["content"]."'><div class='spinbox-buttons input-group-btn'><button type='button' class='btn spinbox-up btn-sm btn-success' onclick='div_add_field(\"company_contact_fax\",\"input-mask-tele\")'><i class='icon-only  ace-icon ace-icon fa fa-plus bigger-110'></i></button></div></div>";
				}
				else
				{
					echo "<input type='text' id='company_contact_fax' class='spinbox-input form-control input-mask-tele' value='".$row3["content"]."' style='margin-bottom:5px;' placeholder='(99)-999-9999'>";
				}

			}
			echo "#|";
			$sql4_add = 0;
			$sql4 = "SELECT CompanyID, type, content FROM tbltrans_company_contacts WHERE CompanyID = '".$_POST["id"]."' AND type = 'email'";
			$result4 = mysql_query($sql4, $connection);
			$result4_num = mysql_num_rows($result4);
			while($row4 = mysql_fetch_array($result4))
			{
				$sql4_add++;
				if($sql4_add == $result4_num)
				{
					echo "<div class='input-group' style='width:100%;'><input type='text' id='company_contact_email' class='spinbox-input form-control emailaddress' placeholder='sample@yahoo.com' value='".$row4["content"]."'><div class='spinbox-buttons input-group-btn'><button type='button' class='btn spinbox-up btn-sm btn-success' onclick='div_add_field(\"company_contact_email\",\"emailaddress\")'><i class='icon-only  ace-icon ace-icon fa fa-plus bigger-110'></i></button></div></div>";
				}
				else
				{
					echo "<input type='text' id='company_contact_email' class='spinbox-input form-control emailaddress' value='".$row4["content"]."' style='margin-bottom:5px;' placeholder='sample@yahoo.com'>";
				}
			}
			echo "#|";
			$sql5_add = 0;
			$sql5 = "SELECT CompanyID, type, content FROM tbltrans_company_contacts WHERE CompanyID = '".$_POST["id"]."' AND type = 'website'";
			$result5 = mysql_query($sql5, $connection);
			$result5_num = mysql_num_rows($result5);
			while($row5 = mysql_fetch_array($result5))
			{
				$sql5_add++;
				if($sql5_add == $result5_num)
				{
					echo "<div class='input-group' style='width:100%;'><input type='text' id='company_contact_website' class='spinbox-input form-control website' placeholder='www.sample.com' value='".$row5["content"]."'><div class='spinbox-buttons input-group-btn'><button type='button' class='btn spinbox-up btn-sm btn-success' onclick='div_add_field(\"company_contact_website\",\"website\")'><i class='icon-only  ace-icon ace-icon fa fa-plus bigger-110'></i></button></div></div>";
				}
				else
				{
					echo "<input type='text' id='company_contact_website' class='spinbox-input form-control website' value='".$row5["content"]."' style='margin-bottom:5px;' placeholder='www.sample.com'>";
				}
			}
			echo "#|";
        break;

        case 'load_updatecompany_contactpersons':
        	$sql = "SELECT ConID, Confname, Conmname, Conlname, custID, name, designation, address, filename FROM tbltrans_company_contact_person WHERE ConID = '".$_POST["id"]."'";
			$result = mysql_query($sql, $connection);
			while($row = mysql_fetch_array($result))
			{
				if($row["filename"] == "")
				{
					$image = "assets/images/avatars/noimage.png";
				}
				else
				{
					$image = "server/company/".$_POST["id"]."/contact_person/".$row["custID"]."/".$row["filename"];
				}

				echo "<div class='alert alert-info div_inquiry_wells' id='contact_".$row["custID"]."'><div class='tools tools-left in'><a href='#' title='Edit Photo' class='btnedit' style='float:right;margin-bottom:8px;margin-top:8px;' onclick='editthiscontactperson(\"".$row["custID"]."\", \"".$row["ConID"]."\")'><i class='ace-icon fa fa-pencil'></i></a><a href='#' title='Remove Photo' class='btndelete' style='float:right;margin-right:5px;margin-bottom:8px;margin-top:8px;' onclick='removethiscontactperson(\"".$row["custID"]."\")'><i class='ace-icon fa fa-times red'></i></a></div><center><div class='image'><img class='img-thumbnail imageName form-control' src='".$image."' style='border: 2px solid #bdc3c7; margin-bottom: 8px;height: 160px;width:90%;'></div></center><label style='font-size: 14px; font-weight: bold;margin: 0px !important;' class='contact_person_firstname'>".$row["Confname"]." ".$row["Conmname"]." ".$row["Conlname"]."</label><p style='font-size: 14px; font-weight: normal;margin: 0px !important;' class='contact_person_designation'>".$row["designation"]."</p><p style='font-size: 10px; font-weight: normal;margin: 0px !important;' class='address_person'>".$row["address"]."</p>";

				$sql2 = "SELECT content FROM tbltrans_company_contact_person_contacts WHERE ConID = '".$row["custID"]."'";
				$result2 = mysql_query($sql2, $connection);
				while($row2 = mysql_fetch_array($result2))
				{
					echo"<p style='font-size: 10px; font-weight: normal;margin: 0px !important;'>".$row2["content"]."</p>";
				}

				echo "</div>";

			}
        break;

        case 'savetradename_update':
			$sql = "UPDATE tbltrans_tradename SET tradename = '".$_POST["tradename"]."', companyID = '".$_POST["companyid"]."' WHERE tradeID = '".$_POST["id"]."'";
			$result = mysql_query($sql, $connection);
			$row = mysql_fetch_array($result);

			if($result == true)
			{
				echo "1|". $_POST["companyid"] ."|". $_POST["id"];
			}
        break;

        case 'savenewmall_update':
			$sql = "UPDATE tbltrans_company SET Company = '".$_POST["name"]."', industry = '".$_POST["industry"]."', businessAddress = '".$_POST["busadd"]."', owner_firstname = '".$_POST["fname"]."', owner_middlename = '".$_POST["mname"]."', owner_lastname = '".$_POST["lname"]."', permanent_address = '".$_POST["perm_add"]."', current_address = '".$_POST["curr_add"]."', billing_address = '".$_POST["bill_add"]."', remarks = '' WHERE CompanyID = '".$_POST["id"]."'";
			$result = mysql_query($sql, $connection);

			$deleteall = "DELETE FROM tbltrans_company_owner_contacts WHERE CompanyID = '".$_POST["id"]."'";
			$resal = mysql_query($deleteall, $connection);

			$deleteall2 = "DELETE FROM tbltrans_company_contacts WHERE CompanyID = '".$_POST["id"]."'";
			$resal2 = mysql_query($deleteall2, $connection);

			$ownertel = explode("|", $_POST["owner_tel_no"]);
			for($i=0; $i<=count($ownertel)-2; $i++)
			{
				$owner_telno = "INSERT INTO tbltrans_company_owner_contacts(CompanyID, type, content) VALUES('".$_POST["id"]."', 'telephone', '".$ownertel[$i]."')";
				$result_owner_telno = mysql_query($owner_telno, $connection);
			}

			$contact_mobile = explode("|", $_POST["contact_mobile"]);
			for($j=0; $j<=count($contact_mobile)-2; $j++)
			{
				$contact_mobile_query = "INSERT INTO tbltrans_company_contacts(CompanyID, type, content) VALUES('".$_POST["id"]."', 'mobile', '".$contact_mobile[$j]."')";
				$contact_mobile_result = mysql_query($contact_mobile_query, $connection);
			}

			$contact_tele = explode("|", $_POST["contact_tele"]);
			for($k=0; $k<=count($contact_tele)-2; $k++)
			{
				$contact_tele_query = "INSERT INTO tbltrans_company_contacts(CompanyID, type, content) VALUES('".$_POST["id"]."', 'telephone', '".$contact_tele[$k]."')";
				$contact_tele_result = mysql_query($contact_tele_query, $connection);
			}

			$contact_fax = explode("|", $_POST["contact_fax"]);
			for($l=0; $l<=count($contact_fax)-2; $l++)
			{
				$contact_fax_query = "INSERT INTO tbltrans_company_contacts(CompanyID, type, content) VALUES('".$_POST["id"]."', 'fax', '".$contact_fax[$l]."')";
				$contact_fax_result = mysql_query($contact_fax_query, $connection);
			}

			$contact_email = explode("|", $_POST["contact_email"]);
			for($m=0; $m<=count($contact_email)-2; $m++)
			{
				$contact_email_query = "INSERT INTO tbltrans_company_contacts(CompanyID, type, content) VALUES('".$_POST["id"]."', 'email', '".$contact_email[$m]."')";
				$contact_email_result = mysql_query($contact_email_query, $connection);
			}

			$contact_website = explode("|", $_POST["contact_website"]);
			for($n=0; $n<=count($contact_website)-2; $n++)
			{
				$contact_website_query = "INSERT INTO tbltrans_company_contacts(CompanyID, type, content) VALUES('".$_POST["id"]."', 'website', '".$contact_website[$n]."')";
				$contact_website_result = mysql_query($contact_website_query, $connection);
			}

			if($result == true)
			{
				echo $_POST["id"]."|1|Successfully Modified";
			}
        break;

        case 'chkunitfrst':
        	$refDate = $_POST["datefrom"];
        	$refDate2 = $_POST["datefrom"];
        	$datefrst = "";

			$date1 = $_POST["datefrom"];
			$date2 = $_POST["dateto"];

			$ts1 = strtotime($date1);
			$ts2 = strtotime($date2);

			$year1 = date('Y', $ts1);
			$year2 = date('Y', $ts2);

			$month1 = date('m', $ts1);
			$month2 = date('m', $ts2);

			$days = (strtotime($_POST["dateto"]) - strtotime($_POST["datefrom"])) / (60 * 60 * 24);
			$months = (($year2 - $year1) * 12) + ($month2 - $month1);

			for ($x=1; $x<=$days+1; $x++)
			{
				$refDate = date( 'Y/m/d', strtotime($refDate) );
				$refDate2 = date( 'Y/m/d', strtotime($refDate2) );
				$select = "SELECT COUNT(unitid) FROM tblunit_statuslogs WHERE unitid = '".$_POST["unit"]."' AND xdate = '".date("Y-m-d", strtotime($refDate))."' AND (status = 'occupied' OR status = 'reserved')";
				$result_sel = mysql_query($select, $connection);
				$fetcc = mysql_fetch_array($result_sel);

				if($fetcc[0] >= 1)
				{
					// echo $select . "#|";
					if($datefrst == "")
					{
						$datefrst = $refDate2;
					}
					$refDate2 = date( 'm/d/Y', strtotime($refDate2 . '+1 day') );
				}
				// echo $fetcc[0] . "|";

				$refDate = date( 'm/d/Y', strtotime($refDate . '+1 day') );
			}

			if($datefrst != "")
			{
				echo "The unit you selected is already occupied/reserved from " . $datefrst ." to ". $refDate2 . ", either change your unit or your date to proceed.";
			}
			// echo $refDate2;
   //      	$sql = "SELECT startDate, endDate FROM tblref_unit where unitid = '".$_POST["unit"]."'";
   //     		$res = mysql_query($sql, $connection);
			// while($row = mysql_fetch_array($res)){

			// }
        break;

        case 'chkunitfrst2':
        	$refDate = $_POST["datefrom"];
        	$refDate2 = $_POST["datefrom"];
        	$datefrst = "";

			$date1 = $_POST["datefrom"];
			$date2 = $_POST["dateto"];

			$ts1 = strtotime($date1);
			$ts2 = strtotime($date2);

			$year1 = date('Y', $ts1);
			$year2 = date('Y', $ts2);

			$month1 = date('m', $ts1);
			$month2 = date('m', $ts2);

			$days = (strtotime($_POST["dateto"]) - strtotime($_POST["datefrom"])) / (60 * 60 * 24);
			$months = (($year2 - $year1) * 12) + ($month2 - $month1);

			for ($x=1; $x<=$days+1; $x++)
			{
				$refDate = date( 'Y/m/d', strtotime($refDate) );
				$refDate2 = date( 'Y/m/d', strtotime($refDate2) );
				$select = "SELECT COUNT(unitid) FROM tblunit_statuslogs WHERE unitid = '".$_POST["unit"]."' AND xdate = '".date("Y-m-d", strtotime($refDate))."' AND (status = 'occupied' OR status = 'reserved') AND tenantid != '".$_POST["appid"]."'";
				$result_sel = mysql_query($select, $connection);
				$fetcc = mysql_fetch_array($result_sel);

				if($fetcc[0] >= 1)
				{
					// echo $select . "#|";
					if($datefrst == "")
					{
						$datefrst = $refDate2;
					}
					$refDate2 = date( 'm/d/Y', strtotime($refDate2 . '+1 day') );
				}
				// echo $fetcc[0] . "|";

				$refDate = date( 'm/d/Y', strtotime($refDate . '+1 day') );
			}
			if($datefrst != "")
			{
				echo "The unit you selected is already occupied/reserved from " . $datefrst ." to ". $refDate2 . ", either change your unit or your date to proceed.";
			}
			// echo $refDate2;
   //      	$sql = "SELECT startDate, endDate FROM tblref_unit where unitid = '".$_POST["unit"]."'";
   //     		$res = mysql_query($sql, $connection);
			// while($row = mysql_fetch_array($res)){

			// }
        break;

        case 'selectunit_history':
        	$sql = "SELECT unitid, unitname, buildingname, typeofbusiness, classificationname, sqmunitsetup, pricepersqmunitsetup, totalamountunitsetup, dateadded, mallid, bldgnumber, floorid, wingid, classid, depid, catid, TenantID, TenantName, startDate, endDate, sqm_width, sqm_height, floorunit FROM tblref_unit WHERE unitid = '".$_POST["id"]."'";
        	$result = mysql_query($sql, $connection);
        	$row = mysql_fetch_array($result);

        	$sql2 = "SELECT mallid, mallname, malladdress FROM tblref_mall WHERE mallid = '".$row["mallid"]."'";
			$result2 = mysql_query($sql2);
			$row2 = mysql_fetch_array($result2);

        	$sql3 = "SELECT classification FROM tblref_merchandise_class WHERE classificationID = '".$row["classid"]."'";
			$result3 = mysql_query($sql3);
			$row3 = mysql_fetch_array($result3);

			$sql4 = "SELECT department FROM tblref_merchandise_depa WHERE departmentID = '".$row["depid"]."'";
			$result4 = mysql_query($sql4);
			$row4 = mysql_fetch_array($result4);

			$sql5 = "SELECT category FROM tblref_merchandisedep_cat WHERE categoryID = '".$row["catid"]."'";
			$result5 = mysql_query($sql5);
			$row5 = mysql_fetch_array($result5);

			$sql6 = "SELECT floor FROM tblref_floorsetup WHERE floorid = '".$row["floorid"]."'";
			$result6 = mysql_query($sql6);
			$row6 = mysql_fetch_array($result6);

			$sql7 = "SELECT wing FROM tblref_wing WHERE wingID = '".$row["wingid"]."'";
			$result7 = mysql_query($sql7);
			$row7 = mysql_fetch_array($result7);

        	echo $row2["mallname"] . "|" . $row["unitid"] ."|". $row["unitname"] ."|". $row["buildingname"] ."|". $row["typeofbusiness"] ."|". $row["classificationname"] ."|". $row["sqmunitsetup"] ."|". $row["pricepersqmunitsetup"] ."|". $row["totalamountunitsetup"] ."|". $row["dateadded"] ."|". $row["mallid"] ."|". $row["bldgnumber"] ."|". $row6["floor"] ."|". $row7["wing"] ."|". $row3["classification"] ."|". $row4["department"] ."|". $row5["category"] ."|". $row["TenantID"] ."|". $row["TenantName"] ."|". $row["startDate"] ."|". $row["endDate"] ."|". $row["sqm_width"] ."|". $row["sqm_height"] ."|". $row["floorunit"];
        break;

        case 'loadtbl_selectunit_history':
        	$dates = explode(" - ", $_POST["date_filter"]);
        	$sql = "SELECT TenantID, tradename, companyname, datefrom, dateto, status FROM tbltrans_tenants WHERE unitID = '".$_POST["id"]."' AND (datefrom BETWEEN '".date("d-m-Y", strtotime($dates[0]))."' AND '".date("d-m-Y", strtotime($dates[1]))."') ";
        	$result = mysql_query($sql, $connection);
        	while($row = mysql_fetch_array($result))
        	{

        		if($row[5] == "actived"){
                    $stat = "<span class='fa fa-flag' style='font-weight: 700; color: #DFE21A;'></span>";
                }else if($row[5] == "inactive"){
                    $stat = "<span class='fa fa-flag' style='font-weight: 700; color: DarkGray;'></span>";
                }else if($row[5] == "forrenewal"){
                    $stat = "<span class='fa fa-flag' style='font-weight: 700; color: #428BCA;'></span>";
                }else if($row[5] == "foreviction"){
                    $stat = "<span class='fa fa-flag' style='font-weight: 700; color: red;'></span>";
                }
                else if($row[5] == "evicted"){
                    $stat = "<span class='fa fa-flag' style='font-weight: 700; color: grey;'></span>";
                }

        		echo "
				<tr style='width: 100%;display: table;table-layout: fixed;'>
				<td class='hide_mobile' width='5%'><center>" . $stat . "</center></th>
				<td class='hide_mobile'>" . $row["TenantID"] . "</th>
				<td class='scroll'>" . $row["tradename"] . "</th>
				<td class='scroll'>" . $row["companyname"] . "</th>
				<td class='hide_mobile'>" . $row["datefrom"] . "</th>
				<td class='hide_mobile'>" . $row["dateto"] . "</th>
				</tr>";
        	}
        break;

        case 'loadallmalls_SET':
	        $flridd = "";
	        $wingidd = "";
	        $unitt = "";
	        $srchtype = "";
        	if($_POST["mall"] == "" && $_POST["key"] != "")
        	{
        		$sqlunittt = "SELECT mallid, floorid, wingid FROM tblref_unit WHERE unitname LIKE '%".$_POST["key"]."%'";
				$sqlunitttresult = mysql_query($sqlunittt, $connection);
				$unittt = mysql_fetch_array($sqlunitttresult);

				$mall = "WHERE mallID = '" . $unittt["mallid"] ."'";
				$flridd .= "WHERE floorid = '".$unittt["floorid"]."' ORDER BY floor ASC";
				$wingidd .= "WHERE wingID = '" . $unittt["wingid"] ."'";
				$unitt .= "WHERE unitname LIKE '%" . $_POST["key"] . "%' AND floorid = '".$unittt["floorid"]."' ORDER BY unitname ASC";

				$srchtype .= "unit_only";
        	}
        	else
        	{
				if($_POST["mall"] == "")
				{
					$mall = "";
				}
				else
				{
					$mall = "WHERE mallID = '" . $_POST["mall"] ."'";
				}
				$srchtype .= "unit_with_other_info";
        	}

        	if($srchtype == "unit_with_other_info")
        	{
        		$sqlunittt2 = "SELECT mallid, floorid, wingid FROM tblref_unit WHERE mallid = '".$_POST["mall"]."' AND floorid = '".$_POST["floor"]."' AND wingid = '".$_POST["wing"]."' AND unitname LIKE '%".$_POST["key"]."%'";
				$sqlunittt2result = mysql_query($sqlunittt2, $connection);
				$unittt_cnt = mysql_num_rows($sqlunittt2result);

				if($unittt_cnt == 0)
				{
					if($_POST["mall"] == "" && $_POST["floor"] == "" && $_POST["wing"] == "" && $_POST["key"] == "")
					{
			        	$sql_mall = "SELECT mallid, mallname FROM tblref_mall " . $mall;
			       		$res_mall = mysql_query($sql_mall, $connection);
						// echo $sql_mall;
						while($row_mall = mysql_fetch_array($res_mall)){
							echo "<li class='list_mall'><i class='fa fa-building' style='color: #666633;'></i>&nbsp;&nbsp;".$row_mall["mallname"];
										if($_POST["mall"] == "" && $_POST["key"] != "")
		        						{
		        							$wing = $wingidd;
		        						}
		        						else
		        						{
											if($_POST["wing"] == "")
											{
												$wing = "WHERE mallID = '".$row_mall["mallid"]."'";
											}
											else
											{
												$wing = "WHERE wingID = '" . $_POST["wing"] ."'";
											}
		        						}


											$sql_wing = "SELECT wingID, wing FROM tblref_wing " . $wing;
											$sql_wing_res = mysql_query($sql_wing, $connection);
											// echo $sql_wing;
											while($wing = mysql_fetch_array($sql_wing_res))
											{
												echo "<ul>";
													echo "<li class='list_mall clickme'><i class='fa fa-folder-open' style='color: #ffcc66;'></i>&nbsp;&nbsp;".$wing["wing"];
															if($_POST["mall"] == "" && $_POST["key"] != "")
		        											{
		        												$floor = $flridd;
		        											}
		        											else
		        											{
																if($_POST["floor"] == "")
																{
																	$floor = "WHERE wingid = '".$wing["wingID"]."'";
																}
																else
																{
																	$floor = "WHERE floorid = '" . $_POST["floor"] . "'";
																}
		        											}

																$sql_floor = "SELECT floorid, floor FROM tblref_floorsetup " . $floor;
																$sql_floor_res = mysql_query($sql_floor, $connection);
																// echo $sql_floor;
																while($floor = mysql_fetch_array($sql_floor_res))
																{


																			echo "<ul>";
																					echo "<li class='list_mall clickme'><i class='fa fa-folder-open' style='color: #ffcc66;'></i>&nbsp;&nbsp;". $floor["floor"];
																					if($_POST["mall"] == "" && $_POST["key"] != "")
		        																	{
		        																		$key = $unitt;
		        																	}
		        																	else
		        																	{
																						if($_POST["key"] == "")
			    																		{
			    																			$key = "WHERE floorid = '".$floor["floorid"]."' ORDER BY unitname ASC";
			    																		}
			    																		else
			    																		{
			    																			$key = "WHERE unitname LIKE '%" . $_POST["key"] . "%' AND floorid = '".$floor["floorid"]."' ORDER BY unitname ASC";
			    																		}
		        																	}

																							$sql_unit = "SELECT unitid, unitname FROM tblref_unit ". $key;
																							$sql_unit_res = mysql_query($sql_unit, $connection);
																							// echo $sql_unit;
																							$cntunit = mysql_num_rows($sql_unit_res);
																							if($cntunit != 0)
																							{
																								echo "<ul>";
																							}
																							while($unit = mysql_fetch_array($sql_unit_res))
																							{
																										echo"<li class='unit' onclick='selectunit(\"".$unit["unitid"]."\")'>".$unit["unitname"]."</li>";
																							}
																							if($cntunit != 0)
																							{
																								echo "</ul>";
																							}

																					echo "</li>";
																			echo "</ul>";

																}
													echo "</li>";
												echo "</ul>";
											}
							echo "</li>";
						}
					}
					else
					{
						echo "<div style='opacity: 0.3;'><center><label style='font-size:30px;margin-top:10%;'>No data found</label><img src='assets/images/folder.png' style='margin-top:5%;'></center></div>";
					}
				}
				else
				{
		        	$sql_mall = "SELECT mallid, mallname FROM tblref_mall " . $mall;
		       		$res_mall = mysql_query($sql_mall, $connection);
					// echo $sql_mall;
					while($row_mall = mysql_fetch_array($res_mall)){
						echo "<li class='list_mall'><i class='fa fa-building' style='color: #666633;'></i>&nbsp;&nbsp;".$row_mall["mallname"];
									if($_POST["mall"] == "" && $_POST["key"] != "")
	        						{
	        							$wing = $wingidd;
	        						}
	        						else
	        						{
										if($_POST["wing"] == "")
										{
											$wing = "WHERE mallID = '".$row_mall["mallid"]."'";
										}
										else
										{
											$wing = "WHERE wingID = '" . $_POST["wing"] ."'";
										}
	        						}


										$sql_wing = "SELECT wingID, wing FROM tblref_wing " . $wing;
										$sql_wing_res = mysql_query($sql_wing, $connection);
										// echo $sql_wing;
										while($wing = mysql_fetch_array($sql_wing_res))
										{
											echo "<ul>";
												echo "<li class='list_mall clickme'><i class='fa fa-folder-open' style='color: #ffcc66;'></i>&nbsp;&nbsp;".$wing["wing"];
														if($_POST["mall"] == "" && $_POST["key"] != "")
	        											{
	        												$floor = $flridd;
	        											}
	        											else
	        											{
															if($_POST["floor"] == "")
															{
																$floor = "WHERE wingid = '".$wing["wingID"]."'";
															}
															else
															{
																$floor = "WHERE floorid = '" . $_POST["floor"] . "'";
															}
	        											}

															$sql_floor = "SELECT floorid, floor FROM tblref_floorsetup " . $floor;
															$sql_floor_res = mysql_query($sql_floor, $connection);
															// echo $sql_floor;
															while($floor = mysql_fetch_array($sql_floor_res))
															{


																		echo "<ul>";
																				echo "<li class='list_mall clickme'><i class='fa fa-folder-open' style='color: #ffcc66;'></i>&nbsp;&nbsp;". $floor["floor"];
																				if($_POST["mall"] == "" && $_POST["key"] != "")
	        																	{
	        																		$key = $unitt;
	        																	}
	        																	else
	        																	{
																					if($_POST["key"] == "")
		    																		{
		    																			$key = "WHERE floorid = '".$floor["floorid"]."' ORDER BY unitname ASC";
		    																		}
		    																		else
		    																		{
		    																			$key = "WHERE unitname LIKE '%" . $_POST["key"] . "%' AND floorid = '".$floor["floorid"]."' ORDER BY unitname ASC";
		    																		}
	        																	}

																						$sql_unit = "SELECT unitid, unitname FROM tblref_unit ". $key;
																						$sql_unit_res = mysql_query($sql_unit, $connection);
																						// echo $sql_unit;
																						$cntunit = mysql_num_rows($sql_unit_res);
																						if($cntunit != 0)
																						{
																							echo "<ul>";
																						}
																						while($unit = mysql_fetch_array($sql_unit_res))
																						{
																									echo"<li class='unit' onclick='selectunit(\"".$unit["unitid"]."\")'>".$unit["unitname"]."</li>";
																						}
																						if($cntunit != 0)
																						{
																							echo "</ul>";
																						}

																				echo "</li>";
																		echo "</ul>";

															}
												echo "</li>";
											echo "</ul>";
										}
						echo "</li>";
					}
				}
        	}
        	else if($srchtype == "unit_only")
        	{
        		$sqlunittt2 = "SELECT mallid, floorid, wingid FROM tblref_unit WHERE unitname LIKE '%".$_POST["key"]."%'";
				$sqlunittt2result = mysql_query($sqlunittt2, $connection);
				$unittt_cnt = mysql_num_rows($sqlunittt2result);

				if($unittt_cnt == 0)
				{
					echo "<div style='opacity: 0.3;'><center><label style='font-size:30px;margin-top:10%;'>No data found</label><img src='assets/images/folder.png' style='margin-top:5%;'></center></div>";
				}
				else
				{
		        	$sql_mall = "SELECT mallid, mallname FROM tblref_mall " . $mall;
		       		$res_mall = mysql_query($sql_mall, $connection);
					// echo $sql_mall;
					while($row_mall = mysql_fetch_array($res_mall)){
						echo "<li class='list_mall'><i class='fa fa-building' style='color: #666633;'></i>&nbsp;&nbsp;".$row_mall["mallname"];
									if($_POST["mall"] == "" && $_POST["key"] != "")
	        						{
	        							$wing = $wingidd;
	        						}
	        						else
	        						{
										if($_POST["wing"] == "")
										{
											$wing = "WHERE mallID = '".$row_mall["mallid"]."'";
										}
										else
										{
											$wing = "WHERE wingID = '" . $_POST["wing"] ."'";
										}
	        						}


										$sql_wing = "SELECT wingID, wing FROM tblref_wing " . $wing;
										$sql_wing_res = mysql_query($sql_wing, $connection);
										// echo $sql_wing;
										while($wing = mysql_fetch_array($sql_wing_res))
										{
											echo "<ul>";
												echo "<li class='list_mall clickme'><i class='fa fa-folder-open' style='color: #ffcc66;'></i>&nbsp;&nbsp;".$wing["wing"];
														if($_POST["mall"] == "" && $_POST["key"] != "")
	        											{
	        												$floor = $flridd;
	        											}
	        											else
	        											{
															if($_POST["floor"] == "")
															{
																$floor = "WHERE wingid = '".$wing["wingID"]."'";
															}
															else
															{
																$floor = "WHERE floorid = '" . $_POST["floor"] . "'";
															}
	        											}

															$sql_floor = "SELECT floorid, floor FROM tblref_floorsetup " . $floor;
															$sql_floor_res = mysql_query($sql_floor, $connection);
															// echo $sql_floor;
															while($floor = mysql_fetch_array($sql_floor_res))
															{


																		echo "<ul>";
																				echo "<li class='list_mall clickme'><i class='fa fa-folder-open' style='color: #ffcc66;'></i>&nbsp;&nbsp;". $floor["floor"];
																				if($_POST["mall"] == "" && $_POST["key"] != "")
	        																	{
	        																		$key = $unitt;
	        																	}
	        																	else
	        																	{
																					if($_POST["key"] == "")
		    																		{
		    																			$key = "WHERE floorid = '".$floor["floorid"]."' ORDER BY unitname ASC";
		    																		}
		    																		else
		    																		{
		    																			$key = "WHERE unitname LIKE '%" . $_POST["key"] . "%' AND floorid = '".$floor["floorid"]."' ORDER BY unitname ASC";
		    																		}
	        																	}

																						$sql_unit = "SELECT unitid, unitname FROM tblref_unit ". $key;
																						$sql_unit_res = mysql_query($sql_unit, $connection);
																						// echo $sql_unit;
																						$cntunit = mysql_num_rows($sql_unit_res);
																						if($cntunit != 0)
																						{
																							echo "<ul>";
																						}
																						while($unit = mysql_fetch_array($sql_unit_res))
																						{
																									echo"<li class='unit' onclick='selectunit(\"".$unit["unitid"]."\")'>".$unit["unitname"]."</li>";
																						}
																						if($cntunit != 0)
																						{
																							echo "</ul>";
																						}

																				echo "</li>";
																		echo "</ul>";

															}
												echo "</li>";
											echo "</ul>";
										}
						echo "</li>";
					}
				}
        	}

        break;

        case 'loadallmalls_LCA':
	        if($_POST["mall"] == "")
			{
				$mall = "";
			}
			else
			{
				$mall = "WHERE mallID = '" . $_POST["mall"] ."'";
			}
				$content = "";
				$cnnnt = 0;
	        	$sql_mall = "SELECT mallid, mallname FROM tblref_mall " . $mall;
	       		$res_mall = mysql_query($sql_mall, $connection);
				// echo $sql_mall;
				while($row_mall = mysql_fetch_array($res_mall)){
					$content .= "<li class='list_mall'><i class='fa fa-building' style='color: #666633;'></i>&nbsp;&nbsp;".$row_mall["mallname"];
							if($_POST["key"] == "")
							{
								$key = "";
							}
							else
							{
								$key = "AND unitname LIKE '%".$_POST["key"]."%'";
							}

							$sql_unit = "SELECT unitid, unitname FROM tblref_unit WHERE mallid = '".$row_mall["mallid"]."' AND typeofbusiness = 'LCA' ".$key." ORDER BY unitname ASC";
							$sql_unit_res = mysql_query($sql_unit, $connection);
							$cntunit = mysql_num_rows($sql_unit_res);
							if($cntunit != 0)
							{
								$content .= "<ul>";
							}
							while($unit = mysql_fetch_array($sql_unit_res))
							{
								$cnnnt++;
								$content .="<li class='unit' onclick='selectunit_lca(\"".$unit["unitid"]."\")'>".$unit["unitname"]."</li>";
							}
							if($cntunit != 0)
							{
								$content .= "</ul>";
							}

					$content .= "</li>";
				}

				if($cnnnt == 0)
				{
					echo "<div style='opacity: 0.3;'><center><label style='font-size:30px;margin-top:10%;'>No data found</label><img src='assets/images/folder.png' style='margin-top:5%;'></center></div>";
				}
				else
				{
					echo '<ul class="tree tree-unselectable tree-folder-select">'.$content.'</ul>';
				}
        break;

   // case 'loadallmalls':
	  //       if($_POST["key"] != "")
	  //       {
	  //   		$sql = "SELECT unitid, unitname, mallid, floorid, wingid FROM tblref_unit WHERE unitname = '".$_POST["key"]."'";
	  //   		$result = mysql_query($sql, $connection);
	  //   		$resnum = mysql_num_rows($result);
	  //   		while($row = mysql_fetch_array($result))
	  //   		{
			//     		// if($resnum <= 1)
			//     		// {
			//     			$type = "WithResult";
			//     			$windid = " AND wingID = '".$row["wingid"]."'";
			//     			$floorid = " AND floorid = '".$row["floorid"]."'";
			//     			$unitid = " AND unitid = '".$row["unitid"]."'";
			//     			$mallid = "WHERE mallid = '".$row["mallid"]."'";

			//     			$unitresult = "";
			//     			$sql_unit = "SELECT unitid, unitname FROM tblref_unit WHERE floorid = '".$row["floorid"]."' ". $unitid;
			// 				$sql_unit_res = mysql_query($sql_unit, $connection);
			// 				$cntunit = mysql_num_rows($sql_unit_res);
			// 				if($cntunit != 0)
			// 				{
			// 					$unitresult .= "<ul>";
			// 				}
			// 				while($unit = mysql_fetch_array($sql_unit_res))
			// 				{
			// 							$unitresult .="<li class='unit' onclick='selectunit(\"".$unit["unitid"]."\")'>".$unit["unitname"]."</li>";
			// 				}
			// 				if($cntunit != 0)
			// 				{
			// 					$unitresult .= "</ul>";
			// 				}

			//     			$sql_mall = "SELECT mallid, mallname FROM tblref_mall " . $mallid;
			// 	       		$res_mall = mysql_query($sql_mall, $connection);
			// 				while($row_mall = mysql_fetch_array($res_mall)){
			// 					echo "<li class='list_mall'><i class='fa fa-building' style='color: #666633;'></i>&nbsp;&nbsp;".$row_mall["mallname"];

			// 									$sql_wing = "SELECT wingID, wing FROM tblref_wing WHERE mallID = '".$row_mall["mallid"]."'" . $windid;
			// 									$sql_wing_res = mysql_query($sql_wing, $connection);
			// 									while($wing = mysql_fetch_array($sql_wing_res))
			// 									{
			// 										echo "<ul>";
			// 											echo "<li class='list_mall clickme'><i class='fa fa-folder-open' style='color: #ffcc66;'></i>&nbsp;&nbsp;".$wing["wing"];

			// 														$sql_floor = "SELECT floorid, floor FROM tblref_floorsetup WHERE wingid = '".$wing["wingID"]."'" . $floorid;
			// 														$sql_floor_res = mysql_query($sql_floor, $connection);
			// 														while($floor = mysql_fetch_array($sql_floor_res))
			// 														{


			// 																	echo "<ul>";
			// 																			echo "<li class='list_mall clickme'><i class='fa fa-folder-open' style='color: #ffcc66;'></i>&nbsp;&nbsp;". $floor["floor"];

			// 																					echo $unitresult;

			// 																			echo "</li>";
			// 																	echo "</ul>";

			// 														}
			// 											echo "</li>";
			// 										echo "</ul>";
			// 									}
			// 					echo "</li>";
			// 				}
	  //   		}
	  //       }
	  //       else
	  //       {
	  //       	$type = "NoFilter";
	  //       	$windid = "";
	  //       	$floorid = "";
	  //       	$unitid = "";
	  //       	$mallid = "";

			//         	$sql_mall = "SELECT mallid, mallname FROM tblref_mall " . $mallid;
			//        		$res_mall = mysql_query($sql_mall, $connection);
			// 			while($row_mall = mysql_fetch_array($res_mall)){
			// 				echo "<li class='list_mall'><i class='fa fa-building' style='color: #666633;'></i>&nbsp;&nbsp;".$row_mall["mallname"];

			// 								$sql_wing = "SELECT wingID, wing FROM tblref_wing WHERE mallID = '".$row_mall["mallid"]."'" . $windid;
			// 								$sql_wing_res = mysql_query($sql_wing, $connection);
			// 								while($wing = mysql_fetch_array($sql_wing_res))
			// 								{
			// 									echo "<ul>";
			// 										echo "<li class='list_mall clickme'><i class='fa fa-folder-open' style='color: #ffcc66;'></i>&nbsp;&nbsp;".$wing["wing"];

			// 													$sql_floor = "SELECT floorid, floor FROM tblref_floorsetup WHERE wingid = '".$wing["wingID"]."'" . $floorid;
			// 													$sql_floor_res = mysql_query($sql_floor, $connection);
			// 													while($floor = mysql_fetch_array($sql_floor_res))
			// 													{


			// 																echo "<ul>";
			// 																		echo "<li class='list_mall clickme'><i class='fa fa-folder-open' style='color: #ffcc66;'></i>&nbsp;&nbsp;". $floor["floor"];

			// 																				$sql_unit = "SELECT unitid, unitname FROM tblref_unit WHERE floorid = '".$floor["floorid"]."'". $unitid;
			// 																				$sql_unit_res = mysql_query($sql_unit, $connection);
			// 																				$cntunit = mysql_num_rows($sql_unit_res);
			// 																				if($cntunit != 0)
			// 																				{
			// 																					echo "<ul>";
			// 																				}
			// 																				while($unit = mysql_fetch_array($sql_unit_res))
			// 																				{
			// 																							echo"<li class='unit' onclick='selectunit(\"".$unit["unitid"]."\")'>".$unit["unitname"]."</li>";
			// 																				}
			// 																				if($cntunit != 0)
			// 																				{
			// 																					echo "</ul>";
			// 																				}

			// 																		echo "</li>";
			// 																echo "</ul>";
			// 													}
			// 										echo "</li>";
			// 									echo "</ul>";
			// 								}
			// 				echo "</li>";
			// 			}
	  //       }
   //      break;

        case 'laodallmallsss':
        	$getmall = "SELECT mallid, mallname FROM tblref_mall";
        	$mallresult = mysql_query($getmall, $connection);
        	echo "<option value=''>Choose Mall</option>";
        	while($mall = mysql_fetch_array($mallresult))
        	{ echo "<option value='" . $mall["mallid"] . "'>" . $mall["mallname"] . "</option>"; }
        break;

        case 'removecontactper':
        	$sql = "DELETE FROM tbltrans_company_contact_person WHERE custID = '".$_POST["id"]."'";
        	$result = mysql_query($sql, $connection);
        	if($result == true)
        	{
        		echo 1;
        	}
        break;

        case 'editthiscontactperson':
        	$sql = "SELECT ConID, Confname, Conmname, Conlname, custID, name, designation, address, filename FROM tbltrans_company_contact_person WHERE custID = '".$_POST["id"]."'";
        	$result = mysql_query($sql, $connection);
        	$row = mysql_fetch_array($result);

        		if($row["filename"] == "")
				{
					$image = "assets/images/avatars/noimage.png";
				}
				else
				{
					$image = "server/company/".$row["ConID"]."/contact_person/".$row["custID"]."/".$row["filename"];
				}

        		echo $row["Confname"] . "|" . $row["Conmname"] . "|" . $row["Conlname"] . "|" . $row["custID"] . "|" . $row["name"] . "|" . $row["designation"] . "|" . $row["address"] . "|" . $image . "|";
        break;

        case 'editthiscontactperson_contacts':
        	$sql = "SELECT type, content FROM tbltrans_company_contact_person_contacts WHERE ConID = '".$_POST["id"]."' AND type = 'email'";
        	$result = mysql_query($sql, $connection);
        	$count = mysql_num_rows($result);
        	$count_a = 0;
        	if($count == 0)
        	{
        		echo "<div class='input-group' style='width:100%;'><input type='text' id='div_add_contact_person_email_update' class='spinbox-input form-control email-address emailaddress' placeholder='sample@yahoo.com'><div class='spinbox-buttons input-group-btn'><button type='button' class='btn spinbox-up btn-sm btn-success' onclick='div_add_field(\"div_add_contact_person_email_update\",\"emailaddress\")'><i class='icon-only  ace-icon ace-icon fa fa-plus bigger-110'></i></button></div></div>#|";
        	}
        	while($row = mysql_fetch_array($result))
        	{
        		$count_a++;
        		if($count_a == $count)
        		{
					echo "<div class='input-group' style='width:100%;'><input type='text' id='div_add_contact_person_email_update' class='spinbox-input form-control email-address emailaddress' value='".$row["content"]."' placeholder='sample@yahoo.com'><div class='spinbox-buttons input-group-btn'><button type='button' class='btn spinbox-up btn-sm btn-success' onclick='div_add_field(\"div_add_contact_person_email_update\",\"emailaddress\")'><i class='icon-only  ace-icon ace-icon fa fa-plus bigger-110'></i></button></div></div>#|";
        		}
        		else
        		{
        			echo "<input type='text' id='div_add_contact_person_email_update' class='form-control emailaddress' value='".$row["content"]."' style='margin-bottom:5px;'>";
        		}
        	}

        	$sql2 = "SELECT type, content FROM tbltrans_company_contact_person_contacts WHERE ConID = '".$_POST["id"]."' AND type = 'mobile'";
        	$result2 = mysql_query($sql2, $connection);
        	$count2 = mysql_num_rows($result2);
        	$count2_a = 0;
        	if($count2 == 0)
        	{
        		echo "<div class='input-group' style='width:100%;'><input type='text' id='company_contact_mobile' class='spinbox-input form-control input-mask-phone' placeholder='(999)-999-9999'><div class='spinbox-buttons input-group-btn'><button type='button' class='btn spinbox-up btn-sm btn-success' onclick='div_add_field(\"company_contact_mobile\",\"input-mask-phone\")'><i class='icon-only  ace-icon ace-icon fa fa-plus bigger-110'></i></button></div></div>#|";
        	}

        	while($row2 = mysql_fetch_array($result2))
        	{
        		$count2_a++;
        		if($count2_a == $count2)
        		{
					echo "<div class='input-group' style='width:100%;'><input type='text' id='company_contact_mobile' class='spinbox-input form-control input-mask-phone' placeholder='(999)-999-9999' value='".$row2["content"]."'><div class='spinbox-buttons input-group-btn'><button type='button' class='btn spinbox-up btn-sm btn-success' onclick='div_add_field(\"company_contact_mobile\",\"input-mask-phone\")'><i class='icon-only  ace-icon ace-icon fa fa-plus bigger-110'></i></button></div></div>#|";
        		}
        		else
        		{
        			echo "<input type='text' id='company_contact_mobile' class='form-control input-mask-phone' value='".$row2["content"]."' style='margin-bottom:5px;'>";
        		}
        	}

        	$sql3 = "SELECT type, content FROM tbltrans_company_contact_person_contacts WHERE ConID = '".$_POST["id"]."' AND type = 'telephone'";
        	$result3 = mysql_query($sql3, $connection);
        	$count3 = mysql_num_rows($result3);
        	$count3_a = 0;
        	if($count3 == 0)
        	{
        		echo "<div class='input-group' style='width:100%;'><input type='text' id='div_add_contact_person_tele_update' class='spinbox-input form-control input-mask-tele' placeholder='(99)-999-9999'><div class='spinbox-buttons input-group-btn'><button type='button' class='btn spinbox-up btn-sm btn-success' onclick='div_add_field(\"div_add_contact_person_tele_update\",\"emailaddress\")'><i class='icon-only  ace-icon ace-icon fa fa-plus bigger-110'></i></button></div></div>#|";
        	}
        	while($row3 = mysql_fetch_array($result3))
        	{
        		$count3_a++;
        		if($count3_a == $count3)
        		{
					echo "<div class='input-group' style='width:100%;'><input type='text' id='div_add_contact_person_tele_update' class='spinbox-input form-control input-mask-tele' placeholder='(99)-999-9999' value='".$row3["content"]."'><div class='spinbox-buttons input-group-btn'><button type='button' class='btn spinbox-up btn-sm btn-success' onclick='div_add_field(\"div_add_contact_person_tele_update\",\"emailaddress\")'><i class='icon-only  ace-icon ace-icon fa fa-plus bigger-110'></i></button></div></div>#|";
        		}
        		else
        		{
        			echo "<input type='text' id='div_add_contact_person_tele_update' class='form-control input-mask-tele' value='".$row3["content"]."' style='margin-bottom:5px;'>";
        		}
        	}

        break;

        case 'savecontactperson_update':
        	$sql = "UPDATE tbltrans_company_contact_person SET Confname = '".$_POST["fname"]."', Conmname = '".$_POST["mname"]."', Conlname = '".$_POST["lname"]."', designation = '".$_POST["designation"]."', address = '".$_POST["add"]."' WHERE custID = '".$_POST["id"]."'";
        	$result = mysql_query($sql, $connection);
        	if($result == true)
        	{
        		echo 1;
        	}
        break;

        case 'savecontactperson_update_contactnum':
        	$sql2 = "DELETE FROM tbltrans_company_contact_person_contacts WHERE ConID = '".$_POST["id"]."'";
        	$result2 = mysql_query($sql2, $connection);

        	$contact_email = explode("|", $_POST["email_update"]);
        	for ($i=0; $i<=count($contact_email)-2; $i++)
        	{
	        	$sql = "INSERT INTO tbltrans_company_contact_person_contacts (ConID, type, content)VALUES('".$_POST["id"]."', 'email', '".$contact_email[$i]."')";
	        	$result = mysql_query($sql, $connection);
	        	if($result == true)
	        	{
	        		echo 1;
	        	}
        	}

        	$contact_mobile = explode("|", $_POST["mobile_number"]);
        	for ($j=0; $j<=count($contact_mobile)-2; $j++)
        	{
	        	$sql = "INSERT INTO tbltrans_company_contact_person_contacts (ConID, type, content)VALUES('".$_POST["id"]."', 'mobile', '".$contact_mobile[$j]."')";
	        	$result = mysql_query($sql, $connection);
	        	if($result == true)
	        	{
	        		echo 1;
	        	}
        	}

        	$contact_tele = explode("|", $_POST["tel_number"]);
        	for ($k=0; $k<=count($contact_tele)-2; $k++)
        	{
	        	$sql = "INSERT INTO tbltrans_company_contact_person_contacts (ConID, type, content)VALUES('".$_POST["id"]."', 'telephone', '".$contact_tele[$k]."')";
	        	$result = mysql_query($sql, $connection);
	        	if($result == true)
	        	{
	        		echo 1;
	        	}
        	}

        break;

        case 'addcontactperson_update':
        $cnt = "SELECT COUNT(custID) FROM tbltrans_company_contact_person WHERE Confname = '".$_POST["contact_firstname"]."' AND Conlname = '".$_POST["contact_middlename"]."' AND Conmname = '".$_POST["contact_middlename"]."' AND ConID = '".$_POST["id"]."'";
        $rescnt = mysql_query($cnt, $connection);
        $cnnnt = mysql_fetch_array($rescnt);
        if($cnnnt[0] > 0)
        {
        	echo "0|0|";
        }
        else
        {
			$contactid = createidno("CON", "tbltrans_company_contact_person", "ConID");
			$sql = "INSERT INTO tbltrans_company_contact_person (ConID, Confname, Conmname, Conlname, custID, name, designation, address)VALUES('".$_POST["id"]."', '".$_POST["contact_firstname"]."', '".$_POST["contact_middlename"]."', '".$_POST["contact_lastname"]."', '".$contactid."', '".$_POST["contact_firstname"]." ".$_POST["contact_middlename"]." ".$_POST["contact_lastname"]."', '".$_POST["contact_designation"]."', '".$_POST["contact_address"]."')";
			$result = mysql_query($sql, $connection);

			$email_string = explode("|", $_POST["person_email"]);
			for($a=0; $a<=count($email_string)-2; $a++)
			{
				$email_string_query = "INSERT INTO tbltrans_company_contact_person_contacts(ConID, type, content) VALUES('".$contactid."', 'email', '".$email_string[$a]."')";
				$email_string_result = mysql_query($email_string_query, $connection);
			}

			$mobile_string = explode("|", $_POST["person_mobile"]);
			for($b=0; $b<=count($mobile_string)-2; $b++)
			{
				$mobile_string_query = "INSERT INTO tbltrans_company_contact_person_contacts(ConID, type, content) VALUES('".$contactid."', 'mobile', '".$mobile_string[$b]."')";
				$mobile_string_result = mysql_query($mobile_string_query, $connection);
			}

			$tele_string = explode("|", $_POST["person_tele"]);
			for($c=0; $c<=count($tele_string)-2; $c++)
			{
				$tele_string_query = "INSERT INTO tbltrans_company_contact_person_contacts(ConID, type, content) VALUES('".$contactid."', 'telephone', '".$tele_string[$c]."')";
				$tele_string_result = mysql_query($tele_string_query, $connection);
			}

			echo "1|".$contactid."|";
        }
        break;

        case 'loadcompanylo':
        	$sql = "SELECT CompanyID, Company, industryID, industry, businessAddress, owner_firstname, owner_middlename, owner_lastname, permanent_address, current_address, billing_address, remarks, filename FROM tbltrans_company";
        	$result = mysql_query($sql, $connection);
        	while($row = mysql_fetch_array($result))
        	{
        		if($row["filename"] == "")
				{
					$image = "assets/images/avatars/noimage.png";
				}
				else
				{
					$image = "server/company/".$row["CompanyID"]."/profile/".$row["filename"];
				}

        		echo "<li class='dd-item dd2-item' id='module_1' style='cursor: pointer;'>
                         <div class='dd-handle dd2-handle' style='height:100%;'>
                             <img src='".$image."' style='height:85%;width:85%;margin-bottom:3px !important;margin-top:3px !important;'>
                         </div>
                         <div class='dd2-content'><label style='width:80%;' onclick='loadinformationcomp(\"".$row["CompanyID"]."\")'>".$row["Company"]."</label>
                         	<a href='#' title='Edit Company Profile' class='btnedit' style='float:right;' onclick='updatecompany(\"".$row["CompanyID"]."\");'><i class='ace-icon fa fa-pencil'></i></a>
						 </div>
                     </li>";
        	}
        break;

        case 'loadtardelist':
        	$sql = "SELECT tradename, companyID, tradeID, filename FROM tbltrans_tradename WHERE companyID = '".$_POST["id"]."'";
        	$result = mysql_query($sql, $connection);
        	while($row = mysql_fetch_array($result))
        	{
        		if($row["filename"] == "")
				{
					$image = "assets/images/avatars/noimage.png";
				}
				else
				{
					$image = "server/company/".$row["companyID"]."/trades/".$row["tradeID"]."/".$row["filename"];
				}
        		echo "
					<tr style='width: 100%;display: table;table-layout: fixed;' onclick='editstore(\"".$row["tradeID"]."\", \"".$image."\", \"".$row["tradename"]."\", \"".$row["companyID"]."\")'>
						<td class='hide_mobile' width='7%'><img src='".$image."' style='width:50px;height:50px;'></th>
						<td class='scroll' width='15%'>" . $row["tradeID"] . "</th>
						<td class='scroll'>" . $row["tradename"] . "</th>
					</tr>
					";
			}
        break;

        case 'loadinformationcomp':
        	$sql = "SELECT CompanyID, Company, industryID, industry, businessAddress, owner_firstname, owner_middlename, owner_lastname, permanent_address, current_address, billing_address, remarks, filename FROM tbltrans_company WHERE CompanyID = '".$_POST["id"]."'";
        	$result = mysql_query($sql, $connection);
        	$row = mysql_fetch_array($result);

        	if($row["filename"] == "")
			{
				$image = "assets/images/avatars/noimage.png";
			}
			else
			{
				$image = "server/company/".$row["CompanyID"]."/profile/".$row["filename"];
			}

        	echo $row["Company"]."|".$row["industry"]."|".$row["businessAddress"]."|".$row["owner_firstname"]."|".$row["owner_middlename"]."|".$row["owner_lastname"]."|".$image."|";
        break;

        case 'getallamenities':
        	$sql = "SELECT amenitiesID, amenities FROM tblref_unit_amenities WHERE unitID = '".$_POST["id"]."'";
        	$result = mysql_query($sql, $connection);
        	$row = mysql_fetch_array($result);

        	$getam = "SELECT amenitiesname FROM tblref_amenities WHERE amenitiesid = '".$row["amenitiesID"]."'";
        	$amres = mysql_query($getam, $connection);
        	while($am = mysql_fetch_array($amres))
        	{
	        	echo '<span class="tag tagval_'.$row["amenitiesID"].'" id="span_'.$row["amenitiesID"].'"> '.$am["amenitiesname"].'<button type="button" class="close">×</button><input type="hidden" value="'.$row["amenities"].'" class="qty_amenities"><input type="hidden" value="'.$row["amenitiesID"].'" class="chosen_amenities"></span>';
        	}
        	echo '<br><label style="width: 100%;" onclick="addnewrefamenities()">Click to add amenities ..</label>';
        break;

        case 'loadmallcount':
        	$sql = " SELECT COUNT(*) from tblref_mall ";
        	$res = mysql_query($sql, $connection);
        	$row = mysql_fetch_array($res);
			echo $row[0];
        break;

        case 'maxmallcount':
        	$sql = " SELECT maxnumofmall from tblsys_setup2 ";
        	$res = mysql_query($sql, $connection);
        	$row = mysql_fetch_array($res);
        	echo $row[0];
        break;

        case 'loadentriesstorelist':
            	$search = " ( tradename LIKE '%".$_POST['txtsearchtradename']."%')";

               if($_POST["page"] == ""){
                   $page = 1;
               }else{
                   $page = $_POST["page"];
               }

               $limit = ($page-1) * 20;

                $sql = "SELECT COUNT(a.CompanyID) FROM tbltrans_company AS a INNER JOIN tbltrans_tradename AS b ON a.companyID = b.companyID WHERE ".$search." ";
                $result = mysql_query($sql, $connection);
                $row = mysql_fetch_array($result);

                $rowsperpage = 20;
                $totalpages = ceil($row[0] / $rowsperpage);
                $upto = $limit + 20;
                $from = $limit + 1;
                if($page == $totalpages && $row[0] != 0){
                     echo "Showing " . $from . " to " . $row[0] . " of " . $row[0] . " entries";
                }
                else
                {
                     if($row[0] == 0){
                       echo "no data";
                      }
                     else if($row[0] <= 19 && $row[0] != 0){
                       echo "Showing 1 to " . $row[0] . " of " . $row[0] . " entries";
                      }
                     else if($row[0] >= 20 && $row[0] != 0){
                       echo "Showing " . $from . " to " . $upto . " of " . $row[0] . " entries";
                      }

                 }
           break;

    		case "loadpagestorelist":
                $search = " ( tradename LIKE '%".$_POST['txtsearchtradename']."%')";

    		    $page = $_POST["page"];

            	$sqlb = "SELECT COUNT(a.CompanyID) FROM tbltrans_company AS a INNER JOIN tbltrans_tradename AS b ON a.companyID = b.companyID WHERE ".$search." ";
    			$aa = mysql_query($sqlb, $connection);
    			$nums = mysql_fetch_row($aa);
    			$num = $nums[0];
    			// if($num <= 20)
    			// {
    			// 	$page = 1
    			// }
    			$rowsperpage = 20;
    			$range = 19;
    			$totalpages = ceil($num / $rowsperpage);
    			$prevpage;
    			$nextpage;
    			// if not on page 1, don't show back links
    			if($page > 1 ){
    			   echo "<li style='width:50px !important;' onclick='pagination_store(1)'><< First</li>";
    			   $prevpage = $page - 1;
    			   echo "<li style='width:70px !important;' onclick='pagination_store(". $prevpage .")'>< Previous</li>";
    			}

    			for($x = ($page - $range); $x < (($page + $range) + 1); $x++)
    			{
    			   if (($x > 0) && ($x <= $totalpages)){
        			    if ($x == $page){
                            echo "<li id='pg" . $x . "' class='pgnum active' onclick='pagination_store(" . $x . ",". $x .")'>" . $x . "</li>";
                          }
        			    else{
        			        echo "<li id='pg" . $x . "' class='pgnum' onclick='pagination_store(" . $x . ",". $x .")'>" . $x . "</li>";
                        }
    		       }
    		    }
    		    if($page < ($totalpages - $range)){
                    echo "<li>...</li>";
                }

    		    if ($page != $totalpages && $num != 0){
    		       $nextpage = $page + 1;
    		       echo "<li style='width:50px !important;' onclick='pagination_store(". $nextpage .", ". $nextpage .")'>Next ></li>";
    		       echo "<li style='width:50px !important;' onclick='pagination_store(". $totalpages .", ". $totalpages .")'>Last >></li>";
    		    }
    		break;

    		case 'loadentriescompanylist':
            	$search = " ( Company LIKE '%".$_POST['txtsearchcompany']."%')";

               if($_POST["page"] == ""){
                   $page = 1;
               }else{
                   $page = $_POST["page"];
               }

               $limit = ($page-1) * 20;

                $sql = "SELECT COUNT(*) FROM tbltrans_company WHERE ".$search." ";
                $result = mysql_query($sql, $connection);
                $row = mysql_fetch_array($result);

                $rowsperpage = 20;
                $totalpages = ceil($row[0] / $rowsperpage);
                $upto = $limit + 20;
                $from = $limit + 1;
                if($page == $totalpages && $row[0] != 0){
                     echo "Showing " . $from . " to " . $row[0] . " of " . $row[0] . " entries";
                }
                else
                {
                     if($row[0] == 0){
                       echo "no data";
                      }
                     else if($row[0] <= 19 && $row[0] != 0){
                       echo "Showing 1 to " . $row[0] . " of " . $row[0] . " entries";
                      }
                     else if($row[0] >= 20 && $row[0] != 0){
                       echo "Showing " . $from . " to " . $upto . " of " . $row[0] . " entries";
                      }

                 }
           break;

    		case "loadpagecompanylist":
                $search = " ( Company LIKE '%".$_POST['txtsearchcompany']."%')";

    		    $page = $_POST["page"];

            	$sqlb = "SELECT COUNT(*) FROM tbltrans_company WHERE ".$search." ";
    			$aa = mysql_query($sqlb, $connection);
    			$nums = mysql_fetch_row($aa);
    			$num = $nums[0];
    			// if($num <= 20)
    			// {
    			// 	$page = 1
    			// }
    			$rowsperpage = 20;
    			$range = 19;
    			$totalpages = ceil($num / $rowsperpage);
    			$prevpage;
    			$nextpage;
    			// if not on page 1, don't show back links
    			if($page > 1 ){
    			   echo "<li style='width:50px !important;' onclick='pagination(1)'><< First</li>";
    			   $prevpage = $page - 1;
    			   echo "<li style='width:70px !important;' onclick='pagination(". $prevpage .")'>< Previous</li>";
    			}

    			for($x = ($page - $range); $x < (($page + $range) + 1); $x++)
    			{
    			   if (($x > 0) && ($x <= $totalpages)){
        			    if ($x == $page){
                            echo "<li id='pg" . $x . "' class='pgnum active' onclick='pagination(" . $x . ",". $x .")'>" . $x . "</li>";
                          }
        			    else{
        			        echo "<li id='pg" . $x . "' class='pgnum' onclick='pagination(" . $x . ",". $x .")'>" . $x . "</li>";
                        }
    		       }
    		    }
    		    if($page < ($totalpages - $range)){
                    echo "<li>...</li>";
                }

    		    if ($page != $totalpages && $num != 0){
    		       $nextpage = $page + 1;
    		       echo "<li style='width:50px !important;' onclick='pagination(". $nextpage .", ". $nextpage .")'>Next ></li>";
    		       echo "<li style='width:50px !important;' onclick='pagination(". $totalpages .", ". $totalpages .")'>Last >></li>";
    		    }
    		break;

    		case 'load_mall_select':
    			echo "<option value=''>-- Select Mall --</option>";
    			$queryind = "SELECT mallid, mallname FROM tblref_mall WHERE mallstat != '0' ";
                $rsss = mysql_query($queryind, $connection);
                while($row = mysql_fetch_array($rsss)){
                  $industry = "<option value='".$row['mallid']."'>";
                  $industry .= $row['mallname']."</option>";

                  echo $industry;
              }
    		break;

    		case 'loadrequirements_tenants':
	    		$i = 0;
	            $queryind = "SELECT id, requirements FROM tblref_applicationrequirements";
	            $rsss = mysql_query($queryind, $connection);
	             while($row = mysql_fetch_array($rsss)){
	              $i++;
	                  echo " <form name='posting_comment' class='form_lease_application_req' id='posting_commentreq_".$i."'>
	                       <div style='display: none'>
	                         <input type='text' name='txtaapid' class='txtaapid' id='txtappid_form_".$i."'>
	                         <input type='text' name='txtinqqid' class='txtinqqid' id='txtinqid_form_".$i."'>
	                           </div>";
	                  echo'<div class="row"><div class="col-xs-6">'.$row["requirements"].'</div><div class="col-xs-6"><input type="file" class="upload_app_req id-input-file-2" name="attachment_filess" onchange="chkclippeddocx($(this))"/><input type="hidden" name="hiddenidss" value="'.$row["id"].'" /></div></div>';
	                  echo "</form>";
	            }
            break;

            case 'savenewtenant':
            	$datenow = getsysdate();
				$sql_mall = "SELECT mallname FROM tblref_mall WHERE mallid = '". $_POST['mallid'] ."'";
				$result_mall = mysql_query($sql_mall, $connection);
				$mall = mysql_fetch_array($result_mall);

				$sql_user = "SELECT firstname, middlename, lastname FROM tbluser WHERE userid = '".$_COOKIE["userid"]."'";
       			$res = mysql_query($sql_user, $connection);
       			$row_user = mysql_fetch_array($res);

				$inqid = createidno("INQ", "tbltrans_inquiry", "Inquiry_ID");
				$appid = createidno("APP", "tbltrans_inquiry", "Application_ID");
				$sql = "INSERT INTO tbltrans_inquiry (Inquiry_ID, Application_ID, Mall, Mall_ID, Trade_Name, Company_Name, Industry, Address, Remarks, User_ID, Company_ID, TradeID, UnitID, datefrom, dateto, DepartmentID,CategoryID, depamount, advamount, dep_month, adv_month, date_inquired, UnitType, ClassID, LCA_length, LCA_width, desired_noofmonths, desired_noofdays, inq_by, date_modified, mod_by, time_inquired, Status, merchant_code, Status_Type) values('". $inqid ."' , '". $appid ."' , '".$_POST["mallname"]."', '".$_POST["mallid"]."', '".$_POST["tradename"]."', '".$_POST["companyname"]."', '".$_POST["industryname"]."', '".$_POST["address"]."','".$_POST["remarks"]."', '".$_COOKIE["userid"]."', '".$_POST["companyid"]."', '".$_POST["tradeid"]."','".$_POST["unitid"]."', '".$_POST["datefrom"]."', '".$_POST["dateto"]."', '".$_POST["dep_id"]."', '".$_POST["cat_id"]."', '".$_POST["depositpayment"]."', '".$_POST["advancepayment"]."', '".$_POST["monthlydepamt"]."', '".$_POST["monthlyadvamt"]."', '".$datenow."', '".$_POST["unittype"]."', '".$_POST["classid"]."', '".$_POST["sqm_length"]."', '".$_POST["sqm_width"]."', '".$_POST["monthnum"]."', '".$_POST["daynum"]."', '".$row_user["lastname"].", ".$row_user["firstname"]." ".$row_user["middlename"]."', '".date($datenow." H:i:s")."', '".$row_user["lastname"].", ".$row_user["firstname"]." ".$row_user["middlename"]."', '".date("H:i:s")."', 'Occupied', '".$_POST["merchcode"]."', 'direct_occupied')";
				$result = mysql_query($sql, $connection);
				if($result == true)
				{
					$tenantID = createidno("TENANT", "tbltrans_tenants", "TenantID");
					$logs = create_logs("added a new tenant.", "Tenants Module", $inqid ."|".$_POST["mallname"]."|".$_POST["mallid"]."|".$_POST["tradename"]."|".$_POST["companyname"]."|".$_POST["industryname"]."|".$_POST["address"]."|".$_POST["remarks"]."|".$row_user["lastname"].", ".$row_user["firstname"]." ".$row_user["middlename"]."|".$_POST["companyid"]."|".$_POST["tradeid"]."|".$_POST["unitid"]."|".$_POST["datefrom"]."|".$_POST["dateto"]."|".$_POST["dep_id"]."|".$_POST["cat_id"]."|".$_POST["depositpayment"]."|".$_POST["advancepayment"]."|".$_POST["monthlydepamt"]."|".$_POST["monthlyadvamt"]."|".$_POST["unittype"]."|".$_POST["classid"]."|".$_POST["sqm_length"]."|".$_POST["sqm_width"]."|".$_POST["monthnum"]."|".$_POST["daynum"], "ADD");
						echo 1 . "|" . $inqid . "|" . $appid . "|";

					$tran_logs = create_logs_per_transaction("added a new tenant directly.", "Tenants Module", $inqid ."|".$_POST["mallname"]."|".$_POST["mallid"]."|".$_POST["tradename"]."|".$_POST["companyname"]."|".$_POST["industryname"]."|".$_POST["address"]."|".$_POST["remarks"]."|".$row_user["lastname"].", ".$row_user["firstname"]." ".$row_user["middlename"]."|".$_POST["companyid"]."|".$_POST["tradeid"]."|".$_POST["unitid"]."|".$_POST["datefrom"]."|".$_POST["dateto"]."|".$_POST["dep_id"]."|".$_POST["cat_id"]."|".$_POST["depositpayment"]."|".$_POST["advancepayment"]."|".$_POST["monthlydepamt"]."|".$_POST["monthlyadvamt"]."|".$_POST["unittype"]."|".$_POST["classid"]."|".$_POST["sqm_length"]."|".$_POST["sqm_width"]."|".$_POST["monthnum"]."|".$_POST["daynum"], "ADD", $inqid, $appid, $tenantID);

						$sqlselectneeded_inq = "SELECT TradeID, Mall_ID, Trade_Name, Company_ID, Company_Name, UnitID, datefrom, dateto, accof_Reservation, alerttype_cus, alerttype_email, datepayment, amount, alertdate, accof_Reservation, alerttype_cus, alerttype_email, UnitType, ClassID, DepartmentID, CategoryID FROM tbltrans_inquiry WHERE Inquiry_ID = '".$inqid."' AND Application_ID = '".$appid."'";
						$sqlselectneeded_inq_result = mysql_query($sqlselectneeded_inq, $connection);
						$inq = mysql_fetch_array($sqlselectneeded_inq_result);

						// $logs = create_logs("changed the status of a reservation of ".$inq["Trade_Name"].".", "Reservation Module", $appid."|".$inqid, "UPDATE");

						// $tran_logs = create_logs_per_transaction("changed the status of a reservation of ".$inq["Trade_Name"].".", "Reservation Module", $appid."|".$inqid, "UPDATE", $inqid, $appid, "");

						$updatelogs = "UPDATE tbllogs_per_trans SET tenID = '".$tenantID."' WHERE inqID = '".$inqid."'";
						$resultudatelogs = mysql_query($updatelogs, $connection);

						$sqlselectneeded_comp = "SELECT owner_firstname, owner_middlename, owner_lastname FROM tbltrans_company WHERE CompanyID = '".$inq["Company_ID"]."'";
						$sqlselectneeded_comp_result = mysql_query($sqlselectneeded_comp, $connection);
						$comp = mysql_fetch_array($sqlselectneeded_comp_result);

						$sqlselectneeded_unit = "SELECT unitname, totalamountunitsetup, typeofbusiness FROM tblref_unit WHERE unitid = '".$inq["UnitID"]."'";
						$sqlselectneeded_unit_result = mysql_query($sqlselectneeded_unit, $connection);
						$unit = mysql_fetch_array($sqlselectneeded_unit_result);

						$date1 = $inq["datefrom"];
						$date2 = $inq["dateto"];

						$ts1 = strtotime($date1);
						$ts2 = strtotime($date2);

						$year1 = date('Y', $ts1);
						$year2 = date('Y', $ts2);

						$month1 = date('m', $ts1);
						$month2 = date('m', $ts2);

						$months = (($year2 - $year1) * 12) + ($month2 - $month1);


						$days = (strtotime($inq["dateto"]) - strtotime($inq["datefrom"])) / (60 * 60 * 24);

						if($unit["typeofbusiness"] == "LCA")
						{
							$months2 = $months;
							$days2 = $days;
						}
						else if($unit["typeofbusiness"] == "SET")
						{
							$months2 = $months;
							$days2 = 0;
						}

						if($inq["UnitType"] == "LCA")
						{

							$sqla_class = "SELECT classification FROM tblref_merchandise_class WHERE classificationID = '".$inq["ClassID"]."'";
							$resulta_class = mysql_query($sqla_class, $connection);
							$rowa_class = mysql_fetch_array($resulta_class);

							// if($countlca != 0)
							// {
								$ttlamtsetup = intval($lca_unit["width"]) * intval($lca_unit["ulength"]);
								$unitid = createidno("U", "tblref_unit", "unitid");
								$insertunit = "INSERT INTO tblref_unit (unitid, unitname, buildingname, typeofbusiness, classificationname, sqmunitsetup, pricepersqmunitsetup, totalamountunitsetup, dateadded, mallid, bldgnumber, floorid, wingid, classid, depid, catid, TenantID, TenantName, startDate, endDate, sqm_width, sqm_height, floorunit) VALUES('".$unitid."', '".$_POST["lca_unitname"]."', '".$_POST["unitwing"]."', '".$inq["UnitType"]."', '".$rowa_class["classification"]."', '".$ttlamtsetup."', '".$_POST["persqm"]."', '".$_POST["totalsqm"]."', '".$datenow."', '".$_POST["mallid"]."', '".$_POST["unitwing"]."', '".$_POST["unitfloor"]."', '".$_POST["unitwing"]."', '".$inq["ClassID"]."', '".$inq["DepartmentID"]."', '".$inq["CategoryID"]."', '".$tenantID."', '".$inq["Trade_Name"]."', '".date("Y-m-d", strtotime($inq["datefrom"]))."', '".date("Y-m-d", strtotime($inq["dateto"]))."', '".$_POST["sqm_width"]."', '".$_POST["sqm_length"]."', '".$_POST["unitfloor"]."')";
								$result_insertunit = mysql_query($insertunit, $connection);

							$refDate2 = $inq["datefrom"];
							for ($x=1; $x<=$days+1; $x++)
							{
								$refDate2 = date( 'Y/m/d', strtotime($refDate2) );
								$selectlogs = "SELECT COUNT(*) FROM tblunit_statuslogs WHERE unitid = '".$unitid."' AND xdate = '".$refDate2."'";
								$resultlogs = mysql_query($selectlogs, $connection);
								$logs = mysql_fetch_array($resultlogs);

								if($logs[0] == 0)
								{
									$insert_logs = "INSERT INTO tblunit_statuslogs (unitid, unitname, tenantid, tenantname, xdate, xtime, status)VALUES('".$unitid."', '".$_POST["lca_unitname"]."', '".$tenantID."', '".$_POST["lca_unitname"]."', '".$refDate2."', '".date("h-i-s")."', 'occupied')";
									$result_logs = mysql_query($insert_logs);
								}
								else
								{
									$insert_logs = "UPDATE tblunit_statuslogs SET status = 'occupied', tenantid = '".$tenantID."' WHERE unitid = '".$unitid."' AND xdate = '".$refDate2."'";
									$result_logs = mysql_query($insert_logs);
								}
								$refDate2 = date( 'Y/m/d', strtotime($refDate2 . '+1 day') );

							}


							$update_unitstats = "UPDATE tblref_unit SET status = 'occupied', TenantID = '".$tenantID."' WHERE unitid = '".$unitid."'";
							$res_updateresstat = mysql_query($update_unitstats);



							$refDate = $inq["datefrom"];
							$chknumposted = explode("|", $_POST["chknum"]);
							$bnkposted = explode("|", $_POST["bankname"]);
							if($unit["typeofbusiness"] == "LCA")
							{
								for ($x=1; $x<=$days; $x++) {

									// $mgadate .= "<span class='pdcdate' style='font-size: 14px; color: black;'>". $refDate . "</span><label style='font-size: 14px; color: black;'> - ₱ ".$_POST['inqmonpayment'].".00</label style='font-size: 14px;'><br>";

									$refDate = date( 'Y/m/d', strtotime($refDate . '+1 day') );
									$sql_pdc = "INSERT INTO tbltrans_pdc (inquiryid, customerid, lname, fname, pdcdate, amount, checkno, bank)VALUES('". $inqid ."', '". $tenantID ."', '". $comp["owner_lastname"] ."', '". $comp["owner_firstname"] ."', '". $refDate ."', '". $unit[1] ."', '".$chknumposted[$x]."', '".$bnkposted[$x]."')";
									$result_pdc = mysql_query($sql_pdc, $connection);

								}
							}
							else
							{
								for ($x=1; $x<=$months; $x++) {

									// $mgadate .= "<span class='pdcdate' style='font-size: 14px; color: black;'>". $refDate . "</span><label style='font-size: 14px; color: black;'> - ₱ ".$_POST['inqmonpayment'].".00</label style='font-size: 14px;'><br>";

									$refDate = date( 'Y/m/d', strtotime($refDate . '+1 month') );
									$sql_pdc = "INSERT INTO tbltrans_pdc (inquiryid, customerid, lname, fname, pdcdate, amount, checkno, bank)VALUES('". $inqid ."', '". $tenantID ."', '". $comp["owner_lastname"] ."', '". $comp["owner_firstname"] ."', '". $refDate ."', '". $unit[1] ."', '".$chknumposted[$x]."', '".$bnkposted[$x]."')";
									$result_pdc = mysql_query($sql_pdc, $connection);

								}
							}


									$updateinquiryunit = "UPDATE tbltrans_inquiry SET UnitID = '".$unitid."' WHERE Inquiry_ID = '".$inqid."'";
									$resultinquiryunit = mysql_query($updateinquiryunit, $connection);


									if($result_insertunit == true)
									{
										$delunit = "DELETE FROM tblref_unit_lca_dummy WHERE inquiryID = '".$inqid."'";
										$result = mysql_query($delunit, $connection);
									}

									$insert_tenants = "INSERT INTO tbltrans_tenants (TenantID, mallID, owner_lastname, owner_firstname, owner_midname, appID, inqID, tradeID, tradename, CompanyID, companyname, unitID, unitname, datefrom, dateto, datepayment, amount, alertdate, remarks, accof, alerttype_cus, alerttype_email, Status, noofmonths, noofdays,  costpermonths, ustatus, tenanttype, revpercent, merchant_code)VALUES('".$tenantID."' ,'".$inq["Mall_ID"]."' ,'".$comp["owner_lastname"]."' ,'".$comp["owner_firstname"]."' ,'".$comp["owner_middlename"]."' ,'".$appid."' ,'".$inqid."' ,'".$inq["TradeID"]."' ,'".$inq["Trade_Name"]."' ,'".$inq["Company_ID"]."' ,'".$inq["Company_Name"]."' ,'".$unitid."' ,'".$_POST["lca_unitname"]."' ,'".date("Y/m/d", strtotime($inq["datefrom"]))."' ,'".date("Y/m/d", strtotime($inq["dateto"]))."' ,'".$inq["datepayment"]."' ,'".$inq["amount"]."' ,'".$inq["alertdate"]."' ,'' ,'".$inq["accof_Reservation"]."' ,'".$inq["alerttype_cus"]."' ,'".$inq["alerttype_email"]."' ,'actived' ,'".$months2."','".$days2."' ,'".$unit["totalamountunitsetup"]."', 'occupied', '". $_POST["billtype"] . "', '". $_POST["perc"] . "', '".$_POST["merchcode"]."')";
									$result_tenants = mysql_query($insert_tenants, $connection);
								// }
						}
						else
						{
							$insert_tenants = "INSERT INTO tbltrans_tenants (TenantID, mallID, owner_lastname, owner_firstname, owner_midname, appID, inqID, tradeID, tradename, CompanyID, companyname, unitID, unitname, datefrom, dateto, datepayment, amount, alertdate, remarks, accof, alerttype_cus, alerttype_email, Status, noofmonths, noofdays,  costpermonths, ustatus, tenanttype, revpercent, merchant_code)VALUES('".$tenantID."' ,'".$inq["Mall_ID"]."' ,'".$comp["owner_lastname"]."' ,'".$comp["owner_firstname"]."' ,'".$comp["owner_middlename"]."' ,'".$appid."' ,'".$inqid."' ,'".$inq["TradeID"]."' ,'".$inq["Trade_Name"]."' ,'".$inq["Company_ID"]."' ,'".$inq["Company_Name"]."' ,'".$inq["UnitID"]."' ,'".$unit["unitname"]."' ,'".date("Y/m/d", strtotime($inq["datefrom"]))."' ,'".date("Y/m/d", strtotime($inq["dateto"]))."' ,'".$inq["datepayment"]."' ,'".$inq["amount"]."' ,'".$inq["alertdate"]."' ,'' ,'".$inq["accof_Reservation"]."' ,'".$inq["alerttype_cus"]."' ,'".$inq["alerttype_email"]."' ,'actived' ,'".$months2."','".$days2."' ,'".$unit["totalamountunitsetup"]."', 'occupied', '". $_POST["billtype"] . "', '". $_POST["perc"] . "', '".$_POST["merchcode"]."')";
							$result_tenants = mysql_query($insert_tenants, $connection);

							$refDate2 = $inq["datefrom"];
							for ($x=1; $x<=$days+1; $x++)
							{
								$refDate2 = date( 'Y/m/d', strtotime($refDate2) );
								$selectlogs = "SELECT COUNT(*) FROM tblunit_statuslogs WHERE unitid = '".$inq["UnitID"]."' AND xdate = '".$refDate2."'";
								$resultlogs = mysql_query($selectlogs, $connection);
								$logs = mysql_fetch_array($resultlogs);

								if($logs[0] == 0)
								{

									$insert_logs = "INSERT INTO tblunit_statuslogs (unitid, unitname, tenantid, tenantname, xdate, xtime, status)VALUES('".$inq["UnitID"]."', '".$unit["unitname"]."', '".$tenantID."', '".$inq["Trade_Name"]."', '".$refDate2."', '".date("h-i-s")."', 'occupied')";
									$result_logs = mysql_query($insert_logs);
								}
								else
								{
									$insert_logs = "UPDATE tblunit_statuslogs SET status = 'occupied', tenantid = '".$tenantID."' WHERE unitid = '".$inq["UnitID"]."' AND xdate = '".$refDate2."'";
									$result_logs = mysql_query($insert_logs);
								}
								$refDate2 = date( 'Y/m/d', strtotime($refDate2 . '+1 day') );
							}


							$update_unitstats = "UPDATE tblref_unit SET status = 'occupied', TenantID = '".$tenantID."' WHERE unitid = '".$inq["UnitID"]."'";
							$res_updateresstat = mysql_query($update_unitstats);



							$refDate = $inq["datefrom"];
							$chknumposted = explode("|", $_POST["chknum"]);
							$bnkposted = explode("|", $_POST["bankname"]);
							if($unit["typeofbusiness"] == "LCA")
							{
								for ($x=1; $x<=$days; $x++) {

									// $mgadate .= "<span class='pdcdate' style='font-size: 14px; color: black;'>". $refDate . "</span><label style='font-size: 14px; color: black;'> - ₱ ".$_POST['inqmonpayment'].".00</label style='font-size: 14px;'><br>";

									$refDate = date( 'Y/m/d', strtotime($refDate . '+1 day') );
									$sql_pdc = "INSERT INTO tbltrans_pdc (inquiryid, customerid, lname, fname, pdcdate, amount, checkno, bank)VALUES('". $inqid ."', '". $tenantID ."', '". $comp["owner_lastname"] ."', '". $comp["owner_firstname"] ."', '". $refDate ."', '". $unit[1] ."', '".$chknumposted[$x]."', '".$bnkposted[$x]."')";
									$result_pdc = mysql_query($sql_pdc, $connection);

								}
							}
							else
							{
								for ($x=1; $x<=$months; $x++) {

									// $mgadate .= "<span class='pdcdate' style='font-size: 14px; color: black;'>". $refDate . "</span><label style='font-size: 14px; color: black;'> - ₱ ".$_POST['inqmonpayment'].".00</label style='font-size: 14px;'><br>";

									$refDate = date( 'Y/m/d', strtotime($refDate . '+1 month') );
									$sql_pdc = "INSERT INTO tbltrans_pdc (inquiryid, customerid, lname, fname, pdcdate, amount, checkno, bank)VALUES('". $inqid ."', '". $tenantID ."', '". $comp["owner_lastname"] ."', '". $comp["owner_firstname"] ."', '". $refDate ."', '". $unit[1] ."', '".$chknumposted[$x]."', '".$bnkposted[$x]."')";
									$result_pdc = mysql_query($sql_pdc, $connection);

								}
							}
						}


						if (!file_exists("../csv/".$inq["Mall_ID"]."/" . $tenantID)) {
							mkdir("../csv/".$inq["Mall_ID"]."/" . $tenantID, 0777, true);
						}
				}

				if($_POST["unittype"] == "LCA" && $_POST["lca_unitname"] != "")
				{
					$sqlunit = "INSERT INTO tblref_unit_lca_dummy (inquiryID, appID, UnitName, width, ulength, amountpersqm, totalamountsqm, FlrName, WingID, MallID, xStat) VALUES('". $inqid ."', '', '". $_POST["lca_unitname"] ."', '". $_POST["sqm_width"] ."', '". $_POST["sqm_length"] ."', '". $_POST["persqm"] ."', '". $_POST["totalsqm"] ."', '". $_POST["unitfloor"] ."', '". $_POST["unitwing"] ."', '". $_POST["mallid"] ."', 'inquired')";
					$sqlresit = mysql_query($sqlunit, $connection);
				}
		break;

		case 'getfirstmall':
			$sql = "SELECT mallid FROM tblref_mall WHERE mallstat != '0' LIMIT 1";
			$result = mysql_query($sql, $connection);
			$row = mysql_fetch_array($result);

			echo $row["mallid"] . "|";
		break;

		case 'getstatusprint':
			$sql = "SELECT Application_ID, Status FROM tbltrans_inquiry WHERE Inquiry_ID = '".$_POST["Inquiry_ID"]."'";
			$result = mysql_query($sql, $connection);
			$row = mysql_fetch_array($result);
			if($_POST["type"] == "inquiry")
			{
				if($row["Status"] == "Pending" && $row["Application_ID"] == "")
				{
					$stat = "<span class='label label-sm label-light' style='text-decoration:underline;font-weight:bold;color: #5c8a8a !important;'>Inquired</span>";
				}
				else if($row["Application_ID"] != "" && ($row["Status"] == "Pending" || $row["Status"] == "For Approval"))
				{
					$stat = "<span class='label label-sm label-success' style='text-decoration:underline;font-weight:bold;color: #008000 !important;'>Application on process . . .</span>";
				}
				else if($row["Application_ID"] != "" && $row["Status"] == "Disapproved")
				{
					$stat = "<span class='label label-sm label-danger' style='text-decoration:underline;font-weight:bold;color: #cc2900 !important;'>Disapproved Application</span>";
				}
				else if($row["Status"] == "Tentative")
				{
					$stat = "<span class='label label-sm label-info' style='text-decoration:underline;font-weight:bold;color: #24248f !important;'>Approved</span>";
				}
				else if($row["Status"] == "Confirmed")
				{
					$stat = "<span class='label label-sm label-yellow' style='text-decoration:underline;font-weight:bold;color: #cca300 !important;'>Reserved</span>";
				}
				else if($row["Status"] == "Occupied")
				{
					$stat = "<span class='label label-sm label-warning' style='text-decoration:underline;font-weight:bold;color: #e65c00 !important;'>Occupied</span>";
				}
			}
			else if($_POST["type"] == "application")
			{
				if($row["Status"] == "Pending" && $row["Application_ID"] != "")
				{

					$stat = "<span class='label label-sm label-pink' style='text-decoration:underline;font-weight:bold;color: #D6487E !important;'>Pending Application</span>";
				}
				else if($row["Status"] == "For Approval")
				{
					$stat = "<span class='label label-sm label-sm label-success' style='text-decoration:underline;font-weight:bold;color: #009900 !important;'>For Approval</span>";
				}
				else if($row["Status"] == "Tentative")
				{
					$stat = "<span class='label label-sm label-info' style='text-decoration:underline;font-weight:bold;color: #0099ff !important;'>Approved</span>";
				}
				else if($row["Application_ID"] != "" && $row["Status"] == "Disapproved")
				{
					$stat = "<span class='label label-sm label-danger' style='text-decoration:underline;font-weight:bold;color: #ff0000 !important;'>Disapproved Application</span>";
				}
				else if($row["Status"] == "Tentative" || $row["Status"] == "Confirmed")
				{
					$stat = "<span class='label label-sm label-yellow' style='text-decoration:underline;font-weight:bold;color: #5c8a8a !important;'>Reserved</span>";
				}
				else if($row["Status"] == "Occupied")
				{
					$stat = "<span class='label label-sm label-warning' style='text-decoration:underline;font-weight:bold;color: #ff9900 !important;'>Occupied</span>";
				}
			}
			echo $stat;
		break;

		case 'loadremakrs':
			$sql = "SELECT tbltrans_remarks.remID, tbltrans_remarks.xremarks, tbluser.firstname, tbluser.middlename, tbluser.lastname, tbltrans_remarks.xdate, tbltrans_remarks.inqID FROM tbluser INNER JOIN tbltrans_remarks ON tbluser.userid = tbltrans_remarks.userID WHERE tbltrans_remarks.inqID = '".$_POST["id"]."'";
			$result = mysql_query($sql, $connection);
			while($row = mysql_fetch_array($result))
			{
			echo "<li class='dd-item dd2-item' id='module_1' style='cursor: pointer;'>
				    <div class='dd2-content'><small style='width:80%;font-size: 85%;display: inline-block;color:black !important;text-align:justify'>".$row["xremarks"]."</small>
				       <a href='#' title='Edit Company Profile' class='btnedit' style='float:right;padding-left:2px;display: inline-block;' onclick='edittranremarks(\"".$row["remID"]."\", \"".$row["inqID"]."\");'><i class='ace-icon fa fa-pencil' style='font-size:15px;'></i></a>
				       <a href='#' title='Delete Company Profile' class='btnedit' style='float:right;padding-left:2px;padding-right:4px;font-size:15px;display: inline-block;' onclick='deletetranremarks(\"".$row["remID"]."\", \"".$row["inqID"]."\");'><i class='ace-icon fa fa-remove' style='color:#b30000;'></i></a>
				       <br />
				       <br /><text style='font-size: 80%;font-weight: normal;margin:0px;'>Added by: ".$row["firstname"]." ".$row["lastname"]."</text><br />
				       		<text style='font-size: 80%;font-weight: normal;margin:0px;'>Date Added: ".date("F d, Y h:i:s A", strtotime($row["xdate"]))."</text>
				       	<br />
				    </div>
				  </li>";
			}
		break;

		case 'savenewremark':
			$datenow = getsysdate();
			if($_POST["remID"] == "")
			{
				$remid = createidno("REM", "tbltrans_remarks", "remID");
				$sql = "INSERT INTO tbltrans_remarks(remID, inqID, xremarks, xdate, userID)VALUES('". $remid ."', '". $_POST["inqID"] ."', '". $_POST["remarks"] ."', '". date($datenow." H:i:s") ."', '". $_COOKIE["userid"] ."')";
				$result = mysql_query($sql, $connection);

				if($result == true)
				{
					echo 1;
				}
			}
			else
			{
				$sql = "UPDATE tbltrans_remarks SET xremarks = '". $_POST["remarks"] ."' WHERE remID = '".$_POST["remID"]."'";
				$result = mysql_query($sql, $connection);

				if($result == true)
				{
					echo 2;
				}
			}
		break;

		case 'edittranremarks':
			$sql = "SELECT xremarks FROM tbltrans_remarks WHERE remID = '".$_POST["remID"]."'";
			$result = mysql_query($sql, $connection);
			$row = mysql_fetch_array($result);

			echo $row["xremarks"];
		break;

		case 'deletetranremarks':
			$sql = "DELETE FROM tbltrans_remarks WHERE remID = '".$_POST["remID"]."'";
			$result = mysql_query($sql, $connection);
			if($result == true)
			{
				echo 1;
			}
		break;

		case 'viewhistoryinquirydisplay':
			$sql = " SELECT username, mydate, mytime, module, xaction FROM tbllogs_per_trans WHERE inqID = '". $_POST['inqidnglogs'] ."' ";
			$res = mysql_query($sql, $connection);
			while($row = mysql_fetch_array($res)){
				?>
				<tr>
					<td width="20%"><?php echo $row[0]; ?></td>
					<td width="20%"><?php echo $row[1]; ?></td>
					<td width="20%"><?php echo $row[2]; ?></td>
					<td width="20%"><?php echo $row[3]; ?></td>
					<td width="20%"><?php echo $row[4]; ?></td>
				</tr>
				<?php
			}
		break;

		case 'viewhistoryleasingdisplay':
			$sql = " SELECT username, mydate, mytime, module, xaction FROM tbllogs_per_trans WHERE inqID = '". $_POST['inqidnglogsleasing'] ."' ";
			$res = mysql_query($sql, $connection);
			while($row = mysql_fetch_array($res)){
				?>
				<tr>
					<td width="20%"><?php echo $row[0]; ?></td>
					<td width="20%"><?php echo $row[1]; ?></td>
					<td width="20%"><?php echo $row[2]; ?></td>
					<td width="20%"><?php echo $row[3]; ?></td>
					<td width="20%"><?php echo $row[4]; ?></td>
				</tr>
				<?php
			}
		break;

		case 'viewhistoryreservationdisplay':
			$sql = " SELECT username, mydate, mytime, module, xaction FROM tbllogs_per_trans WHERE inqID = '". $_POST['inqidnglogsreservation'] ."' ";
			$res = mysql_query($sql, $connection);
			while($row = mysql_fetch_array($res)){
				?>
				<tr>
					<td width="20%"><?php echo $row[0]; ?></td>
					<td width="20%"><?php echo $row[1]; ?></td>
					<td width="20%"><?php echo $row[2]; ?></td>
					<td width="20%"><?php echo $row[3]; ?></td>
					<td width="20%"><?php echo $row[4]; ?></td>
				</tr>
				<?php
			}
		break;

		case 'loadalllcaunit':
		echo "<option value=''>-- Select Unit --</option>";
    		$queryind = "SELECT unitid, unitname FROM tblref_unit WHERE typeofbusiness = 'LCA'";
            $rsss = mysql_query($queryind, $connection);
            while($row = mysql_fetch_array($rsss)){
              $industry = "<option value='".$row['unitid']."'>".$row['unitname']."</option>";

              echo $industry;
            }
		break;

		case 'getheaderprint':
			$template = mysql_fetch_array(mysql_query("SELECT template FROM tblsys_setup2"));
			$row = mysql_fetch_array(mysql_query("SELECT mallname, malladdress, telephone_number, email, mall_image FROM tblref_mall WHERE mallid = '".$_POST["mallID"]."'"));
			if($template[0] == "1")
			{
				echo "<tr>
				      	<td width='130px;padding:0px !important;'><img src='server/mall_image/".$row[4]." ' style='height: 130px; width: 120px;'></td>
				      	<td style='padding-top:0px;'>
				      		<p style='padding: 0px; display: block;margin:0px;' class='companyname'><h2>".$row[0]."</h2></p>
				      		<p style='padding: 0px; display: block;margin:0px;' class='companyaddress'>".$row[1]."</p>
				      		<p style='padding: 0px; display: block;margin:0px;' class='companynumber'>".$row[2]."</p>
				      		<p style='padding: 0px; display: block;margin:0px;' class='companywebsite'>".$row[3]."</p>
				      	</td>
				      </tr>";
			}
			else
			{
				echo "<tr>
					  	<td colspan='3' align='center'><img src='server/mall_image/".$row[5]." ' style='height: 130px; width: 120px;'></td>
					  </tr>
					  <tr>
					  	<td colspan='3' align='center'>
					  		<p style='padding: 0px; display: block;margin:0px;' class='companyname'><h2>".$row[0]."</h2></p>
					  		<p style='padding: 0px; display: block;margin:0px;' class='companyaddress'>".$row[1]."</p>
					  		<p style='padding: 0px; display: block;margin:0px;' class='companynumber'>".$row[2]."</p>
					  		<p style='padding: 0px; display: block;margin:0px;' class='companywebsite'>".$row[3]."</p>
					  	</td>
					  </tr>";
			}
		break;

		case 'endofcontract':
		$arr = explode("#", $_POST["val"]);
		for($i=0;$i<=count($arr)-1;$i++)
		{
			$sql = "SELECT TenantID, unitID FROM tbltrans_tenants WHERE dateto <= '". date("Y/m/d") ."' AND Status = 'actived' AND ustatus = 'occupied' AND TenantID = '".$arr[$i]."'";
			$result = mysql_query($sql, $connection);
			while($row = mysql_fetch_array($result))
			{
				$endo = mysql_query("UPDATE tbltrans_tenants SET Status = 'endofcon' WHERE TenantID = '".$row["TenantID"]."'");
				$vacant = mysql_query("UPDATE tblref_unit SET status = 'vacant' WHERE unitid = '".$row["unitID"]."'");

				echo $row["TenantID"] . "|";
			}
		}
		break;

		case 'tblendofcontract':
		if($_POST["key"] != "")
		{
			$filter = " AND tradename LIKE '%".$_POST["key"]."%'";
		}
		else
		{
			$filter = "";
		}
			$getendonum = mysql_fetch_array(mysql_query("SELECT endodaynot FROM tblsys_setup2"));
			if(intval($getendonum["endodaynot"]) > 0)
			{
				$daysNOT = "dateto <= '". date("Y/m/d", strtotime("+".$getendonum["endodaynot"]." days")) ."' OR";
			}
			else
			{
				$daysNOT = "dateto <= '". date("Y/m/d") ."' AND";
			}

			$sql = "SELECT TenantID, unitID, tradename, dateto FROM tbltrans_tenants WHERE (".$daysNOT." dateto <= '". date("Y/m/d") ."') AND Status = 'actived' AND ustatus = 'occupied'".$filter;
			$result = mysql_query($sql, $connection);
			while($row = mysql_fetch_array($result))
			{
				$datestr=date("Y-m-d", strtotime($row["dateto"]))." 00:00:00";//Your date
				$date=strtotime($datestr);//Converted to a PHP date (a second count)

				//Calculate difference
				$diff=$date-time();//time returns current time in seconds
				$days=floor($diff/(60*60*24));//seconds/minute*minutes/hour*hours/day)
				$hours=round(($diff-$days*60*60*24)/(60*60));
					if($days > 0)
					{
						$days2 = $days . " days";
					}
					else
					{
						$days2 = "";
					}

					if($hours > 0)
					{
						$hours2 = $hours . " hours";
					}
					else
					{
						$hours2 = "";
					}

				if($row["dateto"] < date("Y/m/d"))
				{
					$checkbox = "<label>
		                              <input name='form-field-checkbox' class='ace chk_endo' type='checkbox' value='".$row["TenantID"]."' id=''>
		                              <span class='lbl'></span>
		                          </label>";
		            $days2 = "0 days";
					$hours2 = "0 hours";
				}
				else
				{
					$checkbox = "";
					if($days > 0)
					{
						$days2 = $days . " days";
					}
					else
					{
						$days2 = "";
					}

					if($hours > 0)
					{
						$hours2 = $hours . " hours";
					}
					else
					{
						$hours2 = "";
					}
				}

				echo " <tr>
                        <td style='background-color: #f2f2f2 !important;color:#707070;width:20px;padding:5px;text-align:center;'>
                          ".$checkbox."
                        </td>
                        <td style='font-weight:400;font-size:12px;padding:5px;'>".$row["tradename"]."</td>
                        <td style='font-weight:400;font-size:12px;padding:5px;'>".date("F d, Y", strtotime($row["dateto"]))."</td>
                        <td style='font-weight:400;font-size:12px;padding:5px;'>".$days2." ".$hours2."</td>
                      </tr>";
			}
		break;

		case 'tblpenalizeten':
				$datenow = getsysdate();
    			$allduedate = "";
    			$sql = "SELECT month_period, year_period, DueDate FROM tbltrans_processedbill WHERE gen_xstat = '1' OR gen_xstat = '2'";
    			$result = mysql_query($sql, $connection);
    			while($row = mysql_fetch_array($result))
    			{
    				$allduedate .= $row["month_period"] . "|" . $row["year_period"] . "|" . $row["DueDate"] . "#";
    			}

    			// echo $allduedate;
    			$dates = explode("#", $allduedate);
    			for($x=0; $x<=count($dates)-2; $x++)
    			{
    				$arr = explode("|", $dates[$x]);
	    			if(date("Y-m-d", strtotime($arr[2])) < $datenow)
	    			{
	    				if($_POST["key"] != "")
						{
							$filter = " AND tradename LIKE '%".$_POST["key"]."%'";
						}
						else
						{
							$filter = "";
						}

		    			$alltenants = "SELECT TenantID, costpermonths, tradename FROM tbltrans_tenants WHERE Status = 'actived' AND ustatus = 'occupied'".$filter;
		    			$resulttenants = mysql_query($alltenants, $connection);
		    			while($tenantss = mysql_fetch_array($resulttenants))
		    			{
							$percentpenalty = mysql_fetch_array(mysql_query("SELECT chrgpenalpercent FROM tblref_charges WHERE chrgpenaltytype = 'Monthly'"));

							$month = $arr[0];
							$year = $arr[1];

							// **************************************************************************************
							$getbalance = mysql_fetch_array(mysql_query("SELECT SUM(balance) FROM tbltransaction WHERE tenantid = '".$tenantss['TenantID']."' AND balance != '0.00' AND description = 'Monthly Rental' AND (MONTH(xdate) = '".$month."' AND YEAR(xdate) = '".$year."')"));

							$getperiod = mysql_fetch_array(mysql_query("SELECT datefrom, dateto FROM tbltrans_processedbill WHERE month_period = '".$month."' AND year_period = '".$year."'"));
							$header = explode("|", getrentvattype());
							$vatpercent = floatval($header[5]) / 100;

							if($header[6] == "yes")
							{
								if($header[4] == "percent")
								{
									if($header[7] == "inc")
									{
										$penalty_percentage = floatval($header[9]) / 100;
										$penalty = $penalty_percentage * floatval($getbalance[0]);
										$vat_pen = $penalty * (floatval($header[5]) / 100);
										$bef_vat_pen = $penalty - $vat_pen;
										$ttll = $vat_pen + $bef_vat_pen;
									}
									else
									{
										$penalty_percentage = floatval($header[5]) / 100;
										$penalty = $penalty_percentage * floatval($getbalance[0]);
										$vat_pen = $penalty * (floatval($header[5]) / 100);
										$bef_vat_pen = $penalty + $vat_pen;
										$ttll = $vat_pen + $bef_vat_pen;
									}
								}
								else
								{
									if($header[7] == "inc")
									{
										$penalty = floatval($header[8]);
										$vat_pen = $penalty * (floatval($header[5]) / 100);
										$bef_vat_pen = $penalty - $vat_pen;
										$ttll = $vat_pen + $bef_vat_pen;
									}
									else
									{
										$penalty = floatval($header[8]);
										$vat_pen = $penalty * (floatval($header[5]) / 100);
										$bef_vat_pen = $penalty + $vat_pen;
										$ttll = $vat_pen + $bef_vat_pen;
									}
								}
							}
							else
							{
									$penalty_percentage = floatval($percentpenalty["chrgpenalpercent"])/100;
									$ttll = floatval($getbalance[0]);
									$penalty = $penalty_percentage * $ttll;
							}

							// **************************************************************************************
							$chargetomonth = date( 'Y-m-d', strtotime($year . "-" . $month . "-1" . '+1 month') );


							$sql_cnt = mysql_fetch_array(mysql_query("SELECT COUNT(tenantid) FROM tbltransaction WHERE tenanttype = '".$arr[0]."|".$arr[1]."' AND tenantid = '".$tenantss['TenantID']."'"));
			    			if($sql_cnt[0] == 0)
			    			{
								if($getbalance[0] != 0)
								{
									echo "<tr>
					                        <td style='background-color: #f2f2f2 !important;color:#707070;width:20px;padding:5px;'>
					                          <label>
					                              <input name='form-field-checkbox' class='ace chk_pena' type='checkbox' value='".$month."|".$year."|".$tenantss['TenantID']."' id=''>
					                              <span class='lbl'></span>
					                          </label>
					                        </td>
					                        <td style='font-weight:400;font-size:12px;padding:5px;'>".$tenantss["tradename"]."</td>
					                        <td style='font-weight:400;font-size:12px;padding:5px;'>Penalty for the month of " . date("F", mktime(0, 0, 0, $arr[0], 10)) ."</td>
					                        <td style='font-weight:400;font-size:12px;padding:5px;text-align: right;'>".number_format($ttll, 2, '.', ',')."</td>
					                      </tr>";
								}
							}

		    			}
	    			}

    			}
    		break;

		case 'getnum_not':
			$datenow = getsysdate();
		// end of contract count
			$endo = mysql_fetch_array(mysql_query("SELECT COUNT(TenantID) FROM tbltrans_tenants WHERE dateto <= '". date("Y/m/d") ."' AND Status = 'actived' AND ustatus = 'occupied'"));

		// tenants to be penalized count
			$penalized = 0;
			$allduedate = "";
    		$sql = "SELECT month_period, year_period, DueDate FROM tbltrans_processedbill WHERE gen_xstat = '1' OR gen_xstat = '2'";
    		$result = mysql_query($sql, $connection);
    		while($row = mysql_fetch_array($result))
    		{
    			$allduedate .= $row["month_period"] . "|" . $row["year_period"] . "|" . $row["DueDate"] . "#";
    		}

    		$dates = explode("#", $allduedate);
    		for($x=0; $x<=count($dates)-2; $x++)
    		{
    			$arr = explode("|", $dates[$x]);
	    		if(date("Y-m-d", strtotime($arr[2])) < $datenow)
	    		{
		    		$alltenants = "SELECT TenantID, costpermonths FROM tbltrans_tenants WHERE Status = 'actived' AND ustatus = 'occupied'";
		    		$resulttenants = mysql_query($alltenants, $connection);
		    		while($tenantss = mysql_fetch_array($resulttenants))
		    		{

						$month = $arr[0];
						$year = $arr[1];

						$getbalance = mysql_fetch_array(mysql_query("SELECT SUM(balance) FROM tbltransaction WHERE tenantid = '".$tenantss['TenantID']."' AND balance != '0.00' AND (MONTH(xdate) = '".$month."' AND YEAR(xdate) = '".$year."')"));

						$sql_cnt = mysql_fetch_array(mysql_query("SELECT COUNT(tenantid) FROM tbltransaction WHERE tenanttype = '".$arr[0]."|".$arr[1]."' AND tenantid = '".$tenantss['TenantID']."'"));

						if($sql_cnt[0] == 0)
						{
							if($getbalance[0] != 0)
							{
								$penalized++;
							}
						}

		    		}
	    		}
    		}

    		$ttl = floatval($penalized) + floatval($endo[0]);
    		echo $ttl . "|" . $penalized . "|" . $endo[0] . "|". $allduedate;
		break;

		case 'chkmerchntcode':
			$getcount = mysql_fetch_array(mysql_query("SELECT COUNT(merchant_code) FROM tbltrans_inquiry WHERE merchant_code = '".$_POST["code"]."' AND Application_ID != '".$_POST["Application_ID"]."'"));
			if($getcount[0] == 0)
			{
				echo "not_existing";
			}
			else
			{
				echo "existing";
			}
		break;

		case 'chkmerchntcode2':
			$getcount = mysql_fetch_array(mysql_query("SELECT COUNT(merchant_code) FROM tbltrans_inquiry WHERE merchant_code = '".$_POST["code"]."'"));
			if($getcount[0] == 0)
			{
				echo "not_existing";
			}
			else
			{
				echo "existing";
			}
		break;

		case 'savesoasign':
		$cnt = mysql_fetch_array(mysql_query("SELECT COUNT(mall_id) FROM mall_setup WHERE mall_id = '".$_POST["mallid"]."'"));
		if($cnt[0] == 0)
		{
			$sql = mysql_query("INSERT INTO mall_setup (prepby, chkdby, apprby, rcvdby, mall_id) VALUES('".$_POST["prep"]."', '".$_POST["chkd"]."', '".$_POST["appr"]."', '".$_POST["rcvd"]."', '".$_POST["mallid"]."')");
			if($sql == true)
			{
				echo 1;
			}
		}
		else
		{
			$sql = mysql_query("UPDATE mall_setup SET prepby = '".$_POST["prep"]."', chkdby = '".$_POST["chkd"]."', apprby = '".$_POST["appr"]."', rcvdby = '".$_POST["rcvd"]."' WHERE mall_id = '".$_POST["mallid"]."'");
			if($sql == true)
			{
				echo 2;
			}
		}
		break;

		case 'load_billsetup':
			$sql = mysql_fetch_array(mysql_query("SELECT prepby, chkdby, apprby, rcvdby, mall_id, vatable_rent, vat_rent_type, vat_rent_prcnt, vatable_penalty, vat_penalty_type, vat_penalty_prcnt, penalty_type, penalty_amount, penalty_percent, elec_amnt, watr_amnt, pstc_amnt, associationdues, depositperc FROM mall_setup WHERE mall_id = '".$_POST["mallid"]."'"));
			echo $sql["prepby"] ."#". $sql["chkdby"] ."#". $sql["apprby"] ."#". $sql["rcvdby"] ."#". $sql["mall_id"] . "#" . $sql["vatable_rent"] ."#". $sql["vat_rent_type"] ."#". $sql["vat_rent_prcnt"] ."#". $sql["vatable_penalty"] ."#". $sql["vat_penalty_type"] ."#". $sql["vat_penalty_prcnt"] ."#". $sql["penalty_type"] ."#". number_format($sql["penalty_amount"], 2, '.', ',') ."#". $sql["penalty_percent"]."#".number_format($sql["elec_amnt"], 2, '.', ',')."#".number_format($sql["watr_amnt"], 2, '.', ',')."#".number_format($sql["pstc_amnt"], 2, '.', ',')."#".number_format($sql["associationdues"], 2, '.', ',')."#".$sql[18];
		break;

		case 'save_vat_penalty_setup':
			$cnt = mysql_fetch_array(mysql_query("SELECT COUNT(mall_id) FROM mall_setup WHERE mall_id = '".$_POST["mallid"]."'"));
			if($cnt[0] == 0)
			{
				$sql = mysql_query("INSERT INTO mall_setup (vatable_rent, vat_rent_type, vat_rent_prcnt, vatable_penalty, vat_penalty_type, vat_penalty_prcnt, penalty_type, penalty_amount, penalty_percent, mall_id, depositperc) VALUES('".$_POST["rent_vatable"]."', '".$_POST["rent_vattype"]."', '".$_POST["rent_vatperc"]."', '".$_POST["penalty_vatable"]."', '".$_POST["penalty_vattype"]."', '".$_POST["penalty_vatperc"]."', '".$_POST["penalty_type"]."', '".$_POST["penalty_amt"]."', '".$_POST["penalty_perc"]."', '".$_POST["mallid"]."', '". $_POST['deposit_perc'] ."')");
				if($sql == true)
				{
					echo 1;
				}
			}
			else
			{
				$sql = mysql_query("UPDATE mall_setup SET vatable_rent = '".$_POST["rent_vatable"]."', vat_rent_type = '".$_POST["rent_vattype"]."', vat_rent_prcnt = '".$_POST["rent_vatperc"]."', vatable_penalty = '".$_POST["penalty_vatable"]."', vat_penalty_type = '".$_POST["penalty_vattype"]."', vat_penalty_prcnt = '".$_POST["penalty_vatperc"]."', penalty_type = '".$_POST["penalty_type"]."', penalty_percent = '".$_POST["penalty_perc"]."', penalty_amount = '".$_POST["penalty_amt"]."', depositperc = '". $_POST['deposit_perc'] ."' WHERE mall_id = '".$_POST["mallid"]."'");
				if($sql == true)
				{
					echo 2;
				}
			}
		break;

		case 'savemaintenance_setup':
			$cnt = mysql_fetch_array(mysql_query("SELECT COUNT(mall_id) FROM mall_setup WHERE mall_id = '".$_POST["mallid"]."'"));
			if($cnt[0] == 0)
			{
				$sql = mysql_query("INSERT INTO mall_setup (elec_amnt, watr_amnt, pstc_amnt, mall_id) VALUES('".$_POST["elec"]."', '".$_POST["water"]."', '".$_POST["pestcon"]."', '".$_POST["mallid"]."')");
				if($sql == true)
				{
					echo 1;
				}
			}
			else
			{
				$sql = mysql_query("UPDATE mall_setup SET elec_amnt = '".$_POST["elec"]."', watr_amnt = '".$_POST["water"]."', pstc_amnt = '".$_POST["pestcon"]."' WHERE mall_id = '".$_POST["mallid"]."'");
				if($sql == true)
				{
					echo 2;
				}
			}
		break;

		case 'loadallontimeandlate':
			$year = date("Y");
			$sql_date = mysql_query("SELECT datefrom, dateto, DueDate, year_period, month_period FROM tbltrans_processedbill WHERE year_period = '".$year."' ORDER BY month_period ASC");
			while($date = mysql_fetch_array($sql_date))
			{
				// $sql = mysql_query("SELECT TenantID FROM tbltrans_tenants WHERE ((datefrom = '".date("Y/m/d", strtotime($date["datefrom"]))."' AND dateto = '".date("Y/m/d", strtotime($date["dateto"]))."') OR (datefrom > '".date("Y/m/d", strtotime($date["datefrom"]))."' AND dateto > '".date("Y/m/d", strtotime($date["dateto"]))."' AND datefrom < '".date("Y/m/d", strtotime($date["dateto"]))."') OR (datefrom > '".date("Y/m/d", strtotime($date["datefrom"]))."' AND dateto < '".date("Y/m/d", strtotime($date["dateto"]))."') OR (datefrom > '".date("Y/m/d", strtotime($date["datefrom"]))."' AND dateto > '".date("Y/m/d", strtotime($date["datefrom"]))."' AND dateto < '".date("Y/m/d", strtotime($date["dateto"]))."') OR(datefrom < '".date("Y/m/d", strtotime($date["datefrom"]))."' AND dateto > '".date("Y/m/d", strtotime($date["dateto"]))."'))");
				// while($tenant = mysql_fetch_array($sql))
				// {
					// getting balance of date selected / considered as late payment
					$sqlpayment = mysql_query("SELECT SUM(ontimepayment), SUM(latepayment) FROM tbltransaction WHERE paymenttype = '' AND xdate = '".$date["year_period"]."-".$date["month_period"]."-1'");
					$pay = mysql_fetch_array($sqlpayment);
					echo date("F", mktime(0, 0, 0, $date["month_period"], 10)) . "|" . $pay[0] . "|" . $pay[1] . "#";
				// }
			}
		break;

		case 'loaddrilldownlateontime':
			$year = date("Y");
			$sqlpayment = mysql_query("SELECT tbltransaction.latepayment, tbltransaction.ontimepayment, tbltransaction.description, tbltrans_tenants.tradename , tbltransaction.".$_POST["amtval"]." FROM tbltransaction INNER JOIN tbltrans_tenants ON tbltrans_tenants.TenantID = tbltransaction.tenantid WHERE tbltransaction.paymenttype = '' AND xdate = '".$year."/".date("m", strtotime($_POST["month"]))."/1'".$_POST["cond"]."' AND tbltrans_tenants.tradename LIKE '%".$_POST["key"]."%'");
			while($pay = mysql_fetch_array($sqlpayment))
			{
				if($_POST["amtval"] == "latepayment")
				{
					$clr = "#df6c07";
				}
				else
				{
					$clr = "#0a6cf5";
				}
				echo "<tr>
	                    <td style='font-weight:400;font-size:12px;padding:5px;'>".$pay["tradename"]."</td>
	                    <td style='font-weight:400;font-size:12px;padding:5px;'>".$pay["description"]."</td>
	                    <td style='font-weight:400;font-size:12px;padding:5px;text-align:right;color:".$clr."'>".number_format($pay[4], 2, '.', ',')."</td>
	                  </tr>";
			}
		break;

		case 'showmallpermits':
			$sqlmall = " SELECT mallname, mallid FROM tblref_mall WHERE mallstat = '1' ";
			$resmall = mysql_query($sqlmall, $connection);
			while($rowmall = mysql_fetch_array($resmall)){
				?>
					<div class="widget-box widget-color-blue collapsed" id="widget-box-4">
						<div class="widget-header widget-header-large">
							<h4 class="widget-title"><?php echo $rowmall[0]; ?></h4>

							<div class="widget-toolbar">
								<a href="#" data-action="collapse">
									<i class="ace-icon fa fa-chevron-down"></i>
								</a>
							</div>
						</div>

						<div class="widget-body" style="display: none;">
							<div class="widget-main">
							<div class="row">
									<div class="col-xs-12" style="overflow-x: scroll;display: block;">
										<table class="table table-bordered table-striped">
											<thead>
												<tr>
													<td align="center"></td>
													<td align="center">Building Insurance</td>
													<td align="center">Business Permit</td>
													<td align="center">Sanitary Permit</td>
													<td align="center">Mechanical Certificate</td>
													<td align="center">Electrical Certificate</td>
													<td align="center">Discharge Permit</td>
													<td align="center">FSIC</td>
													<td align="center">Permit To Operate Elevator</td>
													<td align="center">Combustible Clearance</td>
													<td align="center">Permit To Operate Gen Set</td>
													<td align="center">DENR Permit</td>
													<td align="center">Water Test</td>
													<td align="center">RPT</td>
													<td align="center">Option</td>
												</tr>
											</thead>
							<?php
			$sql = " SELECT TenantID, tradename, Bldng_Insurance, Business_Permit, Sanitary_Permit, Mech_Cert, Elec_Cert, Discharge_Permit, FSIC, Permit_To_Op_Elev, Combustible_Clearance, Permit_To_Op_GenSet, DENR_Permit, Water_Test, RPT FROM tbltrans_tenants WHERE mallid = '". $rowmall[1] ."' ";
			$res = mysql_query($sql, $connection);
			while($row = mysql_fetch_array($res)){
				?>



											<tr>
												<td align="center" style="white-space: nowrap;"> <?php echo $row[1]; ?> </td>
												<td align="center" style="white-space: nowrap;<?php if($row[2] <=  date('Y-m-d')){echo "background-color:#ff6666;"; }else if($row[2] <= date('Y-m-d', strtotime('+30 days'))){ echo "background-color:#ffff66;";  }else{echo "background-color:#8fbcd6;"; }?>" id="<?php echo "Bldng_Insurance".$row[0]; ?>"> <?php echo $row[2]; ?> </td>
												<td align="center" style="white-space: nowrap;<?php if($row[3] <=  date('Y-m-d')){echo "background-color:#ff6666;"; }else if($row[3] <= date('Y-m-d', strtotime('+30 days'))){ echo "background-color:#ffff66;";  }else{echo "background-color:#8fbcd6;"; }?>" id="<?php echo "Business_Permit".$row[0]; ?>"> <?php echo $row[3]; ?> </td>
												<td align="center" style="white-space: nowrap;<?php if($row[4] <=  date('Y-m-d')){echo "background-color:#ff6666;"; }else if($row[4] <= date('Y-m-d', strtotime('+30 days'))){ echo "background-color:#ffff66;";  }else{echo "background-color:#8fbcd6;"; }?>" id="<?php echo "Sanitary_Permit".$row[0]; ?>"> <?php echo $row[4]; ?> </td>
												<td align="center" style="white-space: nowrap;<?php if($row[5] <=  date('Y-m-d')){echo "background-color:#ff6666;"; }else if($row[5] <= date('Y-m-d', strtotime('+30 days'))){ echo "background-color:#ffff66;";  }else{echo "background-color:#8fbcd6;"; }?>" id="<?php echo "Mech_Cert".$row[0]; ?>"> <?php echo $row[5]; ?> </td>
												<td align="center" style="white-space: nowrap;<?php if($row[6] <=  date('Y-m-d')){echo "background-color:#ff6666;"; }else if($row[6] <= date('Y-m-d', strtotime('+30 days'))){ echo "background-color:#ffff66;";  }else{echo "background-color:#8fbcd6;"; }?>" id="<?php echo "Elec_Cert".$row[0]; ?>"> <?php echo $row[6]; ?> </td>
												<td align="center" style="white-space: nowrap;<?php if($row[7] <=  date('Y-m-d')){echo "background-color:#ff6666;"; }else if($row[7] <= date('Y-m-d', strtotime('+30 days'))){ echo "background-color:#ffff66;";  }else{echo "background-color:#8fbcd6;"; }?>" id="<?php echo "Discharge_Permit".$row[0]; ?>"> <?php echo $row[7]; ?> </td>
												<td align="center" style="white-space: nowrap;<?php if($row[8] <=  date('Y-m-d')){echo "background-color:#ff6666;"; }else if($row[8] <= date('Y-m-d', strtotime('+30 days'))){ echo "background-color:#ffff66;";  }else{echo "background-color:#8fbcd6;"; }?>" id="<?php echo "FSIC".$row[0]; ?>"> <?php echo $row[8]; ?> </td>
												<td align="center" style="white-space: nowrap;<?php if($row[9] <=  date('Y-m-d')){echo "background-color:#ff6666;"; }else if($row[9] <= date('Y-m-d', strtotime('+30 days'))){ echo "background-color:#ffff66;";  }else{echo "background-color:#8fbcd6;"; }?>" id="<?php echo "Permit_To_Op_Elev".$row[0]; ?>"> <?php echo $row[9]; ?> </td>
												<td align="center" style="white-space: nowrap;<?php if($row[10] <=  date('Y-m-d')){echo "background-color:#ff6666;"; }else if($row[10] <= date('Y-m-d', strtotime('+30 days'))){ echo "background-color:#ffff66;";  }else{echo "background-color:#8fbcd6;"; }?>" id="<?php echo "Combustible_Clearance".$row[0]; ?>"> <?php echo $row[10]; ?> </td>
												<td align="center" style="white-space: nowrap;<?php if($row[11] <=  date('Y-m-d')){echo "background-color:#ff6666;"; }else if($row[11] <= date('Y-m-d', strtotime('+30 days'))){ echo "background-color:#ffff66;";  }else{echo "background-color:#8fbcd6;"; }?>" id="<?php echo "Permit_To_Op_GenSet".$row[0]; ?>"> <?php echo $row[11]; ?> </td>
												<td align="center" style="white-space: nowrap;<?php if($row[12] <=  date('Y-m-d')){echo "background-color:#ff6666;"; }else if($row[12] <= date('Y-m-d', strtotime('+30 days'))){ echo "background-color:#ffff66;";  }else{echo "background-color:#8fbcd6;"; }?>" id="<?php echo "DENR_Permit".$row[0]; ?>"> <?php echo $row[12]; ?> </td>
												<td align="center" style="white-space: nowrap;<?php if($row[13] <=  date('Y-m-d')){echo "background-color:#ff6666;"; }else if($row[13] <= date('Y-m-d', strtotime('+30 days'))){ echo "background-color:#ffff66;";  }else{echo "background-color:#8fbcd6;"; }?>" id="<?php echo "Water_Test".$row[0]; ?>"> <?php echo $row[13]; ?> </td>
												<td align="center" style="white-space: nowrap;<?php if($row[14] <=  date('Y-m-d')){echo "background-color:#ff6666;"; }else if($row[14] <= date('Y-m-d', strtotime('+30 days'))){ echo "background-color:#ffff66;";  }else{echo "background-color:#8fbcd6;"; }?>" id="<?php echo "RPT".$row[0]; ?>"> <?php echo $row[14]; ?> </td>
												<td width="10%" align="center" style="white-space: nowrap;">
													<div class="btn-group">
														<button class="btn btn-minier btn-info" onclick='enableedit123("<?php echo $row[0]; ?>")' id='edit<?php echo $row[0]; ?>'><i class="fa fa-pencil"></i></button>
													</div>
												</td>
											</tr>

						<?php
			}
						?>
																		</table>
									</div>
								</div>
							</div>
						</div>
					</div>
				<?php
			}
		break;

		case 'showmallpermitsnoti':
			$i = 0;
			$sql = " SELECT TenantID, tradename, Bldng_Insurance, Business_Permit, Sanitary_Permit, Mech_Cert, Elec_Cert, Discharge_Permit, FSIC, Permit_To_Op_Elev, Combustible_Clearance, Permit_To_Op_GenSet, DENR_Permit, Water_Test, RPT FROM tbltrans_tenants ";
			$res = mysql_query($sql, $connection);
			while($row = mysql_fetch_array($res)){
				?>

						<?php if($row[2] <= date("Y-m-d")){ $i++; } ?>
						<?php if($row[3] <= date("Y-m-d")){ $i++; } ?>
						<?php if($row[4] <= date("Y-m-d")){ $i++; } ?>
						<?php if($row[5] <= date("Y-m-d")){ $i++; } ?>
						<?php if($row[6] <= date("Y-m-d")){ $i++; } ?>
						<?php if($row[7] <= date("Y-m-d")){ $i++; } ?>
						<?php if($row[8] <= date("Y-m-d")){ $i++; } ?>
						<?php if($row[9] <= date("Y-m-d")){ $i++; } ?>
						<?php if($row[10] <= date("Y-m-d")){ $i++; } ?>
						<?php if($row[11] <= date("Y-m-d")){ $i++; } ?>
						<?php if($row[12] <= date("Y-m-d")){ $i++; } ?>
						<?php if($row[13] <= date("Y-m-d")){ $i++; } ?>
						<?php if($row[14] <= date("Y-m-d")){ $i++; } ?>
				<?php
			}

			echo $i;
		break;

		case 'enableedit':
			$sql = " SELECT TenantID, tradename, Bldng_Insurance, Business_Permit, Sanitary_Permit, Mech_Cert, Elec_Cert, Discharge_Permit, FSIC, Permit_To_Op_Elev, Combustible_Clearance, Permit_To_Op_GenSet, DENR_Permit, Water_Test, RPT FROM tbltrans_tenants WHERE TenantID = '". $_POST['mallid'] ."' ";
			$res = mysql_query($sql, $connection);
			$row = mysql_fetch_array($res);

			echo
			date('Y-m-d', strtotime($row[2]))  . "|" . date('Y-m-d', strtotime($row[3]))  . "|" . date('Y-m-d', strtotime($row[4]))  . "|" . date('Y-m-d', strtotime($row[5]))  . "|" . date('Y-m-d', strtotime($row[6]))  . "|" . date('Y-m-d', strtotime($row[7]))  . "|" . date('Y-m-d', strtotime($row[8]))  . "|" . date('Y-m-d', strtotime($row[9]))  . "|" . date('Y-m-d', strtotime($row[10]))  . "|" . date('Y-m-d', strtotime($row[11]))  . "|" . date('Y-m-d', strtotime($row[12]))  . "|" . date('Y-m-d', strtotime($row[13]))  . "|" . date('Y-m-d', strtotime($row[14])) . "|" . $row[1];
		break;

		case 'sendconfirm':
			$sql = " UPDATE tbltrans_tenants SET Bldng_Insurance = '". $_POST['Bldng_Insurance'] ."', Business_Permit = '". $_POST['Business_Permit'] ."', Sanitary_Permit = '". $_POST['Sanitary_Permit'] ."', Mech_Cert = '". $_POST['Mech_Cert'] ."', Elec_Cert = '". $_POST['Elec_Cert'] ."', Discharge_Permit = '". $_POST['Discharge_Permit'] ."', FSIC = '". $_POST['FSIC'] ."', Permit_To_Op_Elev = '". $_POST['Permit_To_Op_Elev'] ."', Combustible_Clearance = '". $_POST['Combustible_Clearance'] ."', Permit_To_Op_GenSet = '". $_POST['Permit_To_Op_GenSet'] ."', DENR_Permit = '". $_POST['DENR_Permit'] ."', Water_Test = '". $_POST['Water_Test'] ."', RPT = '". $_POST['RPT'] ."' WHERE TenantID = '". $_POST['mallid'] ."' ";
			$res = mysql_query($sql, $connection);
			$row = mysql_fetch_array($res);
		break;

		case 'getsysdate':
			$sys = mysql_fetch_array(mysql_query("SELECT eoddate FROM tbltrans_eod ORDER BY eoddate DESC LIMIT 0,1"));
			if($sys[0] == "")
			{
				echo "System Date: ".date("l, F d, Y");
			}
			else
			{
				echo "System Date: ".date("l, F d, Y", strtotime($sys[0]));
			}

		break;

		case 'checkbustypevalue':
			$unitcount = mysql_fetch_array(mysql_query(" SELECT COUNT(unitid) FROM tblref_unit WHERE typeofbusiness = '". $_POST['bus'] ."' AND mallid = '". $_POST['mallid'] ."' ", $connection));
			if($_POST['bus'] == "SET"){
				$limittype = mysql_fetch_array(mysql_query(" SELECT MaxSET FROM tblref_mall WHERE mallid = '". $_POST['mallid'] ."' ", $connection));
			}else if($_POST['bus'] == "LCA"){
				$limittype = mysql_fetch_array(mysql_query(" SELECT MaxLCA FROM tblref_mall WHERE mallid = '". $_POST['mallid'] ."' ", $connection));
			}else{
				$limittype = 0;
			}

			if($_POST['bus'] == "LCA"){
                $unittype = "SET";
            }else if($_POST['bus'] == "SET"){
                $unittype = "LCA";
            }else{
                $unittype = "";
            }

			if($unitcount[0] >= $limittype[0]){
				echo "Maximum limit of ". $_POST['bus'] ." units for this mall already reached." . "|" . $unittype;
			}
		break;

		case 'loadheader':
			$header = mysql_fetch_array(mysql_query("SELECT softwaretype FROM tblsys_setup2", $connection));
			if($header[0] == "1"){
				echo "<i class='fa'><img src='assets/images/company_logo/ai1_logo.png' style='width: 25px; height: 25px;'></i>&nbsp;Property Leasing Management Application";
			}else{
				echo "<i class='fa'><img src='assets/images/company_logo/ai1_logo.png' style='width: 25px; height: 25px;'></i>&nbsp;Mall Management System";
			}
		break;

		case 'titletext':
			$title = mysql_fetch_array(mysql_query("SELECT softwaretype FROM tblsys_setup2", $connection));
			if($title[0] == "1"){
				echo "Property Leasing Management Application";
			}else{
				echo "Mall Management System";
			}
		break;

		case 'syscolor':
			$color = mysql_fetch_array(mysql_query("SELECT softwaretype FROM tblsys_setup2", $connection));
			echo $color[0];
		break;

		case 'checkeod':
			$cureod = mysql_fetch_array(mysql_query("SELECT eoddate FROM tbltrans_eod ORDER BY id DESC", $connection));
			if($cureod[0] != date('Y-m-d')){
				echo "PROCEED EOD";
			}else{
				echo "CONTINUE";
			}
		break;

		case 'saveassdues':
			$sql = "UPDATE mall_setup SET associationdues = '". $_POST['assdues'] ."' WHERE mall_id = '". $_POST['mallid'] ."' ";
			$res = mysql_query($sql, $connection);
			if($res == true){
				echo 1;
			}
		break;

		case 'showreservationpaymentlist':
			$page = $_POST['page'];
			$limit = ($page-1) * 10;
			$res = mysql_query("SELECT id, description, balance, paymenttype, orno, xdate FROM tbltransaction WHERE isdeposit = '1' AND paymentamount != '0' AND balance != '0.00' LIMIT ".$limit.",10", $connection);
			while($row = mysql_fetch_array($res)){
				$arr = explode("-", $row[2]);
				?>
					<tr  id="tr<?php echo $row[0]; ?>">
						<td><input class="ace ace-checkbox-2 chkpayment <?php echo "ids".$row[0]; ?>" type="checkbox" value="<?php echo $row[0]; ?>"><span class="lbl"</span></td>
						<td><?php echo date('F d, Y', strtotime($row[5])); ?></td>
						<td><?php echo $row[1]; ?></td>
						<td><?php echo $row[4]; ?></td>
						<td><?php echo $row[3]; ?></td>
						<td style="text-align: right;"><?php echo number_format($arr[1], 2, '.', ','); ?></td>
					</tr>
				<?php
			}
		break;

		case 'savereservationfee':
			$totalval = 0;
			$getvalues = explode("|", $_POST['ids']);
			for ($i=0; $i <= count($getvalues); $i++) { 
				$sqlsum = mysql_fetch_array(mysql_query("SELECT amount FROM tbltransaction WHERE id = '". $getvalues[$i] ."' ", $connection));
				$totalval += $sqlsum[0];
			}
   			$arr = explode("-", $totalval);
			$selectdown = mysql_fetch_array(mysql_query("SELECT depamount FROM tbltrans_inquiry WHERE inquiry_ID = '". $_POST['inquiryID'] ."' ", $connection));
			if($arr[1] >= $selectdown[0]){
				$sql = "UPDATE tbltrans_inquiry SET reservationfee = '". $_POST['ids'] ."' WHERE Inquiry_ID = '". $_POST['inquiryID'] ."' ";
				$res = mysql_query($sql, $connection);
				if($res == true){
					$appid = mysql_fetch_array(mysql_query("SELECT Application_ID, reservationfee FROM tbltrans_inquiry WHERE Inquiry_ID = '". $_POST['inquiryID'] ."' ", $connection));
					echo "1"."|".$appid[0]."|".$_POST['inquiryID']."|"."Confirmed";
				}else{

				}
			}else{
				echo "NO";	
			}
		break;

		case 'onloadreservationpaymentlist':
			$ids = mysql_fetch_array(mysql_query("SELECT reservationfee FROM tbltrans_inquiry WHERE Inquiry_ID = '". $_POST['Inquiry_ID'] ."' ", $connection));
			$arr = explode("|", $ids[0]);
				for($a=0; $a<=count($arr)-2; $a++){
			$row = mysql_fetch_array(mysql_query("SELECT id, description, amount, paymenttype, orno, xdate FROM tbltransaction WHERE id = '". $arr[$a] ."' ", $connection));
				?>
					<tr>
						<td><?php echo date('F d, Y', strtotime($row[5])); ?></td>
						<td><?php echo $row[1]; ?></td>
						<td><?php echo $row[4]; ?></td>
						<td><?php echo $row[3]; ?></td>
						<td style="text-align: right;"><?php echo number_format($row[2], 2, '.', ','); ?></td>
					</tr>
				<?php
			}

			echo "|".'Confirmed'."|".'Tentative';
		break;

		case 'searchids':
			$ids = mysql_fetch_array(mysql_query("SELECT reservationfee FROM tbltrans_inquiry WHERE Inquiry_ID = '". $_POST['id'] ."' ", $connection));
			echo $ids[0];
		break;

		case 'showdepositperc':
			$depositperc = mysql_fetch_array(mysql_query("SELECT depositperc FROM mall_setup WHERE mall_id = '". $_POST['mallid'] ."' ", $connection));
			echo $depositperc[0].'%';
		break;

		case 'getassocdues':
			$unitinfo = mysql_fetch_array(mysql_query("SELECT assocdues, totalamountunitsetup FROM tblref_unit WHERE unitid = '". $_POST['unitid'] ."' ", $connection));

			if($unitinfo[0] == "1"){
                $sqlassocdues = mysql_fetch_array(mysql_query("SELECT associationdues FROM mall_setup WHERE mall_id = '". $_POST['mallid'] ."' ", $connection));
                $assocdues = $sqlassocdues[0];
            }else{
                $assocdues = 0;
            }

            $totalmonthlydues = $assocdues + $unitinfo[1];
            echo number_format($assocdues, '2', '.', ',') . "|" . number_format($totalmonthlydues, '2', '.', ',');
		break;

		case 'confirmoverride':
			$sql = "SELECT count(userid), userid, CONCAT(lastname, ', ', firstname, ' ', middlename) FROM tbluser WHERE username = '" . $_POST["username"] . "' and password2 = '" . md5($_POST["password"]) . "' AND groupaccess = '0000004' ";
            $result = mysql_query($sql, $connection);
            $row = mysql_fetch_array($result);

            $ifnoaccess = mysql_fetch_array(mysql_query("SELECT COUNT(userid) FROM tbluser WHERE username = '" . $_POST["username"] . "' and password2 = '" . md5($_POST["password"]) . "' ", $connection));

            if($row[0] == "0" && $ifnoaccess[0] == "1"){
            	echo 3;
            }else if($row[0] == "0" && $ifnoaccess[0] == "0"){
            	echo 2;
            }else if($row[0] == "1" && $ifnoaccess[0] == "1"){
            	echo 1;
            	$reqname = mysql_fetch_array(mysql_query("SELECT requirements FROM tblref_applicationrequirements WHERE id = '". $_POST['id'] ."' ", $connection));
				$sqlpertrans = "INSERT INTO tbllogs_per_trans SET LogID = '". createidno("LOG", "tbllogs_per_trans", "logID") ."', inqID = '". $_POST['inqid'] ."', appID = '". $_POST['appid'] ."', userid = '". $row[1] ."', username = '". $row[2] ."', mydate = '". date('Y-m-d') ."', mytime = '". date('H:i:s') ."', remarks = '". $row[2] ." override an application requirement', module = 'Leasing Application Module', xinfo = '". $_POST['inqid']."|".$_POST["appid"]."|".$reqname[0]."|".$row[1] ."', xaction = 'Override' ";
				$respertrans = mysql_query($sqlpertrans, $connection);

				$sqllogs = "INSERT INTO tbllogs_trans SET LogID = '". createidno("LOG", "tbllogs_trans", "logID") ."', userid = '". $row[1] ."', username = '". $row[2] ."', mydate = '". date('Y-m-d') ."', mytime = '". date('H:i:s') ."', remarks = '". $row[2] ." override an application requirement', module = 'Leasing Application Module', xinfo = '". $_POST['inqid']."|".$_POST["appid"]."|".$reqname[0]."|".$row[1] ."', xaction = 'Override' ";
				$reslogs = mysql_query($sqllogs, $connection);
            }
		break;

		case 'loadpaymentlisentries':
			if($_POST["page"] == ""){
               	$page = 1;
           	}else{
               	$page = $_POST["page"];
           	}

           	$limit = ($page-1) * 10;

            $sql = "SELECT COUNT(id) FROM tbltransaction WHERE isdeposit = '1' AND paymentamount != '0' AND amount NOT LIKE '%-%'";
            $result = mysql_query($sql, $connection);
            $row = mysql_fetch_array($result);

            $rowsperpage = 10;
            $totalpages = ceil($row[0] / $rowsperpage);
            $upto = $limit + 10;
            $from = $limit + 1;
            if($page == $totalpages && $row[0] != 0){
                 echo "Showing " . $from . " to " . $row[0] . " of " . $row[0] . " entries";
            }
            else{
                if($row[0] == 0){
                   	echo "";
                }
                else if($row[0] <= 9 && $row[0] != 0){
                   	echo "Showing 1 to " . $row[0] . " of " . $row[0] . " entries";
                }
                else if($row[0] >= 10 && $row[0] != 0){
                   	echo "Showing " . $from . " to " . $upto . " of " . $row[0] . " entries";
                }

            }
		break;

		case 'loadpaymentlistpagination':
			$page = $_POST["page"];

        	$sqlb = "SELECT COUNT(id) FROM tbltransaction WHERE isdeposit = '1' AND paymentamount != '0' AND amount NOT LIKE '%-%'";
			$aa = mysql_query($sqlb, $connection);
			$nums = mysql_fetch_row($aa);
			$num = $nums[0];
			// if($num <= 20)
			// {
			// 	$page = 1
			// }
			$rowsperpage = 10;
			$range = 9;
			$totalpages = ceil($num / $rowsperpage);
			$prevpage;
			$nextpage;
			// if not on page 1, don't show back links
			if($page > 1 ){
			   echo "<li style='width:50px !important;' onclick='paginationforpaymentlist(1)'><< First</li>";
			   $prevpage = $page - 1;
			   echo "<li style='width:70px !important;' onclick='paginationforpaymentlist(". $prevpage .")'>< Previous</li>";
			}

			for($x = ($page - $range); $x < (($page + $range) + 1); $x++)
			{
			   if (($x > 0) && ($x <= $totalpages)){
    			    if ($x == $page){
                        echo "<li id='pgpaymentlist" . $x . "' class='pgnumofpaymentlist active' onclick='paginationforpaymentlist(" . $x . ",". $x .")'>" . $x . "</li>";
                      }
    			    else{
    			        echo "<li id='pgpaymentlist" . $x . "' class='pgnumofpaymentlist' onclick='paginationforpaymentlist(" . $x . ",". $x .")'>" . $x . "</li>";
                    }
		       }
		    }
		    if($page < ($totalpages - $range)){
                echo "<li>...</li>";
            }

		    if ($page != $totalpages && $num != 0){
		       $nextpage = $page + 1;
		       echo "<li style='width:50px !important;' onclick='paginationforpaymentlist(". $nextpage .", ". $nextpage .")'>Next ></li>";
		       echo "<li style='width:50px !important;' onclick='paginationforpaymentlist(". $totalpages .", ". $totalpages .")'>Last >></li>";
		    }
		break;

		case 'onloadcardinfo':
				$cardinfo = mysql_fetch_array(mysql_query("SELECT cardtype, cardholder, authno, seccode, expirydate, bankfrom, bf_accno, bankto, bt_accno, owner_card_number FROM tbltrans_inquiry WHERE Inquiry_ID = '". $_POST['inqid'] ."' ", $connection));
				if($_POST['paymenttype'] == "Credit Card" || $_POST['paymenttype'] == "Debit Card"){
					echo $cardinfo[0]."|".$cardinfo[1]."|".$cardinfo[2]."|".$cardinfo[3]."|".$cardinfo[4]."|".$cardinfo[9];
				}else if($_POST['paymenttype'] == "Bank Transfer"){
					echo $cardinfo[5]."|".$cardinfo[6]."|".$cardinfo[7]."|".$cardinfo[8]."||";
				}
		break;

		case 'reloadmonthlydues':
			$unitprice = mysql_fetch_array(mysql_query("SELECT totalamountunitsetup FROM tblref_unit WHERE unitid = '". $_POST['unitid'] ."' ", $connection));

			$priceinquired = mysql_fetch_array(mysql_query("SELECT monthly_dues FROM tbltrans_inquiry WHERE Inquiry_ID = '". $_POST['inqid'] ."'", $connection));

			if($priceinquired[0] != 0 || $priceinquired[0] != ""){
				$presyo = $priceinquired[0];
			}else{
				$presyo = $unitprice[0];
			}
			// $assocmallid = mysql_fetch_array(mysql_query("SELECT mallid FROM tblref_unit WHERE assocdues = '1' AND unitid = '". $_POST['unitid'] ."' ", $connection));
			// $assocpricepermall = mysql_fetch_array(mysql_query("SELECT associationdues FROM mall_setup WHERE mall_id = '". $assocmallid[0] ."' ", $connection));
			// $total = $unitprice[0] + $assocpricepermall[0];
			echo number_format($presyo, '2', '.', ',');
		break;

		case 'dipslaytotalonly':
			$assocmallid = mysql_fetch_array(mysql_query("SELECT mallid FROM tblref_unit WHERE assocdues = '1' AND unitid = '". $_POST['unitid'] ."' ", $connection));
			$assocpricepermall = mysql_fetch_array(mysql_query("SELECT associationdues FROM mall_setup WHERE mall_id = '". $assocmallid[0] ."' ", $connection));
			echo number_format($assocpricepermall[0], '2', '.', ',');
		break;

		case 'viewcardinformation':
			$cardinfo = mysql_fetch_array(mysql_query("SELECT cardtype, owner_card_number, expirydate, bankfrom, bf_accno, bankto, bt_accno FROM tbltrans_inquiry WHERE inquiry_ID = '". $_POST['Inquiry_ID'] ."' ", $connection));

			echo $cardinfo[0] ."|" . $cardinfo[1] ."|" . $cardinfo[2] ."|" . $cardinfo[3] ."|" . $cardinfo[4] ."|" . $cardinfo[5] ."|" . $cardinfo[6];
		break;
       }
?>
