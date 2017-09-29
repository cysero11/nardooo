<style>
/* Let's get this party started */
::-webkit-scrollbar {
    width: 5px;
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
    background: #cccccc;
    -webkit-box-shadow: inset 0 0 6px #cccccc;
}
::-webkit-scrollbar-thumb:window-inactive {
    background: #cccccc;
}    
</style>
<style>
#group_access_list tr td { cursor: hand !important; cursor: pointer !important; }
#tblpermission tr td { cursor: hand !important; cursor: pointer !important; }
a { cursor: hand !important; cursor: pointer !important; }
</style>
<div class="page-header">
    <div class="form-group" style="padding-bottom: 10px;">
        <div class="col-md-3 col-xs-12" style="padding-bottom: 10px;">
            <h1>User & Accessibility</h1>        
        </div>
        <div class="col-md-3 col-xs-12">
               
        </div>
        <div class="col-md-4 col-xs-12">
               
        </div> 
        <div class="col-md-2 col-xs-12" style="padding-right: 0px; padding-left: 0px;">
            <a href="#" id="btn_inquiry" class="btn btn-info btn-sm" style="width: 100% !important;float:right;" onclick="newuser()">New User</a>   
        </div>               
    </div>

</div>


<div class="row">
    <div class="col-xs-12">
        <!-- PAGE CONTENT BEGINS -->
        <div>
            <div class="row search-page" id="search-page-1">
                <div class="col-xs-12">
                  <div class="row">
                    <div class="col-xs-12">
                      <!-- PAGE CONTENT BEGINS -->
                      <div class="row">
                        <div class="col-sm-12">
                          <div class="tabbable">
                            <ul class="nav nav-tabs" id="myTab">
                              <li class="active">
                                <a data-toggle="tab" href="#home" id="div_businessinfo">
                                  Users List
                                </a>
                              </li>

                              <li>
                                <a data-toggle="tab" href="#unitinfo" id="div_unitinfo">
                                  Group Access
                                </a>
                              </li>
                            </ul>

                            <div class="tab-content" style="display: block; height: 28em;padding-bottom:0px;padding-top: 10px;">
                              <div id="home" class="tab-pane fade in active">
                                <div id="div_user" style="display: block;height: 26em;overflow-y: scroll;">

                                </div>                              
                              </div>

                              <div id="unitinfo" class="tab-pane fade">
                              <div class="row form-group" style="margin-bottom: 0px;">
                                <div class="col-md-3">
                                  <div class="panel panel-default" style="margin-bottom: 0px;">
                                    <div class="panel-heading">
                                      <h4 class="panel-title">
                                        Group List
                                      </h4>
                                    </div>

                                    <div class="panel-collapse collapse in" id="collapseOne" aria-expanded="true">
                                      <div class="panel-body">
                                        <table style="display: block; height: 15em;overflow-y: scroll;">
                                          <tbody id="group_access_list">
                                            
                                          </tbody>
                                        </table>
                                        <hr />
                                        <div class="input-group" id="company_contact_mobile" style="width: 100%;">
                                          <input type="text" id="txtnew_groupname" class="form-control" placeholder="New Group Name">
                                            <div class="spinbox-buttons input-group-btn">         
                                              <a href="#" id="btn_inquiry" style="margin: 0px;float:right;" onclick="savenewgroupname()" class="btn btn-info btn-sm">Add</a>       
                                            </div>
                                        </div>
                                        
                                      </div>
                                    </div>



                                  </div>                                
                                </div>

                                <div class="col-md-4">
                                  <div class="panel panel-default" style="margin-bottom: 0px;">
                                    <div class="panel-heading">
                                      <h4 class="panel-title">
                                        Permissions
                                      </h4>
                                    </div>

                                    <div class="panel-collapse collapse in" id="collapseOne" aria-expanded="true" style="display: block; height: 22em;overflow-y:scroll;">
                                      <div class="panel-body">
                                        <table id="tblpermission" style="display: none;">
                                          <tbody>
                                            <tr><td style='padding:5px;'><i class='ace-icon fa fa-caret-right green'></i>&nbsp;&nbsp;&nbsp;<label id="div_group" style="font-weight: bold;"></label></td></tr>
                                            <tr onclick="disppermission('div_content_inq');"><td style='padding:5px;'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class='ace-icon fa fa-caret-right blue'></i>&nbsp;&nbsp;&nbsp;INQUIRY MODULE</td></tr>
                                            <tr onclick="disppermission('div_content_app');"><td style='padding:5px;'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class='ace-icon fa fa-caret-right blue'></i>&nbsp;&nbsp;&nbsp;LEASING APPLICATION MODULE</td></tr>
                                            <tr onclick="disppermission('div_content_res');"><td style='padding:5px;'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class='ace-icon fa fa-caret-right blue'></i>&nbsp;&nbsp;&nbsp;RESERVATION MODULE</td></tr>
                                          </tbody>
                                        </table>
                                      </div>
                                    </div>
                                  </div>                                
                                </div>

                                <div class="col-md-5">
                                  <div class="panel panel-default" style="margin-bottom: 0px;">
                                    <div class="panel-heading">
                                      <h4 class="panel-title">
                                        Granted Permissions
                                      </h4>
                                    </div>

                                    <div class="panel-collapse collapse in" id="collapseOne" aria-expanded="true" style="display: block; height: 22em;overflow-y:scroll;">
                                      <div class="panel-body">
                                        <div style="display: block; height: 17em;overflow-y: scroll;">
                                        <ul class="list-unstyled div_cont" style="display: none;" id="div_content_inq">
                                          <li>
                                            <label>
                                              <input name="form-field-checkbox2" id="clkdivinq" class="ace ace-checkbox-2" type="checkbox" value="" onclick="chkall('clkdivinq','inquiry_module')">
                                              &nbsp;&nbsp;&nbsp;<span class="lbl" style="font-weight: bold;"> INQUIRY MODULE</span>
                                            </label>
                                          </li>

                                          <li>
                                            &nbsp;&nbsp;&nbsp;
                                            <label>
                                              <input name="form-field-checkbox2" class="ace ace-checkbox-2 inquiry_module permission" type="checkbox" id="inq_new" onclick="">
                                              &nbsp;&nbsp;&nbsp;<span class="lbl"> Creating of New Inquiry.</span>
                                            </label>
                                          </li>

                                          <li>
                                            &nbsp;&nbsp;&nbsp;
                                            <label>
                                              <input name="form-field-checkbox2" class="ace ace-checkbox-2 inquiry_module permission" type="checkbox" id="inq_updating" onclick="">
                                              &nbsp;&nbsp;&nbsp;<span class="lbl"> Updating of Inquiry.</span>
                                            </label>
                                          </li>
                                        </ul>
                                        <ul class="list-unstyled div_cont" style="display: none;" id="div_content_app">
                                          <li>
                                            <label>
                                              <input name="form-field-checkbox2" id="clkdivapp" class="ace ace-checkbox-2" type="checkbox"  onclick="chkall('clkdivapp','inquiry_app')">
                                              &nbsp;&nbsp;&nbsp;<span class="lbl" style="font-weight: bold;"> LEASING APPLICATION MODULE</span>
                                            </label>
                                          </li>

                                          <li>
                                            &nbsp;&nbsp;&nbsp;
                                            <label>
                                              <input name="form-field-checkbox2" class="ace ace-checkbox-2 inquiry_app permission" type="checkbox" id="app_new" value="" onclick="">
                                              &nbsp;&nbsp;&nbsp;<span class="lbl"> Creating of New Leasing Application.</span>
                                            </label>
                                          </li>

                                          <li>
                                            &nbsp;&nbsp;&nbsp;
                                            <label>
                                              <input name="form-field-checkbox2" class="ace ace-checkbox-2 inquiry_app permission" type="checkbox" id="app_update" onclick="">
                                              &nbsp;&nbsp;&nbsp;<span class="lbl"> Updating of Leasing Application.</span>
                                            </label>
                                          </li>

                                          <li>
                                            &nbsp;&nbsp;&nbsp;
                                            <label>
                                              <input name="form-field-checkbox2" class="ace ace-checkbox-2 inquiry_app permission" type="checkbox" id="app_forapp" onclick="">
                                              &nbsp;&nbsp;&nbsp;<span class="lbl"> Changing of status into 'for approval'.</span>
                                            </label>
                                          </li>

                                          <li>
                                            &nbsp;&nbsp;&nbsp;
                                            <label>
                                              <input name="form-field-checkbox2" class="ace ace-checkbox-2 inquiry_app permission" type="checkbox" id="app_appr" onclick="">
                                              &nbsp;&nbsp;&nbsp;<span class="lbl"> Approving of Leasing Application.</span>
                                            </label>
                                          </li>
                                        </ul>
                                        <ul class="list-unstyled div_cont" style="display: none;" id="div_content_res">
                                          <li>
                                            <label>
                                              <input name="form-field-checkbox2" id="clkdivres" class="ace ace-checkbox-2" type="checkbox" onclick="chkall('clkdivres','inquiry_res')">
                                              &nbsp;&nbsp;&nbsp;<span class="lbl" style="font-weight: bold;"> RESERVATION MODULE</span>
                                            </label>
                                          </li>

                                          <li>
                                            &nbsp;&nbsp;&nbsp;
                                            <label>
                                              <input name="form-field-checkbox2" class="ace ace-checkbox-2 inquiry_res permission" type="checkbox" id="res_update" onclick="">
                                              &nbsp;&nbsp;&nbsp;<span class="lbl"> Updating of Reservation Form.</span>
                                            </label>
                                          </li>

                                          <li>
                                            &nbsp;&nbsp;&nbsp;
                                            <label>
                                              <input name="form-field-checkbox2" class="ace ace-checkbox-2 inquiry_res permission" type="checkbox" id="res_confirm" onclick="">
                                              &nbsp;&nbsp;&nbsp;<span class="lbl"> Changing of status into 'confirmed'.</span>
                                            </label>
                                          </li>
                                        </ul>
                                        </div>
                                        <a href="#" id="btn_updateaccess" style="margin: 0px;float:right;display: none;" class="btn btn-default btn-sm">Update</a>
                                      </div>
                                    </div>
                                  </div>                                
                                </div>
                              </div>

                            </div>
                          </div>
                        </div><!-- /.col -->

                        <div class="vspace-6-sm"></div>
                      </div><!-- /.row -->

                      <div class="space"></div>
                    </div>
                  </div>                
                </div>
            </div>
        </div>
        <!-- PAGE CONTENT ENDS -->
    </div><!-- /.col -->
</div><!-- /.row -->
<!-- /.page-content -->

<?php
    include("modal_user.php");
?>

<script>
 $(function(){
    loaduserlist();
    loadgroup_access_list();
 });

 function savenewgroupname()
 {
    var grp = $("#txtnew_groupname").val();
    $.ajax({
      type: 'POST',
      url: 'mainclass.php',
      data: 'grp='+grp+'&form=savenewgroupname',
      success: function(data)
      {
        loadgroup_access_list();
        $("#txtnew_groupname").val("");
        $("#btn_updateaccess").css("display", "none");
        $(".div_cont").css("display", "none");
      }
    })
 }

 function disppermission(div)
 {
  $(".div_cont").css("display", "none");
  $("#"+div).css("display", "block");
  $("#btn_updateaccess").css("display", "block");
 }

 function chkall(id, chkbox)
 {
    $('#'+id).on('change', function() {
        if (!$(this).is(':checked')) {
            $('.'+chkbox).prop('checked', false);    
        } else {
            $('.'+chkbox).prop('checked', true);
        }
    });
 }

 function newuser() {
     var empty = $("#file_upload_user_img").find("a[class='remove']");
     empty.click();
     $("#modal_newuser").modal("show");
     $("#btn_user_modal").attr("onclick", "saveuserinfo(\"\")");
     $("#txtuser_lname").val("");
     $("#txtuser_fname").val("");
     $("#txtuser_mname").val("");
     $("#txtuser_eaddress").val("");
     $("#txtuser_username").val("");
     $("#txtuser_pass").val("");
     $("#slctgroupaccess").val("");
     $("#imguseraccount").attr("src", "assets/images/avatars/noimage.png");
 }

 function loaduserlist()
 {
    $.ajax({
        type: 'POST',
        url: 'mainclass.php',
        data: 'form=loaduserlist',
        success: function(data)
        {
            $("#div_user").html(data);
        }
    })
 }

function edituser(userid)
{

    $.ajax({
        type: 'POST',
        url: 'mainclass.php',
        data: 'userid=' + userid + '&form=edituser',
        success: function(data)
        {
            var arr = data.split("|");
            $("#txtuser_lname").val(arr[3]);
            $("#txtuser_fname").val(arr[1]);
            $("#txtuser_mname").val(arr[2]);
            $("#txtuser_eaddress").val(arr[4]);
            $("#txtuser_username").val(arr[5]);
            $("#txtuser_pass").val(arr[6]);
            $("#slctgroupaccess").val(arr[11]);
            if(arr[10] == "" || arr[10].match(/^\s*$/))
            {
                $("#imguseraccount").attr("src", "assets/images/avatars/noimage.png");            
            }
            else
            {
                $("#imguseraccount").attr("src", "server/user/"+arr[0]+"/"+arr[10]+"");
            }

            $("#btn_user_modal").attr("onclick", "saveuserinfo(\""+arr[0]+"\")");
            $("#modal_newuser").modal("show");
        }
    })
}

function edituseraccess(userid)
{
    $.ajax({
        type: 'POST',
        url: 'mainclass.php',
        data: 'userid=' + userid + '&form=edituseraccess',
        success: function(data)
        {
            alert(data)
        }
    })
}

function deleteuser(userid)
{
    $.ajax({
        type: 'POST',
        url: 'mainclass.php',
        data: 'userid=' + userid + '&form=deleteuser',
        success: function(data)
        {
            alert(data)
        }
    })
}

function saveuserinfo(userid)
{
    var lname = $("#txtuser_lname").val();
    var fname = $("#txtuser_fname").val();
    var mname = $("#txtuser_mname").val();
    var eaddress = $("#txtuser_eaddress").val();
    var username = $("#txtuser_username").val();
    var pass = $("#txtuser_pass").val();
    var access = $("#slctgroupaccess").val();
    $.ajax({
        type: 'POST',
        url: 'mainclass.php',
        data: '&id=' + userid +
              '&lname=' + lname +
              '&fname=' + fname +
              '&mname=' + mname +
              '&eaddress=' + eaddress +
              '&username=' + username +
              '&pass=' + pass +
              '&access=' + access +
              '&form=saveuserinfo',
        success: function(data)
        {   
            var arr = data.split("|");
            if(arr[0] == "1")
            {
                alert("User successfully modified.");
                sendprofilepic_user(arr[1])
                $("#modal_newuser").modal("hide");
            }
            else if(arr[0] == "2")
            {
                alert("A new user successfully added.");
                sendprofilepic_user(arr[1])
                $("#modal_newuser").modal("hide");
            }

            loaduserlist();
        }
    })
}

function sendprofilepic_user(userID){
    $("#userID").val(userID);
    var data = new FormData($('#posting_profilepic_trade')[0]);
    $.ajax({
      type:"POST",
      url:"setup/user/upload_image.php",
      data: data,
      mimeType: "multipart/form-data",
      contentType: false,
      cache: false,
      processData: false,
      success:function(data){
        // alert(data);
      }
    });
}

 $(".form_lease_application_req").each(function(){
  var form_id = $(this).attr("id");
  var inputfile = $(this).find(".upload_app_req");
  var empty = $(this).find("a[class='remove']");
  inputfile.click(function(){
    empty.click();
    $("#"+form_id+"_icon").removeClass("fa-check");
    $("#"+form_id+"_icon").addClass("fa-remove");
    $("#"+form_id+"_icon").css("color", "red");
  })
});

 function loadgroup_access_list()
 {
  $.ajax({
    type: 'POST',
    url: 'mainclass.php',
    data: 'form=group_access_list',
    success: function(data)
    {
      $("#group_access_list").html(data);
    }
  })
 }

 function viewpermission(groupid, name)
 {
  $.ajax({
    type: 'POST',
    url: 'mainclass.php',
    data: 'id='+groupid+'&form=viewpermission',
    success: function(data)
    {
      $("#btn_updateaccess").attr("onclick", "savepermission(\""+groupid+"\")")
      $("#btn_updateaccess").css("display", "none");
      $(".div_cont").css("display", "none");
      $("#div_group").text(name);
      $("#tblpermission").css("display", "block")
      var chkbox = "inq_new|inq_updating|app_new|app_update|app_forapp|app_appr|res_update|res_confirm|";
      var arr = data.split("|");
      var chk = chkbox.split("|");
      var i = 0;
      for(i = 0; i<=arr.length-1; i++)
      {
        if(arr[i] == "1")
        {
          $("#"+chk[i]).prop("checked", true);
        }
        else
        {
          $("#"+chk[i]).prop("checked", false);
        }
      }

      if(arr[0] == "1" && arr[1] == "1")
      {
        $("#clkdivinq").prop("checked", true);
      }
      else
      {
        $("#clkdivinq").prop("checked", false); 
      }
      if(arr[2] == "1" && arr[3] == "1" && arr[4] == "1" && arr[5] == "1")
      {
        $("#clkdivapp").prop("checked", true);        
      }
      else
      {
        $("#clkdivapp").prop("checked", false); 
      }
      if(arr[6] == "1" && arr[7] == "1")
      {
        $("#clkdivres").prop("checked", true);        
      }
      else
      {
        $("#clkdivres").prop("checked", false); 
      }
    }
  })
 }

 function savepermission(id_per)
 {
  var permission = "";
  $(".permission").each(function(){
    if($(this).is(":checked"))
    {
      permission += "1|";
    }
    else
    {
      permission += "0|";
    }
  });

  $.ajax({
    type: 'POST',
    url: 'mainclass.php',
    data: 'permission=' + permission + '&id=' + id_per + '&form=savepermission',
    success: function(data)
    {
      alert("Successfully modified accessibility.");
    }
  })
 }
</script>