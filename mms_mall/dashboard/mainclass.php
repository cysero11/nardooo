<?php
	include("connect.php");
	switch($_POST["form"])
	{
		case "changedate":
			$file = "mydate.txt";
			$open = fopen($file, 'w');
			fwrite($open, date("Y-m-d", strtotime($_POST["mydate"])));
			fclose($open);
			echo "|1";
		break;

		case 'getpetchapie':
			$ctr = 1;
			$return_arr = array();
		
			
			$totinquiry = mysql_fetch_array(mysql_query("SELECT COUNT(*) AS totinquiry FROM tbltrans_inquiry WHERE STATUS = 'pending'"));
			$totunit = mysql_fetch_array(mysql_query("SELECT COUNT(*) AS totunit FROM tblref_unit "));
			$totoccupied = mysql_fetch_array(mysql_query("SELECT COUNT(*) AS totunit FROM tblref_unit WHERE status = 'occupied' "));
			$totvacants = mysql_fetch_array(mysql_query("SELECT COUNT(*) AS totunit FROM tblref_unit WHERE status = 'vacant' "));

			/*$row_array['label'] = 'Inquiry';
			$row_array['data'] = $totinquiry[0];
			$row_array['color'] = "#68BC31";
			$row_array['label'] = 'Total Unit';
			$row_array['data'] = $totinquiry[0];
			$row_array['color'] = "#2091CF";
*/

			// This appends a new element to $d, in this case the value is another array
			$return_arr[] = array('label' => "Inquiry" ,'data' => $totinquiry[0],'color' => "#68BC31");
			$return_arr[] = array('label' => "Total Unit" ,'data' => $totunit[0],'color' => "#2091CF");
			$return_arr[] = array('label' => "Occupied" ,'data' => $totoccupied[0],'color' => "#AF4E96");
			$return_arr[] = array('label' => "Vacant" ,'data' => $totvacants[0],'color' => "#DA5430");

		    //$row_array['col2'] = $row['col2'];

		  //  array_push($return_arr,$row_array);

			echo json_encode($return_arr);
		break;

		case 'getlinya':
			$return_arr = array();
			for($i=1;$i<=12;$i++){
				$totrevenue = mysql_fetch_array(mysql_query("SELECT SUM(amount) AS totrevenue FROM tbltransaction WHERE paymenttype = '' AND MONTH(xdate) = '".$i."' "));
				//$row_array[] = array($totrevenue[0] ?: 0);
				if($totrevenue[0]!=""){
					array_push($return_arr, (int)$totrevenue[0]);
				}
				


			}
			//array_push($return_arr,$row_array);
			echo json_encode(($return_arr));
		break;
	}
?>