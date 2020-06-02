<?php 
include '../config.php';

?>

<table class="table" id="tabel-customer">
	<tbody>
		<?php 
		$sql2 = mysqli_query($con, "SELECT * FROM customer WHERE no_telp='$_GET[key]' GROUP BY no_telp,nama_customer LIMIT 10");

		if(mysqli_num_rows($sql2)=='0') {
		?>
		<tr>
			<td>
				<b style="color: red;"><em>Customer lama tidak ditemukan!!</em></b><br><br>
				<a href="#" class="btn btn-info" data-toggle="modal" data-target=".tambah-customer">Tambah Customer</a>
			</td>
		</tr>				
		<?php
		}
		else {
		while($data = mysqli_fetch_assoc($sql2)) {			
			?>
			<tr>
				<td>								
					<b>Nama Customer: </b><?= $data['nama_customer'] ?>	<br>
					<b>Alamat : </b><?= $data['alamat']  ?><br>
					<b>No. Telp : </b><?= $data['no_telp']  ?><br>
					<b>Status : </b><?php if($data['lgn']=='1') echo "Langganan"; else if($data['member']=='1') echo "Membership"; else echo "-" ?><br><br>
					<a href="#" class="btn btn-success btn-proses" id="<?= $data['id'] ?>">Proses</a>					
				</td>
			</tr>

			<?php
			}

		
		}
		?>
		
	</tbody>
</table>

<div class="modal fade tambah-customer" id="modal-tambah-customer">
  <div class="modal-dialog">
    <div class="modal-content">
    	<div class="modal-heading">
    		<h3 class="modal-title" align="center" style="margin-top: 15px">Customer Baru</h3>
    	</div>
  		<div class="modal-body">
  			
			<input class="form-control" type="text" name="" id="nama" placeholder="Nama Customer"><br>
			<input class="form-control" type="text" name="" id="alamat" placeholder="Alamat"><br>
			<input class="form-control" type="text" name="" id="telp" placeholder="Nomor HP">
  			<div id="pesan-tambah" style="margin-bottom: 15px; color: red"></div>
  			<div id="pesan-tambah-success" style="margin-bottom: 15px; color: green"></div>
  			<div class="text-center">
	        <button type="button" class="btn btn-lg btn-secondary" data-dismiss="modal">Batal</button>
	        <a id="submit-tcustomer" class="btn btn-lg btn-success">Simpan</a>
	        </div>
      	</div>
    </div>
  </div>
</div>

<div id="trx"></div>


<script type="text/javascript">
	$(document).on('click', '.btn-proses', function(){
		var idkey = $(this).attr('id');
		$('#tabel-customer').addClass('hidden');
		$('#trx').load('transaksi.php?idtrx='+idkey);
	});

	$("#telp").keypress(function(e){       
        var telp = $(this).val();     
        var panj = telp.length;
        if(panj>11) {
            $("#pesan-tambah").html("Maksimal 12 Karakter").fade(fast); 
            return false;
        } 
        if(e.which!=8 && e.which!=0 && (e.which<48 || e.which>57)) {
            $("#pesan-tambah").html("Isikan Angka");
             return false;
        } 
    });

	$('#submit-tcustomer').on('click', function(){
		var nama = $('#nama').val();
		var alamat = $('#alamat').val();
		var telp = $('#telp').val();
		$.ajax({
			url 	: 'action/add_customer.php',
			data 	: 'nama='+nama+'&alamat='+alamat+'&telp='+telp,
			success : function(data) {
				$("#pesan-tambah-success").html(data);
			}
		})
	})
</script>