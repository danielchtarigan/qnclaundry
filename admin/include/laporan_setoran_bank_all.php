                        <div class="panel-heading">
                            Kas Resepsionis dan Setoran Bank
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Karyawan</th>
                                            <th>Outlet</th>
                                            <th>Tanggal</th>
                                            <th>Bank</th>
                                            <th>Jumlah</th>
                                            <th>Kode Referensi</th>
                                            <th>Status Verifikasi</th>
                                            <th>OP Verifikasi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
										$no = 1;
										$qcustomer = mysqli_query($con, "select * from setoran_bank order by id desc");
										while ($rcustomer = mysqli_fetch_array($qcustomer)){	
									?>
                                        <tr class="odd gradeX">
                                            <td><?php echo $no; ?></td>
                                            <td><?php echo $rcustomer['reception']; ?></td>
                                            <td><?php echo $rcustomer['outlet']; ?></td>
                                            <td><?php echo $rcustomer['tanggal']; ?></td>
                                            <td><?php echo $rcustomer['bank']; ?></td>
                                            <td><?php echo rupiah($rcustomer['setoran']); ?></td>
                                            <td><?php echo $rcustomer['kode_referensi']; ?></td>
                               	            <td align="center" style="vertical-align:middle;">
                                            <?php 
											if ($rcustomer['verifikasi']=='Belum'){
											?>
                                            <button type="button" class="btn btn-primary btn-xs" style="background-color:#F00; border-color:#F00;">Proses</button>
											<?php
											} 
											else{
											?>
                                            <button type="button" class="btn btn-info btn-circle;" style="width:50px; height:40px;"><i class="fa fa-check"></i></button>
                                            <?php
                                            }
											?>
											</td>
                                            <td><?php echo $rcustomer['op_verifikasi']; ?></td>
                                        </tr>
									<?php
									$no++;	
										}
									?>
                                    </tbody>
                                </table>
                                