<!-- ============ MODAL INQUIRY ============= -->
 <style>
 tbody tr td { cursor: hand !important; cursor: pointer !important; }
 
.parent {
    height: 50vh;
}

</style>
<!-- ============ MODAL INQUIRY ============= -->
<div class="modal fade" id="modal_loadcompany" role="dialog" area-hidden="true" data-keyboard="false" data-backdrop="static">
  <div class="modal-dialog modal-lg">
  
    <!-- Modal content-->
    <div class="modal-content">

       <!-- Modal header-->
      <div class="modal-header" style="background-color: #438EB9;">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" style="color:white; font-weight: bold;">Company List</h4>
      </div>

       <!-- Modal body-->
      <div class="modal-body" style="display: block;height: 41em;">
          <div class="row form-group">
              <div class="col-md-8 col-xs-12">
                  <span class="input-icon" style="width: 100%;">
                    <input type="text" class="form-control" placeholder="Search ..." id="txtsearchcompany">
                    <i class="ace-icon fa fa-search nav-search-icon"></i>
                  </span>
              </div>
              <div class="col-md-4 col-xs-12">
                <a href="#" id="btn_new_comany" class="btn btn-info btn-sm" style="width: 100% !important;" onclick="newcompany()">New Company</a>
              </div> 
          </div>         
          <div class="row form-group" style="margin-bottom: 0px !important;">

              <div class="col-xs-12">
                <div id="companytable" class="parent">
                  <table id="simple-table" class="table table-bordered table-hover fixTable">
                        <thead>
                          <tr>
                            <td>Company</td>   
                            <td>Business Address</td>                                                    
                          </tr>
                        </thead>
                        <div class="" id="status_company_list"></div>
                        <tbody id="tblcompanylist">

                        </tbody>
                    </table>
                  </div>
                <table class="tabledash_footer table" style="margin: 0px !important;">
                  <thead>
                    <tr>
                        <th id="th_tabledash_footer" width="" colspan="7" style="width: 911px;padding-top: 15px;padding-bottom: 15px;">
                        <font style="float: left; color: white !important;margin-left: 15px;font-weight: normal;font-weight: 8px !important;" id="txtentriescompanylist"><br /></font>
                            <input type="hidden" id="txt_userpage2" name="">
                            <ul id="ulpaginationcompanylist" class="pagination pull-right"></ul>
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
  $("#txt_userpage2").val("1");
  $("#txtsearchcompany").focus(function(){
    $("#tblcompanylist").tablenav("remove", "tblcompanylist", "tblcompanylist", $("#tradetable"));
  });

  $("#txttrade_companyname").focus(function(){
    $("#tblcompanylist").tablenav("add", "tblcompanylist", "tblcompanylist", $("#tradetable"));
  });
    
  $("#txtsearchcompany").keydown(function(e){
    var x = e.keyCode;
    if(x == 13)
    { loadcompanylist(); }
    else if(x == 40)
    {
      $("#tblcompanylist").focus();
      $("#tblcompanylist").tablenav("add", "tblcompanylist", "tblcompanylist", $("#tradetable"));
    }
  });

    $("#btn_new_comany").keydown(function(e){
    var x = e.keyCode;
    if(x == 13)
    { newcompany() }
  }); 
});

$(function(){
  $("#companytable").click(function(){
    var obj = $(this);
    $("#tblcompanylist").tablenav("tblcompanylist", "tblcompanylist", obj);
  });
});

// laoding of company list
function loadcompanylist() {
  var txtsearchcompany = $("#txtsearchcompany").val();
  var page = $("#txt_userpage2").val();
  $.ajax({
    type: 'POST',
    url: 'mainclass.php',
    data: 'txtsearchcompany=' + txtsearchcompany + '&page=' + page + '&form=loadcompanylist',
    beforeSend : function() {
      $('#indexloadingscreen').addClass('myspinner');
    },
    success: function(data){
      $('#indexloadingscreen').removeClass('myspinner');
      $("#tblcompanylist").html(data);
      loadentriescompanylist();
      loadpagecompanylist();
    }
  })
}

function loadentriescompanylist(){
    var page = $("#txt_userpage2").val();
    var txtsearchcompany = $("#txtsearchcompany").val();

    $.ajax({
        type: 'POST',
        url: 'mainclass.php',
        data: 'txtsearchcompany=' + txtsearchcompany + '&page=' + page  + '&form=loadentriescompanylist',
        success: function(data){
            if(data == "no data"){
                $("#txtentriescompanylist").html("<br />");
            }
            else{
                $("#txtentriescompanylist").text(data);
            }
        }
    });
}

function loadpagecompanylist()
{
  var page = $("#txt_userpage2").val();
  var txtsearchcompany = $("#txtsearchcompany").val();

  $.ajax({
      type: 'POST',
      url: 'mainclass.php',
      data: 'page=' + page + '&txtsearchcompany=' + txtsearchcompany + '&form=loadpagecompanylist',
      success: function(data){
          $("#ulpaginationcompanylist").html(data);
      }
  });
}

function pagination(page, pagenums){
    $(".pgnum").removeClass("active");
    var value = "#" + pagenums;
    $("#pg" + pagenums).addClass("active");
    $("#txt_userpage2").val(page);
    loadcompanylist();
    loadpagecompanylist();
    loadentriescompanylist();
}

// displaying of modal for loading companies
function modal_loadcompany()
{
  // var trade = $("#txttrade_tradename").val();
  // if(trade == "")
  // {
  //   alert("Enter trade name first.");
  //   $("#txttrade_tradename").css("border-color","#f2a696");
  // }
  // else
  // {
    // $("#txttrade_tradename").css("border-color","#D5D5D5");    
    loadcompanylist();
    $("#modal_loadcompany").modal("show");    
  // }

}

// modal for new company
function newcompany()
{
  $(".home-address").each(function(){
    var this_id = $(this).attr("id");
    $(this).attr("onclick", "loadaddressmodal(\""+this_id+"\")")
  })
  $("#modal_new_company").modal("show");
  loadindustry();
  loadcompanyposition();
  $("#txtcomp_busadd").css("text-indent", "");
  $("#txtcomp_busadd_icon").removeClass("fa-map-marker");
  $("#txtcomp_perm_add").css("text-indent", "");
  $("#txtcomp_perm_add_icon").removeClass("fa-map-marker");
  $("#txtcomp_curr_add").css("text-indent", "");
  $("#txtcomp_curr_add_icon").removeClass("fa-map-marker");
  $("#txtcomp_bill_add").css("text-indent", "");
  $("#txtcomp_bill_add_icon").removeClass("fa-map-marker");
  $("#txtcontact_address").css("text-indent", "");
  $("#txtcontact_address_icon").removeClass("fa-map-marker");
}

// selecting company
function selectthiscompanyforref(this_company)
{
  $.ajax({
    type: 'POST',
    url: 'mainclass.php',
    data: 'companyid=' + this_company + '&form=selectthiscompanyforref',
    success: function(data)
    {
      var arr = data.split("|");
      $("#txttrade_companyname").val(arr[1]);
      $("#txttrade_companyname").attr("value", arr[0]);
      $("#txttrade_tradeindustry").val(arr[2]);
      $("#txttrade_busadd").val(arr[3]);
      $("#modal_loadcompany").modal("hide");
    }
  })
}
</script>