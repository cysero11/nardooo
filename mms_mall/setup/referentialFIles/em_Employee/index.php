<div class="container-fluid modules" id="em_Employee" style="display:none;">
	<div class="panel panel-primary">
						<div class="panel-heading">
							<div class="container-fluid">
								<div class="form-horizontal">  <!-- search keyword -->
									<div class="form-group">
										<div class="input-group">
											<span class="input-group-addon"><span class="glyphicon glyphicon-search"></span></span>
											<input type="text" class="form-control" id="txtsearchEmployee" onkeyup="displayEmployee2()">
										</div>
									</div>
								</div> <!-- end -->
							</div>
						</div>

						<div class="panel-body" style="min-height: 300px;">
							<div class="container-fluid">
								<table class="table">
									<thead>
										<th>Assigned Building</th>
										<th>Code</th>
										<th>Department</th>
										<th>Position</th>
										<th>First Name</th>
										<th>Middle Name</th>
										<th>Last Name</th>
									</thead>

									<tbody id="tblEmployee" class="refsss"></tbody>
								</table>
							</div>
						</div>

						<div class="panel-footer">
							<button id="btn-first999" onclick="page999('first')" class="btn btn-info btn-sm"><span class="glyphicon glyphicon-fast-backward"></span></button>
							<button id="btn-prev999" onclick="page999('prev')" class="btn btn-info btn-sm"><span class="glyphicon glyphicon-backward"></span></button>
							<button id="btn-next999" onclick="page999('next')" class="btn btn-info btn-sm"><span class="glyphicon glyphicon-forward"></span></button>
							<button id="btn-last999" onclick="page999('last')" class="btn btn-info btn-sm"><span class="glyphicon glyphicon-fast-forward"></span></button>
						</div>
					</div>

					<hr/>

					<div class="form-horizontal">
						<div class="form-group">
							<label class="control-label col-md-3 col-lg-3"> Assigned Building:</label>
							<div class="col-md-3 col-lg-9">
								<select class="form-control txtEmployee2" id="txtmall" disabled></select>
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-md-3 col-lg-3"> Code:</label>
							<div class="col-md-3 col-lg-9">
								<input type="text" class="form-control txtEmployee" id="EmpCode" readonly>
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-md-3 col-lg-3">Department:</label>
							<div class="col-md-3 col-lg-9">
								<select class="form-control txtEmployee2" id="EmpDepartment" disabled></select>
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-md-3 col-lg-3">Position:</label>
							<div class="col-md-3 col-lg-9">
								<select class="form-control txtEmployee2" id="EmpPosition" disabled></select>
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-md-3 col-lg-3">First Name:</label>
							<div class="col-md-3 col-lg-9">
								<input type="text" class="form-control txtEmployee" id="EmpFN" readonly>
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-md-3 col-lg-3">Middle Name:</label>
							<div class="col-md-3 col-lg-9">
								<input type="text" class="form-control txtEmployee" id="EmpMN" readonly>
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-md-3 col-lg-3">Last Name:</label>
							<div class="col-md-3 col-lg-9">
								<input type="text" class="form-control txtEmployee" id="EmpLN" readonly>
							</div>
						</div>

					</div>

					<div class="btn-group pull-left" id="buttonsEmployee">
						<button class="btn btn-primary" onclick="clickAddEmployee()"><span class="glyphicon glyphicon-plus-sign"></span> Add</button>
						<button class="btn btn-success" onclick="clickUpdateEmployee()"><span class="glyphicon glyphicon-pencil"></span> Edit</button>
						<button class="btn btn-danger" onclick="clickDeleteEmployee()"><span class="glyphicon glyphicon-trash"></span> Delete</button>
					</div>

					<div class="btn-group pull-left" style="display: none;" id="savingbuttonsEmployee">
						<button class="btn btn-success" onclick="saveEmployee()"><span class="glyphicon glyphicon-save"></span> Save</button>
						<button class="btn btn-danger" onclick="cancelbuttonEmployee()"><span class="glyphicon glyphicon-trash"></span> Cancel</button>
					</div>

					<div class="btn-group pull-left" style="display: none;" id="updatebuttonsEmployee">
						<button class="btn btn-success" onclick="updateEmployee()"><span class="glyphicon glyphicon-save"></span> Save</button>
						<button class="btn btn-danger" onclick="cancelbuttonEmployee2()"><span class="glyphicon glyphicon-trash"></span> Cancel</button>
					</div>
</div>

<input type="hidden" id="Employeecounts">
<input type="hidden" id="hiddenemployeeid">
