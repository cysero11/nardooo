<?php 
	include("../connect.php");
	switch ($_POST['form']) {
		case 'displaycomplaints':
			$cnt_fltr = 0;
			$sql_filter = mysql_fetch_array(mysql_query("SELECT checked_value, otherfilter, bystat, xcheck FROM tblref_filters WHERE module = 'Complaint'"));
		    $trby = explode("|", $sql_filter["checked_value"]);
		    $stat = explode("|", $sql_filter["bystat"]);
		    $unit = explode("|", $sql_filter["xcheck"]);
		    $date = explode("|", $sql_filter["otherfilter"]);
		    $filter = "";
		    // filter for status
		    $cnt = 0; $chk = "";
		    for($a = 0; $a<=count($stat)-1; $a++){
			    if($stat[$a] == "High"){ 
			    	$con = "Priority_Status = 'High'"; 
			    }
			    else if($stat[$a] == "Medium"){ 
			    	$con = "Priority_Status = 'Medium'";
			    }
			    else if($stat[$a] == "Low"){
			    	$con = "Priority_Status = 'Low'";
			    }
			       
			    if($stat[$a] != ""){
			        $cnt_fltr++;
			        $cnt++;
			        if($cnt == 1){
			          	$chk .= $con;
			        }
			        else{
			          	$chk .= " OR ".$con;
			        }
			    }
			}
		    if($cnt > 1){
		      	$Stat_fltr = "(".$chk.")";
		    }
		    else{
		      	$Stat_fltr = $chk;
		    }
		    if($cnt > 0){
		      	$and = " AND ";
		    }
		    else{
		      	$and = "";
		    }

		    $cnt2 = 0; $chk2 = "";
			for($b = 0; $b<=count($unit)-1; $b++){
				if($unit[$b] != ""){
					$cnt_fltr++;
					$cnt2++;
					if($cnt2 == 1){
						$chk2 .= "Complaint_Status = '".$unit[$b]."'";
					}
					else{
						$chk2 .= " OR Complaint_Status = '".$unit[$b]."'";
					}
				}
			}
			if($cnt2 > 1){
				$Unit_fltr = "(".$chk2.")";
			}
			else{
				$Unit_fltr = $chk2;
			}

			if($cnt2 > 0){
				$and1 = " AND ";
			}
			else{
				$and1 = "";
			}

		    // filter by date
		    $date_fltr = "(Date_Entry BETWEEN '".date("Y-m-d", strtotime($date[0]))."' AND '".date("Y-m-d", strtotime($date[1]))."')";
		    // filter by
		    $cnt3 = 0; $chk3 = "";
		    for($c = 0; $c<=count($trby)-1; $c++){
		      	if($trby[$c] != ""){
		        	$cnt_fltr++;
		        	$cnt3++;
	        		if($cnt3 == 1){
	          			$chk3 .= $trby[$c] . " LIKE '%".$_POST["key"]."%'";
	        		}
	        		else{
	          			$chk3 .= " OR ". $trby[$c] . " LIKE '%".$_POST["key"]."%'";
	        		}
		      	}
		    }
		    if($cnt3 > 1){
		      	$by_fltr = "(".$chk3.")";
		    }
		    else{
		     	$by_fltr = $chk3;
		    }
		    if($cnt3 > 0){
		      	$and2 = " AND ";
		    }
		    else{
		      	$and2 = "";
		    }
		    if($cnt > 0 ){
			    $filterselected = "WHERE ".$Stat_fltr . "".$and."" . "". $date_fltr . "".$and2."" . $by_fltr ."".$and1.$Unit_fltr;

				$page = $_POST['page'];
				$limit = ($page-1) * 20;

				$sql = " SELECT Complaint_Series_No, TenantID, Date_Entry, Complaint_Code, Complete_Description, Customer_Name, unitname, Time_Received, Time_Resolved, Duration, Complaint_Status, Priority_Status, username, building_id, unitid, floorid, company, Complaint_Series_No FROM tblcomplaints ".$filterselected." ORDER BY xdate DESC limit ".$limit.",20 ";
				$res = mysql_query($sql, $connection) or die(mysql_error());
				while($row = mysql_fetch_array($res)){
					$assignperson = mysql_fetch_array(mysql_query("SELECT workername FROM tblmaintenance_workorder WHERE Complaint_Series_No = '". $row[0] ."' "))
					?>
						<tr id="<?php echo $row[0]; ?>">		
								<td><?php echo $row[1]; ?></td>
								<td><?php echo $row[2]; ?></td>
								<td><?php echo $row[3]; ?></td>
								<td><?php echo $row[4]; ?></td>
								<td><?php echo $row[16]; ?></td>
								<td><?php echo $row[7]; ?></td>
								<td><?php echo $row[8]; ?></td>
								<td><?php echo $assignperson[0]; ?></td>
								<td><?php echo $row[10]; ?></td>
								<td>
						<div>	
						<?php								
						if( $row[11] == "High" )	{	?>
							<span class="label label-sm label-danger"><?php echo $row[11]." Priority"; ?></span>
						<?php 	}	
						else if( $row[11] == "Medium" )	{	?>
							<span class="label label-sm label-warning"><?php echo $row[11]." Priority"; ?></span>
						<?php 	}
						else if( $row[11] == "Low" )	{	?>
							<span class="label label-sm label-yellow"><?php echo $row[11]." Priority"; ?></span>
						<?php 	}	?>
						</div>
								</td>
								<td>
								<?php
								if ($row["Complaint_Status"] == 'Pending') { ?>

							<button class='btn btn-sm btn-info'  onclick='setcomplaintastask("<?php echo $row[1]; ?>", "<?php echo $row[3]; ?>", "<?php echo $row[4]; ?>", "<?php echo $row[5]; ?>", "<?php echo $row[6]; ?>", "<?php echo $row[0]; ?>");'><i class="fa fa-tasks"></i></button>
							<?php } 
							else {	?>
							<button disabled class='btn btn-sm btn-info'  onclick='setcomplaintastask("<?php echo $row[1]; ?>");'><i class="fa fa-tasks"></i></button>
						<?php 	}	?>
							<button class='btn btn-sm btn-default' onclick='printcomplaint("<?php echo $row[17]; ?>", "<?php echo $row[13]; ?>");'><img src='assets/images/printer.png' style='width: 100%; height: auto;'></button>
								</td>
						</tr>	
					<?php	
				}
			}
		break;

		case 'loadentries':
			$cnt_fltr = 0;
			$sql_filter = mysql_fetch_array(mysql_query("SELECT checked_value, otherfilter, bystat, xcheck FROM tblref_filters WHERE module = 'Complaint'"));
		    $trby = explode("|", $sql_filter["checked_value"]);
		    $stat = explode("|", $sql_filter["bystat"]);
		    $unit = explode("|", $sql_filter["xcheck"]);
		    $date = explode("|", $sql_filter["otherfilter"]);
		    $filter = "";
		    // filter for status
		    $cnt = 0; $chk = "";
		    for($a = 0; $a<=count($stat)-1; $a++){
			    if($stat[$a] == "High"){ 
			    	$con = "Priority_Status = 'High'"; 
			    }
			    else if($stat[$a] == "Medium"){ 
			    	$con = "Priority_Status = 'Medium'";
			    }
			    else if($stat[$a] == "Low"){
			    	$con = "Priority_Status = 'Low'";
			    }
			       
			    if($stat[$a] != ""){
			        $cnt_fltr++;
			        $cnt++;
			        if($cnt == 1){
			          	$chk .= $con;
			        }
			        else{
			          	$chk .= " OR ".$con;
			        }
			    }
			}
		    if($cnt > 1){
		      	$Stat_fltr = "(".$chk.")";
		    }
		    else{
		      	$Stat_fltr = $chk;
		    }
		    if($cnt > 0){
		      	$and = " AND ";
		    }
		    else{
		      	$and = "";
		    }
		    // filter by date
		    $date_fltr = "(Date_Entry BETWEEN '".date("Y-m-d", strtotime($date[0]))."' AND '".date("Y-m-d", strtotime($date[1]))."')";
		    // filter by
		    $cnt3 = 0; $chk3 = "";
		    for($c = 0; $c<=count($trby)-1; $c++){
		      	if($trby[$c] != ""){
		        	$cnt_fltr++;
		        	$cnt3++;
	        		if($cnt3 == 1){
	          			$chk3 .= $trby[$c] . " LIKE '%".$_POST["key"]."%'";
	        		}
	        		else{
	          			$chk3 .= " OR ". $trby[$c] . " LIKE '%".$_POST["key"]."%'";
	        		}
		      	}
		    }
		    if($cnt3 > 1){
		      	$by_fltr = "(".$chk3.")";
		    }
		    else{
		     	$by_fltr = $chk3;
		    }
		    if($cnt3 > 0){
		      	$and2 = " AND ";
		    }
		    else{
		      	$and2 = "";
		    }
		    if($cnt > 0 ){
			    $filterselected = "WHERE ".$Stat_fltr . "".$and."" . "". $date_fltr . "".$and2."" . $by_fltr;

		        if($_POST["page"] == ""){
		            $page = 1;
		        }else{
		            $page = $_POST["page"];
		        }

	          	$limit = ($page-1) * 20;

	            $sql = "SELECT COUNT(*) FROM tblcomplaints ".$filterselected." ";
	            $result = mysql_query($sql, $connection);
	            $row = mysql_fetch_array($result);

	            $rowsperpage = 20;
	            $totalpages = ceil($row[0] / $rowsperpage);
	            $upto = $limit + 20;
	            $from = $limit + 1;
	            if($page == $totalpages && $row[0] != 0){
	                 echo "Showing " . $from . " to " . $row[0] . " of " . $row[0] . " entries";
	            }
	            else{
	                if($row[0] == 0){
	                  	echo "";
	                }
	                else if($row[0] <= 19 && $row[0] != 0){
	                  	echo "Showing 1 to " . $row[0] . " of " . $row[0] . " entries";
	                }
	                else if($row[0] >= 20 && $row[0] != 0){
	                  	echo "Showing " . $from . " to " . $upto . " of " . $row[0] . " entries";
	                }

	            }
	        }
        break;

		case "loadpagecomplaints":
            $cnt_fltr = 0;
			$sql_filter = mysql_fetch_array(mysql_query("SELECT checked_value, otherfilter, bystat, xcheck FROM tblref_filters WHERE module = 'Complaint'"));
		    $trby = explode("|", $sql_filter["checked_value"]);
		    $stat = explode("|", $sql_filter["bystat"]);
		    $unit = explode("|", $sql_filter["xcheck"]);
		    $date = explode("|", $sql_filter["otherfilter"]);
		    $filter = "";
		    // filter for status
		    $cnt = 0; $chk = "";
		    for($a = 0; $a<=count($stat)-1; $a++){
			    if($stat[$a] == "High"){ 
			    	$con = "Priority_Status = 'High'"; 
			    }
			    else if($stat[$a] == "Medium"){ 
			    	$con = "Priority_Status = 'Medium'";
			    }
			    else if($stat[$a] == "Low"){
			    	$con = "Priority_Status = 'Low'";
			    }
			       
			    if($stat[$a] != ""){
			        $cnt_fltr++;
			        $cnt++;
			        if($cnt == 1){
			          	$chk .= $con;
			        }
			        else{
			          	$chk .= " OR ".$con;
			        }
			    }
			}
		    if($cnt > 1){
		      	$Stat_fltr = "(".$chk.")";
		    }
		    else{
		      	$Stat_fltr = $chk;
		    }
		    if($cnt > 0){
		      	$and = " AND ";
		    }
		    else{
		      	$and = "";
		    }
		    // filter by date
		    $date_fltr = "(Date_Entry BETWEEN '".date("Y-m-d", strtotime($date[0]))."' AND '".date("Y-m-d", strtotime($date[1]))."')";
		    // filter by
		    $cnt3 = 0; $chk3 = "";
		    for($c = 0; $c<=count($trby)-1; $c++){
		      	if($trby[$c] != ""){
		        	$cnt_fltr++;
		        	$cnt3++;
	        		if($cnt3 == 1){
	          			$chk3 .= $trby[$c] . " LIKE '%".$_POST["key"]."%'";
	        		}
	        		else{
	          			$chk3 .= " OR ". $trby[$c] . " LIKE '%".$_POST["key"]."%'";
	        		}
		      	}
		    }
		    if($cnt3 > 1){
		      	$by_fltr = "(".$chk3.")";
		    }
		    else{
		     	$by_fltr = $chk3;
		    }
		    if($cnt3 > 0){
		      	$and2 = " AND ";
		    }
		    else{
		      	$and2 = "";
		    }
		    if($cnt > 0 ){
			    $filterselected = "WHERE ".$Stat_fltr . "".$and."" . "". $date_fltr . "".$and2."" . $by_fltr;

		    $page = $_POST["page"];

	        	$sqlb = "SELECT COUNT(*) FROM tblcomplaints ".$condition." ".$petsa." ".$statmo." ";
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

				for($x = ($page - $range); $x < (($page + $range) + 1); $x++){
				   if (($x > 0) && ($x <= $totalpages)){
	    			    if ($x == $page){
	                        echo "<li id='pgcomplaints" . $x . "' class='pgnumpcomplaints active' onclick='pagination(" . $x . ",". $x .")'>" . $x . "</li>";
	                    }
	    			    else{
	    			        echo "<li id='pgcomplaints" . $x . "' class='pgnumpcomplaints' onclick='pagination(" . $x . ",". $x .")'>" . $x . "</li>";
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
			}
		break;


		case 'loadfilters_complaint':
			$sql = "SELECT checked_value, otherfilter, bystat, xcheck FROM tblref_filters WHERE module = '".$_POST['module']."'";
	        $result = mysql_query($sql, $connection);
	        $row = mysql_fetch_array($result);

	        echo $row[0] . "#" . $row[1] . "#" . $row[2] . "#" . $row[3];
		break;

		case 'savecomplaintfilter':
			$sql = "SELECT checked_value FROM tblref_filters WHERE module = '".$_POST["module"]."'";
	      	$result = mysql_query($sql, $connection);
	      	$num = mysql_num_rows($result);
	      	$row = mysql_fetch_array($result);

	      	if($num == 0){
	        	$sql_insert = "INSERT INTO tblref_filters (module, checked_value, filters, otherfilter, bystat, xcheck)VALUES('".$_POST["module"]."', '".$_POST["checked"]."', '".$_POST["checked2"]."', '".$_POST["datefrom"]."|".$_POST["dateto"]."', '".$_POST["checked3"]."', '".$_POST["checked4"]."')";
	        	$result_insert = mysql_query($sql_insert, $connection);
		        if($result_insert == true){
		          	echo 1;
		        }
	      	}
	     		else{	
	        		$sql_update= "UPDATE tblref_filters SET checked_value = '".$_POST["checked"]."', otherfilter = '".$_POST["datefrom"]."|".$_POST["dateto"]."', bystat = '".$_POST["checked3"]."', xcheck = '".$_POST["checked4"]."' WHERE module = '".$_POST["module"]."'";
			        $result_update = mysql_query($sql_update, $connection); 
				        if($result_update == true){
				          	echo 1;
				        }   
	      	}
		break;

		case 'savecomplaintsmodal':
			$jonumber = createidno("JO", "tblmaintenance_workorder", "workorderid");
			$ownername = mysql_fetch_array(mysql_query("SELECT CONCAT(owner_firstname, ' ' ,owner_lastname), tradename FROM tbltrans_tenants WHERE TenantID = '". $_POST['tenantid'] ."' ", $connection));
			$sql = " INSERT INTO tblmaintenance_workorder SET TenantID = '". $_POST['tenantid'] ."', xdate = '". date('Y-m-d') ."', xtime = '". date('H:i:s') ."', departmentid = '". $_POST['assignedperson'] ."', Complaint_Series_No = '". $_POST['complaint_series_no'] ."', startdate = '". date('Y-m-d', strtotime($_POST['datestart'])) ."', starttime = '". date('H:i:s', strtotime($_POST['starttime'])) ."', workorderid = '". $jonumber ."', ownername = '".$ownername[0]."', tradename = '". $ownername[1] ."' ";
			echo $sql;
			$res = mysql_query($sql, $connection);
			if($res == true){
				$sql2 = "UPDATE tblcomplaints SET Complaint_Status = 'Ongoing', Time_Received = '". date('Y-m-d H:i:s') ."' WHERE Complaint_Series_No = '". $_POST["complaint_series_no"] ."' ";
				$result2 = mysql_query($sql2, $connection);
				if($result2 == true){
					echo 1;
				}
			}
		break;

		case 'printbydaterange':
			$sql = " SELECT TenantID, Date_Entry, Complaint_Code, Complete_Description, Customer_Name, Company, unitname, Time_Received, Time_Resolved, Duration, resolvedby, Complaint_Status, Priority_Status, username FROM tblcomplaints WHERE Date_Entry BETWEEN '".date("Y-m-d", strtotime($_POST['datefrom']))."' AND '".date("Y-m-d", strtotime($_POST['dateto']))."' ";
			$res = mysql_query($sql, $connection);
			while($row = mysql_fetch_array($res)){
				?>
					<tr>
						<td style="border-left:1px solid;border-bottom: 1px solid;"><?php echo $row[0]; ?></td>
						<td style="border-left:1px solid;border-bottom: 1px solid;"><?php echo $row[1]; ?></td>
						<td style="border-left:1px solid;border-bottom: 1px solid;"><?php echo $row[2]; ?></td>
						<td style="border-left:1px solid;border-bottom: 1px solid;"><?php echo $row[3]; ?></td>
						<td style="border-left:1px solid;border-bottom: 1px solid;"><?php echo $row[4]; ?></td>
						<td style="border-left:1px solid;border-bottom: 1px solid;"><?php echo $row[5]; ?></td>
						<td style="border-left:1px solid;border-bottom: 1px solid;"><?php echo $row[6]; ?></td>
						<td style="border-left:1px solid;border-bottom: 1px solid;"><?php echo $row[7]; ?></td>
						<td style="border-left:1px solid;border-bottom: 1px solid;"><?php echo $row[8]; ?></td>
						<td style="border-left:1px solid;border-bottom: 1px solid;"><?php echo $row[9]; ?></td>
						<td style="border-left:1px solid;border-bottom: 1px solid;"><?php echo $row[10]; ?></td>
						<td style="border-left:1px solid;border-bottom: 1px solid;"><?php echo $row[11]; ?></td>
						<td style="border-left:1px solid;border-bottom: 1px solid;"><?php echo $row[12]; ?></td>
						<td style="border-left:1px solid;border-bottom: 1px solid;border-right: 1px solid;"><?php echo $row[13]; ?></td>
					</tr>
				<?php
			}	
			echo "|" . date('F d, Y', strtotime($_POST['datefrom'])) . "|" . date('F d, Y', strtotime($_POST['dateto']));
		break;
	}
?>