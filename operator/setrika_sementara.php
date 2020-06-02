<html>
<?php
include 'header.php';
include '../config.php';
?>

<head>

</head>
 <body>
 <div class="container-fluid" style="width:800px; margin:0 auto; position:relative; border:3px solid rgba(0,0,0,0); -webkit-border-radius:5px; -moz-border-radius:5px; border-radius:5px; -webkit-box-shadow:0 0 18px rgba(0,0,0,0.4); -moz-box-shadow:0 0 18px rgba(0,0,0,0.4); box-shadow:0 0 18px rgba(0,0,0,0.4);  margin-bottom:80px; color:#000000;">
<marquee behavior=alternate style="font-size: 25px;color: #fd4102"  > <h1>SETRIKA HOTEL</h1></marquee>
	
	<form id="form-input" method="POST" class="form-horizontal">
	<strong><p> Cara mengisi no nota : nama setrika.nama hotel.tgl setrika. Contoh nya andi.astra.020615</p></strong>
    <div id="pesan_kirim" style="display:none"></div>


		<div class="form-group">
  		<label class="control-label col-xs-3" for="hp">No Nota</label><div class="col-xs-4"> 
  		<input type="text" class="form-control" name="no_nota" id="no_nota" required>
		</div></div>
		<div class="form-group ">
  		<label class="control-label col-xs-3" for="nama_customer">Nama Customer</label><div class="col-xs-4"> 
  		<input type="text" class="form-control" name="nama_customer" id="nama_customer" required>
		</div></div>
		<div class="form-group ">
  		<label class="control-label col-xs-3" for="hp">Berat</label><div class="col-xs-4"> 
  		<input type="number" step="any" class="form-control" name="berat" id="berat" required="true">
		</div></div>
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


	<div class="form-group">
	
	<input type="button" value="Simpan" name="add" id="add" onclick="kirim_form();" class="btn btn-primary">
	
	</div>

	</form>
	</div>




</div>
	<script type="text/javascript">
        $(function() {
            $("#no_nota").focus();
        });
    </script>
</body>
    <script type="text/javascript">
     function printout() {

    var newWindow = window.open();
    newWindow.document.write(document.getElementById("pesan_kirim").innerHTML);
    newWindow.print();
}
    </script>

<script>
	 
	function kirim_form(){
		
    $('#pesan_kirim').html('Loading ...');
    $('#pesan_kirim').slideDown('slow');
     
    var no_nota   = $('#no_nota').val();
    var jumlah1 = $('#jumlah1').val();
    var ket = $('#ket').val();
    var setrika = $('#setrika').val();
     var berat = $('#berat').val();
    if(jumlah1 == '' || setrika == ''|| berat == ''){
		alert("Tolong Jumlah ama setrika di isi");
		exit();
	} else 
	{
		
		
    
   
    $.ajax({
        //Alamat url harap disesuaikan dengan lokasi script pada komputer anda
        url      : 'save_setrika_hotel.php',
        type     : 'POST',
        dataType : 'html',
        data     : 'no_nota='+no_nota+'&jumlah1='+jumlah1+'&ket='+ket+'&setrika='+setrika+'&berat='+berat,
        success  : function(respons){
        	
            $('#pesan_kirim').html(respons);
	           printout();
            $("#form-input")[0].reset();
            $("#no_nota").val('');
            $("#nama_customer").val('');
            $("#jumlah").val('');
            
            
        },
    })
}
}
     </script>
    
</html>

