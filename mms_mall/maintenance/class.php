<?php
	include("../connect.php");

	switch ( $_POST['form'] ) {
		case 'tblworkorder':
				$cnt_fltr = 0;
			    $sql_filter = mysql_fetch_array(mysql_query("SELECT checked_value, otherfilter, bystat, xcheck FROM tblref_filters WHERE module = 'Maintenance'"));
			    $trby = explode("|", $sql_filter["checked_value"]);
			    $stat = explode("|", $sql_filter["bystat"]);
			    $unit = explode("|", $sql_filter["xcheck"]);
			    $date = explode("|", $sql_filter["otherfilter"]);
			    $filter = "";
			    // filter for status
			    $cnt = 0; $chk = "";
			    for($a = 0; $a<=count($stat)-1; $a++){
			      	if($stat[$a] == "Pending"){ 
			      		$con = "xstatus = 'Pending'";
			      	}
			      	else if($stat[$a] == "Resolved"){
			      		$con = "xstatus = 'Resolved'"; 
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

			    $date_fltr = "AND (xdate BETWEEN '".date("Y-m-d", strtotime($date[0]))."' AND '".date("Y-m-d", strtotime($date[1]))."')";
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
			      	$filterselected = "WHERE ".$Stat_fltr . "" . "".$and2."" . $by_fltr . "" . $date_fltr;

					$sql = " SELECT workorderid, TenantID, ownername, xdate, xtime, workerid, workername, remarks, xstatus, joformanagement, Complaint_Series_No, postingstatus, mallid, departmentid FROM tblmaintenance_workorder ".$filterselected." ";
					$res = mysql_query($sql, $connection);
					while( $row = mysql_fetch_array($res) ){
						$tradename = mysql_fetch_array(mysql_query("SELECT tradename FROM tbltrans_tenants WHERE tenantID = '". $row[1] ."' ", $connection));
						$complaints = mysql_fetch_array(mysql_query("SELECT Complaint_Status, Complaint_Code FROM tblcomplaints WHERE Complaint_Series_No = '". $row[10] ."' ", $connection));
							if ($row[8] == 'Pending') {
								$stats = '<span class="label label-warning">'.$row[8].'</span>';
							}
							else if($row[8] == 'Resolved'){
								$stats = '<span class="label label-success">'.$row[8].'</span>';
							}

							if($complaints[0] == "Ongoing"){
								$complaintstatus = '<span class="blue fa fa-circle"></span>';
							}else{
								$complaintstatus = '<span class="green fa fa-circle"></span>';
							}
						?>
							<tr>
								<td><?php echo $row[0]; ?></td>						
								<td><?php echo date('F d, Y', strtotime($row[3])); ?></td>						
								<td><?php echo $tradename[0]; ?></td>						
								<td>
								<?php 
									if($row[10] == ""){
										$res2 = mysql_query("SELECT xcategory, taskstatus FROM tblmaintenance_workorderlist WHERE workorderid = '". $row[0] ."' ", $connection);
										while($joblist = mysql_fetch_array($res2)){
											$catname = mysql_fetch_array(mysql_query("SELECT category FROM tblmaintenance_category WHERE category_id = '". $joblist[0] ."' ", $connection));
											if($joblist[1] == 'Resolved'){
												$span = '<span class="green fa fa-circle"></span>';
											}else if($joblist[1] == 'Pending'){
												$span = '<span class="orange fa fa-circle"></span>';
											}else if($joblist[1] == 'Ongoing'){
												$span = '<span class="blue fa fa-circle"></span>';
											}
											echo $span." ".$catname[0]."<br/>";
										}
									}
									else{
											echo $complaintstatus." ".$complaints[1];
										}
								?>
								</td>						
								<td><?php echo $row[6]; ?></td>						
								<td><?php echo $stats; ?></td>
								<td>
						<?php				

						if($row[10] == ""){
							echo 	"<div class='btn-group'>
										<button class='btn btn-xs btn-primary' style='padding-bottom: 1px;' onclick='ViewWOdetailed(\"".  $row[0] ."\", \"". $row[1] . "\", \"". $row[10] . "\", \"". $row[8] . "\", \"". $row[10] . "\", \"".  $row[11] ."\", \"".  $row[13] ."\")' title='View Work Order'>
		                                <i class='fa fa-wrench' style='padding:2px;'></i></button> 

										<button class='btn btn-danger btn-xs' style='padding-bottom: 1px;' title='Cancel Job Order' onclick='cancelJO(\"".  $row[0] ."\")'><i class='fa fa-trash-o' style='padding:2px;'></i></button>

										<button class='btn btn-default btn-xs' title='Print Job Order' style='margin-left: 1px;' onclick='printJO(\"".  $row[0] ."\",  \"". $row[1] . "\", \"". $row[12] . "\")'><img src='assets/images/printer.png' style='width: 100%; height: auto;' /></button>
									</div>";
						}else{
							echo 	"<div class='btn-group'>
										<button class='btn btn-xs btn-primary' style='padding-bottom: 1px;' onclick='ViewWOdetailedcomplaint(\"".  $row[0] ."\", \"". $row[1] . "\", \"". $row[10] . "\", \"".  $row[8] ."\")' title='View Work Order'>
		                                <i class='fa fa-wrench' style='padding:2px;'></i></button>

										<button class='btn btn-danger btn-xs' style='padding-bottom: 1px;' title='Cancel Job Order' onclick='cancelJO(\"".  $row[0] ."\")'><i class='fa fa-trash-o' style='padding:2px;'></i></button>

										<button class='btn btn-default btn-xs' title='Print Job Order' style='margin-left: 1px;' onclick='printcomplaint(\"". $row[10] . "\", \"". $row[12] . "\")'><img src='assets/images/printer.png' style='width: 100%; height: auto;' /></button>
									</div>";
						}
						?>
								</td>
							</tr>
						<?php					
					}
				}
		break;

		case 'ViewWOdetailed':
			$companyname = mysql_fetch_array(mysql_query("SELECT companyname, unitname, mallid, unitid, CompanyID FROM tbltrans_tenants WHERE TenantID = '". $_POST['tenantid'] ."' ", $connection));
			$mallname = mysql_fetch_array(mysql_query("SELECT mallname FROM tblref_mall WHERE mallid = '". $companyname[2] ."' ", $connection));
			$wing = mysql_fetch_array(mysql_query("SELECT wing FROM tblref_wing WHERE mallid = '". $companyname[2] ."'"));
			$floorid = mysql_fetch_array(mysql_query("SELECT floorid FROM tblref_unit WHERE unitid = '". $companyname[3] ."' ", $connection));
			$floor = mysql_fetch_array(mysql_query("SELECT floor FROM tblref_floorsetup WHERE floorid = '". $floorid[0] ."' ", $connection));
			$contactname = mysql_fetch_array(mysql_query("SELECT name FROM tbltrans_company_contact_person WHERE ConID = '". $companyname[4] ."' ", $connection));
			$contactnumber = mysql_fetch_array(mysql_query("SELECT content FROM tbltrans_company_owner_contacts WHERE CompanyID = '". $companyname[4] ."' ", $connection));
			$workername = mysql_fetch_array(mysql_query("SELECT workername FROM tblmaintenance_workorder WHERE workorderid = '". $_POST['workorderid'] ."'", $connection));
			if($_POST['tenantid'] != "" && $_POST['formanagement'] == ""){
				echo $companyname[0] . "|" . $companyname[1] . "|" . $mallname[0] . "|" . $wing[0] . "|" . $floor[0] . "|" . $workername[0];
			}else if($_POST['tenantid'] == "" && $_POST['formanagement'] != ""){
				$sql = mysql_fetch_array(mysql_query("SELECT floor, unit FROM tblmaintenance_equip WHERE code = '". $_POST['formanagement'] ."' ", $connection));
				$mallname2 = mysql_fetch_array(mysql_query("SELECT mallname FROM tblref_mall WHERE mallid = '". $sql[1] ."' ", $connection));
				echo $sql[0] . "|" . $mallname2[0] . "|" . $workername[0];
			}
		break;

		case 'wodetailedwoi':
			if($_POST['csn'] == ""){
				$rescatid = mysql_query(" SELECT DISTINCT(xcategory) FROM tblmaintenance_workorderlist WHERE workorderid = '". $_POST['workorderid'] ."' ", $connection);
				while($catid = mysql_fetch_array($rescatid)){

					$catname = mysql_fetch_array(mysql_query(" SELECT category FROM tblmaintenance_category WHERE category_id = '". $catid[0] ."' ", $connection));

	                if($catname[0] == 'Electric Reading'){
	                	$workorder = mysql_fetch_array(mysql_query("SELECT xdate FROM tblmaintenance_workorder WHERE workorderid = '". $_POST['workorderid'] ."'", $connection));

		            	$rowstatusER = mysql_fetch_array(mysql_query("SELECT taskstatus, meter_reading, sub_total, id, tenantid FROM tblmaintenance_workorderlist WHERE  workorderid = '". $_POST['workorderid'] ."' AND xcategory = '". $catid[0] ."' ", $connection));
		            	
		            	echo	"<table class='table table-bordered' style='width: 100%;margin-bottom: 20px;'>
									<tr>
										<th style='background-color: #666;' colspan='12'><center>".$catname[0]."</center></th>
									</tr>
									<tr>
										<th>Reading Date</th>
				                        <th>Status</th>
				                        <th>Kilowatt</th>
				                        <th>Amount</th>
				                    </tr>
				                    <tr onclick='inputreading(\"". $catid[0] ."\", \"". $rowstatusER[0] ."\", \"". $_POST['workorderid'] ."\", \"". $rowstatusER[3] ."\", \"". $rowstatusER[4] ."\")'>
				                    	<td>".date('F d, Y',strtotime($workorder[0]))."</td>
				                        <td>".$rowstatusER[0]."</td>
				                        <td>".$rowstatusER[1]."</td>
				                        <td>".$rowstatusER[2]."</td>
				                    </tr>";
	                }
	                else if($catname[0] == 'Water Reading'){
	                	$workorder = mysql_fetch_array(mysql_query("SELECT xdate FROM tblmaintenance_workorder WHERE workorderid = '". $_POST['workorderid'] ."'", $connection));

		            	$rowstatusER = mysql_fetch_array(mysql_query("SELECT taskstatus, meter_reading, sub_total, id, tenantid FROM tblmaintenance_workorderlist WHERE  workorderid = '". $_POST['workorderid'] ."' AND xcategory = '". $catid[0] ."' ", $connection));

	                	echo	"<table class='table table-bordered' style='width: 100%;margin-bottom: 20px;'>
									<tr>
										<th style='background-color: #666;' colspan='12'><center>".$catname[0]."</center></th>
									</tr>
									<tr>
										<th>Reading Date</th>
				                        <th>Status</th>
				                        <th>Cubic Meter</th>
				                        <th>Amount</th>
				                    </tr>
				                    <tr onclick='inputreading(\"". $catid[0] ."\", \"". $rowstatusER[0] ."\", \"". $_POST['workorderid'] ."\", \"". $rowstatusER[3] ."\", \"". $rowstatusER[4] ."\")'>
				                    	<td>".date('F d, Y',strtotime($workorder[0]))."</td>
				                        <td>".$rowstatusER[0]."</td>
				                        <td>".$rowstatusER[1]."</td>
				                        <td>".$rowstatusER[2]."</td>
				                    </tr>";
	                }else{
	                	if($catname[0] != 'Electric Reading' || $catname[0] != 'Water Reading'){

							echo 	"<table class='table table-bordered' style='width: 100%;margin-bottom: 20px;'>
										<tr>
											<th style='background-color: #666;' colspan='12'><center>".$catname[0]."</center></th>
										</tr>
										<tr>
											<th>Task Name</th>
					                        <th>Equipment</th>
					                        <th>Status</th>
					                        <th>Total Duration</th>
					                        <th>Amount</th>
					                    </tr>";
	                		
		                	$restaskid = mysql_query(" SELECT xtaskid, id FROM tblmaintenance_workorderlist WHERE workorderid = '". $_POST['workorderid'] ."' AND xcategory = '". $catid[0] ."' ", $connection);
				            while($rowtaskid = mysql_fetch_array($restaskid)){
				            	$rowtaskinfo = mysql_fetch_array(mysql_query(" SELECT description, amount, equipmentname, id FROM tblmaintenance_tasklist WHERE taskid = '". $rowtaskid[0] ."' ", $connection));

				            	$rowstatus = mysql_fetch_array(mysql_query(" SELECT taskstatus, schedline, id FROM tblmaintenance_workorderlist WHERE xtaskid = '". $rowtaskid[0] ."' AND workorderid = '". $_POST['workorderid'] ."' AND xcategory = '". $catid[0] ."' AND id = '". $rowtaskid[1] ."' ", $connection));
				            	$totalduration = 0;
				            	$duration = explode("#", $rowstatus[1]);
				            	for($i=1; $i<=count($duration); $i++){
				            		$duration2 = explode("|", $duration[$i]);
				            		$totalduration = $totalduration + $duration2[4];
				            	}

				            	if($rowtaskid[0] != ""){
				            	echo "<tr  onclick='showschedule(\"".  $catid[0] ."\", \"".  $rowtaskid[0] ."\", \"".  $_POST['workorderid'] ."\", \"". $rowtaskinfo[0] ."\", \"". $rowstatus[0] ."\",  \"". $rowstatus[2] ."\")'>
				            			<td>".$rowtaskinfo[0]."</td>
				            			<td>".$rowtaskinfo[2]."</td>
				            			<td>".$rowstatus[0]."</td>
				            			<td>".number_format($totalduration, 1, '.', '')."</td>
				            			<td>".$rowtaskinfo[1]."</td>
				            		</tr>";
				            	}
				            }
				        }
	                }
				}
				echo	"</table>";
			}else{

				echo	"<table class='table table-bordered' style='width: 100%;margin-bottom: 20px;'>
							<tr>
								<th style='background-color: #666;' colspan='12'><center>Complaint</center></th>
							</tr>
							<tr>
								<th>Complaint Code</th>
		                        <th>Complaint Description</th>
		                        <th>Status</th>
		                        <th>Total Duration</th>
		                        <th>Amount</th>
		                    </tr>";
		            $sql = " SELECT Complaint_Code, Complete_Description, Complaint_Status FROM tblcomplaints WHERE Complaint_Series_No = '". $_POST['csn'] ."' ";
		            $res = mysql_query($sql, $connection);
		            while($row = mysql_fetch_array($res)){
		            	$complaint = mysql_fetch_array(mysql_query("SELECT duration, totalamount FROM tblmaintenance_workorder WHERE Complaint_Series_No = '". $_POST['csn'] ."' ", $connection));
		            	echo "<tr onclick='resolvingofcomplaint(\"".  $_POST['csn'] ."\", \"".  $row[2] ."\")'>
		            			<td>".$row[0]."</td>
		            			<td>".$row[1]."</td>
		            			<td>".$row[2]."</td>
		            			<td>".$complaint[0]."</td>
		            			<td>".$complaint[1]."</td>
		            		</tr>";
		            }
		        echo "</table>";
			}
				
		break;

        case 'loadentriesjo':
        	$cnt_fltr = 0;
		    $sql_filter = mysql_fetch_array(mysql_query("SELECT checked_value, otherfilter, bystat, xcheck FROM tblref_filters WHERE module = 'Maintenance'"));
		    $trby = explode("|", $sql_filter["checked_value"]);
		    $stat = explode("|", $sql_filter["bystat"]);
		    $unit = explode("|", $sql_filter["xcheck"]);
		    $date = explode("|", $sql_filter["otherfilter"]);
		    $filter = "";
		    // filter for status
		    $cnt = 0; $chk = "";
		    for($a = 0; $a<=count($stat)-1; $a++){
		      	if($stat[$a] == "Pending"){
		      		$con = "xstatus = 'Pending'";
		      	}
		      	else if($stat[$a] == "Resolved"){ 
		      		$con = "xstatus = 'Resolved'"; 
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

		    $date_fltr = "AND (xdate BETWEEN '".date("Y-m-d", strtotime($_POST['dateFrom']))."' AND '".date("Y-m-d", strtotime($_POST['dateTo']))."')";
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
			$filterselected = "WHERE ".$Stat_fltr . "" . "".$and2."" . $by_fltr . "" . $date_fltr;

	            $sql = "SELECT COUNT(*) FROM tblmaintenance_workorder ".$filterselected." ";
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

		case "loadpagejo":
		    $page = $_POST["page"];

		    $cnt_fltr = 0;
		    $sql_filter = mysql_fetch_array(mysql_query("SELECT checked_value, otherfilter, bystat, xcheck FROM tblref_filters WHERE module = 'Maintenance'"));
		    $trby = explode("|", $sql_filter["checked_value"]);
		    $stat = explode("|", $sql_filter["bystat"]);
		    $unit = explode("|", $sql_filter["xcheck"]);
		    $date = explode("|", $sql_filter["otherfilter"]);
		    $filter = "";
		    // filter for status
		    $cnt = 0; $chk = "";
		    for($a = 0; $a<=count($stat)-1; $a++){
		      	if($stat[$a] == "Pending"){ 
		      		$con = "xstatus = 'Pending'"; 
		      	}
		      	else if($stat[$a] == "Resolved"){
		      		$con = "xstatus = 'Resolved'"; 
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

		    $date_fltr = "AND (xdate BETWEEN '".date("Y-m-d", strtotime($_POST['dateFrom']))."' AND '".date("Y-m-d", strtotime($_POST['dateTo']))."')";
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
		      	$filterselected = "WHERE ".$Stat_fltr . "" . "".$and2."" . $by_fltr . "" . $date_fltr;

	        	$sqlb = "SELECT COUNT(*) FROM tblmaintenance_workorder ".$filterselected."";
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
				   echo "<li style='width:50px !important;' onclick='paginationjo(1)'><< First</li>";
				   $prevpage = $page - 1;
				   echo "<li style='width:70px !important;' onclick='paginationjo(". $prevpage .")'>< Previous</li>";
				}

				for($x = ($page - $range); $x < (($page + $range) + 1); $x++)
				{
				   if (($x > 0) && ($x <= $totalpages)){
	    			    if ($x == $page){
	                        echo "<li id='pgjo" . $x . "' class='pgnumjo active' onclick='paginationjo(" . $x . ",". $x .")'>" . $x . "</li>";
	                      }
	    			    else{
	    			        echo "<li id='pgjo" . $x . "' class='pgnumjo' onclick='paginationjo(" . $x . ",". $x .")'>" . $x . "</li>";
	                    }
			       }
			    }
			    if($page < ($totalpages - $range)){
	                echo "<li>...</li>";
	            }

			    if ($page != $totalpages && $num != 0){
			       $nextpage = $page + 1;
			       echo "<li style='width:50px !important;' onclick='paginationjo(". $nextpage .", ". $nextpage .")'>Next ></li>";
			       echo "<li style='width:50px !important;' onclick='paginationjo(". $totalpages .", ". $totalpages .")'>Last >></li>";
			    }
			}
		break;

		case 'loadfilters_maintenance':
			$sql = "SELECT checked_value, bystat, otherfilter FROM tblref_filters WHERE module = '".$_POST["module"]."'";
			$result = mysql_query($sql, $connection);
			$row = mysql_fetch_array($result);

			echo $row["checked_value"] . "#" . $row["bystat"] . "#" . $row[2];
		break;	

		case 'savemaintenancefilter':
			$sql = "SELECT checked_value FROM tblref_filters WHERE module = '".$_POST["module"]."'";
			$result = mysql_query($sql, $connection);
			$num = mysql_num_rows($result);
			$row = mysql_fetch_array($result);
			if($num == 0)
			{
				$sql_insert = "INSERT INTO tblref_filters (module, checked_value, filters, bystat, otherfilter)VALUES('".$_POST["module"]."', '".$_POST["checked"]."', '".$_POST["checked2"]."', '". $_POST['checked3'] ."', '". $_POST['datefrom'] . "|" . $_POST['dateto'] ."')";
				$result_insert = mysql_query($sql_insert, $connection);
				if($result_insert == true)
				{
					echo 1;
				}
			}
			else
			{
				$sql_update= "UPDATE tblref_filters SET checked_value = '".$_POST["checked"]."', bystat = '". $_POST['checked3'] ."', otherfilter = '". $_POST['datefrom'] . "|" . $_POST['dateto'] ."' WHERE module = '".$_POST["module"]."' ";
				echo $sql_update;
				$result_update = mysql_query($sql_update, $connection);	
				if($result_update == true)
				{
					echo 1;
				}		
			}
		break;

		case 'jocalendar':
			$return_arr = array();
			$ctr = 1;
			$sql = " SELECT room_owner_id, task_id, location_id, worker_name, sched, timestart FROM pmls_android_worker_task ";
			$res = mysql_query($sql, $connection);
			while ( $row = mysql_fetch_array($res) ) {

					$sqltradename = " SELECT tradename FROM tbltrans_tenants WHERE TenantID = '". $row[0] ."' ";
					$restradename = mysql_query($sqltradename, $connection);
					$rowtradename = mysql_fetch_array($restradename);

					$sqltaskname = " SELECT description FROM pmls_android_reftask WHERE task_id = '". $row[1] ."' ";
					$restaskname = mysql_query($sqltaskname, $connection);
					$rowtaskname = mysql_fetch_array($restaskname);

					$sqllocation = " SELECT unitname FROM tblref_unit WHERE unitid = '". $row[2] ."' ";
					$reslocation = mysql_query($sqllocation, $connection);
					$rowlocation = mysql_fetch_array($reslocation);

				array_push($num_arr[$ctr],$row[3]);

				$row_array['title'] = $rowtradename[0]." ". $rowtaskname[0]." ".$rowlocation[0];
				$row_array['start'] = date('Y-m-d',strtotime($row[4]))." ".$row[5];

				array_push($return_arr,$row_array);
				$ctr ++;
			}

			echo json_encode($return_arr);
		break;

		case 'cancelJO':
			$sql = " DELETE FROM tblmaintenance_workorder WHERE workorderid = '". $_POST['deletemokokoya'] ."' ";
			$res = mysql_query($sql, $connection);
			if($res == true){
				echo 1;
			}
		break;

		case 'loadchklist':
			// daily
			$sub_daily = mysql_query("SELECT mainid, xtask, id, xdesc FROM ref_maintenancemain_sub WHERE xperiod = 'Daily'");
			while($day = mysql_fetch_array($sub_daily))
			{
				$sql_daily = mysql_fetch_array(mysql_query("SELECT COUNT(id) FROM ref_maintenancemain_log WHERE xdate = '".date("Y-m-d")."' AND LIid = '".$day["id"]."'", $connection));
				if($sql_daily[0] == 0)
				{
					$sql_insert_daily = mysql_fetch_array(mysql_query("INSERT INTO ref_maintenancemain_log SET LIid = '".$day["id"]."', mainid = '".$day["mainid"]."', xtask =  '".$day["xtask"]."', xdesc =  '".$day["xdesc"]."', xdate = '".date("Y-m-d")."'", $connection));
				}
			}

			// weekly
			$sub_weekly = mysql_query("SELECT mainid, xtask, id, xdesc, xday FROM ref_maintenancemain_sub WHERE xperiod = 'Weekly' AND xday = '".date('l')."'");
			while($week = mysql_fetch_array($sub_weekly))
			{
				$sql_weekly = mysql_fetch_array(mysql_query("SELECT COUNT(id) FROM ref_maintenancemain_log WHERE xdate = '".date("Y-m-d")."' AND LIid = '".$week["id"]."'", $connection));
				if($sql_weekly[0] == 0)
				{
					$sql_insert_weekly = mysql_fetch_array(mysql_query("INSERT INTO ref_maintenancemain_log SET LIid = '".$week["id"]."', mainid = '".$week["mainid"]."', xtask =  '".$week["xtask"]."', xdesc =  '".$week["xdesc"]."', xdate = '".date("Y-m-d")."'", $connection));
				}
			}

			// monthly
			$sub_monthly = mysql_query("SELECT mainid, xtask, id, xdesc, xday, xday_num FROM ref_maintenancemain_sub WHERE xperiod = 'Monthly' AND xday_num = '".date('d')."'");
			while($monthly = mysql_fetch_array($sub_monthly))
			{
				$sql_monthly = mysql_fetch_array(mysql_query("SELECT COUNT(id) FROM ref_maintenancemain_log WHERE xdate = '".date("Y-m-d")."' AND LIid = '".$monthly["id"]."'", $connection));
				if($sql_monthly[0] == 0)
				{
					$sql_insert_monthly = mysql_fetch_array(mysql_query("INSERT INTO ref_maintenancemain_log SET LIid = '".$monthly["id"]."', mainid = '".$monthly["mainid"]."', xtask =  '".$monthly["xtask"]."', xdesc =  '".$monthly["xdesc"]."', xdate = '".date("Y-m-d")."'", $connection));
				}
			}			

			$sub_daily_load = mysql_query("SELECT DISTINCT(mainid) FROM ref_maintenancemain_log WHERE xdate = '".date("Y-m-d")."'");
			while($day_load = mysql_fetch_array($sub_daily_load))
			{
				$getcategory = mysql_fetch_array(mysql_query("SELECT xdesc FROM ref_maintenancemain WHERE mainid = '".$day_load[0]."'", $connection));
				echo '<thead>
					      <tr>
					          <th style="background-color: #f2f2f2 !important;color:#707070;width:40%;white-space: nowrap;">'.$getcategory[0].'</th>
					          <th style="background-color: #f2f2f2 !important;color:#707070;width:55%;border-right:0px !important;white-space: nowrap;">Task</th>
					          <th style="background-color: #f2f2f2 !important;color:#707070;width:5%;border-left:0px !important;white-space: nowrap;"></th>
					      </tr>
					  </thead><tbody>';
				$loadday = mysql_query("SELECT xtask, xdesc, id, xstat FROM ref_maintenancemain_log WHERE xdate = '".date("Y-m-d")."' AND mainid = '".$day_load[0]."'");
				while($dayss = mysql_fetch_array($loadday))
				{
					if($dayss["xstat"] == "1")
					{
						$as = "checked";
						$backgroun = "background-color:#80ffaa;";
					}
					else
					{
						$as = "";
						$backgroun = "background-color:#ff9999;";
					}
					echo '<tr>
				                <td style="white-space: nowrap;width:40%;'.$backgroun.'">'.$dayss[0].'</td>
				                <td style="white-space: nowrap;width:55%;border-right:0px !important;'.$backgroun.'">'.$dayss[1].'</td>
				                <td style="white-space: nowrap;width:5%;border-left:0px !important;'.$backgroun.'"><label><input name="form-field-checkbox" class="ace ace-checkbox-2" type="checkbox" value="" id="" onclick="changestatoflist(\''.$dayss["id"].'\', $(this))" '.$as.'><span class="lbl"></span></label></td>
				            </tr>';
				}
				echo '</tbody>';
			}
		break;

		case 'changestatoflist':
			$sql = mysql_query("UPDATE ref_maintenancemain_log SET xstat = '".$_POST["a"]."' WHERE id = '".$_POST["id"]."'", $connection);
		break;

		case 'showtenantlist':
				echo "<option value=''>-- Select Tenant --</option>";
			$res = mysql_query("SELECT TenantID, CONCAT(owner_firstname, ' ', owner_lastname), tradename FROM tbltrans_tenants");
			while( $row = mysql_fetch_array($res)){
				echo "<option value='".$row[0]."'>".$row[2]."</option>";
			}	
		break;

		case 'showwoperson':	
				echo "<option value=''>-- Select Person --</option>";
			$sql = "SELECT groupid, groupname FROM tblref_groupaccess";
            $result = mysql_query($sql, $connection);
            while( $row = mysql_fetch_array ($result)){
                echo "<option value='" . $row[0] . "'>" . $row[1] . "</option>";
            }
		break;

		case 'showwomanagementlist':
				echo "<option value=''>-- Select Maintenance --</option>";
			$sql = " SELECT Code, description FROM tblmaintenance_equip WHERE xcategory = 'Security and Communication System' OR xcategory = 'Facilities' ";
            $result = mysql_query($sql, $connection);
            while( $row = mysql_fetch_array ($result)){
                echo "<option value='" . $row[0] . "'>" . $row[1] . "</option>";
            }
		break;

		case 'showtblwojob':
			$mgaMeron = "";
			$arr = explode("|", $_POST['val']);
			for ($i=0; $i <= count($arr)-2; $i++) { 
				$mgaMeron .= "'" . $arr[$i] . "'" . ",";
			}

			if($_POST['val'] != ""){
				$tanong = "AND category_id NOT IN (". substr(trim($mgaMeron), 0, -1) .")";
			}else{
				$tanong = "";
			}

			$sql = " SELECT category_id, category, icon FROM tblmaintenance_category WHERE category LIKE '%".$_POST['key']."%' ".$tanong."";
			$res = mysql_query($sql, $connection);
			while( $row = mysql_fetch_array($res) ){
				?>
					<tr onclick='createjob("<?php echo $row[0]; ?>","<?php echo $row[1]; ?>")'>
						<td width="5%"><img style='margin-right: 5px;' src='assets/images/maintenance/<?php echo $row[2]; ?>' width='20px' height='20px' /></td>
						<td><?php echo $row[0]; ?></td>
						<td><?php echo $row[1]; ?></td>
					</tr>
				<?php
			}

		break;

		case 'showtblwotask':
			$arr = explode("/", $_POST["catid"]);
			$sql = " SELECT taskid, description, amount, equipmentid, equipmentname FROM tblmaintenance_tasklist WHERE description LIKE '%". $_POST['key'] ."%' AND xcategory = '". $arr[0] ."' ";
			$res = mysql_query($sql, $connection);
			while( $row = mysql_fetch_array($res) ){
				?>
					<tr onclick='createtask("<?php echo $arr[1]; ?>","<?php echo $row[0]; ?>","<?php echo $row[1]; ?>","<?php echo $row[2]; ?>","<?php echo $row[3]; ?>","<?php echo $row[4]; ?>")'>
						<td><?php echo $row[0]; ?></td>
						<td><?php echo $row[1]; ?></td>
						<td><?php echo $row[4]; ?></td>
						<td><?php echo $row[2]; ?></td>
					</tr>
				<?php
			}
		break;

		case 'savenewworkorder':
			$ownername = mysql_fetch_array(mysql_query("SELECT CONCAT(owner_firstname, ' ' ,owner_lastname), mallid FROM tbltrans_tenants WHERE TenantID = '". $_POST['wotenant'] ."' ", $connection));
			$tradename = mysql_fetch_array(mysql_query("SELECT tradename FROM tbltrans_tenants WHERE tenantID = '". $_POST['wotenant'] ."' ", $connection));
			$mallid = mysql_fetch_array(mysql_query("SELECT unit FROM tblmaintenance_equip WHERE Code = '". $_POST['womanagementlist'] ."' ", $connection));
			$jonum = createidno("JO", "pmls_android_worker_task", "staff_task_id");
			
			$arr = explode("|", $_POST['WorkOrderModal']);
			for ($a=1;$a<=count($arr)-1;$a++) {
				
				$arr2 = explode("|", $arr[$a]);
				$arr3 = explode("@", $arr[$a]);
				$arr4 = explode("#", $arr3[1]);
				$arr5 = explode("/", $arr[$a]);

				for ($i=1; $i<=count($arr3)-1; $i++) {
				$sql2 = " INSERT INTO tblmaintenance_workorderlist SET workorderid = '". $jonum ."', xcategory = '". $arr5[0] ."', xtaskid = '". $arr3[$i] ."', xstatus = 'Not Posted', TenantID = '". $_POST['wotenant'] ."' ";
				$res2 = mysql_query($sql2, $connection);
				$row2 = mysql_fetch_array($res2);
				}

				if(count($arr3) == "1"){

					for ($i=0; $i<=count($arr3)-1; $i++) {
					$sql2 = " INSERT INTO tblmaintenance_workorderlist SET workorderid = '". $jonum ."', xcategory = '". $arr5[0] ."', xstatus = 'Not Posted', TenantID = '". $_POST['wotenant'] ."', reading_date = '". date('Y-m-d') ."' ";
					$res2 = mysql_query($sql2, $connection);
					$row2 = mysql_fetch_array($res2);

					}
				}
				$catname = mysql_fetch_array(mysql_query("SELECT category FROM tblmaintenance_category WHERE category_id = '". $arr5[0] ."'", $connection));

			}

			if($_POST['wotenant'] != "" && $_POST['womanagementlist'] == ""){
				$sql = " INSERT INTO tblmaintenance_workorder SET workorderid = '". $jonum ."', TenantID = '". $_POST['wotenant'] ."', ownername = '". $ownername[0] ."', xdate = '". date('Y-m-d') ."', xtime = '". date('H:i:s') ."', departmentid = '". $_POST['woperson'] ."', remarks = '". $_POST['woremarks'] ."', tradename = '". $tradename[0] ."', mallid = '". $ownername[1] ."' ";
				$res = mysql_query($sql, $connection);
				if($res == true){
					echo 1;
				}
			}else if($_POST['wotenant'] == "" && $_POST['womanagementlist'] != ""){
				$sql = " INSERT INTO tblmaintenance_workorder SET workorderid = '". $jonum ."', xdate = '". date('Y-m-d') ."', xtime = '". date('H:i:s') ."', departmentid = '". $_POST['woperson'] ."', remarks = '". $_POST['woremarks'] ."', joformanagement = '". $_POST['womanagementlist'] ."', mallid = '". $mallid[0] ."' ";
				$res = mysql_query($sql, $connection);
				if($res == true){
					echo 1;
				}
			}
		break;

		case 'saveschedline':
			$arr = explode("|", $_POST['ids']);
			$sql = " UPDATE tblmaintenance_workorderlist SET schedline = '". $_POST['schedline'] ."', taskstatus = '". $_POST['stat'] ."' WHERE workorderid = '". $arr[2] ."' AND xtaskid = '". $arr[1] ."' AND xcategory = '". $arr[0] ."' AND id = '". $arr[3] ."' ";
			$res = mysql_query($sql, $connection);
			if($res == true){
				echo 1;
			}

		break;

		case 'showschedule':
			$sql = " SELECT schedline, taskstatus FROM tblmaintenance_workorderlist WHERE xtaskid = '". $_POST['taskid'] ."' AND workorderid = '". $_POST['workorderid'] ."' AND xcategory = '". $_POST['catid'] ."' ";
			$res = mysql_query($sql, $connection);
			$row = mysql_fetch_array($res);

			if($row[0] == ""){
				?>
					<tr>
                        <td width="3%"><input type="checkbox" class="cbschedline" style="margin-top: 10px;"></td>
                        <td><input type="text" class="date-picker schedline slstartdate" value="<?php echo date('m/d/Y'); ?>" id="slstartdate"></td>
                        <td><input type="text" class="date-picker schedline slenddate" value="<?php echo date('m/d/Y'); ?>" id="slenddate"></td>
                        <td><input type="time" class="schedline slstarttime" id="slstarttime"></td>
                        <td><input type="time" class="schedline slendtime" id="slendtime"></td>
                        <td><input type="text" size="4" class="schedline slduration numberlang" id="slduration"></td>
                    </tr>
				<?php
			}else{
				$schedline = explode("#", $row[0]);
	            	for($i=1; $i<=count($schedline)-2; $i++){
	            		$data = explode("|", $schedline[$i]);
	            		?> 
	            		<tr>
                                <td width="3%"><input type="checkbox" class="cbschedline" style="margin-top: 10px;" disabled></td>
                                <td><input type="text" class="date-picker schedline slstartdate" value="<?php echo $data[0]; ?>" id="slstartdate" disabled></td>
                                <td><input type="text" class="date-picker schedline slenddate" value="<?php echo $data[1]; ?>" id="slenddate" disabled></td>
                                <td><input type="time" class="schedline slstarttime" id="slstarttime" value="<?php echo $data[2]; ?>" disabled></td>
                                <td><input type="time" class="schedline slendtime" id="slendtime" value="<?php echo $data[3]; ?>" disabled></td>
                                <td><input type="text" size="4" class="schedline slduration numberlang" id="slduration" value="<?php echo $data[4]; ?>" disabled></td>
                            </tr>
                        <?php
	            	}
				}

			echo "|" . $row[1];
		break;

		case 'savewocatmodal':
			$check = " SELECT category_id FROM tblmaintenance_category WHERE category_id = '". $_POST['catid'] ."' ";
			$rescheck = mysql_query($check, $connection);
			$rowcheck = mysql_fetch_array($rescheck);
			if ( $rowcheck[0] == "" ) {
				$rowdesc = mysql_fetch_array(mysql_query("SELECT category FROM tblmaintenance_category WHERE category = '". $_POST['catdes'] ."' ", $connection));
				if($rowdesc[0] == ""){
					$sql = " INSERT INTO tblmaintenance_category SET category_id = '". $_POST['catid'] ."', category = '". utf8_encode($_POST['catdes']) ."' ";
					$res = mysql_query($sql, $connection) or die(mysql_error($connection));

					if ( $res == true ) {
						$id = mysql_fetch_array(mysql_query("SELECT id FROM tblmaintenance_category WHERE category_id = '". $_POST['catid'] ."' ", $connection));
						echo "1"."|".$id[0];
					}
				}else{
					echo "Category description already exist.";
				}
			}

			else {
				echo "Category Code already exist.";
			}
		break;

		case 'savewowotaskmodal':
			$check = " SELECT taskid FROM tblmaintenance_tasklist WHERE taskid = '". $_POST['taskid'] ."' ";
			$rescheck = mysql_query($check, $connection);
			$rowcheck = mysql_fetch_array($rescheck);
			if ( $rowcheck[0] == "" ) {
				$rowdesc = mysql_fetch_array(mysql_query("SELECT description FROM tblmaintenance_tasklist WHERE description = '". $_POST['taskname'] ."' ", $connection));
				if($rowdesc[0] == ""){
					$resequip = mysql_query("SELECT description FROM tblmaintenance_equip WHERE code = '". $_POST['equipment'] ."' ", $connection);
					$rowequip = mysql_fetch_array($resequip);
					$arr = explode("/", $_POST['catid']);
					$sql = " INSERT INTO tblmaintenance_tasklist SET taskid = '". $_POST['taskid'] ."', description = '". utf8_encode($_POST['taskname']) ."', xcategory = '". $arr[0] ."', amount = '". $_POST['amount'] ."', equipmentid = '". $_POST['equipment'] ."', equipmentname = '". $rowequip[0] ."' ";
					$res = mysql_query($sql, $connection);

					if ( $res == true ) {
						echo 1;
					}
				}else{
					echo "Task Description already exist.";
				}
			}

			else {
				echo "Task Code already exist";
			}
		break;

		case 'printJOtenantinformation':
			$companyname = mysql_fetch_array(mysql_query("SELECT companyname, unitname, mallid, unitid, CompanyID FROM tbltrans_tenants WHERE TenantID = '". $_POST['tenantid'] ."' ", $connection));
			$mallname = mysql_fetch_array(mysql_query("SELECT mallname FROM tblref_mall WHERE mallid = '". $companyname[2] ."' ", $connection));
			$wing = mysql_fetch_array(mysql_query("SELECT wing FROM tblref_wing WHERE mallid = '". $companyname[2] ."'"));
			$floorid = mysql_fetch_array(mysql_query("SELECT floorid FROM tblref_unit WHERE unitid = '". $companyname[3] ."' ", $connection));
			$floor = mysql_fetch_array(mysql_query("SELECT floor FROM tblref_floorsetup WHERE floorid = '". $floorid[0] ."' ", $connection));
			$contactname = mysql_fetch_array(mysql_query("SELECT name FROM tbltrans_company_contact_person WHERE ConID = '". $companyname[4] ."' ", $connection));
			$contactnumber = mysql_fetch_array(mysql_query("SELECT content FROM tbltrans_company_owner_contacts WHERE CompanyID = '". $companyname[4] ."' ", $connection));
			echo $companyname[0] . "|" . $companyname[1] . "|" . $mallname[0] . "|" . $wing[0] . "|" . $floor[0] . "|" . $contactname[0] . "|" . $contactnumber[0];
		break;

		case 'printJOjotasklistcontainer':
			$rescatid = mysql_query(" SELECT DISTINCT(xcategory) FROM tblmaintenance_workorderlist WHERE workorderid = '". $_POST['workorderid'] ."' ", $connection);
			while($catid = mysql_fetch_array($rescatid)){

				$catname = mysql_fetch_array(mysql_query(" SELECT category FROM tblmaintenance_category WHERE category_id = '". $catid[0] ."' ", $connection));

					if($catname[0] == 'Electric Reading'){
	                	$workorder = mysql_fetch_array(mysql_query("SELECT xdate, mallid FROM tblmaintenance_workorder WHERE workorderid = '". $_POST['workorderid'] ."'", $connection));

		            	$rowstatusER = mysql_fetch_array(mysql_query("SELECT taskstatus, meter_reading, sub_total, id, tenantid FROM tblmaintenance_workorderlist WHERE  workorderid = '". $_POST['workorderid'] ."' AND xcategory = '". $catid[0] ."' ", $connection));

						$elec_amnt = mysql_fetch_array(mysql_query("SELECT elec_amnt FROM mall_setup WHERE mall_id = '". $workorder[1] ."' ", $connection));

		            	$prevkwh = mysql_fetch_array(mysql_query("SELECT meter_reading, reading_date FROM tblmaintenance_workorderlist WHERE meter_reading <> NULL OR meter_reading <> '0' AND xcategory = '". $catid[0] ."' AND tenantid = '". $_POST['tenantid'] ."' AND reading_date LIKE '%". date('Y-m', strtotime($workorder[0].'-1 month')) ."%' ", $connection));

	                    if($prevkwh[0] == ""){
	                        $previousreading = 0;
	                    }else{
	                        $previousreading = $prevkwh[0];
	                    }
		            	
		            	echo	"<table class='table table-bordered' style='width: 100%;margin-bottom: 20px;'>
									<tr>
										<th style='background-color: #666;color: white;' colspan='12'><center>".$catname[0]."</center></th>
									</tr>
									<tr>
										<th colspan='2' style='border-left: 1px solid;border-bottom: 1px solid;padding-left: 5px;padding-right: 5px;'>Date of Reading</th>
				                        <th colspan='2' style='border-left: 1px solid;border-bottom: 1px solid;padding-left: 5px;padding-right: 5px;'>Meter Reading</th>
				                        <th rowspan='2' style='border-left: 1px solid;border-right: 1px solid;border-bottom: 1px solid;padding-left: 5px;padding-right: 5px;'>Amount</th>
				                    </tr>
				                    <tr>
				                    	<td style='border-left: 1px solid;border-bottom: 1px solid;padding-left: 5px;padding-right: 5px;'>From</td>
				                    	<td style='border-left: 1px solid;border-bottom: 1px solid;padding-left: 5px;padding-right: 5px;'>To</td>
				                    	<td style='border-left: 1px solid;border-bottom: 1px solid;padding-left: 5px;padding-right: 5px;'>Previous</td>
				                    	<td style='border-left: 1px solid;border-bottom: 1px solid;padding-left: 5px;padding-right: 5px;'>Present</td>
				                    </tr>
				                    <tr>
				                    	<td style='border-left: 1px solid;border-bottom: 1px solid;padding-left: 5px;padding-right: 5px;'>".date('m/d/Y',strtotime($prevkwh[1]))."</td>
				                    	<td style='border-left: 1px solid;border-bottom: 1px solid;padding-left: 5px;padding-right: 5px;'>".date('m/d/Y',strtotime($workorder[0]))."</td>
				                        <td style='border-left: 1px solid;border-bottom: 1px solid;padding-left: 5px;padding-right: 5px;'>".
				                        $previousreading."</td>
				                        <td style='border-left: 1px solid;border-bottom: 1px solid;padding-left: 5px;padding-right: 5px;'>".$rowstatusER[1]."</td>
				                        <td style='border-left: 1px solid;border-right: 1px solid;border-bottom: 1px solid;padding-left: 5px;padding-right: 5px;'>".number_format($rowstatusER[2], 2, '.', ',')."</td>
				                    </tr>";
				                echo	"<tr><td></td><td></td><td></td>
							 				<td style='border-left: 1px solid;border-bottom: 1px solid;padding-left: 5px;padding-right: 5px;'>Subtotal</td>
							 				<td style='border-left: 1px solid;border-right: 1px solid;border-bottom: 1px solid;padding-left: 5px;padding-right: 5px;'>".number_format($rowstatusER[2], 2, '.', ',')."</td></tr>";	

							 	$kuryente = $rowstatusER[2];
	                }else if($catname[0] == 'Water Reading'){
	                	$workorder = mysql_fetch_array(mysql_query("SELECT xdate, mallid FROM tblmaintenance_workorder WHERE workorderid = '". $_POST['workorderid'] ."'", $connection));

		            	$rowstatusER = mysql_fetch_array(mysql_query("SELECT taskstatus, meter_reading, sub_total, id, tenantid FROM tblmaintenance_workorderlist WHERE  workorderid = '". $_POST['workorderid'] ."' AND xcategory = '". $catid[0] ."' ", $connection));
						$elec_amnt = mysql_fetch_array(mysql_query("SELECT elec_amnt FROM mall_setup WHERE mall_id = '". $workorder[1] ."' ", $connection));
		            	$prevkwh = mysql_fetch_array(mysql_query("SELECT meter_reading, reading_date FROM tblmaintenance_workorderlist WHERE meter_reading <> NULL OR meter_reading <> '0' AND xcategory = '". $catid[0] ."' AND tenantid = '". $_POST['tenantid'] ."' AND reading_date LIKE '%". date('Y-m', strtotime($workorder[0].'-1 month')) ."%' ", $connection));

	                    if($prevkwh[0] == ""){
	                        $previousreading = 0;
	                    }else{
	                        $previousreading = $prevkwh[0];
	                    }

	                	echo	"<table class='table table-bordered' style='width: 100%;margin-bottom: 20px;'>
									<tr>
										<th style='background-color: #666;color: white;' colspan='12'><center>".$catname[0]."</center></th>
									</tr>
									<tr>
										<th colspan='2' style='border-left: 1px solid;border-bottom: 1px solid;padding-left: 5px;padding-right: 5px;'>Date of Reading</th>
				                        <th colspan='2' style='border-left: 1px solid;border-bottom: 1px solid;padding-left: 5px;padding-right: 5px;'>Meter Reading</th>
				                        <th rowspan='2' style='border-left: 1px solid;border-right: 1px solid;border-bottom: 1px solid;padding-left: 5px;padding-right: 5px;'>Amount</th>
				                    </tr>
				                    <tr>
				                    	<td style='border-left: 1px solid;border-bottom: 1px solid;padding-left: 5px;padding-right: 5px;'>From</td>
				                    	<td style='border-left: 1px solid;border-bottom: 1px solid;padding-left: 5px;padding-right: 5px;'>To</td>
				                    	<td style='border-left: 1px solid;border-bottom: 1px solid;padding-left: 5px;padding-right: 5px;'>Previous</td>
				                    	<td style='border-left: 1px solid;border-bottom: 1px solid;padding-left: 5px;padding-right: 5px;'>Present</td>
				                    </tr>
				                    <tr>
				                    	<td style='border-left: 1px solid;border-bottom: 1px solid;padding-left: 5px;padding-right: 5px;'>".date('m/d/Y',strtotime($prevkwh[1]))."</td>
				                    	<td style='border-left: 1px solid;border-bottom: 1px solid;padding-left: 5px;padding-right: 5px;'>".date('m/d/Y',strtotime($workorder[0]))."</td>
				                        <td style='border-left: 1px solid;border-bottom: 1px solid;padding-left: 5px;padding-right: 5px;'>".
				                        $previousreading."</td>
				                        <td style='border-left: 1px solid;border-bottom: 1px solid;padding-left: 5px;padding-right: 5px;'>".$rowstatusER[1]."</td>
				                        <td style='border-left: 1px solid;border-right: 1px solid;border-bottom: 1px solid;padding-left: 5px;padding-right: 5px;'>".number_format($rowstatusER[2], 2, '.', ',')."</td>
				                    </tr>";
				        echo	"<tr><td></td><td></td><td></td>
				 				<td style='border-left: 1px solid;border-bottom: 1px solid;padding-left: 5px;padding-right: 5px;'>Subtotal</td>
				 				<td style='border-left: 1px solid;border-right: 1px solid;border-bottom: 1px solid;padding-left: 5px;padding-right: 5px;'>".number_format($rowstatusER[2], 2, '.', ',')."</td></tr>";
				 				$tubig =  $rowstatusER[2];
	                }else{
	                	if($catname[0] != 'Electric Reading' || $catname[0] != 'Water Reading'){

	                		echo 	"<table class='table table-bordered' style='width: 100%;margin-bottom: 20px;'>
										<tr>
											<th style='background-color: #666;color: white;' colspan='12'><center>".$catname[0]."</center></th>
										</tr>
										<tr>
											<th style='border-left: 1px solid;border-bottom: 1px solid;padding-left: 5px;padding-right: 5px;'>Task Name</th>
					                        <th style='border-left: 1px solid;border-bottom: 1px solid;padding-left: 5px;padding-right: 5px;'>Equipment</th>
					                        <th style='border-left: 1px solid;border-bottom: 1px solid;padding-left: 5px;padding-right: 5px;'>Status</th>
					                        <th style='border-left: 1px solid;border-bottom: 1px solid;padding-left: 5px;padding-right: 5px;'>Total Duration</th>
					                        <th style='border-left: 1px solid;border-right: 1px solid;border-bottom: 1px solid;padding-left: 5px;padding-right: 5px;'>Amount</th>
					                    </tr>";
	                		$amount = 0;
		                	$restaskid = mysql_query(" SELECT xtaskid, id FROM tblmaintenance_workorderlist WHERE workorderid = '". $_POST['workorderid'] ."' AND xcategory = '". $catid[0] ."' ", $connection);
				            while($rowtaskid = mysql_fetch_array($restaskid)){
				            	$rowtaskinfo = mysql_fetch_array(mysql_query(" SELECT description, amount, equipmentname, id FROM tblmaintenance_tasklist WHERE taskid = '". $rowtaskid[0] ."' ", $connection));

				            	$rowstatus = mysql_fetch_array(mysql_query(" SELECT taskstatus, schedline, id FROM tblmaintenance_workorderlist WHERE xtaskid = '". $rowtaskid[0] ."' AND workorderid = '". $_POST['workorderid'] ."' AND xcategory = '". $catid[0] ."' AND id = '". $rowtaskid[1] ."' ", $connection));
				            	$totalduration = 0;
				            	$duration = explode("#", $rowstatus[1]);
				            	for($i=1; $i<=count($duration); $i++){
				            		$duration2 = explode("|", $duration[$i]);
				            		$totalduration = $totalduration + $duration2[4];
				            	}
				            	$amount += floatval($rowtaskinfo[1]);

				            	if($rowtaskid[0] != ""){
				            		
				            		
				            	echo "<tr>
				            			<td style='border-left: 1px solid;border-bottom: 1px solid;padding-left: 5px;padding-right: 5px;'>".$rowtaskinfo[0]."</td>
				            			<td style='border-left: 1px solid;border-bottom: 1px solid;padding-left: 5px;padding-right: 5px;'>".$rowtaskinfo[2]."</td>
				            			<td style='border-left: 1px solid;border-bottom: 1px solid;padding-left: 5px;padding-right: 5px;'>".$rowstatus[0]."</td>
				            			<td style='border-left: 1px solid;border-bottom: 1px solid;padding-left: 5px;padding-right: 5px;'>".number_format($totalduration, 1, '.', '')."</td>
				            			<td style='border-left: 1px solid;border-right: 1px solid;border-bottom: 1px solid;padding-left: 5px;padding-right: 5px;'>".$rowtaskinfo[1]."</td>
				            		</tr>";
				            	}
				            }
				            echo	"<tr><td></td><td></td><td></td>
				 				<td style='border-left: 1px solid;border-bottom: 1px solid;padding-left: 5px;padding-right: 5px;'>Subtotal</td>
				 				<td style='border-left: 1px solid;border-right: 1px solid;border-bottom: 1px solid;padding-left: 5px;padding-right: 5px;'>".number_format($amount, 2, '.', ',')."</td></tr>";
				 		$gawain = $gawain + $amount;	
				        }
	                }
			}
			$totalamount = $gawain + $kuryente + $tubig;
				echo "<tr>

							<td colspan='4' style='text-align:right;'>Total Amount</td>
							<td style='color:red;padding-left:5px;font-weight:bold;'>Php ".number_format($totalamount, 2, '.', ',')."</td></tr>";
			echo	"</table>";
		break;

		case 'savewomodalscheduling':
			$wopersonnelname = mysql_fetch_array(mysql_query("SELECT CONCAT(firstname, ' ', lastname) FROM tbluser WHERE userid = '". $_POST['wopersonnel'] ."' ", $connection));
			$sql = " UPDATE tblmaintenance_workorder SET startdate = '". date('Y-m-d', strtotime($_POST['woschedstartdate'])) ."', enddate = '". date('Y-m-d',strtotime($_POST['woschedenddate'])) ."', starttime = '". $_POST['woschedstarttime'] ."', endtime = '". $_POST['woschedendtime'] ."', departmentid = '". $_POST['wodep'] ."', workerid = '". $_POST['wopersonnel'] ."', workername = '". $wopersonnelname[0] ."' WHERE workorderid = '". $_POST['jonumber'] ."' ";
			$res = mysql_query($sql, $connection);
			if($res == true){
				echo 1;
			}
		break;

		case 'thiswilldetermineeverythingthatishappeningtoyourlife':
			$sql = " SELECT DISTINCT(taskstatus) FROM tblmaintenance_workorderlist WHERE workorderid = '". $_POST['workorderid'] ."' ORDER BY taskstatus ASC";
			$res = mysql_query($sql, $connection);
			$row = mysql_fetch_array($res);
			echo $row[0];
		break;

		case 'settaskasresolve':
			$sql = " UPDATE tblmaintenance_workorder SET xstatus = 'Resolved' WHERE workorderid = '". $_POST['jonumber'] ."' ";
			$res = mysql_query($sql, $connection);
			if($res == true){
				echo 1;
			}
		break;

		case 'printbydaterange':
			$sql = " SELECT workorderid, TenantID, ownername, xdate, xtime, workerid, workername, remarks, xstatus, joformanagement, Complaint_Series_No FROM tblmaintenance_workorder WHERE xdate BETWEEN '".date("Y-m-d", strtotime($_POST['datefrom']))."' AND '".date("Y-m-d", strtotime($_POST['dateto']))."' AND mallid = '". $_POST['mallid'] ."' ";
					$res = mysql_query($sql, $connection);
					while( $row = mysql_fetch_array($res) ){
						$tradename = mysql_fetch_array(mysql_query("SELECT tradename FROM tbltrans_tenants WHERE tenantID = '". $row[1] ."' ", $connection));
						$complaints = mysql_fetch_array(mysql_query("SELECT Complaint_Status, Complaint_Code FROM tblcomplaints WHERE Complaint_Series_No = '". $row[10] ."' ", $connection));

							if($complaints[0] == "Ongoing"){
								$complaintstatus = '<span class="fa fa-circle" style="color: #428BCA;"></span>';
							}else if($complaints[0] == "Pending"){
								$complaintstatus = '<span class="fa fa-circle" style="color: #FF892A;"></span>';
							}else{
								$complaintstatus = '<span class="fa fa-circle" style="color: #69AA46;"></span>';
							}

							if ($row[8] == 'Pending') {
								$stats = '<span class="label label-warning">'.$row[8].'</span>';
							}
							else if($row[8] == 'Resolved'){
								$stats = '<span class="label label-success">'.$row[8].'</span>';
							}
						?>
							<tr>
								<td style="vertical-align: top;border-right: 1px solid;border-top: 1px solid;"><?php echo $row[0]; ?></td>						
								<td style="vertical-align: top;border-right: 1px solid;border-top: 1px solid;"><?php echo date('F d, Y', strtotime($row[3])); ?></td>						
								<td style="vertical-align: top;border-right: 1px solid;border-top: 1px solid;"><?php echo $tradename[0]; ?></td>						
								<td style="vertical-align: top;border-right: 1px solid;border-top: 1px solid;">
								<?php
									if($row[10] == ""){
										$res2 = mysql_query("SELECT xcategory, taskstatus FROM tblmaintenance_workorderlist WHERE workorderid = '". $row[0] ."' ", $connection);
										while($joblist = mysql_fetch_array($res2)){
											$catname = mysql_fetch_array(mysql_query("SELECT category FROM tblmaintenance_category WHERE category_id = '". $joblist[0] ."' ", $connection));
											if($joblist[1] == 'Resolved'){
												$span2 = '<span class="fa fa-circle" style="color: #69AA46;"></span>&nbsp;'.$catname[0].'<br/>';
											}else if($joblist[1] == 'Pending'){
												$span2 = '<span class="fa fa-circle" style="color: #FF892A;"></span>&nbsp;'.$catname[0].'<br/>';
											}else if($joblist[1] == 'Ongoing'){
												$span2 = '<span class="fa fa-circle" style="color: #428BCA;"></span>&nbsp;'.$catname[0].'<br/>';
											}
											echo $span2;
										}
									}
									else{
										echo $complaintstatus." ".$complaints[1];
									}
								?>
								</td>						
								<td style="vertical-align: top;border-right: 1px solid;border-top: 1px solid;"><?php echo $row[6]; ?></td>						
								<td style="vertical-align: top;border-top: 1px solid;"><?php echo $stats; ?></td>
						<?php				
							echo "</tr>";
					}
					echo "|".date('F d, Y', strtotime($_POST['datefrom'])) . "|" . date('F d, Y', strtotime($_POST['dateto']));
		break;

		case 'showwomodalscheduling':
			$sql = " SELECT startdate, enddate, starttime, endtime, duration FROM tblmaintenance_workorder WHERE workorderid = '". $_POST['jonumber'] ."' ";
			$res = mysql_query($sql, $connection);
			$row = mysql_fetch_array($res);

			if($row[0] == ""){
				$date1 = date('Y-m-d');
			}else{
				$date1 = $row[0];
			}

			if($row[1] == ""){
				$date2 = "";
			}else{
				$date2 = $row[1];
			}

			if($row[2] == ""){
				$time1 = date('H:i');
			}else{
				$time1 = $row[2];
			}

			if($row[3] == ""){
				$time2 = "";
			}else{
				$time2 = $row[3];
			}

			echo $date1 . "|" . $date2 . "|" . $time1 . "|" . $time2;
		break;

		case 'resolvingofcomplaint':
			$sched = mysql_fetch_array(mysql_query("SELECT Time_Received, Time_Resolved, duration, remarks FROM tblcomplaints WHERE Complaint_Series_No = '". $_POST['csn'] ."' ", $connection));
			$amount = mysql_fetch_array(mysql_query("SELECT totalamount FROM tblmaintenance_workorder WHERE Complaint_Series_No = '". $_POST['csn'] ."' ", $connection));
			$arr = explode(" ", $sched[0]);
			$arr2 = explode(" ", $sched[1]);

			if($arr[0] == ""){
				$property = "";
				$val = date('m/d/Y');
			}else{
				$property = "disabled";
				$val = date('m/d/Y', strtotime($arr[0]));
			}

			if($arr[1] == ""){
				$property2 = "";
				$val2 = date('H:i');
			}else{
				$property2 = "disabled";
				$val2 = date('H:i', strtotime($arr[1]));
			}

			if($arr2[0] == ""){
				$property3 = "";
				$val3 = date('m/d/Y');
			}else{
				$property3 = "disabled";
				$val3 = date('m/d/Y', strtotime($arr2[0]));
			}

			if($arr2[1] == ""){
				$property4 = "";
				$val4 = date('H:i');
			}else{
				$property4 = "disabled";
				$val4 = date('H:i', strtotime($arr2[1]));
			}

			if($sched[2] == ""){
				$property5 = "";
			}else{
				$property5 = "disabled";
			}

			if($amount[0] == ""){
				$property6 = "";
			}else{
				$property6 = "disabled";
			}

			if($sched[3] == ""){
				$property7 = "";
			}else{
				$property7 = "disabled";
			}

				echo "
					<div class='col-xs-6 col-md-6 col-lg-6'>
                        <div class='row form-group'>
                            <div class='col-xs-4 col-md-4 col-lg-4'>
                                Start Date
                            </div>
                            <div class='col-xs-8 col-md-8 col-lg-8'>
                                <div class='input-group'>
                                    <input type='text' class='form-control date-picker' ".$property." id='complaintstartdate' value='". $val ."'>
                                    <label class='input-group-addon'><i class='fa fa-calendar'></i></label>
                                </div>
                            </div>
                        </div>
                        <div class='row form-group'>
                            <div class='col-xs-4 col-md-4 col-lg-4'>
                                End Date
                            </div>
                            <div class='col-xs-8 col-md-8 col-lg-8'>
                                <div class='input-group'>
                                    <input type='text' class='form-control date-picker' ".$property3." value='". $val3 ."' id='complaintenddate'>
                                    <label class='input-group-addon'><i class='fa fa-calendar'></i></label>
                                </div>
                            </div>
                        </div>
                        <div class='row form-group'>
                            <div class='col-xs-4 col-md-4 col-lg-4'>
                                Duration
                            </div>
                            <div class='col-xs-8 col-md-8 col-lg-8'>
                                <div class='input-group'>
                                    <input type='text' class='form-control durationsdsdsd numberlang' ".$property5." placeholder='0.0' value='". $sched[2] ."' id='complaintduration'>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class='col-xs-6 col-md-6 col-lg-6'>
                        <div class='row form-group'>
                            <div class='col-xs-4 col-md-4 col-lg-4'>
                                Start Time
                            </div>
                            <div class='col-xs-8 col-md-8 col-lg-8'>
                                <div class='input-group'>
                                    <input type='time' class='form-control' id='complaintstarttime' ".$property2." value='". $val2 ."'>
                                    <label class='input-group-addon'><i class='fa fa-clock-o'></i></label>
                                </div>
                            </div>
                        </div>
                        <div class='row form-group'>
                            <div class='col-xs-4 col-md-4 col-lg-4'>
                                End Time
                            </div>
                            <div class='col-xs-8 col-md-8 col-lg-8'>
                                <div class='input-group'>
                                    <input type='time' class='form-control' ".$property4." value='". $val4 ."' id='complaintendtime'>
                                    <label class='input-group-addon'><i class='fa fa-clock-o'></i></label>
                                </div>
                            </div>
                        </div>
                        <div class='row form-group'>
                            <div class='col-xs-4 col-md-4 col-lg-4'>
                                Amount
                            </div>
                            <div class='col-xs-8 col-md-8 col-lg-8'>
                                <div class='input-group'>
                                    <input type='text' class='form-control halaga numberlang' ".$property6." placeholder='0.00' value='".$amount[0]."' id='complaintamount'>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class='col-xs-12 col-md-12 col-lg-12'>
                        <div class='row form-group'>
                            <div class='col-xs-2 col-md-2 col-lg-2'>
                                Remarks
                            </div>
                            <div class='col-xs-10 col-md-10 col-lg-10'>
                                <textarea class='form-control text_inquiry' id='complaintremarks' style='height: 90px;resize: none;' ".$property7.">". $sched[3] ."</textarea>
                            </div>
                        </div>
                    </div>";
		break;

		case 'saveresolvingofcomplaint':
			$sql = " UPDATE tblcomplaints SET Time_Resolved = '". date('Y-m-d', strtotime($_POST['enddate'])) .' '. date('H:i:s', strtotime($_POST['endtime'])) ."', Duration = '". $_POST['duration'] ."', Complaint_Status = 'Resolved', remarks = '". $_POST['remarks'] ."' WHERE Complaint_Series_No = '". $_POST['csn'] ."' ";
			$res = mysql_query($sql, $connection);
			if($res == true){
				$sql2 = " UPDATE tblmaintenance_workorder SET enddate = '". date('Y-m-d', strtotime($_POST['enddate'])) ."', endtime = '". date('H:i:s', strtotime($_POST['endtime'])) ."', duration = '". $_POST['duration'] ."', xstatus = 'Resolved', remarks = '". $_POST['remarks'] ."', totalamount = '". $_POST['amount'] ."' WHERE Complaint_Series_No = '". $_POST['csn'] ."' ";
				$res2 = mysql_query($sql2, $connection);
				if($res2 == true){
					echo 1;
				}
			}
		break;

		case 'inputreading':
			$modalinfo = mysql_fetch_array(mysql_query("SELECT meter_reading, meter_img FROM tblmaintenance_workorderlist WHERE workorderid = '". $_POST['workorderid'] ."' AND xcategory = '". $_POST['catid'] ."' AND id = '". $_POST['id'] ."' AND tenantid = '". $_POST['tenantid'] ."' ", $connection));
			echo $modalinfo[0] . "|" . $modalinfo[1];
		break;

		case 'postingconfirmed':
			$startdate = mysql_fetch_array(mysql_query("SELECT startdate FROM tblmaintenance_workorder WHERE workorderid = '". $_POST['workorderid'] ."' ", $connection));
			$date = date('Y-m-01', strtotime($startdate[0]));
			$sql = "SELECT xcategory, xtaskid, meter_reading, sub_total, tenantid, count(workorderid) FROM tblmaintenance_workorderlist WHERE workorderid = '". $_POST['workorderid'] ."' ";
			$res = mysql_query($sql, $connection);
			while ($row = mysql_fetch_array($res)) {
				if($row[5] == 0){
					$rowcomplaint = mysql_fetch_array(mysql_query("SELECT TenantID, Complaint_Series_No, totalamount FROM tblmaintenance_workorder WHERE workorderid = '". $_POST['workorderid'] ."' ", $connection));
					$rowtblcomplaint = mysql_fetch_array(mysql_query("SELECT Complaint_Code, Complete_Description FROM tblcomplaints WHERE Complaint_Series_No = '". $rowcomplaint[1] ."' ", $connection)); 
						$sqlinsertcomplaint = "INSERT INTO tbltransaction SET tenantid = '". $rowcomplaint[0] ."', xcode = '". $rowcomplaint[1] ."', description = '". $rowtblcomplaint[1] ."', xdescription = '". $rowtblcomplaint[0] ."', amount = '". $rowcomplaint[2] ."', qty = '1', balance = '". $rowcomplaint[2] ."', totalamount = '". $rowcomplaint[2] ."', userid = '". $_COOKIE['userid'] ."', xdate = '". $date ."' ";
						$resinsertcomplaint = mysql_query($sqlinsertcomplaint, $connection);
						if($resinsertcomplaint == true){
							$sqlpostcomplaint = "UPDATE tblmaintenance_workorder SET postingstatus = 'Posted', dateposted = '". date('Y-m-d') ."' WHERE workorderid = '". $_POST['workorderid'] ."' ";
							$respostcomplaint = mysql_query($sqlpostcomplaint, $connection);
						}
				}


				$catname = mysql_fetch_array(mysql_query("SELECT category FROM tblmaintenance_category WHERE category_id = '". $row[0] ."' ", $connection));
				$taskname = mysql_fetch_array(mysql_query("SELECT description, amount FROM tblmaintenance_tasklist WHERE taskid = '". $row[1] ."' ", $connection));

					if($catname[0] == 'Electric Reading' || $catname[0] == 'Water Reading'){
						$inserter = "INSERT INTO tbltransaction SET tenantid = '". $row[4] ."', xcode = '". $row[0] ."', amount = '". $row[3] ."', totalamount = '". $row[3] ."', qty = '". $row[2] ."', balance = '". $row[3] ."', xdate = '". $date ."', userid = '". $_COOKIE['userid'] ."', xdescription = '". $catname[0] ."', description = '". $catname[0] ."' ";
						$resinserter = mysql_query($inserter, $connection);
						if($resinserter == true){
							$sqlupdateewr = "UPDATE tblmaintenance_workorder SET postingstatus = 'Posted', dateposted = '". date('Y-m-d') ."' WHERE workorderid = '". $_POST['workorderid'] ."' ";
							$resupdateewr = mysql_query($sqlupdateewr, $connection);
							if($resupdateewr == true){
								$update1v1 = "UPDATE tblmaintenance_workorderlist SET xstatus = 'Posted', dateposted = '". date('Y-m-d') ."' where workorderid = '". $_POST['workorderid'] ."' ";
								$resupdate1v1 = mysql_query($update1v1, $connection);
							}
						}
					}
					else{
						if($catname[0] != 'Electric Reading' || $catname[0] != 'Water Reading'){
						$sqlinsert = "INSERT INTO tbltransaction SET tenantid = '". $row[4] ."', xcode = '". $row[1] ."', amount = '". $taskname[1] ."', totalamount = '". $taskname[1] ."', qty = '1', balance = '". $taskname[1] ."', xdate = '". $date ."', description = '". $taskname[0] ."', userid = '". $_COOKIE['userid'] ."', xdescription = '". $catname[0] ."' ";
						$resinsert = mysql_query($sqlinsert, $connection);
							if($resinsert == true){
								$sqlupdateewr = "UPDATE tblmaintenance_workorder SET postingstatus = 'Posted', dateposted = '". date('Y-m-d') ."' WHERE workorderid = '". $_POST['workorderid'] ."' ";
								$resupdateewr = mysql_query($sqlupdateewr, $connection);
								if($resupdateewr == true){
									$update1v1 = "UPDATE tblmaintenance_workorderlist SET xstatus = 'Posted', dateposted = '". date('Y-m-d') ."' where workorderid = '". $_POST['workorderid'] ."' ";
									$resupdate1v1 = mysql_query($update1v1, $connection);
								}	
							}
						}
					}
			}
		break;

		case 'showtypeofbudget':
			echo "<option value=''>-- Select Utilities --</option>";
			$res = mysql_query("SELECT category_id, category FROM tblmaintenance_category", $connection);
			while($row = mysql_fetch_array($res)){
				echo "<option value=".$row[0].">".$row[1]."</option>";
			}
		break;

		case 'savebudgetperyear':
			$action = "";
			$checkyear = mysql_fetch_array(mysql_query("SELECT xyear FROM tblref_budget WHERE xyear = '". $_POST['year'] ."' AND category_id = '". $_POST['utility'] ."' ", $connection));
			$catname = mysql_fetch_array(mysql_query("SELECT category FROM tblmaintenance_category WHERE category_id = '". $_POST['utility'] ."' ", $connection));
			if($checkyear[0] == ""){
				$sql = "INSERT INTO tblref_budget SET xyear = '". $_POST['year'] ."', xjan = '". $_POST['xjan'] ."', xfeb = '". $_POST['xfeb'] ."', xmar = '". $_POST['xmar'] ."', xapr = '". $_POST['xapr'] ."', xmay = '". $_POST['xmay'] ."', xjun = '". $_POST['xjun'] ."', xjul = '". $_POST['xjul'] ."', xaug = '". $_POST['xaug'] ."', xsep = '". $_POST['xsep'] ."', xoct = '". $_POST['xoct'] ."', xnov = '". $_POST['xnov'] ."', xdec = '". $_POST['xdec'] ."', category_id = '". $_POST['utility'] ."', category = '". $catname[0] ."' ";
				$action = "created";
			}else{
				$sql = "UPDATE tblref_budget SET xjan = '". $_POST['xjan'] ."', xfeb = '". $_POST['xfeb'] ."', xmar = '". $_POST['xmar'] ."', xapr = '". $_POST['xapr'] ."', xmay = '". $_POST['xmay'] ."', xjun = '". $_POST['xjun'] ."', xjul = '". $_POST['xjul'] ."', xaug = '". $_POST['xaug'] ."', xsep = '". $_POST['xsep'] ."', xoct = '". $_POST['xoct'] ."', xnov = '". $_POST['xnov'] ."', xdec = '". $_POST['xdec'] ."', category = '". $catname[0] ."', xdateupdate = '". date('Y-m-d H:i:s') ."' WHERE xyear = '". $_POST['year'] ."' AND category_id = '". $_POST['utility'] ."' ";
				$action = "updated";
			}
			$res = mysql_query($sql, $connection);
			if($res == true){
				echo $catname[0]."|".$_POST['year']."|".$action;
			}
		break;

		case 'addbudgetperyear':
			$catname = mysql_fetch_array(mysql_query("SELECT category FROM tblmaintenance_category WHERE category_id = '". $_POST['utility'] ."' ", $connection));
			$budget = mysql_fetch_array(mysql_query("SELECT category, xjan, xfeb, xmar, xapr, xmay, xjun, xjul, xaug, xsep, xoct, xnov, xdec FROM tblref_budget WHERE category_id = '". $_POST['utility'] ."' ", $connection));
			echo $catname[0] . "|" . $budget[1] . "|" . $budget[2] . "|" . $budget[3] . "|" . $budget[4] . "|" . $budget[5] . "|" . $budget[6] . "|" . $budget[7] . "|" . $budget[8] . "|" . $budget[9] . "|" . $budget[10] . "|" . $budget[11] . "|" . $budget[12];
		break;

		case 'tblbudget':
			$sql = " SELECT category, xyear, xjan, xfeb, xmar, xapr, xmay, xjun, xjul, xaug, xsep, xoct, xnov, xdec FROM tblref_budget ";
			$res = mysql_query($sql, $connection);
			while($row = mysql_fetch_array($res)){
				?>
					<tr>
						<td><?php echo $row[0]; ?></td>
						<td><?php echo $row[1]; ?></td>
						<td><?php echo number_format($row[2], 2, '.', ','); ?></td>
						<td><?php echo number_format($row[3], 2, '.', ','); ?></td>
						<td><?php echo number_format($row[4], 2, '.', ','); ?></td>
						<td><?php echo number_format($row[5], 2, '.', ','); ?></td>
						<td><?php echo number_format($row[6], 2, '.', ','); ?></td>
						<td><?php echo number_format($row[7], 2, '.', ','); ?></td>
						<td><?php echo number_format($row[8], 2, '.', ','); ?></td>
						<td><?php echo number_format($row[9], 2, '.', ','); ?></td>
						<td><?php echo number_format($row[10], 2, '.', ','); ?></td>
						<td><?php echo number_format($row[11], 2, '.', ','); ?></td>
						<td><?php echo number_format($row[12], 2, '.', ','); ?></td>
						<td><?php echo number_format($row[13], 2, '.', ','); ?></td>
					</tr>
				<?php
			}
		break;

		case 'showfilterofmall':
			echo "<option value=''>-- Select Mall --</option>";
			$res = mysql_query("SELECT mallid, mallname FROM tblref_mall", $connection);
			while ($row = mysql_fetch_array($res)) {
				echo "<option value=".$row[0].">".$row[1]."</option>";
			}
		break;

		case 'template':
			$template = mysql_fetch_array(mysql_query("SELECT template FROM tblsys_setup2"));
			$row = mysql_fetch_array(mysql_query("SELECT mallname, malladdress, telephone_number, email, mall_image FROM tblref_mall WHERE mallid = '".$_POST['mallid']."' ", $connection));
			if($template[0] == "1")
			{
				echo "<tr>
				      	<td width='130px;padding:0px !important;'><img src='server/mall_image/".$row[4]." ' style='height: 130px; width: 120px;'></td>
				      	<td style='padding-top:0px;'>
				      		<p style='padding: 0px; display: block;margin:0px;'><h2>".$row[0]."</h2></p>
				      		<p style='padding: 0px; display: block;margin:0px;'>".$row[1]."</p>
				      		<p style='padding: 0px; display: block;margin:0px;'>".$row[2]."</p>
				      		<p style='padding: 0px; display: block;margin:0px;'>".$row[3]."</p>
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
					  		<p style='padding: 0px; display: block;margin:0px;'><h2>".$row[0]."</h2></p>
					  		<p style='padding: 0px; display: block;margin:0px;'>".$row[1]."</p>
					  		<p style='padding: 0px; display: block;margin:0px;'>".$row[2]."</p>
					  		<p style='padding: 0px; display: block;margin:0px;'>".$row[3]."</p>
					  	</td>
					  </tr>";
			}
		break;

		case 'showwodep':
			echo "<option value=''>-- Select Department --</option>";
			$res = mysql_query("SELECT groupid, groupname FROM tblref_groupaccess", $connection);
			while($row = mysql_fetch_array($res)){
				echo "<option value=".$row[0].">".$row[1]."</option>";
			}
		break;

		case 'showwopersonnel':
			echo "<option value=''>-- Select Personnel --</option>";
			$res = mysql_query("SELECT userid, CONCAT(firstname, ' ', lastname) FROM tbluser WHERE groupaccess = '". $_POST['dep'] ."'", $connection);
			while($row = mysql_fetch_array($res)){
				echo "<option value=".$row[0].">".$row[1]."</option>";
			}
		break;












		// case 'savemanualjoborderreport':
		// 	$start = date('Y-m-d H:i:s', strtotime($_POST['manualdateFrom'] . ' ' . $_POST['manualtimestarted']));
		// 	$end = date('Y-m-d H:i:s', strtotime($_POST['manualdateTo'] . ' ' . $_POST['manualtimeended']));

		// 	$datetime1 = new DateTime($start);
		// 	$datetime2 = new DateTime($end);
		// 	$interval = $datetime1->diff($datetime2);

		// 	$txtlabor = $_POST['temp'];
		// 	$txtparts = $_POST['temp2'];
		// 	$chargestype = $_POST['txtchargestype'];

		// 	$arr = explode(",", $chargestype);
		// 	$chargestype2 = "";
		// 	$count = count($arr);
		// 	for($a=0;$a<=$count-1;$a++){
		// 	$chargestype2 = $chargestype2 ."'" . $arr[$a] . "'" . ",";
		// 	}

		// 	$sqlmain = " SELECT chrgid, chrgname FROM tblref_charges WHERE chrgname IN (". substr(trim($chargestype2), 0, -1) .") ";
		// 	$resmain = mysql_query($sqlmain, $connection);
		// 	while($rowmain = mysql_fetch_array($resmain)){

		// 		switch ($rowmain[1]) {
		// 			case 'Water Bill':
		// 				$sqlchrg = " SELECT watr_amnt from mall_setup WHERE mall_id = '". $_POST['building_idsabush'] ."' ";
		// 				$reschrg = mysql_query($sqlchrg, $connection);
		// 				$chrgamount = mysql_fetch_array($reschrg);

		// 				$sqlcubic_meter = " SELECT cubic_meter FROM pmls_android_worker_task_history WHERE cubic_meter <> NULL OR cubic_meter <> '0' AND room_owner_id = '". $_POST['tenantidsabush'] ."' ORDER BY id DESC LIMIT 1 ";
		// 				$rescubic_meter = mysql_query($sqlcubic_meter, $connection);
		// 				$cubic_meter = mysql_fetch_array($rescubic_meter);

		// 				$currentreading = $_POST['cmmanual'] - $cubic_meter[0];
		// 				$totalamountwater = $currentreading * $chrgamount[0];

		// 				$sql = " SELECT chrgid, chrgname FROM tblref_charges WHERE chrgname = '". $rowmain[1] ."' ";
		// 		    			$res = mysql_query($sql, $connection);
		// 		    			$row = mysql_fetch_array($res);

		// 				$charge_detail_id = createidno("CD", "tbl_charges_detail", "charge_detail_id");
		// 				$sqllabor = " INSERT INTO tbl_charges_detail SET xquantity = '". $_POST['cmmanual'] ."', charge_amount = '". $totalamountwater ."', staff_task_id = '". $_POST['joseries'] ."', charge_detail_id = '". $charge_detail_id ."', charge_type_id = '". $row[0] ."', remarks = '". $_POST['cmremarks'] ."', sched = '" . $_POST['schedsabush'] . "' ";
		// 				$reslabor = mysql_query($sqllabor, $connection);
		// 				$row = mysql_fetch_array($reslabor);

		// 			break;

		// 			case 'Electric Bill':
		// 				$sqlchrg = " SELECT elec_amnt from mall_setup WHERE mall_id = '". $_POST['building_idsabush'] ."' ";
		// 				$reschrg = mysql_query($sqlchrg, $connection);
		// 				$chrgamount = mysql_fetch_array($reschrg);

		// 				$sqlkilowatt = " SELECT kilowatt FROM pmls_android_worker_task_history WHERE kilowatt <> NULL OR kilowatt <> '0' AND room_owner_id = '". $_POST['tenantidsabush'] ."' ORDER BY id DESC LIMIT 1 ";
		// 				$reskilowatt = mysql_query($sqlkilowatt, $connection);
		// 				$kilowatt = mysql_fetch_array($reskilowatt);

		// 				$currentreading = $_POST['kwhmanual'] - $kilowatt[0];
		// 				$totalamountelectric = $currentreading * $chrgamount[0];

		// 				$sql = " SELECT chrgid, chrgname FROM tblref_charges WHERE chrgname = '". $rowmain[1] ."' ";
		//     			$res = mysql_query($sql, $connection);
		//     			$row = mysql_fetch_array($res);

		// 				$charge_detail_id = createidno("CD", "tbl_charges_detail", "charge_detail_id");
		// 				$sqllabor = " INSERT INTO tbl_charges_detail SET xquantity = '". $_POST['kwhmanual'] ."', charge_amount = '". $totalamountelectric ."', staff_task_id = '". $_POST['joseries'] ."', charge_detail_id = '". $charge_detail_id ."', charge_type_id = '". $row[0] ."', remarks = '". $_POST['kwhremarks'] ."', sched = '" . $_POST['schedsabush'] . "' ";
		// 				$reslabor = mysql_query($sqllabor, $connection);
		// 				$row = mysql_fetch_array($reslabor);
						
		// 			break;

		// 			case 'Parts':
		// 				$partstotal = 0;
		// 				$partsquantity = 0;
		// 				$arr = explode("|", $txtparts);
		// 				$count = count($arr);
		// 				for($a=0;$a<=$count-2;$a++){
		// 					$arr2 = explode("...", $arr[$a]);
		// 						$partstotal = $partstotal + $arr2[1];
		// 					$arr3 = explode(",,,", $arr[$a]);
		// 						$partsquantity = $partsquantity + $arr3[1];
		// 					$arr4 = explode(",,,", $arr2[1]);

		// 				$sql = " SELECT chrgid, chrgname FROM tblref_charges WHERE chrgname = '". $rowmain[1] ."' ";
		//     			$res = mysql_query($sql, $connection);
		//     			$row = mysql_fetch_array($res);

	 //    				$charge_detail_id = createidno("CD", "tbl_charges_detail", "charge_detail_id");
	 //    				$sqllabor = " INSERT INTO tbl_charges_detail SET remarks = '". $arr2[0] ."', charge_amount = '". $arr4[0] ."', staff_task_id = '". $_POST['joseries'] ."', charge_detail_id = '". $charge_detail_id ."', charge_type_id = '". $row[0] ."', xquantity = '". $arr3[1] ."', sched = '" . $_POST['schedsabush'] . "' ";
	 //    				$reslabor = mysql_query($sqllabor, $connection);
	 //    				$rowlabor = mysql_fetch_array($reslabor);
		// 				}

		// 				$partstotalamount = $partstotal * $partsquantity;
		// 			break;

		// 			case 'Labor':
		// 				$labortotal = 0;
		// 				$laborarr = explode("|", $txtlabor);
		// 				$laborcount = count($laborarr);
		// 				for($a=0;$a<=$laborcount-2;$a++){
		// 				$laborarr2 = explode("...", $laborarr[$a]);
		// 				$labortotal = $labortotal + $laborarr2[1];

		// 				$sql = " SELECT chrgid, chrgname FROM tblref_charges WHERE chrgname = '". $rowmain[1] ."' ";
		//     			$res = mysql_query($sql, $connection);
		//     			$row = mysql_fetch_array($res);

		//     			$charge_detail_id = createidno("CD", "tbl_charges_detail", "charge_detail_id");
		// 				$sqllabor = " INSERT INTO tbl_charges_detail SET remarks = '". $laborarr2[0] ."', charge_amount = '". $laborarr2[1] ."', staff_task_id = '". $_POST['joseries'] ."', charge_detail_id = '". $charge_detail_id ."', charge_type_id = '". $row[0] ."', sched = '" . $_POST['schedsabush'] . "' ";
		// 				$reslabor = mysql_query($sqllabor, $connection);
		// 				$rowlabor = mysql_fetch_array($reslabor);
		// 				}
		// 			break;
		// 		}
		// 	}

		// 				$grandtotal = 0;
		// 				$grandtotal = $labortotal + $partstotalamount + $totalamountelectric + $totalamountwater;
		// 				$manualjoreport = "INSERT INTO pmls_android_worker_task_history SET staff_task_id = '" . $_POST['joseries'] . "',
		// 						 room_owner_id = '" . $_POST['tenantidsabush'] . "',
		// 						  ownername = '" . $_POST['ownernamesabush'] ."',
		// 						   building_id = '" . $_POST['building_idsabush'] . "',
		// 						    floorid = '" . $_POST['flooridsabush'] . "',
		// 						     category_tenant ='" . $_POST['categoryTenantsabush'] . "',
		// 						      category_management = '" . $_POST['categoryManagementsabush'] . "',
		// 						       task_id = '" . $_POST['taskidsabush'] . "',
		// 						        location_id = '". $_POST['location_idsabush'] ."',
		// 						         worker_id = '" . $_POST['workeridsabush'] . "',
		// 						          remarks = '" . $_POST['manualdetails'] . "',
		// 						           sched = '" . $_POST['schedsabush'] . "',
		// 						            startt = '".$start."',
		// 						             endt = '".$end."',
		// 						              duration =  '" . $interval->format('%Y-%m-%d %H:%I:%S') . "',
		// 						               tagstat = '" . $chargestype . "',
		// 						                labor_exp = '". $labortotal ."',
		// 						                 material_exp = '". $partstotalamount ."',
		// 						                  kilowatt = '" . $_POST['kwhmanual'] . "',
		// 						                   kilowatt_php = '" . $totalamountelectric . "',
		// 						                    cubic_meter = '" . $_POST['cmmanual'] . "',
		// 						                     cubic_php = '" . $totalamountwater . "',
		// 						                      total_amount = '" . $grandtotal. "',
		// 						                       worker_name = '". $_POST['manualassignperson'] ."' ";

		// 				$resmanualjoreport = mysql_query($manualjoreport, $connection);
		// 				$row = mysql_fetch_array($resmanualjoreports);
						
		// 				$sqldelete = " DELETE FROM pmls_android_worker_task WHERE staff_task_id = '". $_POST['joseries'] ."' ";
		// 				$res = mysql_query($sqldelete, $connection);

		// 				$sql2 = "UPDATE tblcomplaints SET Complaint_Status = 'Resolved', Time_Resolved = '". date("Y-m-d H:i:s", strtotime($end)) ."', Duration = '". $interval->format('%Y-%m-%d %H:%I:%S') ."'  WHERE Complaint_Series_No = '". $_POST["complaintseriesnumber"] ."' ";
		// 				$result2 = mysql_query($sql2, $connection);
		// 				$row2 = mysql_fetch_array($result2);

		// 					echo 1 . "|" . $_POST['joseries'];
		// break;

		// case 'autosettaskWR':
		// 	$sqltenant = " SELECT tenantid, mallid, CONCAT(owner_firstname, ' ', LEFT(owner_midname, 1), '. ', owner_lastname) as ownername, unitid FROM tbltrans_tenants WHERE STATUS = 'actived' AND TenantID != '". $_POST['hindigagawan'] ."' ";
		// 	$restenant = mysql_query($sqltenant, $connection);
		// 	while($rowtenant = mysql_fetch_array($restenant)){

		// 		$sqlunitinfo = " SELECT floorid FROM tblref_unit where unitid = '". $rowtenant[3] ."' ";
		// 		$resunitinfo = mysql_query($sqlunitinfo, $connection);
		// 		$rowunitinfo = mysql_fetch_array($resunitinfo);

		// 			$sqlchargestype = " SELECT chargetypeid FROM tblref_charges_type WHERE description = 'Water Reading' ";
		// 			$reschargestype = mysql_query($sqlchargestype, $connection);
		// 			$rowchargestype = mysql_fetch_array($reschargestype);

		// 				$sqlreftask = " SELECT task_id FROM pmls_android_reftask WHERE description = 'Water Reading' ";
		// 				$resreftask = mysql_query($sqlreftask, $connection);
		// 				$rowreftask = mysql_fetch_array($resreftask);

		// 		$stafftask = createidno("JO", "pmls_android_worker_task", "staff_task_id");
		// 		$sql = " INSERT INTO pmls_android_worker_task SET staff_task_id = '" . $stafftask ."', room_owner_id = '". $rowtenant[0] ."', ownername = '". $rowtenant[2] ."', building_id = '". $rowtenant[1] ."', floorid = '". $rowunitinfo[0] ."', location_id = '". $rowtenant[3] ."', task_id = '". $rowreftask[0] ."', sched = '". date('Y-m-d',strtotime($_POST['automaticsetup'])) ."', category_tenant = '". $rowchargestype[0] ."', worker_name = '". $_POST['youcantseeme'] ."' ";
		// 		$res = mysql_query($sql, $connection) or die(mysql_error());
		// 			if ( $res == true ) {

		// 				$ref = createidno("RN", "tblref_maintenancetasksetup_stat", "refno");
		// 				$sql2 = " INSERT INTO tblref_maintenancetasksetup_stat SET refno = '" . $ref ."', tenantid = '". $rowtenant[0] ."', task = '". $rowreftask[0] ."', taskDate = '". date('Y-m-d',strtotime($_POST['automaticsetup'])) ."', staff_task_id = '". $stafftask ."' ";
		// 				$res2 = mysql_query($sql2, $connection);
		// 					if ( $res2 == true ) {
		// 						echo 1;
		// 					}

		// 			}else{
		// 				echo 2;
		// 			}
		// 	}
		// break;

		// case 'checkdate':
		// 	$arawngpaggawa = date('d',strtotime($_POST['automaticsetup']));
		// 	$sql = " SELECT dateofmonth FROM tblref_maintenancetasksetup ";
		// 	$res = mysql_query($sql, $connection);
		// 	$row = mysql_fetch_array($res);
		// 	if($row[0] == $arawngpaggawa){
		// 		echo $row[0];
		// 	}
		// 	else{
		// 		echo 1;
		// 	}
		// break;

		// case 'checkexistingER':
		// 	$sqlasdf = " SELECT TenantID, taskDate FROM tblref_maintenancetasksetup_stat WHERE stat = '1' AND DAY(taskDate) = '". $_POST['datengpaggawa'] ."' AND task = 'TASK-0000002' ";
		// 	$resasdf = mysql_query($sqlasdf, $connection);
		// 	$subrow = mysql_fetch_array($resasdf);
		// 	$mgaMeron = "";
		// 	if ( $subrow == "" ) {
		// 		$sqltenant = " SELECT tenantid, mallid, CONCAT(owner_firstname, ' ', LEFT(owner_midname, 1), '. ', owner_lastname) as ownername, unitid FROM tbltrans_tenants WHERE STATUS = 'actived' ";
		// 		$restenant = mysql_query($sqltenant, $connection);
		// 		while($rowtenant = mysql_fetch_array($restenant)){

		// 			$sqlunitinfo = " SELECT floorid FROM tblref_unit where unitid = '". $rowtenant[3] ."' ";
		// 			$resunitinfo = mysql_query($sqlunitinfo, $connection);
		// 			$rowunitinfo = mysql_fetch_array($resunitinfo);

		// 			$sqlchargestype = " SELECT chargetypeid FROM tblref_charges_type WHERE description = 'Electricity Reading' ";
		// 			$reschargestype = mysql_query($sqlchargestype, $connection);
		// 			$rowchargestype = mysql_fetch_array($reschargestype);

		// 			$sqlreftask = " SELECT task_id FROM pmls_android_reftask WHERE description = 'Electric Reading' ";
		// 			$resreftask = mysql_query($sqlreftask, $connection);
		// 			$rowreftask = mysql_fetch_array($resreftask);

		// 			$stafftask = createidno("JO", "pmls_android_worker_task", "staff_task_id");
		// 			$sql3 = " INSERT INTO pmls_android_worker_task SET staff_task_id = '" . $stafftask ."', room_owner_id = '". $rowtenant[0] ."', ownername = '". $rowtenant[2] ."', building_id = '". $rowtenant[1] ."', floorid = '". $rowunitinfo[0] ."', location_id = '". $rowtenant[3] ."', task_id = '". $rowreftask[0] ."', sched = '". date('Y-m-d',strtotime($_POST['automaticsetup'])) ."', category_tenant = '". $rowchargestype[0] ."', worker_name = '". $_POST['youcantseeme'] ."' ";
		// 			$res3 = mysql_query($sql3, $connection) or die(mysql_error());
		// 			if ( $res3 == true ) {

		// 				$ref = createidno("RN", "tblref_maintenancetasksetup_stat", "refno");
		// 				$sql2 = " INSERT INTO tblref_maintenancetasksetup_stat SET refno = '" . $ref ."', tenantid = '". $rowtenant[0] ."', task = '". $rowreftask[0] ."', taskDate = '". date('Y-m-d',strtotime($_POST['automaticsetup'])) ."', staff_task_id = '". $stafftask ."' ";
		// 				$res2 = mysql_query($sql2, $connection);
		// 			}
		// 		}
		// 	}

		// 	else {
		// 		$sql = " SELECT TenantID, taskDate FROM tblref_maintenancetasksetup_stat WHERE stat = '1' AND DAY(taskDate) = '". $_POST['datengpaggawa'] ."' AND task = 'TASK-0000002' ";
		// 		$res = mysql_query($sql, $connection);
		// 		while($row = mysql_fetch_array($res)){
		// 			$mgaMeron .= "'" . $row[0] . "'" . ",";
		// 		}

		// 		$sqltenant = " SELECT tenantid, mallid, CONCAT(owner_firstname, ' ', LEFT(owner_midname, 1), '. ', owner_lastname) as ownername, unitid FROM tbltrans_tenants WHERE STATUS = 'actived' AND TenantID NOT IN (". substr(trim($mgaMeron), 0, -1) .") ";
		// 		$restenant = mysql_query($sqltenant, $connection) or die(mysql_error());
		// 		while($rowtenant = mysql_fetch_array($restenant)){
					

		// 			$sqlunitinfo = " SELECT floorid FROM tblref_unit where unitid = '". $rowtenant[3] ."' ";
		// 			$resunitinfo = mysql_query($sqlunitinfo, $connection);
		// 			$rowunitinfo = mysql_fetch_array($resunitinfo);

		// 			$sqlchargestype = " SELECT chargetypeid FROM tblref_charges_type WHERE description = 'Electricity Reading' ";
		// 			$reschargestype = mysql_query($sqlchargestype, $connection);
		// 			$rowchargestype = mysql_fetch_array($reschargestype);

		// 			$sqlreftask = " SELECT task_id FROM pmls_android_reftask WHERE description = 'Electric Reading' ";
		// 			$resreftask = mysql_query($sqlreftask, $connection);
		// 			$rowreftask = mysql_fetch_array($resreftask);

		// 			$stafftask = createidno("JO", "pmls_android_worker_task", "staff_task_id");
		// 			$sql3 = " INSERT INTO pmls_android_worker_task SET staff_task_id = '" . $stafftask ."', room_owner_id = '". $rowtenant[0] ."', ownername = '". $rowtenant[2] ."', building_id = '". $rowtenant[1] ."', floorid = '". $rowunitinfo[0] ."', location_id = '". $rowtenant[3] ."', task_id = '". $rowreftask[0] ."', sched = '". date('Y-m-d',strtotime($_POST['automaticsetup'])) ."', category_tenant = '". $rowchargestype[0] ."', worker_name = '". $_POST['youcantseeme'] ."' ";
		// 			$res3 = mysql_query($sql3, $connection) or die(mysql_error());
		// 			if ( $res3 == true ) {

		// 				$ref = createidno("RN", "tblref_maintenancetasksetup_stat", "refno");
		// 				$sql2 = " INSERT INTO tblref_maintenancetasksetup_stat SET refno = '" . $ref ."', tenantid = '". $rowtenant[0] ."', task = '". $rowreftask[0] ."', taskDate = '". date('Y-m-d',strtotime($_POST['automaticsetup'])) ."', staff_task_id = '". $stafftask ."' ";
		// 				$res2 = mysql_query($sql2, $connection);
		// 				if( $res2 == true ) {
		// 					echo 1;
		// 				}
		// 			}
		// 		}
		// 	}
		// break;

		// case 'checkexistingWR':
		// 	$sqlasdf = " SELECT TenantID, taskDate FROM tblref_maintenancetasksetup_stat WHERE stat = '1' AND DAY(taskDate) = '". $_POST['datengpaggawa'] ."' AND task = 'TASK-0000001' ";
		// 	$resasdf = mysql_query($sqlasdf, $connection);
		// 	$subrow = mysql_fetch_array($resasdf);
		// 	$mgaMeron = "";
		// 	if ( $subrow == "" ) {
		// 		$sqltenant = " SELECT tenantid, mallid, CONCAT(owner_firstname, ' ', LEFT(owner_midname, 1), '. ', owner_lastname) as ownername, unitid FROM tbltrans_tenants WHERE STATUS = 'actived' ";
		// 		$restenant = mysql_query($sqltenant, $connection);
		// 		while($rowtenant = mysql_fetch_array($restenant)){

		// 			$sqlunitinfo = " SELECT floorid FROM tblref_unit where unitid = '". $rowtenant[3] ."' ";
		// 			$resunitinfo = mysql_query($sqlunitinfo, $connection);
		// 			$rowunitinfo = mysql_fetch_array($resunitinfo);

		// 			$sqlchargestype = " SELECT chargetypeid FROM tblref_charges_type WHERE description = 'Water Reading' ";
		// 			$reschargestype = mysql_query($sqlchargestype, $connection);
		// 			$rowchargestype = mysql_fetch_array($reschargestype);

		// 			$sqlreftask = " SELECT task_id FROM pmls_android_reftask WHERE description = 'Water Reading' ";
		// 			$resreftask = mysql_query($sqlreftask, $connection);
		// 			$rowreftask = mysql_fetch_array($resreftask);

		// 			$stafftask = createidno("JO", "pmls_android_worker_task", "staff_task_id");
		// 			$sql3 = " INSERT INTO pmls_android_worker_task SET staff_task_id = '" . $stafftask ."', room_owner_id = '". $rowtenant[0] ."', ownername = '". $rowtenant[2] ."', building_id = '". $rowtenant[1] ."', floorid = '". $rowunitinfo[0] ."', location_id = '". $rowtenant[3] ."', task_id = '". $rowreftask[0] ."', sched = '". date('Y-m-d',strtotime($_POST['automaticsetup'])) ."', category_tenant = '". $rowchargestype[0] ."', worker_name = '". $_POST['youcantseeme'] ."' ";
		// 			$res3 = mysql_query($sql3, $connection) or die(mysql_error());
		// 			if ( $res3 == true ) {

		// 				$ref = createidno("RN", "tblref_maintenancetasksetup_stat", "refno");
		// 				$sql2 = " INSERT INTO tblref_maintenancetasksetup_stat SET refno = '" . $ref ."', tenantid = '". $rowtenant[0] ."', task = '". $rowreftask[0] ."', taskDate = '". date('Y-m-d',strtotime($_POST['automaticsetup'])) ."', staff_task_id = '". $stafftask ."' ";
		// 				$res2 = mysql_query($sql2, $connection);
		// 			}
		// 		}
		// 	}

		// 	else {
		// 		$sql = " SELECT TenantID, taskDate FROM tblref_maintenancetasksetup_stat WHERE stat = '1' AND DAY(taskDate) = '". $_POST['datengpaggawa'] ."' AND task = 'TASK-0000001' ";
		// 		$res = mysql_query($sql, $connection);
		// 		while($row = mysql_fetch_array($res)){
		// 			$mgaMeron .= "'" . $row[0] . "'" . ",";
		// 		}

		// 		$sqltenant = " SELECT tenantid, mallid, CONCAT(owner_firstname, ' ', LEFT(owner_midname, 1), '. ', owner_lastname) as ownername, unitid FROM tbltrans_tenants WHERE STATUS = 'actived' AND TenantID NOT IN (". substr(trim($mgaMeron), 0, -1) .") ";
		// 		$restenant = mysql_query($sqltenant, $connection) or die(mysql_error());
		// 		while($rowtenant = mysql_fetch_array($restenant)){
					

		// 			$sqlunitinfo = " SELECT floorid FROM tblref_unit where unitid = '". $rowtenant[3] ."' ";
		// 			$resunitinfo = mysql_query($sqlunitinfo, $connection);
		// 			$rowunitinfo = mysql_fetch_array($resunitinfo);

		// 			$sqlchargestype = " SELECT chargetypeid FROM tblref_charges_type WHERE description = 'Water Reading' ";
		// 			$reschargestype = mysql_query($sqlchargestype, $connection);
		// 			$rowchargestype = mysql_fetch_array($reschargestype);

		// 			$sqlreftask = " SELECT task_id FROM pmls_android_reftask WHERE description = 'Water Reading' ";
		// 			$resreftask = mysql_query($sqlreftask, $connection);
		// 			$rowreftask = mysql_fetch_array($resreftask);

		// 			$stafftask = createidno("JO", "pmls_android_worker_task", "staff_task_id");
		// 			$sql3 = " INSERT INTO pmls_android_worker_task SET staff_task_id = '" . $stafftask ."', room_owner_id = '". $rowtenant[0] ."', ownername = '". $rowtenant[2] ."', building_id = '". $rowtenant[1] ."', floorid = '". $rowunitinfo[0] ."', location_id = '". $rowtenant[3] ."', task_id = '". $rowreftask[0] ."', sched = '". date('Y-m-d',strtotime($_POST['automaticsetup'])) ."', category_tenant = '". $rowchargestype[0] ."', worker_name = '". $_POST['youcantseeme'] ."' ";
		// 			$res3 = mysql_query($sql3, $connection) or die(mysql_error());
		// 			if ( $res3 == true ) {

		// 				$ref = createidno("RN", "tblref_maintenancetasksetup_stat", "refno");
		// 				$sql2 = " INSERT INTO tblref_maintenancetasksetup_stat SET refno = '" . $ref ."', tenantid = '". $rowtenant[0] ."', task = '". $rowreftask[0] ."', taskDate = '". date('Y-m-d',strtotime($_POST['automaticsetup'])) ."', staff_task_id = '". $stafftask ."' ";
		// 				$res2 = mysql_query($sql2, $connection);
		// 			}
		// 		}
		// 	}
		// break;
	}
?>
