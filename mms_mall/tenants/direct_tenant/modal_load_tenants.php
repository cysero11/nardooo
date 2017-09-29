<!-- ============ MODAL INQUIRY ============= -->
 <style>
 tbody tr td { cursor: hand !important; cursor: pointer !important; }

/* Let's get this party started */
    ::-webkit-scrollbar {
        width: 10px;
    }

    /* Track */
    ::-webkit-scrollbar-track {
        -webkit-box-shadow: inset 0 0 6px #eee;
        -webkit-border-radius: 10px;
        border-radius: 10px;
    }

    /* Handle */
    ::-webkit-scrollbar-thumb {
        -webkit-border-radius: 10px;
        border-radius: 10px;
        background: gray;
        -webkit-box-shadow: inset 0 0 6px gray;
    }
    ::-webkit-scrollbar-thumb:window-inactive {
        background: rgba(255,0,0,0.4);
    }

.parent3 {
    height: 60vh;
}
        ul.pagination {
        display: inline-block;
        padding: 0;
        margin: 0;
    }

    ul.pagination li {
        cursor: pointer;
        display: inline;
        color: white;
        font-weight: 600;
        padding: 4px 8px;
        border: 1px solid #CCC;
    }

    .pagination li:first-child{
        border-top-left-radius: 4px;
        border-bottom-left-radius: 4px;
    }

    .pagination li:last-child{
        border-top-right-radius: 4px;
        border-bottom-right-radius: 4px;
    }

    ul.pagination li:hover{
        background-color: #FFFFFF;
        color: #3c8dbc;
    }

    .pagination .active{
        background-color: #FFFFFF;
        color: #3c8dbc;
    }
</style>
<div class="modal fade" id="modal_loadtradename" role="dialog" area-hidden="true" data-keyboard="false" data-backdrop="static">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">

       <!-- Modal header-->
      <div class="modal-header" style="background-color: #438EB9;">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" style="color:white; font-weight: bold;">Store List</h4>
      </div>

       <!-- Modal body-->
      <div class="modal-body" id="modal-body-inquiry">
          <div class="row form-group">
              <div class="col-md-8 col-xs-12">
                  <span class="input-icon" style="width: 100%;">
                    <input type="text" class="form-control" placeholder="Search ..." id="txtsearchtradename">
                    <i class="ace-icon fa fa-search nav-search-icon"></i>
                  </span>
              </div>
              <div class="col-md-4 col-xs-12">
                <a href="#" id="btnnew_store" class="btn btn-info btn-sm" style="width: 100% !important;" onclick="addnewtradename()">New Store</a>
              </div>
          </div>
          <div class="row form-group" style="margin-bottom: 0px !important;">
              <div class="col-xs-12">
                <div id="tradetable" class="parent3">
                  <table id="simple-table" class="table table-bordered table-striped fixTable">
                        <thead>
                          <tr>
                            <td><label style="margin-left: 25px;">Store Name</label></td>
                            <td>Company</td>
                            <td>Business Address</td>
                          </tr>
                        </thead>
                        <tbody id="tbltradenamelist"></tbody>
                    </table>
                </div>

              <table class="tabledash_footer table" style="margin: 0px !important;">
                <thead>
                  <tr>
                      <th id="th_tabledash_footer" width="" colspan="7" style="width: 911px;padding-top: 15px;padding-bottom: 15px;">
                        <font style="float: left; color: white !important;margin-left: 15px;font-weight: normal;font-weight: 8px !important;" id="txtentriesstorelist"><br /></font>
                          <input type="hidden" id="txt_userpage_tenants" name="">
                          <ul id="ulpaginationstorelist" class="pagination pull-right"></ul>
                      </th>
                  </tr>
                </thead>
              </table>
              </div>
          </div>
      </div>

       <!-- Modal footer-->
    </div>

  </div>
</div>

<script>

setTimeout(function(){
    $(".fixTable").tableHeadFixer();
    }, 500)
$(function(){
  $("#txtsearchtradename").focus(function(){
    $("#tbltradenamelist").tablenav("remove", "tbltradenamelist", "tbltradenamelist", $("#tradetable"));
  });

  $("#txtinq_tradename").click(function(){
    $("#tbltradenamelist").tablenav("add", "tbltradenamelist", "tbltradenamelist", $("#tradetable"));
  });

  $("#txtsearchtradename").keydown(function(e){
    var x = e.keyCode;
    if(x == 13)
    { $("#txt_userpage_tenants").val("1");loadtradenamelist(); }
    else if(x == 40)
    {
      $("#tbltradenamelist").focus();
      $("#tbltradenamelist").tablenav("add", "tbltradenamelist", "tbltradenamelist", $("#tradetable"));
    }
  });

  $("#btnnew_store").keydown(function(e){
    var x = e.keyCode;
    if(x == 13)
    { addnewtradename() }
  });
});

$(function(){
  $("#tradetable").click(function(){
    var obj = $(this);
    $("#tbltradenamelist").tablenav("tbltradenamelist", "tbltradenamelist", obj);
  });
});

// loading of trade list
function loadtradenamelist() {
  var page = $("#txt_userpage_tenants").val();
  var txtsearchtradename = $("#txtsearchtradename").val();
  $.ajax({
    type: 'POST',
    url: 'mainclass.php',
    data: 'txtsearchtradename=' + txtsearchtradename + '&page=' + page + '&form=loadtenantslist',
    success: function(data){
      $("#tbltradenamelist").html(data);
      loadpagestorelist();
      loadentriesstorelist();
    }
  })
}

function editstorename(storeid) {
  $(".text_new_trade").css("border-color","#D5D5D5");
  $("#posting_profilepic_trade").html('<div style="display: none;"><input type="text" id="trade_hidden_companyID2" name="companyID"><input type="text" id="trade_hidden_tradeID" name="tradeID"></div><input id="file_upload_trade" name="attachment_profilepic" class="form-control upload" type="file" onchange="showimgtrade();" />');
  $("#modal_newtradename").modal("show");
  $("#modal_store_title").text("Update");
  $("#btn_modal_new_store").attr("onclick", "savetradename_update(\""+storeid+"\")");
  $('#file_upload_trade').ace_file_input({
    no_file:'No File ...',
    btn_choose:'Choose',
    btn_change:'Change',
    droppable:false,
    onchange:null,
    thumbnail:false
  });
  $.ajax({
    type: 'POST',
    url: 'mainclass.php',
    data: 'id=' + storeid + '&form=load_editstorename',
    success: function(data) {
      var arr = data.split("|");
      $("#txttrade_tradename").val(arr[2]);
      $("#txttrade_companyname").val(arr[0]);
      $("#txttrade_companyname").attr("value", arr[1]);
      $("#txttrade_tradeindustry").val(arr[4]);
      $("#txttrade_busadd").val(arr[5]);
      $("#imgtradeaccount").attr("src", arr[3]);
    }
  })
}

// update function of store
function savetradename_update(storeid) {
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
                sendprofilepic_trade(arr[1], arr[2])
                $("#modal_newtradename").modal("hide");
                $(".text_new_trade").val("");
                $(".text_new_trade").attr("value", "");
                $(".text_new_trade").css("border-color","#D5D5D5");
                loadtradenamelist();
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

// load modal trade list
function modal_loadtradename()
{
  loadtradenamelist();
  $("#modal_loadtradename").modal("show");
  loadentriesstorelist();
}

// modal new tenant
function newtenant()
{
  $("#modal_loadtradename").modal("show");
}

// selecting of tenant
function selecttenant(companyID, tradeID)
{
  $.ajax({
    type: 'POST',
    url: 'mainclass.php',
    data: 'companyID=' + companyID + '&tradeID=' + tradeID +'&form=selecttenant',
    success: function(data)
    {
      var arr = data.split("|");
      $("#txtinq_companyname").attr("value",companyID);
      $("#txtinq_tradename").val(arr[13]);
      $("#txtinq_tradename").attr("value",tradeID);
      $("#txtinq_companyname").val(arr[1]);
      $("#txtinq_industryname").val(arr[3]);
      $("#txtinq_address").val(arr[4]);
      $("#status_filled").val("1");
    }
  });

  $.ajax({
    type: 'POST',
    url: 'mainclass.php',
    data: 'companyID=' + companyID + '&tradeID=' + tradeID +'&form=selectcontactnumbers',
    success: function(data)
    {
      $("#div_inquiry_contact_numbers").html(data);
    }
  });

  $.ajax({
    type: 'POST',
    url: 'mainclass.php',
    data: 'companyID=' + companyID + '&tradeID=' + tradeID +'&form=selectcontactpersons',
    success: function(data)
    {
      $("#div_inquiry_contact_person").html(data);
    }
  });
  $("#modal_loadtradename").modal("hide");
}

function loadentriesstorelist(){
        var page = $("#txt_userpage_tenants").val();
        var txtsearchtradename = $("#txtsearchtradename").val();

        $.ajax({
            type: 'POST',
            url: 'mainclass.php',
            data: 'txtsearchtradename=' + txtsearchtradename + '&page=' + page  + '&form=loadentriesstorelist',
            success: function(data){
                if(data == "no data"){
                    $("#txtentriesstorelist").html("<br />");
                }
                else{
                    $("#txtentriesstorelist").text(data);
                }
            }
        });
    }

function loadpagestorelist(){
        var page = $("#txt_userpage_tenants").val();
        var txtsearchtradename = $("#txtsearchtradename").val();

        $.ajax({
            type: 'POST',
            url: 'mainclass.php',
            data: 'page=' + page + '&txtsearchtradename=' + txtsearchtradename + '&form=loadpagestorelist',
            success: function(data){
                $("#ulpaginationstorelist").html(data);
            }
        });
    }

function pagination_store(page, pagenums){
    $(".pgnum").removeClass("active");
    var value = "#" + pagenums;
    $("#pg" + pagenums).addClass("active");
    $("#txt_userpage_tenants").val(page);
    loadtradenamelist();
    loadpagestorelist();
    loadentriesstorelist();
}
</script>
