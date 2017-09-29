<div class="container-fluid modules" id="main_SetTaskMod" style="display:none;">
	<div class="panel panel-primary">
						<div class="panel-heading">
							<div class="container-fluid">
								<div class="form-horizontal">  <!-- search keyword -->
									<div class="form-group">
										<div class="input-group">
											<span class="input-group-addon"><span class="glyphicon glyphicon-search"></span></span>
											<input type="text" class="form-control" id="txtsearchsettask" onkeyup="displaySetTask()">
										</div>
									</div>
								</div> <!-- end -->
							</div>
						</div>

						<div class="panel-body" style="min-height: 300px;">
							<div class="container-fluid">
								<table class="table">
									<thead>
										<th>Category</th>
										<th>Code</th>
										<th>Description</th>
										<th>Amount</th>
										<th>Equipment</th>
									</thead>

									<tbody id="tblmaintenance_tasklist" class="refsss"></tbody>
								</table>
							</div>
						</div>

						<div class="panel-footer">
							<button id="btn-first57" onclick="page57('first')" class="btn btn-info btn-sm"><span class="glyphicon glyphicon-fast-backward"></span></button>
							<button id="btn-prev57" onclick="page57('prev')" class="btn btn-info btn-sm"><span class="glyphicon glyphicon-backward"></span></button>
							<button id="btn-next57" onclick="page57('next')" class="btn btn-info btn-sm"><span class="glyphicon glyphicon-forward"></span></button>
							<button id="btn-last57" onclick="page57('last')" class="btn btn-info btn-sm"><span class="glyphicon glyphicon-fast-forward"></span></button>
						</div>
					</div>

					<hr/>

					<div class="form-horizontal">

						<div class="form-group">
							<label class="control-label col-md-3 col-lg-3"> Category:</label>
							<div class="col-md-3 col-lg-9">
								<select id="taskcat" class="form-control" disabled></select>
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-md-3 col-lg-3"> Code:</label>
							<div class="col-md-3 col-lg-9">
								<input type="text" class="form-control txtSetTask" id="setTaskCode" readonly>
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-md-3 col-lg-3">Description:</label>
							<div class="col-md-3 col-lg-9">
								<input type="text" class="form-control txtSetTask" id="setTaskDesc" readonly>
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-md-3 col-lg-3">Amount:</label>
							<div class="col-md-3 col-lg-9">
								<input type="text" class="form-control txtSetTask amount numonly" id="setTaskAmount" readonly>
							</div>
						</div>


						<div class="form-group">
							<label class="control-label col-md-3 col-lg-3"> Equipment:</label>
							<div class="col-md-3 col-lg-9">
								<select class="form-control txtSetTask" id="setEquip" disabled>

								</select>
							</div>
						</div>

						<!-- 

						<div class="form-group">
							<label class="control-label col-md-3 col-lg-3"> Bldg:</label>
							<div class="col-md-3 col-lg-9">
								<select class="form-control txtSetTask" id="bldgId" disabled>

								</select>
							</div>
						</div> -->

					</div>

					<div class="btn-group pull-left" id="buttonsSetTask">
						<button class="btn btn-primary" onclick="clickAddSetTask()"><span class="glyphicon glyphicon-plus-sign"></span> Add</button>
						<button class="btn btn-success" onclick="clickUpdateSetTask()"><span class="glyphicon glyphicon-pencil"></span> Edit</button>
						<button class="btn btn-danger" onclick="clickDeleteSetTask()"><span class="glyphicon glyphicon-trash"></span> Delete</button>
					</div>

					<div class="btn-group pull-left" style="display: none;" id="savingbuttonsSetTask">
						<button class="btn btn-success" onclick="saveSetTask()"><span class="glyphicon glyphicon-save"></span> Save</button>
						<button class="btn btn-danger" onclick="cancelbuttonSetTask()"><span class="glyphicon glyphicon-trash"></span> Cancel</button>
					</div>

					<div class="btn-group pull-left" style="display: none;" id="updatebuttonsSetTask">
						<button class="btn btn-success" onclick="updateSetTask()"><span class="glyphicon glyphicon-save"></span> Save</button>
						<button class="btn btn-danger" onclick="cancelbuttonSetTask2()"><span class="glyphicon glyphicon-trash"></span> Cancel</button>
					</div>
</div>

<input type="hidden" id="settaskcounts">
<input type="hidden" id="hiddensettaskid">
