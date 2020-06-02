<?php 
include '../../config.php';

$query = mysqli_query($con, "SELECT * FROM reception AS a LEFT JOIN customer AS b ON a.id_customer=b.id WHERE a.no_nota='$_GET[order]'");
$data = mysqli_fetch_assoc($query);
if(mysqli_num_rows($query)>0){ ?>
	<div align="center">
	    
		<table style="border: 1px inset; background-color: #EEFDD7; height: 26px; width: 280px; font : 10pt arial; margin-bottom: 15px ">		
			<tr>
				<td>Nama</td>
				<td>:</td>
				<td style="font-weight: bold;"><?php echo $data['nama_customer'] ?></td>
			</tr>
			<tr>
				<td>Telp</td>
				<td>:</td>
				<td style="font-weight: bold;"><?php echo $data['no_telp'] ?></td>
			</tr>
			<tr>
				<td>Item</td>
				<td>:</td>
				<td>
					<?php 
					$detail = mysqli_query($con, "SELECT item FROM detail_penjualan WHERE no_nota='$_GET[order]'");
					while($row = mysqli_fetch_row($detail)){
						echo  $row[0].'<br>';
					}
					?>
				</td>
			</tr>
			<tr>
				<td>Harga</td>
				<td>:</td>
				<td><?php echo number_format($data['total_bayar'],0,',','.') ?></td>
			</tr>
			<tr>
				<td>Rcp Order</td>
				<td>:</td>
				<td><?php echo $data['nama_reception'] ?></td>
			</tr>
		</table>	
	</div>
    <div id="berhasil" style="color: red; font-weight: bold"></div>
	<div>
		<div class="form-group">
			<div class="col-sm-6 col-sm-offset-3">
				<label>
					<input type="radio" name="batal" id="batal" value="void"> Void &nbsp;
					<input type="radio" name="batal" id="batal" value="reject"> Reject	
				</label>
			</div>				
		</div>
		<div class="form-group">
			<div class="col-sm-6 col-sm-offset-3">
				<textarea class="form-control" id="als" name="als" placeholder="Alasan ..."></textarea>							
			</div>
		</div>	
		<div align="center">
			<input class="btn btn-md btn-success" type="submit" name="kirim" id="kirim" value="Kirim">
		</div>
	</div>

	
<?php
}
else echo "Data tidak ditemukan ...";
?>




<script type="text/javascript">
	$('#kirim').on('click', function(e){
		e.preventDefault();
		var batal = $("#batal:checked").val()
		var order = '<?php echo $_GET['order']; ?>';
		var alasan = $('#als').val();
		if(confirm("Apakah anda yakin dengan nota ini?")){
			
			$.ajax({
				url 	: 'action/pembatalan_transaksi.php',
				data 	: 'batal='+batal+'&order='+order+'&als='+alasan,
				success : function(data){
					$('#berhasil').html(data);
				}
			})
		}			
	})
		
</script>