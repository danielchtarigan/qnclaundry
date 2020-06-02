<?php 
if(isset($_POST['submit'])){
	$startDate = $_POST['startDate'];
	$endDate = $_POST['endDate'];
}
else {
	$startDate = date('Y-m-d', strtotime('-7 days', strtotime($date)));
	$endDate = $date;
}


?>     




<div class="app-title">
<div>
  <h1><i class="fa fa-th-list"></i> Tables</h1>
  <p>Tabel Omset dan Order</p>
</div>
<ul class="app-breadcrumb breadcrumb side">
  <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
  <li class="breadcrumb-item">Tables</li>
  <li class="breadcrumb-item active"><a href="#">Tabel Order Belum Lunas <?= $_SESSION['cabang'] ?></a></li>
</ul>
</div>


<div class="tile">
<div class="tile-body">
  <h4>Select Range</h4>
  <form class="row" method="POST" action="">
    <div class="form-group col-md-3">
      <input class="form-control" type="" placeholder="Select Start Date" id="startDate" name="startDate" value="<?= $startDate ?>" autocomplete="off">
    </div>
    <div class="form-group col-md-3">
      <input class="form-control" type="" placeholder="Select End Date" id="endDate" name="endDate" value="<?= $endDate ?>" autocomplete="off">
    </div>
    <div class="form-group col-md-4 align-self-end">
      <button class="btn btn-success" type="submit" name="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Submit</button>
    </div>
  </form>
</div>
</div>


<div class="tile">
	<div class="tile-body">
	  <h4>Pendapatan Omset Belum Lunas</h4>

	      <div class="table-responsive" style="overflow-x:auto">
			<table class="table table-bordered table-striped table-condensed" id="" style="width: 600px; margin:0 auto">
				<thead>
					<tr>
						<th>Nama Outlet</th>
						<th>Kiloan</th>
						<th>Potongan</th>
						<th>Jumlah</th>
					</tr>
				</thead>
				<tbody>
					<?php 
					
						$tKiloan = 0;
						$tPotongan =0;
						$sql = $con-> query("SELECT * FROM reception a, outlet b WHERE a.nama_outlet=b.nama_outlet AND a.cara_bayar<>'Void' AND a.cara_bayar<>'Reject' AND a.rijeck=false AND b.Kota='$cabang' AND a.nama_outlet='$outlet' AND a.lunas=false AND DATE_FORMAT(a.tgl_input, '%Y-%m-%d') BETWEEN '$startDate' AND '$endDate' GROUP BY a.nama_outlet ASC ");
						
						if(mysqli_num_rows($sql)>0){
							while($rs = $sql->fetch_array()){
							echo '
							<tr>
								<td>'.$rs['nama_outlet'].'</td>';

								$kiloan = mysqli_fetch_array(mysqli_query($con, "SELECT SUM(total_bayar) FROM reception WHERE jenis='k' AND nama_outlet='$rs[nama_outlet]' AND lunas=false AND DATE_FORMAT(tgl_input, '%Y-%m-%d') BETWEEN '$startDate' AND '$endDate'"))[0];
								$potongan = mysqli_fetch_array(mysqli_query($con, "SELECT SUM(total_bayar) FROM reception WHERE jenis='p' AND nama_outlet='$rs[nama_outlet]' AND lunas=false AND DATE_FORMAT(tgl_input, '%Y-%m-%d') BETWEEN '$startDate' AND '$endDate'"))[0];

								$tKiloan += $kiloan;
								$tPotongan += $potongan;
								$jumlah = $kiloan+$potongan;

								echo '

								<td align="center">'.number_format($kiloan,0,',','.').'</td>

								<td align="center">'.number_format($potongan,0,',','.').'</td>
								<td align="center">'.number_format($jumlah,0,',','.').'</td>
							</tr>
							';
							}
						
						}
						else {
							echo "<tr><td colspan='4' align='center'>No data available in table</td></tr>";
						
						}

						?>
							
				</tbody>
				<tfoot>
		            <tr>
		                <th style="text-align:right; background-color: #00A8FF; text-align: right;">Total:</th>
		                <th style="background-color: #00A8FF; text-align: center"><?= number_format($tKiloan,0,',','.') ?></th>
		                <th style="background-color: #00A8FF; text-align: center"><?= number_format($tPotongan,0,',','.') ?></th>
		                <th style="background-color: #00A8FF; text-align: center"><?= number_format($tKiloan+$tPotongan,0,',','.') ?></th>
		            </tr>
		        </tfoot>
			</table>
		</div>	      
	</div>
</div>


<div class="tile">
<div class="tile-body">
  <h4>Rincian Omset Belum Terbayar</h4>
  <div class="table-responsive">
  	<table class="table table-hover table-striped" id="omsetTable">
        <thead>
          <tr>
            <th width="15%">Input Date</th>
            <th width="15%">Ordered By</th>
            <th width="15%">Number Order</th>
            <th width="20%">Customer</th>
            <th width="20%">Price Order</th>
            <th>Discount</th>
            <th>Voucher</th>
          </tr>
        </thead>
        <tbody>
          <?php         

      
          $sql = $con-> query("SELECT * FROM reception a, outlet b WHERE a.nama_outlet=b.nama_outlet AND a.cara_bayar<>'Void' AND a.cara_bayar<>'Reject' AND b.Kota='$cabang' AND a.nama_outlet='$outlet' AND a.rijeck=false AND a.lunas=false AND DATE_FORMAT(a.tgl_input, '%Y-%m-%d') BETWEEN '$startDate' AND '$endDate'");
          while($data = $sql-> fetch_array()){
          	?>
          	<tr>
          	  <td><?= date('Y-m-d', strtotime($data['tgl_input'])) ?></td>
          	  <td><?= $data['nama_reception'] ?></td>	
          	  <td><?= $data['no_nota'] ?></td>	
          	  <td><?= $data['nama_customer'] ?></td>	
          	  <td><?= $data['total_bayar'] ?></td>	
          	  <td><?= $data['diskon'] ?></td>	
          	  <td><?= $data['voucher'] ?></td>			
          	</tr>

          	<?php

          }


          ?>
        </tbody>
    </table>
  </div>
      
</div>
</div>