                        <div class="panel-heading">
                            DAFTAR RECOVERY
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <a href="index.php?menu=add_recovery"><button type="submit" class="btn btn-default">Add New</button></a>
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
                                            <th>Nilai Voucher</th>
                                            <th>Status</th>
                                            <th>Reception</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
										$qcustomer = mysqli_query($con, "select * from voucher_recovery where nilai<>0");
										while ($rcustomer = mysqli_fetch_array($qcustomer)){	
									?>
                                        <tr class="odd gradeX">
                                            <td><?php echo $rcustomer['kode']; ?></td>
                                            <td><?php echo $rcustomer['nilai']; ?></td>
                                            <td><?php echo $rcustomer['status']; ?></td>
                                            <td><?php echo $rcustomer['rcp']; ?></td>
                                        </tr>
									<?php	
										}
									 ?>
                                    </tbody>
                                </table>
                            </div>                            
                        </div>