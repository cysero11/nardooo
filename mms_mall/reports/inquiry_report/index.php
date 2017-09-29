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
                <input type="text" class="form-control date-picker" id="dateFrom7" value="<?php echo date('m/d/Y'); ?>">
                <label class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></label>
            </div>
        </div>
        <div class="col-md-4">
            <div class="input-group">
                <input type="text" class="form-control date-picker" id="dateTo7" value="<?php echo date('m/d/Y'); ?>">
                <label class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></label>
            </div>
        </div>
          <button class="btn btn-sm btn-primary" onclick="showinquiryreport();"><i class="glyphicon glyphicon-search"></i>Go</button>
          <button class="glyphicon glyphicon-print btn btn-sm btn-primary" style="margin-bottom: 2px;" onclick="print_inq_report()"></button>
      </div>
    </div>
  <div class="row form-group" style="margin-bottom: 0px !important;margin-left: 1px;margin-right: 1px;">
    <div class="col-xs-12">
        <div class="parent">
            <table class="table table-bordered table-striped fixTable">
                <thead>
                    <tr>
                      <td width='10%'>Inquiry ID</td>
                      <td width='10%'>Date Inquired</td>
                      <td width='10%'>Company Name</td>
                      <td width='10%'>Trade Name</td>
                      <td width='10%'>Unit Type</td>
                      <td width='10%'>Start Date</td>
                      <td width='10%'>End Date</td>
                      <td width='10%'>Remarks</td>
                    </tr>
                </thead>
                <tbody id="inquirylist" ></tbody>
            </table>
        </div>
      <table class="tabledash_footer table" style="margin: 0px !important;">
        <thead>
            <tr>
                <th id="th_tabledash_footer" width="" colspan="7" style="width: 911px;">
                    <div class="row">
                        <div class="col-md-6">
                            <label style="color: #FFF; float: center; margin-left: 10px; margin-top: 10px;" id="txtinq_reportentries"></label>
                        </div>                               
                        <div class="col-md-6">
                            <input type="hidden" id="txt_userpage2" class="form-control input-sm" style="width: 5%; text-align: center;">
                            <ul id="ulpaginationinq_report" class="pagination pull-right"></ul>
                        </div>
                    </div>
                </th>
            </tr>
        </thead>
      </table>
    </div>
  </div>
</div>


<div id="inquiry_report_container" style="margin-top: 10px; display: none;">
  <center>
    <div class="checklist" id="div_form_inq_report" style="margin-top: 20px; width: 99%;margin-bottom: 0;">
      <center>
        <table cellspacing="0" style="padding: 5px; width: 95%">
          <tr><td colspan="2" align="center"><div style="width: 100%; text-align: left;">
            <table style="width: 100%;" cellspacing="0" cellpadding="0">
              <tbody id="template2"></tbody>
            </table>
          </div></td></tr>
          <tr><td colspan="2"><center><p style="font-size: 16px; font-weight: bold; margin-top: 25px;">Inquiry List</p></center></td></tr>
          <tr><td colspan="2"><center><p style="font-size:; 12px; margin-top: 5px;">From:&nbsp;&nbsp;<label id="dateFrom3a"></label>&nbsp;&nbsp;To&nbsp;&nbsp;<label id="dateTo3a"></label></p></center></td></tr>
          <tr>
            <td colspan="2">
              <center>
                <table style='width:100%;' border="1" cellpadding="0" cellspacing="0">
                  <thead style="border: 1px solid black !important;">
                      <tr>
                        <td style="background-color: #111109 !important;-webkit-print-color-adjust: exact;padding-left: 5px;text-align: center;"><h6 style="font-weight: bold;margin: 3px;font-size: 11px;color: #ffffff !important;">Inquiry ID</h6></td>
                        <td style="background-color: #111109 !important;-webkit-print-color-adjust: exact;padding-left: 5px;text-align: center;"><h6 style="font-weight: bold;margin: 3px;font-size: 11px;color: #ffffff !important;">Date Inquired</h6></td>
                        <td style="background-color: #111109 !important;-webkit-print-color-adjust: exact;padding-left: 5px;text-align: center;"><h6 style="font-weight: bold;margin: 3px;font-size: 11px;color: #ffffff !important;">Company Name</h6></td>
                        <td style="background-color: #111109 !important;-webkit-print-color-adjust: exact;padding-left: 5px;text-align: center;"><h6 style="font-weight: bold;margin: 3px;font-size: 11px;color: #ffffff !important;">Trade Name</h6></td>
                        <td style="background-color: #111109 !important;-webkit-print-color-adjust: exact;padding-left: 5px;text-align: center;"><h6 style="font-weight: bold;margin: 3px;font-size: 11px;color: #ffffff !important;">Unit Type</h6></td>
                        <td style="background-color: #111109 !important;-webkit-print-color-adjust: exact;padding-left: 5px;text-align: center;"><h6 style="font-weight: bold;margin: 3px;font-size: 11px;color: #ffffff !important;">Start Date</h6></td>
                        <td style="background-color: #111109 !important;-webkit-print-color-adjust: exact;padding-left: 5px;text-align: center;"><h6 style="font-weight: bold;margin: 3px;font-size: 11px;color: #ffffff !important;">End Date</h6></td>
                        <td style="background-color: #111109 !important;-webkit-print-color-adjust: exact;padding-left: 5px;text-align: center;"><h6 style="font-weight: bold;margin: 3px;font-size: 11px;color: #ffffff !important;">Remarks</h6></td>
                      </tr>
                  </thead>
                  <tbody id="inquirylist2" style="border: 1px solid black !important;"></tbody>
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
    showinquiryreport();
    loadentries2();
    $("#txt_userpage2").val("1");
  })

  function showinquiryreport(){
    var dateFrom = $("#dateFrom7").val();
    var dateTo = $("#dateTo7").val();
    var page = $("#txt_userpage2").val();
    $.ajax({
      type: 'POST',
      url: 'reports/inquiry_report/class.php',
      data: 'dateFrom=' + dateFrom + '&dateTo=' + dateTo + '&page=' + page + '&form=showinquiryreport',
      beforeSend : function() {
        $('#indexloadingscreen').addClass('myspinner');
      },
      success: function(data){
        $('#indexloadingscreen').removeClass('myspinner');
        $("#inquirylist").html(data);
        loadentries2();
        loadpageinq_report();
      }
    })
  }

  function loadentries2(){
        var page = $("#txt_userpage").val();
        var dateFrom = $("#dateFrom7").val();
        var dateTo = $("#dateTo7").val();

        $.ajax({
            type: 'POST',
            url: 'reports/inquiry_report/class.php',
            data: 'page=' + page + '&dateFrom=' + dateFrom + '&dateTo=' + dateTo + '&form=loadentries2',
            success: function(data){
                if(data == ""){
                    $("#txtinq_reportentries").text("");
                }
                else{
                    $("#txtinq_reportentries").text(data);
                }
            }
        });
    }

function loadpageinq_report(){
        var page = $("#txt_userpage").val();
        var dateFrom = $("#dateFrom7").val();
        var dateTo = $("#dateTo7").val();

        $.ajax({
            type: 'POST',
            url: 'reports/inquiry_report/class.php',
            data: 'dateFrom=' + dateFrom +  '&dateTo=' + dateTo + '&page=' + page + '&form=loadpageinq_report',
            success: function(data){
                $("#ulpaginationinq_report").html(data);
            }
        });
    }

    function pagination55(page, pagenums){
        $(".pgnumpinq_report").removeClass("active");
        var value = "#" + pagenums;
        $("#pginq_report" + pagenums).addClass("active");
        $("#txt_userpage").val(page);
        showappreport();
        loadpageinq_report();
        loadentries2();
    }

    function print_inq_report(){
    var dateFrom = $("#dateFrom7").val();
    var dateTo = $("#dateTo7").val();
    $.ajax({
        type: 'POST',
        url: 'reports/inquiry_report/class.php',
        data: 'dateFrom=' + dateFrom + '&dateTo=' + dateTo + '&form=print_inq_report',
        success:function(data){
            $("#inquirylist2").html(data);
            $("#dateFrom7a").text(dateFrom);
            $("#dateTo7a").text(dateTo);

            var toprint = $("#div_form_inq_report").html();
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