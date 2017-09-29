<!-- ============ MODAL INQUIRY ============= -->
<div class="modal fade" id="modal_addnewaddress" role="dialog" area-hidden="true" data-keyboard="false" data-backdrop="static">
  <div class="modal-dialog modal-lg">
    <div class="modal-content ">
      <div class="modal-body">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <div class="row form-group" style="margin-top: 20px">
              <div class="col-md-8 col-xs-12" style="padding-right:0px;">
                <table style="height: 100%;width: 100%;">
                  <tr>
                    <td>
                      <h6 style="font-size:10px; font-weight: bold;margin:2px;">Unit,Room number,Floor/Lot/Block/Phase, Village</h6>
                      <h6 style="font-size:10px; font-style: italic;margin:0px;">Ex. Blk 121 Lot 3 Phase II, Sta. Maria Village</h6>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <input list="list_address_list" type="text" class="form-control" name="" id="txtaddress_streetadd">
                      <datalist id="list_address_list">

                      </datalist>
                    </td>
                  </tr>
                </table>
              </div>
              <div class="col-md-4 col-xs-12">
                <table style="height: 100%;width: 100%;">
                  <tr>
                    <td>
                      <h6 style="font-size:10px; font-weight: bold;margin:2px;">City</h6>
                      <h6 style="font-size:10px; font-style: italic;margin:0px;">Ex. San Pedro City</h6>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <input list="list_city_list" id="txtadd_city" class="form-control text_inquiry" type="text" li="txtbuss" placeholder="Type your city to search..." onkeyup="loadcityref()" />
                      <datalist id="list_city_list">
                      </datalist>

                      <input type="hidden" id="addr">
                      <input type="hidden" id="addr2">
                    </td>
                  </tr>
                </table>
              </div>
          </div>
          <div class="row form-group" style="">
            <div class="col-md-2 col-xs-12" style="padding-right:0px;">

            </div>
            <div class="col-md-10 col-xs-12" style="">
                <button type="button" class="btn btn-primary" style="float: right;" id="okaddressbtn"><i class="ace-icon fa fa-check"></i>&nbsp;OK</button>
            </div>
          </div>
      </div>
    </div>
  </div>
</div>
<script>
$(function(){
    $("#okaddressbtn").keydown(function(e){
        var x = e.keyCode;
        if(x == 13)
        { $(this).click(); }
    });
})
  function loadaddressmodal(this_ids)
  {

    $("#txtaddress_streetadd").focus();
    $("#modal_addnewaddress").modal("show");
    $("#okaddressbtn").attr("onclick", "saveaddressmodalfunc(\""+this_ids+"\")");

    var addr = $("#addr").val();
    var addr2 = $("#addr2").val();

    $("#list_address_list").html("<option value="+addr+">"+addr+"</option>");
    $("#txtaddress_streetadd").dblclick();

    $('#txtadd_city').html("<option value="+addr2+">"+addr2+"</option>");
    $("#txtaddress_streetadd").dblclick();
  }




  function loadcityref()
  {
    var city = $("#txtadd_city").val();
    if(city != "")
    {
      $.ajax({
        type: 'POST',
        url: 'mainclass.php',
        data: 'city=' + city + '&form=loadcityref',
        success: function(data)
        {
          $("#list_city_list").html(data);
        }
      })
    }
  }

  function saveaddressmodalfunc(this_id)
  {
    var txtaddress_streetadd = $("#txtaddress_streetadd").val();
    var txtadd_city = $("#txtadd_city").val();

    $("#addr").val(txtaddress_streetadd);
    $("#addr2").val(txtadd_city);

    if(txtaddress_streetadd == "" || txtadd_city == "")
    {
      showmodal("alert", "Fill all required fields.", "", null, "", null, "1");
      $("#txtaddress_streetadd").css("border-color","#f2a696");
      $("#txtadd_city").css("border-color","#f2a696");
      $("#"+this_id+"_icon").removeClass("fa-map-marker");
      $("#"+this_id).css("padding-left", "0px");
    }
    else
    {
      $("#txtaddress_streetadd").css("border-color","#D5D5D5");
      $("#txtadd_city").css("border-color","#D5D5D5");
      $("#"+this_id+"_icon").removeClass("fa-map-marker");
      $("#"+this_id+"_icon").addClass("fa-map-marker");
      $("#"+this_id).css("padding-left", "15px");
      $("#modal_addnewaddress").modal("hide");
      var txtaddress_streetadd = $("#txtaddress_streetadd").val();
      var txtadd_city = $("#txtadd_city").val();
      $("#"+this_id).val(txtaddress_streetadd + " " + txtadd_city);
    //   $("#"+this_id).css("background-color", "white !important");
    //   $("#"+this_id).attr("onclick", "");
    //   $("#"+this_id).attr("onkeyup", "");
      $("#txtaddress_streetadd").val("");
      $("#txtadd_city").val("");
      $("#"+this_id).focus();
    }

    $('#modal_addnewaddress').on('hidden.bs.modal', function() {
      $('#'+this_id).focus();
    })
  }
</script>
