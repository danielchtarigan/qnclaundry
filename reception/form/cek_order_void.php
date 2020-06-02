<?php 
include '../../config.php';

$query = mysqli_query($con, "SELECT * FROM reception AS a LEFT JOIN customer AS b ON a.id_customer=b.id WHERE a.no_nota='$_GET[order]'");
$data = mysqli_fetch_assoc($query);
if(mysqli_num_rows($query)>0){ ?>
	<div align="center">
	    
		<table style="border: 1px inset; background-color: #EEFDD7; height: 26px; width: 280px; font : 10pt arial; margin-bottom: 15px ">		
			<tr>
				<td style="padding: 4px 8px; border: 1px solid #dedfde">Nama</td>
				<td style="padding: 4px 8px; border: 1px solid #dedfde">:</td>
				<td style="font-weight: bold; padding: 4px 8px; border: 1px solid #dedfde"><?php echo $data['nama_customer'] ?></td>
			</tr>
			<tr>
				<td style="padding: 4px 8px; border: 1px solid #dedfde">Telp</td>
				<td style="padding: 4px 8px; border: 1px solid #dedfde">:</td>
				<td style="font-weight: bold; padding: 4px 8px; border: 1px solid #dedfde"><?php echo $data['no_telp'] ?></td>
			</tr>
			<tr>
				<td style="padding: 4px 8px; border: 1px solid #dedfde">Item</td>
				<td style="padding: 4px 8px; border: 1px solid #dedfde">:</td>
				<td style="padding: 4px 8px; border: 1px solid #dedfde">
					<?php 
					$detail = mysqli_query($con, "SELECT item FROM detail_penjualan WHERE no_nota='$_GET[order]'");
					while($row = mysqli_fetch_row($detail)){
						echo  $row[0].'<br>';
					}
					?>
				</td>
			</tr>
			<tr>
				<td style="padding: 4px 8px; border: 1px solid #dedfde">Harga</td>
				<td style="padding: 4px 8px; border: 1px solid #dedfde">:</td>
				<td style="padding: 4px 8px; border: 1px solid #dedfde"><?php echo number_format($data['total_bayar'],0,',','.') ?></td>
			</tr>
			<tr>
				<td style="padding: 4px 8px; border: 1px solid #dedfde">Rcp Order</td>
				<td style="padding: 4px 8px; border: 1px solid #dedfde">:</td>
				<td style="padding: 4px 8px; border: 1px solid #dedfde"><?php echo $data['nama_reception'] ?></td>
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
	$('#kirim').click(function(){
		if(confirm("Apakah anda yakin dengan nota ini?")){
			var batal = $("#batal:checked").val()
			var order = '<?php echo $_GET['order']; ?>';
			var alasan = $('#als').val();
			$.ajax({
				url 	: 'act/pembatalan_transaksi.php',
				data 	: 'batal='+batal+'&order='+order+'&als='+alasan,
				success : function(data){
					$('#berhasil').html(data);
				}
			})
		}			
	})
		
</script>