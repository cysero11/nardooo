<!-- ============ MODAL NewGroup ============= -->
<div class="modal fade" id="modal_newgroup" role="dialog" area-hidden="true" data-backdrop="static">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header btn-primary" style="margin-bottom: 10px;padding-top:10px;padding-bottom: 10px;">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" style="font-family: Roboto;font-size: 18px;">Terms & Condition</h4>
        <input type="hidden" class="txtup" id="txttac" name="">
      </div>

       <div class="modal-body"  id="modal-body-group">
          <div class="container-fluid">
            <div class="row form-group">
              <div class="col-md-3 col-xs-12">
                    Group:
              </div>
              <div class="col-md-8 col-xs-12">
                <select id="groupdd" onchange="selectgroup(this.value);" class="form-control required"></select>
              </div>
              <button onclick="loadmodal_addgroup()" id="addgroup" class="col-md-1 btn spinbox-up btn-sm btn-primary pull-right"><span class="glyphicon glyphicon-plus"></span></button>  
            </div> 

            <div class="row form-group">
              <div class="col-md-3 col-xs-12">
                    Terms:
              </div>
              <div class="col-md-9 col-xs-12">
                  <input type="text" id="txttac_terms" name="" class="form-control required txttac" placeholder="Term Name">
              </div>                     
            </div> 

            <div class="row form-group">
              <div class="col-md-3 col-xs-12">
                Condition:
              </div>
              <div class="col-md-9 col-xs-12">
                <fieldset>
                  <textarea class="width-100 txttac required " resize="none" id="txttac_condition" placeholder="Conditions"></textarea>
                </fieldset>
              </div>
            </div>
           </div>

        </div>  
          <div class="modal-footer">
            <button type="button" class="btn btn-primary" onclick="saveterms()"><i class="ace-icon fa fa-check"></i>&nbsp;Save</button>
          </div>                                     
      </div>
    </div>
  </div>



<!-- ============ MODAL ADD GROUP ============= -->
<div class="modal fade" id="modal_addgroup" role="dialog" area-hidden="true" data-backdrop="static">
  <div class="modal-dialog">
  
    <!-- Modal content-->
    <div class="modal-content">

       <!-- Modal header-->
      <div class="modal-header btn-primary" style="margin-bottom: 10px;padding-top:10px;padding-bottom: 10px;">
        <button type="button" class="close" data-dismiss="modal" onclick="unloadmodal_addgroup()">&times;</button>
        <h4 class="modal-title"  style="font-family: Roboto;font-size: 18px;">Terms & Condition</h4>
        <input type="hidden" class="txttac" id="txttac" name="">
      </div>

       <!-- Modal body-->      
       <div class="modal-body"  id="modal-body-group">
          
          <!-- Group Name -->
          <div class="container-fluid">
            <div class="row form-group">
              <div class="col-md-3 col-xs-12">
                    Group Name:
              </div>
              <div class="col-md-9 col-xs-12">
                  <input type="text" id="txttac_group" name="" class="form-control txttac" placeholder="Group Name">
              </div> 
                          
           </div>

          </div>                                       
        <!--  -->
      </div>

       <!-- Modal footer-->
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" onclick="savegroup()"><i class="ace-icon fa fa-check"></i>&nbsp;Save</button>
      </div>
    </div>
    
  </div>
</div>

<!-- ============ MODAL EDIT Group ============= -->
<div class="modal fade" id="modal_editgroup" role="dialog" area-hidden="true" data-backdrop="static">
  <div class="modal-dialog">
  
    <!-- Modal content-->
    <div class="modal-content">

       <!-- Modal header-->
      <div class="modal-header btn-primary" style="margin-bottom: 10px;padding-top:10px;padding-bottom: 10px;">
        <button type="button" class="close" data-dismiss="modal" onclick="unloadmodal_editgroup()">&times;</button>
        <h4 class="modal-title" style="font-family: Roboto;font-size: 18px;">Terms & Condition</h4>
        <input type="hidden" class="txttac" id="txttac" name="">
      </div>

       <!-- Modal body-->      
       <div class="modal-body"  id="modal-body-group">
          <!-- TENANT INFORMATION -->
          <div class="container-fluid">
            <div class="row form-group">
              <div class="col-md-3 col-xs-12">
                    Group:
              </div>
              <div class="col-md-9 col-xs-12">
                <input type="text" id="groupdd2" class="form-control txtup erequired" placeholder="Group Name">
              </div>  
            </div> 

            <div class="row form-group">
              <div class="col-md-3 col-xs-12">
                    Terms:
              </div>
              <div class="col-md-9 col-xs-12">
                  <input type="text" id="update_terms" name="" class="form-control erequired txtup" placeholder="Term Name">
              </div>                     
            </div> 

            <div class="row form-group">
                <div class="col-md-3 col-xs-12">
                  Condition:
                </div>
                <div class="col-md-9 col-xs-12">
                  <fieldset>
                    <textarea class="width-100 txtup erequired " resize="none" id="update_condition" placeholder="Conditions"></textarea>
                  </fieldset>
                </div>
            </div>
                <div class="row form-group">
                  <div class="col-md-3 col-xs-12">
                        Status:
                  </div>
                  <div class="col-md-9 col-xs-12">
                    <input type="radio" name="stats" value="1" id="1" class="stats"> Active
                    <input type="radio" name="stats" value="0" id="0" class="stats"> Inactive
                  </div>
                </div>                
           </div>

          </div> 
          <div class="modal-footer">
        <button type="button" class="btn btn-primary" onclick="updategroup()"><i class="ace-icon fa fa-check"></i>&nbsp;Update</button>
      </div>
      </div>

       <!-- Modal footer-->
      
    </div>
  </div>


 <script type="text/javascript">
//   function addcons() {
//     $("#appending").append('<div class="col-md-offset-3 col-md-9 conditionssss appended" style="padding-top: 3px;">' +
//                       '<input type="text" id="txttac_conditions" name="" class="form-control txtup cons" placeholder="Conditions">' +
//                   '</div>');
//   }


// </script>