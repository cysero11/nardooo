<script>
$(function(){
	$("#txt_wingpage").val("1");
	loadwing();
    $("#tblwinglist").niceScroll({cursorcolor:"#999"});
});

	function loadwing()
		{
			var key = $("#txtsearchwingref").val();
			var page = $("#txt_wingpage").val();
			$.ajax({
				type: 'POST',
				url: 'mainclass.php',
				data: 'key=' + key + '&page=' + page + '&form=loadwing',
				success: function(data)
				{
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
            $.ajax({
                type: 'POST',
                url: 'mainclass.php',
                data: 'key=' + key + '&page=' + page + '&form=loadpaginationwing',
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
            $.ajax({
                type: 'POST',
                url: 'mainclass.php',
                data: 'key=' + key + '&page=' + page + '&form=loadentrieswing',
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
            }).error(function() {
                alert(data);
            });
        }						

	function savewing()
	{
		var mallname = $("#txtmall").val();
        var z = $("#list_mall");
        var val = $(z).find('option[value="' + mallname + '"]');
        var endval = val.attr('id');
        var mallid = endval;

		var flrname = $("#txtflr").val();		
        var y = $("#list_flr");
        var val2 = $(y).find('option[value="' + flrname + '"]');
        var endval2 = val2.attr('id');
        var flrid = endval2;

        var wingname = $("#txtwingname").val();
        var id = $("#txtrefwing").val();
        var bldgid = $("#txtbuilding").attr("value");
        $.ajax({
        	type: 'POST',
        	url: 'mainclass.php',
        	data: 'mallid=' + mallid + '&bldgid=' + bldgid + '&flrid=' + flrid + '&wingname=' + wingname + '&id=' + id + '&form=savewing',
        	success: function(data)
        	{
        		if(data == "Already Existing!")
        		{
        			alert(data);
        		}
        		else
        		{
	        		alert(data);
	        		$("#modal_addnewwing").modal("hide");
	        		loadwing();        			
        		}

        	}
        })
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
					loadflrwing2(arr[5], arr[4]);
        			var valmall = $("#list_mall").find('option[id="' + arr[4] + '"]');
					var endvalmall = valmall.attr('value');
					$("#txtmall").val(endvalmall);
     				// var valflr = $("#list_flr").find('option[id="' + arr[5] + '"]');
					// var endvalflr = valflr.attr('value');
					// $("#txtflr").val(endvalflr);        			
        			$("#txtwingname").val(arr[2]);
        			$("#txtrefwing").val(arr[1]);
        			$("#txtbuilding").attr("value", arr[3]);
        			$("#txtbuilding").val(arr[6]);
					$("#modal_addnewwing").modal("show");	
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
				}
			})
		}
	}

	function getbldgwing()
	{
		var bussname = $("#txtmall").val();
		// alert(bussname)
        var z = $("#list_mall");
        var val = $(z).find('option[value="' + bussname + '"]');
        var endval = val.attr('id');
        var mallid = endval;
        // alert(mallid)
		$.ajax({
			type: 'POST',
			url: 'mainclass.php',
			data: 'id=' + mallid + '&form=getbldgwing',
			success: function(data)
			{
				var arr = data.split("|");
				$("#txtbuilding").val(arr[0]);
				$("#txtbuilding").attr("value", arr[1]);
				loadflrwing();
			}
		})
	}

	function loadflrwing()
	{
		var bussname = $("#txtmall").val();
        var z = $("#list_mall");
        var val = $(z).find('option[value="' + bussname + '"]');
        var endval = val.attr('id');
        var mallid = endval;
		$.ajax({
			type: 'POST',
			url: 'mainclass.php',
			data: 'id=' + mallid + '&form=loadflrwing',
			success: function(data)
			{
				$("#list_flr").html(data);
			}
		})
	}

	function loadflrwing2(arr1, arr2)
	{
		// alert(arr2)
		$.ajax({
			type: 'POST',
			url: 'mainclass.php',
			data: 'id=' + arr2 + '&form=loadflrwing',
			success: function(data)
			{
				$("#list_flr").html(data);
				var valflr = $("#list_flr").find('option[id="' + arr1 + '"]');
				var endvalflr = valflr.attr('value');
				$("#txtflr").val(endvalflr);  
			}
		});
	}	
</script>
<div class="row">
	<div class="col-xs-12" style="padding: 10px !important;">
		<div class="pull-left" style="padding-top:10px;">
			<b class="text-primary" style="margin-top: 15px !important;">Wing List</b>
			<input type="hidden" id="txt_wingpage" name="">
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-4 col-xs-12">
		<!-- <form class="form-search"> -->
			<span class="input-icon" style="width: 100%;">
				<input type="text" class="form-control" placeholder="Search ..." id="txtsearchwingref" onkeyup="loadwing()">
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
			<a href="#" id="btn_mall" class="btn btn-default btn-sm" style="width: 100% !important;" onclick="loadmodal_wing()">New Wing</a>
	</div>	
</div>
<div class="row" style="padding: 10px !important;overflow-x: auto;">
	<table id="simple-table" class="table  table-bordered table-hover" style="display: flex;flex-flow: column;height: 100%;width: 100%;margin-bottom: 0px !important">
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
				<td class="hide_mobile">Floor</td>
				<td>Wing</td>
				<td>Option</td>											
			</tr>
		</thead>
		<tbody id="tblwinglist" style="flex: 1 1 auto;display: block;height: 16em;overflow-x: hidden;">

		</tbody>
	</table>
		<table class="tabledash_footer table" style="margin: 0px !important;">
        <thead>
            <tr>
                <th id="th_tabledash_footer" width="" colspan="7" style="width: 911px;">
                <font style="float: left; color: #777 !important;margin-top: 17px;margin-left: 15px;font-weight: normal;font-weight: 8px !important;" id="txtwingentries"></font>
                    <div class="pagination">
                        <ul id="ulpaginationwing"></ul>
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
  <div class="modal fade" id="modal_addnewwing" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Wing</h4>
          <input type="text" id="txtrefwing" class="text_wing" name="">
        </div>
        <div class="modal-body">
   			<div class="row form-group">
   				<div class="col-md-3">
   								Mall
   				</div>
   				<div class="col-md-9">
   			  			<input list="list_mall" id="txtmall" class="form-control text_wing" oninput="getbldgwing();" onkeyup="clearaddress();" type="text" li="txtbuss" placeholder="Select Mall" />
            			<datalist id="list_mall">
            				<?php	
            					include_once("connect.php");
            					$querymall = "Select mallid, mallname, malladdress FROM tblref_mall";
            					$result = mysql_query($querymall, $connection);
						        while($row = mysql_fetch_array($result)){
						        	$mall = "<option id='".$row['mallid']."' ";
						        	$mall .= "value='".$row['mallname']."'>".$row['malladdress']."</option>"; 

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
   			  			<input type="text" id="txtbuilding" class="form-control text_wing" placeholder="Building" />   				
            	</div>
   			</div>
   			<div class="row form-group">
   				<div class="col-md-3">
   								Floor
   				</div>
   				<div class="col-md-9">
   			  			<input list="list_flr" id="txtflr" class="form-control text_wing" onkeyup="clearaddress();" type="text" li="txtflr" placeholder="Select Floor" />
            			<datalist id="list_flr">
            			</datalist>      		
   				</div>
   			</div>
   			<div class="row form-group">
   				<div class="col-md-3">
   								Wing
   				</div>
   				<div class="col-md-9">
   			  			<input type="text" class="form-control upper text_wing" id="txtwingname" name="" placeholder="Wing">      		
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

function loadmodal_wing()
{
	$("#modal_addnewwing").modal("show");
	$(".text_wing").val("");
}
</script>