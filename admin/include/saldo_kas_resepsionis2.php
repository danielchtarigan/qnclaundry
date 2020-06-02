<div class="col-md-12">
	<div class="col-md-6">
		<table>
			<tr>
				<td>
					<input class="form-control" type="text" name="start" id="start" placeholder="Tanggal Awal">
				</td>	
				<td>&nbsp;Sampai&nbsp;</td>	
				<td>
					<input class="form-control" type="text" name="end" id="end" placeholder="Tanggal Akhir">
				</td>
			</tr>
			<tr>
				<td>
					<select class="form-control" id="pilih_nama" name="pilih_nama">
						<option>--Pilih Nama Resepsionis--</option>
						<?php 
						$query = mysqli_query($con, "SELECT name FROM user WHERE level='reception' AND aktif='Ya' AND cabang<>'mojokerto' ORDER BY name ASC");
						while($row = mysqli_fetch_row($query)){
							echo '<option>'.$row[0].'</option>';
						}
						?>
					</select>
				</td>
			</tr>
			<tr>
				<td align="left"><button class="btn btn-md btn-default" id="btn1" name="btn1">Cek</button></td>	
			</tr>	
		</table>
	</div>
</div>
	
<hr>

<div class="col-md-12" id="idn" align="center">
	<!--<div class="col-md-6 col-md-offset-3">-->
	<!--	<table class="table	table-condensed" style="border-style: outset">-->
	<!--		<tr>-->
	<!--			<td>Nama</td>-->
	<!--			<td>:</td>-->
	<!--			<td>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</td>-->
	<!--		</tr>-->
	<!--		<tr>-->
	<!--			<td>Saldo Kas</td>-->
	<!--			<td>:</td>-->
	<!--			<td>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</td>-->
	<!--		</tr>-->
	<!--	</table>-->
	<!--</div>-->
</div>
	


<script type="text/javascript">
	$(document).ready(function(){
		$("#start").datepicker({
            dateFormat:'yy-mm-dd',
        });

        $("#end").datepicker({
            dateFormat:'yy-mm-dd'
        });

		$("#btn1").click(function(){
			var pilih_nama = $("#pilih_nama").val();
			var start = $("#start").val();
			var end = $("#end").val();
			$.ajax({
				url : "data_kas.php",
				type : "GET",
				data : {pilih_nama : pilih_nama, start : start, end : end},
				beforeSend : function(){
					$("#idn").html("Sedang Memuat....");
				},
				success : function(data){
					$("#idn").html(data);
				}
			})
		})
	})
</script>



		