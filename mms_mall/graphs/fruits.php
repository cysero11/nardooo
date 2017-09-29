<?php
// This is a simple example on how to draw a chart using FusionCharts and PHP.
// We have included includes/fusioncharts.php, which contains functions
// to help us easily embed the charts.
// Create the chart - Column 2D Chart with data given in constructor parameter 
// Syntax for the constructor - new FusionCharts("type of chart", "unique chart id", "width of chart", "height of chart", "div id to render the chart", "type of data", "actual data")
$columnChart = new FusionCharts("pareto2d", "ex5", "100%", 350, "chart-5", "json", '{  
                "chart":{  
                  "caption":"Fruits",
                  "subCaption":"Top 5 Fruits",
                  "numberPrefix":"$",
                  "theme":"ocean"
				  
                },
                "data":[  
                  {  
                     "label":"Banana",
                     "value":"99299",
					 "color":"#81CFE0"
                  },
                  {  
                     "label":"Apple",
                     "value":"43210",
					 "color":"#81CFE0"
                  },
                  {  
                     "label":"Lime",
                     "value":"23213",
					 "color":"#81CFE0"
                  },
                  {  
                     "label":"Pineapple",
                     "value":"42212",
					 "color":"#81CFE0"
                  },
                  {  
                     "label":"Other",
                     "value":"33000",
					 "color":"#81CFE0"
                  }
                ]
            }');
// Render the chart
$columnChart->render();
?>
<div id ="chart-5"></div>