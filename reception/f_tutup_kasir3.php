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

        <?php
date_default_timezone_set('Asia/Makassar');
$date = date("Y-m-d");
$usr= ucfirst($user_id);


$i=1;
$cekping = mysqli_query($con,"select * from ping where waktu like '%$date%' and resepsionis='$usr'");
//$cekping = mysqli_query($con,"select * from ping where waktu like '%$date%' and resepsionis='reza'");
$jumlah= mysqli_num_rows ($cekping); 
while($dping = mysqli_fetch_array($cekping)){
        $wping[$i]= $dping['waktu'];
        $i++;
        }
echo "<br>";
$point=0;
$i=1;
$cekpop = mysqli_query($con,"select * from poptime where time like '%$date%'");
while($dpop = mysqli_fetch_array($cekpop)){
        $wpop[$i]= $dpop['time'];
        $ya=0;
        for($j=1;$j<=$jumlah;$j++){
          if ($wping[$j]>=$wpop[$i]){
          $sl=selisih($wpop[$i],$wping[$j]);
          if($sl<900) $ya=1;}
        }
        $point+=$ya;
        $i++;
        }
$persen=$point/16*100;
 echo "Check Log = ".$persen."%"; 

        function selisih($jm,$jk){   
          $pop_time = substr($jm,11);
          $ping_time = substr($jk,11);   
          list($H,$m,$s)=explode(":",$pop_time );
          $dtawal=mktime($H,$m,$s,"1","1","1");
          list($H,$m,$s)=explode(":",$ping_time );
          $dtakhir=mktime($H,$m,$s,"1","1","1");
          $dtselisih=$dtakhir-$dtawal;
          return $dtselisih;
        }
        ?>

	<div class="easyui-panel" title="Tutup Kasir" align="center" style="width:500px;padding:10px;">
		<form id="ff" action="ptk.php" method="post" class="form-horizontal">
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
					<td><input type="hidden" name="point" value="<?php echo $persen; ?>">
                                        <input type="submit" name="test" id="test" value="Submit"></input></td>
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