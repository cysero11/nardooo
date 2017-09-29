<style>
.parent {
    height: 45vh;
}

.divstat span:hover{
    border-bottom: 1px solid #438EB9;
    color: #438EB9;
    cursor: pointer;
    font-weight: bold;
}
</style>
<div class="container-fluid">
    <div class="row">
	   <div class="col-xs-12 col-md-12" style="margin-bottom: 10px;">
            <span class="form-group pull-left"><b>Filter By Group</b>&nbsp;</span>
            <div class="col-xs-2 col-md-2">        
                	<select id="filterbygroup2"  onchange="displaygroup();" class="form-control">
                    </select>
            </div>
                    <button type="button" class="btn btn-sm btn-primary" onclick="loadmodal_newgroup()">New</button>
                <div class="col-xs-2 col-md-2" style="padding-bottom: 5px;">
                <span class="input-icon" style="width: 100%;">
                    <input type="text" class="form-control" placeholder="Search" title="Search according to filter selected" id="txttermsanconditionsearch" onkeyup="displaygroup()">
                    <i class="ace-icon fa fa-search nav-search-icon"></i>
                </span>
            </div>
        	<div class="col-xs-3 col-md-3 clearfix divstat pull-right" style="text-align: center; margin-top: 10px;">
                    <span onclick="jstat('');" style="font-weight: 700;">All Status :</span>&nbsp;&nbsp;
                    <span onclick="jstat('1');"><span class='label label-success'> Active</span></span>&nbsp;|
                    <span onclick="jstat('0');"><span class='label label-danger'>Inactive</span></span>
                    <input type="hidden" id="jstat">
            </div>
        </div>
		<div class="row form-group" style="margin-bottom: 0px !important;">
			<div class="col-xs-12">
                <div class="parent">
    				<table class="table  table-bordered table-striped fixTable">
                        <thead>
                            <tr>
                                <td width="20%" class="group_name">Group Name</td>
                                <td width="20%" class="terms">Term Name</td>
                                <td width="40%" class="conditions">Condition</td>
                                <td width="10%" class="stats">Status</td>
                                <td width="10%" class="option">Option</td>
                            </tr>
                        </thead>
                        <div id="div_termandcon_table"></div>
            			<tbody id="displaygroup">

            			</tbody>
        			</table>
                </div>

				<table class="tabledash_footer table" style="margin: 0px !important;">
                <thead>
                    <tr>
                        <th id="th_tabledash_footer" colspan="7" style="width: 911px;">
                            <div class="row">
                                <div class="col-md-6">
                                    <label style="color: #FFF; float: center; margin-left: 10px; margin-top: 10px;" id="txttacentries"></label>
                                </div>                               
                                <div class="col-md-6">
                                    <input type="hidden" id="txt_userpage" class="form-control input-sm" style="width: 5%; text-align: center;">
                                    <ul id="ulpaginationtac" class="pagination pull-right"></ul>
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

<input type="hidden" id="getid">
<input type="hidden" id="auisdgnfiausdghfniuasdgnfuiasdgfniaudfgniauhsdfgnoausdyfgno">

<?php
    include("termsandcondition/script.php");
	include("termsandcondition/group_modal.php");
?>
