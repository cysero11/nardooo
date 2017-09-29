

<?php
include ("connect_acctg.php");

$strQuery = "(SELECT CASE WHEN terms = 'COD'  OR  terms = 'CASH' THEN '0 days'
		WHEN terms  = '7 DAYS' THEN '30 Days'
		WHEN terms = '15 DAYS' THEN '15 Days'
		WHEN terms = '30 DAYS' THEN '90 DAYS'
		WHEN terms = '21 DAYS' THEN '120 days'  END AS ageband,
	COUNT(*),invoice_number,invoice_date,customer_id,customer_name,due_date,total,payment_collect,balance,Terms,hmsfoliono,gltransjournal.debit,gltransjournal.credit,ar00000.id,gltransjournal.jonum as jo  FROM AR00000,gltransjournal WHERE id_number = invoice_number AND balance >0 and 
Invoice_date <= '2015-12-31'  and originatingcode <> '' and originatingcode   ='C-001' and glaccount_code =  'SGHP-1-101-1' or 'ageband' <> 0)
UNION 
(SELECT '',2,id_number,batch_date,originatingcode,originatingname,'',glvoucherdetails.debit,0,glvoucherdetails.debit-apbal,'',hmsfoliono,gltransjournal.debit,gltransjournal.credit,glvoucherdetails.id,gltransjournal.jonum as jo  FROM glvoucherdetails,gltransjournal WHERE id_number =  glvoucherdetails.jv_number AND glvoucherdetails.jb_project = originatingcode AND glvoucherdetails.debit >apbal  AND 
batch_date <= '2015-12-31'  AND originatingcode <> ''  and originatingcode  ='C-001' AND glaccount_code =  'SGHP-1-101-1'  )
UNION 
(SELECT '',2,id_number,batch_date,originatingcode,originatingname,'',hmspost1chart.debit,0,hmspost1chart.debit-payment,'',foliono,gltransjournal.debit,gltransjournal.credit,hmspost1chart.id,gltransjournal.jonum as jo  FROM hmspost1chart,gltransjournal WHERE batch_date=xdate  and source_journal ='HMS' AND hmspost1chart.subcode = originatingcode AND hmspost1chart.debit >payment and glaccount_code =chartcode  AND  
batch_date <= '2015-12-31'  AND originatingcode <> ''  and originatingcode  ='C-001'  AND glaccount_code =  'SGHP-1-101-1'  GROUP BY xdate,subcode,foliono,hmspost1chart.id)
UNION 
(SELECT '',2,invoiceNo,invoicedate,subcode,subname,'',invoiceamt,invoicepay,invoicebal,terms,'',invoiceamt,0,subsidiaryinvoice.id,'' as jo FROM subsidiaryinvoice WHERE invoicebal > 0  AND 
invoicedate <= '2015-12-31' AND post=-1 and (ntype ='AR' or ntype ='SB') and subcode <> ''  and subcode  ='C-001' AND chartcode  =  'SGHP-1-101-1' )

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
				
                    "caption" => "Aging of Receivables",
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
				"color" => "#1BBC9B"
              	)
           	);
        	}

        	/*JSON Encode the data to retrieve the string containing the JSON representation of the data in the array. */

        	$jsonEncodedData = json_encode($arrData);

        	/*Create an object for the column chart. Initialize this object using the FusionCharts PHP class constructor. The constructor is used to initialize the chart type, chart id, width, height, the div id of the chart container, the data format, and the data source. */

        	$columnChart = new FusionCharts("column2D", "aging1" , "100%", 450, "ar", "json", $jsonEncodedData);

        	// Render the chart
        	$columnChart->render();

        	// Close the database connection
        	$dbhandle->close();

     	}
?>

<div id="ar"><!-- Fusion Charts will render here--></div>