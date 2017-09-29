<div class="modal fade" id="modal_penalize" role="dialog" area-hidden="true" data-keyboard="false" data-backdrop="static">
  <div class="modal-dialog modal-lg">
    <!-- Modal content-->
    <div class="modal-content " style="width:130%;">
       <!-- Modal header-->
      <div class="modal-header" style="background-color: #438EB9;">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" id="" style="color:white; font-weight: bold;">Tenant List</h4>
        <h6 class="modal-title" id="" style="color:white; font-weight: bold;font-style:italic;">(to be penalized)
      </div>

       <!-- Modal body-->
      <div class="modal-body" id="">
        <div class="widget-box widget-color-pink">
            <div class="widget-header" style="padding-left:5px;padding-top:5px;">
                <div class="row form-group" style="margin-bottom: 0px;">
                  <div class="col-md-4">
                    <span class="input-icon" style="width: 100%;">
                        <input type="text" class="form-control" id="txtsearchpenal" placeholder="Search Store Name" onkeyup="loadpenallist()">
                        <i class="ace-icon fa fa-search nav-search-icon"></i>
                    </span>
                  </div>
                  <div class="col-md-8">
                      <div class="widget-toolbar">
                          <i id="spinner_penal" class="ace-icon fa fa-spinner bigger-160"></i>
                      </div>
                  </div>
                </div>
            </div>
            <div class="widget-body" style="height: 290px;display: block;">
                <table id="simple-table" class="table  table-bordered table-hover">
                    <thead>
                        <tr>
                            <th style="background-color: #f2f2f2 !important;color:#707070;width:20px;padding:5px;">
                              <label>
                                  <input name="form-field-checkbox" class="ace" type="checkbox" value="Company_Name" id="select_all_penalty">
                                  <span class="lbl"></span>
                              </label>
                            </th>
                            <th style="background-color: #f2f2f2 !important;color:#707070;">Tenant</th>
                            <th style="background-color: #f2f2f2 !important;color:#707070;">Penalty Description</th>
                            <th style="background-color: #f2f2f2 !important;color:#707070;text-align: right;">Penalty Amount</th>
                        </tr>
                    </thead>
                    <tbody id="tblpenallist" tabindex="0" style="overflow: hidden; outline: none;">
                    </tbody>
                </table>
            </div>
            <div class="widget-toolbox padding-8 clearfix">
             <!--  <button class="btn btn-xs btn-danger pull-left">
                <i class="ace-icon fa fa-times"></i>
                <span class="bigger-110">Remove Penalty</span>
              </button> -->

              <button class="btn btn-xs btn-yellow pull-right" onclick="clickpenalty()">
                <i class="ace-icon fa fa-thumb-tack"></i>
                <span class="bigger-110">Post Penalty</span>                
              </button>
            </div>
        </div>      
      </div>
    </div>
    
  </div>
</div>

<div class="modal fade" id="modal_endo" role="dialog" area-hidden="true" data-keyboard="false" data-backdrop="static">
  <div class="modal-dialog modal-lg">
    <!-- Modal content-->
    <div class="modal-content ">
       <!-- Modal header-->
      <div class="modal-header" style="background-color: #438EB9;">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" id="" style="color:white; font-weight: bold;">Tenant List</h4>
        <h6 class="modal-title" id="" style="color:white; font-weight: bold;font-style:italic;">(with contract that about to end)</h6>
      </div>

       <!-- Modal body-->
      <div class="modal-body" id="">
        <div class="widget-box widget-color-orange">
            <div class="widget-header" style="padding-left:5px;padding-top:5px;">
                <div class="row form-group" style="margin-bottom: 0px;">
                  <div class="col-md-4">
                    <span class="input-icon" style="width: 100%;">
                        <input type="text" class="form-control" id="txtsearchendo" placeholder="Search Store Name" onkeyup="loadendolist()">
                        <i class="ace-icon fa fa-search nav-search-icon"></i>
                    </span>
                  </div>
                  <div class="col-md-8">
                      <div class="widget-toolbar">
                          <i id="spinner_endo" class="ace-icon fa fa-spinner bigger-160"></i>
                      </div>
                  </div>
                </div>
            </div>
            <div class="widget-body" style="height: 290px;display: block;">
                <table id="simple-table" class="table  table-bordered table-hover">
                    <thead>
                        <tr>
                            <th style="background-color: #f2f2f2 !important;color:#707070;width:20px;">
                              <label>
                                  <input name="form-field-checkbox" class="ace" type="checkbox" value="" id="select_all_endo">
                                  <span class="lbl"></span>
                              </label>
                            </th>
                            <th style="background-color: #f2f2f2 !important;color:#707070;">Tenant</th>
                            <th style="background-color: #f2f2f2 !important;color:#707070;">End Date</th>
                            <th style="background-color: #f2f2f2 !important;color:#707070;">Remaining Days</th>
                        </tr>
                    </thead>
                    <tbody id="tblendolist" tabindex="0" style="overflow: hidden; outline: none;">
                     
                    </tbody>
                </table>
            </div>
            <div class="widget-toolbox padding-8 clearfix">
             <!--  <button class="btn btn-xs btn-danger pull-left">
                <i class="ace-icon fa fa-times"></i>
                <span class="bigger-110">I don't accept</span>
              </button> -->

              <button class="btn btn-xs btn-success pull-right" onclick="endoclick()">
                <i class="ace-icon fa fa-repeat icon-on-right"></i>
                <span class="bigger-110">&nbsp;Change Status</span>            
              </button>
            </div>
        </div>      
      </div>
    </div>    
  </div>
</div>