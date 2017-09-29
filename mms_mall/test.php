<script type="text/javascript">
$(function(){
		$("#sys_body").niceScroll({cursorcolor:"#999"});
		$.ajax({
			type: 'POST',
			url: 'mainclass.php',
			data: 'form=getuserdata',
			success: function(data)
			{
				// alert(data)
				var arr = data.split("|");
				if(arr[0] == ""){
				$("#lbluser").text("Gatessoft Corp");
				showrestrictedsidenav();
				}else{
				$("#lbluser").text(arr[0]);
				}
				$("#imguser").attr("alt", arr[0] +"'s Photo");
				$("#imguser").attr("src",arr[3])
				$("#txt_syssetup").val(arr[2]);
			}
		})
});
function showrestrictedsidenav(){
	$("#nakatagodimomakikitakahitgumamitkangmahika").css("display", "block");
}
</script>
