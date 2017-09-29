<?php
// This is a simple example on how to draw a chart using FusionCharts and PHP.
// We have included includes/fusioncharts.php, which contains functions
// to help us easily embed the charts.
// Create the chart - Column 2D Chart with data given in constructor parameter 
// Syntax for the constructor - new FusionCharts("type of chart", "unique chart id", "width of chart", "height of chart", "div id to render the chart", "type of data", "actual data")
$columnChart = new FusionCharts("line", "ex2", "100%", 350, "chart-2", "json", '{  
                "chart":{  
                  "caption":"July Sales",
                  "subCaption":"Daily",
                  "numberPrefix":"$",
                  "theme":"ocean"
                },
                "data":[  
                  {  
                     "label":"01",
                     "value":"880000",
					 "color":"#87D37C"
                  },
                  {  
                     "label":"02",
                     "value":"730000",
					  "color":"#87D37C"
                  },
                  {  
                     "label":"03",
                     "value":"590000",
					  "color":"#87D37C"
                  },
                  {  
                     "label":"04",
                     "value":"520000",
					  "color":"#87D37C"
                  },
                  {  
                     "label":"05",
                     "value":"330000",
					  "color":"#87D37C"
                  },
				   {  
                     "label":"06",
                     "value":"880000",
					  "color":"#87D37C"
                  },
                  {  
                     "label":"07",
                     "value":"730000",
					  "color":"#87D37C"
                  },
                  {  
                     "label":"08",
                     "value":"590000",
					  "color":"#87D37C"
                  },
                  {  
                     "label":"09",
                     "value":"520000",
					  "color":"#87D37C"
                  },
                  {  
                     "label":"10",
                     "value":"330000",
					  "color":"#87D37C"
                  }
                ]
            }');
// Render the chart
$columnChart->render();
?>
<div id ="chart-2"></div>