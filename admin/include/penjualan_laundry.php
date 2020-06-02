


<div class="p_tanggal" style="margin-bottom: 25px; width: 20%">
	<form action="javascript:" method="POST" style="font-size: 9pt" id="pencarian">
		<input class="form-control" type="text" name="start" id="tanggal" placeholder="Dari Tanggal" autocomplete="off">
		<br>
		<input class="form-control" type="text" name="end" id="tanggal2" placeholder="Sampai Tanggal" autocomplete="off">
		<br>
		<button type="submit" class="btn btn-success" name="cari" value="Cari">Submit</button>
	</form>
</div>


<div id="result-penjualan">	
</div>
	
	


<script type="text/javascript">
	$(function(){
        $("#tanggal").datepicker({
            dateFormat:'yy-mm-dd',
            minDate: '2019-01-01'
        });
        
        $("#tanggal2").datepicker({
            dateFormat:'yy-mm-dd',
            maxDate: 0,
        });
        
        $('#pencarian').submit(function(){
        	tgl = $('#tanggal').val();
	        tgl2 = $('#tanggal2').val();
        	$('#result-penjualan').load('include/result_penjualan.php?tgl='+tgl+'&tgl2='+tgl2);
        })        

    });

	
</script>