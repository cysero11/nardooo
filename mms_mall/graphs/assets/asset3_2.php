<?php
include ("connect_acctg.php");
include ("fusioncharts.php");

$countryCode = $_GET["Month"];
		

     	// Form the SQL query that returns the top 10 most populous cities in the selected country
     	$cityQuery = "select DAY(a.`Batch_Date`),  SUM(CASE WHEN b.`SubheaderDesc` = 'Prepayments and other current assets' THEN b.`BeginningBal` + (a.`Debit` - a.`Credit`) ELSE 0 END) AS debit, b.`HeaderDesc` FROM gltransjournal AS a
LEFT JOIN refchart AS b ON a.`GLAccount_Code` = b.`GLAccount_Code`
WHERE Monthname(a.`Batch_Date`) = ?
GROUP BY DAY(a.`Batch_Date`)
ORDER BY DAY(a.`Batch_Date`)
";

$cityPrepStmt = $dbhandle->prepare($cityQuery);

     	// If there is an error in the statement, exit with an error message
     	if($cityPrepStmt === false) {
        	exit("Error while preparing the query to fetch data from City Table. ".$dbhandle->error);
     	}

     	// Bind the parameters to the query prepared
     	$cityPrepStmt->bind_param("s", $countryCode);

     	// Execute the query
     	$cityPrepStmt->execute();

     	// Get the results from the query executed
     	$cityResult = $cityPrepStmt->get_result();

     	// If the query returns a valid response, prepare the JSON string
     	if ($cityResult) {

        	/* Form the SQL query that will return the country name based on the country code. The result of the above query contains only the country code. The country name is needed to be rendered as a caption for the chart that shows the 10 most populous cities */

        	$countryNameQuery = "SELECT YEAR(Batch_Date)from gltransjournal where YEAR(Batch_Date) = ?";

        	// Prepare the query statement
        	$countryPrepStmt = $dbhandle->prepare($countryNameQuery);

        	// If there is an error in the statement, exit with an error message
        	if($countryPrepStmt === false) {
           	exit("Error while preparing the query to fetch data from Country Table. ".$dbhandle->error);
        	}

        	// Bind the parameters to the query prepared
        	$countryPrepStmt->bind_param("s", $countryCode);

        	// Execute the query
        	$countryPrepStmt->execute();

        	// Bind the country name to the variable `$countryName`
        	$countryPrepStmt->bind_result($countryName);

        	// Fetch the result from prepared statement
        	$countryPrepStmt->fetch();

        	// The `$arrData` array holds the chart attributes and data
        	$arrData = array(
                "chart" => array(
				    "showlegend" => '1',
					"showLabel" => "1",
					"numberPrefix" => "₱",
                    "caption" => "Daily Prepayments and other current assets of  ".$countryName,
                    "showValues"=> "1",
                    "theme"=> "zune"
              	)
           	);

        	$arrData["data"] = array();

	// Push the data into the array
        	while($row = $cityResult->fetch_array()) {
                array_push($arrData["data"], array(
              	"label" => $row[0],
              	"value" => $row[1],
				"color" => "#68C3A3"
              	)
           	);
        	}

           /*JSON Encode the data to retrieve the string containing the JSON representation of the data in the array. */

        	$jsonEncodedData = json_encode($arrData);

      	  /*Create an object for the column chart using the FusionCharts PHP class constructor. Syntax for the constructor is `FusionCharts("type of chart", "unique chart id", "width of chart", "height of chart", "div id to render the chart", "data format", "data source")`.*/

        	$columnChart = new FusionCharts("line", "oca" , "100%", 450, "quarter", "json", $jsonEncodedData);

        	// Render the chart
        	$columnChart->render();


        	// Close the database connection
        	$dbhandle->close();
     	}
  	?>
  	<div id="quarter"><!-- Fusion Charts will render here--></div>
