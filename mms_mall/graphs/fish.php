<?php
// This is a simple example on how to draw a chart using FusionCharts and PHP.
// We have included includes/fusioncharts.php, which contains functions
// to help us easily embed the charts.
// Create the chart - Column 2D Chart with data given in constructor parameter 
// Syntax for the constructor - new FusionCharts("type of chart", "unique chart id", "width of chart", "height of chart", "div id to render the chart", "type of data", "actual data")
$columnChart = new FusionCharts("bar2d", "ex4", "100%", 350, "chart-4", "json", '{  
                "chart":{  
                  "caption":"Fish Products",
                  "subCaption":"Top 5 Fish Products",
                  "numberPrefix":"$",
                  "theme":"ocean"
                },
                "data":[  
                  {  
                     "label":"Tuna",
                     "value":"880000"
                  },
                  {  
                     "label":"Milkfish",
                     "value":"730000"
                  },
                  {  
                     "label":"Shrimp",
                     "value":"590000"
                  },
                  {  
                     "label":"Salmon",
                     "value":"520000"
                  },
                  {  
                     "label":"Other Fish products",
                     "value":"330000"
                  }
                ]
            }');
// Render the chart
$columnChart->render();
?>
<div id ="chart-4"></div>