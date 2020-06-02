<?php 
include '../config.php';

if(isset($_POST['kode'])){
	$kode = substr($_POST['kode'],0,10);
	$item_baru = $_POST['item_baru'];

	if($_POST['kode']!='--Pilih Sub Akun--' && $item_baru!=''){
		$query = mysqli_query($con, "SELECT kode_item FROM nama_item WHERE kode_nama_sub_akun='$kode' ORDER BY kode_item DESC");
		$data = mysqli_fetch_row($query);
		if(mysqli_num_rows($query)>0){
			$kode_item = $data[0];
			$kode_baru = substr($kode_item, 11)+1;
			if(substr($kode_item, 11)<10){
				$kode_item_baru = substr($kode_item,0,11).'0'.$kode_baru;
			} else {
				$kode_item_baru = substr($kode_item,0,11).''.$kode_baru;
			}
		} else {
			$kode_item_baru = $kode.'.01';
		}
			
		$newitem = ucwords($item_baru);
		$tambah = mysqli_query($con, "INSERT INTO nama_item (id,kode_nama_sub_akun,kode_item,nama_item) VALUES ('','$kode','$kode_item_baru','$newitem')");

		if($tambah){
			echo '<p style="color: #9beca5; text-align: center;">Item baru telah ditambahkan!!</p>';
			?>
			<script type="text/javascript">
				locatian.href="index.php?menu=list_akun";
			</script>
			<?php
		} else{
			echo 'Gagal';
		}
	} else{
		echo '<p style="color: red; text-align: center;">Kolom belum diisi!!</p>';
	}

		

}

?>