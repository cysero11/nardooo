<!-- ============ MODAL REFERENTIAL ============= -->
  <div class="modal fade bd-example-modal-sm" id="modal_new_referential" role="dialog" area-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-sm">   
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-body">
          <button type="button" class="close" onclick="closemodalref()">&times;</button>
          <h4 class="modal-title" id="txtref_name">Select Amenity</h4>
            
            <div class="row form-group">
                <div class="col-xs-12 col-md-12">
                    <table table id="simple-table" class="table  table-bordered table-hover" style="display: flex;flex-flow: column;height: 100%;width: 100%;margin-top: 10px !important;">
                        <tbody id="tblreflist" style="flex: 1 1 auto;display: block;height: 20em;overflow-x: hidden;">

                        </tbody>
                    </table>
                    <hr />
                    <h6 class="modal-title" id="txtref_name2">New Amenity</h6>
                    <h6 class="modal-title" style="font-size: 10px;font-style: italic;">(if not on the list)</h6>
                    <div class="input-group">
                        <input type="text" id="txtaddnewreferential" style="" class="form-control" name="" placeholder="Add New" style="margin-top: 10px">  
                        <div class="spinbox-buttons input-group-btn">         
                           <button type="button" class="btn btn-success" id="btnnewreferential" onclick="" style="height: 34px;padding-top:2px;">&nbsp;Add</button>            
                            <i class="icon-only  ace-icon ace-icon fa fa-plus bigger-110"></i>          
                          </button>       
                        </div>
                    </div>
                </div>
            </div>
        </div>
      </div>
      
    </div>
  </div> 

<script>
  function loadreferentialmodal(type) {
    if(type == "position")
    {
      $("#txtref_name").text("Company Position");
      $("#txtref_name2").text("New Position");
      $("#btnnewreferential").attr("onclick", "savenewreferential('position')")
      $("#txtaddnewreferential").attr("placeholder", "Position Name");
    }
    else if(type == "industry")
    {
      $("#txtref_name").text("Industry");
      $("#txtref_name2").text("New Industry");
      $("#btnnewreferential").attr("onclick", "savenewreferential('industry')")
      $("#txtaddnewreferential").attr("placeholder", "Industry Name");
    }
    tblreflist(type)
    $("#modal_new_referential").modal("show");
  }

  function tblreflist(type)
  {
    $.ajax({
      type: 'POST',
      url: 'mainclass.php',
      data: 'type=' + type + '&form=tblreflist',
      success: function(data)
      {
        $("#tblreflist").html(data);
      }
    })
  }

  function savenewreferential(type)
  {
    var ref = $("#txtaddnewreferential").val();
    if(ref == "" || ref.match(/^\s*$/))
    {
      alert("Fill required field!");        
      $("#txtaddnewreferential").css("border-color", "#f2a696");  
      $("#txtaddnewreferential").val("");
      $("#txtaddnewreferential").focus();
    }
    else
    {
      $.ajax({
        type: 'POST',
        url: 'mainclass.php',
        data: 'type=' + type + '&ref=' + ref + '&form=savenewreferential',
        success: function(data)
        {
          if(data == 1)
          {
            $("#txtaddnewreferential").css("border-color", "#d5d5d5");
            alert("Successfully Added.");
            tblreflist(type);
            if(type == "industry")
            {
              loadindustry2(ref);            
            }
            else if(type == "position")
            {
              loadcompanyposition2(ref);
            }          
          }
          else if(data == 2)
          {
            alert("Already exisiting!");        
            $("#txtaddnewreferential").css("border-color", "#f2a696");  
            $("#txtaddnewreferential").val("");
            $("#txtaddnewreferential").focus();
          }
        }
      })   
    } 
  }

function loadindustry2(ref)
{

    $.ajax({
        type: 'POST',
        url: 'mainclass.php',
        data: 'form=loadindustry',
        success: function(data)
        {
          $("#txtaddnewreferential").css("border-color", "#d5d5d5");
          $("#txtcomp_industry").html(data);
          $("#txtcomp_industry").val(ref);
          $("#txtaddnewreferential").val("");
          $("#txtaddnewreferential").focus();
        }
    })    

}

function loadcompanyposition2(ref)
{

    $.ajax({
        type: 'POST',
        url: 'mainclass.php',
        data: 'form=loadcompanyposition',
        success: function(data)
        {
          $("#txtaddnewreferential").css("border-color", "#d5d5d5");
          $("#txtcontact_designation").html(data);  
          $("#txtcontact_designation_update").html(data);
          $("#txtcontact_designation").val(ref); 
          $("#txtcontact_designation_update").val(ref);
          $("#txtaddnewreferential").val("");
          $("#txtaddnewreferential").focus();        
        }
    })
}

  function closemodalref()
  {
    $("#modal_new_referential").modal("hide");
  }
</script>