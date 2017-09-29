<?php

include ("connect.php");

   
   $strQuery = "SELECT xyear,  xjan, xfeb, xmar, xapr,xmay,xjun ,
xjul, xaug,xsep, xoct,xnov,xdec
FROM tblref_budget ";

     	// Execute the query, or else return the error message.
     	$result = $dbhandle->query($strQuery) or exit("Error code ({$dbhandle->errno}): {$dbhandle->error}");

    if ($result) {
         $arrData = array(
        "chart" => array(
            "caption"=> "Electric Budget",
            "subCaption"=> "2017",
            "xAxisname"=> "Month",
            "yAxisName"=> "Total",
            "legendItemFontColor"=> "#666666",
		  
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
			 
            "theme"=> "zune"
            )
          );

        	$arrData["data"] = array();
			
			
			 $categoryArray=array();
			 $dataseries0=array();
          $dataseries1=array();
          $dataseries2=array();
		   $dataseries3=array();
		    $dataseries4=array();
			 $dataseries5=array();
			  $dataseries6=array();
			   $dataseries7=array();
			    $dataseries8=array();
				 $dataseries9=array();
				  $dataseries10=array();
				   $dataseries11=array();
				    $dataseries12=array();
					
					$arrData["trendlines"] = array();
      $line = array();
      array_push($line, array("startValue"=>"80000","color"=>"#0075c2","valuePadding"=>"20", "displayvalue"=>"Budget Line"));
      
      array_push($arrData["trendlines"], array("line" => $line));
	// Push the data into the array
        	while($row = $result->fetch_array()) {
				 array_push($categoryArray, array(
                  "label" => $row[0]
          			)
        			);
					
					 array_push($dataseries0, array(
		
           "value" => $row[1],
		  "showValue" => "1",
          )
        );
        array_push($dataseries1, array(
		
           "value" => $row[2],
		  "showValue" => "1",
          )
        );

        array_push($dataseries2, array(
          "value" => $row[3],
		  "showValue" => "1",
		 
         	 )
       		 );
			 array_push($dataseries3, array(
          "value" => $row[4],
		  "showValue" => "1",
		  "link" => "srp.php?Month=".$row[3]
         	 )
       		 );
			 array_push($dataseries4, array(
          "value" => $row[5],
		  "showValue" => "1",
		  "link" => "srp.php?Month=".$row[4]
         	 )
       		 );
			 array_push($dataseries5, array(
          "value" => $row[6],
		  "showValue" => "1",
		  "link" => "srp.php?Month=".$row[5]
         	 )
       		 );
			 array_push($dataseries6, array(
          "value" => $row[7],
		  "showValue" => "1",
		  "link" => "srp.php?Month=".$row[6]
         	 )
       		 );
			 array_push($dataseries7, array(
          "value" => $row[8],
		  "showValue" => "1",
		  "link" => "srp.php?Month=".$row[7]
         	 )
       		 );
			 array_push($dataseries8, array(
          "value" => $row[9],
		  "showValue" => "1",
		  "link" => "srp.php?Month=".$row[2]
         	 )
       		 );
			 array_push($dataseries9, array(
          "value" => $row[10],
		  "showValue" => "1",
		  "link" => "srp.php?Month=".$row[2]
         	 )
       		 );
			 array_push($dataseries10, array(
          "value" => $row[11],
		  "showValue" => "1",
		  "link" => "srp.php?Month=".$row[2]
         	 )
       		 );
			 array_push($dataseries11, array(
          "value" => $row[12],
		  "showValue" => "1",
		  "link" => "srp.php?Month=".$row[2]
         	 )
       		 );
	
        	}
        $arrData["categories"]=array(array("category"=>$categoryArray));
      // creating dataset object
      $arrData["dataset"] = array(
	  
	  array("seriesName"=> "January", "data"=>$dataseries1), 
	  array("seriesName"=> "February",  "data"=>$dataseries2),
	  array("seriesName"=> "March", "data"=>$dataseries3),
	   array("seriesName"=> "April", "data"=>$dataseries4),
	    array("seriesName"=> "May", "data"=>$dataseries5),
		 array("seriesName"=> "June", "data"=>$dataseries6),
		  array("seriesName"=> "July", "data"=>$dataseries7),
		   array("seriesName"=> "August", "data"=>$dataseries8),
		    array("seriesName"=> "September", "data"=>$dataseries9),
			 array("seriesName"=> "October", "data"=>$dataseries10),
			  array("seriesName"=> "November", "data"=>$dataseries11),
			  array("seriesName"=> "December", "data"=>$dataseries12));
           /*JSON Encode the data to retrieve the string containing the JSON representation of the data in the array. */

        	$jsonEncodedData = json_encode($arrData);

      	  /*Create an object for the column chart using the FusionCharts PHP class constructor. Syntax for the constructor is `FusionCharts("type of chart", "unique chart id", "width of chart", "height of chart", "div id to render the chart", "data format", "data source")`.*/

        	$columnChart = new FusionCharts("mscolumn2d", "electric2" , "100%", 450, "elec2", "json", $jsonEncodedData);

        	// Render the chart
        	$columnChart->render();

        	// Close the database connection
        	$dbhandle->close();
     	
     	}

?>

<div id = "elec2"></div>
