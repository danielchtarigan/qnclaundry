<form action="" method="POST">
	<label>dari</label>
	<input type="text" name="start" id="tanggal1" value="<?php echo $startDate ?>">
	<label>sampai</label>
	<input type="text" name="end" id="tanggal2" value="<?php echo $endDate ?>">
	<button type="submit" class="btn btn-default btn-md" name="cari" value="Cari">Cari</button>
</form><hr>

<script type="text/javascript">
    $(function(){
        $("#tanggal1").datepicker({
            dateFormat:'yy/mm/dd',
        });

        $("#tanggal2").datepicker({
            dateFormat:'yy/mm/dd'
        });
    });
</script>