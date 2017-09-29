<div class="container-fluid modules" id="main_Equip" style="display:none;">
	<div class="panel panel-primary">
						<div class="panel-heading">
							<div class="container-fluid">
								<div class="form-horizontal">  <!-- search keyword -->
									<div class="form-group">
										<div class="input-group">
											<span class="input-group-addon"><span class="glyphicon glyphicon-search"></span></span>
											<input type="text" class="form-control" id="txtsearchequipCat" onkeyup="showmainequip()">
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
										<th>Floor</th>
										<th>Branch Name</th>
										<th>Status</th>
									</thead>

									<tbody id="tblequipment_category" class="refsss"></tbody>
								</table>
							</div>
						</div>

						<div class="panel-footer">
							<button id="btn-first54" onclick="page54('first')" class="btn btn-info btn-sm"><span class="glyphicon glyphicon-fast-backward"></span></button>
							<button id="btn-prev54" onclick="page54('prev')" class="btn btn-info btn-sm"><span class="glyphicon glyphicon-backward"></span></button>
							<button id="btn-next54" onclick="page54('next')" class="btn btn-info btn-sm"><span class="glyphicon glyphicon-forward"></span></button>
							<button id="btn-last54" onclick="page54('last')" class="btn btn-info btn-sm"><span class="glyphicon glyphicon-fast-forward"></span></button>
						</div>
					</div>

					<hr/>

					<div class="form-horizontal">
						<div class="form-group">
							<label class="control-label col-md-3 col-lg-3"> Code:</label>
							<div class="col-md-3 col-lg-9">
								<input type="text" class="form-control txtequipCat" id="equipCatCode" readonly>
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-md-3 col-lg-3">Description:</label>
							<div class="col-md-3 col-lg-9">
								<input type="text" class="form-control txtequipCat" id="equipCatDesc" readonly>
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-md-3 col-lg-3">Floor:</label>
							<div class="col-md-3 col-lg-9">
								<select class="form-control txtequipCat2" id="eqfloor" disabled></select>
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-md-3 col-lg-3">Branch:</label>
							<div class="col-md-3 col-lg-9">
								<select class="form-control txtequipCat2" id="equnit" disabled></select>
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-md-3 col-lg-3">Status:</label>
							<div class="col-md-3 col-lg-9">
								<select class="form-control txtequipCat2" id="equipCatstatus" disabled>
								<option value="">-- Select Status</option>
								<option value="Operational">Operational</option>
								<option value="Non-Operational">Non-Operational</option>
								<option value="Condemned Unit(Not in use)">Condemned Unit(Not in use)</option></select>
							</div>
						</div>
					</div>

					<div class="btn-group pull-left" id="buttonsequipCat">
						<button class="btn btn-primary" onclick="clickAddequipCat()"><span class="glyphicon glyphicon-plus-sign"></span> Add</button>
						<button class="btn btn-success" onclick="clickUpdateequipCat()"><span class="glyphicon glyphicon-pencil"></span> Edit</button>
						<button class="btn btn-danger" onclick="clickDeleteequipCat()"><span class="glyphicon glyphicon-trash"></span> Delete</button>
					</div>

					<div class="btn-group pull-left" style="display: none;" id="savingbuttonsequipCat">
						<button class="btn btn-success" onclick="saveequipCat()"><span class="glyphicon glyphicon-save"></span> Save</button>
						<button class="btn btn-danger" onclick="cancelbuttonequipCat()"><span class="glyphicon glyphicon-trash"></span> Cancel</button>
					</div>

					<div class="btn-group pull-left" style="display: none;" id="updatebuttonsequipCat">
						<button class="btn btn-success" onclick="updateequipCat()"><span class="glyphicon glyphicon-save"></span> Save</button>
						<button class="btn btn-danger" onclick="cancelbuttonequipCat2()"><span class="glyphicon glyphicon-trash"></span> Cancel</button>
					</div>
</div>

<input type="hidden" id="equipcatcounts">
<input type="hidden" id="hiddenequipcatid">
