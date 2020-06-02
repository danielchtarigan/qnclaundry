<?php
//Koneksi database
include 'header.php';
include '../config.php';

//$no_nota = $_GET['nama_cs'];
$id_cs   = $_GET['id_cs'];
//if( !empty ( $no_nota ) ){
//Query sql untuk mencari data
$sql = mysqli_query($con,"SELECT * From customer where id='$id_cs' LIMIT 1");
//Cek apakah data ditemukan
$row = mysqli_num_rows( $sql );
//Jika ditemukan maka tampilkan
if( $row != 0 ){
	while( $data = mysqli_fetch_assoc( $sql ) )
	{
?>

<div  class="container" style="padding:20px;
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
   margin-bottom: 100px;
   ">

  <script>
    
    function kirim_form()
    {
    $('#pesan_kirim').html('Loading ...');
    $('#pesan_kirim').slideDown('slow');
    
    var id_customer= $('#id_customer').val();
    var nama_customer= $('#nama_customer').val();
    var Jns_vocher= $('#Jns_vocher').val();
    var vocher= $('#vocher').val();
		if ( vocher == "" )
		{
		alert("No Voucher Masih Kosong");
		$("#vocher").focus();
		return false;
		} 
    
    $.ajax(
    {
    url		 : 'savereferall.php',
    type     : 'POST',
    dataType : 'html',
    data	 : 'id_customer='+id_customer+'&nama_customer='+nama_customer+'&Jns_vocher='+Jns_vocher+'&vocher='+vocher,
    success	 : function(respons)
    {
    $('#pesan_kirim').html(respons);
    },
    })
    }
    </script>
				
                
<fieldset>
<legend align="center"><h2 style="color:#85B92E;">Daftar Costumer Referall
</h2>
<form method="post" action="" id="form-input" class="form-horizontal">
  <div id="pesan_kirim" style="display:none">
  </div>
  <div class="form-group">
  <div class="col-xs-12">
  <input type="hidden" class="form-control" name="id_customer" id="id_customer" required="true" value="<?php echo $data['id']; ?>" readonly="true" />
  </div>
  </div>
  <div class="form-group" >
  <label class="control-label col-xs-5" for="nama_customer">
    Nama Customer
  </label>
  <div class="col-xs-4">
  <input type="text" class="form-control" name="nama_customer" id="nama_customer" required="true" value="<?php echo $data['nama_customer']; ?>" readonly="true" >
  </div>
  </div>
  <div class="form-group" >
  <label class="control-label col-xs-5" for="nama_customer">
    Alamat
  </label>
  <div class="col-xs-4">
  <input type="text" class="form-control" name="alamat" id="alamat" required="true" value="<?php echo $data['alamat']; ?>" readonly="true" >
  </div>
  </div>
  <div class="form-group" >
  <label class="control-label col-xs-5" for="nama_customer">
    No Telephon
  </label>
  <div class="col-xs-4">
  <input type="text" class="form-control" name="no_telp" id="no_telp" required="true" value="<?php echo $data['no_telp']; ?>" readonly="true" >
  </div>
  </div>
  <div class="form-group" >
  <label class="control-label col-xs-5" for="nama_customer2"> Jenis Voucher</label>
  <div class="col-xs-4">
  <input  value="Voucher Referall" class="form-control" type="text" name="Jns_vocher" id="Jns_vocher" readonly="true" />
  </div>
  </div>
  <div class="form-group" >
  <label class="control-label col-xs-5" for="nama_customer3"> Diskon </label>
  <div class="col-xs-4">
  <input  Value="15%" class="form-control" type="text" name="disk" id="disk" readonly="true" />
  </div>
  </div>
  <div class="form-group" >
  <label class="control-label col-xs-5" for="nama_customer">
    No Voucher
  </label>
  <div class="col-xs-4">
  <input  placeholder="nomer vocher" class="form-control" type="text" name="vocher" id="vocher" />
  </div>
  </div>
<hr>
  <div align="center" class="form-group">
      <div class="col-xs-12">
          <input type="button" value="Simpan" name="addvocher" id="addvocher" onclick="kirim_form()" class="btn btn-success" style="width:200px;" />
    </div>
  </div>
</form>
</fieldset>
</div>

<?php
	}}
?>
