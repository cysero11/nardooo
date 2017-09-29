<script type="text/javascript">
	setTimeout(function(){
		clickRefs();
		clickMain();
		// $("#departmentModule").css("display", "block");
		// $("#unit_classMod").css("display", "block");
		// $("#onloadclick").click();
	}, 300)

	function ref(numref) {
		$("#refTitle").text(numref);
	}

	function clickRefs() {
		$("#forReferentials li").each(function(){
			$(this).click(function(){
				$("#forReferentials li").removeClass("active");
				$(this).addClass("active");
			})
		})
	}

	function clickMain() {
		$("#forMaintenance li").each(function(){
			$(this).click(function(){
				$("#forMaintenance li").removeClass("active");
				$(this).addClass("active");
			})
		})
	}

	function refTypes(refVal, refName, moduleName) {
		$("#titleRef").text(refName);
		$(".modules").css("display", "none");
		$("#" + moduleName).css("display", "block");
	}

	function ref(type){
		$(".ref").css("display", "none");
		$("#" + type).css("display", "block");
		if (type == 'refUnit') {
			$('#refTitle').text('Unit');
		}
		else if (type == 'refMaintenance') {
			$('#refTitle').text('Maintenance');
		}
	}
</script>

