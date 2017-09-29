<?php
// This is a simple example on how to draw a chart using FusionCharts and PHP.
// We have included includes/fusioncharts.php, which contains functions
// to help us easily embed the charts.
// Create the chart - Column 2D Chart with data given in constructor parameter 
// Syntax for the constructor - new FusionCharts("type of chart", "unique chart id", "width of chart", "height of chart", "div id to render the chart", "type of data", "actual data")
$columnChart = new FusionCharts("pie2d", "ex3", "100%", 350, "chart-3", "json", '{  
                "chart":{  
                  "caption":"Meat Products",
                  "subCaption":"Top 5 Meat Products",
                  "numberPrefix":"$",
                  "theme":"flint"
                },
                "data":[  
                  {  
                     "label":"Beef Shank",
                     "value":"880000"
                  },
                  {  
                     "label":"Ribs",
                     "value":"730000"
                  },
                  {  
                     "label":"Steak",
                     "value":"590000"
                  },
                  {  
                     "label":"Sirloin",
                     "value":"520000"
                  },
                  {  
                     "label":"Ox Stripe",
                     "value":"330000"
                  }
                ]
            }');
// Render the chart
$columnChart->render();
?>
<div id ="chart-3"></div>