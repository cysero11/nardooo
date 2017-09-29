<!-- <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&key=AIzaSyC2AilVLipxetunhcxHM4U1Pc-hm7Fy-U8&libraries=places&callback=myMap"></script> -->
<!--  Edited By Michael Samuel S. Valencia  -->
<?php

	include('connect.php');
	$query1 = mysql_query("SELECT Trade_Name, Company_Name, UnitType FROM tbltrans_inquiry");
	$query2 = mysql_query("select unitname, typeofbusiness, classificationname, sqmunitsetup, status from tblref_unit");
	$query3 = mysql_query("SELECT unitname, typeofbusiness, classificationname, sqmunitsetup FROM tblref_unit WHERE status = 'occupied' ");
	$query4 = mysql_query("SELECT unitname, typeofbusiness, classificationname, sqmunitsetup FROM tblref_unit WHERE status = 'vacant' ");
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
				 			<tr onclick='viewinfo("<?php echo $row[0]; ?>");' data-dismiss="modal">
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
				<div id='container2' style="min-width: 850px; height: 300px; margin: 0 auto">
					
				</div>
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
  		<li class="active"><a href="javascript:void(0)" onclick="selectpage(1)">1</a></li>
  		<li><a href="javascript:void(0)" onclick="selectpage(2)">2</a></li>
  		<li><a href="javascript:void(0)" onclick="selectpage(3)">3</a></li>
        <li><a href="javascript:void(0)" onclick="selectpage(4)">4</a></li>
   		<li><a href="javascript:void(0)" onclick="selectpage(5)">5</a></li>
        <li><a href="javascript:void(0)" onclick="selectpage(6)">6</a></li>
	</ul>
	<h1 style="color: #2679B5"><b>Monthly Lease</b></h1>
</div><!-- /.page-header -->

<br/>

<div class="row">
	<div class="col-sm-3">
        <div class="panel" style="border-color: #99cc66">
            <div class="panel-heading" >
                <div class="row">
					<div class="col-xs-9 text-left">
						<?php 
								$totinquiry = mysql_fetch_array(mysql_query("SELECT COUNT(*) AS totinquiry FROM tbltrans_inquiry"));
							?>
                        <span class="infobox-data-number" style="font-family: Roboto; font-size:18pt "><b><?php echo $totinquiry[0]; ?></b></span>
                       <div class="infobox-content" style="font-family: Roboto; font-size:12pt"><a id= "inquiry" href="#" onclick='showInquiry();'> Today's Inquiries</a></div>
                    </div>
                    <div class="col-xs-3">
						<i class="fa fa-phone fa-3x" style="border-color: black; color: #99cc66"></i>
					</div> 
                </div>
            </div>
            <a href="#">
            <div class="panel-footer" style="background-color: #99cc66">
            </div>
			</a>
        </div>
    </div>
								  
	<div class="col-sm-3">
	    <div class="panel" style="border-color: #8cc2e6">
	       <div class="panel-heading">
	           <div class="row">
	                <div class="col-xs-9 text-left">
	    				<?php 
							$totunit = mysql_fetch_array(mysql_query("SELECT COUNT(*) AS totunit FROM tblref_unit "));
						?>
						<div class="infobox-data">
							<span class="infobox-data-number" style="font-family: Roboto; font-size:18pt"><b><?php echo $totunit[0] ?: 0; ?></b></span>
							<div class="infobox-content" style="font-family: Roboto; font-size:12pt"><a id= "units" href="#" onclick='showUnits();'>Total Units</a>
							</div>
	                	</div>
					</div>
					<div class="col-xs-3">
						<i class="fa fa-home fa-3x" style="color: #8cc2e6"></i>
					</div> 
	           </div>
	       </div>
	       <a href="#">
	           <div class="panel-footer" style="background-color: #8cc2e6">
	           </div>
	       </a>
	    </div>
    </div>
																  
	<div class="col-sm-3">
        <div class="panel" style="border-color: #cc6666">
            <div class="panel-heading">
                <div class="row">
					<div class="col-xs-9 text-left">
	                   <?php 
								$totoccupied = mysql_fetch_array(mysql_query("SELECT COUNT(*) AS totunit FROM tblref_unit WHERE status = 'occupied' "));
							?>
							<div class="infobox-data">
								<span class="infobox-data-number" style="font-family: Roboto; font-size:18pt"><b><?php echo $totoccupied[0] ?: 0; ?></b></span>
								 <div class="infobox-content" style="font-family: Roboto; font-size:12pt"><a id= "occupied" href="#" onclick='showOccupied();'>Total Occupied Units</a></div>
							</div>
	                </div>
                    <div class="col-xs-3">
						<i class="fa fa-home fa-3x" style="color:#cc6666"></i>
					</div> 
    			</div>
            </div>
	       <a href="#">
	           <div class="panel-footer" style="background-color: #cc6666">
	           </div>
	       </a>
        </div>
    </div>
																				  
	<div class="col-sm-3">
        <div class="panel" style="border-color: #ff99cc">
            <div class="panel-heading">
               <div class="row">
					<div class="col-xs-9 text-left">
        				<?php 
							$totvacants = mysql_fetch_array(mysql_query("SELECT COUNT(*) AS totunit FROM tblref_unit WHERE status = 'vacant' "));
						?>
						<div class="infobox-data">
							<span class="infobox-data-number" style="font-family: Roboto; font-size:18pt"><b><?php echo $totvacants[0] ?: 0; ?></b></span>
							 <div class="infobox-content" style="font-family: Roboto; font-size:12pt"><a id= "vacant" href="#" onclick='showVacant();'>Total Available Units</a></div>
						</div>
                    </div>
                	<div class="col-xs-3">
						<i class="fa fa-home fa-3x" style="color: #ff99cc"></i>
					</div> 
                </div>
			</div>
            <a href="#">
                <div class="panel-footer" style="background-color: #ff99cc">
                </div>
            </a>
        </div>
    </div>
</div>

<div class="row">
	<div class="col-sm-4">
		<div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><a id= "main_button" href="#" onclick='showMain();'>Maintenance Expenses</a></h3>
            </div>
            <div class="panel-body">
	            <div>
	            	<div id="main" style="min-width: 300px; height: 300px; margin: 0 auto"></div>
	            </div>
        	</div>
    	</div>
	</div><!-- /.widget-main -->									

	<div class="col-sm-4">
		<div>
			<div class="panel panel-default">
				<div class="panel-heading">
                    <h3 class="panel-title"><a  href="#" id ="avail2" onclick='showAvail();'>Availability vs Occupancy</a></h3>
                </div>
                <div class="panel-body">
                      <div id="avail" style="min-width: 320px; height: 300px; margin: 0 auto"></div>
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
     				<h3 class="panel-title"><a  href="#" id ="time" onclick='showOvl();'>On Time vs Late Payments</a></h3>
    			</div>
    			<div class="panel-body">
    				<div id="ovl" style="width: 310px; height: 300px; margin: 0 auto"></div>
    			</div>
        	</div>
		</div>
	</div>
</div>
							
<!-- PAGE CONTENT ENDS -->
<!-- </div> --><!-- /.row -->
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
							<h3><span class='glyphicon glyphicon-map-marker' style='color: #F00;'></span> SITE LOCATION</h3>
						</div>
			
						<div id="map" class="panel-body" style=" height: 400px; padding: 0 !important;"></div>
					</div>
				</div>

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

<div id="lateandontime_modal" class="modal fade" >
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header bg-primary">
			<input type="hidden" id="txtvalselectedlateontime" name="">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" style='font-family: Roboto; font-size:18pt' id="lateandontime_modal_text"></h4>
			</div>
			
			<div class="modal-body" style="overflow-y: auto">
				<div class="widget-box widget-color-orange">
		            <div class="widget-header" style="padding-left:5px;padding-top:5px;">
		                <div class="row form-group" style="margin-bottom: 0px;">
		                  <div class="col-md-4">
		                    <span class="input-icon" style="width: 100%;">
		                        <input type="text" class="form-control" id="txtgetsearchtxtontimelate" placeholder="Search Tenant Name" onKeyUp="loaddrilldownlateontime2()">
		                        <i class="ace-icon fa fa-search nav-search-icon"></i>
		                    </span>
		                  </div>
		                  <div class="col-md-8">
		                      <div class="widget-toolbar">
		                          <i id="spinner_ontylate" class="ace-icon fa fa-spinner bigger-160"></i>
		                      </div>
		                  </div>
		                </div>
		            </div>
		            <div class="widget-body" style="height: 290px;display: block;">
		                <table id="simple-table" class="table  table-bordered table-hover">
		                    <thead>
		                        <tr>
		                            <th style="background-color: #f2f2f2 !important;color:#707070;">Tenant Name</th>
		                            <th style="background-color: #f2f2f2 !important;color:#707070;">Description</th>
		                            <th style="background-color: #f2f2f2 !important;color:#707070;text-align: right;">Amount</th>
		                        </tr>
		                    </thead>
		                    <tbody id="tbody_ontimelatepaymnts" tabindex="0" style="overflow: hidden; outline: none;">
		                    </tbody>
		                </table>
		            </div>
		            <div class="widget-toolbox padding-8 clearfix">
		             <label style="float: right;"><h4 style="color:black;display: inline;">Total Amount&nbsp;</h4><h4 style="display: inline;font-weight: bold;" id="txtload_all_ttllateontime">1,000.00</h4></label>
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

	var data1 = [];
	var data2 = [];
	<?php
	$num = 0;
	$sql = "SELECT Year(endt), sum(total_amount) from pmls_android_worker_task_history group by year(endt)";
	$result = mysql_query($sql) or die(mysql_error());;
	while ($row = mysql_fetch_array($result)) 
	{
		$num += 1;
		?>
		data1.push({ name: '<?php echo $row[0]; ?>', y: <?php echo $row[1]; ?>, drilldown: 'category<?php echo $row[0]; ?>'});
		<?php
		$sql2 = "SELECT MonthNAME(endt), sum(total_amount) from pmls_android_worker_task_history where year(endt) = '". $row[0] .
		"' group by MONTHNAME(endt)";
		$result2 = mysql_query($sql2) or die(mysql_error());
		$padding = "";
		while ($row2 = mysql_fetch_array($result2))
	    	{ $padding .= ", [ '" . $row2[0] . "', " . $row2[1] . " ]"; }
		?>
		data2.push({ name: '<?php echo $row[0]; ?>', id: 'category<?php echo $row[0]; ?>', data: [<?php echo substr($padding, 2); ?>] });
		<?php
	}
	?>


$(function () {
    // Create the chart
    $('#main').highcharts({
        chart: {
            type: 'column',
			
        },
		credits: {
      	enabled: false
  		},
        title: {
            text: 'Maintenance Expenses'
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
          name: 'Amount',
            colorByPoint: true,
            data: data1
            }],
        drilldown: {
            series: data2
        }
    })
});

		
$(function () {
    // Create the chart
    $('#main2').highcharts({
        chart: {
            type: 'column',
			
        },
		credits: {
      	enabled: false
  		},
        title: {
            text: 'Maintenance History'
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
          name: 'Amount',
            colorByPoint: true,
            data: data1
            }],
        drilldown: {
            series: data2
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
               renderTo: 'avail',
               plotBackgroundColor: null,
               plotBorderWidth: null,
               plotShadow: false
           },
           title: {
               text: 'Availability of SET'
           },
			credits: {
			    enabled: false
			},
            tooltip: {
                formatter: function() {
                    return '<b>' + this.point.name + '</b>: ' + this.y;
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
                $.getJSON("data-available.php", function(json) {
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
                            return '<b>' + this.point.name + '</b>: ' + this.y;
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
                            }, 8000);
                var options = {
                    chart: {
                        renderTo: 'avail3',
                        plotBackgroundColor: null,
                        plotBorderWidth: null,
                        plotShadow: false
                    },
					credits: {
      enabled: false
  },
                    title: {
                        text: 'Availability of SET'
                    },
                    tooltip: {
                        formatter: function() {
                            return '<b>' + this.point.name + '</b>: ' + this.y;
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
                $.getJSON("data-available.php", function(json) {
                    options.series = json;
                    chart = new Highcharts.Chart(options);
                });
	}
            });
 
 var monthlabel = [];
 var amtlatepy = [];
 var amtontymi = [];
 $(function () {

 	$.ajax({
 		type: 'POST',
 		url: 'mainclass.php',
 		data: 'form=loadallontimeandlate',
 		success: function(data)
 		{
 			var datas = data.split("#");
 			for(var i=0; i<=datas.length-2; i++)
 			{
 				var val = datas[i].split("|");
 				monthlabel.push(val[0]);
 				amtlatepy.push(parseFloat(val[2]))
				amtontymi.push(parseFloat(val[1]))
 			}
 			loadgraphontimeandlatepay()
 		}
 	})
	    
});

function loadgraphontimeandlatepay()
{
	Highcharts.chart('ovl', {
	        chart: {
	            type: 'column'
	        },
			credits: {
	      		enabled: false
	  		},
	        title: {
	            text: 'On Time vs Late Payments'
	        },
			 credits: {
	        enabled: false
	    },
        xAxis: {
				categories: monthlabel,
				crosshair: true
			},

		yAxis: {
			title: {
				text: 'PESO Rate'
			},
			plotLines: [{
				value: 0,
				width: 1,
				color: '#808080'
			}]
		},

		tooltip: {
			formatter: function () {
				return '<b>' + this.x + '</b><br/>' +
					this.series.name + ': ' + (parseFloat(this.y)).toFixed(2).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,") + '<br/>' +
					'Total: ' + (parseFloat(this.point.stackTotal)).toFixed(2).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,");
			}
		},

		plotOptions: {
			column: {
				stacking: 'normal',
				keys: ['y'],
		        point: {
		          events: {
		            click: function() {
		            	loaddrilldownlateontime(this.series.name, this.y, this.category)
		            }
		          }
		        }
			}
		},

		series: [{
			name: 'On Time',
			data: amtontymi,
			color: '#438EF7'
		}, {
			name: 'Late',
			data: amtlatepy,
			color: '#FAA961'
		}]
	});
}

function loaddrilldownlateontime(name, amt, month)
{
	var dateToday = new Date();
	$("#txtvalselectedlateontime").val(name+"|"+amt+"|"+month);
	if(name == "On Time")
	{
		$("#lateandontime_modal_text").text("On Time Payments - "+month+" "+dateToday.getFullYear());
		var cond = " AND tbltransaction.ontimepayment != '0.000000'";
		var amtval = "ontimepayment";
	}
	else
	{
		$("#lateandontime_modal_text").text("Late Payments - "+month+" "+dateToday.getFullYear());
		var cond = " AND tbltransaction.latepayment != '0.000000'";
		var amtval = "latepayment";
	}
	var key = $("#txtgetsearchtxtontimelate").val();
	if(amtval == "latepayment")
	{
		$clr = "#df6c07";
	}
	else
	{
		$clr = "#0a6cf5";
	}
				
	$.ajax({
		type: 'POST',
		url: 'mainclass.php',
		data: 'amt='+amt+'&month='+month+'&cond='+cond+'&cond='+cond+'&amtval='+amtval+'&key='+key+'&form=loaddrilldownlateontime',
		beforeSend : function() {
		 $('#spinner_ontylate').addClass('fa-spin');
		},
		success: function(data)
		{
			$('#spinner_ontylate').removeClass('fa-spin');
			$("#txtload_all_ttllateontime").css("color", $clr);
			$("#txtload_all_ttllateontime").text((parseFloat(amt)).toFixed(2).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,"));
			$("#tbody_ontimelatepaymnts").html(data);
			$("#lateandontime_modal").modal("show");
		}
	})
}

function loaddrilldownlateontime2()
{
	var dateToday = new Date();
	var selected = ($("#txtvalselectedlateontime").val()).split("|");
	var name = selected[0];
	var amt = selected[1];
	var month = selected[2];
	if(name == "On Time")
	{
		$("#lateandontime_modal_text").text("On Time Payments - "+month+" "+dateToday.getFullYear());
		var cond = " AND tbltransaction.ontimepayment != '0.000000'";
		var amtval = "ontimepayment";
	}
	else
	{
		$("#lateandontime_modal_text").text("Late Payments - "+month+" "+dateToday.getFullYear());
		var cond = " AND tbltransaction.latepayment != '0.000000'";
		var amtval = "latepayment";
	}

	var key = $("#txtgetsearchtxtontimelate").val();
	$.ajax({
		type: 'POST',
		url: 'mainclass.php',
		data: 'amt='+amt+'&month='+month+'&cond='+cond+'&cond='+cond+'&amtval='+amtval+'&key='+key+'&form=loaddrilldownlateontime',
		beforeSend : function() {
		 $('#spinner_ontylate').addClass('fa-spin');
		},
		success: function(data)
		{
			$('#spinner_ontylate').removeClass('fa-spin');
			$("#txtload_all_ttllateontime").text((parseFloat(amt)).toFixed(2).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,"));
			$("#tbody_ontimelatepaymnts").html(data);
			$("#lateandontime_modal").modal("show");
		}
	})
}

var data3 = [];
var data4 = [];
<?php
$num = 0;
$sql = "SELECT mallID, mallname, COUNT(mallid) FROM tblref_mall group by mallname";
$result = mysql_query($sql) or die(mysql_error());;
while ($row = mysql_fetch_array($result)) 
{
	$num += 1;
	?>
	data3.push({ name: '<?php echo $row[1]; ?>', y: <?php echo $row[2]; ?>, drilldown: 'category<?php echo $row[0]; ?>'});
	<?php
	$sql2 = "SELECT wing, COUNT(wingID) FROM tblref_wing WHERE mallID = '" .$row[0]. "' GROUP BY wing";
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
    $('#pie1').highcharts({
        chart: {
            type: 'pie'
        },
		credits: {
      enabled: false
  },
        title: {
            text: 'Greenbelt'
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
					   cursor: 'pointer',
            point: {
                events: {
                    click: function () {
                      if(this.x != UNDEFINED)
                                $('#pan2').show();
								$('#pan3').show();
								$('#pan4').show();
                    }
                }
            }
                }
            },
        

        series: [{
          name: 'Mall',
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
                            }, 8000);
                var options = {
                    chart: {
                        renderTo: 'pie2',
                        plotBackgroundColor: null,
                        plotBorderWidth: null,
                        plotShadow: false
                    },
                    title: {
                        text: 'Total Floors Occupied in Greenbelt'
                    },
					credits: {
      enabled: false
  },
                    tooltip: {
                        formatter: function() {
                            return '<b>' + this.point.name + '</b>: ' + this.y;
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
                                    return '<b>' + this.point.name + '</b>: ' + Math.round(this.percentage) +' %';
                                }
                            },
                            showInLegend: true
                        }
                    },
                    series: []
                };
                function loadPage(){
                $.getJSON("data-floor.php", function(json) {
                    options.series = json;
                    chart = new Highcharts.Chart(options);
                });
                }
            });
   $('#myModal3').on('shown.bs.modal', function(){
    myMap();
    });
$('#pan1').hide();
$('#pan2').hide();
$('#pan3').hide();
$('#pan4').hide();

	function myMap() {
    var locations = [['Greenbelt', 4, 14.5541, 121.0189]];
    iw = new google.maps.InfoWindow();
	var geneve = new google.maps.LatLng(12.8797, 121.7740);

    var map = new google.maps.Map(document.getElementById('map'), {
		zoom: 5,
		scrollwheel: false,
		center: new google.maps.LatLng(0.0, 0.0),
		mapTypeId : google.maps.MapTypeId.ROADMAP, // Type de carte, diff�rentes valeurs possible HYBRID, ROADMAP, SATELLITE, TERRAIN
		streetViewControl: false,
		center: geneve,
		panControl: false,
		zoomControl: false,
		mapTypeControlOptions: {
			style: google.maps.MapTypeControlStyle.DROPDOWN_MENU
		},
		zoomControlOptions: {
			style: google.maps.ZoomControlStyle.SMALL
		}
    });
	var inputLocation = /** @type {HTMLInputElement} */(document.getElementById('pac-input'));
	// Link it to the UI element.
	map.controls[google.maps.ControlPosition.TOP_LEFT].push(inputLocation);
	var autocompleteLocation = new google.maps.places.Autocomplete(inputLocation);
	autocompleteLocation.bindTo('bounds', map);
	 /******************** LISTENER ************************/
	google.maps.event.addListener(autocompleteLocation, 'place_changed', function() {
	inputLocation.className = '';
	var placeStart = autocompleteLocation.getPlace();
	if (!placeStart.geometry) {
	  // Inform the user that the place was not found and return.
	  inputLocation.className = 'notfound';
	  return;
	}

	 
	// If the place has a geometry, then present it on a map.
	if (placeStart.geometry.viewport) {
	  map.fitBounds(placeStart.geometry.viewport);
	} else {
	  map.setCenter(placeStart.geometry.location);
	  map.setZoom(13);  // Why 13? Because it looks good.
	}
	var address = '';
	if (placeStart.address_components) {
	  address = [
		(placeStart.address_components[0] && placeStart.address_components[0].short_name || ''),
		(placeStart.address_components[1] && placeStart.address_components[1].short_name || ''),
		(placeStart.address_components[2] && placeStart.address_components[2].short_name || '')
	  ].join(' ');
	}
  });
  /******************** END LISTENER ************************/
    var marker, i;
	var contentDiv = '';

    for (i = 0; i < locations.length; i++) {  
		marker = new google.maps.Marker({
			position: new google.maps.LatLng(locations[i][2], locations[i][3]),
			map: map,
			title: locations[i][0]+ " (" + locations[i][1] + " stars)"
        });

        google.maps.event.addListener(marker, 'click', (function(marker, i) {
			return function() {
			var selectedname = locations[i][0];
			marker.setAnimation(google.maps.Animation.BOUNCE);
			stopAnimation(marker);
			$.ajax({
					success: function(data) {
						iw.open(map, marker);					
						iw.setContent("<button id='chart' onCLick='showChart()'>" + locations[i][0] + " Branch</button>");				
					}
				
			});
				return false;
			};
        })
	    (marker, i));
    }
	
	google.maps.event.addListener(iw, 'closeclick', function() {  
		
	}); 
	
	function stopAnimation(marker) {
		setTimeout(function () {
			marker.setAnimation(null);
		}, 3000);
	}
}


$(function () {
    Highcharts.chart('ovl2', {
        chart: {
            type: 'column'
        },
		
        title: {
            text: 'On Time vs Late Payments'
        },
		credits: {
      enabled: false
  },
		 credits: {
        enabled: false
    },
       xAxis: {
				categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
				crosshair: true,
				min: 0,
				max: 11,
			},

			yAxis: {
				title: {
					text: 'Peso Rate'
				},
				plotLines: [{
					value: 0,
					width: 1,
					color: '#808080'
				}]
			},

			tooltip: {
				formatter: function () {
					return '<b>' + this.x + '</b><br/>' +
						this.series.name + ': ' + this.y + '<br/>' +
						'Total: ' + this.point.stackTotal;
				}
			},

			plotOptions: {
				column: {
					stacking: 'normal'
				}
			},

			series: [{
				name: 'On Time',
				data: [{y:120}, {y:140}, {y:200}, {y:180}],
				color: '#FAA961'
			}, {
				name: 'Late',
				data: [{y:140}, {y:80}, {y:85}, {y:84}],
				color: '#438EF7'
			}]
		});
});
			
		function selectpage(type) {
			if(type == 1){
				$("#div_main_cont").load("dashboard/dashboard.php");
				$("#li_header_header a").text("Monthly Lease");
			}
			else if(type == 2){
				$("#div_main_cont").load("dashboard/dashboard2.php");
				$("#li_header_header a").text("Monthly Lease");
			}
			else if(type == 3){
				$("#div_main_cont").load("graphs/dashboard3.php");
				$("#li_header_header a").text("Monthly Lease");
			}
			else if(type == 4){
				$("#div_main_cont").load("graphs/dashboard4.php");
				$("#li_header_header a").text("Daily Palengke");
			}
			else if(type == 5){
				$("#div_main_cont").load("graphs/dashboard5.php");
				$("#li_header_header a").text("Daily Palengke");
			}
			else if(type == 6){
				$("#div_main_cont").load("graphs/dashboard6.php");
				$("#li_header_header a").text("Daily Palengke");
			}
		}

			function showRevenue() {
			$('#myModal4').modal('show');
		}
		
		
		
		function showChart(){
		$('#chart').click(function() {
		$('#pan1').show();	
		});
		}
		
		function showMap()
		{
		$('#2').click(function() {		
    $('#myModal3').modal('show');
  
	});			
		}

	function showInquiry()
	{
		$('#inquiry').click(function() {

    $('#inquiry_modal').modal('show');
  
	});
	}
	
	function showUnits(){
	$('#units').click(function() {

    $('#unit_modal').modal('show');
  
	});
	}
	
	function showOccupied(){
	$('#occupied').click(function() {

        $('#occupied_modal').modal('show');
  
	});
	}
	
	function showVacant(){
	$('#vacant').click(function() {

       $('#vacant_modal').modal('show');
  
	});
	}
	
	function showMain(){
	$('#main_button').click(function() {

       $('#maintenance_modal').modal('show');
  
	});
	}
	
	function showRevenue(){
	$('#revenue_button').click(function() {

       $('#revenue_modal').modal('show');
  
	});
	}
	
	function showOvl(){
	$('#time').click(function() {

       $('#ovl_modal').modal('show');
  
	});
	}
	
	function showProfit(){
	$('#pro').click(function() {

       $('#profit_modal').modal('show');
  
	});
	}
	
	function showAvail(){
	$('#avail2').click(function() {

      $('#myModal3').modal('show');
  
  
	});
	}
	
	function showRevenue2(){
	$('#rev2').click(function() {

       $('#mall_modal').modal('show');
  
	});
	}
	function closeModal(){
		$('#pan1').hide();
		$('#pan2').hide();
		$('#pan3').hide();
	}
	
	function viewinfo(tname){
$('#inquiry_modal').on('hidden.bs.modal', function (e) {
    // do something...

})
	}
			
						</script>
						
						<!--  Edited By Kevin Harold C. Labajo  -->
						
						
						<!-- Mike Codes -->
						
						<!-- End Mike Codes -->