<style>
  .parent2 {
        height: 30vh;
    }
</style>

<!-- ADD COMPLAINT BUTTON IN TENANTS  -->
<div class="modal fade" id="modal_addcomplaints" role="dialog">
  <div class="modal-dialog" style="width: 900px;">

    <!-- Modal content-->
    <div class="modal-content">

       <!-- Modal header-->
      <div class="modal-header btn-primary" style="margin-bottom: 10px;padding-top:10px;padding-bottom: 10px;">
        <button type="button" class="close" data-dismiss="modal" onclick="closeaddcomplaints()">&times;</button>
        <h4 class="modal-title" style="font-family: Roboto;font-size: 18px;">New Complaints</h4>
        <input type="hidden" class="cmodal" id="cmodal" name="">
      </div>

       <!-- Modal body-->
       <div class="modal-body"  id="modal-body-group">
          <!-- Group Name -->
          <div class="container-fluid">
            <div class="well">
              <div class="row">
                <div class="col-md-3 col-xs-12">
                      Complaint Code
                </div>
                <div class="col-md-5 col-xs-12">
                    <div class="input-group">
                        <select id="complaintscode1" class="crequired form-control" onchange="selectcomplaintscode(this.value);" placeholder="Complaints Code ">
                      </select>
                        <div class="spinbox-buttons input-group-btn">
                          <button style="margin-left: 10px;" type="button" class="btn spinbox-up btn-sm btn-primary pull-right" onclick="addcomplaintscode()">
                            <i class="icon-only  ace-icon ace-icon fa fa-plus bigger-110"></i>
                          </button>
                        </div>
                    </div>
                </div>

              </div>

              <div class="row">
              <div class="col-md-3 col-xs-12">
                    Description
              </div>
              <div class="col-md-5 col-xs-12">
                  <textarea class="form-control crequired txtcomplaints" id="complaintsdescription" placeholder="Description" style="height: 70px !important;"></textarea>
              </div>
            </div>
          </div>
            <div class="widget-box ui-sortable-handle" id="widget-box-1">
                  <div class="widget-header">
                      <h3 class="widget-title label-title">Complaints</h3>
                  </div>
          <div class="parent2">
              <table class="table table-bordered table-striped fixTable" style="display: block;">
                  <thead>
                      <tr>
                          <th width="10%"><b>Date Entry</b></th>
                          <th width="10%"><b>Complaint Code</b></th>
                          <th width="10%"><b>Complaint Description</b></th>
                          <th width="10%"><b>Date Received</b></th>
                          <th width="10%"><b>Date Resolved</b></th>
                          <th width="10%"><b>Duration</b></th>
                          <th width="10%"><b>Resolved by</b></th>
                          <th width="10%"><b>Complaint Status</b></th>
                          <th width="10%"><b>Priority Status</b></th>
                          <th width="10%"><b>User ID</b></th>
                      </tr>
                  </thead>
                  <tbody id="displaycomplaintspertenant"></tbody>
              </table>
          </div>

            <table class="tabledash_footer table" style="margin: 0px !important;">
              <thead>
                  <tr>
                      <th id="th_tabledash_footer" width="" colspan="7" style="width: 911px;">
                          <div class="row">
                              <div class="col-md-6">
                                  <label style="color: #FFF; float: center; margin-left: 10px; margin-top: 10px;" id="txtcomplaintsentriespertenant"></label>
                              </div>                               
                              <div class="col-md-6">
                                  <input type="hidden" id="txt_userpagepertenant" class="form-control input-sm" style="width: 5%; text-align: center;">
                                  <ul id="ulpaginationcomplaintpertenant" class="pagination pull-right"></ul>
                              </div>
                          </div>
                      </th>
                  </tr>
              </thead>
            </table>
          </div>
          </div>
        <!--  -->
      </div>
        <!-- Modal footer-->
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" onclick="sendcomplaints()"><i class="ace-icon fa fa-check"></i>&nbsp;Save</button>
      </div>
    </div>
  </div>
</div>

<input type="hidden" id="hiddenid2">
<input type="hidden" id="hiddenidcname">
<input type="hidden" id="hiddenunit">
<input type="hidden" id="hiddenstats">
<input type="hidden" id="hiddencompany">
<input type="hidden" id="hiddenbuilding_id">
<input type="hidden" id="hiddenunitid">
<input type="hidden" id="hiddenfloorid">

<!-- ============ MODAL ADD Complaints ============= -->
<div class="modal fade" id="modal_addcomplaintscode" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">

       <!-- Modal header-->
      <div class="modal-header btn-primary" style="margin-bottom: 10px;padding-top:10px;padding-bottom: 10px;">
        <button type="button" class="close" data-dismiss="modal" onclick="unload_addcomplaintscode()">&times;</button>
        <h4 class="modal-title" style="font-family: Roboto;font-size: 18px;">Complaints</h4>
      </div>

       <!-- Modal body-->
       <div class="modal-body"  id="modal-body-group">

          <!-- Group Name -->
          <div class="container-fluid">
            <div class="row">
              <div class="col-md-3 col-xs-12">
                    Complaint Code:
              </div>
              <div class="col-md-9 col-xs-12">
                  <input type="text" id="complaintscode" class="form-control required" placeholder="Complaint Code">
              </div>
           </div>
          </div>

           <div class="container-fluid">
            <div class="row">
              <div class="col-md-3 col-xs-12">
                    Description:
              </div>
              <div class="col-md-9 col-xs-12">
                  <textarea id="complaintcodedescription" class="form-control required" placeholder="Complaint Code Description"></textarea>
              </div>
           </div>
          </div>

           <div class="row">
                  <div class="col-md-3 col-xs-12">
                        Priority Status:
                  </div>
                  <div class="col-md-9 col-xs-12">
                    <label>
                      <input type="radio" name="stats" value="High" id="high" class="ace ace-checkbox-2 stats" >
                      <span class="lbl"> High</span>
                    </label>
                    <label>
                      <input type="radio" name="stats" value="Medium" id="Medium" class="ace ace-checkbox-2 stats" >
                      <span class="lbl"> Medium</span>
                    </label>
                    <label>
                      <input type="radio" name="stats" value="Low" id="Low" class="ace ace-checkbox-2 stats" >
                      <span class="lbl"> Low</span>
                    </label>
                    <!-- <input type="radio" name="stats" value="High" id="high" class="stats"> High
                    <input type="radio" name="stats" value="Medium" id="medium" class="stats">Medium
                    <input type="radio" name="stats" value="Low" checked id="low" class="stats"> Low -->
                  </div>
            </div>
        <!--  -->
      </div>

       <!-- Modal footer-->
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" onclick="addcomplaintscode2()"><i class="ace-icon fa fa-check"></i>&nbsp;Save</button>
      </div>
    </div>

  </div>
</div>
