<?php
include("connect.php");
?>
  <div class="row">
    <div class="col-md-12 col-xs-12" style="margin-bottom: 10px;margin-top: 5px;margin-left: 10px;">
      <div class="col-md-6 col-xs-12">

      </div>
      <div class="col-md-6 col-xs-6">
        <label class="control-label col-md-2">Date Range</label>
        <div class="col-md-4">
            <div class="input-group">
                <input type="text" class="form-control date-picker" id="dateFrom6" value="<?php echo date('m/d/Y'); ?>">
                <label class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></label>
            </div>
        </div>
        <div class="col-md-4">
            <div class="input-group">
                <input type="text" class="form-control date-picker" id="dateTo6" value="<?php echo date('m/d/Y'); ?>">
                <label class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></label>
            </div>
        </div>
          <button class="btn btn-sm btn-primary" onclick="showappreport();"><i class="glyphicon glyphicon-search"></i>Go</button>
          <button class="glyphicon glyphicon-print btn btn-sm btn-primary" style="margin-bottom: 2px;" onclick="print_app_report()"></button>
      </div>
    </div>
  <div class="row form-group" style="margin-bottom: 0px !important;margin-left: 1px;margin-right: 1px;">
    <div class="col-xs-12">
        <div class="parent">
            <table class="table table-bordered table-striped fixTable">
                <thead>
                    <tr>
                      <td width='10%'>Application ID</td>
                      <td width='15%'>Application Date</td>
                      <td width='20%'>Company Name</td>
                      <td width='15%'>Trade Name</td>
                      <td width='10%'>Status</td>
                      <td width='8%'>Start Date</td>
                      <td width='8%'>End Date</td>
                      <td width='14%'>Remarks</td>
                    </tr>
                </thead>
                <tbody id="applicationList" ></tbody>
            </table>
        </div>
      <table class="tabledash_footer table" style="margin: 0px !important;">
        <thead>
            <tr>
                <th id="th_tabledash_footer" width="" colspan="7" style="width: 911px;">
                    <div class="row">
                        <div class="col-md-6">
                            <label style="color: #FFF; float: center; margin-left: 10px; margin-top: 10px;" id="txtapp_reportentries"></label>
                        </div>                               
                        <div class="col-md-6">
                            <input type="hidden" id="txt_userpage" class="form-control input-sm" style="width: 5%; text-align: center;">
                            <ul id="ulpaginationapp_report" class="pagination pull-right"></ul>
                        </div>
                    </div>
                </th>
            </tr>
        </thead>
      </table>
    </div>
  </div>
</div>


<div id="app_report_container" style="margin-top: 10px; display: none;">
  <center>
    <div class="checklist" id="div_form_app_report" style="margin-top: 20px; width: 99%;margin-bottom: 0;">
      <center>
        <table cellspacing="0" style="padding: 5px; width: 95%">
          <tr><td colspan="2" align="center"><div style="width: 100%; text-align: left;">
            <table style="width: 100%;" cellspacing="0" cellpadding="0">
              <tbody id="template"></tbody>
            </table>
          </div></td></tr>
          <tr><td colspan="2"><center><p style="font-size: 16px; font-weight: bold; margin-top: 25px;">Application List</p></center></td></tr>
          <tr><td colspan="2"><center><p style="font-size:; 12px; margin-top: 5px;">From:&nbsp;&nbsp;<label id="dateFrom312412"></label>&nbsp;&nbsp;To&nbsp;&nbsp;<label id="dateTo312412"></label></p></center></td></tr>
          <tr>
            <td colspan="2">
              <center>
                <table style='width:100%;' border="1" cellpadding="0" cellspacing="0">
                  <thead style="border: 1px solid black !important;">
                      <tr>
                        <td style="background-color: #111109 !important;-webkit-print-color-adjust: exact;padding-left: 5px;text-align: center;"><h6 style="font-weight: bold;margin: 3px;font-size: 11px;color: #ffffff !important;">APPLICATION ID</h6></td>
                        <td style="background-color: #111109 !important;-webkit-print-color-adjust: exact;padding-left: 5px;text-align: center;"><h6 style="font-weight: bold;margin: 3px;font-size: 11px;color: #ffffff !important;">APPLICATION DATE</h6></td>
                        <td style="background-color: #111109 !important;-webkit-print-color-adjust: exact;padding-left: 5px;"><h6 style="font-weight: bold;margin: 3px;font-size: 11px;color: #ffffff !important;">COMPANY NAME</h6></td>
                        <td style="background-color: #111109 !important;-webkit-print-color-adjust: exact;padding-left: 5px;"><h6 style="font-weight: bold;margin: 3px;font-size: 11px;color: #ffffff !important;">TRADE NAME</h6></td>
                        <td style="background-color: #111109 !important;-webkit-print-color-adjust: exact;padding-left: 5px;"><h6 style="font-weight: bold;margin: 3px;font-size: 11px;color: #ffffff !important;">STATUS</h6></td>
                        <td style="background-color: #111109 !important;-webkit-print-color-adjust: exact;padding-left: 5px;"><h6 style="font-weight: bold;margin: 3px;font-size: 11px;color: #ffffff !important;">START DATE</h6></td>
                        <td style="background-color: #111109 !important;-webkit-print-color-adjust: exact;padding-left: 5px;"><h6 style="font-weight: bold;margin: 3px;font-size: 11px;color: #ffffff !important;">END &nbsp;&nbsp DATE</h6></td>
                        <td style="background-color: #111109 !important;-webkit-print-color-adjust: exact;padding-left: 5px;"><h6 style="font-weight: bold;margin: 3px;font-size: 11px;color: #ffffff !important;">REMARKS</h6></td>
                      </tr>
                  </thead>
                  <tbody id="appreportlist1" style="border: 1px solid black !important;"></tbody>
                </table>
              </center>
            </td>
          </tr>
        </table>
      </center>
    </div>
  </center>
</div>

<script type="text/javascript">
  $(function(){
    showappreport();
    loadentriesappr_report();
    $("#txt_userpage").val("1");
  })  

  function showappreport(){
    var dateFrom = $("#dateFrom6").val();
    var dateTo = $("#dateTo6").val();
    var page = $("#txt_userpage").val();
    $.ajax({
      type: 'POST',
      url: 'reports/app_report/class.php',
      data: 'dateFrom=' + dateFrom + '&dateTo=' + dateTo + '&page=' + page + '&form=showappreport',
      beforeSend : function() {
          $('#indexloadingscreen').addClass('myspinner');
      },
      success: function(data){
          $('#indexloadingscreen').removeClass('myspinner');
        $("#applicationList").html(data);
        loadentriesappr_report();
        loadpageapp_report();
      }
    })
  }

  function loadentriesappr_report(){
        var page = $("#txt_userpage").val();
        var dateFrom = $("#dateFrom6").val();
        var dateTo = $("#dateTo6").val();

        $.ajax({
            type: 'POST',
            url: 'reports/app_report/class.php',
            data: 'page=' + page + '&dateFrom=' + dateFrom + '&dateTo=' + dateTo + '&form=loadentriesappr_report',
            success: function(data){
                if(data == ""){
                    $("#txtapp_reportentries").text("");
                }
                else{
                    $("#txtapp_reportentries").text(data);
                }
            }
        });
    }

function loadpageapp_report(){
        var page = $("#txt_userpage").val();
        var dateFrom = $("#dateFrom6").val();
        var dateTo = $("#dateTo6").val();

        $.ajax({
            type: 'POST',
            url: 'reports/app_report/class.php',
            data: 'dateFrom=' + dateFrom +  '&dateTo=' + dateTo + '&page=' + page + '&form=loadpageapp_report',
            success: function(data){
                $("#ulpaginationapp_report").html(data);
            }
        });
    }

    function pagination54(page, pagenums){
        $(".pgnumpapp_report").removeClass("active");
        var value = "#" + pagenums;
        $("#pgapp_report" + pagenums).addClass("active");
        $("#txt_userpage").val(page);
        showappreport();
        loadpageapp_report();
        loadentriesappr_report();
    }

    function print_app_report(){
    var dateFrom = $("#dateFrom6").val();
    var dateTo = $("#dateTo6").val();
    $.ajax({
        type: 'POST',
        url: 'reports/app_report/class.php',
        data: 'dateFrom=' + dateFrom + '&dateTo=' + dateTo + '&form=print_app_report',
        success:function(data){
            $("#appreportlist1").html(data);
            $("#dateFrom312412").text(dateFrom);
            $("#dateTo312412").text(dateTo);

            var toprint = $("#div_form_app_report").html();
            var myheight = $(window).height()-40;
            var mywidth = $(window).width()-40;
            var popupWin = window.open("", "_blank", "height=" + myheight + ",width=" + mywidth + ",location=no,scrollbars=1,left=" + 20);
            popupWin.document.open();
            popupWin.document.write("<html><head><title></title><link href='assets/css/style2.css' rel='stylesheet' type='text/css'></head><body onload='window.print();'><div class='checklist'>" + toprint + "</div></body></html>");
            popupWin.document.close();
            }
        })
    }
</script>