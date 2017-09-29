<?php
include "../../connect.php";
	switch ($_POST['form']) {
		case 'sayear':
			$sql = " SELECT DISTINCT(YEAR(fdtTrnsctn)) FROM db_sales ";
			$res = mysql_query($sql, $connection);
			while($row = mysql_fetch_array($res)){
				echo"<option value='". $row[0] ."'>".$row[0]."</option>";
			}
		break;

		case 'saday':
			$month = $_POST['month'];

			if($month == "02"){
			echo "<option value=''>Choose Day</option>
				<option>01</option> <option>02</option> <option>03</option> <option>04</option> <option>05</option>
	            <option>06</option> <option>07</option> <option>08</option> <option>09</option> <option>10</option>
	            <option>11</option> <option>12</option> <option>13</option> <option>14</option> <option>15</option>	            
	            <option>16</option> <option>17</option> <option>18</option> <option>19</option> <option>20</option>
	            <option>21</option> <option>22</option> <option>23</option> <option>24</option> <option>25</option>
	            <option>26</option> <option>27</option> <option>28</option> ";
			}
			else if($month == "01" || $month == "03" || $month == "05" || $month == "07" || $month == "08" || $month == "10" || $month == "12"){
			echo "<option value=''>Choose Day</option>
				<option>01</option> <option>02</option> <option>03</option> <option>04</option> <option>05</option>
	            <option>06</option> <option>07</option> <option>08</option> <option>09</option> <option>10</option>
	            <option>11</option> <option>12</option> <option>13</option> <option>14</option> <option>15</option>	            
	            <option>16</option> <option>17</option> <option>18</option> <option>19</option> <option>20</option>
	            <option>21</option> <option>22</option> <option>23</option> <option>24</option> <option>25</option>
	            <option>26</option> <option>27</option> <option>28</option> <option>29</option> <option>30</option>
	            <option>31</option>";
			}
			else if($month == "04" || $month == "06" || $month == "09" || $month == "11"){
			echo "<option value=''>Choose Day</option>
				<option>01</option> <option>02</option> <option>03</option> <option>04</option> <option>05</option>
	            <option>06</option> <option>07</option> <option>08</option> <option>09</option> <option>10</option>
	            <option>11</option> <option>12</option> <option>13</option> <option>14</option> <option>15</option>	            
	            <option>16</option> <option>17</option> <option>18</option> <option>19</option> <option>20</option>
	            <option>21</option> <option>22</option> <option>23</option> <option>24</option> <option>25</option>
	            <option>26</option> <option>27</option> <option>28</option> <option>29</option> <option>30</option>";
			}
			else{
			echo "<option value=''>Choose Day</option>";
			}
		break;

		case 'companysales':
			$sql = "SELECT corporatename FROM tblsys_setup2"; 
			$res = mysql_query($sql, $connection);
			$row = mysql_fetch_array($res);

			$year = $_POST['year'];
			$month = $_POST['month'];
			$day = $_POST['day'];
			$date1 = $_POST['year']."-".$_POST['month']."-".$_POST['day'];

			if($year == "" && $month == "" && $day == ""){
				$sqlsales = " SELECT tenantid, fdtTrnsctn, SUM(fnmGrndTtlOld), SUM(fnmGrndTtlNew), SUM(fnmGTDlySls), SUM(fnmGTDscnt), SUM(fnmGTDscntSNR), SUM(fnmGTDscntPWD), SUM(fnmGTDscntGPC), SUM(fnmGTDscntVIP), SUM(fnmGTDscntEMP), SUM(fnmGTDscntREG), SUM(fnmGTDscntOTH), SUM(fnmGTRfnd), SUM(fnmGTCncld), SUM(fnmGTSlsVAT), SUM(fnmGTVATSlsInclsv), SUM(fnmGTVATSlsExclsv), SUM(fnmOffclRcptBeg), SUM(fnmOffclRcptEnd), SUM(fnmGTCntDcmnt), SUM(fnmGTCntCstmr), SUM(fnmGTCntSnrCtzn), SUM(fnmGTLclTax), SUM(fnmGTSrvcChrg), SUM(fnmGTSlsNonVat), SUM(fnmGTRwGrss), SUM(fnmGTLclTaxDly), fvcWrksttnNmbr, SUM(fnmGTPymntCSH), SUM(fnmGTPymntCRD), SUM(fnmGTPymntOTH) FROM db_sales ";
			}
			else if($year != "" && $month != "" && $day != ""){
				$sqlsales = " SELECT tenantid, fdtTrnsctn, SUM(fnmGrndTtlOld), SUM(fnmGrndTtlNew), SUM(fnmGTDlySls), SUM(fnmGTDscnt), SUM(fnmGTDscntSNR), SUM(fnmGTDscntPWD), SUM(fnmGTDscntGPC), SUM(fnmGTDscntVIP), SUM(fnmGTDscntEMP), SUM(fnmGTDscntREG), SUM(fnmGTDscntOTH), SUM(fnmGTRfnd), SUM(fnmGTCncld), SUM(fnmGTSlsVAT), SUM(fnmGTVATSlsInclsv), SUM(fnmGTVATSlsExclsv), SUM(fnmOffclRcptBeg), SUM(fnmOffclRcptEnd), SUM(fnmGTCntDcmnt), SUM(fnmGTCntCstmr), SUM(fnmGTCntSnrCtzn), SUM(fnmGTLclTax), SUM(fnmGTSrvcChrg), SUM(fnmGTSlsNonVat), SUM(fnmGTRwGrss), SUM(fnmGTLclTaxDly), fvcWrksttnNmbr, SUM(fnmGTPymntCSH), SUM(fnmGTPymntCRD), SUM(fnmGTPymntOTH) FROM db_sales WHERE fdtTrnsctn = '". $date1 ."' ";
			}
			else if($year != "" && $month != "" && $day == ""){
				$sqlsales = " SELECT tenantid, fdtTrnsctn, SUM(fnmGrndTtlOld), SUM(fnmGrndTtlNew), SUM(fnmGTDlySls), SUM(fnmGTDscnt), SUM(fnmGTDscntSNR), SUM(fnmGTDscntPWD), SUM(fnmGTDscntGPC), SUM(fnmGTDscntVIP), SUM(fnmGTDscntEMP), SUM(fnmGTDscntREG), SUM(fnmGTDscntOTH), SUM(fnmGTRfnd), SUM(fnmGTCncld), SUM(fnmGTSlsVAT), SUM(fnmGTVATSlsInclsv), SUM(fnmGTVATSlsExclsv), SUM(fnmOffclRcptBeg), SUM(fnmOffclRcptEnd), SUM(fnmGTCntDcmnt), SUM(fnmGTCntCstmr), SUM(fnmGTCntSnrCtzn), SUM(fnmGTLclTax), SUM(fnmGTSrvcChrg), SUM(fnmGTSlsNonVat), SUM(fnmGTRwGrss), SUM(fnmGTLclTaxDly), fvcWrksttnNmbr, SUM(fnmGTPymntCSH), SUM(fnmGTPymntCRD), SUM(fnmGTPymntOTH) FROM db_sales WHERE YEAR(fdtTrnsctn) = '". $year ."' AND MONTH(fdtTrnsctn) = '". $month ."' ";
			}
			else if($year != "" && $month == "" && $day == ""){
				$sqlsales = " SELECT tenantid, fdtTrnsctn, SUM(fnmGrndTtlOld), SUM(fnmGrndTtlNew), SUM(fnmGTDlySls), SUM(fnmGTDscnt), SUM(fnmGTDscntSNR), SUM(fnmGTDscntPWD), SUM(fnmGTDscntGPC), SUM(fnmGTDscntVIP), SUM(fnmGTDscntEMP), SUM(fnmGTDscntREG), SUM(fnmGTDscntOTH), SUM(fnmGTRfnd), SUM(fnmGTCncld), SUM(fnmGTSlsVAT), SUM(fnmGTVATSlsInclsv), SUM(fnmGTVATSlsExclsv), SUM(fnmOffclRcptBeg), SUM(fnmOffclRcptEnd), SUM(fnmGTCntDcmnt), SUM(fnmGTCntCstmr), SUM(fnmGTCntSnrCtzn), SUM(fnmGTLclTax), SUM(fnmGTSrvcChrg), SUM(fnmGTSlsNonVat), SUM(fnmGTRwGrss), SUM(fnmGTLclTaxDly), fvcWrksttnNmbr, SUM(fnmGTPymntCSH), SUM(fnmGTPymntCRD), SUM(fnmGTPymntOTH) FROM db_sales WHERE YEAR(fdtTrnsctn) = '". $year ."' ";
			}
			else {
				echo "1";
			}
				$ressales = mysql_query($sqlsales, $connection);
				while($rowsales = mysql_fetch_array($ressales)){
					$table .= "
					<tr style='width: 100%;cursor: pointer !important;' onclick='mallsales();'>
					    <td style='text-align: left; width:1%; white-space:nowrap;'>". $row[0] ."</td>
						<td style='text-align: left; width:1%; white-space:nowrap;'>". $year ."</td>	
						<td style='text-align: left; width:1%; white-space:nowrap;'>". number_format($rowsales[3], 2, '.', ',') ."</td>
						<td style='text-align: left; width:1%; white-space:nowrap;'>". number_format($rowsales[5], 2, '.', ',') ."</td>
						<td style='text-align: left; width:1%; white-space:nowrap;'>". number_format($rowsales[6], 2, '.', ',') ."</td>
						<td style='text-align: left; width:1%; white-space:nowrap;'>". number_format($rowsales[7], 2, '.', ',') ."</td>
						<td style='text-align: left; width:1%; white-space:nowrap;'>". number_format($rowsales[8], 2, '.', ',') ."</td>
						<td style='text-align: left; width:1%; white-space:nowrap;'>". number_format($rowsales[9], 2, '.', ',') ."</td>
						<td style='text-align: left; width:1%; white-space:nowrap;'>". number_format($rowsales[10], 2, '.', ',') ."</td>
						<td style='text-align: left; width:1%; white-space:nowrap;'>". number_format($rowsales[11], 2, '.', ',') ."</td>
						<td style='text-align: left; width:1%; white-space:nowrap;'>". number_format($rowsales[12], 2, '.', ',') ."</td>
						<td style='text-align: left; width:1%; white-space:nowrap;'>". number_format($rowsales[13], 2, '.', ',') ."</td>
						<td style='text-align: left; width:1%; white-space:nowrap;'>". number_format($rowsales[14], 2, '.', ',') ."</td>
						<td style='text-align: left; width:1%; white-space:nowrap;'>". number_format($rowsales[15], 2, '.', ',') ."</td>
						<td style='text-align: left; width:1%; white-space:nowrap;'>". number_format($rowsales[16], 2, '.', ',') ."</td>
						<td style='text-align: left; width:1%; white-space:nowrap;'>". number_format($rowsales[17], 2, '.', ',') ."</td>
						<td style='text-align: left; width:1%; white-space:nowrap;'>". number_format($rowsales[18], 2, '.', ',') ."</td>
						<td style='text-align: left; width:1%; white-space:nowrap;'>". number_format($rowsales[19], 2, '.', ',') ."</td>
						<td style='text-align: left; width:1%; white-space:nowrap;'>". number_format($rowsales[20], 2, '.', ',') ."</td>
						<td style='text-align: left; width:1%; white-space:nowrap;'>". number_format($rowsales[21], 2, '.', ',') ."</td>
						<td style='text-align: left; width:1%; white-space:nowrap;'>". number_format($rowsales[22], 2, '.', ',') ."</td>
						<td style='text-align: left; width:1%; white-space:nowrap;'>". number_format($rowsales[23], 2, '.', ',') ."</td>
						<td style='text-align: left; width:1%; white-space:nowrap;'>". number_format($rowsales[24], 2, '.', ',') ."</td>
						<td style='text-align: left; width:1%; white-space:nowrap;'>". number_format($rowsales[25], 2, '.', ',') ."</td>
						<td style='text-align: left; width:1%; white-space:nowrap;'>". number_format($rowsales[26], 2, '.', ',') ."</td>
						<td style='text-align: left; width:1%; white-space:nowrap;'>". number_format($rowsales[27], 2, '.', ',') ."</td>
						<td style='text-align: left; width:1%; white-space:nowrap;'>". number_format($rowsales[29], 2, '.', ',') ."</td>
						<td style='text-align: left; width:1%; white-space:nowrap;'>". number_format($rowsales[30], 2, '.', ',') ."</td>
						<td style='text-align: left; width:1%; white-space:nowrap;'>". number_format($rowsales[31], 2, '.', ',') ."</td>
					</tr>";
					$li .= "<li onclick='mall();'>".$row[0]."</li>";

					echo $table . "|" . $li . "|" . $row[0];
				}
		break;

		case 'mallsales':
			$sql = "SELECT mallid, mallname FROM tblref_mall"; 
			$res = mysql_query($sql, $connection);
			while($row = mysql_fetch_array($res)){

			$year = $_POST['year'];
			$month = $_POST['month'];
			$day = $_POST['day'];
			$date1 = $_POST['year']."-".$_POST['month']."-".$_POST['day'];

			if($year == "" && $month == "" && $day == ""){
				$sqlsales = " SELECT tenantid, fdtTrnsctn, SUM(fnmGrndTtlOld), SUM(fnmGrndTtlNew), SUM(fnmGTDlySls), SUM(fnmGTDscnt), SUM(fnmGTDscntSNR), SUM(fnmGTDscntPWD), SUM(fnmGTDscntGPC), SUM(fnmGTDscntVIP), SUM(fnmGTDscntEMP), SUM(fnmGTDscntREG), SUM(fnmGTDscntOTH), SUM(fnmGTRfnd), SUM(fnmGTCncld), SUM(fnmGTSlsVAT), SUM(fnmGTVATSlsInclsv), SUM(fnmGTVATSlsExclsv), SUM(fnmOffclRcptBeg), SUM(fnmOffclRcptEnd), SUM(fnmGTCntDcmnt), SUM(fnmGTCntCstmr), SUM(fnmGTCntSnrCtzn), SUM(fnmGTLclTax), SUM(fnmGTSrvcChrg), SUM(fnmGTSlsNonVat), SUM(fnmGTRwGrss), SUM(fnmGTLclTaxDly), fvcWrksttnNmbr, SUM(fnmGTPymntCSH), SUM(fnmGTPymntCRD), SUM(fnmGTPymntOTH) FROM db_sales WHERE mallid = '". $row[0] ."' ";
			}
			else if($year != "" && $month != "" && $day != ""){
				$sqlsales = " SELECT tenantid, fdtTrnsctn, SUM(fnmGrndTtlOld), SUM(fnmGrndTtlNew), SUM(fnmGTDlySls), SUM(fnmGTDscnt), SUM(fnmGTDscntSNR), SUM(fnmGTDscntPWD), SUM(fnmGTDscntGPC), SUM(fnmGTDscntVIP), SUM(fnmGTDscntEMP), SUM(fnmGTDscntREG), SUM(fnmGTDscntOTH), SUM(fnmGTRfnd), SUM(fnmGTCncld), SUM(fnmGTSlsVAT), SUM(fnmGTVATSlsInclsv), SUM(fnmGTVATSlsExclsv), SUM(fnmOffclRcptBeg), SUM(fnmOffclRcptEnd), SUM(fnmGTCntDcmnt), SUM(fnmGTCntCstmr), SUM(fnmGTCntSnrCtzn), SUM(fnmGTLclTax), SUM(fnmGTSrvcChrg), SUM(fnmGTSlsNonVat), SUM(fnmGTRwGrss), SUM(fnmGTLclTaxDly), fvcWrksttnNmbr, SUM(fnmGTPymntCSH), SUM(fnmGTPymntCRD), SUM(fnmGTPymntOTH) FROM db_sales WHERE mallid = '". $row[0] ."' AND fdtTrnsctn = '". $date1 ."' ";
			}
			else if($year != "" && $month != "" && $day == ""){
				$sqlsales = " SELECT tenantid, fdtTrnsctn, SUM(fnmGrndTtlOld), SUM(fnmGrndTtlNew), SUM(fnmGTDlySls), SUM(fnmGTDscnt), SUM(fnmGTDscntSNR), SUM(fnmGTDscntPWD), SUM(fnmGTDscntGPC), SUM(fnmGTDscntVIP), SUM(fnmGTDscntEMP), SUM(fnmGTDscntREG), SUM(fnmGTDscntOTH), SUM(fnmGTRfnd), SUM(fnmGTCncld), SUM(fnmGTSlsVAT), SUM(fnmGTVATSlsInclsv), SUM(fnmGTVATSlsExclsv), SUM(fnmOffclRcptBeg), SUM(fnmOffclRcptEnd), SUM(fnmGTCntDcmnt), SUM(fnmGTCntCstmr), SUM(fnmGTCntSnrCtzn), SUM(fnmGTLclTax), SUM(fnmGTSrvcChrg), SUM(fnmGTSlsNonVat), SUM(fnmGTRwGrss), SUM(fnmGTLclTaxDly), fvcWrksttnNmbr, SUM(fnmGTPymntCSH), SUM(fnmGTPymntCRD), SUM(fnmGTPymntOTH) FROM db_sales WHERE mallid = '". $row[0] ."' AND YEAR(fdtTrnsctn) = '". $year ."' AND MONTH(fdtTrnsctn) = '". $month ."' ";
			}
			else if($year != "" && $month == "" && $day == ""){
				$sqlsales = " SELECT tenantid, fdtTrnsctn, SUM(fnmGrndTtlOld), SUM(fnmGrndTtlNew), SUM(fnmGTDlySls), SUM(fnmGTDscnt), SUM(fnmGTDscntSNR), SUM(fnmGTDscntPWD), SUM(fnmGTDscntGPC), SUM(fnmGTDscntVIP), SUM(fnmGTDscntEMP), SUM(fnmGTDscntREG), SUM(fnmGTDscntOTH), SUM(fnmGTRfnd), SUM(fnmGTCncld), SUM(fnmGTSlsVAT), SUM(fnmGTVATSlsInclsv), SUM(fnmGTVATSlsExclsv), SUM(fnmOffclRcptBeg), SUM(fnmOffclRcptEnd), SUM(fnmGTCntDcmnt), SUM(fnmGTCntCstmr), SUM(fnmGTCntSnrCtzn), SUM(fnmGTLclTax), SUM(fnmGTSrvcChrg), SUM(fnmGTSlsNonVat), SUM(fnmGTRwGrss), SUM(fnmGTLclTaxDly), fvcWrksttnNmbr, SUM(fnmGTPymntCSH), SUM(fnmGTPymntCRD), SUM(fnmGTPymntOTH) FROM db_sales WHERE mallid = '". $row[0] ."' AND YEAR(fdtTrnsctn) = '". $year ."' ";
			}
			else {
				echo "1";
			}
				$ressales = mysql_query($sqlsales, $connection);
				while($rowsales = mysql_fetch_array($ressales)){
					$table .= "
					<tr style='width: 100%;cursor: pointer !important;' onclick='wingsales(\"".  $row[0] ."\");'>
					    <td style='text-align: left; width:1%; white-space:nowrap;'>". $row[1] ."</td>
						<td style='text-align: left; width:1%; white-space:nowrap;'>". $year ."</td>
						<td style='text-align: left; width:1%; white-space:nowrap;'>". number_format($rowsales[3], 2, '.', ',') ."</td>
						<td style='text-align: left; width:1%; white-space:nowrap;'>". number_format($rowsales[5], 2, '.', ',') ."</td>
						<td style='text-align: left; width:1%; white-space:nowrap;'>". number_format($rowsales[6], 2, '.', ',') ."</td>
						<td style='text-align: left; width:1%; white-space:nowrap;'>". number_format($rowsales[7], 2, '.', ',') ."</td>
						<td style='text-align: left; width:1%; white-space:nowrap;'>". number_format($rowsales[8], 2, '.', ',') ."</td>
						<td style='text-align: left; width:1%; white-space:nowrap;'>". number_format($rowsales[9], 2, '.', ',') ."</td>
						<td style='text-align: left; width:1%; white-space:nowrap;'>". number_format($rowsales[10], 2, '.', ',') ."</td>
						<td style='text-align: left; width:1%; white-space:nowrap;'>". number_format($rowsales[11], 2, '.', ',') ."</td>
						<td style='text-align: left; width:1%; white-space:nowrap;'>". number_format($rowsales[12], 2, '.', ',') ."</td>
						<td style='text-align: left; width:1%; white-space:nowrap;'>". number_format($rowsales[13], 2, '.', ',') ."</td>
						<td style='text-align: left; width:1%; white-space:nowrap;'>". number_format($rowsales[14], 2, '.', ',') ."</td>
						<td style='text-align: left; width:1%; white-space:nowrap;'>". number_format($rowsales[15], 2, '.', ',') ."</td>
						<td style='text-align: left; width:1%; white-space:nowrap;'>". number_format($rowsales[16], 2, '.', ',') ."</td>
						<td style='text-align: left; width:1%; white-space:nowrap;'>". number_format($rowsales[17], 2, '.', ',') ."</td>
						<td style='text-align: left; width:1%; white-space:nowrap;'>". number_format($rowsales[18], 2, '.', ',') ."</td>
						<td style='text-align: left; width:1%; white-space:nowrap;'>". number_format($rowsales[19], 2, '.', ',') ."</td>
						<td style='text-align: left; width:1%; white-space:nowrap;'>". number_format($rowsales[20], 2, '.', ',') ."</td>
						<td style='text-align: left; width:1%; white-space:nowrap;'>". number_format($rowsales[21], 2, '.', ',') ."</td>
						<td style='text-align: left; width:1%; white-space:nowrap;'>". number_format($rowsales[22], 2, '.', ',') ."</td>
						<td style='text-align: left; width:1%; white-space:nowrap;'>". number_format($rowsales[23], 2, '.', ',') ."</td>
						<td style='text-align: left; width:1%; white-space:nowrap;'>". number_format($rowsales[24], 2, '.', ',') ."</td>
						<td style='text-align: left; width:1%; white-space:nowrap;'>". number_format($rowsales[25], 2, '.', ',') ."</td>
						<td style='text-align: left; width:1%; white-space:nowrap;'>". number_format($rowsales[26], 2, '.', ',') ."</td>
						<td style='text-align: left; width:1%; white-space:nowrap;'>". number_format($rowsales[27], 2, '.', ',') ."</td>
						<td style='text-align: left; width:1%; white-space:nowrap;'>". number_format($rowsales[29], 2, '.', ',') ."</td>
						<td style='text-align: left; width:1%; white-space:nowrap;'>". number_format($rowsales[30], 2, '.', ',') ."</td>
						<td style='text-align: left; width:1%; white-space:nowrap;'>". number_format($rowsales[31], 2, '.', ',') ."</td>
					</tr>";
				}
				$mallname .= $row[1];
			}
				echo $table . "|" .$mallname;
		break;

		case 'wingsales':
			$year = $_POST['year'];
			$month = $_POST['month'];
			$day = $_POST['day'];
			$date1 = $_POST['year']."-".$_POST['month']."-".$_POST['day'];

			$sqlmall = " SELECT mallname FROM tblref_mall WHERE mallid = '". $_POST['mallid'] ."' ";
			$resmall = mysql_query($sqlmall, $connection);
			$rowmall = mysql_fetch_array($resmall);

			$sql = " SELECT wingID, wing FROM tblref_wing WHERE mallid = '". $_POST['mallid'] ."' "; 
			$res = mysql_query($sql, $connection);
			while($row = mysql_fetch_array($res)){

						if($year == "" && $month == "" && $day == ""){
							$sqlsales = " SELECT a.unitid, b.unitid, b.mallid, b.tenantid, c.tenantid, c.fdtTrnsctn, SUM(c.fnmGrndTtlOld), SUM(c.fnmGrndTtlNew), SUM(c.fnmGTDlySls), SUM(c.fnmGTDscnt), SUM(c.fnmGTDscntSNR), SUM(c.fnmGTDscntPWD), SUM(c.fnmGTDscntGPC), SUM(c.fnmGTDscntVIP), SUM(c.fnmGTDscntEMP), SUM(c.fnmGTDscntREG), SUM(c.fnmGTDscntOTH), SUM(c.fnmGTRfnd), SUM(c.fnmGTCncld), SUM(c.fnmGTSlsVAT), SUM(c.fnmGTVATSlsInclsv), SUM(c.fnmGTVATSlsExclsv), SUM(c.fnmOffclRcptBeg), SUM(c.fnmOffclRcptEnd), SUM(c.fnmGTCntDcmnt), SUM(c.fnmGTCntCstmr), SUM(c.fnmGTCntSnrCtzn), SUM(c.fnmGTLclTax), SUM(c.fnmGTSrvcChrg), SUM(c.fnmGTSlsNonVat), SUM(c.fnmGTRwGrss), SUM(c.fnmGTLclTaxDly), c.fvcWrksttnNmbr, SUM(c.fnmGTPymntCSH), SUM(c.fnmGTPymntCRD), SUM(c.fnmGTPymntOTH), a.wingid FROM tblref_unit AS a INNER JOIN tbltrans_tenants AS b ON a.unitid = b.unitid INNER JOIN db_sales AS c ON b.tenantid = c.tenantid WHERE a.wingid = '". $row[0] ."'   ";
						}
						else if($year != "" && $month != "" && $day != ""){
							$sqlsales = " SELECT a.unitid, b.unitid, b.mallid, b.tenantid, c.tenantid, c.fdtTrnsctn, SUM(c.fnmGrndTtlOld), SUM(c.fnmGrndTtlNew), SUM(c.fnmGTDlySls), SUM(c.fnmGTDscnt), SUM(c.fnmGTDscntSNR), SUM(c.fnmGTDscntPWD), SUM(c.fnmGTDscntGPC), SUM(c.fnmGTDscntVIP), SUM(c.fnmGTDscntEMP), SUM(c.fnmGTDscntREG), SUM(c.fnmGTDscntOTH), SUM(c.fnmGTRfnd), SUM(c.fnmGTCncld), SUM(c.fnmGTSlsVAT), SUM(c.fnmGTVATSlsInclsv), SUM(c.fnmGTVATSlsExclsv), SUM(c.fnmOffclRcptBeg), SUM(c.fnmOffclRcptEnd), SUM(c.fnmGTCntDcmnt), SUM(c.fnmGTCntCstmr), SUM(c.fnmGTCntSnrCtzn), SUM(c.fnmGTLclTax), SUM(c.fnmGTSrvcChrg), SUM(c.fnmGTSlsNonVat), SUM(c.fnmGTRwGrss), SUM(c.fnmGTLclTaxDly), c.fvcWrksttnNmbr, SUM(c.fnmGTPymntCSH), SUM(c.fnmGTPymntCRD), SUM(c.fnmGTPymntOTH), a.wingid FROM tblref_unit AS a INNER JOIN tbltrans_tenants AS b ON a.unitid = b.unitid INNER JOIN db_sales AS c ON b.tenantid = c.tenantid  WHERE c.fdtTrnsctn = '". $date1 ."' AND a.wingid = '". $row[0] ."' ";
						}
						else if($year != "" && $month != "" && $day == ""){
							$sqlsales = " SELECT a.unitid, b.unitid, b.mallid, b.tenantid, c.tenantid, c.fdtTrnsctn, SUM(c.fnmGrndTtlOld), SUM(c.fnmGrndTtlNew), SUM(c.fnmGTDlySls), SUM(c.fnmGTDscnt), SUM(c.fnmGTDscntSNR), SUM(c.fnmGTDscntPWD), SUM(c.fnmGTDscntGPC), SUM(c.fnmGTDscntVIP), SUM(c.fnmGTDscntEMP), SUM(c.fnmGTDscntREG), SUM(c.fnmGTDscntOTH), SUM(c.fnmGTRfnd), SUM(c.fnmGTCncld), SUM(c.fnmGTSlsVAT), SUM(c.fnmGTVATSlsInclsv), SUM(c.fnmGTVATSlsExclsv), SUM(c.fnmOffclRcptBeg), SUM(c.fnmOffclRcptEnd), SUM(c.fnmGTCntDcmnt), SUM(c.fnmGTCntCstmr), SUM(c.fnmGTCntSnrCtzn), SUM(c.fnmGTLclTax), SUM(c.fnmGTSrvcChrg), SUM(c.fnmGTSlsNonVat), SUM(c.fnmGTRwGrss), SUM(c.fnmGTLclTaxDly), c.fvcWrksttnNmbr, SUM(c.fnmGTPymntCSH), SUM(c.fnmGTPymntCRD), SUM(c.fnmGTPymntOTH), a.wingid FROM tblref_unit AS a INNER JOIN tbltrans_tenants AS b ON a.unitid = b.unitid INNER JOIN db_sales AS c ON b.tenantid = c.tenantid  WHERE YEAR(c.fdtTrnsctn) = '". $year ."' AND MONTH(c.fdtTrnsctn) = '". $month ."' AND a.wingid = '". $row[0] ."' ";
						}
						else if($year != "" && $month == "" && $day == ""){
							$sqlsales = " SELECT a.unitid, b.unitid, b.mallid, b.tenantid, c.tenantid, c.fdtTrnsctn, SUM(c.fnmGrndTtlOld), SUM(c.fnmGrndTtlNew), SUM(c.fnmGTDlySls), SUM(c.fnmGTDscnt), SUM(c.fnmGTDscntSNR), SUM(c.fnmGTDscntPWD), SUM(c.fnmGTDscntGPC), SUM(c.fnmGTDscntVIP), SUM(c.fnmGTDscntEMP), SUM(c.fnmGTDscntREG), SUM(c.fnmGTDscntOTH), SUM(c.fnmGTRfnd), SUM(c.fnmGTCncld), SUM(c.fnmGTSlsVAT), SUM(c.fnmGTVATSlsInclsv), SUM(c.fnmGTVATSlsExclsv), SUM(c.fnmOffclRcptBeg), SUM(c.fnmOffclRcptEnd), SUM(c.fnmGTCntDcmnt), SUM(c.fnmGTCntCstmr), SUM(c.fnmGTCntSnrCtzn), SUM(c.fnmGTLclTax), SUM(c.fnmGTSrvcChrg), SUM(c.fnmGTSlsNonVat), SUM(c.fnmGTRwGrss), SUM(c.fnmGTLclTaxDly), c.fvcWrksttnNmbr, SUM(c.fnmGTPymntCSH), SUM(c.fnmGTPymntCRD), SUM(c.fnmGTPymntOTH), a.wingid FROM tblref_unit AS a INNER JOIN tbltrans_tenants AS b ON a.unitid = b.unitid INNER JOIN db_sales AS c ON b.tenantid = c.tenantid  WHERE YEAR(c.fdtTrnsctn) = '". $year ."' AND a.wingid = '". $row[0] ."' ";
						}
						else {
							echo "1";
						}

						$ressales = mysql_query($sqlsales, $connection);
						while($rowsales = mysql_fetch_array($ressales)){
				
					$table .= "
					<tr style='width: 100%;cursor: pointer !important;' onclick='floorsales(\"".  $row[0] ."\");'>
					    <td style='text-align: left; width:1%; white-space:nowrap;'>". $row[1] ."</td>
						<td style='text-align: left; width:1%; white-space:nowrap;'>". $year ."</td>
						<td style='text-align: left; width:1%; white-space:nowrap;'>". number_format($rowsales[7], 2, '.', ',') ."</td>
						<td style='text-align: left; width:1%; white-space:nowrap;'>". number_format($rowsales[9], 2, '.', ',') ."</td>
						<td style='text-align: left; width:1%; white-space:nowrap;'>". number_format($rowsales[10], 2, '.', ',') ."</td>
						<td style='text-align: left; width:1%; white-space:nowrap;'>". number_format($rowsales[11], 2, '.', ',') ."</td>
						<td style='text-align: left; width:1%; white-space:nowrap;'>". number_format($rowsales[12], 2, '.', ',') ."</td>
						<td style='text-align: left; width:1%; white-space:nowrap;'>". number_format($rowsales[13], 2, '.', ',') ."</td>
						<td style='text-align: left; width:1%; white-space:nowrap;'>". number_format($rowsales[15], 2, '.', ',') ."</td>
						<td style='text-align: left; width:1%; white-space:nowrap;'>". number_format($rowsales[16], 2, '.', ',') ."</td>
						<td style='text-align: left; width:1%; white-space:nowrap;'>". number_format($rowsales[17], 2, '.', ',') ."</td>
						<td style='text-align: left; width:1%; white-space:nowrap;'>". number_format($rowsales[18], 2, '.', ',') ."</td>
						<td style='text-align: left; width:1%; white-space:nowrap;'>". number_format($rowsales[19], 2, '.', ',') ."</td>
						<td style='text-align: left; width:1%; white-space:nowrap;'>". number_format($rowsales[20], 2, '.', ',') ."</td>
						<td style='text-align: left; width:1%; white-space:nowrap;'>". number_format($rowsales[21], 2, '.', ',') ."</td>
						<td style='text-align: left; width:1%; white-space:nowrap;'>". number_format($rowsales[22], 2, '.', ',') ."</td>
						<td style='text-align: left; width:1%; white-space:nowrap;'>". number_format($rowsales[23], 2, '.', ',') ."</td>
						<td style='text-align: left; width:1%; white-space:nowrap;'>". number_format($rowsales[24], 2, '.', ',') ."</td>
						<td style='text-align: left; width:1%; white-space:nowrap;'>". number_format($rowsales[25], 2, '.', ',') ."</td>
						<td style='text-align: left; width:1%; white-space:nowrap;'>". number_format($rowsales[26], 2, '.', ',') ."</td>
						<td style='text-align: left; width:1%; white-space:nowrap;'>". number_format($rowsales[27], 2, '.', ',') ."</td>
						<td style='text-align: left; width:1%; white-space:nowrap;'>". number_format($rowsales[28], 2, '.', ',') ."</td>
						<td style='text-align: left; width:1%; white-space:nowrap;'>". number_format($rowsales[29], 2, '.', ',') ."</td>
						<td style='text-align: left; width:1%; white-space:nowrap;'>". number_format($rowsales[30], 2, '.', ',') ."</td>
						<td style='text-align: left; width:1%; white-space:nowrap;'>". number_format($rowsales[31], 2, '.', ',') ."</td>
						<td style='text-align: left; width:1%; white-space:nowrap;'>". number_format($rowsales[32], 2, '.', ',') ."</td>
						<td style='text-align: left; width:1%; white-space:nowrap;'>". number_format($rowsales[33], 2, '.', ',') ."</td>
						<td style='text-align: left; width:1%; white-space:nowrap;'>". number_format($rowsales[34], 2, '.', ',') ."</td>
						<td style='text-align: left; width:1%; white-space:nowrap;'>". number_format($rowsales[35], 2, '.', ',') ."</td>
					</tr>";
					}
			}
				echo $table . "|" . $rowmall[0];
		break;

		case 'floorsales':
			$year = $_POST['year'];
			$month = $_POST['month'];
			$day = $_POST['day'];
			$date1 = $_POST['year']."-".$_POST['month']."-".$_POST['day'];

			$sqlwing = " SELECT wing FROM tblref_wing WHERE mallid = '". $_POST['mallid'] ."' AND wingid = '". $_POST['wingid'] ."' ";
			$reswing = mysql_query($sqlwing, $connection);
			$rowwing = mysql_fetch_array($reswing);

			$sql = " SELECT floorid, floor FROM tblref_floorsetup WHERE mallid = '". $_POST['mallid'] ."' AND  wingid = '". $_POST['wingid'] ."' "; 
			$res = mysql_query($sql, $connection);
			while($row = mysql_fetch_array($res)){

			

			if($year == "" && $month == "" && $day == ""){
				$sqlsales = " SELECT a.unitid, b.unitid, b.mallid, b.tenantid, c.tenantid, c.fdtTrnsctn, SUM(c.fnmGrndTtlOld), SUM(c.fnmGrndTtlNew), SUM(c.fnmGTDlySls), SUM(c.fnmGTDscnt), SUM(c.fnmGTDscntSNR), SUM(c.fnmGTDscntPWD), SUM(c.fnmGTDscntGPC), SUM(c.fnmGTDscntVIP), SUM(c.fnmGTDscntEMP), SUM(c.fnmGTDscntREG), SUM(c.fnmGTDscntOTH), SUM(c.fnmGTRfnd), SUM(c.fnmGTCncld), SUM(c.fnmGTSlsVAT), SUM(c.fnmGTVATSlsInclsv), SUM(c.fnmGTVATSlsExclsv), SUM(c.fnmOffclRcptBeg), SUM(c.fnmOffclRcptEnd), SUM(c.fnmGTCntDcmnt), SUM(c.fnmGTCntCstmr), SUM(c.fnmGTCntSnrCtzn), SUM(c.fnmGTLclTax), SUM(c.fnmGTSrvcChrg), SUM(c.fnmGTSlsNonVat), SUM(c.fnmGTRwGrss), SUM(c.fnmGTLclTaxDly), c.fvcWrksttnNmbr, SUM(c.fnmGTPymntCSH), SUM(c.fnmGTPymntCRD), SUM(c.fnmGTPymntOTH), a.wingid, a.floorid FROM tblref_unit AS a INNER JOIN tbltrans_tenants AS b ON a.unitid = b.unitid INNER JOIN db_sales AS c ON b.tenantid = c.tenantid WHERE a.wingid = '". $_POST['wingid'] ."' AND a.floorid = '". $row[0] ."' ";
			}
			else if($year != "" && $month != "" && $day != ""){
				$sqlsales = " SELECT a.unitid, b.unitid, b.mallid, b.tenantid, c.tenantid, c.fdtTrnsctn, SUM(c.fnmGrndTtlOld), SUM(c.fnmGrndTtlNew), SUM(c.fnmGTDlySls), SUM(c.fnmGTDscnt), SUM(c.fnmGTDscntSNR), SUM(c.fnmGTDscntPWD), SUM(c.fnmGTDscntGPC), SUM(c.fnmGTDscntVIP), SUM(c.fnmGTDscntEMP), SUM(c.fnmGTDscntREG), SUM(c.fnmGTDscntOTH), SUM(c.fnmGTRfnd), SUM(c.fnmGTCncld), SUM(c.fnmGTSlsVAT), SUM(c.fnmGTVATSlsInclsv), SUM(c.fnmGTVATSlsExclsv), SUM(c.fnmOffclRcptBeg), SUM(c.fnmOffclRcptEnd), SUM(c.fnmGTCntDcmnt), SUM(c.fnmGTCntCstmr), SUM(c.fnmGTCntSnrCtzn), SUM(c.fnmGTLclTax), SUM(c.fnmGTSrvcChrg), SUM(c.fnmGTSlsNonVat), SUM(c.fnmGTRwGrss), SUM(c.fnmGTLclTaxDly), c.fvcWrksttnNmbr, SUM(c.fnmGTPymntCSH), SUM(c.fnmGTPymntCRD), SUM(c.fnmGTPymntOTH), a.wingid, a.floorid FROM tblref_unit AS a INNER JOIN tbltrans_tenants AS b ON a.unitid = b.unitid INNER JOIN db_sales AS c ON b.tenantid = c.tenantid WHERE c.fdtTrnsctn = '". $date1 ."' AND a.wingid = '". $_POST['wingid'] ."' AND a.floorid = '". $row[0] ."' ";
			}
			else if($year != "" && $month != "" && $day == ""){
				$sqlsales = " SELECT a.unitid, b.unitid, b.mallid, b.tenantid, c.tenantid, c.fdtTrnsctn, SUM(c.fnmGrndTtlOld), SUM(c.fnmGrndTtlNew), SUM(c.fnmGTDlySls), SUM(c.fnmGTDscnt), SUM(c.fnmGTDscntSNR), SUM(c.fnmGTDscntPWD), SUM(c.fnmGTDscntGPC), SUM(c.fnmGTDscntVIP), SUM(c.fnmGTDscntEMP), SUM(c.fnmGTDscntREG), SUM(c.fnmGTDscntOTH), SUM(c.fnmGTRfnd), SUM(c.fnmGTCncld), SUM(c.fnmGTSlsVAT), SUM(c.fnmGTVATSlsInclsv), SUM(c.fnmGTVATSlsExclsv), SUM(c.fnmOffclRcptBeg), SUM(c.fnmOffclRcptEnd), SUM(c.fnmGTCntDcmnt), SUM(c.fnmGTCntCstmr), SUM(c.fnmGTCntSnrCtzn), SUM(c.fnmGTLclTax), SUM(c.fnmGTSrvcChrg), SUM(c.fnmGTSlsNonVat), SUM(c.fnmGTRwGrss), SUM(c.fnmGTLclTaxDly), c.fvcWrksttnNmbr, SUM(c.fnmGTPymntCSH), SUM(c.fnmGTPymntCRD), SUM(c.fnmGTPymntOTH), a.wingid, a.floorid FROM tblref_unit AS a INNER JOIN tbltrans_tenants AS b ON a.unitid = b.unitid INNER JOIN db_sales AS c ON b.tenantid = c.tenantid WHERE YEAR(c.fdtTrnsctn) = '". $year ."' AND MONTH(c.fdtTrnsctn) = '". $month ."' AND a.wingid = '". $_POST['wingid'] ."' AND a.floorid = '". $row[0] ."' ";
			}
			else if($year != "" && $month == "" && $day == ""){
				$sqlsales = " SELECT a.unitid, b.unitid, b.mallid, b.tenantid, c.tenantid, c.fdtTrnsctn, SUM(c.fnmGrndTtlOld), SUM(c.fnmGrndTtlNew), SUM(c.fnmGTDlySls), SUM(c.fnmGTDscnt), SUM(c.fnmGTDscntSNR), SUM(c.fnmGTDscntPWD), SUM(c.fnmGTDscntGPC), SUM(c.fnmGTDscntVIP), SUM(c.fnmGTDscntEMP), SUM(c.fnmGTDscntREG), SUM(c.fnmGTDscntOTH), SUM(c.fnmGTRfnd), SUM(c.fnmGTCncld), SUM(c.fnmGTSlsVAT), SUM(c.fnmGTVATSlsInclsv), SUM(c.fnmGTVATSlsExclsv), SUM(c.fnmOffclRcptBeg), SUM(c.fnmOffclRcptEnd), SUM(c.fnmGTCntDcmnt), SUM(c.fnmGTCntCstmr), SUM(c.fnmGTCntSnrCtzn), SUM(c.fnmGTLclTax), SUM(c.fnmGTSrvcChrg), SUM(c.fnmGTSlsNonVat), SUM(c.fnmGTRwGrss), SUM(c.fnmGTLclTaxDly), c.fvcWrksttnNmbr, SUM(c.fnmGTPymntCSH), SUM(c.fnmGTPymntCRD), SUM(c.fnmGTPymntOTH), a.wingid, a.floorid FROM tblref_unit AS a INNER JOIN tbltrans_tenants AS b ON a.unitid = b.unitid INNER JOIN db_sales AS c ON b.tenantid = c.tenantid  WHERE YEAR(c.fdtTrnsctn) = '". $year ."' AND a.wingid = '". $_POST['wingid'] ."' AND a.floorid = '". $row[0] ."' ";
			}
			else {
				echo "1";
			}
				$ressales = mysql_query($sqlsales, $connection);
				while($rowsales = mysql_fetch_array($ressales)){
					$table .= "
					<tr style='width: 100%;cursor: pointer !important;' onclick='unittypesales(\"".  $row[0] ."\");'>
					    <td style='text-align: left; width:1%; white-space:nowrap;'>". $row[1] ."</td>
						<td style='text-align: left; width:1%; white-space:nowrap;'>". $year ."</td>
						<td style='text-align: left; width:1%; white-space:nowrap;'>". number_format($rowsales[7], 2, '.', ',') ."</td>
						<td style='text-align: left; width:1%; white-space:nowrap;'>". number_format($rowsales[9], 2, '.', ',') ."</td>
						<td style='text-align: left; width:1%; white-space:nowrap;'>". number_format($rowsales[10], 2, '.', ',') ."</td>
						<td style='text-align: left; width:1%; white-space:nowrap;'>". number_format($rowsales[11], 2, '.', ',') ."</td>
						<td style='text-align: left; width:1%; white-space:nowrap;'>". number_format($rowsales[12], 2, '.', ',') ."</td>
						<td style='text-align: left; width:1%; white-space:nowrap;'>". number_format($rowsales[13], 2, '.', ',') ."</td>
						<td style='text-align: left; width:1%; white-space:nowrap;'>". number_format($rowsales[15], 2, '.', ',') ."</td>
						<td style='text-align: left; width:1%; white-space:nowrap;'>". number_format($rowsales[16], 2, '.', ',') ."</td>
						<td style='text-align: left; width:1%; white-space:nowrap;'>". number_format($rowsales[17], 2, '.', ',') ."</td>
						<td style='text-align: left; width:1%; white-space:nowrap;'>". number_format($rowsales[18], 2, '.', ',') ."</td>
						<td style='text-align: left; width:1%; white-space:nowrap;'>". number_format($rowsales[19], 2, '.', ',') ."</td>
						<td style='text-align: left; width:1%; white-space:nowrap;'>". number_format($rowsales[20], 2, '.', ',') ."</td>
						<td style='text-align: left; width:1%; white-space:nowrap;'>". number_format($rowsales[21], 2, '.', ',') ."</td>
						<td style='text-align: left; width:1%; white-space:nowrap;'>". number_format($rowsales[22], 2, '.', ',') ."</td>
						<td style='text-align: left; width:1%; white-space:nowrap;'>". number_format($rowsales[23], 2, '.', ',') ."</td>
						<td style='text-align: left; width:1%; white-space:nowrap;'>". number_format($rowsales[24], 2, '.', ',') ."</td>
						<td style='text-align: left; width:1%; white-space:nowrap;'>". number_format($rowsales[25], 2, '.', ',') ."</td>
						<td style='text-align: left; width:1%; white-space:nowrap;'>". number_format($rowsales[26], 2, '.', ',') ."</td>
						<td style='text-align: left; width:1%; white-space:nowrap;'>". number_format($rowsales[27], 2, '.', ',') ."</td>
						<td style='text-align: left; width:1%; white-space:nowrap;'>". number_format($rowsales[28], 2, '.', ',') ."</td>
						<td style='text-align: left; width:1%; white-space:nowrap;'>". number_format($rowsales[29], 2, '.', ',') ."</td>
						<td style='text-align: left; width:1%; white-space:nowrap;'>". number_format($rowsales[30], 2, '.', ',') ."</td>
						<td style='text-align: left; width:1%; white-space:nowrap;'>". number_format($rowsales[31], 2, '.', ',') ."</td>
						<td style='text-align: left; width:1%; white-space:nowrap;'>". number_format($rowsales[32], 2, '.', ',') ."</td>
						<td style='text-align: left; width:1%; white-space:nowrap;'>". number_format($rowsales[33], 2, '.', ',') ."</td>
						<td style='text-align: left; width:1%; white-space:nowrap;'>". number_format($rowsales[34], 2, '.', ',') ."</td>
						<td style='text-align: left; width:1%; white-space:nowrap;'>". number_format($rowsales[35], 2, '.', ',') ."</td>
					</tr>";
				}
			}
				echo $table . "|" . $rowwing[0];
		break;

		case 'unittypesales':
			$sqlfloor = " SELECT floor FROM tblref_floorsetup WHERE mallid = '". $_POST['mallid'] ."' AND wingid = '". $_POST['wingid'] ."' AND floorid = '". $_POST['floorid'] ."' ";
			$resfloor = mysql_query($sqlfloor, $connection);
			$rowfloor = mysql_fetch_array($resfloor);

			$sql = " SELECT DISTINCT(typeofbusiness) FROM tblref_unit WHERE mallid = '". $_POST['mallid'] ."' AND wingid = '". $_POST['wingid'] ."' AND floorid = '". $_POST['floorid'] ."' "; 
			$res = mysql_query($sql, $connection);
			while($row = mysql_fetch_array($res)){

			$year = $_POST['year'];
			$month = $_POST['month'];
			$day = $_POST['day'];
			$date1 = $_POST['year']."-".$_POST['month']."-".$_POST['day'];

			if($year == "" && $month == "" && $day == ""){
				$sqlsales = " SELECT a.unitid, b.unitid, b.mallid, b.tenantid, c.tenantid, c.fdtTrnsctn, SUM(c.fnmGrndTtlOld), SUM(c.fnmGrndTtlNew), SUM(c.fnmGTDlySls), SUM(c.fnmGTDscnt), SUM(c.fnmGTDscntSNR), SUM(c.fnmGTDscntPWD), SUM(c.fnmGTDscntGPC), SUM(c.fnmGTDscntVIP), SUM(c.fnmGTDscntEMP), SUM(c.fnmGTDscntREG), SUM(c.fnmGTDscntOTH), SUM(c.fnmGTRfnd), SUM(c.fnmGTCncld), SUM(c.fnmGTSlsVAT), SUM(c.fnmGTVATSlsInclsv), SUM(c.fnmGTVATSlsExclsv), SUM(c.fnmOffclRcptBeg), SUM(c.fnmOffclRcptEnd), SUM(c.fnmGTCntDcmnt), SUM(c.fnmGTCntCstmr), SUM(c.fnmGTCntSnrCtzn), SUM(c.fnmGTLclTax), SUM(c.fnmGTSrvcChrg), SUM(c.fnmGTSlsNonVat), SUM(c.fnmGTRwGrss), SUM(c.fnmGTLclTaxDly), c.fvcWrksttnNmbr, SUM(c.fnmGTPymntCSH), SUM(c.fnmGTPymntCRD), SUM(c.fnmGTPymntOTH), a.wingid, a.floorid, a.typeofbusiness FROM tblref_unit AS a INNER JOIN tbltrans_tenants AS b ON a.unitid = b.unitid INNER JOIN db_sales AS c ON b.tenantid = c.tenantid WHERE a.wingid = '". $_POST['wingid'] ."' AND a.floorid = '". $_POST['floorid'] ."'  and a.typeofbusiness = '". $row[0] ."' ";
			}
			else if($year != "" && $month != "" && $day != ""){
				$sqlsales = " SELECT a.unitid, b.unitid, b.mallid, b.tenantid, c.tenantid, c.fdtTrnsctn, SUM(c.fnmGrndTtlOld), SUM(c.fnmGrndTtlNew), SUM(c.fnmGTDlySls), SUM(c.fnmGTDscnt), SUM(c.fnmGTDscntSNR), SUM(c.fnmGTDscntPWD), SUM(c.fnmGTDscntGPC), SUM(c.fnmGTDscntVIP), SUM(c.fnmGTDscntEMP), SUM(c.fnmGTDscntREG), SUM(c.fnmGTDscntOTH), SUM(c.fnmGTRfnd), SUM(c.fnmGTCncld), SUM(c.fnmGTSlsVAT), SUM(c.fnmGTVATSlsInclsv), SUM(c.fnmGTVATSlsExclsv), SUM(c.fnmOffclRcptBeg), SUM(c.fnmOffclRcptEnd), SUM(c.fnmGTCntDcmnt), SUM(c.fnmGTCntCstmr), SUM(c.fnmGTCntSnrCtzn), SUM(c.fnmGTLclTax), SUM(c.fnmGTSrvcChrg), SUM(c.fnmGTSlsNonVat), SUM(c.fnmGTRwGrss), SUM(c.fnmGTLclTaxDly), c.fvcWrksttnNmbr, SUM(c.fnmGTPymntCSH), SUM(c.fnmGTPymntCRD), SUM(c.fnmGTPymntOTH), a.wingid, a.floorid, a.typeofbusiness FROM tblref_unit AS a INNER JOIN tbltrans_tenants AS b ON a.unitid = b.unitid INNER JOIN db_sales AS c ON b.tenantid = c.tenantid WHERE c.fdtTrnsctn = '". $date1 ."' AND a.wingid = '". $_POST['wingid'] ."' AND a.floorid = '". $_POST['floorid'] ."' and a.typeofbusiness = '". $row[0] ."'  ";
			}
			else if($year != "" && $month != "" && $day == ""){
				$sqlsales = " SELECT a.unitid, b.unitid, b.mallid, b.tenantid, c.tenantid, c.fdtTrnsctn, SUM(c.fnmGrndTtlOld), SUM(c.fnmGrndTtlNew), SUM(c.fnmGTDlySls), SUM(c.fnmGTDscnt), SUM(c.fnmGTDscntSNR), SUM(c.fnmGTDscntPWD), SUM(c.fnmGTDscntGPC), SUM(c.fnmGTDscntVIP), SUM(c.fnmGTDscntEMP), SUM(c.fnmGTDscntREG), SUM(c.fnmGTDscntOTH), SUM(c.fnmGTRfnd), SUM(c.fnmGTCncld), SUM(c.fnmGTSlsVAT), SUM(c.fnmGTVATSlsInclsv), SUM(c.fnmGTVATSlsExclsv), SUM(c.fnmOffclRcptBeg), SUM(c.fnmOffclRcptEnd), SUM(c.fnmGTCntDcmnt), SUM(c.fnmGTCntCstmr), SUM(c.fnmGTCntSnrCtzn), SUM(c.fnmGTLclTax), SUM(c.fnmGTSrvcChrg), SUM(c.fnmGTSlsNonVat), SUM(c.fnmGTRwGrss), SUM(c.fnmGTLclTaxDly), c.fvcWrksttnNmbr, SUM(c.fnmGTPymntCSH), SUM(c.fnmGTPymntCRD), SUM(c.fnmGTPymntOTH), a.wingid, a.floorid, a.typeofbusiness FROM tblref_unit AS a INNER JOIN tbltrans_tenants AS b ON a.unitid = b.unitid INNER JOIN db_sales AS c ON b.tenantid = c.tenantid WHERE YEAR(c.fdtTrnsctn) = '". $year ."' AND MONTH(c.fdtTrnsctn) = '". $month ."' AND a.wingid = '". $_POST['wingid'] ."' AND a.floorid = '". $_POST['floorid'] ."' and a.typeofbusiness = '". $row[0] ."'  ";
			}
			else if($year != "" && $month == "" && $day == ""){
				$sqlsales = " SELECT a.unitid, b.unitid, b.mallid, b.tenantid, c.tenantid, c.fdtTrnsctn, SUM(c.fnmGrndTtlOld), SUM(c.fnmGrndTtlNew), SUM(c.fnmGTDlySls), SUM(c.fnmGTDscnt), SUM(c.fnmGTDscntSNR), SUM(c.fnmGTDscntPWD), SUM(c.fnmGTDscntGPC), SUM(c.fnmGTDscntVIP), SUM(c.fnmGTDscntEMP), SUM(c.fnmGTDscntREG), SUM(c.fnmGTDscntOTH), SUM(c.fnmGTRfnd), SUM(c.fnmGTCncld), SUM(c.fnmGTSlsVAT), SUM(c.fnmGTVATSlsInclsv), SUM(c.fnmGTVATSlsExclsv), SUM(c.fnmOffclRcptBeg), SUM(c.fnmOffclRcptEnd), SUM(c.fnmGTCntDcmnt), SUM(c.fnmGTCntCstmr), SUM(c.fnmGTCntSnrCtzn), SUM(c.fnmGTLclTax), SUM(c.fnmGTSrvcChrg), SUM(c.fnmGTSlsNonVat), SUM(c.fnmGTRwGrss), SUM(c.fnmGTLclTaxDly), c.fvcWrksttnNmbr, SUM(c.fnmGTPymntCSH), SUM(c.fnmGTPymntCRD), SUM(c.fnmGTPymntOTH), a.wingid, a.floorid, a.typeofbusiness FROM tblref_unit AS a INNER JOIN tbltrans_tenants AS b ON a.unitid = b.unitid INNER JOIN db_sales AS c ON b.tenantid = c.tenantid  WHERE YEAR(c.fdtTrnsctn) = '". $year ."' AND a.wingid = '". $_POST['wingid'] ."' AND a.floorid = '". $_POST['floorid'] ."' and a.typeofbusiness = '". $row[0] ."'  ";
			}
			else {
				echo "1";
			}
				$ressales = mysql_query($sqlsales, $connection);
				while($rowsales = mysql_fetch_array($ressales)){
					$table .= "
					<tr style='width: 100%;cursor: pointer !important;' onclick='unitsales(\"".  $row[0] ."\");'>
					    <td style='text-align: left; width:1%; white-space:nowrap;'>". $row[0] ."</td>
						<td style='text-align: left; width:1%; white-space:nowrap;'>". $year ."</td>
						<td style='text-align: left; width:1%; white-space:nowrap;'>". number_format($rowsales[7], 2, '.', ',') ."</td>
						<td style='text-align: left; width:1%; white-space:nowrap;'>". number_format($rowsales[9], 2, '.', ',') ."</td>
						<td style='text-align: left; width:1%; white-space:nowrap;'>". number_format($rowsales[10], 2, '.', ',') ."</td>
						<td style='text-align: left; width:1%; white-space:nowrap;'>". number_format($rowsales[11], 2, '.', ',') ."</td>
						<td style='text-align: left; width:1%; white-space:nowrap;'>". number_format($rowsales[12], 2, '.', ',') ."</td>
						<td style='text-align: left; width:1%; white-space:nowrap;'>". number_format($rowsales[13], 2, '.', ',') ."</td>
						<td style='text-align: left; width:1%; white-space:nowrap;'>". number_format($rowsales[15], 2, '.', ',') ."</td>
						<td style='text-align: left; width:1%; white-space:nowrap;'>". number_format($rowsales[16], 2, '.', ',') ."</td>
						<td style='text-align: left; width:1%; white-space:nowrap;'>". number_format($rowsales[17], 2, '.', ',') ."</td>
						<td style='text-align: left; width:1%; white-space:nowrap;'>". number_format($rowsales[18], 2, '.', ',') ."</td>
						<td style='text-align: left; width:1%; white-space:nowrap;'>". number_format($rowsales[19], 2, '.', ',') ."</td>
						<td style='text-align: left; width:1%; white-space:nowrap;'>". number_format($rowsales[20], 2, '.', ',') ."</td>
						<td style='text-align: left; width:1%; white-space:nowrap;'>". number_format($rowsales[21], 2, '.', ',') ."</td>
						<td style='text-align: left; width:1%; white-space:nowrap;'>". number_format($rowsales[22], 2, '.', ',') ."</td>
						<td style='text-align: left; width:1%; white-space:nowrap;'>". number_format($rowsales[23], 2, '.', ',') ."</td>
						<td style='text-align: left; width:1%; white-space:nowrap;'>". number_format($rowsales[24], 2, '.', ',') ."</td>
						<td style='text-align: left; width:1%; white-space:nowrap;'>". number_format($rowsales[25], 2, '.', ',') ."</td>
						<td style='text-align: left; width:1%; white-space:nowrap;'>". number_format($rowsales[26], 2, '.', ',') ."</td>
						<td style='text-align: left; width:1%; white-space:nowrap;'>". number_format($rowsales[27], 2, '.', ',') ."</td>
						<td style='text-align: left; width:1%; white-space:nowrap;'>". number_format($rowsales[28], 2, '.', ',') ."</td>
						<td style='text-align: left; width:1%; white-space:nowrap;'>". number_format($rowsales[29], 2, '.', ',') ."</td>
						<td style='text-align: left; width:1%; white-space:nowrap;'>". number_format($rowsales[30], 2, '.', ',') ."</td>
						<td style='text-align: left; width:1%; white-space:nowrap;'>". number_format($rowsales[31], 2, '.', ',') ."</td>
						<td style='text-align: left; width:1%; white-space:nowrap;'>". number_format($rowsales[32], 2, '.', ',') ."</td>
						<td style='text-align: left; width:1%; white-space:nowrap;'>". number_format($rowsales[33], 2, '.', ',') ."</td>
						<td style='text-align: left; width:1%; white-space:nowrap;'>". number_format($rowsales[34], 2, '.', ',') ."</td>
						<td style='text-align: left; width:1%; white-space:nowrap;'>". number_format($rowsales[35], 2, '.', ',') ."</td>
					</tr>";
				}
			}
				echo $table . "|" . $rowfloor[0];
		break;

		case 'unitsales':
			$sqlunittype = " SELECT DISTINCT(typeofbusiness) FROM tblref_unit WHERE mallid = '". $_POST['mallid'] ."' AND wingid = '". $_POST['wingid'] ."' AND floorid = '". $_POST['floorid'] ."' ";
			$resunittype = mysql_query($sqlunittype);
			$rowunittype = mysql_fetch_array($resunittype);

			$sql = " SELECT unitid, unitname FROM tblref_unit WHERE mallid = '". $_POST['mallid'] ."' AND wingid = '". $_POST['wingid'] ."' AND floorid = '". $_POST['floorid'] ."' AND typeofbusiness = '". $_POST['unittype'] ."' "; 
			$res = mysql_query($sql, $connection);
			while($row = mysql_fetch_array($res)){

			$year = $_POST['year'];
			$month = $_POST['month'];
			$day = $_POST['day'];
			$date1 = $_POST['year']."-".$_POST['month']."-".$_POST['day'];

			if($year == "" && $month == "" && $day == ""){
				$sqlsales = " SELECT a.unitid, b.unitid, b.mallid, b.tenantid, c.tenantid, c.fdtTrnsctn, SUM(c.fnmGrndTtlOld), SUM(c.fnmGrndTtlNew), SUM(c.fnmGTDlySls), SUM(c.fnmGTDscnt), SUM(c.fnmGTDscntSNR), SUM(c.fnmGTDscntPWD), SUM(c.fnmGTDscntGPC), SUM(c.fnmGTDscntVIP), SUM(c.fnmGTDscntEMP), SUM(c.fnmGTDscntREG), SUM(c.fnmGTDscntOTH), SUM(c.fnmGTRfnd), SUM(c.fnmGTCncld), SUM(c.fnmGTSlsVAT), SUM(c.fnmGTVATSlsInclsv), SUM(c.fnmGTVATSlsExclsv), SUM(c.fnmOffclRcptBeg), SUM(c.fnmOffclRcptEnd), SUM(c.fnmGTCntDcmnt), SUM(c.fnmGTCntCstmr), SUM(c.fnmGTCntSnrCtzn), SUM(c.fnmGTLclTax), SUM(c.fnmGTSrvcChrg), SUM(c.fnmGTSlsNonVat), SUM(c.fnmGTRwGrss), SUM(c.fnmGTLclTaxDly), c.fvcWrksttnNmbr, SUM(c.fnmGTPymntCSH), SUM(c.fnmGTPymntCRD), SUM(c.fnmGTPymntOTH), a.wingid, a.floorid, a.typeofbusiness FROM tblref_unit AS a INNER JOIN tbltrans_tenants AS b ON a.unitid = b.unitid INNER JOIN db_sales AS c ON b.tenantid = c.tenantid WHERE a.wingid = '". $_POST['wingid'] ."' AND a.floorid = '". $_POST['floorid'] ."'  and a.typeofbusiness = '". $_POST['unittype'] ."' AND a.unitid = '". $row[0] ."'  ";
			}
			else if($year != "" && $month != "" && $day != ""){
				$sqlsales = " SELECT a.unitid, b.unitid, b.mallid, b.tenantid, c.tenantid, c.fdtTrnsctn, SUM(c.fnmGrndTtlOld), SUM(c.fnmGrndTtlNew), SUM(c.fnmGTDlySls), SUM(c.fnmGTDscnt), SUM(c.fnmGTDscntSNR), SUM(c.fnmGTDscntPWD), SUM(c.fnmGTDscntGPC), SUM(c.fnmGTDscntVIP), SUM(c.fnmGTDscntEMP), SUM(c.fnmGTDscntREG), SUM(c.fnmGTDscntOTH), SUM(c.fnmGTRfnd), SUM(c.fnmGTCncld), SUM(c.fnmGTSlsVAT), SUM(c.fnmGTVATSlsInclsv), SUM(c.fnmGTVATSlsExclsv), SUM(c.fnmOffclRcptBeg), SUM(c.fnmOffclRcptEnd), SUM(c.fnmGTCntDcmnt), SUM(c.fnmGTCntCstmr), SUM(c.fnmGTCntSnrCtzn), SUM(c.fnmGTLclTax), SUM(c.fnmGTSrvcChrg), SUM(c.fnmGTSlsNonVat), SUM(c.fnmGTRwGrss), SUM(c.fnmGTLclTaxDly), c.fvcWrksttnNmbr, SUM(c.fnmGTPymntCSH), SUM(c.fnmGTPymntCRD), SUM(c.fnmGTPymntOTH), a.wingid, a.floorid, a.typeofbusiness FROM tblref_unit AS a INNER JOIN tbltrans_tenants AS b ON a.unitid = b.unitid INNER JOIN db_sales AS c ON b.tenantid = c.tenantid WHERE c.fdtTrnsctn = '". $date1 ."' AND a.wingid = '". $_POST['wingid'] ."' AND a.floorid = '". $_POST['floorid'] ."' and a.typeofbusiness = '". $_POST['unittype'] ."' AND a.unitid = '". $row[0] ."' ";
			}
			else if($year != "" && $month != "" && $day == ""){
				$sqlsales = " SELECT a.unitid, b.unitid, b.mallid, b.tenantid, c.tenantid, c.fdtTrnsctn, SUM(c.fnmGrndTtlOld), SUM(c.fnmGrndTtlNew), SUM(c.fnmGTDlySls), SUM(c.fnmGTDscnt), SUM(c.fnmGTDscntSNR), SUM(c.fnmGTDscntPWD), SUM(c.fnmGTDscntGPC), SUM(c.fnmGTDscntVIP), SUM(c.fnmGTDscntEMP), SUM(c.fnmGTDscntREG), SUM(c.fnmGTDscntOTH), SUM(c.fnmGTRfnd), SUM(c.fnmGTCncld), SUM(c.fnmGTSlsVAT), SUM(c.fnmGTVATSlsInclsv), SUM(c.fnmGTVATSlsExclsv), SUM(c.fnmOffclRcptBeg), SUM(c.fnmOffclRcptEnd), SUM(c.fnmGTCntDcmnt), SUM(c.fnmGTCntCstmr), SUM(c.fnmGTCntSnrCtzn), SUM(c.fnmGTLclTax), SUM(c.fnmGTSrvcChrg), SUM(c.fnmGTSlsNonVat), SUM(c.fnmGTRwGrss), SUM(c.fnmGTLclTaxDly), c.fvcWrksttnNmbr, SUM(c.fnmGTPymntCSH), SUM(c.fnmGTPymntCRD), SUM(c.fnmGTPymntOTH), a.wingid, a.floorid, a.typeofbusiness FROM tblref_unit AS a INNER JOIN tbltrans_tenants AS b ON a.unitid = b.unitid INNER JOIN db_sales AS c ON b.tenantid = c.tenantid WHERE YEAR(c.fdtTrnsctn) = '". $year ."' AND MONTH(c.fdtTrnsctn) = '". $month ."' AND a.wingid = '". $_POST['wingid'] ."' AND a.floorid = '". $_POST['floorid'] ."' and a.typeofbusiness = '". $_POST['unittype'] ."' AND a.unitid = '". $row[0] ."' ";
			}
			else if($year != "" && $month == "" && $day == ""){
				$sqlsales = " SELECT a.unitid, b.unitid, b.mallid, b.tenantid, c.tenantid, c.fdtTrnsctn, SUM(c.fnmGrndTtlOld), SUM(c.fnmGrndTtlNew), SUM(c.fnmGTDlySls), SUM(c.fnmGTDscnt), SUM(c.fnmGTDscntSNR), SUM(c.fnmGTDscntPWD), SUM(c.fnmGTDscntGPC), SUM(c.fnmGTDscntVIP), SUM(c.fnmGTDscntEMP), SUM(c.fnmGTDscntREG), SUM(c.fnmGTDscntOTH), SUM(c.fnmGTRfnd), SUM(c.fnmGTCncld), SUM(c.fnmGTSlsVAT), SUM(c.fnmGTVATSlsInclsv), SUM(c.fnmGTVATSlsExclsv), SUM(c.fnmOffclRcptBeg), SUM(c.fnmOffclRcptEnd), SUM(c.fnmGTCntDcmnt), SUM(c.fnmGTCntCstmr), SUM(c.fnmGTCntSnrCtzn), SUM(c.fnmGTLclTax), SUM(c.fnmGTSrvcChrg), SUM(c.fnmGTSlsNonVat), SUM(c.fnmGTRwGrss), SUM(c.fnmGTLclTaxDly), c.fvcWrksttnNmbr, SUM(c.fnmGTPymntCSH), SUM(c.fnmGTPymntCRD), SUM(c.fnmGTPymntOTH), a.wingid, a.floorid, a.typeofbusiness FROM tblref_unit AS a INNER JOIN tbltrans_tenants AS b ON a.unitid = b.unitid INNER JOIN db_sales AS c ON b.tenantid = c.tenantid  WHERE YEAR(c.fdtTrnsctn) = '". $year ."' AND a.wingid = '". $_POST['wingid'] ."' AND a.floorid = '". $_POST['floorid'] ."' and a.typeofbusiness = '". $_POST['unittype'] ."' AND a.unitid = '". $row[0] ."' ";
			}
			else {
				echo "1";
			}
				$ressales = mysql_query($sqlsales, $connection);
				while($rowsales = mysql_fetch_array($ressales)){
					$table .= "
					<tr style='width: 100%;cursor: pointer !important;' onclick='checkfilterofdate(\"".  $row[0] ."\");'>
					    <td style='text-align: left; width:1%; white-space:nowrap;'>". $row[1] ."</td>
						<td style='text-align: left; width:1%; white-space:nowrap;'>". $year ."</td>
						<td style='text-align: left; width:1%; white-space:nowrap;'>". number_format($rowsales[7], 2, '.', ',') ."</td>
						<td style='text-align: left; width:1%; white-space:nowrap;'>". number_format($rowsales[9], 2, '.', ',') ."</td>
						<td style='text-align: left; width:1%; white-space:nowrap;'>". number_format($rowsales[10], 2, '.', ',') ."</td>
						<td style='text-align: left; width:1%; white-space:nowrap;'>". number_format($rowsales[11], 2, '.', ',') ."</td>
						<td style='text-align: left; width:1%; white-space:nowrap;'>". number_format($rowsales[12], 2, '.', ',') ."</td>
						<td style='text-align: left; width:1%; white-space:nowrap;'>". number_format($rowsales[13], 2, '.', ',') ."</td>
						<td style='text-align: left; width:1%; white-space:nowrap;'>". number_format($rowsales[15], 2, '.', ',') ."</td>
						<td style='text-align: left; width:1%; white-space:nowrap;'>". number_format($rowsales[16], 2, '.', ',') ."</td>
						<td style='text-align: left; width:1%; white-space:nowrap;'>". number_format($rowsales[17], 2, '.', ',') ."</td>
						<td style='text-align: left; width:1%; white-space:nowrap;'>". number_format($rowsales[18], 2, '.', ',') ."</td>
						<td style='text-align: left; width:1%; white-space:nowrap;'>". number_format($rowsales[19], 2, '.', ',') ."</td>
						<td style='text-align: left; width:1%; white-space:nowrap;'>". number_format($rowsales[20], 2, '.', ',') ."</td>
						<td style='text-align: left; width:1%; white-space:nowrap;'>". number_format($rowsales[21], 2, '.', ',') ."</td>
						<td style='text-align: left; width:1%; white-space:nowrap;'>". number_format($rowsales[22], 2, '.', ',') ."</td>
						<td style='text-align: left; width:1%; white-space:nowrap;'>". number_format($rowsales[23], 2, '.', ',') ."</td>
						<td style='text-align: left; width:1%; white-space:nowrap;'>". number_format($rowsales[24], 2, '.', ',') ."</td>
						<td style='text-align: left; width:1%; white-space:nowrap;'>". number_format($rowsales[25], 2, '.', ',') ."</td>
						<td style='text-align: left; width:1%; white-space:nowrap;'>". number_format($rowsales[26], 2, '.', ',') ."</td>
						<td style='text-align: left; width:1%; white-space:nowrap;'>". number_format($rowsales[27], 2, '.', ',') ."</td>
						<td style='text-align: left; width:1%; white-space:nowrap;'>". number_format($rowsales[28], 2, '.', ',') ."</td>
						<td style='text-align: left; width:1%; white-space:nowrap;'>". number_format($rowsales[29], 2, '.', ',') ."</td>
						<td style='text-align: left; width:1%; white-space:nowrap;'>". number_format($rowsales[30], 2, '.', ',') ."</td>
						<td style='text-align: left; width:1%; white-space:nowrap;'>". number_format($rowsales[31], 2, '.', ',') ."</td>
						<td style='text-align: left; width:1%; white-space:nowrap;'>". number_format($rowsales[32], 2, '.', ',') ."</td>
						<td style='text-align: left; width:1%; white-space:nowrap;'>". number_format($rowsales[33], 2, '.', ',') ."</td>
						<td style='text-align: left; width:1%; white-space:nowrap;'>". number_format($rowsales[34], 2, '.', ',') ."</td>
						<td style='text-align: left; width:1%; white-space:nowrap;'>". number_format($rowsales[35], 2, '.', ',') ."</td>
					</tr>";
				}
			}
				echo $table . "|" . $rowunittype[0];
		break;

		case 'tenantsales':
			$sqlunit = " SELECT unitname FROM tblref_unit WHERE mallid = '". $_POST['mallid'] ."' AND wingid = '". $_POST['wingid'] ."' AND floorid = '". $_POST['floorid'] ."' AND typeofbusiness = '". $_POST['unittype'] ."' "; 
			$resunit = mysql_query($sqlunit, $connection);
			$rowunit = mysql_fetch_array($resunit);

			$sql = " SELECT tenantid, tradename FROM tbltrans_tenants WHERE unitid = '". $_POST['unitid'] ."' "; 
			$res = mysql_query($sql, $connection);
			while($row = mysql_fetch_array($res)){

				$sqlcheckpenalty = " SELECT xdescription, xdate, tenantid FROM tbltransaction WHERE tenantid = '". $row[0] ."' AND xdescription = 'Penalty' ";
				$rescheckpenalty = mysql_query($sqlcheckpenalty, $connection);
				$rowcheckpenalty = mysql_fetch_array($rescheckpenalty);

			$year = $_POST['year'];
			$month = $_POST['month'];
			$day = $_POST['day'];
			$date1 = $_POST['year']."-".$_POST['month']."-".$_POST['day'];

			if($year == "" && $month == "" && $day == ""){
				$sqlsales = " SELECT tenantid, fdtTrnsctn, SUM(fnmGrndTtlOld), SUM(fnmGrndTtlNew), SUM(fnmGTDlySls), SUM(fnmGTDscnt), SUM(fnmGTDscntSNR), SUM(fnmGTDscntPWD), SUM(fnmGTDscntGPC), SUM(fnmGTDscntVIP), SUM(fnmGTDscntEMP), SUM(fnmGTDscntREG), SUM(fnmGTDscntOTH), SUM(fnmGTRfnd), SUM(fnmGTCncld), SUM(fnmGTSlsVAT), SUM(fnmGTVATSlsInclsv), SUM(fnmGTVATSlsExclsv), SUM(fnmOffclRcptBeg), SUM(fnmOffclRcptEnd), SUM(fnmGTCntDcmnt), SUM(fnmGTCntCstmr), SUM(fnmGTCntSnrCtzn), SUM(fnmGTLclTax), SUM(fnmGTSrvcChrg), SUM(fnmGTSlsNonVat), SUM(fnmGTRwGrss), SUM(fnmGTLclTaxDly), fvcWrksttnNmbr, SUM(fnmGTPymntCSH), SUM(fnmGTPymntCRD), SUM(fnmGTPymntOTH) FROM db_sales WHERE tenantid = '". $row[0] ."' ";
			}
			else if($year != "" && $month != "" && $day != ""){
				$sqlsales = " SELECT tenantid, fdtTrnsctn, SUM(fnmGrndTtlOld), SUM(fnmGrndTtlNew), SUM(fnmGTDlySls), SUM(fnmGTDscnt), SUM(fnmGTDscntSNR), SUM(fnmGTDscntPWD), SUM(fnmGTDscntGPC), SUM(fnmGTDscntVIP), SUM(fnmGTDscntEMP), SUM(fnmGTDscntREG), SUM(fnmGTDscntOTH), SUM(fnmGTRfnd), SUM(fnmGTCncld), SUM(fnmGTSlsVAT), SUM(fnmGTVATSlsInclsv), SUM(fnmGTVATSlsExclsv), SUM(fnmOffclRcptBeg), SUM(fnmOffclRcptEnd), SUM(fnmGTCntDcmnt), SUM(fnmGTCntCstmr), SUM(fnmGTCntSnrCtzn), SUM(fnmGTLclTax), SUM(fnmGTSrvcChrg), SUM(fnmGTSlsNonVat), SUM(fnmGTRwGrss), SUM(fnmGTLclTaxDly), fvcWrksttnNmbr, SUM(fnmGTPymntCSH), SUM(fnmGTPymntCRD), SUM(fnmGTPymntOTH) FROM db_sales WHERE fdtTrnsctn = '". $date1 ."' AND tenantid = '". $row[0] ."' ";
			}
			else if($year != "" && $month != "" && $day == ""){
				$sqlsales = " SELECT tenantid, fdtTrnsctn, SUM(fnmGrndTtlOld), SUM(fnmGrndTtlNew), SUM(fnmGTDlySls), SUM(fnmGTDscnt), SUM(fnmGTDscntSNR), SUM(fnmGTDscntPWD), SUM(fnmGTDscntGPC), SUM(fnmGTDscntVIP), SUM(fnmGTDscntEMP), SUM(fnmGTDscntREG), SUM(fnmGTDscntOTH), SUM(fnmGTRfnd), SUM(fnmGTCncld), SUM(fnmGTSlsVAT), SUM(fnmGTVATSlsInclsv), SUM(fnmGTVATSlsExclsv), SUM(fnmOffclRcptBeg), SUM(fnmOffclRcptEnd), SUM(fnmGTCntDcmnt), SUM(fnmGTCntCstmr), SUM(fnmGTCntSnrCtzn), SUM(fnmGTLclTax), SUM(fnmGTSrvcChrg), SUM(fnmGTSlsNonVat), SUM(fnmGTRwGrss), SUM(fnmGTLclTaxDly), fvcWrksttnNmbr, SUM(fnmGTPymntCSH), SUM(fnmGTPymntCRD), SUM(fnmGTPymntOTH) FROM db_sales WHERE YEAR(fdtTrnsctn) = '". $year ."' AND MONTH(fdtTrnsctn) = '". $month ."' AND tenantid = '". $row[0] ."' ";
			}
			else if($year != "" && $month == "" && $day == ""){
				$sqlsales = " SELECT tenantid, fdtTrnsctn, SUM(fnmGrndTtlOld), SUM(fnmGrndTtlNew), SUM(fnmGTDlySls), SUM(fnmGTDscnt), SUM(fnmGTDscntSNR), SUM(fnmGTDscntPWD), SUM(fnmGTDscntGPC), SUM(fnmGTDscntVIP), SUM(fnmGTDscntEMP), SUM(fnmGTDscntREG), SUM(fnmGTDscntOTH), SUM(fnmGTRfnd), SUM(fnmGTCncld), SUM(fnmGTSlsVAT), SUM(fnmGTVATSlsInclsv), SUM(fnmGTVATSlsExclsv), SUM(fnmOffclRcptBeg), SUM(fnmOffclRcptEnd), SUM(fnmGTCntDcmnt), SUM(fnmGTCntCstmr), SUM(fnmGTCntSnrCtzn), SUM(fnmGTLclTax), SUM(fnmGTSrvcChrg), SUM(fnmGTSlsNonVat), SUM(fnmGTRwGrss), SUM(fnmGTLclTaxDly), fvcWrksttnNmbr, SUM(fnmGTPymntCSH), SUM(fnmGTPymntCRD), SUM(fnmGTPymntOTH) FROM db_sales WHERE YEAR(fdtTrnsctn) = '". $year ."' AND tenantid = '". $row[0] ."' ";
			}
			else {
				echo "1";
			}
				$ressales = mysql_query($sqlsales, $connection);
				while($rowsales = mysql_fetch_array($ressales)){
					?>
					<tr style="width: 100%;">
					    <?php echo"<td style='text-align: left; width:1%; white-space:nowrap; cursor: pointer !important;' onclick='displaypenaltypertenant(\"".  $row[0] ."\")'>"; ?>
					    <?php 
					    if( $rowcheckpenalty[0] == "Penalty" )	{	?>	
							<span class="red icon-animated-vertical"><?php echo $row[1]; ?></span>
						<?php 	}
						else{	?>
							<?php echo $row[1]; ?>
						<?php 	}	?>
						</td>
						<?php echo"<td style='text-align: left; width:1%; white-space:nowrap; cursor: pointer !important;' onclick='displaypenaltypertenant(\"".  $row[0] ."\")'>"; ?>
					    <?php 
					    if( $rowcheckpenalty[0] == "Penalty" )	{	?>	
							<span class="red icon-animated-vertical"><?php echo $year; ?></span>
						<?php 	}
						else{	?>
							<?php echo $year; ?>
						<?php 	}	?>
						</td>
						<?php echo "<td style='text-align: left; width:1%; white-space:nowrap; cursor: pointer !important;'  onclick='tenantsalesbymonth(\"".  $row[0] ."\")'>". number_format($rowsales[4], 2, '.', ',')."</td>
						<td style='text-align: left; width:1%; white-space:nowrap;'>". number_format($rowsales[5], 2, '.', ',') ."</td>
						<td style='text-align: left; width:1%; white-space:nowrap;'>". number_format($rowsales[6], 2, '.', ',') ."</td>
						<td style='text-align: left; width:1%; white-space:nowrap;'>". number_format($rowsales[7], 2, '.', ',') ."</td>
						<td style='text-align: left; width:1%; white-space:nowrap;'>". number_format($rowsales[8], 2, '.', ',') ."</td>
						<td style='text-align: left; width:1%; white-space:nowrap;'>". number_format($rowsales[9], 2, '.', ',') ."</td>
						<td style='text-align: left; width:1%; white-space:nowrap;'>". number_format($rowsales[10], 2, '.', ',') ."</td>
						<td style='text-align: left; width:1%; white-space:nowrap;'>". number_format($rowsales[11], 2, '.', ',') ."</td>
						<td style='text-align: left; width:1%; white-space:nowrap;'>". number_format($rowsales[12], 2, '.', ',') ."</td>
						<td style='text-align: left; width:1%; white-space:nowrap;'>". number_format($rowsales[13], 2, '.', ',') ."</td>
						<td style='text-align: left; width:1%; white-space:nowrap;'>". number_format($rowsales[14], 2, '.', ',') ."</td>
						<td style='text-align: left; width:1%; white-space:nowrap;'>". number_format($rowsales[15], 2, '.', ',') ."</td>
						<td style='text-align: left; width:1%; white-space:nowrap;'>". number_format($rowsales[16], 2, '.', ',') ."</td>
						<td style='text-align: left; width:1%; white-space:nowrap;'>". number_format($rowsales[17], 2, '.', ',') ."</td>
						<td style='text-align: left; width:1%; white-space:nowrap;'>". number_format($rowsales[18], 2, '.', ',') ."</td>
						<td style='text-align: left; width:1%; white-space:nowrap;'>". number_format($rowsales[19], 2, '.', ',') ."</td>
						<td style='text-align: left; width:1%; white-space:nowrap;'>". number_format($rowsales[20], 2, '.', ',') ."</td>
						<td style='text-align: left; width:1%; white-space:nowrap;'>". number_format($rowsales[21], 2, '.', ',') ."</td>
						<td style='text-align: left; width:1%; white-space:nowrap;'>". number_format($rowsales[22], 2, '.', ',') ."</td>
						<td style='text-align: left; width:1%; white-space:nowrap;'>". number_format($rowsales[23], 2, '.', ',') ."</td>
						<td style='text-align: left; width:1%; white-space:nowrap;'>". number_format($rowsales[24], 2, '.', ',') ."</td>
						<td style='text-align: left; width:1%; white-space:nowrap;'>". number_format($rowsales[25], 2, '.', ',') ."</td>
						<td style='text-align: left; width:1%; white-space:nowrap;'>". number_format($rowsales[26], 2, '.', ',') ."</td>
						<td style='text-align: left; width:1%; white-space:nowrap;'>". number_format($rowsales[27], 2, '.', ',') ."</td>
						<td style='text-align: left; width:1%; white-space:nowrap;'>". number_format($rowsales[29], 2, '.', ',') ."</td>
						<td style='text-align: left; width:1%; white-space:nowrap;'>". number_format($rowsales[30], 2, '.', ',') ."</td>
						<td style='text-align: left; width:1%; white-space:nowrap;'>". number_format($rowsales[31], 2, '.', ',') ."</td>
						"; ?>
					</tr> 
				<?php 
				}
			}
			echo "|". $rowunit[0];
		break;

		case 'tenantsalesbymonth':
			$sql2 = " SELECT tenantid, tradename FROM tbltrans_tenants WHERE unitid = '". $_POST['unitid'] ."' "; 
			$res2 = mysql_query($sql2, $connection);
			$row2 = mysql_fetch_array($res2);

			$sqlunit = " SELECT unitname FROM tblref_unit WHERE mallid = '". $_POST['mallid'] ."' AND wingid = '". $_POST['wingid'] ."' AND floorid = '". $_POST['floorid'] ."' AND typeofbusiness = '". $_POST['unittype'] ."' "; 
			$resunit = mysql_query($sqlunit, $connection);
			$rowunit = mysql_fetch_array($resunit);

			echo $sqlunit;

			$sql = " SELECT tenantid, tradename FROM tbltrans_tenants WHERE unitid = '". $_POST['unitid'] ."' "; 
			$res = mysql_query($sql, $connection);
			$countngid = 1;
			while($row = mysql_fetch_array($res)){

				$sqlcheckpenalty = " SELECT xdescription, xdate, tenantid FROM tbltransaction WHERE tenantid = '". $row[0] ."' AND xdescription = 'Penalty'";
				$rescheckpenalty = mysql_query($sqlcheckpenalty, $connection);
				$rowcheckpenalty = mysql_fetch_array($rescheckpenalty);

			$year = $_POST['year'];
			$month = $_POST['month'];
			$day = $_POST['day'];
			$date1 = $_POST['year']."-".$_POST['month']."-".$_POST['day'];

			if($year == "" && $month == "" && $day == ""){
				$sqlsales = " SELECT tenantid, fdtTrnsctn, SUM(fnmGrndTtlOld), SUM(fnmGrndTtlNew), SUM(fnmGTDlySls), SUM(fnmGTDscnt), SUM(fnmGTDscntSNR), SUM(fnmGTDscntPWD), SUM(fnmGTDscntGPC), SUM(fnmGTDscntVIP), SUM(fnmGTDscntEMP), SUM(fnmGTDscntREG), SUM(fnmGTDscntOTH), SUM(fnmGTRfnd), SUM(fnmGTCncld), SUM(fnmGTSlsVAT), SUM(fnmGTVATSlsInclsv), SUM(fnmGTVATSlsExclsv), SUM(fnmOffclRcptBeg), SUM(fnmOffclRcptEnd), SUM(fnmGTCntDcmnt), SUM(fnmGTCntCstmr), SUM(fnmGTCntSnrCtzn), SUM(fnmGTLclTax), SUM(fnmGTSrvcChrg), SUM(fnmGTSlsNonVat), SUM(fnmGTRwGrss), SUM(fnmGTLclTaxDly), fvcWrksttnNmbr, SUM(fnmGTPymntCSH), SUM(fnmGTPymntCRD), SUM(fnmGTPymntOTH) FROM db_sales WHERE tenantid = '". $row[0] ."' GROUP BY MONTH(fdtTrnsctn) ";
			}
			else if($year != "" && $month != "" && $day != ""){
				$sqlsales = " SELECT tenantid, fdtTrnsctn, SUM(fnmGrndTtlOld), SUM(fnmGrndTtlNew), SUM(fnmGTDlySls), SUM(fnmGTDscnt), SUM(fnmGTDscntSNR), SUM(fnmGTDscntPWD), SUM(fnmGTDscntGPC), SUM(fnmGTDscntVIP), SUM(fnmGTDscntEMP), SUM(fnmGTDscntREG), SUM(fnmGTDscntOTH), SUM(fnmGTRfnd), SUM(fnmGTCncld), SUM(fnmGTSlsVAT), SUM(fnmGTVATSlsInclsv), SUM(fnmGTVATSlsExclsv), SUM(fnmOffclRcptBeg), SUM(fnmOffclRcptEnd), SUM(fnmGTCntDcmnt), SUM(fnmGTCntCstmr), SUM(fnmGTCntSnrCtzn), SUM(fnmGTLclTax), SUM(fnmGTSrvcChrg), SUM(fnmGTSlsNonVat), SUM(fnmGTRwGrss), SUM(fnmGTLclTaxDly), fvcWrksttnNmbr, SUM(fnmGTPymntCSH), SUM(fnmGTPymntCRD), SUM(fnmGTPymntOTH) FROM db_sales WHERE fdtTrnsctn = '". $date1 ."' AND tenantid = '". $row[0] ."' GROUP BY MONTH(fdtTrnsctn) ";
			}
			else if($year != "" && $month != "" && $day == ""){
				$sqlsales = " SELECT tenantid, fdtTrnsctn, SUM(fnmGrndTtlOld), SUM(fnmGrndTtlNew), SUM(fnmGTDlySls), SUM(fnmGTDscnt), SUM(fnmGTDscntSNR), SUM(fnmGTDscntPWD), SUM(fnmGTDscntGPC), SUM(fnmGTDscntVIP), SUM(fnmGTDscntEMP), SUM(fnmGTDscntREG), SUM(fnmGTDscntOTH), SUM(fnmGTRfnd), SUM(fnmGTCncld), SUM(fnmGTSlsVAT), SUM(fnmGTVATSlsInclsv), SUM(fnmGTVATSlsExclsv), SUM(fnmOffclRcptBeg), SUM(fnmOffclRcptEnd), SUM(fnmGTCntDcmnt), SUM(fnmGTCntCstmr), SUM(fnmGTCntSnrCtzn), SUM(fnmGTLclTax), SUM(fnmGTSrvcChrg), SUM(fnmGTSlsNonVat), SUM(fnmGTRwGrss), SUM(fnmGTLclTaxDly), fvcWrksttnNmbr, SUM(fnmGTPymntCSH), SUM(fnmGTPymntCRD), SUM(fnmGTPymntOTH) FROM db_sales WHERE YEAR(fdtTrnsctn) = '". $year ."' AND MONTH(fdtTrnsctn) = '". $month ."' AND tenantid = '". $row[0] ."' GROUP BY MONTH(fdtTrnsctn) ";
			}
			else if($year != "" && $month == "" && $day == ""){
				$sqlsales = " SELECT tenantid, fdtTrnsctn, SUM(fnmGrndTtlOld), SUM(fnmGrndTtlNew), SUM(fnmGTDlySls), SUM(fnmGTDscnt), SUM(fnmGTDscntSNR), SUM(fnmGTDscntPWD), SUM(fnmGTDscntGPC), SUM(fnmGTDscntVIP), SUM(fnmGTDscntEMP), SUM(fnmGTDscntREG), SUM(fnmGTDscntOTH), SUM(fnmGTRfnd), SUM(fnmGTCncld), SUM(fnmGTSlsVAT), SUM(fnmGTVATSlsInclsv), SUM(fnmGTVATSlsExclsv), SUM(fnmOffclRcptBeg), SUM(fnmOffclRcptEnd), SUM(fnmGTCntDcmnt), SUM(fnmGTCntCstmr), SUM(fnmGTCntSnrCtzn), SUM(fnmGTLclTax), SUM(fnmGTSrvcChrg), SUM(fnmGTSlsNonVat), SUM(fnmGTRwGrss), SUM(fnmGTLclTaxDly), fvcWrksttnNmbr, SUM(fnmGTPymntCSH), SUM(fnmGTPymntCRD), SUM(fnmGTPymntOTH) FROM db_sales WHERE YEAR(fdtTrnsctn) = '". $year ."' AND tenantid = '". $row[0] ."' GROUP BY MONTH(fdtTrnsctn) ";
			}
			else {
				echo "1";
			}

				$ressales = mysql_query($sqlsales, $connection);
				while($rowsales = mysql_fetch_array($ressales)){

					$penaltydate = date('Y-m-d', strtotime($rowcheckpenalty[1]. '-1 month'));
					$labasmoko .= date('F', strtotime($rowsales[1]))." ".$year;
					?> <?php
					
					echo "<tr style='width: 100%;' >"; ?>
					    <?php echo"<td style='text-align: left; width:1%; white-space:nowrap; cursor: pointer !important;' onclick='displaypenaltypertenant(\"".  $row[0] ."\")'>"; ?>
					    <?php 
					    if( date('m', strtotime($penaltydate)) == date('m', strtotime($rowsales[1])) )	{	?>	
							<span class="red icon-animated-vertical"><?php echo $row[1]; ?></span>
						<?php 	}
						else{	?>
							<?php echo $row[1]; ?>
						<?php 	}	?>
						</td>
					    <?php echo "<td style='text-align: left; width:1%; white-space:nowrap; cursor: pointer !important;' onclick='displaypenaltypertenant(\"".  $row[0] ."\")'>"; ?>
					    <?php 
					    if( date('m', strtotime($penaltydate)) == date('m', strtotime($rowsales[1])) )	{	?>
							<span class="red icon-animated-vertical"><?php echo date('F', strtotime($rowsales[1]))." ".$year; ?></span>	
						<?php 	}
						else{	?>
							<?php echo date('F', strtotime($rowsales[1]))." ".$year; ?>
						<?php 	}	?>
						</td>
						<?php
						echo "<td style='text-align: left; width:1%; white-space:nowrap; cursor: pointer !important;' onclick='tenantsalesbyday(\"".  date('m', strtotime($rowsales[1])) ."\",\"".  $row[0] ."\");'>". number_format($rowsales[4], 2, '.', ',')."</td>"; ?>
						<td style='text-align: left; width:1%; white-space:nowrap;'><?php echo number_format($rowsales[5], 2, '.', ','); ?></td>
						<td style='text-align: left; width:1%; white-space:nowrap;'><?php echo number_format($rowsales[6], 2, '.', ','); ?></td>
						<td style='text-align: left; width:1%; white-space:nowrap;'><?php echo number_format($rowsales[7], 2, '.', ','); ?></td>
						<td style='text-align: left; width:1%; white-space:nowrap;'><?php echo number_format($rowsales[8], 2, '.', ','); ?></td>
						<td style='text-align: left; width:1%; white-space:nowrap;'><?php echo number_format($rowsales[9], 2, '.', ','); ?></td>
						<td style='text-align: left; width:1%; white-space:nowrap;'><?php echo number_format($rowsales[10], 2, '.', ','); ?></td>
						<td style='text-align: left; width:1%; white-space:nowrap;'><?php echo number_format($rowsales[11], 2, '.', ','); ?></td>
						<td style='text-align: left; width:1%; white-space:nowrap;'><?php echo number_format($rowsales[12], 2, '.', ','); ?></td>
						<td style='text-align: left; width:1%; white-space:nowrap;'><?php echo number_format($rowsales[13], 2, '.', ','); ?></td>
						<td style='text-align: left; width:1%; white-space:nowrap;'><?php echo number_format($rowsales[14], 2, '.', ','); ?></td>
						<td style='text-align: left; width:1%; white-space:nowrap;'><?php echo number_format($rowsales[15], 2, '.', ','); ?></td>
						<td style='text-align: left; width:1%; white-space:nowrap;'><?php echo number_format($rowsales[16], 2, '.', ','); ?></td>
						<td style='text-align: left; width:1%; white-space:nowrap;'><?php echo number_format($rowsales[17], 2, '.', ','); ?></td>
						<td style='text-align: left; width:1%; white-space:nowrap;'><?php echo number_format($rowsales[18], 2, '.', ','); ?></td>
						<td style='text-align: left; width:1%; white-space:nowrap;'><?php echo number_format($rowsales[19], 2, '.', ','); ?></td>
						<td style='text-align: left; width:1%; white-space:nowrap;'><?php echo number_format($rowsales[20], 2, '.', ','); ?></td>
						<td style='text-align: left; width:1%; white-space:nowrap;'><?php echo number_format($rowsales[21], 2, '.', ','); ?></td>
						<td style='text-align: left; width:1%; white-space:nowrap;'><?php echo number_format($rowsales[22], 2, '.', ','); ?></td>
						<td style='text-align: left; width:1%; white-space:nowrap;'><?php echo number_format($rowsales[23], 2, '.', ','); ?></td>
						<td style='text-align: left; width:1%; white-space:nowrap;'><?php echo number_format($rowsales[24], 2, '.', ','); ?></td>
						<td style='text-align: left; width:1%; white-space:nowrap;'><?php echo number_format($rowsales[25], 2, '.', ','); ?></td>
						<td style='text-align: left; width:1%; white-space:nowrap;'><?php echo number_format($rowsales[26], 2, '.', ','); ?></td>
						<td style='text-align: left; width:1%; white-space:nowrap;'><?php echo number_format($rowsales[27], 2, '.', ','); ?></td>
						<td style='text-align: left; width:1%; white-space:nowrap;'><?php echo number_format($rowsales[29], 2, '.', ','); ?></td>
						<td style='text-align: left; width:1%; white-space:nowrap;'><?php echo number_format($rowsales[30], 2, '.', ','); ?></td>
						<td style='text-align: left; width:1%; white-space:nowrap;'><?php echo number_format($rowsales[31], 2, '.', ','); ?></td>
					</tr>
					<?php
				}
			}
			echo "|". $row2[1]." ".$year.$month.$day. "|" . $rowunit[0];
		break;

		case 'tenantsalesbyday':
			$year = $_POST['year'];
			$month = $_POST['month'];
			$day = $_POST['day'];
			$date1 = $_POST['year']."-".$_POST['month']."-".$_POST['day'];

			$sql = " SELECT tenantid, tradename FROM tbltrans_tenants WHERE tenantid = '". $_POST['tenantid'] ."' "; 
			$res = mysql_query($sql, $connection);
			while($row = mysql_fetch_array($res)){

			if($year == "" && $month == "" && $day == ""){
				$sqlsales = " SELECT tenantid, fdtTrnsctn, SUM(fnmGrndTtlOld), SUM(fnmGrndTtlNew), SUM(fnmGTDlySls), SUM(fnmGTDscnt), SUM(fnmGTDscntSNR), SUM(fnmGTDscntPWD), SUM(fnmGTDscntGPC), SUM(fnmGTDscntVIP), SUM(fnmGTDscntEMP), SUM(fnmGTDscntREG), SUM(fnmGTDscntOTH), SUM(fnmGTRfnd), SUM(fnmGTCncld), SUM(fnmGTSlsVAT), SUM(fnmGTVATSlsInclsv), SUM(fnmGTVATSlsExclsv), SUM(fnmOffclRcptBeg), SUM(fnmOffclRcptEnd), SUM(fnmGTCntDcmnt), SUM(fnmGTCntCstmr), SUM(fnmGTCntSnrCtzn), SUM(fnmGTLclTax), SUM(fnmGTSrvcChrg), SUM(fnmGTSlsNonVat), SUM(fnmGTRwGrss), SUM(fnmGTLclTaxDly), fvcWrksttnNmbr, SUM(fnmGTPymntCSH), SUM(fnmGTPymntCRD), SUM(fnmGTPymntOTH) FROM db_sales WHERE tenantid = '". $row[0] ."' AND YEAR(fdtTrnsctn) = '". $year ."' AND MONTH(fdtTrnsctn) = '". $_POST['tenantmonth'] ."'  GROUP BY Day(fdtTrnsctn) ";
			}
			else if($year != "" && $month != "" && $day != ""){
				$sqlsales = " SELECT tenantid, fdtTrnsctn, SUM(fnmGrndTtlOld), SUM(fnmGrndTtlNew), SUM(fnmGTDlySls), SUM(fnmGTDscnt), SUM(fnmGTDscntSNR), SUM(fnmGTDscntPWD), SUM(fnmGTDscntGPC), SUM(fnmGTDscntVIP), SUM(fnmGTDscntEMP), SUM(fnmGTDscntREG), SUM(fnmGTDscntOTH), SUM(fnmGTRfnd), SUM(fnmGTCncld), SUM(fnmGTSlsVAT), SUM(fnmGTVATSlsInclsv), SUM(fnmGTVATSlsExclsv), SUM(fnmOffclRcptBeg), SUM(fnmOffclRcptEnd), SUM(fnmGTCntDcmnt), SUM(fnmGTCntCstmr), SUM(fnmGTCntSnrCtzn), SUM(fnmGTLclTax), SUM(fnmGTSrvcChrg), SUM(fnmGTSlsNonVat), SUM(fnmGTRwGrss), SUM(fnmGTLclTaxDly), fvcWrksttnNmbr, SUM(fnmGTPymntCSH), SUM(fnmGTPymntCRD), SUM(fnmGTPymntOTH) FROM db_sales WHERE tenantid = '". $row[0] ."' AND YEAR(fdtTrnsctn) = '". $year ."' AND MONTH(fdtTrnsctn) = '". $_POST['tenantmonth'] ."' GROUP BY Day(fdtTrnsctn) ";
			}
			else if($year != "" && $month != "" && $day == ""){
				$sqlsales = " SELECT tenantid, fdtTrnsctn, SUM(fnmGrndTtlOld), SUM(fnmGrndTtlNew), SUM(fnmGTDlySls), SUM(fnmGTDscnt), SUM(fnmGTDscntSNR), SUM(fnmGTDscntPWD), SUM(fnmGTDscntGPC), SUM(fnmGTDscntVIP), SUM(fnmGTDscntEMP), SUM(fnmGTDscntREG), SUM(fnmGTDscntOTH), SUM(fnmGTRfnd), SUM(fnmGTCncld), SUM(fnmGTSlsVAT), SUM(fnmGTVATSlsInclsv), SUM(fnmGTVATSlsExclsv), SUM(fnmOffclRcptBeg), SUM(fnmOffclRcptEnd), SUM(fnmGTCntDcmnt), SUM(fnmGTCntCstmr), SUM(fnmGTCntSnrCtzn), SUM(fnmGTLclTax), SUM(fnmGTSrvcChrg), SUM(fnmGTSlsNonVat), SUM(fnmGTRwGrss), SUM(fnmGTLclTaxDly), fvcWrksttnNmbr, SUM(fnmGTPymntCSH), SUM(fnmGTPymntCRD), SUM(fnmGTPymntOTH) FROM db_sales WHERE tenantid = '". $row[0] ."' AND YEAR(fdtTrnsctn) = '". $year ."' AND MONTH(fdtTrnsctn) = '". $_POST['tenantmonth'] ."' GROUP BY Day(fdtTrnsctn) ";
			}
			else if($year != "" && $month == "" && $day == ""){
				$sqlsales = " SELECT tenantid, fdtTrnsctn, SUM(fnmGrndTtlOld), SUM(fnmGrndTtlNew), SUM(fnmGTDlySls), SUM(fnmGTDscnt), SUM(fnmGTDscntSNR), SUM(fnmGTDscntPWD), SUM(fnmGTDscntGPC), SUM(fnmGTDscntVIP), SUM(fnmGTDscntEMP), SUM(fnmGTDscntREG), SUM(fnmGTDscntOTH), SUM(fnmGTRfnd), SUM(fnmGTCncld), SUM(fnmGTSlsVAT), SUM(fnmGTVATSlsInclsv), SUM(fnmGTVATSlsExclsv), SUM(fnmOffclRcptBeg), SUM(fnmOffclRcptEnd), SUM(fnmGTCntDcmnt), SUM(fnmGTCntCstmr), SUM(fnmGTCntSnrCtzn), SUM(fnmGTLclTax), SUM(fnmGTSrvcChrg), SUM(fnmGTSlsNonVat), SUM(fnmGTRwGrss), SUM(fnmGTLclTaxDly), fvcWrksttnNmbr, SUM(fnmGTPymntCSH), SUM(fnmGTPymntCRD), SUM(fnmGTPymntOTH) FROM db_sales WHERE tenantid = '". $row[0] ."' AND YEAR(fdtTrnsctn) = '". $year ."' AND MONTH(fdtTrnsctn) = '". $_POST['tenantmonth'] ."' GROUP BY Day(fdtTrnsctn) ";
			}
			else {
				echo "1";
			}
				$ressales = mysql_query($sqlsales, $connection);
				while($rowsales = mysql_fetch_array($ressales)){
					?> 
					<?php echo "<tr style='width: 100%;'>"; ?>
					    <td style='text-align: left; width:1%; white-space:nowrap;'><?php echo $row[1]; ?></td>
					    <td style='text-align: left; width:1%; white-space:nowrap;'><?php echo date('F', strtotime($rowsales[1]))." ".date('d', strtotime($rowsales[1])).",".$year ?></td>
						<td style='text-align: left; width:1%; white-space:nowrap;'><?php echo number_format($rowsales[4], 2, '.', ','); ?></td>
						<td style='text-align: left; width:1%; white-space:nowrap;'><?php echo number_format($rowsales[5], 2, '.', ','); ?></td>
						<td style='text-align: left; width:1%; white-space:nowrap;'><?php echo number_format($rowsales[6], 2, '.', ','); ?></td>
						<td style='text-align: left; width:1%; white-space:nowrap;'><?php echo number_format($rowsales[7], 2, '.', ','); ?></td>
						<td style='text-align: left; width:1%; white-space:nowrap;'><?php echo number_format($rowsales[8], 2, '.', ','); ?></td>
						<td style='text-align: left; width:1%; white-space:nowrap;'><?php echo number_format($rowsales[9], 2, '.', ','); ?></td>
						<td style='text-align: left; width:1%; white-space:nowrap;'><?php echo number_format($rowsales[10], 2, '.', ','); ?></td>
						<td style='text-align: left; width:1%; white-space:nowrap;'><?php echo number_format($rowsales[11], 2, '.', ','); ?></td>
						<td style='text-align: left; width:1%; white-space:nowrap;'><?php echo number_format($rowsales[12], 2, '.', ','); ?></td>
						<td style='text-align: left; width:1%; white-space:nowrap;'><?php echo number_format($rowsales[13], 2, '.', ','); ?></td>
						<td style='text-align: left; width:1%; white-space:nowrap;'><?php echo number_format($rowsales[14], 2, '.', ','); ?></td>
						<td style='text-align: left; width:1%; white-space:nowrap;'><?php echo number_format($rowsales[15], 2, '.', ','); ?></td>
						<td style='text-align: left; width:1%; white-space:nowrap;'><?php echo number_format($rowsales[16], 2, '.', ','); ?></td>
						<td style='text-align: left; width:1%; white-space:nowrap;'><?php echo number_format($rowsales[17], 2, '.', ','); ?></td>
						<td style='text-align: left; width:1%; white-space:nowrap;'><?php echo number_format($rowsales[18], 2, '.', ','); ?></td>
						<td style='text-align: left; width:1%; white-space:nowrap;'><?php echo number_format($rowsales[19], 2, '.', ','); ?></td>
						<td style='text-align: left; width:1%; white-space:nowrap;'><?php echo number_format($rowsales[20], 2, '.', ','); ?></td>
						<td style='text-align: left; width:1%; white-space:nowrap;'><?php echo number_format($rowsales[21], 2, '.', ','); ?></td>
						<td style='text-align: left; width:1%; white-space:nowrap;'><?php echo number_format($rowsales[22], 2, '.', ','); ?></td>
						<td style='text-align: left; width:1%; white-space:nowrap;'><?php echo number_format($rowsales[23], 2, '.', ','); ?></td>
						<td style='text-align: left; width:1%; white-space:nowrap;'><?php echo number_format($rowsales[24], 2, '.', ','); ?></td>
						<td style='text-align: left; width:1%; white-space:nowrap;'><?php echo number_format($rowsales[25], 2, '.', ','); ?></td>
						<td style='text-align: left; width:1%; white-space:nowrap;'><?php echo number_format($rowsales[26], 2, '.', ','); ?></td>
						<td style='text-align: left; width:1%; white-space:nowrap;'><?php echo number_format($rowsales[27], 2, '.', ','); ?></td>
						<td style='text-align: left; width:1%; white-space:nowrap;'><?php echo number_format($rowsales[29], 2, '.', ','); ?></td>
						<td style='text-align: left; width:1%; white-space:nowrap;'><?php echo number_format($rowsales[30], 2, '.', ','); ?></td>
						<td style='text-align: left; width:1%; white-space:nowrap;'><?php echo number_format($rowsales[31], 2, '.', ','); ?></td>
					</tr>";
				<?php
				}
			}

			echo "|". $row[1].date('F', strtotime($month))." ".$year. "|" ."Daily Sales For the month of ".date('F', strtotime($month))." ".$year ;
		break;

		case 'tenantsalesbyday3':
			$year = $_POST['year'];
			$month = $_POST['month'];
			$day = $_POST['day'];
			$date1 = $_POST['year']."-".$_POST['month']."-".$_POST['day'];

			$sql2 = " SELECT unitid, unitname FROM tblref_unit WHERE mallid = '". $_POST['mallid'] ."' AND wingid = '". $_POST['wingid'] ."' AND floorid = '". $_POST['floorid'] ."' AND typeofbusiness = '". $_POST['unittype'] ."' "; 
			$res2 = mysql_query($sql2, $connection);
			$row2 = mysql_fetch_array($res2);

			$sql3 = " SELECT tenantid, tradename FROM tbltrans_tenants WHERE unitid = '". $_POST['unitid'] ."' "; 
			$res3 = mysql_query($sql3, $connection);
			$row3 = mysql_fetch_array($res3);

			$sql = " SELECT tenantid, tradename FROM tbltrans_tenants WHERE unitid = '". $_POST['unitid'] ."' "; 
			$res = mysql_query($sql, $connection);
			while($row = mysql_fetch_array($res)){

				$sqlcheckpenalty = " SELECT xdescription, xdate, tenantid FROM tbltransaction WHERE tenantid = '". $row[0] ."' AND xdescription = 'Penalty'";
				$rescheckpenalty = mysql_query($sqlcheckpenalty, $connection);
				$rowcheckpenalty = mysql_fetch_array($rescheckpenalty);

			$sqlsales = " SELECT tenantid, fdtTrnsctn, SUM(fnmGrndTtlOld), SUM(fnmGrndTtlNew), SUM(fnmGTDlySls), SUM(fnmGTDscnt), SUM(fnmGTDscntSNR), SUM(fnmGTDscntPWD), SUM(fnmGTDscntGPC), SUM(fnmGTDscntVIP), SUM(fnmGTDscntEMP), SUM(fnmGTDscntREG), SUM(fnmGTDscntOTH), SUM(fnmGTRfnd), SUM(fnmGTCncld), SUM(fnmGTSlsVAT), SUM(fnmGTVATSlsInclsv), SUM(fnmGTVATSlsExclsv), SUM(fnmOffclRcptBeg), SUM(fnmOffclRcptEnd), SUM(fnmGTCntDcmnt), SUM(fnmGTCntCstmr), SUM(fnmGTCntSnrCtzn), SUM(fnmGTLclTax), SUM(fnmGTSrvcChrg), SUM(fnmGTSlsNonVat), SUM(fnmGTRwGrss), SUM(fnmGTLclTaxDly), fvcWrksttnNmbr, SUM(fnmGTPymntCSH), SUM(fnmGTPymntCRD), SUM(fnmGTPymntOTH) FROM db_sales WHERE tenantid = '". $row[0] ."' AND fdtTrnsctn = '". $date1 ."' GROUP BY Day(fdtTrnsctn) ";
				$ressales = mysql_query($sqlsales, $connection);
				while($rowsales = mysql_fetch_array($ressales)){

					?>
					<?php echo "<tr style='width: 100%;' id='".  $row[0] ."'> "; ?>
					    <td style='text-align: left; width:1%; white-space:nowrap;'><?php echo $row[1]; ?></td>
					    <td style='text-align: left; width:1%; white-space:nowrap;'><?php echo date('F', strtotime($rowsales[1]))." ".date('d', strtotime($rowsales[1])).",".$year ?></td>
						<td style='text-align: left; width:1%; white-space:nowrap;'><?php echo number_format($rowsales[4], 2, '.', ','); ?></td>
						<td style='text-align: left; width:1%; white-space:nowrap;'><?php echo number_format($rowsales[5], 2, '.', ','); ?></td>
						<td style='text-align: left; width:1%; white-space:nowrap;'><?php echo number_format($rowsales[6], 2, '.', ','); ?></td>
						<td style='text-align: left; width:1%; white-space:nowrap;'><?php echo number_format($rowsales[7], 2, '.', ','); ?></td>
						<td style='text-align: left; width:1%; white-space:nowrap;'><?php echo number_format($rowsales[8], 2, '.', ','); ?></td>
						<td style='text-align: left; width:1%; white-space:nowrap;'><?php echo number_format($rowsales[9], 2, '.', ','); ?></td>
						<td style='text-align: left; width:1%; white-space:nowrap;'><?php echo number_format($rowsales[10], 2, '.', ','); ?></td>
						<td style='text-align: left; width:1%; white-space:nowrap;'><?php echo number_format($rowsales[11], 2, '.', ','); ?></td>
						<td style='text-align: left; width:1%; white-space:nowrap;'><?php echo number_format($rowsales[12], 2, '.', ','); ?></td>
						<td style='text-align: left; width:1%; white-space:nowrap;'><?php echo number_format($rowsales[13], 2, '.', ','); ?></td>
						<td style='text-align: left; width:1%; white-space:nowrap;'><?php echo number_format($rowsales[14], 2, '.', ','); ?></td>
						<td style='text-align: left; width:1%; white-space:nowrap;'><?php echo number_format($rowsales[15], 2, '.', ','); ?></td>
						<td style='text-align: left; width:1%; white-space:nowrap;'><?php echo number_format($rowsales[16], 2, '.', ','); ?></td>
						<td style='text-align: left; width:1%; white-space:nowrap;'><?php echo number_format($rowsales[17], 2, '.', ','); ?></td>
						<td style='text-align: left; width:1%; white-space:nowrap;'><?php echo number_format($rowsales[18], 2, '.', ','); ?></td>
						<td style='text-align: left; width:1%; white-space:nowrap;'><?php echo number_format($rowsales[19], 2, '.', ','); ?></td>
						<td style='text-align: left; width:1%; white-space:nowrap;'><?php echo number_format($rowsales[20], 2, '.', ','); ?></td>
						<td style='text-align: left; width:1%; white-space:nowrap;'><?php echo number_format($rowsales[21], 2, '.', ','); ?></td>
						<td style='text-align: left; width:1%; white-space:nowrap;'><?php echo number_format($rowsales[22], 2, '.', ','); ?></td>
						<td style='text-align: left; width:1%; white-space:nowrap;'><?php echo number_format($rowsales[23], 2, '.', ','); ?></td>
						<td style='text-align: left; width:1%; white-space:nowrap;'><?php echo number_format($rowsales[24], 2, '.', ','); ?></td>
						<td style='text-align: left; width:1%; white-space:nowrap;'><?php echo number_format($rowsales[25], 2, '.', ','); ?></td>
						<td style='text-align: left; width:1%; white-space:nowrap;'><?php echo number_format($rowsales[26], 2, '.', ','); ?></td>
						<td style='text-align: left; width:1%; white-space:nowrap;'><?php echo number_format($rowsales[27], 2, '.', ','); ?></td>
						<td style='text-align: left; width:1%; white-space:nowrap;'><?php echo number_format($rowsales[29], 2, '.', ','); ?></td>
						<td style='text-align: left; width:1%; white-space:nowrap;'><?php echo number_format($rowsales[30], 2, '.', ','); ?></td>
						<td style='text-align: left; width:1%; white-space:nowrap;'><?php echo number_format($rowsales[31], 2, '.', ','); ?></td>
					</tr>";
				<?php
				}
			}
			echo "|". $row3[1]. " (".date('F d, Y', strtotime($date1)).")". "|" . $row2[1];
		break;

		case 'displaypenaltypertenant':
			$sql = " SELECT a.description, a.xdate, a.balance, a.xpenalty, b.tradename, a.tenantid, b.tenantid FROM tbltransaction AS a INNER JOIN tbltrans_tenants AS b ON a.tenantid = b.tenantid WHERE a.tenantid = '". $_POST['ptenantid'] ."' AND xdescription = 'Penalty' ";
			$res = mysql_query($sql, $connection);
			while($row = mysql_fetch_array($res)){

				$month = date('m', strtotime($row[1]));
				$arr = explode("0", $month);
				$year = date('Y', strtotime($row[1]));

				$sqlduedate = " SELECT month_period, year_period, DueDate FROM tbltrans_processedbill WHERE month_period = '". $arr[1] ."' AND year_period = '". $year ."' ";
				$resduedate = mysql_query($sqlduedate, $connection);
				while($rowduedate = mysql_fetch_array($resduedate)){
					?>
					<tr>
						<td width="20%" style="white-space:nowrap;"><?php echo $row[4]; ?></td>
						<td width="20%" style="white-space:nowrap;"><?php echo $row[0]; ?></td>
						<td width="20%" style="white-space:nowrap;"><?php echo $rowduedate[2]; ?></td>
						<td width="20%" style="white-space:nowrap;"><?php echo $row[2]; ?></td>
						<td width="20%" style="white-space:nowrap;"><?php echo $row[3]; ?></td>
					</tr>
					<?php
				}
			}
			break;

			case 'showtblaccreditationlist':
				$sql = " SELECT tenantid, Accreditation_ID, DateOfAccreditation, DateofCertification, OperatingSystem, SoftwareVersion, TextfileGeneration, stats, DateofExpiration, startdateofsendingfiles FROM tblaccreditation WHERE DateOfAccreditation BETWEEN '". date('Y-m-d', strtotime($_POST['dateFrom'])) ."' AND '". date('Y-m-d', strtotime($_POST['dateTo'])) ."' ";
				$res = mysql_query($sql, $connection);
				while($row = mysql_fetch_array($res)){
				
					if($row[7] == "Accredited"){
						$status = "<i class='fa fa-flag green'></i> Accredited";
					}
					else{
						$status = "<i class='fa fa-flag red'></i> Not Accredited";
					}

					if($row[2] == NULL || $row[2] == "" || $row[2] == "0000-00-00"){
						$petsa = "";
					}
					else{
						$petsa = date('Y-m-d', strtotime($row[2]));
					}

					if($row[3] == NULL || $row[3] == "" || $row[3] == "0000-00-00"){
						$petsa2 = "";
					}
					else{
						$petsa2 = date('Y-m-d', strtotime($row[3]));
					}

					if($row[8] == NULL || $row[8] == "" || $row[8] == "0000-00-00"){
						$petsa3 = "";
					}
					else{
						$petsa3 = date('Y-m-d', strtotime($row[8]));
					}

					if($row[9] == NULL || $row[9] == "" || $row[9] == "0000-00-00"){
						$petsa4 = "";
					}
					else{
						$petsa4 = date('Y-m-d', strtotime($row[9]));
					}

						$dateofshowing = date('Y-m-d', strtotime($row[8].'-3 months'));

					if($dateofshowing <= date('Y-m-d') ){
						$setsched= "style='display: inline;'";
					}else if($petsa3 == ""){
						$setsched= "style='display: none;'";
					}else{
						$setsched= "style='display: none;'";
					}

					echo "
						<tr>
							<td width='8%'>".$row[1]."</td>
							<td width='9%'>".$row[0]."</td>
							<td width='9%'>".$petsa."</td>
							<td width='8%'>".$petsa2."</td>
							<td width='8%'>".$petsa3."</td>
							<td width='8%'>".$petsa4."</td>
							<td width='8%'>".$row[4]."</td>
							<td width='8%'>".$row[5]."</td>
							<td width='8%'>".$row[6]."</td>
							<td width='8%'>".$status."</td>
							<td width='8%'>
								<div class='btn-group'>
									<button ".$setsched." class='btn btn-xs btn-warning' style='margin:1px;' title='Set Schedule' onclick='showaccreditationschedulemodal(\"".  $row[0] ."\")'>
										<i class='fa fa-calendar'></i>
									</button>
									<button class='btn btn-xs btn-danger' style='margin:1px;margin-top:-0px;' title='Set Schedule' onclick='setpenalty(\"".  $row[0] ."\")'>
										<i class='fa fa-exclamation-circle'></i>
									</button>
								</div>
							</td>
						</tr>
					";
				}
			break;

			case 'saveaccreditationschedule':
			$gagawin = $_POST['anogagawin'];
			$status = $_POST['accredtationstatus'];
            $Accreditation_ID = createidno("PACI", "tblaccreditation", "Accreditation_ID");
            $expiry = date('Y-m-d', strtotime('+1 year'));
			$alert = "";
			if($status == "Not Accredited"){
				$sql = " UPDATE tblaccreditation SET WrksttnNmbr = '". $_POST['macaddress'] ."', DateofCertification = '". $_POST['accreditationdate'] ."', OperatingSystem = '". $_POST['operatingsystem'] ."', SoftwareVersion = '". $_POST['softwareversion'] ."', NatureOfPos = '". $_POST['POSINFO'] ."', TextfileGeneration = '". $_POST['textfilegeneratortype'] ."', Remarks = '". $_POST['remarks'] ."', RetailPartnerName = '". $_POST['retailpartnername'] ."', NumberofPOS = '". $_POST['numberofpos'] ."', NameofPOSProvider = '". $_POST['nameofposprovider'] ."', MobileNumber = '". $_POST['mobilenumber'] ."' WHERE TenantID = '". $_POST['tenantid'] ."' ";
				$alert = "Accreditation schedule successfully updated.";
			}else if($status == "Accredited"){
				$sql = " UPDATE tblaccreditation SET WrksttnNmbr = '". $_POST['macaddress'] ."', DateofCertification = '". $_POST['accreditationdate'] ."', OperatingSystem = '". $_POST['operatingsystem'] ."', SoftwareVersion = '". $_POST['softwareversion'] ."', NatureOfPos = '". $_POST['POSINFO'] ."', TextfileGeneration = '". $_POST['textfilegeneratortype'] ."', Remarks = '". $_POST['remarks'] ."', RetailPartnerName = '". $_POST['retailpartnername'] ."', NumberofPOS = '". $_POST['numberofpos'] ."', NameofPOSProvider = '". $_POST['nameofposprovider'] ."', MobileNumber = '". $_POST['mobilenumber'] ."', Accreditation_ID = '". $Accreditation_ID ."', DateofCertification = '". date('Y-m-d') ."', DateofExpiration = '". $expiry ."', stats = 'Accredited', StartDateofSendingFiles = '". date('Y-m-d', strtotime($_POST['startdateofsendingfiles'])) ."' WHERE TenantID = '". $_POST['tenantid'] ."' ";
				$alert = "Accreditation schedule successfully updated.";
			}
				$res = mysql_query($sql, $connection);
				if($res == true){
					echo $alert . "|" . $_POST['tenantid'];
				}
				else{
					echo "Something Went Wrong.";
				}
			break;

			case 'saveschedule':

				$sqlcheck = " SELECT COUNT(TenantID) FROM tblaccreditation WHERE TenantID = '". $_POST['tenantid'] ."' ";
				$rescheck = mysql_query($sqlcheck, $connection);
				$rowcheck = mysql_fetch_array($rescheck);
					if($rowcheck[0] > 0){
						echo 1;
					}else{
						$sql = " INSERT INTO tblaccreditation SET TenantID = '". $_POST['tenantid'] ."', DateOfAccreditation = '". date('Y-m-d', strtotime($_POST['accreditationdate'])) ."', RetailPartnerName = '". $_POST['retailpartnername'] ."', SoftwareVersion = '". $_POST['softwareversion'] ."', OperatingSystem = '". $_POST['operatingsystem'] ."', NumberofPOS = '". $_POST['numberofpos'] ."', Remarks = '". $_POST['remarks'] ."', NameofPOSProvider = '". $_POST['nameofposprovider'] ."', MobileNumber = '". $_POST['mobilenumber'] ."', NatureOfPos = '". $_POST['POSINFO'] ."', TextfileGeneration = '". $_POST['textfilegeneratortype'] ."', WrksttnNmbr = '". $_POST['macaddress'] ."' ";
						$res = mysql_query($sql, $connection);
						$row = mysql_fetch_array($res);
						echo $_POST['tenantid'];
					}
			break;

			case 'showaccreditationschedulemodal':
				$sql = " SELECT WrksttnNmbr, DateOfAccreditation, OperatingSystem, SoftwareVersion, NatureOfPos, TextfileGeneration, remarks, RetailPartnerName, NumberofPOS, NameofPOSProvider, MobileNumber, Accreditation_ID, stats FROM tblaccreditation WHERE TenantID = '". $_POST['tenantid'] ."' ";
				$res = mysql_query($sql, $connection);
				$row = mysql_fetch_array($res);

				if ($row[12]  == 'Accredited'){
					$stats = "<option value='Accredited'> Accredited </option><option value='Not Accredited'> Not Accredited </option>";
				}
				else{
					$stats = "<option value='Accredited'>Not Accredited </option><option value='Not Accredited'> Accredited </option>";
				}

				$arr3 = explode("|", $row[4]);
				$alskd = count($arr3)-1;
				echo $row[0] . "#" . $row[1] . "#" . $row[2] . "#" . $row[3] . "#" . $row[4] . "#" . $row[5] . "#" . $row[6] . "#" . $row[7] . "#" . $row[8] . "#" . $row[9] . "#" . $row[10] . "#" . $row[11] . "#" . $alskd;
			break;

			case 'setpenalty':
				$sql = " INSERT INTO tbltransaction SET TenantID = '". $_POST['tenantid'] ."', description = '". $_POST['reasonforpenalty'] ."', amount = '". $_POST['amountforpenalty'] ."', balance = '". $_POST['amountforpenalty'] ."', xpenalty = '". $_POST['amountforpenalty'] ."', totalamount = '". $_POST['amountforpenalty'] ."', xdate = '".  date('Y-m-d') ."', xdatetime = '". date('Y-m-d H:i:s') ."', xdescription = 'Penalty', checkdate = '0000-00-00' ";
				$res = mysql_query($sql, $connection);
				if($res == true){
					echo "Penalty has been set.";
				}else{
					echo "Something Went Wrong.";
				}
			break;

			case 'loadentriesofaccreditation':
               	$limit = ($page-1) * 20;

                $sql = "SELECT COUNT(*) FROM tblaccreditation WHERE DateOfAccreditation BETWEEN '". date('Y-m-d', strtotime($_POST['dateFrom'])) ."' AND '". date('Y-m-d', strtotime($_POST['dateTo'])) ."'	 ";
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

    		case "loadpageofaccreditation":
    		    $page = $_POST["page"];

            	$sqlb = "SELECT COUNT(*) FROM tblaccreditation WHERE DateOfAccreditation BETWEEN '". date('Y-m-d', strtotime($_POST['dateFrom'])) ."' AND '". date('Y-m-d', strtotime($_POST['dateTo'])) ."'	 ";
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
    			   echo "<li style='width:50px !important;' onclick='paginationofaccreditation(1)'><< First</li>";
    			   $prevpage = $page - 1;
    			   echo "<li style='width:70px !important;' onclick='paginationofaccreditation(". $prevpage .")'>< Previous</li>";
    			}

    			for($x = ($page - $range); $x < (($page + $range) + 1); $x++)
    			{
    			   if (($x > 0) && ($x <= $totalpages)){
        			    if ($x == $page){
                            echo "<li id='pgaccreditation" . $x . "' class='pgnumpaccreditation active' onclick='paginationofaccreditation(" . $x . ",". $x .")'>" . $x . "</li>";
                          }
        			    else{
        			        echo "<li id='pgaccreditation" . $x . "' class='pgnumpaccreditation' onclick='paginationofaccreditation(" . $x . ",". $x .")'>" . $x . "</li>";
                        }
    		       }
    		    }
    		    if($page < ($totalpages - $range)){
                    echo "<li>...</li>";
                }

    		    if ($page != $totalpages && $num != 0){
    		       $nextpage = $page + 1;
    		       echo "<li style='width:50px !important;' onclick='paginationofaccreditation(". $nextpage .", ". $nextpage .")'>Next ></li>";
    		       echo "<li style='width:50px !important;' onclick='paginationofaccreditation(". $totalpages .", ". $totalpages .")'>Last >></li>";
    		    }
    		break;

    		case 'printaccreditation':
				$sql = " SELECT tenantid, Accreditation_ID, DateOfAccreditation, DateofCertification, OperatingSystem, SoftwareVersion, TextfileGeneration, stats, DateofExpiration FROM tblaccreditation WHERE DateOfAccreditation BETWEEN '". date('Y-m-d', strtotime($_POST['dateFrom'])) ."' AND '". date('Y-m-d', strtotime($_POST['dateTo'])) ."' AND stats = 'Not Accredited' ";
				$res = mysql_query($sql, $connection);
				while($row = mysql_fetch_array($res)){

					if($row[7] == "Accredited"){
						$status = "<i class='fa fa-flag green'></i> Accredited";
					}
					else{
						$status = "<i class='fa fa-flag red'></i> Not Accredited";
					}

					if($row[2] == NULL || $row[2] == "" || $row[2] == "0000-00-00"){
						$petsa = "";
					}
					else{
						$petsa = date('Y-m-d', strtotime($row[2]));
					}

					if($row[3] == NULL || $row[3] == "" || $row[3] == "0000-00-00"){
						$petsa2 = "";
					}
					else{
						$petsa2 = date('Y-m-d', strtotime($row[3]));
					}

					if($row[8] == NULL || $row[8] == "" || $row[8] == "0000-00-00"){
						$petsa3 = "";
					}
					else{
						$petsa3 = date('Y-m-d', strtotime($row[8]));
					}

						$dateofshowing = date('Y-m-d', strtotime($row[8].'-3 months'));

					if($dateofshowing <= date('Y-m-d') ){
						$setsched= "style='display: inline;'";
					}else if($petsa3 == ""){
						$setsched= "style='display: none;'";
					}else{
						$setsched= "style='display: none;'";
					}

					echo "
						<tr>
							<td width='20%'>".$row[0]."</td>
							<td width='15%'>".$petsa."</td>
							<td width='15%'>".$row[4]."</td>
							<td width='20%'>".$row[5]."</td>
							<td width='15%'>".$row[6]."</td>
							<td width='15%'>".$status."</td>
						</tr>
					";
   				}
			break;

			case 'updateaccreditationinfo':
				$sql = "SELECT TenantID, StartDateofSendingFiles, NumberofPOS FROM tblaccreditation WHERE stats = 'Accredited' AND startdateofsendingfiles = '". date('Y-m-d') ."' ";
				$res = mysql_query($sql, $connection);
				while($row = mysql_fetch_array($res)){
					if($row[0] != ""){
						$sqlupdate = " UPDATE tbltrans_tenants SET uploadingoffiles = '1', withPOS = '". $row[2] ."' WHERE TenantID = '". $row[0] ."' ";
						$resupdate = mysql_query($sqlupdate, $connection);
						$rowupdate = mysql_fetch_array($resupdate);
					}
				}
			break;

			case 'showtenantlistthatisnotaccreditedyet':
				echo "<option value=''>-- Select Tenant --</option>";
				$sql = " SELECT TenantID,tradename FROM tbltrans_tenants WHERE withPOS = '0' ";
				$res = mysql_query($sql, $connection);
				while($row=mysql_fetch_array($res)){
					echo "<option value='". $row[0] ."'>". $row[1] ."</option>";
				}
			break;
		
	}
?>