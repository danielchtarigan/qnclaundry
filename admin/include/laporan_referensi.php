                        <div class="panel-heading">
                            Laporan Customer Referensi
                        </div>
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Customer Baru</th>
                                            <th>Customer Referensi</th>
                                            <th>No Telepon Customer Referensi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
					$no = 1;
					$qcustomer = mysqli_query($con, "select * from customer where referensi<>0 order by id desc");
					while ($rcustomer = mysqli_fetch_array($qcustomer)){	
					  $valid = mysqli_query($con, "select * from customer where no_telp='$rcustomer[referensi]'");
					  $rvalid = mysqli_fetch_array($valid);
					  $nvalid = mysqli_num_rows($valid);
					  if ($nvalid>0){
						?>
	                                        <tr class="odd gradeX">
	                                            <td><?php echo $no; ?></td>
	                                            <td><?php echo $rcustomer['nama_customer']; ?></td>
	                                            <td><?php echo $rvalid['nama_customer']; ?></td>
	                                            <td><?php echo $rvalid['no_telp']; ?></td>
	                                        </tr>
						<?php
					  }
					  else{
					  
					  }
									$no++;	
										}
									?>
                                    </tbody>
                                </table>
                            </div>                            
                        </div>                 