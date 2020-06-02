<?php 
include '../../config.php';
include '../zonawaktu.php';


if(isset($_GET['cuci'])){
	mysqli_query($con, "UPDATE reception SET cuci='1', op_cuci='$_SESSION[user_id]', tgl_cuci='$nowDate' WHERE no_nota='$_GET[nota]' ");

	mysqli_query($con, "INSERT INTO cuci (no_nota,tgl_cuci,op_cuci,jumlah,no_mesin,ket) VALUES ('$_GET[nota]','$nowDate','$_SESSION[user_id]','$_GET[jumlah]','$_GET[mesin]','$_GET[ket]') ");

} else if(isset($_GET['kering'])){
	mysqli_query($con, "UPDATE reception SET pengering='1', op_pengering='$_SESSION[user_id]', tgl_pengering='$nowDate' WHERE no_nota='$_GET[nota]' ");

	mysqli_query($con, "INSERT INTO pengering (no_nota,tgl_pengering,op_pengering,jumlah,no_mesin,ket) VALUES ('$_GET[nota]','$nowDate','$_SESSION[user_id]','$_GET[jumlah]','$_GET[mesin]','$_GET[ket]') ");
	

} else if(isset($_GET['setrika'])){
    mysqli_query($con, "INSERT INTO setrika_sementara (no_nota,tgl_setrika,user_setrika,berat,status,workshop) VALUES ('$_GET[nota]','$nowDate','$_GET[user_setrika]','$_GET[berat]','0','') ");


		?>
		<p>Apakah ingin mencetak SPK?</p>
		<div class="col-xs-6">
		    <button class="btn btn-primary btn-sm btn-block print-ya">Ya</button>
		</div>
		<div class="col-xs-6">
		    <button class="btn btn-danger btn-sm btn-block print-tidak">Tidak</button>
		</div>

		<script type="text/javascript">
			$(function(){
				$('.print-ya').on('click', function(){
					window.open('document/cetak_spk_setrika.php?nota=<?php echo $_GET['nota'] ?>','page','toolbar=0,scrollbars=1,location=0,statusbar=0,menubar=0,resizable=0,width=750,height=600,left=50,top=50,titlebar=yes');

					window.location = "";
				});
				
				$('.print-tidak').on('click', function(){
				    window.location = "";
				})


			})
		</script>

		<?php


} else if(isset($_GET['sementara'])){
	mysqli_query($con, "INSERT INTO setrika (no_nota,tgl_setrika,user_setrika,berat) VALUES ('$_GET[nota]','$nowDate','$_GET[user_setrika]','$_GET[berat]') ");
	mysqli_query($con, "UPDATE setrika_sementara SET status='1' WHERE no_nota='$_GET[nota]'");
	mysqli_query($con, "UPDATE reception SET setrika='1', user_setrika='$_GET[user_setrika]', tgl_setrika='$nowDate' WHERE no_nota='$_GET[nota]' ");

} else if(isset($_GET['packing'])){
	mysqli_query($con, "INSERT INTO packing (no_nota,tgl_packing,user_packing,jumlah,harga,ket,jenis) VALUES ('$_GET[nota]','$nowDate','$_SESSION[user_id]','$_GET[jumlah]','$_GET[harga]','$_GET[ket]','$_GET[jenis]') ");
	mysqli_query($con, "UPDATE reception SET packing='1', user_packing='$_SESSION[user_id]', tgl_packing='$nowDate' WHERE no_nota='$_GET[nota]' ");


	$fakturs = mysqli_query($con, "SELECT no_faktur FROM reception WHERE no_nota='$_GET[nota]'");
	$faktur = mysqli_fetch_row($fakturs)[0];

	$semuanota = mysqli_query($con, "SELECT COUNT(no_nota) AS jumlah FROM reception WHERE no_faktur='$faktur' AND packing=false AND tgl_packing='0000-00-00 00:00:00' AND kembali=false AND tgl_kembali='0000-00-00 00:00:00'");
	$jumnota = mysqli_fetch_row($semuanota)[0];



}
?>




