<html>
<?php
include 'header.php';
include '../config.php';


?>

<head>

</head>
  <body>
 <div style="width:800px; margin:0 auto; position:relative; border:3px solid rgba(0,0,0,0); -webkit-border-radius:5px; -moz-border-radius:5px; border-radius:5px; -webkit-box-shadow:0 0 18px rgba(0,0,0,0.4); -moz-box-shadow:0 0 18px rgba(0,0,0,0.4); box-shadow:0 0 18px rgba(0,0,0,0.4); margin-top:70px; margin-bottom:80px; color:#000000;">
<div class="row">
    <div class="col-lg-10">
        <div class="page-header">
            <h1>Packing</h1>
        </div>
    </div>
</div>
<div class="row">
	<div class="col-md-6">
	<form id="form_input" method="POST">	

<?php  
$us=$_SESSION['user_id'];
if(isset($_POST['update']))
{


date_default_timezone_set('Asia/Makassar');
	$jam=date("Y-m-d H:i:s");
	$query="insert into packing (tgl_packing,user_packing,no_nota,jumlah) VALUES('$jam','$us','".$_POST['no_nota']."','".$_POST['jumlah']."')";
 	 $hasil=mysqli_query($con,$query);
	 if($hasil){
	echo( '<font color="green" size=10>berhasil</font>');
header("location:cari_nota_packer.php");

	}
	
	else {
	 echo '<font color="red" size=10>ERROR DATA GAGAL DI SIMPAN</font>';
	 }
	}
	
?>
		<div class="form-group">
  		<label class="control-label" for="hp">No Nota</label>
  		<input type="text" class="form-control" name="no_nota" id="no_nota" required>
		</div>
		<div class="form-group">
  		<label class="control-label" for="hp">jumlah</label>
  		<input type="text" class="form-control" name="jumlah" id="jumlah" required>
		</div>
		


	<div class="form-group">
	<input type="submit" value="Simpan" name="update" class="btn btn-primary">
	
	</div>

	</form>
	</div>
</div>




</div>
	<script type="text/javascript">
        $(function() {
            $("#no_nota").focus();
        });
    </script>
</body>
</html>
