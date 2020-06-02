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

	$pastStartDate = date('Y-m-d', strtotime('-3 months', strtotime($startDate)));
	$pastEndDate = date('Y-m-d', strtotime('-1 months', strtotime($endDate)));
} else{
	$startDate = date('Y').'-'.date('m', strtotime('-1 months', strtotime(date('Y-m-d')))).'-26';
	$endDate   = date('Y').'-'.date('m').'-25';
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>HALAMAN ADMIN</title>
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
    	"order": [[ 3,"asc" ]],
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


<h3 align="center">DAFTAR PENCAPAIAN POIN DAN KPI OPERASIONAL</h3>
<div class="col-md-6 col-md-offset-4">
		<form class="form-inline" method="POST">
		<div class="col-md-4 col-xs-5 col-md-offset-0"><input class="form-control" type="date" name="start" value="<?php echo $startDate ?>"></div>
		<div class="col-md-4 col-xs-5 col-md-offset-0"><input class="form-control" type="date" name="end" value="<?php echo $endDate ?>"></div>
		<div class="col-md-4 col-xs-2 col-xs-offset-0"><input class="btn btn-primary btn-md btn-active" type="submit" name="submit" value="Pilih"></div>
		</form>
</div><br><br><br>

<div class="table-responsive">
				<table class="table table-hover table-border" id="tampilok" style="font-size: 10px">
					<thead>
						<tr>
						    <th rowspan="2">No</th>
							<th rowspan="2">USER ID</th>
							<th rowspan="2">NAMA CREW</th>
							<th rowspan="2">JABATAN</th>
							<th rowspan="2">TARGET</th>
							<th rowspan="2">HARI KERJA</th>
							<th rowspan="2">MASUK MALAM</th>
							<th rowspan="2">POIN MINIMAL</th>
							<th colspan="7">PENCAPAIAN POIN NORMAL</th>
							<th colspan="4">PENCAPAIAN POIN BONUS</th>
							<th rowspan="2">TOTAL PENCAPAIAN POIN</th>
							<th rowspan="2">BONUS OMSET POTONGAN</th>
							<th colspan="2">POIN DENDA OPERASIONAL</th>
							<th rowspan="2">TOTAL DENDA OPERASIONAL</th>
							<th rowspan="2">PENCAPAIAN-DENDA</th>
							<th rowspan="2">RATA-RATA HARIAN</th>
							<th rowspan="2">KEKURANGAN POIN PERBULAN</th>
							<th rowspan="2">TOTAL BONUS RUPIAH</th>
							<th rowspan="2">TOTAL POTONGAN RUPIAH</th>
							<th rowspan="2">GRAND TOTAL RUPIAH</th>
						</tr>
						<tr>
							<th>Cuci Kiloan</th>
							<th>Kering Kiloan</th>
							<th>Cuci Potongan</th>
							<th>Setrika Retail</th>
							<th>Packing Kiloan</th>
							<th>Packing Potongan</th>
							<th>Cuci dan Packing Hotel</th>
							<th>Insentif Malam</th>
							<th>Bagi Brosur</th>
							<th>Express</th>
							<th>Priority</th>				
							<th>Cucian Telat</th>
							<th>Kasus Operasional</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$no = 1;
						$query = mysqli_query($con, "SELECT *FROM kpi_opr WHERE awal='$startDate' AND akhir='$endDate'");
						while($data = mysqli_fetch_array($query)){
							$id = $data['user_id'];
							$user = $data['username'];

								?>
								<tr>
								    <td><?php echo $no++ ?></td>
									<td><?php echo $id; ?></td>
									<td><?php echo $user; ?></td>
									<td><?php echo $data['jabatan']; ?></td>
									<td><?php echo $data['target'] ?></td>
									<td><?php echo $data['hadir']; ?></td>
									<td><?php echo $data['masuk_malam'] ?></td>
									<td><?php echo $data['poin_minimal'] ?></td>
									<td><?php if(array_key_exists('cuci_kiloan', $data)) echo $data['cuci_kiloan']; else echo 0; ?></td>
									<td><?php if(array_key_exists('poin_pengering', $data)) echo $data['poin_pengering']; else echo 0; ?></td>
									<td><?php if(array_key_exists('cuci_potongan', $data)) echo $data['cuci_potongan']; else echo 0; ?></td>
									<td><?php if(array_key_exists('setrika', $data)) echo $data['setrika']; else echo 0; ?></td>
									<td><?php if(array_key_exists('packing_kiloan', $data)) echo $data['packing_kiloan']; else echo 0; ?></td>
									<td><?php if(array_key_exists('packing_potongan', $data)) echo $data['packing_potongan']; else echo 0; ?></td>
									<td>0</td>
									<td><?php if(array_key_exists('insentif_malam', $data)) echo round($data['insentif_malam'],2); else echo 0; ?></td>
									<td><?php if(array_key_exists('bagi_brosur', $data)) echo $data['bagi_brosur']; else echo 0; ?></td>
									<td><?php if(array_key_exists('poin_express', $data)) echo $data['poin_express']; else echo 0; ?></td>
									<td><?php if(array_key_exists('poin_priority', $data)) echo $data['poin_priority']; else echo 0; ?></td>
									<td><?php if(array_key_exists('total_pencapaian_poin', $data)) echo round($data['total_pencapaian_poin'],2); else echo 0; ?></td>
									<td><?php if(array_key_exists('bonus_omset_potongan', $data)) echo rupiah($data['bonus_omset_potongan'],2); else echo 0; ?></td>
									<td><?php if(array_key_exists('cucian_telat', $data)) echo $data['cucian_telat']; else echo 0; ?></td>
									<td><?php if(array_key_exists('kasus_operasional', $data)) echo $data['kasus_operasional']; else echo 0; ?></td>
									<td><?php if(array_key_exists('total_denda_operasional', $data)) echo $data['total_denda_operasional']; else echo 0; ?></td>
									<td><?php if(array_key_exists('pencapaian_akhir', $data)) echo round($data['pencapaian_akhir'],2); else echo 0; ?></td>
									<td><?php if(array_key_exists('rata_harian', $data)) echo round($data['rata_harian'],2); else echo 0; ?></td>
									<td><?php if(array_key_exists('kekurangan_poin_perbulan', $data)) echo $data['kekurangan_poin_perbulan']; else echo 0; ?></td>
									<td><?php if(array_key_exists('total_bonus', $data)) echo rupiah($data['total_bonus']); else echo 0; ?></td>
									<td><?php if(array_key_exists('total_potongan', $data)) echo rupiah($data['total_potongan']); else echo 0; ?></td>
									<td><?php if(array_key_exists('grand_total', $data)) echo rupiah($data['grand_total']); else echo 0; ?></td>
								</tr>

						<?php 
							}
					
						?>			
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