
<?php 
	include("script.php");
	include("printtemplate.php");
 ?>
<input type="hidden" id="hiddencount">
<div class="container-fluid">
	<div class="page-content" style="padding: 0px;">
		<div class="row">
        	<div class="col-xs-12">
        		<div class="panel panel-primary">
					<div class="panel-heading" style="margin-bottom: 10px;">
						<b>System Set Up</b>
						<i id="pangedit" class="glyphicon glyphicon-edit pull-right" onclick="enableedit()"></i>
					</div>
			
					<form method="post" action="#" enctype="multipart/form-data" name="savesetup" id="savesetup">
					<input type="hidden" id="sentry" name="sentry" value="1">
					<input type="hidden" id="wards" name="wards">
		
						

						<div class="row form-group">
							<div class="col-xs-12 col-md-12">
								<div class="col-xs-6 col-md-6">
									<div class="well">
										<div class="row form-group">
											<div class="col-xs-4 col-md-4">
												Corporate Name :
											</div>
											<div class="col-xs-8 col-md-8">
												<input type="text" class="form-control disablemoko" name="txtcorporatename" id="txtcorporatename" style="text-transform:capitalize;" disabled>
											</div>
										</div>
										<div class="row form-group">
											<div class="col-xs-4 col-md-4">
												Address :
											</div>
											<div class="col-xs-8 col-md-8">
												<textarea class="form-control disablemoko" style="height: 60px !important;text-transform:capitalize;resize: none;" name="txtcompanyaddress" id="txtcompanyaddress" disabled></textarea>
											</div>
										</div>
										<div class="row form-group">
											<div class="col-xs-4 col-md-4">
												About :
											</div>
											<div class="col-xs-8 col-md-8">
												<textarea class="form-control disablemoko" style="height: 60px !important;text-transform:capitalize;resize: none;" name="txtcompanyabout" id="txtcompanyabout" disabled></textarea>
											</div>
										</div>
										<div class="row form-group">
											<div class="col-xs-4 col-md-4">
												Email Address :
											</div>
											<div class="col-xs-8 col-md-8">
												<input type="text" class="form-control email-address disablemoko" name="txtcompanyemail" id="txtcompanyemail" disabled>
											</div>
										</div>
										<div class="row form-group">
											<div class="col-xs-4 col-md-4">
												Website :
											</div>
											<div class="col-xs-8 col-md-8">
												<input type="text" class="form-control website-input disablemoko" name="txtwebsite" id="txtwebsite"  disabled placeholder="www.sample.com">
											</div>
										</div>
										<div class="row form-group">
											<div class="col-xs-4 col-md-4">
												Mobile Number :
											</div>
											<div class="col-xs-8 col-md-8">
												<input type="text" class="form-control input-mask-phone disablemoko" name="txtcompanycont" id="txtcompanycont" placeholder="(00)-000-0000" disabled>
											</div>
										</div>
										<div class="row form-group">
											<div class="col-xs-4 col-md-4">
												Telephone Number :
											</div>
											<div class="col-xs-8 col-md-8">
												<input type="text" class="form-control input-mask-tele disablemoko" name="txttelephone" id="txttelephone" disabled placeholder="(00)-000-0000">
											</div>
										</div>
										<div class="row form-group">
											<div class="col-xs-4 col-md-4">
												FAX Number :
											</div>
											<div class="col-xs-8 col-md-8">
												<input type="text" class="form-control input-mask-tele disablemoko" name="txtfax" id="txtfax" disabled placeholder="(00)-000-0000">
											</div>
										</div>
										<div class="row form-group">
											<div class="col-xs-4 col-md-4">
												TIN Number :
											</div>
											<div class="col-xs-8 col-md-8">
												<input type="text" class="form-control disablemoko" name="txtTIN" id="txtTIN" disabled >
											</div>
										</div>
										<div class="row form-group">
											<div class="col-xs-4 col-md-4">
												Max Number of Mall :
											</div>
											<div class="col-xs-8 col-md-8">
												<input type="text" class="form-control numberlang disablemoko" name="txtnumofmall" id="txtnumofmall" disabled maxlength="5">
											</div>
										</div>
										<div class="row form-group">
											<div class="col-xs-4 col-md-4">
												Mall ID Prefix :
											</div>
											<div class="col-xs-8 col-md-8">
												<input type="text" class="form-control disablemoko" name="txtmallprefix" id="txtmallprefix" style="text-transform:uppercase;" disabled maxlength="3">
											</div>
										</div>
										<div class="row form-group">
											<div class="col-xs-4 col-md-4">
												Inquiry ID Prefix :
											</div>
											<div class="col-xs-8 col-md-8">
												<input type="text" class="form-control disablemoko" name="txtinqprefix" id="txtinqprefix" style="text-transform:uppercase;" disabled maxlength="3">
											</div>
										</div>
										<div class="row form-group">
											<div class="col-xs-4 col-md-4">
												Application ID Prefix :
											</div>
											<div class="col-xs-8 col-md-8">
												<input type="text" class="form-control disablemoko" name="txtappprefix" id="txtappprefix" style="text-transform:uppercase;" disabled maxlength="3">
											</div>
										</div>
										<div class="row form-group">
											<div class="col-xs-4 col-md-4">
												Machine No :
											</div>
											<div class="col-xs-8 col-md-8">
												<input type="text" class="form-control disablemoko" name="txtmachineno" id="txtmachineno" disabled>
											</div>
										</div>
										<div class="row form-group">
											<div class="col-xs-4 col-md-4">
												Serial No :
											</div>
											<div class="col-xs-8 col-md-8">
												<input type="text" class="form-control disablemoko" name="txtserialno" id="txtserialno" disabled>
											</div>
										</div>
										<div class="row form-group">
											<div class="col-xs-4 col-md-4">
												Accreditation No :
											</div>
											<div class="col-xs-8 col-md-8">
												<input type="text" class="form-control disablemoko" name="txtaccreditationno" id="txtaccreditationno" disabled>
											</div>
										</div>
									</div>
								</div>
								<div class="col-xs-6 col-md-6">
									<div class="well">
										<div class="row form-group">
											<div class="col-xs-12 col-md-12">
												<h5>Select print template</h5>
											</div>
											<div class="col-xs-12 col-md-12">
												<div class="col-xs-4 col-md-4 pull-right">
													<img height="150" width="150" style="border: 1px dashed #d9d9d9;" id="imgg1">
													<input type="file" id="file1" class=" disablemoko" name="file1" onchange="showimg(1);" disabled>
												</div>
												<div class="col-xs-7 col-md-7">
													<div class="col-xs-6 col-md-6">
														<input type="radio" class="txtcompanytemplate disablemoko" name="txtcompanytemplate" checked="checked" value="1" id="template1" disabled>
															Template 1
														<img src="assets/images/templates/header_template2.png" height="150" width="200" style="border: 1px dashed #d9d9d9;">
													</div>
													<div class="col-xs-6 col-md-6">
														<input type="radio" class="txtcompanytemplate disablemoko" name="txtcompanytemplate" value="2" id="template2" disabled>
															Template 2
														<img src="assets/images/templates/header_template1.png" height="150" width="200" style="border: 1px dashed #d9d9d9;">
													</div>
												</div>
											</div>
										</div>
										<div class="row form-group">
											Software Type 
										</div>
										<div class="row form-group">
		                                    <label>
		                                        <input type="radio" id="mms" name="btnsoftwaretype" value="0" class="btnsoftwaretype disablemoko ace">
		                                        <span class="lbl"> Mall Management System</span>
		                                    </label>
										</div>
										<div class="row form-group">
											<label>
		                                        <input type="radio" id="plms" name="btnsoftwaretype" value="1" class="btnsoftwaretype disablemoko ace">
		                                        <span class="lbl"> Property Leasing Management System</span>
		                                    </label>
										</div>
									</div>
								</div>
							</div>
							
							<button id="savebtn" onclick="checkmachineno()" class="btn btn-info pull-right disablemoko" style="float: right; border: none!important; padding-left: 30px; padding-right: 30px;margin-right: 30px;margin-top: -50px;" disabled>
							    Save
							</button>
						</div>
					</form>
				</div>
			</div>
        </div>
    </div>             
</div>
            
 