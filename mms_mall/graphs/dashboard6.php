<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&key=AIzaSyC2AilVLipxetunhcxHM4U1Pc-hm7Fy-U8&libraries=places&callback=myMap"></script>
<!--  Edited By Kevin Harold C. Labajo  -->
<?php
						
include('connect.php');
include('fusioncharts.php');

?>
<body>
	

<div class="page-header" style="background-color: #edf4f8;padding-right: 15px;padding-top: 12px;">
	<ul class="pagination pull-right" style="margin-top: 0px;">
  <li><a href="javascript:void(1)" onClick="selectpage(1)">1</a></li>
  <li><a href="javascript:void(1)" onClick="selectpage(2)">2</a></li>
  <li><a href="javascript:void(1)" onClick="selectpage(3)">3</a></li>
  <li><a href="javascript:void(1)" onClick="selectpage(4)">4</a></li>
  <li><a href="javascript:void(1)" onClick="selectpage(5)">5</a></li>
   <li class="active"><a href="javascript:void(1)" onClick="selectpage(6)">6</a></li>
</ul>
	<h1 style="color: black">
		
	<b>Daily Palengke</b>
	</h1>
</div><!-- /.page-header -->


<div class="row">

<div class="col-sm-4">
<div>
<div class="panel panel-default">
<div class="panel-heading">
<h3 class="panel-title">Occupancy Report</h3>
 </div>
<div class="panel-body">
<?php include ("occ_report.php"); ?>
</div>
 </div>
</div><!-- /.widget-main -->
</div>

<div class="col-sm-4">
<div>
<div class="panel panel-default">
<div class="panel-heading">
<h3 class="panel-title">Occupancy Rate</h3>
 </div>
<div class="panel-body">
<?php include ("occ_rate.php"); ?>
</div>
 </div>
</div><!-- /.widget-main -->
</div>
				
<div class="col-sm-4">
<div>
<div class="panel panel-default">
<div class="panel-heading">
<h3 class="panel-title">Water Consumption</h3>
 </div>
<div class="panel-body">
<?php include ("water.php"); ?>
</div>
 </div>
</div><!-- /.widget-main -->
</div>

<div class="col-sm-12">
<div>
<div class="panel panel-default">
<div class="panel-heading">
<h3 class="panel-title">Electric Consumption</h3>
 </div>
<div class="panel-body">
<?php include ("elec.php"); ?>
</div>
 </div>
</div><!-- /.widget-main -->
</div>







					
								<!-- PAGE CONTENT ENDS -->
						</div><!-- /.row -->
