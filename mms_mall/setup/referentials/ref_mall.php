<script>
$(function(){
    $("#txt_mallpage").val("1");
    loadmall();
    $("#tblmalllist").niceScroll({cursorcolor:"#999"});
});

function loadmall()
        {
            var key = $("#txtsearchmallref").val();
            var page = $("#txt_mallpage").val();
            $.ajax({
                type: 'POST',
                url: 'mainclass.php',
                data: 'key=' + key + '&page=' + page + '&form=loadmall',
                success: function(data){
                    $("#tblmalllist").html(data);
                    $(".scroll").niceScroll({cursorcolor:"#999"});
                    loadpaginationmall();
                    loadentriesmall();
                }

            });
        }

    function loadpaginationmall() //added by melanie
        {
            var key = $("#txtsearchmallref").val();
            var page = $("#txt_mallpage").val();
            $.ajax({
                type: 'POST',
                url: 'mainclass.php',
                data: 'key=' + key + '&page=' + page + '&form=loadpaginationmall',
                success: function(data){
                    $("#ulpaginationmall").html(data);
                }
            }).error(function() {
                alert(data);
            });
        }

    function getvalmall(page, pagenums) //added by melanie
        {
            // alert(page);
                $(".pgnumptnts").removeClass("active");
                var value = "#" + pagenums;
                $("#pgptnts" + pagenums).addClass("active");
                $("#txt_mallpage").val(page);
                // reloadhmo();
                loadmall();
                loadpaginationmall();
                loadentriesmall();
        }

    function loadentriesmall() //added by melanie
        {
            var key = $("#txtsearchmallref").val();
            var page = $("#txt_mallpage").val();
            $.ajax({
                type: 'POST',
                url: 'mainclass.php',
                data: 'key=' + key + '&page=' + page + '&form=loadentriesmall',
                success: function(data){
                    if(data == "no data")
                    {
                        $("#txtmallentries").text("");
                    }
                    else
                    {
                        $("#txtmallentries").text(data);
                    }
                }
            }).error(function() {
                alert(data);
            });
        }               

function delmallref(mall)
    {
        var conf = confirm("Are you sure?");
        if(conf == true)
        {
            $.ajax({
                type: 'POST',
                url: 'mainclass.php',
                data: 'id=' + mall + '&form=delmallref',
                success: function(data)
                {
                        alert(data);
                        loadmall();
                }
            })      
        }
    }

    function editmallref(mall)
    {
        $.ajax({
            type: 'POST',
            url: 'mainclass.php',
            data: 'id=' + mall + '&form=editmallref',
            success: function(data)
            {
                    var arr = data.split("|");
                    $("#txtmallid").val(arr[1]);
                    $("#txtmallname").val(arr[2]);
                    $("#txtmalladdress").val(arr[3]);
                    $("#new_mall").modal("show");
            }
        })
    }

function addnewmall()
    {
        var mallid = $("#txtmallid").val();
        var str = "";
        var str2 = "";
        if(mallid == "")
        {
            str = "Save Mall?";
            str2 = "Mall has been saved";
        }
        else
        {
            str = "Update Mall?";
            str2 = "Mall has been updated";
        }
        var conf = confirm(str);
        if(conf == true)
        {
            var mallid = $("#txtmallid").val();
            var mallname = $("#txtmallname").val();
            var malladdress = $("#txtmalladdress").val();
        
            $.ajax({
                type: 'POST',
                url: 'mainclass.php',
                data: 'mallid=' + mallid + '&mallname=' + mallname  +  '&malladdress=' + malladdress  +  '&form=addnewmall',
                success: function(data) {
                    if(data == "Successfully modified.")
                    {
                        alert(data);
                        loadmall();
                        $(".text_mall").val("");
                        $("#new_mall").modal("hide");
                    }
                    else
                    {
                        alert(data);
                        loadmall();
                        $(".text_mall").val("");
                    }
                    
                
                }
            });
        }
    }
</script>
<div class="row">
    <div class="col-xs-12" style="padding: 10px !important;">
        <div class="pull-left" style="padding-top:10px;">
            <b class="text-primary" style="margin-top: 15px !important;">Mall List</b>
            <input type="hidden" id="txt_mallpage" name="">
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-4 col-xs-12">
        <!-- <form class="form-search"> -->
            <span class="input-icon" style="width: 100%;">
                <input type="text" class="form-control" placeholder="Search ..." id="txtsearchmallref" onkeyup="loadmall()">
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
            <a href="#" id="btn_mall" class="btn btn-default btn-sm" style="width: 100% !important;" onclick="loadmodal_mall()">New Mall</a>
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
                <th class="hide_mobile">Mall ID</th>
                <th class="scroll">Mall</th>
                <th class="scroll">Mall Address</th>
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
                <font style="float: left; color: #777 !important;margin-top: 17px;margin-left: 15px;font-weight: normal;font-weight: 8px !important;" id="txtmallentries"></font>
                    <div class="pagination">
                        <ul id="ulpaginationmall"></ul>
                    </div>
                </th>
            </tr>
        </thead>
</div>

<!-- =============================================  dialog ============================================ -->
<div id="dialog-mall" class="hide">
</div>
<!-- ====================================================================================================== -->
<!-- Modal -->
  <div class="modal fade" id="new_mall" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Mall</h4>
          <input type="hidden" id="txtmallid" class="text_mall" name="">
        </div>
        <div class="modal-body">
            <div class="row form-group">
                <label class="col-sm-3 col-xs-12 control-label no-padding-right" for="form-field-1"> Mall </label>

                <div class="col-sm-9 col-xs-12">
                    <input type="text" id="txtmallname" class="form-control text_mall" placeholder="Mall">
                </div>
            </div>
            <div class="row form-group">
                <label class="col-sm-3 col-xs-12 control-label no-padding-right" for="form-field-1"> Mall Address </label>

                <div class="col-sm-9 col-xs-12">
                    <textarea id="txtmalladdress" class="form-control text_mall" placeholder="Mall Address"></textarea>
                </div>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" onclick="addnewmall()"><i class="ace-icon fa fa-check"></i>&nbsp;Save</button>
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

function loadmodal_mall()
{
    $("#new_mall").modal("show");
    $(".text_mall").val("");
}
</script>