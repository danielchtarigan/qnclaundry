<!DOCTYPE html>
<html>
<head>
<?php 
include "header.php";
include "../config.php";
?>
<meta charset="UTF-8">
<link rel="stylesheet" type="text/css" href="../lib/themes/bootstrap/easyui.css">
<link rel="stylesheet" type="text/css" href="../lib/themes/icon.css">
<script type="text/javascript" src="../lib/js/jquery.easyui.min.js"></script>
	
</head>
<body>
<div align="center">
	<h2>FORM TUTUP KASIR</h2>
	<div class="easyui-panel" title="Tutup Kasir" align="center" style="width:500px;padding:10px;">
		<form id="ff" action="p_tutup_kasir.php" method="post" class="form-horizontal">
			<table>
		

		<div class="form-group">
  		<label class="control-label col-xs-3" for="nama_customer">Pengeluaran Langsung</label>
  		 <div class="col-xs-8" >
  		<input type="number" autocomplete="off" class="form-control" min="0" step="1"  name="pengeluaran" id="pengeluaran"   onkeydown="return tabOnEnter(this,event)"required/>
		</div>
		</div>
		<div class="form-group">
  		<label class="control-label col-xs-3" for="nama_customer">Pengeluaran Untuk</label>
  		 <div class="col-xs-8" >
  		<input type="text" autocomplete="off" class="form-control" name="untuk" id="untuk"   onkeydown="return tabOnEnter(this,event)"required/>
		</div>
		</div>
		<div class="form-group">
  		<label class="control-label col-xs-3" for="nama_customer">Ijin Oleh</label>
  		 <div class="col-xs-8" >
  		<input type="text" autocomplete="off" class="form-control" name="ijin" id="ijin"   onkeydown="return tabOnEnter(this,event)"required/>
		</div>
		</div>
		<div class="form-group">
  		<label for="no_nota" class="control-label col-xs-3">Cash Bersih</label>
        <?php 
		$bukakasir = mysqli_query($con, "select * from bukakasir where tgl like '%$tgl%' and resepsionis='$_SESSION[user_id]' and outlet='$_SESSION[nama_outlet]'");
		$rbukakasir = mysqli_fetch_array($bukakasir);
		$uangbuka = $rbukakasir['uang'];
		
		$uang = mysqli_query($con, "select sum(jumlah) as cash from cara_bayar where tanggal_input like '%$tgl%' and resepsionis='$_SESSION[user_id]' and cara_bayar='Cash'");
		$ruang = mysqli_fetch_array($uang);
		$cash = $ruang['cash'];
		?>
  		 <div class="col-xs-8">
  		<input type="text" class="form-control" name="setoran_bersih" id="setoran_bersih" value="<?php echo $cash; ?>" required="true" />
  		</div>
		</div>
<?php
		$uang1 = mysqli_query($con, "select sum(jumlah) as mandiri from reception a, cara_bayar b where a.tgl_input like '%$tgl%' and a.rcp_lunas='$_SESSION[user_id]' and a.nama_outlet='$_SESSION[nama_outlet]' and a.no_faktur=b.no_faktur and b.cara_bayar='Mandiri'");
		$ruang1 = mysqli_fetch_array($uang1);
		$cash1 = $ruang1['mandiri'];

?>
		<div class="form-group">
  		<label for="no_nota" class="control-label col-xs-3">EDC MANDIRI</label>
  		 <div class="col-xs-8">
  		<input type="number" autocomplete="off" class="form-control" name="edc_mandiri" id="edc_mandiri"  value="" required />
  		</div>
		</div>
		
<?php
/*		$uang2 = mysqli_query($con, "select sum(jumlah) as bca from reception a, cara_bayar b where a.tgl_input like '%$tgl%' and a.rcp_lunas='$_SESSION[user_id]' and a.nama_outlet='$_SESSION[nama_outlet]' and a.no_faktur=b.no_faktur and b.cara_bayar='BCA'");
		$ruang2 = mysqli_fetch_array($uang2);
		$cash2 = $ruang2['bca'];
*/
?>

		<div class="form-group">
  		<label for="no_nota" class="control-label col-xs-3">EDC BCA</label>
  		 <div class="col-xs-8">
  		<input type="number" autocomplete="off" class="form-control" name="edc_bca" id="edc_bca" value="0" required/>
  		</div>
		</div>
		
<?php
/*
		$uang3 = mysqli_query($con, "select sum(jumlah) as bri from reception a, cara_bayar b where a.tgl_input like '%$tgl%' and a.rcp_lunas='$_SESSION[user_id]' and a.nama_outlet='$_SESSION[nama_outlet]' and a.no_faktur=b.no_faktur and b.cara_bayar='BRI'");
		$ruang3 = mysqli_fetch_array($uang3);
		$cash3 = $ruang3['bri'];
*/
?>
		<div class="form-group">
  		<label for="no_nota" class="control-label col-xs-3">EDC BRI</label>
  		 <div class="col-xs-8">
  		<input type="number" autocomplete="off" class="form-control" name="edc_bri" id="edc_bri" value="0" required />
  		</div>
		</div>

<?php
/*
		$uang4 = mysqli_query($con, "select sum(jumlah) as bri from reception a, cara_bayar b where a.tgl_input like '%$tgl%' and a.rcp_lunas='$_SESSION[user_id]' and a.nama_outlet='$_SESSION[nama_outlet]' and a.no_faktur=b.no_faktur and b.cara_bayar='BNI'");
		$ruang4 = mysqli_fetch_array($uang3);
		$cash4 = $ruang4['bni'];
*/
?>
		<div class="form-group">
  		<label for="no_nota" class="control-label col-xs-3">EDC BNI</label>
  		 <div class="col-xs-8">
  		<input type="number" autocomplete="off" class="form-control" name="edc_bni" id="edc_bni"  value="0"  required/>
  		</div>
		</div>

		<div class="form-group">
  		<label for="no_nota" class="control-label col-xs-3">Meteran Listrik Tutup</label>
  		 <div class="col-xs-8">
  		<input type="number" autocomplete="off" class="form-control" name="meteran_tutup" id="meteran_tutup"   onkeydown="return tabOnEnter(this,event)"required/>
  		</div>
		</div>
		<tr>
					<td></td>
Pastikan Anda mengisi sesuai pecahan uang yang diterima yang dimasukkan ke amplop!! Jika selisih menyetor di bank, akan dikenakan sanksi pemotongan gaji! Setelah melakukan submit, segala kekurangan kas akan ditagihkan langsung ke Resepsionis dan kelebihan kas akan disimpan dalam akun tersendiri
					<td><input type="submit" name="test" id="test" value="Submit"></input></td>
				</tr>
			</table>
		</form>
	</div>
	</div>	
	<style scoped>
		.f1{
			width:200px;
		}
	</style>
<!--
	<script type="text/javascript">
		$(function(){
			$('#ff').form({
				success:function(data){
					$.messager.alert('Info', data, 'info');
				$('#ff').form('clear');
				}
			});
		});
	</script>
-->

	<script type="text/javascript">

	$(document).ready(function()
	{
		$('#test').click(function()
		{
			var jumlah = $('#setoran_bersih').val();
			if (confirm("Simpan Data?"+"Jumlah :"+jumlah))
			{				
			}else{
				return false;
			}
		});
	});
</script>
</body>
</html>