<?php 
session_start();

if($_SESSION['level']!="admin2"){
  header("location: ../");
}

?>


<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="../css/main.css">
    <!-- Font-icon css-->
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>New Password</title>

    <script src="../js/jquery-3.2.1.min.js"></script>
  </head>
  <body>
    <section class="material-half-bg">
      <div class="cover"></div>
    </section>
    <section class="login-content">
      <div class="login-box">
        <form class="login-form" action="password_login.php" method="POST">
          <h3 class="login-head"><i class="fa fa-lg fa-fw fa-key"></i>Ganti Password</h3>
          <div class="form-group">
            <label class="control-label">Password Lama</label>
            <input class="form-control" type="password" placeholder="Old Password" autofocus required="" name="old_password">
            <span></span>
          </div>
          <div class="form-group">
            <label class="control-label">Password baru</label>
            <input class="form-control" type="password" placeholder="New Password" required="" name="new_password">
          </div>
          <div class="form-group">
            <label class="control-label">Konfirmasi Password baru</label>
            <input class="form-control" type="password" placeholder="New Password" required="" name="konfirmasi_new_password">
            <span></span>            
          </div>
          <br>
          <div class="form-group btn-container">
            <button class="btn btn-success btn-block" name="submit_password"><i class="fa fa-sign-in fa-lg fa-fw"></i>Simpan dan Masuk</button>
          </div>
        </form>
        
      </div>
    </section>



    <script type="text/javascript">
      jQuery(function($){
        
        $("input[name=old_password]").blur(function(){

          oldPassword = $(this).val();
          $.ajax({
            data    : 'passwordPost=cek_password&oldPassword='+oldPassword,
            type    : 'POST',
            url     : 'password_login.php',
            success : function(data){
              if(data==1){
                $('input[name=old_password]').next().text("Password Benar").css('color', 'green').fadeOut(1000);
                // $('input[nama=new_password]).attr('enabled', 'enabled');
              }
              else{
                $('input[name=old_password]').next().text("Password Salah").css('color', 'red');
              }              
              
            }
          })
        });

        $("input[name=konfirmasi_new_password]").blur(function(){

          newPassword = $("input[name=new_password]").val();
          konfirmPassword = $(this).val();

          if(newPassword!=konfirmPassword){
            $('input[name=konfirmasi_new_password]').next().text("Password tidak sesuai!").css('color', 'red');
          }

        })

      });

    </script>


  </body>
</html>