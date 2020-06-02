<legend align="center">MASTER TABLE</legend>


	<label>dari</label>
	<input type="text" name="start" id="tanggal1" value="<?php echo $startDate ?>">
	<label>sampai</label>
	<input type="text" name="end" id="tanggal2" value="<?php echo $endDate ?>">
	<input type="submit" class="btn btn-default btn-md" name="cari" value="Cari" id="cari">



<script type="text/javascript">
	$(document).ready(function(){

		$("#tanggal1").datepicker({
            dateFormat:'yy-mm-dd',
        });

        $("#tanggal2").datepicker({
            dateFormat:'yy-mm-dd'
        });

		$('#cari').click(function(){
			var cari = $(this).val();
			var startDate = $('#tanggal1').val();
			var endDate = $('#tanggal2').val();
			$.ajax({
				url : "include/data_master_table.php",
				type : "POST",
				data : {cari : cari, startDate : startDate, endDate : endDate},
				dataType : "html",
				beforeSend : function(){             
             		$("#hasil").html("Sedang Memuat Data Besar....");
         		},
				success : function(data){
					$("#hasil").html(data);	
				}
			})
		})
	})
</script>

<br><br>

<div align="center" id="hasil"></div>

