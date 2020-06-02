<?php


function rupiah($angka)
{
	$jadi = "Rp.".number_format($angka,0,',','.');
	return $jadi;
}
session_start();
$us             = $_SESSION['name'];
$ot             = 'mojokerto';
?>
<?php
include "../../../config.php";


date_default_timezone_set('Asia/Makassar');
$jam            = date("Y-m-d H:i:s");
$id_cs          = $_GET['id_cs'];
$total          = $_GET['tt'];
$carabayar      = $_GET['carabayar'];
$totalpoin      = $_GET['totalpoin'];
$poin           = $_GET['poin'];
$kuota_sekarang = $_GET['kuota_sekarang'];
$nofaktur       = $_GET['no_faktur'];

function isi_keranjang()
{

	include '../../../config.php';
	$ids          = session_id();
	$id_cs        = $_GET['id_cs'];

	$isikeranjang = array();

	$sql   = "SELECT * FROM rincian_faktur_temp WHERE id_customer='$id_cs'";


	$hasil = mysqli_query($con,$sql);

	while($r = mysqli_fetch_array($hasil)){
		$isikeranjang[] = $r;
	}
	return $isikeranjang;
}


$isikeranjang = isi_keranjang();
$jml          = count($isikeranjang);

for($i = 0; $i < $jml; $i++){
	mysqli_query($con,"insert into rincian_faktur (no_nota,jumlah,no_faktur,id_customer) values ('{$isikeranjang[$i]['no_nota']}','{$isikeranjang[$i]['jumlah']}','$nofaktur','$id_cs')");
}

for($i = 0; $i < $jml; $i++){
	mysqli_query($con,"DELETE FROM rincian_faktur_temp
		WHERE no_nota = '{$isikeranjang[$i]['no_nota']}' and id_customer='$id_cs'");
}
for($i = 0; $i < $jml; $i++){
	mysqli_query($con,"update reception set lunas='1',tgl_lunas='$jam',no_faktur='$nofaktur',rcp_lunas='$us',cara_bayar='$carabayar' WHERE no_nota = '{$isikeranjang[$i]['no_nota']}'");
}
$query5           = "SELECT max(right(no_voucher,3)) AS last FROM voucher_lucky WHERE jenis_voucher='mb' LIMIT 1";
$hasil5           = mysqli_query($con,$query5);
$data5            = mysqli_fetch_array($hasil5);
$lastNoTransaksi5 = $data5['last'];
$nextNoUrut5      = $lastNoTransaksi5 + 1;
$char             = "m15";
// membuat format nomor transaksi berikutnya
$a                = 0.00004;
$b                = $total;
$c                = floor($a * $b);






$jml              = $nextNoUrut5 + $c;




$tambah           = mysqli_query($con,"insert into faktur_penjualan(no_faktur,nama_outlet,rcp,tgl_transaksi,total,cara_bayar,id_customer,jenis_transaksi) VALUES('$nofaktur','$ot','$us','$jam','$total','$carabayar','$id_cs','ritel')");
$cs               = mysqli_query($con,"update customer set poin='$totalpoin' WHERE  id='$id_cs'");
$lg               = mysqli_query($con,"update customer set sisa_kuota='$kuota_sekarang' WHERE  id='$id_cs'");
$tambah1          = mysqli_query($con,"insert into transaksi_member (jenis_transaksi,jumlah_transaksi,id_customer,tgl_transaksi,no_nota,jumlah_poin) VALUES('1','$total','$id_cs','$jam','$nofaktur','$poin')");
$tambah2          = mysqli_query($con,"insert into detail_lgn (jenis_transaksi,jumlah_transaksi,id_customer,tgl_transaksi,no_nota,cara_bayar) VALUES('0','$total','$id_cs','$jam','$nofaktur','$carabayar')");

if($tambah){
	$edit = mysqli_query($con,"SELECT no_faktur,nama_customer,id FROM reception WHERE no_faktur='$nofaktur'");
	$r    = mysqli_fetch_array($edit);

	?>

	<script language="javascript">
		function Clickheretoprint()
		{
			var newWindow = window.open('','_blank','status=0,toolbar=0,location=0,menubar=1,resizable=1,scrollbars=1');
			newWindow.document.write(document.getElementById("bayarr").innerHTML);
			newWindow.print();
		}
	</script>
	<a id="cccc" href="javascript:Clickheretoprint()">
		Print
	</a>
	<div class="bayarr" id="bayarr">

	<div style="font-size: 12px; font-family: Arial" >
		<div align="center">
			<img src="../../../logo.bmp" />
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
			Nota Pembayaran
		</div>

		<div>
			<?php
			echo 'Nama : '.$r['nama_customer'].'<br>';
			echo 'No Faktur : '.$nofaktur.'<br>';
			?>
		</div>
		<table id="resultTable" data-responsive="table" style="text-align: left;">
			<thead>
				<tr>
					<th>
					</th>

					<th>
					</th>

				</tr>
			</thead>
			<tbody>
				<?php

				$sql2 = mysqli_query($con,"SELECT * FROM reception WHERE no_faktur= '$nofaktur'");

				while($s = mysqli_fetch_array($sql2))
				{
					$harga = rupiah($s['total_bayar']);
					?>
					<tr>

						<td colspan="2">
							<?php echo $s['no_nota'];?>
						</td>
						<td>
						</td>
						<td colspan="4">
							<?php echo $harga;?>
						</td>

					</tr>

					<?php
				}
				?>
				<tr>
					<td colspan="2">
						Total:
					</td>
					<td>
					</td>
					<td colspan="4">
						<?php
						$sql3 = mysqli_query($con,"SELECT sum(total_bayar) as total FROM reception WHERE no_faktur= '$nofaktur' and id_customer='$id_cs'");
						$s1   = mysqli_fetch_array($sql3);
						$hr   = rupiah($s1['total']);
						echo $hr ;
						?>
					</td>
				</tr>
				<tr>
					<td colspan="2">
						Cara Pembayaran:
					</td>
					<td>
					</td>
					<td colspan="4">
						<?php
						echo $carabayar ;
						?>
					</td>
				</tr>


			</tbody>
		</table>
	</div>
	<div id="mainmain">
		<p style="border: 1px solid #000000;font-size: 8px; font-family: arial;border-radius: 2px;padding: 3px">
			Simpan bukti pembayaran ini. Anda Wajib menunjukan bukti ini jika akan melakukan komplain. Komplain Maksimal 3 hari setelah cucian di terima dan 14 hari sejak tanggal order.
		</p>
	</div>
	<div id="mainmain1">
	<p style="border: 1px solid #000000;font-size: 8px; font-family: arial;border-radius: 2px;padding: 3px">

<?php
include "../../../reception/bar128.php";
	date_default_timezone_set('Asia/Makassar');
	$jam1 = date("Y-m-d");
	$sql  = $con->query("select * from customer WHERE id = '$id_cs'");
	$r    = $sql->fetch_assoc();
$jumlahpoin=$r['poin'];
	
	if($r['member'] == '1' && $r['tgl_akhir'] >= $jam1  )
	{
echo "Voucher Referral. Bagikan voucher ke teman,dapatkan 1 Point Member setiap kali voucher digunakan. Voucher bisa digunakan sampai 10 kali. Diskon 15%.Jumlah Poin :$jumlahpoin";
$pad       = 4;
for($i = $nextNoUrut5; $i < $jml; $i++){
$i = str_pad($i, $pad, "0", STR_PAD_LEFT);
			echo bar128(stripslashes("m15$i"));
			mysqli_query($con,"insert into voucher_lucky (no_voucher,jenis_voucher,disk,id_customer) values ('m15$i','mb','0.15','$id_cs')");

		}
	}


?>
</p>
</div>
<?php echo "Tgl $jam<br />" ?>
<?php echo "Reception :$_SESSION[name]" ?>

<tr>
	<td col>
		<br/>
		<span style='float: left; text-align:center;'>
			<br/ >
			Customer<br/> </br> </br>

			<br/>(<?php echo $r['nama_customer'] ?>)

		</span>

	</td>

</tr>
</div>
<?php
}
else
{
	echo "ERROR";
}

?>