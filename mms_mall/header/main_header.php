				<button type="button" class="navbar-toggle menu-toggler pull-left" id="menu-toggler" data-target="#sidebar">
					<span class="sr-only">Toggle sidebar</span>

					<span class="icon-bar"></span>

					<span class="icon-bar"></span>

					<span class="icon-bar"></span>
				</button>

				<div class="navbar-header pull-left">
					<a href="index.php" class="navbar-brand">
						<small id="systemheader">
							<i class="fa"><img src="assets/images/company_logo/ai1_logo.png" style="width: 25px; height: 25px;"></i>
						</small>
					</a>
				</div>
<script type="text/javascript">
$(function(){
	$.ajax({
		type: 'POST',
		url: 'mainclass.php',
		data: 'form=loadheader',
		success:function(data){
			$("#systemheader").html(data);
		}
	})	
});
</script>