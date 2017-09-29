<?php include("../connect.php"); ?>
<style>
	
	.myupload
	{
		border: dashed 1px #999;
		padding: 15px;
		display: block;
		margin: 15px;
	}
	
	.myupload h1
	{
		font-size: 30px;
		font-weight: 400 !important;
		color: #999;
		text-align: center;
		margin-top: 10px;
		margin-bottom: 20px;
	}
	
	.myupload input[type="file"]
	{ opacity: 0; }
	
	.malltxt
	{
		font-size: 26px;
		margin: 10px;
		font-weight: 800;
		padding: 5px;
		border-bottom: solid 1px #dddddd;
		color: #333;
	}
	
	.wingtxt
	{
		font-size: 16px;
		font-weight: 300;
		margin: 10px;
		padding: 5px;
		color: #666;
	}
</style>
<script>
	$(function(){
		$(".floorlist").niceScroll({ cursorcolor: "#666", width: "8px" });
		loadfloorplan();
	});
	
	function loadwing(mallid)
	{
		$.ajax({
			type: 'POST',
			url: 'tenants/mcp_mainclass.php',
			data: 'mallid=' + mallid + '&form=loadwing',
			beforeSend:function(){
			},
			success: function(data) {
				$("#txtwing").html(data);
			}
		}).error(function() {
			alert(data);
		});
	}
	
	function selectview(type)
	{
		if(type == "thumb")
		{
			$("#floorlist").css("display", "block");
			$("#floorlist2").css("display", "none");
			loadfloorplan();
		}
		else
		{
			$("#floorlist").css("display", "none");
			$("#floorlist2").css("display", "block");
			loadfloorplan2();
		}
	}
	
	function loadfloorplan()
	{
		var mallid = $("#txtmall").val();
		var wingid = $("#txtwing").val();
		$.ajax({
			type: 'POST',
			url: 'tenants/mcp_mainclass.php',
			data: 'mallid=' + mallid + '&wingid=' + wingid + '&type=set&form=loadfloorplan',
			beforeSend:function(){
				$(".myspinner").css("display", "block");
			},
			success: function(data) {
				$(".myspinner").css("display", "none");
				$("#floorlist").html(data);
				addfloorclick();
			}
		}).error(function() {
			alert(data);
		});
	}
	
	function loadfloorplan2()
	{
		var mallid = $("#txtmall").val();
		var wingid = $("#txtwing").val();
		$.ajax({
			type: 'POST',
			url: 'tenants/mcp_mainclass.php',
			data: 'mallid=' + mallid + '&wingid=' + wingid + '&type=set&form=loadfloorplan2',
			beforeSend:function(){
				$(".myspinner").css("display", "block");
			},
			success: function(data) {
				$(".myspinner").css("display", "none");
				$("#floorlist2").html(data);
				$(".cont").niceScroll({
					cursorcolor: "#666",
					cursoropacitymax: 0.5,
					cursorwidth: "10px",
					background: "#dddddd",
					cursorborderradius: "0px",
					cursorborder: "0",
					autohidemode: false,
					cursorminheight: 30,
					oneaxismousemode: "auto"
				});
				addfloorclick2();
			}
		}).error(function() {
			alert(data);
		});
	}
	
	function addfloorclick()
	{
		$("#floorlist li").each(function(){
			var obj = $(this);
			obj.find(".btnedit").click(function(){
				editfloor(obj.attr("id"));
			});
			obj.find(".btndelete").click(function(){
				removefloor(obj.attr("id"));
			});
		});
	}
	
	function addfloorclick2()
	{
		$("#floorlist2 table tbody tr").each(function(){
			var obj = $(this);
			obj.find("td").each(function(){
				var obj2 = $(this);
				obj2.click(function(){
					if(!$(this).hasClass("option"))
					{ viewdetails(obj.attr("id"), obj.find("td").eq(2).text()); }
				});
			});
		});
	}
	
	function addfloorplan()
	{
		$("#txtmall2").val("");
		$("#txtwing2").val("");
		$("#txtfloor2").val("");
		removephoto();
		$("#addfloorplan").modal("show");
	}
	
	function viewdetails(floorid, floorname)
	{
		$("#div_main_cont").load("tenants/floorplan4.php", {"floorid": floorid, "floorname": floorname});
		$("#links li").removeClass("active");
		$("#links li").eq(1).click(function(){
			$("#div_main_cont").load("tenants/floorplan.php");
			$("#links li").eq(2).remove();
			$(this).addClass("active");
		});
		$("#links").append("<li class='active'><a href='#'>Floor Plan</a></li>");
	}
	
	function editfloor(floorid)
	{
		$.ajax({
			type: 'POST',
			url: 'tenants/mcp_mainclass.php',
			data: 'floorid=' + floorid + '&form=editfloor',
			beforeSend:function(){
			},
			success: function(data) {
				var arr = data.split("|");
				removephoto();
				$("#img").attr("src", "server/floorplan/" + floorid + "." + arr[1]);
				$("#img").css("display", "block");
				$("#txtspan").css("display", "none");
				$("#txtclick").css("display", "none");
				$("#addfloorplan").modal("show");
			}
		}).error(function() {
			alert(data);
		});
	}
	
	function removefloor(floorid)
	{
		var conf = confirm("Remove floor plan photo?");
		if(conf == true)
		{
			$.ajax({
				type: 'POST',
				url: 'tenants/mcp_mainclass.php',
				data: 'floorid=' + floorid + '&form=removefloor',
				beforeSend:function(){
				},
				success: function(data) {
					var arr = data.split("|");
					if(arr[1] == "1")
					{
						alert("Floor plan photo has been removed");
						loadfloorplan();
					}
					else
					{ alert(arr[1]); }
				}
			}).error(function() {
				alert(data);
			});
		}
	}
</script>
<div class="page-content">
    <div class="page-header">
        <h1>
            Floor Plan - SET
            <small>
                <i class="ace-icon fa fa-angle-double-right"></i>&nbsp;
                floor layout of units
            </small>
            <div class="pull-right">
            	<button class="btn btn-info" style="margin-top: -10px;" onClick="addfloorplan();"><span class="glyphicon glyphicon-upload"></span>&nbsp;&nbsp;Upload New Floor Plan</button>
            </div>
        </h1>
    </div>
    <div class="row">
        <div class="col-xs-12">
        	<div>
                <div class="row search-page">
                	<div class="col-xs-12">
                        <div class="row">
                            <div class="col-xs-12 col-sm-3">
                                <div class="search-area well well-sm">
                                    <div class="search-filter-header bg-primary">
                                        <h5 class="smaller no-margin-bottom">
                                            <i class="ace-icon fa fa-sliders light-green bigger-130"></i>&nbsp; Refine your Search
                                        </h5>
                                    </div>
                                    <div class="space-10"></div>
                                    <div>
                                    	<p style="margin-bottom: 4px; margin-left: 2px;">Choose Mall</p>
                                        <select class="form-control" id="txtmall" onchange="loadwing(this.value);">
                                        <?php
                                        	$getmall = "select mallid, mallname from tblref_mall";
											$mallresult = mysql_query($getmall);
											echo "<option value=''>Choose Mall</option>";
											while($mall = mysql_fetch_array($mallresult))
											{ echo "<option value='" . $mall[0] . "'>" . $mall[1] . "</option>"; }
										?>
                                        </select>
                                        <div class="space-10"></div>
                                    	<p style="margin-bottom: 4px; margin-left: 2px;">Choose Building/Wing</p>
                                        <select class="form-control" id="txtwing">
                                        	<option value="">Choose Wing</option>
                                        </select>
                                        <div class="space-10"></div>
                                        <button class="btn btn-success" onclick="loadfloorplan();"><span class="glyphicon glyphicon-ok"></span>&nbsp;&nbsp;Submit Search</button>
                                    </div>
								</div>
							</div>
                            <div class="col-xs-12 col-sm-9">
                            	<div class="well well-sm">
                                	<div class="row">
                                    	<div class="col-sm-8 col-xs-7">
                                			<h4 class="blue" style="margin: 5px;">Floor Plan List&nbsp;&nbsp;<small style="font-size: 13px;"><i class="ace-icon fa fa-angle-double-right"></i>&nbsp;Search Floor Plan</small></h4>
                                        </div>
                                    	<div class="col-sm-4 col-xs-5">
                                        	<div class="input-group">
                                            	<span class="input-group-addon">Change View</span>
                                            	<select class="form-control" onchange="selectview(this.value);"><option value="thumb">Thumbnail</option><option value="list">List</option></select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                            	<div class="floorlist" style="height: 400px; margin-top: -5px; overflow-x: hidden !important;">
                                	<div class="myspinner" style="display: none;"></div>
                                    <ul class="ace-thumbnails clearfix" id="floorlist">
                                    </ul>
                                    <div class="table-responsive" id="floorlist2" style="display: none;">
                                    </div>
                                </div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
	$(function(){
		var _URL = window.URL || window.webkitURL;
		
		$("#txtfile").change(function (e) {
			var file, img;
			if ((file = this.files[0])){
				img = new Image();
				img.onload = function(){
					$("#imgwidth").val(this.width)
					$("#imgheight").val(this.height);
				};
				img.src = _URL.createObjectURL(file);
			}
		});
		
		$("#uploadimage").on('submit',(function(e) {
			e.preventDefault();
			$.ajax({
				url: 'tenants/uploadfile.php',
				type: 'POST',
				data: new FormData(this),
				contentType: false,
				cache: false,
				processData: false,
				success: function(data) {
					var arr = data.split("|");
					if(arr[1] == "1")
					{
						alert("Photo has been uploaded.");
						$("#txtmall2").val("");
						$("#txtwing2").val("");
						$("#txtfloor2").val("");
						removephoto();
						$("#addfloorplan").modal("hide");
						loadfloorplan();
					}
					else
					{ alert(arr[1]); }
				}
			}).error(function() {
				alert(data);
			});
		}));
	});
	
	function loadwing2(mallid)
	{
		$.ajax({
			type: 'POST',
			url: 'tenants/mcp_mainclass.php',
			data: 'mallid=' + mallid + '&form=loadwing',
			beforeSend:function(){
			},
			success: function(data) {
				$("#txtwing2").html(data);
				loadfloor2($("#txtwing2 option:first-child").val());
			}
		}).error(function() {
			alert(data);
		});
	}
	
	function loadfloor2(wingid)
	{
		$.ajax({
			type: 'POST',
			url: 'tenants/mcp_mainclass.php',
			data: 'wingid=' + wingid + '&form=loadfloor',
			beforeSend:function(){
			},
			success: function(data) {
				$("#txtfloor2").html(data);
			}
		}).error(function() {
			alert(data);
		});
	}
	
	function checkphoto(floorid)
	{
		$.ajax({
			type: 'POST',
			url: 'tenants/mcp_mainclass.php',
			data: 'floorid=' + floorid + '&form=checkphoto',
			beforeSend:function(){
			},
			success: function(data) {
				var arr = data.split("|");
				if(arr[1] == "1")
				{
					$("#img").css("display", "block");
					$("#txtspan").css("display", "none");
					$("#txtclick").css("display", "none");
					$("#img").attr("src", arr[2]);
				}
			}
		}).error(function() {
			alert(data);
		});
	}
	
	function showimg()
	{
		var oFReader = new FileReader();
		oFReader.readAsDataURL(document.getElementById("txtfile").files[0]);
		
		oFReader.onload = function (oFREvent) {
			$("#img").css("display", "block");
			$("#txtspan").css("display", "none");
			$("#txtclick").css("display", "none");
			document.getElementById("img").src = oFREvent.target.result;
		};
	}
	
	function removephoto()
	{
		$("#img").attr("src", "#");
		$("#img").css("display", "none");
		$("#txtspan").css("display", "block");
		$("#txtclick").css("display", "block");
		$("#txtfile").val("");
	}
</script>
<div class="modal fade" role="dialog" id="addfloorplan">
	<div class="modal-dialog modal-lg">
    	<div class="modal-content">
        	<div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Add Floor Plan</h4>
			</div>
            <div class="modal-body">
            	<form id="uploadimage" action="" method="post" enctype="multipart/form-data">
                	<input type="hidden" name="txttype" value="set">
                    <div class="row">
                        <div class="col-sm-3">
                            <div class="search-area well well-sm">
                                <div class="search-filter-header bg-primary">
                                    <h5 class="smaller no-margin-bottom">
                                        <i class="ace-icon fa fa-asterisk light-green bigger-130"></i>&nbsp; Unit Information
                                    </h5>
                                </div>
                                <div class="space-10"></div>
                                <div>
                                    <p style="margin-bottom: 4px; margin-left: 2px;">Choose Mall</p>
                                    <select class="form-control" id="txtmall2" name="txtmall2" onchange="loadwing2(this.value);">
                                    <?php
                                        $getmall2 = "select mallid, mallname from tblref_mall";
                                        $mallresult2 = mysql_query($getmall2);
                                        echo "<option value=''>Choose Mall</option>";
                                        while($mall2 = mysql_fetch_array($mallresult2))
                                        { echo "<option value='" . $mall2[0] . "'>" . $mall2[1] . "</option>"; }
                                    ?>
                                    </select>
                                    <div class="space-10"></div>
                                    <p style="margin-bottom: 4px; margin-left: 2px;">Choose Building/Wing</p>
                                    <select class="form-control" id="txtwing2" name="txtwing2" onchange="loadfloor2(this.value);">
                                        <option value="">Choose Wing</option>
                                    </select>
                                    <div class="space-10"></div>
                                    <p style="margin-bottom: 4px; margin-left: 2px;">Choose Floor</p>
                                    <select class="form-control" id="txtfloor2" name="txtfloor2" onChange="checkphoto(this.value);" required>
                                        <option value="">Choose Floor</option>
                                    </select>
                                    <br>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-9">
                            <center>
                            <input type="hidden" id="imgwidth" name="imgwidth">
                            <input type="hidden" id="imgheight" name="imgheight">
                            <label class="myupload">
                                <img class="img-responsive" src="#" id="img" style="display: none;">
                                <input type="file" name="txtfile" id="txtfile" onChange="showimg();" required="required">
                                <span class="fa fa-cloud-upload" style="font-size: 80px; color: #999;" id="txtspan"></span>
                                <h1 id="txtclick">Click here to upload picture</h1>
                            </label>
                            <button class="btn btn-success"><span class="glyphicon glyphicon-upload"></span>&nbsp;&nbsp;Upload</button>
                            <div class="btn btn-light" onclick="removephoto();"><span class="glyphicon glyphicon-remove"></span>&nbsp;&nbsp;Remove Photo</div>
                            </center>
                        </div>
                    </div>
                </form>
			</div>
        </div>
	</div>
</div>