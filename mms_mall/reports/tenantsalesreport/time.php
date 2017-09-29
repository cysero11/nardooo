<script type="text/javascript">
	$(function() {
		// alert();
	})

	setInterval(function(){
		getTheTime();
		// alert();
	}, 50000)

	function getTheTime() {
		$.ajax ({
			type: 'POST',
			url: 'reports/class.php',
			data: 'form=syncFiles',
			success: function(data) {
				if ( data == 1 ) {
					savecsv2();
				}
			}
		})
	}


	function savecsv2() {
		// alert();
		$.ajax ({
			type: 'POST',
			url: 'reports/class2.php',
			data: 'form=importcsv',
			beforeSend: function() {
				$("#loadingSync2").modal("show");
			},
			success: function(data) {
				// alert();
				$("#loadingSync2").modal("hide");
				$("#alertStat2").text("Files Successfully Synced.");
				$("#modalAlert2").modal("show");

				// yearpie();
				// sycndata();
				

					
			}
		})
	}
</script>

<div class="modal fade" id="modalAlert2">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header">
				System Alert
			</div>

			<div class="modal-body">
				<center><h3 id="alertStat2">Time has been set. . .</h3></center>
			</div>

			<div class="modal-footer">
				<button class="btn btn-info" data-dismiss="modal"><span class="glyphicon glyphicon-thumbs-up"></span> OK</button>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="loadingSync2" data-backdrop="static" style="margin-top: 20% !important;">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header">
				Loading. Please wait while files are syncing...
			</div>
			<div class="modal-body row">
				<div class="container-fluid">
					<center>
						<span class="fa fa-spinner fa-spin fa-3x fa-fw" style="font-size: 80px;"></span>
					</center>
				</div>
			</div>
		</div>
	</div>
</div>