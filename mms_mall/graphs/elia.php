<?php

include ("connect_acctg.php");

   
   
   	$strQuery = "SELECT YEAR(a.`Batch_Date`), 

SUM(CASE WHEN b.`SubheaderDesc` = 'Accounts and Other Payables' THEN b.`BeginningBal` + (a.`Credit` - a.`Debit`) ELSE 0 END) + 
SUM(CASE WHEN b.`SubheaderDesc` = 'Long-term debt - net of current portion' THEN b.`BeginningBal` + (a.`Credit` - a.`Debit`) ELSE 0 END) +
SUM(CASE WHEN b.`SubheaderDesc` = 'Income Tax Payable' THEN b.`BeginningBal` + (a.`Credit` - a.`Debit`) ELSE 0 END)
AS 'Total Current Liabilities',

SUM(CASE WHEN b.`SubheaderDesc` = 'Other Non-current liabilities' THEN b.`BeginningBal` + (a.`Credit` - a.`Debit`) ELSE 0 END) + 
SUM(CASE WHEN b.`SubheaderDesc` = 'Customers` Advances and Deposits' THEN b.`BeginningBal` + (a.`Credit` - a.`Debit`) ELSE 0 END) +
SUM(CASE WHEN b.`SubheaderDesc` = 'Due to Related Parties' THEN b.`BeginningBal` + (a.`Credit` - a.`Debit`) ELSE 0 END)
AS 'Total  Liabilities',
SUM(CASE WHEN b.`SubheaderDesc` = 'Capital Stock' THEN b.`BeginningBal` + (a.`Credit` - a.`Debit`) ELSE 0 END) + 
SUM(CASE WHEN b.`SubheaderDesc` = 'Additional Paid-in Capital' THEN b.`BeginningBal` + (a.`Credit` - a.`Debit`) ELSE 0 END) +
SUM(CASE WHEN b.`SubheaderDesc` = 'Retained Earnings' THEN b.`BeginningBal` + (a.`Credit` - a.`Debit`) ELSE 0 END)
AS 'Stockholders Equity'


FROM gltransjournal AS a
LEFT JOIN refchart AS b ON a.`GLAccount_Code` = b.`GLAccount_Code`
GROUP BY YEAR(a.`Batch_Date`)
";

     	// Execute the query, or else return the error message.
$result = $dbhandle->query($strQuery) or exit("Error code ({$dbhandle->errno}): {$dbhandle->error}");

    if ($result) {
         $arrData = array(
        "chart" => array(
            "caption"=> "Liability and Equity",
            "subCaption"=> "Yearly",
            "xAxisname"=> "Year",
            "yAxisName"=> "Total",
            "legendItemFontColor"=> "#666666",
		  
		  "formatNumberScale" =>"0",
			 "placeValuesInside"=>"0",
			"rotateValues"=>"0",
			"decimalSeparator" =>".",
			"thousandSeparator" => ",",
			"valueFontColor" => "#000000",
			"valueBgColor"=> "#FFFFFF",
			"valueBgAlpha"=> "50",
			
			 "baseFont"=>"Arial",
                "baseFontSize"=>"12",
                "baseFontColor"=>"#0066cc",
		  
			 "xAxisNameFont" =>"Arial",
                "xAxisNameFontSize"=> "12",
                "xAxisNameFontColor"=> "#993300",
                "xAxisNameFontBold"=> "1",
                "xAxisNameFontItalic"=> "1",
                "xAxisNameAlpha"=> "80",
			 
			 "yAxisNameFont"=> "Arial",
                "yAxisNameFontSize"=> "12",
                "yAxisNameFontColor"=> "#993300",
                "yAxisNameFontBold"=> "1",
                "yAxisNameFontItalic"=> "1",
                "yAxisNameAlpha"=> "80",
			 
            "theme"=> "zune"
            )
          );

        	$arrData["data"] = array();
			
			
			 $categoryArray=array();
          $dataseries1=array();
          $dataseries2=array();
		  $dataseries3=array();
	// Push the data into the array
        	while($row = $result->fetch_array()) {
				 array_push($categoryArray, array(
                  "label" => $row[0]
          			)
        			);
        array_push($dataseries1, array(
          "value" => $row[1],
		  "showValue" => "1",
		  "color" => "#D64541"
          )
        );

        array_push($dataseries2, array(
          "value" => $row[2],
		  "showValue" => "1",
		  "color" => "#AEA8D3"
         	 )
       		 );
	     array_push($dataseries3, array(
          "value" => $row[3],
		  "showValue" => "1",
		  "color" => "#03C9A9"
         	 )
       		 );
        	}
$arrData["categories"]=array(array("category"=>$categoryArray));
      // creating dataset object
      $arrData["dataset"] = array(array("seriesName"=> "Current Liabilities", "data"=>$dataseries1), array("seriesName"=> "Liabilities",   "data"=>$dataseries2)
	  , array("seriesName"=> "Stockholders Equity",   "data"=>$dataseries3));
           /*JSON Encode the data to retrieve the string containing the JSON representation of the data in the array. */

        	$jsonEncodedData = json_encode($arrData);

      	  /*Create an object for the column chart using the FusionCharts PHP class constructor. Syntax for the constructor is `FusionCharts("type of chart", "unique chart id", "width of chart", "height of chart", "div id to render the chart", "data format", "data source")`.*/

        	$columnChart = new FusionCharts("mscolumn2d", "elia" , "100%", 380, "rrcomp2", "json", $jsonEncodedData);

        	// Render the chart
        	$columnChart->render();

        	// Close the database connection
        	$dbhandle->close();
     	}
?>
<div id="rrcomp2"><!-- Fusion Charts will render here--></div>