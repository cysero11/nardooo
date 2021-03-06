<?php
 
include ("connect_acctg.php");

 $dbhandle = new mysqli($hostdb, $userdb, $passdb, $namedb);

   // Render an error message, to avoid abrupt failure, if the database connection parameters are incorrect
   if ($dbhandle->connect_error) {
    exit("There was an error with your connection: ".$dbhandle->connect_error);
   }

   
   $strQuery = "SELECT YEAR(a.`Batch_Date`), SUM(CASE WHEN b.`SubheaderDesc` = 'Cash and Cash Equivalents' THEN b.`BeginningBal` + (a.`Debit` - a.`Credit`) ELSE 0 END) AS debit, b.`HeaderDesc` FROM gltransjournal AS a
LEFT JOIN refchart AS b ON a.`GLAccount_Code` = b.`GLAccount_Code`
GROUP BY YEAR(a.`Batch_Date`)
";

    //select dota2.wr, lol.ar, from dota2, lol WHERE dota2.wr = lol.ar
    //dota2.wr = tae;
    //lol.ar - tae;



/*SELECT e1.* FROM 
(SELECT DISTINCT salary FROM po ORDER BY salary DESC LIMIT 10 ) S1
JOIN podetailes  e1 
ON e1.salary = s1.salary 
ORDER BY e1.`quantity` DESC */ 

/*select b.`Category`, SUM(a.QtyActual * a.Cost) from actualcountd as a
LEFT JOIN itemlist AS b ON a.`PCnumber` = b.`PC_BATCH`
WHERE b.`Category` <> '' AND b.`Category` IS NOT NULL
GROUP BY b.`Category` order by SUM(a.QtyActual * a.Cost) DESC*/

     	// Execute the query, or else return the error message.
     	$result = $dbhandle->query($strQuery) or exit("Error code ({$dbhandle->errno}): {$dbhandle->error}");

     	// If the query returns a valid response, prepare the JSON string
     	if ($result) {
        	// The `$arrData` array holds the chart attributes and data
        	$arrData = array(
                "chart" => array(
				     "legendPosition" => "right",
                    "showValues"=> "1",
					 "showLabels" => "1",
					 "showPercentValues" => "1",
                  "xAxisname"=> "Dues",
            "yAxisName"=> "Total",
					"baseFont" => "Arial",
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
				
                    "theme"=> "ocean"
              	)
           	);

        	$arrData["data"] = array();

	// Push the data into the array


        	while($row = mysqli_fetch_array($result)) {
           	array_push($arrData["data"], array(
                "label" => $row[0],    
                "value" => $row[1],
				"color" => "#22313F"
              	)
           	);
        	} 

        	/*JSON Encode the data to retrieve the string containing the JSON representation of the data in the array. */

        	$jsonEncodedData = json_encode($arrData);

        	/*Create an object for the column chart. Initialize this object using the FusionCharts PHP class constructor. The constructor is used to initialize the chart type, chart id, width, height, the div id of the chart container, the data format, and the data source. */

        	$columnChart = new FusionCharts("column2d", "a" , "100%", 450, "asset", "json", $jsonEncodedData);

        	// Render the chart
        	$columnChart->render();

        	// Close the database connection
        	$dbhandle->close();

     	}

       // $tae = $row[0];

?>

        
<div id = "asset"></div> 






