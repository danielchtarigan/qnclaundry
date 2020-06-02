
<legend>Pelacakan Order</legend>


<div class="row">
	<form class="form-horizontal" action="javascript:;">
		<div class="col-md-6">
			<input class="form-control" placeholder="Scan nomor order di sini .." type="text" name="" id="no_order">
		</div>
		
		<button class="btn btn-success" id="tombol-lacak">Submit</button>
	</form>
</div>
	

<div id="order_terlacak" align="center">
	
</div>


<script type="text/javascript">
	$('form').submit(function(e){
		e.preventDefault();
		no_order = $('#no_order').val();
		$.ajax({
			url 	: '../lacak_order.php',
			data 	: 'no_order='+no_order,
			method 	: 'POST',
			beforeSend : function(){
				$("#order_terlacak").text("Sedang memuat ...");
			},
			success : function(data){
				$("#order_terlacak").html(data);
			}
		})
	})
</script>