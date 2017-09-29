<div class="container-fluid modules" id="unit_ReqMod" style="display:none;">
	<div class="panel panel-primary">
						<div class="panel-heading">
							<div class="container-fluid">
								<div class="form-horizontal">  <!-- search keyword -->
									<div class="form-group">
										<div class="input-group">
											<span class="input-group-addon"><span class="glyphicon glyphicon-search"></span></span>
											<input type="text" class="form-control" id="txtsearchreq" onkeyup="displayReq2()">
										</div>
									</div>
								</div> <!-- end -->
							</div>
						</div>

						<div class="panel-body" style="min-height: 300px;">
							<div class="container-fluid">
								<table class="table">
									<thead>
										<th>Description</th>
										<th>Override</th>
									</thead>

									<tbody id="tblref_applicationrequirements" class="refsss"></tbody>
								</table>
							</div>
						</div>

						<div class="panel-footer">
							<button id="btn-first907" onclick="page907('first')" class="btn btn-info btn-sm"><span class="glyphicon glyphicon-fast-backward"></span></button>
							<button id="btn-prev907" onclick="page907('prev')" class="btn btn-info btn-sm"><span class="glyphicon glyphicon-backward"></span></button>
							<button id="btn-next907" onclick="page907('next')" class="btn btn-info btn-sm"><span class="glyphicon glyphicon-forward"></span></button>
							<button id="btn-last907" onclick="page907('last')" class="btn btn-info btn-sm"><span class="glyphicon glyphicon-fast-forward"></span></button>
						</div>
					</div>

					<hr/>

					<div class="form-horizontal">
						<div class="form-group">
							<label class="control-label col-md-3 col-lg-3">Override</label>
							<div class="col-md-1 col-lg-1"></div>
							<div class="col-md-2 col-lg-2">
								<div class="radio">
	                                <label>
		                                <input name="form-field-radio" type="radio" class="ace override" value="1">
		                                <span class="lbl">&nbsp;&nbsp;&nbsp;Yes</span>
	                                </label>
	                             </div>
							</div>
							<div class="col-md-2 col-lg-2">
								<div class="radio">
	                                <label>
		                                <input name="form-field-radio" type="radio" class="ace override" value="0">
		                                <span class="lbl">&nbsp;&nbsp;&nbsp;No</span>
	                                </label>
	                             </div>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-md-3 col-lg-3">Description:</label>
							<div class="col-md-3 col-lg-9">
								<input type="text" class="form-control txtReq" id="reqDesc" readonly>
							</div>
						</div>
					</div>

					<div class="btn-group pull-left" id="buttonsReq">
						<button class="btn btn-primary" onclick="clickAddReq()"><span class="glyphicon glyphicon-plus-sign"></span> Add</button>
						<button class="btn btn-success" onclick="clickUpdateReq()"><span class="glyphicon glyphicon-pencil"></span> Edit</button>
						<button class="btn btn-danger" onclick="clickDeleteReq()"><span class="glyphicon glyphicon-trash"></span> Delete</button>
					</div>

					<div class="btn-group pull-left" style="display: none;" id="savingbuttonsReq">
						<button class="btn btn-success" onclick="saveReq()"><span class="glyphicon glyphicon-save"></span> Save</button>
						<button class="btn btn-danger" onclick="cancelbuttonReq()"><span class="glyphicon glyphicon-trash"></span> Cancel</button>
					</div>

					<div class="btn-group pull-left" style="display: none;" id="updatebuttonsReq">
						<button class="btn btn-success" onclick="updateReq()"><span class="glyphicon glyphicon-save"></span> Save</button>
						<button class="btn btn-danger" onclick="cancelbuttonReq2()"><span class="glyphicon glyphicon-trash"></span> Cancel</button>
					</div>
</div>

<input type="hidden" id="reqcounts">
<input type="hidden" id="hiddenreqid">
