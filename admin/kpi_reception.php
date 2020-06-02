<?php 
session_start();
include 'auth.php';
include '../config.php';


function rupiah($angka)
{
	$jadi = "Rp. ".number_format($angka,0,',','.');
	return $jadi;
}

date_default_timezone_set('Asia/Makassar');		

if(isset($_POST['submit'])){
	$startDate = $_POST['start'];
	$endDate   = $_POST['end'];
	
} else{
	$startDate = date('Y').'-'.date('m', strtotime('-1 months', strtotime(date('Y-m-d')))).'-26';
	$endDate   = date('Y').'-'.date('m').'-25';
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>KPI RECEPTIONIST</title>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

	<link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/plugins/metisMenu/metisMenu.min.css" rel="stylesheet">
    <link href="../css/sb-admin-2.css" rel="stylesheet">
    <link href="../font-awesome-4.1.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">   
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css">    
 

	<script src = "../lib/js/jquery-2.1.3.min.js"></script>

	<script type="text/javascript">
	$(document).ready(function() {
    var table = $('#tampilok').DataTable( {
    	"order": [[ 1,"asc" ]],
    	"bAutoWidth": false,
				"bJQueryUI" : true,
				"sPaginationType" : "full_numbers",
				"iDisplayLength": 10,"aLengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]],
        lengthChange: true,
        buttons: [ 
        		{
                    extend: 'copy',                       
                    text: '<i class="fa fa-files-o fa-fw"></i> Copy'
                 },
        		{
                    extend: 'excel',                       
                    text: '<i class="fa fa-file-excel-o fa-fw"></i> Excel'
                 },
        		{
                    extend: 'pdfHtml5',
                    orientation: 'landscape',
                    pageSize: 'A2',   
                    text: '<i class="fa fa-file-pdf-o fa-fw"></i> Pdf'
                 }]
		    } );
		 
		    table.buttons().container()
		        .appendTo( '#tampilok_wrapper .col-md-6:eq(0)' );
		} );
	</script>

</head>
<body>


<style type="text/css">
	th{
		text-align: center;
	}
</style>
	<div id="wrapper">
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0; background-color:#6C0;">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>			
                <a class="navbar-brand" href="index.php" style="color:#FFF;">Welcome to QnC Aplication</a>
			</div>
            <ul class="nav navbar-top-links navbar-right">
                 <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#" style="font-weight:bold">
                        <i class="fa fa-hand-o-up fa-fw"></i> KPI
                    </a>
                    <ul class="dropdown-menu dropdown-messages">
                        <li><a href="kpi_operasional.php"><i class="fa fa-hand-o-right fa-fw"></i> KPI Operasional</a></li>                       
                        <li><a href="kpi_reception.php"><i class="fa fa-hand-o-right fa-fw"></i> KPI Resepsionis</a></li>                        
                        <li><a href=""><i class="fa fa-hand-o-right fa-fw"></i> KPI Delivery</a></li>
                    </ul>
                </li>
                
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="index.php?act=<?php echo md5('setpasswd'); ?>"><i class="fa fa-user fa-fw"></i> Change Password</a></li>
                        <li><a href="../logout.php"><i class="fa fa-user fa-fw"></i> Logout</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
    </div>


</div>

<h3 align="center">KPI RESEPSIONIS</h3>
  	<div class="col-md-6 col-md-offset-4">
		<form class="form-inline" method="POST">
		<div class="col-md-4 col-xs-5 col-md-offset-0"><input class="form-control" type="date" name="start" value="<?php echo $startDate ?>"></div>
		<div class="col-md-4 col-xs-5 col-md-offset-0"><input class="form-control" type="date" name="end" value="<?php echo $endDate ?>"></div>
		<div class="col-md-4 col-xs-2 col-xs-offset-0"><input class="btn btn-primary btn-md btn-active" type="submit" name="submit" value="Pilih"></div>
		</form>
    </div><br><br>

<div class="table-responsive">
	<table class="table table-striped table-bordered table-hover table-condensed" id="tampilok" style="font-size: 12px">	
		<thead>
			<tr>
				<th rowspan="2">No</th>				
				<th rowspan="2">Nama Reception</th>	
				<th rowspan="2">Tipe</th>		
				<th rowspan="2">Hari Kerja</th>
				<th rowspan="2">Gaji Pokok</th>		
				<th colspan="2">Lembur</th>
				<th colspan="3">Bonus</th>
				<th rowspan="2">Komisi 10% Langganan Baru</th>
				<th rowspan="2">Kenaikan Omset 2 Juta</th>
				<th rowspan="2">Kasus Reject</th>
				<th colspan="3">Denda</th>
				<th colspan="3">Absen atau Izin Sebelum Kerja</th>
				<th rowspan="2">Akumulasi Terlambat Masuk</th>			
				<th rowspan="2">Total_Gaji_Bersih</th>
				<th rowspan="2">Cetak</th>
			</tr>
			<tr>
				<th>Reguler (L)</th>
				<th>12 Jam (L)</th>
				<th>4% SPK</th>
				<th>Membership</th>
				<th>Quality Audit</th>			
				<th>Tidak Menyetor Senin, Rabu, Jumat</th>
				<th>Tidak Tutup Kasir</th>
				<th>Tidak Stok Opname</th>
				<th>Tanpa Keterangan</th>
				<th>Izin < 2 Jam</th>
				<th>Izin > 2 Jam</th>			
			</tr>		
		</thead>
		<tbody>
			<?php

			$no = 1;
			$kpi = mysqli_query($con, "SELECT *FROM kpi_resepsionis WHERE tgl_awal='$startDate' AND tgl_akhir='$endDate' ");
			while($datakpi = mysqli_fetch_array($kpi)){
			?>
			<tr>
				<td align  ="center"><?php echo $no++ ?></td>
				<td><?php echo $datakpi['rcp'] ?></td>
				<td><?php echo $datakpi['tipe_rcp'] ?></td>
				<td><?php echo $datakpi['hari_kerja'] ?></td>
				<td><?php echo $datakpi['gaji_pokok'] ?></td>
				<td><?php echo $datakpi['lembur_reg'] ?></td>
				<td><?php echo $datakpi['lembur_duabelas'] ?></td>
				<td><?php echo $datakpi['bonus_spk'] ?></td>
				<td><?php echo $datakpi['bonus_member'] ?></td>
				<td><?php echo $datakpi['bonus_qa'] ?></td>
				<td><?php echo $datakpi['komisi_lgn'] ?></td>
				<td><?php echo $datakpi['komisi_omset'] ?></td>
				<td><?php echo $datakpi['kasus_reject'] ?></td>
				<td><?php echo $datakpi['tidak_menyetor'] ?></td>
				<td><?php echo $datakpi['tidak_tk'] ?></td>
				<td><?php echo $datakpi['tidak_so'] ?></td>
				<td><?php echo $datakpi['absen'] ?></td>
				<td><?php echo $datakpi['izin_kurang_dua_jam'] ?></td>
				<td><?php echo $datakpi['izin_lebih_dua_jam'] ?></td>
				<td><?php echo $datakpi['akumulasi_terlambat'] ?></td>
				<td align="right"><?php echo rupiah($datakpi['gaji_bersih']) ?></td>	
				<td align="center"><a href="struk/slipgaji.php?user=<?php echo $datakpi['rcp'] ?>&awal=<?php echo $startDate ?>&akhir=<?php echo $endDate; ?>" target="_blank">Slip</a></td>
			</tr>
			<?php } ?>
		</tbody>
	</table>
</div>

	<script src="../js/bootstrap.min.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js" ></script>
	<script type="text/javascript" src="https://cdn.datatables.net/1.10.15/js/dataTables.bootstrap4.min.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.3.1/js/dataTables.buttons.min.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.3.1/js/buttons.bootstrap4.min.js"></script>
	<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
	<script type="text/javascript" src="//cdn.rawgit.com/bpampuch/pdfmake/0.1.27/build/pdfmake.min.js"></script>
	<script type="text/javascript" src="//cdn.rawgit.com/bpampuch/pdfmake/0.1.27/build/vfs_fonts.js"></script>
	<script type="text/javascript" src="//cdn.datatables.net/buttons/1.3.1/js/buttons.html5.min.js"></script>
	<script type="text/javascript" src="//cdn.datatables.net/buttons/1.3.1/js/buttons.colVis.min.js"></script>
</body>
</html>