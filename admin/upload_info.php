<?php
include '../config.php';
include 'head.php';

date_default_timezone_set('Asia/Makassar');
	 
	 
if(isset($_POST['submit'])){
	$ot = $_POST['outlet'];
	$urut = $_POST['urut'];

	$folder = '../reception/images/';
	$nfile = $_FILES['infor']['name'];
	$ori = $_FILES['infor']['tmp_name'];
	$rnfile = date('Hs').$nfile;
	move_uploaded_file($ori, $folder.$rnfile);

	$info = mysqli_query($con, "select *from informasi");
     if (mysqli_num_rows($info)>0) {
     	$upload = mysqli_query($con, "update informasi set info_gambar='$rnfile', outlet='$ot' where tampil='$urut'");

     	if ($upload) {?>
		<!-- <script type="text/javascript">
			alert("Gambar berhasil diupload!");
			location.href = "upload_info.php";
		</script> -->
		<?php 
		}
	 }
     else {
	 	$upload = mysqli_query($con, "insert into informasi values ('','$urut','$rnfile','$ot')");
	 
		if ($upload) {?>
			<script type="text/javascript">
				alert("Gambar berhasil diupload!");
				location.href = "upload_info.php";
			</script>
			<?php 
		}
	}
}


?>

<script type="text/javascript">
	$(document).ready(function(){
		$.ajax({
			url : 'info_gambar.php',			
			dataType : 'html',			
		}).done(function(output){
			$("#tampil").html(output);
		})
	});
</script>


<div class="container">
	<form class="form-horizontal" method="post" enctype="multipart/form-data">
	<div class="form-group">
		<label class="control-label col-xs-2 col-sm-22">Tampilan</label>
		    <div class="col-sm-4 col-xs-4">
    			<select class="form-control" name="urut">
    				<option>Urutan Tampil</option>
    				<option value="1">Pertama</option>
    				<option value="2">Kedua</option>
    				<option value="3">Ketiga</option>
    				<option value="4">Keempat</option>
    				<option value="5">Kelima</option>
    			</select>
    		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-xs-2 col-sm-2 hidden">Di Outlet</label>
		    <div class="col-sm-4 col-xs-4">
    			<select name="outlet" class="hidden">		
    				<option value="All">All Outlet</option>
    				<?php 
    					$outlet = mysqli_query($con, "select *from outlet");
    					while($out = mysqli_fetch_array($outlet)){
    				?>
    				<option name="<?php echo $out['nama_outlet']; ?>" value="<?php echo $out['nama_outlet']; ?>"><?php echo $out['nama_outlet']; ?></option>
    				<?php } ?>
    		    </select>
    		</div>
	</div> 
	<div class="form-group">
		<label class="control-label col-xs-2 col-sm-2">Gambar</label>
		<div class="col-sm-4 col-xs-4"><input type="file" id="infor" name="infor"></div>
	</div>
	    <div class="col-sm-2 col-xs-2 col-sm-offset-2">
		    <input class="btn btn-md btn-primary" type="submit" name="submit" value="submit">
		</div>
	</form>
</div>
<br><hr>


<div class="" id="tampil"></div>