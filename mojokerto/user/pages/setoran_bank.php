<!DOCTYPE html>
<html lang="en">

<head>
<?php

include '../../../config.php';
?>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>QUICK &' CLEAN ADMIN</title>

    <link href="../../../lib/css/bootstrap.min.css" rel="stylesheet">
	<link href="../../dist/css/metisMenu.css" rel="stylesheet">
	<link href="../../dist/css/timeline.css" rel="stylesheet">
	<link href="../../dist/css/sb-admin-2.css" rel="stylesheet">
	<link href="../../font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

<link rel="stylesheet" type="text/css" href="../../../lib/themes/bootstrap/easyui.css">
<link rel="stylesheet" type="text/css" href="../../../lib/themes/icon.css">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
          <?php 
             include 'nav.php';
           ?>
        <div id="page-wrapper">


<div align="center">
	<h2>FORM SETORAN BANK</h2>
	<div class="easyui-panel" title="Tutup Kasir" align="center" style="width:500px;padding:10px;">
		<form id="ff" action="../fungsi/p_setoran_bank.php" method="post" class="form-horizontal">
		<table>
		
   	<div class="form-group"><label for="no_nota" class="control-label col-xs-3">Bank</label><div class="col-xs-4">
          <select class="form-control" name="bank" id="bank" required="true">
          <option value="">--</option>
        <option value="bri">BRI</option>
        <option value="permata">Permata</option>
        <option value="danamon">Danamon</option>
        <option value="bni">bni</option>
 <option value="mandiri">Mandiri</option>
 <option value="bca">BCA</option>
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



          
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <script src="../../../lib/js/jquery-2.1.4.min.js"></script>
    <script src="../../../lib/js/bootstrap.min.js"></script>
    <script src="../../dist/js/metisMenu.js"></script>
    <script src="../../dist/js/sb-admin-2.js"></script>
  <script type="text/javascript" src="../../../lib/js/jquery.easyui.min.js"></script>
</body>

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

</html>
