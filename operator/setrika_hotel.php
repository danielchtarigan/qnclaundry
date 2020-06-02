<html>
<head>
<?php 
require "header.php";
include "../config.php"; 
$us=$_SESSION['user_id'];
$ot=$_SESSION['nama_outlet'];
date_default_timezone_set('Asia/Makassar');
$today = date("Ymd");
$query = "SELECT max(no_nota) AS last FROM setrika_hotel WHERE no_nota like '$today%'";
$hasil = mysqli_query($con,$query);
$data  = mysqli_fetch_array($hasil);
$lastNoTransaksi = $data['last'];
 
// baca nomor urut transaksi dari id transaksi terakhir
$lastNoUrut = substr($lastNoTransaksi, 8, 4);
 
// nomor urut ditambah 1
$nextNoUrut = $lastNoUrut + 1;
 
// membuat format nomor transaksi berikutnya
$nextNoTransaksi = $today.sprintf('%04s', $nextNoUrut);

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
<h1>Setrika Hotel</h1>
<div class="row">
<div class="col-md-15 col-sm-15">
	<div id="pesan_kirim" style="display:none"></div>
	<input type="button" value="New" name="new" id="new" onclick="new();" class="btn btn-info">
	<form id="form-input"  method="POST" class="form-horizontal">
	<div class="form-group ">
  		<label class="control-label col-xs-3" for="hp">No Nota</label><div class="col-xs-4"> 
  		<input type="text" readonly="true" class="form-control" autocomplete="off" name="no_nota" id="no_nota" required="true">
		</div></div>
	 <div class="form-group"> 
	
     	<label class="control-label col-xs-3" for="nama_customer">Customer</label>
	 <div class="col-xs-4" >
	<select class="form-control" name="nama_customer" id="nama_customer">
        <option value="">--</option>
        <option value="amaris">H Amaris</option>
        <option value="astra">H Astra</option>
        <option value="bestwestern">H Best Western</option>
        <option value="scarlet">H scarlet</option>
        <option value="vindika">H Vindika</option>
        <option value="vindikapengayoman">H Vindika Pengayoman</option>
        <option value="parade">H parade</option>
        <option value="platinum">H Platinum</option>
        <option value="pondok">H Pondok</option>
        <option value="Regency">H Regency</option>
        <option value="MakassarBeach">H Makassar Beach</option>
        <option value="venuskencana">H Venus Kencana</option>        
    </select>
</div>
     </div>
     <div class="form-group"> 
     	<label class="control-label col-xs-3" for="setrika">Setrika</label>
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
	<div class="form-group ">
  		<label class="control-label col-xs-3" for="hp">Berat</label><div class="col-xs-4"> 
  		<input type="number" step="any" class="form-control" autocomplete="off" name="berat" id="berat" required="true">
		</div></div>
	
     <div class="form-group">
  		<label class="control-label col-xs-3" for="nama_customer">Keterangan</label>
  		 <div class="col-xs-4" >
  		<textarea type="text" class="form-control" name="ket" id="ket"></textarea>
		</div>
		</div>
	<div class="form-group">
	 <div class="col-xs-10" align="center" >
	 
	 <input type="button" value="Simpan" name="update" id="update" onclick="kirim_form();" class="btn btn-success">
	</div>
</div>
	</form>
	</div>

</div>
</div>


<input type="button" value="Tampilkan" name="tampil" id="tampil"  class="btn btn-info">
<div id="detailhotel"></div>

</body>
  <script type="text/javascript">
     function printout() {

    var newWindow = window.open('','_blank','status=0,toolbar=0,location=0,menubar=1,resizable=1,scrollbars=1');
    newWindow.document.write(document.getElementById("pesan_kirim").innerHTML);
    newWindow.print();
}
    </script>
    
    <script>
 
 //Inisiasi awal penggunaan jQuery
 $(document).ready(function(){
 	
  //Pertama sembunyikan elemen class gambar
 
        $('#update').hide(); 
  //Ketika elemen class tampil di klik maka elemen class gambar tampil
        $('#new').click(function(){
			
        	$('#no_nota').val('<?php echo $nextNoTransaksi ?>');
        $('#update').show();
        });

 });
 </script>
    
<script>

 $("#tampil").click(function()
     	{
     		 $('#detailhotel').load('daftar_setrika_hotel.php');
  					   
        })
                    




	function kirim_form(){
		
    $('#pesan_kirim').html('Loading ...');
    $('#pesan_kirim').slideDown('slow');
    
    var no_nota   = $('#no_nota').val();
   var berat   = $('#berat').val();
    var nama_customer = $('#nama_customer').val();
    var ket = $('#ket').val();
    var setrika=$('#setrika').val();
   
    			
			if ( berat== "" ){
				alert("berat Masih Kosong");
				$("#berat").focus();
				return false;
			}
			else if ( nama_customer == "" ){
				alert("nama customer Kosong");
				$("#nama_customer").focus();
				return false;
			}
			else if ( setrika == "" ){
				alert("setrika Kosong");
				$("#setrika").focus();
				return false;
			}
			$.ajax({
				
url      : 'pk_setrika_hotel.php',
type     : 'POST',
dataType : 'html',
data     : 'no_nota='+no_nota+'&berat='+berat+'&ket='+ket+'&nama_customer='+nama_customer+'&setrika='+setrika,
success  : function(respons){
$('#pesan_kirim').html(respons);
 $("#form-input")[0].reset();
          	
          	 $('#detailhotel').load('daftar_setrika_hotel.php');
          	 $('#pesan_kirim').hide();
          	printout();
             location.reload();        
            
        },
    })
}


     </script>
<script>
	function getNextElement(field) {
    var form = field.form;
    for ( var e = 0; e < form.elements.length; e++) {
        if (field == form.elements[e]) {
            break;
        }
    }
    return form.elements[++e % form.elements.length];
}

function tabOnEnter(field, evt) {
if (evt.keyCode === 13) {
        if (evt.preventDefault) {
            evt.preventDefault();
        } else if (evt.stopPropagation) {
            evt.stopPropagation();
        } else {
            evt.returnValue = false;
        }
        getNextElement(field).focus();
        return false;
    } else {
        return true;
    }
}
		
		
	</script>
	<script type="text/javascript">
        $(function() {
            $("#no_nota").focus();
        });
    </script>
</html>