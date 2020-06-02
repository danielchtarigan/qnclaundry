<?php
///rupiah adalah fungsi yang nantinya akan kita panggil
function rupiah($angka)
{
	$jadi = "Rp.".number_format($angka,0,',','.');
	return $jadi;
}
session_start();
$us = $_SESSION['user_id'];
$ot = $_SESSION['nama_outlet'];
?>
<?php
include "../config.php";
$op = isset($_GET['op'])?$_GET['op']:null;
if($op == 'tambah'){
	date_default_timezone_set('Asia/Makassar');
	$jam     = date("Y-m-d H:i:s");
	$id_cs   = $_GET['id_cs'];
	$jumlah  = $_GET['jumlah'];
	$no_nota = $_GET['no_nota'];
	$total   = $_GET['total'];
	$jenis   = "deposit";

	$tambah  = mysqli_query($con," update customer set sisa_kuota='$total' WHERE id='$id_cs'");
	$tambah  = mysqli_query($con,"insert into detail_lgn (jenis_transaksi,jumlah_transaksi,id_customer,tgl_transaksi,no_nota) VALUES('1','$jumlah','$id_cs','$jam','$no_nota')");

	if($tambah){
		$edit = mysqli_query($con,"SELECT * FROM customer WHERE id='$id_cs'");
		$r    = mysqli_fetch_array($edit);
		$total= rupiah($_GET['total']);


		echo "<form method=POST >
		<input type=hidden name=id value=$r[id]>
		<table width=100%>
		<tr>
		<td style='width:50px'>
		Nama Customer
		</td>
		<td> : $r[nama_customer]</td>
		</tr>

		<tr><td>
		No Nota</td>
		<td> : $no_nota</td>
		</tr>
		<tr><td>
		Jenis :</td>
		<td> : $jenis</td>
		</tr>
		<tr>
		<td>Transaksi</td>
		<td> :  $jumlah</td>
		</tr>
		<tr>
		<td>Sisa Kuota</td>
		<td> :  $total</td>
		</tr>

		</table></form>";
	}
	else
	{
		echo "ERROR";
	}
}
elseif($op == 'up_cst_lgn'){
	date_default_timezone_set('Asia/Makassar');
	$jam    = date("Y-m-d H:i:s");
	$id     = $_GET['id'];

	$tambah = mysqli_query($con," update customer set lgn=1 WHERE id='$id'");

	if($tambah){
		header("location: admin/index.php");
		echo "sukses";

	}
	else
	{
		echo "ERROR";
	}
}

elseif($op == 'up_cst_member'){
	date_default_timezone_set('Asia/Makassar');
	$jam      = date("Y-m-d H:i:s");
	$id       = $_GET['id'];
	$jenis    = $_GET['jenis'];
	$tgl_join = $_GET['tgl_join'];
	$tgl_akhir= $_GET['tgl_akhir'];


	$tambah   = mysqli_query($con," update customer set member=1 , jenis_member='$jenis',tgl_join='$tgl_join',tgl_akhir='$tgl_akhir' WHERE id='$id'");

	if($tambah){
		echo "sukses";
	}
	else
	{
		echo "ERROR";
	}
}























elseif($op == 'kurang'){
	date_default_timezone_set('Asia/Makassar');
	$jam     = date("Y-m-d H:i:s");
	$id_cs   = $_GET['id_cs'];
	$jumlah  = $_GET['jumlah'];
	$no_nota = $_GET['no_nota'];
	$total   = $_GET['total'];
	$jenis   = "pemakaian";
	$tambah  = mysqli_query($con," update customer set sisa_kuota='$total' WHERE id='$id_cs'");
	$tambah  = mysqli_query($con,"insert into detail_lgn (jenis_transaksi,jumlah_transaksi,id_customer,tgl_transaksi,no_nota) VALUES('0','$jumlah','$id_cs','$jam','$no_nota')");

	if($tambah){
		$edit = mysqli_query($con,"SELECT * FROM customer WHERE id='$id_cs'");
		$r    = mysqli_fetch_array($edit);
		$total= rupiah($_GET['total']);
		echo "<form method=POST >
		<input type=hidden name=id value=$r[id]>
		<table width=100%>
		<tr>
		<td style='width:50px'>
		Nama Customer
		</td>
		<td> : $r[nama_customer]</td>
		</tr>

		<tr><td>
		No Nota</td>
		<td> : $no_nota</td>
		</tr>
		<tr>
		<tr><td>
		Jenis :</td>
		<td> : $jenis</td>
		</tr>
		<tr>
		<td>Transaksi</td>
		<td> :  $jumlah</td>
		</tr>
		<tr>
		<td>Sisa Kuota</td>
		<td> :  $total</td>
		</tr>

		</table></form>";
	}
	else
	{
		echo "no nota sudah ada";
	}
}

elseif($op == 'tambah_customer'){
	date_default_timezone_set('Asia/Makassar');
	$jam            = date("Y-m-d H:i:s");

	$nama_customer1 = $_GET['nama_customer1'];
	$alamat1        = $_GET['alamat1'];
	$no_telp1       = $_GET['no_telp1'];

	$con->query("INSERT INTO customer(nama_customer,alamat,no_telp) VALUES ('$nama_customer1','$alamat1','$no_telp1')");

	if($con){
		echo "sukses";
	}
	else
	{
		echo "ERROR";
	}
}


elseif($op == 'customer'){
	?><?PHP
	date_default_timezone_set('Asia/Makassar');
	$jam   = date("Y-m-d H:i:s");
	$id_cs = $_GET['id_cs'];
	$sql   = $con->query("select * from customer WHERE id = '$id_cs'");
	$r     = $sql->fetch_assoc();
	?>
	<div class="row equal">
		<div  class="col-md-6 col-xs-6 col-sm-6" style="font-size: 30px" >

		</div>
		<div  class="col-md-6 col-xs-6 col-sm-6" >

			<label class="control-label col-xs-10 col-xs-offset-0">
				Nama Customer : <?php echo $r['nama_customer'] ?>
			</label>
			<label class="control-label col-xs-10 col-xs-offset-0">
				Alamat : <?php echo $r['alamat'] ?>
			</label>
			<label class="control-label col-xs-10 col-xs-offset-0">
				No Telp : <?php echo $r['no_telp'] ?>
			</label>
			<label class="control-label col-xs-10 col-xs-offset-0">
				Email: <?php echo $r['email'] ?>
			</label>
		</div>
	</div>

	<?php
}

elseif($op == 'dt_lgn'){
	$id_cs = $_GET['id_cs'];
	$brg   = mysqli_query($con,"select * from detail_lgn WHERE id_customer='$id_cs' ORDER BY tgl_transaksi DESC");

	echo "<thead>
	<tr>
	<td>No Nota</td>
	<td>tgl transaksi</td>
	<td>Jumlah</td>
	<td>Jenis Transaksi</td>

	</tr>
	</thead>";
	while($r = mysqli_fetch_array($brg))
	{
		$harga = rupiah($r['jumlah_transaksi']);
		if($r['jenis_transaksi'] == TRUE)
		{
			$jenis = "deposit";
		}
		else
		{
			$jenis = "pemakaian";
		}
		echo "<tr>
		<td>$r[no_nota]</td>
		<td>$r[tgl_transaksi]</td>
		<td>$harga</td>
		<td>$jenis</td>

		</tr>";
	}
}
elseif($op == 'cek')
{
	$no_nota = $_GET['no_nota'];
	$sql     = mysqli_query($con,"select * from detail_lgn where no_nota='$no_nota'");
	$cek     = mysqli_num_rows($sql);
	echo $cek;
}
elseif($op == 'telp')
{
	$no_telp = $_GET['no_telp'];
	$sql     = mysqli_query($con,"select * from customer where no_telp='$no_telp'");
	$cek     = mysqli_num_rows($sql);
	echo $cek;
}

elseif($op == 'member'){
	?><?PHP
	date_default_timezone_set('Asia/Makassar');
	$jam   = date("Y-m-d H:i:s");
	$id_cs = $_GET['id_cs'];
	$sql   = $con->query("select * from customer WHERE id = '$id_cs'");
	$r     = $sql->fetch_assoc();
	?>
	<div class="row equal">
		<div  class="col-md-6 col-xs-6 col-sm-6" style="font-size: 30px" >
			<div class="form-group">
				<div  class="col-md-7 col-md-offset-4 ">
					<label style="font-size: 50px ;  background-color: #ccff00;  ">
						<?php echo $r['poin'] ?>
					</label>
					<input class="sisa" id="sisa" name="sisa" type="hidden"  readonly=true value="<?php echo $r['poin'] ?>" />
				</div>
			</div>
		</div>
		<div  class="col-md-6 col-xs-6 col-sm-6" >
			<div class="form-group">
				<label class="control-label col-5" for="nama_customer">
					Nama Customer :
				</label>
				<label class="control-label col-6" style="font-size: 12px;color: #000000;">
					<?php echo $r['nama_customer'] ?>
				</label>
			</div>
			<div class="form-group">
				<label class="control-label col-5" for="nama_customer">
					Alamat :
				</label>
				<label  class="control-label col-6" style="font-size: 12px;color: #000000;">
					<?php echo $r['alamat'] ?>
				</label>
			</div>
			<div class="form-group">
				<label class="control-label col-5" for="nama_customer">
					No Telp :
				</label>
				<label class="control-label col-6"  style="font-size: 12px;color: #000000;">
					<?php echo $r['no_telp'] ?>
				</label>
			</div>
		</div>
	</div>

	<?php
}

elseif($op == 'rc_member'){
	$id_cs = $_GET['id_cs'];
	$brg   = mysqli_query($con,"select * from transaksi_member WHERE id_customer='$id_cs' ORDER BY tgl_transaksi DESC");

	echo "<thead>
	<tr>
	<td>No Nota</td>
	<td>tgl transaksi</td>
	<td>Jumlah</td>
	<td>Poin</td>
	<td>Jenis Transaksi</td>

	</tr>
	</thead>";
	while($r = mysqli_fetch_array($brg))
	{
		$harga = rupiah($r['jumlah_transaksi']);
		if($r['jenis_transaksi'] == TRUE)
		{
			$jenis = "tambah";
		}
		else
		{
			$jenis = "pemakaian";
		}
		echo "<tr>
		<td>$r[no_nota]</td>
		<td>$r[tgl_transaksi]</td>
		<td>$harga</td>
		<td>$r[jumlah_poin]</td>
		<td>$jenis</td>

		</tr>";
	}
}
elseif($op == 'tambahpoin'){
	date_default_timezone_set('Asia/Makassar');
	$jam     = date("Y-m-d H:i:s");
	$id_cs   = $_GET['id_cs'];
	$jumlah  = $_GET['jumlah'];
	$no_nota = $_GET['no_nota'];
	$total   = $_GET['total'];
	$jenis   = "tambah";
	$poin    = $_GET['poin'];


	$tambah  = mysqli_query($con," update customer set poin='$total' WHERE id='$id_cs'");
	$tambah  = mysqli_query($con,"insert into transaksi_member (jenis_transaksi,jumlah_transaksi,id_customer,tgl_transaksi,no_nota,jumlah_poin) VALUES('1','$jumlah','$id_cs','$jam','$no_nota','$poin')");

	if($tambah){
		$edit   = mysqli_query($con,"SELECT * FROM customer WHERE id='$id_cs'");
		$r      = mysqli_fetch_array($edit);
		$jumlah = rupiah($_GET['jumlah']);


		echo "<form method=POST >
		<input type=hidden name=id value=$r[id]>
		<table width=100%>
		<tr>
		<td style='width:50px'>
		Nama Customer
		</td>
		<td> : $r[nama_customer]</td>
		</tr>

		<tr><td>
		No Nota</td>
		<td> : $no_nota</td>
		</tr>
		<tr><td>
		Jenis :</td>
		<td> : $jenis</td>
		</tr>
		<tr>
		<td>Transaksi</td>
		<td> :  $jumlah</td>
		</tr>
		<tr>
		<td>Poin</td>
		<td> :  $poin</td>
		</tr>
		<tr>
		<td>Total Poin</td>
		<td> :  $total</td>
		</tr>

		</table></form>";
	}
	else
	{
		echo "ERROR";
	}
}
elseif($op == 'belumspk'){
	?>
	<table id="belumkembali" class="display">
		<thead>
			<tr>
				<th>
					Tanggal Masuk
				</th>
				<th>
					No Nota
				</th>
				<th>
					Nama Customer
				</th>
				<th>
					Nama Customer
				</th>
			</tr>
		</thead>
		<tbody>
			<?php
			$query = "SELECT id, tgl_input,no_nota,nama_customer FROM reception where nama_outlet='$ot' and ambil=false and packing=false and kembali=false and spk=false and cuci=false and setrika=false ORDER BY tgl_input DESC" ;
			$tampil= mysqli_query($con, $query);
			while($data = mysqli_fetch_array($tampil))
			{
				?>

				<tr id="<?php echo $data['id']; ?>">
					<td>
						<?php echo $data['tgl_input']; ?>
					</td>
					<td>
						<?php echo $data['no_nota']; ?>
					</td>
					<td>
						<?php echo $data['nama_customer']; ?>
					</td>
					<td align="center">
						<a class="btn btn-sm btn-danger" href="detail_spk.php?id=<?php echo $data['id']; ?>">
							pilih
						</a>
					</td>
				</tr>
				<?php
			}
			?>
		</tbody>
	</table>
	<script src="../lib/js/jquery-2.1.3.min.js">
	</script><!-- Memasukkan plugin jQuery -->
	<script src="../lib/js/jquery.dataTables.min.js">
	</script><!-- Memasukkan file jquery.dataTables.js -->
	<script type="text/javascript">
		$(document).ready(function()
			{
				$('#belumkembali').dataTable();

			});
	</script>

	<?PHP
}
elseif($op == 'rincian_penjualan'){
	$id_cs   = $_GET['id_cs'];
	$no_nota = $_GET['no_nota'];
	$brg     = mysqli_query($con,"select * from detail_penjualan WHERE no_nota='$no_nota' and id_customer='$id_cs'");
	$sql3    = mysqli_query($con,"SELECT sum(total) as total FROM detail_penjualan WHERE no_nota= '$no_nota' and id_customer='$id_cs'");
	$s1      = mysqli_fetch_array($sql3);
	$tt      = rupiah($s1['total']);

	echo "<thead>
	<tr>
	<td>No Nota</td>
	<td>item</td>
	<td>jumlah</td>
	<td>harga</td>
	<td>total</td>
	<td>aksi</td>
	</tr>
	</thead>";
	while($r = mysqli_fetch_array($brg))
	{
		$tt2 = rupiah($r['total']);

		echo "<tr id='$r[id]' >
		<td>$r[no_nota]</td>
		<td>$r[item]</td>
		<td>$r[jumlah]</td>
		<td>$r[harga]</td>
		<td>$tt2</td>

		<td><a class='hapus' id='$r[id]' style='cursor: pointer;'>hapus</a></td>
		</tr>";
	} echo "<tr>
	<td colspan='4'>Total</td><td>$tt</td>
	</tr>";
	?>
	<script>
		$(function ()
			{
				//Box Konfirmasi Hapus
				$('#konfirm-box').dialog(
					{
						modal: true,
						autoOpen: false,
						show: "Bounce",
						hide: "explode",
						title: "Konfirmasi",
						buttons:
						{

							"Ya": function ()
							{
								jQuery.ajax(
									{
										type: "POST",
										url: "dell_detail_jual.php",
										data: 'id=' +id,
										success: function()
										{
											$('#'+id).animate({ backgroundColor: "#fbc7c7" }, "fast")
											.animate({ opacity: "hide" }, "slow");
										}
									});
								$(this).dialog("close");
							},

							"Batal": function ()
							{
								//jika memilih tombol batal
								$(this).dialog("close");

							}
						}
					});

				//Tombol hapus diklik
				$('.hapus').click(function ()
					{
						$('#konfirm-box').dialog("open");
						//ambil nomor id
						id = $(this).attr('id');
					});
			});
	</script>
	<?php
}

elseif($op == 'hapus')
{
	$id = $_GET['id'];
	$del= mysqli_query($con,"delete from detail_spk where id='$id'");
	if($del)
	{

	}
	else
	{

	}
}
elseif($op == 'customerspk'){
	?><?PHP
	$id_cs = $_GET['id_cs'];
	$sql   = $con->query("select * from reception WHERE id = '$id_cs' and spk=false");
	$r     = $sql->fetch_assoc();
	?>
	<div class="row equal">
		<div  class="col-md-6 col-xs-6 col-sm-6" >
			<div class="form-group">
				<label class="control-label col-5" for="nama_customer">
					Nama Customer :
				</label>
				<label class="control-label col-6" style="font-size: 12px;color: #000000;">
					<?php echo $r['nama_customer'] ?>
				</label>
			</div>
			<div class="form-group">
				<label class="control-label col-5" for="nama_customer">
					Alamat :
				</label>
				<label  class="control-label col-6" style="font-size: 12px;color: #000000;">
					<?php echo $r['no_nota'] ?>
				</label>
			</div>
			<div class="form-group">
				<label class="control-label col-5" for="nama_customer">
					No Telp :
				</label>
				<label class="control-label col-6"  style="font-size: 12px;color: #000000;">
					<?php echo $r['jumlah'] ?>
				</label>
			</div>
		</div>
	</div>

	<?php
}

elseif($op == 'tambahdetailpenjualan'){

	date_default_timezone_set('Asia/Makassar');
	$jam        = date("Y-m-d H:i:s");

	$jumlah     = $_GET['jumlah'];
	$jenis_item = $_GET['jenis_item'];
	$total      = $_GET['total'];
	$id_cs      = $_GET['id_cs'];
	$harga      = $_GET['harga'];
	$berat      = $_GET['berat'];
        
        
        $hanger_own = $_GET['hanger_own'];
        $deliver = $_GET['deliver'];
        $parfum = $_GET['parfum'];
        $charge =  $_GET['charge'];
        $hanger = $_GET['hanger'];
        $hanger_plastic = $_GET['hanger_plastic']; 


	$tambah     = mysqli_query($con,"insert into rincian_order_temp (id,tgl_transaksi,item,total,id_customer,jumlah,harga,berat) VALUES('0','$jam','$jenis_item','$total','$id_cs','$jumlah','$harga','$berat')");

        $last_id = mysqli_insert_id($con);
        if($tambah){
        $tambah_icon_details = mysqli_query($con,"insert into cris_icon_details (creator,id_rincian_order_tmp,id_detail_penjualan,hanger_own,deliver,parfum,charge,hanger,hanger_plastic,id_reception) "
                . " values ('$us','$last_id','0','$hanger_own','$deliver','$parfum','$charge','$hanger','$hanger_plastic','0') ");
        }
	if($tambah){
		echo "sukses";

	}
	else
	{
		echo "ERROR";
	}
}







elseif($op == 'selesai'){

	date_default_timezone_set('Asia/Makassar');
	$jam             = date("Y-m-d H:i:s");
	$id_cs           = $_GET['id_cs'];
	$no_nota         = $_GET['no_nota'];
	$nama_customer   = $_GET['nama_customer'];
	$jenis           = $_GET['jenis'];
	$express         = $_GET['express'];
	$email           = $_GET['email'];
	$query           = "SELECT max(no_so) AS last FROM reception WHERE nama_outlet='$ot' LIMIT 1";
	$hasil           = mysqli_query($con,$query);
	$data            = mysqli_fetch_array($hasil);
	$lastNoTransaksi = $data['last'];
	// baca nomor urut transaksi dari id transaksi terakhir
	//soCDW000001
	$lastNoUrut      = (int)substr($lastNoTransaksi, 5, 6);
	// nomor urut ditambah 1
	$nextNoUrut1 = $lastNoUrut + 1;

	if($ot == "Toddopuli")
	{
		$char = "SDTDL";

	}
	elseif($ot == "Landak")
	{
		$char = "SDLDK";


	}
	elseif($ot == "Baruga")
	{
		$char = "SDBRG";

	}
	elseif($ot == "Cendrawasih")
	{
		$char = "SDCDW";

	}
	elseif($ot == "BTP")
	{
		$char = "SDBTP";

	}
	elseif($ot == "DAYA")
	{
		$char = "SDDYA";

	}elseif($ot == "mojokerto")
	{
		$char = "SDMJK";

	}


	// membuat format nomor transaksi berikutnya
	$noso   = $char.sprintf('%06s', $nextNoUrut1);
	$sql3   = mysqli_query($con,"SELECT sum(total) as total FROM detail_penjualan WHERE no_nota= '$no_nota' and id_customer='$id_cs'");
	$s1     = mysqli_fetch_array($sql3);
	$total  = $s1['total'];

	$tambah = mysqli_query($con,"insert into reception(nama_outlet,nama_reception,tgl_input,nama_customer,no_nota,jenis,express,no_so,id_customer,total_bayar) VALUES('$ot','$us','$jam', '$nama_customer','$no_nota','$jenis','$express','$noso','$id_cs','$total')");

	if($tambah){


		$to      = $email . ', '; // note the comma

		// subject
		$subject = 'Order Laundry : ';
		$subject .= 'Order Laundry';
		$message = '<html><body>';
		$message .= '<table rules="all" style="border-color: #666;" cellpadding="10">';
		$message .= "<tr style='background: #eee;'><td><strong>NoNota:</strong> </td><td>" . strip_tags($no_nota) . "</td></tr>";
		$message .= "<tr><td><strong>Customer:</strong> </td><td>" . strip_tags($nama_customer) . "</td></tr>";
		$message .= "<tr><td><strong>Bersih:</strong> </td><td>" . strip_tags($total) . "</td></tr>";


		// To send HTML mail, the Content - type header must be set
		$headers = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

		// Additional headers

		$headers .= 'to :'.$email.'' . "\r\n";
		$headers .= 'From: admin@qnclaundry.com' . "\r\n";
		$headers .= 'Cc: admin@qnclaundry.com' . "\r\n";
		$headers .= 'Bcc: admin@qnclaundry.com' . "\r\n";

		// Mail it
		@mail($to, $subject, $message, $headers);
		?>
		<?php
		include"bar128.php";
		$edit = mysqli_query($con,"SELECT * FROM reception WHERE no_nota='$no_nota'");
		$r    = mysqli_fetch_array($edit);

		?>
		<div style="font-size: 12px; font-family: Arial" >
			<div align="center">
				<img src="../logo.bmp" />
			</div>
			<div align="center">
				Quick &' Clean Laundry
			</div>
			<div align="center">
				Jl Toddopuli Raya No 08
			</div>
			<div align="center">
				Makassar
			</div>
			<div align="center">
				0411-444180
			</div>

			<div align="center" class="style1 style4">
				Nota Order
			</div>
			<?php echo bar128(stripslashes($no_nota))?>
			<div>
				<?php
				echo 'Nama : '.$nama_customer.'<br>';
				echo 'No Nota : '.$no_nota.'<br>';
				?>
			</div>
			<table id="resultTable" data-responsive="table" style="text-align: left;">
				<thead>
					<tr>
						<th>
						</th>
						<th width="50%">
							Item
						</th>
						<th width="21%">
							Harga
						</th>
						<th width="20%">
							Total
						</th>
					</tr>
				</thead>
				<tbody>
					<?php

					$sql2 = mysqli_query($con,"SELECT * FROM detail_penjualan WHERE no_nota= '$no_nota' and id_customer='$id_cs'");

					while($data = mysqli_fetch_array($sql2))
					{
						?>
						<tr>

							<td>
								<?php echo $data['jumlah'];?>
							</td>

							<td>
								<?php echo $data['item'];?>
							</td>
							<td>
								<?php echo $data['harga'];?>
							</td>
							<td>
								<?php echo $data['total'];?>
							</td>


						</tr>

						<?php
					}
					?>
					<tr>
						<td colspan="1">
							Total:
						</td>
						<td colspan="4">
							<?php
							$sql3 = mysqli_query($con,"SELECT sum(total) as total FROM detail_penjualan WHERE no_nota= '$no_nota' and id_customer='$id_cs'");
							$s1   = mysqli_fetch_array($sql3);
							$hr   = $s1['total'];
							echo rupiah($hr, true);
							?>
						</td>
					</tr>

				</tbody>
			</table>
		</div>
		<table border="1">
			<td>
				<font size=2px face="Arial" >
					Konsumen tunduk pada syarat dan ketentuan umum laundry kiloan dan laundry potongan di Quick & Clean
				</font> <br/><br />
				<font size=2px face="Arial" >
					Cucian yang tidak diambil dalam 30 hari, di luar tanggung jawab Quick &' Clean.
				</font><br/><br >
				<font size=2px face="Arial" >
					Komplain maksimal 3 hari sejak tanggal pengembalian, 14 hari sejak cucian bersih sampai di outlet dan wajib menunjukkan nota pembayaran.
				</font><br/>
			</td>
		</table>
		<?php echo "Tgl $jam<br />" ?>
		<?php echo "Reception :$_SESSION[user_id]" ?>

		<tr>
			<td col>
				<br/>
				<span style='float: left; text-align:center;'>
					<br/>
					Customer<br/> </br> </br>
					(....................)
					<br/><?php echo $nama_customer ?>

				</span>

			</td>

		</tr>
		<?php





	}
	else
	{
		echo "ERROR";
	}
}
elseif($op == 'piutang')
{

	$id_cs = $_GET['id_cs'];

	$brg   = mysqli_query($con,"select * from reception WHERE id_customer='$id_cs' and lunas=false");
	$sql3  = mysqli_query($con,"SELECT sum(total_bayar) as total FROM reception WHERE id_customer='$id_cs' and lunas=false");
	$s1    = mysqli_fetch_array($sql3);
	$tt3   = rupiah($s1['total']);
	echo "<thead>
	<tr>
	<td>No Nota</td>


	<td>total</td>

	</tr>
	</thead>";
	while($r = mysqli_fetch_array($brg))
	{
		$tt = rupiah($r['total_bayar']);
		echo "<tr>
		<td>$r[no_nota]</td>

		<td>$tt</td>


		</tr>";
	} echo "<tr>
	<td colspan='1'>Total</td><td>$tt3</td>
	</tr>";

}
elseif($op == 'voucher')
{
	$no_voucher = $_GET['voucher'];
	$tgl = date('Y-m-d');
	//$sql     = mysqli_query($con,"select * from voucher_lucky a, voucher_berkala b where a.no_voucher='$no_voucher' or b.kode_voucher=$no_voucher and a.aktif='0' and b.status='aktif' LIMIT 1");
	$sql     = mysqli_query($con, "select * from voucher_lucky where no_voucher='$no_voucher' and aktif='0'");
	$cek     = mysqli_num_rows($sql);
	$sql1     = mysqli_query($con,"select * from voucher_berkala where kode_voucher='$no_voucher' and status='aktif' and periode_awal<='$tgl' and periode_akhir>='$tgl'");
	$cek1     = mysqli_num_rows($sql1);
	
	$newhari = date("l");
	$sql2     = mysqli_query($con,"select * from kode_promo where kode='$no_voucher' and status='Aktif' and hari like '%$newhari%'");
	$cek2     = mysqli_num_rows($sql2);
	
	$sql3     = mysqli_query($con,"select * from promo_flat where kode='$no_voucher' and status='Aktif' and hari like '%$newhari%'");
	$cek3     = mysqli_num_rows($sql3);


	if ($cek>0){
	$d=mysqli_fetch_array($sql);
	    echo $d['disk']."|".$cek."|".$d['jenis_voucher']."|".$d['kali']."|".$d['id_customer'];
	}
	else if ($cek1>0){
	$d1=mysqli_fetch_array($sql1);
	    echo $d1['diskon']."|".$cek1."|Berkala|".$d1['outlet']."|".$d1['kategori']."|".$d1['minimal']."|".$d1['maksimal'];
	}
	else if ($cek2>0){
	$d2=mysqli_fetch_array($sql2);
	    echo $d2['diskon']."|".$cek2."|Promo|".$d2['outlet']."|".$d2['kategori']."|".$d2['minimum_transaksi']."|".$d2['maksimum_transaksi']."|".$d2['syarat']."|".$d2['pembayaran'];
	}
	else if ($cek3>0){
	$d3=mysqli_fetch_array($sql3);
	    echo $d3['flat']."|".$cek3."|Flat|".$d3['outlet']."|".$d3['kategori']."|".$d3['minimum_berat']."|".$d3['maksimum_berat']."|".$d3['syarat']."|".$d3['pembayaran'];
	}
}


?>