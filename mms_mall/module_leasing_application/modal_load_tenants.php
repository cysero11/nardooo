<!-- ============ MODAL INQUIRY ============= -->
 <style>
 tbody tr td { cursor: hand !important; cursor: pointer !important; }
 
.parent {
    height: 50vh;
}

</style>
<!-- ============ MODAL INQUIRY ============= -->
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
      <div class="modal-body" id="modal-body-inquiry" style="display: block;height: 41em;">
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
                <div id="tradetable" class="parent">
                  <table id="simple-table" class="table  table-bordered table-hover">
                        <thead>
                          <tr>
                            <td>Store Name</td> 
                            <td>Company</td>   
                            <td>Business Address</td>                                                    
                          </tr>
                        </thead>
                        <div class="" id="statussavingreservation_store"></div>
                        <tbody id="tbltradenamelist">

                        </tbody>
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
    beforeSend : function() {
     $("#statussavingreservation_store").addClass("myspinner");
    },
    success: function(data){
      $("#statussavingreservation_store").removeClass("myspinner");
      $("#tbltradenamelist").html(data);
      loadpagestorelist();
      loadentriesstorelist();
    }
  })
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

function pagination_store(page, pagenums){
    $(".pgnum").removeClass("active");
    var value = "#" + pagenums;
    $("#pg" + pagenums).addClass("active");
    $("#txt_userpage_tenants").val(page);
    loadtradenamelist();
    loadpagestorelist();
    loadentriesstorelist();
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

// load modal trade list
function modal_loadtradename()
{
  loadtradenamelist();
  $("#modal_loadtradename").modal("show");
}

// modal new tenant
function newtenant()
{
  $("#modal_loadtradename").modal("show");
}

// selecting of tenant
function selecttenant(companyID, tradeID)
{
  $("#status_filled").val("1");
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
  $("#modal_loadtradename").modal("hide")
}
</script>