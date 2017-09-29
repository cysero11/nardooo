<div class="modal fade bd-example-modal-lg" id="modal_billsetup" area-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-lg">   
      <!-- Modal content-->
      <div class="modal-content">
      <div class="modal-header btn-primary">
        <button type="button" class="close" onclick="closesetupbill()">&times;</button>
        <h4 class="modal-title" style="font-family: Roboto;font-size: 18px;">Billing Setup</h4>
      </div>
        <div class="modal-body">
            <div class="row form-group">
              <div class="col-md-6">
                <div class="widget-box widget-color-green" id="tbdywidget_billing">
                  <div class="widget-header">
                    <h5 class="widget-title bigger lighter">SOA Signatories</h5>
                    <i id="pangedit1" class="pull-right glyphicon glyphicon-edit" onclick="call()" style="color: white;margin: 10px;"></i>
                  </div>

                  <div class="widget-body">
                    <div class="widget-main">
                      <div class="form-group row" style="margin-bottom: 0px;">
                        <div class="col-xs-12">
                          <p style="font-size: 13px;margin: 0px;font-weight: normal;">Prepared by</p>
                        </div>
                      </div>
                      <div class="form-group row">
                        <div class="col-xs-4" style="padding-right: 0px;">
                          <input type="text" name="" class="form-control input-sm" placeholder="Last Name" id="txtpreparedby_lname">
                        </div>
                        <div class="col-xs-4" style="padding-right: 0px;">
                          <input type="text" name="" class="form-control input-sm" placeholder="First Name" id="txtpreparedby_fname">
                        </div>
                        <div class="col-xs-4">
                          <input type="text" name="" class="form-control input-sm" placeholder="Middle Name" id="txtpreparedby_mname">
                        </div>
                      </div>
                      <div class="form-group row" style="margin-bottom: 0px;">
                        <div class="col-xs-12">
                          <p style="font-size: 13px;margin: 0px;font-weight: normal;">Checked by</p>
                        </div>
                      </div>
                      <div class="form-group row">
                        <div class="col-xs-4" style="padding-right: 0px;">
                          <input type="text" name="" class="form-control input-sm" placeholder="Last Name" id="txtchkedby_lname">
                        </div>
                        <div class="col-xs-4" style="padding-right: 0px;">
                          <input type="text" name="" class="form-control input-sm" placeholder="First Name" id="txtchkedby_fname">
                        </div>
                        <div class="col-xs-4">
                          <input type="text" name="" class="form-control input-sm" placeholder="Middle Name" id="txtchkedby_mname">
                        </div>
                      </div>
                      <div class="form-group row" style="margin-bottom: 0px;">
                        <div class="col-xs-12">
                          <p style="font-size: 13px;margin: 0px;font-weight: normal;">Approved by</p>
                        </div>
                      </div>
                      <div class="form-group row">
                        <div class="col-xs-4" style="padding-right: 0px;">
                          <input type="text" name="" class="form-control input-sm" placeholder="Last Name" id="txtapprovedby_lname">
                        </div>
                        <div class="col-xs-4" style="padding-right: 0px;">
                          <input type="text" name="" class="form-control input-sm" placeholder="First Name" id="txtapprovedby_fname">
                        </div>
                        <div class="col-xs-4">
                          <input type="text" name="" class="form-control input-sm" placeholder="Middle Name" id="txtapprovedby_mname">
                        </div>
                      </div>
                      <div class="form-group row" style="margin-bottom: 0px;">
                        <div class="col-xs-12">
                          <p style="font-size: 13px;margin: 0px;font-weight: normal;">Received by</p>
                        </div>
                      </div>
                      <div class="form-group row">
                        <div class="col-xs-4" style="padding-right: 0px;">
                          <input type="text" name="" class="form-control input-sm" placeholder="Last Name" id="txtreceivedby_lname">
                        </div>
                        <div class="col-xs-4" style="padding-right: 0px;">
                          <input type="text" name="" class="form-control input-sm" placeholder="First Name" id="txtreceivedby_fname">
                        </div>
                        <div class="col-xs-4">
                          <input type="text" name="" class="form-control input-sm" placeholder="Middle Name" id="txtreceivedby_mname">
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="widget-toolbox padding-8 clearfix">
                    <button class="btn btn-xs btn-success pull-right" onclick="savesoasign()">
                      <i class="ace-icon fa fa-check icon-on-right"></i>
                      <span class="bigger-110">&nbsp;Save</span>            
                    </button>
                  </div>
                </div>
              </div> 
              <div class="col-md-6">
                <div class="widget-box widget-color-green" id="tbdywidget_vatpen">
                  <div class="widget-header">
                    <h5 class="widget-title bigger lighter">Penalty and VAT </h5>
                    <i id="pangedit2" class="pull-right glyphicon glyphicon-edit" onclick="call2()" style="color: white;margin: 10px;"></i>
                  </div>

                  <div class="widget-body">
                    <div class="widget-main">
                      <fieldset style="margin: 8px;border: 1px dotted #CCC;padding: 8px;margin-top: 0px;">
                        <legend style="border: none;margin-bottom: 0px;font-size: 15px; font-weight: normal;width:95px;">&nbsp;&nbsp;Vat Setup&nbsp;&nbsp;</legend>      
                          <div class="form-group row" style="margin-bottom: 5px;">
                            <div class="col-md-6"><label style="margin-top: 10px;">Is rent bill vatable?</label></div>
                            <div class="col-md-3">
                              <div class="radio">
                                <label>
                                  <input name="rent_vatable" type="radio" class="ace widget_vatpen" id="" value="yes">
                                  <span class="lbl">&nbsp;&nbsp;&nbsp;YES</span>
                                </label>
                              </div>
                            </div>
                            <div class="col-md-3">
                              <div class="radio">
                                <label>
                                  <input name="rent_vatable" type="radio" class="ace widget_vatpen" id="" value="no">
                                  <span class="lbl">&nbsp;&nbsp;&nbsp;NO</span>
                                </label>
                              </div>                          
                            </div>
                          </div>
                          <div class="form-group row" style="margin-bottom: 5px;">
                            <div class="col-md-5"><label>Rent Vat type</label></div>
                            <div class="col-md-6">
                              <select class="form-control widget_vatpen" id="slct_rentvattype">
                                <option value="inc" selected>Incusive Vat</option>
                                <option value="exc">Excusive Vat</option>
                              </select>
                            </div>
                            <div class="col-md-1">
                            </div>
                          </div>
                          <div class="form-group row" style="margin-bottom: 5px;">
                            <div class="col-md-5"><label>Rent Vat Percent</label></div>
                            <div class="col-md-2">
                              <input type="text" class="form-control input-sm numonly widget_vatpen" name="" id="txtrentvatperc">
                            </div>
                            <div class="col-md-5">
                            </div>
                          </div>                                            
                      </fieldset>
                      <fieldset style="margin: 8px;border: 1px dotted #CCC;padding: 8px;margin-top: 0px;">
                        <legend style="border: none;margin-bottom: 0px;font-size: 15px; font-weight: normal;l;width:120px;">&nbsp;&nbsp;Penalty Setup&nbsp;&nbsp;</legend>      
                          <div class="form-group row" style="margin-bottom: 5px;">
                            <div class="col-md-6"><label style="margin-top: 10px;">Is penalty vatable?</label></div>
                            <div class="col-md-3">
                              <div class="radio">
                                <label>
                                  <input name="penalty_vatable" type="radio" class="ace vattrigger widget_vatpen" id="triggeredyes" value="yes" onclick="disablevattrap()">
                                  <span class="lbl">&nbsp;&nbsp;&nbsp;YES</span>
                                </label>
                              </div>
                            </div>
                            <div class="col-md-3">
                              <div class="radio">
                                <label>
                                  <input name="penalty_vatable" type="radio" class="ace vattrigger widget_vatpen" id="triggeredno" value="no" onclick="enablevattrap()">
                                  <span class="lbl">&nbsp;&nbsp;&nbsp;NO</span>
                                </label>
                              </div>                          
                            </div>
                          </div>
                          <div class="form-group row" style="margin-bottom: 5px;">
                            <div class="col-md-5"><label>Penalty Vat type</label></div>
                            <div class="col-md-6">
                              <select class="form-control" id="slct_penaltypevattype">
                                <option value="inc" selected>Incusive Vat</option>
                                <option value="exc">Excusive Vat</option>
                              </select>
                            </div>
                            <div class="col-md-1">
                            </div>
                          </div>
                          <div class="form-group row" style="margin-bottom: 5px;">
                            <div class="col-md-5"><label>Penalty Vat Percent</label></div>
                            <div class="col-md-2">
                              <input type="text" class="form-control input-sm numonly" name="" id="txtpenaltyvatperc">
                            </div>
                            <div class="col-md-5">
                            </div>
                          </div>  
                          <div class="form-group row" style="margin-bottom: 5px;">
                            <div class="col-md-4"><label style="margin-top: 10px;">Penalty Type</label></div>
                            <div class="col-md-4">
                              <div class="radio">
                                <label>
                                  <input name="penalty_type" type="radio" class="ace widget_vatpen" id="" value="amount">
                                  <span class="lbl">&nbsp;&nbsp;&nbsp;Amount</span>
                                </label>
                              </div> 
                            </div>
                            <div class="col-md-4">
                              <div class="radio">
                                <label>
                                  <input name="penalty_type" type="radio" class="ace widget_vatpen" id="" value="percent">
                                  <span class="lbl">&nbsp;&nbsp;&nbsp;Percent</span>
                                </label>
                              </div>
                            </div>
                          </div> 
                          <div class="form-group row" style="margin-bottom: 5px;">
                            <div class="col-md-5"><label style="margin-top: 10px;">Penalty Amount</label></div>
                            <div class="col-md-6">
                               <input type="text" class="form-control input-sm numonly amount widget_vatpen" name="" style="text-align: right" id="txtpenalty_amt" placeholder="0.00">
                            </div>
                            <div class="col-md-1">
                            </div>
                          </div>
                          <div class="form-group row" style="margin-bottom: 5px;">
                            <div class="col-md-5"><label style="margin-top: 10px;">Penalty Percent</label></div>
                            <div class="col-md-2">
                               <input type="text" class="form-control input-sm numonly widget_vatpen" name="" id="txtpenalty_perc">
                            </div>
                            <div class="col-md-5">
                            </div>
                          </div>                                            
                      </fieldset>
                      <fieldset style="margin: 8px;border: 1px dotted #CCC;padding: 8px;margin-top: 0px;">
                        <legend style="border: none;margin-bottom: 0px;font-size: 15px; font-weight: normal;l;width:120px;">&nbsp;&nbsp;Deposit Setup&nbsp;&nbsp;</legend>
                          <div class="form-group row" style="margin-bottom: 5px;">
                            <div class="col-md-5"><label style="margin-top: 10px;">Deposit Percent</label></div>
                            <div class="col-md-2">
                               <input type="text" class="form-control input-sm numonly widget_vatpen" name="" id="txtdeposit_perc">
                            </div>
                            <div class="col-md-5">
                            </div>
                          </div>                                            
                      </fieldset>                    
                    </div>
                  </div>

                  <div class="widget-toolbox padding-8 clearfix">
                    <button class="btn btn-xs btn-success pull-right widget_vatpen" onclick="save_vat_penalty_setup()">
                      <i class="ace-icon fa fa-check icon-on-right"></i>
                      <span class="bigger-110">&nbsp;Save</span>            
                    </button>
                  </div>
                </div>
              </div>

              <div class="col-md-6" style="margin-top: -280px;">
                <div class="widget-box widget-color-green" id="tbdywidget_assdues">
                  <div class="widget-header">
                    <h5 class="widget-title bigger lighter">Association Due</h5>
                    <i id="pangedit4" class="pull-right glyphicon glyphicon-edit" onclick="call4()" style="color: white;margin: 10px;"></i>
                  </div>

                  <div class="widget-body">
                    <div class="widget-main">
                      <div class="form-group row" style="margin-bottom: 0px;">
                        <div class="col-xs-2">
                          <p style="font-size: 13px;margin: 0px;font-weight: normal;">Amount</p>
                        </div>
                        <div class="col-xs-10">
                          <input type="text" name="" class="form-control input-sm numonly" placeholder="Amount" id="txtassduesamount">
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="widget-toolbox padding-8 clearfix">
                    <button class="btn btn-xs btn-success pull-right" onclick="saveassdues()">
                      <i class="ace-icon fa fa-check icon-on-right"></i>
                      <span class="bigger-110">&nbsp;Save</span>            
                    </button>
                  </div>
                </div>
              </div>

            </div>
        </div>
      </div>
      
    </div>
</div> 

<div class="modal fade bd-example-modal-sm" id="modal_maintenancesetup" area-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-sm">   
      <!-- Modal content-->
      <div class="modal-content">
      <div class="modal-header btn-primary">
        <button type="button" class="close" onclick="closesetupbill2()">&times;</button>
        <h4 class="modal-title" style="font-family: Roboto;font-size: 18px;">Maintenance Setup</h4>
      </div>
        <div class="modal-body">
            <div class="row form-group">
              <div class="col-md-12">
                <div class="widget-box widget-color-green" id="tbdywidget_maintenance">
                  <div class="widget-header">
                    <h5 class="widget-title bigger lighter">Maintenance Cost</h5>
                    <i id="pangedit3" class="pull-right glyphicon glyphicon-edit" onclick="call3()" style="color: white;margin: 10px;"></i>
                  </div>

                  <div class="widget-body">
                    <div class="widget-main">
                      <div class="form-group row">
                        <div class="col-xs-5">
                          Electric / Kwh
                        </div>
                        <div class="col-xs-7">
                          <input type="text" class="form-control numonly amount" id="txtmainenance_elec" name="" style="text-align: right;" placeholder="0.00">
                        </div>
                      </div>
                      <div class="form-group row">
                        <div class="col-xs-5">
                          Water / Cubicmeter
                        </div>
                        <div class="col-xs-7">
                          <input type="text" class="form-control numonly amount" id="txtmainenance_water" name="" style="text-align: right;" placeholder="0.00">
                        </div>
                      </div>
                      <div class="form-group row">
                        <div class="col-xs-5">
                          Pest Control
                        </div>
                        <div class="col-xs-7">
                          <input type="text" class="form-control numonly amount" id="txtmainenance_pestcon" name="" style="text-align: right;" placeholder="0.00">
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="widget-toolbox padding-8 clearfix">
                    <button class="btn btn-xs btn-success pull-right" onclick="savemaintenance()">
                      <i class="ace-icon fa fa-check icon-on-right"></i>
                      <span class="bigger-110">&nbsp;Save</span>            
                    </button>
                  </div>
                </div>
              </div>              
            </div>
        </div>
      </div>
      
    </div>
</div> 
  <script>
  $(function(){
    numonly()
    $("#tbdywidget_billing :input").prop("disabled", true);
    $("#tbdywidget_vatpen :input").prop("disabled", true);
    $("#tbdywidget_maintenance :input").prop("disabled", true);
    $("#tbdywidget_assdues :input").prop("disabled", true);
  })

  function enablevattrap(){
    $("#slct_penaltypevattype").prop("disabled", true);
    $("#txtpenaltyvatperc").prop("disabled", true);
  }

  function disablevattrap(){
    $("#slct_penaltypevattype").prop("disabled", false);
    $("#txtpenaltyvatperc").prop("disabled", false);
  }

  var callOne = true;
  var callTwo = true;
  var callThree = true;
  var callFour = true;

  function one() {
    $("#tbdywidget_billing :input").prop("disabled", false);
    $("#pangedit1").css("color", "red");
    $("#pangedit1").removeClass("glyphicon-edit");
    $("#pangedit1").addClass("glyphicon-remove");
  }

  function two() {
    $("#tbdywidget_billing :input").prop("disabled", true);
    $("#pangedit1").css("color", "white");
    $("#pangedit1").addClass("glyphicon-edit");
    $("#pangedit1").removeClass("glyphicon-remove");
  }

  function one2() {
    $(".widget_vatpen").prop("disabled", false);
    $("#pangedit2").css("color", "red");
    $("#pangedit2").removeClass("glyphicon-edit");
    $("#pangedit2").addClass("glyphicon-remove");
  }

  function two2() {
    $("#tbdywidget_vatpen :input").prop("disabled", true);
    $("#pangedit2").css("color", "white");
    $("#pangedit2").addClass("glyphicon-edit");
    $("#pangedit2").removeClass("glyphicon-remove");
  }

 function one3() {
    $("#tbdywidget_maintenance :input").prop("disabled", false);
    $("#pangedit3").css("color", "red");
    $("#pangedit3").removeClass("glyphicon-edit");
    $("#pangedit3").addClass("glyphicon-remove");
  }

  function two3() {
    $("#tbdywidget_maintenance :input").prop("disabled", true);
    $("#pangedit3").css("color", "white");
    $("#pangedit3").addClass("glyphicon-edit");
    $("#pangedit3").removeClass("glyphicon-remove");
  }

  function one4() {
    $("#tbdywidget_assdues :input").prop("disabled", false);
    $("#pangedit4").css("color", "red");
    $("#pangedit4").removeClass("glyphicon-edit");
    $("#pangedit4").addClass("glyphicon-remove");
  }

  function two4() {
    $("#tbdywidget_assdues :input").prop("disabled", true);
    $("#pangedit4").css("color", "white");
    $("#pangedit4").addClass("glyphicon-edit");
    $("#pangedit4").removeClass("glyphicon-remove");
  }

  function call(){
     if(callOne) one();
    else two();
    callOne = !callOne;
  }

  function call2(){
     if(callTwo) one2();
    else two2();
    callTwo = !callTwo;
  }

  function call3(){
     if(callThree) one3();
    else two3();
    callThree = !callThree;
  }

  function call4(){
     if(callFour) one4();
    else two4();
    callFour = !callFour;
  }

  function modal_billsetup() 
  {
    var mallid = $("#txtmall_id").val();
    $.ajax({
      type: 'POST',
      url: 'mainclass.php',
      data: 'mallid='+mallid+'&form=load_billsetup',
      success: function(data)
      {
        var arr = data.split("#");
        var preparedby = arr[0].split("|");
        var chkedby = arr[1].split("|");
        var approvedby = arr[2].split("|");
        var receivedby = arr[3].split("|");
        $("#txtpreparedby_lname").val(preparedby[0]);
        $("#txtpreparedby_fname").val(preparedby[1]);
        $("#txtpreparedby_mname").val(preparedby[2]);
        $("#txtchkedby_lname").val(chkedby[0]);
        $("#txtchkedby_fname").val(chkedby[1]);
        $("#txtchkedby_mname").val(chkedby[2]);
        $("#txtapprovedby_lname").val(approvedby[0]);
        $("#txtapprovedby_fname").val(approvedby[1]);
        $("#txtapprovedby_mname").val(approvedby[2]);
        $("#txtreceivedby_lname").val(receivedby[0]);
        $("#txtreceivedby_fname").val(receivedby[1]);
        $("#txtreceivedby_mname").val(receivedby[2]);
        $("input[name='rent_vatable'][value='"+arr[5]+"']").prop("checked", true);
        $("#slct_rentvattype").val(arr[6]);
        $("#txtrentvatperc").val(arr[7]);
        $("input[name='penalty_vatable'][value='"+arr[8]+"']").prop("checked", true);
        $("#slct_penaltypevattype").val(arr[9]);
        $("#txtpenaltyvatperc").val(arr[10]);
        $("input[name='penalty_type'][value='"+arr[11]+"']").prop("checked", true);
        $("#txtpenalty_amt").val(arr[12]);
        $("#txtpenalty_perc").val(arr[13]);
        $("#txtassduesamount").val(arr[17]);
        $("#txtdeposit_perc").val(arr[18]);
        $("#modal_billsetup").modal("show");
        if(arr[8] == "yes"){
          $("#triggeredyes").click();
        }else{
          $("#triggeredno").click();
        }
      }
    })
  }

  function modal_maintenancesetup()
  {
    var mallid = $("#txtmall_id").val();
    $.ajax({
      type: 'POST',
      url: 'mainclass.php',
      data: 'mallid='+mallid+'&form=load_billsetup',
      success: function(data)
      {
        var arr = data.split("#");
        $("#txtmainenance_elec").val(arr[14]);
        $("#txtmainenance_water").val(arr[15]);
        $("#txtmainenance_pestcon").val(arr[16]);
        $("#modal_maintenancesetup").modal("show");        
      }
    })    
  }

  function closesetupbill()
  {
    $("#modal_billsetup").modal("hide");
  }

  function closesetupbill2()
  {
    $("#modal_maintenancesetup").modal("hide");
  }  

  function enable_edit1()
  {
    $("#tbdywidget_billing :input").prop("disabled", false);
  }

  function savesoasign()
  {
    var preparedby_lname = $("#txtpreparedby_lname").val();
    var preparedby_fname = $("#txtpreparedby_fname").val();
    var preparedby_mname = $("#txtpreparedby_mname").val();
    var chkedby_lname = $("#txtchkedby_lname").val();
    var chkedby_fname = $("#txtchkedby_fname").val();
    var chkedby_mname = $("#txtchkedby_mname").val();
    var approvedby_lname = $("#txtapprovedby_lname").val();
    var approvedby_fname = $("#txtapprovedby_fname").val();
    var approvedby_mname = $("#txtapprovedby_mname").val();
    var receivedby_lname = $("#txtreceivedby_lname").val();
    var receivedby_fname = $("#txtreceivedby_fname").val();
    var receivedby_mname = $("#txtreceivedby_mname").val();
    var mallid = $("#txtmall_id").val();
    $.ajax({
      type: 'POST',
      url: 'mainclass.php',
      data: 'prep='+preparedby_lname+'|'+preparedby_fname+'|'+preparedby_mname+
            '&chkd='+chkedby_lname+'|'+chkedby_fname+'|'+chkedby_mname+
            '&appr='+approvedby_lname+'|'+approvedby_fname+'|'+approvedby_mname+
            '&rcvd='+receivedby_lname+'|'+receivedby_fname+'|'+receivedby_mname+
            '&mallid='+mallid+
            '&form=savesoasign',
      success: function(data)
      {
        if(data == "2" || data == "1")
        {
          showmodal("alert", "You have successfully saved changes on the setup.", "success()", null, "", null, "0");
        }
      }
    })
  }

  function save_vat_penalty_setup()
  {
    var rent_vatable = $("input[name='rent_vatable']").val();
    var rent_vattype = $("#slct_rentvattype").val();
    var rent_vatperc = $("#txtrentvatperc").val();
    var penalty_vatable = $("input[name='penalty_vatable']").val();
    var penalty_vattype = $("#slct_penaltypevattype").val();
    var penalty_vatperc = $("#txtpenaltyvatperc").val();
    var penalty_type = $("input[name='penalty_type']").val();
    var penalty_amt = $("#txtpenalty_amt").val();
    var penalty_perc = $("#txtpenalty_perc").val();
    var mallid = $("#txtmall_id").val();
    var deposit_perc = $("#txtdeposit_perc").val();
    $.ajax({
      type: 'POST',
      url: 'mainclass.php',
      data: 'rent_vatable='+rent_vatable+
            '&rent_vattype='+rent_vattype+
            '&rent_vatperc='+rent_vatperc+
            '&penalty_vatable='+penalty_vatable+
            '&penalty_vattype='+penalty_vattype+
            '&penalty_vatperc='+penalty_vatperc+
            '&penalty_type='+penalty_type+
            '&penalty_amt='+penalty_amt+
            '&penalty_perc='+penalty_perc+
            '&mallid='+mallid+
            '&deposit_perc='+deposit_perc+
            '&form=save_vat_penalty_setup',
      success: function(data)
      {
        if(data == "2" || data == "1")
        {
          showmodal("alert", "You have successfully saved changes on the setup.", "success2()", null, "", null, "0");
        }
      }
    })
  }

  function savemaintenance()
  {
    var elec = $("#txtmainenance_elec").val();
    var water = $("#txtmainenance_water").val();
    var pestcon = $("#txtmainenance_pestcon").val();
    var mallid = $("#txtmall_id").val();    
    $.ajax({
      type: 'POST',
      url: 'mainclass.php',
      data: 'elec='+elec+
            '&water='+water+
            '&pestcon='+pestcon+
            '&mallid='+mallid+
            '&form=savemaintenance_setup',
      success: function(data)
      {
        if(data == "2" || data == "1")
        {
          showmodal("alert", "You have successfully saved changes on the setup.", "success3()", null, "", null, "0");
        }        
      }
    })
  }

  function success()
  {
    two();
    $('#alertmodal').modal('hide');
  }

  function success2()
  {
    two2();
    $('#alertmodal').modal('hide');
  }

  function success3()
  {
    two3();
    $('#alertmodal').modal('hide');
  }  

  function success4()
  {
    two4();
    $('#alertmodal').modal('hide');
  }  

  function numonly()
  {
     $(".numonly").keydown(function(event) {

         // Allow only backspace and delete
         if ( event.keyCode == 46 || event.keyCode == 8 || event.keyCode == 190 || event.keyCode == 9) {
             // let it happen, don't do anything
         }
         else {
             // Ensure that it is a number and stop the keypress
             if (event.keyCode < 48 || event.keyCode > 57 ) {
                 event.preventDefault(); 
             }   
         }
     });

     $(".amount").change(function(){
          var v = parseFloat($(this).val());
          $(this).val((isNaN(v)) ? '' : v.toFixed(2).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,"));
     });
  }

  function saveassdues(){
    var mallid = $("#txtmall_id").val();
    var assdues = $("#txtassduesamount").val();
    $.ajax({
      type: 'POST',
      url: 'mainclass.php',
      data: 'assdues=' + assdues + '&mallid=' + mallid + '&form=saveassdues',
      success:function(data){
        if(data == "1"){
          showmodal("alert", "You have successfully saved changes on the setup.", "success3()", null, "", null, "0");
        }
      }
    })
  }
  </script>