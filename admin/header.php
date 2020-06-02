<?php
date_default_timezone_set('Asia/Makassar');
?>

<!DOCTYPE html>
<html lang="en">
	<head>
<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
 <link rel="icon" href="../favicon.png">

    <title>QnC Laundry</title>

        <link href="../lib/css/bootstrap.min.css" rel="stylesheet" type="text/css">
        <link href="../font-awesome-4.1.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
        <link rel="stylesheet" type="text/css" href="../lib/css/jquery.dataTables.css" />
		<link rel="stylesheet" type="text/css" href="../lib/css/jquery.dataTables_themeroller.css" />
		<link rel="stylesheet" type="text/css" href="../lib/css/jquery.dataTables.css">
		<link rel="stylesheet" type="text/css" href="../lib/css/jquery-ui.css">
		<link rel="stylesheet" type="text/css" href="../lib/css/jquery.dataTables.yadcf.css">
<link rel="stylesheet" type="text/css" href="css/dataTables.tableTools.css">
<link rel="stylesheet" href="css/datepicker.css">

<?php
		session_start();
$user_id= $_SESSION['user_id'];
if (isset($_SESSION['level']))
{
	// jika level admin
	if ($_SESSION['level'] == "admin")
   {

   }
   // jika kondisi level user maka akan diarahkan ke halaman lain
   else if ($_SESSION['level'] == "reception")
   {
       header('location:../reception/index.php');
   }
}
if (!isset($_SESSION['user_id']) and !isset($_SESSION['level']) and !isset($_SESSION['nama_outlet']))
{
	header('location:../index.html');
}
if ($_SESSION['level']!='admin'){
	?>
        <script type="text/javascript">
		 location.href="https://qnclaundry.com";
		</script>
<?php
	}


?>
<script>
					function kirim_form1()
					{

    		     	    $('#pesan_kirim1').html('Loading ...');
			   			$('#pesan_kirim1').slideDown('slow');

	  					  var passbaru=$('#passbaru').val();
	                      var passbaru1=$('#passbaru1').val();
	                      var passlama=$('#passlama').val();


			            if ( passlama == "" ){
						alert("password lama Masih Kosong");
						$("#passlama").focus();
						return false;
						} else if ( passbaru == "" ){
						alert("passport baru Masih Kosong");
						$("#passbaru").focus();
						return false;
						}else if ( passbaru !== passbaru1 ){
						alert("passporttidak sama Masih Kosong");
						$("#passbaru").focus();
						return false;
						}



                        $.ajax({
                        	url:'../gantip.php',
					        type     : 'POST',
					        dataType : 'html',
					        data:'passbaru='+passbaru+'&passlama='+passlama+'&passbaru1='+passbaru1,
                          	success  : function(respons){

                       		 $('#pesan_kirim1').html(respons);
                       		 $('#passbaru').val("");
                        	 $('#passbaru1').val("");
                        	 $('#passlama').val("");

                            }
                        })
                    }

     </script>


	</head>
	<body>
	 <div class="navbar navbar-default navbar-fixed-top" style="background-color: #e075f7;">
            <div class="container">
                <a class="navbar-brand" href="index.php">
                    <!--<img src="../logo.png"/>-->
	            </a>

                <button class = "navbar-toggle" data-toggle = "collapse" data-target = ".navHeaderCollapse">
                    <span class = "icon-bar"></span>
                  <span class = "icon-bar"></span>
                </button>
                <div class="collapse navbar-collapse navHeaderCollapse">
                    <ul class="nav navbar-nav navbar-right" style="font-size: 15pt;color: #ff0000;">
                    <li> <a href="index.php" data-target="#tambah-data"> Home</a></li>
<li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Cek<span class="caret"></span></a>
                  <ul class="dropdown-menu" role="menu">
                    <li><a href="index.php?menu=Data Terlambat">Terlambat</a></li>
<li><a href="cari_rincian.php">Cari Data</a></li>

<li><a href="express.php">Express</a></li>

                  </ul>
                </li>
<li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Halaman<span class="caret"></span></a>
                  <ul class="dropdown-menu" role="menu">
                    <li><a href="../reception/index.php">Reception</a></li>
                    <li><a href="../operator/index.php">Operator</a></li>
<li><a href="../packer/index.php">Pakcer</a></li>
                  </ul>
                </li>
<li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Laporan<span class="caret"></span></a>
                  <ul class="dropdown-menu" role="menu">
<li><a href="laporan_delivery.php">Laporan Delivery</a></li>
<li><a href="cari_lap_cash.php">Laporan Pemasukan</a></li>
<li><a href="cari_lap_omset.php">Laporan Omset/Order</a></li>
<li><a href="lap_otp_operasional_cari.php">Lap OTP</a></li>
<li><a href="lap_spk.php">Lap SPK</a></li>
<li><a href="lap_tutup_kasir.php">Lap Tutup Kasir</a></li>
<li><a href="lap_setoran_bank.php">Lap Setoran Bank</a></li>
<li><a href="lap_piutang.php">Lap Piutang</a></li>
<!--<li><a href="lap_vocer.php">Lap Pemilik Voucher Diskon</a></li>-->
<li><a href="lap_vocer_r.php">Lap Pemilik Voucher Referral</a></li>
<li><a href="lap_vocer_user.php">Lap Pengguna Voucher</a></li>
<!--<li><a href="lap_vocer_r_user.php">Lap Pengguna Voucher Referral</a></li>-->
<li><a href="inventory.php">Inventory</a></li>
<li><a href="d_customer.php">Daftar Customer</a></li>
<li><a href="cari_lap_customer.php">Lap Customer</a></li>
<li><a href="cari_lap_member.php">Member/Lgn</a></li>
<li><a href="header.php?laporan=tutup-kasir-sistem">Tutup Kasir Baru</a></li>
<li><a href="cari_lap_acc.php">Laporan Accounting</a></li>
                  </ul>
                </li>
<li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Edit<span class="caret"></span></a>
                  <ul class="dropdown-menu" role="menu">
 <li><a href="update_hari.php">Update Hari Selesai</a></li>
                     <li><a href="cari_delete_order.php">Hapus Order</a></li>
 <li><a href="user.php">Tambah User</a></li>
 <li><a href="poin_kuota.php">Edit Kuota n Poin</a></li>
 <li><a href="d_piutang.php">Update Lunas</a></li>
 <li><a href="d_faktur_penjualan.php">Edit Pembayaran</a></li>
<li><a href="tutup_kasir.php">Setor Ke bank</a></li>
<li><a href="f_voucher.php">input voucher lucky dip</a></li>
<li><a href="f_voucher_berkala.php">Voucher Berkala</a></li>
<li><a href="index.php?menu=promo">Kode Promo</a></li>
                 </ul>
                </li>


<li> <a data-id='0' data-toggle="modal" href="#" data-target="#tambah-data"> Ubah Password</a></li>
				<li><a href="../logout.php">Log Out</a></li>

                    </ul>
                </div>
            </div>
        </div>
<div  style="width:300px; margin:0 auto; position:relative;">
<b behavior=alternate  width="250"><strong><font size="5px" color="000"> <?php echo "Hai: ".$user_id?></font></strong> </b>
</div>
 <div id="tambah-data" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
		<div class="modal-dialog">

		<div class="modal-content">

<form  action="" method="post" class="form-horizontal"><br>
<h4  align="center"><strong>Ganti Pasword</strong></h4><br>
<div id="pesan_kirim1" style="display:none"></div>
           <div class="form-group"><label for="no_nota" class="control-label col-xs-3">Password Lama</label><div class="col-xs-4">
              <input type="password" placeholder="password lama" id="passlama" name="passlama" class="form-control">
            </div></div>
            <div class="form-group"><label for="no_nota" class="control-label col-xs-3">Password Baru</label><div class="col-xs-4">
              <input type="password" placeholder="password baru" id="passbaru" name="passbaru" class="form-control">
            </div></div>
            <div class="form-group"><label for="no_nota" class="control-label col-xs-3">Ulangi Password Baru</label><div class="col-xs-4">
              <input type="password" placeholder="passbaru" class="form-control" id="passbaru1" name="passbaru1">
            </div></div>


           			<div class="modal-footer">
           			<input type="button" value="Simpan"  onclick="kirim_form1();" class="btn btn-success">

					<button class="btn btn-default" data-dismiss="modal">Tutup</button>		</div>

				</form>
			</div>
		</div>
	</div>
    <style type="text/css">
    #lap {
        width:100%; margin: 0 auto ; position:relative; border:3px solid rgba(0,0,0,0); -webkit-border-radius:5px; -moz-border-radius:5px; border-radius:5px; -webkit-box-shadow:0 0 18px rgba(0,0,0,0.4); -moz-box-shadow:0 0 18px rgba(0,0,0,0.4); box-shadow:0 0 18px rgba(0,0,0,0.4);  margin-bottom:20px; margin-top:36px; color:#000000;
    }
  </style>

    <div class="container-fluid" id="<?= (isset($_GET['laporan'])) ? "lap" : "" ?>">
              <?php 
              if(isset($_GET['aksi'])){
                $aksi = $_GET['aksi'];
                if($aksi=="input_cuci"){
                  include 'act/input_cuci.php';         
                }
                else if($aksi=="input_pengering"){                  
                  include 'act/input_pengering.php';
                }
                else if($aksi=="input_setrika"){
                  include 'act/input_setrika.php';
                }       
              } 

              if(isset($_GET['laporan'])) {
                $lap = $_GET['laporan'];
                if($lap=="tutup-kasir-sistem") {
                  include 'include/lap_tutup_kasir.php';
                }
              }

              ?>
    </div>

   	
<script src = "../lib/js/jquery-2.1.3.min.js"></script>
   <script src = "../lib/js/bootstrap.min.js"></script>
	<script type="text/javascript" language="javascript" src="../lib/js/jquery.dataTables.min.js"></script>
   <script type="text/javascript" language="javascript" src="../lib/js/jquery-ui.js"></script>
<script type="text/javascript" language="javascript" src="../lib/js/jquery.dataTables.yadcf.js"></script>
<script type="text/javascript" language="javascript" src="js/dataTables.tableTools.js"></script>
 <script src="../lib/js/jquery.form.js"></script>
 <script src="js/bootstrap-datepicker.js"></script>
 </body>
 
</html>
