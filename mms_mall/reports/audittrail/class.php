<?php 
include "../../connect.php";
	switch ($_POST['form']) {

			case 'displayaudittrail':
        $page = $_POST['page'];
        $limit = ($page-1) * 10;

        if($_POST['filterbymodule'] == ""){
        $filterbymodule = "";
        }
        else{
          $filterbymodule = "(module = '". $_POST['filterbymodule'] ."') AND";
        }

        $search = "(username LIKE '%".$_POST['txtaudittrail']."%') AND";

				$petsa = "(mydate BETWEEN '".date("Y-m-d", strtotime($_POST['dateFrom']))."' AND '".date("Y-m-d", strtotime($_POST['dateTo']))."') ";

				$sql = " SELECT username, mytime, mydate, module, xaction FROM tbllogs_trans where ".$filterbymodule." ".$search." ".$petsa." ORDER BY timestamp desc LIMIT ".$limit.",10 ";
				$res = mysql_query($sql, $connection);
				while($row = mysql_fetch_array($res)){
					?>
					<tr>		
								<td width="20%"><?php echo $row[0]; ?></td>
								<td width="20%"><?php echo $row[1]; ?></td>
								<td width="20%"><?php echo $row[2]; ?></td>
								<td width="20%"><?php echo $row[3]; ?></td>
								<td width="20%"><?php echo $row[4]; ?></td>
					<?php
				}
			break;

			case 'printaudittrail':
				$sql = " SELECT username, mytime, mydate, module, xaction FROM tbllogs_trans WHERE mydate BETWEEN '".date("Y-m-d", strtotime($_POST['dateFrom']))."' AND '".date("Y-m-d", strtotime($_POST['dateTo']))."' ORDER BY timestamp desc";
				$res = mysql_query($sql, $connection);
				while($row = mysql_fetch_array($res)){
				$tables .= "
   					   			<tr>
   					   				<td>".$row[0]."</td>
   					   				<td>".$row[1]."</td>
   					   				<td>".$row[2]."</td>
   					   				<td>".$row[3]."</td>
   					   				<td>".$row[4]."</td>
   					   			</tr>";
   				}

				echo $tables;
			break;

      case 'loaddropdowndata':
        echo "<option value=''>All</option>";
        $sql = " SELECT DISTINCT(module) FROM tbllogs_trans ";
        $res = mysql_query($sql, $connection);
        while ( $row = mysql_fetch_array($res)) {
          echo"
          <option value='". $row[0] ."'>".$row[0]."</option>
          ";
        }
      break;

      case 'loadentries':
        if($_POST['filterbymodule'] == ""){
        $filterbymodule = "";
        }
        else{
          $filterbymodule = " (module = '". $_POST['filterbymodule'] ."') AND";
        }

        $search = " (username LIKE '%".$_POST['txtaudittrail']."%') AND";

        $petsa = "(mydate BETWEEN '".date("Y-m-d", strtotime($_POST['dateFrom']))."' AND '".date("Y-m-d", strtotime($_POST['dateTo']))."') ";

         if($_POST["page"] == ""){
             $page = 1;
         }else{
             $page = $_POST["page"];
         }

         $limit = ($page-1) * 10;

          $sql = "SELECT COUNT(*) FROM tbllogs_trans where ".$filterbymodule." ".$search." ".$petsa." ";
          $result = mysql_query($sql, $connection);
          $row = mysql_fetch_array($result);

          $rowsperpage = 10;
          $totalpages = ceil($row[0] / $rowsperpage);
          $upto = $limit + 10;
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

      case "loadpageaudittrail":
         if($_POST['filterbymodule'] == ""){
          $filterbymodule = "";
          }
          else{
            $filterbymodule = " (module = '". $_POST['filterbymodule'] ."') AND";
          }

          $search = " ( username LIKE '%".$_POST['txtaudittrail']."%') AND";

          $petsa = "(mydate BETWEEN '".date("Y-m-d", strtotime($_POST['dateFrom']))."' AND '".date("Y-m-d", strtotime($_POST['dateTo']))."') ";

            $page = $_POST["page"];

              $sqlb = "SELECT COUNT(*) FROM tbllogs_trans WHERE ".$filterbymodule." ".$search." ".$petsa." ";
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
             echo "<li style='width:50px !important;' onclick='pagination(1)'><< First</li>";
             $prevpage = $page - 1;
             echo "<li style='width:70px !important;' onclick='pagination(". $prevpage .")'>< Previous</li>";
          }

          for($x = ($page - $range); $x < (($page + $range) + 1); $x++)
          {
             if (($x > 0) && ($x <= $totalpages)){
                  if ($x == $page){
                            echo "<li id='pgaudittrail" . $x . "' class='pgnumaudittrail active' onclick='pagination(" . $x . ",". $x .")'>" . $x . "</li>";
                          }
                  else{
                      echo "<li id='pgaudittrail" . $x . "' class='pgnumaudittrail' onclick='pagination(" . $x . ",". $x .")'>" . $x . "</li>";
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

      case 'template':
      $sql = " SELECT corporatename, about, address, contactnumber, emailaddress, corporatelogo, template from tblsys_setup2 ";
      $res = mysql_query($sql, $connection) or die(mysql_error());
      $row = mysql_fetch_array($res);

      $template1 .= "
            <tr>
              <td colspan='3' align='center'><img src='assets/images/corporate_logo/".$row[0].".".$row[5]." ' style='height: 130px; width: 120px;'></td>
              <td colspan='3'>
                <p style='padding: 0px; display: block;margin:0px;' class=''><h2>".$row[0]."</h2></p>
                <p style='padding: 0px; display: block;margin:0px;' class=''>".$row[2]."</p>
                <p style='padding: 0px; display: block;margin:0px;' class=''>".$row[3]."</p>
                <p style='padding: 0px; display: block;margin:0px;' class=''>".$row[4]."</p>
              </td>
            </tr>
            ";
      $template2 .= "
            <tr>
              <td colspan='3' align='center'><img src='assets/images/corporate_logo/".$row[0].".".$row[5]." ' style='height: 130px; width: 120px;'></td>
            </tr>
            <tr>
              <td colspan='3' align='center'>
                <p style='padding: 0px; display: block;margin:0px;' class='companyname'><h2>".$row[0]."</h2></p>
                <p style='padding: 0px; display: block;margin:0px;' class='companyaddress'>".$row[2]."</p>
                <p style='padding: 0px; display: block;margin:0px;' class='companynumber'>".$row[3]."</p>
                <p style='padding: 0px; display: block;margin:0px;' class='companywebsite'>".$row[4]."</p>
              </td>
            </tr>
            ";

      if ($row[6] == "1"){
        echo $template1;
        }
      else{
        echo $template2;
      }

      break;
}
?>