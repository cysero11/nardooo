<style>
.parent {
    height: 50vh;
}

    
</style>


<!-- ============ MODAL Terms & Condition with Checkbox ============= -->
<div class="modal fade" id="modal_tnccheckbox" role="dialog">
  <div class="modal-dialog modal-lg">
  
    <!-- Modal content-->
    <div class="modal-content">

      <!-- Modal header-->
      <div class="modal-header" style="background-color: #438EB9;">
        <button type="button" class="close" data-dismiss="modal" onclick="unloadmodal_tnccheckbox()">&times;</button>
        <h4 class="modal-title" style="color:white; font-weight: bold;">Terms and Conditions</h4>
        <input type="hidden" class="tncmodal" id="tncmodal" name="">
      </div>

       <!-- Modal body-->
<div class="container-fluid">
      <div class="row form-group">
        <div class="col-md-3 col-xs-12 col-lg-3" style="padding-top: 5px;">
                  <b >Filter by Group Name:</b>
        </div>
        <div class="col-md-4 col-xs-12 col-lg-4" style="padding-top: 5px;">
          <!-- <input list="list_group" id="groupdd" class="form-control txttac" type="text" li="txtbuss" placeholder=" Select Group" /> -->
                    <select id="selectfilterdisplay"  onchange="selectfilter(this.value);" class="form-control required">
                      <option onclick="displaytnc()">Display all</option>
                    </select>

        </div>
      </div>
<div class="row">
  <div class="col-xs-12">
    <div class="row form-group" style="margin-bottom: 0px !important;">
      <div class="col-xs-12">
        <div class="parent">
        <table id="simple-table" class="table  table-bordered table-hover fixTable" style="display:  block;">
                    <thead>
                        <tr>
                            <!-- <td width="3%">&nbsp;</td> -->
                            <td width="15%">Group Name</td>
                            <td width="20%">Term Name</td>
                            <td width="35%">Condition</td>
                            <td width="10%">Status</td>
                        </tr>
                    </thead>
              <tbody id="displaytnc"></tbody>
          </table>
          </div>
        <table class="tabledash_footer table" style="margin: 0px !important;">
            <thead>
                <tr>
                    <th id="th_tabledash_footer" width="" colspan="7" style="width: 911px;">
                    <font style="float: left; color: #777 !important;margin-top: 17px;margin-left: 15px;font-weight: normal;font-weight: 8px !important;" id="txttnc"></font>
                        <div class="pagination">
                            <ul id=""></ul>
                        </div>
                    </th>
                </tr>
            </thead>
        </table>
      </div>
    </div>

  </div>
</div>
</div>

       <!-- Modal footer-->
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" onclick="addselectedtnc()"><i class="ace-icon fa fa-check"></i>&nbsp;Add Selected</button>
      </div>
    </div>
    
  </div>
</div>

<input id="inqid" type="hidden">
</script>