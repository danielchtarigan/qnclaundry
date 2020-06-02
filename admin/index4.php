<?php
session_start();
include 'auth.php';
include '../config.php';
function rupiah($angka)
{
	$jadi = "Rp.".number_format($angka,0,',','.');
	return $jadi;
}
date_default_timezone_set('Asia/Makassar');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Halaman Admin</title>
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/plugins/metisMenu/metisMenu.min.css" rel="stylesheet">
    <link href="../css/sb-admin-2.css" rel="stylesheet">
    <link href="../font-awesome-4.1.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">

<!--	<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen"> -->
    <link href="bootstrap/css/bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen">
    
    <script src="js/highcharts.js"></script>
    <script src="js/data.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
</head>
<body>
    <?php require 'nav.php'; ?>
    
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
						else if (isset($_GET['id'])){
                        include "form/customer.php";
						}
						else if (isset($_GET['menu'])){
                         $menu = $_GET['menu'];
						 if ($menu=="retail"){
							 include "include/product.php";
							 }
						 else if ($menu=="footer"){
							 include "include/add-footer.php";
							 }
						 else if ($menu=="add-product"){
							 include "include/add-product.php";
							 }
						 else if ($menu=="promo"){
							 include "include/daftar_promo.php";
							 }
						 else if ($menu=="add_promo"){
							 include "include/promo.php";
							 }
						 else if ($menu=="rupiah"){
							 include "include/daftar_rupiah.php";
							 }
						 else if ($menu=="recovery"){
							 include "include/daftar_recovery.php";
							 }
						 else if ($menu=="add_rupiah"){
							 include "include/rupiah.php";
							 }
						 else if ($menu=="add_recovery"){
							 include "include/recovery.php";
							 }
						 else if ($menu=="penyesuaian"){
					                 include "form/penyesuaian.php";
							 }
						 else if ($menu=="flat"){
							 include "include/daftar_flat.php";
							 }
						 else if ($menu=="add_flat"){
							 include "include/flat.php";
							 }
						 else if ($menu=="sms"){
							 include "include/sms.php";
							 }
							 else if ($menu=="referral") {
								 include "include/referral.php";
							 }
						 else if ($menu=="smsselesai"){
							 include "include/smsselesai.php";
							 }
						 else if ($menu=="quality_audit"){
							 include "include/laporan_quality_audit.php";
							 }
						 else if ($menu=="setoran_bank"){
							 include "include/set_bank.php";
							 }
						 else if ($menu=="referensi"){
							 include "include/laporan_referensi.php";
							 }
                                                 else if ($menu=="log_rcp"){
							 include "include/report_ping.php";
							 }
                                                 else if ($menu=="parkir"){
							 include "include/parkir.php";
							 }
                                                 else if ($menu=="change"){
							 include "act/changestat.php";
							 }
                                                 else if ($menu=="csetrika"){
                                                         include "include/con_setrika.php";
                                                         }
                                                 else if ($menu=="change2"){
                                                         include "act/changestat2.php";
                                                         }
						 else if ($menu=="ticket"){
							 include "include/ticket.php";
							 }
						 else if ($menu=="order_corp"){
							include "cari/order_corporate.php";
							}
							else if ($menu=="pack_corp"){
							include "cari/pack_corporate.php";
							}
							 else if ($menu=="void_edit"){
							include "report_void.php";
							}
							 else if ($menu=="tagihan"){
							include "cari/tagihan.php";
						 	}
						 	 else if ($menu=="prioritycontrol") {
                                include "form/priority.php";
                            }
                              else if ($menu=="updateKerjaOperasional") {
                                include "form/update_operasional.php";
                            }
                             else if ($menu=="cucianTelat") {
                                include "act/denda_cucian_telat.php";
                            }
                            
						}
						else{
?>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Omset Harian</h3>
                </div>
                <div class="panel-body">
                <?php include 'dashboard/omsethari.php' ?>
                <p style="font-size:10px; color:#040106; font-style:oblique; text-align:right">Sumber data: Pembayaran order bukan kuota, membership, dan deposit langganan</p>
                </div>
            </div>
        

        
            <div class="panel panel-default">
                <div class="row">
                    <div class="panel-body">                                                        
                        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                            <?php include 'dashboard/otp.php' ?><hr>  
                            <?php include 'dashboard/audit.php' ?>                      
                        </div>
                        <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12" style="background-color: #e0e5e1">
                            <p style="font-family: cambria; color: #9dceec">10 komentar terakhir</p>
                            <table class="table table-hover"  style="font-size: 9px; font-family: arial">
                                <thead>
                                    <tr>
                                        <th>Customer</th>
                                        <th>Kritik dan saran</th>
                                        <th>Waktu</th>
                                        <th>Jumlah</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <?php 
                                        $qa = mysqli_query($con, "select *from quality_audit order by tgl_input DESC LIMIT 10");
                                        while($hasilqa = mysqli_fetch_array($qa)){?>
                                            <td><?php echo $hasilqa['nama_customer'] ?></td>
                                            <td><?php echo $hasilqa['ket'] ?></td>
                                            <td><?php if($hasilqa['waktu']=='ya' or $hasilqa['waktu']=='Ya' ) echo "OK"; else echo "Telat"; ?></td>
                                            <td><?php if($hasilqa['jumlah']=='ya' or $hasilqa['jumlah']=='Ya') echo "OK"; else echo "Tidak"; ?></td>        
                                    </tr>
                                        <?php
                                        }
                                        ?>      
                                </tbody>
                            </table>
                        </div>
                    </div>                   
                </div>
            </div>

            <div class="row">
                 <div class="col-lg-6 col-md-6">                    
                    <div class="panel panel-default">
                        <div class="panel-heading">
                        <h3 class="panel-title">Top 10 customer 7 hari Terakhir</h3>
                        </div>
                        <div class="panel-body">
                         <?php include 'dashboard/top.php'; ?>
                        </div>
                    </div>

                        <div class="panel panel-default">
                        <div class="panel-heading">
                        <h3 class="panel-title">Voucher dan Promo 7 hari Terakhir</h3>
                        </div>
                        <div class="panel-body">
                           <?php include 'dashboard/voucher.php' ?>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 col-md-6">                    
                    <div class="panel panel-default">
                        <div class="panel-heading">
                        <h3 class="panel-title">Kas Resepsionis</h3>
                        </div>
                            <?php include 'include/kas_recepsionis.php';?>
                    </div>
                </div>               
            </div>
<?php
}
?>
                    </div>
                </div>
            </div>
        </div>
    </div></div>
    <script src="../js/jquery-1.11.0.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/plugins/metisMenu/metisMenu.min.js"></script>
    <script src="../js/sb-admin-2.js"></script>

<script type="text/javascript" src="js/bootstrap-datetimepicker.js" charset="UTF-8"></script>
<script type="text/javascript" src="js/locales/bootstrap-datetimepicker.id.js" charset="UTF-8"></script>

<script type="text/javascript">
 $('.form_date').datetimepicker({
        language:  'id',
        weekStart: 1,
        todayBtn:  1,
  autoclose: 1,
  todayHighlight: 1,
  startView: 2,
  minView: 2,
  forceParse: 0
    });
</script>

</body>
</html>