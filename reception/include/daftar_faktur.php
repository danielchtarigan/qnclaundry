                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>No Faktur</th>
                                            <th>Tanggal</th>
                                            <th>Nilai Transaksi</th>
                                            <th>Pilih</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
										$qcustomer = mysqli_query($con, "select * from faktur_penjualan where id_customer='$_GET[id]' order by id desc limit 0,10");
										$ncustomer = mysqli_num_rows($qcustomer);
										if ($ncustomer>0){
											$no = 1;
										while ($rcustomer = mysqli_fetch_array($qcustomer)){	
																			
									?>
                                        <tr class="odd gradeX">
                                            <td><?php echo $no;?></td>
                                            <td><?php echo $rcustomer['no_faktur']; ?></td>
                                            <td><?php echo $rcustomer['tgl_transaksi']; ?></td>
                                            <td><?php echo $rcustomer['total']; ?></td>
                                            <td><a href="cetak_faktur.php?faktur=<?php echo $rcustomer['no_faktur']; ?>" target="_blank"><input type="button" name="faktur" value="cetak" /></a></td>
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
                            </div>                            
                        </div>
