<div id="pilih">
    <input class="btn btn-default btn-xs btn-active" type="submit" name="submit" value="Ganti Range">
</div>

<div id="pilih2" class="hidden">
    <form action="" method="POST" style="font-size: 12px">
    	<label>dari</label>
    	<input type="text" name="start" id="tanggal3" value="<?php echo $startDate ?>">
    	<label>sampai</label>
    	<input type="text" name="end" id="tanggal4" value="<?php echo $endDate ?>">
    	<input class="btn btn-default btn-xs btn-active" type="submit" name="submit" value="Ganti Range" id="range">
    </form><br>
</div>
    

<script type="text/javascript">
    $(function(){
        $("#tanggal3").datepicker({
            dateFormat:'yy-mm-dd',
        });

        $("#tanggal4").datepicker({
            dateFormat:'yy-mm-dd'
        });
        
        $(document).on('click', '#pilih, #range', function(){
           $('#pilih, #pilih2').toggleClass('hidden'); 
        });  
        
        
    });
</script>