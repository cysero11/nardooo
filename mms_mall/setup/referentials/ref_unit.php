<?php
include("connect.php");
?>
<script>
$(function(){
	$("#txt_unitpage").val("1");
	numonly();
	loadunit();
    $("#tblunitlist").niceScroll({cursorcolor:"#999"});
    // $(".scroll").niceScroll({cursorcolor:"#999"});	
	$('.upper').keyup(function() {
            $(this).val($(this).val().toUpperCase());
    });
});

	function loadunit()
	{
		var key = $("#txtsearchamenities").val();
		var page = $("#txt_unitpage").val();
		$.ajax({
			type: 'POST',
			url: 'mainclass.php',
			data: 'key=' + key + '&page=' + page + '&form=loadunit',
			success: function(data)
			{
				$("#tblunitlist").html(data);
				$(".scroll").niceScroll({cursorcolor:"#999"});
				loadpaginationunit();
               	loadentriesunit();
			}
		})
	}

 	function loadpaginationunit() //added by melanie
        {
			var key = $("#txtsearchamenities").val();
			var page = $("#txt_unitpage").val();
            $.ajax({
                type: 'POST',
                url: 'mainclass.php',
                data: 'key=' + key + '&page=' + page + '&form=loadpaginationunit',
                success: function(data){
                    $("#ulpaginationunit").html(data);
                }
            }).error(function() {
                alert(data);
            });
        }

    function getvalunit(page, pagenums) //added by melanie
        {
            // alert(page);
                $(".pgnumptnts").removeClass("active");
                var value = "#" + pagenums;
                $("#pgptnts" + pagenums).addClass("active");
                $("#txt_unitpage").val(page);
                // reloadhmo();
                loadunit();
                loadpaginationunit();
                loadentriesunit();
        }

    function loadentriesunit() //added by melanie
        {
			var key = $("#txtsearchamenities").val();
			var page = $("#txt_unitpage").val();
            $.ajax({
                type: 'POST',
                url: 'mainclass.php',
                data: 'key=' + key + '&page=' + page + '&form=loadentriesunit',
                success: function(data){
                    if(data == "no data")
                    {
                        $("#txtunitentries").text("");
                    }
                    else
                    {
                        $("#txtunitentries").text(data);
                    }
                }
            }).error(function() {
                alert(data);
            });
        }					

	function saveunit()
	{
		var id = $("#txtrefunit").val();
		var toilet = $('input[name="toilet"]:checked').val();
		var toiletqty = $("#txttoiletqty").val();

		var mallname = $("#txtmall").val();
        var a = $("#list_mall");
        var val = $(a).find('option[value="' + mallname + '"]');
        var endval_a = val.attr('id');
        var mallid = endval_a;

        var flrname = $("#txtflr").val();
        var b = $("#list_flr");
        var val = $(b).find('option[value="' + flrname + '"]');
        var endval_b = val.attr('id');
        var flrid = endval_b;

        var wingname = $("#txtwing").val();
        var c = $("#list_wing");
        var val = $(c).find('option[value="' + wingname + '"]');
        var endval_c = val.attr('id');
        var wingid = endval_c;

        var classname = $("#txtclass").val();
        var d = $("#list_class");
        var val = $(d).find('option[value="' + classname + '"]');
        var endval_d = val.attr('id');
        var classid = endval_d;

        var sqm = $("#txtsqm").val();
		var pricepersqm = $("#txtpricepersqm").val();
		var bldgname = $("#txtbuilding").val();
		var bldgid = $("#txtbuilding").attr("value");
		var unitname = $("#txtunitname").val();
		var bustype = $("#txtbustype").val();
		var bussid = $("#txtbustype").attr("value");
        $.ajax({
        	type: 'POST',
        	url: 'mainclass.php',
        	data: 'id=' + id + '&toilet=' + toilet + '&toiletqty=' + toiletqty + '&mallname=' + mallname + '&mallid=' + mallid + '&flrname=' + flrname + '&flrid=' + flrid + '&wingname=' + wingname + '&wingid=' + wingid + '&sqm=' + sqm + '&pricepersqm=' + pricepersqm + '&bldgid=' + bldgid + '&bldgname=' + bldgname + '&unitname=' + unitname + '&classname=' + classname + '&classid=' + classid + '&bustype=' + bustype + '&bussid=' + bussid + '&form=saveunit',
        	success: function(data)
        	{
        		if(data == "Already Existing!")
        		{
        			alert(data);
        		}
        		else
        		{
	        		alert(data);
	        		$("#modal_addnewunit").modal("hide");
	        		loadunit();        			
        		}

        	}
        })
	}

	function editrefunit(unit)
	{
			$.ajax({
				type: 'POST',
				url: 'mainclass.php',
				data: 'id=' + unit + '&form=editrefunit',
				success: function(data)
				{
					var arr = data.split("|");

					$("#txtrefunit").val(arr[16]);
					var toilet = $('input[value="'+arr[8]+'"]:checked').val();
					var toiletqty = $("#txttoiletqty").val(arr[9]);

    				var val_a = $("#list_mall").find('option[id="' + arr[12] + '"]');
					var endval_a = val_a.attr('value');
					$("#txtmall").val(endval_a);

					loadflrwing2(arr[12], arr[13]);    				
					loadwingflr2(arr[13], arr[14]);

    				var val_d = $("#list_class").find('option[id="' + arr[15] + '"]');
					var endval_d = val_d.attr('value');
					$("#txtclass").val(endval_d);    				

    				var sqm = $("#txtsqm").val(arr[4]);
					var pricepersqm = $("#txtpricepersqm").val(arr[5]);

					var bldgname = $("#txtbuilding").val(arr[1]);
					var bldgid = $("#txtbuilding").attr("value");
					var unitname = $("#txtunitname").val(arr[0]);
					var bustype = $("#txtbustype").val(arr[2]);
					$("#modal_addnewunit").modal("show");	
				}
			})
	}

	function delrefunit(unit)
	{
		var conf = confirm("Are you sure?");
		if(conf == true)
		{
			$.ajax({
				type: 'POST',
				url: 'mainclass.php',
				data: 'id=' + unit + '&form=delrefunit',
				success: function(data)
				{
					alert(data);
					loadunit();
				}
			})
		}
	}

	function chkradiovalue()
	{
		var toilet = $('input[name="toilet"]:checked').val();
		if(toilet == "yes")
		{
			$("#txttoiletqty").prop("disabled", false);
			// $("#txttoiletqty").val("0");
		}
		else
		{
			$("#txttoiletqty").prop("disabled", true);
			$("#txttoiletqty").val("0");
		}
	}

	function getbldgwing()
	{
		var mallname = $("#txtmall").val();
        var z = $("#list_mall");
        var val = $(z).find('option[value="' + mallname + '"]');
        var endval = val.attr('id');
        var mallid = endval;
		$.ajax({
			type: 'POST',
			url: 'mainclass.php',
			data: 'id=' + mallid + '&form=getbldgwing',
			success: function(data)
			{
				var arr = data.split("|");
				$("#txtbuilding").val(arr[0]);
				$("#txtbuilding").attr("value", arr[1]);
				loadflrwing(mallid, "");
			}
		})
	}

	function loadflrwing()
	{
		var mallname = $("#txtmall").val();
        var z = $("#list_mall");
        var val = $(z).find('option[value="' + mallname + '"]');
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

	function loadflrwing2(mallid, selected)
	{
		$.ajax({
			type: 'POST',
			url: 'mainclass.php',
			data: 'id=' + mallid + '&form=loadflrwing',
			success: function(data)
			{
				$("#list_flr").html(data);
				var val_b = $("#list_flr").find('option[id="' + selected + '"]');
				var endval_b = val_b.attr('value');
				$("#txtflr").val(endval_b);
				
			}
		})
	}

	function loadwingflr()
	{
		var flrname = $("#txtflr").val();
        var z = $("#list_flr");
        var val = $(z).find('option[value="' + flrname + '"]');
        var endval = val.attr('id');
        var flrid = endval;
		$.ajax({
			type: 'POST',
			url: 'mainclass.php',
			data: 'id=' + flrid + '&form=loadwingflr',
			success: function(data)
			{
				$("#list_wing").html(data);
			}
		})	
	}

	function loadwingflr2(flrid, selected)
	{
		$.ajax({
			type: 'POST',
			url: 'mainclass.php',
			data: 'id=' + flrid + '&form=loadwingflr',
			success: function(data)
			{
				$("#list_wing").html(data);
				var val_c = $("#list_wing").find('option[id="' + selected + '"]');
				var endval_c = val_c.attr('value');
				$("#txtwing").val(endval_c);
			}
		})	
	}


	function loadotherinfo()
	{
		var classname = $("#txtclass").val();
        var z = $("#list_class");
        var val = $(z).find('option[value="' + classname + '"]');
        var endval = val.attr('id');
        var classid = endval;
        $.ajax({
        	type: 'POST',
        	url: 'mainclass.php',
        	data: 'id=' + classid + '&form=loadotherinfo',
        	success: function(data)
        	{
        		var arr = data.split("|");
        		$("#txtbustype").val(arr[0]);
        		$("#txtbustype").attr("value", arr[1]);
				$("#txtsqm").val(arr[4]);
				$("#txtpricepersqm").val(arr[3]);
        	}
        })
	}

	function loadmodal_unit()
	{
		$("#modal_addnewunit").modal("show");
		$(".text_wing").val("");
	}
</script>
<div class="row">
	<div class="col-xs-12" style="padding: 10px !important;">
		<div class="pull-left" style="padding-top:10px;">
			<b class="text-primary" style="margin-top: 15px !important;">Unit List</b>
			<input type="hidden" id="txt_unitpage" name="">
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-4 col-xs-12">
		<!-- <form class="form-search"> -->
			<span class="input-icon" style="width: 100%;">
				<input type="text" class="form-control" placeholder="Search ..." id="txtsearchamenities" onkeyup="loadunit()">
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
			<a href="#" id="btn_mall" class="btn btn-default btn-sm" style="width: 100% !important;" onclick="loadmodal_unit()">New Unit</a>
	</div>	
</div>
<div class="row" style="padding: 10px !important;overflow-x: auto;">
	<table id="simple-table" class="table  table-bordered table-hover" style="display: flex;flex-flow: column;height: 100%;width: 100%;margin-bottom: 0px !important;">
		<thead style="flex: 0 0 auto;width: calc(100%);">
			<tr style="display: table;table-layout: fixed;width: 100%;display: table;">
				<td>Mall</td>
				<td class="hide_mobile">Building</td>
				<td class="hide_mobile">Floor</td>
				<td class="hide_mobile">Wing</td>
				<td>Unit</td>
				<td class="hide_mobile">Type of Business</td>
				<td class="hide_mobile">Classification</td>
				<td class="hide_mobile">SQM</td>
				<td class="hide_mobile" style="text-align: right;">Price per sqm</td>
				<td class="hide_mobile" style="text-align: right;">Total Amount</td>
				<td>Option</td>										
			</tr>
		</thead>
		<tbody id="tblunitlist" style="flex: 1 1 auto;display: block;height: 15em;overflow-x: hidden;">

		</tbody>
	</table>
	<table class="tabledash_footer table" style="margin: 0px !important;">
    	<thead>
    	    <tr>
    	        <th id="th_tabledash_footer" width="" colspan="7" style="width: 911px;">
    	    		<font style="float: left; color: #777 !important;margin-top: 17px;margin-left: 15px;font-weight: normal;font-weight: 8px !important;" id="txtunitentries"></font>
    	    		    <div class="pagination">
    	    		        <ul id="ulpaginationunit"></ul>
    	    		    </div>
    	        </th>
    	    </tr>
    	</thead>
    </table>
</div>

<!-- ====================================================================================================== -->
<!-- Modal -->
  <div class="modal fade" id="modal_addnewunit" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Unit</h4>
          <input type="hidden" id="txtrefunit" class="text_wing" name="">
        </div>
        <div class="modal-body">
   			<div class="row form-group">
   				<div class="col-md-3">
   								Mall
   				</div>
   				<div class="col-md-9">
   			  			<input list="list_mall" id="txtmall" class="form-control text_unit" oninput="getbldgwing();" type="text" li="txtbuss" placeholder="Select Mall" />
            			<datalist id="list_mall">
            				<?php	
            		// 			$querymall = "Select mallid, mallname, malladdress FROM tblref_mall";
            		// 			$rsss = mysql_query($querymall, $connection);
						        // while($row = mysql_fetch_array($rsss)){
						        // 	$mall = "<option id='".$row['mallid']."' ";
						        // 	$mall .= "value='".$row['mallname']."'>".$row['malladdress']."</option>"; 

						        // 	echo $mall;
						        // }
		    			    ?>
            			</datalist>       		
   				</div>
   			</div>
   			<div class="row form-group">
   				<div class="col-md-3">
   								Building
   				</div>
   				<div class="col-md-9">
   			  			<input type="text" id="txtbuilding" class="form-control text_unit" placeholder="Building" />   				
            	</div>
   			</div>
   			<div class="row form-group">
   				<div class="col-md-3">
   								Floor
   				</div>
   				<div class="col-md-9">
   			  			<input list="list_flr" id="txtflr" class="form-control text_unit" oninput="loadwingflr();" type="text" li="txtflr" placeholder="Select Floor" />
            			<datalist id="list_flr">
            			</datalist>      		
   				</div>
   			</div>
   			<div class="row form-group">
   				<div class="col-md-3">
   								Wing
   				</div>
   				<div class="col-md-9">
   			  			<input list="list_wing" id="txtwing" class="form-control text_unit" type="text" li="txtwing" placeholder="Select Wing" />
            			<datalist id="list_wing">
            			</datalist>      		
   				</div>
   			</div>  
   			<div class="row form-group">
   				<div class="col-md-3">
   								Unit
   				</div>
   				<div class="col-md-9">
   			  			<input type="text" class="form-control text_unit" id="txtunitname" name="" placeholder="Unit">      		
   				</div>
   			</div>
   			<div class="row form-group">
   				<div class="col-md-3">
   								Classification
   				</div>
   				<div class="col-md-9">
   			  			<input list="list_class" id="txtclass" class="form-control text_unit" oninput="loadotherinfo();" type="text" li="txtbuss" placeholder="Select class" />
            			<datalist id="list_class">
            				<?php	
            		// 			$queryclass = mysql_query("Select classificationid, classname FROM smms_refclassification")or die(mysql_error());
						        // while($row = mysql_fetch_array($queryclass)){
						        // 	$class = "<option id='".$row['classificationid']."' ";
						        // 	$class .= "value='".$row['classname']."'/>"; 

						        // 	echo $class;
						        // }
		    			    ?>
            			</datalist>      		
   				</div>
   			</div>
   			<div class="row form-group">
   				<div class="col-md-3">
   								Business Type
   				</div>
   				<div class="col-md-9">
   			  			<input type="text" class="form-control text_unit" id="txtbustype" name="" placeholder="Unit">      		
   				</div>
   			</div>
   			<div class="row form-group">
   				<div class="col-md-3">
   								Toilet
   				</div>
   				<div class="col-md-3">
   					<input type="radio" name='toilet' value="yes" onclick="chkradiovalue()">&nbsp;&nbsp;with toilet
   				</div>
   				<div class="col-md-3">
   					<input type="radio" name='toilet' value="no" onclick="chkradiovalue()" checked>&nbsp;&nbsp;without toilet
   				</div>
   				<div class="col-md-3">
   					<input type="text" class="form-control upper text_unit numonly" id="txttoiletqty" name="" placeholder="qty" disabled>
   				</div>
   			</div>  
   			<div class="row form-group">
   				<div class="col-md-3">
   							SQM	
   				</div>
   				<div class="col-md-3">
   			  			<input type="text" class="form-control upper text_unit numonly" id="txtsqm" name="" placeholder="sqm">      		
   				</div>
   				<div class="col-md-6">
   			  			<input type="text" class="form-control upper text_unit numonly amount" id="txtpricepersqm" name="" style="text-align: right;" placeholder="Price per sqm">      		
   				</div>
   			</div>  			   			 		   			
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" onclick="saveunit()"><i class="ace-icon fa fa-check"></i>&nbsp;Save</button>
        </div>
      </div>
      
    </div>
  </div>
