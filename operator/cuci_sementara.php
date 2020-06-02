<html>
<?php
include 'header.php';
include '../config.php';
//$sql = mysqli_query($con,"SELECT id,no_nota,nama_customer,jumlah,berat FROM reception WHERE id = '".$_GET['id']."'");
//$data = mysqli_fetch_array($sql);

?>

<head>

</head>
  <body>
 <div class="container-fluid" style="width:800px; margin:0 auto; position:relative; border:3px solid rgba(0,0,0,0); -webkit-border-radius:5px; -moz-border-radius:5px; border-radius:5px; -webkit-box-shadow:0 0 18px rgba(0,0,0,0.4); -moz-box-shadow:0 0 18px rgba(0,0,0,0.4); box-shadow:0 0 18px rgba(0,0,0,0.4);  margin-bottom:80px; color:#000000;">
<marquee behavior=alternate style="font-size: 25px;color: #fd4102"  ><h1>Cuci Hotel</h1></marquee>

	<form id="form_input" method="POST" class="form-horizontal">
	<div id="result"></div>	

<?php  
$us=$_SESSION['user_id'];
if(isset($_POST['update']))
{


date_default_timezone_set('Asia/Makassar');
	$nt=$_POST['no_nota'];
	$jam=date("Y-m-d H:i:s");
	$query="insert into cuci (tgl_cuci,op_cuci,no_nota,jumlah,no_mesin,ket) VALUES('$jam','$us','$nt','".$_POST['jumlah']."','".$_POST['no_mesin']."','".$_POST['ket']."')";
 	 $hasil=mysqli_query($con,$query);
	 if($hasil){
	echo( '<font color="green" size=10>berhasil</font>');
	header("location:cuci_sementara.php");

	}
	
	else {
	 echo '<font color="red" size=10>ERROR DATA GAGAL DI SIMPAN</font>';
	 }
	}
	
?>
		<div class="form-group">
  		<label class="control-label col-xs-3" for="hp">No Nota</label><div class="col-xs-4">
  		<input type="text" class="form-control" name="no_nota" autocomplete="off" id="no_nota" placeholder="isi nama hotel dan tgl masuk" required="true">
		</div><br /></div>
		<div class="form-group">
  		<label class="control-label col-xs-3" for="hp">Jumlah</label><div class="col-xs-4">
  		<input type="number"  class="form-control" autocomplete="off" name="jumlah" id="jumlah" required="true">
		</div><br /></div>
		<div class="form-group">
  		<label class="control-label col-xs-3" for="hp">No Mesin</label><div class="col-xs-4">
  		<input type="text" class="form-control" autocomplete="off" name="no_mesin" id="no_mesin" required="true">
		</div><br /></div>
		<div class="form-group">
  		<label class="control-label col-xs-3" for="ket">Keterangan</label><div class="col-xs-4">
  		<textarea type="text" class="form-control" name="ket" id="ket" required="true"></textarea>
		</div><br /></div>


	<div class="form-group"><div class="col-xs-4">
	<input type="submit" value="Simpan" name="update" class="btn btn-primary">
	</div></div>

	</form>
	</div>
	<script type="text/javascript">
        $(function() {
            $("#no_nota").focus();
        });
    </script>
</body>
</html>