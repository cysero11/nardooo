<?php
    include('../connect.php');

    switch ($_POST['form']) {

            case 'counttenantstatus':
                $sql = "SELECT COUNT(id) FROM tbltrans_tenants WHERE Status = 'foreviction'";
                $result = mysql_query($sql, $connection);
                $row = mysql_fetch_array($result);

                echo $row[0];
            break;

            case 'tbltenantlists':
                $page = $_POST["page"];
                $limit = ($page-1) * 5;

                $cnt_fltr = 0;
                $sql_filter = mysql_fetch_array(mysql_query("SELECT checked_value, otherfilter, bystat, xcheck FROM tblref_filters WHERE module = 'Tenant'"));
                $trby = explode("|", $sql_filter["checked_value"]);
                $stat = explode("|", $sql_filter["bystat"]);
                $unit = explode("|", $sql_filter["xcheck"]);
                $date = explode("|", $sql_filter["otherfilter"]);
                $filter = "";

                // filter for status
                $cnt = 0; $chk = "";
                for($a = 0; $a<=count($stat)-1; $a++)
                {
                    if($stat[$a] == "actived"){ $con = " status LIKE '%actived%' "; }
                    else if($stat[$a] == "inactive"){ $con = " status LIKE '%inactive%' "; }
                    else if($stat[$a] == "forrenewal"){ $con = " status LIKE '%forrenewal%' "; }
                    else if($stat[$a] == "foreviction"){ $con = " status LIKE '%foreviction%' "; }
                    else if($stat[$a] == "evicted"){ $con = " status LIKE '%evicted%' "; }
                    else if($stat[$a] == "endofcon"){ $con = " status LIKE '%endofcon%' "; }

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
                            $chk2 .= "ustatus = '".$unit[$b]."'";
                        }
                        else
                        {
                            $chk2 .= " OR ustatus = '".$unit[$b]."'";
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
                $date_fltr = "(dateto BETWEEN '".date("Y/m/d", strtotime($date[0]))."' AND '".date("Y/m/d", strtotime($date[1]))."')";

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

                $sql = "SELECT TenantID, CONCAT(owner_firstname, ' ', LEFT(owner_midname, 1), '. ', owner_lastname) as tenant, companyname, unitID, unitname, status, datefrom, dateto, noofmonths, costpermonths, inqID, appID, remarks, noofdays, CompanyID, tradename, mallID, remarks, merchant_code, tenanttype, tenantphoto FROM tbltrans_tenants ".$filterselected." LIMIT ".$limit.", 5";
                $result = mysql_query($sql, $connection);
                while ($row = mysql_fetch_array($result)) {

                    $sql2 = "SELECT buildingname, unitname, floorunit, typeofbusiness, classificationname, sqmunitsetup, pricepersqmunitsetup, totalamountunitsetup, wingID, mallID, unitID FROM tblref_unit WHERE unitid = '".$row[3]."'";
                    $result2 = mysql_query($sql2, $connection);
                    $row2 = mysql_fetch_array($result2);

                    $sql3 = "SELECT * FROM tblref_floorsetup WHERE floorid = '".$row2[2]."'";
                    $result3 = mysql_query($sql3, $connection);
                    $row3 = mysql_fetch_array($result3);

                    $sql4 = "SELECT filename, tradeID FROM tbltrans_tradename WHERE companyID = '".$row[14]."'";
                    $result4 = mysql_query($sql4, $connection);
                    $row4 = mysql_fetch_array($result4);

                    $sql5 = "SELECT wing FROM tblref_wing WHERE wingID = '".$row2[8]."'";
                    $result5 = mysql_query($sql5, $connection);
                    $row5 = mysql_fetch_array($result5);

                    $sql6 = "SELECT mallname FROM tblref_mall WHERE mallID = '".$row[16]."'";
                    $result6 = mysql_query($sql6, $connection);
                    $row6 = mysql_fetch_array($result6);

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
                    else if($row[5] == "endofcon"){
                        $stat = "<span class='fa fa-flag' style='font-weight: 700; color: #D6487E;'></span>";
                    }

                    $dateofnotif = date( 'Y/m/d', strtotime($row[7].'-10 days') );
                    $datengayon = date('Y/m/d');

                    $renew = "";
                    if($dateofnotif <= $datengayon){
                        $renew= "style='display: inline;'";
                    }
                    else{
                        $renew = "style='display: none;'";
                    }

                    $dateofendo = date( 'Y/m/d', strtotime($row[7].'-10 days') );

                    $manualeoc = "";
                    if( $dateofendo <= $datengayon ){
                        $manualeoc = "style='display: inline;'";
                    }
                    else{
                        $manualeoc = "style='display: none;'";
                    }

                    $e = "eviction";
                    $w = "warning";



                    $showinfo = "<button class='btn btn-xs btn-info'onclick='showinfo(\"".$row[0]."\", \"".$row[6]."\", \"".$row[7]."\", \"".$row2[1]."\", \"".$row3[4]."\", \"".$row5[0]."\", \"".$row[8]."\", \"".$row[9]."\", \"".$row[10]."\", \"".$row2[3]."\", \"".$row2[4]."\", \"".$row2[5]."\", \"".$row2[6]."\", \"".$row2[7]."\", \"".$row[5]."\", \"".$row[1]."\", \"".$row[2]."\", \"".$row[11]."\", \"".$row[13]."\", \"".$row[14]."\", \"".$row4[0]."\", \"".$row4[1]."\", \"".$row6[0]."\", \"".$row[17]."\", \"".$row[18]."\", \"".$row[19]."\", \"".$row[16]."\", \"".$row[20]."\");' title='View Information'><img src='assets/images/view.png' style='width: 100%; height: auto;' /></button>";

                    $renewcontract = "<button ".$manualeoc." class='btn btn-xs btn-primary' onclick='renewcontract(\"".$row[0]."\", \"".$row[10]."\", \"".$row[14]."\", \"".$row4[1]."\", \"".$row[3]."\", \"".$row[10]."\", \"".$row[16]."\", \"".$row2[3]."\", \"".$row[11]."\");' title='Renew Contract'><img src='assets/images/contract.png' style='width: 100%; height: auto;' /></button>";

                    $warningforeviction = "<button class='btn btn-xs btn-warning' onclick='modaleviction(\"".$row[0]."\", \"".$w."\", \"".$row[0]."\", \"".$row[10]."\", \"".$row[11]."\")' title='Send Warning'><img src='assets/images/warning.png' style='width: 100%; height: auto;' /></button>";

                    $evictenant = "<button class='btn btn-xs btn-warning' onclick='modaleviction(\"".$row[0]."\", \"".$e."\");' title='Evict Tenant'><img src='assets/images/doorway.png' style='width: 100%; height: auto;' /></button>";

                    $complaints = "<button class='btn btn-xs btn-danger' onclick='addcomplaints(\"".$row[0]."\", \"".$row[1]."\", \"".$row2[0]."/".$row2[1]."/ ".$row2[2]."\", \"".$row[2]."\", \"".$row2[9]."\", \"".$row2[10]."\", \"".$row2[2]."\");' title='Add Complaints'><img src='assets/images/sad.png' style='width: 100%; height: auto;' /></button>";

                    $viewlogs = "<button class='btn btn-xs btn-success' onclick='viewhistorytenant(\"". $row[0] ."\")' title='View Logs'><img src='assets/images/clock.png' style='width: 100%; height: auto;' /></button>";

                    $showeoc  = "<button class='btn btn-xs btn-yellow' onclick='showeocdate(\"". $row[0] ."\", \"". $row[10] ."\", \"". $row[11] ."\")' title='End of Contract'><img src='assets/images/file.png' style='width: 100%; height: auto;' /></button>";

                    $evictionbutton = "";
                    if($row[5] == "actived"){
                        $evictionbutton = $warningforeviction;
                    }else if($row[5] == "foreviction"){
                        $evictionbutton = $evictenant;
                    }

                    $buttons = "";
                    if($row[5] == "actived"){
                        $buttons = $showinfo.$renewcontract.$evictionbutton.$complaints.$viewlogs.$showeoc;
                    }else if($row[5] == "inactive"){
                        $buttons = $showinfo.$renewcontract.$evictionbutton.$complaints.$viewlogs.$showeoc;
                    }else if($row[5] == "forrenewal"){
                        $buttons = $showinfo.$renewcontract.$evictionbutton.$complaints.$viewlogs.$showeoc;
                    }else if($row[5] == "foreviction"){
                        $buttons = $showinfo.$renewcontract.$evictionbutton.$complaints.$viewlogs.$showeoc;
                    }else if($row[5] == "evicted"){
                        $buttons = $showinfo.$viewlogs.$showeoc;
                    }else if($row[5] == "endofcon"){
                        $buttons = $showinfo.$$renewcontract.$viewlogs;
                    }

                    echo "
                        <tr>
                            <td width='3%' align='center'>".$stat."</td>
                            <td width='10%'>". $row[0] ."</td>
                            <td width='3%'>".$row[18]."</td>
                            <td width='11%'>".$row[2]."</td>
                            <td width='11%'>";
                            ?>
                            <?php if( $row[20] == "" ){ ?>
                            <img style='margin-right: 5px;' class='img-circle' src='server/company/<?php echo $row[14]; ?>/trades/<?php echo $row4[1];  ?>/<?php echo $row4[0]; ?>' width='20px' height='20px' /><?php echo $row[15]; ?></td>
                           <?php } else { ?>
                            <img style='margin-right: 5px;' class='img-circle' src='tenants/tenantsimages/<?php echo $row[20]; ?>' width='20px' height='20px' /><?php echo $row[15]; ?></td>
                            <?php } ?>

                            <?php
                            echo "
                            <td width='10%'>".$row[1]."</td>
                            <td width='25%'>".$row5[0]."/ ".$row2[1]."/ ".$row3[4]."</td>
                            <td width='8%'>".date('Y-m-d', strtotime($row[6]))."</td>
                            <td width='8%'>".date('Y-m-d', strtotime($row[7]))."</td>
                            <td width='11%'>
                            <div class='btn-group'>";
                                echo $buttons;
                            echo "</div></td>
                        </tr>
                    ";

                }
            }
            break;

            case "loadpaginationuser":
                $sql_filter = "SELECT checked_value FROM tblref_filters WHERE module = 'Tenant'";
                $result_filter = mysql_query($sql_filter, $connection);
                $row_filter = mysql_fetch_array($result_filter);
                $filters = explode("|", $row_filter["checked_value"]);
                $condition = "WHERE ";
                if($row_filter["checked_value"] != "")
                {
                    $condition .= "(";
                }
                for($i=0; $i<=count($filters)-2; $i++)
                {
                    if($i > 0)
                    {
                        $condition .= "OR ".$filters[$i]. " LIKE '%".$_POST["txtsearchtenantlist"]."%' ";
                    }
                    else
                    {
                        $condition .= $filters[$i]. " LIKE '%".$_POST["txtsearchtenantlist"]."%' ";
                    }
                }
                if($row_filter["checked_value"] != "")
                {
                    $condition .= ") ";
                }

    		    $page = $_POST["page"];

            	$sqlb = "SELECT COUNT(*) FROM tbltrans_tenants ".$condition." ";
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
                $sql_filter = "SELECT checked_value FROM tblref_filters WHERE module = 'Tenant'";
                $result_filter = mysql_query($sql_filter, $connection);
                $row_filter = mysql_fetch_array($result_filter);
                $filters = explode("|", $row_filter["checked_value"]);
                $condition = "WHERE ";
                if($row_filter["checked_value"] != "")
                {
                    $condition .= "(";
                }
                for($i=0; $i<=count($filters)-2; $i++)
                {
                    if($i > 0)
                    {
                        $condition .= "OR ".$filters[$i]. " LIKE '%".$_POST["txtsearchtenantlist"]."%' ";
                    }
                    else
                    {
                        $condition .= $filters[$i]. " LIKE '%".$_POST["txtsearchtenantlist"]."%' ";
                    }
                }
                if($row_filter["checked_value"] != "")
                {
                    $condition .= ") ";
                }

               if($_POST["page"] == ""){
                   $page = 1;
               }else{
                   $page = $_POST["page"];
               }

               $limit = ($page-1) * 5;

                $sql = "SELECT COUNT(*) FROM tbltrans_tenants  ".$condition." ";
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

            case 'tblcontactinfo':
                $sql = "SELECT ConID, CONCAT(Confname, ' ', LEFT(Conmname, 1), '. ', Conlname) as conname, designation, custID, Confname, Conmname, Conlname, address, filename FROM tbltrans_company_contact_person WHERE ConID = '".$_POST['compid']."'";
                $result = mysql_query($sql, $connection);
                while ($row = mysql_fetch_array($result)) {

                    $sql2 = "SELECT type, content FROM tbltrans_company_contact_person_contacts WHERE ConID = '".$row[3]."' AND TYPE = 'Mobile' ";
                    $result2 = mysql_query($sql2, $connection);
                    $row2 = mysql_fetch_array($result2);

                    $sql3 = "SELECT type, content FROM tbltrans_company_contact_person_contacts WHERE ConID = '".$row[3]."' AND TYPE = 'Telephone' ";
                    $result3 = mysql_query($sql3, $connection);
                    $row3 = mysql_fetch_array($result3);

                    $sql4 = "SELECT type, content FROM tbltrans_company_contact_person_contacts WHERE ConID = '".$row[3]."' AND TYPE = 'Email' ";
                    $result4 = mysql_query($sql4, $connection);
                    $row4 = mysql_fetch_array($result4);

                    ?>
                    <div class="col-md-4">
                        <center style="border: 1px solid #C5D0DC; border-radius: 4px; padding-top: 10px; padding-bottom: 10px; height: 300px; margin-top: 4px; border-top: 3px solid #4C8FBD;">
                        <?php if( $row[8] == "" ){ ?>
                            <img src="assets/images/avatars/noimage.png" class="img-responsive img-thumbnail" style="height: 110px; width: 110px;" onerror="imgerror($(this));">
                        <?php } else { ?>
                            <img src="server/company/<?php echo $row[0]; ?>/contact_person/<?php echo $row[3]; ?>/<?php echo $row[8]; ?>" class="img-responsive img-thumbnail" style="height: 110px; width: 110px;" onerror="imgerror($(this));">
                        <?php } ?>
                            <br>
                                <span style="font-weight: 700; color: #69AA46; font-size: 14px;"><?php echo $row[1]; ?>
                                <button class="btn btn-xs btn-success" onclick="editcontactinfo('<?php echo $row[6]; ?>', '<?php echo $row[4]; ?>', '<?php echo $row[5]; ?>', '<?php echo $row[2]; ?>', '<?php echo $row[7]; ?>', 'server/company/<?php echo $row[3]; ?>/contact_person/<?php echo $row[3]; ?>/<?php echo $row[8]; ?>', '<?php echo $row[8]; ?>', '<?php echo $row[3]; ?>');"><span class="fa fa-pencil"></span></button>
                                </span>
                                <br>
                                <span style="font-size: 14px;"><?php echo $row[2]; ?></span><br><br>
                            <div style="height: 100px; overflow-y: auto; font-size: 14px;">
                                <span><span class="fa fa-mobile"></span><?php echo $row2[1]; ?></span><br>
                                <span><span class="fa fa-phone"></span><?php echo $row3[1]; ?></span><br>
                                <span><span class="fa fa-envelope"></span><?php echo $row4[1]; ?></span><br>
                                <span><span class="fa fa-home"></span><?php echo $row[7]; ?></span>
                            </div>
                        </center>
                        <br>
                    </div>
                    <?php
                }
            break;

            case 'tblrequirements':
                $sql = "SELECT type_req_ID, filename, docname, docdesc, appID, filetype FROM tbltrans_leasingapplicationreq WHERE reqID = '".$_POST["id"]."'";
                $result = mysql_query($sql, $connection);
                while ($row = mysql_fetch_array($result)) {

                    $sql2 = "SELECT requirements FROM tblref_applicationrequirements WHERE id = '".$row[0]."'";
                    $result2 = mysql_query($sql2, $connection);
                    $row2 = mysql_fetch_array($result2);

                    $docname = "";
                    if($row[0] == ""){
                        $docname = $row[2];
                    }else{
                        $docname = $row2[0];
                    }

                    $sql3 = "SELECT Status FROM tbltrans_tenants WHERE inqID = '".$_POST["id"]."'";
                    $res3 = mysql_query($sql3, $connection);
                    $row3 = mysql_fetch_array($res3);
                        if($row3[0] == "evicted" || $row3[0] == "inactive"){
                            $evict ="disabled='true'";
                        }else{
                            $action = "href = 'server/Requirements/".$row[4]."/".$docname."/".$row[1]."' download";
                        }

                    $btn = "";
                    $arr = explode("/", $row[5]);
                    if($arr[0] != "image"){
                        $btn = "
                        <a ".$action.">
                            <span class='btn-xs btn-info' ".$evict."><i class='fa fa-download'></i></span>
                        </a>
                        ";
                    }else{
                        $imgname = "server/Requirements/".$row[4]."/".$docname."/".$row[1];
                        $btn = "
                        <a onclick='viewdocuimg(\"".$imgname."\");'>
                            <span class='btn-xs btn-info' ".$evict."><i class='fa fa-eye'></i></span>
                        </a>
                        ";
                    }

                    echo "
                    <tr>
                        <td width='31%'>".$docname."</td>
                        <td width='31%'>".$row[3]."</td>
                        <td width='30%'>".$row[1]."</td>
                        <td width='7%' align='center'>
                            ".$btn."
                        </td>
                    </tr>
                    ";
                }
            break;

            case 'savecontactperson':
                $compID = createidno("COM", "tbltrans_company_contact_person", "ConID");
                $custID = createidno("CON", "tbltrans_company_contact_person", "custID");

                if($_POST['conid'] == ""){
                    $sql = "INSERT INTO tbltrans_company_contact_person SET custID = '".$custID."', ConID = '".$_POST['compid']."', name = '".$_POST['name']."', designation = '".$_POST['designation']."', Confname = '".$_POST['confname']."', Conmname = '".$_POST['conmname']."', Conlname = '".$_POST['conlname']."', address = '".$_POST['address']."' ";
                    $result = mysql_query($sql, $connection);

                    $arr = explode("#", $_POST['paddingmob']);
					for ( $i = 1; $i <= count($arr)-1; $i++ )
					{
						$arr2 = explode("|", $arr[$i]);
						$sqlNew ="INSERT INTO tbltrans_company_contact_person_contacts SET ConID = '".$custID."', type = '".$arr2[1]."', content = '".$arr2[2]."' ";
						$resultNew = mysql_query($sqlNew, $connection);
					}

                    $arr1 = explode("#", $_POST['paddingtelno']);
					for ( $i = 1; $i <= count($arr1)-1; $i++ )
					{
						$arr2 = explode("|", $arr1[$i]);
						$sqlNew ="INSERT INTO tbltrans_company_contact_person_contacts SET ConID = '".$custID."', type = '".$arr2[1]."', content = '".$arr2[2]."' ";
						$resultNew = mysql_query($sqlNew, $connection);
					}

                    $arr2 = explode("#", $_POST['paddingemail']);
					for ( $i = 1; $i <= count($arr2)-1; $i++ )
					{
						$arr3 = explode("|", $arr2[$i]);
						$sqlNew ="INSERT INTO tbltrans_company_contact_person_contacts SET ConID = '".$custID."', type = '".$arr3[1]."', content = '".$arr3[2]."' ";
						$resultNew = mysql_query($sqlNew, $connection);
					}

                    echo "Contact person successfully added." . "|" . $custID . "|" . $compID;
                }else{
                    $sql = "UPDATE tbltrans_company_contact_person SET custID = '".$custID."', ConID = '".$_POST['compid']."', name = '".$_POST['name']."', designation = '".$_POST['designation']."', Confname = '".$_POST['confname']."', Conmname = '".$_POST['conmname']."', Conlname = '".$_POST['conlname']."', address = '".$_POST['address']."' WHERE custID = '".$_POST['conid']."' ";
                    $result = mysql_query($sql, $connection);

                    echo "Contact person has been modified.|";
                }
            break;

            case 'tblaccountdetails':
                // $sql = "SELECT tenantid, xdate, reference, amount FROM tbltransaction WHERE tenantid ='".$_POST['tid']."' AND YEAR(xdate) = '2017' AND MONTH(xdate) = '2'";
                // $result = mysql_query($sql, $connection);
                // while ($row = mysql_fetch_array($result)) {
                //
                // <tr style='display: table;table-layout: fixed;width: 100%;display: table;'>
                //     <td width='17%'>".$row[1]."</td>
                //     <td width='15%'>".$row[0]."</td>
                //     <td width='22%'>".$row[2]." </td>
                //     <td align='right' width='15%'></td>
                //     <td align='right' width='12%'></td>
                //     <td align='right' width='12%'>".$row[3]."</td>
                //     <td align='right' width='12%'>0.00</td>
                // </tr>

                $sql = "SELECT count(id) AS transactionnum, tenantid, YEAR(xdate) YEAR, MONTH(xdate) Month, SUM(amount) as charges, SUM(xpenalty) as penalties, SUM(paymentamount) as payment, SUM(balance) as balance  FROM tbltransaction WHERE tenantid ='".$_POST['tid']."' AND amount > '0' GROUP BY YEAR(xdate),MONTH(xdate)";
                $result = mysql_query($sql, $connection);
                while ($row = mysql_fetch_array($result)) {

                    if($row[3] == 1){
                        $mon = "January";
                    }elseif($row[3] == 2){
                        $mon = "February";
                    }elseif($row[3] == 3){
                        $mon = "March";
                    }elseif($row[3] == 4){
                        $mon = "April";
                    }elseif($row[3] == 5){
                        $mon = "May";
                    }elseif($row[3] == 6){
                        $mon = "June";
                    }elseif($row[3] == 7){
                        $mon = "July";
                    }elseif($row[3] == 8){
                        $mon = "August";
                    }elseif($row[3] == 9){
                        $mon = "September";
                    }elseif($row[3] == 10){
                        $mon = "Octorber";
                    }elseif($row[3] == 11){
                        $mon = "November";
                    }else{
                        $mon = "December";
                    }

                    echo "
                    <tr>
                        <td width='14%'>".$mon.", ".$row[2]."</td>
                        <td width='15%'>".$row[1]."</td>
                        <td width='24%'>Total Payment in Month of ".$mon.", ".$row[2]." </td>
                        <td align='right' width='13%'>".number_format($row[4], "2",".",",")."</td>
                        <td align='right' width='10%'>".number_format($row[5], "2",".",",")."</td>
                        <td align='right' width='10%'>".number_format($row[6], "2",".",",")."</td>
                        <td align='right' width='10%'>".number_format($row[7], "2",".",",")."</td>
                        <td align='center' width='6%'>
                            <button class='btn btn-xs btn-info' onclick='tblviewtransall(\"".$row[1]."\", \"".$row[2]."\", \"".$row[3]."\");'><i class='fa fa-eye'></i></button>
                        </td>
                    </tr>
                    ";
                }
            break;

            case 'tblviewtransall':
                $sql = "SELECT tenantid, xdate, reference, amount, paymentamount, balance, xpenalty FROM tbltransaction WHERE tenantid ='".$_POST['tenantid']."' AND YEAR(xdate) = '".$_POST['yearname']."' AND MONTH(xdate) = '".$_POST['monname']."' AND amount > '0' ";
                $result = mysql_query($sql, $connection);
                while ($row = mysql_fetch_array($result)) {

                    if($row[6] > 0){
                        $charges = "0.00";
                    }else{
                        $charges = $row[3];
                    }
                    echo "
                    <tr>
                        <td width='17%'>".date('Y-M-d', strtotime($row[1]))."</td>
                        <td width='15%'>".$row[0]."</td>
                        <td width='22%'>".$row[2]." </td>
                        <td align='right' width='15%'>".number_format($charges, "2",".",",")."</td>
                        <td align='right' width='12%'>".number_format($row[6], "2",".",",")."</td>
                        <td align='right' width='12%'>".number_format($row[4], "2",".",",")."</td>
                        <td align='right' width='12%'>".number_format($row[5], "2",".",",")."</td>
                    </tr>
                    ";
                }
            break;

            case 'tblpdc':
			$sql = "SELECT pdcdate, lname, fname, depositorystat, checkstat, amount, pdcreceiptno, bank, checkno, chckreceivedby, depository, id, paymentstat, penalty, customerid, datedep FROM tbltrans_pdc WHERE inquiryid  = '".$_POST['id']."' " ;
			$result = mysql_query($sql, $connection);
			while ($row = mysql_fetch_array($result)) {

                $sql2 = "SELECT companyname FROM tbltrans_tenants WHERE tenantID = '".$row[14]."'";
                $result2 = mysql_query($sql2, $connection);
                $row2 = mysql_fetch_array($result2);

				$pdcamount = str_replace(',','',$row['amount']);

                        if($row[4] == "Insufficient Fund"){
                            $stat = "<span class='fa fa-circle' style='color: red;'></span>";
                        }
                        elseif ($row[4] == "Cleared"){
                            $stat = "<span class='fa fa-circle' style='color: green;'></span>";
                        }else{
                            $stat = "<span class='fa fa-circle' style='color: orange;'></span>";
                        }

    					echo "
    						<tr class='thisrow' onclick='choosepdc(\"". $row[0] ."\", \"". $row[3] ."\", \"". $row[1] ."\", \"". $row[2] ."\", \"". $row[8] ."\", \"". $row[7] ."\", \"". $row[9] ."\", \"". $row[10] ."\", \"". $row[5] ."\", \"". $row[4] ."\", \"". $row[11] ."\", \"". $row[12] ."\", \"". $pdctotal ."\", \"". $row[15] ."\");'>
    							<td width='15%'>". $row['pdcdate'] ."</td>
    							<td width='22%'>". $row['depositorystat'] ."</td>
    							<td width='20%'>". $row['datedep'] ."</td>
                                <td width='17%'>". $row['checkno'] ."</td>
    							<td width='8%' align='center'>".$stat."</td>
                                <td width='18%' align='right'>". number_format($pdcamount, "2", ".", ",")."</td>
    						</tr>
    					";
			}
		break;

        case 'savepdctransaction':
			// if($_POST['acccheckstat'] == "Insufficient Fund"){
            //  $sql = "UPDATE tbltrans_pdc SET depositorystat = '". $_POST['accstat'] ."', lname = '". $_POST['acclname'] ."', fname = '". $_POST['accfname'] ."', bank = '". $_POST['accbank'] ."', checkno = '". $_POST['acccheckno'] ."', chckreceivedby = '". $_POST['accreceiveby'] ."', depository = '". $_POST['accdepository'] ."', checkstat = '". $_POST['acccheckstat'] ."' WHERE inquiryid = '". $_POST['id'] ."' AND pdcdate = '". $_POST['accpdcdate'] ."' ";
            //  $result = mysql_query($sql, $connection);
            //
            //      // $totalamount = str_replace(',','',$_POST["accamount"]);
            //      // $transid = createidno("TRANS", "transaction_header", "inquiryid");
            //      // $sql2 = "INSERT transaction_header SET transactionid = '". $transid ."', customerid = '". $_POST['accpdcid'] ."', customername = '" . $_POST["accfname"] . " " . $_POST["acclname"] . "', mydate = '". $_POST['accpdcdate'] ."', mytime = '" . date("h:i:sa") . "', itemtype = 'PDC', itemname = 'Rent for the month of ". $_POST['accpdcdate'] ."', amount = '". $_POST['accamount'] ."', unitcost = '". $_POST['accamount'] ."', subtotal = '". $_POST['accamount'] . "', totalamount = '". $_POST['accamount'] ."', tagstat = 'Rent', paymentstat = '0' ";
            //      // $result2 = mysql_query($sql2, $connection);
            //
            //  echo "PDC has been modified and added to cashiering.";
            // }else{
                $sql = "UPDATE tbltrans_pdc SET depositorystat = '". $_POST['accstat'] ."', bank = '". $_POST['accbank'] ."', checkno = '". $_POST['acccheckno'] ."', chckreceivedby = '". $_POST['accreceiveby'] ."',
                depository = '".$_POST['accdepository']."', depositorystat = 'Deposited', checkstat = 'Cleared', datedep = '". date('Y/m/d', strtotime($_POST['accdatedep'])) ."' WHERE inquiryid = '". $_POST['id'] ."' AND pdcdate = '". $_POST['accpdcdate'] ."' ";
                $result = mysql_query($sql, $connection);

                    // $totalamount = str_replace(',','',$_POST["accamount"]);
                    // $sql2 = "INSERT tbltransaction SET tenantid = '".$_POST['tid']."', xcode = 'check', description = 'check', amount = '".$totalamount."', xdate = '".date('Y-m-d')."', reference = 'Monthly Rental', xpenaltystatus = '1', checkno = '".$_POST['acccheckno']."', checkdate = '".$_POST['accpdcdate']."', bankname = '".$_POST['accbank']."', totalamount = '".$totalamount."', xdatetime = '".date('Y-m-d H:i s')."'";
                    // $result2 = mysql_query($sql2, $connection);

                echo "PDC has been cleared.";
            // }
		break;

        case 'tblmaintenance':
            $sql = "SELECT staff_task_id, room_owner_id, ownername, building_id, floorid, task_id, location_id, worker_id, remarks, sched, startt, endt, duration, tagstat, labor_exp, material_exp, kilowatt, kilowatt_php, cubic_meter, cubic_php, total_amount, cutoff, duedate, paymentstat, img_bef_1 FROM pmls_android_worker_task_history WHERE room_owner_id = '". $_POST['tid'] ."' ";
            $result = mysql_query($sql, $connection);
            while ($row = mysql_fetch_array($result)) {

                $sqlunit = "SELECT unitname FROM tblref_unit WHERE unitid = '". $row[6] ."' ";
                $resunit = mysql_query($sqlunit, $connection);
                $rowunit = mysql_fetch_array($resunit);

                // $sqltask = "SELECT description FROM pmls_android_reftask WHERE task_id = '". $row[5] ."' ";
                // $restask = mysql_query($sqltask, $connection);
                // $rowtask = mysql_fetch_array($restask);

                $sqluser = "SELECT CONCAT(firstname, ' ',LEFT(middlename, 1), '. ',lastname) as workername FROM tbluser WHERE userid = '". $row[7] ."' ";
                $resuser = mysql_query($sqluser, $connection);
                $rowuser = mysql_fetch_array($resuser);

                if($row[23] == "0"){
                    $paystat = "<span class='fa fa-circle' style='color: orange;'></span>";
                }else{
                    $paystat = "<span class='fa fa-circle' style='color: green;'></span>";
                }

                if($row[13] != "repairbill"){
                    $imgname = 'SMMS/uploads/'.$row[24];
                    $btn = "<button class='btn btn-xs btn-info' onclick='viewimg(\"".$imgname."\", \"".$row[16]."\", \"".$row[18]."\");'><i class='fa fa-eye'></i></button>";
                }else{
                    $btn = "";
                }

                echo "
                    <tr>
                        <td width='20%'>". date('Y-m-d', strtotime($row[9])) ."</td>
                        <td width='15%'>".$rowtask[0]."</td>
                        <td width='15%'>".$rowuser[0]."</td>
                        <td width='5%' align='center'>".$paystat."</td>
                        <td width='20%'>".$row[8]."</td>
                        <td width='20%'>". date( 'H:i s',$row[10]) ." - ". date( 'H:i s',$row[11]) ." / ".$row[12]."</td>
                        <td width='5%' align='center'>
                            ".$btn."
                        </td>
                    </tr>
                ";
            }
        break;

        case 'eviction':
            $sql = "UPDATE tbltrans_tenants SET status = 'evicted', remarks = '".$_POST['remarks']."' WHERE TenantID = '".$_POST['tenantid']."' ";
            $result = mysql_query($sql, $connection);

            $sqlaiid = " SELECT appID, inqID FROM tbltrans_tenants WHERE TenantID = '". $_POST['tenantid'] ."' ";
            $resaiid = mysql_query($sqlaiid, $connection);
            $rowaiid = mysql_fetch_array($resaiid);

            $sql2 = "SELECT unitid FROM tbltrans_tenants WHERE TenantID = '".$_POST['tenantid']."'";
            $res2 = mysql_query($sql2, $connection);
            $row2 = mysql_fetch_array($res2);

            $sql3 = "UPDATE tblunit_statuslogs SET status = 'vacant' WHERE unitid = '".$row2[0]."'";
            $res3 = mysql_query($sql3, $connection);

            $sql4 = "UPDATE tblref_unit SET status = 'vacant' WHERE unitid = '".$row2[0]."'";
            $res4 = mysql_query($sql4, $connection);

            $logs = create_logs("Evicted ".$_POST["tenantid"]."", "Tenants Module", "with a reason of  ".$_POST['remarks']."", "EVICT");

            $tran_logs = create_logs_per_transaction("Evicted ".$_POST["tenantid"]." .", "Tenants Module", "with a reason of ".$_POST['remarks'], "EVICT", $rowaiid[1], $rowaiid[0], $_POST['tenantid']);

            echo "Tenant is now evicted.";
        break;

        case 'warning':
            $sql = " UPDATE tbltrans_tenants SET Status = 'foreviction' WHERE TenantID = '". $_POST['tid'] ."' ";
            $res = mysql_query($sql, $connection);
            $row = mysql_fetch_array($res);

            $sql2 = "SELECT unitid, datefrom, dateto FROM tbltrans_tenants WHERE TenantID = '".$_POST['tid']."'";
            $res2 = mysql_query($sql2, $connection);
            $row2 = mysql_fetch_array($res2);

            $sql5 = "UPDATE tblref_unitplot2 SET status = 'for eviction' WHERE unitid = '".$row2[0]."'";
            $res5 = mysql_query($sql5, $connection);

            $logs = create_logs("Sends a warning notice to ".$_POST["tid"]."", "Tenants Module", "with a reason of  ".$_POST['remarks']."", "WARNING FOR EVICTION");

            $tran_logs = create_logs_per_transaction("Sends a warning notice to ".$_POST["tid"]." .", "Tenants Module", "with a reason of ".$_POST['remarks'], "WARNING FOR EVICTION", $_POST['iid'], $_POST['aid'], $_POST['tid']);
        break;

        case 'renewthis':
            $sql = "UPDATE tbltrans_tenants SET Status = 'forrenewal', remarks = '".$_POST['remarks']."' WHERE TenantID = '".$_POST['tenantid']."' ";
            $result = mysql_query($sql, $connection);

            $sql2 = "SELECT unitid FROM tbltrans_tenants WHERE TenantID = '".$_POST['tenantid']."'";
            $res2 = mysql_query($sql2, $connection);
            $row2 = mysql_fetch_array($res2);

            $sql3 = "UPDATE tblunit_statuslogs SET status = 'vacant' WHERE unitid = '".$row2[0]."'";
            $res3 = mysql_query($sql3, $connection);

            $sql4 = "UPDATE tblref_unit SET status = 'vacant' WHERE unitid = '".$row2[0]."'";
            $res4 = mysql_query($sql4, $connection);

            echo "Tenant status has been updated to Renewal.";
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

        case 'tblcontract':
            $sql = " SELECT datefrom, dateto, unitid, contractID FROM tblcontract WHERE tenantid = '". $_POST['tenantid'] ."' OR inquiryid = '". $_POST['inquiryid'] ."' ";
            echo $sql;
            $res = mysql_query($sql, $connection);
            while($row = mysql_fetch_array($res)){
                $sqlunit = " SELECT unitname, typeofbusiness FROM tblref_unit WHERE unitid = '". $row[2] ."' ";
                $resunit = mysql_query($sqlunit, $connection);
                $rowunit = mysql_fetch_array($resunit);

                echo "
                        <tr>
                            <td>".$row[3]."</td>
                            <td>".date('F d, Y', strtotime($row[0]))."</td>
                            <td>".date('F d, Y', strtotime($row[1]))."</td>
                            <td>".$rowunit[0]."</td>
                            <td>
                                <button class='btn btn-xs btn-info'onclick='viewcontract(\"".$_POST['inquiryid']."\", \"".$_POST['tenantid']."\" , \"".$rowunit[1]."\", \"".$row['contractID']."\");' title='View Contract'>
                                    <img src='assets/images/contract.png' style='width: 100%; height: auto;' />
                                </button>
                            </td>
                        </tr>
                ";
            }
        break;

        case 'tblcontractinfo':
            $sql = "SELECT TenantID, CONCAT(owner_firstname, ' ', owner_lastname) as owner, CompanyID, tradename, companyname, costpermonths, unitname, noofmonths, mallid, noofdays, datefrom, dateto from tbltrans_tenants where TenantID = '".$_POST["tenantid"]."'";
            $result = mysql_query($sql, $connection);
            $row = mysql_fetch_array($result);

            $sql2 = " SELECT Address from tbltrans_inquiry WHERE inquiry_id = '". $_POST['inquiryid'] ."' ";
            $res2 = mysql_query($sql2, $connection);
            $row2 = mysql_fetch_array($res2);

            $sql3 = " SELECT CompanyID, content FROM tbltrans_company_contacts WHERE CompanyID = '". $row[2] ."' ";
            $res3 = mysql_query($sql3, $connection);
            $row3 = mysql_fetch_array($res3);

            $sql7 = "SELECT CompanyID, industry, permanent_address, billing_address FROM tbltrans_company where CompanyID = '". $row[2] ."' ";
            $res7 = mysql_query($sql7, $connection);
            $row7 = mysql_fetch_array($res7);

            $sql8 = " SELECT content FROM tbltrans_company_owner_contacts where CompanyID  = '". $row[2] ."' ";
            $res8 = mysql_query($sql8, $connection);
            $row8 = mysql_fetch_array($res8);

            $sql9 = " SELECT malladdress FROM tblref_mall WHERE mallid = '". $row[8] ."' ";
            $res9 = mysql_query($sql9, $connection);
            $row9 = mysql_fetch_array($res9);

            if($_POST['type'] == "LCA" && $row[7] == "0"){
                $stay = $row[9]." "."Day(s)";
            }
            else if($_POST['type'] == "LCA" ){
                $stay = $row[7]." Month(s) and ".$row[9]." Day(s)";
            }
            else{
                $stay = $row[7]." "."Month(s)";
            }

            echo $row[3] . "|" . $row[4] . "|" . $row[1] . "|" . $row[0] . "|" . $row9[0] . "|" . $row[3] . "|" . $row2[0] . "|" . $row[4] . "|" . $row[5] . "|" . $row[6] . "|" .  $stay . "|" . $row8[0] . "|" . $row7[1] . "|" . date('F d, Y', strtotime($row[10])) . "|" . date('F d, Y', strtotime($row[11]));

        break;

        case 'loadfilters_tenant':
            $sql = "SELECT checked_value, otherfilter, bystat, xcheck FROM tblref_filters WHERE module = '".$_POST["module"]."'";
            $result = mysql_query($sql, $connection);
            $row = mysql_fetch_array($result);

            echo $row["checked_value"] . "#" . $row["otherfilter"] . "#" . $row["bystat"] . "#" . $row["xcheck"];
            break;

        case 'savetenantfilter':
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

        case 'viewhistorytenantdisplay':
            $sql = " SELECT username, mydate, mytime, module, xaction FROM tbllogs_per_trans WHERE tenID = '". $_POST['tenantidnglogs'] ."' ";
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

        case 'displaytncdirect':
            $sql = " SELECT Group_ID, Group_Name, Term_Name, Description, Stats, Term_ID FROM tblcondition WHERE Group_ID LIKE '%".$_POST['selectfilterdisplaydirect']."%' ORDER BY STATS = 1 DESC ";
            $res = mysql_query($sql, $connection);
            while($row = mysql_fetch_array($res)){
                ?>
                    <tr  id="<?php echo $row[5]; ?>">
                        <td width="3%"><input type="checkbox" id="<?php echo $row[0]; ?>" class="checkbox <?php echo $row[5]; ?>" value='<?php echo $row[5]; ?>'></td>
                        <td width="15%"><?php echo $row[1]; ?></td>
                        <td width="20%"><?php echo $row[2]; ?></td>
                        <td width="35%"><?php echo $row[3]; ?></td>
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

        case 'selectfilterdirect':
            if ( $_POST['id'] != "" ) {
                $sql = " SELECT Group_ID, Group_Name, Term_Name, Description, Stats, Term_ID FROM tblcondition WHERE Group_ID = '". $_POST['id'] ."' ORDER BY Stats = 1 ";
            }

            else {
                $sql = " SELECT Group_ID, Group_Name, Term_Name, Description, Stats, Term_ID FROM tblcondition ORDER BY STATS = 1 DESC";
            }

            $res = mysql_query($sql, $connection);
            while( $row = mysql_fetch_array($res)) {
                ?>
                        <tr>
                                <td width="3%"><input type="checkbox" id="<?php echo $row[0]; ?>" class="checkbox <?php echo $row[5]; ?>" value='<?php echo $row[5]; ?>'></td>
                                <td width="15%"><?php echo $row[1]; ?></td>
                                <td width="20%"><?php echo $row[2]; ?></td>
                                <td width="35%"><?php echo $row[3]; ?></td>
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

        case 'selectfilterdisplaydirect':
            echo " <option value=''>All</option> ";
            $sql = "SELECT Group_ID, Group_Name FROM tblgroups";
            $result = mysql_query($sql, $connection);
            while ( $row = mysql_fetch_array($result)) {
                echo"
                <option value='". $row[0] ."'>".$row[1]."</option>
                ";
            }
        break;

        case 'lamanngtabledirect':
            $_POST['checkto'];
            $arr = explode("|", $_POST['checkto']);

            for($a = 0;$a <= count($arr)-2;$a++){
                $sql = " SELECT Term_ID, Group_Name, Term_Name, Description FROM tblcondition WHERE Term_ID = '". $arr[$a] ."' ";
                $res = mysql_query($sql, $connection);
                $row = mysql_fetch_array($res);
                ?>
                    <tr>
                        <td width="15%"><?php echo $row[1]; ?></td>
                        <td width="20%"><?php echo $row[2]; ?></td>
                        <td width="35%"><?php echo $row[3]; ?></td>
                    </tr>
                <?php
            }

        break;

        case 'lamanngtabledirect2':
            $_POST['lahat'];
            $arr = explode("|", $_POST['lahat']);

            for($a = 0;$a <= count($arr)-2;$a++){
                $sql = " SELECT Term_ID, Group_Name, Term_Name, Description FROM tblcondition WHERE Term_ID = '". $arr[$a] ."' ";
                $res = mysql_query($sql, $connection);
                $row = mysql_fetch_array($res);
                ?>
                    <tr>
                        <td width="15%"><?php echo $row[1]; ?></td>
                        <td width="20%"><?php echo $row[2]; ?></td>
                        <td width="35%"><?php echo $row[3]; ?></td>
                    </tr>
                <?php
            }
        break;

        case 'searchCheckeddirect':
            $sql = "SELECT conditions from tblcontract WHERE inquiryID = '". $_POST['id'] ."' ";
            $res = mysql_query($sql, $connection);
            $row = mysql_fetch_array($res);

            echo $row[0];
        break;

        case 'malltemplate':
            $sql = " SELECT template from tblsys_setup2 ";
            $res = mysql_query($sql, $connection) or die(mysql_error());
            $row = mysql_fetch_array($res);
            echo $sql;

                $sqlmall = "SELECT mallid, mallname, malladdress,telephone_number, email, mall_image FROM tblref_mall WHERE mallid = '". $_POST['mallidprint'] ."' ";
                $resmall = mysql_query($sqlmall, $connection);
                while($rowmall = mysql_fetch_array($resmall)){
                    if($rowmall[5] == "")
                        {
                            $image = "assets/images/avatars/noimage.png";
                        }
                        else
                        {
                            $image = "server/mall_image/".$rowmall[5];
                        }

                    $template1 .= "
                            <tr>
                                <td align='center'><img src='".$image."' style='height: 130px; width: 120px;'></td>
                                <td>
                                    <p style='padding: 0px; display: block;margin:0px;' class='companyname'><h2>".$rowmall[1]."</h2></p>
                                    <p style='padding: 0px; display: block;margin:0px;' class='companyaddress'>".$rowmall[2]."</p>
                                    <p style='padding: 0px; display: block;margin:0px;' class='companynumber'>".$rowmall[3]."</p>
                                    <p style='padding: 0px; display: block;margin:0px;' class='companywebsite'>".$rowmall[4]."</p>
                                </td>
                            </tr>
                            ";
                    $template2 .= "
                            <tr>
                                <td align='center'><img src='".$image."' style='height: 130px; width: 120px;'></td>
                            </tr>
                            <tr>
                                <td align='center'>
                                    <p style='padding: 0px; display: block;margin:0px;' class='companyname'><h2>".$rowmall[1]."</h2></p>
                                    <p style='padding: 0px; display: block;margin:0px;' class='companyaddress'>".$rowmall[2]."</p>
                                    <p style='padding: 0px; display: block;margin:0px;' class='companynumber'>".$rowmall[3]."</p>
                                    <p style='padding: 0px; display: block;margin:0px;' class='companywebsite'>".$rowmall[4]."</p>
                                </td>
                            </tr>
                            ";
                }
                if ($row[0] == "1"){
                    echo $template1;
                    }
                else{
                    echo $template2;
                }
                    echo $row[5];
        break;

        case 'showeocdate':
            $sql = " SELECT datefrom, dateto, status FROM tbltrans_tenants WHERE TenantID = '". $_POST['id'] ."' ";
            $res = mysql_query($sql, $connection);
            $row = mysql_fetch_array($res);

            echo date('F d, Y', strtotime($row[0]))."|".date('F d, Y', strtotime($row[1]));
        break;

        case 'eoc':
            $sql = " UPDATE tbltrans_tenants SET status = 'endofcon', dateevic = '". date('Y-m-d') ."' WHERE TenantID = '". $_POST['tenantid'] ."' ";
            $res = mysql_query($sql, $connection);
            $row = mysql_fetch_array($res);

            $sql2 = "SELECT unitid, datefrom, dateto FROM tbltrans_tenants WHERE TenantID = '".$_POST['tenantid']."'";
            $res2 = mysql_query($sql2, $connection);
            $row2 = mysql_fetch_array($res2);

            $sql3 = "UPDATE tblunit_statuslogs SET status = 'vacant', tenantid = '', tenantname = '' WHERE unitid = '".$row2[0]."' AND xdate BETWEEN '".date("Y-m-d", strtotime($row2[1 ]))."' AND '".date("Y-m-d", strtotime($row2[2]))."' ";
            $res3 = mysql_query($sql3, $connection);

            $sql4 = "UPDATE tblref_unit SET status = 'vacant' WHERE unitid = '".$row2[0]."'";
            $res4 = mysql_query($sql4, $connection);

            $sql5 = "UPDATE tblref_unitplot2 SET status = 'vacant' WHERE unitid = '".$row2[0]."'";
            $res5 = mysql_query($sql5, $connection);

            $logs = create_logs("Ended the contract of ".$_POST["tenantid"]." Tenant ID.", "Tenants Module", "END OF CONTRACT", "END OF CONTRACT");

            $tran_logs = create_logs_per_transaction("Ended the contract of ".$_POST["tenantid"]." Tenant ID.", "Tenants Module", "END OF CONTRACT", "END OF CONTRACT", $_POST["inqid"], $_POST["appid"], $_POST['tenantid']);

            echo 1;
        break;

        case 'termsandcon':
            $sql = "SELECT conditions FROM tblcontract WHERE inquiryid = '".$_POST['inquiryid']."' ";
            echo $sql;
            $result = mysql_query($sql, $connection);
            $row = mysql_fetch_array($result);

            $arr = explode("|", $row[0]);

            for ( $i = 0; $i <= count($arr)-1; $i++ )
            {
                $sqlNew ="SELECT Term_Name, Description, Group_Name FROM tblcondition WHERE Term_ID = '".$arr[$i]."' ";
                 $resultNew = mysql_query($sqlNew, $connection);
                 $rownew = mysql_fetch_array($resultNew);

                 echo "
                    <tr>
                        <td width='15%'>".$rownew[0]."</td>
                        <td width='70%'>".$rownew[1]."</td>
                    </tr>
                 ";
            }
        break;

        case 'unitinformation':
           $sql = "SELECT TenantID, CONCAT(owner_firstname, ' ', owner_lastname) as owner, CompanyID, tradename, companyname, costpermonths, unitname, noofmonths, mallid, noofdays from tbltrans_tenants where TenantID = '".$_POST["tenantid"]."'";
            $result = mysql_query($sql, $connection);
            $row = mysql_fetch_array($result);

            $sql2 = " SELECT Address from tbltrans_inquiry WHERE TenantID = '". $row[0] ."' ";
            $res2 = mysql_query($sql2, $connection);
            $row2 = mysql_fetch_array($res2);

            $sql3 = " SELECT CompanyID, content FROM tbltrans_company_contacts WHERE CompanyID = '". $row[2] ."' ";
            $res3 = mysql_query($sql3, $connection);
            $row3 = mysql_fetch_array($res3);

            $sql7 = "SELECT CompanyID, industry, permanent_address, billing_address FROM tbltrans_company where CompanyID = '". $row[2] ."' ";
            $res7 = mysql_query($sql7, $connection);
            $row7 = mysql_fetch_array($res7);

            $sql8 = " SELECT content FROM tbltrans_company_owner_contacts where CompanyID  = '". $row[2] ."' ";
            $res8 = mysql_query($sql8, $connection);
            $row8 = mysql_fetch_array($res8);

            $sql9 = " SELECT malladdress FROM tblref_mall WHERE mallid = '". $row[8] ."' ";
            $res9 = mysql_query($sql9, $connection);
            $row9 = mysql_fetch_array($res9);

            if($_POST['type'] == "LCA" && $row[7] == "0"){
                $stay = $row[9]." "."Days";
            }
            else if($_POST['type'] == "LCA" ){
                $stay = $row[7]." Months and ".$row[9]." Days";
            }
            else{
                $stay = $row[7]." "."Months";
            }

            echo $row[3] . "|" . $row[4] . "|" . $row[1] . "|" . $row[0] . "|" . $row9[0] . "|" . $row[3] . "|" . $row2[0] . "|" . $row[4] . "|" . $row[5] . "|" . $row[6] . "|" .  $stay . "|" . $row8[0] . "|" . $row7[1];
        break;

        case 'inquiryinfosatenantmodule':
            $sql = " SELECT Application_ID, Mall, Mall_ID, UnitID, UnitType, TradeID, Trade_Name, Company_ID, Company_Name, Industry, ClassID, DepartmentID, categoryID, Address, Remarks, Application_Remarks, User_ID, datefrom, dateto, applicationdate, Status, Status_Type, datepayment, amount, alertdate, remarks_Reservation, accof_Reservation, alerttype_Cus, alerttype_email, depamount, advamount, dep_month, adv_month, contractID, billingtype, desired_noofdays, desired_noofmonths, merchant_code, owner_card_number FROM tbltrans_inquiry WHERE Inquiry_ID = '". $_POST['inquiryid'] ."' ";

            $res = mysql_query($sql, $connection);
            $row = mysql_fetch_array($res);

            $sql2 = " SELECT tenanttype, datefrom, dateto FROM tbltrans_tenants WHERE tenantID = '". $_POST['tenantid'] ."' ";
            $res2 = mysql_query($sql2, $connection);
            $row2 = mysql_fetch_array($res2);

            $sql3 = "SELECT filename FROM tbltrans_tradename WHERE tradeid = '".$row[5]."' ";
            $res3 = mysql_query($sql3, $connection);
            $row3 = mysql_fetch_array($res3);

            $sql4 = " SELECT CompanyID, Company, industryID, industry, businessAddress, owner_firstname, owner_middlename, owner_lastname, permanent_address, current_address, billing_address, remarks, filename FROM tbltrans_company WHERE CompanyID = '".$row[7]."' ";
            $res4 = mysql_query($sql4, $connection);
            $row4 = mysql_fetch_array($res4);

            $image = "server/company/".$row[7]."/trades/".$row[5]."/".$row3[0]."";

            $arr = explode("|", $row2[0]);
            $billingtype = $arr[0]."-".$arr[1];

            echo $row[1] . "|" . $row[8] . "|" . $row[6] . "|" . $row[9] . "|" . $row[13] . "|" . $billingtype . "|" . $row[37] . "|" . $row[38] . "|" . $image . "|" . $row4[5] . "|" . $row4[6] . "|" . $row4[7] . "|" . $row4[8] . "|" . $row4[9] . "|" . $row4[10] . "|" . $row[36] . "|" . $row[35] . "|" . $row[30] . "|" . $row[29] . "|" . $row[4]  . "|" . $row[31] . "|" . $row[32] . "|" . date('m/d/Y', strtotime($row2[1])) . "|" . date('m/d/Y', strtotime($row2[2]));
        break;

        case 'loadtbodypdc_inquiry1':
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
                    $refDate = $_POST["datefrom"];
                    if($_POST["type"] == "SET")
                    {
                        for ($x=1; $x<=$months; $x++) {

                            // $mgadate .= "<span class='pdcdate' style='font-size: 14px; color: black;'>". $refDate . "</span><label style='font-size: 14px; color: black;'> - ₱ ".$_POST['inqmonpayment'].".00</label style='font-size: 14px;'><br>";

                            $refDate = date( 'Y/m/d', strtotime($refDate . '+1 month') );
                            echo '<tr style="width: 100%;display: table;table-layout: fixed;" id="'.date("m/d/Y", strtotime($refDate)).'" class="unselected">
                                  <td class="center" style="width:15%;">'.$x.'</td>
                                  <td>
                                    '.date("m/d/Y", strtotime($refDate)).'
                                  </td>
                                  <td style="text-align: right;">'.number_format($row_pdc["totalamountunitsetup"], 2, '.', ',').'</td>
                                  <td><input type="text" class="form-control numonly" value="'.$ccc[$x-1].'" disabled></td>
                                  <td><select class="form-control bnk" onchange="chkduplicatedchknum2()" disabled>';

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
                    $refDate = $_POST["datefrom"];
                    if($_POST["type"] == "LCA")
                    {
                         for ($x=1; $x<=$days; $x++) {

                            // $mgadate .= "<span class='pdcdate' style='font-size: 14px; color: black;'>". $refDate . "</span><label style='font-size: 14px; color: black;'> - ₱ ".$_POST['inqmonpayment'].".00</label style='font-size: 14px;'><br>";
                            $payable = $_POST['ttlamnt'];
                            $refDate = date( 'Y/m/d', strtotime($refDate . '+1 day') );

                            echo '<tr style="width: 100%;display: table;table-layout: fixed;" id="'.date("m/d/Y", strtotime($refDate)).'" class="unselected">
                                  <td class="center" style="width:15%;">'.$x.'</td>
                                  <td>
                                    '.date("m/d/Y", strtotime($refDate)).'
                                  </td>
                                  <td style="text-align: right;">'.number_format($payable, 2, '.', ',').'</td>
                                  <td><input type="text" class="form-control numonly" value="'.$ccc[$x-1].'" disabled></td>
                                  <td><select class="form-control bnk" onchange="chkduplicatedchknum2()" disabled>';

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
        break;

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


                    $sql_pdc = "SELECT totalamountunitsetup FROM tblref_unit WHERE unitid = '".$_POST["unit_id"]."'";
                    $result_pdc = mysql_query($sql_pdc, $connection);
                    $row_pdc = mysql_fetch_array($result_pdc);

                    $ccc = explode("#", $pdc);
                    $ddd = explode("#", $bankname);
                    $refDate = $_POST["datefrom"];
                    if($_POST["type"] == "SET")
                    {
                        for ($x=1; $x<=$months; $x++) {

                            // $mgadate .= "<span class='pdcdate' style='font-size: 14px; color: black;'>". $refDate . "</span><label style='font-size: 14px; color: black;'> - ₱ ".$_POST['inqmonpayment'].".00</label style='font-size: 14px;'><br>";

                            $refDate = date( 'Y/m/d', strtotime($refDate . '+1 month') );
                            echo '<tr style="width: 100%;display: table;table-layout: fixed;" id="'.date("m/d/Y", strtotime($refDate)).'" class="unselected">
                                  <td class="center" style="width:15%;">'.$x.'</td>
                                  <td>
                                    '.date("m/d/Y", strtotime($refDate)).'
                                  </td>
                                  <td style="text-align: right;">'.number_format($row_pdc["totalamountunitsetup"], 2, '.', ',').'</td>
                                  <td><input type="text" class="form-control numonly required_addendum tenantadd" onkeyup="chkduplicatedchknum2()"></td>
                                  <td><select class="form-control bnk" onchange="chkduplicatedchknum2()">';

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
        break;

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


                    $sql_pdc = "SELECT totalamountunitsetup FROM tblref_unit WHERE unitid = '".$_POST["unit_id"]."'";
                    $result_pdc = mysql_query($sql_pdc, $connection);
                    $row_pdc = mysql_fetch_array($result_pdc);

                    $ccc = explode("#", $pdc);
                    $ddd = explode("#", $bankname);
                    $refDate = $_POST["datefrom"];
                    if($_POST["type"] == "LCA")
                    {
                         for ($x=1; $x<=$days; $x++) {

                            // $mgadate .= "<span class='pdcdate' style='font-size: 14px; color: black;'>". $refDate . "</span><label style='font-size: 14px; color: black;'> - ₱ ".$_POST['inqmonpayment'].".00</label style='font-size: 14px;'><br>";
                            $payable = $_POST['ttlamnt'];
                            $refDate = date( 'Y/m/d', strtotime($refDate . '+1 day') );

                            echo '<tr style="width: 100%;display: table;table-layout: fixed;" id="'.date("m/d/Y", strtotime($refDate)).'" class="unselected">
                                  <td class="center" style="width:15%;">'.$x.'</td>
                                  <td>
                                    '.date("m/d/Y", strtotime($refDate)).'
                                  </td>
                                  <td style="text-align: right;">'.number_format($payable, 2, '.', ',').'</td>
                                  <td><input type="text" class="form-control numonly required_addendum tenantadd" value="'.$ccc[$x-1].'" onkeyup="chkduplicatedchknum2()"></td>
                                  <td><select class="form-control bnk" onchange="chkduplicatedchknum2()">';

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
        break;

        case 'addendum':
            $sql = " INSERT INTO tbltrans_termsandcondition_add SET conditions = '". $_POST['nakacheck'] ."', TenantID = '". $_POST['id'] ."', Date_added = '". date('Y-m-d') ."', userid = '". $_COOKIE['userid'] ."' ";
            $res = mysql_query($sql, $connection);
            if($res == true){
                echo 1;
            }
        break;

        case 'selectdepartment':
           echo '<option value="">-- Select Category --</option>';
            $querydep = "SELECT departmentID, department FROM tblref_merchandise_depa WHERE class_ID = '".$_POST["classification"]."'";
            $result_dep = mysql_query($querydep, $connection);
            while($row = mysql_fetch_array($result_dep)){
                $dep = "<option";
                $dep .= " value='".$row['departmentID']."'>".$row['department']."</option>";

                echo $dep;
            }
        break;

        case 'selectcategory':
            echo '<option value="">-- Select Category --</option>';
            $querycat = "SELECT categoryID, category FROM tblref_merchandisedep_cat WHERE dept_ID = '".$_POST["category"]."'";
            $result_cat = mysql_query($querycat, $connection);
            while($row = mysql_fetch_array($result_cat)){
                $cat = "<option";
                $cat .= " value='".$row['categoryID']."'>".$row['category']."</option>";

                echo $cat;
            }
        break;

        case 'selectwing':
        if($_POST["type"] == "SET")
        {
                $wings = "";
                $sql = "SELECT DISTINCT(wingid) FROM tblref_unit WHERE typeofbusiness = '".$_POST['type']."' AND classid = '".$_POST['classification_id']."' AND mallid = '".$_POST['mallid']."'";

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
                    $condition .= $and."mallID = '".$_POST['mallid']."'";
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
            $querywing = "SELECT wingID, wing FROM tblref_wing WHERE mallID = '".$_POST['mallid']."'";
            $result_wing = mysql_query($querywing, $connection);
            while($row = mysql_fetch_array($result_wing)){
                echo "<option value='".$row["wingID"]."'>".$row["wing"]."</option>";
            }
        }

        break;

        case 'displayunitinformationtab':
            $sql = " SELECT unitid FROM tbltrans_tenants WHERE TenantID = '". $_POST['tenantid'] ."' ";
            $res = mysql_query($sql, $connection);
            $row = mysql_fetch_array($res);

            $sql2 = " SELECT classid, depid, catid, wingid, floorid, unitid, unitname, typeofbusiness FROM tblref_unit WHERE unitid = '". $row[0] ."' ";
            $res2 = mysql_query($sql2, $connection);
            $row2 = mysql_fetch_array($res2);

            $sql3 = " SELECT classification FROM tblref_merchandise_class WHERE classificationID = '". $row2[0] ."' ";
            $res3 = mysql_query($sql3, $connection);
            $row3 = mysql_fetch_array($res3);

            $sql4 = " SELECT department FROM tblref_merchandise_depa WHERE departmentID = '". $row2[1] ."' ";
            $res4 = mysql_query($sql4, $connection);
            $row4 = mysql_fetch_array($res4);

            $sql5 = " SELECT Category FROM tblref_merchandisedep_cat WHERE categoryID = '". $row2[2] ."' ";
            $res5 = mysql_query($sql5, $connection);
            $row5 = mysql_fetch_array($res5);

            $sql6 = " SELECT wing FROM tblref_wing WHERE wingID = '". $row2[3] ."' ";
            $res6 = mysql_query($sql6, $connection);
            $row6 = mysql_fetch_array($res6);

            $sql7 = " SELECT floor FROM tblref_floorsetup WHERE floorid = '". $row2[4] ."' ";
            $res7 = mysql_query($sql7, $connection);
            $row7 = mysql_fetch_array($res7);

            // echo $row3[0] . "|" .$row4[0] . "|" .$row5[0] . "|" .$row6[0] . "|" .$row7[0] . "|" . $row2[6] . "|" . $row2[7];

            echo "<option value='". $row2[0] ."'>". $row3[0] ."</option>" . "|"
             . "<option value='". $row2[1] ."'>". $row4[0] ."</option>" . "|"
              ."<option value='". $row2[2] ."'>". $row5[0] ."</option>" . "|"
              ."<option value='". $row2[3] ."'>". $row6[0] ."</option>" . "|"
               ."<option value='". $row2[4] ."'>". $row7[0] ."</option>" . "|"
                ."<option value='". $row2[5] ."'>". $row2[6] ."</option>" . "|"
                 . $row2[7];
        break;

        case 'selectclassification':
            $queryind = "Select classificationID, classification FROM tblref_merchandise_class";
            $rsss = mysql_query($queryind, $connection);
            while($row = mysql_fetch_array($rsss)){
            $industry = "<option value='".$row['classificationID']."'> ";
            $industry .= $row['classification']."</option>";

            echo $industry;
        }
        break;

        case 'loadtotalamountundertable':
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
                        $payable = $_POST["ttlamnt"];
                        for ($x=1; $x<=$days; $x++) {

                            // $mgadate .= "<span class='pdcdate' style='font-size: 14px; color: black;'>". $refDate . "</span><label style='font-size: 14px; color: black;'> - ₱ ".$_POST['inqmonpayment'].".00</label style='font-size: 14px;'><br>";

                            $refDate = date( 'Y/m/d', strtotime($refDate . '+1 day') );
                            $rate += floatval($payable);
                        }
                    }
                    else
                    {
                        $payable = $row_pdc["totalamountunitsetup"];
                        for ($x=1; $x<=$months; $x++) {

                            // $mgadate .= "<span class='pdcdate' style='font-size: 14px; color: black;'>". $refDate . "</span><label style='font-size: 14px; color: black;'> - ₱ ".$_POST['inqmonpayment'].".00</label style='font-size: 14px;'><br>";

                            $refDate = date( 'Y/m/d', strtotime($refDate . '+1 month') );
                            $rate += floatval($row_pdc["totalamountunitsetup"]);
                        }
                    }

                    echo number_format($rate, 2, '.', ',') . "|" . $rate . "|" . $payable . "|";
        break;

        case 'savedesiredaddendum':
            $sqltenantinfo = " SELECT TenantID, mallID, owner_lastname, owner_firstname, owner_midname, appID, inqID, tradeID, tradename, CompanyID, companyname, datepayment, amount, alertdate, remarks, accof, alerttype_cus, alerttype_email, Status, noofmonths, noofdays, costpermonths, ustatus, billing_type, dateevic, tenanttype, revpercent, withPOS, merchant_code, contractid, owner_card_number, tenantphoto FROM tbltrans_tenants WHERE TenantID = '". $_POST['tenantid'] ."' ";
            $restenantinfo = mysql_query($sqltenantinfo, $connection);
            $rowtenantinfo = mysql_fetch_array($restenantinfo);

            $lahat = $_POST['bankname']."|".$_POST['chknum']."|".$_POST['trid'];
            $contractID = createidno("CONTRACT", "tblcontact", "ContractID");
            $lahat2 = explode("|", $lahat);
            $bankname2 = explode(",,,", $lahat2[0]);
            $checkno = explode("...", $lahat2[1]);
            $petsa = explode("#", $lahat2[2]);
            for ($x=0; $x<=count($petsa)-2; $x++) {
                $sqlpdc = " INSERT INTO tbltrans_pdc SET inquiryid = '". $_POST['inquiryid'] ."', customerid = '". $_POST['tenantid'] ."', lname = '".  $rowtenantinfo[2] ."', fname = '". $rowtenantinfo[3] ."', pdcdate = '". date('m/d/Y', strtotime($petsa[$x])) ."', amount = '". $_POST['amount'] ."', bank = '". $bankname2[$x] ."', checkno = '". $checkno[$x] ."' ";
                $respdc = mysql_query($sqlpdc, $connection);
                $rowpdc = mysql_fetch_array($respdc);
            }

            $sqldummy = " INSERT INTO tbltrans_tenants_dummy SET TenantID = '". $rowtenantinfo[0] ."', MallID = '". $rowtenantinfo[0] ."', owner_lastname = '". $rowtenantinfo[2] ."', owner_firstname = '". $rowtenantinfo[3] ."', owner_midname = '". $rowtenantinfo[4] ."', appID = '". $rowtenantinfo[5] ."', inqID = '". $rowtenantinfo[6] ."', tradeID = '". $rowtenantinfo[7] ."', tradename = '". $rowtenantinfo[8] ."', CompanyID = '". $rowtenantinfo[9] ."', companyname = '". $rowtenantinfo[10] ."', datepayment = '". $rowtenantinfo[11] ."', amount = '". $rowtenantinfo[12] ."', alertdate = '". $rowtenantinfo[13] ."', remarks = '". $rowtenantinfo[14] ."', accof = '". $rowtenantinfo[15] ."', alerttype_cus = '". $rowtenantinfo[16] ."', alerttype_email = '". $rowtenantinfo[17] ."', Status = '". $rowtenantinfo[18] ."', noofmonths = '". $_POST['noofmonths'] ."', noofdays = '". $_POST['noofdays'] ."', costpermonths = '". $_POST['monthlyrate'] ."', ustatus = '". $rowtenantinfo[22] ."', billing_type = '". $rowtenantinfo[23] ."', dateevic = '". $rowtenantinfo[24] ."', tenanttype = '". $rowtenantinfo[25] ."', revpercent = '". $rowtenantinfo[26] ."', withPOS = '". $rowtenantinfo[27] ."', merchant_code = '". $rowtenantinfo[28] ."', contractID = '". $contractID ."', owner_card_number = '". $rowtenantinfo[30] ."', tenantphoto  = '". $rowtenantinfo[31] ."', unitID = '". $_POST['unitid'] ."', unitname = '". $_POST['unitname'] ."', datefrom = '". $_POST['datefrom'] ."', dateto = '". $_POST['dateto'] ."', depmonth = '".  $_POST['monthlydep'] ."', advmonth = '". $_POST['monthlyadv'] ."', depamount = '". $_POST['depamount'] ."', advamount = '". $_POST['advamount'] ."' ";
            $resdummy = mysql_query($sqldummy, $connection);
            $rowdummy = mysql_fetch_array($resdummy);

            $sqlupdatestatus = " UPDATE tbltrans_tenants SET Status = 'forrenewal' WHERE TenantID = '". $_POST['tenantid'] ."' ";
            $resupdatestatus = mysql_query($sqlupdatestatus, $connection);
            $rowupdatestatus = mysql_fetch_array($resupdatestatus);

            $sqlgeneratecontract = " INSERT INTO tblcontract (ContractID, MallID, InquiryID, datefrom, dateto, unitid, conditions, TenantID)VALUES('". $contractID ."', '". $rowtenantinfo[1] ."', '". $rowtenantinfo[6] ."', '". date('Y-m-d', strtotime($_POST['datefrom'])) ."', '". date('Y-m-d', strtotime($_POST['dateto'])) ."', '". $_POST['unitid'] ."', '". $_POST['conditions'] ."', '". $_POST['tenantid'] ."')";
            $resgeneratecontract = mysql_query($sqlgeneratecontract, $connection);
            $rowgeneratecontract = mysql_fetch_array($resgeneratecontract);

            $logs = create_logs("Updated the contract of ".$_POST["tenantid"]." Tenant ID.", "Tenants Module", $_POST['noofmonths'] . "|" . $_POST['noofdays'] . "|" . $_POST['monthlyrate'] . "|" . $_POST['unitid'] . "|" . $_POST['unitname'] . "|" . $_POST['datefrom'] . "|" . $_POST['dateto'] . "|" . $_POST['monthlydep'] . "|" . $_POST['monthlyadv'] . "|" . $_POST['depamount'] . "|" . $_POST['advamount'], "ADDENDUM");

            $tran_logs = create_logs_per_transaction("Updated the contract of ".$_POST["tenantID"]." Tenant ID.", "Tenants Module", $_POST['noofmonths'] . "|" . $_POST['noofdays'] . "|" . $_POST['monthlyrate'] . "|" . $_POST['unitid'] . "|" . $_POST['unitname'] . "|" . $_POST['datefrom'] . "|" . $_POST['dateto'] . "|" . $_POST['monthlydep'] . "|" . $_POST['monthlyadv'] . "|" . $_POST['depamount'] . "|" . $_POST['advamount'], "ADDENDUM", $rowtenantinfo[6], $rowtenantinfo[5], $_POST['tenantid']);
        break;

        case 'activateaddendum':
            $sql = " SELECT TenantID, unitID, unitname, datefrom, dateto, noofmonths, noofdays, costpermonths, contractid, depamount, advamount, depmonth, advmonth FROM tbltrans_tenants_dummy WHERE datefrom = '". date('m/d/Y') ."' ";
            $res = mysql_query($sql, $connection);
            while($row = mysql_fetch_array($res)){
                if($row[0] == ""){

                }
                else{

                    $sqlupdatetenants = " UPDATE tbltrans_tenants SET unitid = '". $row[1] ."', unitname = '". $row[2] ."', datefrom = '". $row[3] ."', dateto = '". $row[4] ."', noofmonths = '". $row[5] ."', costpermonths = '". $row[6] ."', contractid = '". $row[7] ."', depamount = '". $row[8] ."', advamount = '". $row[9] ."', depmonth = '". $row[10] ."', advmonth = '". $row[11] ."' WHERE TenantID = '". $row[0] ."' ";
                    $resupdatetenats = mysql_query($sqlupdatetenants, $connection);
                    $rowupdatetenats = mysql_fetch_array($resupdatetenats);

                    $sqldelete = " DELETE FROM tbltrans_tenants_dummy WHERE TenantID = '". $row[0] ."' ";
                    $resdelete = mysql_query($sqldelete, $connection);
                    $rowdelete = mysql_fetch_array($resdelete);
                }
            }
        break;

        case 'viewcontract':
            $sql3 = " SELECT Term_Name, Conditions FROM tblcontract WHERE InquiryID = '". $_POST['inquiryid'] ."' AND TenantID = '". $_POST['tenantid'] ."' AND ContractID = '". $_POST['contractID'] ."' ";
            $res3 = mysql_query($sql3, $connection);
            $row3 = mysql_fetch_array($res3);

            $arr = explode("|", $row3[0]);
            $arr2 = explode("|", $row3[1]);
            for($a = 0;$a <= count($arr)-2;$a++){
                ?>
                    <tr>
                        <td style="vertical-align: top;"><?php echo $arr[$a]; ?></td>
                        <td><?php echo $arr2[$a]; ?></td>
                    </tr>
                <?php
            }
        break;

        case 'displayselected2':
            $sql = "SELECT conditions from tblcontract WHERE inquiryID = '". $_POST['invi'] ."' ANd datefrom = '". date('Y-m-d', strtotime($_POST['datefromlabas'])) ."' AND dateto = '". date('Y-m-d', strtotime($_POST['datetolabas'])) ."' ";
            $res = mysql_query($sql, $connection);
            $row = mysql_fetch_array($res);
            $arr = explode("|", $row[0]);

             for($a = 0;$a <= count($arr)-2;$a++){
                $sql2 = " SELECT Term_ID, Group_Name, Term_Name, Description FROM tblcondition WHERE Term_ID = '". $arr[$a] ."' ";
                $res2 = mysql_query($sql2, $connection);
                $row2 = mysql_fetch_array($res2);

                ?>
                    <tr>
                        <td width="15%"><?php echo $row2[1]; ?></td>
                        <td width="20%"><?php echo $row2[2]; ?></td>
                        <td width="35%"><?php echo $row2[3]; ?></td>
                    </tr>
                <?php
            }
        break;

        case 'displaytenantER':
                ?>
                <div class="panel panel-primary" style="margin: 5px;margin-top: -10px;">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#ElectricReading" aria-expanded="false">
                                <i class="bigger-110 ace-icon fa fa-angle-right" data-icon-hide="ace-icon fa fa-angle-down" data-icon-show="ace-icon fa fa-angle-right"></i>
                                &nbsp;Electric Reading
                            </a>
                        </h4>
                    </div>
                    <div class="panel-collapse collapse" id="ElectricReading" aria-expanded="false">
                        <div class="panel-body" style="overflow-y: auto;height: 200px;">
                            <div class="row">
                                <table class="table table-bordered table-striped fixTable" style="margin-top: -14px;">
                                    <thead>
                                        <tr>
                                            <td align="center">Date of Reading</td>
                                            <td align="center">Previous Reading</td>
                                            <td align="center">Current Reading</td>
                                            <td align="center">Total kWh</td>
                                            <td align="center">Rate per Kwh</td>
                                            <td align="center">Total Amount</td>
                                            <td align="center">Worker Name</td>
                                        </tr>
                                    </thead>
                <?php
                $sql = " SELECT sched, kilowatt, kilowatt_php, worker_name, building_id FROM pmls_android_worker_task_history WHERE tagstat LIKE '%Electric Bill%' AND room_owner_id = '". $_POST['tid'] ."' ";
                $res = mysql_query($sql, $connection);
                while( $row = mysql_fetch_array($res) ){

                    $previouskilowatt = mysql_fetch_array(mysql_query(" SELECT kilowatt FROM pmls_android_worker_task_history WHERE room_owner_id = '". $_POST['tid'] ."' AND tagstat LIKE '%Electric Bill%' AND sched LIKE '%". date('Y-m', strtotime($row[0].'-1 month')) ."%' ", $connection));
                    if($previouskilowatt[0] == ""){
                        $previousreading = 0;
                    }else{
                        $previousreading = $previouskilowatt[0];
                    }

                    $kwhrate = mysql_fetch_array(mysql_query(" SELECT elec_amnt FROM mall_setup WHERE mall_id = '". $row[4] ."' ", $connection));
                    $totalkwh = $row[1] - $previousreading;
                ?>
                                    <tbody>
                                        <tr>
                                            <td align="center"><?php echo date('F d, Y', strtotime($row[0])); ?></td>
                                            <td align="center"><?php echo $previousreading." kWh"; ?></td>
                                            <td align="center"><?php echo $row[1]." kWh"; ?></td>
                                            <td align="center"><?php echo $totalkwh." kWh" ?></td>
                                            <td align="center"><?php echo "Php ".number_format($kwhrate[0], "2",".",","); ?></td>
                                            <td align="center"><?php echo "Php ".number_format($row[2], "2",".",","); ?></td>
                                            <td align="center"><?php echo $row[3]; ?></td>
                                        </tr>
                                    </tbody>
                <?php
                }
                ?>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
        break;

        case 'displaytenantWR':
                ?>
                <div class="panel panel-success" style="margin: 5px;margin-top: -5px;">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#WaterReading" aria-expanded="false">
                                <i class="bigger-110 ace-icon fa fa-angle-right" data-icon-hide="ace-icon fa fa-angle-down" data-icon-show="ace-icon fa fa-angle-right"></i>
                                &nbsp;Water Reading
                            </a>
                        </h4>
                    </div>
                    <div class="panel-collapse collapse" id="WaterReading" aria-expanded="false">
                        <div class="panel-body" style="overflow-y: auto;height: 200px;">
                            <div class="row">
                                <table class="table table-bordered table-striped fixTable" style="margin-top: -14px;">
                                    <thead>
                                        <tr>
                                            <td style="background-color: #dff0d8;color: #3c763d;" align="center">Date of Reading</td>
                                            <td style="background-color: #dff0d8;color: #3c763d;" align="center">Previous Reading</td>
                                            <td style="background-color: #dff0d8;color: #3c763d;" align="center">Current Reading</td>
                                            <td style="background-color: #dff0d8;color: #3c763d;" align="center">Total Cubic Meter</td>
                                            <td style="background-color: #dff0d8;color: #3c763d;" align="center">Rate per Cubic Meter</td>
                                            <td style="background-color: #dff0d8;color: #3c763d;" align="center">Total Amount</td>
                                            <td style="background-color: #dff0d8;color: #3c763d;" align="center">Worker Name</td>
                                        </tr>
                                    </thead>
                <?php
                $sql = " SELECT sched, cubic_meter, cubic_php, worker_name, building_id FROM pmls_android_worker_task_history WHERE tagstat Like '%Water Bill%' AND room_owner_id = '". $_POST['tid'] ."' ";
                $res = mysql_query($sql, $connection);
                while( $row = mysql_fetch_array($res) ){

                    $previouscubicmeter = mysql_fetch_array(mysql_query(" SELECT cubic_meter FROM pmls_android_worker_task_history WHERE room_owner_id = '". $_POST['tid'] ."' AND tagstat LIKE '%Water Bill%' AND sched LIKE '%". date('Y-m', strtotime($row[0].'-1 month')) ."%' ", $connection));

                    if($previouscubicmeter[0] == ""){
                        $previouswreading = 0;
                    }else{
                        $previouswreading = $previouscubicmeter[0];
                    }

                    $kwhrate = mysql_fetch_array(mysql_query(" SELECT watr_amnt FROM mall_setup WHERE mall_id = '". $row[4] ."' ", $connection));
                    $totalcubicmeter = $row[1] - $previouswreading;
                ?>
                                    <tbody>
                                        <tr>
                                            <td align="center"><?php echo date('F d, Y', strtotime($row[0])); ?></td>
                                            <td align="center"><?php echo $previouswreading." m³"; ?></td>
                                            <td align="center"><?php echo $row[1]." m³"; ?></td>
                                            <td align="center"><?php echo $totalcubicmeter." m³" ?></td>
                                            <td align="center"><?php echo "Php ".number_format($kwhrate[0], "2",".",","); ?></td>
                                            <td align="center"><?php echo "Php ".number_format($row[2], "2",".",","); ?></td>
                                            <td align="center"><?php echo $row[3]; ?></td>
                                        </tr>
                                    </tbody>
                <?php
                }
                ?>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
        break;

        case 'displaytenantPC':
                ?>
                <div class="panel panel-warning" style="margin: 5px;margin-top: -5px;">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#PestControl" aria-expanded="false">
                                <i class="bigger-110 ace-icon fa fa-angle-right" data-icon-hide="ace-icon fa fa-angle-down" data-icon-show="ace-icon fa fa-angle-right"></i>
                                &nbsp;Pest Control
                            </a>
                        </h4>
                    </div>
                    <div class="panel-collapse collapse" id="PestControl" aria-expanded="false">
                        <div class="panel-body" style="overflow-y: auto;height: 200px;">
                            <div class="row">
                                <table class="table table-bordered table-striped fixTable" style="margin-top: -14px;">
                                    <thead>
                                        <tr>
                                            <td style="background-color: #fcf8e3;color: #8a6d3b;" align="center">Date</td>
                                            <td style="background-color: #fcf8e3;color: #8a6d3b;" align="center">Worker Name</td>
                                            <td style="background-color: #fcf8e3;color: #8a6d3b;" align="center">Amount</td>
                                        </tr>
                                    </thead>
                <?php
                $sql = " SELECT sched, worker_name, total_amount FROM pmls_android_worker_task_history WHERE tagstat = 'Pest Control' AND room_owner_id = '". $_POST['tid'] ."' ";
                $res = mysql_query($sql, $connection);
                while( $row = mysql_fetch_array($res) ){
                ?>
                                    <tbody>
                                        <tr>
                                            <td align="center"><?php echo date('F d, Y', strtotime($row[0])); ?></td>
                                            <td align="center"><?php echo $row[1]; ?></td>
                                            <td align="center"><?php echo "Php ".number_format($row[2], "2",".",","); ?></td>
                                        </tr>
                                    </tbody>
                <?php
                }
                ?>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
        break;
    }
?>
