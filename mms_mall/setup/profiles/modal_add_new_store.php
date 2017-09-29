<!-- ============ MODAL INQUIRY ============= -->
<div class="modal fade" id="modal_newtradename" role="dialog" area-hidden="true" data-keyboard="false" data-backdrop="static">
  <div class="modal-dialog modal-lg">
  
    <!-- Modal content-->
    <div class="modal-content">

       <!-- Modal header-->
      <div class="modal-header" style="background-color: #438EB9;">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" style="color:white; font-weight: bold;">Store Profile</h4>
      </div>

       <!-- Modal body-->
      <div class="modal-body">
          <div class="row form-group">
            <div class="col-md-3">
              <div class="row form-group">
                <div class="col-md-12 col-xs-12">
                    <div class="image">
                        <img class="img-thumbnail imageName form-control" src="assets/images/avatars/noimage.png" id="imgtradeaccount" style="border: 2px solid #bdc3c7; margin-bottom: 8px;height: 160px;">
                    </div>
                    <form name="posting_profilepic_trade" id="posting_profilepic_trade" >
                      <div style="display: none;"><input type="text" id="trade_hidden_companyID2" name="companyID">
                      <input type="text" id="trade_hidden_tradeID" name="tradeID"></div>
                        <input id="file_upload_trade" name="attachment_profilepic" class="form-control upload" type="file" onchange="showimgtrade();" />
                    </form>
                </div>
              </div>
            </div>
            <div class="col-md-9">
              <div class="row form-group">
                <div class="col-md-4 col-xs-12">Store Name</div>
                <div class="col-md-8 col-xs-12"><input type="text" class="form-control text_new_trade" name="" id="txttrade_tradename" placeholder="Enter Store Name"></div>
              </div>
              <div class="row form-group">
                <div class="col-md-4 col-xs-12">Company Name</div>
                <div class="col-md-8 col-xs-12">
                    <input id="txttrade_companyname" class="form-control text_new_trade" type="text" placeholder="Company Name" disabled="" style="background-color: white !important;"/>
                </div>
              </div>
              <div class="row form-group">
                <div class="col-md-4 col-xs-12">Industry</div>
                <div class="col-md-8 col-xs-12"><input type="text" class="form-control text_new_trade" style="background-color: white !important;" name="" id="txttrade_tradeindustry" placeholder="Industry" disabled="true"></div>
              </div> 
              <div class="row form-group">
                <div class="col-md-4 col-xs-12">Business Address<br /><h6 style="font-size:10px; font-style: italic;">(other than address in commercial center)</h6></div>
                <div class="col-md-8 col-xs-12"><textarea class="form-control text_new_trade" name="" style="height: 70px;background-color: white !important;" id="txttrade_busadd" placeholder="Business Address" disabled="true"></textarea></div>
              </div>   
            </div>
          </div>
      </div>

       <!-- Modal footer-->
      <div class="modal-footer">
        <button type="button" id="btn_new_store" class="btn btn-primary" onclick="savetradename()"><i class="ace-icon fa fa-check"></i>&nbsp;Save</button>
      </div>
    </div>
    
  </div>
</div>

<script>
function addnewtradename()
{
  if($("#txtcompany_name").val() == "")
  {
    showmodal("alert", "Select company first.", "", null, "", null, "1");
  }
  else
  {
    $("#modal_newtradename").modal("show");
    $("#txttrade_tradename").val("");
    $(".text_new_trade").css("border-color","#D5D5D5");
    $("#trade_hidden_companyID2").val("");
    $("#trade_hidden_tradeID").val("");
    $("#imgtradeaccount").attr("src", "assets/images/avatars/noimage.png");
    $("#file_upload_trade").val("");
    $("#posting_profilepic_trade").html('<div style="display: none;"><input type="text" id="trade_hidden_companyID2" name="companyID"><input type="text" id="trade_hidden_tradeID" name="tradeID"></div><input id="file_upload_trade" name="attachment_profilepic" class="form-control upload upload_app_req" type="file" onchange="showimgtrade();" />');
    uploadcss();    
  }

}

function savetradename()
{
    var e = 0;
  $(".text_new_trade").each(function(){
    if($(this).val() == "")
    {
      e++;
      $(this).css("border-color","#f2a696");
    }
    else
      {
        $(this).css("border-color","#D5D5D5");
      }
  });

  if(e == 0)
  { 
    var tradename = $("#txttrade_tradename").val();
    var companyname = $("#txttrade_companyname").val();
    var companyid = $("#txttrade_companyname").attr("value");
    $.ajax({
      type: 'POST',
      url: 'mainclass.php',
      data: 'tradename=' + tradename +
            '&companyname=' + companyname +
            '&companyid=' + companyid +
            '&form=savetradename',
      success: function(data)
      {
        var arr = data.split("|");
        // alert(data)
        sendprofilepic_trade(arr[1], arr[2])
        if(arr[0] == "1")
        {
          alert("Successfully added!");
          $("#modal_newtradename").modal("hide");
          $(".text_new_trade").css("border-color","#D5D5D5");
          loadtenantlist(companyid);
        }
      }
    });
  }
  else
  {
    alert("Fill all required fields!");
    $('.text_new_trade').each(function() {
    if ( this.value === '' ) {
        this.focus();
        return false;
    }
    });
  }
}

function editstore(storeID, img, storename, comID)
{
  $("#imgtradeaccount").attr("src", img);
  $("#txttrade_tradename").val(storename);
  $("#modal_newtradename").modal("show");
  $("#file_upload_trade").val("");
  $("#posting_profilepic_trade").html('<div style="display: none;"><input type="text" id="trade_hidden_companyID2" name="companyID"><input type="text" id="trade_hidden_tradeID" name="tradeID"></div><input id="file_upload_trade" name="attachment_profilepic" class="form-control upload upload_app_req" type="file" onchange="showimgtrade();" />');
    uploadcss();
  $("#btn_new_store").attr("onclick", "savetradename_update(\""+storeID+"\", \""+comID+"\")")
}

function savetradename_update(storeid, comid) {
    var e = 0;
  $(".text_new_trade").each(function(){
    if($(this).val() == "")
    {
      e++;
      $(this).css("border-color","#f2a696");
    }
    else
      {
        $(this).css("border-color","#D5D5D5");
      }
  });

  if(e == 0)
  { 
      var tradename = $("#txttrade_tradename").val();
      var companyid = $("#txttrade_companyname").attr("value");
      $.ajax({
        type: 'POST',
        url: 'mainclass.php',
        data: 'tradename=' + tradename +
              '&companyid=' + companyid +
              '&id=' + storeid +
              '&form=savetradename_update',
              success: function(data)
              {
                alert("Successfully Updated!");
                var arr = data.split("|");
                sendprofilepic_trade(comid, storeid)
                $("#modal_newtradename").modal("hide");
                $(".text_new_trade").css("border-color","#D5D5D5");
              }
      })
      }
      else
      {
        alert("Fill all required fields!");
        $('.text_new_trade').each(function() {
        if ( this.value === '' ) {
            this.focus();
            return false;
        }
        });
      }
}

// appearing of attached (logo) image
  function showimgtrade(){
    var oFReader = new FileReader();
    oFReader.readAsDataURL(document.getElementById("file_upload_trade").files[0]);
        
    oFReader.onload = function (oFREvent) {
        document.getElementById("imgtradeaccount").src = oFREvent.target.result;
    };
  }

    function sendprofilepic_trade(companyID, tradeID){
        $("#trade_hidden_companyID2").val(companyID);
        $("#trade_hidden_tradeID").val(tradeID);
        var data = new FormData($('#posting_profilepic_trade')[0]);
        $.ajax({
          type:"POST",
          url:"inquiry/upload_app_trade.php",
          data: data,
          mimeType: "multipart/form-data",
          contentType: false,
          cache: false,
          processData: false,
          success:function(data){
            loadtenantlist(companyID);
          }
        });
    }
</script>