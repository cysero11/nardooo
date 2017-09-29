<?php
// This is a simple example on how to draw a chart using FusionCharts and PHP.
// We have included includes/fusioncharts.php, which contains functions
// to help us easily embed the charts.
// Create the chart - Column 2D Chart with data given in constructor parameter 
// Syntax for the constructor - new FusionCharts("type of chart", "unique chart id", "width of chart", "height of chart", "div id to render the chart", "type of data", "actual data")
$columnChart = new FusionCharts("area2d", "ex4", "100%", 350, "chart-4", "json", '{  
                "chart":{  
                  "caption":"Vegetables",
                  "subCaption":"Top 5 Vegetables",
                  "numberPrefix":"$",
                  "theme":"ocean"
                },
                "data":[  
                  {  
                     "label":"Squash",
                     "value":"99299"
                  },
                  {  
                     "label":"Cabbage",
                     "value":"43210"
                  },
                  {  
                     "label":"Carrots",
                     "value":"23213"
                  },
                  {  
                     "label":"Lettuce",
                     "value":"42212"
                  },
                  {  
                     "label":"Other",
                     "value":"33000"
                  }
                ]
            }');
// Render the chart
$columnChart->render();
?>
<div id ="chart-4"></div>