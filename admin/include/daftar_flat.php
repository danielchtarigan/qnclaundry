                        <div class="panel-heading">
                            DAFTAR PROMO FLAT
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <a href="index.php?menu=add_flat"><button type="submit" class="btn btn-default">Add New</button></a>
                                </div>
                                <!-- /.col-lg-6 (nested) -->
                            </div>
                            <!-- /.row (nested) -->
                            <br>
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>Kode</th>
                                            <th>Syarat</th>
                                            <th>Minimum Transaksi</th>
                                            <th>Maksimum Transaksi</th>
                                            <th>Pembayaran</th>
                                            <th>Status</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
										$qcustomer = mysqli_query($con, "select * from promo_flat");
										while ($rcustomer = mysqli_fetch_array($qcustomer)){	
									?>
                                        <tr class="odd gradeX">
                                            <td><?php echo $rcustomer['kode']; ?></td>
                                            <td><?php echo $rcustomer['syarat']; ?></td>
                                            <td><?php echo $rcustomer['minimum_berat']; ?></td>
                                            <td><?php echo $rcustomer['maksimum_berat']; ?></td>
                                            <td><?php echo $rcustomer['pembayaran']; ?></td>
                                            <td><a href="act/ubahstatusflat.php?kode=<?php echo $rcustomer['kode']; ?>&status=<?php echo $rcustomer['status']; ?>"><?php echo $rcustomer['status']; ?></td>
                                            <td><a href="index.php?menu=add_flat&kode=<?php echo $rcustomer['kode']; ?>"> Edit</a> | <a href="act/hapus_flat.php?kode=<?php echo $rcustomer['kode']; ?>"> Hapus</a></td>
                                        </tr>
									<?php	
										}
									 ?>
                                    </tbody>
                                </table>
                            </div>                            
                        </div>