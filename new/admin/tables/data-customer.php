

<div class="app-title">
<div>
  <h1><i class="fa fa-th-list"></i> Tables</h1>
  <p>Data Customer</p>
</div>
<ul class="app-breadcrumb breadcrumb side">
  <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
  <li class="breadcrumb-item">Tables</li>
  <li class="breadcrumb-item active"><a href="#">Daftar Customer <?= $_SESSION['cabang'] ?></a></li>
</ul>
</div>


<div class="tile">
	<div class="tile-body">
	  <h4>Daftar Customer</h4>
	  <div class="table-responsive">
	  	<table class="table table-hover table-striped" id="omsetTable">
	        <thead>
	          <tr>
	            <th width="15%">Terdaftar Sejak</th>
	            <th width="15%">Nama Customer</th>
	            <th width="35%">Alamat</th>
	            <th width="">Telepon</th>
	            <th width="">Berlangganan</th>
	            <th width="">Membership</th>
	          </tr>
	        </thead>
	        <tbody>
	          <?php         

	      
	          $sql = $con-> query("SELECT DISTINCT a.id, a.tgl_input AS tgl_input,a.nama_customer AS nama_customer,a.no_telp,a.alamat,a.member,a.lgn FROM customer a, reception b WHERE a.id=b.id_customer AND (a.kota='$_SESSION[cabang]' OR b.cabang='$_SESSION[cabang]') AND b.nama_outlet='$outlet'");
	          while($data = $sql-> fetch_array()){

	          	?>
	          	<tr>
	          	  <td><?= date('Y-m-d', strtotime($data['tgl_input'])) ?></td>
	          	  <td id="<?= encrypt($data['id'],$key)  ?>" class="riwayat-order"><a href="#" style="color:black"><?= $data['nama_customer'] ?></a></td>	
	          	  <td><?= $data['alamat'] ?></td>	
	          	  <td><?= $data['no_telp'] ?></td>	
	          	  <td><?= ($data['lgn']=="1") ? "Ya" : "-" ?></td>			
	          	  <td><?= ($data['member']=="1") ? "Ya" : "-" ?></td>			
	          	</tr>

	          	<?php

	          }


	          ?>
	        </tbody>
	    </table>
	  </div>
	      
	</div>
</div>

