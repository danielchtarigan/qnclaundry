<?php 
include '../../config.php';


$query = mysqli_query($con, "SELECT * FROM faktur_penjualan AS a LEFT JOIN customer AS b ON a.id_customer=b.id WHERE a.no_faktur='$_GET[faktur]'");
$data = mysqli_fetch_assoc($query);
if(mysqli_num_rows($query)>0){ ?>

	<div align="center">
		<table style="border: 1px inset; background-color: #EEFDD7; height: 26px; width: 280px; font : 10pt arial; margin-bottom: 15px ">		
			<tr>
				<td>Nama</td>
				<td>:</td>
				<td style="font-weight: bold"><?php echo $data['nama_customer'] ?></td>
			</tr>
			<tr>			
				<td>Jenis Transaksi</td>
				<td>:</td>
				<td><?php if($data['jenis_transaksi']=='membership') echo "Admin Membership"; else if ($data['jenis_transaksi']=='deposit') echo "Deposit Langganan"; else if ($data['jenis_transaksi']=='ritel') echo "Retail"; ?>				
				</td>			
			</tr>
			<?php
			if($data['jenis_transaksi']=='ritel'){ 
				$detail = mysqli_query($con, "SELECT no_nota, total_bayar FROM reception WHERE no_faktur='$_GET[faktur]'");
				while($row = mysqli_fetch_row($detail)){
				?>
			<tr>
				<td><?php echo '->&nbsp;'. $row[0]; ?></td>
				<td>:</td>
				<td><?php echo number_format($row[1],0,',','.'); ?></td>
				
			</tr>
			<?php
				}
			}
			?>
			<tr>
				<td>Total Harga</td>
				<td>:</td>
				<td style="font-weight: bold"><?php echo number_format($data['total'],0,',','.') ?></td>
			</tr>
			<tr>
				<td>Tgl Bayar</td>
				<td>:</td>
				<td><?php echo date('d M Y H:i:s', strtotime($data['tgl_transaksi'])) ?></td>
			</tr>

		</table>
	</div>

	<div class="form-group">
		<label for="carabayar" class="control-label col-sm-3">Cara Bayar</label>
		<div class="col-sm-6">
			<select class="form-control" id="carabayar" name="carabayar" required>
				<option><?php echo $data['cara_bayar'] ?></option>
				<option value="Cash">Cash</option>
				<option value="BNI">BNI</option>
				<option value="BRI">BRI</option>
				<option value="MANDIRI">MANDIRI</option>
				<option value="BCA">BCA</option>
				<option value="Kuota">Kuota</option>
			</select>
		</div>
	</div>			

	<div>
		<div class="form-group">
			<div class="col-sm-6 col-sm-offset-3">
				<textarea class="form-control" id="ket" name="ket" placeholder="Keterangan ..."></textarea>							
			</div>
		</div>	
		<div align="center">
			<input class="btn btn-md btn-success" type="submit" name="kirim2" id="kirim2" value="Kirim">
		</div>
	</div>

<?php
}

else {
	echo "Data tidak ditemukan ...";
}

?>

<div id="berhasil2"></div>

<script type="text/javascript">
	$('#kirim2').on('click', function(e){
		e.preventDefault();
		var ubah = "ubah";
		var faktur = '<?php echo $_GET['faktur']; ?>';
		var bayar = $('#carabayar').val();
		var ket = $('#ket').val();
		$.ajax({
			url 	: 'action/ubah_pembayaran.php',
			data 	: 'ubah='+ubah+'&faktur='+faktur+'&bayar='+bayar+'&ket='+ket,
			success : function(data){
				$('#berhasil2').html(data);
			}
		})
	})
</script>