<script>
$(function(){
		$("#txt_amenitiespage").val("1");
		numonly();
		loadrefamenities();
    	$("#tblamenitieslist").niceScroll({cursorcolor:"#999"});

	    $('.upper').keyup(function() {
            $(this).val($(this).val().toUpperCase());
        });
});

	function loadrefamenities()
		{
			var key = $("#txtsearchamenities").val();
			var page = $("#txt_amenitiespage").val();
			$.ajax({
				type: 'POST',
				url: 'mainclass.php',
				data: 'key=' + key + '&page=' + page + '&form=loadamenities',
				success: function(data)
				{
					$("#tblamenitieslist").html(data);
					$(".scroll").niceScroll({cursorcolor:"#999"});
					loadpaginationamenities();
					loadentriesame();
				}
			})
		}

    function loadpaginationamenities() //added by melanie
        {
            var key = $("#txtsearchamenities").val();
            var page = $("#txt_amenitiespage").val();
            $.ajax({
                type: 'POST',
                url: 'mainclass.php',
                data: 'key=' + key + '&page=' + page + '&form=loadpaginationamenities',
                success: function(data){
                    $("#ulpaginationamenities").html(data);
                }
            }).error(function() {
                alert(data);
            });
        }

    function getvalame(page, pagenums) //added by melanie
        {
            // alert(page);
                $(".pgnumptnts").removeClass("active");
                var value = "#" + pagenums;
                $("#pgptnts" + pagenums).addClass("active");
                $("#txt_amenitiespage").val(page);
                // reloadhmo();
                loadrefamenities();
                loadpaginationamenities();
                loadentriesame();
        }

    function loadentriesame() //added by melanie
        {
            var key = $("#txtsearchamenities").val();
            var page = $("#txt_amenitiespage").val();
            $.ajax({
                type: 'POST',
                url: 'mainclass.php',
                data: 'key=' + key + '&page=' + page + '&form=loadentriesame',
                success: function(data){
                    if(data == "no data")
                    {
                        $("#txtamenitiesentries").text("");
                    }
                    else
                    {
                        $("#txtamenitiesentries").text(data);
                    }
                }
            }).error(function() {
                alert(data);
            });
        }		

	function saveamenities()
	{
		var amenity = $("#txtamenity").val();
		var abbreviation = $("#txtabbreviation").val();
		var id = $("#txtrefamenities").val();

        $.ajax({
        	type: 'POST',
        	url: 'mainclass.php',
        	data: 'amenity=' + amenity + '&abbreviation=' + abbreviation + '&id=' + id + '&form=saveamenities',
        	success: function(data)
        	{
        		if(data == "Already Existing!")
        		{
        			alert(data);
        		}
        		else
        		{
	        		alert(data);
	        		$("#modal_addnewamenities").modal("hide");
	        		loadrefamenities();        			
        		}

        	}
        })
	}

	function editrefame(amenity)
	{
			$.ajax({
				type: 'POST',
				url: 'mainclass.php',
				data: 'id=' + amenity + '&form=editrefame',
				success: function(data)
				{
					var arr = data.split("|");
					$("#txtrefamenities").val(arr[1]);
					$("#txtamenity").val(arr[2]);
					$("#txtabbreviation").val(arr[3]);
					$("#modal_addnewamenities").modal("show");	
				}
			})
	}

	function delrefame(amenity)
	{
		var conf = confirm("Are you sure?");
		if(conf == true)
		{
			$.ajax({
				type: 'POST',
				url: 'mainclass.php',
				data: 'id=' + amenity + '&form=delrefame',
				success: function(data)
				{
					alert(data);
					loadrefamenities();
				}
			})
			
		}

	}
</script>
<div class="row">
	<div class="col-xs-12" style="padding: 10px !important;">
		<div class="pull-left" style="padding-top:10px;">
			<b class="text-primary" style="margin-top: 15px !important;">Amenities List</b>
			<input type="hidden" id="txt_amenitiespage" name="">
		</div>
	</div>
</div>
<div class="row">	
	<div class="col-md-4 col-xs-12">
		<!-- <form class="form-search"> -->
			<span class="input-icon" style="width: 100%;">
				<input type="text" class="form-control" placeholder="Search ..." id="txtsearchamenities" onkeyup="loadrefamenities()">
				<i class="ace-icon fa fa-search nav-search-icon"></i>
			</span>
		<!-- </form> -->
	</div>
	<div class="col-md-6 col-xs-6">
			<!-- <a href="#" id="" class="btn btn-danger btn-sm" style="width: 100% !important;">Delete</a> -->
	</div>
	<div class="col-md-2 col-xs-6">
			<a href="#" id="btn_mall" class="btn btn-default btn-sm" style="width: 100% !important;" onclick="addnewamenities()">New Amenity</a>
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
				<td>Amenity</td>
				<td>Abbreviation</td>
				<td>Option</td>											
			</tr>
		</thead>
		<tbody id="tblamenitieslist" style="flex: 1 1 auto;display: block;height: 16em;overflow-x: hidden;">

		</tbody>
	</table>
	<table class="tabledash_footer table" style="margin: 0px !important;">
        <thead>
            <tr>
                <th id="th_tabledash_footer" width="" colspan="7" style="width: 911px;">
                <font style="float: left; color: #777 !important;margin-top: 17px;margin-left: 15px;font-weight: normal;font-weight: 8px !important;" id="txtamenitiesentries"></font>
                    <div class="pagination">
                        <ul id="ulpaginationamenities"></ul>
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
  <div class="modal fade" id="modal_addnewamenities" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">AMENITIES</h4>
          <input type="hidden" id="txtrefamenities" class="text_amenities" name="">
        </div>
        <div class="modal-body">
     		<div class="row form-group">
     			<div class="col-md-3">
     							Amenity
     			</div>
     			<div class="col-md-9">
     		  			<input type="text" class="form-control text_amenities" id="txtamenity" name="" placeholder="Amenity">      		
     			</div>
     		</div>
     		<div class="row form-group">
     			<div class="col-md-3">
     							Abbreviation
     			</div>
     			<div class="col-md-9">
     		  			<input type="text" class="form-control upper text_amenities" id="txtabbreviation" name="" placeholder="Abbreviation">      		
     			</div>
     		</div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" onclick="saveamenities()"><i class="ace-icon fa fa-check"></i>&nbsp;Save</button>
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

function addnewamenities()
{
	$("#modal_addnewamenities").modal("show");
	$(".text_amenities").val("");
}
</script>