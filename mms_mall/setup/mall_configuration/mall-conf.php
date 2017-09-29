<input type="hidden" id="currentmallcount">
<div class="col-md-2 col-xs-12 pull-right" style=" padding-left: 0px;margin-bottom: 10px;">
    <a href="#" id="btn_inquiry" class="btn btn-default btn-sm" style="width: 100% !important;float:right;margin-bottom: 0px;" onclick="newmall()">New Mall</a>   
</div> 
<div class="row">
    <div class="col-xs-12">
        <div>
            <div class="row search-page" id="search-page-1">
                <div class="col-xs-12">
                    <div id="div_malls" style="display: block;height: 400px;">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- ==================================  MALL CONFIGURATION  ======================================= -->
<div  class="modal fade" id="modalconfiguremodal" area-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" style="color: white;" id="div_tex_header_con"></h4>
                <input type="hidden" id="txtmall_id" name="">
            </div>
            
                <div class="modal-body fornewroom" id="divcontent_modalmall">
                        <div class="tabbable tabs-left" id="mallconfdiv" style="display: none;">
                            <ul class="nav nav-tabs" id="myTab3">
                                <li class="active">
                                    <a data-toggle="tab" href="#home3">
                                        <i class="pink ace-icon fa fa-building bigger-110"></i>
                                        Wing
                                    </a>
                                </li>

                                <li>
                                    <a data-toggle="tab" href="#profile3">
                                        <i class="blue ace-icon fa fa-building bigger-110"></i>
                                        Floor
                                    </a>
                                </li>

                                <li>
                                    <a data-toggle="tab" href="#dropdown13">
                                        <i class="ace-icon fa fa-building"></i>
                                        Unit
                                    </a>
                                </li>

                                <li>
                                    <a data-toggle="tab" href="#setupbill">
                                        <i class="ace-icon fa fa-cog"></i>
                                        Setup
                                    </a>
                                </li>
                            </ul>
                            <input type="hidden" id="txt_wingpage" name="">
                            <div class="tab-content" style="margin-bottom: 20px;">
                                <div id="home3" class="tab-pane in active">
                                    <?php include("refwing.php"); ?>
                                </div>

                                <div id="profile3" class="tab-pane">
                                    <?php include("reffloor.php"); ?>
                                </div>

                                <div id="dropdown13" class="tab-pane">
                                    <?php include("refunit.php"); ?>
                                </div>
                                <div id="setupbill" class="tab-pane">
                                    <?php include("refbillsetup.php"); ?>
                                </div>
                            </div>
                        </div>
                        <div class="" id="mallneweditdiv" style="display: none;">
                        <!--  -->
                            <div class='row' style="padding-bottom: 20px;">
                                <div class='col-xs-12 col-sm-3'>
                                    <div class='text-center'>
                                        <img height='150' width='100%' id="img_mallinfo" class='thumbnail inline no-margin-bottom' alt='Greenbelt' src='assets/images/avatars/noimage.png' />
                                    </div>
                                    <div class="text-center" style="padding-top: 10px;">
                                        <form name='posting_profilepic' id="posting_profilepic" class='posting_profilepic' style="display: none;">
                                            <div style="display: none;">
                                            <input type="text" id="txtmallid_forms" name="txtmallid_forms">
                                            </div>
                                            <input id='file_upload' name='attachment_profilepic' class='form-control upload_app_req' type='file' style="margin-top: 20px;" onchange="showimg123();"/>
                                        </form>
                                        <button id="btn_changedp" class="btn btn-sm btn-primary" style="width: 100%;text-align: center;display: none;" onclick="updateaccdp()">Change</button>
                                    </div>
                                </div>

                                <div class='col-xs-12 col-sm-9'>
                                    <div class='space visible-xs'></div>

                                    <div class='profile-user-info profile-user-info-striped'>
                                        <div class='profile-info-row'>
                                            <div class='profile-info-name'> Mall Name </div>

                                            <div class='profile-info-value'>
                                                <span><input type="text" class="form-control required mall-info" placeholder="Mall Name" id="txtmall_name" name="" style="border-color: white !important;" maxlength="100"></span>
                                            </div>
                                        </div>

                                        <div class='profile-info-row'>
                                            <div class='profile-info-name'> Location </div>

                                            <div class='profile-info-value'>
                                                
                                                <span><input type="text" class="form-control required mall-info" placeholder="Location" id="txtmall_loc" name="" style="border-color: white !important;" maxlength="200"></span>
                                            </div>
                                        </div>
                                        
                                        <div class='profile-info-row'>
                                            <div class='profile-info-name'> About </div>

                                            <div class='profile-info-value'>
                                                <span><textarea class="form-control required mall-info" id="txtmall_abouts" style="height: 80px;border-color: white !important;" maxlength="300"></textarea></span>
                                            </div>
                                        </div>

                                        <div class='profile-info-row'>
                                            <div class='profile-info-name'> Telephone Number </div>

                                            <div class='profile-info-value'>
                                                <span><input class="form-control required mall-info input-mask-tele" id="txtmall_telephone" maxlength="11" placeholder="(99)-999-9999" style="border-color: white !important;" maxlength="100"></span>
                                            </div>
                                        </div>

                                        <div class='profile-info-row'>
                                            <div class='profile-info-name'> Email </div>

                                            <div class='profile-info-value'>
                                                <span><input class="form-control required mall-info email-address" id="txtmall_email" placeholder="sample@yahoo.com" style="border-color: white !important;" maxlength="100"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--  -->
                            </div>
                        </div>
                </div>
                <!-- End of Modal-body -->
                <div class="modal-footer">
                <button type="button" style="float: right;" class="btn btn-primary" id="btnmallupdateeee" onclick="savemallupdate()"><i class="ace-icon fa fa-check"></i>&nbsp;Save</button>
                </div>
        </div>
    </div>
</div>
<input type="hidden" id="dimakita">
<!-- ===================================================================================================== -->
<!-- Modal -->
  <div class="modal fade" id="modal_addnewunit" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" onclick="closeunitmodal()">&times;</button>
          <h4 class="modal-title">Unit</h4>
          <input type="hidden" id="txtrefunit" class="text_unit" name="">
        </div>
        <div class="modal-body">
            <div class="row form-group">
                <div class="col-md-3">
                                Unit Type
                </div>
                <div class="col-md-9">
                        <select class="form-control req_unit" id="txtbustype" onchange="checkbustypevalue()">   
                            <option value="">-- Select Type --</option>
                            <option value="LCA">Lease Common Area</option>
                            <option value="SET">SET</option>
                        </select>        
                </div>
            </div>        
            <div class="row form-group">
                <div class="col-md-3">
                                Wing
                </div>
                <div class="col-md-9">
                        <select id="txtbuilding" class="form-control text_unit req_unit" onchange="loadflrrrls2();">
                        <option value="">-- Select Wing --</option>
                        </select>            
                </div>
            </div>
        <!--  -->
            <div class="row form-group">
                <div class="col-md-3">
                                Floor
                </div>
                <div class="col-md-9">
                        <select id="txtflr" class="form-control text_unit req_unit">
                         <option value="">-- Select Floor --</option>
                        </select>           
                </div>
            </div>
            <hr />
        <!--  -->
            <div class="row form-group">
                <div class="col-md-3">
                                Unit
                </div>
                <div class="col-md-9">
                        <input type="text" class="form-control text_unit textreq_unit req_unit" id="txtunitname" name="" placeholder="Enter New Unit Name">              
                </div>
            </div>
            <div class="row form-group">
                <div class="col-md-3">
                                Classification
                </div>
                <div class="col-md-9">
                        <select id="txtclasses" class="form-control text_unit textreq_unit req_unit" onchange="loadotherinfo();">
                             <option value="">-- Select Classification --</option>
                        </select>         
                </div>
            </div>
            <div class="row form-group">
                <div class="col-md-3">
                                Department
                </div>
                <div class="col-md-9">
                        <select id="txtdepartments" class="form-control text_unit textreq_unit req_unit" onchange="loadotherinfo2()">
                             <option value="">-- Select Department --</option>
                        </select>           
                </div>
            </div>
            <div class="row form-group">
                <div class="col-md-3">
                                Category
                </div>
                <div class="col-md-9">
                        <select id="txtcategories" class="form-control text_unit textreq_unit req_unit">
                             <option value="">-- Select Category --</option>
                        </select>    
                </div>
            </div>
            <div class="row form-group">
                <div class="col-md-3">
                                Amenities
                </div>
                <!-- <div class="col-md-3">
                    <input type="radio" name='toilet' value="yes" onclick="chkradiovalue()">&nbsp;&nbsp;with toilet
                </div>
                <div class="col-md-3">
                    <input type="radio" name='toilet' value="no" onclick="chkradiovalue()" checked>&nbsp;&nbsp;without toilet
                </div>
                <div class="col-md-3">
                    <input type="text" class="form-control upper text_unit numonly" id="txttoiletqty" name="" placeholder="qty" disabled>
                </div> -->
                <div class="col-md-9">
                    <div class="inline" style="width: 100%;">
                        <div class="tags" style="width: 100%;" id="div_amenitiesselected">
                            <br/><label style="width: 100%;" onclick="addnewrefamenities()">Click to add amenities ..</label>
                        </div>
                    </div>
                </div>
            </div>  
            <div class="row form-group">
                <div class="col-md-3">
                            Area (sqm)
                </div>
                <div class="col-md-2" style="padding-right:2px;">
                        <input type="text" class="form-control upper text_unit textreq_unit numonly req_unit" id="txtsqm_height" name="" placeholder="Length">              
                </div>
                <div class="col-md-2" style="padding-left:2px;">
                        <input type="text" class="form-control upper text_unit textreq_unit numonly req_unit" id="txtsqm_width" name="" placeholder="Width">              
                </div>
                <div class="col-md-2">
                            Price per sqm 
                </div>
                <div class="col-md-3">
                        <input type="text" class="form-control upper text_unit textreq_unit numonly amount req_unit" id="txtpricepersqm" name="" style="text-align: right;" placeholder="Price per sqm">              
                </div>
            </div>
            <div class="row form-group">
                <div class="col-md-3">
                    Association Dues
                </div>
                <div class="col-md-3">
                    <div class="radio">
                      <label>
                        <input name="form-field-radio" type="radio" class="ace assocdues" value="1" checked>
                        <span class="lbl">&nbsp;&nbsp;&nbsp;Yes</span>
                      </label>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="radio">
                      <label>
                        <input name="form-field-radio" type="radio" class="ace assocdues" value="0">
                        <span class="lbl">&nbsp;&nbsp;&nbsp;No</span>
                      </label>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" onclick="saveunit()"><i class="ace-icon fa fa-check"></i>&nbsp;Save</button>
        </div>
      </div>
      
    </div>
  </div>

  <div class="modal fade bd-example-modal-sm" id="modal_addnewrefamenities" role="dialog">
    <div class="modal-dialog modal-sm">   
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-body">
          <button type="button" class="close" onclick="closemodalrefam()">&times;</button>
          <h4 class="modal-title">Select Amenity</h4>
            
            <div class="row form-group">
                <div class="col-xs-12 col-md-12">
                    <table style="margin:10px;border: 1px dotted #CCC;">
                        <tbody id="tblamenitiesreflist" style="flex: 1 1 auto;display: block;height: 20em;overflow-y: scroll;">

                        </tbody>
                    </table>
                    <hr />
                    <h6 class="modal-title">New Amenity</h6>
                    <h6 class="modal-title" style="font-size: 10px;font-style: italic;">(if not on the list)</h6>
                    <div class="input-group" style="width: 100%;">
                     <input type="text" id="txtaddnewrefame" style="" class="form-control" name="" placeholder="Add New" style="height: 43px !important;">
                       <div class="spinbox-buttons input-group-btn">         
                         <button type="button" class="btn btn-success btn-sm" onclick="savenewamenitiesref()"><i class="ace-icon fa fa-plus"></i>&nbsp;Add</button>     
                       </div>
                   </div>
                    
                    <div class="row form-group" style="margin-bottom: 5px;margin-top: 10px;">
                        <div class="col-md-12 col-xs-12">
                             <label style="width: 100%">
                                <input name="count_type" type="radio" class="ace" value="1">
                                <span class="lbl"> Inventory</span>
                            </label>                           
                        </div>
                    </div>
                    <div class="row form-group" style="margin-bottom: 5px;">
                        <div class="col-md-12 col-xs-12">
                            <label style="width: 100%">
                                <input name="count_type" type="radio" class="ace" value="0">
                                <span class="lbl"> Non-Inventory</span>
                            </label>                            
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="modal-footer">
          
          <button type="button" class="btn btn-primary" onclick="addamenitiesselected()"><i class="ace-icon fa fa-check"></i>&nbsp;Save</button>
        </div>
      </div>
      
    </div>
  </div> 
<script>
    $(function(){
        loadmalls();
        $("#div_malls").niceScroll({cursorcolor:"#999"});
        filecss();
        loadmallcurrentmallcount();
        trap();
        
    });

    $('.input-mask-tele').mask('(99)-999-9999');

    function trap(){
        $('.email-address').each(function(){
            $(this).focusout(function() {
                var sEmail = $(this).val();
                if ($.trim(sEmail).length == 0) {
                    // $(this).focus();
                    // alert("Please enter valid email address");
                    // alert('Please enter valid email address');
                }
                if (validateEmail(sEmail)) {
                    // $(".errohere").hide();
                    // alert('Email is valid');
                    // Nothing happens...
                }
                else {
                    // $(this).focus();
                    showmodal("alert", "The email address you entered is in invalid format.", "", null, "", null, "0");
                }
            });
        });   
    }

    function validateEmail(sEmail) {
    var filter = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
    if (filter.test(sEmail)) {
        return true;
    }
    else {
        return false;
    }
}

    function loadmalls()
    {
        $.ajax({
            type: 'POST',
            url: 'mainclass.php',
            data: 'form=loaddivmalls',
            beforeSend : function() {
                $('#indexloadingscreen').addClass('myspinner');
            },
            success: function(data){
                $('#indexloadingscreen').removeClass('myspinner');
                $("#div_malls").html(data);
                loadmallcurrentmallcount();
            }
        })
    }

    function savenewamenitiesref()
    {
        var newame =  $("#txtaddnewrefame").val();
        var radio = $('input[name="count_type"]:checked').val();
        if(newame != "" && radio != "")
        {
            $.ajax({
                type: 'POST',
                url: 'mainclass.php',
                data: 'newame=' + newame + '&radio=' + radio + '&form=savenewamenitiesref',
                success: function(data)
                {
                    if(data == 1)
                    {
                        loadaddedameni();
                    }
                }
            })

        }
        else
        {
            showmodal("alert", "All fields are required to be filled.", "", null, "", null, "0");
        }
    }

    function loadaddedameni()
    {
        var amenities = "WHERE ";
        var i = 0;
        $("#tblamenitiesreflist .amenities_chk").each(function(){
            var values = $(this).attr("value");
            i++;
            if(i == 1)
            {
                amenities += "amenitiesid != '"+values+"' ";
            }
            else
            {
                amenities += "AND amenitiesid != '"+values+"' ";
            }
            
        });

        $.ajax({
            type: 'POST',
            url: 'mainclass.php',
            data: 'amenities=' + amenities + '&form=loadaddedameni',
            success: function(data)
            {
                $( data ).appendTo( "#tblamenitiesreflist" );
                $("input[name='count_type']").prop("selected", false);
                $("#txtaddnewrefame").val("");
                numonly()
            }
        })
    }

    function configuremall(id)
    {
        $("#txtmall_id").val(id);
        loadwingdetails();
        loadmallls2();
        loadclassrls2();
        loadwingdet();
        loadmallls2();
        loadwing();
        loadunit();
        loadfloors();
        $("#mallconfdiv").css("display", "block");
        $("#mallneweditdiv").css("display", "none");
        $("#btnmallupdateeee").css("display", "none");
        $("#modalconfiguremodal").modal("show");
        $("#div_tex_header_con").text("Configuration");
    }

   function showimg123(){
     var oFReader = new FileReader();
     oFReader.readAsDataURL(document.getElementById("file_upload").files[0]);
    
     
     oFReader.onload = function (oFREvent) {
         document.getElementById("img_mallinfo").src = oFREvent.target.result;
     };
   }

    function newmall()
    {
        $.ajax({
            type: 'POST',
            url: 'mainclass.php',
            data: 'form=maxmallcount',
            success: function(data){
                var mc = $("#currentmallcount").val();
                if(mc < data ){
                    $(".mall-info").val("");
                    $("#txtmall_id").val("");
                    $("#img_mallinfo").prop("src", "assets/images/avatars/noimage.png");
                    $("#posting_profilepic").css("display", "inline");
                    $("#btn_changedp").css("display", "none");
                    $("#mallconfdiv").css("display", "none");
                    $("#mallneweditdiv").css("display", "block");
                    $("#btnmallupdateeee").css("display", "block");
                    $("#modalconfiguremodal").modal("show");
                    $("#div_tex_header_con").text("New Mall");
                    $("#posting_profilepic").html('<div style="display: none;"><input type="text" id="txtmallid_forms" name="txtmallid_forms"></div><input id="file_upload" name="attachment_profilepic" class="form-control upload_app_req" type="file" style="margin-top: 20px;" onchange="showimg123();"/>');
                    filecss();
                }
                else{
                    showmodal("alert", "Maximum number of mall already reached.", "", null, "", null, "0");
                }
            }
        })
    }

    function editmall(id)
    {
        $("#txtmall_id").val(id);
        $("#mallconfdiv").css("display", "none");
        $("#mallneweditdiv").css("display", "block");
        $("#btnmallupdateeee").css("display", "block");
        $("#posting_profilepic").html('<div style="display: none;"><input type="text" id="txtmallid_forms" name="txtmallid_forms"></div><input id="file_upload" name="attachment_profilepic" class="form-control upload_app_req" type="file" style="margin-top: 20px;" onchange="showimg123();"/>');
        
        $.ajax({
            type: 'POST',
            url: 'mainclass.php',
            data: 'id=' + id + '&form=editmallinformation',
            success: function(data)
            {
                var arr = data.split("|");
                if(arr[4] == "server/mall_image/")
                {
                    $("#img_mallinfo").prop("src", "assets/images/avatars/noimage.png");
                    $("#posting_profilepic").css("display", "inline");
                    $("#btn_changedp").css("display", "none");

                }
                else
                {
                    $("#img_mallinfo").prop("src", arr[4]);
                    $("#posting_profilepic").css("display", "none");
                    $("#btn_changedp").css("display", "inline");
                }

                $("#txtmall_name").val(arr[1]);
                $("#txtmall_loc").val(arr[2]);
                $("#txtmall_abouts").val(arr[3]);
                $("#txtmall_telephone").val(arr[5]);
                $("#txtmall_email").val(arr[6]);
                filecss();
                $("#modalconfiguremodal").modal("show");
                $("#div_tex_header_con").text("Edit Mall");
            }
        })
    }

    function updateaccdp()
    {
      $("#posting_profilepic").css("display", "inline");
      $("#btn_changedp").css("display", "none");
    }

    function savemallupdate(){
        
        var id = $("#txtmall_id").val();
        var name = $("#txtmall_name").val();
        var loc = $("#txtmall_loc").val();
        var abouts = $("#txtmall_abouts").val();
        var telephone = $("#txtmall_telephone").val();
        var email = $("#txtmall_email").val();

        var countinput = 0;
        $("#modalconfiguremodal .required").each(function() {
            if($(this).val() == ""){
                countinput = countinput +1;
            }
        })

        if(countinput == 0){
            $.ajax({
                type: 'POST',
                url: 'mainclass.php',
                data: 'id=' + id + '&name=' + name + '&loc=' + loc + '&abouts=' + abouts + '&telephone=' + telephone + '&email=' + email + '&form=savemallupdate',
                success: function(data)
                {
                    var arr = data.split("|");
                    if(arr[0] == "2")
                    {
                        showmodal("alert", "Mall successfully modified.", "", null, "", null, "0");
                        sendData(arr[1])
                        $("#modalconfiguremodal").modal("hide");
                    }
                    else if(arr[0] == "1")
                    {
                        showmodal("alert", "Mall successfully added.", "", null, "", null, "0");
                        sendData(arr[1]);
                        $(".mall-info").val("");
                        $("#txtmall_id").val("");
                        $("#img_mallinfo").prop("src", "assets/images/avatars/noimage.png");
                        $("#posting_profilepic").css("display", "inline");
                        $("#btn_changedp").css("display", "none");
                        $("#mallconfdiv").css("display", "none");
                        $("#mallneweditdiv").css("display", "block");
                        $("#div_tex_header_con").text("New Mall");
                        $("#posting_profilepic").html('<div style="display: none;"><input type="text" id="txtmallid_forms" name="txtmallid_forms"></div><input id="file_upload" name="attachment_profilepic" class="form-control upload_app_req" type="file" style="margin-top: 20px;" onchange="showimg123();"/>');
                        filecss();
                        loadmallcurrentmallcount();
                        $("#modalconfiguremodal").modal("hide");
                    }
                }
            })
        }
        else{
            showmodal("alert", "All fields are required to be filled.", "", null, "", null, "0");
        }
    }

    function deletemall(id){
        $("#dimakita").val(id);
        showmodal("confirm", "Deactivate this mall?", "deletemall2", null, "", null,0);
    }

    function deletemall2(){
        var id = $("#dimakita").val();
            $.ajax({
                type: 'POST',
                url: 'mainclass.php',
                data: 'id=' + id + '&form=deletemall',
                success: function(data){
                    if(data == 1){
                    setTimeout(function(){
                        showmodal("alert", "Mall successfully deactivated.", "loadmalls", null, "", null, 0);
                    }, 1000)
                    }
                }
            })        
    }

    function reactivate(id){
        $("#dimakita").val(id);
        showmodal("confirm", "Deactivate this mall?", "reactivate2", null, "", null,0);
    }

    function reactivate2(){
        var id = $("#dimakita").val();
            $.ajax({
                type: 'POST',
                url: 'mainclass.php',
                data: 'id=' + id + '&form=reactivate',
                success: function(data){
                    if(data == 1){
                    setTimeout(function(){
                        showmodal("alert", "Mall successfully reactivated.", "loadmalls", null, "", null, 0);
                    }, 1000)
                    }
                }
            })        
    }

    function sendData(mallid){
    $("#txtmallid_forms").val(mallid);
    var data = new FormData($('#posting_profilepic')[0]);
    $.ajax({
      type:"POST",
      url:"setup/mall_configuration/uploadmallpic.php",
      data: data,
      mimeType: "multipart/form-data",
      contentType: false,
      cache: false,
      processData: false,
      success:function(data){
        loadmalls();
        // closemodal("uploadattach");
      }
    });
  }



  function filecss()
 {        
    var tag_input = $('#form-field-tags');
        try{
          tag_input.tag(
            {
            placeholder:tag_input.attr('placeholder'),
            //enable typeahead by specifying the source array
            source: ace.vars['US_STATES'],//defined in ace.js >> ace.enable_search_ahead
            /**
            //or fetch data from database, fetch those that match "query"
            source: function(query, process) {
              $.ajax({url: 'remote_source.php?q='+encodeURIComponent(query)})
              .done(function(result_items){
              process(result_items);
              });
            }
            */
            }
          )
      
          //programmatically add/remove a tag
          var $tag_obj = $('#form-field-tags').data('tag');
          // $tag_obj.add('Programmatically Added');
          
          var index = $tag_obj.inValues('some tag');
          $tag_obj.remove(index);
        }
        catch(e) {
          //display a textarea for old IE, because it doesn't support this plugin or another one I tried!
          tag_input.after('<textarea id="'+tag_input.attr('id')+'" name="'+tag_input.attr('name')+'" rows="3">'+tag_input.val()+'</textarea>').remove();
          //autosize($('#form-field-tags'));
        }

        $('.upload_app_req').ace_file_input({
          no_file:'No File ...',
          btn_choose:'Choose',
          btn_change:'Change',
          droppable:false,
          onchange:null,
          thumbnail:false //| true | large
          //whitelist:'gif|png|jpg|jpeg'
          //blacklist:'exe|php'
          //onchange:''
          //
        });
}

    function loadmallcurrentmallcount(){
            $.ajax({
                type: 'POST',
                url: 'mainclass.php',
                data: 'form=loadmallcount',
                success: function(data){
                    $("#currentmallcount").val(data);
                }
            })
    }
</script>
<?php include("setup_billing.php"); ?>

