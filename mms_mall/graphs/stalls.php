<?php
// This is a simple example on how to draw a chart using FusionCharts and PHP.
// We have included includes/fusioncharts.php, which contains functions
// to help us easily embed the charts.
// Create the chart - Column 2D Chart with data given in constructor parameter 
// Syntax for the constructor - new FusionCharts("type of chart", "unique chart id", "width of chart", "height of chart", "div id to render the chart", "type of data", "actual data")
$columnChart = new FusionCharts("column2d", "ex1", "100%", 350, "chart-1", "json", '{  
                "chart":{  
                  "caption":"Stalls",
                  "subCaption":"Top 5 Palengke Stalls",
                  "numberPrefix":"$",
                  "theme":"ocean"
                },
                "data":[  
                  {  
                     "label":"Meat Stall",
                     "value":"880000",
					 "color":"#E9D460"
                  },
                  {  
                     "label":"Pork Stall",
                     "value":"730000",
					  "color":"#E9D460"
                  },
                  {  
                     "label":"Fish Stall",
                     "value":"590000",
					  "color":"#E9D460"
                  },
                  {  
                     "label":"Vegetable Stall",
                     "value":"520000",
					  "color":"#E9D460"
                  },
                  {  
                     "label":"Other Dry Stall",
                     "value":"330000",
					  "color":"#E9D460"
                  }
                ]
            }');
// Render the chart
$columnChart->render();
?>
<div id ="chart-1"></div>