<div class="col-xs-12 col-sm-3">
	<div class="search-area well well-sm" style="padding-bottom: 20px;margin-bottom: 0px !important;">
		<div class="search-filter-header bg-primary">
			<h5 class="smaller no-margin-bottom">
				
				<div class="dropdown">
				  <button class="dropbtn" style="background-color: #337ab7;"><i class="icon-only ace-icon fa fa-list"></i></button>
				  <div class="dropdown-content">
				    <a href="javascript:void(0)" onclick="selectsetup(1)">Referential Files</a>
				    <a href="javascript:void(0)" onclick="selectsetup(2)">Mail Configuration</a>
				    <a href="javascript:void(0)" onclick="selectsetup(3)">TAX Configuration</a>
				    <a href="javascript:void(0)" onclick="selectsetup(4)">Terms &#38; Conditions</a>
				    <a href="javascript:void(0)" onclick="selectsetup(5)">Floor Plan</a>
				  </div>
				</div>
				&nbsp; Referential files
			</h5>
		</div>

		<div class="space-10"></div>
		<div class="hr hr-dotted"></div>
		<div class="tree-branch-header" style="padding-left: 20px;padding-bottom: 10px;">					
			<span class="tree-branch-name">						
				<i class="fa fa-file-text-o" style="color: #6fb3e0;"></i>						
				<span class="tree-label">&nbsp;&nbsp;<a class="grey" onclick="selectref(1)">Investigator</a></span>	
			</span>
		</div>
		<div class="tree-branch-header" style="padding-left: 20px;padding-bottom: 10px;">	
			<span class="tree-branch-name">						
				<i class="fa fa-file-text-o" style="color: #6fb3e0;"></i>						
				<span class="tree-label">&nbsp;&nbsp;<a class="grey" onclick="selectref(2)">Mall</a></span>					
			</span>
		</div>
		<div class="tree-branch-header" style="padding-left: 20px;padding-bottom: 10px;">	
			<span class="tree-branch-name">						
				<i class="fa fa-file-text-o" style="color: #6fb3e0;"></i>						
				<span class="tree-label">&nbsp;&nbsp;<a class="grey" onclick="selectref(3)">Building</a></span>					
			</span>
		</div>
		<div class="tree-branch-header" style="padding-left: 20px;padding-bottom: 10px;">	
			<span class="tree-branch-name">						
				<i class="fa fa-file-text-o" style="color: #6fb3e0;"></i>						
				<span class="tree-label">&nbsp;&nbsp;<a class="grey" onclick="selectref(4)">Floor</a></span>					
			</span>
		</div>
		<div class="tree-branch-header" style="padding-left: 20px;padding-bottom: 10px;">
			<span class="tree-branch-name">						
				<i class="fa fa-file-text-o" style="color: #6fb3e0;"></i>						
				<span class="tree-label">&nbsp;&nbsp;<a class="grey" onclick="selectref(5)">Wing</a></span>					
			</span>	
		</div>
		<div class="tree-branch-header" style="padding-left: 20px;padding-bottom: 10px;">
			<span class="tree-branch-name">						
				<i class="fa fa-file-text-o" style="color: #6fb3e0;"></i>						
				<span class="tree-label">&nbsp;&nbsp;<a class="grey" onclick="selectref(6)">Unit</a></span>					
			</span>	
		</div>
		<div class="tree-branch-header" style="padding-left: 20px;padding-bottom: 10px;">
			<span class="tree-branch-name">						
				<i class="fa fa-file-text-o" style="color: #6fb3e0;"></i>						
				<span class="tree-label">&nbsp;&nbsp;<a class="grey" onclick="selectref(7)">Classification</a></span>					
			</span>	
		</div>
		<div class="tree-branch-header" style="padding-left: 20px;padding-bottom: 10px;">
			<span class="tree-branch-name">						
				<i class="fa fa-file-text-o" style="color: #6fb3e0;"></i>						
				<span class="tree-label">&nbsp;&nbsp;<a class="grey" onclick="selectref(8)">Business Type</a></span>					
			</span>	
		</div>
		<div class="tree-branch-header" style="padding-left: 20px;padding-bottom: 10px;">
			<span class="tree-branch-name">						
				<i class="fa fa-file-text-o" style="color: #6fb3e0;"></i>						
				<span class="tree-label">&nbsp;&nbsp;<a class="grey" onclick="selectref(9)">Amenities</a></span>					
			</span>	
		</div>
		<div class="tree-branch-header" style="padding-left: 20px;padding-bottom: 10px;">
			<span class="tree-branch-name">						
				<i class="fa fa-file-text-o" style="color: #6fb3e0;"></i>						
				<span class="tree-label">&nbsp;&nbsp;<a class="grey" onclick="selectref(10)">User Management</a></span>					
			</span>	
		</div>
		<div class="tree-branch-header" style="padding-left: 20px;padding-bottom: 10px;">																											
		</div>
	</div>
</div>

<div class="col-xs-12 col-sm-9" style=" border: 1px solid #d6e1ea;" id="div_ref_content">
	<?php
		include("ref_investigator.php");
	?>
</div>