<?php

include ("connect.php");
   
   
   	$strQuery = "SELECT MONTHNAME(dateadded),COUNT(unitid),
SUM(IF(STATUS = 'reserved',1,0)) AS 'Reserved',
SUM(IF(STATUS = 'occupied',1,0)) AS 'Occupied'
FROM tblref_unit
GROUP BY MONTHNAME(dateadded) ORDER BY MONTH(dateadded)
";

     	// Execute the query, or else return the error message.
     	$result = $dbhandle->query($strQuery) or exit("Error code ({$dbhandle->errno}): {$dbhandle->error}");

    if ($result) {
         $arrData = array(
        "chart" => array(
            "caption"=> "Occupancy Report for ".date("Y"),
            "subCaption"=> "Monthly",
            "xAxisname"=> "Month",
            "yAxisName"=> "Total",
            "legendItemFontColor"=> "#666666",
		  
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
          "value" => "100",
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
      $arrData["dataset"] = array(array("seriesName"=> "Total No. of Units", "data"=>$dataseries1), array("seriesName"=> "Turned over Units Developer to Owner",  "renderAs"=>"line", "data"=>$dataseries2),
		array("seriesName"=> "Moved-in (Actual)", "data"=>$dataseries3));
           /*JSON Encode the data to retrieve the string containing the JSON representation of the data in the array. */

        	$jsonEncodedData = json_encode($arrData);

      	  /*Create an object for the column chart using the FusionCharts PHP class constructor. Syntax for the constructor is `FusionCharts("type of chart", "unique chart id", "width of chart", "height of chart", "div id to render the chart", "data format", "data source")`.*/

        	$columnChart = new FusionCharts("mscolumn2d", "occrep" , "100%", 350, "rep1", "json", $jsonEncodedData);

        	// Render the chart
        	$columnChart->render();

        	// Close the database connection
        	$dbhandle->close();
     	}
?>
<div id="rep1"><!-- Fusion Charts will render here--></div>