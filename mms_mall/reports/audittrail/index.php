<?php
include("connect.php");
include("../audittrail/script.php");
include("../audittrail/printaudittrail.php");
?>
<style>
.parent {
    height: 48vh;
}
</style>
<div class="row">
	<div class="col-xs-12">
		<div class="row form-group">
             <div class="col-xs-6 col-md-6" style="margin-bottom: 10px;">
                <span class="form-group pull-left"><b>Filter By Module</b>&nbsp;</span>
                <div class="col-xs-3 col-md-3">        
                        <select id="filterbymodule"  onchange="displayaudittrail();" class="form-control">
                        </select>
                </div>
                    <div class="col-xs-5 col-md-5" style="padding-bottom: 5px;">
                    <span class="input-icon" style="width: 100%;">
                        <input type="text" class="form-control" placeholder="Search" id="txtaudittrail" title="Search according to filter selected" onkeyup="displayaudittrail()">
                        <i class="ace-icon fa fa-search nav-search-icon"></i>
                    </span>
                </div>
            </div>
            <div class="col-md-6 col-xs-6">
                    <label class="control-label col-md-2">Date Range</label>
                    <div class="col-md-4">
                        <div class="input-group">
                            <input type="text" class="form-control date-picker" id="dateFrom5" value="<?php echo date('m/d/Y'); ?>">
                            <label class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></label>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="input-group">
                            <input type="text" class="form-control date-picker" id="dateTo5" value="<?php echo date('m/d/Y'); ?>">
                            <label class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></label>
                        </div>
                    </div>
                    <button class="btn btn-info btn-sm" onclick="displayaudittrail()"><span class="glyphicon glyphicon-search"></span> Go</button>
                    <button class="glyphicon glyphicon-print btn btn-sm btn-info" onclick="printaudittrail()" style="margin-bottom: 3px;"></button>
            </div>
		</div>
		<div class="row form-group" style="margin-bottom: 0px !important;">
			<div class="col-xs-12">
                <div class="parent">
				<table class="table table-bordered table-striped fixTable">
                    <thead>
                        <tr>
							<td width="20%">User Name</td>
                            <td width="20%">Time</td>
                            <td width="20%">Date</td>
                            <td width="20%">Module</td>
                            <td width="20%">Action</td>
                        </tr>
                    </thead>
                    <tbody id="displayaudittrail"></tbody>
                </table>
                </div>
               <table class="tabledash_footer table" style="margin: 0px !important;">
                <thead>
                    <tr>
                        <th id="th_tabledash_footer" colspan="7" style="width: 911px;">
                            <div class="row">
                                <div class="col-md-6">
                                    <label style="color: #FFF; float: center; margin-left: 10px; margin-top: 10px;" id="txtauditrailentries"></label>
                                </div>                               
                                <div class="col-md-6">
                                    <input type="hidden" id="txt_userpage" class="form-control input-sm" style="width: 5%; text-align: center;">
                                    <ul id="ulpaginationaudittrail" class="pagination pull-right"></ul>
                                </div>
                            </div>
                        </th>
                    </tr>
                </thead>
            </table>
            </div>
        </div>
    </div>
</div>