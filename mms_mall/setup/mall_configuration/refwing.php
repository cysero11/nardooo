<div class="page-header">
</div>
<div class="row">
    <div class="col-xs-12 col-sm-6" style="padding-bottom: 5px;">
        <span class="input-icon" style="width: 100%;">
            <input type="text" class="form-control" placeholder="Search Wing Name..." id="txtsearchwingref" onkeyup="loadwing()">
            <i class="ace-icon fa fa-search nav-search-icon"></i>
        </span>
    </div>
    <div class="col-xs-12 col-sm-3">
        <!-- <a href="#" id="btn_mall" class="btn btn-default btn-sm" style="width: 100% !important;" onclick="loadmodal_wing()">New Wing</a> -->
    </div>
    <div class="col-xs-12 col-sm-3">
        <a href="#" id="btn_mall" class="btn btn-default btn-sm" style="width: 100% !important;" onclick="loadmodal_wing()">New Wing</a>
    </div>
</div>

<table id="simple-table" class="table  table-bordered table-hover" style="display: flex;flex-flow: column;height: 100%;width: 100%;margin-bottom: 0px !important">
    <thead style="flex: 0 0 auto;width: calc(100%);">
        <tr style="display: table;table-layout: fixed;width: 100%;display: table;">
            <td>Wing</td>
            <td>Option</td>                                         
        </tr>
    </thead>
    <div id="div_wing_table"></div>
    <tbody id="tblwinglist" style="flex: 1 1 auto;display: block;height: 16em;overflow-x: hidden;">

    </tbody>
</table>
<table class="tabledash_footer table" style="margin: 0px !important;">
    <thead>
        <tr>
            <th id="th_tabledash_footer" width="" colspan="7" style="width: 911px;padding-bottom: 15px;padding-top: 15px;">
            <font style="float: left; color: white !important;margin-left: 15px;font-weight: normal;font-weight: 8px !important;" id="txtwingentries"></font>
                <ul id="ulpaginationwing" class="pagination pull-right"></ul>
            </th>
        </tr>
    </thead>
</table>
  <div class="modal fade" id="modal_addnewwing" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" onclick="closemodalwing()">&times;</button>
          <h4 class="modal-title">Wing</h4>
          <input type="hidden" id="txtrefwing" class="text_wing" name="">
        </div>
        <div class="modal-body">
            <div class="row form-group">
                <div class="col-md-3">
                                Wing
                </div>
                <div class="col-md-9">
                        <input type="text" class="form-control req_wing text_wing" id="txtwingname" name="">            
                </div>
            </div>  
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" onclick="savewing()"><i class="ace-icon fa fa-check"></i>&nbsp;Save</button>
        </div>
      </div>
      
    </div>
  </div>
<script>
$(function(){
    $("#txt_wingpage").val("1");
    $("#tblwinglist").niceScroll({cursorcolor:"#999"});
});

    function loadwing()
        {
            var key = $("#txtsearchwingref").val();
            var page = $("#txt_wingpage").val();
            var mallid = $("#txtmall_id").val();
            $.ajax({
                type: 'POST',
                url: 'mainclass.php',
                data: 'key=' + key + '&page=' + page + '&mallid=' + mallid + '&form=loadwing',
                beforeSend : function() {
                    $('#indexloadingscreen').addClass('myspinner');
                },
                success: function(data){
                    $('#indexloadingscreen').removeClass('myspinner');
                    $("#tblwinglist").html(data);
                    $(".scroll").niceScroll({cursorcolor:"#999"});
                    loadpaginationwing();
                    loadentrieswing();                  
                }
            })
        }

    function loadpaginationwing() //added by melanie
        {
            var key = $("#txtsearchwingref").val();
            var page = $("#txt_wingpage").val();
            var mallid = $("#txtmall_id").val();
            $.ajax({
                type: 'POST',
                url: 'mainclass.php',
                data: 'key=' + key + '&page=' + page + '&mallid=' + mallid + '&form=loadpaginationwing',
                success: function(data){
                    $("#ulpaginationwing").html(data);
                }
            }).error(function() {
                alert(data);
            });
        }

    function getvalwing(page, pagenums) //added by melanie
        {
            // alert(page);
                $(".pgnumptnts").removeClass("active");
                var value = "#" + pagenums;
                $("#pgptnts" + pagenums).addClass("active");
                $("#txt_wingpage").val(page);
                // reloadhmo();
                loadwing();
                loadpaginationwing();
                loadentrieswing();
        }

    function loadentrieswing() //added by melanie
        {
            var key = $("#txtsearchwingref").val();
            var page = $("#txt_wingpage").val();
            var mallid = $("#txtmall_id").val();
            $.ajax({
                type: 'POST',
                url: 'mainclass.php',
                data: 'key=' + key + '&page=' + page + '&mallid=' + mallid + '&form=loadentrieswing',
                success: function(data){
                    if(data == "no data")
                    {
                        $("#txtwingentries").text("");
                    }
                    else
                    {
                        $("#txtwingentries").text(data);
                    }
                }
            });
        }  

    function loadmodal_wing()
    {
        $("#modal_addnewwing").modal("show");
        $(".text_wing").val("");
    }  

    function savewing()
    {
        var i = 0;
        $(".req_wing").each(function(){
            if($(this).val() == "" || ($(this).val()).match(/^\s*$/))
            {
                i++;
                $(this).css("border-color","#f2a696");
            }
            else
            {
                $(this).css("border-color","#D5D5D5");
            }
        });

        if(i == 0)
        {
            var wingname = $("#txtwingname").val();
            var mallid = $("#txtmall_id").val();
            var id = $("#txtrefwing").val();
            $.ajax({
                type: 'POST',
                url: 'mainclass.php',
                data: 'mallid=' + mallid + '&wingname=' + wingname + '&id=' + id + '&form=savewing',
                success: function(data)
                {
                    if(data == "Already Existing!")
                    {
                        $(".req_wing").css("border-color","#f2a696");
                        showmodal("alert", data, "", null, "", null, "1");
                        loadwingdetails();
                        loadwingdet();
                        loadmallls2();
                        
                    }
                    else if(data == "Successfully modified.")
                    {
                        $(".req_wing").css("border-color","#D5D5D5");
                        showmodal("alert", data, "", null, "", null, "0");
                        loadwingdetails();
                        loadwingdet();
                        loadmallls2();
                        $(".req_wing").val("");
                        $("#modal_addnewwing").modal("hide");
                        loadwing();                         
                    }
                    else if(data = "Successfully Added."){
                        $(".req_wing").css("border-color","#D5D5D5");
                        showmodal("alert", data, "", null, "", null, "0");
                        loadwingdetails();
                        loadwingdet();
                        loadmallls2();
                        $(".req_wing").val("");
                        $("#modal_addnewwing").modal("hide");
                        loadwing(); 
                    }
                    else
                    {
                        $(".req_wing").css("border-color","#D5D5D5");
                        showmodal("alert", data, "", null, "", null, "0");
                        loadwingdetails();
                        loadwingdet();
                        loadmallls2();
                        $(".req_wing").val("");
                        // $("#modal_addnewwing").modal("hide");
                        loadwing();                 
                    }

                }
            })
        }
        else
        {
            alert("Fill all required fields!");
            $('.req_wing').each(function() {
                if ( this.value === '' ) {
                    this.focus();
                    return false;
                }
            });
        }
    }

    function editrefwing(wing)
    {
            $.ajax({
                type: 'POST',
                url: 'mainclass.php',
                data: 'id=' + wing + '&form=editrefwing',
                success: function(data)
                {
                    var arr = data.split("|");
                    $("#txtwingname").val(arr[2]);
                    $("#txtrefwing").val(arr[1]);
                    $("#modal_addnewwing").modal("show");   
                    loadwingdet();
                    loadwingdetails();
                }
            })
    }

    function delrefwing(wing)
    {
        var conf = confirm("Are you sure?");
        if(conf == true)
        {
            $.ajax({
                type: 'POST',
                url: 'mainclass.php',
                data: 'id=' + wing + '&form=delrefwing',
                success: function(data)
                {
                    alert(data);
                    loadwing();
                    loadwingdet();
                    loadwingdetails();
                }
            })
        }
    }

    function closemodalwing()
    {
        $('#modal_addnewwing').modal('hide');
    }
                
</script>