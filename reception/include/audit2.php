<?php
session_start();
include '../../config.php';
include '../../auth.php';
date_default_timezone_set('Asia/Makassar');
$ot = $_SESSION['nama_outlet'];
$tgl = date('Y-m-d');
?>
                        <div class="panel-heading">
                            <strong><a href='index.php?menu=audit'>MAKASSAR</a></strong> |
                            <strong><a href='index.php?menu=audit_mojokerto'>MOJOKERTO</a></strong> |
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
                                        </tr>
                                    </thead>
                                    <tbody>
										<?php
										$tgl_ambil = date('Y-m-d h:i:s',strtotime('-72 hours'));
                                    	$qcustomer = mysqli_query($con, "select * from reception a, customer b where a.id_customer=b.id and a.nama_outlet<>'$ot' and a.tgl_ambil>='$tgl_ambil' order by rand() limit 0,20");
										while ($rcustomer = mysqli_fetch_array($qcustomer)){
											if(mysqli_num_rows(mysqli_query($con, "SELECT * FROM quality_audit a, reception b WHERE a.no_nota=b.no_nota AND b.id_customer='$rcustomer[id_customer]' AND DATE(a.tgl_input) >= CURDATE() - INTERVAL 3 WEEK"))>0)
											{
											}
											else{
										?>
                                        <tr class="odd gradeX">
                                            <td><a href="index.php?menu=qualityaudit&cari=<?php echo $rcustomer['no_nota']; ?>"><?php echo $rcustomer['nama_customer']; ?></a></td>
                                            <td><?php echo $rcustomer['alamat']; ?></td>
                                            <td><?php echo $rcustomer['no_telp']; ?></td>
                                            <td><?php echo $rcustomer['tgl_ambil']; ?></td>                                            
											<td><?php echo $rcustomer['no_nota']; ?></td>                                            
                                        </tr>
										<?php	
											}
										}
										?>
                                    </tbody>
                                </table>
                            </div>                            
                        </div>