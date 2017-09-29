<?php
	include "connect.php";
	
	switch($_POST['form']){

    case 'showappreport':
        $page = $_POST['page'];
        $limit = ($page-1) * 20;

        $sql = " SELECT Application_ID, applicationDate, Company_Name, Trade_Name, Status, datefrom, dateto, Inquiry_ID FROM tbltrans_inquiry WHERE date_inquired BETWEEN '". date('Y-m-d', strtotime($_POST['dateFrom'])) ."' AND '". date('Y-m-d', strtotime($_POST['dateTo'])) ."' ORDER BY date_inquired DESC LIMIT ".$limit.",20 ";
        $res = mysql_query($sql, $connection);
        while($row = mysql_fetch_array($res)){

        $sql1 =" SELECT xremarks FROM tbltrans_remarks WHERE inqID = '". $row[7] ."' ";
        $res1 = mysql_query($sql1, $connection);
        while($row1 = mysql_fetch_array($res1)){
          $remark .= "<span class='fa fa-circle'></span>"." ". $row1[0] ."<br/>";
        }
          
          $table .= "
                    <tr>
                      <td width='10%'>". $row[0] ."</td>
                      <td width='10%'>". date("F d, Y", strtotime($row[1])) ."</td>
                      <td width='20%'>". $row[2] ."</td>
                      <td width='20%'>". $row[3] ."</td>
                      <td width='10%'>". $row[4] ."</td>
                      <td width='8%'>". $row[5] ."</td>
                      <td width='8%'>". $row[6] ."</td>
                      <td width='14%'>". $remark ."</td>
                    </tr>
                    ";
        }
        echo $table;
    break;

    case 'loadentriesappr_report':
      if($_POST["page"] == ""){
          $page = 1;
      }else{
          $page = $_POST["page"];
      }
  
      $limit = ($page-1) * 20;
  
       $sql = " SELECT COUNT(*) FROM tbltrans_inquiry WHERE date_inquired BETWEEN '". date('Y-m-d', strtotime($_POST['dateFrom'])) ."' AND '". date(' Y-m-d', strtotime($_POST['dateTo'])) ."' ";
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

    case "loadpageapp_report":
        $page = $_POST["page"];

          $sqlb = "SELECT COUNT(*) FROM tbltrans_inquiry WHERE date_inquired BETWEEN '". date('Y-m-d', strtotime($_POST['dateFrom'])) ."' AND '". date('Y-m-d', strtotime($_POST['dateTo'])) ."' ";
      $aa = mysql_query($sqlb, $connection);
      $nums = mysql_fetch_row($aa);
      $num = $nums[0];
      // if($num <= 20)
      // {
      //  $page = 1
      // }
      $rowsperpage = 20;
      $range = 19;
      $totalpages = ceil($num / $rowsperpage);
      $prevpage;
      $nextpage;
      // if not on page 1, don't show back links
      if($page > 1 ){
         echo "<li style='width:50px !important;' onclick='pagination54(1)'><< First</li>";
         $prevpage = $page - 1;
         echo "<li style='width:70px !important;' onclick='pagination54(". $prevpage .")'>< Previous</li>";
      }

      for($x = ($page - $range); $x < (($page + $range) + 1); $x++)
      {
         if (($x > 0) && ($x <= $totalpages)){
              if ($x == $page){
                        echo "<li id='pgapp_report" . $x . "' class='pgnumpapp_report active' onclick='pagination54(" . $x . ",". $x .")'>" . $x . "</li>";
                      }
              else{
                  echo "<li id='pgapp_report" . $x . "' class='pgnumpapp_report' onclick='pagination54(" . $x . ",". $x .")'>" . $x . "</li>";
                    }
           }
        }
        if($page < ($totalpages - $range)){
                echo "<li>...</li>";
            }

        if ($page != $totalpages && $num != 0){
           $nextpage = $page + 1;
           echo "<li style='width:50px !important;' onclick='pagination54(". $nextpage .", ". $nextpage .")'>Next ></li>";
           echo "<li style='width:50px !important;' onclick='pagination54(". $totalpages .", ". $totalpages .")'>Last >></li>";
        }
    break;

    case 'print_app_report':
      $sql = " SELECT Application_ID, applicationDate, Company_Name, Trade_Name, Status, datefrom, dateto, Inquiry_ID FROM tbltrans_inquiry WHERE date_inquired BETWEEN '". date('Y-m-d', strtotime($_POST['dateFrom'])) ."' AND '". date('Y-m-d', strtotime($_POST['dateTo'])) ."' ORDER BY date_inquired";
        $res = mysql_query($sql, $connection);
        while($row = mysql_fetch_array($res)){

        $sql1 =" SELECT xremarks FROM tbltrans_remarks WHERE inqID = '". $row[7] ."' ";
        $res1 = mysql_query($sql1, $connection);
        while($row1 = mysql_fetch_array($res1)){
          $remark .= "•". $row1[0] ."<br/>";
        }

        $tables .= "
                    <tr>
                      <td>". $row[0] ."</td>
                      <td>". date("F d, Y", strtotime($row[1])) ."</td>
                      <td>". $row[2] ."</td>
                      <td>". $row[3] ."</td>
                      <td>". $row[4] ."</td>
                      <td>". $row[5] ."</td>
                      <td>". $row[6] ."</td>
                      <td>". $remark ."</td>
                    </tr>";
          }

        echo $tables;
    break;
  }
?>		

