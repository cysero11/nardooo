<?php
						
include('fusioncharts.php');

?>
<body>
	
<div class="page-header" style="background-color: #edf4f8;padding-right: 15px;padding-top: 12px;">
	
	<h1 style="color: black">
		
	<b>FINANCIAL HIGHLIGHTS</b>
	</h1>
</div><!-- /.page-header -->


<div class="row">

<div class="col-sm-4">
<div>
<div class="panel panel-default">
<div class="panel-heading">
<h3 class="panel-title">Cash and Cash Equivalents</h3>
</div>
<div class="panel-body">
<?php include ("assets/asset-1.php");  ?></div>
<div class="text-right">
</div>
</div>
</div>
 </div>

					
<div class="col-sm-4">
<div>
<div class="panel panel-default">
	<div class="panel-heading">
 <h3 class="panel-title">AP</h3>
</div>
<div class="panel-body">
<?php include ("ap.php");  ?></div>
<div class="text-right">
                                  
</div>
</div>
</div>
</div>

<div class="col-sm-4">
<div>
<div class="panel panel-default">
<div class="panel-heading">
<h3 class="panel-title">AR</h3>
</div>
<div class="panel-body">
<?php include ("ar.php");  ?></div>
<div class="text-right">
</div>
</div>
</div>
 </div>
 
 
</div>


<div class="row">

<div class="col-sm-6">
<div>
<div class="panel panel-default">
<div class="panel-heading">
<h3 class="panel-title">Current Liabilities</h3>
</div>
<div class="panel-body">
<?php include ("assets/assetcomp.php");  ?></div>
<div class="text-right">
</div>
</div>
</div>
 </div>

					
<div class="col-sm-6">
<div>
<div class="panel panel-default">
	<div class="panel-heading">
 <h3 class="panel-title">Non-Current Liabilities</h3>
</div>
<div class="panel-body">
<?php include ("elia.php");  ?></div>
<div class="text-right">
                                  
</div>
</div>
</div>
</div>


 
 
</div>
					
</body>
					
					
								<!-- PAGE CONTENT ENDS -->
						</div><!-- /.row -->
