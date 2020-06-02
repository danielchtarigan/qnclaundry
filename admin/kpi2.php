<?php 
include '../config.php';

date_default_timezone_set('Asia/Makassar');
$startDate = date('2017-04-26');
$endDate = date('2017-05-25');

$endprocDate = date('Y-m-d', strtotime('+6 day', strtotime($endDate))) ;

function rupiah($angka)
{
	$jadi = "Rp. ".number_format($angka,0,',','.');
	return $jadi;
}


?>

<title>KPI OPERASIONAL</title>

<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha.6/css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.15/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.3.1/css/buttons.bootstrap4.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css">

<script type="text/javascript" src="//code.jquery.com/jquery-1.12.4.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js" ></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.15/js/dataTables.bootstrap4.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.3.1/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.3.1/js/buttons.bootstrap4.min.js"></script>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script type="text/javascript" src="//cdn.rawgit.com/bpampuch/pdfmake/0.1.27/build/pdfmake.min.js"></script>
<script type="text/javascript" src="//cdn.rawgit.com/bpampuch/pdfmake/0.1.27/build/vfs_fonts.js"></script>
<script type="text/javascript" src="//cdn.datatables.net/buttons/1.3.1/js/buttons.html5.min.js"></script>
<script type="text/javascript" src="//cdn.datatables.net/buttons/1.3.1/js/buttons.colVis.min.js"></script>

<script type="text/javascript">
	$(document).ready(function() {
    var table = $('#tampilok').DataTable( {
    	"order": [[ 1,"asc" ]],
        lengthChange: false,
        buttons: [ 'copy', 'excel',
        			{
                    extend: 'pdfHtml5',
                    orientation: 'landscape',
                    pageSize: 'A2',

                }]
    } );
 
    table.buttons().container()
        .appendTo( '#tampilok_wrapper .col-md-6:eq(0)' );
} );
</script>

<style type="text/css">
	th{
		text-align: center;
	}
</style>

<h3 align="center">DAFTAR PENCAPAIAN POIN DAN KPI OPERASIONAL</h3>
<h4 align="center">PER <?php echo '<strong>'.$startDate.'</strong> S/D <strong>'.$endDate.'</strong>'; ?></h4>
	


<br><br>
<div class="table-responsive">
<table class="table table-striped table-bordered" id="tampilok" style="font-size: 9px">	
	<thead>
	<tr>		
		<th rowspan="2">Nama Crew</th>
		<th rowspan="2">Jabatan</th>
		<th rowspan="2">Total Hari Kerja</th>
		<th rowspan="2">Masuk Malam</th>
		<th rowspan="2">Hari 12 Jam Kerja</th>
		<th rowspan="2">Target Poin Harian</th>
		<th rowspan="2">Poin Minimal</th>
		<th rowspan="2">Poin Non-Bonus</th>
		<th rowspan="2">Pencapaian Poin</th>
		<th rowspan="2">Bonus/Potongan</th>
		<th rowspan="2">Cuci Kiloan</th>
		<th rowspan="2">Kering Kiloan</th>
		<th rowspan="2">Setrika Retail</th>
		<th rowspan="2">Cuci Potongan</th>
		<th rowspan="2">Cuci dan Packing Hotel</th>	
		<th colspan="2">Packing Retail</th>	
		<th rowspan="2">Insentif Malam</th>		
		<th colspan="2">Bonus</th>
		<th colspan="2">Denda</th>
		<th rowspan="2">Rata-Rata Harian</th>
		<th rowspan="2">Kekurangan Poin Perbulan</th>
		<th rowspan="2">Total Bonus/Potongan</th>
	</tr>
	<tr>					
		<th>Kiloan(Pack)</th>
		<th>Potongan(Pack)</th>
		<th>Keterangan(Bns)</th>
		<th>Jumlah(Bns)</th>
		<th>Keterangan(Dnd)</th>
		<th>Jumlah(Dnd)</th>
	</tr>
	</thead>
	
	<tbody>	

		<?php	
	$user = mysqli_query($con, "SELECT *FROM user WHERE level<>'admin' and level<>'reception' and level<>'delivery' and aktif='Ya'");
	while($datauser = mysqli_fetch_array($user)){	
		if($datauser['level']=='operator' && $datauser['jenis']=='kiloan') $target=65; else if($datauser['level']=='setrika' && $datauser['jenis']=='kiloan') $target=50; else if($datauser['level']=='setrika' && $datauser['jenis']=='potongan') $target=60; else if($datauser['level']=='packer') $target=75;
		$jabatan = $datauser['level'].'&nbsp'.$datauser['jenis'];

		$extraopr = mysqli_query($con, "SELECT *FROM extra_operasional WHERE id_user='$datauser[user_id]'  ");
		$datatambah = mysqli_fetch_array($extraopr);
		
		$hkerjaopr = mysqli_query($con, "SELECT COUNT(*) as harikerja FROM (SELECT DATE_FORMAT(tgl_cuci, '%Y-%m-%d') AS tanggal FROM reception WHERE op_cuci='$datauser[name]' AND (DATE_FORMAT(tgl_cuci, '%Y-%m-%d') BETWEEN '$startDate' AND '$endDate') UNION SELECT DATE_FORMAT(tgl_pengering, '%Y-%m-%d') AS tanggal FROM reception WHERE op_pengering='$datauser[name]' AND (DATE_FORMAT(tgl_pengering, '%Y-%m-%d') BETWEEN '$startDate' AND '$endDate') UNION SELECT DATE_FORMAT(tgl_setrika, '%Y-%m-%d') AS tanggal FROM reception WHERE user_setrika='$datauser[name]' AND (DATE_FORMAT(tgl_setrika, '%Y-%m-%d') BETWEEN '$startDate' AND '$endDate') )T1");
		$datahkerjaopr = mysqli_fetch_array($hkerjaopr);
		if($datahkerjaopr['harikerja']>0){
		?>
	<tr>				
		<td><?php echo $datauser['name'] ?></td>
		<td><?php echo $jabatan ?></td>
		<td><?php echo $datahkerjaopr['harikerja'] ?></td>
		<td style="color: blue;"><?php echo $datatambah['masuk_malam'] ?></td>
		<td style="color: blue;"><?php echo $datatambah['duabelasjam'] ?></td>		
		<td><?php echo $target; ?></td>
		<?php
		$extraopr = mysqli_query($con, "SELECT *FROM extra_operasional WHERE id_user='$datauser[user_id]' ");
		$datatambah = mysqli_fetch_array($extraopr);
		$duabelasjam = $datatambah['duabelasjam'];

		$poinmin = $datahkerjaopr['harikerja']*$target;
		$poinnonbonus = $poinmin+($duabelasjam*$target/2);

		$cucik = mysqli_query($con, "SELECT COUNT(*) as poin FROM reception WHERE op_cuci='$datauser[name]' AND jenis='k' AND (DATE_FORMAT(tgl_cuci, '%Y-%m-%d') BETWEEN '$startDate' AND '$endDate')");
		$rsltcucik = mysqli_fetch_array($cucik);

		$cucip = mysqli_query($con, "SELECT SUM(jumlah) as poin FROM reception WHERE op_cuci='$datauser[name]' AND jenis='p' AND (DATE_FORMAT(tgl_cuci, '%Y-%m-%d') BETWEEN '$startDate' AND '$endDate')");
		$rsltcucip = mysqli_fetch_array($cucip);
		if($datauser['level']=='operator' && $datauser['jenis']=='kiloan'){
			$cucikiloan = $rsltcucik['poin']/2; 
			$cucipotongan = $rsltcucip['poin']/2;
		}  
		else{
			$cucikiloan = 0; 
			$cucipotongan = 0;
		}

		$keringk = mysqli_query($con, "SELECT COUNT(*) as poin FROM reception WHERE op_pengering='$datauser[name]' AND jenis='k' AND (DATE_FORMAT(tgl_pengering, '%Y-%m-%d') BETWEEN '$startDate' AND '$endDate')");
		$rsltkeringk = mysqli_fetch_array($keringk);		
		if($datauser['level']=='operator' && $datauser['jenis']=='kiloan') $keringkiloan = $rsltcucik['poin']/2; else $keringkiloan = 0;

		$setrikak = mysqli_query($con, "SELECT SUM(berat) as poin FROM reception WHERE user_setrika='$datauser[name]' AND (DATE_FORMAT(tgl_setrika, '%Y-%m-%d') BETWEEN '$startDate' AND '$endDate') AND jenis='k' ");
		$rsltsetrikak = mysqli_fetch_array($setrikak);		

		$setrikap = mysqli_query($con, "SELECT SUM(b.jumlah) as poin FROM reception AS a INNER JOIN detail_penjualan AS b ON a.no_nota=b.no_nota WHERE a.user_setrika='$datauser[name]' AND (DATE_FORMAT(a.tgl_setrika, '%Y-%m-%d') BETWEEN '$startDate' AND '$endDate') AND a.jenis='p' AND item not like 'Gordyn%' ");
		$rsltsetrikap = mysqli_fetch_array($setrikap);

		$setrikapgr = mysqli_query($con, "SELECT SUM(b.jumlah) as poin FROM reception AS a INNER JOIN detail_penjualan AS b ON a.no_nota=b.no_nota WHERE a.user_setrika='$datauser[name]' AND (DATE_FORMAT(a.tgl_setrika, '%Y-%m-%d') BETWEEN '$startDate' AND '$endDate') AND a.jenis='p' AND item like 'Gordyn%' ");
		$rsltsetrikapgr = mysqli_fetch_array($setrikapgr);
		if($datauser['level']=='setrika' && $datauser['jenis']=='kiloan') $psetrika = $rsltkeringk['poin']/2; else if($datauser['level']=='setrika' && $datauser['jenis']=='potongan') $psetrika = $rsltsetrikap['poin']/2+$rsltsetrikapgr['poin']; else $psetrika = 0;	

		$packingk = mysqli_query($con, "SELECT COUNT(*) as poin FROM reception WHERE user_packing='$datauser[name]' AND jenis='k' AND (DATE_FORMAT(tgl_packing, '%Y-%m-%d') BETWEEN '$startDate' AND '$endDate')");
		$rsltpackingk = mysqli_fetch_array($packingk);

		$packingp = mysqli_query($con, "SELECT SUM(jumlah) as poin FROM reception WHERE user_packing='$datauser[name]' AND jenis='p' AND (DATE_FORMAT(tgl_packing, '%Y-%m-%d') BETWEEN '$startDate' AND '$endDate')");
		$rsltpackingp = mysqli_fetch_array($packingp);		
			$packingkiloan = $rsltpackingk['poin'];
			$packingpotongan = $rsltpackingp['poin']/2;

			$poinhotel=0;
		
		$insentifmalam = number_format(($cucikiloan+$keringkiloan+$psetrika+$cucipotongan+$poinhotel+$packingkiloan+$packingkiloan+$packingpotongan)/($datahkerjaopr['harikerja']/2)*$datatambah['masuk_malam'],2);

		$cuciexp = mysqli_query($con, "SELECT COUNT(*) as bonus, op_cuci FROM reception WHERE op_cuci='$datauser[name]' AND express='1' AND jenis='k' AND (DATE_FORMAT(tgl_cuci, '%Y-%m-%d') BETWEEN '$startDate' AND '$endDate') ");
			$rsltcuciexp = mysqli_fetch_array($cuciexp);

		$cuciprio= mysqli_query($con, "SELECT COUNT(*) as bonus, op_cuci FROM reception WHERE op_cuci='$datauser[name]' AND priority='1' AND express='0' AND jenis='k' AND (DATE_FORMAT(tgl_cuci, '%Y-%m-%d') BETWEEN '$startDate' AND '$endDate') ");
			$rsltcuciprio = mysqli_fetch_array($cuciprio);

		$setrikaexp = mysqli_query($con, "SELECT COUNT(*) as bonus, user_setrika FROM reception WHERE user_setrika='$datauser[name]' AND express='1' AND (DATE_FORMAT(tgl_setrika, '%Y-%m-%d') BETWEEN '$startDate' AND '$endDate') ");
			$rsltsetrikaexp = mysqli_fetch_array($setrikaexp);

		$packingexp = mysqli_query($con, "SELECT COUNT(*) as bonus, user_packing FROM reception WHERE user_packing='$datauser[name]' AND express='1' AND priority='0' AND (DATE_FORMAT(tgl_packing, '%Y-%m-%d') BETWEEN '$startDate' AND '$endDate') ");
			$rsltpackingexp = mysqli_fetch_array($packingexp);
			if($datauser['name']==$rsltcuciexp['op_cuci'] || $datauser['name']==$rsltcuciprio['op_cuci']){
				$bonusop = $rsltcuciexp['bonus']+$rsltcuciprio['bonus']/2;
				$ketbonus = "Express & Priority";
			}else if($datauser['name']==$rsltsetrikaexp['user_setrika']){
				$bonusop = $rsltsetrikaexp['bonus'];
				$ketbonus = "Express";
			}else if($datauser['name']==$rsltpackingexp['user_packing']){
				$bonusop = $rsltpackingexp['bonus'];
				$ketbonus = "Express";
			}else{
				$bonusop = 0;
				$ketbonus = "--";
			}
			$denda=0;
			$pencapaian = ($cucikiloan+$keringkiloan+$psetrika+$cucipotongan+$poinhotel+$packingkiloan+$packingpotongan+$insentifmalam+$bonusop-$denda);
			$rataharian = number_format(($pencapaian/$datahkerjaopr['harikerja']),2);
			$kekuranganpoinperbulan = ($rataharian-$target)*$datahkerjaopr['harikerja'];

			$pstandar_op = 1100;
			$pbonus_op = 1800;
			$pstandar_st = 800;
			$pbonus_st = 800;
			$pstandar_pc = 950;
			$pbonus_pc = 1500;		

			if($datauser['level']=='operator'){
				if($pencapaian<=$poinmin || $pencapaian<$poinnonbonus) $bonuspot = (($datahkerjaopr['harikerja']*$target)-$pencapaian)*$pstandar_op; else $bonuspot = ($poinnonbonus-$poinmin)*$pstandar_op+($pencapaian-$poinnonbonus)*$pstandar_op;
			}else if($datauser['level']=='packer'){
				if($pencapaian<=$poinmin || $pencapaian<$poinnonbonus) $bonuspot = (($datahkerjaopr['harikerja']*$target)-$pencapaian)*$pstandar_pc; else $bonuspot = ($poinnonbonus-$poinmin)*$pstandar_pc+($pencapaian-$poinnonbonus)*$pstandar_pc;
			}else if($datauser['level']=='setrika'){
				if($pencapaian<=$poinmin || $pencapaian<$poinnonbonus) $bonuspot = (($datahkerjaopr['harikerja']*$target)-$pencapaian)*$pstandar_st; else $bonuspot = ($poinnonbonus-$poinmin)*$pstandar_st+($pencapaian-$poinnonbonus)*$$pstandar_st;
			}	
		?>		

			
		<td><?php echo $poinmin; ?></td>
		<td><?php echo $poinnonbonus; ?></td>
		<td><?php echo $pencapaian ?></td>
		<td><?php echo $bonuspot ?></td>		
		<td><?php echo $cucikiloan ?></td>
		<td><?php echo $keringkiloan ?></td>
		<td><?php echo $psetrika ?></td>
		<td><?php echo $cucipotongan ?></td>
		<td><?php echo $poinhotel ?></td>
		<td><?php echo $packingkiloan ?></td>
		<td><?php echo $packingpotongan ?></td>
		<td><?php echo $insentifmalam ?></td>		
		<td><?php echo $ketbonus ?></td>
		<td><?php echo $bonusop; ?></td>
		<td>--</td>
		<td><?php echo $denda; ?></td>
		<td><?php echo $rataharian; ?></td>
		<td><?php echo $kekuranganpoinperbulan; ?></td>
		<td><?php echo rupiah($bonuspot) ?></td>
	
	</tr>
	<?php } }

	// $usercorp = mysqli_query($con, "SELECT * FROM user_corp ");
	// while($datauscorp = mysqli_fetch_array($usercorp)){


	// }



	?>

	</tbody>
</table>
</div>
</div>

