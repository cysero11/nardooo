<?php
	include("connect.php");
?>
<script>
$(function(){
		$("#txt_classpage").val("1");
		numonly();
		loadclassification();
    	$("#tblclassificationlist").niceScroll({cursorcolor:"#999"});
});

	function loadclassification()
		{
			var key = $("#txtsearchclassification").val();
			var page = $("#txt_classpage").val();
			$.ajax({
				type: 'POST',
				url: 'mainclass.php',
				data: 'key=' + key + '&page=' + page + '&form=loadclassification',
				success: function(data){
					$("#tblclassificationlist").html(data);
					$(".scroll").niceScroll({cursorcolor:"#999"});
                	loadpaginatioclass();
                	loadentriesclass();
				}

			});
		}

 	function loadpaginatioclass() //added by melanie
        {
			var key = $("#txtsearchclassification").val();
			var page = $("#txt_classpage").val();
            $.ajax({
                type: 'POST',
                url: 'mainclass.php',
                data: 'key=' + key + '&page=' + page + '&form=loadpaginatioclass',
                success: function(data){
                    $("#ulpaginationclass").html(data);
                }
            }).error(function() {
                alert(data);
            });
        }

    function getvalclass(page, pagenums) //added by melanie
        {
            // alert(page);
                $(".pgnumptnts").removeClass("active");
                var value = "#" + pagenums;
                $("#pgptnts" + pagenums).addClass("active");
                $("#txt_classpage").val(page);
                // reloadhmo();
                loadclassification();
                loadpaginatioclass();
                loadentriesclass();
        }

    function loadentriesclass() //added by melanie
        {
			var key = $("#txtsearchclassification").val();
			var page = $("#txt_classpage").val();
            $.ajax({
                type: 'POST',
                url: 'mainclass.php',
                data: 'key=' + key + '&page=' + page + '&form=loadentriesclass',
                success: function(data){
                    if(data == "no data")
                    {
                        $("#txtclassentries").text("");
                    }
                    else
                    {
                        $("#txtclassentries").text(data);
                    }
                }
            }).error(function() {
                alert(data);
            });
        }				

	function saveclassification()
	{
		var bussname = $("#txtbuss").val();
        var z = $("#list_buss");
        var val = $(z).find('option[value="' + bussname + '"]');
        var endval = val.attr('id');
        var bussid = endval;

        var classification = $("#txtclassification").val();
		var counter = $("#txtcounter").val();
		var sqm = $("#txtsqm").val();
		var pricepersqm = $("#txtpricepersqm").val();
		var id = $("#txtrefclassification").val();
        $.ajax({
        	type: 'POST',
        	url: 'mainclass.php',
        	data: 'classification=' + classification + '&counter=' + counter + '&sqm=' + sqm + '&pricepersqm=' + pricepersqm + '&bussname=' + bussname + '&bussid=' + bussid + '&id=' + id + '&form=saveclassification',
        	success: function(data)
        	{
        		if(data == "Already Existing!")
        		{
        			alert(data);
        		}
        		else
        		{
	        		alert(data);
	        		$("#modal_addnewclassification").modal("hide");
	        		loadclassification();        			
        		}

        	}
        })
	}

	function editrefclass(classi)
	{
		$.ajax({
				type: 'POST',
				url: 'mainclass.php',
				data: 'id=' + classi + '&form=editrefclass',
				success: function(data)
				{
					var arr = data.split("|");

					var val = $("#list_buss").find('option[id="' + arr[4] + '"]');
					var endval = val.attr('value');
					var bussname = $("#txtbuss").val(endval);
					$("#txtrefclassification").val(arr[1]);
					$("#txtclassification").val(arr[2]);
					$("#txtcounter").val(arr[5]);
					$("#txtsqm").val(arr[7]);
					$("#txtpricepersqm").val(arr[6]);
					$("#modal_addnewclassification").modal("show");	
				}
			})
	}

	function delrefclass(classi)
	{
		var conf = confirm("Are you sure?");
		if(conf == true)
		{
			$.ajax({
				type: 'POST',
				url: 'mainclass.php',
				data: 'id=' + classi + '&form=delrefclass',
				success: function(data)
				{
					alert(data);
					loadclassification();
				}
			})
			
		}

	}
</script>
<div class="row">
	<div class="col-xs-12" style="padding: 10px !important;">
		<div class="pull-left" style="padding-top:10px;">
			<b class="text-primary" style="margin-top: 15px !important;">Classification List</b>
			<input type="hidden" id="txt_classpage" name="">
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-4 col-xs-12">
		<!-- <form class="form-search"> -->
			<span class="input-icon" style="width: 100%;">
				<input type="text" class="form-control" placeholder="Search ..." id="txtsearchclassification" onkeyup="loadclassification()">
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
			<a href="#" id="btn_mall" class="btn btn-default btn-sm" style="width: 100% !important;" onclick="loadmodal_mall()">New Classification</a>
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
				<td class="scroll">Classification</td>
				<td class="scroll">Businesstype</td>
				<td class="hide_mobile">Counter</td>
				<td class="hide_mobile">SQM</td>
				<td class="hide_mobile" style="text-align: right;">Price per sqm</td>
				<td class="hide_mobile" style="text-align: right;">Total Price</td>
				<td>Option</td>													
			</tr>
		</thead>
		<tbody id="tblclassificationlist" style="flex: 1 1 auto;display: block;height: 16em;overflow-x: hidden;">

		</tbody>
	</table>
	<table class="tabledash_footer table" style="margin: 0px !important;">
        <thead>
            <tr>
                <th id="th_tabledash_footer" width="" colspan="7" style="width: 911px;">
                <font style="float: left; color: #777 !important;margin-top: 17px;margin-left: 15px;font-weight: normal;font-weight: 8px !important;" id="txtclassentries"></font>
                    <div class="pagination">
                        <ul id="ulpaginationclass"></ul>
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
  <div class="modal fade" id="modal_addnewclassification" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Classification</h4>
          <input type="hidden" id="txtrefclassification" class="text_classification" name="">
        </div>
        <div class="modal-body">
    		<div class="row form-group">
    			<div class="col-md-3">
    							Classification
    			</div>
    			<div class="col-md-9">
    		  			<input type="text" class="form-control text_classification" id="txtclassification" name="" placeholder="Classification">      		
    			</div>
    		</div>
    		<div class="row form-group">
    			<div class="col-md-3">
    							Business Type
    			</div>
    			<div class="col-md-9">
    		  		<input list="list_buss" id="txtbuss" class="form-control text_classification" oninput="getbldg();" onkeyup="clearaddress();" type="text" li="txtbuss" placeholder="Select Bussiness Type" />
    		    	<datalist id="list_buss">
    		    		<?php	
    		    			$querybuss = "Select businessid, typeofbusiness FROM tblref_typeofbusiness";
    		    			$res = mysql_query($querybuss, $connection);
				            while($row = mysql_fetch_array($res)){
				            	$buss = "<option id='".$row['businessid']."' ";
					        	$buss .= "value='".$row['typeofbusiness']."'/>"; 

					        	echo $buss;
					        }
			            ?>
    		        </datalist>      		
    			</div>
    		</div>
    		<div class="row form-group">
    			<div class="col-md-3">
    							Counter
    			</div>
    			<div class="col-md-9">
    		                	<input type="text" id="txtcounter" class="form-control numonly text_classification" placeholder="Counter" />
    			</div>
    		</div>
    		<div class="row form-group">
    			<div class="col-md-3">
    							SQM
    			</div>
    			<div class="col-md-4 col-xs-5">
    		  					<input type="text" id="txtsqm" class="form-control numonly text_classification" placeholder="SQM" />           		
    			</div>
    			<div class="col-md-5 col-xs-7">
    		  					<input type="text" id="txtpricepersqm" style="text-align: right;" class="form-control numonly amount text_classification" placeholder="Price per SQM" />           		
    			</div>
    		</div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" onclick="saveclassification()"><i class="ace-icon fa fa-check"></i>&nbsp;Save</button>
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
	$("#modal_addnewclassification").modal("show");
	$(".text_classification").val("");
}
</script>