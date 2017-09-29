<!-- ============ MODAL INQUIRY ============= -->
<div class="modal fade" id="modal_loadcompany" role="dialog">
  <div class="modal-dialog">
  
    <!-- Modal content-->
    <div class="modal-content">

       <!-- Modal header-->
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Company List</h4>
      </div>

       <!-- Modal body-->
      <div class="modal-body" style="display: inline-block; height: 30em;" id="modal-body-inquiry">
          <div class="row form-group">
              <div class="col-md-8 col-xs-12">
                  <span class="input-icon" style="width: 100%;">
                    <input type="text" class="form-control" placeholder="Search ..." id="txtsearchinquiry" onkeyup="$('#txtinquirypages').val('1');loadinquiries()">
                    <i class="ace-icon fa fa-search nav-search-icon"></i>
                  </span>
              </div>
              <div class="col-md-4 col-xs-12">
                <a href="#" id="btn_inquiry" class="btn btn-default btn-sm" style="width: 100% !important;" onclick="newcompany()">New Company</a>
              </div> 
          </div>         
          <div class="row form-group" style="margin-bottom: 0px !important;">

              <div class="col-xs-12">
                <table id="simple-table" class="table  table-bordered table-hover" style="display: flex;flex-flow: column;height: 100%;width: 100%;margin-bottom: 0px !important;">
                      <thead style="flex: 0 0 auto;width: calc(100%);">
                        <tr style="display: table;table-layout: fixed;width: 100%;display: table;">
                          <td>Company</td>                                                    
                        </tr>
                      </thead>
                      <tbody id="tblcompanylist" style="flex: 1 1 auto;display: block;height: 19em;overflow: hidden;">

                      </tbody>
                  </table>
                <table class="tabledash_footer table" style="margin: 0px !important;">
                    <thead>
                        <tr>
                            <th id="th_tabledash_footer" width="" colspan="7" style="width: 911px;">
                            <font style="float: left; color: #777 !important;margin-top: 17px;margin-left: 15px;font-weight: normal;font-weight: 8px !important;" id="txtinquiryenties"></font>
                                <div class="pagination">
                                    <ul id="ulinquirypagination"></ul>
                                </div>
                            </th>
                        </tr>
                    </thead>
                </table>
              </div>
          </div>
      </div>

       <!-- Modal footer-->
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" onclick="saveinquiry()"><i class="ace-icon fa fa-check"></i>&nbsp;Save</button>
      </div>
    </div>
    
  </div>
</div>

<script>
function loadcompanylist() {
  $.ajax({
    type: 'POST',
    url: 'mainclass.php',
    data: 'form=loadcompanylist',
    success: function(data)
    {
      $("#tblcompanylist").html(data)
    }
  })
}

function modal_loadcompany()
{
  loadcompanylist();
  $("#modal_loadcompany").modal("show");
}

function newcompany()
{
  $("#modal_new_company").modal("show");
}
</script>