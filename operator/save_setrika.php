<html>
<?php
include 'header.php';
include '../config.php';
$sql = mysqli_query($con,"SELECT id,no_nota,nama_customer,jumlah,berat FROM reception WHERE id = '".$_GET['id']."'");
$data = mysqli_fetch_array($sql);

?>

<head>

</head>
  <body>
 <div style="width:800px; margin:0 auto; position:relative; border:3px solid rgba(0,0,0,0); -webkit-border-radius:5px; -moz-border-radius:5px; border-radius:5px; -webkit-box-shadow:0 0 18px rgba(0,0,0,0.4); -moz-box-shadow:0 0 18px rgba(0,0,0,0.4); box-shadow:0 0 18px rgba(0,0,0,0.4); margin-top:70px; margin-bottom:80px; color:#000000;">
<div class="row">
    <div class="col-lg-10">
        <div class="page-header">
            <h1>SETRIKA</h1>
             <strong><font color="#ff0000">-- Jika berat ada komanya maka di isi titik contoh 1.9 --</font></strong></br>
<strong><font color="#0567fa">-- Perhatikan nama setrika jangan sampai salah --</font></strong>
        </div>
    </div>
</div>
<div class="row">
	<div class="col-md-10">
	<form id="form_input" method="POST" class="form-horizontal">	

<?php  
$nt=$data['no_nota'];
$us=$_SESSION['user_id'];
if(isset($_POST['update']))
{
	date_default_timezone_set('Asia/Makassar');
$jam=date("Y-m-d H:i:s");

		$q=mysqli_query($con,"insert into setrika (tgl_setrika,user_setrika,no_nota,berat) VALUES('$jam','".$_POST['setrika']."','$nt','".$_POST['berat']."')");

	 $query="update reception set setrika='1',tgl_setrika='$jam',user_setrika='".$_POST['setrika']."'  WHERE id = '".$_GET['id']."'";
	 $hasil=mysqli_query($con,$query);
	 if($hasil){
	header("location:cari_nota_setrika.php");


	}
	
	else {
	 echo '<font color="red" size=10>Error, CAN NOT SAVE DATA</font>';
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
  		Berat   	  : <label class="control-label" for="nama_customer"><?php echo $data['berat']; ?></label>
		</div>
		<div class="form-group">
  		<label class="control-label col-xs-3" for="hp">Berat</label>
 <div class="col-xs-4" >
  		<input type="number" step="any" class="form-control" name="berat" id="berat" required>
		</div></div>
		
        <div class="form-group"> 
     	<label class="control-label col-xs-3" for="Express">Setrika</label>
	 <div class="col-xs-4" >
	<select class="form-control" name="setrika" id="setrika" required=true>
        <option value="">--</option>';				

			<?php
			
			$query = "select * from user where level='setrika'";
			$hasil = mysqli_query($con,$query);
			while ($qtabel = mysqli_fetch_assoc($hasil))
			{
                              
				echo '<option value="'.$qtabel['name'].'">'.$qtabel['name'].'</option>';				
			}
			?>


    </select>
</div>
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
            $("#jumlah").focus();
        });
    </script>
</body>
</html>

