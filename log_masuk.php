<?php 
include 'config.php';
?>


<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Login QnC Laundry</title>    
    <meta name="viewport" content="width=device-width , initial-scale=1">

    <style type="text/css">
      * {
        padding: 0px;
        margin: 0px;
        font-family: arial;
      }
      body{
        background-color: #f0f0f0;
      }

      #login {
        width: 100%;
        height: 100vh;
        background-image: url("img/");
        background-size: cover;
        background-repeat: no-repeat;
        position: absolute;
      }

      .center {
        width: 350px;
        height: auto;
        margin: 0 auto;
        margin-top: 100px;
        background: white;
        box-shadow: 2px 2px 16px 0px #757575;
        padding: 15px;
      }

      .center h2 {
        font-size: 28px;
        text-align: center;
        color: #757575;
        padding-bottom: 40px;
      }

      .fl {
        width: 100%;
      }

      .itpw {
        width: 92%;
        padding: 13px 10px;
        margin: 5px 0px;
        background-color: #dbdbdb;
        border: 3px solid #dbdbdb;
        color: #757575;
        transition: all 0.7s;
      }
      .itsl {
        width: 99.7%;
        padding: 13px 10px;
        margin: 5px 0px;
        background-color: white;
        border: 3px solid #dbdbdb;
        color: #757575;
        transition: all 0.7s;
      }

      .its {
        width: 99.7%;
        font-size: 19px;
        color: #f5f5f5;
        padding: 12px;
        margin: 5px 0;
        background-color: #92c84a;
        border: none;
        transition: all 0.4s;
      }

      .itpw:focus {
        border-bottom: 3px solid #004d40;
        color: #004d40
      }

      .its:hover , .its:focus {
        opacity: 0.7;
        cursor: pointer;
        background-color: #9af419;
        color: #6d746e;
      }

      .center p {
        margin: 20px 0;
        text-align: center;
        font-size: 14px;
      }

      .center p a {
        color: #757575;
      }

      .hidden{
        display: none;
      }

      @media screen and (min-width:1500px) {

        .center {
          width: 350px;
        }

      }

      @media screen and (max-width:900px) {
        #login {
          background-size: 100% 100%;
        }

        .its {
          width: 97.4%;
        }

        .itpw {
          font-size: 14px;
          width: 90%;
          padding: 13px 3%;
        }

        .itsl {
          width: 96.7%;
        }

        .center{
          width: auto;
          height: auto;
          margin: 0 auto;
          background: white;
          box-shadow: 2px 2px 16px 0px #757575;
          padding: 15px;
          }

        .center p {
          font-size: 12px;
        }

      }
    </style>

    <script type="text/javascript" src="new/assets/js/jquery-2.1.4.min.js"></script>

  </head>
  <body>

    <div id="login"><!-- membuat sebuah div id dengan tujuan sebagai background utama  -->
      <div class="center"><!-- div dengan class center bertujuan untuk membuat posisi tag form yang akan dibuat akan menjadi rata tengah -->

          <div align="center"><img src="logo.png"></div>
          <div id="pesan"></div>

          <?php
          if(isset($_POST['login'])){
            $cabang = $_POST['cabang'];
            $username = $_POST['username'];
            $password = md5($_POST['password']);

            if($cabang=="--Pilih Kota Cabang--"){
              ?>
              <script type="text/javascript">
                alert("Silahkan Pilih Kota Cabang Dahulu!");
                location.href="index2.php";
              </script>
              <?php
            }

            $cekname = mysqli_query($con, "SELECT * FROM user WHERE aktif='Ya' AND name='$username'");
            $cekdata = mysqli_fetch_assoc($cekname);
            if($cekdata!=false && $cekdata['password']==$password){

              if($cabang=="Makassar"){ 
                ?>
                <script type="text/javascript">
                  location.href="login.php";
                </script>
                <?php
              } else{ ?>
                <div class="fl" action="" method="post">
                    <input class="hidden" type="text" name="cabang" id="cabang" value="<?php echo $cabang?>">
                    <input class="hidden" type="text" name="username" id="username" value="<?php echo $username?>">
                    <select class="itsl" type="text" name="outlet" id="outlet">
                      <option>--Pilih Outlet--</option>
                      <?php 
                      
                      $outlets = mysqli_query($con, "SELECT nama_outlet FROM outlet WHERE Kota='$cabang'");
                      $outlet = mysqli_fetch_row($outlets);
                      echo '<option>'.$outlet[0].'</option>';
                      ?>
                    </select>                  
                    <input class="its" type="submit" name="login" id="logine" value="LOGIN">
                  </div>
                  <?php                
              }
            }
            else {
              ?>
              <script type="text/javascript">
                alert("Username dan Password Salah!");
                location.href='index2.php';
              </script>
              <?php
            }

          } else{ ?>
            <form class="fl" action="" method="post">
              <select class="itsl" type="text" name="cabang" id="cabang">
                <option>--Pilih Kota Cabang--</option>
                <?php 
                $cabangs = mysqli_query($con, "SELECT DISTINCT kota FROM outlet");
                while($rcab = mysqli_fetch_assoc($cabangs)) {
                	echo "<option>".$rcab['kota']."</option>";
                }

                ?>
              </select>
              <input class="itpw" type="text" name="username" placeholder="Username or Email"><br>
              <input class="itpw" type="password" name="password" placeholder="Password"><br>
              <input class="its" type="submit" name="login" value="LOGIN">
            </form>
          <?php
          }

          ?>

          
      </div>
    </div>


    <script type="text/javascript">
      $('#logine').click(function(){
        var cabang = $('#cabang').val();
        var username = $('#username').val();
        var outlet = $('#outlet').val();
        if(outlet!="--Pilih Outlet--"){
          $.ajax({
            url     : 'new/session.php',
            type    : 'POST',
            data    : 'cabang='+cabang+'&username='+username+'&outlet='+outlet,
            success : function(){
              window.location.href="new/index.php";
            }
          })
        }
        else{
          alert("Anda belum memilih outlet jaga!");
        }
          
      })
        
    </script>

  </body>
</html>

