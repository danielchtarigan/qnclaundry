<?php 

$id = decrypt($_GET['customerId'],$key);


$customer = mysqli_fetch_row(mysqli_query($con, "SELECT nama_customer FROM customer WHERE id='$id'"))[0];
$total_order = mysqli_fetch_row(mysqli_query($con, "SELECT SUM(total_bayar) FROM reception WHERE id_customer='$id' AND cabang='$_SESSION[cabang]' "))[0]

?>


<div class="app-title">
<div>
  <h1><i class="fa fa-th-list"></i> Tables</h1>
  <p>Data Customer</p>
</div>
<ul class="app-breadcrumb breadcrumb side">
  <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
  <li class="breadcrumb-item">Tables</li>
  <li class="breadcrumb-item active"><a href="#">Riwayat Order <?= $_SESSION['cabang'] ?></a></li>
</ul>
</div>


<div class="tile">
	<div class="tile-body">
		<div class="row">
			<h4 class="col-lg-6 col-xs-12"><?= $customer ?></h4>
			<h4 class="col-lg-6 col-xs-12 col-lg-offset-6 align-right"><?= 'Dengan kontribusi Rp '. number_format($total_order) ?></h4>
		</div>
		
	</div>
</div>


<div class="tile">
	<div class="tile-body">
	  <h4>Riwayat Order</h4>
	  <div class="table-responsive">
	  	<table class="table table-hover table-striped" id="omsetTable">
	        <thead>
	          <tr>
	            <th width="15%">Tanggal Order</th>
	            <th>Reception Order</th>
	            <th width="15%">Nomor Order</th>
	            <th width="">Harga Order</th>
	            <th width="">Nomor Pembayaran</th>
	            <th width="">Tanggal Bayar</th>
	          </tr>
	        </thead>
	        <tbody>
	          <?php         

	      		$total = 0;
	          $sql = $con-> query("SELECT * FROM reception WHERE id_customer='$id' AND cabang='$_SESSION[cabang]'");
	          while($data = $sql-> fetch_array()){
	          	$total += $data['total_bayar'];

	          	$colorLunas = ($data['lunas']=="1") ? "lunas" : "belum-lunas";

	          	?>
	          	<tr>
	          	  <td class="<?= $colorLunas ?>"><?= date('Y-m-d', strtotime($data['tgl_input'])) ?></td>
	          	  <td class="<?= $colorLunas ?>"><?= $data['nama_reception'] ?></td>
	          	  <td class="<?= $colorLunas ?>"><a href="#" title="Click to view" class="data-order <?= $colorLunas ?>" data-toggle="modal" data-target="#rincian_order" id="<?php echo $data['no_nota'];?>"><?= strtoupper($data['no_nota']) ?></a></td>	
	          	  <td class="<?= $colorLunas ?>"><?= $data['total_bayar'] ?></td>	
	          	  <td class="<?= $colorLunas ?>"><?= ($data['lunas']=="1") ? $data['no_faktur'] : "Belum Lunas" ?></td>	
	          	  <td class="<?= $colorLunas ?>"><?= ($data['lunas']=="1") ? date('Y-m-d', strtotime($data['tgl_lunas'])) : "-" ?></td>			
	          	</tr>

	          	<?php

	          }


	          ?>
	        </tbody>
	        <tfoot>
	        	<tr class="background-total">
	        		<th colspan="3" style="text-align: right">Total Order</th>
	        		<th><?= number_format($total) ?></th>
	        		<th colspan="2"></th>
	        	</tr>
	        </tfoot>
	    </table>
	  </div>
	      
	</div>
</div>