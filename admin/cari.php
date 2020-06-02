<form action="" method="POST" style="font-size: 9pt">
	<label>dari</label>
	<input type="text" name="start" id="tanggal4" value="<?php echo $startDate ?>">
	<label>sampai</label>
	<input type="text" name="end" id="tanggal5" value="<?php echo $endDate ?>">
	<button type="submit" class="btn btn-default btn-xs" name="cari" value="Cari">Ganti Range</button>
</form>

<script type="text/javascript">
    $(function(){
        $("#tanggal4").datepicker({
            dateFormat:'yy/mm/dd',
        });

        $("#tanggal5").datepicker({
            dateFormat:'yy/mm/dd'
        });
    });
</script>