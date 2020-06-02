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
  <li class="breadcrumb-item active"><a href="#">Tabel Order Dibatalkan</a></li>
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
	  <h4>Rincian Order Dibatalkan</h4>
	  <div class="table-responsive">
	  	<table class="table table-hover table-striped" id="voidTable">
	        <thead>
	          <tr>
	            <th width="15%">Canceled Date</th>
	            <th width="15%">Canceled By</th>
	            <th width="15%">Number Order</th>
	            <th width="15%">Customer</th>
	            <th width="15%">Price Order</th>
	            <th>Status</th>
	            <th width="25%">The Reason for canceled</th>
	          </tr>
	        </thead>
	        <tbody>
	          <?php         

	      
	          $sql = $con-> query("SELECT * FROM order_batal a, reception b WHERE a.no_order=b.no_nota AND b.cabang='$_SESSION[cabang]' AND b.nama_outlet='$outlet' AND DATE_FORMAT(a.tanggal, '%Y-%m-%d') BETWEEN '$startDate' AND '$endDate'");
	          while($data = $sql-> fetch_array()){
	          	?>
	          	<tr>
	          	  <td><?= date('Y-m-d', strtotime($data['tanggal'])) ?></td>
	          	  <td><?= $data['rcp_input'] ?></td>
	          	  <td><a href="#" style="color: black" title="Click to view" class="data-order" data-toggle="modal" data-target="#rincian_order" id="<?php echo $data['no_order'];?>"><?= strtoupper($data['no_order']) ?></a></td>	
	          	  <td><?= $data['nama_customer'] ?></td>	
	          	  <td><?= $data['harga'] ?></td>	
	          	  <td><?= $data['status'] ?></td>	
	          	  <td><?= strtolower($data['alasan']) ?></td>			
	          	</tr>

	          	<?php

	          }


	          ?>
	        </tbody>
	    </table>
	  </div>
	      
	</div>
</div>
