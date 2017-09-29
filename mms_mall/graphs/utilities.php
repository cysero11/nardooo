<?php
						
include('fusioncharts.php');

?>
<body>
	
<div class="page-header" style="background-color: #edf4f8;padding-right: 15px;padding-top: 12px;">
	
	<h1 style="color: black">
		
	<b>UTILITIES CONSUMPTION</b>
	</h1>
</div><!-- /.page-header -->


<div class="row">

<div class="col-sm-6">
<div>
<div class="panel panel-default">
<div class="panel-heading">
<h3 class="panel-title">Electric Reading</h3>
</div>
<div class="panel-body">
<?php include ("elec.php");  ?></div>
<div class="text-right">
</div>
</div>
</div>
 </div>

<div class="col-sm-6">
<div>
<div class="panel panel-default">
<div class="panel-heading">
<h3 class="panel-title">Water Reading</h3>
</div>
<div class="panel-body">
<?php include ("water.php");  ?></div>
<div class="text-right">
</div>
</div>
</div>
 </div>
					

 
 
</div>
					
</body>
					
					
								<!-- PAGE CONTENT ENDS -->
						</div><!-- /.row -->
