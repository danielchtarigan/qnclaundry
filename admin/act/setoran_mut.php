<?php 
include '../../config.php';
session_start();

date_default_timezone_set('Asia/Makassar');
$date = date('Y-m-d H:i:s');

if(isset($_GET['simpan'])){
	$tgl = $_GET['tgl'];
	$penyetor = $_GET['nama'];
	$jumlah = $_GET['jumlah'];
	$bank = $_GET['bank'];

	if($tgl==0){
		echo "<p style='color: red'>* <em>Tanggal belum dipilih!!</em></p>";
	}else if($penyetor=='--Pilih Nama Resepsionis--'){
		echo "<p style='color: red'>* <em>Nama Resepsionis belum dipilih!!</em></p>";
	}else if($jumlah==0){
		echo "<p style='color: red'>* <em>Jumlah Setor Masih Kosong tuh!!</em></p>";
	}else if($bank=='--Pilih Bank/Apotik--'){
		echo "<p style='color: red'>* <em>Nama Bank belum dipilih!!</em></p>";
	}else{
		$cektgl = mysqli_query($con, "SELECT * FROM setoran_bank_sebenarnya WHERE tanggal='$tgl' AND nama='$penyetor' AND nama_bank='$bank' AND jumlah='$jumlah' ");
		$data = mysqli_fetch_assoc($cektgl);
		if(mysqli_num_rows($cektgl)>0){
			echo "<p style='color: red'>* <em>Setoran ".$penyetor." pada tanggal ".date('d/m/Y', strtotime($tgl))." di Bank ".$bank." sudah ada!!</em></p>";
		} else{
			$query = mysqli_query($con, "INSERT INTO setoran_bank_sebenarnya (tanggal,nama,jumlah,nama_bank,ket,user_input,tgl_input) VALUES ('$tgl','$penyetor','$jumlah','$bank','$_GET[ket]','$_SESSION[user_id]','$date')");

			if($query){ ?>
				<script type="text/javascript">
					location.href="laporan.php?form=Setoran";
				</script>
				
			<?php 
			} 
		}
			
	}
}

else if(isset($_GET['edit'])){
	mysqli_query($con, "UPDATE setoran_bank_sebenarnya SET tanggal='$_GET[tgl]', nama='$_GET[nama]', jumlah='$_GET[jumlah]', nama_bank='$_GET[bank]', ket='$_GET[ket]' WHERE id='$_GET[id]' "); ?>
	<script type="text/javascript">
		location.href="laporan.php?form=Setoran"; 
	</script>
<?php
}
	

	
?>