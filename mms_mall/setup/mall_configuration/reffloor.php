<div class="page-header">
</div>
<div class="row">
    <div class="col-sm-3 col-xs-12" style="padding-bottom: 5px;">
        <select class="form-control" id="txtfilterby" name="txtfilterby" onchange="loadfloors()">
            <option value="">Filter by</option>
        </select>
    </div>  
    <div class="col-sm-3 col-xs-12" style="padding-bottom: 5px;">
        <!-- <form class="form-search"> -->
            <span class="input-icon" style="width: 100%;">
                <input type="text" class="form-control" placeholder="Search Floor Name..." id="txtsearchfloormc" onkeyup="loadfloors()">
                <i class="ace-icon fa fa-search nav-search-icon"></i>
            </span>
        <!-- </form> -->
    </div>
    <div class="col-xs-12 col-sm-3">
        <!-- <a href="#" id="btn_mall" class="btn btn-default btn-sm" style="width: 100% !important;" onclick="loadmodal_wing()">New Wing</a> -->
    </div>
    <div class="col-xs-12 col-sm-3">
        <a href="#" id="btn_mall" class="btn btn-default btn-sm" style="width: 100% !important;" onclick="loadmodal_floor()">New Floor</a>
    </div>
</div>
<input type="hidden" id="txt_flrpage" name="">
    <table id="simple-table" class="table  table-bordered table-hover" style="display: flex;flex-flow: column;height: 100%;width: 100%;margin-bottom: 0px !important;">
        <thead style="flex: 0 0 auto;width: calc(100%);">
            <tr style="display: table;table-layout: fixed;width: 100%;display: table;">
                
                <td>Floor</td>
                <td class="hide_mobile">Wing</td>
                <td>Dimensions</td>
                <td class="hide_mobile">Min. Area</td>
                <td>Option</td>                                             
            </tr>
        </thead>
        <div id="div_floor_table"></div>
        <tbody id="tblfloorslist" style="flex: 1 1 auto;display: block;height: 16em;overflow-x: hidden;">

        </tbody>
    </table>
    <table class="tabledash_footer table" style="margin: 0px !important;">
        <thead>
            <tr>
                <th id="th_tabledash_footer" width="" colspan="7" style="width: 911px;padding-bottom: 15px;padding-top: 15px;">
                     <font style="float: left; color: white !important;margin-left: 15px;font-weight: normal;font-weight: 8px !important;" id="txtflrentries"></font>
                        <ul id="ulpaginationflr" class="pagination pull-right"></ul>
                </th>
            </tr>
        </thead>
    </table>

<!-- Modal -->
  <div class="modal fade" id="modal_addnewfloor" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" onclick="cloaseflrmodal()">&times;</button>
          <h4 class="modal-title">Floor</h4>
          <input type="hidden" id="txtreffloor" class="text_floor" name="">
        </div>
        <div class="modal-body">
            <div class="row form-group">
                <div class="col-md-3">
                                Wing
                </div>
                <div class="col-md-9">
                    <select id="txtwings" class="form-control text_floor txtreq_flr" onchange="getbldg();">
                        <option value="">-- Select Wing --</option>
                    </select>
                </div>
            </div>
            <hr/>
            <div class="row form-group">
                <div class="col-md-3">
                                Floor
                </div>
                <div class="col-md-9">
                    <div class="input-group">
                        <!-- <span class="input-group-addon">
                            <i class="ace-icon fa fa-check"></i>
                        </span> -->

                        <select id="txtfloor" class="form-control text_floor txtref_flr txtreq_flr">
                            
                        </select>
                        <span class="input-group-btn">
                            <button type="button" class="btn btn-light btn-sm" onclick="addnewreffloor()">
                                <span class="ace-icon fa fa-plus icon-on-right bigger-110"></span>
                            </button>
                        </span>
                    </div>               
                </div>
            </div>
            <div class="row form-group">
                <div class="col-md-3">Width</div>
                <div class="col-md-5">
                    <div class="input-group">
                    	<input type="text" class="form-control numonly text_floor txtreq_flr" id="txtwidth">
                    	<span class="input-group-addon">
                        	meters
                        </span>
                    </div>               
                </div>
            </div>
            <div class="row form-group">
                <div class="col-md-3">Length</div>
                <div class="col-md-5">
                    <div class="input-group">
                    	<input type="text" class="form-control numonly text_floor txtreq_flr" id="txtlength">
                    	<span class="input-group-addon">
                        	meters
                        </span>
                    </div>               
                </div>
            </div>
            <div class="row form-group">
                <div class="col-md-3">Minimum Area</div>
                <div class="col-md-4">
                    <div class="input-group">
                    	<input type="text" class="form-control numonly text_floor txtreq_flr" id="txtminarea">
                    	<span class="input-group-addon">
                        	sqm.
                        </span>
                    </div>               
                </div>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" onclick="savefloor()"><i class="ace-icon fa fa-check"></i>&nbsp;Save</button>
        </div>
      </div>
      
    </div>
  </div>

  <div class="modal fade bd-example-modal-sm" id="modal_addnewreffloor" role="dialog">
    <div class="modal-dialog modal-sm">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-body">
          <button type="button" class="close" onclick="cloaseflrmodal2()">&times;</button>
            <h4 class="modal-title">Floors</h4>
            <h6 class="modal-title">(Referential)</h6>
            <div class="row form-group">
                <div class="col-xs-12 col-md-12">
                    <table id="simple-table" class="table  table-bordered table-hover" style="display: flex;flex-flow: column;height: 100%;width: 100%;margin-top: 10px;">
                        <tbody id="tblfloorsreflist" style="flex: 1 1 auto;display: block;height: 10em;overflow-x: hidden;">

                        </tbody>
                    </table>
                    <hr />
                    <h6 class="modal-title">New Floor</h6>
                    <h6 class="modal-title" style="font-size: 10px;font-style: italic;">(if not on the selection)</h6>
                    <input type="text" id="txtaddnewrefflr" style="" class="form-control" name="" placeholder="Add New">
                </div>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" onclick="savereffloor()"><i class="ace-icon fa fa-check"></i>&nbsp;Save</button>
        </div>
      </div>
      
    </div>
  </div>  
<script>
$(function(){
    $("#txt_flrpage").val("1");
    $("#tblfloorslist").niceScroll({cursorcolor:"#999"});
    $("#tblfloorsreflist").niceScroll({cursorcolor:"#999"});
    loaddropflr();
    loadwingdetails();
    loadfloors()
});

    function loadfloors()
        {
            var key = $("#txtsearchfloormc").val();
            var type = $("#txtfilterby").val();
            var page = $("#txt_flrpage").val();
            $.ajax({
                type: 'POST',
                url: 'mainclass.php',
                data: 'key=' + key + '&type=' + type + '&page=' + page + '&form=loadfloors',
                beforeSend : function() {
                    $('#indexloadingscreen').addClass('myspinner');
                },
                success: function(data){
                    $('#indexloadingscreen').removeClass('myspinner');
                    $("#tblfloorslist").html(data);
                    $(".scroll").niceScroll({cursorcolor:"#999"});
                    loadpaginationflr();
                    loadentriesflr();
                }
            })
        }

    function loadpaginationflr() //added by melanie
        {
            var key = $("#txtsearchfloormc").val();
            var type = $("#txtfilterby").val();
            var page = $("#txt_flrpage").val();
            $.ajax({
                type: 'POST',
                url: 'mainclass.php',
                data: 'key=' + key + '&type=' + type + '&page=' + page + '&form=loadpaginationflr',
                success: function(data){
                    $("#ulpaginationflr").html(data);
                }
            }).error(function() {
                alert(data);
            });
        }

    function getvalflr(page, pagenums) //added by melanie
        {
            // alert(page);
                $(".pgnumptnts").removeClass("active");
                var value = "#" + pagenums;
                $("#pgptnts" + pagenums).addClass("active");
                $("#txt_flrpage").val(page);
                // reloadhmo();
                loadfloors();
                loadpaginationflr();
                loadentriesflr();
        }

    function loadentriesflr() //added by melanie
        {
            var key = $("#txtsearchfloormc").val();
            var type = $("#txtfilterby").val();
            var page = $("#txt_flrpage").val();
            $.ajax({
                type: 'POST',
                url: 'mainclass.php',
                data: 'key=' + key + '&type=' + type + '&page=' + page + '&form=loadentriesflr',
                success: function(data){
                    if(data == "no data")
                    {
                        $("#txtflrentries").text("");
                    }
                    else
                    {
                        $("#txtflrentries").text(data);
                    }
                }
            }).error(function() {
                alert(data);
            });
        }                       

    function editreffloor(floor)
    {
            $.ajax({
                type: 'POST',
                url: 'mainclass.php',
                data: 'id=' + floor + '&form=editreffloor',
                success: function(data)
                {
                    var arr = data.split("|");
                    $("#txtwings").val(arr[2]);

                    $("#txtreffloor").val(arr[4]);
                    $("#txtfloor").val(arr[3]);
                    $("#txtwidth").val(arr[5]);
                    $("#txtlength").val(arr[6]);
                    $("#txtminarea").val(arr[7]);
                    $("#modal_addnewfloor").modal("show");  
                }
            })
    }

    function delreffloor(floor)
    {
        var conf = confirm("Are you sure?");
        if(conf == true)
        {
            $.ajax({
                type: 'POST',
                url: 'mainclass.php',
                data: 'id=' + floor + '&form=delreffloor',
                success: function(data)
                {
                    alert(data);
                    loadfloors();
                }
            })

        }
    }

    // function getbldg()
    // {
    //     var x = $('#txtmall').val();
    //     var z = $('#list_mall');
    //     var val = $(z).find('option[value="' + x + '"]');
    //     var endval = val.attr('id');
    //     var id = endval;
    //     $.ajax({
    //         type: 'POST',
    //         url: 'mainclass.php',
    //         data: 'id=' + id + '&form=getbldg',
    //         success: function(data)
    //         {
    //             var arr = data.split("|");
    //             $("#txtbldg").val(arr[0]);
    //             $("#txtbldg").attr("value", arr[1]);
    //             // alert(data)
    //         }
    //     })
    // }

    function savefloor()
    {
        var i = 0;
        $(".txtreq_flr").each(function(){
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
            var wingid = $("#txtwings").val();

            var floorid = $("#txtreffloor").val();
            var floor = $("#txtfloor").val();
            var mallid = $("#txtmall_id").val();
            var width = $("#txtwidth").val();
            var length = $("#txtlength").val();
            var minarea = $("#txtminarea").val();
            $.ajax({
                type: 'POST',
                url: 'mainclass.php',
                data: 'floor=' + floor + '&floorid=' + floorid + '&wingid=' + wingid + '&mallid=' + mallid + '&width=' + width + '&length=' + length + '&minarea=' + minarea + '&form=savefloor',
                success: function(data)
                {
                    if(data == "Already Existing.")
                    {
                        $(".txtreq_flr").css("border-color","#f2a696");
                        showmodal("alert", data, "", null, "", null, "1");
                    }
                    else if(data == "Successfully modified.")
                    {
                        $(".txtreq_flr").css("border-color","#D5D5D5");
                        showmodal("alert", data, "", null, "", null, "0");
                        $(".txtref_flr").val("");
                        $("#modal_addnewfloor").modal("hide");
                        loadfloors();                   
                    }
                    else
                    {
                        $(".txtreq_flr").css("border-color","#D5D5D5");
                        showmodal("alert", data, "", null, "", null, "0");
                        $(".txtref_flr").val("");
                        loadfloors();                   
                    }
					

                }
            })
        }
        else
        {
            alert("Fill all required fields!");
            $('.txtreq_flr').each(function() {
                if ( this.value === '' ) {
                    this.focus();
                    return false;
                }
            });
        }
    }

    function loadmodal_floor()
    {
        $("#modal_addnewfloor").modal("show");
        $(".text_floor").val("");
        var filter = $("#txtfilterby").val();
        $("#txtwings").val(filter);
    }

    function cloaseflrmodal()
    {
         $("#modal_addnewfloor").modal("hide");
    }

    function cloaseflrmodal2()
    {
         $("#modal_addnewreffloor").modal("hide");
    }    

    function loadwingdetails()
    {
        var ids = $("#txtmall_id").val();
        $.ajax({
            type: 'POST',
            url: 'mainclass.php',
            data: 'id=' + ids + '&form=loadwingdetails',
            success: function(data)
            {
                $("#txtwings").html(data);
            }
        })
    }

    function loadrefflrdetails()
    {
        $.ajax({
            type: 'POST',
            url: 'mainclass.php',
            data: 'form=loadrefflrdetails',
            success: function(data)
            {
                $("#tblfloorsreflist").html(data);
            }
        })
    }

    function loadwingdet()
    {
        var ids = $("#txtmall_id").val();
        $.ajax({
            type: 'POST',
            url: 'mainclass.php',
            data: 'id=' + ids + '&form=loadwingdetails2',
            success: function(data)
            {
                // alert(data)
                $("#txtfilterby").html(data);
                $('select[name=txtfilterby] option:eq(1)').attr('selected', 'selected');
                loadfloors();
                // $('select[name="txtfilterby"] option:nth-child(3)').attr('selected', 'selected');
            }
        })
    }

    function loaddropflr()
    {
        $.ajax({
            type: 'POST',
            url: 'mainclass.php',
            data: 'form=loaddropflr',
            success: function(data)
            {
                $("#txtfloor").html(data);
            }
        })
        
    }
    function loaddropflr2(cont)
    {
        $.ajax({
            type: 'POST',
            url: 'mainclass.php',
            data: 'form=loaddropflr',
            success: function(data)
            {
                $("#txtfloor").html(data);
                $('#txtfloor option[value="'+cont+'"]').prop('selected','selected');
            }
        })
        
    }
    function addnewreffloor()
    {
        loadrefflrdetails();
        $("#modal_addnewreffloor").modal("show");
    }

    function savereffloor()
    {
        var flr = $("#txtaddnewrefflr").val();
        $.ajax({
            type: 'POST',
            url: 'mainclass.php',
            data: 'flr=' + flr + '&form=savereffloor',
            success: function(data)
            {
                // alert(data)
                if(data == 1)
                {
                    loadrefflrdetails();
                    loaddropflr2(flr);
                    
                    $("#modal_addnewreffloor").modal("hide");
                }
                else if(data == 2)
                {
                    alert("existing");
                }
            }
        })
    }
</script>