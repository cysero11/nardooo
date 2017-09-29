<?php

include ("connect.php");

   
   $strQuery = "SELECT MONTHNAME(dateposted), IF(YEAR(DATE_SUB(NOW(), INTERVAL 1 YEAR)) = YEAR(dateposted),  meter_reading,0) AS 'Previous Year',
IF(YEAR(CURDATE()) = YEAR(dateposted), meter_reading,0) AS 'Current Year'
FROM tblmaintenance_workorderlist
WHERE xcategory = 'CAT-000006'
AND dateposted IS NOT NULL
GROUP BY MONTHNAME(dateposted)
ORDER BY Month(dateposted)

";

     	// Execute the query, or else return the error message.
     	$result = $dbhandle->query($strQuery) or exit("Error code ({$dbhandle->errno}): {$dbhandle->error}");

    if ($result) {
         $arrData = array(
        "chart" => array(
            "caption"=> "Water Reading Comparison",
            "subCaption"=> "Previous Year vs Current Year",
            "xAxisname"=> "Month",
            "yAxisName"=> "m3",
		  
		   "baseFont"=>"Arial",
                "baseFontSize"=>"14",
                
		  
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
			 
			 
            "legendItemFontColor"=> "#666666",
		
            "theme"=> "zune"
            )
          );

        	$arrData["data"] = array();
			
			
			 $categoryArray=array();
          $dataseries1=array();
          $dataseries2=array();
	// Push the data into the array
        	while($row = $result->fetch_array()) {
				 array_push($categoryArray, array(
                  "label" => $row[0]
          			)
        			);
        array_push($dataseries1, array(
          "value" => "200",
		  "showValue" => "1",
		  "color" => "#663399",
		  "link" => "cost.php?Month=".$row[0]
          )
        );

        array_push($dataseries2, array(
          "value" => $row[2],
		  "showValue" => "1",
		  "link" => "srp.php?Month=".$row[0]
         	 )
       		 );
			 
        	}
        $arrData["categories"]=array(array("category"=>$categoryArray));
      // creating dataset object
      $arrData["dataset"] = array(array("seriesName"=> "Previous Year", "data"=>$dataseries1, "color" => "#663399"), array("seriesName"=> "Current Year",  "renderAs"=>"line", "data"=>$dataseries2, "color" => "#336E7B"));
           /*JSON Encode the data to retrieve the string containing the JSON representation of the data in the array. */

        	$jsonEncodedData = json_encode($arrData);

      	  /*Create an object for the column chart using the FusionCharts PHP class constructor. Syntax for the constructor is `FusionCharts("type of chart", "unique chart id", "width of chart", "height of chart", "div id to render the chart", "data format", "data source")`.*/

        	$columnChart = new FusionCharts("mscolumn2d", "water" , "100%", 400, "wat", "json", $jsonEncodedData);

        	// Render the chart
        	$columnChart->render();

        	// Close the database connection
        	$dbhandle->close();
     	
     	}

?>

<div id = "wat"></div>
