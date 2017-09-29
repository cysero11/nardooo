<style>
.parent {
    height: 50vh;
}
</style>
<!-- ============ MODAL Terms & Condition with Checkbox ============= -->
<div class="modal fade" id="modal_tncdirect" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">

      <!-- Modal header-->
      <div class="modal-header" style="background-color: #438EB9;">
        <button type="button" class="close" data-dismiss="modal" onclick="unloadmodal_tncdirect()">&times;</button>
        <h4 class="modal-title" style="color:white; font-weight: bold;">Terms and Conditions</h4>
        <input type="hidden" class="tncmodal" id="tncmodal" name="">
      </div>

       <!-- Modal body-->
<div class="container-fluid">
      <div class="row form-group">
        <div class="col-md-3 col-xs-12 col-lg-3" style="padding-top: 5px;">
                  <b >Filter by Group Name:</b>
        </div>
        <div class="col-md-4 col-xs-12 col-lg-4" style="padding-top: 5px;">
            <select id="selectfilterdisplaydirect"  onchange="displaytncdirect();" class="form-control required">
                <option value="">Display all</option>
            </select>
        </div>
      </div>
<div class="row">
  <div class="col-xs-12">
    <div class="row form-group" style="margin-bottom: 0px !important;">
      <div class="col-xs-12">
        <div class="parent">
        <table id="simple-table" class="table  table-bordered table-hover fixTable">
                    <thead>
                        <tr>
                            <td width="3%">&nbsp;</td>
                            <td width="15%">Group Name</td>
                            <td width="20%">Term Name</td>
                            <td width="35%">Condition</td>
                            <td width="10%">Status</td>
                        </tr>
                    </thead>
              <tbody id="displaytncdirect"></tbody>
          </table>
          </div>
        <table class="tabledash_footer table" style="margin: 0px !important;">
            <thead>
                <tr>
                    <th id="th_tabledash_footer" width="" colspan="7" style="width: 911px;">
                    <font style="float: left; color: #777 !important;margin-top: 17px;margin-left: 15px;font-weight: normal;font-weight: 8px !important;" id="txttnc"></font>
                        <div class="pagination">
                            <ul id=""></ul>
                        </div>
                    </th>
                </tr>
            </thead>
        </table>
      </div>
    </div>
  </div>
</div>
</div>

       <!-- Modal footer-->
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" onclick="chckconterm();"><i class="ace-icon fa fa-check"></i>&nbsp;DONE</button>
      </div>
    </div>

  </div>
</div>
<input type="hidden" id="checkto">
<script type="text/javascript">
  $(function(){
    displaytncdirect();
    selectfilterdisplay();
  });

  function modal_tncdirect(){
    // selectfilterdisplay();
    $("#modal_tncdirect").modal("show");
  }

  function unloadmodal_tncdirect(){
    $("#modal_tncdirect").modal("hide");
  }

  function selectfilterdisplay(){
    $.ajax({
        type: 'POST',
        url: 'tenants/tenantmainclass.php',
        data: 'form=selectfilterdisplaydirect',
        success: function(data){
            $("#selectfilterdisplaydirect").html(data);
            clickablenatable();
        }
    })
  }

  function displaytncdirect(){
    var selectfilterdisplaydirect = $("#selectfilterdisplaydirect").val();

    $.ajax({
      type: 'POST',
      url: 'tenants/tenantmainclass.php',
      data:'selectfilterdisplaydirect='+selectfilterdisplaydirect+
      '&form=displaytncdirect',
      success: function(data){
        $("#displaytncdirect").html(data);
            clickablenatable();
            // checkSelected();
            chckconterm();
      }
    });
  }

  function chckconterm(){
      $("#displayselected").empty();
      var lahatnglaman = "";
     $(".checkbox").each(function(){
            var trlaman = this.value;
            if($(this).is(":checked")){
                grpname = $("#"+trlaman).find('td:nth-child(2)').text();
                trmname = $("#"+trlaman).find('td:nth-child(3)').text();
                condition = $("#"+trlaman).find('td:nth-child(4)').text();
                $("#displayselected").append("<tr><td>"+grpname+"</td><td>"+trmname+"</td><td>"+condition+"</td></tr>");
                $("#modal_tncdirect").modal("hide");
            }
     });
  }

  // function selectfilterdirect(id) {
  //   $.ajax({
  //       type: 'POST',
  //       url: 'tenants/tenantmainclass.php',
  //       data: 'id=' + id + '&form=selectfilterdirect',
  //       success: function(data) {
  //           $("#displaytncdirect").html(data);
  //           clickablenatable();
  //           checkSelected2();
  //         }
  //     })
  // }
  //
  function clickablenatable() {
    $("#displaytncdirect tr").each(function(){
      $(this).click(function(){
        eto = $(this).find(".checkbox");
        if ( eto.is(":checked") ) {
          var ids = $("#checkto").val();
          eto.prop("checked", false);
          $("#checkto").val(ids.replace($(this).find(".checkbox").val() + "|", ""));
        }
        else {
          var ids = $("#checkto").val();
          eto.prop("checked", true);
          ids += $(this).find(".checkbox").val() + "|";
          $("#checkto").val(ids);
        }
      })
    })
  }
  //
  // function addselecteddirect(){
  //   var checkto = $("#checkto").val();
  //     $.ajax({
  //       type: 'POST',
  //       url: 'tenants/tenantmainclass.php',
  //       data: 'checkto=' + checkto + '&form=lamanngtabledirect',
  //       success: function(data){
  //         $("#displayselected2").html(data);
  //       }
  //     })
  // }
  //
  // function checkSelected() {
  //   var allselected = $("#checkto").val();
  //   var arr = allselected.split("|");
  //
  //   for ( var a = 0; a <= arr.length; a++ ) {
  //     $("." + arr[a]).prop("checked", true);
  //   }
  // }
  //
  // function checkSelected2() {
  //   var allselected = $("#checkto").val();
  //   var arr = allselected.split("|");
  //
  //   for ( var a = 0; a <= arr.length; a++ ) {
  //     $("." + arr[a]).prop("checked", true);
  //   }
  // }

</script>
