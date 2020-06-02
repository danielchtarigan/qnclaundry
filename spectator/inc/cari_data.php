<script>
$(document).ready(function() {
    $('#cari').keyup(function(e) {
        if (e.which == 13) {  // detect the enter key
            $('#cuci').click(); // fire a sample click,  you can do anything
        }
    });

    $('#cuci').click(function(e) {
        var val_cari = $('#cari').val();
 
           //kode 1
           var request = $.ajax ({
               url : "inc/c_rincian.php",
               data : "cari="+val_cari,
               type : "GET",
               dataType: "html"
           });
 
           //menampilkan pesan Sedang mencari saat aplikasi melakukan proses pencarian
           $('#hasil-cari').html('Sedang Mencari...');
 
           //Jika pencarian selesai
           request.done(function(output) {
               //Tampilkan hasil pencarian pada tag div dengan id hasil-cari
               $('#kotak2').slideDown();
               $('#hasil-cari').html(output);
               $('#cari').val('');
                });
 
    });
});

      
           //membuat variabel val_cari dan mengisinya dengan nilai pada field cari
          
     
   </script>


<head>

</head>
<body>




<div class="col-md-6 col-md-offset-3">
<legend align="center"><marquee behavior=alternate  width="90%"><strong>Cari Rincian Nota</strong></marquee></legend>
</div><br>

<div class="col-md-6 col-xs-12 col-md-offset-4">

  <div class="row">
    <div class="col-md-6 col-xs-8">
      <input  placeholder="nomor nota" class="form-control" type="text" name="cari" id="cari" >
    </div>
    <div class="col-md-4 col-xs-4">
      <input name="cuci" class="btn btn-sm btn-danger" type="submit" id="cuci" value="Cari">
    </div>
  </div>
 
  <div id="hasil-cari">
</div>

</body>