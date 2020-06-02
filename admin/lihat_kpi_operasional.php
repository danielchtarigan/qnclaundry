<?php 
include '../config.php';
include 'header.php';

date_default_timezone_set('Asia/Makassar');
if(isset($_POST['submit'])){
	$startDate = $_POST['start'];
	$endDate   = $_POST['end'];

	$pastStartDate = date('Y-m-d', strtotime('-3 months', strtotime($startDate)));
	$pastEndDate = date('Y-m-d', strtotime('-1 months', strtotime($endDate)));
} else{
	$startDate = date('Y-m', strtotime('-1 months', strtotime(date('Y-m-d')))).'-26';
	$endDate   = date('Y-m').'-25';
}

function rupiah($angka)
{
	$jadi = "Rp. ".number_format($angka,0,',','.');
	return $jadi;
}


?>

<title>KPI OPERASIONAL</title>

<div class="container" style="width:auto; margin:0 auto; position:relative; border:3px solid rgba(0,0,0,0); -webkit-border-radius:5px; -moz-border-radius:5px; border-radius:5px; -webkit-box-shadow:0 0 18px rgba(0,0,0,0.4); -moz-box-shadow:0 0 18px rgba(0,0,0,0.4); box-shadow:0 0 18px rgba(0,0,0,0.4);  margin-top:50px; margin-bottom:50px; color:#000000;">
<script type="text/javascript">
		$(document).ready(function(){
			$('#tampilok').dataTable({
			"order": [[ 1,"asc" ]],
				dom: 'T<"clear">lfrtip',
                tableTools: {
                    "sSwfPath": "swf/copy_csv_xls_pdf.swf",
                    "aButtons": [ 'copy',
                        {
                            'sExtends': 'xls',
                            'sFileName': 'KPI operasional.xls',
                            'sButtonText': 'Simpan Ke Excel'
                            
                        }

                    ]
                },
	                "columnDefs": [
	                    {
	                        "targets": [0],
	                        "visible": true,
	                        "searchable": true,"width":"4px",
	                    },
	                ],
	                "bAutoWidth": false,
					"bJQueryUI" : true,
					"sPaginationType" : "full_numbers",
					"iDisplayLength": 50,"aLengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]],
				});

		});
	</script>



<style type="text/css">
	th{
		text-align: center;
	}
</style>

<fieldset>
<legend align="center" >DAFTAR PENCAPAIAN POIN DAN KPI OPERASIONAL<br>
<h4 align="center"></center><?php echo 'Tanggal '.date("d F Y", strtotime($startDate)).' - '.date("d F Y", strtotime($endDate)); ?></h4></legend>
<?php include 'cari2.php' ?>


<form action="kunci_kpi_opr.php" method="POST">
<button class="btn btn-xs btn-primary btn-active" name="submit">KUNCI KPI</button></a>
<br><br>
<div class="table-responsive">
<table class="table table-bordered table-hover" id="tampilok" style="font-size: 10px">	
	<thead>
	<tr>
		<th rowspan="2">Nama Crew</th>
		<th rowspan="2">Jabatan</th>
		<th rowspan="2">Total Hari Kerja</th>
		<th rowspan="2">Masuk Malam</th>
		<th rowspan="2">Poin Brosur</th>
		<th rowspan="2">Target Poin Harian</th>
		<th rowspan="2">Poin Minimal</th>
		<th rowspan="2">Poin Non-Bonus</th>
		<th rowspan="2">Pencapaian Poin</th>
		<th rowspan="2">Pencapaian Poin Potongan</th>
		<th rowspan="2">Bonus/Potongan</th>
		<th rowspan="2">Cuci Kiloan</th>
		<th rowspan="2">Kering Kiloan</th>
		<th rowspan="2">Setrika Retail</th>
		<th rowspan="2">Cuci Potongan</th>
		<th rowspan="2">Cuci dan Packing Hotel</th>	
		<th colspan="2">Packing Retail</th>	
		<th rowspan="2">Insentif Malam</th>		
		<th colspan="2">Bonus</th>
		<th colspan="2">Bonus KPI Potongan</th>
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
		<th>Keterangan(BnsPot)</th>
		<th>Jumlah(BnsPot)</th>
		<th>Keterangan(Dnd)</th>
		<th>Jumlah(Dnd)</th>
	</tr>
	</thead>
	
	<tbody>

		<?php
				
	
		$i = 1;	
		$user = mysqli_query($con, "SELECT *FROM user WHERE level<>'admin' and level<>'reception' and level<>'delivery' and aktif='Ya'");
		while($datauser = mysqli_fetch_array($user)){
		if($datauser['level']=='setrika' && $datauser['jenis']=='kiloan') $target=50; else if($datauser['level']=='setrika' && $datauser['jenis']=='potongan') $target=60; else if($datauser['level']=='packer') $target=75; else if($datauser['level']=='operator') $target=65;
		$jabatan = $datauser['level'].' '.$datauser['jenis'];
		
		if($datauser['name']=='warnidah'){
		    $target = 0;
		    $jabatan = "Gudang";
		}

		$extraopr = mysqli_query($con, "SELECT *FROM extra_operasional WHERE id_user='$datauser[user_id]'");
		$datatambah = mysqli_fetch_array($extraopr);

		$duabelasjam = $datatambah['duabelasjam'];
		$pbrosur = $datatambah['poin_brosur'];
		
		// $hkerjaopr = mysqli_query($con, "SELECT COUNT(*) as harikerja FROM (SELECT DATE_FORMAT(tgl_cuci, '%Y-%m-%d') AS tanggal FROM reception WHERE op_cuci='$datauser[name]' AND (DATE_FORMAT(tgl_cuci, '%Y-%m-%d') BETWEEN '$startDate' AND '$endDate') UNION SELECT DATE_FORMAT(tgl_pengering, '%Y-%m-%d') AS tanggal FROM reception WHERE op_pengering='$datauser[name]' AND (DATE_FORMAT(tgl_pengering, '%Y-%m-%d') BETWEEN '$startDate' AND '$endDate') UNION SELECT DATE_FORMAT(tgl_setrika, '%Y-%m-%d') AS tanggal FROM reception WHERE user_setrika='$datauser[name]' AND (DATE_FORMAT(tgl_setrika, '%Y-%m-%d') BETWEEN '$startDate' AND '$endDate') )T1");
		// $datahkerjaopr = mysqli_fetch_array($hkerjaopr);

		$kerjareg = $datatambah['hadir'];
	    $id = $i++;
		if	($kerjareg>0 || $datauser['name']=='warnidah'){
		    
		    $jumkerjaopr = mysqli_query($con, "SELECT SUM(hadir) AS kerjaall FROM extra_operasional AS a INNER JOIN user AS b ON a.id_user=b.user_id WHERE b.level='operator' AND b.jenis='potongan' AND b.aktif='Ya'");
    		$datakerjaopr = mysqli_fetch_row($jumkerjaopr);
    		
    		$jumkerjastr = mysqli_query($con, "SELECT SUM(hadir) AS kerjaall FROM extra_operasional AS a INNER JOIN user AS b ON a.id_user=b.user_id WHERE b.level='setrika' AND b.jenis='potongan' AND b.aktif='Ya'");
    		$datakerjastr = mysqli_fetch_row($jumkerjastr);
    	

		?>
		<input class="hidden" type="text" name="id[]" value="<?php echo $id; ?>">
		<input class="hidden" type="text" name="awal[]" value="<?php echo $startDate; ?>">
		<input class="hidden" type="text" name="akhir[]" value="<?php echo $endDate; ?>">
	<tr>
		<td><input class="hidden" type="text" name="nama[]" value="<?php echo $datauser['name'] ?>"><?php echo $datauser['name'] ?></td>
		<td><input class="hidden" type="text" name="jabatan[]" value="<?php echo $jabatan ?>"><?php echo $jabatan ?></td>
		<td style="color: blue;"><input class="hidden" type="text" name="harikerja[]" value="<?php echo $kerjareg ?>"><?php echo $kerjareg ?></td>
		<td style="color: blue;"><input class="hidden" type="text" name="masukmalam[]" value="<?php echo $datatambah['masuk_malam'] ?>"><?php echo $datatambah['masuk_malam'] ?></td>
		<td style="color: blue;"><input class="hidden" type="text" name="pbrosur[]" value="<?php echo $pbrosur ?>"><?php echo $pbrosur ?></td>		
		<td><input class="hidden" type="text" name="target[]" value="<?php echo $target ?>"><?php echo $target; ?></td>
		<?php
		
		if($datauser['level']=='operator' && $datauser['jenis']=='potongan'){
		    $poinmin = 0;
		    $poinnonbonus = 0;
		} else {
		    $poinmin = $kerjareg*$target;
		    $poinnonbonus = $poinmin+($duabelasjam*$target/2);
		}
        
		$cucik = mysqli_query($con, "SELECT COUNT(*) as poin FROM reception WHERE op_cuci='$datauser[name]' AND jenis='k' AND (DATE_FORMAT(tgl_cuci, '%Y-%m-%d') BETWEEN '$startDate' AND '$endDate')");
		$rsltcucik = mysqli_fetch_array($cucik);

		$cucip = mysqli_query($con, "SELECT SUM(jumlah) as poin FROM reception WHERE op_cuci='$datauser[name]' AND jenis='p' AND (DATE_FORMAT(tgl_cuci, '%Y-%m-%d') BETWEEN '$startDate' AND '$endDate')");
		$rsltcucip = mysqli_fetch_array($cucip);

		$omsetpot = mysqli_query($con, "SELECT SUM(total_bayar) AS omset FROM reception WHERE (DATE_FORMAT(tgl_input, '%Y-%m-%d') BETWEEN '$startDate' AND '$endDate') AND jenis='p' AND nama_outlet<>'mojokerto' ");
		$dataomsetp = mysqli_fetch_array($omsetpot);
		$omsetpotongan = $dataomsetp['omset'];  

		$qjumoperator = mysqli_query($con, "SELECT COUNT(DISTINCT a.op_cuci) AS operator FROM reception AS a INNER JOIN user AS b ON a.op_cuci=b.name WHERE (DATE_FORMAT(a.tgl_input, '%Y-%m-%d') BETWEEN '$startDate' AND '$endDate') AND a.jenis='p' AND b.jenis='potongan'");
		$rjumoperator = mysqli_fetch_row($qjumoperator);
		$jumOperator = $rjumoperator[0];

		$qjumsetrika = mysqli_query($con, "SELECT COUNT(DISTINCT a.op_cuci) AS operator FROM reception AS a INNER JOIN user AS b ON a.op_cuci=b.name WHERE (DATE_FORMAT(a.tgl_input, '%Y-%m-%d') BETWEEN '$startDate' AND '$endDate') AND a.jenis='p' AND b.jenis='potongan' AND b.aktif='Ya' ");
		$rjumsetrika = mysqli_fetch_row($qjumsetrika);
		$jumSetrika = $rjumsetrika[0];

		$keringk = mysqli_query($con, "SELECT COUNT(*) as poin FROM reception WHERE op_pengering='$datauser[name]' AND jenis='k' AND (DATE_FORMAT(tgl_pengering, '%Y-%m-%d') BETWEEN '$startDate' AND '$endDate')");
		$rsltkeringk = mysqli_fetch_array($keringk);
		
		if($datauser['level']=='operator' && $datauser['jenis']=='kiloan'){
			$cucikiloan = $rsltcucik['poin']/2;
			$keringkiloan = $rsltkeringk['poin']/2;
			$cucipotongan = $rsltcucip['poin'];
		}  
		else{
			$cucikiloan = 0;
			$keringkiloan = 0;
			$cucipotongan = 0;
		}

		$setrikak = mysqli_query($con, "SELECT SUM(b.berat) as poin FROM reception AS a INNER JOIN detail_penjualan AS b ON a.no_nota=b.no_nota WHERE a.user_setrika='$datauser[name]' AND (DATE_FORMAT(a.tgl_setrika, '%Y-%m-%d') BETWEEN '$startDate' AND '$endDate') AND a.jenis='k' ");
		$rsltsetrikak = mysqli_fetch_array($setrikak);		

		$setrikap = mysqli_query($con, "SELECT SUM(b.jumlah) as poin FROM reception AS a INNER JOIN detail_penjualan AS b ON a.no_nota=b.no_nota WHERE a.user_setrika='$datauser[name]' AND (DATE_FORMAT(a.tgl_setrika, '%Y-%m-%d') BETWEEN '$startDate' AND '$endDate') AND a.jenis='p' AND b.item NOT LIKE 'Gordyn%' AND b.item NOT LIKE 'Voucher%' ");
		$rsltsetrikap = mysqli_fetch_array($setrikap);
    
		$setrikapgr = mysqli_query($con, "SELECT SUM(b.jumlah) as poin FROM reception AS a INNER JOIN detail_penjualan AS b ON a.no_nota=b.no_nota WHERE a.user_setrika='$datauser[name]' AND (DATE_FORMAT(a.tgl_setrika, '%Y-%m-%d') BETWEEN '$startDate' AND '$endDate') AND a.jenis='p' AND b.item LIKE 'Gordyn%'");
		$rsltsetrikapgr = mysqli_fetch_array($setrikapgr);
		$psetrika = $rsltsetrikak['poin']+ $rsltsetrikap['poin']/2+$rsltsetrikapgr['poin'];


		$packingk = mysqli_query($con, "SELECT COUNT(*) as poin FROM reception WHERE user_packing='$datauser[name]' AND jenis='k' AND (DATE_FORMAT(tgl_packing, '%Y-%m-%d') BETWEEN '$startDate' AND '$endDate')");
		$rsltpackingk = mysqli_fetch_array($packingk);

		$packingp = mysqli_query($con, "SELECT SUM(jumlah) as poin FROM reception WHERE user_packing='$datauser[name]' AND jenis='p' AND (DATE_FORMAT(tgl_packing, '%Y-%m-%d') BETWEEN '$startDate' AND '$endDate')");
		$rsltpackingp = mysqli_fetch_array($packingp);
		if($datauser['level']=='packer'){
			$packingkiloan = $rsltpackingk['poin'];
			$packingpotongan = $rsltpackingp['poin']/2;
		} else {
		    $packingkiloan = $rsltpackingk['poin'];
			$packingpotongan = $rsltpackingp['poin']/2;
		}

			$poinhotel=0;
		
		$insentifmalam = ($cucikiloan+$keringkiloan+$psetrika+$cucipotongan+$poinhotel+$packingkiloan+$packingpotongan)/$kerjareg/2*$datatambah['masuk_malam'];

		$cuciexp = mysqli_query($con, "SELECT COUNT(*) as bonus, op_cuci FROM reception WHERE op_cuci='$datauser[name]' AND (express='1' OR express='2' OR express='3') AND jenis='k' AND (DATE_FORMAT(tgl_cuci, '%Y-%m-%d') BETWEEN '$startDate' AND '$endDate') ");
			$rsltcuciexp = mysqli_fetch_array($cuciexp);

		$cuciprio= mysqli_query($con, "SELECT COUNT(*) as bonus, op_cuci FROM reception WHERE op_cuci='$datauser[name]' AND priority='1' AND express='0' AND jenis='k' AND (DATE_FORMAT(tgl_cuci, '%Y-%m-%d') BETWEEN '$startDate' AND '$endDate') ");
			$rsltcuciprio = mysqli_fetch_array($cuciprio);

		$setrikaexp = mysqli_query($con, "SELECT COUNT(*) as bonus, user_setrika FROM reception WHERE user_setrika='$datauser[name]' AND (express='1' OR express='2' OR express='3') AND (DATE_FORMAT(tgl_setrika, '%Y-%m-%d') BETWEEN '$startDate' AND '$endDate') ");
			$rsltsetrikaexp = mysqli_fetch_array($setrikaexp);

		$packingexp = mysqli_query($con, "SELECT COUNT(*) as bonus, user_packing FROM reception WHERE user_packing='$datauser[name]' AND (express='1' OR express='2' OR express='3')  AND (DATE_FORMAT(tgl_packing, '%Y-%m-%d') BETWEEN '$startDate' AND '$endDate') ");
			$rsltpackingexp = mysqli_fetch_array($packingexp);
			
			if($datauser['name']==$rsltcuciexp['op_cuci'] || $datauser['name']==$rsltcuciprio['op_cuci']){
				$bonusop = $rsltcuciexp['bonus']+$rsltcuciprio['bonus']/2;
				$ketbonus = "Express & Priority";
			}else if($datauser['name']==$rsltpackingexp['user_packing']){
				$bonusop = $rsltpackingexp['bonus'];
				$ketbonus = "Express";
			}else if($datauser['name']==$rsltsetrikaexp['user_setrika']){
				$bonusop = $rsltsetrikaexp['bonus'];
				$ketbonus = "Express";
			}else if($datauser['level']=='operator' && $datauser['jenis']=='potongan'){
				$ketbonus = "Omset Potongan 4%";
				$bonusop = ($omsetpotongan/$datakerjaopr[0]*$kerjareg)*0.04/1100/$jumOperator;			
			}else{
				$bonusop = 0;
				$ketbonus = "--";
			}
			
			if($datauser['level']=='setrika' && $datauser['jenis']=='potongan'){
				$ketbonus2 = "Omset Potongan 2%";
				$bonusop2 = ($omsetpotongan/$datakerjastr[0]*$kerjareg)*0.02/800;
			}else if($datauser['level']=='operator' && $datauser['jenis']=='potongan'){
				$ketbonus2 = "Omset Potongan 4%";
				$bonusop2 = ($omsetpotongan/$datakerjaopr[0]*$kerjareg)*0.04/1100;			
			}else{
				$bonusop2 = 0;
				$ketbonus2 = "--";
			}
			

			$pstandar_op = 1100;
			$pbonus_op = 1800;
			$pstandar_st = 800;
			$pbonus_st = 800;
			$pstandar_pc = 950;
			$pbonus_pc = 1500;

			$dendatelatopr = mysqli_query($con, "SELECT COUNT(*) AS telat FROM denda_cucian_telat WHERE operator='$datauser[name]' AND DATE_FORMAT(tgl_denda, '%Y-%m-%d') BETWEEN '$startDate' AND '$endDate' ");
			$hitungdendatelatopr = mysqli_fetch_array($dendatelatopr);

			$dendatelatpck = mysqli_query($con, "SELECT COUNT(*) AS telat FROM denda_cucian_telat WHERE packer='$datauser[name]' AND DATE_FORMAT(tgl_denda, '%Y-%m-%d') BETWEEN '$startDate' AND '$endDate' ");
			$hitungdendatelatpck = mysqli_fetch_array($dendatelatpck);

			if($datauser['level']=='operator') $dendaopr = $hitungdendatelatopr['telat']; else if($datauser['level']=='packer') $dendaopr = $hitungdendatelatpck['telat']; else $dendaopr = 0;

				if($datatambah['kasus_nota']<>"0" && $dendaopr<>"0"){
					$denda = $datatambah['kasus_nota']+$dendaopr;
					$ketdenda = "Cucian Telat & Kasus Operasional";
				} else if($datatambah['kasus_nota']<>"0" && $dendaopr=="0"){
					$denda = $datatambah['kasus_nota'];
					$ketdenda = "Kasus Operasional";
				} else if($datatambah['kasus_nota']=="0" && $dendaopr<>"0"){
					$denda = $dendaopr;
					$ketdenda = "Cucian Telat";
				} else{
					$denda = 0;
					$ketdenda = "--";
				}

			//masih bermasalah di kasus nota. kasus nota tidak
			if($datauser['level']=='operator'){
			    if($datauser['jenis']=='potongan'){
			        $pencapaian = ($pbrosur+$bonusop2-$denda);
			        $pencapaian2 = $pencapaian;
			    } else{
			        $pencapaian = ($pbrosur+$cucikiloan+$keringkiloan+$psetrika+$cucipotongan+$poinhotel+$packingkiloan+$packingpotongan+$insentifmalam+$bonusop-$denda);
			        $pencapaian2 = 0;
			    }
				$rataharian = ($pencapaian/$kerjareg);
				$kekuranganpoinperbulan = ($rataharian-$target)*$kerjareg;
				if($pencapaian<=$poinmin || $pencapaian<$poinnonbonus) $bonuspot = ($pencapaian-$poinmin)*$pstandar_op; else $bonuspot = ($poinnonbonus-$poinmin)*$pstandar_op+($pencapaian-$poinnonbonus)*$pstandar_op;
				
			}else if($datauser['level']=='packer'){				
				$pencapaian = ($pbrosur+$cucikiloan+$keringkiloan+$psetrika+$cucipotongan+$poinhotel+$packingkiloan+$packingpotongan+$insentifmalam+$bonusop-$denda);
				$pencapaian2 = 0;
				$rataharian = ($pencapaian/$kerjareg);
				$kekuranganpoinperbulan = ($rataharian-$target)*$kerjareg;
				if($pencapaian<=$poinmin || $pencapaian<$poinnonbonus) $bonuspot = ($pencapaian-$poinmin)*$pstandar_pc; else $bonuspot = ($poinnonbonus-$poinmin)*$pstandar_pc+($pencapaian-$poinnonbonus)*$pstandar_pc;
			}else if($datauser['level']=='setrika'){
				if($datatambah['kasus_nota']>0){
					$denda = $datatambah['kasus_nota'];
					$ketdenda = "Kasus Operasional";
				} if($datatambah['kasus_nota']=0){
					$denda = 0;
					$ketdenda = "--";
				}
				
				$pencapaian = ($pbrosur+$cucikiloan+$keringkiloan+$psetrika+$cucipotongan+$poinhotel+$packingkiloan+$packingpotongan+$insentifmalam+$bonusop-$denda);				
				$rataharian = ($pencapaian/$kerjareg);
				$kekuranganpoinperbulan = ($rataharian-$target)*$kerjareg;	
				if($datauser['jenis']=='potongan'){					
					$pencapaian2 = ($pbrosur+$bonusop2-$denda);
					$poinmin2 = 0;
					$poinnonbonus2 = 0;
					if($pencapaian2<=$poinmin2 || $pencapaian2<$poinnonbonus2) $bonuspot = ($pencapaian2-$poinmin2)*$pstandar_st; else $bonuspot = ($poinnonbonus2-$poinmin2)*$pstandar_st+($pencapaian2-$poinnonbonus2)*$pstandar_st;	
				}else{
					if($pencapaian<=$poinmin || $pencapaian<$poinnonbonus) $bonuspot = ($pencapaian-$poinmin)*$pstandar_st; else $bonuspot = ($poinnonbonus-$poinmin)*$pstandar_st+($pencapaian-$poinnonbonus)*$pstandar_st;
				}				
			}else{
			    $pencapaian = ($pbrosur+$cucikiloan+$keringkiloan+$psetrika+$cucipotongan+$poinhotel+$packingkiloan+$packingpotongan+$insentifmalam+$bonusop-$denda);
				$pencapaian2 = 0;
				$rataharian = ($pencapaian/$kerjareg);
				$kekuranganpoinperbulan = ($rataharian-$target)*$kerjareg;
				if($pencapaian<=$poinmin || $pencapaian<$poinnonbonus) $bonuspot = ($pencapaian-$poinmin)*$pstandar_pc; else $bonuspot = ($poinnonbonus-$poinmin)*$pstandar_pc+($pencapaian-$poinnonbonus)*$pstandar_pc;
			}	
		?>	

			
		<td><input class="hidden" type="text" name="poinmin[]" value="<?php echo $poinmin; ?>"><?php echo $poinmin; ?></td>
		<td><input class="hidden" type="text" name="poinnonbonus[]" value="<?php echo $poinnonbonus; ?>"><?php echo $poinnonbonus; ?></td>
		<td><input class="hidden" type="text" name="pencapaianpoin[]" value="<?php echo round($pencapaian,2) ?>"><?php echo round($pencapaian,2) ?></td>
		<td><input class="hidden" type="text" name="pencapaianpoin2[]" value="<?php echo round($pencapaian2,2) ?>"><?php echo round($pencapaian2,2) ?></td>
		<td><input class="hidden" type="text" name="bonuspot[]" value="<?php echo round($bonuspot) ?>"><?php echo round($bonuspot) ?></td>		
		<td><input class="hidden" type="text" name="cucikiloan[]" value="<?php echo round($cucikiloan,2) ?>"><?php echo round($cucikiloan,2) ?></td>
		<td><input class="hidden" type="text" name="keringkiloan[]" value="<?php echo round($keringkiloan,2) ?>"><?php echo round($keringkiloan,2) ?></td>
		<td><input class="hidden" type="text" name="poinsetrika[]" value="<?php echo round($psetrika,2) ?>"><?php echo round($psetrika,2) ?></td>
		<td><input class="hidden" type="text" name="cucipotongan[]" value="<?php echo round($cucipotongan,2) ?>"><?php echo round($cucipotongan,2) ?></td>
		<td><input class="hidden" type="text" name="poinhotel[]" value="<?php echo $poinhotel ?>"><?php echo $poinhotel ?></td>
		<td><input class="hidden" type="text" name="packingkilo[]" value="<?php echo round($packingkiloan,2) ?>"><?php echo round($packingkiloan,2) ?></td>
		<td><input class="hidden" type="text" name="packingpot[]" value="<?php echo round($packingpotongan,2) ?>"><?php echo round($packingpotongan,2) ?></td>
		<td><input class="hidden" type="text" name="insmalam[]" value="<?php echo round($insentifmalam,2) ?>"><?php echo round($insentifmalam,2) ?></td>		
		<td><input class="hidden" type="text" name="ketbonus[]" value="<?php echo $ketbonus ?>"><?php echo $ketbonus ?></td>
		<td><input class="hidden" type="text" name="bonusopr[]" value="<?php echo round($bonusop,2); ?>"><?php echo round($bonusop,2); ?></td>
		<td><input class="hidden" type="text" name="ketbonus2[]" value="<?php echo $ketbonus2 ?>"><?php echo $ketbonus2 ?></td>
		<td><input class="hidden" type="text" name="bonusopr2[]" value="<?php echo round($bonusop2,2); ?>"><?php echo round($bonusop2,2); ?></td>
		<td><input class="hidden" type="text" name="ketdenda[]" value="<?php echo $ketdenda; ?>"><?php echo $ketdenda; ?></td>
		<td><input class="hidden" type="text" name="denda[]" value="<?php echo round($denda,2); ?>"><?php echo round($denda,2); ?></td>
		<td><input class="hidden" type="text" name="rataharian[]" value="<?php echo round($rataharian,2); ?>"><?php echo round($rataharian,2); ?></td>
		<td><input class="hidden" type="text" name="kurangpoin[]" value="<?php echo round($kekuranganpoinperbulan,2); ?>"><?php echo round($kekuranganpoinperbulan,2); ?></td>
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
</form>
</fieldset>
</div>

