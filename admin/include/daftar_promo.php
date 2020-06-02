                        <div class="panel-heading">
                            DAFTAR PROMO
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <a href="index.php?menu=add_promo"><button type="submit" class="btn btn-default">Add New</button></a>
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
										$qcustomer = mysqli_query($con, "select * from kode_promo");
										while ($rcustomer = mysqli_fetch_array($qcustomer)){	
									?>
                                        <tr class="odd gradeX">
                                            <td><?php echo $rcustomer['kode']; ?></td>
                                            <td><?php echo $rcustomer['syarat']; ?></td>
                                            <td><?php echo $rcustomer['minimum_transaksi']; ?></td>
                                            <td><?php echo $rcustomer['maksimum_transaksi']; ?></td>
                                            <td><?php echo $rcustomer['pembayaran']; ?></td>
                                            <td><a href="act/ubahstatuspromo.php?kode=<?php echo $rcustomer['kode']; ?>&status=<?php echo $rcustomer['status']; ?>"><?php echo $rcustomer['status']; ?></td>
                                            <td><a href="index.php?menu=add_promo&kode=<?php echo $rcustomer['kode']; ?>"> Edit</a> | <a href="act/hapus_promo.php?kode=<?php echo $rcustomer['kode']; ?>"> Hapus</a></td>
                                        </tr>
									<?php	
										}
									 ?>
                                    </tbody>
                                </table>
                            </div>                            
                        </div>