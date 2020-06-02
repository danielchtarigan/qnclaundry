<?php
//Koneksi database
include 'config.php';
$cari = $_GET['cari'];
 
if ( !empty ( $cari ) ) {
 
//Query sql untuk mencari data
$sql = mysqli_query($con,"SELECT * From reception where no_nota = '$cari' LIMIT 1");
 
//Cek apakah data ditemukan
$row = mysqli_num_rows( $sql );
 
//Jika ditemukan maka tampilkan
if ( $row != 0 ) {
 
		while ( $r = mysqli_fetch_assoc( $sql ) ) 
		{
			if($r['cuci']=='1') {
    			$cuci = '<font color="green">Ok</font>';
   				}
   			else{
		      $cuci = '<font color="Red">Maaf Belum Di Cuci</font>';
		   		}
		   	if($r['setrika']=='1') {
    			$setrika = '<font color="green">Ok</font>';
   				}
   			else{
		      $setrika = '<font color="Red">Maaf Belum Di setrika</font>';
		   		}
			if($r['packing']=='1') {
    			$packing = '<font color="green">Ok</font>';
   				}
   			else{
		      $packing ='<font color="Red">Maaf Belum Di packing</font>';
		   		}
		   		
		   	if($r['kembali']=='1') {
    			$kembali = '<font color="green">Ok</font>';
   				}
   			else{
		      $kembali = '<font color="Red">Maaf Belum sampai di outlet</font>';
		   		}

		   
			?><br/>
				<div class="form-group">
				No Nota 	  : <label class="control-label" for="nama"><?php echo $r['no_nota']; ?></label>
		  		</div>
		  		
		  		<div class="form-group">
		  		Nama Customer : <label class="control-label" for="nama_customer"><?php echo $r['nama_customer']; ?></label>
				</div>
				
				<div class="form-group">
		  		Tanggal Masuk : <label class="control-label" for="nama_customer"><?php echo $r['tgl_input']; ?></label>
				</div>
				<div class="form-group">
		  		cuci 	  : <label class="control-label" for="nama"><?php echo $cuci; ?></label>
		  		</div>
				<div class="form-group">
		  		Tgl Cuci : <label class="control-label" for="nama_customer"><?php echo $r['tgl_cuci']; ?></label>
				</div>
				<div class="form-group">
		  		setrika 	  : <label class="control-label" for="nama"><?php echo $setrika; ?></label>
		  		</div>
				<div class="form-group">
		  		Tgl setrika : <label class="control-label" for="nama_customer"><?php echo $r['tgl_setrika']; ?></label>
				</div>
				<div class="form-group">
		  		Packing 	  : <label class="control-label" for="nama"><?php echo $packing; ?></label>
		  		</div>
				<div class="form-group">
		  		Tgl Packing : <label class="control-label" for="nama_customer"><?php echo $r['tgl_packing']; ?></label>
				</div>
				<div class="form-group">
		  		Kembali Ke Outlet 	  : <label class="control-label" for="nama"><?php echo $kembali; ?></label>
		  		</div>
				<div class="form-group">
		  		Tgl Kembali : <label class="control-label" for="nama_customer"><?php echo $r['tgl_kembali']; ?></label>
				</div>
		  		
		  		
		  		
		  		


		 


		<?php 
		}
		}
else 
{ 
echo "Tidak menemukan data"; }
 
}
