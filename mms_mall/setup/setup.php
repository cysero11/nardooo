<div class="page-header row" style="margin-bottom: 10px;padding-top:10px;background-color: #edf4f8;padding-bottom: 10px;">
	<div style="padding-left: 0px!important;">
		<h1><span class="fa fa-cogs"></span> <strong>SETUP</strong></h1>
		<input type="hidden" id="txtreservationpages" name="">
	</div>
</div>
<div class="page-content" style="padding: 0px;">
	<div class="tabbable">
        <ul class="nav nav-tabs" id="myTaba">

            <li class="active">
                <a data-toggle="tab" href="#tab1">
                    <i class="green ace-icon fa fa-list bigger-120"></i>
                    Referentials
                </a>
            </li>

            <li>
                <a data-toggle="tab" href="#tab2">
                    <i class="green ace-icon fa fa-building bigger-120"></i>
                    Mall Configuration
                </a>
            </li>

            <li>
                <a data-toggle="tab" href="#tab3">
                    <i class="green ace-icon fa fa-clipboard bigger-120"></i>
                    Terms and Conditions
                </a>
            </li>

            <li>
                <a data-toggle="tab" href="#tab4">
                    <i class="green menu-icon fa fa-users bigger-120"></i>
                    User and Accessibility
                </a>
            </li>

            <li>
                <a data-toggle="tab" href="#tab5">
                    <i class="green ace-icon fa fa-trello bigger-120"></i>
                    Company List
                </a>
            </li>

            <li>
                <a data-toggle="tab" href="#tab6">
                    <i class="green ace-icon fa fa-check bigger-120"></i>
                    Maintenance Checklist
                </a>
            </li>
        </ul>
        <div class="tab-content">
            <div id="tab1" class="tab-pane fade in active">
				<div class="row">
					<div class="container-fluid">
						<div class="row-fluid">
							<div class="col-md-4">
								<div class="panel panel-primary">
									<div class="panel-heading" style="padding: 0px !important;">
										<div class="panel-heading">
											<label style="background-color: transparent !important; border: none;"><span class="glyphicon glyphicon-list" style="font-size: 20px;"></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <span id="refTitle">Referential Files</span></label>
										</div>
									</div>
									
									<div class="ref panel-body" id="refUnit" >
										<div class="panel panel-primary">
						                    <div class="panel-heading">
						                        <h4 class="panel-title">
						                            <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#Unit" aria-expanded="false">
						                                <i class="bigger-110 ace-icon fa fa-angle-right" data-icon-hide="ace-icon fa fa-angle-down" data-icon-show="ace-icon fa fa-angle-right"></i>
						                                &nbsp;Unit
						                            </a>
						                        </h4>
						                    </div>
						                    <div class="panel-collapse collapse" id="Unit" aria-expanded="false">
						                        <div class="panel-body">
						                            <div class="row">
						                                <ul class="list-group" id="forReferentials" style="margin-top: -13px;margin-bottom: -13px;">
															<li onclick="refTypes('unit_class', 'Classification', 'unit_ClassMod')" class="list-group-item">&nbsp;&nbsp;&nbsp;&nbsp;<span class="fa fa-file-o"></span> Classification</li>
															<li onclick="refTypes('unit_dept', 'Department', 'unit_DeptMod')" class="list-group-item">&nbsp;&nbsp;&nbsp;&nbsp;<span class="fa fa-file-o"></span> Department</li>
															<li onclick="refTypes('unit_category', 'Category', 'unit_CategoryMod' )" class="list-group-item">&nbsp;&nbsp;&nbsp;&nbsp;<span class="fa fa-file-o"></span> Category</li>
															<li onclick="refTypes('unit_industry', 'Industry','unit_IndustryMod' )" class="list-group-item">&nbsp;&nbsp;&nbsp;&nbsp;<span class="fa fa-file-o"></span> Industry</li>
															<li onclick="refTypes('unit_bank', 'Bank', 'unit_BankMod' )" class="list-group-item">&nbsp;&nbsp;&nbsp;&nbsp;<span class="fa fa-file-o"></span> Bank Name</li>
															<li onclick="refTypes('unit_position', 'Position', 'unit_PositionMod' )" class="list-group-item">&nbsp;&nbsp;&nbsp;&nbsp;<span class="fa fa-file-o"></span> Position</li>
															<li onclick="refTypes('unit_req', 'Requirements', 'unit_ReqMod' )" class="list-group-item">&nbsp;&nbsp;&nbsp;&nbsp;<span class="fa fa-file-o"></span> Requirements</li>
															<li onclick="refTypes('unit_floorplan', 'Floor Plan', 'unit_FloorPlanMod' )" class="list-group-item">&nbsp;&nbsp;&nbsp;&nbsp;<span class="fa fa-file-o"></span>Floor Plan</li>
														</ul>
						                            </div>
						                        </div>
						                    </div>
						                </div>
						                <div class="panel panel-primary">
						                    <div class="panel-heading">
						                        <h4 class="panel-title">
						                            <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#Maintenance" aria-expanded="false">
						                                <i class="bigger-110 ace-icon fa fa-angle-right" data-icon-hide="ace-icon fa fa-angle-down" data-icon-show="ace-icon fa fa-angle-right"></i>
						                                &nbsp;Maintenance
						                            </a>
						                        </h4>
						                    </div>
						                    <div class="panel-collapse collapse" id="Maintenance" aria-expanded="false">
						                        <div class="panel-body">
						                            <div class="row">
						                                <ul class="list-group" id="forReferentials" style="margin-top: -13px;margin-bottom: -13px;">
															<li onclick="refTypes('main_cat', 'Category', 'main_CatMod')" class="list-group-item">&nbsp;&nbsp;&nbsp;&nbsp;<span class="fa fa-file-o"></span> Category</li>
															<li onclick="refTypes('main_cat', 'Equipment', 'main_Equip')" class="list-group-item">&nbsp;&nbsp;&nbsp;&nbsp;<span class="fa fa-file-o"></span> Equipment</li>
															<li onclick="refTypes('main_settask', 'Set Task', 'main_SetTaskMod' )" class="list-group-item">&nbsp;&nbsp;&nbsp;&nbsp;<span class="fa fa-file-o"></span> Set Task</li>
															<!-- <li onclick="refTypes('main_charges', 'Charges','main_ChargesMod' )" class="list-group-item">&nbsp;&nbsp;&nbsp;&nbsp;<span class="fa fa-file-o"></span> Charges</li> -->
															<li onclick="refTypes('main_cat', 'Security and Communication System Equipment', 'main_SCSE')" class="list-group-item">&nbsp;&nbsp;&nbsp;&nbsp;<span class="fa fa-file-o"></span> Security and Communication System Equipment</li>
															<li onclick="refTypes('main_cat', 'Facilities', 'main_Facilities')" class="list-group-item">&nbsp;&nbsp;&nbsp;&nbsp;<span class="fa fa-file-o"></span> Facilities</li>
															<!-- <li onclick="refTypes('main_cat', 'Department', 'main_Department')" class="list-group-item">&nbsp;&nbsp;&nbsp;&nbsp;<span class="fa fa-file-o"></span> Department</li> -->
															<li onclick="refTypes('main_cat', 'House Rules', 'main_HouseRules')" class="list-group-item">&nbsp;&nbsp;&nbsp;&nbsp;<span class="fa fa-file-o"></span> House Rules</li>
														</ul>
						                            </div>
						                        </div>
						                    </div>
						                </div>
						                <div class="panel panel-primary">
						                    <div class="panel-heading">
						                        <h4 class="panel-title">
						                            <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#Employee" aria-expanded="false">
						                                <i class="bigger-110 ace-icon fa fa-angle-right" data-icon-hide="ace-icon fa fa-angle-down" data-icon-show="ace-icon fa fa-angle-right"></i>
						                                &nbsp;Employee Management
						                            </a>
						                        </h4>
						                    </div>
						                    <div class="panel-collapse collapse" id="Employee" aria-expanded="false">
						                        <div class="panel-body">
						                            <div class="row">
						                                <ul class="list-group" id="forReferentials" style="margin-top: -13px;margin-bottom: -13px;">
															<li onclick="refTypes('main_cat', 'Employee', 'em_Employee')" class="list-group-item">&nbsp;&nbsp;&nbsp;&nbsp;<span class="fa fa-file-o"></span> Employee</li>
														</ul>
						                            </div>
						                        </div>
						                    </div>
						                </div>
										
									</div>

									<div class="ref panel-body" id="refMaintenance" style="display:none;" >
										
									</div>


									<div class="ref panel-body" id="refMallConfig" style="display:none;">
										<li class="disable list-group-item"><span class="glyphicon glyphicon-folder-open"></span>&nbsp;&nbsp;<b>Referental Files</b></li>
										<ul class="list-group" id="forReferentials">
											<li onclick="mallTypes('department', 'Department')" class="list-group-item active">&nbsp;&nbsp;&nbsp;&nbsp;<span class="fa fa-file-o"></span> Department</li>
											<li onclick="mallTypes('branch', 'Branch List')" class="list-group-item">&nbsp;&nbsp;&nbsp;&nbsp;<span class="fa fa-file-o"></span> Branch List</li>
											<li onclick="mallTypes('floor', 'Floor List')" class="list-group-item">&nbsp;&nbsp;&nbsp;&nbsp;<span class="fa fa-file-o"></span> Floor List</li>
											<li onclick="mallTypes('wing', 'Wing List')" class="list-group-item">&nbsp;&nbsp;&nbsp;&nbsp;<span class="fa fa-file-o"></span> Wing List</li>
											<li onclick="mallTypes('country', 'Country')" class="list-group-item">&nbsp;&nbsp;&nbsp;&nbsp;<span class="fa fa-file-o"></span> Country</li>
											<li onclick="mallTypes('city', 'City')" class="list-group-item">&nbsp;&nbsp;&nbsp;&nbsp;<span class="fa fa-file-o"></span> City</li>
											<li onclick="mallTypes('terms', 'Terms & Condition Group')" class="list-group-item">&nbsp;&nbsp;&nbsp;&nbsp;<span class="fa fa-file-o"></span> Terms & Condition Group</li>
											<li onclick="mallTypes('tax', 'Tax Type')" class="list-group-item">&nbsp;&nbsp;&nbsp;&nbsp;<span class="fa fa-file-o"></span> Tax Type</li>
										</ul> 
									</div>

									<div class="">
										
									</div>
								</div>
							</div>

							<div class="col-md-8">
								<div class="panel panel-primary">
									<div class="panel-heading">
										<span id="titleRef"></span>
										
									</div>

									<div class="panel-body">
										<?php 
											include "referentialFiles/unit_class/index.php";
											include "referentialFiles/unit_dept/index.php"; 
											include "referentialFiles/unit_category/index.php"; 
											include "referentialFiles/unit_industry/index.php"; 
											include "referentialFiles/unit_bank/index.php"; 
											include "referentialFiles/unit_position/index.php"; 
											include "referentialFiles/unit_req/index.php"; 
											include "referentialFiles/main_Cat/index.php"; 
											include "referentialFiles/main_settask/index.php"; 
											include "referentialFiles/main_charges/index.php"; 
											include "referentialFiles/unit_floorplan/index.php"; 
											include "referentialFiles/main_equipment/index.php"; 
											include "referentialFiles/main_SCSE/index.php";
											include "referentialFiles/main_facilities/index.php";
											include "referentialFIles/main_Department/index.php";
											include "referentialFIles/main_HouseRules/index.php";
											include "referentialFIles/em_Employee/index.php";
											//include "referentialFiles/unit/department.php"; 
											//include "referentialFiles/unit/unit.php"; 
											//include "referentialFiles/unit/unit.php"; 
										?>
									</div>
								</div>
							</div>
						</div>	
					</div>
				</div>
			</div>

           	<div id="tab2" class="tab-pane fade">                    
                <div class="row">
                	<?php include ("mall_configuration/mall-conf.php"); ?>
                </div>
            </div>

            <div id="tab3" class="tab-pane fade">
                <div class="row">
                	<?php include ("termsandcondition/termsandcondition.php"); ?>
                </div>
            </div>

            <div id="tab4" class="tab-pane fade">
            	<div class="row">
               		<?php include ("user/user.php"); ?>
                </div>
            </div>

            <div id="tab5" class="tab-pane fade">
            	<div class="row">
                	<?php include ("profiles/company_list.php"); ?>
                </div>
            </div>

            <div id="tab6" class="tab-pane fade">
            	<div class="row">
                	<?php include ("maintenance/setup.php"); ?>
                </div>
            </div>            
        </div>
    </div>
</div>


<?php include "../setup/script.php"; ?>
<?php 
	include "referentialfiles/unit_class/script.php"; 
	include "referentialfiles/unit_dept/script.php"; 
	include "referentialfiles/unit_category/script.php"; 
	include "referentialfiles/unit_industry/script.php"; 
	include "referentialfiles/unit_bank/script.php"; 
	include "referentialfiles/unit_position/script.php"; 
	include "referentialfiles/unit_req/script.php"; 
	include "referentialfiles/main_cat/script.php"; 
	include "referentialfiles/main_settask/script.php"; 
	include "referentialfiles/main_charges/script.php";
    include "referentialFiles/unit_floorplan/script.php"; 	
	include "referentialFiles/main_equipment/script.php"; 
	include "referentialFiles/main_SCSE/script.php";
	include "referentialFIles/main_facilities/script.php";
	include "referentialFIles/main_Department/script.php";
	include "referentialFIles/main_HouseRules/script.php";
	include "referentialFIles/em_Employee/script.php";
	
	#include "referentialfiles/department/script.php"; 
?>