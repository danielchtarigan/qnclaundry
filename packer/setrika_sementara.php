<?php
//Koneksi database
include '../config.php';
include 'header.php';

$no_nota = $_GET['no_nota'];
$id_cs = $_GET['id_cs'];
$jenis=$_GET['jenis'];
$workshop=$_SESSION['workshop'];

$sql1=$con->query("select * from reception WHERE no_nota = '$no_nota' and id_customer='$id_cs' LIMIT 1");
$data = $sql1->fetch_assoc();

$sql=$con->query("select * from setrika_sementara WHERE no_nota = '$no_nota' LIMIT 1");
$row = mysqli_num_rows( $sql );
 
 
//Jika ditemukan maka tampilkan
if ( $row != 0 ) {
	?>
		<div  class="container-fluid" style="width:500px;
   margin:0 auto; 
   position:relative; 
   border:3px solid rgba(0,0,0,0); 
   -webkit-border-radius:5px; 
   -moz-border-radius:5px;
   border-radius:5px;
   -webkit-box-shadow:0 0 18px rgba(0,0,0,0.4);
   -moz-box-shadow:0 0 18px rgba(0,0,0,0.4);
   box-shadow:0 0 18px rgba(0,0,0,0.4);
   color:#000000;
   margin-bottom: 10px;">
   <marquee behavior=alternate style="font-size: 25px;color: #ff0000"  > <h1>Sementara di setrika</h1></marquee>
			<form method="post" action="" id="form-input" class="form-horizontal">
		 <input type="hidden" class="form-control" name="id_cs" id="id_cs" required="true" value="<?php echo $id_cs; ?>" readonly="true" >
		<div class="form-group">
  		
  		<label class="control-label col-xs-3" for="no_nota">No Nota</label> <div class="col-xs-4"> <input type="text" class="form-control" name="no_nota" id="no_nota" required="true" value="<?php echo $no_nota; ?>" readonly="true" >
  		</div></div>
  		
  		<div class="form-group" >
  		<label class="control-label col-xs-3" for="nama_customer">Nama Customer</label>
		<div class="col-xs-4"> <input type="text" class="form-control" name="nama_customer" id="nama_customer" required="true" value="<?php echo $data['nama_customer']; ?>" readonly="true" ></div>
		</div>
		<div class="form-group">
  	<label class="control-label col-xs-3" for="nama">Jumlah</label><div class="col-xs-4">
  	<input type="text" class="form-control" name="jumlah" id="jumlah" required="true" value="<?php echo $data['jumlah']; ?>" readonly="true" ></div>
  		</div>
  		<div class="form-group">
  		<label class="control-label col-xs-3" for="ket">Keterangan</label>
  		<div class="col-xs-5">
  		<textarea type="text" class="form-control" name="ket" id="ket" required="true" value="<?php echo $data['ket']; ?>" readonly="true" ></textarea></div>
  		</div>
		<div class="form-group"> 
     	<label class="control-label col-xs-3" for="setrika">Setrika</label>
	 <div class="col-xs-4" >
	<select class="form-control" name="setrika" id="setrika" readonly="true" required=true>
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
	
	</div>

	</form>
	</div>


<?php }
	else{?>
	<div  class="container-fluid" style="width:500px;
   margin:0 auto; 
   position:relative; 
   border:3px solid rgba(0,0,0,0); 
   -webkit-border-radius:5px; 
   -moz-border-radius:5px;
   border-radius:5px;
   -webkit-box-shadow:0 0 18px rgba(0,0,0,0.4);
   -moz-box-shadow:0 0 18px rgba(0,0,0,0.4);
   box-shadow:0 0 18px rgba(0,0,0,0.4);
   color:#000000;
   margin-bottom: 10px;">
   <marquee behavior=alternate style="font-size: 25px;color: #ff0000"  > <h1>Daftarkan Setrikaan</h1></marquee>
			<form method="post" action="" id="form-input" class="form-horizontal">
		<div id="pesan_kirim" style="display:none"></div>
		 <input type="hidden" class="form-control" name="id_cs" id="id_cs" required="true" value="<?php echo $id_cs; ?>" readonly="true" >
		<div class="form-group">
  		
  		<label class="control-label col-xs-3" for="no_nota">No Nota</label> <div class="col-xs-4"> <input type="text" class="form-control" name="no_nota" id="no_nota" required="true" value="<?php echo $no_nota; ?>" readonly="true" >
  		</div></div>
  		
  		<div class="form-group" >
  		<label class="control-label col-xs-3" for="nama_customer">Nama Customer</label>
		<div class="col-xs-4"> <input type="text" class="form-control" name="nama_customer" id="nama_customer" required="true" value="<?php echo $data['nama_customer']; ?>" readonly="true" ></div>
		</div>
		<div class="form-group">
  	<label class="control-label col-xs-3" for="nama">Jumlah</label><div class="col-xs-4">
  	<input type="text" class="form-control" name="jumlah" id="jumlah" required="true" value="<?php echo $data['jumlah']; ?>" readonly="true" ></div>
  		</div>
  		<div class="form-group">
  		<label class="control-label col-xs-3" for="ket">Keterangan</label>
  		<div class="col-xs-5">
  		<textarea type="text" class="form-control" name="ket" id="ket" required="true" value="<?php echo $data['ket']; ?>" readonly="true" ></textarea></div>
  		</div>
		<div class="form-group"> 
     	<label class="control-label col-xs-3" for="setrika">Setrika</label>
	 <div class="col-xs-4" >
	<select class="form-control" name="setrika" id="setrika" required=true>
        <option value="">--</option>';				
		
			<?php
			if ($jenis=='potongan'){
			$query = "select * from user where level='setrika' and aktif='Ya' and jenis='potongan' or izinkan='setrika'";
			$hasil = mysqli_query($con,$query);
			while ($qtabel = mysqli_fetch_assoc($hasil))
			{
                              
				echo '<option value="'.$qtabel['name'].'">'.$qtabel['name'].'</option>';				
			}
				
			}else{
				$query = "select * from user where level='setrika' and aktif='Ya' or izinkan='setrika'";
			$hasil = mysqli_query($con,$query);
			while ($qtabel = mysqli_fetch_assoc($hasil))
			{
                              
				echo '<option value="'.$qtabel['name'].'">'.$qtabel['name'].'</option>';				
			}
			}
			
			?>


    </select>
</div>
     </div>
	<div class="form-group">
        <input type="hidden" value="<?=$workshop?>" name="workshop" id="workshop">
	<input type="button" value="Simpan" name="add" id="add" onclick="kirim_form();" class="btn btn-primary">
	</div>

	</form>
	</div>
	<script type="text/javascript">
     function printout() {

    var newWindow = window.open('','_blank','status=0,toolbar=0,location=0,menubar=1,resizable=1,scrollbars=1');
    newWindow.document.write(document.getElementById("pesan_kirim").innerHTML);
    newWindow.print();
}
    </script>

<script>
	 
	function kirim_form(){
		
    $('#pesan_kirim').html('Loading ...');
    $('#pesan_kirim').slideDown('slow');

    var id_cs   = $('#id_cs').val();
    var no_nota   = $('#no_nota').val();
    var setrika = $('#setrika').val();
    var workshop = $('#workshop').val();
    if(setrika == ''){
		alert("Tolong setrika di isi");
		exit();
	} else 
	{$.ajax({
        //Alamat url harap disesuaikan dengan lokasi script pada komputer anda
        url      : 'save_setrika_sementara.php',
        type     : 'POST',
        dataType : 'html',
        data     : 'no_nota='+no_nota+'&id_cs='+id_cs+'&setrika='+setrika+'&workshop='+workshop,
        success  : function(respons){
            $('#pesan_kirim').html(respons);
printout();
window.location='d_setrika.php';
            $("#form-input")[0].reset();
            $("#no_nota").val('');
            $("#nama_customer").val('');
            $("#jumlah").val('');
        },
    })
}
}
     </script>
	<?php
	}
?>
