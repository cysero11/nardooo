<div class="container-fluid modules" id="unit_ClassMod" style="display:none;">
	<div class="panel panel-primary">
						<div class="panel-heading">
							<div class="container-fluid">
								<div class="form-horizontal">  <!-- search keyword -->
									<div class="form-group">
										<div class="input-group">
											<span class="input-group-addon"><span class="glyphicon glyphicon-search"></span></span>
											<input type="text" class="form-control" id="txtsearchunitclass" onkeyup="displayUnitClass2()">
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
									</thead>

									<tbody id="tblref_merchandise_class" class="refsss"></tbody>
								</table>
							</div>
						</div>

						<div class="panel-footer">
							<button id="btn-first900" onclick="page900('first')" class="btn btn-info btn-sm"><span class="glyphicon glyphicon-fast-backward"></span></button>
							<button id="btn-prev900" onclick="page900('prev')" class="btn btn-info btn-sm"><span class="glyphicon glyphicon-backward"></span></button>
							<button id="btn-next900" onclick="page900('next')" class="btn btn-info btn-sm"><span class="glyphicon glyphicon-forward"></span></button>
							<button id="btn-last900" onclick="page900('last')" class="btn btn-info btn-sm"><span class="glyphicon glyphicon-fast-forward"></span></button>
						</div>
					</div>

					<hr/>

					<div class="form-horizontal">
						<div class="form-group">
							<label class="control-label col-md-3 col-lg-3"> Code:</label>
							<div class="col-md-3 col-lg-9">
								<input type="text" class="form-control txtUnitClass" id="classCode" readonly>
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-md-3 col-lg-3">Description:</label>
							<div class="col-md-3 col-lg-9">
								<input type="text" class="form-control txtUnitClass" id="classDesc" readonly>
							</div>
						</div>
					</div>

					<div class="btn-group pull-left" id="buttonsClass">
						<button class="btn btn-primary" onclick="clickAddClass()"><span class="glyphicon glyphicon-plus-sign"></span> Add</button>
						<button class="btn btn-success" onclick="clickUpdateClass()"><span class="glyphicon glyphicon-pencil"></span> Edit</button>
						<button class="btn btn-danger" onclick="clickDeleteClass()"><span class="glyphicon glyphicon-trash"></span> Delete</button>
					</div>

					<div class="btn-group pull-left" style="display: none;" id="savingbuttonsClass">
						<button class="btn btn-success" onclick="saveClass()"><span class="glyphicon glyphicon-save"></span> Save</button>
						<button class="btn btn-danger" onclick="cancelbuttonClass()"><span class="glyphicon glyphicon-trash"></span> Cancel</button>
					</div>

					<div class="btn-group pull-left" style="display: none;" id="updatebuttonsClass">
						<button class="btn btn-success" onclick="updateClass()"><span class="glyphicon glyphicon-save"></span> Save</button>
						<button class="btn btn-danger" onclick="cancelbuttonClass2()"><span class="glyphicon glyphicon-trash"></span> Cancel</button>
					</div>
</div>

<input type="hidden" id="classcounts">
<input type="hidden" id="hiddenclassid">
