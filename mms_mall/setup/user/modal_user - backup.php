
<div class="modal fade" id="modal_newuser" role="dialog" area-hidden="true" data-keyboard="false" data-backdrop="static">
  <div class="modal-dialog modal-lg" style="width: 60%;">
  
    <!-- Modal content-->
    <div class="modal-content">

       <!-- Modal header-->
      <div class="modal-header" style="background-color: #438EB9;">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" style="color:white; font-weight: bold;">New User</h4>
      </div>

       <!-- Modal body-->
      <div class="modal-body">
          <div class="row form-group">
            <div class="col-md-3">
              <div class="row form-group">
                <div class="col-md-12 col-xs-12">
                    <div class="image">
                        <img class="img-thumbnail imageName form-control" src="assets/images/avatars/noimage.png" id="imguseraccount" style="border: 2px solid #bdc3c7; margin-bottom: 8px;height: 160px;">
                    </div>
                    <form name="posting_profilepic_trade" id="posting_profilepic_trade" >
                      <div style="display: none;"><input type="text" id="userID" name="userID"></div>
                        <input id="file_upload_user_img" name="attachment_profilepic" class="form-control upload" type="file" onchange="showimgtrade();" />
                    </form>
                </div>
              </div>
            </div>
            <div class="col-md-9">
              <div class="row form-group">
                <div class="col-md-3 col-xs-12">Group Access</div>
                <div class="col-md-9 col-xs-12"><select class="form-control" id="slctgroupaccess"></select></div>
              </div>
              <div class="row form-group">
                <div class="col-md-3 col-xs-12">Name</div>
                <div class="col-md-3 col-xs-12"><input type="text" id="txtuser_lname" class="form-control" name="" placeholder="Last Name"></div>
                <div class="col-md-3 col-xs-12"><input type="text" id="txtuser_fname" class="form-control" name="" placeholder="First Name"></div>
                <div class="col-md-3 col-xs-12"><input type="text" id="txtuser_mname" class="form-control" name="" placeholder="Middle Name"></div>
              </div>
              <div class="row form-group">
                <div class="col-md-3 col-xs-12">Email Address</div>
                <div class="col-md-9 col-xs-12">
                    <input type="text" id="txtuser_eaddress" class="form-control" name="" placeholder="sample@yahoo.com">
                </div>
              </div>
              <div class="row form-group">
                <div class="col-md-3 col-xs-12">Username</div>
                <div class="col-md-9 col-xs-12"><input type="text" id="txtuser_username" class="form-control" name=""></div>
              </div> 
              <div class="row form-group">
                <div class="col-md-3 col-xs-12">Password<br /></div>
                <div class="col-md-9 col-xs-12"><input type="password" id="txtuser_pass" class="form-control" name=""></div>
              </div>   
            </div>
          </div>
      </div>

       <!-- Modal footer-->
      <div class="modal-footer">
        <button type="button" id="btn_user_modal" class="btn btn-primary" onclick=""><i class="ace-icon fa fa-check"></i>&nbsp;Save</button>
      </div>
    </div>
    
  </div>
</div>

<script>
  $(function(){
    loadgaccess();
  })
  
  function showimgtrade(){
    var oFReader = new FileReader();
    oFReader.readAsDataURL(document.getElementById("file_upload_user_img").files[0]);
        
    oFReader.onload = function (oFREvent) {
        document.getElementById("imguseraccount").src = oFREvent.target.result;
    };
  }


  function loadgaccess()
  {
    $.ajax({
      type: 'POST',
      url: 'mainclass.php',
      data: 'form=loadgaccess',
      success: function(data)
      {
        $("#slctgroupaccess").html(data);
      }
    })
  }

      $('#file_upload_user_img').ace_file_input({
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

      


</script>