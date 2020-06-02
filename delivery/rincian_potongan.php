<?php 

include '../config.php';

$outlet = $_GET['outlet'];
if($outlet<>'') {
	include 'code_order.php';
}

$idkey = $_GET['idkey']; 

$sql = mysqli_query($con, "SELECT * FROM customer WHERE id='$idkey'");
$data = mysqli_fetch_assoc($sql);

if($data['lgn']=='1'){
	$status = "langganan";
} else if($data['member']=='1') {
	$status = "member";
} else {
	$status = "normal";
} 

date_default_timezone_set('Asia/Makassar');
$nowDate = date('Y-m-d H:i:s');

$item = $_GET['nama_item'];
$harga = $_GET['harga'];
$jumlah = $_GET['jumlah'];
$cabang = "Delivery";
$total = $harga*$jumlah;

if($_GET['nota']<>''){
	$no_nota = $_GET['nota'];
} else {
	$no_nota = $no_order;
}

$customers = mysqli_query($con, "SELECT nama_customer FROM customer WHERE id='$idkey'");
$cust = mysqli_fetch_row($customers)[0];


$order_tmp = mysqli_query($con, "SELECT * FROM order_potongan_tmp WHERE no_nota='$no_nota'");

if(mysqli_num_rows($order_tmp)>0) {
	$dorder = mysqli_fetch_assoc($order_tmp);
	$no_so = $dorder['no_so'];

	mysqli_query($con, "INSERT INTO order_potongan_tmp (tgl,no_nota,no_so,id_customer,item,harga,jumlah,cabang) VALUES ('$nowDate','$no_nota','$no_so','$idkey','$item','$harga','$jumlah','$cabang') ");
	mysqli_query($con, "INSERT INTO detail_penjualan (tgl_transaksi,item,harga,jumlah,total,no_nota,id_customer) VALUES ('$nowDate','$item','$harga','$jumlah','$total','$no_nota','$idkey') ");

} else {
	mysqli_query($con, "INSERT INTO order_potongan_tmp (tgl,no_nota,no_so,id_customer,item,harga,jumlah,cabang) VALUES ('$nowDate','$no_nota','$no_so','$idkey','$item','$harga','$jumlah','$cabang') ");
	mysqli_query($con, "INSERT INTO detail_penjualan (tgl_transaksi,item,harga,jumlah,total,no_nota,id_customer) VALUES ('$nowDate','$item','$harga','$jumlah','$total','$no_nota','$idkey') ");
	
    $kat_item = mysqli_fetch_array(mysqli_query($con, "SELECT kategory FROM item_spk WHERE nama_item='$item'"))[0];

	    
		if($kat_item=='4' OR $kat_item=='5' OR $kat_item=='6'){
			$katItem = "P1";
		}
		else if($kat_item=='7'){
			$katItem = "P2";
		}
		else if($kat_item=='8' OR $kat_item=='9'){
			$katItem = "P3";
		}

	mysqli_query($con, "INSERT INTO reception (tgl_input,nama_reception,id_customer,nama_customer,no_nota,no_so,cabang,nama_outlet,jenis,kategori_item) VALUES ('$nowDate','$user','$idkey','$cust','$no_nota','$no_so','$cabang','$outlet','p','$katItem') ");
}


?>

<h3>Rincian Potongan</h3>
<form class="form-horizontal">
	<div class="form-group">
		<div class="col-xs-12">
			<table class="table table-striped table-condensed">
				<thead>
					<tr>
						<th>No</th>
						<th>Nama Item</th>
						<th>Harga</th>
						<th>Jumlah</th>
						<th>Total</th>
					</tr>
				</thead>
				<tbody>
					<?php 
					$no = 1;
					$order_tmp2 = mysqli_query($con, "SELECT * FROM order_potongan_tmp WHERE no_nota='$no_nota' AND new_nota=''");
					if(mysqli_num_rows($order_tmp2)>0) {
						$rinc_pots = mysqli_query($con, "SELECT * FROM order_potongan_tmp WHERE id_customer='$idkey' AND no_nota='$no_nota' ORDER BY id ASC");
					} else {
						$rinc_pots = mysqli_query($con, "SELECT * FROM order_potongan_tmp WHERE id_customer='$idkey' ORDER BY id ASC");
					}
					
					while($rpots = mysqli_fetch_array($rinc_pots)) {
						?>
						<tr>
							<td><?= $no; ?></td>
							<td><?= $rpots['item'] ?></td>
							<td><?= $rpots['harga'] ?></td>
							<td><?= $rpots['jumlah'] ?></td>
							<td><?= $rpots['harga']*$rpots['jumlah']; ?></td>
						</tr>
						
						<?php
						$no++;
					}

					?>
				</tbody>
			</table>
		</div>			
	</div>

	<div class="form-group">
		<div class="col-xs-12">
			<a href="#" class="btn btn-danger btn-cancelp">Batal</a>
			<a href="#" class="btn btn-default btn-add" style="background: grey; color: #fff">Tambah</a>
			<a href="#" class="btn btn-success btn-nextp">Berikutnya <span class="glyphicon glyphicon-step-forward"></span></a>
		</div>
	</div>
</form>


<script type="text/javascript">
	$('.btn-add').on('click', function(){
		$('#proses_potongan').addClass('hidden');
		var nota = '<?= $no_nota ?>';
		var idkey = '<?= $idkey ?>';
		$('#rincian_potongan').load('tambah_item_potongan.php?nota='+nota+'&idkey='+idkey).removeClass('hidden');
	});

	$(document).on('click', '.btn-nextp', function(){
		$('#rincian_potongan').addClass('hidden');
		$('#pro-expressp').removeClass('hidden');
		$('#no_notap').val('<?= $no_nota ?>');
	})
</script>