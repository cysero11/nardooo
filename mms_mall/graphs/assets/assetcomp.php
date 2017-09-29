<?php

include ("connect_acctg.php");

   
   
   	$strQuery = "SELECT  YEAR(a.`Batch_Date`) ,
SUM(CASE WHEN b.`SubheaderDesc` = 'CASH & CASH EQUIVALENT' THEN b.`BeginningBal` + (a.`Debit` - a.`Credit`) ELSE 0 END)
AS 'Cash and Cash Equivalents',
SUM(CASE WHEN b.`SubheaderDesc` = 'TRADE & OTHER RECEIVABLES' THEN b.`BeginningBal` + (a.`Debit` - a.`Credit`) ELSE 0 END)
AS 'Receivables',
SUM(CASE WHEN b.`SubheaderDesc` = 'INVENTORIES' THEN b.`BeginningBal` + (a.`Debit` - a.`Credit`) ELSE 0 END)
AS 'Inventories',
SUM(CASE WHEN b.`SubheaderDesc` = 'OTHER ASSETS' THEN b.`BeginningBal` + (a.`Debit` - a.`Credit`) ELSE 0 END)
AS 'Prepayments and other current assets',
FORMAT(SUM(CASE WHEN b.`SubheaderDesc` = 'CASH & CASH EQUIVALENT' AND b.`GLType` = 'DEBIT' THEN b.`BeginningBal` + (a.`Debit` - a.`Credit`) ELSE 0 END)+
SUM(CASE WHEN b.`SubheaderDesc` = 'TRADE & OTHER RECEIVABLES' AND b.`GLType` = 'DEBIT' THEN b.`BeginningBal` + (a.`Debit` - a.`Credit`) ELSE 0 END) +
SUM(CASE WHEN b.`SubheaderDesc` = 'INVENTORIES' AND b.`GLType` = 'DEBIT' THEN a.`Debit` ELSE 0 END) +
SUM(CASE WHEN b.`SubheaderDesc` = 'OTHER ASSETS' AND b.`GLType` = 'DEBIT'THEN b.`BeginningBal` + (a.`Debit` - a.`Credit`) ELSE 0 END),2) AS 'Total Assets'
FROM gltransjournal AS a
LEFT JOIN refchart AS b ON a.`GLAccount_Code` = b.`GLAccount_Code`
WHERE YEAR(a.`Batch_Date`) =  '2015'
";

     	// Execute the query, or else return the error message.
$result = $dbhandle->query($strQuery) or exit("Error code ({$dbhandle->errno}): {$dbhandle->error}");

    if ($result) {
         $arrData = array(
        "chart" => array(
            "caption"=> "Assets",
            "subCaption"=> "Yearly",
            "xAxisname"=> "Year",
            "yAxisName"=> "Total",
            "legendItemFontColor"=> "#666666",
		  
		   "baseFont"=>"Arial",
                "baseFontSize"=>"14",
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
		  "showValue" => "1"
          )
        );

        array_push($dataseries2, array(
          "value" => $row[2],
		  "showValue" => "1"
         	 )
       		 );
	     array_push($dataseries3, array(
          "value" => $row[3],
		  "showValue" => "1"
         	 )
       		 );
        	}
$arrData["categories"]=array(array("category"=>$categoryArray));
      // creating dataset object
      $arrData["dataset"] = array(array("seriesName"=> "Current Assets", "data"=>$dataseries1), array("seriesName"=> "Fixed Assets",   "data"=>$dataseries2)
	  , array("seriesName"=> "Intangible Assets",   "data"=>$dataseries3));
           /*JSON Encode the data to retrieve the string containing the JSON representation of the data in the array. */

        	$jsonEncodedData = json_encode($arrData);

      	  /*Create an object for the column chart using the FusionCharts PHP class constructor. Syntax for the constructor is `FusionCharts("type of chart", "unique chart id", "width of chart", "height of chart", "div id to render the chart", "data format", "data source")`.*/

        	$columnChart = new FusionCharts("mscolumn2d", "comapare" , "100%", 380, "rrcomp1", "json", $jsonEncodedData);

        	// Render the chart
        	$columnChart->render();

        	// Close the database connection
        	$dbhandle->close();
     	}
?>
<div id="rrcomp1"><!-- Fusion Charts will render here--></div>