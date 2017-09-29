<script>
$(function(){
    $("#txt_userpage").val("1");
    loaduser();
    $("#tblmalllist").niceScroll({cursorcolor:"#999"});
});

function loaduser()
        {
            var key = $("#txtsearchuserref").val();
            var page = $("#txt_userpage").val();
            $.ajax({
                type: 'POST',
                url: 'mainclass.php',
                data: 'key=' + key + '&page=' + page + '&form=loaduser',
                success: function(data){
                    $("#tblmalllist").html(data);
                    $(".scroll").niceScroll({cursorcolor:"#999"});
                    loadpaginationuser();
                    loadentriesuser();
                }

            });
        }


    function loadpaginationuser() //added by melanie
        {
            var key = $("#txtsearchuserref").val();
            var page = $("#txt_userpage").val();
            $.ajax({
                type: 'POST',
                url: 'mainclass.php',
                data: 'key=' + key + '&page=' + page + '&form=loadpaginationuser',
                success: function(data){
                    $("#ulpaginationuser").html(data);
                }
            }).error(function() {
                alert(data);
            });
        }

    function getvaluser(page, pagenums) //added by melanie
        {
            // alert(page);
                $(".pgnumptnts").removeClass("active");
                var value = "#" + pagenums;
                $("#pgptnts" + pagenums).addClass("active");
                $("#txt_userpage").val(page);
                // reloadhmo();
                loaduser();
                loadpaginationuser();
                loadentriesuser();
        }

    function loadentriesuser() //added by melanie
        {
            var key = $("#txtsearchuserref").val();
            var page = $("#txt_userpage").val();
            $.ajax({
                type: 'POST',
                url: 'mainclass.php',
                data: 'key=' + key + '&page=' + page + '&form=loadentriesuser',
                success: function(data){
                    if(data == "no data")
                    {
                        $("#txtuserentries").text("");
                    }
                    else
                    {
                        $("#txtuserentries").text(data);
                    }
                }
            }).error(function() {
                alert(data);
            });
        }

function delrefuser(user)
    {
        var conf = confirm("Are you sure?");
        if(conf == true)
        {
            $.ajax({
                type: 'POST',
                url: 'mainclass.php',
                data: 'id=' + user + '&form=delrefuser',
                success: function(data)
                {
                        alert(data);
                        loaduser();
                }
            })      
        }
    }

    function editrefuser(user)
    {
        $.ajax({
            type: 'POST',
            url: 'mainclass.php',
            data: 'id=' + user + '&form=editrefuser',
            success: function(data)
            {
                    var arr = data.split("|");
                    $("#txtuserid").val(arr[1])
                    $("#txtuser_first").val(arr[2]);
                    $("#txtuser_middle").val(arr[3]);
                    $("#txtuser_last").val(arr[4]);
                    $("#txtuser_email").val(arr[5]);
                    $("#txtuser_username").val(arr[6]);
                    $("#txtuser_password").val(arr[7]);
                    $("#new_user").modal("show");
            }
        })
    }

function addnewuser()
    {
        var mallid = $("#txtuserid").val();
        var str = "";
        var str2 = "";
        if(mallid == "")
        {
            str = "Save User?";
            str2 = "User has been saved";
        }
        else
        {
            str = "Update User?";
            str2 = "User has been updated";
        }
        var conf = confirm(str);
        if(conf == true)
        {
                var userid = $("#txtuserid").val();
                var first = $("#txtuser_first").val();
                var middle = $("#txtuser_middle").val();
                var last = $("#txtuser_last").val();
                var email = $("#txtuser_email").val();
                var username = $("#txtuser_username").val();
                var password = $("#txtuser_password").val();
        
            $.ajax({
                type: 'POST',
                url: 'mainclass.php',
                data: 'id=' + userid + '&first=' + first  +  '&middle=' + middle  + '&last=' + last + '&email=' + email + '&username=' + username  + '&password=' + password  +  '&form=addnewuser',
                success: function(data) {
                    if(data == "Successfully modified.")
                    {
                        alert(data);
                        loaduser();
                        $(".text_user").val("");
                        $("#new_user").modal("hide");
                    }
                    else
                    {
                        alert(data);
                        loaduser();
                        $(".text_user").val("");
                    }
                    
                
                }
            });
        }
    }
</script>
<div class="row">
    <div class="col-xs-12" style="padding: 10px !important;">
        <div class="pull-left" style="padding-top:10px;">
            <b class="text-primary" style="margin-top: 15px !important;">User List</b>
            <input type="hidden" id="txt_userpage" name="">
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-4 col-xs-12">
        <!-- <form class="form-search"> -->
            <span class="input-icon" style="width: 100%;">
                <input type="text" class="form-control" placeholder="Search ..." id="txtsearchuserref" onkeyup="loaduser()">
                <i class="ace-icon fa fa-search nav-search-icon"></i>
            </span>
        <!-- </form> -->
    </div>
    <div class="col-md-4 col-xs-12">
    </div>
    <div class="col-md-2 col-xs-6">
            <!-- <a href="#" id="" class="btn btn-danger btn-sm" style="width: 100% !important;">Delete</a> -->
    </div>
    <div class="col-md-2 col-xs-6">
            <a href="#" id="btn_mall" class="btn btn-default btn-sm" style="width: 100% !important;" onclick="loadmodal_user()">New User</a>
    </div>  
</div>
<div class="row" style="padding: 10px !important;overflow-x: auto;">
    <table id="simple-table" class="table  table-bordered table-hover" style="display: flex;flex-flow: column;height: 100%;width: 100%;margin-bottom: 0px !important;">
        <thead style="flex: 0 0 auto;width: calc(100%);">
            <tr style="display: table;table-layout: fixed;width: 100%;display: table;">
                <!-- <th class="center">
                    <label class="pos-rel">
                        <input type="checkbox" class="ace" />
                        <span class="lbl"></span>
                    </label>
                </th> -->
                <th>Name</th>
                <th class="hide_mobile">Email Address</th>
                <th>Username</th>
                <th>Option</th>                                                     
            </tr>
        </thead>
        <tbody id="tblmalllist" style="flex: 1 1 auto;display: block;height: 16em;overflow-x: hidden;">

        </tbody>
    </table>
    <table class="tabledash_footer table" style="margin: 0px !important;">
        <thead>
            <tr>
                <th id="th_tabledash_footer" width="" colspan="7" style="width: 911px;">
                <font style="float: left; color: #777 !important;margin-top: 17px;margin-left: 15px;font-weight: normal;font-weight: 8px !important;" id="txtuserentries"></font>
                    <div class="pagination">
                        <ul id="ulpaginationuser"></ul>
                    </div>
                </th>
            </tr>
        </thead>
</table>
</div>
<div class="row">

</div>

<!-- =============================================  dialog ============================================ -->
<div id="dialog-mall" class="hide">
</div>
<!-- ====================================================================================================== -->
<!-- Modal -->
  <div class="modal fade" id="new_user" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">User</h4>
          <input type="hidden" id="txtuserid" class="text_user" name="">
        </div>
        <div class="modal-body">
            <div class="row form-group">
                <label class="col-sm-3 col-xs-12 control-label no-padding-right" for="form-field-1"> First Name </label>

                <div class="col-sm-9 col-xs-12">
                    <input type="text" id="txtuser_first" class="form-control text_user" placeholder="First Name">
                </div>
            </div>
            <div class="row form-group">
                <label class="col-sm-3 col-xs-12 control-label no-padding-right" for="form-field-1"> Middle Name </label>

                <div class="col-sm-9 col-xs-12">
                    <input type="text" id="txtuser_middle" class="form-control text_user" placeholder="Middle Name">
                </div>
            </div>
            <div class="row form-group">
                <label class="col-sm-3 col-xs-12 control-label no-padding-right" for="form-field-1"> Last Name </label>

                <div class="col-sm-9 col-xs-12">
                    <input type="text" id="txtuser_last" class="form-control text_user" placeholder="Last Name">
                </div>
            </div> 
            <div class="row form-group">
                <label class="col-sm-3 col-xs-12 control-label no-padding-right" for="form-field-1"> Email </label>

                <div class="col-sm-9 col-xs-12">
                    <input type="text" id="txtuser_email" class="form-control text_user" placeholder="Email Address">
                </div>
            </div> 
            <div class="row form-group">
                <label class="col-sm-3 col-xs-12 control-label no-padding-right" for="form-field-1"> Username </label>

                <div class="col-sm-9 col-xs-12">
                    <input type="text" id="txtuser_username" class="form-control text_user" placeholder="Username">
                </div>
            </div> 
            <div class="row form-group">
                <label class="col-sm-3 col-xs-12 control-label no-padding-right" for="form-field-1"> Password </label>

                <div class="col-sm-9 col-xs-12">
                    <input type="password" id="txtuser_password" class="form-control text_user" placeholder="Password">
                </div>
            </div>                                              
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" onclick="addnewuser()"><i class="ace-icon fa fa-check"></i>&nbsp;Save</button>
        </div>
      </div>
      
    </div>
  </div>
<script>
function loadalert()
{   
        
            $( "#dialog-confirm" ).removeClass('hide').dialog({
                resizable: false,
                width: '320',
                modal: true,
                title: "<div class='widget-header'><h4 class='smaller'><i class='ace-icon fa fa-exclamation-triangle red'></i> Empty the recycle bin?</h4></div>",
                title_html: true,
                buttons: [
                    {
                        html: "<i class='ace-icon fa fa-trash-o bigger-110'></i>&nbsp; Delete all items",
                        "class" : "btn btn-danger btn-minier",
                        click: function() {
                            $( this ).dialog( "close" );
                        }
                    }
                    ,
                    {
                        html: "<i class='ace-icon fa fa-times bigger-110'></i>&nbsp; Cancel",
                        "class" : "btn btn-minier",
                        click: function() {
                            $( this ).dialog( "close" );
                        }
                    }
                ]
            });
}

function loadmodal_user()
{
    $("#new_user").modal("show");
    $(".text_user").val("");
}
</script>