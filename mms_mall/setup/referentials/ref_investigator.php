
<script>
$(function(){
    $("#txt_investigatorpage").val("1");
    loadinvestigator();
    $("#tblinvestigatorlist").niceScroll({cursorcolor:"#999"});
});

    function loadinvestigator()
        {
            var key = $("#txtscrinvest").val();
            var page = $("#txt_investigatorpage").val();
            $.ajax({
                type: 'POST',
                url: 'mainclass.php',
                data: 'key=' + key + '&page=' + page + '&form=loadinvestigator',
                success: function(data){
                    $("#tblinvestigatorlist").html(data);
                    $(".scroll").niceScroll({cursorcolor:"#999"});
                    loadpaginationinvest();
                    loadentriesinvest();                    
                }

            });
        }

    function loadpaginationinvest() //added by melanie
        {
            var key = $("#txtscrinvest").val();
            var page = $("#txt_investigatorpage").val();
            $.ajax({
                type: 'POST',
                url: 'mainclass.php',
                data: 'key=' + key + '&page=' + page + '&form=loadpaginationinvest',
                success: function(data){
                    $("#ulpaginationinve").html(data);
                }
            }).error(function() {
                alert(data);
            });
        }

    function getvalinve(page, pagenums) //added by melanie
        {
            // alert(page);
                $(".pgnumptnts").removeClass("active");
                var value = "#" + pagenums;
                $("#pgptnts" + pagenums).addClass("active");
                $("#txt_investigatorpage").val(page);
                // reloadhmo();
                loadinvestigator();
                loadpaginationinvest();
                loadentriesinvest();
        }

    function loadentriesinvest() //added by melanie
        {
            var key = $("#txtscrinvest").val();
            var page = $("#txt_investigatorpage").val();
            $.ajax({
                type: 'POST',
                url: 'mainclass.php',
                data: 'key=' + key + '&page=' + page + '&form=loadentriesinvest',
                success: function(data){
                    if(data == "no data")
                    {
                        $("#txtinveentries").text("");
                    }
                    else
                    {
                        $("#txtinveentries").text(data);
                    }
                }
            }).error(function() {
                alert(data);
            });
        }                       

 function delbmref(bm)
      {
        var conf = confirm("Are you sure you want to delete this investigator?");
        if(conf == true)
        {
                $.ajax({
                    type: 'POST',
                    url: 'mainclass.php',
                    data: 'id=' + bm + '&form=delbmref',
                    success: function(data)
                    {
                            // loadalert()
                            alert(data);
                            loadinvestigator();
                    }
                })  
        }
      }

function editbmref(bm)
      {
        $.ajax({
            type: 'POST',
            url: 'mainclass.php',
            data: 'id=' + bm + '&form=editbmref',
            success: function(data)
            {
                var arr = data.split("|");
                    $("#txtbmid").val(arr[1])
                    $("#txtinvestigatorlname").val(arr[2]);
                    $("#txtinvestigatorfname").val(arr[3]);
                    $("#txtinvestigatormname").val(arr[4]);
                    $("#txtinvestigatorpos").val(arr[5]);
                    $("#txtinvestigatorusername").val(arr[6]);
                    $("#txtinvestigatorpass").val(arr[7]);
                    $("#investigator").modal("show");
            }
        })
      }

    function newinvestigator()
    {
        var refbmlastname = $("#txtinvestigatorlname").val();
        var refbmfirstname = $("#txtinvestigatorfname").val();
        var refbmmiddlename = $("#txtinvestigatormname").val();
        var refbmposition = $("#txtinvestigatorpos").val();
        var refbmusername = $("#txtinvestigatorusername").val();
        var refbmpassword = $("#txtinvestigatorpass").val();
        var bmid = $("#txtbmid").val();
        if(refbmlastname == "" || refbmfirstname == "" )
        { alert("Please fill-up all the informations."); }
        else
        {
        var conf = confirm("Save New Investigator information?");
        if (conf == true) 
        {
            $.ajax({
                type: 'POST',
                url: 'mainclass.php',
                data: 'refbmlastname=' + refbmlastname + '&refbmfirstname=' + refbmfirstname + '&refbmmiddlename=' + refbmmiddlename +  '&refbmposition=' + refbmposition + '&refbmusername=' + refbmusername + '&refbmpassword=' + refbmpassword + '&bmid=' + bmid + '&form=newinvestigator',
                success: function(data) {
                        if(data == "Investigator successfully modified.")
                        {
                            alert(data);
                            $("#investigator").modal("hide");
                            loadinvestigator();
                        }
                        else
                        {
                            alert(data);
                            $(".text_investigator").val("");
                            loadinvestigator();
                        }
                        
                }
            });
        }
        }
    }
</script>
<style>

</style>
<div class="row">
    <div class="col-xs-12" style="padding: 10px !important;">
        <div class="pull-left" style="padding-top:10px;">
            <b class="text-primary" style="margin-top: 15px !important;">Investigator List</b>
            <input type="hidden" id="txt_investigatorpage" name="">
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-4 col-xs-12">
        <!-- <form class="form-search"> -->
            <span class="input-icon" style="width: 100%;">
                <input type="text" class="form-control" placeholder="Search ..." id="txtscrinvest" onkeyup="loadinvestigator()">
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
            <a href="#" id="btn_investigator" class="btn btn-default btn-sm" style="width: 100% !important;" onclick="loadmodal_investigator()">New Investigator</a>
    </div>  
</div>
<div class="row" style="padding: 10px !important;overflow-x: auto;">
    <table id="simple-table" class="table table-bordered table-hover" style="display: flex;flex-flow: column;height: 100%;width: 100%;margin-bottom: 0px !important;">
        <thead style="flex: 0 0 auto;width: calc(100%);">
            <tr style="display: table;table-layout: fixed;width: 100%;display: table;">
                <!-- <th class="center">
                    <label class="pos-rel">
                        <input type="checkbox" class="ace" />
                        <span class="lbl"></span>
                    </label>
                </th> -->
                <th class="hide_mobile">Investigator ID</th>
                <th>Last Name</th>
                <th>First Name</th>
                <th class="hide_mobile">Middle Name</th>
                <th class="hide_mobile">Position</th>
                <th class="hide_mobile">Username</th>   
                <th>Option</th>                                                         
            </tr>
        </thead>
        <tbody id="tblinvestigatorlist" style="flex: 1 1 auto;display: block;height: 16em;">

        </tbody>
    </table>
        <table class="tabledash_footer table" style="margin: 0px !important;">
        <thead>
            <tr>
                <th id="th_tabledash_footer" width="" colspan="7" style="width: 911px;">
                <font style="float: left; color: #777 !important;margin-top: 17px;margin-left: 15px;font-weight: normal;font-weight: 8px !important;" id="txtinveentries"></font>
                    <div class="pagination">
                        <ul id="ulpaginationinve"></ul>
                    </div>
                </th>
            </tr>
        </thead>
</div>

<!-- =============================================  dialog ============================================ -->
<div id="dialog-investigator" class="hide">
</div>
<!-- ====================================================================================================== -->
<!-- Modal -->
  <div class="modal fade" id="investigator" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Investigator</h4>
          <input type="hidden" id="txtbmid" class="text_investigator" name="">
        </div>
        <div class="modal-body">
            <div class="row form-group">
                <label class="col-sm-3 col-xs-12 control-label no-padding-right" for="form-field-1"> Last Name </label>

                <div class="col-sm-9 col-xs-12">
                    <input type="text" id="txtinvestigatorlname" class="form-control text_investigator" placeholder="Lastname">
                </div>
            </div>
            <div class="row form-group">
                <label class="col-sm-3 col-xs-12 control-label no-padding-right" for="form-field-1"> First Name </label>

                <div class="col-sm-9 col-xs-12">
                    <input type="text" id="txtinvestigatorfname" class="form-control text_investigator" placeholder="Firstname">
                </div>
            </div>
            <div class="row form-group">
                <label class="col-sm-3 col-xs-12 control-label no-padding-right" for="form-field-1"> Middle Name </label>

                <div class="col-sm-9 col-xs-12">
                    <input type="text" id="txtinvestigatormname" class="form-control text_investigator" placeholder="Middlename">
                </div>
            </div>
            <div class="row form-group">
                <label class="col-sm-3 col-xs-12 control-label no-padding-right" for="form-field-1"> Position </label>

                <div class="col-sm-9 col-xs-12">
                <select class="form-control text_investigator" id="txtinvestigatorpos" style="height: 34px;">
                    <option value="">Select Investigator Position</option>
                    <?php
                    include_once("connect.php");
                        $getcardtype = "SELECT investigatorpos from tblref_investigatorpos order by id";
                        $resultgetcardtype = mysql_query($getcardtype, $connection);
                        while($cardtype = mysql_fetch_array($resultgetcardtype))
                        { echo "<option value=".$cardtype[0].">" . $cardtype[0] . "</option>"; }
                    ?>
                </select>
                </div>
            </div>
            <div class="row form-group">
                <label class="col-sm-3 col-xs-12 control-label no-padding-right" for="form-field-1"> Username </label>

                <div class="col-sm-9 col-xs-12">
                    <input type="text" id="txtinvestigatorusername" class="form-control text_investigator" placeholder="Username">
                </div>
            </div>
            <div class="row form-group">
                <label class="col-sm-3 col-xs-12 control-label no-padding-right" for="form-field-1"> Password </label>

                <div class="col-sm-9 col-xs-12">
                    <input type="Password" id="txtinvestigatorpass" class="form-control text_investigator" placeholder="Password">
                </div>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" onclick="newinvestigator()"><i class="ace-icon fa fa-check"></i>&nbsp;Save</button>
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

function loadmodal_investigator()
{
    $("#investigator").modal("show");
    $(".text_investigator").val("");
}
</script>