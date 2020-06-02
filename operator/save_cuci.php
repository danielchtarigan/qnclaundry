<html>
<?php
include 'header.php';
include '../config.php';
$sql = mysqli_query($con,"SELECT id,no_nota,nama_customer,jumlah FROM reception WHERE id = '".$_GET['id']."'");
$data = mysqli_fetch_array($sql);

?>

<head>

</head>
  <body>
 <div style="width:800px; margin:0 auto; position:relative; border:3px solid rgba(0,0,0,0); -webkit-border-radius:5px; -moz-border-radius:5px; border-radius:5px; -webkit-box-shadow:0 0 18px rgba(0,0,0,0.4); -moz-box-shadow:0 0 18px rgba(0,0,0,0.4); box-shadow:0 0 18px rgba(0,0,0,0.4); margin-top:70px; margin-bottom:80px; color:#000000;">
<div class="row">
    <div class="col-lg-10">
        <div class="page-header">
            <h1>OPERATOR CUCI</h1>
        </div>
    </div>
</div>
<div class="row">
	<div class="col-md-6">
	<form id="form_input" method="POST">	

<?php  
$us=$_SESSION['user_id'];
$nt=$data['no_nota'];
if(isset($_POST['update']))

{

date_default_timezone_set('Asia/Makassar');
$jam=date("Y-m-d H:i:s");
	$q=mysqli_query($con,"insert into cuci (tgl_cuci,op_cuci,no_nota,jumlah,no_mesin) VALUES('$jam','$us','$nt','".$_POST['jumlah1']."','".$_POST['no_mesin']."')");
	
	 $query="update reception set cuci='1',tgl_cuci='$jam',op_cuci='$us'  WHERE id = '".$_GET['id']."'";
	 $hasil=mysqli_query($con,$query);
	 if($hasil){
	 	
	 echo '<font color="green">DATA HAS BEEN SAVED</font>';
	header("location:cari_nota_cuci.php");


	}
	
	else {
	 echo '<font color="red">Error, CAN NOT SAVE DATA</font>';
	 }
	}
	
?>

  		<div class="form-group">
		No Nota 	  : <label class="control-label" for="nama"><?php echo $data['no_nota']; ?></label>
  		</div>
  		<div class="form-group">
  		Nama Customer : <label class="control-label" for="nama_customer"><?php echo $data['nama_customer']; ?></label>
		</div>
		<div class="form-group">
  		Jumlah  	  : <label class="control-label" for="nama"><?php echo $data['jumlah']; ?></label>
  		</div>
		<div class="form-group">
  		<label class="control-label" for="jumlah">Jumlah</label>
  		<input type="number" class="form-control" name="jumlah1" id="jumlah1" required>
		</div>
		<div class="form-group">
  		<label class="control-label" for="hp">No Mesin</label>
  		<input type="text" class="form-control" name="no_mesin" id="no_mesin" required>
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
            $("#jumlah1").focus();
        });
    </script>
</body>
</html>

