<?php
session_start();
include '../config.php';
include '../auth.php';
// include '../cek_session.php';
if ($_SESSION['nama_outlet']!='Toddopuli') {
	include '../pop.php';
}
date_default_timezone_set('Asia/Makassar');
$ot = $_SESSION['nama_outlet'];
$tgl = date('Y-m-d');
?>
<script src="js/bootstrap.js"></script>
	    <script src="js/jquery.js"></script>
	    <style>
		.datepicker{z-index:1151;}
	    </style>
	    <script>
		$(function(){
		    $("#tanggal1").datepicker({
			format:'yyyy/mm/dd'
		    });
                });

		$(function(){
		    $("#tanggal2").datepicker({
			format:'yyyy/mm/dd'
		    });
                });

		$(function(){
		    $("#tanggal3").datepicker({
			format:'yyyy/mm/dd'
		    });
                });

		$(function(){
		    $("#tanggal4").datepicker({
			format:'yyyy/mm/dd'
		    });
                });

	    </script>

<script type="text/javascript">
	
	$(function(){

		function cetak(){
			window.open("pendapatan_harian_shift.php","", "width=800,height=800");
		};

		$('#tutupShift').on('click', function(){
			cetak();
		})	
	})

</script>

<?php
//$quang = mysqli_query($con, "select * from bukakasir where outlet='$ot' and tgl='$tgl'");
//$nuang = mysqli_num_rows($quang);
/*
if ($nuang<1){
?>

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/sb-admin-2.css" rel="stylesheet">
    <link href="font-awesome-4.1.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                <div align="center">
                <br>
Selamat datang di Halaman Resepsionis. <br>
<marquee>Halaman ini wajib diisi ketika recepsionis membuka halaman QnC pertama kali tiap harinya.</marquee>               </div>

                    <div class="panel-body">
                    Selamat datang <?php echo $_SESSION['level']?>, <?php echo $_SESSION['user_id']."(".$_SESSION['id'].") Outlet : ".$_SESSION['nama_outlet']."jumlah".$nuang.$tgl; ?>

                        <form role="form" action="act/saveuang.php" method="GET">
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Masukkan Jumlah Uang Kecil" name="uang" type="text" autofocus required>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Masukkan Meteran Listrik" name="meteran" type="text" required>
                                </div>
                                <input type="submit" class="btn btn-lg btn-success btn-block" value="Simpan">

                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>



<?php
}
else{
*/

function rupiah($angka)
{
	$jadi = "Rp.".number_format($angka,0,',','.');
	return $jadi;
}
date_default_timezone_set('Asia/Makassar');
?>
<!DOCTYPE html>
<html lang="en">

<?php
if ($_SESSION['nama_outlet']=='' OR $_SESSION['level']!='reception' AND $_SESSION['level']!='admin')
{
	header('location:../index.php');
}
else
{
include 'manifest_driver.php';
	?>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>QnC Aplication</title>
    <link rel="icon" href="../Logo 2017.png">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/plugins/metisMenu/metisMenu.min.css" rel="stylesheet">
    <link href="css/sb-admin-2.css" rel="stylesheet">
    <link href="font-awesome-4.1.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="css/datepicker.css">
		<link rel="stylesheet" href="../admin/css/select2.min.css" />

</head>
<body>
    <div id="wrapper">
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0; background-color:#6C0; position: fixed; width : 100%; margin-top: -2px">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="http://www.qnclaundry.com/" style="color:#FFF;">Welcome to QnC Aplication</a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
                <li>
					<a href="index.php"><i class="fa fa-bar-chart-o fa-fw"></i> Home</a>
                </li>
                <li>
					<a href="index.php?menu=customer"><i class="fa fa-table fa-fw"></i> Data Customer</a>
                </li>
				<li>
                            <a href="terlambat.php"><i class="fa fa-bar-chart-o fa-fw"></i> Data Terlambat</a>
                </li>
                <li>
                    <a data-toggle="dropdown" href="#"><i class="fa fa-edit fa-fw"></i>Form</a>
                    <ul class="dropdown-menu dropdown-user">
					<li><a href="index.php?menu=voucher">Voucher Rupiah</a></li>
					<li><a href="index.php?menu=recovery">Voucher Recovery</a></li>
					<li><a href="belum_spk.php">SPK</a></li>
					<li><a href="index.php?menu=pengeluaran">Pengeluaran</a></li>
				    <?php
				    if($_SESSION['nama_outlet']=="Toddopuli" || $_SESSION['nama_outlet']=="support" || $_SESSION['nama_outlet']=="Antang") { echo '<li><a href="dari_workshop.php">Workshop</a></li>'; }
				    ?>
                    
					<!--<li><a href="cari_ambil.php">Pengambilan</a></li>-->
					<li><a href="cari_ambil.php">Pengambilan</a></li>
					<li><a href="index.php?menu=pembatalan">Pembatalan Transaksi</a></li>
					<li><a href="f_so.php">Stok Opname</a></li>
					<li><a href="cari_complain.php">Komplain</a></li>
					<!--<li><a href="index.php?menu=complain">Komplain</a></li>-->
					<li><a href="#" id="tutupShift">Tutup Kasir</a></li>
					<li><a href="index.php?menu=setoran_bank">Setoran Bank</a></li>
<!--					<li><a href="f_setoran_bank.php">Setoran Bank</a></li>
-->
					<li><a href="index.php?menu=audit">Quality Audit</a></li>
					<li><a href="index.php?menu=setoran delivery">Setoran Delivery</a></li>
					<!--
					<li><a href="c_quality_audit.php">Quality Audit</a></li>
					-->
					<li><a href="cetak_label_box.php">Cetak Label box</a></li>
					<!--<li><a href="index.php?menu=log_delivery">Log Delivery</a></li>-->
					<?php
					if($_SESSION['nama_outlet']=="support"){
					    echo '<li><a href="?menu=SMS-Blast">SMS Blast</a></li>';
					} 
					?>
					 </ul>
					
                    <!-- /.dropdown-user -->
                </li>
     <!--           <li>-->
     <!--               <a data-toggle="dropdown" href="#"><i class="fa fa-edit fa-fw"></i>Manifest</a>-->
     <!--               <ul class="dropdown-menu dropdown-user">-->
					<!--<li><a href="index.php?menu=dmserah">Manifest Serah WorkShop</a></li>-->
					<!--<li><a href="index.php?menu=mterima">Manifest Terima Outlet</a></li>-->
     <!--               </ul>-->
                    <!-- /.dropdown-user -->
     <!--           </li>-->
                <li>
                    <a href="?menu=lacak"><i class="fa fa-edit fa-fw"></i>Lacak Order</a>
                </li>
                <li>
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="fa fa-files-o fa-fw"></i>Laporan</a>
                    <ul class="dropdown-menu dropdown-user">
                    <li><a href="index.php?menu=daftarharga">Daftar Harga</a></li>
                    <?php 
                    if($_SESSION['user_id']=="arul" or $_SESSION['user_id']=="arni") {
                    	echo '<li><a href="index.php?menu=customer type c">Customer Type C</a></li>';
                    }
                    ?>
	                    
                    <li><a href="data_delivery.php">Data Delivery</a></li>
        			<li><a href="absen_rcp.php">Data Absen Resepsionis</a></li>
					<li><a href="lap_riject.php">Reject</a></li>
					<li><a href="d_lgn.php">Langganan</a></li>
					<li><a href="d_member.php">Member</a></li>
                    <li><a href="cari_lap_so.php">Stok Opname</a></li>
                    <li><a href="barhil.php">Barhil</a></li>
					<li><a href="cari_rincian.php">Cari Data</a></li>
                    <li><a href="cari_view_outlet.php">Cari</a></li>
					<li><a href="cari_view_all.php">Cari semua outlet</a></li>
					<li><a href="daftar_komplain.php">Data Komplain</a></li>
					<li><a href="cari_daftar_ambil.php">Data Pengambilan</a></li>
					<li><a href="daftar_qa.php">Data Quality Audit</a></li>
					<li><a href="cari_lap_spk.php">cari Data spk</a></li>
					<li><a href="cari_lap_order.php">Lap Order</a></li>					
					<li><a href="lap_setoran_bank.php">Lap setoran bank</a></li>
					<li><a href="sms_so.php">data SO</a></li>
					<li><a href="cari_lap_tutup_kasir.php">Lap Tutup Kasir</a></li>
					<li><a href="lap_piutang.php">Lap Piutang</a></li>
					<li><a href="cari_lap_cs.php">Customer baru</a></li>
					<li><a href="cari_tidak_tk.php">Tidak Tutup Kasir</a></li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
                <li>
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="fa fa-files-o fa-fw"></i>Account
                    <ul class="dropdown-menu dropdown-user">
                    <li><a href="#"><i class="fa fa-user fa-fw"></i> <?php echo $_SESSION['user_id'] ?></a></li>
					<li><a href="index.php?act=<?php echo md5('setpasswd'); ?>"><i class="fa fa-user fa-fw"></i> Change Password</a></li>
                    <li><a href="../logout.php"><i class="fa fa-user fa-fw"></i> Logout</a></li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
			</ul>
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li>
                        <?php
						include "headnews.html";
						?>
						</li>
				    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>

        <div id="page-wrapper">
            <br><br><br>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">

                        <div class="panel-body"> 
                        <?php
						if (isset($_GET['act'])){
						 $act = $_GET['act'];
						 if ($act==md5('setpasswd')){
							 include '../setpasswd.php';
							 }
						}
						// else if (isset($_GET['id'])){
                        //  include "form/customer.php";
						// }
						else if (isset($_GET['id'])){
							include "form/bs_sales.php";
						   }
						else if (isset($_GET['sms'])){
							$sms = $_GET['sms'];
							if ($sms=='selesai'){
 	 	                       include "include/sms-selesai.php";
								}
						}
						else if (isset($_GET['form'])){
							$form = $_GET['form'];
							if ($form=="customer"){
								include "form/add-customer.php";
								}
						}
						else if (isset($_GET['menu'])){
							$menu = $_GET['menu'];
							if ($menu=="customer"){
					                        include "include/customer.php";
								}
							if ($menu=="ticket"){
					                        include "include/ticket.php";
								}
							if ($menu=="add_ticket"){
					                        include "form/ticket.php";
								}
							if ($menu=="voucher"){
		                        			include "form/voucher.php";
								}
							if ($menu=="recovery"){
		                        			include "form/recovery.php";
								}
							if ($menu=="log_delivery"){
		                        			include "form/log_delivery.php";
								}
							if ($menu=="pulang_delivery"){
		                        			include "form/pulang_delivery.php";
								}
							if ($menu=="complain"){
								include "include/complain.php";
								}
							if ($menu=="pengeluaran"){
					                        include "include/pengeluaran.php";
								}
							if ($menu=="tutupkasir"){
								include "include/tutupkasir.php";
								}
                                                        if ($menu=="mserah"){
								include "include/mserah.php";
								}
							if ($menu=="dmserah"){
								include "include/d_mserah.php";
								}
							if ($menu=="mterima"){
								include "include/mterima.php";
								}
							if ($menu=="am"){
								include "act/act_manifest.php";
                                                                }
							if ($menu=="setoran_bank"){
								include "include/setoran_bank.php";
								}
                                                        if ($menu=="void"){
								include "form/void.php";
								}
							if ($menu=="edit"){
								include "form/edit.php";
								}
							if ($menu=="tutup_kasir"){
								include "form/tutup_kasir.php";
								}
							if ($menu=="tutup_kasir_lanjut"){
								include "form/tutup_kasir_lanjut.php";
								}
                                                        if ($menu=="kas_rcp"){
								include "history_kas.php";
								}
							if ($menu=="audit"){
								?>
								<div id="q_audit">
								 <?php
									include "include/audit.php";
								 ?>
								</div>
								<script>
									var auto_refresh = setInterval(
									function () {
									$("#q_audit").load("include/audit2.php").fadeIn("slow");
									}, 60000); // refresh setiap 10 milliseconds
								</script>
								<?php
								}
							if ($menu=="audit_mojokerto"){
								?>
								<div id="q_audit2">
								 <?php
									include "include/audit_mojokerto.php";
								 ?>
								</div>
								<script>
									var auto_refresh = setInterval(
									function () {
									$("#q_audit2").load("include/audit_mojokerto.php").fadeIn("slow");
									}, 60000); // refresh setiap 10 milliseconds
								</script>
								<?php
								}
							if ($menu=="audithariini"){
								?>
								<div id="quality_audit">
								 <?php
								  include "include/audithariini.php";
								 ?>
								</div>
								<script>
									var auto_refresh = setInterval(
									function () {
									$("#quality_audit").load("include/audithariini2.php").fadeIn("slow");
									}, 10); // refresh setiap 10 milliseconds
								</script>
								<?php
								}
							if ($menu=="qualityaudit"){
								include "f_quality_audit_new.php";
								}
							if ($menu=="daftarharga"){
								include "include/daftar_harga.php";
								}
							if ($menu=="pembatalan"){
								include "form_pembatalan.php";
								}
							if ($menu=="customer type c"){
								include "../customer_c.php";
								}
							if ($menu=="customer khusus"){
								include "customer_khusus.php";
								}
							if ($menu=="setoran delivery"){
								include "include/setoran_delivery.php";
								}
							if ($menu=="lacak"){
								include "form/lacak_order.php";
								}
							if($menu=="info_1"){
							    include "info_1.php";
							}
							if ($menu=="SMS-Blast"){
							    include "include/control_sms_p.php";
							}

						}
						else if (isset($_GET['key'])){
							$key = $_GET['key'];
		                        include "include/customer.php";
						}
						else if (isset($_GET['id1'])){
							$key = $_GET['id1'];
		                        include "form/reg_mahasiswa.php";
						}
						else{
	                        include "include/dashboard.php";
							}
						?>
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

<script type="text/javascript" src="../md5.js"></script>

<script type="text/javascript">
$("#pop100").click(function()
{
key100=$("#key100").val();
code100=$("#code100").val();
key = md5("QnC"+key100+"QnC");
	if (code100==key){
			$.ajax(
				{
					url:"../pop_act.php",
					data:"status=hadir",
					cache:false,
					success:function(msg)
					{
					}
				})
	  history.back();
	}
	else{
	alert("Respon code tidak sesuai!!");
		}
	})
</script>





    <!-- jQuery Version 1.11.0 -->
    <script src="../js/jquery-1.11.0.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../js/plugins/metisMenu/metisMenu.min.js"></script>


    <!-- Custom Theme JavaScript -->
    <script src="../js/sb-admin-2.js"></script>
    <script type="text/javascript" src="../admin/js/select2.min.js"></script>


</body>

</html>
<?php
}
//}
?>

<script src="js/bootstrap-modal.js"></script>
<script src="js/bootstrap-transition.js"></script>	
<script src="js/bootstrap-datepicker.js"></script>