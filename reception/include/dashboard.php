<?php
include 'pencapaian_kpi.php';
include 'laporan_kas_resepsionis.php';
include "info_piutang.php";
?>

                        <div class="panel-heading">
                            <strong>Data Express</strong>
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example" style="font-size:12px;">
                                    <thead>
                                        <tr>
			<th>No</th>
			<th>Tanggal Masuk</th>
			<th>No Nota</th>
			<th>Nama Customer</th>
			<th>Cuci</th>
			<th>Setrika</th>
			<th>Packing</th>
                                        </tr>
                                    </thead>
                                    <tbody>
			<?php

			$outlet=$_SESSION['nama_outlet'];
			$query = "SELECT * FROM reception where nama_outlet='$outlet' and kembali=false and express=true AND cara_bayar<>'Void' AND cara_bayar<>'Reject' ORDER BY tgl_input desc limit 0,10" ;
			$tampil = mysqli_query($con, $query);
			
			$no = 1;
			while($data = mysqli_fetch_array($tampil)){?>
				<tr>
						<td><?php echo $no ;?> </td>
						<td><?php echo $data['tgl_input'];?></td>
						<td><?php echo $data['no_nota'];?></td>
						<td><?php echo $data['nama_customer'];?></td>
						<td><?php		       if($data['tgl_cuci']<>"0000-00-00 00:00:00")
		       {
			   echo ''.$data['tgl_cuci'].'';
		       }
		       else
			   {
			   echo 'belum';
		       };
			  ?>
		       
		      
                                                </td>
                                                <td><?php		       if($data['tgl_setrika']<>"0000-00-00 00:00:00")
		       {
			   echo ''.$data['tgl_setrika'].'';
		       }
		       else
			   {
			   echo 'belum';
		       };
			  ?></td>
			  			<td><?php		       if($data['tgl_packing']<>"0000-00-00 00:00:00")
		       {
			   echo ''.$data['tgl_packing'].'';
		       }
		       else
			   {
			   echo 'belum';
		       };
			  ?></td>
						
						</tr>
			
						<?php $no++; 
						} 
 ?> 
 
 
 
 
 
                                    </tbody>
                                </table>
                            </div>                            
                        </div>




    <!-- DataTables JavaScript -->
    <script src="../js/plugins/dataTables/jquery.dataTables.js"></script>
    <script src="../js/plugins/dataTables/dataTables.bootstrap.js"></script>
    

    
      <script>
    $(document).ready(function() {
        $('#dataTables-example').dataTable();
    });
    </script>