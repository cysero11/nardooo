<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&key=AIzaSyC2AilVLipxetunhcxHM4U1Pc-hm7Fy-U8&libraries=places&callback=myMap"></script>
<!--  Edited By Kevin Harold C. Labajo  -->
<?php
						
include('connect.php');
include ('fusioncharts.php');
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
  <li><a href="javascript:void(1)" onClick="selectpage(1)">1</a></li>
  <li><a href="javascript:void(1)" onClick="selectpage(2)">2</a></li>
  <li class="active"><a href="javascript:void(1)" onClick="selectpage(3)">3</a></li>
     <li><a href="javascript:void(1)" onClick="selectpage(4)">4</a></li>
   <li><a href="javascript:void(1)" onClick="selectpage(5)">5</a></li>
        <li><a href="javascript:void(1)" onClick="selectpage(6)">6</a></li>
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
<h3 class="panel-title">Total Occupied</h3>
 </div>
<div class="panel-body">
<div id="occupied3" style="min-width: 310px; height: 300px; margin: 0 auto"></div>
</div>
 </div>
</div><!-- /.widget-main -->
</div>

<div class="col-sm-4">
<div>
<div class="panel panel-default">
<div class="panel-heading">
<h3 class="panel-title">Total Lease Revenue</h3>
 </div>
<div class="panel-body">
<div id="mall" style="min-width: 310px; height: 300px; margin: 0 auto"></div>
</div>
 </div>
</div><!-- /.widget-main -->
</div>
				
<div class="col-sm-4">
<div>
<div class="panel panel-default">
<div class="panel-heading">
<h3 class="panel-title">Incolplete Requirements</h3>
 </div>
<div class="panel-body">
<div id="inc" style="min-width: 310px; height: 300px; margin: 0 auto"></div>
</div>
 </div>
</div><!-- /.widget-main -->
</div>

<div class="col-sm-12">
<div>
<div class="panel panel-default">
<div class="panel-heading">
<h3 class="panel-title">Monthly Sales by Tenant</h3>
 </div>
<div class="panel-body">
<?php include ("mon.php"); ?>
</div>
 </div>
</div><!-- /.widget-main -->
</div>
<!--
<div class="col-md-4">
	<div class="panel panel-default">
		<div class="panel-heading">
			Total Customers
		</div>

		<div class="panel-body">
			<div class="container-fluid">
				<div id="total-customers">
					
				</div>
			</div>
		</div>
	</div>
</div>

<div class="col-md-4">
	<div class="panel panel-default"> 
		<div class="panel-heading"> 
			Average Sale per Customer
		</div>

		<div class="panel-body">
			<table class="table table-bordered">
				<thead>
					
					<th>Revenue</th>
					<th>Total Customer</th>
					<th>Average</th>
				</thead>
				<tbody id="total_rev">
				</tbody>
			</table>
		</div>
	</div>
</div>
-->
<script type="text/javascript">
	setTimeout(function(){
		customers();
		totalRev();
	}, 300)

	function totalRev() {
		$.ajax ({
			type: 'POST',
			url: 'reports/class4.php',
			data: 'form=totalRev',
			success: function(data) {
				$("#total_rev").html(data);
			}
		})
	}

	function customers() {
		var arrdata = JSON.parse(customercount());

		var data = arrdata;
	
		chart = new Highcharts.Chart(
		{
			credits: {
				enabled: false
			},
			series:[{
				"data": data,
				type: 'pie',
				animation: false,
				point:{
					events:{
						click: function (event) {
							selectTenant(this.id);
						}
					}
				},
				dataLabels:{
					enabled:true,
					formatter:function() {
						return Highcharts.numberFormat(this.y);
					}
				}       
			}],
			legend: {
				layout: 'vertical',
				align: 'left',
				verticalAlign: 'bottom',
				// x: -40,
				// y: 80,
				floating: true,
				borderWidth: 1,
				backgroundColor: ((Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'),
				shadow: true
			},
			plotOptions: {
				pie: {
					allowPointSelect: true,
					cursor: 'pointer',
					dataLabels: {
						enabled: false
					},
					showInLegend: true
				}
			},
			"chart":{
				"renderTo":"total-customers"
			},
			title: {
				text: 'Total Count of Customers - <?php echo date("Y"); ?>'
			},
		});
	}


	function customercount() {
		// var mall = $("#mallsid").val();
		var arr = '';
		$.ajax({
			type:'POST',
			async:false,
			url:'reports/class4.php',
			data: 'form=customerPie', 
			success:function(data){
				// alert(data);
				arr = data; 
			}
		}); 

		return arr;
	}
</script>




					
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

			$(document).ready(function() {
		loadPage();
		setInterval(function()
                            {
                                loadPage();
                            }, 600000);
                var options = {
                    chart: {
                        renderTo: 'occupied3',
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
                $.getJSON("data-occupied2.php", function(json) {
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
                        renderTo: 'mall',
                        type: 'bar'
                    },
                    title: {
                        text: 'Total Lease Revenue',
                        x: -20 //center
                    },
	       credits: {
      enabled: false
  },
                    subtitle: {
                        text: 'Source : Management',
                        x: -20
                    },
                    xAxis: {
                        categories: []
                    },
                    yAxis: {
                        title: {
                            text: 'Amount'
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
                $.getJSON("data-mall.php", function(json) {
                    options.xAxis.categories = json[0]['data']; //xAxis: {categories: []}
                    options.series[0] = json[1];
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
                        renderTo: 'inc',
                        type: 'column'
                    },
                    title: {
                        text: 'Total Incomplete Requirements',
                        x: -20 //center
                    },
	       credits: {
      enabled: false
  },
                    subtitle: {
                        text: 'Source : Management',
                        x: -20
                    },
                    xAxis: {
                        categories: []
                    },
                    yAxis: {
                        title: {
                            text: 'Value'
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
                $.getJSON("data-inc.php", function(json) {
                    options.xAxis.categories = json[0]['data']; //xAxis: {categories: []}
                    options.series[0] = json[1];
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
                        renderTo: 'elec',
                        type: 'column'
                    },
                    title: {
                        text: 'Electric vs Water Revenue',
                        x: -20 //center
                    },
	       credits: {
      enabled: false
  },
                    subtitle: {
                        text: 'Source :  Management Maintenance',
                        x: -20
                    },
                    xAxis: {
                        categories: []
                    },
                    yAxis: {
                        title: {
                            text: 'Value'
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
                $.getJSON("data-elec.php", function(json) {
                    options.xAxis.categories = json[0]['data']; //xAxis: {categories: []}
                    options.series[0] = json[1];
                    chart = new Highcharts.Chart(options);
                });
                }
            });
						
						</script>
						
						<!--  Edited By Kevin Harold C. Labajo  -->
						
						
						<!-- Mike Codes -->
						
						<!-- End Mike Codes -->