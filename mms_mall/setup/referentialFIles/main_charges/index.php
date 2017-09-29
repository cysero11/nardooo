<div class="container-fluid modules" id="main_ChargesMod" style="display:none;">
	<div class="panel panel-primary">
						<div class="panel-heading">
							<div class="container-fluid">
								<div class="form-horizontal">  <!-- search keyword -->
									<div class="form-group">
										<div class="input-group">
											<span class="input-group-addon"><span class="glyphicon glyphicon-search"></span></span>
											<input type="text" class="form-control" id="txtsearchCharge" onkeyup="displayCharge2()">
										</div>
									</div>
								</div> <!-- end -->
							</div>
						</div>

						<div class="panel-body" style="min-height: 300px;">
							<div class="container-fluid">
								<table class="table">
									<thead>
										<th>Code</th>
										<th>Description</th>
										<th>Amount</th>
									</thead>

									<tbody id="tblref_charges" class="refsss"></tbody>
								</table>
							</div>
						</div>

						<div class="panel-footer">
							<button id="btn-first3" onclick="page3('first')" class="btn btn-info btn-sm"><span class="glyphicon glyphicon-fast-backward"></span></button>
							<button id="btn-prev3" onclick="page3('prev')" class="btn btn-info btn-sm"><span class="glyphicon glyphicon-backward"></span></button>
							<button id="btn-next3" onclick="page3('next')" class="btn btn-info btn-sm"><span class="glyphicon glyphicon-forward"></span></button>
							<button id="btn-last3" onclick="page3('last')" class="btn btn-info btn-sm"><span class="glyphicon glyphicon-fast-forward"></span></button>
						</div>
					</div>

					<hr/>

					<div class="form-horizontal">
						<div class="form-group">
							<label class="control-label col-md-3 col-lg-3"> Code:</label>
							<div class="col-md-3 col-lg-9">
								<input type="text" class="form-control txtCharge" id="chargeCode" readonly>
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-md-3 col-lg-3">Description:</label>
							<div class="col-md-3 col-lg-9">
								<input type="text" class="form-control txtCharge" id="chargeDesc" readonly>
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-md-3 col-lg-3">Amount:</label>
							<div class="col-md-3 col-lg-9">
								<input type="text" class="form-control txtCharge" id="chargeAmount" readonly>
							</div>
						</div>
					</div>

					<div class="btn-group pull-left" id="buttonsCharge">
						<button class="btn btn-primary" onclick="clickAddCharge()"><span class="glyphicon glyphicon-plus-sign"></span> Add</button>
						<button class="btn btn-success" onclick="clickUpdateCharge()"><span class="glyphicon glyphicon-pencil"></span> Edit</button>
						<button class="btn btn-danger" onclick="clickDeleteCharge()"><span class="glyphicon glyphicon-trash"></span> Delete</button>
					</div>

					<div class="btn-group pull-left" style="display: none;" id="savingbuttonsCharge">
						<button class="btn btn-success" onclick="saveCharge()"><span class="glyphicon glyphicon-save"></span> Save</button>
						<button class="btn btn-danger" onclick="cancelbuttonCharge()"><span class="glyphicon glyphicon-trash"></span> Cancel</button>
					</div>

					<div class="btn-group pull-left" style="display: none;" id="updatebuttonsCharge">
						<button class="btn btn-success" onclick="updateCharge()"><span class="glyphicon glyphicon-save"></span> Save</button>
						<button class="btn btn-danger" onclick="cancelbuttonCharge2()"><span class="glyphicon glyphicon-trash"></span> Cancel</button>
					</div>
</div>

<input type="hidden" id="chargecounts">
<input type="hidden" id="hiddenchargeid">
