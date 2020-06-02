<html>
<head>
	
<?php 
include "header.php";
include "../config.php"; 
$us=$_SESSION['user_id'];
$ot=$_SESSION['nama_outlet'];

date_default_timezone_set('Asia/Makassar');
$today = date("Ymd");
$query = "SELECT max(no_so) AS last FROM hotel_trans LIMIT 1";
$hasil = mysqli_query($con,$query);
$data  = mysqli_fetch_array($hasil);
$lastNoTransaksi = $data['last'];
 
// baca nomor urut transaksi dari id transaksi terakhir
$lastNoUrut = substr($lastNoTransaksi, 4, 6);
 
// nomor urut ditambah 1
$nextNoUrut = $lastNoUrut + 1;
$char = "SCOR"; 
// membuat format nomor transaksi berikutnya
$nextNoTransaksi = $char.sprintf('%04s', $nextNoUrut);

$sql=$con->query("select * from hotel");
$r = $sql->fetch_assoc();

?>
</head>
<body>


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
<legend align="center"><strong><h1>Input Order Hotel</h1></strong></legend>
</br>

<div class="row">
<div class="col-md-15 col-sm-15">
<div id="pesan_kirim" style="display:none"></div>
<div class="form-group">
<div class="col-xs-10" align="center" >
<input type="button" value="New Transaction" name="new" id="new" onClick="new();" class="btn btn-info">
</br>
</br>
</div>
</div>

<form id="form-input"  method="POST" class="form-horizontal">
<div class="form-group ">
    <label class="control-label col-xs-3" for="hp4">
    No Nota</label>
    <div class="col-xs-4">
    <input type="text" readonly="true" class="form-control" autocomplete="off" name="no_nota" id="no_nota" required="true">
    </div>
</div>
<div class="form-group ">
<label class="control-label col-xs-3" for="nama_customer5">Hotel</label>

<div class="col-xs-4" >
  <select class="form-control" name="nama_hotel" id="nama_hotel" required=true>
    <option value="">-- Pilih Hotel--</option>
    ';				
			
<?php		
$query = "select * from hotel";
$hasil = mysqli_query($con,$query);
while ($qtabel = mysqli_fetch_assoc($hasil))
{                             
echo '<option value="'.$qtabel['nama_hotel'].'">'.$qtabel['nama_hotel'].'</option>';				
}
?>


</select>
</div>
</div>
<!--
        <div class="form-group ">
        <label class="control-label col-xs-3" for="hp3">Alamat</label>
        <div class="col-xs-4">
          <input type="text" readonly="true" class="form-control" autocomplete="off" name="alamat" id="alamat" required="true" >
        </div>
        </div>

		<div class="form-group ">
        <label class="control-label col-xs-3" for="hp3">No Telephon</label>
        <div class="col-xs-4">
          <input type="text" readonly="true" class="form-control" autocomplete="off" name="notelp" id="notelp" required="true">
        </div>
        </div>
        
        <div class="form-group ">
        <label class="control-label col-xs-3" for="hp3">Email</label>
        <div class="col-xs-4">
          <input type="text" readonly="true" class="form-control" autocomplete="off" name="email" id="email" required="true">
        </div>
        </div>
        
        <div class="form-group">
        <div class="col-xs-10" align="center" >
        
-->
        <input type="button" value="Simpan" name="update" id="update" onClick="kirim_form();" class="btn btn-success">
        </div>
        </div>
	  </form>
	</div>

</div>
</div>


<!--<div id="spk">
<!--<form id="form-detail"  method="POST" class="form-horizontal">
<!--<div class="form-group ">
    <div class="col-xs-4">
    <input type="text" readonly="true" class="form-control" autocomplete="off" name="no_nota2" id="no_nota2" required="true">
    </div>
</div> -->
<div id="detailhotel"></div>
<!--</form> -->
<!--</div> -->



</body>
<script>

 
 //Inisiasi awal penggunaan jQuery
 $(document).ready(function(){
 	
  //Pertama sembunyikan elemen class gambar
 
        $('#update').hide();
		//$('#spk').hide(); 
  //Ketika elemen class tampil di klik maka elemen class gambar tampil
        $('#new').click(function(){
			
        	$('#no_nota').val('<?php echo $nextNoTransaksi ?>');
        $('#update').show();
        });

 });
 </script>
 
 <script>
	function kirim_form(){
    $('#pesan_kirim').html('Loading ...');
    $('#pesan_kirim').slideDown('slow');
    
    var no_nota   = $('#no_nota').val();
    var nama_hotel = $('#nama_hotel').val();
   			
	if ( nama_hotel == "" ){
		alert("Nama Hotel masih Kosong");
		$("#nama_hotel").focus();
		return false;
	}
	$.ajax({
	url      : 'pk_hotel.php',
	type     : 'POST',
	dataType : 'html',
	data     : 'no_nota='+no_nota+'&nama_hotel='+nama_hotel,
	success  : function(respons){
		
				 $('#pesan_kirim').html(respons);
				 $('#detailhotel').load("detail_spk.php","no_nota="+no_nota);
				  $('#update').hide();
				 //$('#spk').show();
				 //$('#no_nota2').value()=$('#no_nota').value();
				 //$('#pesan_kirim').hide();
				 printout();
				 location.reload();        
			},
		})
	}
     </script>
</html>
