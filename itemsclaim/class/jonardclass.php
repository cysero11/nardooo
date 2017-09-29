<?php 

    include('../../connect.php');


    switch($_POST["form"])
    {

        case 'loadcardid':
        $cardid = "SELECT card_id FROM items_claim_deposit";
        $querryy = mysql_query($cardid,$connection);
        if($row = mysql_fetch_array($querryy)){

            echo $row['card_id'];

        }
        break;

        case 'insertdata':

        $additem = "SELECT item_description, card_id, owner_name, notes, important, quantity, deposit_date, deposit_time, item_status FROM items_claim_deposit WHERE card_id ='".$_POST['cardid']."' ";
        $resultadd = mysql_query($additem,$connection);
        $row2 = mysql_fetch_array($resultadd);
        if($row2>0)
        {
            // echo "Card ID already used!";
        }
        else
        {
            $additem2 = "INSERT INTO items_claim_deposit SET card_id = '" .$_POST['cardid']. "',item_description='".$_POST['itemdesc']. "',owner_name= '" .$_POST['ownername']. "',notes='" .$_POST['notess']. "',important='" .$_POST['importants']."',quantity='" .$_POST['quantityy']."' ,transaction_id = '".$_POST['transac']."',deposit_date='".date("Y/m/d", strtotime($_POST["datess"]))."',deposit_time ='" .$_POST['timess']."',item_status ='Deposited'";
        $resultadditem = mysql_query($additem2,$connection);
        if(!$resultadditem){

            echo mysql_error($connection);
        }
        else
        {
            echo "Item Successfully Deposited!";
        }

        }
        break;

        case 'gettable':

        $gettablee = "SELECT DISTINCT item_description, card_id, owner_name, notes, important, quantity, claim_date, claim_time, item_status, deposit_date, deposit_time FROM items_claim_deposit WHERE item_status = 'Deposited' AND deposit_date = CURDATE()";
        $resulttable = mysql_query($gettablee,$connection);
        if(!$resulttable){echo mysql_error($connection);}
        while($row = mysql_fetch_array($resulttable)){

            echo "<tr>
                        <td>" .$row['card_id']. "</td>
                        <td>" .$row['owner_name']. "</td>
                        <td>" .$row['item_description']. "</td>
                        <td>" .$row['notes']. "</td>
                        <td>" .$row['quantity']. "</td>
                        <td>" .$row['deposit_date']. "</td>
                        <td>" .$row['deposit_time']. "</td>
                        <td>" .$row['claim_date']. "</td>
                        <td>" .$row['claim_date']. "</td>
                        <td style='font-weight: bold; color: orange;'>" .$row['item_status']. "</td>
                        <td style='text-align: center;'><a href='#' title='Claim' onclick='updatehehe(\"".$row['card_id']. "\");' data-pjax='0'><button class='btn btn-success' type='button'> Claim </button></a></td> 
                </tr>";


        }
        break; 

        case 'searchbox':

        $searchhehe = "SELECT DISTINCT card_id, item_description, owner_name, notes, important, quantity, deposit_date, deposit_time, item_status FROM items_claim_deposit WHERE card_id LIKE '%" .$_POST['search']. "%' or item_description LIKE '" .$_POST['search']. "%' or owner_name LIKE '%" .$_POST['search']. "%' or notes LIKE '%" .$_POST['search']. "%' or important LIKE '%" .$_POST['search']."%' or quantity LIKE '%" .$_POST['search']."' HAVING deposit_date= '" .$_POST['wawww']. "'";
        $resultsearch = mysql_query($searchhehe,$connection);
        // echo $searchhehe;s
        while($row = mysql_fetch_array($resultsearch)){
             echo "<tr>
                        <td>" .$row['card_id']. "</td>
                        <td>" .$row['owner_name']. "</td>
                        <td>" .$row['item_description']. "</td>
                        <td>" .$row['notes']. "</td>
                        <td>" .$row['quantity']. "</td>
                        <td>" .$row['deposit_date']. "</td>
                        <td>" .$row['deposit_time']. "</td>
                        <td style='text-align: center;'><a href='#' title='Claim' onclick='updatehehe();' data-pjax='0'><button class='btn btn-success' type='button'> Claim </button></a></td> 
                </tr>";

        }
        break;

        case 'updateclaim':
        $cardidj = $_POST['cardidj'];
        $updatehehe = "UPDATE items_claim_deposit SET item_status = 'Claimed', claim_date = NOW(), claim_time = NOW() WHERE card_id = '" .$cardidj."' ";
        // echo $updatehehe;

        $resultsq = mysql_query($updatehehe,$connection); 

        break;


        case 'printkomamamo':
        if($_POST['itemstatus']=='Deposited')
        {

            //print ng lahat ng nadeposit
            $querygetdeposited = "SELECT card_id, item_description, owner_name, notes, important, quantity, claim_date, claim_time, deposit_date, deposit_time,item_status FROM items_claim_deposit WHERE deposit_date BETWEEN '".date("Y-m-d", strtotime($_POST['dateFrom']))."' AND '".date("Y-m-d", strtotime($_POST['dateTo']))."' AND item_status = 'Deposited'";
             $res = mysql_query($querygetdeposited, $connection);
             if(!$res){echo mysql_error($connection);}
             else
             {
                // echo "<center><label> DEPOSITED </label></center>";
                while($row = mysql_fetch_array($res)){

                echo 
                    "<tr>
                        <td style='text-align: center;'>" .$row['owner_name']. "</td>
                        <td style='text-align: center;'>" .$row['item_description']. "</td>
                        <td style='text-align: center;'>" .$row['notes']. "</td>
                        <td style='text-align: center;'>" .$row['quantity']. "</td>
                        <td style='text-align: center;'>" .$row['deposit_date']. "</td>
                        <td style='text-align: center;'>" .$row['deposit_time']. "</td>
                        <td style='text-align: center;'>" .$row['claim_date']. "</td>
                        <td style='text-align: center;'>" .$row['claim_time']. "</td>
                        <td style='text-align: center; color: orange;'>" .$row['item_status']. "</td>
                    </tr>";

            }
        
            echo "|". date('F d, Y', strtotime($_POST['dateFrom'])) . "|" . date('F d, Y', strtotime($_POST['dateTo']));
            }
           
        }
        else if ($_POST['itemstatus']=='Claimed')
        {
            $querygetclaimed = "SELECT card_id, item_description, owner_name, notes, important, quantity, claim_date, claim_time, deposit_date, deposit_time,item_status FROM items_claim_deposit WHERE claim_date BETWEEN '".date("Y-m-d", strtotime($_POST['dateFrom']))."' AND '".date("Y-m-d", strtotime($_POST['dateTo']))."' AND item_status = 'Claimed' ";
             $res = mysql_query($querygetclaimed, $connection);
             if(!$res){echo mysql_error($connection);}
             else
             {
                while($row = mysql_fetch_array($res)){

                echo "<tr>
                        <td style='text-align: center;'>" .$row['owner_name']. "</td>
                        <td style='text-align: center;'>" .$row['item_description']. "</td>
                        <td style='text-align: center;'>" .$row['notes']. "</td>
                        <td style='text-align: center;'>" .$row['quantity']. "</td>
                        <td style='text-align: center;'>" .$row['claim_date']. "</td>
                        <td style='text-align: center;'>" .$row['claim_time']. "</td>
                        <td style='text-align: center;'>" .$row['deposit_date']. "</td>
                        <td style='text-align: center;'>" .$row['deposit_time']. "</td>
                        <td style='text-align: center; color: green;'>" .$row['item_status']. "</td>
                    </tr>";

            }
            echo "|". date('F d, Y', strtotime($_POST['dateFrom'])) . "|" . date('F d, Y', strtotime($_POST['dateTo']));
             }


            
        }
        break;

        case 'printkomamammo2':
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

        case 'printfilter':
            echo "<option value=''> -- Filter By -- </option>";
            $hehe = mysql_query("SELECT DISTINCT item_status FROM items_claim_deposit" , $connection);
            while ($row = mysql_fetch_array($hehe)){

                echo "<option value=" .$row['item_status']. ">" .$row['item_status']. "</option>";

            }
        break;

        case 'malloption':
            echo "<option value=''>-- Select Mall --</option>";
            $res = mysql_query("SELECT mallid, mallname FROM tblref_mall", $connection);
            while ($row = mysql_fetch_array($res)) {
                echo "<option value=".$row[0].">".$row[1]."</option>";
            }
        break;




        ////////////////////////////////////// Jerms Class ///////////////////////////////////////

        case 'loadfilters_inquiry':
            $sql = "SELECT checked_value, otherfilter, xcheck , bystat FROM tblref_filters WHERE module = 'ItemsClaim'";
            $result = mysql_query($sql, $connection);
            $row = mysql_fetch_array($result);
            
            echo $row["checked_value"] . "#" . $row["otherfilter"] . "#". $row["bystat"] . "#" . $row["xcheck"];
            // echo $sql;
        break;

        case 'savefilter':
            $sql = "SELECT checked_value FROM tblref_filters WHERE module = '".$_POST["module"]."'";
            $result = mysql_query($sql, $connection);
            $num = mysql_num_rows($result);
            $row = mysql_fetch_array($result);

            if($num == 0){
                $sql_insert = "INSERT INTO tblref_filters (module, checked_value, filters, otherfilter, xcheck, bystat)VALUES('".$_POST["module"]."', '".$_POST["checked"]."', '".$_POST["checked2"]."','".date("Y/m/d", strtotime($_POST["claimappstart"]))."|".date("Y/m/d", strtotime($_POST["claimappend"]))."|".date("Y/m/d", strtotime($_POST["depoappstart"]))."|".date("Y/m/d", strtotime($_POST["depoappend"]))."', '".$_POST["datefilter"]."', '".$_POST['checked3']."')";
                $result_insert = mysql_query($sql_insert, $connection);
                if($result_insert == true){
                    echo 1;
                }
            }

            else{

                $sql_update= "UPDATE tblref_filters SET checked_value = '".$_POST["checked"]."', otherfilter = '".date("Y/m/d", strtotime($_POST["claimappstart"]))."|".date("Y/m/d", strtotime($_POST["claimappend"]))."|".date("Y/m/d", strtotime($_POST["depoappstart"]))."|".date("Y/m/d", strtotime($_POST["depoappend"]))."', xcheck = '".$_POST["datefilter"]."', bystat = '".$_POST['checked3']."' WHERE module = '".$_POST['module']."'";
                $result_update = mysql_query($sql_update, $connection);
                //echo $sql_update;  
                if($result_update == true){
                    echo 2;   
                }
            }
        break; 

         case 'listofitems':

           //loop for > 1 whole query data

        

            $lubricant1 = ""; //value for this query
            $v = 0; //loop for > 1 data for this query
            $lotion = ""; //query for WHERE
            $testing = 0;



            $filter_query = "SELECT checked_value, otherfilter, bystat, xcheck FROM tblref_filters WHERE module = 'ItemsClaim'";
            $sql = mysql_query($filter_query,$connection);
            $filter_row = mysql_fetch_array($sql);



            $asdtangina = explode("|", $filter_row['bystat']);
            for($d = 0; $d <= count($asdtangina); $d++){

                if($asdtangina[$d] != ""){
                    $v++;
                    if($v == 1)
                    {
                
                            $lubricant1 .= " a.item_status = '".$asdtangina[$d]."'";    
                    }
                 
                    else if($v > 1)
                    {
                        
                            $lubricant1 .= " OR a.item_status = '".$asdtangina[$d]."'"; 
                        
                    }
                }
            }



            if($v > 0){
               $testing++;
                $lotion .= "WHERE (".$lubricant1.") ";
            }
            else{
                $lubricant1 = "";
                $lotion .= $lubricant1;
            }



            
            $lubricant2 = "";   
            $b = 0;

            $qop = explode("|",$filter_row['checked_value']);
            for($loopa = 0; $loopa <=count($qop); $loopa++){

                if($qop[$loopa] != ""){
                    $b++;
                    if($b == 1)
                    {
                
                            $lubricant2 .= " a.`".$qop[$loopa]."` LIKE '%".$_POST["searchehe"]."%'";    
                    }
                 
                    else if($b > 1)
                    {
                        
                            $lubricant2 .= " OR a.`".$qop[$loopa]."` LIKE '%".$_POST["searchehe"]."%'"; 
                        
                    }
                }
        }

            
            if($b > 0){
               $testing++;
                $lotion .= " (".$lubricant2.") ";
            }
            else{
                $lubricant2 = "";
                $lotion .= $lubricant2;
            }








            $lubricant3 = "";
            $pucklord = explode("|", $filter_row["otherfilter"]);

            if($filter_row["xcheck"] === 'datecheck2'){
                     $lubricant3 .= " a.`claim_date` BETWEEN '".$pucklord[0]."' AND '".$pucklord[1]."'";
                     $testing++;
            }

            else if($filter_row["xcheck"] === 'datecheck1'){

                 $lubricant3 .= " a.`deposit_date` BETWEEN '".$pucklord[2]."' AND '".$pucklord[3]."'";
                 $testing++;
            }
    
        
            $lotion .= " (".$lubricant3.") ";
        

           
            if($testing > 1){
                if($lubricant1 === ""){
                    $lotion = "WHERE (".$lubricant3.") AND (".$lubricant2.")";
                }
                else if($lubricant2 === ""){
                    $lotion = "WHERE (".$lubricant3.") AND (".$lubricant1.")";
                }
                else if($lubricant3 === ""){
                    $lotion = "WHERE (".$lubricant1.") AND (".$lubricant2.")";
                }
            }
        
            if($lubricant1 === "" && $lubricant2 === ""){
                $lotion = "WHERE (".$lubricant3.") ";
            
            }
            else if($lubricant1 != "" && $lubricant2 != "" && $lubricant3 != ""){
                $lotion = "WHERE (".$lubricant1.") AND (".$lubricant2.") AND (".$lubricant3.")";
            }

            $page = $_POST['page'];
            $limit = ($page-1) * 10;


            $sql = " SELECT * FROM items_claim_deposit AS a ".$lotion." ORDER BY card_id desc LIMIT ".$limit.",10 ";
            $res = mysql_query($sql, $connection);
            // echo $sql;
          echo mysql_error($connection);
           
            

            while( $row = mysql_fetch_array($res) ){
            if($row['item_status'] === 'Deposited')
            {
                echo "<tr>";
                echo "<td>" .$row['card_id']. "</td>";
                echo "<td>" .$row['owner_name']. "</td>";
                echo "<td>" .$row['item_description']. "</td>";
                echo "<td>" .$row['notes']. "</td>";
                echo "<td>" .$row['quantity']. "</td>";
                echo "<td style='width: 100px;'>" .$row['deposit_date']. "</td>";
                echo "<td>" .$row['deposit_time']. "</td>";
                echo "<td>" .$row['claim_date']. "</td>";
                echo "<td>" .$row['claim_time']. "</td>";
                echo "<td style='font-weight: bold; color: orange;'>" .$row['item_status']. "</td>";
                echo "<td style='text-align: center;'><a href='#' title='Claim' onclick='updatehehe(\"".$row['card_id']. "\");' data-pjax='0'><button class='btn btn-success' type='button'> Claim </button></a></td>";
                echo "</tr>";
            }
            if($row['item_status']=== 'Claimed')
            {

                echo "<tr>";
                echo "<td>" .$row['card_id']. "</td>";
                echo "<td>" .$row['owner_name']. "</td>";
                echo "<td>" .$row['item_description']. "</td>";
                echo "<td>" .$row['notes']. "</td>";
                echo "<td>" .$row['quantity']. "</td>";
                echo "<td>" .$row['deposit_date']. "</td>";
                echo "<td>" .$row['deposit_time']. "</td>";
                echo "<td>" .$row['claim_date']. "</td>";
                echo "<td>" .$row['claim_time']. "</td>";
                echo "<td style='font-weight: bold; color: green;'>" .$row['item_status']. "</td>";

                if($row['item_status'] == 'Claimed'){
                    $disabled = 'disabled';
                }
                else{
                    $disabled = '';
                }
                echo "<td style='text-align: center;'><a href='#' title='Claim' onclick='updatehehe(\"".$row['card_id']. "\");' data-pjax='0' hidden><button ".$disabled." class='btn btn-success' type='button'> Claim </button></a></td>";
                echo "</tr>";

            }
            // else
            // {
            //     echo "<td style='text-align: center;'><a href='#' title='Claim' onclick='updatehehe(\"".$row['card_id']. "\");' data-pjax='0'><button class='btn btn-success' type='button'> Claim </button></a></td> 
            //     ";
            // }
            // echo '</tr>';

        }
        break;


        ///////////////////////////////// PAGINATION & LOAD ENTRIES ///////////////////////////////////////////

        case "loadpaginationdeposit":
                
                $lubricant1 = ""; //value for this query
            $v = 0; //loop for > 1 data for this query
            $lotion = ""; //query for WHERE
            $testing = 0;



            $filter_query = "SELECT checked_value, otherfilter, bystat, xcheck FROM tblref_filters WHERE module = 'ItemsClaim'";
            $sql = mysql_query($filter_query,$connection);
            $filter_row = mysql_fetch_array($sql);



            $asdtangina = explode("|", $filter_row['bystat']);
            for($d = 0; $d <= count($asdtangina); $d++){

                if($asdtangina[$d] != ""){
                    $v++;
                    if($v == 1)
                    {
                
                            $lubricant1 .= " a.item_status = '".$asdtangina[$d]."'";    
                    }
                 
                    else if($v > 1)
                    {
                        
                            $lubricant1 .= " OR a.item_status = '".$asdtangina[$d]."'"; 
                        
                    }
                }
            }



            if($v > 0){
               $testing++;
                $lotion .= "WHERE (".$lubricant1.") ";
            }
            else{
                $lubricant1 = "";
                $lotion .= $lubricant1;
            }



            
            $lubricant2 = "";   
            $b = 0;

            $qop = explode("|",$filter_row['checked_value']);
            for($loopa = 0; $loopa <=count($qop); $loopa++){

                if($qop[$loopa] != ""){
                    $b++;
                    if($b == 1)
                    {
                
                            $lubricant2 .= " a.`".$qop[$loopa]."` LIKE '%".$_POST["searchehe"]."%'";    
                    }
                 
                    else if($b > 1)
                    {
                        
                            $lubricant2 .= " OR a.`".$qop[$loopa]."` LIKE '%".$_POST["searchehe"]."%'"; 
                        
                    }
                }
        }

            
            if($b > 0){
               $testing++;
                $lotion .= " (".$lubricant2.") ";
            }
            else{
                $lubricant2 = "";
                $lotion .= $lubricant2;
            }








            $lubricant3 = "";
            $pucklord = explode("|", $filter_row["otherfilter"]);

            if($filter_row["xcheck"] === 'datecheck2'){
                     $lubricant3 .= " a.`claim_date` BETWEEN '".$pucklord[0]."' AND '".$pucklord[1]."'";
                     $testing++;
            }

            else if($filter_row["xcheck"] === 'datecheck1'){

                 $lubricant3 .= " a.`deposit_date` BETWEEN '".$pucklord[2]."' AND '".$pucklord[3]."'";
                 $testing++;
            }
    
        
            $lotion .= " (".$lubricant3.") ";
        

           
            if($testing > 1){
                if($lubricant1 === ""){
                    $lotion = "WHERE (".$lubricant3.") AND (".$lubricant2.")";
                }
                else if($lubricant2 === ""){
                    $lotion = "WHERE (".$lubricant3.") AND (".$lubricant1.")";
                }
                else if($lubricant3 === ""){
                    $lotion = "WHERE (".$lubricant1.") AND (".$lubricant2.")";
                }
            }
        
            if($lubricant1 === "" && $lubricant2 === ""){
                $lotion = "WHERE (".$lubricant3.") ";
            
            }
            else if($lubricant1 != "" && $lubricant2 != "" && $lubricant3 != ""){
                $lotion = "WHERE (".$lubricant1.") AND (".$lubricant2.") AND (".$lubricant3.")";
            }

                $page = $_POST["page"];


                $sqlb = "SELECT COUNT(*) FROM items_claim_deposit AS a ".$lotion."";
                $aa = mysql_query($sqlb, $connection);
                $nums = mysql_fetch_row($aa);
                $num = $nums[0];
                // if($num <= 20)
                // {
                //  $page = 1
                // }
                $rowsperpage = 10;
                $range = 9;
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
                        else
                        {
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

            case 'loadentries':
               
                $lubricant1 = ""; //value for this query
            $v = 0; //loop for > 1 data for this query
            $lotion = ""; //query for WHERE
            $testing = 0;



            $filter_query = "SELECT checked_value, otherfilter, bystat, xcheck FROM tblref_filters WHERE module = 'ItemsClaim'";
            $sql = mysql_query($filter_query,$connection);
            $filter_row = mysql_fetch_array($sql);



            $asdtangina = explode("|", $filter_row['bystat']);
            for($d = 0; $d <= count($asdtangina); $d++){

                if($asdtangina[$d] != ""){
                    $v++;
                    if($v == 1)
                    {
                
                            $lubricant1 .= " a.item_status = '".$asdtangina[$d]."'";    
                    }
                 
                    else if($v > 1)
                    {
                        
                            $lubricant1 .= " OR a.item_status = '".$asdtangina[$d]."'"; 
                        
                    }
                }
            }



            if($v > 0){
               $testing++;
                $lotion .= "WHERE (".$lubricant1.") ";
            }
            else{
                $lubricant1 = "";
                $lotion .= $lubricant1;
            }



            
            $lubricant2 = "";   
            $b = 0;

            $qop = explode("|",$filter_row['checked_value']);
            for($loopa = 0; $loopa <=count($qop); $loopa++){

                if($qop[$loopa] != ""){
                    $b++;
                    if($b == 1)
                    {
                
                            $lubricant2 .= " a.`".$qop[$loopa]."` LIKE '%".$_POST["searchehe"]."%'";    
                    }
                 
                    else if($b > 1)
                    {
                        
                            $lubricant2 .= " OR a.`".$qop[$loopa]."` LIKE '%".$_POST["searchehe"]."%'"; 
                        
                    }
                }
        }

            
            if($b > 0){
               $testing++;
                $lotion .= " (".$lubricant2.") ";
            }
            else{
                $lubricant2 = "";
                $lotion .= $lubricant2;
            }








            $lubricant3 = "";
            $pucklord = explode("|", $filter_row["otherfilter"]);

            if($filter_row["xcheck"] === 'datecheck2'){
                     $lubricant3 .= " a.`claim_date` BETWEEN '".$pucklord[0]."' AND '".$pucklord[1]."'";
                     $testing++;
            }

            else if($filter_row["xcheck"] === 'datecheck1'){

                 $lubricant3 .= " a.`deposit_date` BETWEEN '".$pucklord[2]."' AND '".$pucklord[3]."'";
                 $testing++;
            }
    
        
            $lotion .= " (".$lubricant3.") ";
        

           
            if($testing > 1){
                if($lubricant1 === ""){
                    $lotion = "WHERE (".$lubricant3.") AND (".$lubricant2.")";
                }
                else if($lubricant2 === ""){
                    $lotion = "WHERE (".$lubricant3.") AND (".$lubricant1.")";
                }
                else if($lubricant3 === ""){
                    $lotion = "WHERE (".$lubricant1.") AND (".$lubricant2.")";
                }
            }
        
            if($lubricant1 === "" && $lubricant2 === ""){
                $lotion = "WHERE (".$lubricant3.") ";
            
            }
            else if($lubricant1 != "" && $lubricant2 != "" && $lubricant3 != ""){
                $lotion = "WHERE (".$lubricant1.") AND (".$lubricant2.") AND (".$lubricant3.")";
            }

                if($_POST["page"] == "")
                {
                    $page = 1;
                }
                else
                {
                    $page = $_POST["page"];
                }

                $limit = ($page-1) * 10;
                $sql = "SELECT COUNT(*) FROM items_claim_deposit AS a ".$lotion."";
               // echo $sql;
                $result = mysql_query($sql, $connection);
                $row = mysql_fetch_array($result);
                $rowsperpage = 10;
                $totalpages = ceil($row[0] / $rowsperpage);
                $upto = $limit + 10;
                $from = $limit + 1;
                if($page == $totalpages && $row[0] != 0)
                {
                    echo "Showing " . $from . " to " . $row[0] . " of " . $row[0] . " entries";
                }
                else
                {
                    if($row[0] == 0)
                    {
                        echo "";
                    }
                    else if($row[0] <= 9 && $row[0] != 0)
                    {
                        echo "Showing 1 to " . $row[0] . " of " . $row[0] . " entries";
                    }
                    else if($row[0] >= 10 && $row[0] != 0)
                    {
                        echo "Showing " . $from . " to " . $upto . " of " . $row[0] . " entries";
                    }
                }
            break;

            case 'generatevisitid':
              $checkid = "SELECT transaction_id from items_claim_deposit Order by transaction_id DESC LIMIT 1";
              $checkid_query = mysql_query($checkid,$connection);
              $countrows = mysql_num_rows($checkid_query);
              $getrow = mysql_fetch_array($checkid_query);
              if($countrows>0)
              {
                $last_id = $getrow['transaction_id'];
                $incrementdate = substr($last_id,4);
                $wew = substr($last_id,0,3);
                $incrementdate+=1;
                $finalincremenet = $wew."-".$incrementdate;
                $arr = explode("-", $getrow['transaction_id']);
                $payID ="TRANSACTION-". addleadingzero($arr[1]+1);
                echo $payID;
              }
              else
              {
                $getcurrentyear =  "TRANSACTION";
                $firstnumber = 0;
                $finaldate_zero = $getcurrentyear."-".$firstnumber;
                $payID = $getcurrentyear."-".addleadingzero("1");
                echo $payID;
              }
            break;



    }
?>