<?php

include ("connect.php");

 $dbhandle = new mysqli($hostdb, $userdb, $passdb, $namedb);

   // Render an error message, to avoid abrupt failure, if the database connection parameters are incorrect
   if ($dbhandle->connect_error) {
    exit("There was an error with your connection: ".$dbhandle->connect_error);
   }

   
   $strQuery = "select YEAR(a.`Batch_Date`), sum(a.`Credit`) as debit, b.`HeaderDesc` from gltransjournal as a
left join refchart as b on a.`GLAccount_Code` = b.`GLAccount_Code`
where b.`SubheaderDesc` = 'Retained Earnings'
group by year(a.`Batch_Date`)
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
				 	"showlegend" => "1",
                    "showValues"=> "1",
					"showLabels" => "1",

          
					"showPercentValues" => "1",
					"legendPosition" => "right",           
                    "theme"=> "zune"
              	)
           	);

        	$arrData["data"] = array();

	// Push the data into the array


        	while($row = mysqli_fetch_array($result)) {
           	array_push($arrData["data"], array(
                "label" => $row[0],    
                "value" => $row[1],
				"color" => "#AEA8D3",
				"link" => "re.php?Year=".$row[0]
              	)
           	);
        	} 

        	/*JSON Encode the data to retrieve the string containing the JSON representation of the data in the array. */

        	$jsonEncodedData = json_encode($arrData);

        	/*Create an object for the column chart. Initialize this object using the FusionCharts PHP class constructor. The constructor is used to initialize the chart type, chart id, width, height, the div id of the chart container, the data format, and the data source. */

        	$columnChart = new FusionCharts("column2d", "equi1" , "100%", 350, "eq1", "json", $jsonEncodedData);

        	// Render the chart
        	$columnChart->render();

        	// Close the database connection
        	$dbhandle->close();

     	}

       // $tae = $row[0];

?>

        
<div id = "eq1"></div> 






