<div class="container-fluid modules" id="unit_deptMod">
	<table class="table table-stripped">
		<thead>
			<th>CODE</th>
			<th>DESCRIPTION</th>
		</thead>

		<tbody id="tblcompany" class="refsss"></tbody>
	</table>
</div>

<div class="container-fluid modules" id="unit_ClassMod" style="display: none;">
	<table class="table table-stripped">
		<thead>
			<th>CODE</th>
			<th>DESCRIPTION</th>
		</thead>

		<tbody id="tblcompany" class="refsss"></tbody>
	</table>

	<div class="form-horizontal">
		<div class="form-group">
			<label class="control-label col-md-3 col-lg-3">Dept. Code:</label>
			<div class="col-md-3 col-lg-9">
				<input type="text" class="form-control txtdept" id="deptcode" readonly>
			</div>
		</div>

		<div class="form-group">
			<label class="control-label col-md-3 col-lg-3">Dept. Name:</label>
			<div class="col-md-3 col-lg-9">
				<input type="text" class="form-control txtdept" id="deptname" readonly>
			</div>
		</div>
	</div>

	<div class="btn-group pull-left" id="buttonsDept">
						<button class="btn btn-primary" onclick="clickAddDept()"><span class="glyphicon glyphicon-plus-sign"></span> Add</button>
						<button class="btn btn-success" onclick="clickUpdateDept()"><span class="glyphicon glyphicon-pencil"></span> Edit</button>
						<button class="btn btn-danger" onclick="clickDeleteDept()"><span class="glyphicon glyphicon-trash"></span> Delete</button>
					</div>

					<div class="btn-group pull-left" style="display: none;" id="savingbuttonsDept">
						<button class="btn btn-success" onclick="saveDept()"><span class="glyphicon glyphicon-save"></span> Save</button>
						<button class="btn btn-danger" onclick="cancelbuttonDept()"><span class="glyphicon glyphicon-trash"></span> Cancel</button>
					</div>

					<div class="btn-group pull-left" style="display: none;" id="updatebuttonsDept">
						<button class="btn btn-success" onclick="updateDept()"><span class="glyphicon glyphicon-save"></span> Save</button>
						<button class="btn btn-danger" onclick="cancelbuttonDept2()"><span class="glyphicon glyphicon-trash"></span> Cancel</button>
					</div>
</div>

<div class="container-fluid modules" id="unit_CategoryMod" style="display: none;">
	qwer
</div>

<div class="container-fluid modules" id="unit_IndustryMod" style="display: none;">
	qwer
</div>

<div class="container-fluid modules" id="unit_BankMod" style="display: none;">
	qwer
</div>

<div class="container-fluid modules" id="unit_PositionMod" style="display: none;">
	qwer
</div>

<div class="container-fluid modules" id="unit_ReqMod" style="display: none;">
	qwer
</div>