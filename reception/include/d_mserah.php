<?php
?>

                        <div class="panel-heading"><table width="100%"><tr>
                        <td><strong>Data Manifest Serah Workshop</strong></td>
                        <td align="right"><a href="?menu=mserah">
							<button class="btn btn-default">Manifest Baru</button></a>
						</td></tr></table>
                            
                            
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example" style="font-size:12px;">
                                    <thead>
                                        <tr>
			<th>No</th>
			<th>Tanggal</th>
			<th>Kode Manifest</th>
			<th>Resepsionis</th>
			<th>Driver</th>
			<th>Jumlah Nota</th>
			<th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
			<?php

			$outlet=$_SESSION['nama_outlet'];
			$query2 = "SELECT * FROM outlet WHERE nama_outlet='$outlet'";
			$hasil2 = mysqli_query($con,$query2);
			$data2  = mysqli_fetch_array($hasil2);
			$kd = $data2['kode'];
			$query = "SELECT * FROM man_serah where tempat='$outlet' and kode_serah like '%MSW".$kd."%' order by tgl desc limit 10" ;
			$tampil = mysqli_query($con, $query);
			
			$no = 1;
			while($data = mysqli_fetch_array($tampil)){?>
				<tr>
						<td><?php echo $no ;?> </td>
						<td><?php echo $data['tgl'];?></td>
						<td><?php echo $data['kode_serah'];?></td>
						<td><?php echo $data['pemberi'];?></td>
						<td><?php echo $data['driver'];?></td>
						<td><?php echo $data['jumlah'];?></td>
						<td>
							<a href="cetak_manifest.php?kode=<?=$data['kode_serah']?>" target="_blank">
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

