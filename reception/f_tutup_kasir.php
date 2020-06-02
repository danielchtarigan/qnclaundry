<!DOCTYPE html>
<html>
<head>
<?php 
include "header.php";
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
  		 <div class="col-xs-8">
  		<input type="number" autocomplete="off" class="form-control" name="setoran_bersih" id="setoran_bersih"   onkeydown="return tabOnEnter(this,event)"required="true"/>
  		</div>
		</div>
		<div class="form-group">
  		<label for="no_nota" class="control-label col-xs-3">EDC MANDIRI</label>
  		 <div class="col-xs-8">
  		<input type="number" autocomplete="off" class="form-control" name="edc_mandiri" id="edc_mandiri"   onkeydown="return tabOnEnter(this,event)"required/>
  		</div>
		</div>
		
		<div class="form-group">
  		<label for="no_nota" class="control-label col-xs-3">EDC BCA</label>
  		 <div class="col-xs-8">
  		<input type="number" autocomplete="off" class="form-control" name="edc_bca" id="edc_bca"   onkeydown="return tabOnEnter(this,event)"required/>
  		</div>
		</div>
		
		<div class="form-group">
  		<label for="no_nota" class="control-label col-xs-3">EDC BRI</label>
  		 <div class="col-xs-8">
  		<input type="number" autocomplete="off" class="form-control" name="edc_bri" id="edc_bri"   onkeydown="return tabOnEnter(this,event)"required/>
  		</div>
		</div>

		<div class="form-group">
  		<label for="no_nota" class="control-label col-xs-3">EDC BNI</label>
  		 <div class="col-xs-8">
  		<input type="number" autocomplete="off" class="form-control" name="edc_bni" id="edc_bni"   onkeydown="return tabOnEnter(this,event)"required/>
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