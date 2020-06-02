<?php
if ($con->connect_error){
	echo "Gagal terkoneksi ke database : (".$mysqli->connect_error.")".$mysqli->connect_error;
}
?>
<table class="table table-bordered" id="datapotongan" name="datapotongan" style="background:green;">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Item</th>
                                            <th>Harga Satuan</th>
                                            <th>Jumlah</th>
                                            <th>Keterangan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
<?php
										$qcustomer = mysqli_query($con, "select * from order_potongan_tmp where id_customer='$_GET[id]' order by id desc");
										$ncustomer = mysqli_num_rows($qcustomer);
										if ($ncustomer>0){
											$no = 1;
										while ($rcustomer = mysqli_fetch_array($qcustomer)){																				
										?>
                                        <tr>
                                            <td><?php echo $no;?></td>
                                            <td><?php echo $rcustomer['item']; ?></td>
                                            <td><?php echo $rcustomer['harga']; ?></td>
                                            <td><?php echo $rcustomer['jumlah']; ?></td>
                                            <td><?php echo $rcustomer['ket']; ?></td>                                            
                                        </tr>
									<?php	
									$no++;
										}
										}
									else{
									?>
                                        <tr class="odd gradeX">
                                            <td colspan="6" align="center">.. Data Tidak Ada ..</td>
                                        </tr>
                                     <?php
									 }
									 ?>
									 </tbody>
                                </table>