<script>
$(function(){
	$("#txt_businesspage").val("1");
	loadbusinesstype();
    $("#tblbusinesstype").niceScroll({cursorcolor:"#999"});
});

	function loadbusinesstype()
		{
			var key = $("#txtsearchbustype").val();
			var page = $("#txt_businesspage").val();
			$.ajax({
				type: 'POST',
				url: 'mainclass.php',
				data: 'key=' + key + '&page=' + page + '&form=loadbusinesstype',
				success: function(data)
				{
					$("#tblbusinesstype").html(data);
					$(".scroll").niceScroll({cursorcolor:"#999"});
					loadpaginationbusiness();
    				loadentriebusiness();
				}
			})
		}
 	function loadpaginationbusiness() //added by melanie
        {
			var key = $("#txtsearchbustype").val();
			var page = $("#txt_businesspage").val();
            $.ajax({
                type: 'POST',
                url: 'mainclass.php',
                data: 'key=' + key + '&page=' + page + '&form=loadpaginationbusiness',
                success: function(data){
                    $("#ulpaginationbusi").html(data);
                }
            }).error(function() {
                alert(data);
            });
        }

    function getvalbusi(page, pagenums) //added by melanie
        {
            // alert(page);
                $(".pgnumptnts").removeClass("active");
                var value = "#" + pagenums;
                $("#pgptnts" + pagenums).addClass("active");
                $("#txt_businesspage").val(page);
                // reloadhmo();
                loadbusinesstype();
                loadpaginationbusiness();
                loadentriebusiness();
        }

    function loadentriebusiness() //added by melanie
        {
			var key = $("#txtsearchbustype").val();
			var page = $("#txt_businesspage").val();
            $.ajax({
                type: 'POST',
                url: 'mainclass.php',
                data: 'key=' + key + '&page=' + page + '&form=loadentriebusiness',
                success: function(data){
                    if(data == "no data")
                    {
                        $("#txtbusientries").text("");
                    }
                    else
                    {
                        $("#txtbusientries").text(data);
                    }
                }
            }).error(function() {
                alert(data);
            });
        }		

	function savebustype()
	{
		var id = $("#txtrefbusinesstype").val();
		var type = $("#txtbustype").val();
        $.ajax({
        	type: 'POST',
        	url: 'mainclass.php',
        	data: 'type=' + type + '&id=' + id + '&form=savebustype',
        	success: function(data)
        	{
        		if(data == "Already Existing!" || data == "Successfully Added.")
        		{
        			alert(data);
        			loadbusinesstype();
        		}
        		else
        		{
	        		alert(data);
	        		$("#modal_addnewnusinesstype").modal("hide");
	        		loadbusinesstype();        			
        		}

        	}
        })
	}



	function editrefbustype(floor)
	{
			$.ajax({
				type: 'POST',
				url: 'mainclass.php',
				data: 'id=' + floor + '&form=editrefbustype',
				success: function(data)
				{
					var arr = data.split("|");
					$("#txtrefbusinesstype").val(arr[0]);
					$("#txtbustype").val(arr[1]);
					$("#modal_addnewnusinesstype").modal("show");	
				}
			})
	}

	function delrefbustype(bustype)
	{
		var conf = confirm("Are you sure?");
		if(conf == true)
		{
			$.ajax({
				type: 'POST',
				url: 'mainclass.php',
				data: 'id=' + bustype + '&form=delrefbustype',
				success: function(data)
				{
					alert(data);
					loadbusinesstype();
				}
			})

		}
	}
</script>
<div class="row">
	<div class="col-xs-12" style="padding: 10px !important;">
		<div class="pull-left" style="padding-top:10px;">
			<b class="text-primary" style="margin-top: 15px !important;">Business Type List</b>
			<input type="hidden" id="txt_businesspage" name="">
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-4 col-xs-12">
		<!-- <form class="form-search"> -->
			<span class="input-icon" style="width: 100%;">
				<input type="text" class="form-control" placeholder="Search ..." id="txtsearchbustype" onkeyup="loadbusinesstype()">
				<i class="ace-icon fa fa-search nav-search-icon"></i>
			</span>
		<!-- </form> -->
	</div>
	<div class="col-md-6 col-xs-6">
			<!-- <a href="#" id="" class="btn btn-danger btn-sm" style="width: 100% !important;">Delete</a> -->
	</div>
	<div class="col-md-2 col-xs-6">
			<a href="#" id="btn_mall" class="btn btn-default btn-sm" style="width: 100% !important;" onclick="loadmodal_floor()">New Type</a>
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
				<td>Type of Business</td>
				<td>Option</td>											
			</tr>
		</thead>
		<tbody id="tblbusinesstype" style="flex: 1 1 auto;display: block;height: 16em;overflow-x: hidden;">

		</tbody>
	</table>
	<table class="tabledash_footer table" style="margin: 0px !important;">
        <thead>
            <tr>
                <th id="th_tabledash_footer" width="" colspan="7" style="width: 911px;">
                <font style="float: left; color: #777 !important;margin-top: 17px;margin-left: 15px;font-weight: normal;font-weight: 8px !important;" id="txtbusientries"></font>
                    <div class="pagination">
                        <ul id="ulpaginationbusi"></ul>
                    </div>
                </th>
            </tr>
        </thead>
</table>
</div>

<!-- =============================================  dialog ============================================ -->
<div id="dialog-mall" class="hide">
</div>
<!-- ====================================================================================================== -->
<!-- Modal -->
  <div class="modal fade" id="modal_addnewnusinesstype" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Business Type</h4>
          <input type="hidden" id="txtrefbusinesstype" class="text_bustype" name="">
        </div>
        <div class="modal-body">
    		<div class="row form-group">
        		<div class="col-md-3">
        						Type of Business
        		</div>
        		<div class="col-md-9">
        		            	<input type="text" id="txtbustype" class="form-control text_bustype" placeholder="Type of business" />
        		</div>
        	</div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" onclick="savebustype()"><i class="ace-icon fa fa-check"></i>&nbsp;Save</button>
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
	$("#modal_addnewnusinesstype").modal("show");
	$(".text_bustype").val("");
}
</script>