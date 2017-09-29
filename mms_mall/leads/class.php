<?php 
include("../connect.php");

switch ($_POST["form"]) {
	
		case 'mall_branch':

		$mall_branch = "";

		$mall_branch = "<option value=''>--Select Mall Branch--</option>";
		# code...
		$sql = "SELECT mallid, mallname, malladdress FROM tblref_mall";
		$res = mysql_query($sql, $connection);

		while ($row = mysql_fetch_array($res)) {

			$mall_branch .= "
				<option value=".$row[0].">".$row[1]."</option>

			";


			# code...
		}

		echo $mall_branch;

		break;

		case 'saveleads':

		$leadsID = "";

		$getmax = "SELECT leadsID FROM trans_leads ORDER BY id desc LIMIT 0, 1";
		$resultmaxno = mysql_query($getmax, $connection);
		$maxno = mysql_fetch_array($resultmaxno);
		if($maxno[0] == "")
		{ 	$leadsID = "L-" . addleadingzero("1"); }
		else
		{
			$arr = explode("-", $maxno[0]);
			$leadsID = "L-" . addleadingzero($arr[1]+1);
		}

		$sql = "INSERT INTO trans_leads SET leadsID = '".$leadsID."', firstName = '".$_POST['firstName']."', middleName = '".$_POST['Mname']."', lastName = '".$_POST['Lname']."', occupation = '".$_POST['Occu']."', mobile_number = '".$_POST['Cnum']."', telephone = '".$_POST['Tnum']."', email = '".$_POST['email']."', address = '".$_POST['Addr']."', date_created = '".date('Y-m-d')."', status = 'Pending'  ";
		$res = mysql_query($sql, $connection);





		break;

		case 'statusPo':

		$sql = "SELECT status FROM trans_leads WHERE leadsID = '".$_POST['userID']."'";
		$res = mysql_query($sql, $connection);

		$row = mysql_fetch_array($res);

		echo $row[0];


		break;


        case 'loadfilters_leads':
            $sql = "SELECT checked_value, otherfilter, bystat, xcheck FROM tblref_filters WHERE module = '".$_POST["module"]."'";
            $result = mysql_query($sql, $connection);
            $row = mysql_fetch_array($result);

            echo $row["checked_value"] . "#" . $row["otherfilter"] . "#" . $row["bystat"] . "#" . $row["xcheck"];
        break;  

        case 'saveleadsfilter':
        $sql = "SELECT checked_value FROM tblref_filters WHERE module = '".$_POST["module"]."'";
        $result = mysql_query($sql, $connection);
        $num = mysql_num_rows($result);
        $row = mysql_fetch_array($result);

        if($num == 0)
        {
            $sql_insert = "INSERT INTO tblref_filters (module, checked_value, filters, otherfilter, bystat, xcheck)VALUES('".$_POST["module"]."', '".$_POST["checked"]."', '".$_POST["checked2"]."', '". $_POST['contractstart'] . "|" . $_POST['contractend'] ."', '". $_POST['checked3'] ."', '". $_POST['tstatus'] ."')";
            $result_insert = mysql_query($sql_insert, $connection);
            
            if($result_insert == true)
            {
                echo 1;
            }
        }
        else
        {
            $sql_update= "UPDATE tblref_filters SET checked_value = '".$_POST["checked"]."', otherfilter = '". $_POST['contractstart'] . "|" . $_POST['contractend'] ."', bystat = '". $_POST['checked3'] ."', xcheck = '". $_POST['tstatus'] ."' WHERE module = '".$_POST["module"]."'";
            $result_update = mysql_query($sql_update, $connection); 
            if($result_update == true)
            {
                echo 1;
            }       
        }
        break;

		case 'tblLeads':

		$page = $_POST["page"];
        $limit = ($page-1) * 5;

        

		$stat = "";

		$sql = "SELECT firstName, middleName, lastName, occupation, mobile_number, telephone, email, address, leadsID, status, progress_bar FROM trans_leads WHERE firstName LIKE '%".$_POST['txtlead']."%' OR middleName LIKE '%".$_POST['txtlead']."%' OR lastName LIKE '%".$_POST['txtlead']."%' OR leadsID LIKE '%".$_POST['txtlead']."%' OR status LIKE '%".$_POST['txtlead']."%'  LIMIT ".$limit.", 5";
		$res = mysql_query($sql, $connection);

		while ($row = mysql_fetch_array($res)) {

			if($row[9] == 'Pending')
	          {
	               $stat = '<span class="label label-sm label-success">Application on process . . .</span>';
	           }else if($row[9] == 'Approved'){

	                $stat = '<span class="label label-sm label-info">Approved Application</span>';

	          }else if($row[9] == 'Denied'){

	          	$stat = '<span class="label label-sm label-danger">Blocked</span>';

	          }
	   $sqlReq = "SELECT COUNT(*) FROM tbltrans_leasingapplicationreq WHERE reqID = '".$row[8]."' ";
	   $resReq = mysql_query($sqlReq, $connection);
	   $rowReq = mysql_fetch_array($resReq);       

	          if($rowReq[0] == '1'){
	         $progressBar = '<div class="progress">
    				<div class="progress-bar progress-bar-danger progress-bar-striped active" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="10" style="width:15%">
      					10%
    				</div>
  				</div>'; 
  			}else if ($rowReq[0] == '2'){

  				$progressBar = '<div class="progress">
    				<div class="progress-bar progress-bar-warning progress-bar-striped active" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="40" style="width:40%">
      					40%
    				</div>
  				</div>'; 

  			}else if ($rowReq[0] == '3'){

  					$progressBar = '<div class="progress">
    				<div class="progress-bar progress-bar-success progress-bar-striped active" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="70" style="width:70%">
      					70%
    				</div>
  				</div>'; 

  			}
  			else if ($rowReq[0] == '4'){

  					$progressBar = '<div class="progress">
    				<div class="progress-bar progress-bar-success progress-bar-striped active" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width:100%">
      					Complete
    				</div>
  				</div>'; 

  			}
  			else if ($rowReq[0] == '0'){

  					$progressBar = '<div class="progress">
    				<div  role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="30" style="width:100%">
      					<center>N/A</center>
    				</div>
  				</div>'; 

  			}
  			
			echo "
				<tr id='".$row[8]."' style='width: 100%;display: table;table-layout: fixed;'>
					<td width='10%' >".$row[8]."</td>
					<td width='15%' >".$progressBar."</td>
					<td width='20%' >".$row[0]." ".$row[1]." ".$row[2]."</td>
					<td width='15%'  >".$row[4]."</td>
					<td width='15%' >".$row[6]."</td>
					<td width='15%' >".$stat."</td>
					<td width='10%' >
							<div class='btn-group'>
							<button class='btn btn-xs btn-info' onclick='transToInq(\"". $row[8] ."\", \"".$row[9]."\", \"".$rowReq[0]."\")' title='Transfer To Inquiry'>
	                                <img src='assets/images/network.png' style='width:15px; height:15px;' />
	                         </button>
	                        <button class='btn btn-xs btn-gray' onclick='viewLeads(\"". $row[0] ."\", \"". $row[1] ."\", \"". $row[2] ."\" , \"". $row[3] ."\", \"". $row[8] ."\", \"". $row[4] ."\", \"". $row[5] ."\", \"". $row[6] ."\" ,\"". $row[7] ."\", \"".$row[9]."\")' title='View Leads'>
	                                <img src='assets/images/contract.png' style='width: 100%; height: auto;' />
	                         </button>
	                                    


							</div>




					</td>
					
				</tr>

			";

			# code...
		}

		break;

		 case "loadpaginationuser":
                

    		    $page = $_POST["page"];

            	$sqlb = "SELECT COUNT(*) FROM trans_leads";
    			$aa = mysql_query($sqlb, $connection);
    			$nums = mysql_fetch_row($aa);
    			$num = $nums[0];
    			// if($num <= 20)
    			// {
    			// 	$page = 1
    			// }
    			$rowsperpage = 5;
    			$range = 4;
    			$totalpages = ceil($num / $rowsperpage);
    			$prevpage;
    			$nextpage;
    			// if not on page 1, don't show back links

    			if($page > 1 ){
    			   echo "<li style='width:50px !important;' onclick='getvaluser(1)'><< First</li>";
    			   $prevpage = $page - 1;
    			   echo "<li style='width:70px !important;' onclick='getvaluser(". $prevpage .")'>< Previous</li>";
    			}

    			for($x = ($page - $range); $x < (($page + $range) + 1); $x++)
    			{
    			   if (($x > 0) && ($x <= $totalpages)){
        			    if ($x == $page){
                            echo "<li id='pgptnts" . $x . "' class='pgnumptnts active' onclick='getvaluser(" . $x . ",". $x .")'>" . $x . "</li>";
                          }
        			    else{
        			        echo "<li id='pgptnts" . $x . "' class='pgnumptnts' onclick='getvaluser(" . $x . ",". $x .")'>" . $x . "</li>";
                        }
    		       }
    		    }
    		    if($page < ($totalpages - $range)){
                    echo "<li>...</li>";
                }

    		    if ($page != $totalpages && $num != 0){
    		       $nextpage = $page + 1;
    		       echo "<li style='width:50px !important;' onclick='getvaluser(". $nextpage .", ". $nextpage .")'>Next ></li>";
    		       echo "<li style='width:50px !important;' onclick='getvaluser(". $totalpages .", ". $totalpages .")'>Last >></li>";
    		    }
    		break;

            case 'loadentriesuser':
               

               if($_POST["page"] == ""){
                   $page = 1;
               }else{
                   $page = $_POST["page"];
               }

               $limit = ($page-1) * 5;

                $sql = "SELECT COUNT(*) FROM trans_leads ";
                $result = mysql_query($sql, $connection);
                $row = mysql_fetch_array($result);

                $rowsperpage = 5;
                $totalpages = ceil($row[0] / $rowsperpage);
                $upto = $limit + 5;
                $from = $limit + 1;
                
                if($page == $totalpages && $row[0] != 0){
                     echo "Showing " . $from . " to " . $row[0] . " of " . $row[0] . " entries";
                }
                else
                {
                     if($row[0] == 0){
                       echo "";
                      }
                     else if($row[0] <= 4 && $row[0] != 0){
                       echo "Showing 1 to " . $row[0] . " of " . $row[0] . " entries";
                      }
                     else if($row[0] >= 5 && $row[0] != 0){
                       echo "Showing " . $from . " to " . $upto . " of " . $row[0] . " entries";
                      }

                 }
       break;

		case 'unblockLeads':

		$sql = "UPDATE trans_leads SET status = 'Pending' WHERE leadsID = '".$_POST['userID']."'";
		$res = mysql_query($sql, $connection);


		break;

		case 'ApproveStat':

		$sql = "UPDATE trans_leads SET status = 'Approved' WHERE leadsID = '".$_POST['haha']."'";
		$res = mysql_query($sql, $connection);


		break;

		case 'cancelTo':

		$sql = "UPDATE trans_leads SET status = 'Denied' WHERE leadsID = '".$_POST['leadsID']."'";
		$res = mysql_query($sql, $connection);

		



		break;

		case 'unblockLeads':

		$sql1 = "SELECT status FROM trans_leads WHERE leadsID = '".$_POST['leadsID']."'";
		$res1 = mysql_query($sql1, $connection);

		$row = mysql_fetch_array($res1);

		echo $row[0];



		break;

		case 'EditLeads':

		$sql = "UPDATE trans_leads SET firstName = '".$_POST['firstName1']."', middleName = '".$_POST['Mname1']."', lastName = '".$_POST['Lname1']."', occupation = '".$_POST['Occu1']."', mobile_number = '".$_POST['Cnum1']."', telephone = '".$_POST['Tnum1']."', email = '".$_POST['email1']."', address = '".$_POST['Addr1']."' WHERE leadsID = '".$_POST['userID']."'";
		$res = mysql_query($sql, $connection);

		echo "Successfully Updated!";

		break;

		case 'Rleads':

			$i = 0;
			$sql = "SELECT id, requirements FROM tblref_applicationrequirements";
			$result = mysql_query($sql, $connection);
			while($row = mysql_fetch_array($result))
			{
				$sql2 = "SELECT filename, filetype, filename FROM tbltrans_leasingapplicationreq WHERE 
				 reqID = '".$_POST["userID"]."' AND type_req_ID = '".$row["id"]."'";
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
                                <input type="text" name="txtaapid" class="txtaapid" value="'.$_POST["userID"].'" id="txtappid_form_'.$i.'"><br />
                                <input type="text" name="txtinqqid" class="txtinqqid" value="'.$_POST["userID"].'" id="txtinqid_form_'.$i.'">
                              </div>
                                <input type="file" class="upload_app_req id-input-file-2" name="attachment_filess" onchange="chkclippeddocx($(this))" '.$_POST["inputt"].'/><input type="hidden" name="hiddenidss" value="'.$row["id"].'">
                              </form></div></div>';
				}
				else
				{
					$file = '<div class="row">
							 <div class="col-xs-6">'.$row["requirements"].'</div><div class="col-xs-1"><i style="color:green;" class="ace-icon fa fa-check bigger-120" onclick="deleteMe();"></i></div>';
					$file .= '<div class="col-xs-5" style="white-space: nowrap;text-overflow: ellipsis;overflow: hidden;">';
					$file .= '<button class="btn btn-xs btn-info" style="padding:2px;margin-bottom:3px;margin-left:2px;display:inline;">
								<a href="leads/leads/Requirements/'.$_POST["userID"].'/'.$row["requirements"].'/'.$row2["filename"].'" download><i style="color:white !important;" class="ace-icon fa fa-arrow-down bigger-120"></i></a>
							  </button>';

							$linkimage = 'leads/leads/Requirements/'.$_POST["userID"].'/'.$row["requirements"].'/'.$row2["filename"];
							if($row2["filetype"] == "image/jpeg" || $row2["filetype"] == "image/png" || $row2["filetype"] == "image/jpg")
							{
								$file .= "<button class='btn btn-xs btn-purple' style='padding:2px;margin-bottom:3px;margin-left:2px;display:inline;' onclick='load_req_image1(\"". $linkimage ."\")' title='view image'>
									<i class='ace-icon fa fa-picture-o bigger-120'></i>
									</button>";
							}
							else
							{
								$file .= '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
							}
									
					$file .= '<p class="req_nam_'.$_POST["userID"].'" id="'.$row2["filename"].'" style="font-size:11px;font-weight:normal;font-style:italic;display:inline;">&nbsp;&nbsp;'.$row2["filename"].'</p></div>
							</div>';						
				}

				

				echo $file;
			}		

		break;

		case 'savenewremark':

		
		$remID = "";

		$getmax = "SELECT remID FROM tbltrans_remarks ORDER BY id desc LIMIT 0, 1";
		$resultmaxno = mysql_query($getmax, $connection);
		$maxno = mysql_fetch_array($resultmaxno);
		if($maxno[0] == "")
		{ 	$remID = "REM-" . addleadingzero("1"); }
		else
		{
			$arr = explode("-", $maxno[0]);
			$remID = "REM-" . addleadingzero($arr[1]+1);
		}

		$sql = "INSERT INTO tbltrans_remarks SET remID = '".$remID."', leadsID = '".$_POST['id']."', xremarks = '".$_POST['txtArea']."'";
		$res = mysql_query($sql, $connection);

		break;

		case 'loadRemarks':

		$sql= "SELECT xremarks FROM tbltrans_remarks WHERE leadsID = '".$_POST['userID']."'";
		$res = mysql_query($sql, $connection);

		while($row = mysql_fetch_array($res))
			{
			echo "<li class='dd-item dd2-item' id='module_1' style='cursor: pointer;'>
				    <div class='dd2-content'><small style='width:80%;font-size: 85%;display: inline-block;color:black !important;text-align:justify'>".$row[0]."</small>
				       <a href='#' title='Edit Company Profile' class='btnedit' style='float:right;padding-left:2px;display: inline-block;' onclick='edittranremarks(\"".$row["remID"]."\", \"".$row["leadsID"]."\");'><i class='ace-icon fa fa-pencil' style='font-size:15px;'></i></a>
				       <a href='#' title='Delete Company Profile' class='btnedit' style='float:right;padding-left:2px;padding-right:4px;font-size:15px;display: inline-block;' onclick='deletetranremarks(\"".$row["remID"]."\", \"".$row["inqID"]."\");'><i class='ace-icon fa fa-remove' style='color:#b30000;'></i></a>
				       <br />
				       <br /><text style='font-size: 80%;font-weight: normal;margin:0px;'>Added by: ".$row["firstname"]." ".$row["lastname"]."</text><br />
				       		<text style='font-size: 80%;font-weight: normal;margin:0px;'>Date Added: ".date("F d, Y h:i:s A", strtotime($row["xdate"]))."</text>
				       	<br />
				    </div>
				  </li>";
			}



		break;

		case 'Occu':

		$loadOcc = "";

		$loadOcc = "<option value=''>--Select Industry--</option>";
		$sql = "SELECT Industry_ID, Industry FROM tblref_industry";
		$res = mysql_query($sql, $connection);

		while ($row = mysql_fetch_array($res)) {

			$loadOcc .= "
			<option value=".$row[0].">".$row[1]."</option>

			";
			# code...
		}

		echo $loadOcc;


		break;

	
}






?>


