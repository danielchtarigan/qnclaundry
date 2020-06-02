<?php 
include 'akses.php';

include 'config.php';
date_default_timezone_set('Asia/Makassar');
$tanggal = date('Y-m-d H:i:s');
$date = date('Y-m-d');

if($_POST['nota']=='' || $_POST['supplier']=='' || $_POST['item']=='--Pilih Nama Item--' || $_POST['harga']=='0' ||$_POST['quantity']=='0'){
	echo '<td colspan="7" align="center" style="color: red">*Form Pemesanan belum terisi semua, silahkan ulangi kembali....!!</td>';
} else{
	$simpan = mysqli_query($con, "INSERT INTO pemesanan VALUES ('','$tanggal','$_POST[nota]','$_POST[supplier]','$_POST[item]','$_POST[harga]','$_POST[quantity]','') ");

	if($simpan){ 
		echo "OK";

		
	} 
}

	

?>

<script type="text/javascript">
	$('.remove-data').click(function(){
	    var id = $(this).attr("id");
		$.ajax({
			type : 'post',
		    url : 'action/hapus_pesanan.php',
		    data :  'id='+ id,
		    success : function(data){
		    $('.hapus-item').html(data);//menampilkan data ke dalam modal
		    }
		})
	});
</script>