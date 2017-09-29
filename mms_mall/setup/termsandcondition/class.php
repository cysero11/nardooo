<?php 
	include("../../connect.php");

	switch ($_POST['form']) {
		case 'addnewgroup':
			$groupname = $_POST['txttac_group'];

			$newid = createidno("GRP", "tblgroups", "Group_ID");

			$sql = "SELECT COUNT(Group_Name) from tblgroups WHERE Group_Name = '".$groupname."' ";
			$res = mysql_query($sql, $connection);
			$row = mysql_fetch_array($res);
			if($row[0] == 0  ){

				$setid = " INSERT INTO tblgroups SET Group_ID = '". $newid ."', Group_Name = '". $_POST['txttac_group'] ."' ";
				$resultnew = mysql_query($setid, $connection);
				if($resultnew == true) {
					echo 1;
				}
			}

			else {
				echo "The Group Name you entered is already existing.";
			}
		break;

		case 'saveterms':
			$termid = $_POST['txttac_terms'];

			$newid = createidno("TRN", "tblterms", "Term_No");
			$sql = " SELECT Group_Name from tblgroups WHERE Group_ID = '". $_POST['groupid'] ."' ";
			$res = mysql_query($sql, $connection);
			$row = mysql_fetch_array($res);

			$sql2 = " INSERT INTO tblterms SET Term_Name = '". mysql_real_escape_string($_POST['terms']) ."', Term_No = '". $newid ."', Group_ID = '". $_POST['groupid'] ."', Group_Name = '". $row[0] ."' ";
			$res2 = mysql_query($sql2, $connection) or die(mysql_error());
			
			if($res2 == true){
				$sql3 = " INSERT INTO tblcondition SET Term_ID = '". $newid ."', Term_Name = '". mysql_real_escape_string($_POST['terms']) ."', Description = '". mysql_real_escape_string($_POST['condition']) ."', Group_ID = '". $_POST['groupid'] ."', Group_Name = '". $row[0] ."' ";
				$res3 = mysql_query($sql3, $connection);
				if ( $res3 == true ) {

					echo 1;
				}
			}
		break;

		case 'displaygroup':
			$page = $_POST['page'];
			$limit = ($page-1) * 20;

			if($_POST['groupname'] == ""){
				$groupname = "";
			}
			else{
				$groupname = " (Group_ID = '". $_POST['groupname'] ."') AND";
			}

			$info = " ( Group_Name LIKE '%".$_POST['txttermsanconditionsearch']."%' OR Term_Name LIKE '%".$_POST['txttermsanconditionsearch']."%' OR Description LIKE '%".$_POST['txttermsanconditionsearch']."%') AND";

			$statmo = " Stats LIKE '%".$_POST['jstat']."%' ";

			$sql = " SELECT Group_ID, Group_Name, Term_Name, Description, Stats, Term_ID FROM tblcondition WHERE ".$groupname." ".$info." ".$statmo." ORDER BY STATS = 1 DESC LIMIT ".$limit.",20 ";		
			$res = mysql_query($sql, $connection) or die(mysql_error());
			while($row = mysql_fetch_array($res)) {
					?>
						<tr  id="<?php echo $row[5]; ?>">		
								<td  width="20%" class="groupname" ><?php echo $row[1]; ?></td>
								<td  width="20%" class="tername"><?php echo $row[2]; ?></td>
								<td  width="40%" class="condition"><?php echo substr($row[3], 0, 100)."..."; ?></td>
								<div>
								<td width="10%"><?php 
										if( $row[4] == 1 )	{	?>
											<span class="label label-sm label-success"><?php echo "Active"; ?></span>
										<?php 	}
										else {	?>
											<span class="label label-sm label-danger"><?php echo "Inactive"; ?></span>
										<?php 	}	?>
								</td>
								</div>
								<input type="hidden" class="groupid" value="<?php echo $row[0]; ?>">
								<input type="hidden" class="statuss" value="<?php echo $row[4]; ?>">
								<td width="10%">
									<div class='btn-group'>
									<button class='btn btn-xs btn-info' onclick='loadmodal_editgroup("<?php echo $row[5]; ?>", "<?php echo $row[0]; ?>")' id="edit" title='Edit'>
										<i class='ace-icon fa fa-edit bigger-120'></i>
									</button>
									</div>
								</td>
						</tr>			
					<?php	
			}
			break;

		case 'updategroup':
			$arr = explode("|", $_POST['id']);
			$sql = " UPDATE tblgroups SET Group_Name = '". $_POST['groupid'] ."' WHERE Group_ID = '". $arr[1] ."' ";
			$res = mysql_query($sql, $connection);
			if($res == true){
				$sql2 = " UPDATE tblterms SET Term_Name = '". mysql_real_escape_string($_POST['terms']) ."', Group_ID = '". $arr[1] ."', Group_Name = '". $row[0] ."' WHERE Term_No = '". $arr[0] ."' ";
				$res2 = mysql_query($sql2, $connection);
				if($res2 == true){
					$sql3 = " UPDATE tblcondition SET Group_Name = '". $_POST['groupid'] ."', Term_Name = '". mysql_real_escape_string($_POST['terms']) ."', Description = '". mysql_real_escape_string($_POST['condition']) ."', Stats = '". $_POST['stats'] ."' WHERE Term_ID = '". $arr[0] ."'";
					$res3 = mysql_query($sql3, $connection);
					if($res3 == true){
						echo 1;
					}
				}
			}
		break;

		case 'displaygroupname':
			echo "<option value='' selected disabled>-- Select Group --</option>";
			$sql = "SELECT Group_ID, Group_Name FROM tblgroups";
            $result = mysql_query($sql, $connection);
            while ( $row = mysql_fetch_array($result)) {
                echo"
                <option value='". $row[0] ."'>".$row[1]."</option>
                ";
            }
        break;
	
		case 'selectgroup':
        	$sql = " SELECT Term_Name, Description from tblcondition WHERE Group_ID = '" .$_POST['id']. "' ";
			$result = mysql_query($sql, $connection);
			$row = mysql_fetch_array($result);
			echo $row[0] ."|". $row[1];
		break;
	
		case 'selectgroup2':
        	$sql = " SELECT Term_Name, Description from tblcondition WHERE Group_ID = '" .$_POST['id']. "' ";
			$result = mysql_query($sql, $connection);
			$row = mysql_fetch_array($result);
			echo $row[0] ."|". $row[1];
		break;

		case 'filterbygroup2':
			echo "<option value=''>All</option>";
			$sql = "SELECT Group_ID, Group_Name FROM tblgroups";
            $result = mysql_query($sql, $connection);
            while ( $row = mysql_fetch_array($result)) {
                echo"
                <option value='". $row[0] ."'>".$row[1]."</option>
                ";
            }
        break;

        case 'loadentries':
            	if($_POST['groupname'] == ""){
				$groupname = "";
				}
				else{
					$groupname = " (Group_ID = '". $_POST['groupname'] ."') AND";
				}
				$info = " ( Term_Name LIKE '%".$_POST['txttermsanconditionsearch']."%') AND";
			    $statmo = " Stats LIKE '%".$_POST['jstat']."%' ";

               if($_POST["page"] == ""){
                   $page = 1;
               }else{
                   $page = $_POST["page"];
               }

               $limit = ($page-1) * 20;

                $sql = "SELECT COUNT(*) FROM tblcondition where ".$groupname." ".$info." ".$statmo." ";
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

		case "loadpagetac":
           	if($_POST['groupname'] == ""){
			$groupname = "";
			}
			else{
				$groupname = " (Group_ID = '". $_POST['groupname'] ."') AND";
			}
			$info = " ( Term_Name LIKE '%".$_POST['txttermsanconditionsearch']."%') AND";
		    $statmo = " Stats LIKE '%".$_POST['jstat']."%' ";

		    $page = $_POST["page"];

        	$sqlb = "SELECT COUNT(*) FROM tblcondition WHERE ".$groupname." ".$info." ".$statmo." ";
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
		    if($page > 1 )
				{
				   echo "<li style='width:50px !important;' onclick='pagination(1)'><< First</li>";
				   $prevpage = $page - 1;
				   echo "<li style='width:70px !important;' onclick='pagination(". $prevpage .")'>< Previous</li>";
				}
				for($x = ($page - $range); $x < (($page + $range) + 1); $x++)
				{
				   if (($x > 0) && ($x <= $totalpages))
				   {
				      if ($x == $page)
				      { 
				      	
			   	echo "<li id='pgtac" . $x . "' class='pgnumtac active' onclick='pagination(" . $x . ",". $x .")'>" . $x . "</li>"; }
				else
				{
				echo "<li id='pgtac" . $x . "' class='pgnumtac' onclick='pagination(" . $x . ",". $x .")'>" . $x . "</li>"; }
			       }
			    }
			    if($page < ($totalpages - $range))
			    { echo "<li>...</li>"; }
			    if ($page != $totalpages && $num != 0)
			    {
			       $nextpage = $page + 1;
			       echo "<li style='width:50px !important;' onclick='pagination(". $nextpage .", ". $nextpage .")'>Next ></li>";
			       echo "<li style='width:50px !important;' onclick='pagination(". $totalpages .", ". $totalpages .")'>Last >></li>";
			    }
		break;

		case 'loadeditgroup':
			$sql = " SELECT Group_ID, Group_Name, Term_Name, Description, Stats FROM tblcondition WHERE TERM_ID = '". $_POST['getid'] ."' ";
			$res = mysql_query($sql, $connection);
			$row = mysql_fetch_array($res);

			echo $row[0]. "|" . $row[1] . "|" . $row[2] . "|" . $row[3] . "|" . $row[4];
		break;

        
         
}
?>