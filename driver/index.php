<?php
if(empty($_SERVER['HTTPS']) || $_SERVER['HTTPS'] == "off"){
    $redirect = 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    header('HTTP/1.1 301 Moved Permanently');
    header('Location: ' . $redirect);
    exit();
}
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="css/main6.css">
    <!-- Font-icon css-->
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Login Driver</title>

    <style type="text/css">
      #drop, #welcome, #pesan_logout {
        display: none;
      }

    </style>

    <script src="js/jquery-3.2.1.min.js"></script>
  </head>
  <body>
   
    <section class="material-half-bg">
      <div class="cover"></div>
    </section>
    <section class="login-content">
      <div class="login-box">
        <form class="login-form" action="#" method="POST" id="login">
          <h3 class="login-head"><i class="fa fa-lg fa-fw fa-key"></i>Driver Login</h3>
          <div class="form-group">
            <label class="control-label">Username</label>
            <input class="form-control" type="text" placeholder="Username" autofocus required="" name="username">
            <span></span>
          </div>
          <div class="form-group">
            <label class="control-label">Password</label>
            <input class="form-control" type="password" placeholder="Password" required="" name="password">
          </div>          
          <span id="pesan_error"></span>
          <br>
          <div class="form-group btn-container">
            <button class="btn btn-success btn-block" name="login"><i class="fa fa-sign-in fa-lg fa-fw"></i>Lanjut</button>
          </div>
        </form>   

        <form class="login-form" action="#" method="POST" id="drop">
          <h3 class="login-head"><i class="fa fa-lg fa-fw fa-location-arrow"></i>Lokasi Form</h3>
          <div class="form-group row">
            <div class="animated-radio-button col-lg-6">
              <label class="control-label">
                <input class="form-check-input" type="radio" name="formlokasi" required="" value="workshop" checked=""><span class="label-text">Workshop</span>
              </label>
            </div>
            <div class="animated-radio-button col-lg-6">
              <label class="control-label">
                <input class="form-check-input" type="radio" name="formlokasi" required="" value="outlet"><span class="label-text">Outlet</span>
              </label>
            </div>
          </div>
          <div class="form-group" id="">
            <label class="control-label">Lokasi</label>
            <select class="form-control" name="lokasi">
                <option value="Toddopuli">Toddopuli</option>
                <option value="Daya">Antang</option>
            </select>
          </div>
          <div class="form-group row">
            <div class="animated-radio-button col-lg-6">
              <label class="control-label">
                <input class="form-check-input" type="radio" name="keterangan" required="" value="bersih" checked=""><span class="label-text">Cucian Bersih</span>
              </label>
            </div>
            <div class="animated-radio-button col-lg-6">
              <label class="control-label">
                <input class="form-check-input" type="radio" name="keterangan" required="" value="kotor"><span class="label-text">Cucian Kotor</span>
              </label>
            </div>             
          </div>
          <div class="form-group btn-container">
            <button class="btn btn-success btn-block" name="login"><i class="fa fa-sign-in fa-lg fa-fw"></i>Simpan dan Masuk</button>
          </div>
        </form> 

        <form class="login-form" action="javascript:" method="POST" id="welcome" onmousemove="stopInt()">
          <h3 class="login-head"><i class="fa fa-lg fa-fw fa-home"></i>Selamat datang</h3>
          <p id="name" style="text-align: center; font-weight: bolder"></p>
          <div class="form-group">
            <p id="pesan"></p>
          </div>
          <div class="form-group btn-container" style="margin-top: 58px" id="logout-tombol">
            <button class="btn btn-success btn-block" name="logout">Log Out <i class="fa fa-sign-out fa-lg fa-fw"></i></button>
          </div>
          <div class="form-group btn-container" style="margin-top: 78px; display: none" id="kembali-tombol">
            <button class="btn btn-success btn-block" name="" id="btnKembali">Kembali</button>
          </div>
        </form>   
         <form class="login-form" action="#" method="POST" id="pesan_logout">         
        </form>            
      </div>
    </section>



    <script type="text/javascript">
      jQuery(function($){

        function return_page(){
          location.href = "";
        }
        
        $('#login').on('submit', function(e){
          e.preventDefault();
          var nama = $('input[name=username]').val();
          var password = $('input[name=password]').val();
          var login = "login";
          $.ajax({
            url     : 'process_login.php',
            data    : {nama:nama, password:password, login:login},
            method  : 'POST',
            success : function(data){
              if(data==1) {
                $('#login').css('display', 'none');
                $('#drop').slideToggle(100);
              } else {
                $('#pesan_error').html(data).css('color', 'red');
                setInterval(function(){return_page()},1000);
              }
            }
          })

        });

        function lokasi(){

          var lokasi = $('input[name=formlokasi]:checked').val();   
          if(lokasi=="outlet") {
            $('input[value=bersih]').removeAttr('checked');
            $('input[value=kotor]').prop('checked', 'checked');
          } else {
            $('input[value=kotor]').removeAttr('checked');
            $('input[value=bersih]').prop('checked', 'checked');
          }    

          $.ajax({
            url     : 'pilih_lokasi.php',
            data    : {lokasi : lokasi},
            method  : 'POST',
            success : function(data){
               $('select[name=lokasi]').html(data);
            }
          })                   
          
        }

        $('input[name=formlokasi]').click(function(){
          lokasi();
        });


        $('#drop').on('submit', function(e){
          e.preventDefault();
          $('#login, #drop').css('display', 'none');

          var nama = $('input[name=username]').val();
          var lokasiform = $('input[name=formlokasi]:checked').val();
          var lokasi = $('select[name=lokasi]').val();
          var keterangan = $('input[name=keterangan]:checked').val();

          $.ajax({
            url     : 'process_login.php',
            data    : {lokasiform:lokasiform, lokasi:lokasi, keterangan:keterangan, nama:nama},
            method  : 'POST',
            success : function(data){       
              $('#pesan').append("<span>Anda telah mengaktifkan from driver di komputer "+lokasiform+" "+lokasi+"</span><br><span style='color:red'>Status komputer "+lokasiform+" "+lokasi+" disabled</span>").css('text-align','center').css('font-weight', 'bolder');
              $('#welcome').slideToggle(100);
              $('p[id=name]').text(nama);
            }
          })

              

        })
        

      });

    </script>


    <script type="text/javascript">
      
      function stopInt() {
        var driver = $('p[id=name]').text();
        var lokasiform = $('input[name=formlokasi]:checked').val();
        var lokasi = $('select[name=lokasi]').val();
        $.ajax({
          url     : 'aktifkan_driver.php',
          data    : {driver:driver},
          success : function(data) {
            if(data==1){
              $('#pesan').html("Anda telah terlogout dari komputer "+lokasiform+" "+lokasi).css('color', 'red').css('font-size', '14px');
              $('#logout-tombol').css('display', 'none');
              $('#kembali-tombol').css('display', 'block')
            }      

          }
        })

      }

      $('button[name=logout]').click(function(){
        var driver = $('input[name=username]').val();
        $.ajax({
          url     : 'logout.php',
          data    : {driver:driver},
          method  : 'POST',
          success : function(data){
            if(data==1){
              window.location = "";
            }
          }
        })
      });
      
      $('#btnKembali').click(function(){
           window.location = "";
      })



    </script>


  </body>
</html>