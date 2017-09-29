

<?php
include ("connect.php");

$strQuery = "SELECT MONTHNAME(dateposted), COUNT(*)
FROM tblmaintenance_workorderlist
WHERE xcategory = 'CAT-000002'
AND dateposted IS NOT NULL
GROUP BY MONTHNAME(dateposted)
ORDER BY MONTH(dateposted)
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
                    "theme"=> "zune",
					"baseFont" => "Arial",
				 	"showlegend" => "1",
					"baseFontSize" => "20",
					"valueFontSize" => "20",
                    "caption" => "Electrical",
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
				"color" => "#F22613"
              	)
           	);
        	}

        	/*JSON Encode the data to retrieve the string containing the JSON representation of the data in the array. */

        	$jsonEncodedData = json_encode($arrData);

        	/*Create an object for the column chart. Initialize this object using the FusionCharts PHP class constructor. The constructor is used to initialize the chart type, chart id, width, height, the div id of the chart container, the data format, and the data source. */

        	$columnChart = new FusionCharts("column2D", "con2" , "100%", 400, "electrical", "json", $jsonEncodedData);

        	// Render the chart
        	$columnChart->render();

        	// Close the database connection
        	$dbhandle->close();

     	}
?>

<div id="electrical"><!-- Fusion Charts will render here--></div>