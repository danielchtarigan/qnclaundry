<?php
session_start();
include '../../config.php';
include '../../auth.php';
date_default_timezone_set('Asia/Makassar');
$ot = $_SESSION['nama_outlet'];
$tgl = date('Y-m-d');
?>
                        <div class="panel-heading">
                            <strong><a href='index.php?menu=audit'>DATA QUALITY AUDIT</a></strong> | 
							<strong><a href='index.php?menu=audithariini'>QUALITY AUDIT HARI INI</a></strong>
                        </div>
                        <div class="panel-body">
                            <!-- /.row (nested) -->
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>Nama</th>
                                            <th>Alamat</th>
                                            <th>Telepon</th>
                                            <th>Tangal Ambil</th>
                                            <th>No. Nota</th>
											<th>Reception</th>
                                        </tr>
                                    </thead>
                                    <tbody>
										<?php
										$hariini = date('Y-m-d');
										$qcustomer = mysqli_query($con, "select * from quality_audit where tgl_input>='$hariini'");
										while ($rcustomer = mysqli_fetch_array($qcustomer)){
										  $qcus = mysqli_query($con, "select * from customer where nama_customer='$rcustomer[nama_customer]'");										
										  $rcus = mysqli_fetch_array($qcus);										  
										  $qcus1 = mysqli_query($con, "select * from reception where no_nota='$rcustomer[no_nota]'");										
										  $rcus1 = mysqli_fetch_array($qcus1);
										?>
                                        <tr class="odd gradeX">
                                            <td><?php echo $rcustomer['nama_customer'];?></td>
                                            <td><?php echo $rcus['alamat']; ?></td>
                                            <td><?php echo $rcus['no_telp']; ?></td>
                                            <td><?php echo $rcus1['tgl_ambil']; ?></td>                                            
											<td><?php echo $rcustomer['no_nota']; ?></td>                                            
											<td><?php echo $rcustomer['user_input']; ?></td>                                            
                                        </tr>
										<?php	
										}
										?>
                                    </tbody>
                                </table>
                            </div>                            
                        </div>
