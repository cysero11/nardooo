<?php
include ("connect.php");

$strQuery = "SELECT Violation, COUNT(Violation)
FROM tblmaintenance_hrviolators
GROUP BY Violation
";

     	// Execute the query, or else return the error message.
     	$result = $dbhandle->query($strQuery) or exit("Error code ({$dbhandle->errno}): {$dbhandle->error}");

     	// If the query returns a valid response, prepare the JSON string
     	if ($result) {
        	// The `$arrData` array holds the chart attributes and data
        	$arrData = array(
                "chart" => array(
				"showlegend" => "1",
                    "legendPosition" => "right",
                    "showValues"=> "1",
					 "showLabels" => "1",
					 "showPercentValues" => "1",
                   
				   "xAxisname"=> "Violation",
            "yAxisName"=> "Total",
				 	"showlegend" => "1",
                    "caption" => "Cash and Cash Equivalents",
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
				
				 	"showlegend" => "1",
                    "caption" => "Most House Rules Violated of the Tenants",
                    "theme"=> "ocean"
              	)
           	);

        	$arrData["data"] = array();
			$total = "";
	// Push the data into the array

        	while($row = mysqli_fetch_array($result)) {
           	array_push($arrData["data"], array(
                "label" => $row[0],
                "value" => $row[1],
				"color" => "#1F3A93"
              	)
           	);
        	}

        	/*JSON Encode the data to retrieve the string containing the JSON representation of the data in the array. */

        	$jsonEncodedData = json_encode($arrData);

        	/*Create an object for the column chart. Initialize this object using the FusionCharts PHP class constructor. The constructor is used to initialize the chart type, chart id, width, height, the div id of the chart container, the data format, and the data source. */

        	$columnChart = new FusionCharts("column2D", "violation" , "100%", 450, "hr", "json", $jsonEncodedData);

        	// Render the chart
        	$columnChart->render();

        	// Close the database connection
        	$dbhandle->close();

     	}
?>

<div id="hr"><!-- Fusion Charts will render here--></div>