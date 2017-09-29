<script>
$(function(){
	$("#txt_flrpage").val("1");
	loadfloors();
    $("#tblfloorslist").niceScroll({cursorcolor:"#999"});
});

	function loadfloors()
		{
			var key = $("#txtsearchfloor").val();
			var type = $("#txtfilterby").val();
			var page = $("#txt_flrpage").val();
			$.ajax({
				type: 'POST',
				url: 'mainclass.php',
				data: 'key=' + key + '&type=' + type + '&page=' + page + '&form=loadfloors',
				success: function(data)
				{
					$("#tblfloorslist").html(data);
					$(".scroll").niceScroll({cursorcolor:"#999"});
					loadpaginationflr();
                	loadentriesflr();
				}
			})
		}

 	function loadpaginationflr() //added by melanie
        {
			var key = $("#txtsearchfloor").val();
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
			var key = $("#txtsearchfloor").val();
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
					var val = $("#list_mall").find('option[id="' + arr[1] + '"]');
					var endval = val.attr('value');
					var mallname = $("#txtmall").val(endval);
					$("#txtreffloor").val(arr[4]);
					$("#txtleasetype").val(arr[5]);
					$("#txtbldg").val(arr[2]);
					$("#txtfloor").val(arr[3]);
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

	function getbldg()
	{
		var x = $('#txtmall').val();
        var z = $('#list_mall');
        var val = $(z).find('option[value="' + x + '"]');
        var endval = val.attr('id');
        var id = endval;
        $.ajax({
        	type: 'POST',
        	url: 'mainclass.php',
        	data: 'id=' + id + '&form=getbldg',
        	success: function(data)
        	{
        		var arr = data.split("|");
        		$("#txtbldg").val(arr[0]);
        		$("#txtbldg").attr("value", arr[1]);
        		// alert(data)
        	}
        })
	}

	function savefloor()
	{
		var id = $("#txtreffloor").val();
		var bldgname = $("#txtbldg").val();
		var bldgid = $("#txtbldg").attr("value");
		var floorname = $("#txtfloor").val();
		var mallname = $("#txtmall").val();
        var z = $("#list_mall");
        var val = $(z).find('option[value="' + mallname + '"]');
        var endval = val.attr('id');
        var mallid = endval;
        var leasetype = $("#txtleasetype").val();
        $.ajax({
        	type: 'POST',
        	url: 'mainclass.php',
        	data: 'bldgname=' + bldgname + '&bldgid=' + bldgid + '&floorname=' + floorname + '&mallname=' + mallname + '&mallid=' + mallid + '&leasetype=' + leasetype + '&id=' + id + '&form=savefloor',
        	success: function(data)
        	{
        		if(data == "Already Existing!")
        		{
        			alert(data);
        		}
        		else
        		{
	        		alert(data);
	        		$("#modal_addnewfloor").modal("hide");
	        		loadfloors();        			
        		}

        	}
        })
	}
</script>
<div class="row">
	<div class="col-xs-12" style="padding: 10px !important;">
		<div class="pull-left" style="padding-top:10px;">
			<b class="text-primary" style="margin-top: 15px !important;">Floor List</b>
			<input type="hidden" id="txt_flrpage" name="">
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-2 col-xs-12">
		<select class="form-control" id="txtfilterby" onchange="loadfloors()">
			<option value="">Filter by</option>
			<option value="floor">Floor</option>
			<option value="mallname">Mall</option>
			<option value="bldgname">Building</option>
		</select>
	</div>	
	<div class="col-md-4 col-xs-12">
		<!-- <form class="form-search"> -->
			<span class="input-icon" style="width: 100%;">
				<input type="text" class="form-control" placeholder="Search ..." id="txtsearchfloor" onkeyup="loadfloors()">
				<i class="ace-icon fa fa-search nav-search-icon"></i>
			</span>
		<!-- </form> -->
	</div>
	<div class="col-md-4 col-xs-6">
			<!-- <a href="#" id="" class="btn btn-danger btn-sm" style="width: 100% !important;">Delete</a> -->
	</div>
	<div class="col-md-2 col-xs-6">
			<a href="#" id="btn_mall" class="btn btn-default btn-sm" style="width: 100% !important;" onclick="loadmodal_floor()">New Floor</a>
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
				<td>Mall</td>
				<td class="hide_mobile">Building</td>
				<td>Floor</td>
				<td>Option</td>												
			</tr>
		</thead>
		<tbody id="tblfloorslist" style="flex: 1 1 auto;display: block;height: 16em;overflow-x: hidden;">

		</tbody>
	</table>
		<table class="tabledash_footer table" style="margin: 0px !important;">
        <thead>
            <tr>
                <th id="th_tabledash_footer" width="" colspan="7" style="width: 911px;">
                <font style="float: left; color: #777 !important;margin-top: 17px;margin-left: 15px;font-weight: normal;font-weight: 8px !important;" id="txtflrentries"></font>
                    <div class="pagination">
                        <ul id="ulpaginationflr"></ul>
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
  <div class="modal fade" id="modal_addnewfloor" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Floor</h4>
          <input type="text" id="txtreffloor" class="text_floor" name="">
        </div>
        <div class="modal-body">
    		<div class="row form-group">
    			<div class="col-md-3">
    							Lease Type
    			</div>
    			<div class="col-md-9">
    		  			<select class="form-control text_floor" id="txtleasetype" onchange="loadfloors()">
				 			<option value="">Select Type</option>
				 			<option value="SET">SET</option>
				 			<option value="OLCA">Outside Lease Common Area</option>
				 			<option value="ILCA">Inside Lease Common Area</option>
				 		</select>      		
    			</div>
    		</div>
    		<div class="row form-group">
    			<div class="col-md-3">
    							Mall
    			</div>
    			<div class="col-md-9">
    		  		<input list="list_mall" id="txtmall" class="form-control text_floor" oninput="getbldg();" type="text" li="txtmall" placeholder="Select Mall" >
    		    	<datalist id="list_mall">
    		    		<?php	
    		    			include_once("connect.php");
    		    			$querymall = "Select mallid, mallname FROM tblref_mall";
    		    			$result = mysql_query($querymall, $connection);
				            while($row = mysql_fetch_array($result)){
				            	$mall = "<option id='".$row['mallid']."' ";
					        	$mall .= "value='".$row['mallname']."'/>"; 

					        	echo $mall;
					        }
			            ?>
    		        </datalist>        		       		
    			</div>
    		</div>
    		<div class="row form-group">
    			<div class="col-md-3">
    							Building
    			</div>
    			<div class="col-md-9">
    		                	<input type="text" id="txtbldg" class="form-control text_floor" placeholder="Building" />
    			</div>
    		</div>
    		<div class="row form-group">
    			<div class="col-md-3">
    							Floor
    			</div>
    			<div class="col-md-9">
    		  					<input type="text" id="txtfloor" class="form-control text_floor" placeholder="Floor" />           		
    			</div>
    		</div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" onclick="savefloor()"><i class="ace-icon fa fa-check"></i>&nbsp;Save</button>
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

function loadmodal_floor()
{
	$("#modal_addnewfloor").modal("show");
	$(".text_floor").val("");
}
</script>