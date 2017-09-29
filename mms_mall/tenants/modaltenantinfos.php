<style media="screen">
    .modal-body .row {
        margin-bottom: 4px !important;
    }

    .activated  td{
        color: #FFF !important;
        background-color: #428BCA !important;
    }

    #pdc label,
    #maintenance label{
        font-size: 13px !important;
    }

  .hovertext{
    position: relative;
    width: 500px;
    text-decoration: none !important;
    text-align: left;
  }
  .hovertext::after{
    content: attr(title);
    position: absolute;
    left: 0;
    bottom: -270px !important;
    padding: 0.5em 20px;
    width: 100%;
    background: rgba(0,0,0,0.8);
    text-decoration: none !important;
    color: #fff;
    opacity: 0;
    -webkit-transition: 0.5s;
    -moz-transition: 0.5s;
    -o-transition: 0.5s;
    -ms-transition: 0.5s;
  }
  .hovertext:after, .hovertext:focus::after {
    opacity: 1.0;
  }

  .hoverdoc {
    position: relative;
    width: 500px;
    text-decoration: none !important;
    text-align: left;
  }
  .hoverdoc::after {
    content: attr(title);
    position: absolute;
    left: 0;
    bottom: -270px !important;
    padding: 0.5em 20px;
    width: 100%;
    background: rgba(0,0,0,0.8);
    text-decoration: none !important;
    color: #fff;
    opacity: 0;
    -webkit-transition: 0.5s;
    -moz-transition: 0.5s;
    -o-transition: 0.5s;
    -ms-transition: 0.5s;
  }
  .hoverdoc:hover::after, .hoverdoc:focus::after {
    opacity: 1.0;
  }

</style>
<div class="modal fade" role="dialog" id="tenantinfo" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-lg" style="width:85% !important;">
        <div class="modal-content" style="width:100% !important;">
            <div class="modal-header">
                <button type="button" class="close" onclick="closeinfo();">&times;</button>
                <h4 class="modal-title">Tenant Information</h4>
                <input type="hidden" id="mallidprint">
                <input type="hidden" id="hiddentenantidulet">
                <input type="hidden" id="hiddeninqidulet">
                <input type="hidden" id="hiddenappidulet">
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-5 col-xs-12">
                        <div class="row">
                            <div class="form-group">
                                <label class="col-md-5 control-label" style="color: #303030 !important; font-weight: 700;">Company Name</label>
                                <div class="col-md-7">
                                    <label type="text" class="form-control input-sm" id="company" style="text-align: center; font-size: 14px; color: black !important;"></label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <label class="col-md-5 control-label" style="color: #303030 !important; font-weight: 700;">Contact Person</label>
                                <div class="col-md-7">
                                    <label type="text" class="form-control input-sm" id="contactp" style="text-align: center; font-size: 14px; color: black !important;"></label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <label class="col-md-5 control-label" style="color: #303030 !important; font-weight: 700;">Branch Name</label>
                                <div class="col-md-7">
                                    <label type="text" class="form-control input-sm" id="branch" style="text-align: center; font-size: 14px; color: black !important;"></label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5 col-xs-12">
                        <div class="row">
                            <div class="form-group">
                                <label class="col-md-5 control-label" style="color: #303030 !important; font-weight: 700;">Tenant ID</label>
                                <div class="col-md-7">
                                    <label type="text" style="text-align: center; font-size: 14px; color: black !important;" class="form-control input-sm" id="Tid" ></label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <label class="col-md-5 control-label" style="color: #303030 !important; font-weight: 700;">Store Code</label>
                                <div class="col-md-7">
                                    <label type="text" style="text-align: center; font-size: 14px; color: black !important;" class="form-control input-sm" id="merchant_code" ></label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <label class="col-md-5 control-label" style="color: #303030 !important; font-weight: 700;">Billing Type</label>
                                <div class="col-md-7">
                                    <label type="text" style="text-align: center; font-size: 14px; color: black !important;" class="form-control input-sm" id="billingttype" ></label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2 col-xs-12">
                    <form method="post" action="#" enctype="multipart/form-data" id="savephoto">
                        <input type="hidden" name="hiddentenantidsapicture" id="hiddentenantidsapicture">
                        <div id="imgledgerhere">
                            <label class="myupload">
                                <img  class="img-responsive img-thumbnail" style="height: 110px; width: 110px;" onerror="imgerror($(this));" id="imglogo">
                                <input type="file" name="tenantupload" id="tenantupload" style="display: none;" onchange="showimg2()">
                            </label>
                        </div>
                        <button class="btn btn-sm btn-info" style="width: 110px;"><center>SAVE IMAGE</center></button>
                    </form>
                        <label style="text-align: center; display: none;" class="form-control input-sm" id="inqid"></label>
                        <!-- src="server/company/COM-0000062/trades/TRADE-0000022/jollibee.jpg" -->
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="tabbable">
                            <ul class="nav nav-tabs" id="myTab">
                                <li class="active thistab">
                                    <a data-toggle="tab" href="#custdetail" style="font-weight: 800; font-size: 13px; color: black !important;">
                                        <i class="green ace-icon fa fa-list-alt bigger-120"></i>
                                        Customer Details
                                    </a>
                                </li>

                                <li class="thistab">
                                    <a data-toggle="tab" href="#contperson" style="font-weight: 800; font-size: 13px; color: black !important;">
                                        <i class="green ace-icon fa fa-phone bigger-120"></i>
                                        Contact Person
                                    </a>
                                </li>

                                <li class="thistab">
                                    <a data-toggle="tab" href="#documents" style="font-weight: 800; font-size: 13px; color: black !important;">
                                        <i class="green ace-icon fa fa-folder bigger-120"></i>
                                        Documents&nbsp;&nbsp;&nbsp;
                                    </a>
                                </li>

                                <li class="thistab">
                                    <a data-toggle="tab" href="#accdetails" style="font-weight: 800; font-size: 13px; color: black !important;">
                                        <i class="green ace-icon fa fa-file-text bigger-120"></i>
                                        SOA&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    </a>
                                </li>

                                <li class="pdctab">
                                    <a data-toggle="tab" href="#pdc" style="font-weight: 800; font-size: 13px; color: black !important;">
                                        <i class="green ace-icon fa fa-calendar-check-o bigger-120"></i>
                                        PDC&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    </a>
                                </li>

                                <li class="pdctab">
                                    <a data-toggle="tab" href="#maintenance" style="font-weight: 800; font-size: 13px; color: black !important;">
                                        <i class="green ace-icon fa fa-cog bigger-120"></i>
                                        Maintenance History
                                    </a>
                                </li>

                                <li class="pdctab">
                                    <a data-toggle="tab" href="#contract" style="font-weight: 800; font-size: 13px; color: black !important;">
                                        <i class="green ace-icon fa fa-pencil-square-o bigger-120"></i>
                                        Contract&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    </a>
                                </li>

                            </ul>

                            <div class="tab-content" style="display:block;height:300px;overflow-y: auto;">
                                <div id="custdetail" class="tab-pane fade in active">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <label style="font-weight: 900; color: #303030;">Contract Date</label>
                                                    <div class="row">
                                                        <div class="form-group">
                                                            <label class="col-md-4 control-label">Start Date</label>
                                                            <div class="col-md-8">
                                                                <input type="text" class="form-control input-sm" id="Sdate" readonly="true" style="color: red #important; color: black !important;"/>
                                                                <span class="fa fa-calendar form-control-feedback" style="margin-right: 15px;"></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="form-group">
                                                            <label class="col-md-4 control-label">End Date</label>
                                                            <div class="col-md-8">
                                                                <input type="text" class="form-control input-sm" id="Edate" readonly="true" style="color: black !important;"/>
                                                                <span class="fa fa-calendar form-control-feedback" style="margin-right: 15px;"></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <br>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <label style="font-weight: 900; color: #303030;">Remarks</label><br>
                                                    <textarea id="remarkshere" class="form-control"  rows="4" readonly></textarea>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <label style="font-weight: 900; color: #303030;">Unit Details</label>
                                                    <div class="row">
                                                        <div class="form-group">
                                                            <label class="col-md-5 control-label">Unit #</label>
                                                            <div class="col-md-7">
                                                                <input type="text" class="form-control input-sm" id="unitno" readonly="true" style="color: black !important;"/>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="form-group">
                                                            <label class="col-md-5 control-label">Floor</label>
                                                            <div class="col-md-7">
                                                                <input type="text" class="form-control input-sm" id="floorno" readonly="true" style="color: black !important;"/>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="form-group">
                                                            <label class="col-md-5 control-label">Wing</label>
                                                            <div class="col-md-7">
                                                                <input type="text" class="form-control input-sm" id="wing" readonly="true" style="color: black !important;"/>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="form-group">
                                                            <label class="col-md-5 control-label">Unit Type</label>
                                                            <div class="col-md-7">
                                                                <input type="text" class="form-control input-sm" id="unittype" readonly="true" style="color: black !important;"/>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="form-group">
                                                            <label class="col-md-5 control-label">Classification</label>
                                                            <div class="col-md-7">
                                                                <input type="text" class="form-control input-sm" id="unitclass" readonly="true" style="color: black !important;"/>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="form-group">
                                                            <label class="col-md-5 control-label">Unit Area</label>
                                                            <div class="col-md-7">
                                                                <input type="text" class="form-control input-sm" id="unitarea" readonly="true" style="color: black !important;"/>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="form-group">
                                                            <label class="col-md-5 control-label">Price per area</label>
                                                            <div class="col-md-7">
                                                                <input type="text" class="form-control input-sm" id="priceperarea" style="text-align: right; color: black !important;" readonly="true"/>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="form-group">
                                                            <label class="col-md-5 control-label">Unit Price</label>
                                                            <div class="col-md-7">
                                                                <input type="text" class="form-control input-sm" id="unitprice" style="text-align: right; color: black !important;" readonly="true"/>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <label style="font-weight: 900; color: #303030;">Unit Cost Details</label>
                                                    <div class="row">
                                                        <div class="form-group">
                                                            <label class='col-md-6'>No. of Day(s)</label>
                                                            <div class="col-md-6">
                                                                <input type="text" style="width: 40%; text-align: center; color: black !important;" class="form-control input-sm" id="nodays" readonly="true"/>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="form-group">
                                                            <label class='col-md-6'>No. of Month(s)</label>
                                                            <div class="col-md-6">
                                                                <input type="text" style="width: 40%; text-align: center; color: black !important;" class="form-control input-sm" id="nomonths" readonly="true"/>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="form-group">
                                                            <label class='col-md-6'>Cost per Month</label>
                                                            <div class="col-md-6">
                                                                <input type="text" style="text-align: right; color: black !important" class="form-control input-sm" id="costpermonth" readonly="true"/>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <hr style="border-bottom: 2px solid #CCC;">
                                                    <div class="row" style="margin-top: -4px !important;">
                                                        <div class="form-group">
                                                            <label class='col-md-6' style="font-weight: 900; color: #303030;">Total Cost</label>
                                                            <div class="col-md-6">
                                                                <label type="text" style="text-align: right; border: 2px solid #CCC; font-weight: 700; font-size: 13px; color: black !important;" class="form-control input-sm" id="unitcost"><label/>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <div id="contperson" class="tab-pane fade">
                                    <div class="row">
                                        <div class="col-md-12"><button class="btn btn-xs btn-primary evict" onclick="$('#modalcontactperson').modal('show'); $('#modalcontactperson').find('input').val('');"><i class="fa fa-plus"></i> Add Contact </button>
                                            </label>
                                            <div class="row">
                                                <br>
                                                <div id="tblcontactinfo" style="padding: 5px;">

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div id="documents" class="tab-pane fade">
                                    <div class="row">
                                        <form name="posting_comments" id="posting_comments" >
                                        <div class="col-md-6">
                                            <div class="row">
                                                <div class="form-group">
                                                    <label class="col-md-4" style="color: black !important;">Doc. Name</label>
                                                    <div class="col-md-8">
                                                        <input type="text" class="form-control input-sm" id="docname" name="docname" style="color: black !important;"/>
                                                        <input type="hidden" class="form-control input-sm" id="appidreq" name="appidreq" />
                                                        <input type="hidden" class="form-control input-sm" id="inqidreq" name="inqidreq" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group">
                                                    <label class="col-md-4"style="color: black !important;">Description</label>
                                                    <div class="col-md-8">
                                                        <input type="text" class="form-control input-sm" id="description" name="description"style="color: black !important;"/>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="row">
                                                <label class="col-md-4 control-label" style="color: black !important;">Select Document</label>
                                                <div class="col-md-8">
                                                    <input id="file_uploads" name="file_uploads" class="form-control" type="file" style="color: black !important;"/>
                                                </div>
                                            </div>
                                        </form>
                                            <div class="row" >
                                                <div class="col-md-12">
                                                    <div class="btn btn-xs btn-primary evict" style="width: 100%;" onclick="savereq();"><span class="fa fa-plus"></span> ADD</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-10 pull-right">
                                            <div class="parent">
                                                <table id="simple-table" class="table table-striped table-bordered table-hover fixTable">
                                                    <thead>
                                                        <tr>
                                                            <td width="31%">Document Name</td>
                                                            <td width="31%">Description</td>
                                                            <td width="30%">Attached Document</td>
                                                            <td width="7%"></td>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="tblrequirements">

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div id="accdetails" class="tab-pane fade">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="clearfix pull-left">
													<label class="text-primary" style="font-weight: 900; color: #303030;">SUMMARY</label>
                                            </div>
                                            <div class="clearfix pull-right">
													<button class="btn btn-primary btn-sm evict" onclick="printsoa();"><span class="fa fa-printer"></span> Print</button>
                                            </div>
                                            <br><br>
                                            <div id="soatable" class="parent">
                                                <table id="soatbl" class="table table-striped table-bordered table-hover fixTable">
                                                    <thead>
                                                        <tr>
                                                            <td width="14%">Date</td>
                                                            <td width="15%">Tenant ID</td>
                                                            <td width="24%">Description</td>
                                                            <td width="13%">Total Charges</td>
                                                            <td width="10%">Penalty</td>
                                                            <td width="10%">Payment</td>
                                                            <td width="10%">Balance</td>
                                                            <td width="6%"></td>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="tblaccountdetails">

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>

                                        <div class="modal fade" role="dialog" id="modalviewtransall">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title" id='transtitle' >All Transactions</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="clearfix pull-right">
                    													<button class="btn btn-primary btn-sm evict" onclick="printallsoa();"><span class="fa fa-printer"></span> Print</button>
                                                                </div>
                                                                <br><br>
                                                                <div id="allsoatable" class="parent">
                                                                    <table id="allsoatbl" class="table table-striped table-bordered table-hover fixTable">
                                                                        <thead>
                                                                            <tr>
                                                                                <td width="17%">Date</td>
                                                                                <td width="15%">Tenant ID</td>
                                                                                <td width="22%">Description</td>
                                                                                <td width="15%" align="right">Total Charges</td>
                                                                                <td width="12%" align="right">Penalty</td>
                                                                                <td width="12%" align="right">Payment</td>
                                                                                <td width="12%" align="right">Balance</td>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody id="tblviewtransall">

                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button class="btn btn-sm btn-danger" onclick="$('#modalviewtransall').modal('hide'); cancelpdctransaction();" style="border-radius: 3px;">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

									</div>
                                </div>

                                <div id="pdc" class="tab-pane fade">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div id="divpdc">
                                                <div class="clearfix">
                                                    <span style="font-weight: 900; color: #303030; font-size: 14px;">Check Status :</span>&nbsp;&nbsp;&nbsp;
                                                    <span style="font-size: 14px !important; color: black !important;"><span class='fa fa-circle' style='color: orange;'></span> Pending</span>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
                                                    <span style="font-size: 14px !important; color: black !important;"><span class='fa fa-circle' style='color: green;'></span> Cleared</span>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
                                                    <span style="font-size: 14px !important; color: black !important;"><span class='fa fa-circle' style='color: red;'></span> Insufficient Fund</span>
                                                </div>
                                                <br>
                                                <div class="parent">
                                                    <table id="pdctbl" class="table table-bordered fixTable">
                                                        <thead>
                                                            <tr>
                                                                <td style="background-color: #111109 !important;-webkit-print-color-adjust: exact;padding-left: 5px;"><h6 style="font-weight: bold;margin: 3px;font-size: 11px;color: #ffffff !important;" width="15%">Check Date</td>
                                                                <td style="background-color: #111109 !important;-webkit-print-color-adjust: exact;padding-left: 5px;"><h6 style="font-weight: bold;margin: 3px;font-size: 11px;color: #ffffff !important;" width="22%">Dep. Status</td>
                                                                <td style="background-color: #111109 !important;-webkit-print-color-adjust: exact;padding-left: 5px;"><h6 style="font-weight: bold;margin: 3px;font-size: 11px;color: #ffffff !important;" width="20%">Depository Date</td>
                                                                <td style="background-color: #111109 !important;-webkit-print-color-adjust: exact;padding-left: 5px;"><h6 style="font-weight: bold;margin: 3px;font-size: 11px;color: #ffffff !important;" width="17%">Check #</td>
                                                                <td style="background-color: #111109 !important;-webkit-print-color-adjust: exact;padding-left: 5px;"><h6 style="font-weight: bold;margin: 3px;font-size: 11px;color: #ffffff !important;" width="8%">Status</td>
                                                                <td style="background-color: #111109 !important;-webkit-print-color-adjust: exact;padding-left: 5px;"><h6 style="font-weight: bold;margin: 3px;font-size: 11px;color: #ffffff !important;" width="18%">Amount</td>
                                                            </tr>
                                                        </thead>
                                                        <tbody id="tblpdc">

                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <br><br>
                                        <div class="col-md-6 col-sm-6">
                                        <div style="border: 3px solid #e3e3e3; padding-left: 10px !important;">
                                            <br><br>
    										<div class="row">
                                                <div class="col-md-6 ">
                                                    <div class="row">
                                                        <div class="form-group">
                                                            <label class="col-sm-4 control-label" style="font-size: 14px !important;">Account #</label>
                                                            <div class="col-sm-8">
                                                                <input type="text" class="form-control input-sm" id="acctnum" readonly="true" style="background-color: #FFF !important; border: none; border-bottom:1px solid #e3e3e3; text-align: center; color: black !important;">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="form-group">
                                                            <label class="col-sm-4 control-label" style="font-size: 14px !important;">Name</label>
                                                            <div class="col-sm-8">
                                                                <input type="text" class="form-control input-sm" id="acctname" readonly="true" style="background-color: #FFF !important; border: none; border-bottom:1px solid #e3e3e3; text-align: center; color: black !important;">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="col-sm-5 control-label" style="font-size: 14px !important;">Check #</label>
                                                        <div class="col-sm-7">
                                                            <input type="text" class="form-control input-sm" id="acccheckno" style="background-color: #FFF !important; border: none; border-bottom:1px solid #e3e3e3; text-align: center; font-weight: bold; color: red;" readonly="true">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-sm-5 control-label" style="font-size: 14px !important;">PDC Date</label>
                                                        <div class="col-sm-7">
                                                            <input type="text" class="form-control input-sm" id="accpdcdate" readonly="true" style="background-color: #FFF !important; border: none; border-bottom:1px solid #e3e3e3; text-align: center; color: black !important;">
                                                        </div>
                                                    </div>
                                                </div>
    										</div>
                                            <br>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <span style="font-size: 14px !important;">Pay to the order of <input type="text" id="accpayto" value="Glorietta 5" style="width: 50%; border: none; border-bottom:1px solid #e3e3e3; background-color: #FFF !important; font-size: 14px !important; color: black !important;" readonly="true"/> ₱ <input type="text" id="accamount" style="background-color: #FFF !important; text-align: right; border: none; border-bottom:1px solid #e3e3e3; width: 25%; font-size: 14px !important; color: black !important;" readonly="true" /><br><br><label id="amntwrd" style="border-bottom:1px solid #e3e3e3; text-transform: capitalize; color: red; font-weight: bold;"></label></span>
                                                    <br><br>
                                                    <label id="banko" style="text-transform: uppercase; color: red; font-weight: bold; font-size: 36px !important;"></label>
                                                </div>
                                            </div>
                                        </div>
                                        <br><br>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="row">
                                                    <div class="form-group">
                                                        <label class="col-sm-5 control-label">Bank Name</label>
                                                        <div class="col-sm-7">
                                                            <label class="form-control input-sm" id="accbank"  style="color: black !important; font-size: 14px;">
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="form-group">
                                                        <label class="col-sm-5 control-label">Received By</label>
                                                        <div class="col-sm-7">
                                                            <input type="text" class="form-control input-sm" id="accreceiveby" style="color: black !important;">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="form-group">
                                                        <label class="col-sm-5 control-label">Depository</label>
                                                        <div class="col-sm-7">
                                                            <input type="text" class="form-control input-sm" id="accdepository" style="color: black !important;">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="row">
                                                    <div class="form-group">
                                                        <label class="col-sm-5 control-label">Dep. Status</label>
                                                        <div class="col-sm-7">
                                                            <input type="text" class="form-control input-sm" id="accstat" readonly="true" style="color: black !important;">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="form-group">
                                                        <label class="col-sm-5 control-label">Check Status</label>
                                                        <div class="col-sm-7">
                                                            <select class="form-control input-sm" id="acccheckstat" style="color: black !important; font-size: 14px;">
                                                                <optgroup label="Check Status">
                                                                    <option value="Cleared">Cleared</option>
                                                                    <option value="Close Account">Close Account</option>
                                                                    <option value="Check Replace">Check Replace</option>
                                                                    <option value="Pending" disabled>Pending</option>
                                                                    <option value="Insufficient Fund" disabled>Insufficient Fund</option>
                                                                </optgroup>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="form-group">
                                                        <label class="col-sm-5 control-label">Depository Date</label>
                                                        <div class="col-sm-7">
                                                            <div class="input-group date" data-provide="datepicker">
                                                                <div class="input-group-addon">
                                                                    <span class="fa fa-calendar bigger-110"></span>
                                                                </div>
                                                                <input type="text" class="form-control input-sm" value="<?php echo date('m/d/Y'); ?>"  id="accdatedep" style="color: black !important;">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
										<br>
										<div class="row">
											<div class="col-sm-12">
												<div class="btn=group pull-right">
													<button id="btnsavepdc" class="btn btn-success btn-sm evict" onclick="savepdctransaction();"><span class="fa fa-check-square-o"></span> Post</button>
                                                    <button class="btn btn-primary btn-sm evict" onclick="printpdc();"><span class="fa fa-print"></span> Print</button>
                                                    <button class="btn btn-default btn-sm evict" onclick="cancelpdctransaction();"><span class="fa fa-remove"></span> Cancel</button>
												</div>
											</div>
										</div>
									</div>
                                    </div>
                                </div>

                                <div id="pdc2" class="tab-pane fade">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div id="divpdc2">
                                            <table style="width: 100%;" cellspacing="0" cellpadding="0">
                                                <tbody id="template3"></tbody>
                                            </table>
                                                <div class="clearfix">
                                                    <span style="font-weight: 900; color: #303030; font-size: 14px;">Check Status :</span>&nbsp;&nbsp;&nbsp;
                                                    <span style="font-size: 14px !important; color: black !important;"><span class='fa fa-circle' style='color: orange;'></span> Pending</span>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
                                                    <span style="font-size: 14px !important; color: black !important;"><span class='fa fa-circle' style='color: green;'></span> Cleared</span>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
                                                    <span style="font-size: 14px !important; color: black !important;"><span class='fa fa-circle' style='color: red;'></span> Insufficient Fund</span>
                                                </div>
                                                <br>
                                                <div class="parent">
                                                    <table id="pdctbl" class="table table-bordered fixTable">
                                                        <thead>
                                                            <tr>
                                                                <td style="background-color: #111109 !important;-webkit-print-color-adjust: exact;padding-left: 5px;"><h6 style="font-weight: bold;margin: 3px;font-size: 11px;color: #ffffff !important;" width="15%">Check Date</td>
                                                                <td style="background-color: #111109 !important;-webkit-print-color-adjust: exact;padding-left: 5px;"><h6 style="font-weight: bold;margin: 3px;font-size: 11px;color: #ffffff !important;" width="22%">Dep. Status</td>
                                                                <td style="background-color: #111109 !important;-webkit-print-color-adjust: exact;padding-left: 5px;"><h6 style="font-weight: bold;margin: 3px;font-size: 11px;color: #ffffff !important;" width="20%">Depository Date</td>
                                                                <td style="background-color: #111109 !important;-webkit-print-color-adjust: exact;padding-left: 5px;"><h6 style="font-weight: bold;margin: 3px;font-size: 11px;color: #ffffff !important;" width="17%">Check #</td>
                                                                <td style="background-color: #111109 !important;-webkit-print-color-adjust: exact;padding-left: 5px;"><h6 style="font-weight: bold;margin: 3px;font-size: 11px;color: #ffffff !important;" width="8%">Status</td>
                                                                <td style="background-color: #111109 !important;-webkit-print-color-adjust: exact;padding-left: 5px;"><h6 style="font-weight: bold;margin: 3px;font-size: 11px;color: #ffffff !important;" width="18%">Amount</td>
                                                            </tr>
                                                        </thead>
                                                        <tbody id="tblpdc2"></tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div id="maintenance" class="tab-pane fade">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="row form-group">
                                                <div id="tenantER"></div>
                                            </div>
                                            <div class="row form-group">
                                                <div id="tenantWR"></div>
                                            </div>
                                            <div class="row form-group">
                                                <div id="tenantPC"></div>
                                            </div>
                                            <!-- <div class="clearfix">
                                                <span style="font-weight: 900; color: #303030; font-size: 14px;">Maintenance Status :</span>&nbsp;&nbsp;&nbsp;
                                                <span style="font-size: 14px !important; color: black !important;"><span class='fa fa-circle' style='color: orange;'></span> Resolved</span>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
                                                <span style="font-size: 14px !important; color: black !important;"><span class='fa fa-circle' style='color: green;'></span> Posted</span>
                                                <button class="btn btn-primary btn-sm evict pull-right" style="margin-bottom: 8px;" onclick="printmaintenance();"><span class="fa fa-printer"></span> Print</button>
                                            </div>
                                            <div class="parent">
                                                <table id="maintenancetbl" class="table table-striped table-bordered table-hover fixTable" >
                                                    <thead>
                                                        <tr>
                                                            <td width="20%">Scheduled</td>
                                                            <td width="15%">Task</td>
                                                            <td width="15%">Assigned</td>
                                                            <td width="5%">Status</td>
                                                            <td width="20%">Remarks</td>
                                                            <td width="20%">Start Time - End Time / Duration</td>
                                                            <td width="5%"></td>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="tblmaintenance">

                                                    </tbody>
                                                </table>
                                            </div> -->
                                        </div>

                                    </div>
                                </div>

                                <div id="printmaintenancediv" class="tab-pane fade">
                                    <table style="width: 100%;" cellspacing="0" cellpadding="0">
                                        <tbody id="template2"></tbody>
                                    </table>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="clearfix">
                                                <span style="font-weight: 900; color: #303030; font-size: 14px;">Maintenance Status :</span>&nbsp;&nbsp;&nbsp;
                                                <span style="font-size: 14px !important; color: black !important;"><span class='fa fa-circle' style='color: orange;'></span> Resolved</span>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
                                                <span style="font-size: 14px !important; color: black !important;"><span class='fa fa-circle' style='color: green;'></span> Posted</span>
                                            </div>
                                            <div class="parent" id="divprintmaintenance">
                                                <table id="maintenancetbl" class="table table-striped table-bordered table-hover fixTable" >
                                                    <thead>
                                                        <tr>
                                                            <td style="background-color: #111109 !important;-webkit-print-color-adjust: exact;padding-left: 5px;"><h6 style="font-weight: bold;margin: 3px;font-size: 11px;color: #ffffff !important;" width="20%">Scheduled</td>
                                                            <td style="background-color: #111109 !important;-webkit-print-color-adjust: exact;padding-left: 5px;"><h6 style="font-weight: bold;margin: 3px;font-size: 11px;color: #ffffff !important;" width="15%">Task</td>
                                                            <td style="background-color: #111109 !important;-webkit-print-color-adjust: exact;padding-left: 5px;"><h6 style="font-weight: bold;margin: 3px;font-size: 11px;color: #ffffff !important;" width="15%">Assigned</td>
                                                            <td style="background-color: #111109 !important;-webkit-print-color-adjust: exact;padding-left: 5px;"><h6 style="font-weight: bold;margin: 3px;font-size: 11px;color: #ffffff !important;" width="5%">Status</td>
                                                            <td style="background-color: #111109 !important;-webkit-print-color-adjust: exact;padding-left: 5px;"><h6 style="font-weight: bold;margin: 3px;font-size: 11px;color: #ffffff !important;" width="20%">Remarks</td>
                                                            <td style="background-color: #111109 !important;-webkit-print-color-adjust: exact;padding-left: 5px;"><h6 style="font-weight: bold;margin: 3px;font-size: 11px;color: #ffffff !important;" width="20%">Start Time - End Time / Duration</td>
                                                            <td style="background-color: #111109 !important;-webkit-print-color-adjust: exact;padding-left: 5px;"><h6 style="font-weight: bold;margin: 3px;font-size: 11px;color: #ffffff !important;" width="5%"></td>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="tblmaintenanceprint">

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <div id="contract" class="tab-pane fade">
                                    <div class="row form-group">
                                        <div class="col-md-12">
                                            <div class="parent">
                                                <table class="table table-bordered table-striped fixTable">
                                                    <thead>
                                                        <tr>
                                                            <td>Contract ID</td>
                                                            <td>Date From</td>
                                                            <td>Date To</td>
                                                            <td>Unit Name</td>
                                                            <td>Preview/Print</td>
                                                            <tbody id="tblcontract"></tbody>
                                                        </tr>
                                                    </thead>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="btn-group pull-left">
                    <label style="font-weight: bold;">Status:&nbsp;&nbsp; <span id="stathere"></span></label>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" role="dialog" id="modalviewtransall">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id='transtitle'>All Transactions</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="clearfix pull-right">
                                <button class="btn btn-primary btn-sm evict" onclick=""><span class="fa fa-printer"></span> Print</button>
                        </div>
                        <br><br>
                        <table id="simple-table" class="table  table-bordered table-hover" style="display: flex;flex-flow: column;height: 100%;width: 100%;margin-bottom: 0px !important;">
                            <thead style="flex: 0 0 auto;width: calc(100%);">
                                <tr style="display: table;table-layout: fixed;width: 100%;display: table;">
                                    <td width="17%">Date</td>
                                    <td width="15%">Tenant ID</td>
                                    <td width="22%">Description</td>
                                    <td width="15%" align="right">Total Charges</td>
                                    <td width="12%" align="right">Penalty</td>
                                    <td width="12%" align="right">Payment</td>
                                    <td width="12%" align="right">Balance</td>
                                </tr>
                            </thead>
                            <tbody id="tblviewtransall" style="flex: 1 1 auto;display: block;height: auto; overflow: hidden;">

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-sm btn-danger" onclick="$('#modalviewtransall').modal('hide'); cancelpdctransaction();" style="border-radius: 3px;">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" role="dialog" id="modalimg">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div id="taskimghere">
                            <span class="hovertext" title="">
                            <img id="taskimg" alt="Task Image" style="width: 100%; height: 550px;">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" role="dialog" id="modaldocu">
<button type="button" class="close" style="font-size: 40px;margin-right: 210px;" data-dismiss="modal">&times;</button>
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div id="docuimghere">
                            <a class="hoverdoc" title="Click the image to download." download>
                                <img id="docuimg" alt="Document Image" style="width: 100%; height: 550px !important;">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
