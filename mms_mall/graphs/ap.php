

<?php
include ("connect_acctg.php");

$strQuery = "(SELECT CASE WHEN terms = 'COD'  OR  terms = 'CASH' THEN '0 days'
		WHEN terms  = '7 DAYS' THEN '30 Days'
		WHEN terms = '15 DAYS' THEN '60 Days'
		WHEN terms = '30 DAYS' THEN '90 DAYS'
		WHEN terms = '21 DAYS' THEN 'Overdue'  END AS ageband,
	COUNT(*),
	vopo_number,vopo_date,supplier_id,supplier_name,due_date,total,payment,balance,terms,gltransjournal.debit,gltransjournal.credit,gltransjournal.jonum AS jo 
	FROM AP00000,gltransjournal,refterm
	WHERE id_number = vopo_number AND balance >0 AND 
		vopo_date <= '2015-12-31' AND originatingcode <> '' GROUP BY ageband
		ORDER BY ageband ASC)

		
 UNION
 (SELECT 1, 2,id_number,batch_date,originatingcode,originatingname,'',glvoucherdetails.credit,0,glvoucherdetails.credit-apbal,'',gltransjournal.debit,gltransjournal.credit,gltransjournal.jonum AS jo FROM glvoucherdetails,gltransjournal WHERE id_number =  glvoucherdetails.jv_number AND glvoucherdetails.jb_project = originatingcode AND glvoucherdetails.credit >apbal  AND 
 batch_date <= '2015-12-31' AND originatingcode <> '' )
 UNION 
 (SELECT 1,2, invoiceNo,invoicedate,subcode,subname,'',invoiceamt,invoicepay,invoicebal,terms,0,invoicebal,'' AS jo FROM subsidiaryinvoice WHERE invoicebal > 0  AND 
 invoicedate <= '2015-12-31' AND post =-1 AND ntype='AP' AND subcode <> '' )
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
                  "xAxisname"=> "Dues",
            "yAxisName"=> "Total",
					"baseFont" => "Arial",
				 	"showlegend" => "1",
                    "caption" => "Aging of Payables",
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

        	$columnChart = new FusionCharts("column2D", "aging2" , "100%", 450, "ap", "json", $jsonEncodedData);

        	// Render the chart
        	$columnChart->render();

        	// Close the database connection
        	$dbhandle->close();

     	}
?>

<div id="ap"><!-- Fusion Charts will render here--></div>