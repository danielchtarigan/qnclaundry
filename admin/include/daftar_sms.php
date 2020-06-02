                        <div class="panel-heading">
                            DAFTAR SMS PROMOSI
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <a href="index.php?menu=add_sms"><button type="submit" class="btn btn-default">Add New</button></a>
                                </div>
                                <!-- /.col-lg-6 (nested) -->
                            </div>
                            <!-- /.row (nested) -->
                            <br>
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Tanggal Mulai</th>
                                            <th>Tanggal Selesai</th>
                                            <th>Isi SMS</th>
                                            <th>Target Penyebaran</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
										$no = 1;
										$qcustomer = mysqli_query($con, "select * from sms_customer");
										while ($rcustomer = mysqli_fetch_array($qcustomer)){	
									?>
                                        <tr class="odd gradeX">
                                            <td><?php echo $no; ?></td>
                                            <td><?php echo $rcustomer['tgl_mulai']; ?></td>
                                            <td><?php echo $rcustomer['tgl_selesai']; ?></td>
                                            <td><?php echo $rcustomer['sms']; ?></td>
                                            <td><?php echo $rcustomer['target']; ?></td>
                                            <td><a href="index.php?menu=add_sms&kode=<?php echo $rcustomer['kode']; ?>"> Edit</a> | <a href="act/hapus_sms.php?kode=<?php echo $rcustomer['kode']; ?>"> Hapus</a></td>
                                        </tr>
									<?php	
									$no++;
										}
									 ?>
                                    </tbody>
                                </table>
                            </div>                            
                        </div>