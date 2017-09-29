<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&key=AIzaSyC2AilVLipxetunhcxHM4U1Pc-hm7Fy-U8&libraries=places&callback=myMap"></script>
<!--  Edited By Kevin Harold C. Labajo  -->
<?php
						
include('connect.php');

?>
<body>
	
<div id="inquiry_modal" class="modal fade" >
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header bg-primary">
				<button type="button" style="color: white;" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" style='font-family: Roboto; font-size:18pt'>Overall Inquiries</h4>
			</div>
			
			<div class="modal-body row">
				<div class="table-respive">          
						<table class="table">
					<thead>
							<tr>
							  <th>Store Name</th>
							  <th>Company</th>
							  <th>Unit Type</th>
							</tr>
						  </thead>
						  <tbody>
							  <?php while ($row = mysql_fetch_array($query1)):?>
							<tr>
							  <td><?php echo $row[0]; ?></td>
							  <td><?php echo $row[1]; ?></td>
							  <td><?php echo $row[2]; ?></td>
							</tr>
							<?php endwhile;?>
						  </tbody>
						</table>
					</div>
				<?php
				$totinquiry2 = mysql_fetch_array(mysql_query("SELECT COUNT(*) AS totinquiry FROM tbltrans_inquiry"));
				?>
				<label>Total Inquiries:</label> <label><?php echo $totinquiry2[0]; ?></label>
				<br/>
				</div>
			</div>
		</div>
	</div>

<div id="unit_modal" class="modal fade" >
	<div class="modal-dialog modal-md">
		<div class="modal-content">
			<div class="modal-header bg-primary">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" style='font-family: Roboto; font-size:18pt'>Overall Units</h4>
			</div>
			
			<div class="modal-body row" style="overflow-y: auto">
				<div class="table-respive">          
						<table class="table">
					<thead>
							<tr>
							  <th>Unit Name</th>
							  <th>Type of Business</th>
							  <th>Classification</th>
							  <th>SQM Unit Setup</th>
							  <th>Status</th>
							</tr>
						  </thead>
						  <tbody>
							  <?php while ($row = mysql_fetch_array($query2)):?>
							<tr>
							  <td><?php echo $row[0]; ?></td>
							  <td><?php echo $row[1]; ?></td>
							  <td><?php echo $row[2]; ?></td>
							  <td><?php echo $row[3]; ?></td>
							  <td><?php echo $row[4]; ?></td>
							</tr>
							<?php endwhile;?>
						  </tbody>
						</table>
					</div>
				<?php
				$totlca = mysql_fetch_array(mysql_query("SELECT COUNT(typeofbusiness) AS totinquiry FROM tblref_unit WHERE typeofbusiness = 'LCA'"));
				$totset = mysql_fetch_array(mysql_query("SELECT COUNT(typeofbusiness) AS totinquiry FROM tblref_unit WHERE typeofbusiness = 'SET'"));
				?>
				<label>Total LCA:</label> <label><?php echo $totlca[0]; ?></label>
				<br/>
				
				<label>Total SET:</label> <label><?php echo $totset[0]; ?></label>
				</div>
			</div>
		</div>
	</div>

<div id="occupied_modal" class="modal fade" >
	<div class="modal-dialog modal-md">
		<div class="modal-content">
			<div class="modal-header bg-primary">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" style='font-family: Roboto; font-size:18pt'>Occupied</h4>
			</div>
			
			<div class="modal-body row" style="overflow-y: auto">
				<div class="table-respive">          
						<table class="table">
					<thead>
							<tr>
							  <th>Unit Name</th>
							  <th>Unit Type</th>
							  <th>Classification</th>
							  <th>SQM Unit Setup</th>
							</tr>
						  </thead>
						  <tbody>
							  <?php while ($row = mysql_fetch_array($query3)):?>
							<tr>
							  <td><?php echo $row[0]; ?></td>
							  <td><?php echo $row[1]; ?></td>
							  <td><?php echo $row[2]; ?></td>
							  <td><?php echo $row[3]; ?></td>
							</tr>
							<?php endwhile;?>
						  </tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>

<div id="vacant_modal" class="modal fade" >
	<div class="modal-dialog modal-md">
		<div class="modal-content">
			<div class="modal-header bg-primary">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" style='font-family: Roboto; font-size:18pt'>Vacant</h4>
			</div>
			
			<div class="modal-body row" style="overflow-y: auto">
				<div class="table-respive">          
						<table class="table">
					<thead>
							<tr>
							  <th>Unit Name</th>
							  <th>Unit Type</th>
							  <th>Classification</th>
							  <th>SQM Unit Setup</th>
							</tr>
						  </thead>
						  <tbody>
							  <?php while ($row = mysql_fetch_array($query4)):?>
							<tr>
							  <td><?php echo $row[0]; ?></td>
							  <td><?php echo $row[1]; ?></td>
							  <td><?php echo $row[2]; ?></td>
							  <td><?php echo $row[3]; ?></td>
							</tr>
							<?php endwhile;?>
						  </tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>

<div id="revenue_modal" class="modal fade" >
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header bg-primary">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" style='font-family: Roboto; font-size:18pt'>Overall Revenue</h4>
			</div>
			
			<div class="modal-body row" style="overflow-y: auto">
				<div id='container2' style="min-width: 850px; height: 300px; margin: 0 auto"></div>
					</div>
				</div>
			</div>
		</div>
	<div id="available_modal" class="modal fade" >
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header bg-primary">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" style='font-family: Roboto; font-size:18pt'>Availability</h4>
			</div>
			
			<div class="modal-body row" style="overflow-y: auto">
				<div id='avail3' style="min-width: 850px; height: 300px; margin: 0 auto"></div>
					</div>
				</div>
			</div>
		</div>



<div id="maintenance_modal" class="modal fade" >
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header bg-primary">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" style='font-family: Roboto; font-size:18pt'>Maintenance Details</h4>
			</div>
			
			<div class="modal-body row" style="overflow-y: auto">
			<div id="main2" style="min-width: 850px; height: 300px; margin: 0 auto"></div>
					</div>
				</div>
			</div>
		</div>

<div id="ovl_modal" class="modal fade" >
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header bg-primary">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" style='font-family: Roboto; font-size:18pt'>Payment Details</h4>
			</div>
			
			<div class="modal-body row" style="overflow-y: auto">
			<div id="ovl2" style="min-width: 850px; height: 300px; margin: 0 auto"></div>
					</div>
				</div>
			</div>
		</div>


<div id="profit_modal" class="modal fade" >
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header bg-primary">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" style='font-family: Roboto; font-size:18pt'>Profit Details</h4>
			</div>
			
			<div class="modal-body row" style="overflow-y: auto">
			<div id="lineprofit2" style="min-width: 850px; height: 300px; margin: 0 auto"></div>
					</div>
				</div>
			</div>
		</div>

<div id="mall_modal" class="modal fade" >
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header bg-primary">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" style='font-family: Roboto; font-size:18pt'>Overall Revenue</h4>
			</div>
			
			<div class="modal-body row" style="overflow-y: auto">
				<div id='pie4' style="min-width: 850px; height: 300px; margin: 0 auto"></div>
					</div>
				</div>
			</div>
		</div>
<div class="page-header" style="background-color: #edf4f8;padding-right: 15px;padding-top: 12px;">
	<ul class="pagination pull-right" style="margin-top: 0px;">
  		<li><a href="javascript:void(0)" onclick="selectpage(1)">1</a></li>
  		<li class="active"><a href="javascript:void(0)" onclick="selectpage(2)">2</a></li>
  		<li><a href="javascript:void(0)" onclick="selectpage(3)">3</a></li>
	   	<li><a href="javascript:void(0)" onclick="selectpage(4)">4</a></li>
	   	<li><a href="javascript:void(0)" onclick="selectpage(5)">5</a></li>
	   	<li><a href="javascript:void(0)" onclick="selectpage(6)">6</a></li>
</ul>
	<h1 style="color: black">
		
	<b>Monthly Lease</b>
	</h1>
</div><!-- /.page-header -->


<div class="row">

<div class="col-sm-4">
<div>
<div class="panel panel-default">
<div class="panel-heading">
<h3 class="panel-title"><a  href="#" id ="pro" onclick='showProfit();'>Complaints</a></h3>
</div>
<div class="panel-body">
<div id="comp" style="min-width: 320px; height: 300px; margin: 0 auto"></div>
<div class="text-right">
</div>
</div>
</div>
 </div>
</div>
					
<div class="col-sm-4">
<div>
<div class="panel panel-default">
	<div class="panel-heading">
 <h3 class="panel-title"><a  href="#" id ="rev2" onclick='showRevenue2();'>Revenue</a></h3>
</div>
<div class="panel-body">
<div id="pie3" style="min-width: 320px; height: 300px; margin: 0 auto"></div>
<div class="text-right">
                                  
</div>
</div>
</div>
</div>
</div>
					
<div class="col-sm-4">
<div>
<div class="panel panel-default">
<div class="panel-heading">
<h3 class="panel-title">Classification (Rented vs Vacant)</h3>
</div>
<div class="panel-body">
<div id="class" style="min-width: 320px; height: 300px; margin: 0 auto"></div>
<div class="text-right">           
</div>
</div>
</div>
</div>
</div>

<div class="col-sm-4">
<div>
<div class="panel panel-default">
<div class="panel-heading">
<h3 class="panel-title">LCA</h3>
 </div>
<div class="panel-body">
<div id="pielca" style="min-width: 310px; height: 300px; margin: 0 auto"></div>
</div>
 </div>
</div><!-- /.widget-main -->
</div>
									
		

				
					
<div class="col-sm-4">
<div>
<div class="panel panel-default">
<div class="panel-heading">
<h3 class="panel-title"><a  href="#" id ="time" onclick='showOvl();'>Number of Buyers</a></h3>
</div>
<div class="panel-body">
<div id="rent" style="width: 310px; height: 300px; margin: 0 auto"></div>
</div>
</div>
</div>
</div>
					
					
<div class="col-sm-4">
<div>
<div class="panel panel-default">
<div class="panel-heading">
<h3 class="panel-title"><a  href="#" id ="pro" onclick='showProfit();'>Inquiries</a></h3>
</div>
<div class="panel-body">
<div id="inq" style="min-width: 320px; height: 300px; margin: 0 auto"></div>
<div class="text-right">                     
</div>
</div>
</div>
</div>
</div>
					
					
								<!-- PAGE CONTENT ENDS -->
						</div><!-- /.row -->
<div id="myModal3" class="modal fade" >
	<div class="modal-dialog modal-lg" style="width: 100%; overflow-y:initial !important">
		<div class="modal-content">
			<div class="modal-header bg-primary">
				<button onclick='closeModal()' type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" style='font-family: Roboto; font-size:18pt'>Overall Status</h4>
			</div>
			
			<div class="modal-body row" style="overflow-y: auto">
				<div class="col-md-3">
				<div class="panel panel-default">
				<div class="panel-heading bg-semiblue">
				<h3><span class='glyphicon glyphicon-map-marker' style='color: #F00;'></span> SITE LOCATI</h3>
			</div>
			
			<div id="map" class="panel-body" style=" height: 400px; padding: 0 !important;"></div>
		</div>
	</div>
<!-- chart -->				
<div class="col-md-4" id="pan1">
	<div class="panel panel-default" style=" height: 400px; padding: 0 !important;">
		<div class="panel-heading">
			<h3 class="panel-title"><i class="fa fa-shopping-bag fa-fw"></i>Mall</h3>
		</div>
		<center>
			<div id="pie1" class="panel-body" style="min-width: 400px; height: 350px; margin: 0 auto"></div>
		</center>
		</div>
	</div>


<div class="col-md-4" id="pan2">
	<div class="panel panel-default" style=" height: 400px; padding: 0 !important;">
		<div class="panel-heading">
			<h3 class="panel-title"><i class="fa fa-map-marker fa-fw"></i> Floor</h3>
		</div>
		<center>
			<div id="pie2" class="panel-body" style="min-width: 400px; height: 350px; margin: 0 auto"></div>
		</center>
		</div>
	</div>


			</div>
</div>
</div>
</div>

</div>
</div>
</div>

</body>


		<script type="text/javascript">
			
			var data3 = [];
var data4 = [];
<?php
$num = 0;
$sql = "SELECT a.Inquiry_ID, tradename, COUNT(*) FROM tbltrans_lca_plot AS a
LEFT JOIN tbltrans_inquiry AS b
ON a.Inquiry_ID = b.Inquiry_ID
GROUP BY tradename";
$result = mysql_query($sql) or die(mysql_error());;
while ($row = mysql_fetch_array($result)) 
{
	$num += 1;
	?>
	data3.push({ name: '<?php echo $row[1]; ?>', y: <?php echo $row[2]; ?>, drilldown: 'category<?php echo $row[0]; ?>'});
	<?php
	$sql2 = "SELECT tradename, SUM(totalarea) FROM tbltrans_lca_plot AS a
WHERE a.Inquiry_ID = '". $row[0] ."'
GROUP BY tradename";
	$result2 = mysql_query($sql2) or die(mysql_error());
	$padding = "";
	while ($row2 = mysql_fetch_array($result2))
    	{ $padding .= ", [ '" . $row2[0] . "', " . $row2[1] . " ]"; }
	?>
	data4.push({ name: '<?php echo $row[0]; ?>', id: 'category<?php echo $row[0]; ?>', data: [<?php echo substr($padding, 2); ?>] });
	<?php
}
?>
$(function () {
 
 var UNDEFINED;
    // Create the chart
    $('#pielca').highcharts({
        chart: {
            type: 'pie'
        },
        credits: {
      enabled: false
  },
        title: {
            text: 'LCA'
        },
        xAxis: {
            type: 'category'
        },

        legend: {
            enabled: false
        },

        plotOptions: {
            series: {
                borderWidth: 0,
                dataLabels: {
                    enabled: true,
				},
                }
            },
        

        series: [{
          name: 'LCA',
            colorByPoint: true,
            data: data3
            }],
        drilldown: {
            series: data4
        }
    })
});
			
			 $(document).ready(function() {
		loadPage();
		setInterval(function()
                            {
                                loadPage();
                            }, 600000);
                var options = {
                    chart: {
                        renderTo: 'class',
                        plotBackgroundColor: null,
                        plotBorderWidth: null,
                        plotShadow: false
                    },
                    title: {
                        text: 'No. of Classifications'
                    },
					credits: {
      enabled: false
  },
                    tooltip: {
                        formatter: function() {
                            return '<b>' + this.point.name + '</b>: ' + this.y+ ' Inquired';
                        }
                    },
                    plotOptions: {
                        pie: {
                            allowPointSelect: true,
                            cursor: 'pointer',
                            dataLabels: {
                                enabled: true,
                                color: '#000000',
                                connectorColor: '#000000',
                                formatter: function() {
                                    return '<b>' + this.point.name + '</b>: ' + Math.round(this.percentage*100)/100 + ' %';
                                }
                            },
                            showInLegend: true
                        }
                    },
                    series: []
                };
	function loadPage(){
                $.getJSON("data-classification.php", function(json) {
                    options.series = json;
                    chart = new Highcharts.Chart(options);
                });
	}
            });
			
			 $(document).ready(function() {
                loadPage();
                setInterval(function()
                            {
                                loadPage();
                            }, 600000);
                var options = {
                    chart: {
                        renderTo: 'comp',
                        type: 'bar'
                    },
                    title: {
                        text: 'Complaints',
                        x: -20 //center
                    },
	       credits: {
      enabled: false
  },
                    subtitle: {
                        text: 'Source : Mall Management Maintenance',
                        x: -20
                    },
                    xAxis: {
                        categories: []
                    },
                    yAxis: {
                        title: {
                            text: 'Total Complaints'
                        },
                        plotLines: [{
                                value: 0,
                                width: 1,
                                color: '#808080'
                            }]
                    },
                    tooltip: {
                        headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
                        pointFormat: '<span style="color:{point.color}">{point.name}</span>:<b>{point.y}</b> of total<br/>'
                    },
                    plotOptions: {
                        series: {
                            borderWidth: 0,
                            dataLabels: {
                                enabled: true,
                                format: '{point.y}'
                            }
                        }
                    },
                    legend: {
                        layout: 'vertical',
                        align: 'right',
                        verticalAlign: 'top',
                        x: -40,
                        y: 100,
                        floating: true,
                        borderWidth: 1,
                        backgroundColor: ((Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'),
                        shadow: true
                    },
                    series: []
                };
                function loadPage(){
                $.getJSON("data-complaints.php", function(json) {
                    options.xAxis.categories = json[0]['data']; //xAxis: {categories: []}
                    options.series[0] = json[1];
                    chart = new Highcharts.Chart(options);
                });
                }
            });
var data5 = [];
var data6 = [];
<?php
$num = 0;
$sql = "SELECT MONTHNAME(xdate), SUM(amount) AS totrevenue FROM tbltransaction WHERE paymenttype = '' group by MONTHNAME(xdate) ORDER BY xdate";
$result = mysql_query($sql) or die(mysql_error());;
while ($row = mysql_fetch_array($result)) 
{
	$num += 1;
	?>
	data5.push({ name: '<?php echo $row[0]; ?>', y: <?php echo $row[1]; ?>, drilldown: 'category<?php echo $row[0]; ?>'});
	<?php
	$sql2 = "SELECT xdate, amount AS totrevenue FROM tbltransaction WHERE MONTHNAME(xdate) = '". $row[0] . "'  and amount >= 0 group by description";
	$result2 = mysql_query($sql2) or die(mysql_error());
	$padding = "";
	while ($row2 = mysql_fetch_array($result2))
    	{ $padding .= ", [ '" . $row2[0] . "', " . $row2[1] . " ]"; }
	?>
	data6.push({ name: '<?php echo $row[0]; ?>', id: 'category<?php echo $row[0]; ?>', data: [<?php echo substr($padding, 2); ?>] });
	<?php
}
?>
$(function () {
 
 var UNDEFINED;
    // Create the chart
    $('#pie3').highcharts({
        chart: {
            type: 'column'
        },
        credits: {
      enabled: false
  },
        title: {
            text: 'Lease Revenue'
        },
        xAxis: {
            type: 'category'
        },

        legend: {
            enabled: false
        },

        plotOptions: {
            series: {
                borderWidth: 0,
                dataLabels: {
                    enabled: true,
				},
                }
            },
        

        series: [{
          name: 'Revenue',
            colorByPoint: true,
            data: data5
            }],
        drilldown: {
            series: data6
        }
    })
});

$(function () {

  $('#pie4').highcharts({
        chart: {
            type: 'column'
        },
        title: {
            text: 'Palengke Revenue'
        },
        credits: {
      enabled: false
  },
        xAxis: {
            type: 'category'
        },

        legend: {
            enabled: false
        },

        plotOptions: {
            series: {
                borderWidth: 0,
                dataLabels: {
                    enabled: true,
				},
                }
            },
        

        series: [{
          name: 'Revenue',
            colorByPoint: true,
            data: data5
            }],
        drilldown: {
            series: data6
        }
    })
});
           $(document).ready(function() {
var options = {
chart: {
renderTo: 'rent',
type: 'column',
marginRight: 130,
marginBottom: 25
},
title: {
text: 'Rented vs Vacant',
x: -20 //center
},
credits: {
      enabled: false
  },
subtitle: {
text: '',
x: -20
},
xAxis: {
categories: []
},
yAxis: {
title: {
text: 'Total'
},
plotLines: [{
value: 0,
width: 1,
color: '#808080'
}]
},
 tooltip: {
            pointFormat: '<span style="color:{series.color}">{series.name}</span>: <b>{point.y}</b> ({point.percentage:.0f}%)<br/>',
            shared: true
        },
legend: {
layout: 'vertical',
align: 'right',
verticalAlign: 'top',
x: -10,
y: 100,
borderWidth: 0
},
plotOptions: {
column: {
stacking: 'normal',
dataLabels: {
enabled: true,
color: (Highcharts.theme && Highcharts.theme.dataLabelsColor) || 'white'
}
}
},
series: []
};
 
$.getJSON("data-rented.php", function(json) {
options.xAxis.categories = json[0]['data'];
options.series[0] = json[1];
options.series[1] = json[2];
chart = new Highcharts.Chart(options);
});
});
				
			 $(document).ready(function() {
		loadPage();
		setInterval(function()
                            {
                                loadPage();
                            }, 600000);
                var options = {
                    chart: {
                        renderTo: 'inq',
                        plotBackgroundColor: null,
                        plotBorderWidth: null,
                        plotShadow: false
                    },
                    title: {
                        text: 'Inquiries'
                    },
	       credits: {
      enabled: false
  },
                    tooltip: {
                        formatter: function() {
                            return '<b>' + this.point.name + '</b>: ' + this.y+ ' Inquired';
                        }
                    },
                    plotOptions: {
                        pie: {
                            allowPointSelect: true,
                            cursor: 'pointer',
                            dataLabels: {
                                enabled: true,
                                color: '#000000',
                                connectorColor: '#000000',
                                formatter: function() {
                                    return '<b>' + this.point.name + '</b>: ' + Math.round(this.percentage*100)/100 + ' %';
                                }
                            },
                            showInLegend: true
                        }
                    },
                    series: []
                };
	function loadPage(){
                $.getJSON("data-inquiry.php", function(json) {
                    options.series = json;
                    chart = new Highcharts.Chart(options);
                });
	}
            });
			 
	
	
 $(document).ready(function() {
		loadPage();
		setInterval(function()
                            {
                                loadPage();
                            }, 600000);
                var options = {
                    chart: {
                        renderTo: 'occupied2',
                        plotBackgroundColor: null,
                        plotBorderWidth: null,
                        plotShadow: false
                    },
                    title: {
                        text: 'Occupied'
                    },
	       credits: {
      enabled: false
  },
                    tooltip: {
                        formatter: function() {
                            return '<b>' + this.point.name + '</b>: ' + this.y+ ' Occupied';
                        }
                    },
                    plotOptions: {
                        pie: {
                            allowPointSelect: true,
                            cursor: 'pointer',
                            dataLabels: {
                                enabled: true,
                                color: '#000000',
                                connectorColor: '#000000',
                                formatter: function() {
                                    return '<b>' + this.point.name + '</b>: ' + Math.round(this.percentage*100)/100 + ' %';
                                }
                            },
                            showInLegend: true
                        }
                    },
                    series: []
                };
	function loadPage(){
                $.getJSON("data-occupied.php", function(json) {
                    options.series = json;
                    chart = new Highcharts.Chart(options);
                });
	}
            });


		 $(document).ready(function() {
                loadPage();
                setInterval(function()
                            {
                                loadPage();
                            }, 8000);
                var options = {
                    chart: {
                        renderTo: 'senior',
                        type: 'bar'
                    },
                    title: {
                        text: 'Senior Citizen',
                        x: -20 //center
                    },
	       credits: {
      enabled: false
  },
                    subtitle: {
                        text: 'Sales',
                        x: -20
                    },
                    xAxis: {
                        categories: []
                    },
                    yAxis: {
                        title: {
                            text: 'Total Seniors'
                        },
                        plotLines: [{
                                value: 0,
                                width: 1,
                                color: '#808080'
                            }]
                    },
                    tooltip: {
                        headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
                        pointFormat: '<span style="color:{point.color}">{point.name}</span>:<b>{point.y}</b> of total<br/>'
                    },
                    plotOptions: {
                        series: {
                            borderWidth: 0,
                            dataLabels: {
                                enabled: true,
                                format: '{point.y}'
                            }
                        }
                    },
                    legend: {
                        layout: 'vertical',
                        align: 'right',
                        verticalAlign: 'top',
                        x: -40,
                        y: 100,
                        floating: true,
                        borderWidth: 1,
                        backgroundColor: ((Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'),
                        shadow: true
                    },
                    series: []
                };
                function loadPage(){
                $.getJSON("data-senior.php", function(json) {
                    options.xAxis.categories = json[0]['data']; //xAxis: {categories: []}
                    options.series[0] = json[1];
                    chart = new Highcharts.Chart(options);
                });
                }
            });

            $(document).ready(function() {
    var options = {
        chart: {
            renderTo: 'lineprofit',
            type: 'line'
        },
        title: {
            text: 'Revenue vs Expenses',
            x: -20 //center
        },
        credits: {
      enabled: false
  },
        subtitle: {
            text: '',
            x: -20
        },
        xAxis: {
            categories: []
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Amount'
            },
            labels: {
                overflow: 'justify'
            }
        },
        tooltip: {
            formatter: function() {
                    return '<b>'+ this.series.name +'</b><br/>'+
                    this.x +': '+ this.y + '.00';
            }
        },
        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'top',
            x: -10,
            y: 100,
            borderWidth: 0
        }, 
        plotOptions: {
            bar: {
                dataLabels: {
                    enabled: true
                }
            }
        },
        series: []
    }
     
    $.getJSON("data-revexp.php", function(json) {
        options.xAxis.categories = json[0]['data'];
        options.series[0] = json[1];
        options.series[1] = json[2];
        chart = new Highcharts.Chart(options);
    });
});
            
            $(function () {
	 var options = {
        chart: {
            renderTo: 'lineprofit2',
            type: 'line'
        },
        title: {
            text: 'Revenue vs Expenses',
            x: -20 //center
        },
        credits: {
      enabled: false
  },
        subtitle: {
            text: '',
            x: -20
        },
        xAxis: {
            categories: []
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Amount'
            },
            labels: {
                overflow: 'justify'
            }
        },
        tooltip: {
            formatter: function() {
                    return '<b>'+ this.series.name +'</b><br/>'+
                    this.x +': '+ this.y;
            }
        },
        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'top',
            x: -10,
            y: 100,
            borderWidth: 0
        }, 
        plotOptions: {
            bar: {
                dataLabels: {
                    enabled: true
                }
            }
        },
        series: []
    }
     
    $.getJSON("data-revexp.php", function(json) {
        options.xAxis.categories = json[0]['data'];
        options.series[0] = json[1];
        options.series[1] = json[2];
        chart = new Highcharts.Chart(options);
    });
});
            
            $(function () {
		$('#linegraphmonth').highcharts({
			title: {
				text: 'COLLECTION',
				x: -20 //center
			},
			credits: {
      enabled: false
  },
			subtitle: {
				text: 'Source: BILLING',
				x: -20
			},
			xAxis: {

				categories: [
					'1',
					'2',
					'3',
					'4',
					'5',
					'6'
				],
				min: 0,

				max: 31
			},
			yAxis: {
				title: {
					text: 'Peso'
				},
				plotLines: [{
					value: 0,
					width: 1,
					color: '#808080'
				}]
			},
			tooltip: {
				valueSuffix: 'P'
			},
			legend: {
				layout: 'vertical',
				align: 'right',
				verticalAlign: 'middle',
				borderWidth: 0
			},
			series: [{
				name: 'COLLECTION',
				data: [7.0, 6.9, 9.5, 14.5, 18.2, 21.5, 25.2, 26.5, 23.3, 18.3, 13.9, 9.6]
			}]
		});
		});
		// function selectpage(type) {
		// 	if(type == 1){
		// 		$("#div_main_cont").load("dashboard/dashboard.php");
		// 		$("#li_header_header a").text("Monthly Lease");
		// 	}
		// 	else if(type == 1){
		// 		$("#div_main_cont").load("dashboard/dashboard2.php");
		// 		$("#li_header_header a").text("Monthly Lease");
		// 	}
		// 	else if(type == 3){
		// 		$("#div_main_cont").load("graphs/dashboard3.php");
		// 		$("#li_header_header a").text("Monthly Lease");
		// 	}
		// 	else if(type == 4){
		// 		$("#div_main_cont").load("graphs/dashboard4.php");
		// 		$("#li_header_header a").text("Daily Palengke");
		// 	}
		// 	else if(type == 5){
		// 		$("#div_main_cont").load("graphs/dashboard5.php");
		// 		$("#li_header_header a").text("Daily Palengke");
		// 	}
		// 	else if(type == 6){
		// 		$("#div_main_cont").load("graphs/dashboard6.php");
		// 		$("#li_header_header a").text("Daily Palengke");
		// 	}
		// }
		 
						</script>
						
						<!--  Edited By Kevin Harold C. Labajo  -->
						
						
						<!-- Mike Codes -->
						
						<!-- End Mike Codes -->