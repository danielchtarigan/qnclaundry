<html>
<head>
<?php 
require "header.php";
include "../config.php"; 
$us=$_SESSION['user_id'];
$ot=$_SESSION['nama_outlet'];

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
<h1>Packing Hotel</h1>
<div class="row">
<div class="col-md-15 col-sm-15">
	<div id="pesan_kirim" style="display:none"></div>
	<form id="form-input" method="POST" class="form-horizontal">
	
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
        <option value="venuskencana">H Venus Kencana</option>
        <option value="Regency">H Regency</option>
        <option value="MakassarBeach">H Makassar Beach</option>
        
    </select>
</div>
     </div>	
	<div class="form-group">
  		<label class="control-label col-xs-3" for="jumlah">Jumlah</label>
	 <div class="col-xs-3" >
	<input type="number" class="form-control" name="jumlah" autocomplete="off" id="jumlah"   onkeydown="return tabOnEnter(this,event)"required/>
</div>
	</div>
	
     <div class="form-group">
  		<label class="control-label col-xs-3" for="nama_customer">Keterangan</label>
  		 <div class="col-xs-4" >
  		<textarea type="text" class="form-control" name="ket" id="ket"></textarea>
		</div>
		</div>
	<div class="form-group">
	 <div class="col-xs-10" align="center" >
	 
	 <input type="button" value="Simpan" name="update" id="update" onClick="kirim_form();" class="btn btn-success">
	</div>
</div>
	</form>
	</div>

</div>
</div>


<input type="button" value="Tampilkan" name="tampil" id="tampil"  class="btn btn-info">
<div id="detailhotel"></div>

</body>

<script>

 $("#tampil").click(function()
     	{
     		 $('#detailhotel').load('daftar_packing_hotel.php');
  					   
        })
                    




	function kirim_form(){
		
    $('#pesan_kirim').html('Loading ...');
    $('#pesan_kirim').slideDown('slow');
     
    var no_nota   = $('#no_nota').val();
    var jumlah = $('#jumlah').val();
    var nama_customer = $('#nama_customer').val();
    var ket = $('#ket').val();
   
    			
			if ( jumlah == "" ){
				alert("jumlah Masih Kosong");
				$("#jumlah").focus();
				return false;
			}
			else if ( nama_customer == "" ){
				alert("nama customer Kosong");
				$("#nama_customer").focus();
				return false;
			}
			
			
    $.ajax({
        //Alamat url harap disesuaikan dengan lokasi script pada komputer anda
        url      : 'pk_operasional_hotel.php',
        type     : 'POST',
        dataType : 'html',
        data     : 'no_nota='+no_nota+'&jumlah='+jumlah+'&ket='+ket+'&nama_customer='+nama_customer,
        success  : function(respons){
            $('#pesan_kirim').html(respons);
          	$("#form-input")[0].reset();
          	
          	 $('#detailhotel').load('daftar_packing_hotel.php');
                     
            
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