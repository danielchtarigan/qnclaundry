<?php 
if(isset($_POST['submit'])){
	$startDate = $_POST['start'];
	$endDate   = $_POST['end'];
	
} else{
	$startDate = date('Y-m', strtotime('-1 months', strtotime(date('Y-m-d')))).'-26';
	$endDate   = date('Y-m').'-25';
}

function tanggal_pemasukan($username,$startDate,$endDate){
	global $con;
	$query = mysqli_query($con, "SELECT DISTINCT DATE_FORMAT(tanggal_input, '%Y-%m-%d') AS tgl FROM cara_bayar WHERE resepsionis='$username' AND (DATE_FORMAT(tanggal_input, '%Y-%m-%d') BETWEEN '$startDate' AND '$endDate') AND outlet<>'mojokerto' UNION SELECT DISTINCT DATE_FORMAT(tgl_transaksi, '%Y-%m-%d') AS tgl FROM faktur_penjualan WHERE (DATE_FORMAT(tgl_transaksi, '%Y-%m-%d') BETWEEN '$startDate' AND '$endDate') AND rcp='$username' AND nama_outlet<>'mojokerto' ORDER BY tgl ASC");
	$dataa = mysqli_fetch_row($query);
	return $dataa[0];
}

function total_kas_order($username,$startDate,$endDate){
	global $con;
	$query = mysqli_query($con, "SELECT COALESCE(SUM(jumlah),0) AS total FROM cara_bayar WHERE (cara_bayar='Cash' OR cara_bayar='cash') AND (DATE_FORMAT(tanggal_input, '%Y-%m-%d') BETWEEN '$startDate' AND '$endDate') AND resepsionis='$username'");
	$dataa = mysqli_fetch_row($query);
	return $dataa[0];
}

function total_kas_langganan($username,$startDate,$endDate){
	global $con;
	$query = mysqli_query($con, "SELECT COALESCE(SUM(total),0) AS total FROM faktur_penjualan WHERE cara_bayar LIKE '%cash%' AND (DATE_FORMAT(tgl_transaksi, '%Y-%m-%d') BETWEEN '$startDate' AND '$endDate') AND rcp='$username' AND jenis_transaksi<>'ritel'");
	$dataa = mysqli_fetch_row($query);
	return $dataa[0];
}

function total_kas_pengeluaran($username,$startDate,$endDate){
	global $con;
	$query = mysqli_query($con, "SELECT COALESCE(SUM(pengeluaran),0) AS total FROM tutup_kasir WHERE (DATE_FORMAT(tanggal, '%Y-%m-%d') BETWEEN '$startDate' AND '$endDate') AND reception='$username'");
	$dataa = mysqli_fetch_row($query);
	return $dataa[0];
}

function total_kas_setoran($username,$startDate,$endDate){
	global $con;
	$query = mysqli_query($con, "SELECT COALESCE(SUM(setoran),0) AS total FROM setoran_bank WHERE (DATE_FORMAT(tanggal, '%Y-%m-%d') BETWEEN '$startDate' AND '$endDate') AND reception='$username'");
	$dataa = mysqli_fetch_row($query);
	return $dataa[0];
}

function detail_pemasukan($username,$startDate,$endDate){
	$dataa['tanggal'] = tanggal_pemasukan($username,$startDate,$endDate);
	$dataa['total_sisa_kas'] =  total_kas_order($username,$startDate,$endDate)+total_kas_langganan($username,$startDate,$endDate)-total_kas_pengeluaran($username,$startDate,$endDate)-total_kas_setoran($username,$startDate,$endDate);
	return $dataa;
}

function tanggal_setoran($username,$tanggal){
	global $con;
	$query = mysqli_query($con, "SELECT DISTINCT DATE_FORMAT(tanggal, '%Y-%m-%d') AS tanggal FROM setoran_bank WHERE tanggal LIKE '%$tanggal%' AND reception='$username'");
	$datta = mysqli_fetch_row($query);
	return $datta[0];
}

function cash_bersih_order($username,$tanggal){
	global $con;
	$query = mysqli_query($con, "SELECT COALESCE(SUM(jumlah),0) AS total FROM cara_bayar WHERE (cara_bayar='Cash' OR cara_bayar='cash') AND tanggal_input LIKE '%$tanggal%' AND resepsionis='$username'");
	$datta = mysqli_fetch_row($query);
	return $datta[0];
}

function cash_bersih_langganan($username,$tanggal){
	global $con;
	$query = mysqli_query($con, "SELECT COALESCE(SUM(total),0) AS total FROM faktur_penjualan WHERE cara_bayar LIKE '%cash%' AND tgl_transaksi LIKE '%$tanggal%' AND rcp='$username' AND jenis_transaksi<>'ritel'");
	$datta = mysqli_fetch_row($query);
	return $datta[0];
}

function pengeluaran($username,$tanggal){
	global $con;
	$query = mysqli_query($con, "SELECT COALESCE(SUM(pengeluaran),0) AS total FROM tutup_kasir WHERE tanggal LIKE '%$tanggal%' AND reception='$username'");
	$datta = mysqli_fetch_row($query);
	return $datta[0];
}

function setoran_bank($username,$tanggal){
	global $con;
	$query = mysqli_query($con, "SELECT COALESCE(SUM(setoran),0) AS total FROM setoran_bank WHERE tanggal LIKE '%$tanggal%' AND reception='$username'");
	$datta = mysqli_fetch_row($query);
	return $datta[0];
}


function detail_setoran($username,$tanggal){
	$datta['cash_bersih'] = cash_bersih_order($username,$tanggal)+cash_bersih_langganan($username,$tanggal)- pengeluaran($username,$tanggal);
	$datta['setoran_bank'] = setoran_bank($username,$tanggal);
	$datta['tanggal_setor'] = tanggal_setoran($username,$tanggal);
	return $datta;
}

?>


<legend><center>Laporan Kas Resepsionis</center></legend>
<?php include 'cari2.php'; ?>

<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
  <?php 
  $b = 1;
	$query = mysqli_query($con, "SELECT DISTINCT name FROM user WHERE level='reception' AND aktif='Ya' ORDER BY name ASC");
	while($data = mysqli_fetch_array($query)){
		$username = $data['name'];
		$dataa = detail_pemasukan($username,$startDate,$endDate);
		if($dataa['tanggal']>0){
	$n = $b++;
	?>
  <div class="panel panel-default">
      <h4 class="panel-title">
        <a class="list-group-item" role="button" data-toggle="collapse" data-parent="#accordion" href="<?php echo '#collapse'.substr($username,0,3); ?>" aria-expanded="false" aria-controls="collapseTwo">
          <?php echo $username ?>
          <span class="pull-right text-muted small"><em><?php echo rupiah($dataa['total_sisa_kas']); ?></em></span>
        </a>
      </h4>
    <div id="<?php echo 'collapse'.substr($username,0,3); ?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
      <div class="panel-body"> 
        <div style="overflow-x: auto">
			<table class="table table-bordered table-hover" id="<?php echo 'tampilkans'.$n ?>">
				<thead>
					<tr>
						<th>NO</th>
						<th>Tanggal Pemasukan</th>
						<th>Nama Resepsionis</th>
						<th>Setoran Bank</th>
						<th>Penerimaan Cash</th>
						<th>Saldo Cash</th>
					</tr>
				</thead>
				<tbody>
					<?php 
					$i = 1;
					$query2 = mysqli_query($con, "SELECT DISTINCT DATE_FORMAT(tanggal_input, '%Y-%m-%d') AS tgl FROM cara_bayar WHERE resepsionis='$username' AND (DATE_FORMAT(tanggal_input, '%Y-%m-%d') BETWEEN '$startDate' AND '$endDate') UNION SELECT DISTINCT DATE_FORMAT(tgl_transaksi, '%Y-%m-%d') AS tgl FROM faktur_penjualan WHERE (DATE_FORMAT(tgl_transaksi, '%Y-%m-%d') BETWEEN '$startDate' AND '$endDate') AND rcp='$username' ORDER BY tgl ASC");
					while($data2 = mysqli_fetch_array($query2)){
						$tanggal = $data2['tgl'];
						$no = $i++;
						$datta = detail_setoran($username,$tanggal);
					?>
					<tr>						
						<td><?php echo $no; ?></td>
						<td><?php echo date('l, d M Y', strtotime($data2['tgl'])) ?></td>
						<?php 
						if($no==1){
							echo '<td>'.$username.'</td>';
							echo '<td>'.rupiah($datta['setoran_bank']).'</td>';
							echo '<td>'.rupiah($datta['cash_bersih']).'</td>';
							$setoran = $datta['setoran_bank'];
							$cash_bersih = $datta['cash_bersih'];
							$saldo = $cash_bersih-$setoran;
							echo '<td>'.rupiah($saldo).'</td>';
						} else{
							echo '<td>'.$username.'</td>';
							echo '<td>'.rupiah($datta['setoran_bank']).'</td>';
							echo '<td>'.rupiah($datta['cash_bersih']).'</td>';
							$cash_bersih = $cash_bersih+$datta['cash_bersih'];
							$setoran = $setoran+$datta['setoran_bank'];
							$saldo = $cash_bersih-$setoran;
							echo '<td>'.rupiah($saldo).'</td>';												
						}
						?>				
					</tr>
					<?php } ?>	
				</tbody>
			</table>			
		</div>

		<script type="text/javascript">
		$(document).ready(function(){
			$('<?php echo '#tampilkans'.$n ?>').dataTable({
				dom: 'T<"clear">lfrtip',
                tableTools: {
                    "sSwfPath": "swf/copy_csv_xls_pdf.swf",
                    "aButtons": [ 'copy',
                        {
                            'sExtends': 'xls',
                            'sFileName': 'detail_setoran.xls',
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
					"iDisplayLength": 5,"aLengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]],					
				});

		});
	 </script> 
      </div>
    </div>
   </div>   
	<?php } } ?>
</div>


