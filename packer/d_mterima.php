<?php
?>

                        <div class="panel-heading">
                        <center><strong>DATA MANIFEST TRANSFER MASUK</strong></center>
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example" style="font-size:12px;">
                                    <thead>
                                        <tr>
			<th>No</th>
			<th>Tanggal</th>
			<th>Kode Manifest</th>
			<th>Operator</th>
			<th>Driver</th>
			<th>Jumlah Nota</th>
			<th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
			<?php

			$workshop=$_SESSION['workshop'];
			$query2 = "SELECT * FROM workshop WHERE workshop='$workshop'";
			$hasil2 = mysqli_query($con,$query2);
			$data2  = mysqli_fetch_array($hasil2);
			$kd = $data2['kode'];
			$query = "SELECT * FROM man_terima where tempat='$workshop' and kode_terima like '%MTM".$kd."%' order by tgl desc limit 10" ;
			$tampil = mysqli_query($con, $query);
			
			$no = 1;
			while($data = mysqli_fetch_array($tampil)){?>
				<tr>
						<td><?php echo $no ;?> </td>
						<td><?php echo $data['tgl'];?></td>
						<td><?php echo $data['kode_terima'];?></td>
						<td><?php echo $data['penerima'];?></td>
						<td><?php echo $data['driver'];?></td>
						<td><?php echo $data['jumlah'];?></td>
						<td>
							<a href="cetak_manifest2.php?kode=<?=$data['kode_terima']?>" target="_blank">
							<button class="btn btn-default">Cetak</button></a>
						</td>
						
						</tr>
			
						<?php $no++; 
						} 
 ?> 
 
 
 
 
 
                                    </tbody>
                                </table>
                            </div>                            
                        </div>

