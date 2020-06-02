<?php
include '../config.php';
session_start();
include 'auth.php';

date_default_timezone_set('Asia/Makassar');

function rupiah($angka)
{
	$jadi = "Rp ".number_format($angka,0,',','.');
	return $jadi;
}
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
        <link href="css/style2.css" rel="stylesheet" type="text/css">
    
    	       
        <link rel="stylesheet" type="text/css" href="../lib/css/jquery.dataTables.css" />
        <link rel="stylesheet" type="text/css" href="../lib/css/jquery.dataTables_themeroller.css" />        
        <link rel="stylesheet" type="text/css" href="../lib/css/jquery-ui.css">
        <link rel="stylesheet" type="text/css" href="../lib/css/jquery.dataTables.yadcf.css">
        <link rel="stylesheet" type="text/css" href="css/dataTables.tableTools.css">
        <link rel="stylesheet" type="text/css" href="css/jquery.dataTables.min.css">
    
    	<script src = "../lib/js/jquery-2.1.3.min.js"></script>
        <script src = "../lib/js/bootstrap.min.js"></script>
        <script src="../js/plugins/metisMenu/metisMenu.min.js"></script>
        <script src="../js/sb-admin-2.js"></script>
        
        <script type="text/javascript" language="javascript" src="../lib/js/jquery-ui.js"></script>
        <script type="text/javascript" language="javascript" src="../lib/js/jquery.dataTables.yadcf.js"></script>
        <script type="text/javascript" src="js/jquery.dataTables.min.js"></script>
        <script type="text/javascript" language="javascript" src="js/dataTables.tableTools.js"></script>
	    <script type="text/javascript">
            $(function(){
                $("#tanggal").datepicker({
                    dateFormat:'yy-mm-dd',
                });
                
                $("#tanggal2").datepicker({
                    dateFormat:'yy-mm-dd',
                    maxDate: 0,
                });
            });
        </script>
	
	
	

</head>
<body>
	
	<?php require 'nav.php'; ?>
	<div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-body">
                        <?php
						if (isset($_GET['menu'])){
                         $menu = $_GET['menu'];
						    if ($menu=="QualityAudit") {
						     include "include/report_quality_audit.php";
                            } else if($menu=="Pembayaran"){
                                include "include/laporan_pembayaran.php";
                            } else if($menu=="langganan"){
                                include "include/daftar_langganan.php";
                            } else if($menu=="kas"){
                                include "include/detail_kas_resepsionis.php";
                            } else if($menu=="setoran_bank"){
                                include "set_bank.php";
                            } else if($menu=="cara_bayar_retail"){
                                include "cbayar_ritel.php";
                            } else if($menu=="Delivery"){
                                include "include/laporan_delivery.php";
                            } else if($menu=="Master Table"){
                                include "include/cari_master_table.php";
                            } else if($menu=="Saldo Kas Resepsionis"){
                                include "include/saldo_kas_resepsionis.php";
                            } else if($menu=="Tabel_order"){
                                include "include/tabel_order.php";
                            } else if($menu=="Komplain Customer"){
                                include "include/complain_cs.php";
                            } else if($menu=="Omset Subagen"){
                                include "include/omsetSubAgen.php";
                            } else if($menu=="omset"){
                                include "include/laporan_omset.php";
                            }
						} else if(isset($_GET['form'])){
                            $form = $_GET['form'];
                            if($form=='Setoran'){
                                include "form/setoran.php";                                
                            }
                        } 

                        ?>
					   </div>
				    </div>
				

   	</body>

</html>
