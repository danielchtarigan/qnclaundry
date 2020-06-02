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
	<h2>FORM SETORAN BANK</h2>
	<div class="easyui-panel" title="Tutup Kasir" align="center" style="width:500px;padding:10px;">
		<form id="ff" action="p_setoran_bank.php" method="post" class="form-horizontal">
		<table>
		<div class="form-group"><label for="no_nota" class="control-label col-xs-3">Outlet</label><div class="col-xs-4">
          <select class="form-control" name="nama_outlet" id="nama_outlet" required="true">
          <option value="">--</option>
        <option value="Toddopuli">Toddopuli</option>
        <option value="Landak">Landak</option>
        <option value="Baruga">Baruga</option>
        <option value="Cendrawasih">Cendrawasih</option>
<option value="BTP">BTP</option>
<option value="DAYA">Daya</option>
<option value="Boulevard">Boulevard</option>
<option value="Graha Pena">Graha Pena</option>
<option value="Trans Studio Mall">Trans Studio Mall</option>
<option value="support">support</option>
   	</select>
   	</div>
   	</div>
   	<div class="form-group"><label for="no_nota" class="control-label col-xs-3">Bank</label><div class="col-xs-4">
          <select class="form-control" name="bank" id="bank" required="true">
          <option value="">--</option>
        <option value="bri">BRI</option>
        <option value="permata">Permata</option>
        <option value="danamon">Danamon</option>
        <option value="bni">bni</option>
 <option value="mandiri">Mandiri</option>
 <option value="bca">BCA</option>
  <option value="bii">BII</option>
   	</select>
   	</div>
   	</div>
<div class="form-group">
  		<label for="no_nota" class="control-label col-xs-3">Jumlah Setoran</label>
  		 <div class="col-xs-8">
  		<input type="number" autocomplete="off" class="form-control" name="setoran" id="setoran"   onkeydown="return tabOnEnter(this,event)"required="true"/>
  		</div>
		</div>
		
		
		
		<div class="form-group">
  		<label for="no_nota" class="control-label col-xs-3">Pemasukan Tanggal</label>
  		 <div class="col-xs-8">
  		<textarea type="text" class="form-control" name="pemasukan_tgl" id="pemasukan_tgl"   onkeydown="return tabOnEnter(this,event)"required="true" ></textarea>
  		</div>
		</div>
		
		
		
		
		
		
		
		<tr>
					<td></td>
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
			var jumlah = $('#setoran').val();
				
    		
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