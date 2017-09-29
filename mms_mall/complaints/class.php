<?php 
include "../connect.php";
	switch ($_POST['form']) {

		case 'displaycomplaints2':
			$cnt_fltr = 0;
		    $sql_filter = mysql_fetch_array(mysql_query("SELECT checked_value, otherfilter, bystat, xcheck FROM tblref_filters WHERE module = 'Complaints' ", $connection));
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

			$page = $_POST['page'];
			$limit = ($page-1) * 20;

				$sql = " SELECT Complaint_Series_No, TenantID, Date_Entry, Complaint_Code, Complete_Description, Customer_Name, Company, unitname, Time_Received, Time_Resolved, Duration, Complaint_Status, Priority_Status, username, building_id, unitid, floorid FROM tblcomplaints ".$filterselected." ORDER BY xdate DESC LIMIT ".$limit.",20 ";
				$res = mysql_query($sql, $connection) or die(mysql_error());
				while($row = mysql_fetch_array($res)){
					$assignperson = mysql_fetch_array(mysql_query("SELECT workername FROM tblmaintenance_workorder WHERE Complaint_Series_No = '". $row[0] ."' ", $connection));
					?>
						<tr>		
								<td><?php echo $row[1]; ?></td>
								<td><?php echo $row[2]; ?></td>
								<td><?php echo $row[3]; ?></td>
								<td><?php echo $row[4]; ?></td>
								<td><?php echo $row[6]; ?></td>
								<td><?php echo $row[8]; ?></td>
								<td><?php echo $row[9]; ?></td>
								<td><?php echo $assignperson[0]; ?></td>
								<td><?php echo $row[11]; ?></td>
								<td>
						<div>	
						<?php								
						if( $row[12] == "High" )	{	?>
							<span class="label label-sm label-danger"><?php echo $row[12]; ?></span>
						<?php 	}	
						else if( $row[12] == "Medium" )	{	?>
							<span class="label label-sm label-warning"><?php echo $row[12]; ?></span>
						<?php 	}
						else if( $row[12] == "Low" )	{	?>
							<span class="label label-sm label-yellow" style="background-color:rgba(255, 255, 0, 0.62);"><?php echo $row[12]; ?></span>
						<?php 	}	?>
						</div>
								</td>
								<td><?php echo $row[13]; ?></td>
								<td><button class='btn btn-sm btn-default' onclick='printcomplaint("<?php echo $row[0]; ?>", "<?php echo $row[14]; ?>");'><img src='assets/images/printer.png' style='width: 100%; height: auto;'></button></td>
							?>
						</tr>	
					<?php	
				}
			}
		break;
			
		case 'addnewcomplaintscode':
			$sql = " INSERT INTO tblcomplaintscode SET Complaints_Code = '". $_POST['complaintscode'] ."', Complete_Description = '". $_POST['complaintcodedescription'] ."', Priority_Status = '". $_POST['stats'] ."' ";
			$res = mysql_query($sql, $connection) or die(mysql_error());
				echo 1;
		break;

		case 'sendcomplaints':
			$id = $_POST['id'];
			$complaintscode1 = $_POST['complaintscode1'];
			$complaintsdecription = $_POST['complaintsdecription'];
			$stats = $_POST['stats'];
			$hiddenidcname = $_POST['hiddenidcname'];
			$hiddencompany = $_POST['hiddencompany'];
			$hiddenbuilding_id = $_POST['hiddenbuilding_id'];
			$hiddenunitid = $_POST['hiddenunitid'];
			$hiddenfloorid = $_POST['hiddenfloorid'];


				$maxid = " SELECT Complaint_Series_No, TenantID,  Complaint_Code,  Time_Received, Complete_Description, Priority_Status from tblcomplaints ORDER BY id DESC LIMIT 1 ";
				$resultmax = mysql_query($maxid, $connection);
				$rowmax = mysql_fetch_array($resultmax);

				if ( $rowmax[0] == "" ) {
					$newid = "CSN-" . str_pad(1, 7, 0, STR_PAD_LEFT);
				}

				else {
					$arr = explode("-", $rowmax[0]);
					$newid = "CSN-" . str_pad($arr[1] + 1, 7, 0, STR_PAD_LEFT);
				}

					$setid = " INSERT INTO tblcomplaints SET Complaint_Series_No = '". $newid ."', Complaint_Code = '". $_POST['complaintscode1'] ."', 	Complete_Description = '". $_POST['complaintsdescription'] ."', Priority_Status = '". $_POST['hiddenstats'] ."', Customer_Name = '". $_POST['hiddenidcname'] ."', unitname = '". $_POST['hiddenunit'] ."', TenantID = '". $_POST['id'] ."', username = '". $_POST['user'] ."', Date_Entry = '". date('Y-m-d') ."', Company = '". $_POST['hiddencompany'] ."', unitid = '". $_POST['hiddenunitid'] ."', floorid = '". $_POST['hiddenfloorid'] ."', building_id = '". $_POST['hiddenbuilding_id'] ."' ";

					$resultnew = mysql_query($setid, $connection) or die(mysql_error());
					if($resultnew == true) {
						$logs = create_logs("Created a new complaint.", "Tenants Module", $newid ."|".$_POST["complaintscode1"]."|".$_POST["complaintsdescription"]."|".$_POST["hiddenstats"]."|".$_POST["hiddenidcname"]."|".$_POST["hiddenunit"], "ADD");
						echo 1;
					}
				
		break;

		case 'displaycomplaintcode':
			$sql = "SELECT Complaints_Code FROM tblcomplaintscode";
            $result = mysql_query($sql, $connection);
            while ( $row = mysql_fetch_array($result)) {
                echo"
                <option value='". $row[0] ."'>".$row[0]."</option>
                ";
            }
        break;

        case 'displayselected':
        	$sql = " SELECT Complete_Description, Priority_Status FROM tblcomplaintscode WHERE Complaints_Code = '" .$_POST['id']. "' ";
			$result = mysql_query($sql, $connection);
			$row = mysql_fetch_array($result);
			echo $row[0] ."|". $row[1];
		break;

		case 'printcomplaints':
			$sql = " SELECT Complaint_Series_No, TenantID, xdate, Complaint_Code, Complete_Description, Customer_Name, Company, unitname, Time_Received, Time_Resolved, Duration, Complaint_Status, Priority_Status, username, xdate FROM tblcomplaints WHERE Date_Entry BETWEEN '".date("Y-m-d", strtotime($_POST['dateFrom']))."' AND '".date("Y-m-d", strtotime($_POST['dateTo']))."' AND building_id = '". $_POST['mallid'] ."' ORDER BY xdate desc";
			$res = mysql_query($sql, $connection);
			while($row = mysql_fetch_array($res)){

				$sql2 = " SELECT worker_id, complaint_seriesno from pmls_android_worker_task WHERE complaint_seriesno = '".$row[0]."' ";
				$res2 = mysql_query($sql2, $connection) or die(mysql_error());
				$row2 = mysql_fetch_array($res2);

					$gumawa = " SELECT CONCAT(firstname, ' ', lastname) FROM tbluser WHERE userid = '". $row2[0] ."' ";
					$resgumawa = mysql_query($gumawa, $connection);
					$rowgumawa = mysql_fetch_array($resgumawa);

			$tables .= "
					   			<tr>
					   				<td style='border-left: 1px solid black;border-bottom: 1px solid;'>".$row[1]."</td>
					   				<td style='border-left: 1px solid black;border-bottom: 1px solid;'>".$row[2]."</td>
					   				<td style='border-left: 1px solid black;border-bottom: 1px solid;'>".$row[3]."</td>
					   				<td style='border-left: 1px solid black;border-bottom: 1px solid;'>".$row[4]."</td>
					   				<td style='border-left: 1px solid black;border-bottom: 1px solid;'>".$row[5]."</td>
					   				<td style='border-left: 1px solid black;border-bottom: 1px solid;'>".$row[6]."</td>
					   				<td style='border-left: 1px solid black;border-bottom: 1px solid;'>".$row[7]."</td>
					   				<td style='border-left: 1px solid black;border-bottom: 1px solid;'>".$row[8]."</td>
					   				<td style='border-left: 1px solid black;border-bottom: 1px solid;'>".$row[9]."</td>
					   				<td style='border-left: 1px solid black;border-bottom: 1px solid;'>".$row[10]."</td>
					   				<td style='border-left: 1px solid black;border-bottom: 1px solid;'>".$rowgumawa[0]."</td>
					   				<td style='border-left: 1px solid black;border-bottom: 1px solid;'>".$row[11]."</td>
					   				<td style='border-left: 1px solid black;border-bottom: 1px solid;'>".$row[12]."</td>
					   				<td style='border-left: 1px solid black;border-bottom: 1px solid;border-right: 1px solid;'>".$row[13]."</td>
					   			</tr>";
			}

			echo $tables . "|" . date('F d, Y', strtotime($_POST['dateFrom'])) . "|" . date('F d, Y', strtotime($_POST['dateTo']));
		break;

		case 'loadentries':
			$cnt_fltr = 0;
		    $sql_filter = mysql_fetch_array(mysql_query("SELECT checked_value, otherfilter, bystat, xcheck FROM tblref_filters WHERE module = 'Complaints' ", $connection));
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

		case "loadpagecomplaints":
			$cnt_fltr = 0;
		    $sql_filter = mysql_fetch_array(mysql_query("SELECT checked_value, otherfilter, bystat, xcheck FROM tblref_filters WHERE module = 'Complaints' ", $connection));
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

	        	$sqlb = "SELECT COUNT(*) FROM tblcomplaints ".$filterselected." ";
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

    	case 'loadfilters_complaints':
			$sql = "SELECT checked_value, otherfilter, bystat, xcheck FROM tblref_filters WHERE module = '".$_POST['module']."'";
	        $result = mysql_query($sql, $connection);
	        $row = mysql_fetch_array($result);

	        echo $row[0] . "#" . $row[1] . "#" . $row[2] . "#" . $row[3];
		break;	

		case 'savecomplaintsfilter':
			$sql = "SELECT checked_value FROM tblref_filters WHERE module = '".$_POST["module"]."'";
	      	$result = mysql_query($sql, $connection);
	      	$num = mysql_num_rows($result);
	      	$row = mysql_fetch_array($result);

	      	if($num == 0){
	        	$sql_insert = "INSERT INTO tblref_filters (module, checked_value, filters, otherfilter, bystat, xcheck)VALUES('".$_POST["module"]."', '".$_POST["checked"]."', '".$_POST["checked2"]."', '".$_POST["datefrom"]."|".$_POST["dateto"]."', '".$_POST["checked3"]."', '". $_POST['checked4'] ."')";
	        	$result_insert = mysql_query($sql_insert, $connection);
		        if($result_insert == true){
		          	echo 1;
		        }
	      	}
	     		else{	
	        		$sql_update= "UPDATE tblref_filters SET checked_value = '".$_POST["checked"]."', otherfilter = '".$_POST["datefrom"]."|".$_POST["dateto"]."', bystat = '".$_POST["checked3"]."', xcheck = '". $_POST['checked4'] ."' WHERE module = '".$_POST["module"]."'";
			        $result_update = mysql_query($sql_update, $connection); 
				        if($result_update == true){
				          	echo 1;
				        }   
	      	}
		break;

		case 'displaycomplaintspertenant':
			$page = $_POST['page'];
			$limit = ($page-1) * 20;

			$sql = " SELECT Complaint_Series_No, Date_Entry, Complaint_Code, Complete_Description, Time_Received, Time_Resolved, Duration, Complaint_Status, Priority_Status, username FROM tblcomplaints WHERE TenantID = '". $_POST['hiddenid2'] ."' LIMIT ".$limit.",20 ";
			$res = mysql_query($sql, $connection);
			while($row = mysql_fetch_array($res)){
				
				$sql2 = " SELECT worker_id, complaint_seriesno from pmls_android_worker_task WHERE complaint_seriesno = '".$row[0]."' ";
				$res2 = mysql_query($sql2, $connection) or die(mysql_error());
				$row2 = mysql_fetch_array($res2);

				$gumawa = " SELECT CONCAT(firstname, ' ', lastname) FROM tbluser WHERE userid = '". $row2[0] ."' ";
				$resgumawa = mysql_query($gumawa, $connection);
				$rowgumawa = mysql_fetch_array($resgumawa);
				?>
					<tr>		
							<td width="10%"><?php echo $row[1]; ?></td>
							<td width="10%"><?php echo $row[2]; ?></td>
							<td width="10%"><?php echo $row[3]; ?></td>
							<td width="10%"><?php echo $row[4]; ?></td>
							<td width="10%"><?php echo $row[5]; ?></td>
							<td width="10%"><?php echo $row[6]; ?></td>
							<td width="10%"><?php echo $rowgumawa[0]; ?></td>
							<td width="10%"><?php echo $row[7]; ?></td>
							<td width="10%">
					<div>	
					<?php								
					if( $row[8] == "High" )	{	?>
						<span class="label label-sm label-danger"><?php echo $row[8]; ?></span>
					<?php 	}	
					else if( $row[8] == "Medium" )	{	?>
						<span class="label label-sm label-warning"><?php echo $row[8]; ?></span>
					<?php 	}
					else if( $row[8] == "Low" )	{	?>
						<span class="label label-sm label-yellow" style="background-color:rgba(255, 255, 0, 0.62);"><?php echo $row[8]; ?></span>
					<?php 	}	?>
					</div>
							</td>
							<td width="10%"><?php echo $row[9]; ?></td>
						?>
					</tr>	
				<?php	
			}
			break;

			case 'loadentriespertenant':
           if($_POST["page"] == ""){
               $page = 1;
           }else{
               $page = $_POST["page"];
           }

           $limit = ($page-1) * 20;

            $sql = "SELECT COUNT(*) FROM tblcomplaints where TenantID = '". $_POST['hiddenid2'] ."' ";
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
       	break;

		case "loadpagecomplaintspertenant":
		    $page = $_POST["page"];

        	$sqlb = "SELECT COUNT(*) FROM tblcomplaints WHERE TenantID = '". $_POST['hiddenid2'] ."' ";
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
			   echo "<li style='width:50px !important;' onclick='paginationpertenant(1)'><< First</li>";
			   $prevpage = $page - 1;
			   echo "<li style='width:70px !important;' onclick='paginationpertenant(". $prevpage .")'>< Previous</li>";
			}

			for($x = ($page - $range); $x < (($page + $range) + 1); $x++)
			{
			   if (($x > 0) && ($x <= $totalpages)){
    			    if ($x == $page){
                        echo "<li id='pgcomplaintspertenant" . $x . "' class='pgnumpcomplaintspertenant active' onclick='paginationpertenant(" . $x . ",". $x .")'>" . $x . "</li>";
                      }
    			    else{
    			        echo "<li id='pgcomplaintspertenant" . $x . "' class='pgnumpcomplaintspertenant' onclick='paginationpertenant(" . $x . ",". $x .")'>" . $x . "</li>";
                    }
		       }
		    }
		    if($page < ($totalpages - $range)){
                echo "<li>...</li>";
            }

		    if ($page != $totalpages && $num != 0){
		       $nextpage = $page + 1;
		       echo "<li style='width:50px !important;' onclick='paginationpertenant(". $nextpage .", ". $nextpage .")'>Next ></li>";
		       echo "<li style='width:50px !important;' onclick='paginationpertenant(". $totalpages .", ". $totalpages .")'>Last >></li>";
		    }
		break;

		case 'printcomplaint':
			$printcomplaint = mysql_fetch_array(mysql_query("SELECT Company, building_id, floorid, unitid, Date_Entry, username, Complaint_Code, Complete_Description, tenantid FROM tblcomplaints WHERE Complaint_Series_No = '". $_POST['csn'] ."' ", $connection));
			$mallname = mysql_fetch_array(mysql_query("SELECT mallname FROM tblref_mall WHERE mallid = '". $printcomplaint[1] ."' ", $connection));
			$floorname = mysql_fetch_array(mysql_query("SELECT floor FROM tblref_floorsetup WHERE floorid = '". $printcomplaint[2] ."' ", $connection));
			$unitname = mysql_fetch_array(mysql_query("SELECT unitname, buildingname FROM tblref_unit WHERE unitid = '". $printcomplaint[3] ."' ", $connection));
			$username = mysql_fetch_array(mysql_query("SELECT workername FROM tblmaintenance_workorder WHERE Complaint_Series_No = '". $_POST['csn'] ."' ", $connection));
			echo $printcomplaint[0] . "|" . $mallname[0] . "|" . $unitname[1] . "|" . $floorname[0] . "|" . $unitname[0] . "|" . date('F d, Y', strtotime($printcomplaint[4])) . "|" . $printcomplaint[5] . "|" . $printcomplaint[6] . "|" . $printcomplaint[7] . "|" . $username[0] . "|" . $printcomplaint[8];
		break;

		case 'iftenantischecked':
				echo "<option value=''>-- Select Tenant --</option>";
			$res = mysql_query("SELECT TenantID, CONCAT(owner_firstname, ' ', owner_lastname) FROM tbltrans_tenants WHERE status != 'endofcon' AND status != 'evicted' AND status != 'inactive' ", $connection);
			while($row = mysql_fetch_array($res)){
				echo "<option value=".$row[0].">".$row[1]."</option>";
			}
		break;

		case 'ifemployeeischecked':
				echo "<option value=''>-- Select Employee --</option>";
			$res = mysql_query("SELECT Code, CONCAT(First_Name, ' ', LEFT(Middle_Name, 1), '.', ' ', Last_Name) FROM tblref_employee ", $connection);
			while($row = mysql_fetch_array($res)){
				echo "<option value=".$row[0].">".$row[1]."</option>";
			}
		break;

		case 'tblviolationlist':
			$res = mysql_query("SELECT Code, Violation, 1st_offense, 2nd_offense, 3rd_offense, xsucceeding FROM tblmaintenance_houserules", $connection);
			while ($row = mysql_fetch_array($res)) {
				?>
					<tr id="<?php echo "tr".$row[0]; ?>">
						<td style='display:none;'><input type='checkbox' value="<?php echo $row[0]; ?>" class='checkbox "<?php echo $row[0]; ?>"'></td>
						<td width='10%'><?php echo $row[0]; ?></td>
						<td width='40%'><?php echo $row[1]; ?></td>
						<td width='10%'><?php echo $row[2]; ?></td>
						<td width='10%'><?php echo $row[3]; ?></td>
						<td width='10%'><?php echo $row[4]; ?></td>
						<td width='10%'><?php echo $row[5]; ?></td>
					</tr>
				<?php
			}
		break;

		case 'savecheckedviolations':
			$arr = explode("|", $_POST['ids']);
			for ($i=0; $i <= count($arr)-2; $i++) { 
			$row = mysql_fetch_array(mysql_query("SELECT Code, Violation FROM tblmaintenance_houserules WHERE Code = '". $arr[$i] ."' ", $connection));
				echo 	"<tr>
							<td>".$row[0]."</td>
							<td>".$row[1]."</td>
						</tr>";
			}
		break;

		case 'saveviolationticket':
            $VSeriesNumber = createidno("VHR", "tblmaintenance_hrviolators", "VSeriesNumber");
            if($_POST['type'] == "Employee"){
				$ViolatorsName = mysql_fetch_array(mysql_query("SELECT CONCAT(First_Name, ' ', LEFT(Middle_Name, 1), '.', ' ', Last_Name), mallid FROM tblref_employee WHERE Code = '". $_POST['whoeveritis'] ."' ", $connection));
			}else if($_POST['type'] == "Tenant"){
				$ViolatorsName = mysql_fetch_array(mysql_query("SELECT CONCAT(owner_firstname, ' ', owner_lastname), mallid FROM tbltrans_tenants WHERE tenantid = '". $_POST['whoeveritis'] ."' ", $connection));
			}
			$arr = explode("|", $_POST['ids']);
			for ($a=0;$a<=count($arr)-2;$a++) { 
				$offense = mysql_fetch_array(mysql_query("SELECT COUNT(Code) FROM tblmaintenance_hrviolators WHERE Code = '". $arr[$a] ."' AND ViolatorID = '". $_POST['whoeveritis'] ."' ", $connection));
					if($offense[0] == "0"){
						$offensecount = "1st Offense";
					}else if($offense[0] == "1"){
						$offensecount = "2nd Offense";
					}else if($offense[0] == "2"){
						$offensecount = "3rd Offense";
					}else{
						$offensecount = "Succeeding";
					}

					$Violation = mysql_fetch_array(mysql_query("SELECT Violation FROM tblmaintenance_houserules WHERE Code = '". $arr[$a] ."' ", $connection));

					
					$resinsert = mysql_query("INSERT INTO tblmaintenance_hrviolators SET VSeriesNumber = '". $VSeriesNumber ."', Code = '". $arr[$a] ."', Violation = '". $Violation[0] ."', ViolatorID = '". $_POST['whoeveritis'] ."', ViolatorName = '". $ViolatorsName[0] ."', offensetype = '". $offensecount ."', xtype = '". $_POST['type'] ."', xdate = '". date('Y-m-d') ."', xtime = '". date('H:i:s') ."' ", $connection);
			}

			$resinsertheader = mysql_query("INSERT INTO tblmaintenance_hrviolatorsheader SET VSeriesNumber = '". $VSeriesNumber ."', ViolatorID = '". $_POST['whoeveritis'] ."', ViolatorName = '". $ViolatorsName[0] ."', xdate = '". date('Y-m-d') ."', xtime = '". date('H:i:s') ."', xtype = '". $_POST['type'] ."', mallid = '". $ViolatorsName[1] ."' ", $connection);
			if($resinsertheader == true){
				echo 1;
			}else{
				echo 2;
			}
		break;

		case 'tblviolation':
			$cnt_fltr = 0;
		    $sql_filter = mysql_fetch_array(mysql_query("SELECT checked_value, otherfilter, bystat, xcheck FROM tblref_filters WHERE module = 'HouseRules' ", $connection));
		    $trby = explode("|", $sql_filter["checked_value"]);
		    $stat = explode("|", $sql_filter["bystat"]);
		    $unit = explode("|", $sql_filter["xcheck"]);
		    $date = explode("|", $sql_filter["otherfilter"]);
		    $filter = "";
		    // filter for status
		    $cnt = 0; $chk = "";
		    for($a = 0; $a<=count($stat)-1; $a++){
		      	if($stat[$a] == "Resolved"){ 
		      		$con = "xstatus = 'Resolved'"; 
		      	}
		      	else if($stat[$a] == "Pending"){ 
		      		$con = "xstatus = 'Pending'"; 
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
		    $date_fltr = "(xdate BETWEEN '".date("Y-m-d", strtotime($date[0]))."' AND '".date("Y-m-d", strtotime($date[1]))."')";
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
				$res = mysql_query("SELECT VSeriesNumber, ViolatorID, ViolatorName, xstatus, xdate, xtime, xtype FROM tblmaintenance_hrviolatorsheader ".$filterselected." ", $connection);
				while($row = mysql_fetch_array($res)){

					if($row[3] == "Resolved"){
						$stat2 = '<span class="label label-success"> '.$row[3].'</span>';
					}else{
						$stat2 = '<span class="label label-warning"> '.$row[3].'</span>';
					}
					?>
						<tr>
							<td><?php echo $row[0]; ?></td>
							<td><?php echo $row[2]; ?></td>
							<td>
								<?php
									$res2 = mysql_query("SELECT Violation, offensetype FROM tblmaintenance_hrviolators WHERE VSeriesNumber = '". $row[0] ."' ", $connection);
									while($row2 = mysql_fetch_array($res2)){
										if($row2[1] == "1st Offense"){
											$stat = '<i class="fa fa-circle" style="color: #F89406;"></i>&nbsp;'.$row2[0];
										}else if($row2[1] == "2nd Offense"){
											$stat = '<i class="fa fa-circle" style="color: #D6487E;"></i>&nbsp;'.$row2[0];
										}else if($row2[1] == "3rd Offense"){
											$stat = '<i class="fa fa-circle" style="color: #D15B47;"></i>&nbsp;'.$row2[0];
										}else{
											$stat = '<i class="fa fa-circle" style="color: #333;"></i>&nbsp;'.$row2[0];
										}

										echo $stat."<br/>";

									}
								?>
							</td>
							<td><?php echo date('F d, Y', strtotime($row[4])); ?></td>
							<td><?php echo date('h:i A', strtotime($row[5])); ?></td>
							<td><?php echo $stat2; ?></td>
							<td>
								<button class="btn btn-xs btn-success" onclick='viewticket("<?php echo $row[0]; ?>", "<?php echo $row[6]; ?>", "<?php echo $row[2]; ?>", "<?php echo date('F d, Y', strtotime($row[4])); ?>", "<?php echo date('h:i A', strtotime($row[5])); ?>", "<?php echo $row[1]; ?>", "<?php echo $row[3]; ?>")'><i class="fa fa-ticket" style="padding-right: 5px;padding-left: 5px;padding-top: 4px;padding-bottom: 5px;">></i></button>

								<button class="btn btn-xs btn-danger" onclick='deletethisticket("<?php echo $row[0]; ?>");'><i class="fa fa-trash-o" style="padding-right: 8px;padding-left: 8px;padding-top: 4px;padding-bottom: 5px;"></i></button>

								<button class="btn btn-sm btn-default" onclick='printnotificationofviolation("<?php echo $row[0]; ?>", "<?php echo $row[6]; ?>", "<?php echo $row[2]; ?>", "<?php echo date('F d, Y', strtotime($row[4])); ?>", "<?php echo date('h:i A', strtotime($row[5])); ?>", "<?php echo $row[1]; ?>");'>
								<img src="assets/images/printer.png" style="width: 100%; height: auto;">
								</button>
							</td>
						</tr>
					<?php
				}
			}
		break;

		case 'saveHouseRulesfilter':
			$sql = "SELECT checked_value FROM tblref_filters WHERE module = '".$_POST["module"]."'";
	      	$result = mysql_query($sql, $connection);
	      	$num = mysql_num_rows($result);
	      	$row = mysql_fetch_array($result);

	      	if($num == 0){
	        	$sql_insert = "INSERT INTO tblref_filters (module, checked_value, filters, otherfilter, bystat)VALUES('".$_POST["module"]."', '".$_POST["checked"]."', '".$_POST["checked2"]."', '".$_POST["datefrom"]."|".$_POST["dateto"]."', '".$_POST["checked3"]."')";
	        	echo $sql_insert;
	        	$result_insert = mysql_query($sql_insert, $connection);
		        if($result_insert == true){
		          	echo 1;
		        }
	      	}
	     		else{	
	        		$sql_update= "UPDATE tblref_filters SET checked_value = '".$_POST["checked"]."', otherfilter = '".$_POST["datefrom"]."|".$_POST["dateto"]."', bystat = '".$_POST["checked3"]."' WHERE module = '".$_POST["module"]."'";
	        		echo $sql_update;
			        $result_update = mysql_query($sql_update, $connection); 
				        if($result_update == true){
				          	echo 1;
				        }   
	      	}
		break;

		case 'loadfilters_HouseRules':
			$sql = "SELECT checked_value, otherfilter, bystat FROM tblref_filters WHERE module = '".$_POST['module']."'";
	        $result = mysql_query($sql, $connection);
	        $row = mysql_fetch_array($result);

	        echo $row[0] . "#" . $row[1] . "#" . $row[2];
		break;	

		case 'printcomplaintshr':
			$res = mysql_query("SELECT VSeriesNumber, ViolatorName, xdate, xtime, xstatus FROM tblmaintenance_hrviolatorsheader WHERE xdate BETWEEN '".date("Y-m-d", strtotime($_POST['dateFrom']))."' AND '".date("Y-m-d", strtotime($_POST['dateTo']))."' AND mallid = '". $_POST['mallid'] ."' ", $connection);
			while($row = mysql_fetch_array($res)){
				?>
				<tr>
					<td style="border-left: 1px solid;border-bottom: 1px solid;vertical-align: top;"><?php echo $row[0]; ?></td>
					<td style="border-left: 1px solid;border-bottom: 1px solid;vertical-align: top;"><?php echo $row[1]; ?></td>
					<td style="border-left: 1px solid;border-bottom: 1px solid;">
						<?php 
							$res2 = mysql_query("SELECT Violation, offensetype FROM tblmaintenance_hrviolators WHERE VSeriesNumber = '". $row[0] ."' ", $connection);
							while($row2 = mysql_fetch_array($res2)){
								if($row2[1] == "1st Offense"){
									$stat = '<span class="fa fa-circle" style="color: #F89406;"></span>&nbsp;'.$row2[0];
								}else if($row2[1] == "2nd Offense"){
									$stat = '<span class="fa fa-circle" style="color: #D6487E;"></span>&nbsp;'.$row2[0];
								}else if($row2[1] == "3rd Offense"){
									$stat = '<span class="fa fa-circle" style="color: #D15B47;"></span>&nbsp;'.$row2[0];
								}else{
									$stat = '<span class="fa fa-circle" style="color: black;"></span>&nbsp;'.$row2[0];
								}
								echo $stat."<br/>";
							}
						?>
					</td>
					<td width="10%" style="border-left: 1px solid;border-bottom: 1px solid;"><?php echo date('F d, Y', strtotime($row[2])); ?></td>
					<td width="8%" style="border-left: 1px solid;border-bottom: 1px solid;"><?php echo date('H:i A', strtotime($row[3])); ?></td>
					<td style="border-left: 1px solid;border-bottom: 1px solid;border-right: 1px solid;"><?php echo $row[4]; ?></td>
				</tr>
				<?php
			}
			echo "|". date('F d, Y', strtotime($_POST['dateFrom'])) . "|" . date('F d, Y', strtotime($_POST['dateTo']));
		break;

		case 'deletethisticket':
			$res = mysql_query("DELETE FROM tblmaintenance_hrviolatorsheader WHERE VSeriesNumber = '". $_POST['vsn'] ."' ", $connection);
			if($res == true){
				$res2 = mysql_query("DELETE FROM tblmaintenance_hrviolators WHERE VSeriesNumber = '". $_POST['vsn'] ."' ", $connection);
				if($res2 == true){
					echo 1;
				}
				else{
					echo 2;
				}
			}
		break;

		case 'loadentriesofhr':
			$cnt_fltr = 0;
		    $sql_filter = mysql_fetch_array(mysql_query("SELECT checked_value, otherfilter, bystat, xcheck FROM tblref_filters WHERE module = 'HouseRules' ", $connection));
		    $trby = explode("|", $sql_filter["checked_value"]);
		    $stat = explode("|", $sql_filter["bystat"]);
		    $unit = explode("|", $sql_filter["xcheck"]);
		    $date = explode("|", $sql_filter["otherfilter"]);
		    $filter = "";
		    // filter for status
		    $cnt = 0; $chk = "";
		    for($a = 0; $a<=count($stat)-1; $a++){
		      	if($stat[$a] == "Resolved"){ 
		      		$con = "xstatus = 'Resolved'"; 
		      	}
		      	else if($stat[$a] == "Pending"){ 
		      		$con = "xstatus = 'Pending'"; 
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
		    $date_fltr = "(xdate BETWEEN '".date("Y-m-d", strtotime($date[0]))."' AND '".date("Y-m-d", strtotime($date[1]))."')";
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

	            $sql = "SELECT COUNT(*) FROM tblmaintenance_hrviolatorsheader ".$filterselected." ";
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

		case 'loadpagehr':
			$cnt_fltr = 0;
		    $sql_filter = mysql_fetch_array(mysql_query("SELECT checked_value, otherfilter, bystat, xcheck FROM tblref_filters WHERE module = 'HouseRules' ", $connection));
		    $trby = explode("|", $sql_filter["checked_value"]);
		    $stat = explode("|", $sql_filter["bystat"]);
		    $unit = explode("|", $sql_filter["xcheck"]);
		    $date = explode("|", $sql_filter["otherfilter"]);
		    $filter = "";
		    // filter for status
		    $cnt = 0; $chk = "";
		    for($a = 0; $a<=count($stat)-1; $a++){
		      	if($stat[$a] == "Resolved"){ 
		      		$con = "xstatus = 'Resolved'"; 
		      	}
		      	else if($stat[$a] == "Pending"){ 
		      		$con = "xstatus = 'Pending'"; 
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
		    $date_fltr = "(xdate BETWEEN '".date("Y-m-d", strtotime($date[0]))."' AND '".date("Y-m-d", strtotime($date[1]))."')";
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

	        	$sqlb = "SELECT COUNT(*) FROM tblmaintenance_hrviolatorsheader ".$filterselected." ";
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

		case 'viewticket':
			if($_POST['type'] == "Tenant"){
				$row = mysql_fetch_array(mysql_query("SELECT unitname FROM tbltrans_tenants WHERE TenantID = '". $_POST['violatorid'] ."' ", $connection));
			}else{
				$row = mysql_fetch_array(mysql_query("SELECT Position FROM tblref_employee WHERE Code = '". $_POST['violatorid'] ."' ", $connection));
			}
			echo $row[0];
		break;

		case 'viewtickettable':
			$bayad2 = "";
			$res = mysql_query("SELECT Code, Violation, offensetype, resolution, xstatus, xfine FROM tblmaintenance_hrviolators WHERE VSeriesNumber = '". $_POST['vsn'] ."' ", $connection);
			while($row = mysql_fetch_array($res)){
				$fine = mysql_fetch_array(mysql_query("SELECT 1st_offense, 2nd_offense, 3rd_offense, xsucceeding FROM tblmaintenance_houserules WHERE Code = '". $row[0] ."' ", $connection));

				if($row[5] == ""){
					if($row[2] == "1st Offense"){
						$bayad = $fine[0];
					}else if($row[2] == "2nd Offense"){
						$bayad = $fine[1];
					}else if($row[2] == "3rd Offense"){
						$bayad = $fine[2];
					}else{
						$bayad = $fine[3];
					}
				}else{
					$bayad = $row[5];
				}

				$bayad2 = $bayad2+$bayad;

				?>
					<tr onclick='addreso("<?php echo $row[0]; ?>", "<?php echo $_POST['vsn']; ?>", "<?php echo $bayad; ?>", "<?php echo $row[1]; ?>", "<?php echo $row[4]; ?>", "<?php echo $row[3]; ?>")'>
						<td><?php echo $row[1]; ?></td>
						<td><?php echo $row[3]; ?></td>
						<td width="13%"><?php echo $row[2]; ?></td>
						<td><?php echo $row[4]; ?></td>
						<td><?php echo $bayad; ?></td>
					</tr>
				<?php
			}
			echo "|"."Total Amount: ".number_format($bayad2, 2, '.', ',');
		break;

		case 'viewtickettable2':
			$bayad2 = "";
			$res = mysql_query("SELECT Code, Violation, offensetype FROM tblmaintenance_hrviolators WHERE VSeriesNumber = '". $_POST['vsn'] ."' ", $connection);
			while($row = mysql_fetch_array($res)){
				$fine = mysql_fetch_array(mysql_query("SELECT 1st_offense, 2nd_offense, 3rd_offense, xsucceeding FROM tblmaintenance_houserules WHERE Code = '". $row[0] ."' ", $connection));

				if($row[2] == "1st Offense"){
					$bayad = $fine[0];
				}else if($row[2] == "2nd Offense"){
					$bayad = $fine[1];
				}else if($row[2] == "3rd Offense"){
					$bayad = $fine[2];
				}else{
					$bayad = $fine[3];
				}
				$bayad2 = $bayad2+$bayad;
				?>
					<tr>
						<td><?php echo $row[1]; ?></td>
						<td width="13%"><?php echo $row[2]; ?></td>
						<td><?php echo $bayad; ?></td>
					</tr>
				<?php
			}
			?> 
				<tr><td colspan="3" style="border-top: 1px solid;"></td></tr>
				<tr>
					<td></td>
					<td align="right">Total Amount: </td>
					<td><?php echo "<label style='color: red;'>Php ".number_format($bayad2, 2, '.', ',')."</label>"; ?></td>
				</tr>
			<?php
		break;

		case 'template':
			if($_POST['type'] == "Tenant"){
				$mallid = mysql_fetch_array(mysql_query("SELECT mallid FROM tbltrans_tenants WHERE TenantID = '". $_POST['violatorid'] ."' ", $connection));
			}else{
				$mallid = mysql_fetch_array(mysql_query("SELECT mallid FROM tblref_employee WHERE Code = '". $_POST['violatorid'] ."' ", $connection));
			}
			$template = mysql_fetch_array(mysql_query("SELECT template FROM tblsys_setup2"));
			$row = mysql_fetch_array(mysql_query("SELECT mallname, malladdress, telephone_number, email, mall_image FROM tblref_mall WHERE mallid = '".$mallid[0]."' ", $connection));
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

		case 'template2':
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

		case 'savemodalAddReso':
			$arr = explode("|", $_POST['ids']);
			$res = mysql_query("UPDATE tblmaintenance_hrviolators SET xfine = '". $_POST['amount'] ."', Resolution = '". $_POST['reso'] ."', xstatus = 'Resolved', xdateresolved = '". date('Y-m-d') ."', xtimeresolved = '". date('H:i:s') ."', xdatetimeresolved = '". date('Y-m-d H:i:s') ."' WHERE Code = '". $arr[0] ."' AND VSeriesNumber = '". $arr[1] ."' ", $connection);
			if($res == true){
				echo "1"."|".$arr[1];
			}else{
				echo "2"."|".$arr[1];
			}
		break;

		case 'checkmunabagopost':
			$res = mysql_query(" SELECT DISTINCT(xstatus) FROM tblmaintenance_hrviolators WHERE VSeriesNumber = '". $_POST['vsn'] ."' ORDER BY xstatus ASC", $connection);
			$row = mysql_fetch_array($res);
			echo $row[0];
		break;

		case 'postmonabes':
			$res = mysql_query("SELECT Code, Violation, ViolatorID, xfine, violatorid, xdate FROM tblmaintenance_hrviolators WHERE VSeriesNumber = '". $_POST['vsn'] ."' ", $connection);
			while($row = mysql_fetch_array($res)){
			$date = date('Y-m-01', strtotime($row[5]));
				if(is_numeric($row[3])){
					$res2 = mysql_query("INSERT INTO tbltransaction SET tenantid = '". $row[4] ."', xcode = '". $row[0] ."', description = '". $row[1] ."', xdescription = 'Violation', amount = '". $row[3] ."', qty = '0', balance = '". $row[3] ."', xdate = '". $date ."', totalamount = '". $row[3] ."', userid = '". $_COOKIE['userid'] ."' ", $connection);
					if($res2 == true){
						$res3 = mysql_query("UPDATE tblmaintenance_hrviolatorsheader SET xstatus = 'Resolved', xdateresolved = '". date('Y-m-d') ."', xtimeresolved = '". date('H:i:s') ."', xdatetimeresolved = '". date('Y-m-d H:i:s') ."' WHERE VSeriesNumber = '". $_POST['vsn'] ."' ", $connection);
					}else{
						echo 2;
					}
				}
			}
		break;

		case 'malloption':
			echo "<option value=''>-- Select Mall --</option>";
			$res = mysql_query("SELECT mallid, mallname FROM tblref_mall", $connection);
			while ($row = mysql_fetch_array($res)) {
				echo "<option value=".$row[0].">".$row[1]."</option>";
			}
		break;
	}				
?>