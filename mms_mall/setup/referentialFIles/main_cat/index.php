<style type="text/css">
	.zoom {
      display:inline-block;
      position: relative;
    }
    .zoom:after {
      content:'';
      display:block; 
      width:33px; 
      height:33px; 
      position:absolute; 
      top:0;
      right:0;
      background:url(icon.png);
    }
    .zoom img::selection { background-color: transparent; }
</style>

<div class="container-fluid modules" id="main_CatMod" style="display:none;">
	<div class="panel panel-primary">
						<div class="panel-heading">
							<div class="container-fluid">
								<div class="form-horizontal">  <!-- search keyword -->
									<div class="form-group">
										<div class="input-group">
											<span class="input-group-addon"><span class="glyphicon glyphicon-search"></span></span>
											<input type="text" class="form-control" id="txtsearchMainCat" onkeyup="displayMainCat2()">
										</div>
									</div>
								</div> <!-- end -->
							</div>
						</div>

						<div class="panel-body" style="min-height: 300px;">
							<div class="container-fluid">
								<table class="table">
									<thead>
										<th>Icon</th>
										<th>Code</th>
										<th>Description</th>
									</thead>

									<tbody id="tblmaintenance_category" class="refsss"></tbody>
								</table>
							</div>
						</div>

						<div class="panel-footer">
							<button id="btn-first103" onclick="page103('first')" class="btn btn-info btn-sm"><span class="glyphicon glyphicon-fast-backward"></span></button>
							<button id="btn-prev103" onclick="page103('prev')" class="btn btn-info btn-sm"><span class="glyphicon glyphicon-backward"></span></button>
							<button id="btn-next103" onclick="page103('next')" class="btn btn-info btn-sm"><span class="glyphicon glyphicon-forward"></span></button>
							<button id="btn-last103" onclick="page103('last')" class="btn btn-info btn-sm"><span class="glyphicon glyphicon-fast-forward"></span></button>
						</div>
					</div>

					<hr/>

					<div class="form-horizontal">
						<div class="form-group androidicon" style="display: none;">
							<form method="post" name="posting_icon" id="posting_icon">
								<div class="col-md-5 col-lg-5">
									<input type="hidden" id="pinaghuhugutan" name="pinaghuhugutan">
								</div>
								<div class="col-md-2 col-lg-2">
									<label class="myupload" style="border: none;">
		                                <img class="img-responsive" id="imahengmetro" style="display: none;" src="">
		                                <input type="file" name="androidicon" id="androidicon" onchange="showpic();" style="display: none;">
		                                <span class="fa fa-cloud-upload" style="font-size: 60px; color: rgb(153, 153, 153); display: block;text-align: center;" id="logongupload"></span>
		                            <h6 id="textngupload">Click here to upload picture</h6>
		                            </label>
	                        		<div class="btn btn-light" id="btnremovephoto" onclick="removephoto();" style="width: auto; display: none;"><span class="glyphicon glyphicon-remove"></span>&nbsp;&nbsp;Remove Photo</div>
								</div>
								<div class="col-md-5 col-lg-5">
									
								</div>
							</form>
						</div>
						<div class="form-group">
							<label class="control-label col-md-3 col-lg-3"> Code:</label>
							<div class="col-md-3 col-lg-9">
								<input type="text" class="form-control txtMainCat" id="MainCatCode" readonly>
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-md-3 col-lg-3">Description:</label>
							<div class="col-md-3 col-lg-9">
								<input type="text" class="form-control txtMainCat" id="MainCatDesc" readonly>
							</div>
						</div>
					</div>

					<div class="btn-group pull-left" id="buttonsMainCat">
						<button class="btn btn-primary" onclick="clickAddMainCat()"><span class="glyphicon glyphicon-plus-sign"></span> Add</button>
						<button class="btn btn-success" onclick="clickUpdateMainCat()"><span class="glyphicon glyphicon-pencil"></span> Edit</button>
						<button class="btn btn-danger" onclick="clickDeleteMainCat()"><span class="glyphicon glyphicon-trash"></span> Delete</button>
					</div>

					<div class="btn-group pull-left" style="display: none;" id="savingbuttonsMainCat">
						<button class="btn btn-success" onclick="saveMainCat()"><span class="glyphicon glyphicon-save"></span> Save</button>
						<button class="btn btn-danger" onclick="cancelbuttonMainCat()"><span class="glyphicon glyphicon-trash"></span> Cancel</button>
					</div>

					<div class="btn-group pull-left" style="display: none;" id="updatebuttonsMainCat">
						<button class="btn btn-success" onclick="updateMainCat()"><span class="glyphicon glyphicon-save"></span> Save</button>
						<button class="btn btn-danger" onclick="cancelbuttonMainCat2()"><span class="glyphicon glyphicon-trash"></span> Cancel</button>
					</div>
</div>
<input type="hidden" id="maincatcounts">
<input type="hidden" id="hiddenmaincatid">
