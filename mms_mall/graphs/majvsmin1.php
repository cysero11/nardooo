<?php

include ("connect.php");
   
   
   	$strQuery = "SELECT Monthname(Date_Entry),
SUM(IF(Priority_Status = 'High',1,0)) AS 'Major',
SUM(IF(Priority_Status = 'Medium',1,0)) AS 'Major',
SUM(IF(Priority_Status = 'Low',1,0)) AS 'Low'
FROM tblcomplaints 
GROUP BY MONTHNAME(Date_Entry) ORDER BY MONTH(Date_Entry)
";

     	// Execute the query, or else return the error message.
     	$result = $dbhandle->query($strQuery) or exit("Error code ({$dbhandle->errno}): {$dbhandle->error}");

    if ($result) {
         $arrData = array(
        "chart" => array(
            "caption"=> "Incident Report",
            "subCaption"=> "Monthly",
            "xAxisname"=> "Month",
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
                "baseFontSize"=>"14",
              
		  
			 "xAxisNameFont" =>"Arial",
                "xAxisNameFontSize"=> "14",
                "xAxisNameFontColor"=> "#993300",
                "xAxisNameFontBold"=> "1",
                "xAxisNameFontItalic"=> "1",
                "xAxisNameAlpha"=> "80",
			 
			 "yAxisNameFont"=> "Arial",
                "yAxisNameFontSize"=> "14",
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
      $arrData["dataset"] = array(array("seriesName"=> "Major", "data"=>$dataseries1), array("seriesName"=> "Medium",  "renderAs"=>"line", "data"=>$dataseries2),
		array("seriesName"=> "Minor", "data"=>$dataseries3));
           /*JSON Encode the data to retrieve the string containing the JSON representation of the data in the array. */

        	$jsonEncodedData = json_encode($arrData);

      	  /*Create an object for the column chart using the FusionCharts PHP class constructor. Syntax for the constructor is `FusionCharts("type of chart", "unique chart id", "width of chart", "height of chart", "div id to render the chart", "data format", "data source")`.*/

        	$columnChart = new FusionCharts("msline", "comapare" , "100%", 450, "rrcomp1", "json", $jsonEncodedData);

        	// Render the chart
        	$columnChart->render();

        	// Close the database connection
        	$dbhandle->close();
     	}
?>
<div id="rrcomp1"><!-- Fusion Charts will render here--></div>